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
use \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount;
use \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig;
use \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig;
use \CrefoShopwarePlugIn\Components\Core\Enums\PrivatePersonProductsType;
use \CrefoShopwarePlugIn\Components\Core\Enums\IdentificationResultType;
use \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson;
use \Shopware\Components\CSRFWhitelistAware;

/**
 * Class Shopware_Controllers_Backend_CrefoConfiguration
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
     * @var null|\CrefoShopwarePlugIn\Models\CrefoPluginSettings\SettingsRepository $settingsRepository
     */
    private $settingsRepository = null;
    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyRepository $reportCompanyRepository
     */
    private $reportCompanyRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\Repository $reportPrivatePersonRepository
     */
    private $reportPrivatePersonRepository = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsRepository $productsPrivatePersonRepository
     */
    private $productsPrivatePersonRepository = null;
    /**
     * @var null|\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfigRepository $inkassoConfigRepository
     */
    private $inkassoConfigRepository = null;
    /**
     * @var null|CrefoLogger $crefoLogger
     */
    private $crefoLogger = null;

    /**
     * @return null|CrefoLogger
     */
    private function getCrefoLogger()
    {
        if ($this->crefoLogger === null) {
            $this->crefoLogger = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.logger');
        }
        return $this->crefoLogger;
    }

    /**
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
     * @return null|\CrefoShopwarePlugIn\Models\CrefoPluginSettings\SettingsRepository
     */
    private function getPluginSettingsRepository()
    {
        if ($this->settingsRepository === null) {
            $this->settingsRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings');
        }
        return $this->settingsRepository;
    }

    /**
     * @return null|\CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyRepository
     */
    private function getReportCompanyRepository()
    {
        if ($this->reportCompanyRepository === null) {
            $this->reportCompanyRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig');
        }
        return $this->reportCompanyRepository;
    }

    /**
     * @return null|\CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\Repository
     */
    private function getReportPrivatePersonRepository()
    {
        if ($this->reportPrivatePersonRepository === null) {
            $this->reportPrivatePersonRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig');
        }
        return $this->reportPrivatePersonRepository;
    }

    /**
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
     * @return null|\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfigRepository
     */
    private function getInkassoConfigRepository()
    {
        if ($this->inkassoConfigRepository === null) {
            $this->inkassoConfigRepository = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig');
        }
        return $this->inkassoConfigRepository;
    }


    public function logonAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==logon==", ["Perform Logon."]);
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

    public function changePasswordAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==changePassword==", ["Perform Change Password."]);
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

    public function changeDefaultPasswordAction()
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==changeDefaultPassword==",
            ["Perform Change Default Password."]);
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
            is_null($rawResponse) ? ($errors = ['error' => 'connection']) : ($errors = $this->processWSErrors($rawResponse));
        }
        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $dataAccount]);
    }

    public function checkIndividualPasswordAction()
    {
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
                    $params['individualpassword']) == 0
        ]);
    }

    public function activatePaymentAction()
    {
        $state = $this->Request()->getParam('state', null);
        /**
         * @var \Shopware\Models\Payment\Payment $crefoInvoice
         */
        $crefoInvoice = $this->getPaymentRepository()->findOneBy(['name' => 'crefo_invoice']);
        if (!is_null($crefoInvoice) && !is_null($state)) {
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

    public function resetGeneralSettingsAction()
    {
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $this->getPluginSettingsRepository()->find($configId);
        $settings->setCommunicationLanguage('de');
        $settings->setConsentDeclaration(true);
        $settings->setEmailAddress(null);
        $settings->setErrorNotificationActive(false);
        $settings->setErrorTolerance(1);
        $settings->setLogsMaxNumberOfRequests(0);
        $settings->setLogsMaxStorageTime(2);
        $settings->setRequestCheckAtValue(2);
        $shopwareModels->persist($settings);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true, 'data' => $shopwareModels->toArray($settings)]);
    }

    public function getGeneralSettingsAction()
    {
        $arraySettings = $this->getPluginSettingsRepository()->getGeneralSettingsArray();
        $this->View()->assign(['success' => true, 'data' => $arraySettings]);
    }

    public function updateGeneralSettingsAction()
    {
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $this->getPluginSettingsRepository()->find($configId);
        $params = $this->Request()->getParams();
        $settings->setCommunicationLanguage($params['communicationLanguage']);
        $settings->setConsentDeclaration(boolval($params['consentDeclaration']));
        $errorNotificationStatus = boolval($params['errorNotificationStatus']);
        if ($errorNotificationStatus) {
            $settings->setErrorTolerance(intval($params['errorTolerance']));
            $settings->setEmailAddress($params['emailAddress']);
            $settings->setRequestCheckAtValue(intval($params['requestCheckAtValue']));
        }
        $settings->setErrorNotificationActive($errorNotificationStatus);
        $settings->setLogsMaxNumberOfRequests(intval($params['logsMaxNumberOfRequest']));
        $settings->setLogsMaxStorageTime(intval($params['logsMaxStorageTime']));

        $shopwareModels->persist($settings);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true, 'data' => $shopwareModels->toArray($settings)]);
    }

    public function getErrorNotificationStatusAction()
    {
        $repoErrorRequests = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests');
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests $errorRequestObj
         */
        $errorRequestObj = $repoErrorRequests->find($configId);
        $this->View()->assign(
            [
                'success' => true,
                'data' => [
                    'numReq' => $errorRequestObj->getNumberOfRequests(),
                    'numErr' => $errorRequestObj->getNumberOfFailedRequests(),
                    'errTolerance' => $errorRequestObj->getFailurePercent()
                ]
            ]);
    }

    public function getAccountsAction()
    {
        $params = $this->Request()->getParams();
        $limit = (empty($params["limit"])) ? 20 : $params["limit"];
        $offset = (empty($params["start"])) ? 0 : $params["start"];


        $query = $this->getAccountRepository()->getAccountsQuery($limit, $offset);

        //returns the total count of the query
        $totalResult = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getQueryCount($query);

        //returns the customer data
        $customers = $query->getArrayResult();

        $this->View()->assign([
            'success' => true,
            'data' => $customers,
            'total' => $totalResult
        ]);
    }

    public function createAccountAction()
    {
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $params = $this->Request()->getParams();

        $account = $this->createAccountFromParameters($params);

        $shopwareModels->persist($account);
        $shopwareModels->flush();
        $this->View()->assign(['success' => true, 'data' => $shopwareModels->toArray($account)]);
    }

    public function updateAccountAction()
    {
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

    public function deleteAccountAction()
    {
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

    public function getReportCompanyInfoAction()
    {
        $query = $this->getReportCompanyRepository()->getReportCompanyConfigQueryBuilder()->getQuery();
        //returns the customer data
        $reportComp = $query->getArrayResult();

        $this->View()->assign([
            'success' => true,
            'data' => $reportComp
        ]);
    }

    public function getReportPrivatePersonInfoAction()
    {
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
        /**
         * @var PrivatePersonConfig $privatePersonConfig
         */
        $privatePersonConfig = $this->getReportPrivatePersonRepository()->findCrefoObject(PrivatePersonConfig::class,
            $configId);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $privatePersonArray = $shopwareModels->toArray($privatePersonConfig);
        if (!is_null($privatePersonConfig->getUserAccountId())) {
            $privatePersonArray['userAccountId'] = $privatePersonConfig->getUserAccountId()->getId();
            $privatePersonArray['user_account_id'] = $shopwareModels->toArray($privatePersonConfig->getUserAccountId());
        }
        $this->View()->assign([
            'success' => true,
            'data' => $privatePersonArray
        ]);
    }

    public function getInkassoInfoAction()
    {
        $query = $this->getInkassoConfigRepository()->getInkassoConfigQueryBuilder()->getQuery();
        //returns the customer data
        $data = $query->getArrayResult();

        $this->View()->assign(['success' => true, 'data' => $data]);
    }

    public function getInkassoCreditorsAction()
    {
        /**
         * @var \Doctrine\ORM\Query $query
         */
        $query = $this->getInkassoConfigRepository()->getInkassoCreditorsQueryBuilder()->getQuery();
        //returns the customer data
        $creditorsFromDB = $query->getArrayResult();
        if (!empty($creditorsFromDB)) {
            $data = array_merge([0 => ['id' => 0, 'useraccount' => '', 'name' => '', 'address' => '']],
                $creditorsFromDB);
        } else {
            $data = $creditorsFromDB;
        }

        $this->View()->assign(['success' => true, 'creditors' => $data]);
    }

    public function destroyInkassoCreditorsAction()
    {
        /**
         * @var \Doctrine\ORM\Query $query
         */
        $query = $this->getInkassoConfigRepository()->getInkassoCreditorsQueryBuilder()->getQuery();
        //returns the customer data
        $data = $query->getArrayResult();

        //get doctrine entity manager
        $manager = CrefoCrossCuttingComponent::getShopwareInstance()->Models();

        foreach ($data as $value) {
            $entity = $this->getInkassoConfigRepository()->findCrefoObject(\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoCreditors::class,
                $value['id']);
            if (!is_null($entity)) {
                $manager->remove($entity);
                //Performs all of the collected actions.
                $manager->flush();
            }
        }

        $this->View()->assign(['success' => true]);
    }

    public function getInkassoValuesAction()
    {
        /**
         * @var \Doctrine\ORM\Query $query
         */
        $query = $this->getInkassoConfigRepository()->getInkassoValuesQueryBuilder()->getQuery();
        //returns the customer data
        $data = $query->getArrayResult();

        $this->View()->assign(['success' => true, 'data' => $data]);
    }

    public function destroyInkassoValuesAction()
    {
        /**
         * @var \Doctrine\ORM\Query $query
         */
        $query = $this->getInkassoConfigRepository()->getInkassoValuesQueryBuilder()->getQuery();
        //returns the customer data
        $data = $query->getArrayResult();

        //get doctrine entity manager
        $manager = CrefoCrossCuttingComponent::getShopwareInstance()->Models();

        foreach ($data as $value) {
            $entity = $this->getInkassoConfigRepository()->findCrefoObject(\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoWSValues::class,
                $value['id']);
            if (!is_null($entity)) {
                $manager->remove($entity);
                //Performs all of the collected actions.
                $manager->flush();
            }
        }

        $this->View()->assign(['success' => true]);
    }

    public function logonReportCompanyAction()
    {
        $accountId = $this->Request()->getParam('useraccountId');
        $successful = true;
        $account = null;
        $errors = null;
        $reportCompaniesData = null;
        $productsNotAvailable = null;

        if (!is_null($accountId) && strcmp('', $accountId) != 0) {
            $account = $this->getAccountRepository()->find($accountId);
        } else {
            $errors = 'null-account';
        }

        if (!is_null($account)) {
            $rawResponseXml = $this->performLogon($account);
            $successful = $this->processReportCompaniesData($rawResponseXml, $reportCompaniesData);
            if (!$successful) {
                $errors = $this->processWSErrors($rawResponseXml);
            }
        }

        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $reportCompaniesData]);
    }

    public function logonReportPrivatePersonAction()
    {
        $accountId = $this->Request()->getParam('useraccountId');
        $successful = true;
        $account = null;
        $errors = null;
        $reportData = null;
        $productsNotAvailable = null;

        if (!is_null($accountId) && strcmp('', $accountId) != 0) {
            $account = $this->getAccountRepository()->find($accountId);
        } else {
            $errors = 'null-account';
        }

        if (!is_null($account)) {
            $rawResponseXml = $this->performLogon($account);
            $successful = $this->processReportPrivatePersonData($rawResponseXml, $reportData);
            if (!$successful) {
                $errors = $this->processWSErrors($rawResponseXml);
            }
        }

        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $reportData]);
    }

    public function logonInkassoAction()
    {
        $accountId = $this->Request()->getParam('useraccountId');
        $successful = true;
        $account = null;
        $errors = null;
        $inkassoData = null;

        if (!is_null($accountId) && strcmp('', $accountId) != 0) {
            $account = $this->getAccountRepository()->find($accountId);
        } else {
            $errors = 'null-account';
        }

        if (!is_null($account)) {
            $rawResponseXml = $this->performLogon($account);
            $successful = $this->processInkassoData($rawResponseXml, $inkassoData);
            if (!$successful) {
                $errors = $this->processWSErrors($rawResponseXml);
            }
        }

        $this->View()->assign(['success' => $successful, 'errors' => $errors, 'data' => $inkassoData]);
    }

    public function getInUseAccountsAction()
    {
        $data = [];
        $configReportCompanies = $this->getReportCompanyRepository()->getReportCompanyConfigQueryBuilder()->getQuery()->getArrayResult();
        if (!empty($configReportCompanies)) {
            $data[] = [
                'id' => $configReportCompanies[0]['useraccountId'],
                'serviceCallee' => \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig::class
            ];
        }
        $configReportPrivatePersonId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
        /**
         * @var PrivatePersonConfig $configReportPrivatePerson
         */
        $configReportPrivatePerson = $this->getReportPrivatePersonRepository()->findCrefoObject(PrivatePersonConfig::class,
            $configReportPrivatePersonId);
        if (!is_null($configReportPrivatePerson->getUserAccountId())) {
            $data[] = [
                'id' => $configReportPrivatePerson->getUserAccountId()->getId(),
                'serviceCallee' => PrivatePersonConfig::class
            ];
        }
        $configInkasso = $this->getInkassoConfigRepository()->getInkassoConfigQueryBuilder()->getQuery()->getArrayResult();
        if (!empty($configInkasso)) {
            $data[] = [
                'id' => $configInkasso[0]['inkasso_user_account'],
                'serviceCallee' => \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig::class
            ];
        }
        $this->View()->assign([
            'success' => true,
            'data' => $data,
            'total' => count($data)
        ]);
    }

    public function getReportCompaniesProductConfigAction()
    {
        /**
         * @var \CrefoShopwarePlugIn\CrefoShopwarePlugIn $bootstrap
         */
        $bootstrap = CrefoCrossCuttingComponent::getCreditreformPlugin();
        $configClassName = \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig::class;
        $configIdReportCompanies = $bootstrap->getConfigurationId($configClassName);

        $query = $this->getReportCompanyRepository()->getCrefoProductsConfigQuery($configIdReportCompanies);

        $configProducts = $query->getArrayResult();

        $this->View()->assign([
            'success' => true,
            'data' => $configProducts
        ]);
    }

    public function getAllowedBonimaProductsAction()
    {
        $buildAllowedProducts = [];
        foreach (PrivatePersonProductsType::AllowedProducts() as $key => $product) {
            $buildAllowedProducts[] = ['id' => $key, 'keyWS' => $product];
        }
        $this->View()->assign([
            'success' => true,
            'data' => $buildAllowedProducts
        ]);
    }

    public function getReportPrivatePersonProductsAction()
    {
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
        /**
         * @var PrivatePersonConfig $privatePersonConfig
         */
        $privatePersonConfig = $this->getReportPrivatePersonRepository()->findCrefoObject(PrivatePersonConfig::class,
            $configId);
        $products = [];
        if (!empty($privatePersonConfig->getProducts()->toArray())) {
            $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
            $tempArray = $privatePersonConfig->getProducts()->toArray();
            /**
             * @var ProductsPrivatePerson $product
             */
            foreach ($tempArray as $product) {
                $productArray = $shopwareModels->toArray($product);
                $productArray['configId'] = $product->getConfigId()->getId();
                $products[] = $productArray;
            }
        }
        $this->View()->assign([
            'success' => true,
            'data' => $products
        ]);
    }

    public function updateReportPrivatePersonProductsAction()
    {
        $params = $this->Request()->getParams();
        $success = true;
        $this->getProductsPrivatePersonRepository()->updateAvailabilityForProducts(boolval($params['isProductAvailable']),
            intval($params['productKeyWS']));
        $this->View()->assign(['success' => $success]);
    }

    public function saveReportCompaniesAction()
    {
        $params = $this->Request()->getParams();
        $success = true;
        /**
         * @var \CrefoShopwarePlugIn\CrefoShopwarePlugIn $bootstrap
         */
        $bootstrap = CrefoCrossCuttingComponent::getCreditreformPlugin();
        $configClassName = \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig::class;
        $configIdReportCompanies = $bootstrap->getConfigurationId($configClassName);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig $reportCompanyConfigObj
         */
        $reportCompanyConfigObj = $this->getReportCompanyRepository()->findCrefoObject($configClassName,
            $configIdReportCompanies);

        if (strcmp($params['useraccountId'], '') == 0) {
            $reportCompanyConfigObj->setLegitimateKey(null);
            $reportCompanyConfigObj->setReportLanguageKey(null);
            $reportCompanyConfigObj->setUserAccountId(null);
        } else {
            $reportCompanyConfigObj->setLegitimateKey(strval($params['legitimateKey']));
            $reportCompanyConfigObj->setReportLanguageKey(strval($params['reportLanguageKey']));
            $reportCompanyConfigObj->setUserAccountId($this->getAccountRepository()->find(intval($params['useraccountId'])));
        }
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $shopwareModels->persist($reportCompanyConfigObj);
        $shopwareModels->flush();


        //save products configuration: first remove old config and save from scratch new config
        $query = $this->getReportCompanyRepository()->getCrefoProductsConfigQuery($configIdReportCompanies);
        $arrayConfigProducts = $query->getArrayResult();
        if (!empty($arrayConfigProducts)) {
            $this->removeConfigProducts($arrayConfigProducts);
        }
        if (strcmp($params['useraccountId'], '') != 0) {
            $success = $this->addConfigProductsFromParameters($params, $configIdReportCompanies);
        }

        $this->View()->assign(['success' => $success]);
    }

    public function saveReportPrivatePersonAction()
    {
        $params = $this->Request()->getParams();
        $success = true;

        try {
            $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
            /**
             * @var PrivatePersonConfig $reportPrivatePerson
             */
            $reportPrivatePerson = $this->getReportCompanyRepository()->findCrefoObject(PrivatePersonConfig::class,
                $configId);

            if (strcmp($params['privatePersonUserAccountId'], '') == 0) {
                $reportPrivatePerson->setLegitimateKey(null);
                $reportPrivatePerson->setSelectedProductKey(null);
                $reportPrivatePerson->setUserAccountId(null);
                $reportPrivatePerson->setThresholdMax(null);
                $reportPrivatePerson->setThresholdMin(null);
            } else {
                $reportPrivatePerson->setLegitimateKey(strval($params['legitimateKeyPrivatePerson']));
                $reportPrivatePerson->setSelectedProductKey(intval($params['selectedProductKey']));
                $thresholdMax = is_null($params['thresholdMax']) || $params['thresholdMax'] === '' ? null : floatval($params['thresholdMax']);
                $reportPrivatePerson->setThresholdMax($thresholdMax);
                $reportPrivatePerson->setThresholdMin(floatval($params['thresholdMin']));
                /**
                 * @var CrefoAccount $account
                 */
                $account = $this->getAccountRepository()->find(intval($params['privatePersonUserAccountId']));
                $reportPrivatePerson->setUserAccountId($account);
            }
            $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
            $shopwareModels->persist($reportPrivatePerson);
            if (!is_null($reportPrivatePerson->getSelectedProductKey())) {
                if ($reportPrivatePerson->getSelectedProductKey() === PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT) {
                    $products = $this->getProductsPrivatePersonRepository()->findBy([
                        'productKeyWS' => PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT
                    ], ['id' => 'ASC']);
                    if (empty($products)) {
                        $this->truncateTable($shopwareModels, ProductsPrivatePerson::class);
                        for ($i = IdentificationResultType::IDENTIFIED; $i < IdentificationResultType::UNIDENTIFIED + 1; $i++) {
                            $fromId = 'ident_from_' . $i;
                            $toId = 'ident_to_' . $i;
                            $fromScoreBonima = is_null($params[$fromId]) || $params[$fromId] === '' ? null : intval($params[$fromId]);
                            $toScoreBonima = is_null($params[$toId]) || $params[$toId] === '' ? null : intval($params[$toId]);
                            $bonimaProduct = $this->createBonimaScorePoolIdentProduct($reportPrivatePerson, $i,
                                $fromScoreBonima, $toScoreBonima);
                            $shopwareModels->persist($bonimaProduct);
                        }
                    } else {
                        $this->setExistingProducts($products, $reportPrivatePerson, $params);
                    }
                } elseif ($reportPrivatePerson->getSelectedProductKey() === PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT_PREMIUM) {
                    $products = $this->getProductsPrivatePersonRepository()->findBy([
                        'productKeyWS' => PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT_PREMIUM
                    ], ['id' => 'ASC']);
                    if (empty($products)) {
                        $this->truncateTable($shopwareModels, ProductsPrivatePerson::class);
                        for ($i = IdentificationResultType::PERSON_IDENTIFIED; $i < IdentificationResultType::PERSON_UNIDENTIFIED + 1; $i++) {
                            $fromId = 'ident_from_' . $i;
                            $toId = 'ident_to_' . $i;
                            $fromScoreBonima = is_null($params[$fromId]) || $params[$fromId] === '' ? null : intval($params[$fromId]);
                            $toScoreBonima = is_null($params[$toId]) || $params[$toId] === '' ? null : intval($params[$toId]);
                            $bonimaProduct = $this->createBonimaScorePoolIdentPremiumProduct($reportPrivatePerson, $i,
                                $fromScoreBonima, $toScoreBonima);
                            $shopwareModels->persist($bonimaProduct);
                        }
                    } else {
                        $this->setExistingProducts($products, $reportPrivatePerson, $params);
                    }
                }
            } else {
                $this->truncateTable($shopwareModels, ProductsPrivatePerson::class);
            }
            $shopwareModels->flush();
        } catch (\Exception $e) {
            $success = false;
        }
        $this->View()->assign(['success' => $success]);
    }

    public function saveInkassoConfigAction()
    {
        $params = $this->Request()->getParams();
        $success = true;
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig $inkassoConfig
         */
        $inkassoConfig = $this->getInkassoConfigRepository()->findCrefoObject(\CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig::class,
            $configId);

        if (strcmp($params['inkasso_user_account'], '') == 0) {
            $inkassoConfig->setCreditor(null);
            $inkassoConfig->setCustomerReference(null);
            $inkassoConfig->setDueDate(0);
            $inkassoConfig->setInterestRateRadio(1);
            $inkassoConfig->setInterestRateValue(null);
            $inkassoConfig->setOrderType(null);
            $inkassoConfig->setReceivableReason(null);
            $inkassoConfig->setTurnoverType(null);
            $inkassoConfig->setValutaDate(0);
            $inkassoConfig->setUserAccountId(null);
        } else {
            if (array_key_exists('inkasso_creditor', $params) && $params['inkasso_creditor'] !== '') {
                $inkassoConfig->setCreditor(intval($params['inkasso_creditor']));
            } else {
                $inkassoConfig->setCreditor(null);
            }
            if (array_key_exists('inkasso_customer_reference', $params)) {
                $inkassoConfig->setCustomerReference(intval($params['inkasso_customer_reference']));
            } else {
                $inkassoConfig->setCustomerReference(null);
            }
            if (!array_key_exists('inkasso_due_date', $params)) {
                $inkassoConfig->setDueDate(0);
            } else {
                $inkassoConfig->setDueDate(intval($params['inkasso_due_date']));
            }
            if (!array_key_exists('inkasso_valuta_date', $params)) {
                $inkassoConfig->setValutaDate(0);
            } else {
                $inkassoConfig->setValutaDate(intval($params['inkasso_valuta_date']));
            }
            if (array_key_exists('inkasso_interest_rate_radio', $params)) {
                $inkassoConfig->setInterestRateRadio(intval($params['inkasso_interest_rate_radio']));
            } else {
                $inkassoConfig->setInterestRateRadio(null);
            }
            if (array_key_exists('inkasso_interest_rate_value', $params)) {
                $inkassoConfig->setInterestRateValue(floatval($params['inkasso_interest_rate_value']));
            } else {
                $inkassoConfig->setInterestRateValue(null);
            }
            if (array_key_exists('inkasso_order_type', $params)) {
                $inkassoConfig->setOrderType(strval($params['inkasso_order_type']));
            } else {
                $inkassoConfig->setOrderType(null);
            }
            if (array_key_exists('inkasso_receivable_reason', $params)) {
                $inkassoConfig->setReceivableReason(strval($params['inkasso_receivable_reason']));
            } else {
                $inkassoConfig->setReceivableReason(null);
            }
            if (array_key_exists('inkasso_turnover_type', $params)) {
                $inkassoConfig->setTurnoverType(strval($params['inkasso_turnover_type']));
            } else {
                $inkassoConfig->setTurnoverType(null);
            }
            $inkassoConfig->setUserAccountId($this->getAccountRepository()->find(intval($params['inkasso_user_account'])));
        }
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $shopwareModels->persist($inkassoConfig);
        $shopwareModels->flush();


        $this->View()->assign(['success' => $success]);
    }

    public function saveInkassoWSValuesAction()
    {
        $params = $this->Request()->getParams();
        $success = true;
        $entries = json_decode($params['inkasso_values']);
        foreach ($entries as $entry) {
            $inkassoValue = new \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoWSValues();
            $inkassoValue->setKeyWS($entry->keyWS);
            $inkassoValue->setTextWS($entry->textWS);
            $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
            $shopwareModels->persist($inkassoValue);
            $shopwareModels->flush();
        }

        $this->View()->assign(['success' => $success]);
    }

    public function saveInkassoCreditorsAction()
    {
        $params = $this->Request()->getParams();
        $success = true;
        $entries = json_decode($params['inkasso_creditors']);
        foreach ($entries as $entry) {
            if ($entry->id === 0) {
                continue;
            }
            $inkassoCreditor = new \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoCreditors();
            $inkassoCreditor->setAddress($entry->address);
            $inkassoCreditor->setName($entry->name);
            $inkassoCreditor->setUseraccount($entry->useraccount);
            $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
            $shopwareModels->persist($inkassoCreditor);
            $shopwareModels->flush();
        }

        $this->View()->assign(['success' => $success]);
    }

    /**
     * @param $productsToBeRemoved
     */
    protected function removeConfigProducts($productsToBeRemoved)
    {
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        foreach ($productsToBeRemoved as $removeProduct) {
            $object = $this->getReportCompanyRepository()->findCrefoObject(\CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig::class,
                $removeProduct['id']);
            $shopwareModels->remove($object);
            $shopwareModels->flush();
        }
    }

    /**
     * @param $params
     * @param $configId
     * @return bool
     */
    protected function addConfigProductsFromParameters($params, $configId)
    {
        $countries = ["de", "at", "lu"];
        for ($i = 0; $i < 12; $i++) {
            $this->addProductConfig($params, $countries[intval($i / 4)], $configId, $i + 1);
        }
        return true;
    }

    /**
     * @param $params
     * @param $land
     * @param $configId
     * @param $sequence
     */
    protected function addProductConfig($params, $land, $configId, $sequence)
    {
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $basket = $params[$land . '-' . $sequence . '-value'];
        $thresholdIndex = $params[$land . '-' . $sequence . '-value-index'];
        $productType = $params[$land . '-' . $sequence . '-product'];
        $productRaw = $params[$land . '-' . $sequence . '-rawProduct'];
        $hasSolvencyIndex = strcmp($params[$land . '-' . $sequence . '-solvencyIndex'], 'true') === 0;
        if ((is_null($productType) || is_null($basket) || empty($productType) || empty($basket)) && !is_numeric($basket)) {
            return;
        }
        $object = new ProductsConfig();
        $object->setProductKeyWS($productType);
        if (is_null($productRaw)) {
            $object->setProductTextWS(null);
        } else {
            $object->setProductTextWS($productRaw);
        }
        $object->setLand($land);
        $object->setThreshold(floatval($basket));
        if (!is_null($thresholdIndex) && !empty($thresholdIndex) && is_numeric($thresholdIndex) && $hasSolvencyIndex) {
            $object->setThresholdIndex($thresholdIndex);
        } else {
            $object->setThresholdIndex(null);
        }
        $object->setConfigId($configId);
        $object->setSequence($sequence);
        $object->setSolvencyIndexWS($hasSolvencyIndex);
        $shopwareModels->persist($object);
        $shopwareModels->flush();
    }


    /**
     * @param null|\CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
     * @return mixed
     */
    protected function performLogon($account = null)
    {
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        /**
         * @var  \CrefoShopwarePlugIn\Components\API\Request\LogonRequest $crefoLogon
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
        if (is_null($account)) {
            $accountArray = null;
        } else {
            $accountArray = [
                'userAccount' => $account->getUserAccount(),
                'generalPassword' => $passwordEncoder->decrypt($account->getGeneralPassword(),
                    $config->getEncryptionKey()),
                'individualPassword' => $passwordEncoder->decrypt($account->getIndividualPassword(),
                    $config->getEncryptionKey())
            ];
        }
        $crefoLogon->setHeaderAccount($accountArray);
        $result = null;
        try {
            $result = $crefoLogon->performLogon();
            $crefoLogon->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoLogon->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\SoapFault $fault) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==performLogon>>SoapFault " . date("Y-m-d H:i:s") . "==",
                (array)$fault);
            $result = $fault;
            $crefoLogon->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoLogon->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performLogon>>CrefoCommunicationException " . date("Y-m-d H:i:s") . "==", (array)$e);
            $result = new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException($snippets->get('crefo/messages/error_in_communication'),
                $e->getCode());
            $crefoLogon->getCrefoParser()->setRawResponse($e);
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($crefoLogon, $xmlText,
                CrefoCrossCuttingComponent::ERROR);
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==performLogon>>Exception " . date("Y-m-d H:i:s") . "==", (array)$e);
            $result = new \Exception($snippets->get('crefo/validation/generalError'), $e->getCode());
            $dateProcessEnd = new \DateTime('now');
            CrefoCrossCuttingComponent::saveCrefoLogs([
                'log_status' => \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType::NOT_SAVED,
                'ts_response' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'tsProcessEnd' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'requestXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'requestXMLDescription' => CrefoCrossCuttingComponent::ERROR,
                'responseXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'responseXMLDescription' => CrefoCrossCuttingComponent::ERROR
            ]);
        }
        return $result;
    }

    /**
     * @param $rawResponse
     * @param null $reportCompaniesData
     * @return bool
     */
    private function processReportCompaniesData($rawResponse, &$reportCompaniesData = null)
    {
        $reportCompaniesData = ['reportLanguages' => [], 'legitimateInterests' => [], 'products' => []];
        if (is_soap_fault($rawResponse) || ($rawResponse instanceof \Exception)) {
            $successfulDataProcessed = false;
        } else {
            $successfulDataProcessed = true;
            /**
             * @var \CrefoShopwarePlugIn\Components\Soap\Parsers\ReportCompaniesParser $parser
             */
            $parser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.report_companies_config_parser');
            $parser->setRawResponse($rawResponse);
            $reportCompaniesData['reportLanguages'] = $parser->extractKeysAndValuesFromWS("identificationreport",
                "reportlanguage", $reportCompaniesData['reportLanguages']);
            $reportCompaniesData['legitimateInterests'] = $parser->extractKeysAndValuesFromWS("identificationreport",
                "legitimateinterest", $reportCompaniesData['legitimateInterests']);
            $reportCompaniesData['products'] = $parser->extractProducts();
        }
        return $successfulDataProcessed;
    }

    /**
     * @param $rawResponse
     * @param null $reportData
     * @return bool
     */
    private function processReportPrivatePersonData($rawResponse, &$reportData = null)
    {
        $reportData = ['legitimateInterests' => [], 'products' => []];
        if (is_soap_fault($rawResponse) || ($rawResponse instanceof \Exception)) {
            $successfulDataProcessed = false;
        } else {
            $successfulDataProcessed = true;
            /**
             * @var \CrefoShopwarePlugIn\Components\Soap\Parsers\ReportPrivatePersonParser $parser
             */
            $parser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.report_private_person_parser');
            $parser->setRawResponse($rawResponse);
            $reportData['legitimateInterests'] = $parser->extractKeysAndValuesFromWS("bonimareport",
                "legitimateinterest", $reportData['legitimateInterests']);
            $reportData['products'] = $parser->extractProducts();
        }
        return $successfulDataProcessed;
    }

    /**
     * @param $rawResponse
     * @param null $inkassoData
     * @return bool
     */
    private function processInkassoData($rawResponse, &$inkassoData = null)
    {
        $inkassoData = ['data' => [], 'creditors' => []];
        if (is_soap_fault($rawResponse) || ($rawResponse instanceof \Exception)) {
            $successfulDataProcessed = false;
        } else {
            $successfulDataProcessed = true;
            /**
             * @var \CrefoShopwarePlugIn\Components\Soap\Parsers\CollectionParser $parser
             */
            $parser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.collection_config_parser');
            $parser->setRawResponse($rawResponse);
            $creditorsFromWS = $parser->extractCreditorFromWS();
            if (!empty($creditorsFromWS)) {
                $inkassoData['creditors'] = array_merge([
                    0 => [
                        'id' => 0,
                        'useraccount' => '',
                        'name' => '',
                        'address' => ''
                    ]
                ], $creditorsFromWS);
            } else {
                $inkassoData['creditors'] = [];
            }
            $inkassoData['data'] = $parser->extractKeysAndValuesFromWS("collectionorder", "collectionordertype",
                $inkassoData['data']);
            $inkassoData['data'] = $parser->extractKeysAndValuesFromWS("collectionorder",
                "partreceivable/collectionturnovertype", $inkassoData['data']);
            $inkassoData['data'] = $parser->extractKeysAndValuesFromWS("collectionorder",
                "partreceivable/receivablereason", $inkassoData['data']);
        }
        return $successfulDataProcessed;
    }

    /**
     * @param $rawResponse
     * @return bool
     */
    private function isWSRequestSuccessful($rawResponse)
    {
        return !is_null($rawResponse)
            && !($rawResponse instanceof \Exception)
            && !is_soap_fault($rawResponse)
            && !($rawResponse instanceof \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException);
    }

    /**
     * @param $params
     * @return CrefoAccount
     */
    private function createAccountFromParameters($params)
    {
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
     * @param string $useraccount
     * @return CrefoAccount
     */
    private function createAccountFromDB($useraccount)
    {
        $account = new CrefoAccount();
        $dbAccount = $this->getAccountRepository()->getAccountWithNumber($useraccount);
        $account->setAccountFromQuery($dbAccount);
        return $account;
    }

    /**
     * @param null|\CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $account
     * @param $newPass
     * @return mixed
     */
    private function changePassword($account, $newPass)
    {
        $snippets = CrefoCrossCuttingComponent::getShopwareInstance()->Snippets()->getNamespace('backend/creditreform/translation');
        /**
         * @var  \CrefoShopwarePlugIn\Components\API\Request\ChangePasswordRequest $crefoChangePassword
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
                $config->getEncryptionKey())
        ];
        $crefoChangePassword->setHeaderAccount($accountArray);
        $crefoChangePassword->setNewPassword($newPass);
        $result = null;
        try {
            $result = $crefoChangePassword->changePassword();
            $crefoChangePassword->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoChangePassword->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\SoapFault $fault) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==changePassword>>SoapFault " . date("Y-m-d H:i:s") . "==",
                (array)$fault);
            $result = $fault;
            $crefoChangePassword->getCrefoParser()->setRawResponse($result);
            CrefoCrossCuttingComponent::saveCrefoLogs($crefoChangePassword->handleSoapResponse(CrefoCrossCuttingComponent::DATE_FORMAT));
        } catch (\CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==changePassword>>CrefoCommunicationException " . date("Y-m-d H:i:s") . "==", (array)$e);
            $result = new \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException($snippets->get('crefo/messages/error_in_communication'),
                $e->getCode());
            $crefoChangePassword->getCrefoParser()->setRawResponse($e);
            $xmlText = '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/messages/error_in_communication') . '</Error>';
            CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog($crefoChangePassword, $xmlText,
                CrefoCrossCuttingComponent::ERROR);
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==changePassword>>Exception " . date("Y-m-d H:i:s") . "==", (array)$e);
            $result = new \Exception($snippets->get('crefo/validation/generalError'), $e->getCode());
            $dateProcessEnd = new \DateTime('now');
            CrefoCrossCuttingComponent::saveCrefoLogs([
                'log_status' => \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType::NOT_SAVED,
                'ts_response' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'tsProcessEnd' => $dateProcessEnd->format(CrefoCrossCuttingComponent::DATE_FORMAT),
                'requestXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'requestXMLDescription' => CrefoCrossCuttingComponent::ERROR,
                'responseXML' => '<?xml version="1.0" encoding="UTF-8"?><Error>' . $snippets->get('crefo/validation/generalError') . '</Error>',
                'responseXMLDescription' => CrefoCrossCuttingComponent::ERROR
            ]);
        }
        return $result;
    }

    /**
     * @param $rawResponse
     * @return array
     * @throws Exception
     */
    private function processWSErrors($rawResponse)
    {
        /**
         * @var \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser $crefoParser
         */
        $crefoParser = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.soap_parser');
        $crefoParser->setRawResponse($rawResponse);
        return $crefoParser->getSoapErrors();
    }

    /**
     * @param PrivatePersonConfig $reportPrivatePerson
     * @param integer $ident
     * @param integer $from
     * @param integer $to
     * @return ProductsPrivatePerson
     */
    private function createBonimaScorePoolIdentProduct($reportPrivatePerson, $ident, $from, $to)
    {
        $product = new ProductsPrivatePerson();
        $product->setConfigId($reportPrivatePerson);
        $product->setAddressValidationResult(1);
        $product->setIdentificationResult($ident);
        $product->setVisualSequence($ident);
        $product->setProductAvailability(true);
        $product->setProductKeyWS(PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT);
        $product->setProductScoreFrom($from);
        $product->setProductScoreTo($to);
        return $product;
    }

    /**
     * @param PrivatePersonConfig $reportPrivatePerson
     * @param integer $ident
     * @param integer $from
     * @param integer $to
     * @return ProductsPrivatePerson
     */
    private function createBonimaScorePoolIdentPremiumProduct($reportPrivatePerson, $ident, $from, $to)
    {
        $product = new ProductsPrivatePerson();
        $product->setConfigId($reportPrivatePerson);
        $product->setAddressValidationResult(1);
        $product->setIdentificationResult($ident);
        $product->setVisualSequence($ident);
        $product->setProductAvailability(true);
        $product->setProductKeyWS(PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT_PREMIUM);
        $product->setProductScoreFrom($from);
        $product->setProductScoreTo($to);
        return $product;
    }

    /**
     * @param array $products
     * @param PrivatePersonConfig $reportPrivatePerson
     * @param array $params
     */
    private function setExistingProducts($products, $reportPrivatePerson, $params)
    {
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var ProductsPrivatePerson $product
         */
        foreach ($products as $product) {
            $fromId = 'ident_from_' . $product->getIdentificationResult();
            $toId = 'ident_to_' . $product->getIdentificationResult();
            $fromScoreBonima = is_null($params[$fromId]) || $params[$fromId] === '' ? null : intval($params[$fromId]);
            $toScoreBonima = is_null($params[$toId]) || $params[$toId] === '' ? null : intval($params[$toId]);
            $product->setProductScoreFrom($fromScoreBonima);
            $product->setProductScoreTo($toScoreBonima);
            $product->setProductAvailability(true);
            $product->setConfigId($reportPrivatePerson);
            $shopwareModels->persist($product);
        }
    }

    /**
     * @param \Shopware\Components\Model\ModelManager $em
     * @param string $class
     */
    private function truncateTable($em, $class)
    {
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
     * @return string
     */
    private function getEncryptionKey($passwordEncoder)
    {
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $this->getPluginSettingsRepository()->find($configId);
        $key = $settings->getEncryptionKey();
        if (is_null($key)) {
            $key = $passwordEncoder->generateKey();
            $settings->setEncryptionKey($key);
            CrefoCrossCuttingComponent::getShopwareInstance()->Models()->persist($settings);
            CrefoCrossCuttingComponent::getShopwareInstance()->Models()->flush();
        }
        return $key;
    }

    /**
     * @inheritdoc
     */
    public function getWhitelistedCSRFActions()
    {
        return [];
    }
}
