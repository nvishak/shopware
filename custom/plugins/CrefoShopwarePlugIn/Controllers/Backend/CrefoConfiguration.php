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

use CrefoShopwarePlugIn\Components\Core\Enums\AddressValidationResultType;
use CrefoShopwarePlugIn\Components\Core\Enums\CollectionOrderFieldType;
use CrefoShopwarePlugIn\Components\Core\Enums\CompanyProductsType;
use CrefoShopwarePlugIn\Components\Core\Enums\CountryType;
use CrefoShopwarePlugIn\Components\Core\Enums\PrivatePersonProductsType;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount;
use CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests;
use CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig;
use CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoCreditors;
use CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoWSValues;
use CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\CountriesForCompanies;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig;
use CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig;
use CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig;
use CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductScoreConfig;
use CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson;
use Shopware\Components\CSRFWhitelistAware;

/**
 * Class Shopware_Controllers_Backend_CrefoConfiguration.
 */
class Shopware_Controllers_Backend_CrefoConfiguration extends Shopware_Controllers_Backend_Application implements CSRFWhitelistAware
{
    protected $model = 'CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings';
    protected $alias = 'crefoConfiguration';

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoAccounts\Repository $accountRepository
     */
    private $accountRepository = null;

    /**
     * @var null|\Shopware\Models\Payment\Repository $paymentRepository
     */
    private $paymentRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsRepository $productsPrivatePersonRepository
     */
    private $productsPrivatePersonRepository = null;

