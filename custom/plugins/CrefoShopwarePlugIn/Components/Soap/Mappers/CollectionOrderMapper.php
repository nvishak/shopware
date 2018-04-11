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

namespace CrefoShopwarePlugIn\Components\Soap\Mappers;

use \CrefoShopwarePlugIn\Components\Soap\CrefoMapper;

/**
 * @codeCoverageIgnore
 * Class CollectionOrderMapper
 * @package CrefoShopwarePlugIn\Components\Soap\Mappers
 */
class CollectionOrderMapper extends CrefoMapper
{
    /**
     * @inheritdoc
     */
    protected function getMappingArray()
    {
        return [
            'useraccount' => 'useraccount',
            'companyname' => 'debtorCompany',
            'salutation' => 'debtorSalutation',
            'firstname' => 'debtorFirstName',
            'surname' => 'debtorLastName',
            'street' => 'debtorStreet',
            'housenumber' => 'debtorStreet',
            'housenumberaffix' => 'debtorStreet',
            'postcode' => 'debtorZipCode',
            'city' => 'debtorCity',
            'country' => 'debtorCountry',
            'email' => 'debtorEmail',
            'user' => 'creditor',
            'collectionordertype' => 'orderTypeKey',
            'legal' => 'inkasso_interest_rate_legal',
            'spread' => 'inkasso_interest_rate_variable_spread_text',
            'interestrate' => 'inkasso_interest_rate_fix_text',
            'customerreference' => 'customerReference',
            'remarks' => 'remarks',
            'collectionturnovertype' => 'turnoverTypeKey',
            'datecontract' => 'dateContract',
            'invoicenumber' => 'invoiceNumber',
            'receivablereason' => 'receivableReasonKey',
            'dateinvoice' => 'dateInvoice',
            'datevaluta' => 'valutaDate',
            'datedue' => 'dueDate',
            'amount' => 'amount',
            'currency' => 'currency'
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getLabelsMappingArray($lang = 'de')
    {
        $arrayParent = parent::getLabelsMappingArray($lang);
        $labelArray = [
            'de' => [
                'companyname' => 'Firma',
                'salutation' => 'Anrede',
                'firstname' => 'Vorname',
                'surname' => 'Nachname',
                'birthname' => 'Geburtsname',
                'dateofbirth' => 'Geburtstag',
                'street' => 'Straße',
                'housenumber' => 'Hausnummer',
                'housenumberaffix' => 'Hausnummernzusatz',
                'postcode' => 'PLZ',
                'city' => 'Ort',
                'country' => 'Land',
                'email' => 'Email-Adresse',
                'user' => 'Gläubiger',
                'collectionordertype' => 'Inkasso-Auftragsart',
                'legal' => 'Gesetzlicher Zinssatz',
                'spread' => 'Zins-Aufschlag',
                'interestrate' => 'Fester Zinssatz',
                'customerreference' => 'Geschäftszeichen',
                'remarks' => 'Anmerkungen',
                'collectionturnovertype' => 'Inkasso-Umsatzart',
                'datecontract' => 'Vertragsdatum',
                'invoicenumber' => 'Rechnungsnummer',
                'receivablereason' => 'Forderungsgrund',
                'dateinvoice' => 'Rechnungsdatum',
                'datevaluta' => 'Valuta-Datum',
                'datedue' => 'Fälligkeitsdatum',
                'amount' => 'Betrag',
                'currency' => 'Währung'
            ],
            'en' => [
                'companyname' => 'Company',
                'salutation' => 'Salutation',
                'firstname' => 'First Name',
                'surname' => 'Surname',
                'birthname' => 'Birth Name',
                'dateofbirth' => 'Date of Birth',
                'street' => 'Street',
                'housenumber' => 'House Number',
                'housenumberaffix' => 'House Number Affix',
                'postcode' => 'Post Code',
                'city' => 'City',
                'country' => 'Country',
                'email' => 'E-Mail Address',
                'user' => 'Creditor',
                'collectionordertype' => 'Collection Order Type',
                'legal' => 'Legal Interest Rate',
                'spread' => 'Variable Interest Spread',
                'interestrate' => 'Fixed Interest Rate',
                'customerreference' => 'Customer Reference',
                'remarks' => 'Remarks',
                'collectionturnovertype' => 'Collection Turnover Type',
                'datecontract' => 'Contract Date',
                'invoicenumber' => 'Invoice Number',
                'receivablereason' => 'Reveivable Reason',
                'dateinvoice' => 'Invoice Date',
                'datevaluta' => 'Valuta Date',
                'datedue' => 'Due Date',
                'amount' => 'Amount',
                'currency' => 'Currency'
            ]
        ];
        return array_merge($arrayParent, $labelArray[strtolower($lang)]);
    }
}