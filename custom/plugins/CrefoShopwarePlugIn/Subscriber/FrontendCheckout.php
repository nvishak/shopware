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
use CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use CrefoShopwarePlugIn\Components\Core\Enums\PaymentType;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use CrefoShopwarePlugIn\Components\Swag\Middleware\FrontendObject;
use CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs;
use CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\CountriesForCompanies;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig;
use CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig;
use CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductScoreConfig;
use CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson;
use Enlight\Event\SubscriberInterface;
use Shopware\Models\Country\Country;
use Shopware\Models\Customer\Address;
use Shopware\Models\Customer\AddressRepository;

/**
 * Class FrontendCheckout
 */
class FrontendCheckout extends FrontendObject implements SubscriberInterface
{
    /**
     * @var float
     */
    private $amount = null;

    private $addressArray = [];

    /**
     * @codeCoverageIgnore
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Controllers_Frontend_Checkout::saveShippingPaymentAction::before' => 'onSavePayment',
            'Shopware_Controllers_Frontend_Checkout::confirmAction::after' => 'onConfirmAction',
            'Shopware_Controllers_Frontend_Address::ajaxSaveAction::before' => 'onBeforeAjaxSaveAction',
            'Shopware_Controllers_Frontend_Address::ajaxSaveAction::after' => 'onAfterAjaxSaveAction',
            'Shopware_Controllers_Frontend_Address::handleExtraAction::after' => 'onAfterHandleExtraAction',
            'Shopware_Controllers_Frontend_Checkout::finishAction::after' => 'onFinishAction',
            'Shopware_Controllers_Frontend_CrefoInvoice::indexAction::before' => 'onBeforeIndexAction',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatch',
        ];
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onSavePayment(\Enlight_Hook_HookArgs $args)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            'Leaving the shipping page and continuing with the selected payment.',
            ['Hook to save payment in checkout.']
        );
        /** @var \Enlight_Controller_Action $subject */
        $subject = $args->getSubject();
        $request = $subject->Request();
        $payment = $request->getPost('payment');
        if ($this->isCrefoInvoicePayment($payment)) {
            $this->session->offsetUnset('sCrefoCustomerAddressChanged');
            if (!$this->isAccountOneTime()) {
                $this->saveCrefoPaymentData($request);
            }
            if (null !== $request->getParam('sCrefoConfirmation', null)) {
                $this->session->offsetSet('sCrefoCustomerConsentDeclaration', 'on' === $request->getParam('sCrefoConfirmation', null));
                $this->session->offsetUnset('sNoCrefoConfirmation');
            }
            if (null !== $request->getParam('sCrefoBirthDate', null)) {
                $this->session->offsetSet('sCrefoCustomerBirthDate', $request->getParam('sCrefoBirthDate', null));
                $this->session->offsetUnset('sNoCrefoBirthDate');
            }
            $this->session->offsetUnset('sCrefoInvalidPaymentConditions');
        } else {
            $this->session->offsetUnset('sNoCrefoBirthDate');
            $this->session->offsetUnset('sNoCrefoConfirmation');
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onConfirmAction(\Enlight_Hook_HookArgs $args)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            'After the confirm page in checkout was rendered.',
            ['Hook to confirmation checkout.']
        );
        /** @var \Enlight_Controller_Action $subject */
        $subject = $args->getSubject();
        $this->view = $subject->View();
        if (null !== $this->view->getAssign('sPayment') && $this->isCrefoInvoicePayment($this->view->getAssign('sPayment')['id'])) {
            if (null === $this->session->get('sCrefoConfigs', null)) {
                $this->populateConfigurations();
            }
            if ($this->hasFailedSolvencyCheckInSession($this->session->get('sCrefoBadResponse'))) {
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);

                return;
            }
            if (!$this->validateCrefoInvoiceConditions()) {
                $this->session->offsetSet('sCrefoInvalidPaymentConditions', true);
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);

