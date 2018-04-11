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

namespace CrefoShopwarePlugIn\Components\Core;

/**
 * Class XmlManager
 * @package CrefoShopwarePlugIn\Components\Core
 */
class XmlManager implements Manager
{

    /**
     * ZipManager constructor.
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
        $noStripsData = stripslashes($data);
        if (strpos($noStripsData, '<?xml version="1.0" encoding') !== false) {
            $noStripsData = stripslashes($data);
        } elseif (strpos($noStripsData, '<?xml version="1.0"?>') === false) {
            $noStripsData = '<?xml version="1.0" encoding="UTF-8"?>' . $noStripsData;
        } else {
            $noStripsData = str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>',
                $noStripsData);
        }
        $domxml = new \DOMDocument('1.0', 'UTF-8');
        $domxml->preserveWhiteSpace = false;
        $domxml->formatOutput = true;
        try {
            $xml = simplexml_load_string($noStripsData);
            if (!is_object($xml)) {
                throw new \Exception('Not an XML File.');
            }
            $domxml->loadXML($xml->asXML());
        } catch (\Exception $e) {
            $xmlError = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><Error>Error</Error>');
            $domxml->loadXML($xmlError->asXML());
        } finally {
            return $domxml->saveXML();
        }
    }

    /**
     * @param string $data
     * @param string $nameXML
     */
    public function saveXMLToFile($data, $nameXML)
    {
        file_put_contents($nameXML, $this->formatXmlPretty($data));
    }

}
