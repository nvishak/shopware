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

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class XmlManager
 * @package CrefoShopwarePlugIn\Components\Core
 */
class XmlManager implements Manager
{

    /**
     * ZipManager constructor.
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        mb_internal_encoding("UTF-8");
    }

    /**
     * @param string $data
     * @return string
     */
    public function formatXmlPretty($data)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==XmlManager::formatXmlPretty==',[]);
        $noStripsData = stripslashes($data);
        if (strpos($noStripsData, '<?xml version="1.0" encoding') !== false) {
            $noStripsData = stripslashes($data);
        } elseif (strpos($noStripsData, '<?xml version="1.0"?>') === false) {
            $noStripsData = '<?xml version="1.0" encoding="UTF-8"?>' . $noStripsData;
        } else {
            $noStripsData = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>',
                $noStripsData);
        }
        $domXml = new \DOMDocument('1.0', 'UTF-8');
        $domXml->preserveWhiteSpace = false;
        $domXml->formatOutput = true;
        try {
            $xml = simplexml_load_string($noStripsData);
            // @codeCoverageIgnoreStart
            if (!is_object($xml)) {
                throw new \Exception('Not an XML File.');
            }
            // @codeCoverageIgnoreEnd
            $domXml->loadXML($xml->asXML());
        } catch (\Exception $e) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==XmlManager::Error==',[$e]);
            $xmlError = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><Error>Error</Error>');
            $domXml->loadXML($xmlError->asXML());
        }// @codeCoverageIgnoreStart
        finally {
            return $domXml->saveXML();
        }
    }// @codeCoverageIgnoreEnd

    /**
     * @param string $data
     * @param string $nameXML
     */
    public function saveXMLToFile($data, $nameXML)
    {
        file_put_contents($nameXML, $this->formatXmlPretty($data));
    }

}
