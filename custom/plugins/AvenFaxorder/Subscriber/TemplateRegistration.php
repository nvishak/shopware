<?php

namespace AvenFaxorder\Subscriber;

use AvenFaxorder\AvenFaxorder;
use Enlight\Event\SubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AvenFaxorder\Components\AvenFaxorderDocument;

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
            'Enlight_Controller_Action_PreDispatch' => 'onPreDispatch',
            'Shopware_Modules_Order_SaveOrder_ProcessDetails' => 'onSaveOrder',
        ];
    }

    /**
     *
     */
    public function onPreDispatch()
    {
        $this->templateManager->addTemplateDir($this->pluginDirectory . '/Resources/views');
    }

    public function onSaveOrder(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->get('subject');

        $session = $this->container->get('session');
        $UserId = $session->sUserId;
        $paymentId = $controller->sUserData['additional']['payment']['id'];

        $logger = Shopware()->Container()->get('pluginlogger');
        $logger->info('paymentID',[$paymentId]);

        if ($paymentId == 7) {
            $ordernumber = $controller->sOrderNumber;
            $sql_setStatus = "UPDATE s_order SET status=? WHERE ordernumber=?";
//            $sql_order = "SELECT id from s_order WHERE ordernumber = ?";
//            $orderId = (int)Shopware()->Db()->fetchOne($sql_order, array($ordernumber));
            $orderId = (int) $args->get('orderId');
            Shopware()->Db()->query($sql_setStatus, [37, $ordernumber]);
            $sql_lastid = 'select max(id) from s_faxorder where custID = ?';
            $last_id = (int) Shopware()->Db()->fetchOne($sql_lastid, [$UserId]);
            $sql_updateId = 'UPDATE s_faxorder SET orderID=?, orderNumber=? WHERE id=?';
            Shopware()->Db()->query($sql_updateId, [$orderId, $ordernumber, $last_id]);
            $this->createDocument($orderId, 5);
        }
    }

    /**
     * @param $orderID
     * @param $documentType
     * @return exception|\Exception
     * @throws \AvenFaxorder\Components\Enlight_Exception
     */
    public function createDocument($orderID, $documentType)
    {

        try {
            /** @var TYPE_NAME $document */
            $attachment = AvenFaxorderDocument::createDocument($orderID, $documentType);

        }
        catch (exception $e)
        {
            return $e;
        }
    }

}
