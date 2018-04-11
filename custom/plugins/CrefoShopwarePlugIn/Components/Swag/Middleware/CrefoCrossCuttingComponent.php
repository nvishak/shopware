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

namespace CrefoShopwarePlugIn\Components\Swag\Middleware;

use CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use \CrefoShopwarePlugIn\CrefoShopwarePlugIn;
use \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs;
use \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig;
use \CrefoShopwarePlugIn\Components\Core\Enums\IdentificationResultType;

/**
 * Class CrefoCrossCuttingComponent
 * @package CrefoShopwarePlugIn\Components\Swag\Middleware
 */
class CrefoCrossCuttingComponent
{

    const DATE_FORMAT = 'Y-m-d\TH:i:s';
    const ERROR = 'Error';

    /**
     * @return \Shopware
     */
    public static function getShopwareInstance()
    {
        return \Shopware();
    }

    /**
     * @param string $sqlQuery
     * @param array $valuesArray
     */
    public static function runQuery($sqlQuery, $valuesArray)
    {
        self::getShopwareInstance()->Db()->query($sqlQuery, $valuesArray);
    }

    /**
     * @return null|CrefoShopwarePlugIn
     */
    public static function getCreditreformPlugin()
    {
        $kernel = self::getShopwareInstance()->Container()->get('kernel');
        if (is_null($kernel)) {
            return null;
        }
        return $kernel->getPlugins()['CrefoShopwarePlugIn'];
    }

    /**
     * @param array $logs
     * @return int|array
     */
    public static function saveCrefoLogs(array $logs)
    {
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        $crefoLogs = new CrefoLogs();
        $crefoLogs->setStatusLogs($logs['log_status']);
        $crefoLogs->setTsResponse($logs['ts_response']);
        $crefoLogs->setTsProcessEnd($logs['tsProcessEnd']);
        $crefoLogs->setRequestXML($logs['requestXML']);
        $crefoLogs->setRequestXMLDescription($logs['requestXMLDescription']);
        $crefoLogs->setResponseXML($logs['responseXML']);
        $crefoLogs->setResponseXMLDescription($logs['responseXMLDescription']);
        $shopwareModels->persist($crefoLogs);
        $shopwareModels->flush();
        return $crefoLogs->getId();
    }

    /**
     * @param \CrefoShopwarePlugIn\Components\Core\RequestObject $request
     * @param String $xmlText
     * @param String $titleError
     * @return int
     */
    public static function saveUnsuccessfulRequestLog($request, $xmlText, $titleError)
    {
        $lastResponse = $xmlText;
        $respDesc = $titleError;
        $dateProcessEnd = new \DateTime('now');
        if (is_null($request->getLastSoapCallRequest())) {
            $lastRequestWithoutPassword = $xmlText;
            $reqDesc = $titleError;
            $dateReport = new \DateTime($request->getHeader()->getTransmissionTimestamp());
        } else {
            $lastRequest = $request->getLastSoapCallRequest();
            $reqDesc = $request->getCrefoParser()->extractTextTitleFromStringXml($lastRequest);
            $lastRequestWithoutPassword = $request->getCrefoParser()->removePasswordsTxtFromXML($lastRequest);
            $dateReport = new \DateTime($request->getCrefoParser()->getServiceTimeStamp());
        }
        $logArray = [
            'log_status' => LogStatusType::NOT_SAVED,
            'ts_response' => $dateReport->format(self::DATE_FORMAT),
            'tsProcessEnd' => $dateProcessEnd->format(self::DATE_FORMAT),
            'requestXML' => addslashes($lastRequestWithoutPassword),
            'requestXMLDescription' => $reqDesc,
            'responseXML' => addslashes($lastResponse),
            'responseXMLDescription' => $respDesc
        ];
        return self::saveCrefoLogs($logArray);
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\PrivatePersonReportResults $crefoResults
     * @return bool
     */
    public static function areScoreAndIdentificationResultSatisfied($crefoResults)
    {
        $satisfies = false;
        $configId = self::getCreditreformPlugin()->getConfigurationId(PrivatePersonConfig::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig $configPrivatePerson
         */
        $configPrivatePerson = self::getShopwareInstance()->Models()->find(PrivatePersonConfig::class, $configId);
        $arrayBonimaProducts = $configPrivatePerson->getProducts();
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson $product
         */
        foreach ($arrayBonimaProducts as $product) {
            $identificationKeys = array_flip(IdentificationResultType::getIdentificationKeys($product->getProductKeyWS()));
            if (array_key_exists($crefoResults->getIdentificationResult(), $identificationKeys)
                && $product->getIdentificationResult() === $identificationKeys[$crefoResults->getIdentificationResult()]
                && boolval($product->isProductAvailable())
                && !is_null($product->getProductScoreFrom())
                && !is_null($product->getProductScoreTo())
                && $product->getProductScoreFrom() <= $crefoResults->getScoreValue()
                && $product->getProductScoreTo() >= $crefoResults->getScoreValue()
            ) {
                $satisfies = true;
            }
        }
        return $satisfies;
    }
}
