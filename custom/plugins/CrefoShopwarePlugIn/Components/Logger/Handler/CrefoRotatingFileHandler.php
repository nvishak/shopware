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

namespace CrefoShopwarePlugIn\Components\Logger\Handler;

use \Monolog\Handler\RotatingFileHandler;

/**
 * Class CrefoRotatingFileHandler
 * @package CrefoShopwarePlugIn\Components\Logger\Handler
 */
class CrefoRotatingFileHandler extends RotatingFileHandler
{

    const CREFO_TECH_LOG = 1;

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {

        if (isset($record['context']) && ($record['context']['logType'] === self::CREFO_TECH_LOG || $record['context']['table']['logType'] === self::CREFO_TECH_LOG)) {
            parent::write($record);
        }
    }
}
