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
use \CrefoShopwarePlugIn\Components\API\Parts\BonimaBodyTrait;
use \CrefoShopwarePlugIn\Components\API\Parts\AddressOne;

/**
 * Class BonimaReportBody
 * @package CrefoShopwarePlugIn\Components\API\Body
 */
class BonimaReportBody implements CrefoSanitization
{
    use BonimaBodyTrait;

    private $crefoValidator;

    /**
     * IdentificationReportBody constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('Europe/Berlin');
        $this->crefoValidator = new CrefoValidator();
        $this->addressone = new AddressOne();
    }

    /**
     * should be checked only for DE
     * @param $value
     */
    public function setPostcode($value)
    {
        if (isset($this->addressone) && !is_null($this->addressone)) {
            $this->addressone->setPostcode($this->crefoValidator->checkPostalCode($value));
        }
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
            "legitimate_interest" => $this->getLegitimateInterest(),
            "product_type" => $this->getProductType(),
            "street" => $this->getAddressOne()->getStreet(),
            "houseWithAffix" => $this->getAddressOne()->getHouseNumberWithAffix(),
            "postcode" => $this->getAddressOne()->getPostcode(),
            "city" => $this->getAddressOne()->getCity(),
            "country" => $this->getAddressOne()->getCountry(),
            "date_of_birth" => $this->getDateOfBirth(),
            "first_name" => $this->getFirstName(),
            "surname" => $this->getSurname()
        ];

        $sanitizeObj->addSource($sourceArray);
        $sanitizeObj->addRule('legitimate_interest', 'string', 20, true);
        $sanitizeObj->addRule('product_type', 'string', 20, true);
        $sanitizeObj->addRule('street', 'string', 46, true);
        $sanitizeObj->addRule('houseWithAffix', 'string', 10, true);
        $sanitizeObj->addRule('postcode', 'string', 5, true);
        $sanitizeObj->addRule('city', 'string', 40, true);
        $sanitizeObj->addRule('country', 'string', 2, true);
        $sanitizeObj->addRule('date_of_birth', 'string', 10, true);
        $sanitizeObj->addRule('first_name', 'string', 20, true);
        $sanitizeObj->addRule('surname', 'string', 30, true);
        $sanitizeObj->run();
        $this->setLegitimateInterest($sanitizeObj->sanitized['legitimate_interest']);
        $this->setProductType($sanitizeObj->sanitized['product_type']);
        $this->getAddressOne()->setStreet($sanitizeObj->sanitized['street']);
        $this->getAddressOne()->setHouseNumberWithAffix($sanitizeObj->sanitized['houseWithAffix']);
        $this->setPostcode($sanitizeObj->sanitized['postcode']);
        $this->getAddressOne()->setCity($sanitizeObj->sanitized['city']);
        $this->getAddressOne()->setCountry($sanitizeObj->sanitized['country']);
        $this->setDateOfBirth($sanitizeObj->sanitized['date_of_birth']);
        $this->setFirstName($sanitizeObj->sanitized['first_name']);
        $this->setSurname($sanitizeObj->sanitized['surname']);
    }
}