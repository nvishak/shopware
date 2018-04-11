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

namespace CrefoShopwarePlugIn\Components\Swag\Middleware;

use CrefoShopwarePlugIn\Components\Core\Enums\CountryType;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\CrefoShopwarePlugIn;
use CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData;
use CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings;
use Enlight\Event\SubscriberInterface;
use Enlight_Components_Session_Namespace as Session;
use Shopware\Components\DependencyInjection\Container;
use Shopware\Models\Customer\Customer;

/**
 * Class FrontendObject
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
     * @var \Enlight_View_Default
     */
    protected $view = null;

    /**
     * @var \CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData|null
     */
    private $crefoPaymentData;

    /**
     * @codeCoverageIgnore
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==Create Fronted Object.==',
            ['Constructor of FrontendObject.']);
        $this->container = $container;
        $this->creditreform = CrefoCrossCuttingComponent::getCreditreformPlugin();
        $this->swagModelManager = $this->container->get('Models');
        $this->session = $this->container->get('Session');
    }

    /**
     * @return bool
     */
    abstract public function hasCorrectCompanyReportConfiguration();

    /**
     * @return bool
     */
    abstract public function hasCorrectPersonReportConfiguration();

    /**
     * @return bool
     */
    public function validateCrefoInvoiceConditions()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==validateCrefoInvoiceConditions.==',
            ['Validate conditions for crefo invoice.']);
        $hasValidConditions = true;
        if ($this instanceof \CrefoShopwarePlugIn\Subscriber\FrontendCheckout) {
            $hasValidConditions = $hasValidConditions && $this->hasAllowedCurrency();
        }
        $isCompany = $this->isCompany();
        $country = $this->getCountryFromUserData();
        if ($country === null) {
            return false;
        }
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
     * Returns if the current user is logged in
     *
     * @return bool
     */
    public function isUserLoggedIn()
    {
        return $this->session->get('sUserId', null) !== null;
    }

    /**
     * Returns if it is a guest account
     *
     * @return bool
     */
    public function isAccountOneTime()
    {
        return $this->session->offsetGet('sOneTimeAccount');
    }

    /**
     * Checks if the company field is set in the billing address
     *
     * @return bool|null
     */
    abstract protected function isCompany();

    /**
     * @return string|null
     */
    abstract protected function getCountryFromUserData();

    /**
     * @return bool
     */
    protected function hasAllowedCurrency()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==hasAllowedCurrency.==', ['Check the allowed currency.']);
        /**
         * @var \Shopware\Models\Shop\Shop $shop
         */
        $shop = $this->container->get('Shop');
        $basketCurrencyId = $this->session->offsetGet('sBasketCurrency');
        $shopCurrency = null;
        $currencies = $shop->getCurrencies();
        /**
         * @var \Shopware\Models\Shop\Currency $currency
         */
        foreach ($currencies as $currency) {
            if ($currency->getId() === intval($basketCurrencyId)) {
                $shopCurrency = $currency;
            }
        }

        return $shopCurrency->getCurrency() == self::ALLOWED_CURRENCY;
    }

    /**
     * @return bool
     */
    abstract protected function hasConfiguredConsentDeclaration();

    /**
     * Checks if the country is allowed by the crefo plugin
     *
     * @param string $country
     * @param bool   $isCompany
     *
     * @return bool
     */
    protected function isAllowedCountry($country, $isCompany = false)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==isAllowedCountry.==',
            ['Check country: ' . $country . ' for ' . ($isCompany ? 'company' : 'person')]);
        if ($isCompany) {
            return in_array(strtoupper($country), CountryType::getAllowedCountriesISOForCompanies());
        }

        return in_array(strtoupper($country), CountryType::getAllowedCountriesISOForPrivatePerson());
    }

    /**
     * Removes Crefo Invoice payment from the view
     */
    protected function removePayment()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==removePayment.==', ['Remove payment from the view.']);
        /**
         * @var \sAdmin $admin
         */
        $admin = $this->container->get('Modules')->Admin();
        $paymentsWithoutCrefoInvoice = [];
        if ($this->view->getAssign('sPayments') !== null) {
            $paymentsWithCrefoInvoice = $this->view->getAssign('sPayments');
        } elseif ($this->view->getAssign('sPaymentMeans') !== null) {
            $paymentsWithCrefoInvoice = $this->view->getAssign('sPaymentMeans');
        } else {
            $paymentsWithCrefoInvoice = $admin->sGetPaymentMeans();
        }
        foreach ($paymentsWithCrefoInvoice as $key => $payment) {
            if (strcmp($payment['name'], self::PAYMENT_NAME) !== 0) {
                $paymentsWithoutCrefoInvoice[$key] = $payment;
            }
        }
        if ($this->view->getAssign('sPayments') !== null) {
            /*
             * needed in checkout page
             */
            $this->view->assign('sPayments', $paymentsWithoutCrefoInvoice);
        }
        if ($this->view->getAssign('sPaymentMeans') !== null) {
            /*
             * needed in account page
             */
            $this->view->assign('sPaymentMeans', $paymentsWithoutCrefoInvoice);
        }
    }

    /**
     * register the needed frontend templates
     * @codeCoverageIgnore
     */
    protected function registerFrontendTemplates()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==registerFrontendTemplates.==',
            ['Register frontend templates.']);
        $template = $this->container->get('Template');
        $template->addTemplateDir(
            $this->container->getParameter('creditreform.plugin_dir') . '/Resources/views/'
        );
    }

    /**
     * @param int $paymentId
     *
     * @return bool
     */
    protected function isCrefoInvoicePayment($paymentId)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==isCrefoInvoicePayment.==',
            ['Check for crefo payment. ID:' . $paymentId]);
        /**
         * @var \Shopware\Models\Payment\Payment $payment
         */
        $payment = $this->swagModelManager->getRepository('Shopware\Models\Payment\Payment')->findOneBy(['id' => intval($paymentId)]);
        if (null === $payment || null === $payment->getPlugin()) {
            return false;
        }

        return $payment->getPlugin()->getName() == $this->creditreform->getName();
    }

    /**
     * @param \Enlight_Controller_Request_Request $request
     */
    protected function saveCrefoPaymentData($request)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==saveCrefoPaymentData.==', ['Save the payment data.']);
        if ($request->getParam('sCrefoConfirmation', null) === 'on') {
            $this->getPaymentDataInstance()->setConsent(true);
            $this->flushPaymentData();
        }
    }

    /**
     * @codeCoverageIgnore
     */
    protected function flushPaymentData()
    {
        try {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==flushPaymentData.==', ['Flush the payment data.']);
            $this->swagModelManager->flush($this->getPaymentDataInstance());
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, "==Couldn't flush the payment data.==", (array) $e);
        }
    }

    /**
     * @return PaymentData
     */
    protected function getPaymentDataInstance()
    {
        if (null === $this->crefoPaymentData) {
            $this->initPaymentData();
        }

        return $this->crefoPaymentData;
    }

    /**
     * init Payment Data
     */
    private function initPaymentData()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==initPaymentData.==', ['Init the payment data.']);
        $this->crefoPaymentData = $this->swagModelManager->getRepository('CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData')
            ->findOneBy(['userId' => $this->session->offsetGet('sUserId')]);
        // @codeCoverageIgnoreStart
        if (null === $this->crefoPaymentData) {
            $this->crefoPaymentData = new PaymentData();
            /**
             * @var Customer $customer
             */
            $customer = $this->swagModelManager->getRepository('Shopware\Models\Customer\Customer')
                ->findOneBy(['id' => $this->session->offsetGet('sUserId')]);
            $this->crefoPaymentData->setUserId($customer);
            $this->swagModelManager->persist($this->crefoPaymentData);
        }
        // @codeCoverageIgnoreEnd
    }
}
