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
namespace CrefoShopwarePlugIn\Subscriber;

use \CrefoShopwarePlugIn\Components\Core\Enums\PaymentType;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\FrontendObject;
use \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig;
use \Enlight\Event\SubscriberInterface;
use \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs;
use \Shopware\Models\Shop\Currency;

/**
 * Class FrontendCheckout
 * @package CrefoShopwarePlugIn\Subscriber
 */
class FrontendCheckout extends FrontendObject implements SubscriberInterface
{
    /**
     * @var float
     */
    private $amount = null;

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Controllers_Frontend_Checkout::saveShippingPaymentAction::before' => 'onSavePayment',
            'Shopware_Controllers_Frontend_Checkout::confirmAction::after' => 'onConfirmAction',
            'Shopware_Controllers_Frontend_Checkout::finishAction::after' => 'onFinishAction',
            'Shopware_Controllers_Frontend_CrefoInvoice::indexAction::before' => 'onBeforeIndexAction',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatch'
        ];
    }

    /**
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onSavePayment(\Enlight_Hook_HookArgs $args)
    {
        /** @var \Enlight_Controller_Action $subject */
        $subject = $args->getSubject();
        $request = $subject->Request();
        if ($this->hasCrefoPayment()) {
            $this->session->offsetUnset('sNoCrefoBirthDate');
            $this->session->offsetUnset('sNoCrefoConfirmation');
        }
        $payment = $request->getPost('payment');
        if ($this->isCrefoInvoicePayment($payment)) {
            $this->saveCrefoPaymentData($request);
            $this->getPaymentDataInstance()->setPaymentType($this->isCompany() ? PaymentType::COMPANY : PaymentType::PERSON);
            $this->flushPaymentData();
        }
    }

    /**
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onConfirmAction(\Enlight_Hook_HookArgs $args)
    {
        /** @var \Enlight_Controller_Action $subject */
        $subject = $args->getSubject();
        $this->view = $subject->View();
        if (!is_null($this->view->sPayment) && $this->isCrefoInvoicePayment($this->view->sPayment['id'])) {
            if ($this->hasFailedSolvencyCheckInSession($this->session->get('sCrefoBadResponse')) || !$this->validateCrefoInvoiceConditions()) {
                $this->session->offsetSet('sCrefoInvalidPaymentData', true);
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);
                return;
            }
            if ($this->hasConsentDeclaration() && is_null($this->getPaymentDataInstance()->getConsent())) {
                $this->session->offsetSet('sNoCrefoConfirmation', true);
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);
                return;
            }
            $this->getPaymentDataInstance()->setPaymentType($this->isCompany() ? PaymentType::COMPANY : PaymentType::PERSON);
            $this->flushPaymentData();
            if ($this->getPaymentDataInstance()->getPaymentType() === PaymentType::PERSON && is_null($this->getPaymentDataInstance()->getBirthdate())) {
                $this->session->offsetSet('sNoCrefoBirthDate', true);
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);
                return;
            }
        } else {
            $this->session->offsetUnset('sCrefoInvalidPaymentData');
        }
    }

    /**
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onFinishAction(\Enlight_Hook_HookArgs $args)
    {
        $this->saveOnFinishingWithOtherPayment();
    }

    /**
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onBeforeIndexAction(\Enlight_Hook_HookArgs $args)
    {
        $this->calculateAmount();
        $this->validateConditionsBeforePurchase();
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     */
    public function onPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $action */
        $action = $args->getSubject();
        $request = $action->Request();
        $response = $action->Response();
        $this->view = $action->View();

        if (!$request->isDispatched()
            || $response->isException()
            || $request->getModuleName() != self::FRONTEND_MODULE
            || !$this->view->hasTemplate()
        ) {
            return;
        }
        $this->registerFrontendTemplates();
        //error message for birthdate field
        if (!is_null($this->session->get('sNoCrefoBirthDate'))) {
            $this->view->sNoCrefoBirthDate = $this->session->get('sNoCrefoBirthDate');
        }
        //error message for consent field
        if (!is_null($this->session->get('sNoCrefoConfirmation'))) {
            $this->view->sNoCrefoConfirmation = $this->session->get('sNoCrefoConfirmation');
        }
        if (strcmp(mb_strtolower($request->getActionName()), 'shippingpayment') === 0
            && strcmp(mb_strtolower($request->getControllerName()), 'checkout') === 0
        ) {
            $this->calculateAmount();
            if (!$this->hasFailedSolvencyCheckInSession($this->session->get('sCrefoBadResponse')) && $this->validateCrefoInvoiceConditions()
            ) {
                $isCompany = $this->isCompany();
                $this->view->sIsCompany = $isCompany;
                $this->getPaymentDataInstance()->setPaymentType($isCompany ? PaymentType::COMPANY : PaymentType::PERSON);
                $hasConsent = $this->hasConsentDeclaration();
                $this->view->sHasCrefoConsentDeclaration = $hasConsent;
                //set user consent
                if ($hasConsent) {
                    $this->view->sCrefoConfirmation = boolval($this->getPaymentDataInstance()->getConsent());
                }
                //set birthdate from previous save
                if (!$isCompany && !is_null($this->getPaymentDataInstance()->getBirthdate()) && $this->getPaymentDataInstance()->getBirthdate() instanceof \DateTime) {
                    $this->view->sCrefoBirthDate = $this->getPaymentDataInstance()->getBirthdate()->format('d.m.Y');
                }
                $this->view->extendsTemplate('frontend/crefo_invoice/change_payment.tpl');
                $this->flushPaymentData();
                $this->session->offsetUnset('sRemoveCrefoInvoice');
            } else {
                if ($this->hasFailedSolvencyCheckInSession($request->getParam('sCrefoBadResponse'))) {
                    $this->view->sCrefoShowBadResponse = true;
                    $this->view->sNoCrefoConfirmation = false;
                    $this->view->sNoCrefoBirthDate = false;
                }
                if ($this->session->get('sCrefoInvalidPaymentData')) {
                    $this->view->sCrefoShowBadResponse = true;
                }
                $this->removePayment();
            }
            $this->view->extendsTemplate('frontend/crefo_invoice/shipping_payment.tpl');
        }
    }

    /**
     * @return bool
     */
    private function validateConditionsBeforePurchase()
    {
        $canProceed = true;
        if ($this->hasFailedSolvencyCheckInSession($this->session->sCrefoBadResponse) || !$this->validateCrefoInvoiceConditions()) {
            $this->session->offsetSet('sRemoveCrefoInvoice', true);
            $canProceed = false;
        }
        return $canProceed;
    }

    /**
     * save crefo invoice related information about failed payment
     * @return boolean
     */
    private function saveOnFinishingWithOtherPayment()
    {
        $orderVariables = (object)$this->session->get('sOrderVariables');
        $orderVariables = !is_null($orderVariables) ? $orderVariables->getArrayCopy() : [];
        if (!is_null($this->session->get('sCrefoReportResultId')) && !is_null($orderVariables)) {
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReports\Repository $repoCrefoResults
             */
            $repoCrefoResults = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults');
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoLogs\Repository $crefoLogsRepository
             */
            $crefoLogsRepository = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs');
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults $crefoReportResults
             */
            $crefoReportResults = $repoCrefoResults->find(intval($this->session->sCrefoReportResultId));

            $crefoReportResults->setOrderNumber($orderVariables['sOrderNumber']);
            $builderLogs = $crefoLogsRepository->getCrefoLogsQueryBuilder();
            $builderLogs->andWhere('clog.reportResultId = ?1');
            $builderLogs->setParameter(1, $crefoReportResults->getId());
            $logsResult = $builderLogs->getQuery()->getArrayResult();
            /**
             * @var CrefoLogs $crefoLogs
             */
            $crefoLogs = $crefoLogsRepository->find($logsResult[0]['id']);
            $crefoLogs->setStatusLogs(LogStatusType::SAVE_AND_SHOW);

            $this->swagModelManager->persist($crefoLogs);
            $this->swagModelManager->persist($crefoReportResults);
            $this->swagModelManager->flush();
        }
        return $this->resetCrefoVariables();
    }

    /**
     * @inheritdoc
     */
    public function hasCorrectCompanyReportConfiguration()
    {
        $conditionCompliesToSettings = false;
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyRepository $repoProductConfig
         */
        $repoProductConfig = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig');
        $classNameConfiguration = \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig::class;
        $configIdReportCompanies = $this->creditreform->getConfigurationId($classNameConfiguration);
        $country = $this->getCountryFromUserData();
        $products = $repoProductConfig->findBy([
            'configsId' => $configIdReportCompanies,
            'land' => mb_strtolower($country)
        ], ['sequence' => 'ASC']);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig $configReport
         */
        $configReport = $this->swagModelManager->find($classNameConfiguration, $configIdReportCompanies);
        if (!empty($products) && !is_null($configReport->getUserAccountId())) {
            /**
             * @var ProductsConfig $firstProductConfig
             */
            $firstProductConfig = $products[0];
            $seqMinValue = $firstProductConfig->getSequence();
            //in configuration are 4 places for setting values in a sequence, therefore 1st + 3
            $seqMaxValue = $seqMinValue + 3;
            $lastProductIndexInArray = count($products) - 1;
            /**
             * @var ProductsConfig $lastProductConfig
             */
            $lastProductConfig = $products[$lastProductIndexInArray];
            if ($lastProductIndexInArray !== 0 && ($lastProductConfig->getSequence() === $seqMaxValue)) {
                $conditionCompliesToSettings = ($this->getAmount() >= $firstProductConfig->getThreshold()) && ($this->getAmount() <= $lastProductConfig->getThreshold());
            } else {
                $conditionCompliesToSettings = ($this->getAmount() >= $firstProductConfig->getThreshold());
            }
        }
        return $conditionCompliesToSettings;
    }

    /**
     * @inheritdoc
     */
    public function hasCorrectPersonReportConfiguration()
    {
        $conditionCompliesToSettings = false;
        $classNameConfiguration = \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig::class;
        $configIdReportPrivatePerson = $this->creditreform->getConfigurationId($classNameConfiguration);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig $configPrivatePerson
         */
        $configPrivatePerson = $this->swagModelManager->find($classNameConfiguration, $configIdReportPrivatePerson);
        if (!is_null($configPrivatePerson->getUserAccountId())) {
            $conditionCompliesToSettings = floatval($this->getAmount()) >= $configPrivatePerson->getThresholdMin();
            !is_null($configPrivatePerson->getThresholdMax()) ?
                $conditionCompliesToSettings = $conditionCompliesToSettings && floatval($this->getAmount()) <= floatval($configPrivatePerson->getThresholdMax())
                : null;
        }
        return $conditionCompliesToSettings;
    }

    /**
     * Checks if the customer has already done a solvency check in this session and if the check failed
     * @param bool $crefoResponse
     * @return bool
     */
    private function hasFailedSolvencyCheckInSession($crefoResponse)
    {
        return is_bool($crefoResponse) && $crefoResponse;
    }

    /**
     * @return bool
     */
    private function resetCrefoVariables()
    {
        $this->session->offsetUnset('sCrefoBadResponse');
        $this->session->offsetUnset('sCrefoReportResultId');
        $this->session->offsetUnset('sRemoveCrefoInvoice');
        $this->getPaymentDataInstance()->setPaymentType($this->isCompany() ? PaymentType::COMPANY : PaymentType::PERSON);
        $this->flushPaymentData();
        return true;
    }

    private function calculateAmount()
    {
        if (!is_null($this->session->get('sOrderVariables'))) {
            $orderVariables = $this->session->get('sOrderVariables')->getArrayCopy();
            $amount = $orderVariables['sAmount'];
            if ($orderVariables['sBasket']['sCurrencyName'] != 'EUR') {
                $currencyId = $orderVariables['sBasket']['sCurrencyId'];
                /**
                 * @var Currency $currencyObj
                 */
                $currencyObj = $this->swagModelManager->find(Currency::class, $currencyId);
                $factor = floatval($currencyObj->getFactor());
                $factor === floatval(0) ? $factor = 1 : null;
                $amount = round(floatval($amount) / floatval($currencyObj->getFactor()), 2);
            }
            $this->amount = floatval($amount);
        } elseif (is_null($this->amount) && !is_null($this->view->sBasket) && !is_null($this->view->sAmount)) {
            $basket = $this->view->sBasket;
            $amount = $this->view->sAmount;
            if ($basket['sCurrencyName'] != 'EUR') {
                $currencyId = $basket['sCurrencyId'];
                /**
                 * @var Currency $currencyObj
                 */
                $currencyObj = $this->swagModelManager->find(Currency::class, $currencyId);
                $factor = floatval($currencyObj->getFactor());
                $factor === floatval(0) ? $factor = 1 : null;
                $amount = round(floatval($amount) / floatval($currencyObj->getFactor()), 2);
            }
            $this->amount = floatval($amount);
        }
    }

    /**
     * @return float
     */
    private function getAmount()
    {
        if (is_null($this->amount)) {
            $this->calculateAmount();
        }
        return $this->amount;
    }
}
