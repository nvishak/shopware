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

namespace CrefoShopwarePlugIn\Components\Soap\Mappers;

use \CrefoShopwarePlugIn\Components\Soap\CrefoMapper;

/**
 * Class BonimaReportMapper
 * @package CrefoShopwarePlugIn\Components\Soap\Mappers
 */
class BonimaReportMapper extends CrefoMapper
{
    /**
     * CollectionOrderMapper constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    protected function getMappingArray()
    {
        $arrayParent = parent::getMappingArray();
        return array_merge($arrayParent, [
            'legitimateinterest' => 'legitimateinterest',
            'reportlanguage' => 'reportlanguage',
            'producttype' => 'producttype',
            'solvencyindexthreshold' => 'solvencyindexthreshold',
            'customerreference' => 'customerreference',
            'companyname' => 'companyname',
            'street' => 'street',
            'housenumber' => 'housenumber',
            'housenumberaffix' => 'housenumberaffix',
            'postcode' => 'postcode',
            'city' => 'city',
            'country' => 'country',
            'legalform' => 'legalform',
            'vatid' => 'vatid',
            'phone/diallingcode' => 'diallingcode',
            'phone/phonenumber' => 'phonenumber',
            'registertype' => 'registertype',
            'registerid' => 'registerid',
            'website' => 'website'
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function getLabelsMappingArray($lang = 'de')
    {
        $arrayParent = parent::getLabelsMappingArray($lang);
        $labelArray = [
            'de' => [
                'legitimateinterest' => 'Berechtigtes Interesse',
                'reportlanguage' => 'Auskunftssprache',
                'producttype' => 'Produktart',
                'solvencyindexthreshold' => 'Bonitätsindex-Schwellwert',
                'companyname' => 'Firma',
                'street' => 'Straße',
                'housenumber' => 'Hausnummer',
                'housenumberaffix' => 'Hausnummernzusatz',
                'postcode' => 'PLZ',
                'city' => 'Ort',
                'country' => 'Land',
                'vatid' => 'Umsatzsteuer-ID',
                'diallingcode' => 'Telefon',
                'phonenumber' => 'Telefon'
            ],
            'en' => [
                'legitimateinterest' => 'Legitimate Interest',
                'reportlanguage' => 'Report Language',
                'producttype' => 'Product Type',
                'solvencyindexthreshold' => 'Solvency Index Threshold',
                'companyname' => 'Company',
                'street' => 'Street',
                'housenumber' => 'House Number',
                'housenumberaffix' => 'House Number Affix',
                'postcode' => 'Post Code',
                'city' => 'City',
                'country' => 'Country',
                'vatid' => 'VAT ID',
                'diallingcode' => 'Phone',
                'phonenumber' => 'Phone'
            ]
        ];
        return array_merge($arrayParent, $labelArray[strtolower($lang)]);
    }


}