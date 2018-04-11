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

use CrefoShopwarePlugIn\Components\API\Body\BonimaReportBody;
use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use CrefoShopwarePlugIn\Components\Core\RequestObject;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Soap\Mappers\BonimaReportMapper;
use CrefoShopwarePlugIn\Components\Soap\Parsers\BonimaReportParser;

/**
 * Class BonimaReportRequest
 */
class BonimaReportRequest extends RequestObject
{
    protected $body;

    /**
     * @codeCoverageIgnore
     * BonimaReportRequest constructor.
     * {@inheritdoc}
     */
    public function __construct($config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequest::construct==',
            ['create bonima report request']);
        parent::__construct($config);
        $this->body = new BonimaReportBody();
        $this->body->performSanitization();
    }

    /**
     * @codeCoverageIgnore
     * @param BonimaReportBody $body
     */
    public function setBody(BonimaReportBody $body)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequest::setBody==',
            ['set bonima body for request', 'body' => $body]);
        $this->body = $body;
        $this->body->performSanitization();
    }

    /**
     * @codeCoverageIgnore
     * @return BonimaReportBody
     */
    public function getBody()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequest::getBody==',
            ['get bonima body request']);

        return $this->body;
    }

    /**
     * @codeCoverageIgnore
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\Parsers\BonimaReportParser
     */
    public function getCrefoParser()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequest::getCrefoParser==',
            ['get crefo parser']);
        if (null === $this->crefoParser || !($this->crefoParser instanceof BonimaReportParser)) {
            $mapper = new BonimaReportMapper();
            $this->crefoParser = new BonimaReportParser($mapper);
        }

        return $this->crefoParser;
    }

    /**
     * @throws CrefoCommunicationException|\SoapFault
     *
     * @return mixed
     */
    public function performBonimaReport()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Call bonima report service.',
            ['Start the bonima report action.']);
        /**
         * @var \SoapClient $soapClient
         */
        $soapClient = $this->getCrefoSoapCl()->getSoapClient();
        // @codeCoverageIgnoreStart
        if (null === $soapClient) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        // @codeCoverageIgnoreStop

        return $soapClient->bonimareport($this);
    }

    /**
     * @param BonimaReportParser $crefoParser
     * @return bool
     */
    public function isInvalidBonimaResult($crefoParser)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==BonimaReportRequest::isInvalidBonimaResult==',
            ['check if is invalid bonima result']);

        return null === $crefoParser->getAddressCheckResultKey() ||
            null === $crefoParser->getIdentificationResultKey() ||
            null === $crefoParser->getScoreTypeResultKey() ||
            null === $crefoParser->extractScoreValueResult();
    }
}