    /**
     * @codeCoverageIgnore
     */
    public function logonAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Perform Logon.', ['==logon==']);
        $errors = null;
        $id = $this->Request()->getParam('id', null);
        $params = $this->Request()->getParams();
        if (!empty($id)) {
            $account = $this->createAccountFromDB($params['useraccount']);
        } else {
            $account = $this->createAccountFromParameters($params);
        }
        $rawResponse = $this->performLogon($account);
        $successful = $this->isWSRequestSuccessful($rawResponse);
        if (!$successful) {
            $errors = $this->processWSErrors($rawResponse);
        }
        $this->View()->assign(['success' => $successful, 'errors' => $errors]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function changePasswordAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Perform Change Password.', ['==changePassword==']);
        $errors = null;
        $params = $this->Request()->getParams();
        $account = $this->createAccountFromDB($params['useraccount']);
        $rawResponse = $this->changePassword($account, $params['newindividualpassword']);
        $successful = $this->isWSRequestSuccessful($rawResponse);
        if ($successful) {
            /**
             * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
             */
            $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
            $key = $this->getEncryptionKey($passwordEncoder);
            $this->getAccountRepository()->updateIndividualPassword($account->getUserAccount(),
                $passwordEncoder->encrypt($params['newindividualpassword'], $key));
        } else {
            $errors = $this->processWSErrors($rawResponse);
        }
        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'account' => $account]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function changeDefaultPasswordAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Perform Change Default Password.',
            ['==changeDefaultPassword==']);
        $params = $this->Request()->getParams();
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        $key = $this->getEncryptionKey($passwordEncoder);
        if ($params['edit'] === 'true') {
            $account = $this->createAccountFromDB($params['useraccount']);
            $account->setIndividualPassword($passwordEncoder->encrypt($params['individualpassword'], $key));
        } else {
            $account = $this->createAccountFromParameters($params);
        }
        $rawResponse = $this->changePassword($account, $params['newindividualpassword']);
        $successful = $this->isWSRequestSuccessful($rawResponse);
        $errors = null;
        $dataAccount = null;
        if ($successful) {
            $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
            if ($params['edit'] === 'true') {
                $this->getAccountRepository()->updateIndividualPassword($account->getUserAccount(),
                    $passwordEncoder->encrypt($params['newindividualpassword'], $key));
                /**
                 * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $accountEdited
                 */
                $accountEdited = $this->getAccountRepository()->find($account->getId());
                $shopwareModels->persist($accountEdited);
                $shopwareModels->flush();
                $dataAccount = $shopwareModels->toArray($accountEdited);
            } else {
                $account->setIndividualPassword($passwordEncoder->encrypt($params['newindividualpassword'], $key));
                $shopwareModels->persist($account);
                $shopwareModels->flush();
                $dataAccount = $shopwareModels->toArray($account);
            }
        } else {
            null === $rawResponse ? ($errors = ['error' => 'connection']) : ($errors = $this->processWSErrors($rawResponse));
        }
        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $dataAccount]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function checkIndividualPasswordAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==checkIndividualPasswordAction==', []);
        $params = $this->Request()->getParams();
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
         */
        $account = $this->getAccountRepository()->find($params['id']);
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        $key = $this->getEncryptionKey($passwordEncoder);
        $this->View()->assign([
            'success' => strcmp($passwordEncoder->decrypt($account->getIndividualPassword(), $key),
                    $params['individualpassword']) == 0,
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function activatePaymentAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==activatePaymentAction==',
            [$this->Request()->getParam('state', null)]);
        $state = $this->Request()->getParam('state', null);
        /**
         * @var \Shopware\Models\Payment\Payment $crefoInvoice
         */
        $crefoInvoice = $this->getPaymentRepository()->findOneBy(['name' => 'crefo_invoice']);
        if (null !== $crefoInvoice && null !== $state) {
            $statusPaymentBeforeChange = boolval($crefoInvoice->getActive());
            $crefoInvoice->setActive($state);
            /**
             * @var \Shopware\Components\Model\ModelManager $shopwareModels
             */
            $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
            $shopwareModels->persist($crefoInvoice);
            $shopwareModels->flush();
            $success = true;
        } else {
            $statusPaymentBeforeChange = null;
            $success = false;
        }
        $this->View()->assign(['success' => $success, 'status' => $statusPaymentBeforeChange]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getGeneralSettingsAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getGeneralSettingsAction==', []);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $shopwareModels->find(PluginSettings::class, $configId);
        $settingsArray = $shopwareModels->toArray($settings);

        $this->View()->assign(['success' => true, 'data' => $settingsArray]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateGeneralSettingsAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Change general Settings.', ['==updateGeneralSettingsAction==']);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $shopwareModels->find(PluginSettings::class, $configId);
        $params = $this->Request()->getParams();
        $settings->setCommunicationLanguage($params['communicationLanguage']);
        $settings->setConsentDeclaration(boolval($params['consentDeclaration']));
        $errorNotificationStatus = boolval($params['errorNotificationStatus']);
        if ($errorNotificationStatus) {
            $settings = $this->checkForChangesInNotificationArea($settings, $params);
        } else {
            //defaults
            $settings->setErrorTolerance(null);
            $settings->setEmailAddress(null);
            $settings->setRequestCheckAtValue(null);
            $this->resetNotificationCounters();
        }
        $settings->setErrorNotificationActive($errorNotificationStatus);
        $settings->setLogsMaxNumberOfRequests(intval($params['logsMaxNumberOfRequest']));
        $settings->setLogsMaxStorageTime(intval($params['logsMaxStorageTime']));

        $shopwareModels->persist($settings);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true, 'data' => $shopwareModels->toArray($settings)]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getErrorNotificationStatusAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getErrorNotificationStatusAction==', []);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(ErrorRequests::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests $errorRequestObj
         */
        $errorRequestObj = $shopwareModels->find(ErrorRequests::class, $configId);
        $this->View()->assign(
            [
                'success' => true,
                'data' => [
                    'numReq' => $errorRequestObj->getNumberOfRequests(),
                    'numErr' => $errorRequestObj->getNumberOfFailedRequests(),
                    'errTolerance' => $errorRequestObj->getFailurePercent(),
                ],
            ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAccountsAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getAccountsAction==', []);
        $params = $this->Request()->getParams();
        $limit = (empty($params['limit'])) ? 20 : $params['limit'];
        $offset = (empty($params['start'])) ? 0 : $params['start'];

        $query = $this->getAccountRepository()->getAccountsQuery($limit, $offset);

        //returns the total count of the query
        $totalResult = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getQueryCount($query);

        //returns the customer data
        $customers = $query->getArrayResult();

        $this->View()->assign([
            'success' => true,
            'data' => $customers,
            'total' => $totalResult,
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function createAccountAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Add new Account.', ['==createAccountAction==']);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $params = $this->Request()->getParams();

        $account = $this->createAccountFromParameters($params);

        $shopwareModels->persist($account);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true, 'data' => $shopwareModels->toArray($account)]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateAccountAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Update Account.', ['==updateAccountAction==']);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');

        $id = $this->Request()->getParam('id', null);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
         */
        $account = $this->getAccountRepository()->find($id);
        $params = $this->Request()->getParams();
        if (strcmp($params['individualpassword'], $account->getIndividualPassword()) != 0) {
            $key = $this->getEncryptionKey($passwordEncoder);
            $account->setIndividualPassword($passwordEncoder->encrypt($params['individualpassword'], $key));
            $account->setGeneralPassword($passwordEncoder->encrypt($params['generalpassword'], $key));
        }
        $shopwareModels->persist($account);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true, 'data' => $shopwareModels->toArray($account)]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function deleteAccountAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Delete Account.', ['==deleteAccountAction==']);
        //get doctrine entity manager
        $manager = CrefoCrossCuttingComponent::getShopwareInstance()->Models();

        //get posted user
        $accountID = $this->Request()->getParam('id');

        $entity = $this->getAccountRepository()->find($accountID);
        $manager->remove($entity);

        //Performs all of the collected actions.
        $manager->flush();

        $this->View()->assign(['success' => true]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getReportCompanyInfoAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getReportCompanyInfoAction==', []);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(ReportCompanyConfig::class);
        /**
         * @var ReportCompanyConfig $companyConfig
         */
        $companyConfig = $shopwareModels->find(ReportCompanyConfig::class, $configId);

        $companyArray = $shopwareModels->toArray($companyConfig);

        $countries = $companyConfig->getCountries();
        /**
         * @var CountriesForCompanies $country
         */
        foreach ($countries as $country) {
            $products = $country->getProducts();
            $countriesArray = $shopwareModels->toArray($country);
            /**
             * @var ProductsConfig $product
             */
            foreach ($products as $product) {
                $countriesArray['products'][] = $shopwareModels->toArray($product);
            }
            $companyArray['countries'][] = $countriesArray;
        }
        if (!is_null($companyConfig->getUserAccountId())) {
            $companyArray['useraccountId'] = $companyConfig->getUserAccountId()->getId();
            $companyArray['user_account_id'] = $shopwareModels->toArray($companyConfig->getUserAccountId());
        }
        $this->View()->assign([
            'success' => true,
            'data' => $companyArray,
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getReportPrivatePersonInfoAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getReportPrivatePersonInfoAction==', []);
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
        /**
         * @var PrivatePersonConfig $privatePersonConfig
         */
        $privatePersonConfig = $this->getProductsPrivatePersonRepository()->findCrefoObject(PrivatePersonConfig::class,
            $configId);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $privatePersonArray = $shopwareModels->toArray($privatePersonConfig);
        $products = $privatePersonConfig->getProducts();
        /**
         * @var ProductsPrivatePerson $product
         */
        foreach ($products as $product) {
            $scoreProducts = $product->getScoreProducts();
            $productArray = $shopwareModels->toArray($product);
            /*
             * @var ProductScoreConfig $scoreProduct
             */
            foreach ($scoreProducts as $scoreProduct) {
                $productArray['scoreProducts'][] = $shopwareModels->toArray($scoreProduct);
            }
            $privatePersonArray['products'][] = $productArray;
        }
        if (null !== $privatePersonConfig->getUserAccountId()) {
            $privatePersonArray['userAccountId'] = $privatePersonConfig->getUserAccountId()->getId();
            $privatePersonArray['user_account_id'] = $shopwareModels->toArray($privatePersonConfig->getUserAccountId());
        }
        $this->View()->assign([
            'success' => true,
            'data' => $privatePersonArray,
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getInkassoInfoAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getInkassoInfoAction==', []);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(InkassoConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig $configCollection
         */
        $configCollection = $shopwareModels->find(InkassoConfig::class, $configId);
        $data = $shopwareModels->toArray($configCollection);
        if (null !== $configCollection->getUserAccountId()) {
            $data['useraccount_id'] = $shopwareModels->toArray($configCollection->getUserAccountId());
        }
        $this->View()->assign(['success' => true, 'data' => $data]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function logonReportCompanyAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Perform Logon for companies.',
            ['userAccountID' => $this->Request()->getParam('useraccountId')]);
        $accountId = $this->Request()->getParam('useraccountId', null);
        $successful = true;
        $account = null;
        $errors = null;
        $reportCompaniesData = null;
        $productsNotAvailable = null;

        if (null !== $accountId && strcmp('', $accountId) != 0) {
            $account = $this->getAccountRepository()->find($accountId);
        } else {
            $errors = 'null-account';
        }

        if (null !== $account) {
            $rawResponseXml = $this->performLogon($account);
            $reportCompaniesData = $this->processReportCompaniesData($rawResponseXml);
            $successful = $reportCompaniesData['successful'];
            unset($reportCompaniesData['successful']);
            if (!$successful) {
                $errors = $this->processWSErrors($rawResponseXml);
            }
        }

        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $reportCompaniesData]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function logonReportPrivatePersonAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Perform logon for private persons.',
            ['userAccountID' => $this->Request()->getParam('useraccountId')]);
        $accountId = $this->Request()->getParam('useraccountId', null);
        $successful = true;
        $account = null;
        $errors = null;
        $reportData = null;
        $productsNotAvailable = null;

        if (null !== $accountId && strcmp('', $accountId) != 0) {
            $account = $this->getAccountRepository()->find($accountId);
        } else {
            $errors = 'null-account';
        }

        if (null !== $account) {
            $rawResponseXml = $this->performLogon($account);
            $reportData = $this->processReportPrivatePersonData($rawResponseXml);
            $successful = $reportData['successful'];
            unset($reportData['successful']);
            if (!$successful) {
                $errors = $this->processWSErrors($rawResponseXml);
            }
        }
        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $reportData]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function logonInkassoAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Perform logon for collection order.',
            ['userAccountID' => $this->Request()->getParam('useraccountId')]);
        $accountId = $this->Request()->getParam('useraccountId', null);
        $successful = true;
        $account = null;
        $errors = null;
        $inkassoData = null;
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();

        if (null !== $accountId && strcmp('', $accountId) != 0) {
            $account = $shopwareModels->find(CrefoAccount::class, $accountId);
        } else {
            $errors = 'null-account';
        }

        if (null !== $account) {
            $rawResponseXml = $this->performLogon($account);
            $inkassoData = ['collectionOrderType' => [], 'collectionTurnoverType' => [], 'receivableReason' => [], 'creditors' => []];
            if (null === $rawResponseXml || is_soap_fault($rawResponseXml) || ($rawResponseXml instanceof \Exception)) {
                $successful = false;
                $errors = $this->processWSErrors($rawResponseXml);
            } else {
                $processedData = $this->processInkassoData($rawResponseXml, $inkassoData);
                if ($processedData === false) {
                    $successful = false;
                    $errors['title'] = 'no-service';
                    $errors['errorCode'] = 999;
                } else {
                    $inkassoData = $processedData;
                }
            }
        }

        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $inkassoData]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getInUseAccountsAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getInUseAccountsAction==', []);
        $data = [];
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configReportCompaniesId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(ReportCompanyConfig::class);
        /**
         * @var ReportCompanyConfig $configReportCompanies
         */
        $configReportCompanies = $shopwareModels->find(ReportCompanyConfig::class, $configReportCompaniesId);

        if (null !== $configReportCompanies->getUserAccountId()) {
            $data[] = [
                'id' => $configReportCompanies->getUserAccountId()->getId(),
                'serviceCallee' => ReportCompanyConfig::class,
            ];
        }
        $configReportPrivatePersonId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
        /**
         * @var PrivatePersonConfig $configReportPrivatePerson
         */
        $configReportPrivatePerson = $shopwareModels->find(PrivatePersonConfig::class, $configReportPrivatePersonId);
        if (null !== $configReportPrivatePerson->getUserAccountId()) {
            $data[] = [
                'id' => $configReportPrivatePerson->getUserAccountId()->getId(),
                'serviceCallee' => PrivatePersonConfig::class,
            ];
        }
        $configCollectionId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(InkassoConfig::class);
        /**
         * @var InkassoConfig $configCollection
         */
        $configCollection = $shopwareModels->find(InkassoConfig::class, $configCollectionId);
        if (null !== $configCollection->getUserAccountId()) {
            $data[] = [
                'id' => $configCollection->getUserAccountId()->getId(),
                'serviceCallee' => InkassoConfig::class,
            ];
        }
        $this->View()->assign([
            'success' => true,
            'data' => $data,
            'total' => count($data),
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAllowedBonimaProductsAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getAllowedBonimaProductsAction==', []);
        $buildAllowedProducts = [];
        foreach (PrivatePersonProductsType::AllowedProducts() as $key => $product) {
            $buildAllowedProducts[] = ['id' => $key, 'keyWS' => $product];
        }
        $this->View()->assign([
            'success' => true,
            'data' => $buildAllowedProducts,
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAllowedCompaniesProductsAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getAllowedCompaniesProductsAction==', []);
        $buildAllowedProducts = [];
        foreach (CompanyProductsType::AllowedProducts() as $key => $product) {
            $buildAllowedProducts[] = ['id' => $key, 'keyWS' => $product];
        }
        $this->View()->assign([
            'success' => true,
            'data' => $buildAllowedProducts,
        ]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function saveReportCompaniesAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==saveReportCompaniesAction==',
            [$this->Request()->getParams()]);
        $params = $this->Request()->getParams();
        $success = true;
        try {
            $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
            $configIdReportCompanies = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(ReportCompanyConfig::class);
            /**
             * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig $reportCompanyConfigObj
             */
            $reportCompanyConfigObj = $shopwareModels->find(ReportCompanyConfig::class, $configIdReportCompanies);
            if (strcmp($params['useraccountId'], '') == 0) {
                $this->truncateTable(ProductsConfig::class);
                $this->truncateTable(CountriesForCompanies::class);
                $reportCompanyConfigObj->setLegitimateKey(null);
                $reportCompanyConfigObj->setReportLanguageKey(null);
                $reportCompanyConfigObj->setUserAccountId(null);
                $shopwareModels->persist($reportCompanyConfigObj);
            } else {
                $reportCompanyConfigObj->setLegitimateKey(strval($params['legitimateKey']));
                $reportCompanyConfigObj->setReportLanguageKey(strval($params['reportLanguageKey']));
                $reportCompanyConfigObj->setUserAccountId($this->getAccountRepository()->find(intval($params['useraccountId'])));
                $shopwareModels->persist($reportCompanyConfigObj);
                $this->saveCompanyConfigBasedOnCountries($reportCompanyConfigObj, $params);
            }
            $shopwareModels->flush();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Exception==', [$e]);
            $success = false;
        }

        $this->View()->assign(['success' => $success]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function saveReportPrivatePersonAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==saveReportPrivatePersonAction==',
            [$this->Request()->getParams()]);
        $params = $this->Request()->getParams();
        $success = true;
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();

        try {
            $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
            /**
             * @var PrivatePersonConfig $reportPrivatePersonConfig
             */
            $reportPrivatePersonConfig = $shopwareModels->find(PrivatePersonConfig::class, $configId);

            $this->truncateTable(ProductScoreConfig::class);
            $this->truncateTable(ProductsPrivatePerson::class);

            if (strcmp($params['privatePersonUserAccountId'], '') == 0) {
                $reportPrivatePersonConfig->setLegitimateKey(null);
                $reportPrivatePersonConfig->setUserAccountId(null);
                $shopwareModels->persist($reportPrivatePersonConfig);
            } else {
                $reportPrivatePersonConfig->setLegitimateKey(strval($params['legitimateKeyPrivatePerson']));
                /**
                 * @var CrefoAccount $account
                 */
                $account = $this->getAccountRepository()->find(intval($params['privatePersonUserAccountId']));
                $reportPrivatePersonConfig->setUserAccountId($account);
                $shopwareModels->persist($reportPrivatePersonConfig);
                $this->saveReportPrivatePersonProducts($params, $reportPrivatePersonConfig);
            }
            $shopwareModels->flush();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Exception==', [$e]);
            $success = false;
        }
        $this->View()->assign(['success' => $success]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function saveInkassoConfigAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Save collection order configuration.',
            [$this->Request()->getParams()]);
        $params = $this->Request()->getParams();

        $success = true;
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(InkassoConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig $inkassoConfig
         */
        $inkassoConfig = $shopwareModels->find(InkassoConfig::class, $configId);

        if (array_key_exists('collectionUserAccountId', $params) && strcmp($params['collectionUserAccountId'], '') == 0) {
            $inkassoConfig->setCreditor(null);
            $inkassoConfig->setCustomerReference(null);
            $inkassoConfig->setDueDate(0);
            $inkassoConfig->setInterestRateRadio(null);
            $inkassoConfig->setInterestRateValue(null);
            $inkassoConfig->setOrderType(null);
            $inkassoConfig->setReceivableReason(null);
            $inkassoConfig->setTurnoverType(null);
            $inkassoConfig->setValutaDate(0);
            $inkassoConfig->setUserAccountId(null);
        } else {
            if (array_key_exists('creditor', $params) && $params['creditor'] !== '') {
                $inkassoConfig->setCreditor(intval($params['creditor']));
            } else {
                $inkassoConfig->setCreditor(null);
            }
            if (array_key_exists('customer_reference', $params)) {
                $inkassoConfig->setCustomerReference(intval($params['customer_reference']));
            } else {
                $inkassoConfig->setCustomerReference(null);
            }
            if (!array_key_exists('due_date', $params)) {
                $inkassoConfig->setDueDate(0);
            } else {
                $inkassoConfig->setDueDate(intval($params['due_date']));
            }
            if (!array_key_exists('valuta_date', $params)) {
                $inkassoConfig->setValutaDate(0);
            } else {
                $inkassoConfig->setValutaDate(intval($params['valuta_date']));
            }
            if (array_key_exists('interest_rate_radio', $params)) {
                $inkassoConfig->setInterestRateRadio(intval($params['interest_rate_radio']));
            } else {
                $inkassoConfig->setInterestRateRadio(null);
            }
            if (array_key_exists('interest_rate_value', $params)) {
                $inkassoConfig->setInterestRateValue(floatval($params['interest_rate_value']));
            } else {
                $inkassoConfig->setInterestRateValue(null);
            }
            if (array_key_exists('order_type', $params)) {
                $inkassoConfig->setOrderType(strval($params['order_type']));
            } else {
                $inkassoConfig->setOrderType(null);
            }
            if (array_key_exists('receivable_reason', $params)) {
                $inkassoConfig->setReceivableReason(strval($params['receivable_reason']));
            } else {
                $inkassoConfig->setReceivableReason(null);
            }
            if (array_key_exists('turnover_type', $params)) {
                $inkassoConfig->setTurnoverType(strval($params['turnover_type']));
            } else {
                $inkassoConfig->setTurnoverType(null);
            }
            /**
             * @var CrefoAccount $account
             */
            $account = $this->getAccountRepository()->findOneBy(['id' => intval($params['collectionUserAccountId'])]);
            $inkassoConfig->setUserAccountId($account);
        }
        $shopwareModels->persist($inkassoConfig);
        $shopwareModels->flush();

        $this->View()->assign(['success' => $success]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function saveInkassoWSValuesAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==saveInkassoWSValuesAction==',
            [$this->Request()->getParams()]);
        $params = $this->Request()->getParams();
        $success = true;
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $this->truncateTable(InkassoWSValues::class);
        foreach ($params as $key => $entry) {
            if (is_array($entry) &&
                array_key_exists('keyWS', $entry) &&
                array_key_exists('textWS', $entry) &&
                array_key_exists('typeValue', $entry)
            ) {
                $inkassoValue = new InkassoWSValues();
                $inkassoValue->setKeyWS($entry['keyWS']);
                $inkassoValue->setTextWS($entry['textWS']);
                $inkassoValue->setTypeValue($entry['typeValue']);
                $shopwareModels->persist($inkassoValue);
                $shopwareModels->flush();
            }
        }
        $this->View()->assign(['success' => $success]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function saveInkassoCreditorsAction()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==saveInkassoCreditorsAction==', [$this->Request()->getParams()]);
        $params = $this->Request()->getParams();
        $success = true;
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $this->truncateTable(InkassoCreditors::class);
        foreach ($params as $entry) {
            if (is_array($entry) &&
                array_key_exists('address', $entry) &&
                array_key_exists('name', $entry) &&
                array_key_exists('useraccount', $entry)
            ) {
                $inkassoCreditor = new InkassoCreditors();
                $inkassoCreditor->setAddress($entry['address']);
                $inkassoCreditor->setName($entry['name']);
                $inkassoCreditor->setUseraccount($entry['useraccount']);
                $shopwareModels->persist($inkassoCreditor);
                $shopwareModels->flush();
            }
        }
        $this->View()->assign(['success' => $success]);
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getWhitelistedCSRFActions()
    {
        return [];
    }

    /**
     * @param null|\CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
     *
     * @return mixed
     */
    protected function performLogon($account = null)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==performLogon==', []);
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Request\LogonRequest $crefoLogon
         */
        $crefoLogon = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.logon_request');
        /**
         * @var \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest $config
         */
        $config = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.config_header_request');
        $crefoLogon->setConfigHeaderRequest($config);
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        if (null === $account) {
            $accountArray = null;
        } else {
            $accountArray = [
                'userAccount' => $account->getUserAccount(),
                'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(),
                    $config->getEncryptionKey()),
                'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                    $config->getEncryptionKey()),
            ];
        }
        $crefoLogon->setHeaderAccount($accountArray);
        $result = null;
        try {
            $result = $crefoLogon->performLogon();
            $crefoLogon->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoLogon->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\SoapFault $fault) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==performLogon>>SoapFault ' . date('Y-m-d H:i:s') . '==',
                (array) $fault);
            $result = $fault;
            $crefoLogon->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoLogon->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performLogon>>CrefoCommunicationException ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $result = new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException($snippets->get('crefo/messages/error_in_communication'),
                $e->getCode());
            $crefoLogon->getCrefoParser()->setRawResponse($e);
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($crefoLogon, $xmlText,
                CrefoCrossCuttingComponent::ERROR);
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==performLogon>>Exception ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $result = new \Exception($snippets->get('crefo/validation/generalError'), $e->getCode());
            $dateProcessEnd = new \DateTime('now');
            CrefoCrossCuttingComponent::saveCrefoLogs([
                'log_status' => \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType::NOT_SAVED,
                'ts_response' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'tsProcessEnd' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'requestXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'requestXMLDescription' => CrefoCrossCuttingComponent::ERROR,
                'responseXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'responseXMLDescription' => CrefoCrossCuttingComponent::ERROR,
            ]);
        }

        return $result;
    }

    /**
     * @codeCoverageIgnore
     * @return null|\CrefoShopwarePlugIn\Models\CrefoAccounts\Repository
     */
    private function getAccountRepository()
    {
        if ($this->accountRepository === null) {
            $this->accountRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount');
        }

        return $this->accountRepository;
    }

    /**
     * @codeCoverageIgnore
     * @return null|\Shopware\Models\Payment\Repository
     */
    private function getPaymentRepository()
    {
        if ($this->paymentRepository === null) {
            $this->paymentRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('\Shopware\Models\Payment\Payment');
        }

        return $this->paymentRepository;
    }

    /**
     * @codeCoverageIgnore
     * @return null|\CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsRepository
     */
    private function getProductsPrivatePersonRepository()
    {
        if ($this->productsPrivatePersonRepository === null) {
            $this->productsPrivatePersonRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson');
        }

        return $this->productsPrivatePersonRepository;
    }

    /**
     * @param $rawResponse
     *
     * @return array
     */
    private function processReportCompaniesData($rawResponse)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==processReportCompaniesData==', []);
        $reportCompaniesData = ['reportLanguages' => [], 'legitimateInterests' => [], 'products' => [], 'successful' => false];
        if (null === $rawResponse || is_soap_fault($rawResponse) || ($rawResponse instanceof \Exception)) {
            $successfulDataProcessed = false;
        } else {
            $successfulDataProcessed = true;
            /**
             * @var \CrefoShopwarePlugIn\Components\Soap\Parsers\ReportCompaniesParser $parser
             */
            $parser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.report_companies_config_parser');
            $parser->setRawResponse($rawResponse);
            $reportCompaniesData['reportLanguages'] = $parser->extractKeysAndValuesFromWS('identificationreport',
                'reportlanguage', $reportCompaniesData['reportLanguages']);
            $reportCompaniesData['legitimateInterests'] = $parser->extractKeysAndValuesFromWS('identificationreport',
                'legitimateinterest', $reportCompaniesData['legitimateInterests']);
            $reportCompaniesData['products'] = $parser->extractProducts();
        }
        $reportCompaniesData['successful'] = $successfulDataProcessed;
        return $reportCompaniesData;
    }

    /**
     * @param $rawResponse
     *
     * @return array
     */
    private function processReportPrivatePersonData($rawResponse)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==processReportPrivatePersonData==', []);
        $reportData = ['legitimateInterests' => [], 'products' => [], 'successful' => false];
        if (null === $rawResponse || is_soap_fault($rawResponse) || ($rawResponse instanceof \Exception)) {
            $successfulDataProcessed = false;
        } else {
            $successfulDataProcessed = true;
            /**
             * @var \CrefoShopwarePlugIn\Components\Soap\Parsers\ReportPrivatePersonParser $parser
             */
            $parser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.report_private_person_parser');
            $parser->setRawResponse($rawResponse);
            $reportData['legitimateInterests'] = $parser->extractKeysAndValuesFromWS('bonimareport',
                'legitimateinterest', $reportData['legitimateInterests']);
            $reportData['products'] = $parser->extractProducts();
        }
        $reportData['successful'] = $successfulDataProcessed;
        return $reportData;
    }

    /**
     * @param $rawResponse
     * @param null|array $inkassoData
     *
     * @return bool|array
     */
    private function processInkassoData($rawResponse, array $inkassoData = null)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==processInkassoData==', []);
        /**
         * @var \CrefoShopwarePlugIn\Components\Soap\Parsers\CollectionParser $parser
         */
        $parser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.collection_config_parser');
        $parser->setRawResponse($rawResponse);
        if (!$parser->hasService()) {
            return false;
        }
        $creditorsFromWS = $parser->extractCreditorFromWS();
        if (!empty($creditorsFromWS)) {
            $inkassoData['creditors'] = array_merge([
                    0 => [
                        'id' => 0,
                        'useraccount' => '',
                        'name' => '',
                        'address' => '',
                    ],
                ], $creditorsFromWS);
        } else {
            $inkassoData['creditors'] = [];
        }
        $inkassoData['collectionOrderType'] = $parser->extractKeysAndValuesFromWS('collectionorder', 'collectionordertype',
                $inkassoData['collectionOrderType']);
        $inkassoData['collectionTurnoverType'] = $parser->extractKeysAndValuesFromWS('collectionorder',
                'partreceivable/collectionturnovertype', $inkassoData['collectionTurnoverType']);
        $inkassoData['receivableReason'] = $parser->extractKeysAndValuesFromWS('collectionorder',
                'partreceivable/receivablereason', $inkassoData['receivableReason']);

        $inkassoData['collectionOrderType'] = $this->addCollectionOrderType($inkassoData['collectionOrderType'], CollectionOrderFieldType::ORDER);
        $inkassoData['collectionTurnoverType'] = $this->addCollectionOrderType($inkassoData['collectionTurnoverType'], CollectionOrderFieldType::TURNOVER);
        $inkassoData['receivableReason'] = $this->addCollectionOrderType($inkassoData['receivableReason'], CollectionOrderFieldType::RECEIVABLE_REASON);

        return $inkassoData;
    }

    /**
     * @param array $fieldType
     * @param int   $type
     *
     * @return array
     */
    private function addCollectionOrderType(array $fieldType, $type)
    {
        foreach ($fieldType as $key => $field) {
            if (isset($field['no_service']) || isset($field['no_key'])) {
                return $fieldType;
            }
            $field['typeValue'] = $type;
            $fieldType[$key] = $field;
        }

        return $fieldType;
    }

    /**
     * @param $rawResponse
     *
     * @return bool
     */
    private function isWSRequestSuccessful($rawResponse)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==isWSRequestSuccessful==', []);

        return null !== $rawResponse
            && !($rawResponse instanceof \Exception)
            && !is_soap_fault($rawResponse)
            && !($rawResponse instanceof \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException);
    }

    /**
     * @param $params
     *
     * @return CrefoAccount
     */
    private function createAccountFromParameters($params)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==createAccountFromParameters==', []);
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        $account = new CrefoAccount();
        $account->setUserAccount($params['useraccount']);
        $key = $this->getEncryptionKey($passwordEncoder);
        $account->setIndividualPassword($passwordEncoder->encrypt($params['individualpassword'], $key));
        $account->setGeneralPassword($passwordEncoder->encrypt($params['generalpassword'], $key));

        return $account;
    }

    /**
     * @codeCoverageIgnore
     * @param string $useraccount
     *
     * @return CrefoAccount
     */
    private function createAccountFromDB($useraccount)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==createAccountFromDB==', [$useraccount]);
        $account = new CrefoAccount();
        $dbAccount = $this->getAccountRepository()->getAccountWithNumber($useraccount);
        $account->setAccountFromQuery($dbAccount);

        return $account;
    }

    /**
     * @param null|\CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
     * @param $newPass
     *
     * @return mixed
     */
    private function changePassword($account, $newPass)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==changePassword==', [$account]);
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        /**
         * @var \CrefoShopwarePlugIn\Components\API\Request\ChangePasswordRequest $crefoChangePassword
         */
        $crefoChangePassword = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.change_password_request');
        /**
         * @var \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest $config
         */
        $config = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.config_header_request');
        $crefoChangePassword->setConfigHeaderRequest($config);
        /**
         * @var \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
         */
        $passwordEncoder = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.password_encoder');
        $accountArray = [
            'userAccount' => $account->getUserAccount(),
            'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(), $config->getEncryptionKey()),
            'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                $config->getEncryptionKey()),
        ];
        $crefoChangePassword->setHeaderAccount($accountArray);
        $crefoChangePassword->setNewPassword($newPass);
        $result = null;
        try {
            $result = $crefoChangePassword->changePassword();
            $crefoChangePassword->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoChangePassword->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\SoapFault $fault) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==changePassword>>SoapFault ' . date('Y-m-d H:i:s') . '==',
                (array) $fault);
            $result = $fault;
            $crefoChangePassword->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoChangePassword->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==changePassword>>CrefoCommunicationException ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $result = new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException($snippets->get('crefo/messages/error_in_communication'),
                $e->getCode());
            $crefoChangePassword->getCrefoParser()->setRawResponse($e);
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($crefoChangePassword, $xmlText,
                CrefoCrossCuttingComponent::ERROR);
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==changePassword>>Exception ' . date('Y-m-d H:i:s') . '==', [$e->getMessage()]);
            $result = new \Exception($snippets->get('crefo/validation/generalError'), $e->getCode());
            $dateProcessEnd = new \DateTime('now');
            CrefoCrossCuttingComponent::saveCrefoLogs([
                'log_status' => \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType::NOT_SAVED,
                'ts_response' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'tsProcessEnd' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'requestXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'requestXMLDescription' => CrefoCrossCuttingComponent::ERROR,
                'responseXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'responseXMLDescription' => CrefoCrossCuttingComponent::ERROR,
            ]);
        }

        return $result;
    }

    /**
     * @param $rawResponse
     *
     * @throws Exception
     *
     * @return array
     */
    private function processWSErrors($rawResponse)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==processWSErrors==', []);
        /**
         * @var \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser $crefoParser
         */
        $crefoParser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.soap_parser');
        $crefoParser->setRawResponse($rawResponse);

        return $crefoParser->getSoapErrors();
    }

    /**
     * @codeCoverageIgnore
     * @param string $class
     */
    private function truncateTable($class)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==truncateTable==', [$class]);
        $em = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $cmd = $em->getClassMetadata($class);
        $connection = $em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->beginTransaction();
        try {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $q = $dbPlatform->getTruncateTableSQL($cmd->getTableName());
            $connection->executeUpdate($q);
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollBack();
        }
    }

    /**
     * @param \CrefoShopwarePlugIn\Components\Core\PasswordEncoder $passwordEncoder
     *
     * @return string
     */
    private function getEncryptionKey($passwordEncoder)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getEncryptionKey==', []);
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $shopwareModels->find(PluginSettings::class, $configId);
        $key = $settings->getEncryptionKey();
        if (null === $key) {
            $key = $passwordEncoder->generateKey();
            $settings->setEncryptionKey($key);
            CrefoCrossCuttingComponent::getShopwareInstance()->Models()->persist($settings);
            CrefoCrossCuttingComponent::getShopwareInstance()->Models()->flush();
        }

        return $key;
    }

    /**
     * @param ReportCompanyConfig $companyConfig
     * @param array               $params
     */
    private function saveCompanyConfigBasedOnCountries(ReportCompanyConfig $companyConfig, array $params)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Save configuration for companies.',
            [$params, $companyConfig]);
        $countriesStatus[CountryType::AT] = filter_var($params['companyConfigCheckbox_' . CountryType::AT], FILTER_VALIDATE_BOOLEAN);
        $countriesStatus[CountryType::DE] = filter_var($params['companyConfigCheckbox_' . CountryType::DE], FILTER_VALIDATE_BOOLEAN);
        $countriesStatus[CountryType::LU] = filter_var($params['companyConfigCheckbox_' . CountryType::LU], FILTER_VALIDATE_BOOLEAN);
        foreach ($countriesStatus as $countryID => $countryActivated) {
            $foundCountry = null;
            /**
             * @var CountriesForCompanies $country
             */
            foreach ($companyConfig->getCountries() as $country) {
                if ($country->getCountry() === $countryID) {
                    $foundCountry = $country;
                }
            }
            if (!$countryActivated && $foundCountry != null) {
                $this->removeCompanyConfigForCountry($foundCountry);
            } elseif (filter_var($params['tabSeen_' . $countryID], FILTER_VALIDATE_BOOLEAN)) {
                if ($foundCountry !== null) {
                    $this->updateCountryConfigForCompanies($foundCountry, $params);
                } else {
                    $this->insertCountryConfigForCompanies($companyConfig, $countryID, $params);
                }
            }
        }
    }

    /**
     * @param array               $params
     * @param PrivatePersonConfig $reportPrivatePersonConfig
     */
    private function saveReportPrivatePersonProducts(array $params, PrivatePersonConfig $reportPrivatePersonConfig)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Save configuration for private persons.',
            [$params, $reportPrivatePersonConfig]);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $thresholdMax = null === $params['thresholdMax'] || $params['thresholdMax'] === '' ? null : floatval($params['thresholdMax']);
        $basketThresholds = is_array($params['basketThresholdMin']) ? $params['basketThresholdMin'] : [$params['basketThresholdMin']];
        $multiProducts = is_array($params['basketThresholdMin']) ? true : false;
        $productsNumber = count($params['basketThresholdMin']);
        $subProductsIndexes = ['start' => 0];
        foreach ($basketThresholds as $productRow => $threshold) {
            $product = new ProductsPrivatePerson();
            $product->setProductNameWS($multiProducts ? $params['productCrefoName'][$productRow] : $params['productCrefoName']);
            $keyWS = $multiProducts ? $params['productCrefo'][$productRow] : $params['productCrefo'];
            $allowedProducts = PrivatePersonProductsType::AllowedProducts();
            if ($keyWS === $allowedProducts[PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT]) {
                $keyWSId = PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT;
                if (isset($subProductsIndexes['finish'])) {
                    $subProductsIndexes['start'] = $subProductsIndexes['finish'];
                }
                $subProductsIndexes['finish'] = $subProductsIndexes['start'] + 2;
            } else {
                $keyWSId = PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT_PREMIUM;
                if (isset($subProductsIndexes['finish'])) {
                    $subProductsIndexes['start'] = $subProductsIndexes['finish'];
                }
                $subProductsIndexes['finish'] = $subProductsIndexes['start'] + 4;
            }
            $product->setProductKeyWS($keyWSId);
            $product->setThresholdMin(floatval($threshold));
            if ($productRow + 1 === $productsNumber) {
                $product->setLastThresholdMax(true);
                $product->setThresholdMax($thresholdMax);
            } else {
                if ($productRow + 1 < $productsNumber) {
                    $product->setLastThresholdMax(false);
                    $product->setThresholdMax($basketThresholds[$productRow + 1]);
                }
            }
            $product->setProductAvailability(true);
            $product->setConfigId($reportPrivatePersonConfig);
            $product->setVisualSequence($productRow);
            $shopwareModels->persist($product);
            $this->saveBonimaScoreProducts($params, $subProductsIndexes, $product);
        }
    }

    /**
     * @param array                 $params
     * @param array                 $subProductsIndexes
     * @param ProductsPrivatePerson $product
     */
    private function saveBonimaScoreProducts(array $params, array $subProductsIndexes, ProductsPrivatePerson $product)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==saveBonimaScoreProducts==',
            [$params, $subProductsIndexes, $product]);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $subProductsCount = $subProductsIndexes['finish'] - $subProductsIndexes['start'];
        $indexIndent = $product->getProductKeyWS() === PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT ? 0 : 2;
        for ($i = 0; $i < $subProductsCount; ++$i) {
            $productFromScore = $params['bonimaScoreFrom'][$i + $subProductsIndexes['start']];
            $productFromScore = null === $productFromScore || $productFromScore === '' ? null : intval($productFromScore);
            $productToScore = $params['bonimaScoreTo'][$i + $subProductsIndexes['start']];
            $productToScore = null === $productToScore || $productToScore === '' ? null : intval($productToScore);
            $scoreProductConfig = new ProductScoreConfig();
            $scoreProductConfig->setVisualSequence($i);
            $scoreProductConfig->setIdentificationResult($i + $indexIndent);
            $scoreProductConfig->setAddressValidationResult(AddressValidationResultType::IDENTIFIED);
            $scoreProductConfig->setProductId($product);
            $scoreProductConfig->setProductScoreFrom($productFromScore);
            $scoreProductConfig->setProductScoreTo($productToScore);
            $shopwareModels->persist($scoreProductConfig);
        }
    }

    /**
     * @param CountriesForCompanies $country
     */
    private function removeCompanyConfigForCountry(CountriesForCompanies $country)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==removeCompanyConfigForCountry==',
            [$country]);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var ProductsConfig $product
         */
        foreach ($country->getProducts() as $product) {
            $shopwareModels->remove($product);
        }
        $shopwareModels->remove($country);
    }

    private function updateCountryConfigForCompanies(CountriesForCompanies $country, array $params)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==updateCountryConfigForCompanies==',
            [$country]);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var ProductsConfig $product
         */
        foreach ($country->getProducts() as $product) {
            $shopwareModels->remove($product);
        }
        $this->insertCompanyProduct($country, $params);
    }

    /**
     * @param ReportCompanyConfig $companyConfig
     * @param int                 $countryID
     * @param array               $params
     */
    private function insertCountryConfigForCompanies(ReportCompanyConfig $companyConfig, $countryID, array $params)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==insertCountryConfigForCompanies==',
            [$countryID]);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $country = new CountriesForCompanies();
        $country->setConfigId($companyConfig);
        $country->setCountry($countryID);
        $this->insertCompanyProduct($country, $params);
        $shopwareModels->persist($country);
    }

    /**
     * @param CountriesForCompanies $country
     * @param array                 $params
     */
    private function insertCompanyProduct(CountriesForCompanies $country, array $params)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==insertCompanyProduct==', [$country]);
        $countryID = $country->getCountry();
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $basketMinValue = $params['basketThresholdMin_' . $countryID];
        if (is_array($basketMinValue)) {
            $countSolvencyIndex = 0;
            foreach ($basketMinValue as $sequence => $minVal) {
                $productConfig = new ProductsConfig();
                $productConfig->setCountry($country);
                $productConfig->setThresholdMin(filter_var($minVal, FILTER_VALIDATE_FLOAT));
                if (isset($basketMinValue[$sequence + 1])) {
                    $productConfig->setThresholdMax(filter_var($basketMinValue[$sequence + 1], FILTER_VALIDATE_FLOAT));
                    $productConfig->setLastThresholdMax(false);
                } else {
                    filter_var($params['thresholdMax_' . $countryID], FILTER_VALIDATE_FLOAT) === false ? $productConfig->setThresholdMax(null) : $productConfig->setThresholdMax(filter_var($params['thresholdMax_' . $countryID], FILTER_VALIDATE_FLOAT));
                    $productConfig->setLastThresholdMax(true);
                }
                $productConfig->setProductKeyWS(filter_var($params['productCrefo_' . $countryID][$sequence], FILTER_SANITIZE_STRING));
                $productConfig->setProductTextWS(filter_var($params['productCrefoName_' . $countryID][$sequence], FILTER_SANITIZE_STRING));
                $productConfig->setSequence($sequence);
                if ($productConfig->getProductKeyWS() === CompanyProductsType::AllowedProducts()[CompanyProductsType::ECREFO]) {
                    $productConfig->setHasSolvencyIndex(true);
                    if (count($params['solvencyIndex_' . $countryID]) > 1) {
                        $productConfig->setThresholdIndex(filter_var($params['solvencyIndex_' . $countryID][$countSolvencyIndex], FILTER_VALIDATE_INT));
                        ++$countSolvencyIndex;
                    } else {
                        $productConfig->setThresholdIndex(filter_var($params['solvencyIndex_' . $countryID], FILTER_VALIDATE_INT));
                    }
                } else {
                    $productConfig->setHasSolvencyIndex(false);
                }
                $shopwareModels->persist($productConfig);
            }
        } else {
            $productConfig = new ProductsConfig();
            $productConfig->setCountry($country);
            $productConfig->setThresholdMin(filter_var($basketMinValue, FILTER_VALIDATE_FLOAT));
            filter_var($params['thresholdMax_' . $countryID], FILTER_VALIDATE_FLOAT) === false ? $productConfig->setThresholdMax(null) : $productConfig->setThresholdMax(filter_var($params['thresholdMax_' . $countryID], FILTER_VALIDATE_FLOAT));
            $productConfig->setLastThresholdMax(true);
            $productConfig->setProductKeyWS(filter_var($params['productCrefo_' . $countryID], FILTER_SANITIZE_STRING));
            $productConfig->setProductTextWS(filter_var($params['productCrefoName_' . $countryID], FILTER_SANITIZE_STRING));
            $productConfig->setSequence(0);
            if ($productConfig->getProductKeyWS() === CompanyProductsType::AllowedProducts()[CompanyProductsType::ECREFO]) {
                $productConfig->setHasSolvencyIndex(true);
                $productConfig->setThresholdIndex(filter_var($params['solvencyIndex_' . $countryID], FILTER_VALIDATE_INT));
            } else {
                $productConfig->setHasSolvencyIndex(false);
            }
            $shopwareModels->persist($productConfig);
        }
    }

    /**
     * @param PluginSettings $settings
     * @param array          $params
     *
     * @return PluginSettings
     */
    private function checkForChangesInNotificationArea(PluginSettings $settings, array $params)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==checkForChangesInNotificationArea==', ['settingsId' => $settings->getId()]);
        if ($settings->getEmailAddress() !== $params['emailAddress'] ||
            $settings->getErrorTolerance() !== intval($params['errorTolerance']) ||
            $settings->getRequestCheckAtValue() !== intval($params['requestCheckAtValue'])
        ) {
            $settings->setErrorTolerance(intval($params['errorTolerance']));
            $settings->setEmailAddress($params['emailAddress']);
            $settings->setRequestCheckAtValue(intval($params['requestCheckAtValue']));
            $this->resetNotificationCounters();
        }

        return $settings;
    }

    private function resetNotificationCounters()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==resetNotificationCounters==', ['reset count of the email notification']);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(ErrorRequests::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests $errorRequestObj
         */
        $errorRequestObj = $shopwareModels->find(ErrorRequests::class, $configId);
        $errorRequestObj->resetCounters();
        $shopwareModels->persist($errorRequestObj);
    }
}
