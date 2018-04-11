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

namespace CrefoShopwarePlugIn\Components\API\Parts;

/**
 * @codeCoverageIgnore
 * Class Phone
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
Class Phone
{
    private $countrycode;
    private $diallingcode;
    private $phonenumber;

    /**
     * @return mixed
     */
    public function getDiallingcode()
    {
        return $this->diallingcode;
    }

    /**
     * @param mixed $diallingcode
     */
    public function setDiallingcode($diallingcode)
    {
        $this->diallingcode = $diallingcode;
    }

    /**
     * @return mixed
     */
    public function getCountrycode()
    {
        return $this->countrycode;
    }

    /**
     * @param mixed $countrycode
     */
    public function setCountrycode($countrycode)
    {
        $this->countrycode = $countrycode;
    }

    /**
     * @return mixed
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * @param mixed $phonenumber
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }

}