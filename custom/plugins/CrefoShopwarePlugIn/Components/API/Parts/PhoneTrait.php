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
 * Trait PhoneTrait
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
trait PhoneTrait
{
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