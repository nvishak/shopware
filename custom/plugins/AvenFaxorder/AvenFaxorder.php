<?php

namespace AvenFaxorder;

use AvenFaxorder\Models\Faxquotes;
use Doctrine\ORM\Tools\SchemaTool;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Components\Model\ModelManager;
use AvenFaxorder\Models\Product;
use AvenFaxorder\Models\Orderdetails;

class AvenFaxorder extends Plugin
{
    /**
     * {@inheritdoc}
     */
    public function install(InstallContext $installContext)
    {
        $logger = Shopware()->Container()->get('pluginlogger');
        $logger->info('Inside install');
        $this->createDatabase();


        $service = $this->container->get('shopware_attribute.crud_service');
        //generates the database schema for the own entity SwagAttribute
        $em = $this->container->get('models');
        $schemaTool = new SchemaTool($em);
        $schemaTool->updateSchema(
            [ $em->getClassMetadata(Product::class), $em->getClassMetadata(Orderdetails::class), $em->getClassMetadata(Faxquotes::class)  ],
            true
        );
//        $this->addDemoData();
    }

    /**
     * {@inheritdoc}
     */
    public function activate(ActivateContext $activateContext)
    {
        $activateContext->scheduleClearCache(InstallContext::CACHE_LIST_ALL);
    }

    /**
     * {@inheritdoc}
     */
    public function uninstall(UninstallContext $uninstallContext)
    {
        if (!$uninstallContext->keepUserData()) {
            $this->removeDatabase();
        }
    }

    private function createDatabase()
    {
        $logger = Shopware()->Container()->get('pluginlogger');
        $modelManager = $this->container->get('models');

        $tool = new SchemaTool($modelManager);

        $classes = $this->getClasses($modelManager);
        $logger->info('classes', $classes);
        $tool->updateSchema($classes, true); // make sure to use the save mode
    }

    private function removeDatabase()
    {
        $modelManager = $this->container->get('models');
        $tool = new SchemaTool($modelManager);

        $classes = $this->getClasses($modelManager);

        $tool->dropSchema($classes);
    }

    /**
     * @param ModelManager $modelManager
     * @return array
     */
    private function getClasses(ModelManager $modelManager)
    {
        return [
            $modelManager->getClassMetadata(Product::class),
            $modelManager->getClassMetadata(Orderdetails::class),
            $modelManager->getClassMetadata(Faxquotes::class)
        ];
    }
}