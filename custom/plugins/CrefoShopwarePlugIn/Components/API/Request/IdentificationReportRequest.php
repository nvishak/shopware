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

use \CrefoShopwarePlugIn\Components\API\Body\IdentificationReportBody;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \CrefoShopwarePlugIn\Components\Core\RequestObject;
use \CrefoShopwarePlugIn\Components\Soap\Parsers\IdentificationReportParser;
use \CrefoShopwarePlugIn\Components\Soap\Mappers\IdentificationReportMapper;
use \CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;

/**
 * Class IdentificationReportRequest
 * @package CrefoShopwarePlugIn\Components\API\Request
 */
class IdentificationReportRequest extends RequestObject
{
    protected $body;

    /**
     * IdentificationReportRequest constructor.
     * @inheritdoc
     */
    public function __construct($config)
    {
        parent::__construct($config);
        $this->body = new IdentificationReportBody();
        $this->body->performSanitization();
    }

    /**
     * @param IdentificationReportBody $body
     */
    public function setBody(IdentificationReportBody $body)
    {
        $this->body = $body;
        $this->body->performSanitization();
    }

    /**
     * @return IdentificationReportBody
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\Parsers\IdentificationReportParser
     */
    public function getCrefoParser()
    {
        if (is_null($this->crefoParser) || !($this->crefoParser instanceof IdentificationReportParser)) {
            $mapper = new IdentificationReportMapper();
            $this->crefoParser = new IdentificationReportParser($mapper);
        }
        return $this->crefoParser;
    }

    /**
     * @return mixed
     * @throws CrefoCommunicationException|\SoapFault
     */
    public function performIdentificationReport()
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==performIdentificationReport==",
            ['Start the identification report action.']);
        /**
         * @var \SoapClient $soapClient
         */
        $soapClient = $this->getCrefoSoapCl()->getSoapClient();
        if (is_null($soapClient)) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        return $soapClient->identificationreport($this);
    }
}
