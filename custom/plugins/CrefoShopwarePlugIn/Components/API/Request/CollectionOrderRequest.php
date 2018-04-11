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

use CrefoShopwarePlugIn\Components\API\Body\CollectionOrderBody;
use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use CrefoShopwarePlugIn\Components\Core\RequestObject;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Soap\Mappers\CollectionOrderMapper;
use CrefoShopwarePlugIn\Components\Soap\Parsers\CollectionOrderParser;

/**
 * Class CollectionOrderRequest
 */
class CollectionOrderRequest extends RequestObject
{
    protected $body;

    /**
     * @codeCoverageIgnore
     * CollectionOrderRequest constructor.
     * {@inheritdoc}
     */
    public function __construct($config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequest::construct==',
            ['create collection order request']);
        parent::__construct($config);
        $this->body = new CollectionOrderBody();
        $this->body->performSanitization();
    }

    /**
     * @codeCoverageIgnore
     * @param CollectionOrderBody $body
     */
    public function setBody(CollectionOrderBody $body)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequest::setBody==',
            ['set body of the collection order', 'collection order body' => $body]);
        $this->body = $body;
        $this->body->performSanitization();
    }

    /**
     * @codeCoverageIgnore
     * @return CollectionOrderBody
     */
    public function getBody()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequest::getBody==',
            ['get body of collection order']);

        return $this->body;
    }

    /**
     * @codeCoverageIgnore
     * @return mixed|\CrefoShopwarePlugIn\Components\Soap\Parsers\CollectionOrderParser
     */
    public function getCrefoParser()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CollectionOrderRequest::getCrefoParser==',
            ['get crefo parser']);
        if (null === $this->crefoParser || !($this->crefoParser instanceof CollectionOrderParser)) {
            $mapper = new CollectionOrderMapper();
            $this->crefoParser = new CollectionOrderParser($mapper);
        }

        return $this->crefoParser;
    }

    /**
     * @method sendOrder
     *
     * @throws CrefoCommunicationException
     *
     * @return mixed
     */
    public function sendOrder()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Call collection order service.',
            ['send order']);
        /**
         * @var \SoapClient $soapClient
         */
        $soapClient = $this->getCrefoSoapCl()->getSoapClient();
        // @codeCoverageIgnoreStart
        if (null === $soapClient) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        // @codeCoverageIgnoreStop

        return $soapClient->collectionorder($this);
    }
}
