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

use \CrefoShopwarePlugIn\Components\API\Body\BonimaReportBody;
use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \CrefoShopwarePlugIn\Components\Core\RequestObject;
use \CrefoShopwarePlugIn\Components\Soap\Mappers\BonimaReportMapper;
use \CrefoShopwarePlugIn\Components\Soap\Parsers\BonimaReportParser;

/**
 * Class BonimaReportRequest
 * @package CrefoShopwarePlugIn\Components\API\Request
 */
class BonimaReportRequest extends RequestObject
{
    protected $body;

    /**
     * BonimaReportRequest constructor.
     * @inheritdoc
     */
    public function __construct($config)
    {
        parent::__construct($config);
        $this->body = new BonimaReportBody();
        $this->body->performSanitization();
    }

    /**
     * @param BonimaReportBody $body
     */
    public function setBody(BonimaReportBody $body)
    {
        $this->body = $body;
        $this->body->performSanitization();
    }

    /**
     * @return BonimaReportBody
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\Parsers\BonimaReportParser
     */
    public function getCrefoParser()
    {
        if (is_null($this->crefoParser) || !($this->crefoParser instanceof BonimaReportParser)) {
            $mapper = new BonimaReportMapper();
            $this->crefoParser = new BonimaReportParser($mapper);
        }
        return $this->crefoParser;
    }

    /**
     * @return mixed
     * @throws CrefoCommunicationException|\SoapFault
     */
    public function performBonimaReport()
    {
        $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==performBonimaReport==",
            ['Start the bonima report action.']);
        /**
         * @var \SoapClient $soapClient
         */
        $soapClient = $this->getCrefoSoapCl()->getSoapClient();
        if (is_null($soapClient)) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        return $soapClient->bonimareport($this);
    }

    /**
     * @param BonimaReportParser $crefoParser
     * @return bool
     */
    public function isInvalidBonimaResult($crefoParser)
    {
        return is_null($crefoParser->getAddressCheckResultKey())
            || is_null($crefoParser->getIdentificationResultKey())
            || is_null($crefoParser->getScoreTypeResultKey())
            || is_null($crefoParser->extractScoreValueResult());
    }
}