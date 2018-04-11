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
 * Class AddressData
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
class AddressData
{
    private $addressforservice;

    /**
     * AddressData constructor.
     */
    public function __construct()
    {
        $this->addressforservice = new AddressForService();
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\AddressForService
     */
    public function getAddressForService()
    {
        return $this->addressforservice;
    }
}