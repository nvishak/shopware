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
use \Doctrine\Common\Collections\ArrayCollection;
use \Shopware\Models\Customer\Customer;

/**
 * Class FrontendAccount
 * @package CrefoShopwarePlugIn\Subscriber
 */
class FrontendAccount extends FrontendObject
{
    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Controllers_Frontend_Account::savePaymentAction::after' => 'onSavePaymentAction',
            'Enlight_Controller_Action_PostDispatch_Frontend' => 'onPostDispatch'
        ];
    }

    /**
     * assign saved payment data to view
     *
     * @param \Enlight_Hook_HookArgs $arguments
     */
    public function onSavePaymentAction(\Enlight_Hook_HookArgs $arguments)
    {
        /** @var \Enlight_Controller_Action $subject */
        $subject = $arguments->getSubject();
        $request = $subject->Request();

        $register = $request->getPost('register');
        $sPayment = $register['payment'];
        if ($this->isUserLoggedIn() && $this->isCrefoInvoicePayment($sPayment)) {
            $this->saveCrefoPaymentData($request);
        }
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
        if ($this->isUserLoggedIn() && $request->getControllerName() == 'account' && $request->getActionName() == 'payment') {
            $this->registerFrontendTemplates();
            $this->handlePostDispatchAccountPayment();
        }
    }

    private function handlePostDispatchAccountPayment()
    {
        /**
         * @var Customer $customer
         */
        $customer = $this->swagModelManager->getRepository('Shopware\Models\Customer\Customer')->findOneBy(['id' => $this->session->sUserId]);
        if ($this->validateCrefoInvoiceConditions()) {
            $isCompany = $this->isCompany();
            //save birthday from shopware variable
            if (!$isCompany && !is_null($customer->getBirthday())) {
                $this->view->sCrefoBirthDate = $customer->getBirthday()->format('d.m.Y');
            }
            $this->view->sIsCompany = $isCompany;
            $this->view->sHasCrefoConsentDeclaration = $this->hasConsentDeclaration();
            $this->view->extendsTemplate('frontend/crefo_invoice/payment_fieldset.tpl');
            //set consent
            if ($this->view->sHasCrefoConsentDeclaration) {
                $this->view->sCrefoConfirmation = boolval($this->getPaymentDataInstance()->getConsent());
            }
            //set birthdate from previous save
            if (!$isCompany && !is_null($this->getPaymentDataInstance()->getBirthdate())) {
                $this->view->sCrefoBirthDate = $this->getPaymentDataInstance()->getBirthdate()->format('d.m.Y');
            }
            $this->getPaymentDataInstance()->setPaymentType($isCompany ? PaymentType::COMPANY : PaymentType::PERSON);
            $this->flushPaymentData();
        } else {
            $this->removePayment();
        }
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
        /**
         * @var ArrayCollection $products
         */
        $products = $repoProductConfig->findBy([
            'configsId' => $configIdReportCompanies,
            'land' => mb_strtolower($country)
        ], ['sequence' => 'ASC']);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig $configReportCompanies
         */
        $configReportCompanies = $this->swagModelManager->find($classNameConfiguration, $configIdReportCompanies);
        if (!is_null($configReportCompanies->getUserAccountId()) && !empty($products)) {
            $conditionCompliesToSettings = true;
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
            $conditionCompliesToSettings = true;
        }
        return $conditionCompliesToSettings;
    }
}
