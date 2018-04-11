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
 * Class Debtor
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
class Debtor
{
    private $company = null;
    private $privateperson = null;
    private $addressdata = null;
    private $communicationdata = null;

    /**
     * Debtor constructor.
     */
    public function __construct()
    {
        $this->communicationdata = new CommunicationData();
        $this->addressdata = new AddressData();
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    public function enableCompany()
    {
        $this->company = new Company();
    }

    public function disableCompany()
    {
        $this->company = null;
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\PrivatePerson
     */
    public function getPrivateperson()
    {
        return $this->privateperson;
    }

    public function enablePrivatePerson()
    {
        $this->privateperson = new PrivatePerson();
    }

    public function disablePrivatePerson()
    {
        $this->privateperson = null;
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\AddressData
     */
    public function getAddressdata()
    {
        return $this->addressdata;
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\CommunicationData
     */
    public function getCommunicationData()
    {
        return $this->communicationdata;
    }
}
