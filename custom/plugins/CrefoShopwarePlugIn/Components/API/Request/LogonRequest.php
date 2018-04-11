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

namespace CrefoShopwarePlugIn\Components\API\Request;

use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use CrefoShopwarePlugIn\Components\Core\RequestObject;

/**
 * Class LogonRequest
 * @package CrefoShopwarePlugIn\Components\API\Request
 */
class LogonRequest extends RequestObject
{
    /**
     * LogonRequest constructor.
     * @inheritdoc
     */
    public function __construct($config)
    {
        parent::__construct($config);
    }

    /**
     * @method performLogon
     * @return mixed
     * @throws CrefoCommunicationException|\SoapFault
     */
    public function performLogon()
    {
        /**
         * @var \CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient $crefoSoapCl
         */

        $crefoSoapCl = $this->getCrefoSoapCl();
        /**
         * @var \SoapClient $soapCl
         */
        $soapCl = $crefoSoapCl->getSoapClient();
        if (is_null($soapCl)) {
            throw new CrefoCommunicationException($crefoSoapCl->getSoapError());
        }
        return $soapCl->logon($this);
    }
}
