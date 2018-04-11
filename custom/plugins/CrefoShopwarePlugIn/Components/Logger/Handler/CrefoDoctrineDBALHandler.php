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

use \Shopware\Components\Log\Handler\DoctrineDBALHandler;

/**
 * Class CrefoDoctrineDBALHandler
 * @package CrefoShopwarePlugIn\Components\Logger\Handler
 */
class CrefoDoctrineDBALHandler extends DoctrineDBALHandler
{

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        if (isset($record['context']['table'])) {
            $record = $record['context']['table'];
        } elseif (isset($record['context'])) {
            $record = $record['context'];
        }

        parent::write($record);
    }

}
