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
 * Class AmountRequestsType
 */
abstract class AmountRequestsType
{
    private static $amountRequestsLevels = [
        0 => 10,
        1 => 50,
        2 => 100,
        3 => 500,
        4 => 1000,
    ];

    /**
     * @params int $level
     *
     * @return int
     */
    final public static function getAmountRequestsValue($level)
    {
        if ($level === null) {
            return self::$amountRequestsLevels[2];
        }

        return self::$amountRequestsLevels[$level];
    }
}
