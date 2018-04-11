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

use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class CrefoSoapParser
 */
class CrefoSoapParser
{
    const STARS_TEXT_REPLACEMENT = '*****';
    const REPLACE_PASS_PATTERN = "/(?<=password>).{1,20}(?=<\/(.)*password>)/iu";
    protected $rawResponse;
    protected $crefoMapper;

    /**
     * CrefoSoapParser constructor.
     *
     * @codeCoverageIgnore
     *
     * @param CrefoMapper $crefoMapper
     */
    public function __construct(CrefoMapper $crefoMapper)
    {
        $this->crefoMapper = $crefoMapper;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param $rawSoapResponse
     */
    public function setRawResponse($rawSoapResponse)
    {
        $this->rawResponse = $rawSoapResponse;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param CrefoMapper $crefoMapper
     */
    public function setCrefoMapper(CrefoMapper $crefoMapper)
    {
        $this->crefoMapper = $crefoMapper;
    }

    /**
     * @param $serviceName
     * @param $keyName
     * @param array $array
     *
     * @return array
     */
    public function extractKeysAndValuesFromWS($serviceName, $keyName, array $array = [])
    {
        try {
            $service = $this->getService($serviceName);
            if (null === $service) {
                $array[] = ['no_service' => true];

                return $array;
            }
            $keys = $this->getAllowedKeys($service, $keyName);
            if (null === $keys) {
                $array[] = ['no_keys' => true];

                return $array;
            }
            $i = count($array);
            foreach ($keys as $keyconstraint) {
                if (is_object($keyconstraint) && isset($keyconstraint->keycontent)) {
                    $keycontent = $keyconstraint->keycontent;
                    if (is_object($keycontent) && null !== $keycontent->key && null !== $keycontent->designation) {
                        $array[] = ['id' => $i, 'keyWS' => $keycontent->key, 'textWS' => $keycontent->designation];
                        ++$i;
                    }
                } elseif (is_array($keyconstraint)) {
                    foreach ($keyconstraint as $keycontentObject) {
                        $keycontent = $keycontentObject->keycontent;
                        if (is_object($keycontent) && null !== $keycontent->key && null !== $keycontent->designation) {
                            $array[] = ['id' => $i, 'keyWS' => $keycontent->key, 'textWS' => $keycontent->designation];
                            ++$i;
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            // @codeCoverageIgnoreStart
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==extractKeysAndValuesFromWS>>Exception ' . date('Y-m-d H:i:s') . '==', (array) $ex);
            // @codeCoverageIgnoreEnd
        }

        return $array;
    }

    /**
     * @return string
     */
    public function getServiceTimeStamp()
    {
        $response = $this->rawResponse;
        try {
            if ($response instanceof \SoapFault && isset($response->detail->servicefault->header->transmissiontimestamp)) {
                return $response->detail->servicefault->header->transmissiontimestamp;
            } elseif (isset($response->header->transmissiontimestamp)) {
                return $this->rawResponse->header->transmissiontimestamp;
            }
        } catch (\Exception $e) {
            // @codeCoverageIgnoreStart
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==getServiceTimeStamp>>Exception ' . date('Y-m-d H:i:s') . '==', (array) $e);
            // @codeCoverageIgnoreEnd
        }

        return date("Y-m-d\TH:i:s");
    }

    /**
     * Returns soap errors as array.
     *
     * @method getSoapErrors
     *
     * @param string $lang
     *
     * @return array
     */
    public function getSoapErrors($lang = 'de')
    {
        $errorArray = [];
        if (is_soap_fault($this->rawResponse)) {
            $soapFault = (object) $this->rawResponse;
            if (isset($soapFault->detail->servicefault) && !empty($soapFault->detail->servicefault)) {
                $errorArray['title'] = $soapFault->detail->servicefault->body->errorkey->designation;
                $faults = [];
                $body = $soapFault->detail->servicefault->body;
                $numFaults = count($body->fault);
                if ($numFaults > 1) {
                    for ($i = 0; $i < $numFaults; ++$i) {
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
     * @param string $rawXml
     *
     * @return string
     */
    public function extractTextTitleFromStringXml($rawXml)
    {
        if (!is_string($rawXml)) {
            return '';
        }
        $xml = simplexml_load_string($rawXml);
        $namespaces = $xml->getNamespaces(true);
        // @codeCoverageIgnoreStart
        if (!count($namespaces)) {
            $namespaces = ['' => null];
        }
        // @codeCoverageIgnoreEnd
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
            'path_dir' => '/',
        ]);
        if (strpos(strtolower($title), 'fault') !== false) {
            $title = 'Fault';
        }

        return $title;
    }

    /**
     * @method removePasswordsTxtFromXML
     *
     * @param string $lastRequest
     *
     * @return string
     */
    public function removePasswordsTxtFromXML($lastRequest)
    {
        $newText = '';
        try {
            $newText .= preg_replace(self::REPLACE_PASS_PATTERN, self::STARS_TEXT_REPLACEMENT, $lastRequest);
        } catch (\Exception $e) {
            // @codeCoverageIgnoreStart
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                '==removePasswordsTxtFromXML>>Exception' . date('Y-m-d H:i:s') . '==', (array) $e);
            // @codeCoverageIgnoreEnd
        }

        return $newText;
    }

    /**
     * @param string $rawXml
     *
     * @return array
     */
    public function getSoapErrorsFromXml($rawXml)
    {
        if (!$this->isGeneratedErrorXml($rawXml)) {
            $response = $this->getSoapErrorsFromRealXml($rawXml);
        } else {
            $xml = simplexml_load_string($rawXml, 'SimpleXMLElement', 0, '', true);

            return ['title' => '', 'errorCode' => '0', 'errorText' => '' . $xml];
        }
        $this->setRawResponse($response);

        return $this->getSoapErrors();
    }

    /**
     * @param mixed       $container
     * @param string      $fieldName
     * @param null|string $fieldValue
     *
     * @return null|array|object
     */
    public function getFieldFromContainer($container, $fieldName, $fieldValue = null)
    {
        if (is_object($container)) {
            if (isset($container->$fieldName) && (null === $fieldValue || is_array($container->$fieldName) || strcmp(strtolower($container->$fieldName), strtolower($fieldValue)) == 0)) {
                return $container->$fieldName;
            }
        } elseif (is_array($container)) {
            foreach ($container as $subContainer) {
                if (isset($subContainer->$fieldName) && (null === $fieldValue || is_array($subContainer->$fieldName) || strcmp(strtolower($subContainer->$fieldName), strtolower($fieldValue)) == 0)) {
                    return $subContainer->$fieldName;
                }
            }
        }

        return null;
    }

    /**
     * @param $object - a body component
     *
     * @return null|object
     */
    protected function getBody($object = null)
    {
        if (null !== $object && isset($this->rawResponse->body->$object)) {
            return $this->rawResponse->body->$object;
        }

        return isset($this->rawResponse->body) ? $this->rawResponse->body : $this->rawResponse;
    }

    /**
     * @param $serviceName
     *
     * @return null|object
     */
    protected function getService($serviceName)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getService::check-serviceName==', [$serviceName]);
        $services = $this->getBody('service');
        if (is_array($services) || is_object($services)) {
            foreach ($services as $service) {
                if (strcmp($service->operation, $serviceName) == 0) {
                    return $service;
                }
            }
        }

        return null;
    }

    /**
     * @param $service
     * @param string $allowedKeyName
     *
     * @return mixed
     * @return null|array
     */
    protected function getAllowedKeys($service, $allowedKeyName)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getAllowedKeys::check-service==', [$service]);
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==getAllowedKeys::check-allowedKeyName==', [$allowedKeyName]);
        if (is_object($service->allowedkeys) && $service->allowedkeys instanceof \stdClass) {
            if (isset($service->allowedkeys->keyname) && strcmp(mb_strtolower($service->allowedkeys->keyname),
                    mb_strtolower($allowedKeyName)) == 0
            ) {
                return $service->allowedkeys;
            }
        } else {
            foreach ($service->allowedkeys as $allowedKey) {
                if (isset($allowedKey->keyname) && strcmp(mb_strtolower($allowedKey->keyname),
                        mb_strtolower($allowedKeyName)) == 0
                ) {
                    return $allowedKey;
                }
            }
        }

        return null;
    }

    /**
     * @param object|array $fault
     * @param string       $lang
     *
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
     * @param array  $faultArray
     * @param string $lang
     *
     * @return array
     */
    private function extractOneFault($fault, array $faultArray, $lang = 'de')
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
            }
        }

        return $faultArray;
    }

    /**
     * @param \SimpleXMLElement $xml
     * @param array             $namespaces
     * @param array             $nsArgs     [string $prefix, string $searchedPrefix, null $searchedName, string $path, string $path_dir]
     *
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
            'path_dir' => '/',
        ]
    ) {
        $dname = (!empty($nsArgs['prefix']) ? $nsArgs['prefix'] . ':' : '') . $xml->getName();
        $name = (!empty($nsArgs['prefix']) ? $nsArgs['prefix'] . ':' : '__ns') . $xml->getName();
        $path_dir = $nsArgs['path_dir'] . $name;
        $cpath = $nsArgs['path'] . '<' . $dname . '>';
        $searchedName = $nsArgs['searchedName'];
        if ($nsArgs['prefix'] === $nsArgs['searchedPrefix']) {
            $searchedName = $xml->getName();
        }
        if ((string) $xml !== '') {
            $list[$path_dir] = $cpath;
        }
        foreach ($namespaces as $prefix => $ns) {
            foreach ($xml->children($ns) as $xml_child) {
                if (null === $searchedName) {
                    $searchedName = $this->getFirstXMLChildWithNs($xml_child, $namespaces, [
                        'prefix' => $prefix,
                        'searchedPrefix' => $nsArgs['searchedPrefix'],
                        'searchedName' => $searchedName,
                        'path' => $cpath . '',
                        'path_dir' => $path_dir . '/',
                    ]);
                }
            }
        }

        return $searchedName;
    }

    /**
     * @param string $rawXml
     *
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
        $xml = simplexml_load_string($modifiedXml, 'SimpleXMLElement', 0, $searchedPrefix, true);
        $soapFault = new \SoapFault('1', 'Receiver', 'FaultMsg', $xml->Body->Fault->Detail);

        return $soapFault;
    }

    /**
     * @param string $rawXml
     *
     * @return bool
     */
    private function isGeneratedErrorXml($rawXml)
    {
        if (strpos($rawXml, '<Error>') !== false) {
            return true;
        }

        return false;
    }

    /**
     * @param string $rawXml
     *
     * @return array
     */
    private function getNamespacesFromXml($rawXml)
    {
        $xml = simplexml_load_string($rawXml);
        if ($xml === false) {
            // @codeCoverageIgnoreStart
            return [];
            // @codeCoverageIgnoreEnd
        }

        return $xml->getNamespaces(true);
    }
}
