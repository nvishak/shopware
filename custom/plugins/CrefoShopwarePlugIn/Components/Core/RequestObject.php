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

use CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Soap\CrefoMapper;
use CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient;
use CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;
use CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest;

/**
 * Class RequestObject
 */
abstract class RequestObject
{
    protected $header;

    /**
     * @var null|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser
     */
    protected $crefoParser = null;

    /**
     * @var null|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient $crefoSoapCl
     */
    private $crefoSoapCl = null;

    /**
     * @var null| ConfigHeaderRequest $config
     */
    private $config = null;

    /**
     * RequestObject constructor.
     * @codeCoverageIgnore
     * @param ConfigHeaderRequest $config
     */
    public function __construct(ConfigHeaderRequest $config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::construct==',
            ['create a request object', 'config' => $config]);
        date_default_timezone_set('Europe/Berlin');
        $this->config = $config;
        $this->header = new RequestHeaderImpl($config);
        $this->header->performSanitization();
        $this->getCrefoParser();
    }

    /**
     * @codeCoverageIgnore
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser
     */
    public function getCrefoParser()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::getCrefoParser==',
            ['get crefo parser']);
        if (null === $this->crefoParser) {
            $mapper = new CrefoMapper();
            $this->crefoParser = new CrefoSoapParser($mapper);
        }

        return $this->crefoParser;
    }

    /**
     * @codeCoverageIgnore
     * @param null|array $account
     */
    public function setHeaderAccount(array $account = null)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::setHeaderAccount==',
            ['set account header request']);
        $this->setHeader(new RequestHeaderImpl($this->config, $account));
    }

    /**
     * @codeCoverageIgnore
     * @param ConfigHeaderRequest $config
     */
    public function setConfigHeaderRequest(ConfigHeaderRequest $config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::setConfigHeaderRequest==',
            ['set config header request']);
        $this->config = $config;
    }

    /**
     * Gets the header
     * @codeCoverageIgnore
     * @return RequestHeaderImpl
     */
    public function getHeader()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::getHeader==',
            ['get header request']);

        return $this->header;
    }

    /**
     * @return string
     */
    public function getLastSoapCallRequest()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::getLastSoapCallRequest==',
            ['get last soap call request']);

        return null === $this->getCrefoSoapCl() ? null : $this->getCrefoSoapCl()->getLastSoapCallRequest();
    }

    /**
     * @return string
     */
    public function getLastSoapCallResponse()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::getLastSoapCallResponse==',
            ['get last soap call response']);

        return null === $this->getCrefoSoapCl() ? null : $this->getCrefoSoapCl()->getLastSoapCallResponse();
    }

    /**
     * @param string $format
     *
     * @return array
     */
    public function handleSoapResponse($format = 'Y-m-d\TH:i:s')
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::handleSoapResponse==',
            ['handle soap response', 'format' => $format]);
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
            'responseXMLDescription' => $respDesc,
        ];

        return $logArray;
    }

    /**
     * @codeCoverageIgnore
     * @return null|\CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient
     */
    protected function getCrefoSoapCl()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::getCrefoSoapCl==',
            ['get crefo soap client']);
        if (null === $this->crefoSoapCl) {
            $this->crefoSoapCl = new CrefoSoapClient();
        }

        return $this->crefoSoapCl;
    }

    /**
     * Sets the header
     * @codeCoverageIgnore
     * @param RequestHeaderImpl $header
     */
    private function setHeader(RequestHeaderImpl $header)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==RequestObject::setHeader==',
            ['set header request']);
        $this->header = $header;
        $this->header->performSanitization();
    }
}
