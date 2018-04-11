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

namespace CrefoShopwarePlugIn\Components\API\Parts;

use CrefoShopwarePlugIn\Components\Core\Enums\PrivatePersonProductsType;

/**
 * Class BonimaBodyTrait
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
trait BonimaBodyTrait
{
    private $producttype;
    private $legitimateinterest;
    private $salutation;
    private $surname;
    private $firstname;
    private $dateofbirth;
    private $consentgiven = false;
    private $customerreference;
    /**
     * @var AddressOne $addressone
     */
    private $addressone;

    /**
     * @return string
     */
    public function getProductType()
    {
        return $this->producttype;
    }

    /**
     * @return integer
     */
    public function getProductTypeId()
    {
        $productsTypesFlipped = array_flip(PrivatePersonProductsType::AllowedProducts());
        return $productsTypesFlipped[$this->producttype];
    }

    /**
     * @param integer $producttype
     */
    public function setProductTypeFromId($producttype)
    {
        $productsTypes = PrivatePersonProductsType::AllowedProducts();
        $this->producttype = $productsTypes[$producttype];
    }

    /**
     * @param string $producttype
     */
    public function setProductType($producttype)
    {
        $this->producttype = $producttype;
    }

    /**
     * @return mixed
     */
    public function getLegitimateInterest()
    {
        return $this->legitimateinterest;
    }

    /**
     * @param mixed $legitimateinterest
     */
    public function setLegitimateInterest($legitimateinterest)
    {
        $this->legitimateinterest = $legitimateinterest;
    }

    /**
     * @return mixed
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param mixed $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = strpos(strtolower(trim($salutation)), "s") === false ? "SA-1" : "SA-2";
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateofbirth;
    }

    /**
     * @param mixed $dateofbirth
     */
    public function setDateOfBirth($dateofbirth)
    {
        preg_match("/\d\d\d\d\-\d\d-\d\d/", $dateofbirth, $matches);
        if (count($matches) == 0) {
            $value = preg_replace('/[^\d\.]/', '', $dateofbirth);
            $values = preg_split("/[\.]/", $value);
            if (count($values) == 3) {
                $this->dateofbirth = $values[2] . "-" . $values[1] . "-" . $values[0];
            } else {
                $this->dateofbirth = $value;
            }
        } else {
            $this->dateofbirth = $dateofbirth;
        }
    }

    /**
     * @return mixed
     */
    public function getConsentGiven()
    {
        return $this->consentgiven;
    }

    /**
     * @return AddressOne
     */
    public function getAddressOne()
    {
        return $this->addressone;
    }

    /**
     * @param AddressOne $addressOne
     */
    public function setAddressOne($addressOne)
    {
        $this->addressone = $addressOne;
    }

    /**
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->customerreference;
    }

    /**
     * @param string $customerreference
     */
    public function setCustomerReference($customerreference)
    {
        $this->customerreference = $customerreference;
    }


}