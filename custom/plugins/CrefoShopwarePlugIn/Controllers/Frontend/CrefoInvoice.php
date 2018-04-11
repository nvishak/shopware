<?php
/**
 * Copyright (c) 2016 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */

use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use \CrefoShopwarePlugIn\Components\Core\Enums\PaymentType;
use \Shopware\Components\CSRFWhitelistAware;

/**
 * @see https://developers.shopware.com/developers-guide/shopware-5-plugin-update-guide/
 * Class Shopware_Controllers_Frontend_CrefoInvoice
 */
class Shopware_Controllers_Frontend_CrefoInvoice extends Shopware_Controllers_Frontend_Payment implements CSRFWhitelistAware
{
    const POSITIVE_RESPONSE = 'RIJM-10';
    const NO_VALUE_TEXT = 'novalue';

    /**
     * @var String
     */
    private $transactionId;

    /**
     * @var int
     */
    private $logId;

    /**
     * @var \CrefoShopwarePlugIn\CrefoShopwarePlugIn $plugin
     */
    private $plugin;

    /**
     * @var \Enlight_Components_Session_Namespace $session
     */
    private $session;

    /**
     * @var null|CrefoLogger $crefoLogger
     */
    private $crefoLogger = null;

    /**
     * @var \Shopware\Components\Model\ModelManager
     */
    private $swagModelManager;

    /**
     * @var \CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData
     */
    private $crefoPaymentData;

