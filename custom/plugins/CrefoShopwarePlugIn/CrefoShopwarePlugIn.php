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

namespace CrefoShopwarePlugIn;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';

use CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use CrefoShopwarePlugIn\Components\Core\Enums\PluginSettingsTypes;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use CrefoShopwarePlugIn\Components\Updater\PluginUpdater;
use CrefoShopwarePlugIn\Setup\Installer;
use Doctrine\ORM\Tools\SchemaTool;
use Shopware\Components\CacheManager;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\DeactivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @see https://developers.shopware.com/developers-guide/
 * @see https://developers.shopware.com/developers-guide/plugin-system/
 * Class CrefoShopwarePlugIn
 */
class CrefoShopwarePlugIn extends Plugin
{
    /**
     * @see https://developers.shopware.com/blog/2015/11/11/best-practices-of-shopware-plugin-development/#event-registration-and-callbacks
     * @see https://developers.shopware.com/developers-guide/event-guide/#subscribers
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Front_StartDispatch' => 'onStartDispatch',
            'Enlight_Controller_Action_PostDispatch_Backend_Index' => 'onPostDispatchBackendIndex',
            'Enlight_Controller_Action_PostDispatchSecure_Backend_PluginManager' => 'onPostDispatchSecureBackendPluginManager',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_CrefoConfiguration' => 'onGetCrefoConfigurationBackendController',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_CrefoOrders' => 'onGetCrefoOrdersBackendController',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_CrefoLogs' => 'onGetCrefoLogsBackendController',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_CrefoManagement' => 'onGetCrefoManagementBackendController',
            'Enlight_Controller_Dispatcher_ControllerPath_Frontend_CrefoInvoice' => 'onGetControllerPathFrontend',
            'Shopware_CronJob_DeleteCrefoLogs' => 'onDeleteCrefoLogs',
        ];
    }

    /**
     * @see https://developers.shopware.com/blog/2015/11/11/best-practices-of-shopware-plugin-development/
     * {@inheritdoc}
     */
    public function install(InstallContext $context)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==install plugin==', ['Begin installation!']);
        $this->registerNamespaces();
        $this->registerCrefoSnippets();
        /**
         * @var Installer $installer
         */
        $installer = new Installer($this->container, $this);
        $installer->install($context);
    }

    /**
     * {@inheritdoc}
     */
    public function update(UpdateContext $context)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==update==',
            ['Perform update version:' . $context->getCurrentVersion()]);
        /**
         * @var \Doctrine\DBAL\Connection $connection
         */
        $connection = $this->container->get('dbal_connection');
        $connection->beginTransaction();
        try {
            $crefoUpdater = new PluginUpdater($context->getCurrentVersion(), $context->getUpdateVersion(),
                    CrefoLogger::getCrefoLogger());
            $crefoUpdater->prepareUpdate(new CrefoCrossCuttingComponent());

            /** @var CacheManager $cache */
            $cache = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('shopware.cache_manager');
            $cache->clearProxyCache();
            $cache->clearOpCache();

            $this->updateSchema();
            $resultUpdate = $crefoUpdater->performUpdate();
            if ($resultUpdate !== 1) {
                throw new \Exception('Couldn\'t update Plugin.');
            }
            /**
             * @var \Shopware\Components\Snippet\DatabaseHandler $snippetHandler
             */
            $snippetHandler = $this->container->get('shopware.snippet_database_handler');
            $snippetHandler->removeFromDatabase($this->getPath() . '/Resources/snippets/', true);
            $snippetHandler->loadToDatabase($this->getPath() . '/Resources/snippets/', true);
            $connection->commit();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Update error==', (array) $e);
            $connection->rollBack();
            throw new \Exception($e->getMessage());
        } finally {
            $context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function activate(ActivateContext $context)
    {
        parent::activate($context);
    }

    /**
     * {@inheritdoc}
     */
    public function deactivate(DeactivateContext $context)
    {
        foreach ($context->getPlugin()->getPayments() as $payment) {
            if ($payment->getPlugin()->getId() === $context->getPlugin()->getId()) {
                $payment->setActive(false);
                $this->getEntityManager()->flush($payment);
            }
        }
        parent::deactivate($context);
    }

    /**
     * {@inheritdoc}
     */
    public function uninstall(UninstallContext $context)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==uninstall==', ['Perform uninstall & secure uninstall.']);
        try {
            $context->getPlugin()->setActive(false);
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==secure uninstall==',
                ['Perform secure uninstall (delete Payment, remove DB data).']);
            $this->registerCustomModels();
            $this->deleteTemplates();
            $this->deleteCrefoPayment($context);
            $this->getEntityManager()->flush();
            $this->removeSchema();
            $this->removeCron();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==uninstall error==',
                ['Error by uninstall:' . $e->getMessage()]);
        } finally {
            $context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
            parent::uninstall($context);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('creditreform.plugin_dir', $this->getPath());
        parent::build($container);
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function onGetCrefoOrdersBackendController(\Enlight_Event_EventArgs $args)
    {
        $this->crefoRegisters();

        return $this->getPath() . '/Controllers/Backend/CrefoOrders.php';
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function onGetCrefoLogsBackendController(\Enlight_Event_EventArgs $args)
    {
        $this->crefoRegisters();

        return $this->getPath() . '/Controllers/Backend/CrefoLogs.php';
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function onGetCrefoConfigurationBackendController(\Enlight_Event_EventArgs $args)
    {
        $this->crefoRegisters();

        return $this->getPath() . '/Controllers/Backend/CrefoConfiguration.php';
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function onGetCrefoManagementBackendController(\Enlight_Event_EventArgs $args)
    {
        $this->crefoRegisters();

        return $this->getPath() . '/Controllers/Backend/CrefoManagement.php';
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function onGetControllerPathFrontend(\Enlight_Event_EventArgs $args)
    {
        $this->crefoRegisters();

        return $this->getPath() . '/Controllers/Frontend/CrefoInvoice.php';
    }

    /**
     * @param \Shopware_Components_Cron_CronJob $job
     *
     * @return string
     */
    public function onDeleteCrefoLogs(\Shopware_Components_Cron_CronJob $job)
    {
        if ($this->clearCrefoLogs()) {
            return "Cleared CrefoLogs\n";
        }

        return "Didn't Clear Crefo Logs\n";
    }

    /**
     * @param \Enlight_Controller_EventArgs $args
     */
    public function onStartDispatch(\Enlight_Controller_EventArgs $args)
    {
        require_once $this->getPath() . '/autoload.php';
        $this->crefoRegisters();
    }

    /**
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function onPostDispatchBackendIndex(\Enlight_Controller_ActionEventArgs $args)
    {
        /** @var $action \Enlight_Controller_Action */
        $action = $args->getSubject();
        $view = $action->View();
        $request = $action->Request();
        $response = $action->Response();

        if (!$request->isDispatched()
            || $response->isException()
            || $request->getActionName() != 'index'
            || !$view->hasTemplate()
        ) {
            return;
        }
        $this->crefoRegisters();
        $view->extendsTemplate('backend/index/crefo_index.tpl');
    }

    /**
     * @param \Enlight_Controller_ActionEventArgs $args
     */
    public function onPostDispatchSecureBackendPluginManager(\Enlight_Controller_ActionEventArgs $args)
    {
        /**
         * @var \Enlight_Controller_Action $controller
         */
        $controller = $args->getSubject();
        $view = $controller->View();
        $request = $controller->Request();
        $response = $controller->Response();

        if (!$request->isDispatched()
            || $response->isException()
            || $request->getActionName() != 'load'
            || !$view->hasTemplate()
        ) {
            return;
        }

        $this->crefoRegisters();
        $view->extendsTemplate('backend/extend_plugin_manager/view/list/local_plugin_listing_page.js');
        $view->extendsTemplate('backend/extend_plugin_manager/view/detail/actions.js');
    }

    public function registerNamespaces()
    {
        $this->container->get('Loader')->registerNamespace(
            'CrefoShopwarePlugIn',
            $this->getPath() . '/'
        );
    }

    public function registerCustomModels()
    {
        $this->container->get('Loader')->registerNamespace(
            'CrefoShopwarePlugIn\Models',
            $this->getPath() . 'Models/'
        );
    }

    /**
     * Register models, templates, namespaces, snippets.
     */
    public function crefoRegisters()
    {
        // setting everything up
        $this->registerCrefoTemplateDir();
        $this->registerCustomModels();
        $this->registerNamespaces();
    }

    /**
     * @return array
     */
    public function getCrefoClassArray()
    {
        $em = $this->getEntityManager();

        return [
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\CountriesForCompanies'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductScoreConfig'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoWSValues'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoCreditors'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReports\CompanyReportResults'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoPayment\PaymentData'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrders'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal'),
            $em->getClassMetadata('CrefoShopwarePlugIn\Models\CrefoOrders\OrderListing'),
        ];
    }

    /**
     * @param \Doctrine\DBAL\Connection $connection
     * @param InstallContext            $context
     */
    public function rollbackInstallation($connection, $context)
    {
        $this->deleteTemplates();
        $this->deleteCrefoPayment($context);
        $this->removeSchema();
        $this->removeCron();
        $connection->rollBack();
    }

    /**
     * @param $className
     *
     * @return array|string id of the configuration
     */
    public function getConfigurationId($className)
    {
        $configuration = [
            \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig::class => '1',
            \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig::class => '1',
            \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class => '1',
            \CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoConfig::class => '1',
            \CrefoShopwarePlugIn\Models\CrefoErrorRequests\ErrorRequests::class => '1',
        ];
        if (array_key_exists($className, $configuration)) {
            return $configuration[$className];
        }

        return $configuration;
    }

    protected function registerCrefoTemplateDir()
    {
        $this->container->get('Template')->addTemplateDir(
            $this->getPath() . '/Resources/views/'
        );
    }

    protected function registerCrefoSnippets()
    {
        $this->container->get('snippets')->addConfigDir(
            $this->getPath() . '/Resources/snippets/'
        );
    }

    /**
     * @return bool
     */
    protected function clearCrefoLogs()
    {
        try {
            /**
             * @var \Doctrine\DBAL\Connection $connection
             */
            $connection = $this->container->get('dbal_connection');
            $sql = 'SELECT * FROM crefo_plugin_settings WHERE `id`=1;';
            $resultSettings = $connection->query($sql);
            $arraySettings = $resultSettings->fetchAll();
            $settings = $arraySettings[0];
            $intervalLogsDate = intval(PluginSettingsTypes::LogsMaxStorageTime()[$settings['logsMaxStorageTime']]);
            $logsMaxRequests = intval(PluginSettingsTypes::LogsMaxNumberRequests()[$settings['logsMaxNumberOfRequest']]);
            $sql = 'DELETE FROM crefo_logs WHERE `tsProcessEnd` < date_add(current_date, INTERVAL - ' . $intervalLogsDate . ' MONTH) AND `statusLogs`=' . LogStatusType::NOT_SAVED . ';';
            $connection->query($sql);
            $sql = 'UPDATE `crefo_logs` SET `statusLogs` = ' . LogStatusType::SAVE_AND_NOT_SHOW . ' WHERE `tsProcessEnd` < date_add(current_date, INTERVAL - ' . $intervalLogsDate . ' MONTH) AND `statusLogs`=' . LogStatusType::SAVE_AND_SHOW . ';';
            $connection->query($sql);
            /**
             * Limit with Offset, MAX Limit (as in Manual) = 18446744073709551615.
             *
             * @see http://dev.mysql.com/doc/refman/5.7/en/select.html
             */
            $sql = 'SELECT `id` FROM crefo_logs WHERE `statusLogs` = ' . LogStatusType::NOT_SAVED . ' ORDER BY `tsProcessEnd` DESC LIMIT ' . $logsMaxRequests . ',18446744073709551615';
            $result = $connection->query($sql);
            $logsToDelete = $result->fetchAll();
            foreach ($logsToDelete as $log) {
                $sql = 'DELETE FROM crefo_logs WHERE `id`=' . $log['id'] . ';';
                $connection->query($sql);
            }
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO,
                '==Done deleting the Crefo Logs using the Cron Job.==', ['Successful']);
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==Error by deleting the Crefo Logs using the Cron Job.==', [$e]);

            return false;
        }

        return true;
    }

    /**
     * @return object|\Shopware\Components\Model\ModelManager
     */
    protected function getEntityManager()
    {
        return $this->container->get('Models');
    }

    /**
     * Updates Schema from DB.
     */
    private function updateSchema()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==update schema==', ['Update DB schema.']);
        $tool = new SchemaTool($this->getEntityManager());
        $classes = $this->getCrefoClassArray();
        $tool->updateSchema($classes, true);
    }

    /**
     * Removes Schema from DB.
     */
    private function removeSchema()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==remove schema==', ['Remove DB schema.']);
        $tool = new SchemaTool($this->getEntityManager());
        $classes = $this->getCrefoClassArray();
        try {
            $tool->dropSchema($classes);
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==remove schema error==',
                ["Couldn't drop the Schema: " . $e->getMessage()]);
        }
    }

    /**
     * @param InstallContext $context
     */
    private function deleteCrefoPayment($context)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==delete CrefoPayment==', ['Delete Payment.']);
        $repository = $this->getEntityManager()->getRepository('Shopware\Models\Payment\Payment');
        $model = $repository->findOneBy([
            'pluginId' => $context->getPlugin()->getId(),
        ]);
        try {
            $context->getPlugin()->getPayments()->remove($model);
            $this->getEntityManager()->remove($model);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==delete CrefoPayment error==',
                ["Couldn't delete the Payment: " . $e->getMessage()]);
        }
    }

    /**
     * Deletes the templates in the db.
     */
    private function deleteTemplates()
    {
        /*
         * Delete EMail template
         */
        CrefoCrossCuttingComponent::getShopwareInstance()->Db()->delete('s_core_config_mails',
            ['name = ?' => 'sCREFOERRORREQUESTNOTIFICATIONDE']);
        CrefoCrossCuttingComponent::getShopwareInstance()->Db()->delete('s_core_config_mails',
            ['name = ?' => 'sCREFOERRORREQUESTNOTIFICATIONEN']);
    }

    /**
     * removes the cron from the cron table.
     */
    private function removeCron()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, '==remove cron==', ['Remove DB cron.']);
        /*
         * @var \Doctrine\DBAL\Connection $connection
         */
        $this->container->get('dbal_connection')->executeQuery('DELETE FROM s_crontab WHERE `name` = ?', [
            'CrefoLogs',
        ]);
    }
}
