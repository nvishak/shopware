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

use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class CrefoSoapParser
 * @package CrefoShopwarePlugIn\Components\Soap
 */
class CrefoSoapParser
{
    protected $rawResponse;
    protected $crefoMapper;

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
     * CrefoSoapParser constructor.
     * @param CrefoMapper $crefoMapper
     */
    public function __construct(CrefoMapper $crefoMapper)
    {
        $this->crefoMapper = $crefoMapper;
    }

    /**
     * @param $rawSoapResponse
     */
    public function setRawResponse($rawSoapResponse)
    {
        $this->rawResponse = $rawSoapResponse;
    }

    /**
     * @param CrefoMapper $crefoMapper
     */
    public function setCrefoMapper(CrefoMapper $crefoMapper)
    {
        $this->crefoMapper = $crefoMapper;
    }

    /**
     * @param $object - a body component
     * @return null|Object
     */
    protected function getBody($object = null)
    {
        if (!is_null($object) && isset($this->rawResponse->body->$object)) {
            return $this->rawResponse->body->$object;
        } else {
            return isset($this->rawResponse->body) ? $this->rawResponse->body : $this->rawResponse;
        }
    }

    /**
     * @param $serviceName
     * @return null|Object
     */
    protected function getService($serviceName)
    {
        $services = $this->getBody("service");
        foreach ($services as $service) {
            if (strcmp($service->operation, $serviceName) == 0) {
                return $service;
            }
        }
        return null;
    }

    /**
     * @param $service
     * @param string $allowedKeyName
     * @return mixed
     * @return null|array
     */
    protected function getAllowedKeys($service, $allowedKeyName)
    {
        if (is_object($service->allowedkeys) && $service->allowedkeys instanceof \stdClass) {
            if (isset($service->allowedkeys->keyname) && strcmp(mb_strtolower($service->allowedkeys->keyname),
                    mb_strtolower($allowedKeyName)) == 0
            ) {
                return $service->allowedkeys;
            }
        } else {
            foreach ($service->allowedkeys as $allowedkey) {
                if (isset($allowedkey->keyname) && strcmp(mb_strtolower($allowedkey->keyname),
                        mb_strtolower($allowedKeyName)) == 0
                ) {
                    return $allowedkey;
                }
            }
        }
        return null;
    }

