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

use \CrefoShopwarePlugIn\Components\API\Body\CollectionOrderBody;
use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \CrefoShopwarePlugIn\Components\Core\RequestObject;
use \CrefoShopwarePlugIn\Components\Soap\Parsers\CollectionOrderParser;
use \CrefoShopwarePlugIn\Components\Soap\Mappers\CollectionOrderMapper;

/**
 * Class CollectionOrderRequest
 * @package CrefoShopwarePlugIn\Components\API\Request
 */
class CollectionOrderRequest extends RequestObject
{
    protected $body;

    /**
     * CollectionOrderRequest constructor.
     * @inheritdoc
     */
    public function __construct($config)
    {
        parent::__construct($config);
        $this->body = new CollectionOrderBody();
        $this->body->performSanitization();
    }

    /**
     * @param CollectionOrderBody $body
     */
    public function setBody(CollectionOrderBody $body)
    {
        $this->body = $body;
        $this->body->performSanitization();
    }

    /**
     * @return CollectionOrderBody
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\Parsers\CollectionOrderParser
     */
    public function getCrefoParser()
    {
        if (is_null($this->crefoParser) || !($this->crefoParser instanceof CollectionOrderParser)) {
            $mapper = new CollectionOrderMapper();
            $this->crefoParser = new CollectionOrderParser($mapper);
        }
        return $this->crefoParser;
    }

    /**
     * @method sendOrder
     * @return mixed
     * @throws CrefoCommunicationException|\SoapFault
     */
    public function sendOrder()
    {
        /**
         * @var \SoapClient $soapClient
         */
        $soapClient = $this->getCrefoSoapCl()->getSoapClient();
        if (is_null($soapClient)) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        return $soapClient->collectionorder($this);
    }
}