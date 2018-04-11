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

namespace CrefoShopwarePlugIn\Components\Soap;

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class CrefoSoapClient
 */
class CrefoSoapClient
{
    private $wsdl;
    /**
     * @var null|\SoapClient
     */
    private $soapClient;
    private $errorSoap;

    /**
     * CrefoSoapClient constructor.
     *
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CrefoSoapClient==', ['Create Soap Client.']);
        $this->soapClient = null;

        try {
            if (extension_loaded('soap')) {
                $this->loadIni();
                set_error_handler('CrefoShopwarePlugIn\\Components\\Soap\\ErrorHandler\\CrefoErrorHandler::handle_error');
                $this->soapClient = new \SoapClient($this->getWsdl(), $this->loadSoapOptions());
                restore_error_handler();
            }
            if (null === $this->soapClient) {
                throw new \Exception("Couldn't load SoapClient from wsdl");
            }
        } catch (\SoapFault $fault) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==CrefoSoapClient>>SoapFault ' . date('Y-m-d H:i:s') . '==', [$fault]);
            if (isset($fault->faultstring)) {
                $this->errorSoap = $fault->faultstring;
            }
            $this->soapClient = null;
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::CRITICAL, 'Something went wrong to create the soap client.', [$this->wsdl, $e]);
            $this->errorSoap = $e->getMessage();
            $this->soapClient = null;
        }
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \SoapClient
     */
    public function getSoapClient()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Get soap client.', []);

        return $this->soapClient;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getSoapError()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Get soap errors.', []);

        return $this->errorSoap;
    }

    /**
     * @return string|null
     */
    public function getLastSoapCallRequest()
    {
        $lastRequest = null;
        try {
            if (null === $this->getSoapClient()) {
                throw new \Exception('The soap client is not initialized.');
            }
            $lastRequest = $this->soapClient->__getLastRequest();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==getLastSoapCallRequest==',
                ['No last soap call for request was found.']);
        }

        return $lastRequest;
    }

    /**
     * @return string|null
     */
    public function getLastSoapCallResponse()
    {
        $lastResponse = null;
        try {
            if (null === $this->getSoapClient()) {
                throw new \Exception('The soap client is not initialized.');
            }
            $lastResponse = $this->soapClient->__getLastResponse();
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==getLastSoapCallResponse==',
                ['No last soap call for response was found.']);
        }

        return $lastResponse;
    }

    /**
     * loads ini file either the default or a given file
     *
     * @param file
     */
    private function loadIni($file = null)
    {
        if ($file == null) {
            $file = __DIR__ . DIRECTORY_SEPARATOR . '_resources' . DIRECTORY_SEPARATOR . 'webservice.ini';
        }
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==loadIni==', ['Load from Ini File.']);
        if (file_exists($file)) {
            $ini_array = parse_ini_file(filter_var($file, FILTER_SANITIZE_STRING), true);
            if (array_key_exists('webservice_configuration', $ini_array)) {
                $ws_config = $ini_array['webservice_configuration'];
                $this->setWsdl($ws_config['wsdl']);
                CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==load wsdl info==', $ws_config);
            }
        }
    }

    /**
     * loads soap options
     *
     * @codeCoverageIgnore
     *
     * @return array
     */
    private function loadSoapOptions()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Load soap options.', []);
        if(extension_loaded('openssl')){
            $options =  [
                'trace' => 1,
                'exceptions' => true,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'soap_version' => SOAP_1_2,
                'encoding' => 'UTF-8',
                'features' => SOAP_USE_XSI_ARRAY_TYPE, //SOAP_SINGLE_ELEMENT_ARRAYS,
                'connection_timeout' => 60,
                'keep_alive' => false,
                'ssl_method' => SOAP_SSL_METHOD_TLS,
                'stream_context' => stream_context_create([
                    'ssl' => [
                        'crypto_method' =>  STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
                        'ciphers' => 'ECDHE-RSA-AES256-GCM-SHA384',
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ]),
            ];
        }else{
            $options =  [
                'trace' => 1,
                'encoding' => 'UTF-8',
                'exceptions' => true,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'soap_version' => SOAP_1_2,
                'features' => SOAP_USE_XSI_ARRAY_TYPE, //SOAP_SINGLE_ELEMENT_ARRAYS,
                'connection_timeout' => 60,
                'keep_alive' => false,
                'stream_context' => stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ]),
            ];
        }
        return $options;
    }

    /**
     * @return mixed
     */
    private function getWsdl()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Get wsdl.', []);

        return $this->wsdl;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param $wsdl
     */
    private function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;
    }
}
