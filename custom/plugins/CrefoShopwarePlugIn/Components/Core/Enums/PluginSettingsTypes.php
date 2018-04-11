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
 * Class PluginSettingsTypes
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class PluginSettingsTypes
{
    private static $LogsMaxStorageTime = [
        0 => 6,
        1 => 12,
        2 => 18
    ];

    private static $LogsMaxNumberRequests = [
        0 => 1000,
        1 => 5000,
        2 => 10000
    ];

    /**
     * @return array
     */
    final public static function LogsMaxStorageTime()
    {
        return self::$LogsMaxStorageTime;
    }

    /**
     * @return array
     */
    final public static function LogsMaxNumberRequests()
    {
        return self::$LogsMaxNumberRequests;
    }
}