    /**
     * @return null|CrefoLogger
     */
    private function getCrefoLogger()
    {
        if ($this->crefoLogger === null) {
            $this->crefoLogger = $this->get('creditreform.logger');
        }
        return $this->crefoLogger;
    }


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->plugin = CrefoCrossCuttingComponent::getCreditreformPlugin();
        $this->session = $this->get('Session');
        $this->swagModelManager = $this->get('Models');
        $this->crefoPaymentData = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData')->findOneBy(['userId' => $this->session->sUserId]);
    }

    public function indexAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==IndexCrefoInvoice==", ["Crefo Invoice start Solvency."]);
        if ($this->getPaymentShortName() == 'crefo_invoice' && $this->verifyCrefoInvoice($uniquePaymentID)) {
            $this->forward('finish', 'checkout', null, ['sUniqueID' => $uniquePaymentID]);
        } else {
            $this->forward('shippingPayment', 'checkout', null,
                ['sTarget' => 'checkout', 'sTargetAction' => 'confirm', 'sCrefoBadResponse' => true]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        return CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get($name);
    }

    /**
     * {@inheritdoc}
     */
    public function preDispatch()
    {
        if (!$this->isUserLoggedIn()) {
            $this->redirect(['controller' => 'checkout', 'action' => 'confirm']);
        }
        if (in_array($this->Request()->getActionName(), ['index'])) {
            /**
             * In case the user somehow reached this page while the payment module was removed or unavailable
             * it sends the user back to shippingPayment
             */
            if (!$this->isValidCrefoInvoicePayment()) {
                $this->getCrefoLogger()->log(CrefoLogger::INFO, "==isValidCrefoInvoicePayment==",
                    ["Invalid Crefo Payment Method."]);
                $this->redirect(['controller' => 'checkout', 'action' => 'shippingPayment', 'forceSecure' => true]);
            }
            /**
             * in case the payment data is not available
             */
            if (is_null($this->crefoPaymentData)) {
                $this->getCrefoLogger()->log(CrefoLogger::INFO,
                    "==No Crefo Payment Data found in DB - process was manipulated==",
                    ["sCrefoConfirmation == null"]);
                $this->redirect(['controller' => 'checkout', 'action' => 'shippingPayment', 'forceSecure' => true]);
            }
            /**
             * customer didn't accept the consent
             */
            if ($this->hasConsentDeclaration() && is_null($this->crefoPaymentData->getConsent())) {
                $this->getCrefoLogger()->log(CrefoLogger::INFO, "==No Crefo Consent Confirmed==",
                    ["sCrefoConfirmation == null"]);
                $this->session->offsetSet('sNoCrefoConfirmation', true);
                $this->redirect(['controller' => 'checkout', 'action' => 'shippingPayment', 'forceSecure' => true]);
            }
            /**
             * check if the birth date is set
             */
            if ($this->crefoPaymentData->getPaymentType() == PaymentType::PERSON && is_null($this->crefoPaymentData->getBirthdate())
            ) {
                $this->getCrefoLogger()->log(CrefoLogger::INFO, "==No Crefo Birthdate Provided==",
                    ["sCrefoBirthDate == null"]);
                $this->session->offsetSet('sNoCrefoBirthDate', true);
                $this->redirect(['controller' => 'checkout', 'action' => 'shippingPayment', 'forceSecure' => true]);
            }
            /**
             * @var \Enlight_Controller_Plugins_ViewRenderer_Bootstrap $renderer
             */
            $renderer = $this->get('Front')->Plugins()->ViewRenderer();
            $renderer->setNoRender();
        }
    }

    /**
     * Returns if the current user is logged in
     *
     * @return bool
     */
    public function isUserLoggedIn()
    {
        return (isset($this->session->sUserId) && !empty($this->session->sUserId));
    }

    /**
     * The getaway controller
     * @param &$uniquePaymentID
     * @return boolean
     */
    public function verifyCrefoInvoice(&$uniquePaymentID = null)
    {
        $crefoResult = null;
        try {
            $this->getCrefoLogger()->log(CrefoLogger::INFO, "==Validate Crefo Invoice Payment==",
                ["Starts Solvency Check."]);

            if ($this->crefoPaymentData->getPaymentType() === PaymentType::COMPANY) {
                $crefoResult = $this->performSolvencyCheckForCompanies();
            } elseif ($this->crefoPaymentData->getPaymentType() === PaymentType::PERSON) {
                $crefoResult = $this->performSolvencyCheckForPrivatePerson();
            } else {
                throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoUnknownPaymentException("Unknown Payment.");
            }
            $this->getCrefoLogger()->log(CrefoLogger::INFO, "==saveOrder==", ["Save data related to the Order."]);
            $uniquePaymentID = $this->createPaymentUniqueId();
            $orderNumber = $this->saveOrder($this->transactionId, $uniquePaymentID);
            $crefoResult->setOrderNumber($orderNumber);
            $this->swagModelManager->persist($crefoResult);
            $this->swagModelManager->flush();
            $this->saveResultIdInLogs($crefoResult, $this->logId, LogStatusType::SAVE_AND_SHOW);
            $this->resetCrefoVariables();
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::NOTICE,
                "==Couldn't continue to finish the checkout-CrefoBadSolvencyException-CrefoBadSolvencyException.==",
                (array)$e);
            $this->session->offsetSet('sCrefoBadResponse', true);
            return false;
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoUnknownPaymentException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::NOTICE,
                "==Couldn't continue to finish the checkout-CrefoUnknownPaymentException-CrefoUnknownPaymentException.==",
                (array)$e);
            $this->handleCustomExceptions();
            return false;
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoTechnicalException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::NOTICE,
                "==Couldn't continue to finish the checkout-CrefoTechnicalException-CrefoTechnicalException.==",
                (array)$e);
            $this->handleCustomExceptions();
            return false;
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==Couldn't continue to finish the checkout-Exception.==",
                (array)$e);
            $this->handleCustomExceptions();
            return false;
        }
        return true;
    }

    private function resetCrefoVariables()
    {
        unset($this->session->sCrefoBadResponse);
        unset($this->session->sCrefoReportResultId);
    }

    /**
     * checks to have a legit Company
     * @return boolean
     */
    private function isValidCrefoInvoicePayment()
    {
        if (!is_null($this->session->get('sRemoveCrefoInvoice'))) {
            $this->getCrefoLogger()->log(CrefoLogger::INFO, "==isValidCrefoInvoicePayment==",
                ["Invalid Crefo Payment Method."]);
            $this->session->offsetSet('sCrefoBadResponse', true);
            return false;
        }
        return true;
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults $crefoResult
     * @return boolean
     */
    private function hasBadSolvencyResult($crefoResult)
    {
        if (!$crefoResult->getSuccessfulSolvency()) {
            $this->getCrefoLogger()->log(CrefoLogger::INFO, "==hasBadSolvencyResult==", ["Bad Solvency Result."]);
            if (!is_null($crefoResult)) {
                $this->swagModelManager->persist($crefoResult);
                $this->swagModelManager->flush($crefoResult);
                $this->saveResultIdInLogs($crefoResult, $this->logId);
                $this->session->sCrefoReportResultId = $crefoResult->getId();
            }
            return true;
        }
        return false;
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults $crefoResult
     * @param integer $logID
     * @param $logStatus
     */
    private function saveResultIdInLogs($crefoResult, $logID, $logStatus = LogStatusType::NOT_SAVED)
    {
        if (is_null($logID)) {
            return;
        }
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs $crefoLog
         */
        $crefoLog = $this->swagModelManager->find(\CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs::class, $logID);
        $crefoLog->setReportResultId($crefoResult);
        $crefoLog->setStatusLogs($logStatus);
        $this->swagModelManager->persist($crefoLog);
        $this->swagModelManager->flush();
    }

    /**
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults
     * @throws \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoTechnicalException|\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException
     */
    private function performSolvencyCheckForCompanies()
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==performSolvencyCheckForCompanies==",
            ["Starts the solvency check."]);
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
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performIdentificationReport>>SoapFault " . date("Y-m-d H:i:s") . "==", (array)$fault);
            $crefoResult = $this->fillIdentificationReportFromResponse($identificationReportRequest,
                $identificationReportRequest->getLastSoapCallResponse(), $crefoResult);
            $crefoResult->setRiskJudgement('fault');
            $identificationReportRequest->getCrefoParser()->setRawResponse($fault);
            $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs($identificationReportRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
            $successfulCall = false;
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performIdentificationReport>>CrefoCommunicationException " . date("Y-m-d H:i:s") . "==", (array)$e);
            $crefoResult = $this->fillIdentificationReportFromResponse($identificationReportRequest, null, $crefoResult);
            $crefoResult->setRiskJudgement('fault');
            $identificationReportRequest->getCrefoParser()->setRawResponse($e);
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            $this->logId = CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($identificationReportRequest, $xmlText, CrefoCrossCuttingComponent::ERROR);
            $successfulCall = false;
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performIdentificationReport>>Exception " . date("Y-m-d H:i:s") . "==", (array)$e);
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
            throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException("Bad Solvency.");
        }
        return $crefoResult;
    }

    /**
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResult
     * @throws \Exception
     */
    private function performSolvencyCheckForPrivatePerson()
    {
        $this->getCrefoLogger()->log(CrefoLogger::INFO, "==performSolvencyCheckForPrivatePerson==",
            ["Starts the solvency check."]);
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
            $crefoResult = $this->fillBonimaReportFromResponse($bonimaReportRequest, $bonimaReportResponse,
                $crefoResult);
            $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs($bonimaReportRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\SoapFault $fault) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performBonimaReport>>SoapFault " . date("Y-m-d H:i:s") . "==", (array)$fault);
            $crefoResult = $this->fillBonimaReportFromResponse($bonimaReportRequest,
                $bonimaReportRequest->getLastSoapCallResponse(), $crefoResult);
            $crefoResult->setTextReportName($bonimaReportRequest->getCrefoParser()->extractTextTitleFromStringXml($bonimaReportRequest->getLastSoapCallResponse()));
            $bonimaReportRequest->getCrefoParser()->setRawResponse(strval($fault));
            $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs($bonimaReportRequest->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
            $successfulCall = false;
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performBonimaReport>>CrefoCommunicationException " . date("Y-m-d H:i:s") . "==", (array)$e);
            $crefoResult->setTextReportName('fault');
            $crefoResult->setSuccessfulSolvency(false);
            $crefoResult->setAddressValidationResult('fault');
            $crefoResult->setIdentificationResult('fault');
            $crefoResult->setScoreValue(0);
            $crefoResult->setScoreType('fault');
            $bonimaReportRequest->getCrefoParser()->setRawResponse(strval($e));
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            $this->logId = CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($bonimaReportRequest, $xmlText, CrefoCrossCuttingComponent::ERROR);
            $successfulCall = false;
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performBonimaReport>>Exception " . date("Y-m-d H:i:s") . "==", (array)$e);
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
            throw new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoBadSolvencyException("Bad Solvency.");
        }
        return $crefoResult;
    }

    /**
     * @param $transmissionTime
     * @return mixed
     */
    private function getTransactionIdFromTransmissionTime($transmissionTime)
    {
        return preg_replace(['/:/', '/-/'], ['', ''], $transmissionTime);
    }

    /**
     * @return bool
     */
    private function countRequestNotification()
    {
        $pluginSettingsId = $this->plugin->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        $repoPluginSettings = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $pluginSettings
         */
        $pluginSettings = $repoPluginSettings->find($pluginSettingsId);
        $errorNotification = boolval($pluginSettings->isErrorNotificationActive());
        if ($errorNotification) {
            $errorRequestsId = $this->plugin->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests::class);
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\Repository $repoErrorRequests
             */
            $repoErrorRequests = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests');
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests $errorRequestObj
             */
            $errorRequestObj = $repoErrorRequests->find($errorRequestsId);
            $errorRequestObj->addRequest();
            $this->swagModelManager->persist($errorRequestObj);
            $this->swagModelManager->flush($errorRequestObj);
        }
        return $errorNotification;
    }

    /**
     * @param boolean $resultHasNoError
     */
    private function processErrorNotification($resultHasNoError)
    {
        $pluginSettingsId = $this->plugin->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        $repoPluginSettings = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $pluginSettings
         */
        $pluginSettings = $repoPluginSettings->find($pluginSettingsId);
        $errorRequestsId = $this->plugin->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\Repository $repoErrorRequests
         */
        $repoErrorRequests = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests $errorRequestObj
         */
        $errorRequestObj = $repoErrorRequests->find($errorRequestsId);
        if (!$resultHasNoError) {
            $errorRequestObj->addFailedRequest();
            $this->swagModelManager->persist($errorRequestObj);
            $this->swagModelManager->flush($errorRequestObj);
        }
        if ($pluginSettings->verifyErrorsOnRequest($errorRequestObj->getNumberOfRequests(),
            $errorRequestObj->getFailurePercent())
        ) {
            $pluginSettings->sendEmail($errorRequestObj->getNumberOfRequests(),
                $errorRequestObj->getNumberOfFailedRequests(), $errorRequestObj->getFailurePercent());
            $repoErrorRequests->resetErrorRequests();
        }
        if ($pluginSettings->hasReachedNumberOfRequestAllowed($errorRequestObj->getNumberOfRequests())) {
            $repoErrorRequests->resetErrorRequests();
        }
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Request\IdentificationReportRequest
     * @throws Exception
     */
    private function fillReportCompaniesRequestObject()
    {
        $accountArray = null;
        $configReportCompany = null;
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\Repository $accountRepository
         */
        $accountRepository = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyRepository $repoReportCompanyConfig
         */
        $repoReportCompanyConfig = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig');
        $arrayConfigReportCompany = $repoReportCompanyConfig->getReportCompanyConfigQueryBuilder()->getQuery()->getArrayResult();

        /**
         * @var  \CrefoShopwarePlugIn\Components\API\Body\IdentificationReportBody $bodyObj
         */
        $bodyObj = $this->get('creditreform.identification_report_body');

        /**
         * @var  \CrefoShopwarePlugIn\Components\API\Request\IdentificationReportRequest $requestObj
         */
        $requestObj = $this->get('creditreform.identification_report_request');
        /**
         * @var \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest $config
         */
        $config = $this->get('creditreform.config_header_request');
        $requestObj->setConfigHeaderRequest($config);

        try {
            $configReportCompany = $arrayConfigReportCompany[0];

            $orderVariables = $this->session->get('sOrderVariables');
            $orderVariables = !is_null($orderVariables) ? $orderVariables->getArrayCopy() : [];
            if (empty($orderVariables)) {
                throw new \Exception('order variables are missing');
            }
            $billingAddress = $orderVariables['sUserData']['billingaddress'];

            $bodyObj->setCity($billingAddress['city']);
            $bodyObj->setCompanyName($billingAddress['company']);
            $bodyObj->setPostcode($billingAddress['zipcode']);
            $countryID = $billingAddress['countryID'];
            /**
             * @var \Shopware\Models\Country\Country $countryObject
             */
            $countryObject = $this->swagModelManager->find('Shopware\Models\Country\Country', intval($countryID));
            if (is_null($countryObject)) {
                throw new \Exception('country not found');
            }
            $country = $countryObject->getIso();
            $bodyObj->setCountry($country);
            if (strcmp(strtolower($country), 'lu') == 0) {
                $bodyObj->setStreet($billingAddress['street']);
            } else {
                $addressArray = $bodyObj->validateAddress($billingAddress['street']);
                $bodyObj->setStreet($addressArray['street']);
                $bodyObj->setHouseNumber($addressArray['number']);
                $bodyObj->setHouseNumberAffix($addressArray['affix']);
            }
            $bodyObj->setLegitimateInterest($configReportCompany['legitimateKey']);
            $bodyObj->setReportLanguage($configReportCompany['reportLanguageKey']);
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig $product
             */
            $product = $this->getCompanyProductSettings($country);
            $bodyObj->setProductType($product->getProductKeyWS());
            $bodyObj->setSolvencyIndexThreshold($product->getThresholdIndex());
            $bodyObj->setDiallingcode(null);
            $bodyObj->setPhonenumber($billingAddress['phone']);
            $bodyObj->setRegisterType(null);
            $bodyObj->setRegisterId(null);
            $bodyObj->setLegalForm(null);
            $bodyObj->setWebsite(null);
            /**
             * @var \Shopware\Models\Customer\Customer $customer
             */
            $customer = $this->swagModelManager->find(\Shopware\Models\Customer\Customer::class,
                $billingAddress['userID']);
            if (!is_null($customer)) {
                $bodyObj->setCustomerReference($customer->getNumber());
            }
            $bodyObj->setVatid($billingAddress['vatid']);
            /**
             * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
             */
            $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
             */
            $account = $accountRepository->find($configReportCompany['useraccountId']);
            if (!is_null($account)) {
                $accountArray = [
                    'userAccount' => $account->getUserAccount(),
                    'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(),
                        $config->getEncryptionKey()),
                    'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                        $config->getEncryptionKey())
                ];
            }
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==fillReportCompaniesRequestObject==", (array)$e);
        } finally {
            $requestObj->setHeaderAccount($accountArray);
            $requestObj->setBody($bodyObj);
            return $requestObj;
        }
    }

    /**
     * @param \CrefoShopwarePlugIn\Components\API\Request\IdentificationReportRequest $request
     * @param $response
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults $crefoResult
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults
     */
    private function fillIdentificationReportFromResponse($request, $response, $crefoResult)
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==fillIdentificationReportFromResponse==",
            ['Get values from Response.']);
        try {
            $crefoParser = $request->getCrefoParser();
            $crefoParser->setRawResponse($response);
            $crefoResult->setIndexThreshold($request->getBody()->getSolvencyIndexThreshold());
            $riskJudgementColour = $crefoParser->extractRiskJudgementColour();
            if (is_object($riskJudgementColour) && !is_null($riskJudgementColour->key)) {
                $crefoResult->setRiskJudgement($riskJudgementColour->key);
                strcmp(strtoupper($riskJudgementColour->key),
                    self::POSITIVE_RESPONSE) === 0 ? $crefoResult->setSuccessfulSolvency(true) : null;
            } else {
                $crefoResult->setRiskJudgement(self::NO_VALUE_TEXT);
            }
            $crefoResult->setTextReportPdf($crefoParser->extractTextReport());
            if (is_null($response) || is_string($response)) {
                $lastCallSoap = $response;
            } else {
                $lastCallSoap = $request->getLastSoapCallResponse();
            }
            $crefoResult->setTextReportNameFromValues($crefoParser->extractTextTitleFromStringXml($lastCallSoap));
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==fillReportFromResponse>>Exception==", (array)$e);
        }
        return $crefoResult;
    }

    /**
     * @param \CrefoShopwarePlugIn\Components\API\Request\BonimaReportRequest $request
     * @param $response
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResult
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults
     */
    private function fillBonimaReportFromResponse($request, $response, $crefoResult)
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==fillBonimaReportFromResponse==",
            ['Get values from Response.']);
        try {

            $crefoParser = $request->getCrefoParser();
            $crefoParser->setRawResponse($response);
            $crefoResult->setAddressValidationResult(strval($crefoParser->getAddressCheckResultKey()));
            $crefoResult->setIdentificationResult(strval($crefoParser->getIdentificationResultKey()));
            $crefoResult->setScoreType(strval($crefoParser->getScoreTypeResultKey()));
            $crefoResult->setScoreValue(intval($crefoParser->extractScoreValueResult()));
            if ($request->isInvalidBonimaResult($crefoParser)) {
                $crefoResult->setSuccessfulSolvency(false);
            } else {
                $crefoResult->setSuccessfulSolvency($crefoResult->areBonimaConditionsSatisfied());
            }
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==fillReportFromResponse>>Exception==", (array)$e);
            $crefoResult->setSuccessfulSolvency(false);
        }
        return $crefoResult;
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Request\BonimaReportRequest
     * @throws Exception
     */
    private function fillBonimaRequestObject()
    {
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        /**
         * @var  \CrefoShopwarePlugIn\Components\API\Request\BonimaReportRequest $requestObj
         */
        $requestObj = $this->get('creditreform.bonima_report_request');
        /**
         * @var  \CrefoShopwarePlugIn\Components\API\Body\BonimaReportBody $bodyObj
         */
        $bodyObj = $this->get('creditreform.bonima_report_body');
        /**
         * @var \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest $config
         */
        $config = $this->get('creditreform.config_header_request');
        $requestObj->setConfigHeaderRequest($config);
        $configId = $this->plugin->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\Repository $repoReportPrivatePersonConfig
         */
        $repoReportPrivatePersonConfig = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig');
        $accountArray = null;

        try {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig $configReportPrivatePerson
             */
            $configReportPrivatePerson = $repoReportPrivatePersonConfig->findCrefoObject(\CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig::class,
                $configId);

            $orderVariables = $this->session->get('sOrderVariables');
            $orderVariables = !is_null($orderVariables) ? $orderVariables->getArrayCopy() : [];
            if (empty($orderVariables)) {
                throw new \Exception('order variables are missing');
            }
            $billingAddress = $orderVariables['sUserData']['billingaddress'];
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
            if (!is_null($countryObject)) {
                $country = $countryObject->getIso();
                $addressOne->setCountry($country);
            }
            $addressArray = $bodyObj->validateAddress($billingAddress['street']);
            $addressOne->setStreet($addressArray['street']);
            $addressOne->setHouseNumberWithAffix($addressArray['addressWithoutStreet']);
            $bodyObj->setLegitimateInterest($configReportPrivatePerson->getLegitimateKey());
            $bodyObj->setProductTypeFromId($configReportPrivatePerson->getSelectedProductKey());
            $bodyObj->setDateOfBirth($this->crefoPaymentData->getBirthdate()->format('Y-m-d'));
            /**
             * @var \Shopware\Models\Customer\Customer $customer
             */
            $customer = $this->swagModelManager->find(\Shopware\Models\Customer\Customer::class,
                $billingAddress['userID']);
            if (!is_null($customer)) {
                $bodyObj->setCustomerReference($customer->getNumber());
            }
            $bodyObj->setFirstName($billingAddress['firstname']);
            $bodyObj->setSurname($billingAddress['lastname']);
            $bodyObj->setSalutation($billingAddress['salutation']);
            $bodyObj->setAddressOne($addressOne);
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
             */
            $account = $configReportPrivatePerson->getUserAccountId();
            if (!is_null($account)) {
                $accountArray = [
                    'userAccount' => $account->getUserAccount(),
                    'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(),
                        $config->getEncryptionKey()),
                    'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                        $config->getEncryptionKey())
                ];
            }
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==fillBonimaRequestObject==", (array)$e);
        } finally {
            $requestObj->setHeaderAccount($accountArray);
            $requestObj->setBody($bodyObj);
            return $requestObj;
        }
    }


    /**
     * @param $country
     * @return null|\CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig
     * @throws Exception
     */
    private function getCompanyProductSettings($country)
    {
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyRepository $repoProductConfig
         */
        $repoProductConfig = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig');
        $classNameConfiguration = \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig::class;
        $configIdReportCompanies = $this->plugin->getConfigurationId($classNameConfiguration);
        $products = $repoProductConfig->findBy([
            'configsId' => $configIdReportCompanies,
            'land' => mb_strtolower($country)
        ], ['sequence' => 'ASC']);
        $returnProduct = null;
        if (!empty($products)) {
            $amount = $this->calculateAmountFromOrder();
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig $product
             */
            foreach ($products as $product) {
                if ($amount >= $product->getThreshold() && !is_null($product->getProductKeyWS())) {
                    $returnProduct = $product;
                }
            }
        }
        if (is_null($returnProduct)) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==getProductSettings==",
                ['Crefo Product is not available.']);
            throw new \Exception('Crefo Product is not available.');
        }
        return $returnProduct;
    }

    /**
     * @return float
     */
    private function calculateAmountFromOrder()
    {
        $amount = floatval(0);
        $orderVariables = $this->session->get('sOrderVariables');
        if (!is_null($orderVariables)) {
            $orderVariables = $orderVariables->getArrayCopy();
            $tempAmount = $orderVariables['sAmount'];
            if ($orderVariables['sBasket']['sCurrencyName'] != 'EUR') {
                $currencyId = $orderVariables['sBasket']['sCurrencyId'];
                /**
                 * @var \Shopware\Models\Shop\Currency $currencyObj
                 */
                $currencyObj = $this->swagModelManager->find(\Shopware\Models\Shop\Currency::class, $currencyId);
                $factor = floatval($currencyObj->getFactor());
                $factor === floatval(0) ? $factor = 1 : null;
                $tempAmount = round(floatval($tempAmount) / floatval($currencyObj->getFactor()), 2);
            }
            $amount = floatval($tempAmount);
        }
        return $amount;
    }


    /**
     * @return bool
     */
    private function hasConsentDeclaration()
    {
        $pluginSettingsId = $this->plugin->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        $repoPluginSettings = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $pluginSettings
         */
        $pluginSettings = $repoPluginSettings->find($pluginSettingsId);
        return boolval($pluginSettings->getConsentDeclaration());
    }

    private function handleCustomExceptions()
    {
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        $dateProcessEnd = new \DateTime('now');
        $this->logId = CrefoCrossCuttingComponent::saveCrefoLogs([
            'log_status' => LogStatusType::NOT_SAVED,
            'ts_response' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
            'tsProcessEnd' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
            'requestXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
            'requestXMLDescription' => CrefoCrossCuttingComponent::ERROR,
            'responseXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
            'responseXMLDescription' => CrefoCrossCuttingComponent::ERROR
        ]);
        if ($this->crefoPaymentData->getPaymentType() === PaymentType::COMPANY) {
            /**
             * not important which report result is used
             * @var \CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults $crefoResult
             */
            $crefoResult = $this->get('creditreform.identification_report_results');
            $crefoResult->setRiskJudgement('fault');
        } else {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResult
             */
            $crefoResult = $this->get('creditreform.bonima_report_results');
        }
        $crefoResult->setTextReportName('novalue');
        $crefoResult->setSuccessfulSolvency(0);
        $this->hasBadSolvencyResult($crefoResult);
        $this->session->offsetSet('sCrefoBadResponse', true);
    }

    /**
     * @inheritdoc
     */
    public function getWhitelistedCSRFActions()
    {
        return [
            'shippingPayment',
            'confirm',
            'finish',
            'index'
        ];
    }
}
