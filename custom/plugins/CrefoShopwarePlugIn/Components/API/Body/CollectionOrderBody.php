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

use CrefoShopwarePlugIn\Components\API\Parts\CollectionOrderBodyTrait;
use CrefoShopwarePlugIn\Components\API\Parts\Debtor;
use CrefoShopwarePlugIn\Components\API\Parts\PartReceivable;
use CrefoShopwarePlugIn\Components\API\Parts\Receivable;
use CrefoShopwarePlugIn\Components\Core\CrefoSanitization;
use CrefoShopwarePlugIn\Components\Core\CrefoSanitizer;
use CrefoShopwarePlugIn\Components\Core\CrefoValidator;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * @codeCoverageIgnore
 * Class CollectionOrderBody
 */
class CollectionOrderBody implements RequestBody, CrefoSanitization
{
    use CollectionOrderBodyTrait;

    const SPREAD = 2;
    const INTEREST_RATE = 3;

    private $crefoValidator;

    /**
     * CollectionOrderBody constructor.
     */
    public function __construct()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequestBody::construct==',
            ['create collection order body']);
        date_default_timezone_set('Europe/Berlin');
        $this->debtor = new Debtor();
        $this->receivable = new Receivable();
        $this->partreceivable = new PartReceivable();
        $this->crefoValidator = new CrefoValidator();
    }

    /**
     * @param string $address
     *
     * @return array
     */
    public function validateAddress($address)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequestBody::validateAddress==',
            ['validate address', 'address' => $address]);

        return $this->crefoValidator->computeRawAddress($address);
    }

    /**
     * @return array
     */
    public function getBodyAsArray()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequestBody::getBodyAsArray==',
            ['get collection order body as array']);
        $arrayBase = [
            'email' => $this->getDebtor()->getCommunicationData()->getEmail(),
            'city' => $this->getDebtor()->getAddressdata()->getAddressForService()->getCity(),
            'country' => $this->getDebtor()->getAddressdata()->getAddressForService()->getCountry(),
            'invoiceAmount' => $this->getPartreceivable()->getAmount(),
            'currency' => $this->getReceivable()->getCurrency(),
            'street' => $this->getDebtor()->getAddressdata()->getAddressForService()->getStreet(),
            'houseNumber' => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumber(),
            'houseNumberAffix' => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumberaffix(),
            'postcode' => $this->getDebtor()->getAddressdata()->getAddressForService()->getPostcode(),
        ];
        $salutation = null === $this->getDebtor()->getPrivateperson() ? null : $this->getDebtor()->getPrivateperson()->getSalutation();
        $firstName = null ===$this->getDebtor()->getPrivateperson() ? null : $this->getDebtor()->getPrivateperson()->getFirstname();
        $surname = null ===$this->getDebtor()->getPrivateperson() ? null : $this->getDebtor()->getPrivateperson()->getSurname();
        $company = (null ===$this->getDebtor()->getCompany() || null ===$this->getDebtor()->getCompany()->getCompanyname()) ? null : $this->getDebtor()->getCompany()->getCompanyname();
        if (null ===$company) {
            $arrayBusiness = [
                'salutation' => $salutation,
                'surname' => $surname,
                'firstName' => $firstName,
            ];
        } else {
            $arrayBusiness = [
                'companyName' => $company,
            ];
        }

        return array_merge($arrayBase, $arrayBusiness);
    }

    public function performSanitization()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequestBody::performSanitization==',
            ['perform sanitization']);
        $sanitizeObj = new CrefoSanitizer();

        $sourceArray = [
            'coll_ord_type' => $this->getCollectionordertype(),
            'street' => $this->getDebtor()->getAddressdata()->getAddressForService()->getStreet(),
            'houseNumber' => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumber(),
            'houseNumberAffix' => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumberaffix(),
            'postcode' => $this->getDebtor()->getAddressdata()->getAddressForService()->getPostcode(),
            'city' => $this->getDebtor()->getAddressdata()->getAddressForService()->getCity(),
            'email' => $this->getDebtor()->getCommunicationData()->getEmail(),
            'currency' => $this->getReceivable()->getCurrency(),
            'interest_spread' => $this->getReceivable()->getInterestField(2),
            'interest_rate' => $this->getReceivable()->getInterestField(3),
            'customerReference' => $this->getReceivable()->getCustomerreference(),
            'remarks' => $this->getReceivable()->getRemarks(),
            'coll_turnover' => $this->getPartreceivable()->getCollectionturnovertype(),
            'nr_inv' => $this->getPartreceivable()->getInvoicenumber(),
            'receivableReason' => $this->getPartreceivable()->getReceivablereason(),
            'amount' => $this->getPartreceivable()->getAmount(),
        ];
        if (null === $this->getDebtor()->getCompany() || null ===$this->getDebtor()->getCompany()->getCompanyname()) {
            $salutation = null === $this->getDebtor()->getPrivateperson() ? null : $this->getDebtor()->getPrivateperson()->getSalutation();
            $sourceArray['salutation'] = $salutation;
            $surname = null === $this->getDebtor()->getPrivateperson() ? null : $this->getDebtor()->getPrivateperson()->getSurname();
            $sourceArray['surname'] = $surname;
            $firstName = null === $this->getDebtor()->getPrivateperson() ? null : $this->getDebtor()->getPrivateperson()->getFirstname();
            $sourceArray['firstname'] = $firstName;
        } else {
            $company = null === $this->getDebtor()->getCompany() ? null : $this->getDebtor()->getCompany()->getCompanyname();
            $sourceArray['company_name'] = $company;
        }

        $sanitizeObj->addSource($sourceArray);
        $sanitizeObj->addRule('coll_ord_type', 'string', 100, true);
        if (null === $this->getDebtor()->getCompany() || null === $this->getDebtor()->getCompany()->getCompanyname()) {
            $sanitizeObj->addRule('salutation', 'string', 20, true);
            $sanitizeObj->addRule('surname', 'string', 30, true);
            $sanitizeObj->addRule('firstname', 'string', 30, true);
        } else {
            $sanitizeObj->addRule('company_name', 'string', 300, true);
        }
        $sanitizeObj->addRule('street', 'string', 46, true);
        $sanitizeObj->addRule('houseNumber', 'numeric', 5, true);
        $sanitizeObj->addRule('houseNumberAffix', 'string', 8, true);
        $sanitizeObj->addRule('postcode', 'string', 8, true);
        $sanitizeObj->addRule('city', 'string', 30, true);
        $sanitizeObj->addRule('email', 'string', 100, true);
        $sanitizeObj->addRule('currency', 'string', 3, true);
        if (null !== $this->getReceivable()->getInterestField(self::SPREAD)) {
            $sanitizeObj->addRule('interest_spread', 'numeric_float', 5, true);
        }
        if (null !== $this->getReceivable()->getInterestField(self::INTEREST_RATE)) {
            $sanitizeObj->addRule('interest_rate', 'numeric_float', 5, true);
        }
        $sanitizeObj->addRule('customerReference', 'string', 30, true);
        $sanitizeObj->addRule('remarks', 'string', 500, true);
        $sanitizeObj->addRule('coll_turnover', 'string', 100, true);
        $sanitizeObj->addRule('nr_inv', 'string', 30, true);
        $sanitizeObj->addRule('receivableReason', 'string', 100, true);
        $sanitizeObj->addRule('amount', 'numeric_float', 13, true);
        $sanitizeObj->run();
        $this->setCollectionordertype($sanitizeObj->sanitized['coll_ord_type']);
        if (null === $this->getDebtor()->getCompany() || null === $this->getDebtor()->getCompany()->getCompanyname()) {
            null !== $this->getDebtor()->getPrivateperson() ? $this->getDebtor()->getPrivateperson()->setSalutation($sanitizeObj->sanitized['salutation']) : null;
            null !== $this->getDebtor()->getPrivateperson() ? $this->getDebtor()->getPrivateperson()->setSurname($sanitizeObj->sanitized['surname']) : null;
            null !== $this->getDebtor()->getPrivateperson() ? $this->getDebtor()->getPrivateperson()->setFirstname($sanitizeObj->sanitized['firstname']) : null;
        } else {
            null !== $this->getDebtor()->getCompany() ? $this->getDebtor()->getCompany()->setCompanyname($sanitizeObj->sanitized['company_name']) : null;
        }
        $this->getDebtor()->getAddressdata()->getAddressForService()->setStreet($sanitizeObj->sanitized['street']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setHousenumberaffix($sanitizeObj->sanitized['houseNumberAffix']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setHousenumber($sanitizeObj->sanitized['houseNumber']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setPostcode($sanitizeObj->sanitized['postcode']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setCity($sanitizeObj->sanitized['city']);
        $this->getDebtor()->getCommunicationData()->setEmail($sanitizeObj->sanitized['email']);
        $this->getReceivable()->setCurrency($sanitizeObj->sanitized['currency']);
        if (null !== $this->getReceivable()->getInterestField(self::SPREAD)) {
            $this->getReceivable()->setInterestField(self::SPREAD, $sanitizeObj->sanitized['interest_spread']);
        }
        if (null !== $this->getReceivable()->getInterestField(self::INTEREST_RATE)) {
            $this->getReceivable()->setInterestField(self::INTEREST_RATE, $sanitizeObj->sanitized['interest_rate']);
        }
        $this->getReceivable()->setCustomerreference($sanitizeObj->sanitized['customerReference']);
        $this->getReceivable()->setRemarks($sanitizeObj->sanitized['remarks']);
        $this->getPartreceivable()->setCollectionturnovertype($sanitizeObj->sanitized['coll_turnover']);
        $this->getPartreceivable()->setInvoicenumber($sanitizeObj->sanitized['nr_inv']);
        $this->getPartreceivable()->setReceivablereason($sanitizeObj->sanitized['receivableReason']);
        $this->getPartreceivable()->setAmount($sanitizeObj->sanitized['amount']);
    }
}
