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

use \Doctrine\Common\Collections\ArrayCollection;
use \Enlight\Event\SubscriberInterface;
use \Shopware\Components\Theme\LessDefinition;
use \Shopware\Components\DependencyInjection\Container;

/**
 * Class Assets
 * @package CrefoShopwarePlugIn\Subscriber
 */
class Assets implements SubscriberInterface
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles',
            'Theme_Compiler_Collect_Plugin_Javascript' => 'addJsFiles'
        ];
    }

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Provide the file collection for less
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function addLessFiles()
    {
        $less = new LessDefinition(
            [],
            [
                $this->container->getParameter('creditreform.plugin_dir') . '/Resources/views/frontend/_public/src/less/all.less'
            ],
            __DIR__
        );

        return new ArrayCollection([$less]);
    }

    /**
     * Provide the file collection for js files
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function addJsFiles()
    {
        $jsFiles = [
            $this->container->getParameter('creditreform.plugin_dir') . '/Resources/views/frontend/_public/src/js/jquery.check-birth-date.js'
        ];
        return new ArrayCollection($jsFiles);
    }
}