                return;
            }
            if ($this->session->get('sCrefoCustomerAddressChanged', false)) {
                $this->session->offsetUnset('sCrefoCustomerBirthDate');
                $this->session->offsetSet('sNoCrefoBirthDate', true);
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);

                return;
            }
            $this->initDirectEntryOnConfirmPage();
            if ($this->hasConfiguredConsentDeclaration() && true !== $this->session->get('sCrefoCustomerConsentDeclaration', false)) {
                $this->session->offsetSet('sNoCrefoConfirmation', true);
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);

                return;
            }
            if (!$this->isCompany() && null === $this->session->get('sCrefoCustomerBirthDate', null)) {
                $this->session->offsetSet('sNoCrefoBirthDate', true);
                $subject->redirect(['controller' => 'checkout', 'action' => 'shippingPayment']);

                return;
            }
        } else {
            $this->session->offsetUnset('sCrefoInvalidPaymentConditions');
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onBeforeAjaxSaveAction(\Enlight_Hook_HookArgs $args)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            'Checks on address change.',
            ['Hook to check before address is saved in checkout.']
        );
        $action = $args->getSubject();
        $this->addressArray = [];
        $userId = $this->session->get('sUserId');
        $addressId = $action->Request()->getPost('id', null);

        /**
         * @var AddressRepository $addressRepository
         */
        $addressRepository = $this->swagModelManager->getRepository(Address::class);
        $address = $addressRepository->getOneByUser($addressId, $userId);
        $this->addressArray['firstName'] = $address->getFirstname();
        $this->addressArray['lastName'] = $address->getLastname();
        $this->addressArray['salutation'] = $address->getSalutation();
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onAfterAjaxSaveAction(\Enlight_Hook_HookArgs $args)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            'Checks on address change.',
            ['Hook to check after address is saved in checkout.']
        );
        $action = $args->getSubject();

        $userId = $this->session->get('sUserId');
        $addressId = $action->Request()->getPost('id', null);

        /**
         * @var AddressRepository $addressRepository
         */
        $addressRepository = $this->swagModelManager->getRepository(Address::class);
        $address = $addressRepository->getOneByUser($addressId, $userId);
        $addressCompareArray = [
            'firstName' => $address->getFirstname(),
            'lastName' => $address->getLastname(),
            'salutation' => $address->getSalutation(),
            'company' => $address->getCompany(),
        ];
        if ('update' !== $action->Request()->getParam('saveAction')) {
            /**
             * @var \Enlight_Controller_Response_ResponseHttp $response
             */
            $response = $action->Response();
            $responseData = json_decode($response->getBody(), true);
            $addressData = $responseData['data'];
            $addressCompareArray['firstName'] = $addressData['firstname'];
            $addressCompareArray['lastName'] = $addressData['lastname'];
            $addressCompareArray['salutation'] = $addressData['salutation'];
            $addressCompareArray['company'] = $addressData['company'];
        }
        if (null !== $addressCompareArray['company']) {
            $this->session->offsetUnset('sCrefoCustomerBirthDate');
        } elseif ($this->addressArray['firstName'] !== $addressCompareArray['firstName'] ||
            $this->addressArray['lastName'] !== $addressCompareArray['lastName'] ||
            $this->addressArray['salutation'] !== $addressCompareArray['salutation']
        ) {
            $this->session->offsetSet('sCrefoCustomerAddressChanged', true);
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onAfterHandleExtraAction(\Enlight_Hook_HookArgs $args)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            'Checks on address change from existing address.',
            ['Hook to check after change address in checkout.']
        );
        $action = $args->getSubject();

        $userId = $this->session->get('sUserId');
        $addressId = $action->Request()->getPost('id', null);
        /**
         * @var AddressRepository $addressRepository
         */
        $addressRepository = $this->swagModelManager->getRepository(Address::class);
        $address = $addressRepository->getOneByUser($addressId, $userId);
        if (null !== $address->getCompany()) {
            $this->session->offsetUnset('sCrefoCustomerBirthDate');
        } else {
            $this->session->offsetSet('sCrefoCustomerAddressChanged', true);
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onFinishAction(\Enlight_Hook_HookArgs $args)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            'Finishing the checkout process with another payment method.',
            ['Hook to finish checkout.']
        );
        $this->saveOnFinishingCheckout();
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Hook_HookArgs $args
     */
    public function onBeforeIndexAction(\Enlight_Hook_HookArgs $args)
    {
        /** @var \Enlight_Controller_Action $action */
        $action = $args->getSubject();
        $request = $action->Request();
        $response = $action->Response();
        if (!$request->isDispatched()
            || $response->isException()
            || self::FRONTEND_MODULE != $request->getModuleName()
        ) {
            return;
        }
        if (0 === strcmp(mb_strtolower($request->getActionName()), 'index')
            && 0 === strcmp(mb_strtolower($request->getControllerName()), 'crefo_invoice')
        ) {
            CrefoLogger::getCrefoLogger()->log(
                CrefoLogger::DEBUG,
                'Before calling the solvency check page.',
                ['Hook to before checkout index.']
            );
            $this->validateConditionsBeforePurchase($action);
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function onPostDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        /** @var \Enlight_Controller_Action $action */
        $action = $args->getSubject();
        $request = $action->Request();
        $response = $action->Response();
        $this->view = $action->View();

        if (!$request->isDispatched()
            || $response->isException()
            || self::FRONTEND_MODULE != $request->getModuleName()
            || !$this->view->hasTemplate()
        ) {
            return;
        }

        if (0 === strcmp(mb_strtolower($request->getActionName()), 'shippingpayment')
            && 0 === strcmp(mb_strtolower($request->getControllerName()), 'checkout')
        ) {
            CrefoLogger::getCrefoLogger()->log(
                CrefoLogger::DEBUG,
                'On post dispatch on shipping page.',
                ['We are in the shippingpayment page of the checkout.']
            );
            if (null === $this->session->get('sCrefoConfigs', null)) {
                $this->populateConfigurations();
            }
            $this->registerFrontendTemplates();
            //error message for birthdate field
            if (null !== $this->session->get('sNoCrefoBirthDate')) {
                CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'When a birth date error exists.', ['Error on the birthdate field.']);
                $this->view->assign('sNoCrefoBirthDate', $this->session->get('sNoCrefoBirthDate'));
            }
            //error message for consent field
            if (null !== $this->session->get('sNoCrefoConfirmation')) {
                CrefoLogger::getCrefoLogger()->log(
                    CrefoLogger::DEBUG,
                    'When a consent declaration error exists.',
                    ['Error on the consent declaration field.']
                );
                $this->view->assign('sNoCrefoConfirmation', $this->session->get('sNoCrefoConfirmation'));
            }

            if (!$this->hasFailedSolvencyCheckInSession($this->session->get('sCrefoBadResponse')) && $this->validateCrefoInvoiceConditions()) {
                CrefoLogger::getCrefoLogger()->log(
                    CrefoLogger::INFO,
                    'The customer is a valid candidate for solvency check.',
                    ['Non failed solvency try in the session with valid conditions']
                );
                $isCompany = $this->isCompany();
                $this->view->assign('sIsCompany', $isCompany);
                $this->view->assign('sCrefoBirthDateFieldVisibility', !$isCompany);
                if (!$isCompany) {
                    $this->view->assign('sCrefoBirthDate', $this->extractBirthday());
                }
                $hasConsent = $this->hasConfiguredConsentDeclaration();
                $this->view->assign('sHasCrefoConsentDeclaration', $hasConsent);
                //set user consent
                if ($hasConsent && !$this->isAccountOneTime()) {
                    $this->view->assign('sCrefoConfirmation', boolval($this->getPaymentDataInstance()->getConsent())
                    || $this->session->get('sCrefoCustomerConsentDeclaration', false));
                } elseif ($hasConsent) {
                    $this->view->assign('sCrefoConfirmation', $this->session->get('sCrefoCustomerConsentDeclaration', false));
                }
                $this->view->extendsTemplate('frontend/crefo_invoice/change_payment.tpl');
            } else {
                CrefoLogger::getCrefoLogger()->log(
                    CrefoLogger::INFO,
                    'The customer has a failed solvency try in the session.',
                    ['==onPostDispatch==']
                );
                if ($this->hasFailedSolvencyCheckInSession($request->getParam('sCrefoBadResponse'))) {
                    $this->view->assign('sCrefoShowBadResponse', true);
                    $this->view->assign('sNoCrefoConfirmation', false);
                    $this->view->assign('sNoCrefoBirthDate', false);
                }
                if ($this->session->get('sCrefoInvalidPaymentConditions', false)) {
                    $this->view->assign('sCrefoShowBadResponse', true);
                }
                $this->removePayment();
            }
            $this->view->extendsTemplate('frontend/crefo_invoice/shipping_payment.tpl');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasCorrectCompanyReportConfiguration()
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            '==hasCorrectCompanyReportConfiguration==',
            ['Check the configuration.']
        );

        return $this->checkPaymentConfiguration('company');
    }

    /**
     * {@inheritdoc}
     */
    public function hasCorrectPersonReportConfiguration()
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            '==hasCorrectPersonReportConfiguration==',
            ['Check the configuration.']
        );

        return $this->checkPaymentConfiguration('person');
    }

    /**
     * {@inheritdoc}
     */
    protected function hasConfiguredConsentDeclaration()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==hasConsentDeclaration.==', ['Check the consent declaration.']);
        $configs = $this->session->get('sCrefoConfigs', null);
        if (null === $configs['general']) {
            return false;
        }

        return boolval($configs['general']['consentDeclaration']);
    }

    /**
     * {@inheritdoc}
     */
    protected function isCompany()
    {
        $sRegister = $this->session->get('sRegister', null);
        $sOrderVariables = $this->session->get('sOrderVariables', null);
        if (null !== $sOrderVariables && $sOrderVariables instanceof \ArrayObject) {
            $sOrderVariables = $sOrderVariables->getArrayCopy();

            return $sOrderVariables['sUserData']['billingaddress']['company'] !== null;
        } elseif (null !== $sRegister && isset($sRegister['billing']['customer_type'])) {
            return $sRegister['billing']['customer_type'] === 'business';
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    protected function getCountryFromUserData()
    {
        $sRegister = $this->session->get('sRegister', null);
        $sOrderVariables = $this->session->get('sOrderVariables', null);
        if (null !== $sOrderVariables && $sOrderVariables instanceof \ArrayObject) {
            $sOrderVariables = $sOrderVariables->getArrayCopy();

            return $sOrderVariables['sUserData']['additional']['country']['countryiso'];
        } elseif (null !== $sRegister && isset($sRegister['billing']['country'])) {
            $countryId = $sRegister['billing']['country'];
            /**
             * @var null|\Shopware\Models\Country\Repository
             */
            $countryRepository = $this->swagModelManager->getRepository('Shopware\Models\Country\Country');
            /**
             * @var Country $country
             */
            $country = $countryRepository->findOneBy(['id' => intval($countryId)]);
            if (null !== $country) {
                return $country->getIso();
            }
        } // @codeCoverageIgnore

        return null;
    }

    /**
     * @param string $config
     *
     * @return bool
     */
    private function checkPaymentConfiguration($config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==checkPaymentConfiguration==', [$config]);
        $conditionCompliesToSettings = false;
        $this->session->offsetUnset('sCrefoCurrentConfig');
        $countryFromUserData = $this->getCountryFromUserData();
        $configs = $this->session->get('sCrefoConfigs', null);
        if (null === $countryFromUserData || null === $configs || $configs[$config]['user_account_id'] === null) {
            return $conditionCompliesToSettings;
        }
        $country = CountryType::getCountryIdFromISO2($countryFromUserData);
        if (!isset($configs[$config]['countries'][$country]) || $configs[$config]['countries'][$country] === null) {
            return $conditionCompliesToSettings;
        }
        $countryConfigured = $configs[$config]['countries'][$country];
        if (!isset($countryConfigured['products']) || null === $countryConfigured['products']) {
            return $conditionCompliesToSettings;
        }
        foreach ($countryConfigured['products'] as $sequence => $product) {
            if (0 === $sequence) {
                $conditionCompliesToSettings = floatval($this->getAmount()) >= floatval($product['thresholdMin']);
            }
            if (boolval($product['isLastThresholdMax']) && null !== $product['thresholdMax']) {
                $conditionCompliesToSettings = $conditionCompliesToSettings && floatval($this->getAmount()) <= floatval($product['thresholdMax']);
            }
            if ($this->getAmount() >= $product['thresholdMin'] &&
                (null === $product['thresholdMax'] || $this->getAmount() < $product['thresholdMax'] ||
                    ($product['isLastThresholdMax'] && $this->getAmount() <= $product['thresholdMax']))) {
                $this->session->offsetSet('sCrefoCurrentConfig', $product);
            }
        }

        return $conditionCompliesToSettings;
    }

    /**
     * @return null|string
     */
    private function extractBirthday()
    {
        $birthday = null;
        /**
         * @var \DateTime $dateShopFormat
         */
        $dateShopFormat = null;
        if (null !== $this->session->get('sCrefoCustomerBirthDate', null) && '' !== $this->session->get('sCrefoCustomerBirthDate', '')) {
            $birthday = $this->session->get('sCrefoCustomerBirthDate', null);
            $this->view->assign('sCrefoHasSavedBirthDate', !$this->session->get('sCrefoCustomerAddressChanged', false));

            return $birthday;
        }
        $sRegister = $this->session->get('sRegister', null);
        $userInfo = $this->session->get('userInfo', null);
        $sOrderVariables = (object) $this->session->get('sOrderVariables');
        if (null !== $sOrderVariables && $sOrderVariables instanceof \ArrayObject) {
            $sOrderVariables = $sOrderVariables->getArrayCopy();
        } else {
            $sOrderVariables = null;
        }
        if (null !== $sOrderVariables &&
            isset($sOrderVariables['sUserData']['additional']['user']['birthday']) &&
            !$this->session->get('sCrefoCustomerAddressChanged', false)
        ) {
            $dateShopFormat = new \DateTime($sOrderVariables['sUserData']['additional']['user']['birthday']);
        } elseif (null !== $sRegister &&
            !$this->session->get('sCrefoCustomerAddressChanged', false) &&
            isset($sRegister['personal']['birthday']) &&
            $sRegister['personal']['birthday']['year'] !== '' &&
            $sRegister['personal']['birthday']['month'] !== '' &&
            $sRegister['personal']['birthday']['day'] !== '') {
            $composedDate = $sRegister['personal']['birthday']['year'] . '-' . $sRegister['personal']['birthday']['month'] .
                '-' . $sRegister['personal']['birthday']['day'];
            $dateShopFormat = new \DateTime($composedDate);
        } elseif (null !== $userInfo &&
            null !== $userInfo['birthday'] &&
            !$this->session->get('sCrefoCustomerAddressChanged', false)
        ) {
            $dateShopFormat = new \DateTime($userInfo['birthday']);
        }

        if (null !== $dateShopFormat && false !== $dateShopFormat) {
            $birthday = $dateShopFormat->format('d.m.Y');
        }

        if (null === $birthday) {
            $this->view->assign('sCrefoHasSavedBirthDate', false);
        } else {
            $this->view->assign('sCrefoHasSavedBirthDate', !$this->session->get('sCrefoCustomerAddressChanged', false));
        }

        return $birthday;
    }

    /**
     * @param \Enlight_Controller_Action $action
     */
    private function validateConditionsBeforePurchase($action)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            '==validateConditionsBeforePurchase==',
            ['Validate conditions before purchase.']
        );
        if (!$this->isUserLoggedIn()) {
            $action->forward(
                'login',
                'account',
                null,
                ['sTarget' => 'checkout', 'sTargetAction' => 'confirm', 'showNoAccount' => true]
            );
        }
        /*
             * In case the user somehow reached this page while the payment module was removed or unavailable
             * it sends the user back to shippingPayment
             */
        if ($this->hasFailedSolvencyCheckInSession($this->session->get('sCrefoBadResponse'))) {
            $action->redirect(['controller' => 'checkout', 'action' => 'shippingPayment', 'forceSecure' => true]);
        }
        /*
         * customer didn't accept the consent
         */
        if ($this->hasConfiguredConsentDeclaration() && null === $this->session->get('sCrefoCustomerConsentDeclaration', null)) {
            CrefoLogger::getCrefoLogger()->log(
                CrefoLogger::DEBUG,
                'Customer\'s consent declaration was not found in session.',
                ['sCrefoCustomerConsentDeclaration' => $this->session->get('sCrefoCustomerConsentDeclaration', null)]
            );
            $this->session->offsetSet('sNoCrefoConfirmation', true);
            $action->redirect(['controller' => 'checkout', 'action' => 'shippingPayment', 'forceSecure' => true]);
        }
        $isCompany = $this->isCompany();
        if (!$isCompany && null === $this->session->get('sCrefoCustomerBirthDate', null)) {
            CrefoLogger::getCrefoLogger()->log(
                CrefoLogger::DEBUG,
                'Customer\'s birth date was not found in session.',
                ['sCrefoCustomerBirthDate' => $this->session->get('sCrefoCustomerBirthDate', null)]
            );
            $this->session->offsetSet('sNoCrefoBirthDate', true);
            $action->redirect(['controller' => 'checkout', 'action' => 'shippingPayment', 'forceSecure' => true]);
        }
        $this->session->offsetSet('sCrefoReportType', ($isCompany ? PaymentType::COMPANY : PaymentType::PERSON));
    }

    /**
     * save crefo invoice related information about failed payment
     */
    private function saveOnFinishingCheckout()
    {
        $orderVariables = (object) $this->session->get('sOrderVariables');
        $orderVariables = null !== $orderVariables && $orderVariables instanceof \ArrayObject ? $orderVariables->getArrayCopy() : [];
        if (null !== $this->session->get('sCrefoReportResultId') && !empty($orderVariables)) {
            CrefoLogger::getCrefoLogger()->log(
                CrefoLogger::DEBUG,
                '==saveOnFinishingWithOtherPayment==',
                ['Save information when checkout finished with other payment.']
            );
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
            $crefoReportResults = $repoCrefoResults->find(intval($this->session->get('sCrefoReportResultId')));

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
        CrefoCrossCuttingComponent::resetCrefoVariables($this->session);
    }

    /**
     * Checks if the customer has already done a solvency check in this session and if the check failed
     *
     * @param bool $crefoResponse
     *
     * @return bool
     */
    private function hasFailedSolvencyCheckInSession($crefoResponse)
    {
        CrefoLogger::getCrefoLogger()->log(
            CrefoLogger::DEBUG,
            '==hasFailedSolvencyCheckInSession==',
            ['Check for failed solvency checks.']
        );

        return is_bool($crefoResponse) && $crefoResponse;
    }

    private function calculateAmount()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==calculateAmount==', ['Calculate amount based on basket.']);
        $orderVariables = $this->session->get('sOrderVariables');
        if (null !== $this->view && null !== $this->view->getAssign('sBasket') && null !== $this->view->getAssign('sAmount')) {
            $amount = $this->view->getAssign('sAmount');
            $this->amount = floatval($amount);
        } elseif (null !== $orderVariables && $orderVariables instanceof \ArrayObject) {
            $orderVariables = $orderVariables->getArrayCopy();
            $amount = $orderVariables['sAmount'];
            $this->amount = floatval($amount);
        }
    }

    /**
     * @return float
     */
    private function getAmount()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Get amount from class or session.', ['amount' => $this->amount]);
        if (null === $this->amount) {
            $this->calculateAmount();
        }

        return $this->amount;
    }

    /**
     * @codeCoverageIgnore
     */
    private function initDirectEntryOnConfirmPage()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Init on direct entry on confirm page.', ['']);
        if (!$this->isAccountOneTime() &&
            $this->hasConfiguredConsentDeclaration() &&
            null !== $this->getPaymentDataInstance()->getConsent() &&
            null === $this->session->get('sCrefoCustomerConsentDeclaration', null)
        ) {
            $this->session->offsetSet('sCrefoCustomerConsentDeclaration', $this->getPaymentDataInstance()->getConsent());
        }
        if (!$this->isCompany() &&
            (null === $this->session->get('sCrefoCustomerBirthDate', null) ||
                '' === $this->session->get('sCrefoCustomerBirthDate', ''))) {
            $birthday = $this->extractBirthday();
            if (null !== $birthday) {
                $this->session->offsetSet('sCrefoCustomerBirthDate', $birthday);
            }
        }
    }

    private function populateConfigurations()
    {
        $configs = null;
        $pluginSettingsId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $pluginSettings
         */
        $pluginSettings = $this->swagModelManager->find(PluginSettings::class, $pluginSettingsId);
        $configs['general'] = $this->swagModelManager->toArray($pluginSettings);
        unset($configs['general']['encryptionKey']);
        $companyConfigId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(ReportCompanyConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig $companyConfig
         */
        $companyConfig = $this->swagModelManager->find(ReportCompanyConfig::class, $companyConfigId);
        $configs['company'] = $this->swagModelManager->toArray($companyConfig);
        if (null !== $configs['company']['useraccount_id']) {
            $configs['company']['user_account_id'] = $configs['company']['useraccount_id'];
            unset($configs['company']['useraccount_id']);
            /**
             * @var CountriesForCompanies $country
             */
            foreach ($companyConfig->getCountries() as $country) {
                $configs['company']['countries'][$country->getCountry()] = $this->swagModelManager->toArray($country);
                /**
                 * @var ProductsConfig $product
                 */
                foreach ($country->getProducts() as $product) {
                    $configs['company']['countries'][$country->getCountry()]['products'][$product->getSequence()] = $this->swagModelManager->toArray($product);
                }
            }
        }
        $personConfigId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig $personConfig
         */
        $personConfig = $this->swagModelManager->find(PrivatePersonConfig::class, $personConfigId);
        $configs['person'] = $this->swagModelManager->toArray($personConfig);
        if (null !== $configs['person']['user_account_id']) {
            /**
             * @var ProductsPrivatePerson $product
             */
            foreach ($personConfig->getProducts() as $product) {
                $configs['person']['countries']['1']['products'][$product->getVisualSequence()] = $this->swagModelManager->toArray($product);
                /**
                 * @var ProductScoreConfig $scoreProduct
                 */
                foreach ($product->getScoreProducts() as $scoreProduct) {
                    $configs['person']['countries']['1']['products'][$product->getVisualSequence()]['scoreProducts'][$scoreProduct->getVisualSequence()] = $this->swagModelManager->toArray($scoreProduct);
                }
            }
        }
        $this->session->offsetSet('sCrefoConfigs', $configs);
    }
}
