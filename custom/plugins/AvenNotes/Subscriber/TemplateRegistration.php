<?php

namespace AvenNotes\Subscriber;

use Enlight\Event\SubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TemplateRegistration implements SubscriberInterface 
{
    /**
     * @var string
     */
    private $pluginDirectory;

    /**
     * @var \Enlight_Template_Manager
     */
    private $templateManager;

    public $_orderId;

    public $_supp_email;


    /**
     * @var ContainerInterface
     */
    public $container;


    public $onSaveOrderFlag;


    const DOC_TYPE_DELIVERYNOTE = 2;


    /**
     * TemplateRegistration constructor.
     * @param $pluginDirectory
     * @param \Enlight_Template_Manager $templateManager
     * @param \Enlight_Controller_EventArgs $container
     */
    public function __construct(ContainerInterface  $container, $pluginDirectory, \Enlight_Template_Manager $templateManager)
    {
        $this->container = $container;
        $this->pluginDirectory = $pluginDirectory;
        $this->templateManager = $templateManager;
        $this->onSaveOrderFlag = true;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {

        return [
            'Enlight_Controller_Action_PreDispatch' => 'onPreDispatch'
        ];
    }

    /**
     *
     */
    public function onPreDispatch()
    {
        $this->templateManager->addTemplateDir($this->pluginDirectory . '/Resources/views');
    }



}
