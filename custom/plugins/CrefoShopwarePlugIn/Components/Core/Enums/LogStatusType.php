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

namespace CrefoShopwarePlugIn\Components\Core\Enums;

/**
 * @codeCoverageIgnore
 * Class LogStatusType
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class LogStatusType
{
    /**
     * log not saved, can be deleted by the cron job
     */
    const NOT_SAVED = 0;
    /**
     * saves log to not be deleted by the cron job
     */
    const SAVE_AND_SHOW = 1;
    /**
     * saves the log from deletion and will not show in the log list
     * but will save in the export Zip
     */
    const SAVE_AND_NOT_SHOW = 2;
}