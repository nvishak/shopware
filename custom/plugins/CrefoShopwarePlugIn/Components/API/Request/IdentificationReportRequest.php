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

use CrefoShopwarePlugIn\Components\API\Body\IdentificationReportBody;
use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use CrefoShopwarePlugIn\Components\Core\RequestObject;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Soap\Mappers\IdentificationReportMapper;
use CrefoShopwarePlugIn\Components\Soap\Parsers\IdentificationReportParser;

/**
 * Class IdentificationReportRequest
 */
class IdentificationReportRequest extends RequestObject
{
    protected $body;

    /**
     * @codeCoverageIgnore
     * IdentificationReportRequest constructor.
     * {@inheritdoc}
     */
    public function __construct($config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==IdentificationReportRequest::construct==',
            ['create identification report request']);
        parent::__construct($config);
        $this->body = new IdentificationReportBody();
        $this->body->performSanitization();
    }

    /**
     * @codeCoverageIgnore
     * @param IdentificationReportBody $body
     */
    public function setBody(IdentificationReportBody $body)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==IdentificationReportRequest::setBody==',
            ['set identification report body request', 'body' => $body]);
        $this->body = $body;
        $this->body->performSanitization();
    }

    /**
     * @codeCoverageIgnore
     * @return IdentificationReportBody
     */
    public function getBody()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==IdentificationReportRequest::getBody==',
            ['get identification report body request']);

        return $this->body;
    }

    /**
     * @codeCoverageIgnore
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\Parsers\IdentificationReportParser
     */
    public function getCrefoParser()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==IdentificationReportRequest::getCrefoParser==',
            ['get crefo parser for identification report request']);
        if (null === $this->crefoParser || !($this->crefoParser instanceof IdentificationReportParser)) {
            $mapper = new IdentificationReportMapper();
            $this->crefoParser = new IdentificationReportParser($mapper);
        }

        return $this->crefoParser;
    }

    /**
     * @throws CrefoCommunicationException
     *
     * @return mixed
     */
    public function performIdentificationReport()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Call identification report service.',
            ['Start the identification report action.']);
        /**
         * @var \SoapClient $soapClient
         */
        $soapClient = $this->getCrefoSoapCl()->getSoapClient();
        // @codeCoverageIgnoreStart
        if (null === $soapClient) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        // @codeCoverageIgnoreStop

        return $soapClient->identificationreport($this);
    }
}
