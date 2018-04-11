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

namespace CrefoShopwarePlugIn\Subscriber;

use CrefoShopwarePlugIn\Components\Core\Enums\CountryType;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Swag\Middleware\FrontendObject;
use CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\CountriesForCompanies;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig;
use Shopware\Models\Customer\Customer;

/**
 * Class FrontendAccount
 */
class FrontendAccount extends FrontendObject
{
    /**
     * @codeCoverageIgnore
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Controllers_Frontend_Account::savePaymentAction::after' => 'onSavePaymentAction',
            'Enlight_Controller_Action_PostDispatch_Frontend' => 'onPostDispatch',
        ];
    }

    /**
     * assign saved payment data to view
     *
     * @codeCoverageIgnore
     * @param \Enlight_Hook_HookArgs $arguments
     */
    public function onSavePaymentAction(\Enlight_Hook_HookArgs $arguments)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==onSavePaymentAction==',
            ['Hook to save payment in account.']);
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
     * @codeCoverageIgnore
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function onPostDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==onPostDispatch==', ['Hook to post dispatch in account.']);
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

    /**
     * {@inheritdoc}
     */
    public function hasCorrectCompanyReportConfiguration()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==hasCorrectCompanyReportConfiguration==', ['Check configuration in account.']);
        $conditionCompliesToSettings = false;
        $configIdReportCompanies = $this->creditreform->getConfigurationId(ReportCompanyConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig $reportCompanyConfigObj
         */
        $reportCompanyConfigObj = $this->swagModelManager->find(ReportCompanyConfig::class, $configIdReportCompanies);
        if ($reportCompanyConfigObj->getUserAccountId() !== null && $this->getCountryFromUserData() !== null) {
            $country = CountryType::getCountryIdFromISO2($this->getCountryFromUserData());
            $countriesConfigured = $reportCompanyConfigObj->getCountries();
            if ($countriesConfigured === null) {
                return $conditionCompliesToSettings;
            }
            /**
             * @var CountriesForCompanies $countryConfigured
             */
            foreach ($countriesConfigured as $countryConfigured) {
                if ($countryConfigured->getCountry() === $country && !empty($countryConfigured->getProducts())) {
                    $conditionCompliesToSettings = true;
                }
            }
        }

        return $conditionCompliesToSettings;
    }

    /**
     * {@inheritdoc}
     */
    public function hasCorrectPersonReportConfiguration()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==hasCorrectPersonReportConfiguration==',
            ['Check configuration in account.']);
        $conditionCompliesToSettings = false;
        $classNameConfiguration = \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig::class;
        $configIdReportPrivatePerson = $this->creditreform->getConfigurationId($classNameConfiguration);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig $configPrivatePerson
         */
        $configPrivatePerson = $this->swagModelManager->find($classNameConfiguration, $configIdReportPrivatePerson);
        if (null !== $configPrivatePerson->getUserAccountId()) {
            $conditionCompliesToSettings = true;
        }

        return $conditionCompliesToSettings;
    }

    /**
     * {@inheritdoc}
     */
    protected function isCompany()
    {
        if (!$this->isAccountOneTime()) {
            /**
             * @var Customer $customer
             */
            $customer = $this->swagModelManager->getRepository('Shopware\Models\Customer\Customer')->findOneBy(['id' => $this->session->offsetGet('sUserId')]);
            $companyName = $customer->getDefaultBillingAddress()->getCompany();

            return $companyName !== null && $companyName != '';
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    protected function getCountryFromUserData()
    {
        if (!$this->isAccountOneTime()) {
            /**
             * @var Customer $customer
             */
            $customer = $this->swagModelManager->getRepository('Shopware\Models\Customer\Customer')->findOneBy(['id' => $this->session->offsetGet('sUserId')]);

            return $customer->getDefaultBillingAddress()->getCountry()->getIso();
        }

        return null;
    }

    /**
     * @codeCoverageIgnore
     */
    private function handlePostDispatchAccountPayment()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==handlePostDispatchAccountPayment==',
            ['Handle if the view is shown or not, based on if the conditions are met or not.']);
        if ($this->validateCrefoInvoiceConditions()) {
            $isCompany = $this->isCompany();
            $this->view->assign('sIsCompany', $isCompany);
            $this->view->assign('sHasCrefoConsentDeclaration', $this->hasConfiguredConsentDeclaration());
            $this->view->extendsTemplate('frontend/crefo_invoice/payment_fieldset.tpl');
            //set consent
            if ($this->view->getAssign('sHasCrefoConsentDeclaration')) {
                $this->view->assign('sCrefoConfirmation', boolval($this->getPaymentDataInstance()->getConsent()));
            }
            if (!$isCompany) {
                $this->view->assign('sCrefoBirthDateFieldVisibility', false);
            }
            $this->flushPaymentData();
        } else {
            $this->removePayment();
        }
    }

    /**
     * @inheritdoc
     */
    protected function hasConfiguredConsentDeclaration()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==hasConsentDeclaration.==', ['Check the consent declaration.']);
        $pluginSettingsId = $this->creditreform->getConfigurationId(PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $pluginSettings
         */
        $pluginSettings = $this->swagModelManager->find(PluginSettings::class, $pluginSettingsId);

        return boolval($pluginSettings->getConsentDeclaration());
    }
}
