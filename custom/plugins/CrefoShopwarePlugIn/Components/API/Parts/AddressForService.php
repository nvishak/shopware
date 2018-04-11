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
 * Class AddressForService
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
class AddressForService
{
    private $street;
    private $housenumber;
    private $housenumberaffix;
    private $postcode;
    private $city;
    private $country;

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
    public function getHousenumber()
    {
        return $this->housenumber;
    }

    /**
     * @param mixed $housenumber
     */
    public function setHousenumber($housenumber)
    {
        $this->housenumber = $housenumber;
    }

    /**
     * @return mixed
     */
    public function getHousenumberaffix()
    {
        return $this->housenumberaffix;
    }

    /**
     * @param mixed $housenumberaffix
     */
    public function setHousenumberaffix($housenumberaffix)
    {
        $this->housenumberaffix = $housenumberaffix;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
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


}