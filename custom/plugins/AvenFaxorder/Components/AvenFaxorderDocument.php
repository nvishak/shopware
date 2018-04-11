<?php

namespace AvenFaxorder\Components;


class AvenFaxorderDocument
{

    const DOC_TYPE_INVOICE = 1;
    const DOC_TYPE_DELIVERYNOTE = 2;

    /**
     * @param $orderID
     * @param $documentType
     * @param $supplier
     * @return \Shopware_Components_Document
     */
    public static function createDocument($orderID, $documentType)
    {
        $currentDate = date("d.m.Y");
        $orderIdentifier = (int)$orderID;
        try {
            $document = \Shopware_Components_Document::initDocument($orderID,5,
                array(
                    //'netto'                   => false,
                    //'bid'                     => null,
                    //'voucher'                 => null,
                    'date'                    => $currentDate,
                    'delivery_date'           => $currentDate,
                    'shippingCostsAsPosition' => (int) $documentType !== self::DOC_TYPE_DELIVERYNOTE,
                    '_renderer'               => "pdf",
                    '_preview'                => false,
                    //'_previewForcePagebreak'  => null,
                    //'_previewSample'          => null,
                    //'docComment'              => null,
                    //'forceTaxCheck'           => false
                ));
            $document->render('pdf');
            return $document;
        } catch (\Enlight_Exception $e) {

        }

    }

}

