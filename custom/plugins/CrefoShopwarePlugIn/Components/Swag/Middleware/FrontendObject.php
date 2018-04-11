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

namespace CrefoShopwarePlugIn\Components\Swag\Middleware;

use \CrefoShopwarePlugIn\Components\Core\Enums\PaymentType;
use \CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData;
use \Enlight\Event\SubscriberInterface;
use \Shopware\Components\DependencyInjection\Container;
use \Shopware\Models\Customer\Customer;
use \Enlight_Components_Session_Namespace as Session;
use \CrefoShopwarePlugIn\CrefoShopwarePlugIn;
use \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings;

/**
 * Class FrontendObject
 * @package Components\Swag\Middleware
 */
abstract class FrontendObject implements SubscriberInterface
{
    const FRONTEND_MODULE = 'frontend';
    const PAYMENT_NAME = 'crefo_invoice';
    const ALLOWED_CURRENCY = 'EUR';

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var CrefoShopwarePlugIn $creditreform
     */
    protected $creditreform;

    /**
     * @var \Shopware\Components\Model\ModelManager $swagModelManager
     */
    protected $swagModelManager;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var \CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData|null
     */
    private $crefoPaymentData;

    /**
     * @var \Enlight_View_Default
     */
    protected $view = null;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->creditreform = CrefoCrossCuttingComponent::getCreditreformPlugin();
        $this->swagModelManager = $this->container->get('Models');
        $this->session = $this->container->get('Session');
        $this->crefoPaymentData = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData')->findOneBy(['userId' => $this->session->sUserId]);
    }

    /**
     * @return boolean
     */
    abstract public function hasCorrectCompanyReportConfiguration();

    /**
     * @return boolean
     */
    abstract public function hasCorrectPersonReportConfiguration();

    /**
     * @return boolean
     */
    public function validateCrefoInvoiceConditions()
    {
        $hasValidConditions = true;
        if ($this instanceof \CrefoShopwarePlugIn\Subscriber\FrontendCheckout) {
            $hasValidConditions = $hasValidConditions && $this->hasAllowedCurrency();
        }
        $isCompany = $this->isCompany();
        $country = $this->getCountryFromUserData();
        if ($isCompany) {
            $hasValidConditions = $hasValidConditions && $this->isAllowedCountry($country, $isCompany);
            $hasValidConditions = $hasValidConditions && $this->hasCorrectCompanyReportConfiguration();
        } else {
            $hasValidConditions = $hasValidConditions && $this->isAllowedCountry($country);
            $hasValidConditions = $hasValidConditions && $this->hasCorrectPersonReportConfiguration();
        }
        return $hasValidConditions;
    }

    /**
     * Checks if the company field is set in the billing address
     * @return bool
     */
    protected function isCompany()
    {
        $userData = $this->getUserData();
        if (!$userData) {
            /**
             * @var Customer $customer
             */
            $customer = $this->swagModelManager->getRepository('Shopware\Models\Customer\Customer')->findOneBy(['id' => $this->session->sUserId]);
            $companyName = $customer->getDefaultBillingAddress()->getCompany();
            return !is_null($companyName) && $companyName != '';
        } else {
            $billingAddressArray = $userData['billingaddress'];
            return !is_null($billingAddressArray['company']) && strcmp($billingAddressArray['company'], '') !== 0;
        }
    }

    /**
     * @return string
     */
    protected function getCountryFromUserData()
    {
        $userData = $this->getUserData();
        if (!$userData) {
            /**
             * @var Customer $customer
             */
            $customer = $this->swagModelManager->getRepository('Shopware\Models\Customer\Customer')->findOneBy(['id' => $this->session->sUserId]);
            return $customer->getDefaultBillingAddress()->getCountry()->getIso();
        } else {
            $additional = $userData['additional'];
            return $additional['country']['countryiso'];
        }
    }

    /**
     * @return bool
     */
    protected function hasAllowedCurrency()
    {
        /**
         * @var \Shopware\Models\Shop\Shop $shop
         */
        $shop = $this->container->get('Shop');
        /**
         * @var \Shopware\Models\Shop\Currency $currency
         */
        $currency = $shop->getCurrency();
        return $currency->getCurrency() == self::ALLOWED_CURRENCY;
    }

    /**
     * @return array|false
     */
    protected function getUserData()
    {
        /**
         * @var \sAdmin $admin
         */
        $admin = $this->container->get('Modules')->Admin();
        return !is_null($admin) ? $admin->sGetUserData() : false;
    }

    /**
     * @return bool
     */
    protected function hasConsentDeclaration()
    {
        $pluginSettingsId = $this->creditreform->getConfigurationId(PluginSettings::class);
        $repoPluginSettings = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings');
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $pluginSettings
         */
        $pluginSettings = $repoPluginSettings->find($pluginSettingsId);
        return boolval($pluginSettings->getConsentDeclaration());
    }

    /**
     * Checks if the country is allowed by the crefo plugin
     * @param string $country
     * @param boolean $isCompany
     * @return bool
     */
    protected function isAllowedCountry($country, $isCompany = false)
    {
        if ($isCompany) {
            return in_array(strtoupper($country), $this->creditreform->getAllowedCountriesISOForCompanies());
        } else {
            return in_array(strtoupper($country), $this->creditreform->getAllowedCountriesISOForPrivatePerson());
        }
    }

    /**
     * Removes Crefo Invoice payment from the view
     */
    protected function removePayment()
    {
        /**
         * @var \sAdmin $admin
         */
        $admin = $this->container->get('Modules')->Admin();
        $paymentsWithoutCrefoInvoice = [];
        if (isset($this->view->sPayments)) {
            $paymentsWithCrefoInvoice = $this->view->sPayments;
        } elseif (isset($this->view->sPaymentMeans)) {
            $paymentsWithCrefoInvoice = $this->view->sPaymentMeans;
        } else {
            $paymentsWithCrefoInvoice = $admin->sGetPaymentMeans();
        }
        foreach ($paymentsWithCrefoInvoice as $key => $payment) {
            if (strcmp($payment['name'], self::PAYMENT_NAME) !== 0) {
                $paymentsWithoutCrefoInvoice[$key] = $payment;
            }
        }
        if (isset($this->view->sPayments)) {
            /**
             * needed in checkout page
             */
            $this->view->sPayments = $paymentsWithoutCrefoInvoice;
        }
        if (isset($this->view->sPaymentMeans)) {
            /**
             * needed in account page
             */
            $this->view->sPaymentMeans = $paymentsWithoutCrefoInvoice;
        }
    }

    /**
     * register the needed frontend templates
     */
    protected function registerFrontendTemplates()
    {
        $template = $this->container->get('Template');
        $template->addTemplateDir(
            $this->container->getParameter('creditreform.plugin_dir') . '/Resources/views/'
        );
    }

    /**
     * @param integer $paymentId
     * @return bool
     */
    protected function isCrefoInvoicePayment($paymentId)
    {
        /**
         * @var \Shopware\Models\Payment\Payment $payment
         */
        $payment = $this->swagModelManager->getRepository('Shopware\Models\Payment\Payment')->findOneBy(['id' => intval($paymentId)]);
        if (is_null($payment) || is_null($payment->getPlugin())) {
            return false;
        }
        return $payment->getPlugin()->getName() == $this->creditreform->getName();
    }

    /**
     * Returns if the current user is logged in
     *
     * @return bool
     */
    public function isUserLoggedIn()
    {
        return isset($this->session->sUserId) && !empty($this->session->sUserId);
    }

    /**
     * @param \Enlight_Controller_Request_Request $request
     */
    protected function saveCrefoPaymentData($request)
    {
        $this->initPaymentData();
        if (!is_null($request->getParam('sCrefoBirthDate', null))) {
            $this->getPaymentDataInstance()->setBirthdate(\DateTime::createFromFormat('d.m.Y',
                $request->getParam('sCrefoBirthDate')));
        }
        if (!is_null($request->getParam('sCrefoConfirmation', null))) {
            $this->getPaymentDataInstance()->setConsent(true);
        }
        $this->getPaymentDataInstance()->setPaymentType($this->isCompany() ? PaymentType::COMPANY : PaymentType::PERSON);
        $this->flushPaymentData();
    }

    protected function flushPaymentData()
    {
        $this->swagModelManager->persist($this->getPaymentDataInstance());
        $this->swagModelManager->flush();
    }

    private function initPaymentData()
    {
        if (is_null($this->crefoPaymentData)) {
            $this->crefoPaymentData = new PaymentData();
            /**
             * @var Customer $customer
             */
            $customer = $this->swagModelManager->getRepository('Shopware\Models\Customer\Customer')->findOneBy(['id' => $this->session->sUserId]);
            $this->crefoPaymentData->setUserId($customer);
        }
    }

    /**
     * @return PaymentData
     */
    protected function getPaymentDataInstance()
    {
        if (is_null($this->crefoPaymentData)) {
            $this->initPaymentData();
        }
        return $this->crefoPaymentData;
    }

    /**
     * @return bool
     */
    protected function hasCrefoPayment()
    {
        return !is_null($this->crefoPaymentData);
    }
}
