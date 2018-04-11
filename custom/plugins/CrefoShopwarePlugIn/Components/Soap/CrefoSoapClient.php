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

namespace CrefoShopwarePlugIn\Components\Soap;

use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

if (extension_loaded('soap')) {
    /**
     * Class CrefoSoapClient
     * @package CrefoShopwarePlugIn\Components\Soap
     */
    class CrefoSoapClient
    {

        private $namespace;
        private $wsdl;
        /**
         * @var null|\SoapClient
         */
        private $soapClient;
        private $errorSoap;

        /**
         * @var null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger $crefoLogger
         */
        private $crefoLogger = null;

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
         * CrefoSoapClient constructor.
         */
        public function __construct()
        {
            $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==CrefoSoapClient==", ['Create Soap Client.']);
            $this->soapClient = null;
            try {
                $this->loadIni();
                set_error_handler("CrefoShopwarePlugIn\\Components\\Soap\\ErrorHandler\\CrefoErrorHandler::handle_error");
                $this->soapClient = new \SoapClient($this->wsdl, $this->loadSoapOptions());
                restore_error_handler();
                if (is_null($this->soapClient)) {
                    throw new \Exception("Null SoapClient - couldn't load from wsdl.");
                }
            } catch (\SoapFault $fault) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                    "==CrefoSoapClient>>SoapFault " . date("Y-m-d H:i:s") . "==", (array)$fault);
                if (isset($fault->faultstring)) {
                    $this->errorSoap = $fault->faultstring;
                }
                $this->soapClient = null;
            } catch (\Exception $e) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                    "==CrefoSoapClient>>Exception " . date("Y-m-d H:i:s") . "==", (array)$e);
                $this->errorSoap = $e->getMessage();
                $this->soapClient = null;
            }
        }

        /**
         * loads ini file either the default or a given file
         * @method loadIni
         * @param file
         */
        private function loadIni($file = null)
        {
            if ($file == null) {
                $file = __DIR__ . DIRECTORY_SEPARATOR . "_resources" . DIRECTORY_SEPARATOR . "webservice.ini";
            }
            $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==loadIni==", ['Load from Ini File.']);
            if (file_exists($file)) {
                $ini_array = parse_ini_file(filter_var($file, FILTER_SANITIZE_STRING), true);
                if (array_key_exists("webservice_configuration", $ini_array)) {
                    $ws_config = $ini_array['webservice_configuration'];
                    $this->setNamespace($ws_config['namespace_ws']);
                    $this->setWsdl($ws_config['wsdl']);
                    $this->getCrefoLogger()->log(CrefoLogger::DEBUG, "==load wsdl info==", $ws_config);
                }
            }
        }

        /**
         * loads soap options
         * @method loadSoapOptions
         * @return array
         */
        private function loadSoapOptions()
        {
            $context = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ]);
            return [
                'trace' => 1,
                'exceptions' => true,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'soap_version' => SOAP_1_2,
                'features' => SOAP_USE_XSI_ARRAY_TYPE, //SOAP_SINGLE_ELEMENT_ARRAYS,
                'connection_timeout' => 30,
                'stream_context' => $context
            ];
        }

        /**
         * @method getSoapClient
         * @return \SoapClient
         */
        public function getSoapClient()
        {
            return $this->soapClient;
        }

        /**
         * @return string
         */
        public function getSoapError()
        {
            return $this->errorSoap;
        }

        function getNamespace()
        {
            return $this->namespace;
        }

        function getWsdl()
        {
            return $this->wsdl;
        }

        /**
         * @param $namespace
         */
        function setNamespace($namespace)
        {
            $this->namespace = $namespace;
        }

        /**
         * @param $wsdl
         */
        function setWsdl($wsdl)
        {
            $this->wsdl = $wsdl;
        }

        /**
         * @return string|null
         */
        public function getLastSoapCallRequest()
        {
            $lastRequest = null;
            try {
                if(is_null($this->soapClient)){
                    throw new \Exception('The soap client is not initialized.');
                }
                $lastRequest = $this->soapClient->__getLastRequest();
            } catch (\Exception $e) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==getLastSoapCallRequest==",
                    ["No last soap call for request was found."]);
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
                if(is_null($this->soapClient)){
                    throw new \Exception('The soap client is not initialized.');
                }
                $lastResponse = $this->soapClient->__getLastResponse();
            } catch (\Exception $e) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==getLastSoapCallResponse==",
                    ["No last soap call for response was found."]);
            }
            return $lastResponse;
        }
    }
}
