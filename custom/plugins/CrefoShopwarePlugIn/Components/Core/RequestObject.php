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

namespace CrefoShopwarePlugIn\Components\Core;

use \CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use \CrefoShopwarePlugIn\Components\Soap\CrefoMapper;
use \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;
use \CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class RequestObject
 * @package CrefoShopwarePlugIn\Components\Core
 */
abstract class RequestObject
{
    protected $header;

    /**
     * @var null|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient $crefoSoapCl
     */
    private $crefoSoapCl = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser
     */
    protected $crefoParser = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger $crefoLogger
     */
    private $crefoLogger = null;

    /**
     * @var null| ConfigHeaderRequest $config
     */
    private $config = null;

    /**
     * @return null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger
     */
    protected function getCrefoLogger()
    {
        if ($this->crefoLogger === null) {
            $this->crefoLogger = new CrefoLogger();
        }
        return $this->crefoLogger;
    }

    /**
     * RequestObject constructor.
     * @param ConfigHeaderRequest $config
     */
    public function __construct(ConfigHeaderRequest $config)
    {
        date_default_timezone_set('Europe/Berlin');
        $this->config = $config;
        $this->header = new RequestHeaderImpl($config);
        $this->header->performSanitization();
        $this->getCrefoParser();
    }

    /**
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser
     */
    public function getCrefoParser()
    {
        if (is_null($this->crefoParser)) {
            $mapper = new CrefoMapper();
            $this->crefoParser = new CrefoSoapParser($mapper);
        }
        return $this->crefoParser;
    }

    /**
     * Sets the header
     *
     * @param RequestHeaderImpl $req
     */
    private function setHeader(RequestHeaderImpl $req)
    {
        $this->header = $req;
        $this->header->performSanitization();
    }

    /**
     * @param null|array $account
     */
    public function setHeaderAccount(array $account)
    {
        $this->setHeader(new RequestHeaderImpl($this->config, $account));
    }

    /**
     * @param ConfigHeaderRequest $config
     */
    public function setConfigHeaderRequest(ConfigHeaderRequest $config)
    {
        $this->config = $config;
    }

    /**
     * Gets the header
     *
     * @return RequestHeaderImpl
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return null|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient
     */
    protected function getCrefoSoapCl()
    {
        if (is_null($this->crefoSoapCl)) {
            $this->crefoSoapCl = new CrefoSoapClient();
        }
        return $this->crefoSoapCl;
    }

    /**
     * @return string
     */
    public function getLastSoapCallRequest()
    {
        return is_null($this->getCrefoSoapCl()) ? null : $this->getCrefoSoapCl()->getLastSoapCallRequest();
    }

    /**
     * @return string
     */
    public function getLastSoapCallResponse()
    {
        return is_null($this->getCrefoSoapCl()) ? null : $this->getCrefoSoapCl()->getLastSoapCallResponse();
    }

    /**
     * @param String $format
     * @return array
     */
    public function handleSoapResponse($format = 'Y-m-d\TH:i:s')
    {
        $lastRequest = $this->getLastSoapCallRequest();
        $lastResponse = $this->getLastSoapCallResponse();
        $dateReport = new \DateTime($this->getCrefoParser()->getServiceTimeStamp());
        $dateProcessEnd = new \DateTime('now');
        $reqDesc = $this->getCrefoParser()->extractTextTitleFromStringXml($lastRequest);
        $respDesc = $this->getCrefoParser()->extractTextTitleFromStringXml($lastResponse);
        $lastRequestWithoutPassword = $this->getCrefoParser()->removePasswordsTxtFromXML($lastRequest);
        $logArray = [
            'log_status' => LogStatusType::NOT_SAVED,
            'ts_response' => $dateReport->format($format),
            'tsProcessEnd' => $dateProcessEnd->format($format),
            'requestXML' => addslashes($lastRequestWithoutPassword),
            'requestXMLDescription' => $reqDesc,
            'responseXML' => addslashes($lastResponse),
            'responseXMLDescription' => $respDesc
        ];
        return $logArray;
    }
}
