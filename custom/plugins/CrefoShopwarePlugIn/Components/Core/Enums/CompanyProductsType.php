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
 * Class CompanyProductsType
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class CompanyProductsType
{
    const RISIKOCHECK = 0;
    const ECREFO = 1;

    private static $allowedProducts = [
        self::RISIKOCHECK => 'PRTY-6',
        self::ECREFO => 'PRTY-7'
    ];

    /**
     * @return array
     */
    final public static function AllowedProducts()
    {
        return self::$allowedProducts;
    }
}
