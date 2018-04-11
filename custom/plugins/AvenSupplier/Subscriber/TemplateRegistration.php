<?php

namespace AvenSupplier\Subscriber;

use AvenSupplier\Components\AvenSupplierDocument;
use Enlight\Event\SubscriberInterface;
use Enlight_Exception;
use Shopware\Components\Form\Interfaces\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Zend_Mime_Part;
use Zend_Mime;
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


    /**
     * @param \Enlight_Event_EventArgs $args
     * @throws Enlight_Exception
     * @throws \Exception
     */
    public function onSaveOrder(\Enlight_Event_EventArgs $args)
    {

            /** @var \Enlight_Controller_Action $controller */
           $controller = $args->get('subject');

           $ordernumber = $controller->sOrderNumber;
           $paymentId = $controller->sUserData['additional']['payment']['id'];
           if ($paymentId !== 7) {
//               $sql_order = "SELECT id from s_order WHERE ordernumber = ?";
//               $orderId = (int) Shopware()->Db()->fetchOne($sql_order, array($ordernumber));
               $orderId = $args->get('orderId');
               $checkOrderDetail = Shopware()->Db()->fetchAll("SELECT * from s_order_documents WHERE orderID =?", array($orderId));
               if ($checkOrderDetail == false) {
                   $sql_attributes = "SELECT lieferant from s_articles_attributes WHERE articledetailsID = ?";
                   $article = $controller->sBasketData[content];
                   $supplierUsed = [];
                   for ($i = 0; $i < (count($article)); $i++) {
                       $articleId = $article[$i][additional_details][articleID];
                       if (!empty($articleId)) {
                           $articledetailsID = $article[$i][additional_details][articleDetailsID];
                           $supplierId = (int) Shopware()->Db()->fetchOne($sql_attributes, array($articledetailsID));
                           Shopware()->Db()->query("UPDATE s_articles_attributes SET articleID =? WHERE articledetailsID =?", [$articleId, articleDetailsID]);
                           $sql_updateattributes = "UPDATE s_articles_attributes SET lieferant =? WHERE articleID =?";
                           $sql_updateattrs = Shopware()->Db()->executeQuery($sql_updateattributes, array($supplierId, $articleId));

                           if (count($supplierUsed) == 0) {
                               $sql_supplier = "SELECT * from s_supplier where id = ?";
                               $this->_supp_email = Shopware()->Db()->fetchAll($sql_supplier, array($supplierId));
                               $this->_supp_email->index = $i;
                               $this->createDocument($orderId, 2, $this->_supp_email);
                               $supplierUsed[$i] = $supplierId;
                           } else {
                               $searchSupplier = array_search($supplierId, $supplierUsed);
                               if ($searchSupplier === false) {
                                   $sql_supplier = "SELECT * from s_supplier where id = ?";
                                   $this->_supp_email = Shopware()->Db()->fetchAll($sql_supplier, array($supplierId));
                                   $this->_supp_email->index = $i;
                                   $this->createDocument($orderId, 2, $this->_supp_email);
                                   $supplierUsed[$i] = $supplierId;
                               }
                           }
                       }
                   }
               }
           }
       }

    public function createDocument($orderID, $documentType,$supplier)
    {
        /** @var TYPE_NAME $document */
        $attachment = AvenSupplierDocument::createDocument($orderID, $documentType, $supplier);

        return $this->sendMail($this->_supp_email, $attachment, $orderID);
    }


    /**
     * @param int|string $orderId
     * @param int|string $typeId
     * @param string     $fileExtension
     *
     * @return string
     */
    private function getFileName($orderId, $typeId, $fileExtension = '.pdf')
    {

            return $this->getDefaultName($typeId) . $fileExtension;

    }

    /**
     * Gets the default name from the document template
     *
     * @param int|string $typeId
     *
     * @return bool|string
     */
    private function getDefaultName($typeId)
    {
        $sql_name = "SELECT name from s_core_documents where id = ?";
        $name = Shopware()->Db()->fetchAll($sql_name, array($typeId));
        return $name[0][name];
    }
    /**
     * Creates a attachment by a file path.
     *
     * @param string $filePath
     * @param string $fileName
     *
     * @return Zend_Mime_Part
     */
    private function createAttachment($filePath, $fileName)
    {
        $content = file_get_contents($filePath);
        $zendAttachment = new Zend_Mime_Part($content);
        $zendAttachment->type = 'application/pdf';
        $zendAttachment->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
        $zendAttachment->encoding = Zend_Mime::ENCODING_BASE64;
        $zendAttachment->filename = $fileName;
        return $zendAttachment;
    }


    /**
     * @param $supplierMail
     * @param $attachment
     * @param $orderID
     * @throws Enlight_Exception
     * @throws \Zend_Db_Adapter_Exception
     */
    public function sendMail($supplierMail, $attachment, $orderID){
        $context = $supplierMail;
        $hashNumber = $attachment->_documentHash;
        if($supplierMail[0][email]){
    $mail = Shopware()->TemplateMail()->createMail('sSUPPLIEREMAIL');
    $filePath = Shopware()->DocPath() . 'files/documents/' . $hashNumber . '.pdf';

    $fileName = $this->getFileName($orderID, '2');

    $attachments = $this->createAttachment($filePath, $fileName);
    $mail->addAttachment($attachments);
    $mail->addTo($supplierMail[0][email]);
    $mail->From = Shopware()->Config()->Mail;
    $mail->FromName = Shopware()->Config()->Mail;
    $mail->Body = $supplierMail[0][note];
    $mail->Subject = 'Lieferschein';
    $mail->send();
    }
        $this->addToNotes($orderID);
    }


    /**
     * @param $orderID
     */
    public function addToNotes($orderID){
        var_dump("in addto notes");
        $sql_orderDocuments = "Select a.ordernumber, b.docID, b.hash, a.id from s_order_documents as b
                                inner join s_order as a on a.id=b.orderID 
                                where b.orderID = ?";
        $documents = Shopware()->Db()->fetchAll($sql_orderDocuments, [$orderID]);
        foreach ($documents as $doc){
            var_dump($doc);
            $sql_insert = "INSERT INTO s_deliverynotes (orderID, documentID, hash, orderNumber) VALUES (".$doc[id].",".$doc[docID].",'".$doc[hash]."',".$doc[ordernumber].")";
            Shopware()->Db()->query($sql_insert);

        }

    }

}
