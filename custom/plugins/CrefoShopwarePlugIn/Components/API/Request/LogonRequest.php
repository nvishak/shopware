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

namespace CrefoShopwarePlugIn\Components\API\Request;

use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use CrefoShopwarePlugIn\Components\Core\RequestObject;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class LogonRequest
 */
class LogonRequest extends RequestObject
{
    /**
     * @codeCoverageIgnore
     * LogonRequest constructor.
     * {@inheritdoc}
     */
    public function __construct($config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==LogonRequest::construct==',
            ['Create logon request']);
        parent::__construct($config);
    }

    /**
     * @method performLogon
     *
     * @throws CrefoCommunicationException
     *
     * @return mixed
     */
    public function performLogon()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Call logon service.',
            ['Start the logon action.']);
        /**
         * @var \CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient $crefoSoapCl
         */
        $crefoSoapCl = $this->getCrefoSoapCl();
        /**
         * @var \SoapClient $soapCl
         */
        $soapCl = $crefoSoapCl->getSoapClient();
        // @codeCoverageIgnoreStart
        if (null === $soapCl) {
            throw new CrefoCommunicationException($crefoSoapCl->getSoapError());
        }
        // @codeCoverageIgnoreStop

        return $soapCl->logon($this);
    }
}
