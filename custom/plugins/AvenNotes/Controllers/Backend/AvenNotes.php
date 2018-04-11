<?php

use AvenNotes\Models\Product;
use Shopware\Components\CSRFWhitelistAware;
use Shopware\Models\Order\Document;

class Shopware_Controllers_Backend_AvenNotes extends \Shopware_Controllers_Backend_Application implements CSRFWhitelistAware
{
    protected $model = Product::class;
    protected $alias = 'product';

    public function getWhitelistedCSRFActions()
    {
        return [
            'openOrder',
            'openPdf'
        ];
    }


    /**
     *
     */
    public function openOrderAction(){
        $id = $this->Request()->getParam('id');
//        $this->redirect();
        $this->forward(getList, "Order",null, [$id]);
    }
    /**
     * Calls the backend order controller and openpdf method in it to return the pdf
     *
     */
    public function openPdfAction()
    {
        $id = $this->Request()->getParam('id');
        $this->forward(openPdf, "Order",null, [$id]);
    }
}
