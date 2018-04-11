<?php
/**
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */

use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoTechnicalException;
use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoUnknownPaymentException;
use CrefoShopwarePlugIn\Components\API\Request\BonimaReportRequest;
use CrefoShopwarePlugIn\Components\Core\Enums\CountryType;
use CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use CrefoShopwarePlugIn\Components\Core\Enums\PaymentType;
use CrefoShopwarePlugIn\Components\Core\PasswordEncoder;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Payment\CrefoInvoiceService;
use CrefoShopwarePlugIn\Components\Payment\PaymentResponse;
use CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest;
use CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests;
use CrefoShopwarePlugIn\Components\Core\Enums\ErrorToleranceType;
use CrefoShopwarePlugIn\Components\Core\Enums\AmountRequestsType;
use CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults;
use CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults;
use CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount;
use CrefoShopwarePlugIn\Components\Core\Enums\IdentificationResultType;
use CrefoShopwarePlugIn\Components\Core\Enums\AddressValidationResultType;
use Shopware\Components\CSRFWhitelistAware;

/**
 * @see https://developers.shopware.com/developers-guide/shopware-5-plugin-update-guide/
 * Class Shopware_Controllers_Frontend_CrefoInvoice
 */
class Shopware_Controllers_Frontend_CrefoInvoice extends Shopware_Controllers_Frontend_Payment implements CSRFWhitelistAware
{
    const POSITIVE_RESPONSE = 'RIJM-10';
    const NO_VALUE_TEXT = 'novalue';
    const FAULT_TEXT = 'fault';
    const PAYMENT_STATUS_OPEN = 17;
    const CUSTOMER_NUMBER_TEXT = 'no cust num';
    const CREFO_PAYMENT_NAME = 'crefo_invoice';
    const EMAIL_TEMPLATE_DE = 'de';
    const BONIMA_SCORE_TYPE_KEY = "CGSYTY-1";

    /**
     * @var string
     */
    private $transactionId;

    /**
     * @var int
     */
    private $logId;

    /**
     * @var \CrefoShopwarePlugIn\CrefoShopwarePlugIn
     */
    private $plugin;

    /**
     * @var array
     */
    private $configs;
    /**
     * @var array
     */
    private $currentConfig;

    /**
     * @var \Enlight_Components_Session_Namespace
     */
    private $session;

    /**
     * @var \Shopware\Components\Model\ModelManager
     */
    private $swagModelManager;

    /**
     * @var int
     */
    private $reportType;

