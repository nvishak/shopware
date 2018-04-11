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

/**
 * Class IdentificationReportBodyTrait
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
trait IdentificationReportBodyTrait
{
    use PhoneTrait;

    private $legitimateinterest;
    private $reportlanguage;
    private $producttype;
    private $customerreference;
    private $companyname;
    private $street;
    private $housenumber;
    private $housenumberaffix;
    private $postcode;
    private $city;
    private $country;
    private $legalform;
    private $website;
    private $registertype;
    private $registerid;
    private $vatid;
    private $solvencyindexthreshold;

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
    public function getReportLanguage()
    {
        return $this->reportlanguage;
    }

    /**
     * @param mixed $reportlanguage
     */
    public function setReportLanguage($reportlanguage)
    {
        $this->reportlanguage = $reportlanguage;
    }

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->producttype;
    }

    /**
     * @param mixed $producttype
     */
    public function setProductType($producttype)
    {
        $this->producttype = $producttype;
    }

    /**
     * @return mixed
     */
    public function getCustomerReference()
    {
        return $this->customerreference;
    }

    /**
     * @param mixed $customerreference
     */
    public function setCustomerReference($customerreference)
    {
        $this->customerreference = $customerreference;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyname;
    }

    /**
     * @param mixed $companyname
     */
    public function setCompanyName($companyname)
    {
        $this->companyname = $companyname;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getHouseNumber()
    {
        return $this->housenumber;
    }

    /**
     * @param mixed $housenumber
     */
    public function setHouseNumber($housenumber)
    {
        $this->housenumber = $housenumber;
    }

    /**
     * @return mixed
     */
    public function getHouseNumberAffix()
    {
        return $this->housenumberaffix;
    }

    /**
     * @param mixed $housenumberaffix
     */
    public function setHouseNumberAffix($housenumberaffix)
    {
        $this->housenumberaffix = $housenumberaffix;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostCode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getLegalForm()
    {
        return $this->legalform;
    }

    /**
     * @param mixed $legalform
     */
    public function setLegalForm($legalform)
    {
        $this->legalform = $legalform;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getRegisterType()
    {
        return $this->registertype;
    }

    /**
     * @param mixed $registertype
     */
    public function setRegisterType($registertype)
    {
        $this->registertype = $registertype;
    }

    /**
     * @return mixed
     */
    public function getRegisterId()
    {
        return $this->registerid;
    }

    /**
     * @param mixed $registerid
     */
    public function setRegisterId($registerid)
    {
        $this->registerid = $registerid;
    }

    /**
     * @return mixed
     */
    public function getVatId()
    {
        return $this->vatid;
    }

    /**
     * @param mixed $vatid
     */
    public function setVatId($vatid)
    {
        $this->vatid = $vatid;
    }

    /**
     * @return mixed
     */
    public function getSolvencyIndexThreshold()
    {
        return $this->solvencyindexthreshold;
    }

    /**
     * @param mixed $solvencyindexthreshold
     */
    public function setSolvencyIndexThreshold($solvencyindexthreshold)
    {
        $this->solvencyindexthreshold = $solvencyindexthreshold;
    }
}