    /**
     * @param $serviceName
     * @param $keyName
     * @param array $array
     * @return array
     */
    public function extractKeysAndValuesFromWS($serviceName, $keyName, array $array = [])
    {
        try {
            $service = $this->getService($serviceName);
            if (is_null($service)) {
                $array[] = ["no_service" => true];
                return $array;
            }
            $keys = $this->getAllowedKeys($service, $keyName);
            if (is_null($keys)) {
                $array[] = ["no_keys" => true];
                return $array;
            }
            $i = count($array);
            foreach ($keys as $keyconstraint) {
                if (is_object($keyconstraint) && isset($keyconstraint->keycontent)) {
                    $keycontent = $keyconstraint->keycontent;
                    if (is_object($keycontent) && !is_null($keycontent->key) && !is_null($keycontent->designation)) {
                        $array[] = ["id" => $i, "keyWS" => $keycontent->key, "textWS" => $keycontent->designation];
                        $i++;
                    }
                } elseif (is_array($keyconstraint)) {
                    foreach ($keyconstraint as $keycontentObject) {
                        $keycontent = $keycontentObject->keycontent;
                        if (is_object($keycontent) && !is_null($keycontent->key) && !is_null($keycontent->designation)) {
                            $array[] = ["id" => $i, "keyWS" => $keycontent->key, "textWS" => $keycontent->designation];
                            $i++;
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==extractKeysAndValuesFromWS>>Exception " . date("Y-m-d H:i:s") . "==", (array)$ex);
        }
        return $array;
    }

    /**
     * @return string
     */
    public function getServiceTimeStamp()
    {
        $response = $this->rawResponse;
        if ($response instanceof \SoapFault && isset($response->detail->servicefault->header->transmissiontimestamp)) {
            return $response->detail->servicefault->header->transmissiontimestamp;
        } elseif (isset($response->header->transmissiontimestamp)) {
            return $this->rawResponse->header->transmissiontimestamp;
        }
        return date("Y-m-d\TH:i:s");
    }

    /**
     * Returns soap errors as array.
     * @method getSoapErrors
     * @param string $lang
     * @return array
     */
    public function getSoapErrors($lang = "de")
    {
        $errorArray = [];
        if (is_soap_fault($this->rawResponse)) {
            $soapFault = (object)$this->rawResponse;
            if (isset($soapFault->detail->servicefault) && !empty($soapFault->detail->servicefault)) {
                $errorArray['title'] = $soapFault->detail->servicefault->body->errorkey->designation;
                $faults = [];
                $body = $soapFault->detail->servicefault->body;
                $numFaults = count($body->fault);
                if ($numFaults > 1) {
                    for ($i = 0; $i < $numFaults; $i++) {
                        $faults[] = $body->fault[$i];
                    }
                } else {
                    $faults[] = $body->fault;
                }
                $errorArray['faults'] = $this->resolveFaults($faults, $lang);
            } elseif (isset($soapFault->detail->validationfault)) {
                $errorArray['title'] = $soapFault->detail->validationfault;
                $errorArray['validationfault'] = $soapFault->detail->validationfault;
            }
        } elseif ($this->rawResponse instanceof CrefoCommunicationException) {
            $errorArray['title'] = $this->rawResponse->getMessage();
            $errorArray['errorCode'] = $this->rawResponse->getCode();
        } elseif ($this->rawResponse instanceof \Exception) {
            $errorArray['title'] = $this->rawResponse->getMessage();
            $errorArray['errorCode'] = $this->rawResponse->getCode();
        }
        return $errorArray;
    }

    /**
     * @param object|array $fault
     * @param string $lang
     * @return array
     */
    private function resolveFaults($faults, $lang)
    {
        $faultArray = [];
        foreach ($faults as $fault) {
            $faultArray = $this->extractOneFault($fault, $faultArray, $lang);
        }
        return $faultArray;
    }

    /**
     * @param object $fault
     * @param array $faultArray
     * @param string $lang
     * @return array
     */
    private function extractOneFault($fault, array $faultArray, $lang = "de")
    {
        $index = 0;
        if (!empty($faultArray)) {
            $index = count($faultArray);
        }
        if (isset($fault->errorkey->designation)) {
            $faultArray[$index]['errortext'] = $fault->errorkey->designation;
            if (isset($fault->errorfield)) {
                $faultArray[$index]['errorfield'] = $this->crefoMapper->getFieldId($fault->errorfield);
                $faultArray[$index]['errorFieldLabel'] = $this->crefoMapper->getFieldLabel($fault->errorfield, $lang);
            };
        }
        return $faultArray;
    }

    /**
     * @param string $rawXml
     * @return string
     */
    public function extractTextTitleFromStringXml($rawXml)
    {
        if (!is_string($rawXml)) {
            return '';
        }
        $xml = simplexml_load_string($rawXml);
        $namespaces = $xml->getNamespaces(true);
        if (!count($namespaces)) {
            $namespaces = ['' => null];
        }
        $keysNS = array_keys($namespaces);
        $searchedPrefix = 'ns1';
        foreach ($keysNS as $key => $value) {
            if ($value !== 'xml' && $value !== 'env') {
                $searchedPrefix = $value;
            }
        }
        foreach ($namespaces as $prefix => $ns) {
            $xml->registerXPathNamespace(empty($prefix) ? '__ns' : $prefix, $ns);
        }
        $prefix = $keysNS[0];

        $title = $this->getFirstXMLChildWithNs($xml, $namespaces, [
            'prefix' => $prefix,
            'searchedPrefix' => $searchedPrefix,
            'searchedName' => null,
            'path' => '',
            'path_dir' => '/'
        ]);
        if (strpos(strtolower($title), 'fault') !== false) {
            $title = 'Fault';
        }
        return $title;
    }

    /**
     * @param \SimpleXMLElement $xml
     * @param array $namespaces
     * @param array $nsArgs [string $prefix, string $searchedPrefix, null $searchedName, string $path, string $path_dir]
     * @return null|string
     */
    private function getFirstXMLChildWithNs(
        \SimpleXMLElement $xml,
        array $namespaces,
        array $nsArgs = [
            'prefix' => '',
            'searchedPrefix' => '',
            'searchedName' => null,
            'path' => '',
            'path_dir' => '/'
        ]
    ) {
        ;
        $dname = (!empty($nsArgs['prefix']) ? $nsArgs['prefix'] . ':' : '') . $xml->getName();
        $name = (!empty($nsArgs['prefix']) ? $nsArgs['prefix'] . ':' : '__ns') . $xml->getName();
        $path_dir = $nsArgs['path_dir'] . $name;
        $cpath = $nsArgs['path'] . '<' . $dname . '>';
        $searchedName = $nsArgs['searchedName'];
        if ($nsArgs['prefix'] === $nsArgs['searchedPrefix']) {
            $searchedName = $xml->getName();
        }
        if ((string)$xml !== '') {
            $list[$path_dir] = $cpath;
        }
        foreach ($namespaces as $prefix => $ns) {
            foreach ($xml->children($ns) as $xml_child) {
                if (is_null($searchedName)) {
                    $searchedName = $this->getFirstXMLChildWithNs($xml_child, $namespaces, [
                        'prefix' => $prefix,
                        'searchedPrefix' => $nsArgs['searchedPrefix'],
                        'searchedName' => $searchedName,
                        'path' => $cpath . '',
                        'path_dir' => $path_dir . '/'
                    ]);
                }
            }
        }
        return $searchedName;
    }

    /**
     * @method removePasswordsTxtFromXML
     * @param  string $lastRequest
     * @return string
     */
    public function removePasswordsTxtFromXML($lastRequest)
    {
        $newText = "";
        try {
            $pattern = "/password>([^<]){1,20}<\//";
            $replacement = "password>*****</";
            $newText .= preg_replace($pattern, $replacement, $lastRequest);
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==removePasswordsTxtFromXML>>Exception" . date("Y-m-d H:i:s") . "==", (array)$e);
        }
        return $newText;
    }

    /**
     * @param string $rawXml
     * @return array
     */
    public function getSoapErrorsFromXml($rawXml)
    {
        if (!$this->isGeneratedErrorXml($rawXml)) {
            $response = $this->getSoapErrorsFromRealXml($rawXml);
        } else {
            $xml = simplexml_load_string($rawXml, "SimpleXMLElement", 0, '', true);
            return ['title' => '', 'errorCode' => '0', 'errorText' => ''.$xml];
        }
        $this->setRawResponse($response);
        return $this->getSoapErrors();
    }

    /**
     * @param string $rawXml
     * @return \SoapFault
     */
    private function getSoapErrorsFromRealXml($rawXml)
    {
        $namespaces = $this->getNamespacesFromXml($rawXml);

        $keysNS = array_keys($namespaces);
        $searchedPrefix = 'ns1';
        foreach ($keysNS as $key => $value) {
            if ($value !== 'xml' && $value !== 'env') {
                $searchedPrefix = $value;
            }
        }
        $modifiedXml = $rawXml;
        foreach ($keysNS as $prefix) {
            if ($prefix !== $searchedPrefix) {
                $modifiedXml = preg_replace('/(' . $prefix . ':)/', $searchedPrefix . ':', $modifiedXml);
                $modifiedXml = preg_replace('/(xmlns:' . $prefix . ')/', 'xmlns:' . $searchedPrefix, $modifiedXml);
            }
        }
        $xml = simplexml_load_string($modifiedXml, "SimpleXMLElement", 0, $searchedPrefix, true);
        $soapFault = new \SoapFault('1', 'Receiver', 'FaultMsg', $xml->Body->Fault->Detail);
        return $soapFault;
    }

    /**
     * @param string $rawXml
     * @return bool
     */
    private function isGeneratedErrorXml($rawXml)
    {
        if (strpos($rawXml, "<Error>") !== false) {
            return true;
        }
        return false;
    }

    /**
     * @param string $rawXml
     * @return array
     */
    private function getNamespacesFromXml($rawXml)
    {
        $xml = simplexml_load_string($rawXml);
        if ($xml === false) {
            return [];
        }
        return $xml->getNamespaces(true);
    }

    /**
     * @param string $container
     * @param string $fieldName
     * @param null|string $fieldValue
     * @return null|array|object
     */
    public function getFieldFromContainer($container, $fieldName, $fieldValue = null)
    {
        if (is_object($container)) {
            if (isset($container->$fieldName) && (is_null($fieldValue) || is_array($container->$fieldName) || strcmp(strtolower($container->$fieldName),
                        strtolower($fieldValue)) == 0)
            ) {
                return $container->$fieldName;
            }
        } elseif (is_array($container)) {
            foreach ($container as $subContainer) {
                if (isset($subContainer->$fieldName) && (is_null($fieldValue) || is_array($subContainer->$fieldName) || strcmp(strtolower($subContainer->$fieldName),
                            strtolower($fieldValue)) == 0)
                ) {
                    return $subContainer->$fieldName;
                }
            }
        }
        return null;
    }
}
