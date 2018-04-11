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

namespace CrefoShopwarePlugIn\Components\Core\Enums;

/**
 * Class PrivatePersonProductsType
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class PrivatePersonProductsType
{
    const BONIMA_SCORE_POOL_IDENT = 0;
    const BONIMA_SCORE_POOL_IDENT_PREMIUM = 1;

    private static $allowedProducts = [
        self::BONIMA_SCORE_POOL_IDENT => 'PRTY-12301',
        self::BONIMA_SCORE_POOL_IDENT_PREMIUM => 'PRTY-12302'
    ];

    /**
     * @return array
     */
    final public static function AllowedProducts()
    {
        return self::$allowedProducts;
    }
}
