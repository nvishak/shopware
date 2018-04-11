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

namespace CrefoShopwarePlugIn\Components\API\Body;

use CrefoShopwarePlugIn\Components\API\Parts\AddressOne;
use CrefoShopwarePlugIn\Components\API\Parts\BonimaBodyTrait;
use CrefoShopwarePlugIn\Components\Core\CrefoSanitization;
use CrefoShopwarePlugIn\Components\Core\CrefoSanitizer;
use CrefoShopwarePlugIn\Components\Core\CrefoValidator;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class BonimaReportBody
 */
class BonimaReportBody implements RequestBody, CrefoSanitization
{
    use BonimaBodyTrait;

    private $crefoValidator;

    /**
     * IdentificationReportBody constructor.
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequestBody::construct==',
            ['create bonima report body']);
        date_default_timezone_set('Europe/Berlin');
        $this->crefoValidator = new CrefoValidator();
        $this->addressone = new AddressOne();
    }

    /**
     * should be checked only for DE
     *
     * @param $value
     */
    public function setPostcode($value)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequestBody::setPostcode==',
            ['set postcode', 'value' => $value]);
        if (isset($this->addressone) && null !== $this->addressone) {
            $this->addressone->setPostcode($this->crefoValidator->checkPostalCode($value));
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $address
     * @return array
     */
    public function validateAddress($address)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequestBody::validateAddress==',
            ['validate address', 'address' => $address]);

        return $this->crefoValidator->computeRawAddress($address);
    }

    /**
     * @codeCoverageIgnore
     */
    public function performSanitization()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequestBody::performSanitization==',
            ['perform sanitization']);
        $sanitizeObj = new CrefoSanitizer();
        $sourceArray = [
            'legitimate_interest' => $this->getLegitimateInterest(),
            'product_type' => $this->getProductType(),
            'street' => $this->getAddressOne()->getStreet(),
            'houseWithAffix' => $this->getAddressOne()->getHouseNumberWithAffix(),
            'postcode' => $this->getAddressOne()->getPostcode(),
            'city' => $this->getAddressOne()->getCity(),
            'country' => $this->getAddressOne()->getCountry(),
            'date_of_birth' => $this->getDateOfBirth(),
            'first_name' => $this->getFirstName(),
            'surname' => $this->getSurname(),
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
