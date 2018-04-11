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
use \CrefoShopwarePlugIn\Components\API\Parts\CollectionOrderBodyTrait;
use \CrefoShopwarePlugIn\Components\API\Parts\Debtor;
use \CrefoShopwarePlugIn\Components\API\Parts\Receivable;
use \CrefoShopwarePlugIn\Components\API\Parts\PartReceivable;

/**
 * Class CollectionOrderBody
 * @package CrefoShopwarePlugIn\Components\API\Body
 */
class CollectionOrderBody implements CrefoSanitization
{
    use CollectionOrderBodyTrait;

    private $crefoValidator;

    const SPREAD = 2;
    const INTEREST_RATE = 3;

    /**
     * CollectionOrderBody constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('Europe/Berlin');
        $this->debtor = new Debtor();
        $this->receivable = new Receivable();
        $this->partreceivable = new PartReceivable();
        $this->crefoValidator = new CrefoValidator();
    }

    /**
     * @param string $address
     * @return array
     */
    public function validateAddress($address)
    {
        return $this->crefoValidator->computeRawAddress($address);
    }

    /**
     * @return array
     */
    public function getBodyAsArray()
    {
        $arrayBase = [
            'email' => $this->getDebtor()->getCommunicationData()->getEmail(),
            'city' => $this->getDebtor()->getAddressdata()->getAddressForService()->getCity(),
            'country'=>$this->getDebtor()->getAddressdata()->getAddressForService()->getCountry(),
            'invoiceAmount'=>$this->getPartreceivable()->getAmount(),
            'currency'=>$this->getReceivable()->getCurrency(),
            "street" => $this->getDebtor()->getAddressdata()->getAddressForService()->getStreet(),
            "houseNumber" => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumber(),
            "houseNumberAffix" => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumberaffix(),
            "postcode" => $this->getDebtor()->getAddressdata()->getAddressForService()->getPostcode(),
        ];
        $salutation = is_null($this->getDebtor()->getPrivateperson()) ? null : $this->getDebtor()->getPrivateperson()->getSalutation();
        $firstName = is_null($this->getDebtor()->getPrivateperson()) ? null : $this->getDebtor()->getPrivateperson()->getFirstname();
        $surname = is_null($this->getDebtor()->getPrivateperson()) ? null : $this->getDebtor()->getPrivateperson()->getSurname();
        $company = (is_null($this->getDebtor()->getCompany()) || is_null($this->getDebtor()->getCompany()->getCompanyname())) ? null : $this->getDebtor()->getCompany()->getCompanyname();
        if (is_null($company)) {
            $arrayBusiness = [
                'salutation' => $salutation,
                'surname' => $surname,
                'firstName' => $firstName
            ];
        } else {
            $arrayBusiness = [
                'companyName' => $company
            ];
        }
        return array_merge($arrayBase, $arrayBusiness);
    }

    public function performSanitization()
    {
        $sanitizeObj = new CrefoSanitizer();

        $sourceArray = [
            "coll_ord_type" => $this->getCollectionordertype(),
            "street" => $this->getDebtor()->getAddressdata()->getAddressForService()->getStreet(),
            "houseNumber" => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumber(),
            "houseNumberAffix" => $this->getDebtor()->getAddressdata()->getAddressForService()->getHousenumberaffix(),
            "postcode" => $this->getDebtor()->getAddressdata()->getAddressForService()->getPostcode(),
            "city" => $this->getDebtor()->getAddressdata()->getAddressForService()->getCity(),
            "email" => $this->getDebtor()->getCommunicationData()->getEmail(),
            "currency" => $this->getReceivable()->getCurrency(),
            "interest_spread" => $this->getReceivable()->getInterestField(2),
            "interest_rate" => $this->getReceivable()->getInterestField(3),
            "customerReference" => $this->getReceivable()->getCustomerreference(),
            "remarks" => $this->getReceivable()->getRemarks(),
            "coll_turnover" => $this->getPartreceivable()->getCollectionturnovertype(),
            "nr_inv" => $this->getPartreceivable()->getInvoicenumber(),
            "receivableReason" => $this->getPartreceivable()->getReceivablereason(),
            "amount" => $this->getPartreceivable()->getAmount()
        ];
        if (is_null($this->getDebtor()->getCompany()) || is_null($this->getDebtor()->getCompany()->getCompanyname())) {
            $salutation = is_null($this->getDebtor()->getPrivateperson()) ? null : $this->getDebtor()->getPrivateperson()->getSalutation();
            $sourceArray["salutation"] = $salutation;
            $surname = is_null($this->getDebtor()->getPrivateperson()) ? null : $this->getDebtor()->getPrivateperson()->getSurname();
            $sourceArray["surname"] = $surname;
            $firstName = is_null($this->getDebtor()->getPrivateperson()) ? null : $this->getDebtor()->getPrivateperson()->getFirstname();
            $sourceArray["firstname"] = $firstName;
        } else {
            $company = is_null($this->getDebtor()->getCompany()) ? null : $this->getDebtor()->getCompany()->getCompanyname();
            $sourceArray["company_name"] = $company;
        }

        $sanitizeObj->addSource($sourceArray);
        $sanitizeObj->addRule('coll_ord_type', 'string', 100, true);
        if (is_null($this->getDebtor()->getCompany()) || is_null($this->getDebtor()->getCompany()->getCompanyname())) {
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
        if (!is_null($this->getReceivable()->getInterestField(self::SPREAD))) {
            $sanitizeObj->addRule('interest_spread', 'numeric_float', 5, true);
        }
        if (!is_null($this->getReceivable()->getInterestField(self::INTEREST_RATE))) {
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
        if (is_null($this->getDebtor()->getCompany()) || is_null($this->getDebtor()->getCompany()->getCompanyname())) {
            !is_null($this->getDebtor()->getPrivateperson()) ? $this->getDebtor()->getPrivateperson()->setSalutation($sanitizeObj->sanitized['salutation']) : null;
            !is_null($this->getDebtor()->getPrivateperson()) ? $this->getDebtor()->getPrivateperson()->setSurname($sanitizeObj->sanitized['surname']) : null;
            !is_null($this->getDebtor()->getPrivateperson()) ? $this->getDebtor()->getPrivateperson()->setFirstname($sanitizeObj->sanitized['firstname']) : null;
        } else {
            !is_null($this->getDebtor()->getCompany()) ? $this->getDebtor()->getCompany()->setCompanyname($sanitizeObj->sanitized['company_name']) : null;
        }
        $this->getDebtor()->getAddressdata()->getAddressForService()->setStreet($sanitizeObj->sanitized['street']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setHousenumberaffix($sanitizeObj->sanitized['houseNumberAffix']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setHousenumber($sanitizeObj->sanitized['houseNumber']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setPostcode($sanitizeObj->sanitized['postcode']);
        $this->getDebtor()->getAddressdata()->getAddressForService()->setCity($sanitizeObj->sanitized['city']);
        $this->getDebtor()->getCommunicationData()->setEmail($sanitizeObj->sanitized['email']);
        $this->getReceivable()->setCurrency($sanitizeObj->sanitized['currency']);
        if (!is_null($this->getReceivable()->getInterestField(self::SPREAD))) {
            $this->getReceivable()->setInterestField(self::SPREAD, $sanitizeObj->sanitized['interest_spread']);
        }
        if (!is_null($this->getReceivable()->getInterestField(self::INTEREST_RATE))) {
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
