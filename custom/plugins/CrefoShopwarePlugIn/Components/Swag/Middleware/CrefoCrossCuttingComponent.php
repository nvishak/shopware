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

namespace CrefoShopwarePlugIn\Components\Swag\Middleware;

use CrefoShopwarePlugIn\Components\Core\Enums\LogStatusType;
use CrefoShopwarePlugIn\Components\Versions\QueryAdapter;
use \CrefoShopwarePlugIn\CrefoShopwarePlugIn;
use \CrefoShopwarePlugIn\Models\CrefoLogs\CrefoLogs;
use \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig;
use \CrefoShopwarePlugIn\Components\Core\Enums\IdentificationResultType;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class CrefoCrossCuttingComponent
 * @package CrefoShopwarePlugIn\Components\Swag\Middleware
 * @codeCoverageIgnore
 */
class CrefoCrossCuttingComponent implements QueryAdapter
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
     * @param $sqlQuery
     * @param array $valuesArray
     * @param boolean $noResult
     * @return array|null
     */
    public function execQuery($sqlQuery, array $valuesArray = [], $hasResult = false)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CrefoCrossCuttingComponent::execQuery==',
            ['exec Query', 'query' => $sqlQuery, 'values' => $valuesArray]);
        $resultQuery = self::getShopwareInstance()->Db()->query($sqlQuery, $valuesArray);
        if($hasResult){
            return $resultQuery->fetchAll();
        }
        return null;
    }

    /**
     * @return null|CrefoShopwarePlugIn
     */
    public static function getCreditreformPlugin()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CrefoCrossCuttingComponent::getCreditreformPlugin==',
            ['get plugin']);
        $kernel = self::getShopwareInstance()->Container()->get('kernel');
        if (null === $kernel) {
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
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CrefoCrossCuttingComponent::saveCrefoLogs==',
            ['save logs']);
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
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==CrefoCrossCuttingComponent::saveUnsuccessfulRequestLog==',
            ['save unsuccessful logs']);
        $lastResponse = $xmlText;
        $respDesc = $titleError;
        $dateProcessEnd = new \DateTime('now');
        if (null === $request->getLastSoapCallRequest()) {
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
     * @param \Enlight_Components_Session_Namespace $session
     */
    public static function resetCrefoVariables($session){
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==resetCrefoVariables==', []);
        $session->offsetUnset('sCrefoConfigs');
        $session->offsetUnset('sCrefoCurrentConfig');
        $session->offsetUnset('sCrefoBadResponse');
        $session->offsetUnset('sCrefoReportResultId');
        $session->offsetUnset('sCrefoReportType');
        $session->offsetUnset('sCrefoCustomerBirthDate');
        $session->offsetUnset('sCrefoCustomerConsentDeclaration');
    }
}
