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

namespace CrefoShopwarePlugIn\Components\Soap\Parsers;

use \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;

/**
 * Class CollectionOrderParser
 * @package CrefoShopwarePlugIn\Components\Soap\Parsers
 */
class CollectionOrderParser extends CrefoSoapParser
{

    const FILE_NUMBER = "filenumber";

    /**
     * @return null|Object
     */
    public function extractFileNumber()
    {
        return $this->getBody(self::FILE_NUMBER);
    }

}
