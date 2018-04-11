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

namespace CrefoShopwarePlugIn\Components\Core;

/**
 * Trait RequestHeaderTrait
 * @package CrefoShopwarePlugIn\Components\Core
 * @codeCoverageIgnore
 */
trait RequestHeaderTrait
{

    private $communicationlanguage;
    private $transmissiontimestamp;
    private $keylistversion;
    private $clientapplicationname;
    private $clientapplicationversion;
    private $transactionreference;
    private $useraccount;
    private $generalpassword;
    private $individualpassword;

    //==============setters=================

    /**
     * @param $value
     */
    public function setCommunicationLanguage($value)
    {
        $this->communicationlanguage = $value;
    }

    /**
     * @param $value
     */
    public function setTransmissionTimestamp($value)
    {
        $this->transmissiontimestamp = $value;
    }

    /**
     * @param $value
     */
    public function setKeylistVersion($value)
    {
        $this->keylistversion = $value;
    }

    /**
     * @param $value
     */
    public function setClientApplicationVersion($value)
    {
        $this->clientapplicationversion = $value;
    }

    /**
     * @param $value
     */
    public function setClientApplicationName($value)
    {
        $this->clientapplicationname = $value;
    }

    /**
     * @param $value
     */
    public function setTransactionReference($value)
    {
        $this->transactionreference = $value;
    }

    /**
     * @param $value
     */
    public function setUserAccount($value)
    {
        $this->useraccount = $value;
    }

    /**
     * @param $value
     */
    public function setGeneralPassword($value)
    {
        $this->generalpassword = $value;
    }

    /**
     * @param $value
     */
    public function setIndividualPassword($value)
    {
        $this->individualpassword = $value;
    }

    //==============getters==================

    public function getCommunicationLanguage()
    {
        return $this->communicationlanguage;
    }

    public function getTransmissionTimestamp()
    {
        return $this->transmissiontimestamp;
    }

    public function getKeylistVersion()
    {
        return $this->keylistversion;
    }

    public function getClientApplicationVersion()
    {
        return $this->clientapplicationversion;
    }

    public function getClientApplicationName()
    {
        return $this->clientapplicationname;
    }

    public function getTransactionReference()
    {
        return $this->transactionreference;
    }

    public function getUserAccount()
    {
        return $this->useraccount;
    }

    public function getGeneralPassword()
    {
        return $this->generalpassword;
    }

    public function getIndividualPassword()
    {
        return $this->individualpassword;
    }
}