    /**
     * @codeCoverageIgnore
     * {@inheritdoc}
     */
    public function init()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==init==', []);
        $this->plugin = CrefoCrossCuttingComponent::getCreditreformPlugin();
        $this->session = $this->get('Session');
        $this->swagModelManager = $this->get('Models');
        $this->configs = $this->session->offsetGet('sCrefoConfigs');
        $this->currentConfig = $this->session->offsetGet('sCrefoCurrentConfig');
    }

    /**
     * @codeCoverageIgnore
     */
    public function indexAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Crefo Invoice start Solvency check.', []);
        /**
         * @var CrefoReportResults $crefoResult
         */
        $crefoResult = null;
        $this->reportType = $this->session->offsetGet('sCrefoReportType');
        if ($this->getPaymentShortName() == self::CREFO_PAYMENT_NAME && $this->verifyCrefoInvoice($crefoResult)) {
            $this->swagModelManager->persist($crefoResult);
            $this->swagModelManager->flush();
            /** @var CrefoInvoiceService $service */
            $service = $this->get('creditreform.crefo_invoice_service');
            $user = $this->getUser();
            $billing = $user['billingaddress'];
            $this->redirect([
                 'action' => 'return',
                 'status' => 'accepted',
                 'signature' => $this->persistBasket(),
                 'crefoResultId' => $crefoResult->getId(),
                 'crefoLogId' => $this->logId,
                 'token' => $service->createPaymentToken($this->getAmount(), $billing['customernumber']),
                 'transactionId' => $this->transactionId,
                 'forceSecure' => true,
             ]);

            return;
        }
        $this->forward('shippingPayment', 'checkout', null,
                ['sTarget' => 'checkout', 'sTargetAction' => 'confirm', 'sCrefoBadResponse' => true]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function returnAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Process crefo payment after the solvency check.',
            ['Save data related to the Order.']);

        /** @var CrefoInvoiceService $service */
        $service = $this->get('creditreform.crefo_invoice_service');
        $user = $this->getUser();
        $billing = $user['billingaddress'];
        /** @var PaymentResponse $response */
        $response = $service->createPaymentResponse($this->Request());
        $signature = $response->signature;
        $token = $service->createPaymentToken($this->getAmount(), $billing['customernumber']);

        if (!$service->isValidToken($response, $token)) {
            $this->forward('shippingPayment', 'checkout', null,
                ['sTarget' => 'checkout', 'sTargetAction' => 'confirm', 'sCrefoBadResponse' => true]);

            return;
        }

        try {
            $basket = $this->loadBasketFromSignature($signature);
            $this->verifyBasketSignature($signature, $basket);
            $success = true;
        } catch (Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, 'Non valid signature', [$e]);
            $success = false;
        }

        if (!$success) {
            $this->forward('shippingPayment', 'checkout', null,
                ['sTarget' => 'checkout', 'sTargetAction' => 'confirm', 'sCrefoBadResponse' => true]);

            return;
        }

        switch ($response->status) {
            case 'accepted':
                $orderNumber = $this->saveOrder(
                    $response->transactionId,
                    $response->token,
                    self::PAYMENT_STATUS_OPEN
                );
                $this->logId = $response->crefoLogId;
                /**
                 * @var CrefoReportResults $crefoResult
                 */
                $crefoResult = $this->swagModelManager->find(CrefoReportResults::class, $response->crefoResultId);
                $crefoResult->setOrderNumber($orderNumber);
                $this->swagModelManager->persist($crefoResult);
                $this->swagModelManager->flush();
                $this->saveResultIdInLogs($crefoResult, $this->logId, LogStatusType::SAVE_AND_SHOW);
                CrefoCrossCuttingComponent::resetCrefoVariables($this->session);
                $this->redirect(['controller' => 'checkout', 'action' => 'finish']);
                break;
            default:
                $this->forward('shippingPayment', 'checkout', null,
                    ['sTarget' => 'checkout', 'sTargetAction' => 'confirm', 'sCrefoBadResponse' => true]);
                break;
        }
    }

    /**
     * @codeCoverageIgnore
     * {@inheritdoc}
     */
    public function get($name)
    {
        return CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get($name);
    }

    /**
     * @codeCoverageIgnore
     * {@inheritdoc}
     */
    public function preDispatch()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==preDispatch==',
            ['Start crefo_invoice.']);
        if (in_array($this->Request()->getActionName(), ['index', 'return'])) {
            $this->get('front')->Plugins()->ViewRenderer()->setNoRender();
        }
    }

    /**
     * The getaway controller.
     *
     * @codeCoverageIgnore
     *
     * @param CrefoReportResults &$crefoResult
     *
     * @return bool
     */
    public function verifyCrefoInvoice(&$crefoResult = null)
    {
        try {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==Validate Crefo Invoice Payment==',
                ['Starts Solvency Check.']);

            if ($this->reportType === PaymentType::COMPANY) {
                $crefoResult = $this->performSolvencyCheckForCompanies();
            } elseif ($this->reportType === PaymentType::PERSON) {
                $crefoResult = $this->performSolvencyCheckForPrivatePerson();
            } else {
                throw new CrefoUnknownPaymentException('Unknown Payment.');
            }
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                "==Couldn't continue to finish the checkout-CrefoBadSolvencyException-CrefoBadSolvencyException.==",
                (array) $e);
            $this->session->offsetSet('sCrefoBadResponse', true);

            return false;
        } catch (CrefoUnknownPaymentException $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                "==Couldn't continue to finish the checkout-CrefoUnknownPaymentException-CrefoUnknownPaymentException.==",
                (array) $e);
            $this->handleCustomExceptions();

            return false;
        } catch (CrefoTechnicalException $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                "==Couldn't continue to finish the checkout-CrefoTechnicalException-CrefoTechnicalException.==",
                (array) $e);
            $this->handleCustomExceptions();

            return false;
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                "==Couldn't continue to finish the checkout-Exception.==",
                (array) $e);
            $this->handleCustomExceptions();

            return false;
        }
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG,
            '==verifyCrefoInvoice::Validation succeeded==',
            ['successfulSolvency' => $crefoResult->getSuccessfulSolvency()]);

        return true;
    }

    /**
     * @codeCoverageIgnore
     * {@inheritdoc}
     */
    public function getWhitelistedCSRFActions()
    {
        return [
            'shippingPayment',
            'confirm',
            'return',
            'finish',
            'index',
        ];
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults $crefoResult
     *
     * @return bool
     */
    private function hasBadSolvencyResult($crefoResult)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==hasBadSolvencyResult==', ['Check for bad solvency.']);
        if (null !== $crefoResult && !$crefoResult->getSuccessfulSolvency()) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==hasBadSolvencyResult==', ['Has bad solvency result.']);
            $this->swagModelManager->persist($crefoResult);
            $this->swagModelManager->flush($crefoResult);
            $this->saveResultIdInLogs($crefoResult, $this->logId);
            $this->session->offsetSet('sCrefoReportResultId', $crefoResult->getId());

            return true;
        }

        return false;
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults $crefoResult
     * @param int                                                         $logID
     * @param $logStatus
     */
    private function saveResultIdInLogs($crefoResult, $logID, $logStatus = LogStatusType::NOT_SAVED)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==saveResultIdInLogs==', [$crefoResult, $logID]);
        if (null !== $logID) {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs $crefoLog
             */
            $crefoLog = $this->swagModelManager->find(\CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs::class, $logID);
            $crefoLog->setReportResultId($crefoResult);
            $crefoLog->setStatusLogs($logStatus);
            $this->swagModelManager->persist($crefoLog);
            $this->swagModelManager->flush();
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @throws \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoTechnicalException|\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException
     *
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults
     */
    private function performSolvencyCheckForCompanies()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==performSolvencyCheckForCompanies==',
            ['Starts the solvency check.']);
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults $crefoResult
         */
        $crefoResult = $this->get('creditreform.identification_report_results');
        $errorNotification = $this->countRequestNotification();
        $successfulCall = true;
        try {
            /**
             * @var \CrefoShopwarePlugIn\Components\API\Request\IdentificationReportRequest $identificationReportRequest
             */
            $identificationReportRequest = $this->fillReportCompaniesRequestObject();
            $this->transactionId = $this->getTransactionIdFromTransmissionTime($identificationReportRequest->getHeader()->getTransmissionTimestamp());
            $identificationReportResponse = $identificationReportRequest->performIdentificationReport();
            $identificationReportRequest->getCrefoParser()->setRawResponse($identificationReportResponse);
            $crefoResult = $this->fillIdentificationReportFromResponse($identificationReportRequest,
                $identificationReportResponse,
                $crefoResult);
            $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs($identificationReportRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\SoapFault $fault) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performIdentificationReport>>SoapFault ' . date('Y-m-d H:i:s') . '==', [$fault->getMessage()]);
            $crefoResult = $this->fillIdentificationReportFromResponse($identificationReportRequest,
                $identificationReportRequest->getLastSoapCallResponse(), $crefoResult);
            $crefoResult->setRiskJudgement(self::FAULT_TEXT);
            $identificationReportRequest->getCrefoParser()->setRawResponse($fault);
            $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs($identificationReportRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
            $successfulCall = false;
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performIdentificationReport>>CrefoCommunicationException ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $crefoResult = $this->fillIdentificationReportFromResponse($identificationReportRequest, null,
                $crefoResult);
            $crefoResult->setRiskJudgement(self::FAULT_TEXT);
            $identificationReportRequest->getCrefoParser()->setRawResponse($e);
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            $this->logId = CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($identificationReportRequest,
                $xmlText, CrefoCrossCuttingComponent::ERROR);
            $successfulCall = false;
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performIdentificationReport>>Exception ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $successfulCall = false;
            if ($errorNotification) {
                $this->processErrorNotification($successfulCall);
            }
            throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoTechnicalException();
        }
        if ($errorNotification) {
            $this->processErrorNotification($successfulCall);
        }
        if ($this->hasBadSolvencyResult($crefoResult)) {
            throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException('Bad Solvency.');
        }

        return $crefoResult;
    }

    /**
     * @codeCoverageIgnore
     *
     * @throws \Exception|\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoTechnicalException|\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException
     *
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResult
     */
    private function performSolvencyCheckForPrivatePerson()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==performSolvencyCheckForPrivatePerson==',
            ['Starts the solvency check.']);
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResult
         */
        $crefoResult = $this->get('creditreform.bonima_report_results');
        $errorNotification = $this->countRequestNotification();
        $successfulCall = true;
        try {
            /**
             * @var \CrefoShopwarePlugIn\Components\API\Request\BonimaReportRequest $bonimaReportRequest
             */
            $bonimaReportRequest = $this->fillBonimaRequestObject();
            $this->transactionId = $this->getTransactionIdFromTransmissionTime($bonimaReportRequest->getHeader()->getTransmissionTimestamp());
            $bonimaReportResponse = $bonimaReportRequest->performBonimaReport();
            $bonimaReportRequest->getCrefoParser()->setRawResponse($bonimaReportResponse);
            $crefoResult = $this->fillBonimaReportFromResponse($bonimaReportRequest, $bonimaReportResponse, $crefoResult);
            $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs($bonimaReportRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\SoapFault $fault) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performBonimaReport>>SoapFault ' . date('Y-m-d H:i:s') . '==', [$fault->getMessage()]);
            $crefoResult = $this->fillBonimaReportFromResponse($bonimaReportRequest, $bonimaReportRequest->getLastSoapCallResponse(), $crefoResult);
            $crefoResult->setTextReportName($bonimaReportRequest->getCrefoParser()->extractTextTitleFromStringXml($bonimaReportRequest->getLastSoapCallResponse()));
            $bonimaReportRequest->getCrefoParser()->setRawResponse(strval($fault));
            $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs($bonimaReportRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
            $successfulCall = false;
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performBonimaReport>>CrefoCommunicationException ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $crefoResult->setTextReportName(self::FAULT_TEXT);
            $crefoResult->setSuccessfulSolvency(0);
            $crefoResult->setAddressValidationResult(self::FAULT_TEXT);
            $crefoResult->setIdentificationResult(self::FAULT_TEXT);
            $crefoResult->setScoreValue(0);
            $crefoResult->setScoreType(self::FAULT_TEXT);
            $bonimaReportRequest->getCrefoParser()->setRawResponse(strval($e));
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            $this->logId = CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($bonimaReportRequest, $xmlText,
                CrefoCrossCuttingComponent::ERROR);
            $successfulCall = false;
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performBonimaReport>>Exception ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $successfulCall = false;
            if ($errorNotification) {
                $this->processErrorNotification($successfulCall);
            }
            throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoTechnicalException();
        }
        if ($errorNotification) {
            $this->processErrorNotification($successfulCall);
        }
        if ($this->hasBadSolvencyResult($crefoResult)) {
            throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException('Bad Solvency.');
        }
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==performSolvencyCheckForPrivatePerson::noException==', ['successfulSolvency' => $crefoResult->getSuccessfulSolvency()]);

        return $crefoResult;
    }

    /**
     * @param $transmissionTime
     *
     * @return mixed
     */
    private function getTransactionIdFromTransmissionTime($transmissionTime)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getTransactionIdFromTransmissionTime==', [$transmissionTime]);

        return preg_replace(['/:/', '/-/'], ['', ''], $transmissionTime);
    }

    /**
     * @return bool
     */
    private function countRequestNotification()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==countRequestNotification==', []);
        $pluginSettings = $this->configs['general'];
        $errorNotification = boolval($pluginSettings['errorNotificationStatus']);
        if ($errorNotification) {
            $errorRequestsId = $this->plugin->getConfigurationId(ErrorRequests::class);
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests $errorRequestObj
             */
            $errorRequestObj = $this->swagModelManager->find(ErrorRequests::class, $errorRequestsId);
            $errorRequestObj->addRequest();
            $this->swagModelManager->persist($errorRequestObj);
            $this->swagModelManager->flush($errorRequestObj);
        }

        return $errorNotification;
    }

    /**
     * @param bool $resultHasNoError
     */
    private function processErrorNotification($resultHasNoError)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==processErrorNotification==', ['result' => $resultHasNoError]);
        $errorRequestsId = $this->plugin->getConfigurationId(ErrorRequests::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests $errorRequestObj
         */
        $errorRequestObj = $this->swagModelManager->find(ErrorRequests::class, $errorRequestsId);
        $isErrorsCounterChanged = false;
        if (!$resultHasNoError) {
            $errorRequestObj->addFailedRequest();
            $isErrorsCounterChanged = true;
        }
        if ($this->verifyErrorsOnRequest($errorRequestObj->getNumberOfRequests(), $errorRequestObj->getFailurePercent())) {
            $this->sendEmail($errorRequestObj->getNumberOfRequests(),
                $errorRequestObj->getNumberOfFailedRequests(), $errorRequestObj->getFailurePercent());
            $errorRequestObj->resetCounters();
            $isErrorsCounterChanged = true;
        }
        if ($this->hasReachedNumberOfRequestAllowed($errorRequestObj->getNumberOfRequests())) {
            $errorRequestObj->resetCounters();
            $isErrorsCounterChanged = true;
        }
        if ($isErrorsCounterChanged) {
            $this->swagModelManager->persist($errorRequestObj);
            $this->swagModelManager->flush($errorRequestObj);
        }
    }

    /**
     * @param integer $numberOfRequests
     * @return bool
     */
    private function hasReachedNumberOfRequestAllowed($numberOfRequests)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==hasReachedNumberOfRequestAllowed==', ['number of requests' => $numberOfRequests]);
        $settings = $this->configs['general'];
        return intval($numberOfRequests) >= AmountRequestsType::getAmountRequestsValue($settings['requestCheckAtValue']);
    }


    /**
     * @param integer $numberOfRequests
     * @param float $percent
     * @return bool - true if the Errors are overcoming the thresholds (send mail), otherwise false
     */
    private function verifyErrorsOnRequest($numberOfRequests, $percent)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==verifyErrorsOnRequest==', ['number of requests' => $numberOfRequests, 'percent' => $percent]);
        $settings = $this->configs['general'];
        if(!boolval($settings['errorNotificationStatus'])){
            return false;
        }
        $intValPercent = intval($percent);
        $ceilPercent = ceil($percent);
        if ($ceilPercent == $intValPercent) {
            $hasGreaterTolerance = $intValPercent >= ErrorToleranceType::getErrorToleranceValue($settings['errorTolerance']);
        } else {
            $hasGreaterTolerance = $ceilPercent > ErrorToleranceType::getErrorToleranceValue($settings['errorTolerance']);
        }
        $hasPassedNumberOfRequests = $numberOfRequests >= AmountRequestsType::getAmountRequestsValue($settings['requestCheckAtValue']);
        return $hasPassedNumberOfRequests && $hasGreaterTolerance;
    }

    /**
     * @param integer $numberOfRequests
     * @param integer $numberOfFailedRequests
     * @param float $errorQuote
     * @throws \Enlight_Exception
     */
    private function sendEmail($numberOfRequests, $numberOfFailedRequests, $errorQuote)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==sendEmail==', [$numberOfRequests, $numberOfFailedRequests, $errorQuote]);
        $settings = $this->configs['general'];
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\CrefoValidator $validator
         */
        $validator = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.validator');
        /**
         * @var ConfigHeaderRequest $configHeaderRequest
         */
        $configHeaderRequest = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.config_header_request');
        if (strcmp(strtolower($settings['communicationLanguage']), self::EMAIL_TEMPLATE_DE) == 0) {
            $mailTemplate = 'sCREFOERRORREQUESTNOTIFICATIONDE';
        } else {
            $mailTemplate = 'sCREFOERRORREQUESTNOTIFICATIONEN';
        }
        $configOverride = [
            "fromMail" => $settings['emailAddress'],
            'fromName' => ''
        ]; //fromMail => '' , fromName => ''
        $mail = CrefoCrossCuttingComponent::getShopwareInstance()->TemplateMail()->createMail($mailTemplate, [
            'errorNotification' => [
                'softwareVersion' => $configHeaderRequest->getPluginVersion(),
                'webshopVersion' => $configHeaderRequest->getShopVersion(),
                'numberOfRequests' => $numberOfRequests,
                'numberOfFailedRequests' => $numberOfFailedRequests,
                'errorQuote' => $validator->formatCurrency($errorQuote, $settings['communicationLanguage']),
                'errorNotification' => 'TRUE',
                'emailAddress' => $settings['emailAddress'],
                'numberOfRequestCheck' => AmountRequestsType::getAmountRequestsValue($settings['requestCheckAtValue']),
                'errorTolerance' => ErrorToleranceType::getErrorToleranceValue($settings['errorTolerance'])
            ]
        ], null, $configOverride);
        $mail->addTo($settings['emailAddress']);
        try {
            $mail->send();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, "==sendEmail==", ["Couldn't send email.", "error" => $e]);
        }
    }

    /**
     * @throws Exception
     *
     * @return \CrefoShopwarePlugIn\Components\API\Request\IdentificationReportRequest
     */
    private function fillReportCompaniesRequestObject()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==fillReportCompaniesRequestObject==', []);
        $accountArray = null;
        $configReportCompany = $this->configs['company'];
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
         */
        $account = $this->swagModelManager->find(CrefoAccount::class, $configReportCompany['user_account_id']);
        if ($account === null) {
            throw new \Exception('The account was removed and is not available anymore!');
        }
        $userData = $this->getUser();
        if (null === $userData) {
            throw new \Exception('The data from order variables is missing. The solvency check cannot be completed successful without it.');
        }
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Body\IdentificationReportBody $bodyObj
         */
        $bodyObj = $this->get('creditreform.identification_report_body');

        /**
         * @var \CrefoShopwarePlugIn\Components\API\Request\IdentificationReportRequest $requestObj
         */
        $requestObj = $this->get('creditreform.identification_report_request');
        /**
         * @var \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest $config
         */
        $config = $this->get('creditreform.config_header_request');
        $requestObj->setConfigHeaderRequest($config);
        $billingAddress = $userData['billingaddress'];
        $bodyObj->setCity($billingAddress['city']);
        $bodyObj->setCompanyName($billingAddress['company']);
        $bodyObj->setPostcode($billingAddress['zipcode']);
        $countryID = $billingAddress['countryID'];
        /**
         * @var \Shopware\Models\Country\Country $countryObject
         */
        $countryObject = $this->swagModelManager->find('Shopware\Models\Country\Country', intval($countryID));
        if (null === $countryObject) {
            throw new \Exception('Shopware country was not found!');
        }
        $country = CountryType::getCountryIdFromISO2($countryObject->getIso());
        $bodyObj->setCountry(CountryType::uppercaseISO2Countries($country));
        // @codeCoverageIgnoreStart
        if ($country === CountryType::LU) {
            $bodyObj->setStreet($billingAddress['street']);
        }// @codeCoverageIgnoreEnd
        else {
            $addressArray = $bodyObj->validateAddress($billingAddress['street']);
            $bodyObj->setStreet($addressArray['street']);
            $bodyObj->setHouseNumber($addressArray['number']);
            $bodyObj->setHouseNumberAffix($addressArray['affix']);
        }
        $bodyObj->setLegitimateInterest($configReportCompany['legitimateKey']);
        $bodyObj->setReportLanguage($configReportCompany['reportLanguageKey']);
        $bodyObj->setProductType($this->currentConfig['productKeyWS']);
        $bodyObj->setSolvencyIndexThreshold($this->currentConfig['thresholdIndex']);
        $bodyObj->initPhone();
        $bodyObj->getPhone()->setDiallingcode(null);
        $bodyObj->getPhone()->setPhonenumber($billingAddress['phone']);
        $bodyObj->setRegisterType(null);
        $bodyObj->setRegisterId(null);
        $bodyObj->setLegalForm(null);
        $bodyObj->setWebsite(null);
        $customerNumber = $userData['additional']['user']['customernumber'];
        if ($customerNumber !== null && $customerNumber !== '') {
            $bodyObj->setCustomerReference($customerNumber);
        } else {
            $bodyObj->setCustomerReference(self::CUSTOMER_NUMBER_TEXT);
        }
        $bodyObj->setVatid($billingAddress['vatid']);
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        $accountArray = [
            'userAccount' => $account->getUserAccount(),
            'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(),
                $config->getEncryptionKey()),
            'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                $config->getEncryptionKey()),
        ];
        $requestObj->setHeaderAccount($accountArray);
        $requestObj->setBody($bodyObj);

        return $requestObj;
    }

    /**
     * @param \CrefoShopwarePlugIn\Components\API\Request\IdentificationReportRequest $request
     * @param $response
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults $crefoResult
     *
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults
     */
    private function fillIdentificationReportFromResponse($request, $response, $crefoResult)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==fillIdentificationReportFromResponse==',
            ['Get values from Response.']);
        try {
            $crefoParser = $request->getCrefoParser();
            $crefoParser->setRawResponse($response);
            $crefoResult->setIndexThreshold($request->getBody()->getSolvencyIndexThreshold());
            $riskJudgementColour = $crefoParser->extractRiskJudgementColour();
            if (is_object($riskJudgementColour) && null !== $riskJudgementColour->key) {
                $crefoResult->setRiskJudgement($riskJudgementColour->key);
                strcmp(strtoupper($riskJudgementColour->key),
                    self::POSITIVE_RESPONSE) === 0 ? $crefoResult->setSuccessfulSolvency(true) : null;
                // @codeCoverageIgnoreStart
            } else {
                $crefoResult->setRiskJudgement(self::NO_VALUE_TEXT);
            } // @codeCoverageIgnoreEnd
            $crefoResult->setTextReportPdf($crefoParser->extractTextReport());
            // @codeCoverageIgnoreStart
            if (null === $response || is_string($response)) {
                $lastCallSoap = $response;
            } // @codeCoverageIgnoreEnd
            else {
                $lastCallSoap = $request->getLastSoapCallResponse();
            }
            $crefoResult->setTextReportNameFromValues($crefoParser->extractTextTitleFromStringXml($lastCallSoap));
            // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==fillReportFromResponse>>Exception==', (array) $e);
        }
        // @codeCoverageIgnoreEnd

        return $crefoResult;
    }

    /**
     * @param BonimaReportRequest $request
     * @param $response
     * @param PrivatePersonReportResults $crefoResult
     *
     * @return PrivatePersonReportResults
     */
    private function fillBonimaReportFromResponse($request, $response, $crefoResult)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==fillBonimaReportFromResponse==',
            ['Get values from Response.']);
        $crefoParser = $request->getCrefoParser();
        $crefoParser->setRawResponse($response);
        $crefoResult->setAddressValidationResult(strval($crefoParser->getAddressCheckResultKey()));
        $crefoResult->setIdentificationResult(strval($crefoParser->getIdentificationResultKey()));
        $crefoResult->setScoreType(strval($crefoParser->getScoreTypeResultKey()));
        $crefoResult->setScoreValue(intval($crefoParser->extractScoreValueResult()));
        if ($request->isInvalidBonimaResult($crefoParser)) {
            $crefoResult->setSuccessfulSolvency(false);
        } else {
            $crefoResult->setSuccessfulSolvency($this->areBonimaConditionsSatisfied($crefoResult));
        }
        return $crefoResult;
    }


    /**
     * checks if the Bonima Product conditions are satisfied
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResult
     * @return boolean
     */
    private function areBonimaConditionsSatisfied($crefoResult)
    {
        $satisfied = true;
        $satisfied = $satisfied && $this->isAddressConditionSatisfied($crefoResult->getAddressValidationResult());
        $satisfied = $satisfied && $this->compareKeys($crefoResult->getScoreType(), self::BONIMA_SCORE_TYPE_KEY);
        $identificationKeys = array_flip(IdentificationResultType::getIdentificationKeys($this->currentConfig['productKeyWS']));
        $satisfiesScoreProductConfig = false;
        if($satisfied) {
            /**
             * @var $scoreProduct \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductScoreConfig
             */
            foreach ($this->currentConfig['scoreProducts'] as $sequence => $scoreProduct) {
                if (array_key_exists($crefoResult->getIdentificationResult(), $identificationKeys) &&
                    $scoreProduct['identificationResult'] === $identificationKeys[$crefoResult->getIdentificationResult()] &&
                    boolval($this->currentConfig['isProductAvailable']) &&
                    null !== $scoreProduct['productScoreFrom'] &&
                    null !== $scoreProduct['productScoreTo'] &&
                    $scoreProduct['productScoreFrom'] <= $crefoResult->getScoreValue() &&
                    $scoreProduct['productScoreTo'] >= $crefoResult->getScoreValue()
                ) {
                    $satisfiesScoreProductConfig = true;
                }
            }
        }
        return  $satisfied && $satisfiesScoreProductConfig;
    }

    /**
     * @param string $addressKey
     * @return bool
     */
    private function isAddressConditionSatisfied($addressKey)
    {
        $addressAllowedKeys = AddressValidationResultType::getPositiveValidationAddresses();
        return in_array(strtoupper($addressKey), $addressAllowedKeys);
    }

    /**
     * @param string $keyA
     * @param string $keyB
     * @return bool
     */
    private function compareKeys($keyA, $keyB)
    {
        return strcmp(strtolower($keyA), strtolower($keyB)) == 0;
    }

    /**
     * @throws Exception
     *
     * @return BonimaReportRequest
     */
    private function fillBonimaRequestObject()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==fillBonimaRequestObject==', []);
        /**
         * @var PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Request\BonimaReportRequest $requestObj
         */
        $requestObj = $this->get('creditreform.bonima_report_request');
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Body\BonimaReportBody $bodyObj
         */
        $bodyObj = $this->get('creditreform.bonima_report_body');
        /**
         * @var ConfigHeaderRequest $config
         */
        $config = $this->get('creditreform.config_header_request');
        $requestObj->setConfigHeaderRequest($config);
        $accountArray = null;
        $configReportPrivatePerson = $this->configs['person'];
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
         */
        $account = $this->swagModelManager->find(CrefoAccount::class, $configReportPrivatePerson['user_account_id']);
        if ($account === null) {
            throw new \Exception('The account was removed and is not available anymore!');
        }
        $userData = $this->getUser();
        if (null === $userData) {
            throw new \Exception('The data from order variables is missing. The solvency check cannot be completed successful without it.');
        }
        $billingAddress = $userData['billingaddress'];
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Parts\AddressOne $addressOne
         */
        $addressOne = $bodyObj->getAddressOne();
        $addressOne->setCity($billingAddress['city']);
        $bodyObj->setPostcode($billingAddress['zipcode']);
        $countryID = $billingAddress['countryID'];
        /**
         * @var \Shopware\Models\Country\Country $countryObject
         */
        $countryObject = $this->swagModelManager->find('Shopware\Models\Country\Country', intval($countryID));
        if (null === $countryObject) {
            throw new \Exception('Shopware country was not found!');
        }
        $country = $countryObject->getIso();
        $addressOne->setCountry($country);
        $addressArray = $bodyObj->validateAddress($billingAddress['street']);
        $addressOne->setStreet($addressArray['street']);
        $addressOne->setHouseNumberWithAffix($addressArray['addressWithoutStreet']);
        $bodyObj->setLegitimateInterest($configReportPrivatePerson['legitimateKey']);
        $bodyObj->setProductTypeFromId($this->currentConfig['productKeyWS']);
        $bodyObj->setDateOfBirth($this->session->offsetGet('sCrefoCustomerBirthDate'));
        $customerNumber = $userData['additional']['user']['customernumber'];
        if ($customerNumber !== null && $customerNumber !== '') {
            $bodyObj->setCustomerReference($customerNumber);
        }else {
            $bodyObj->setCustomerReference(self::CUSTOMER_NUMBER_TEXT);
        }
        $bodyObj->setFirstName($billingAddress['firstname']);
        $bodyObj->setSurname($billingAddress['lastname']);
        $bodyObj->setSalutation($billingAddress['salutation']);
        $bodyObj->setAddressOne($addressOne);
        $accountArray = [
            'userAccount' => $account->getUserAccount(),
            'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(),
                $config->getEncryptionKey()),
            'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                $config->getEncryptionKey()),
        ];
        $requestObj->setHeaderAccount($accountArray);
        $requestObj->setBody($bodyObj);

        return $requestObj;
    }

    private function handleCustomExceptions()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==handleCustomExceptions==', []);
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        $dateProcessEnd = new \DateTime('now');
        $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs([
            'log_status' => LogStatusType::NOT_SAVED,
            'ts_response' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
            'tsProcessEnd' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
            'requestXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
            'requestXMLDescription' => CrefoCrossCuttingComponent::ERROR,
            'responseXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
            'responseXMLDescription' => CrefoCrossCuttingComponent::ERROR,
        ]);
        if ($this->reportType === PaymentType::COMPANY) {
            /**
             * not important which report result is used.
             *
             * @var \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults $crefoResult
             */
            $crefoResult = $this->get('creditreform.identification_report_results');
            $crefoResult->setRiskJudgement(self::FAULT_TEXT);
        } else {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResult
             */
            $crefoResult = $this->get('creditreform.bonima_report_results');
            $crefoResult->setAddressValidationResult(self::FAULT_TEXT);
            $crefoResult->setIdentificationResult(self::FAULT_TEXT);
            $crefoResult->setScoreValue(0);
            $crefoResult->setScoreType(self::FAULT_TEXT);
        }
        $crefoResult->setTextReportName(self::FAULT_TEXT);
        $crefoResult->setSuccessfulSolvency(0);
        $this->hasBadSolvencyResult($crefoResult);
        $this->session->offsetSet('sCrefoBadResponse', true);
    }
}
