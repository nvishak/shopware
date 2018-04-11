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

namespace CrefoShopwarePlugIn\Components\API\Body;

use \CrefoShopwarePlugIn\Components\Core\CrefoSanitization;
use \CrefoShopwarePlugIn\Components\Core\CrefoSanitizer;
use \CrefoShopwarePlugIn\Components\Core\CrefoValidator;
use \CrefoShopwarePlugIn\Components\API\Parts\IdentificationReportBodyTrait;

/**
 * Class IdentificationReportBody
 * @package CrefoShopwarePlugIn\Components\API\Body
 */
class IdentificationReportBody implements CrefoSanitization
{
    use IdentificationReportBodyTrait;

    private $crefoValidator;

    /**
     * IdentificationReportBody constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('Europe/Berlin');
        $this->crefoValidator = new CrefoValidator();
    }

    /**
     * @param $value
     */
    public function setPostcode($value)
    {
        $this->postcode = $this->crefoValidator->checkPostalCode($value, strtolower(substr($this->getCountry(), 0, 2)));
    }

    /**
     * @param $value
     */
    public function setVatid($value)
    {
        $this->vatid = preg_replace('/([^\d|^\w]+)/i', '', trim($value));
    }

    /**
     * @param string $address
     * @return array
     */
    public function validateAddress($address)
    {
        return $this->crefoValidator->computeRawAddress($address);
    }

    public function performSanitization()
    {
        $sanitizeObj = new CrefoSanitizer();
        $sourceArray = [
            "legit_int" => $this->getLegitimateInterest(),
            "rep_lang" => $this->getReportLanguage(),
            "prod_type" => $this->getProductType(),
            "threshIndex" => $this->getSolvencyIndexThreshold(),
            "cust_ref" => $this->getCustomerReference(),
            "company_name" => $this->getCompanyName(),
            "street" => $this->getStreet(),
            "housenr" => $this->getHouseNumber(),
            "houseafx" => $this->getHouseNumberAffix(),
            "postcode" => $this->getPostCode(),
            "city" => $this->getCity(),
            "country" => $this->getCountry(),
            "legalform" => $this->getLegalForm(),
            "website" => $this->getWebsite(),
            "register_type" => $this->getRegisterType(),
            "register_id" => $this->getRegisterId(),
            "vatid" => $this->getVatId(),
            "phone_nr" => $this->getPhonenumber(),
            "phone_dc" => $this->getDiallingcode()
        ];

        $sanitizeObj->addSource($sourceArray);
        $sanitizeObj->addRule('threshIndex', 'numeric', 3, true);
        $sanitizeObj->addRule('legit_int', 'string', 20, true);
        $sanitizeObj->addRule('rep_lang', 'string', 2, true);
        $sanitizeObj->addRule('prod_type', 'string', 20, true);
        $sanitizeObj->addRule('cust_ref', 'string', 32, true);
        $sanitizeObj->addRule('company_name', 'string', 90, true);
        $sanitizeObj->addRule('street', 'string', 30, true);
        $sanitizeObj->addRule('housenr', 'numeric', 5, true);
        $sanitizeObj->addRule('houseafx', 'string', 8, true);
        $sanitizeObj->addRule('postcode', 'string', 8, true);
        $sanitizeObj->addRule('city', 'string', 25, true);
        $sanitizeObj->addRule('country', 'string', 2, true);
        $sanitizeObj->addRule('legalform', 'string', 20, true);
        $sanitizeObj->addRule('website', 'string', 50, true);
        $sanitizeObj->addRule('register_type', 'string', 20, true);
        $sanitizeObj->addRule('register_id', 'string', 18, true);
        $sanitizeObj->addRule('vatid', 'string', 11, true);
        $sanitizeObj->addRule('phone_nr', 'string', 16, true);
        $sanitizeObj->addRule('phone_dc', 'string', 7, true);
        $sanitizeObj->run();
        $this->setSolvencyIndexThreshold($sanitizeObj->sanitized['threshIndex']);
        $this->setLegitimateInterest($sanitizeObj->sanitized['legit_int']);
        $this->setReportLanguage($sanitizeObj->sanitized['rep_lang']);
        $this->setProductType($sanitizeObj->sanitized['prod_type']);
        $this->setCustomerReference($sanitizeObj->sanitized['cust_ref']);
        $this->setCompanyName($sanitizeObj->sanitized['company_name']);
        $this->setStreet($sanitizeObj->sanitized['street']);
        $this->setHouseNumberAffix($sanitizeObj->sanitized['houseafx']);
        $this->setHouseNumber($sanitizeObj->sanitized['housenr']);
        $this->setPostcode($sanitizeObj->sanitized['postcode']);
        $this->setCity($sanitizeObj->sanitized['city']);
        $this->setCountry($sanitizeObj->sanitized['country']);
        $this->setLegalForm($sanitizeObj->sanitized['legalform']);
        $this->setWebsite($sanitizeObj->sanitized['website']);
        $this->setRegisterType($sanitizeObj->sanitized['register_type']);
        $this->setRegisterId($sanitizeObj->sanitized['register_id']);
        $this->setVatid($sanitizeObj->sanitized['vatid']);
        $this->setPhonenumber($sanitizeObj->sanitized['phone_nr']);
        $this->setDiallingcode($sanitizeObj->sanitized['phone_dc']);
    }
}