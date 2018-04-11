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
 * Class IdentificationResultType
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class IdentificationResultType
{
    const IDENTIFIED = 0;
    const UNIDENTIFIED = 1;
    const PERSON_IDENTIFIED = 2;
    const HOUSEHOLD_IDENTIFIED = 3;
    const BUILDING_IDENTIFIED = 4;
    const PERSON_UNIDENTIFIED = 5;
    const PERSON_DIED = 6;

    private static $keys = [
        PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT => [
            self::UNIDENTIFIED => 'CGIDRU-0',
            self::IDENTIFIED => 'CGIDRU-1'
        ],
        PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT_PREMIUM => [
            self::PERSON_IDENTIFIED => 'CGIDRU-2',
            self::HOUSEHOLD_IDENTIFIED => 'CGIDRU-3',
            self::BUILDING_IDENTIFIED => 'CGIDRU-5',
            self::PERSON_UNIDENTIFIED => 'CGIDRU-0'
        ]
    ];

    private static $identificationAcronyms = [
        self::UNIDENTIFIED => 'X Ident',
        self::IDENTIFIED => 'Ident PH',
        self::PERSON_IDENTIFIED => 'Ident P',
        self::HOUSEHOLD_IDENTIFIED => 'Ident H',
        self::BUILDING_IDENTIFIED => 'Ident G',
        self::PERSON_UNIDENTIFIED => 'X Ident P',
        self::PERSON_DIED => 'Ident PX'
    ];

    private static $identificationAcronymsFromKeys = [
        'CGIDRU-0' => 'X Ident',
        'CGIDRU-1' => 'Ident PH',
        'CGIDRU-2' => 'Ident P',
        'CGIDRU-3' => 'Ident H',
        'CGIDRU-4' => 'X Ident P',
        'CGIDRU-5' => 'Ident G',
        'CGIDRU-6' => 'Ident PX'
    ];

    /**
     * @param int $productId
     * @return array
     */
    final public static function getIdentificationKeys($productId)
    {
        return self::$keys[$productId];
    }

    /**
     * @param $key
     * @return array
     */
    final public static function getIdentificationAcronyms($key = null)
    {
        if (null !== $key) {
            return self::$identificationAcronymsFromKeys[$key];
        }
        return self::$identificationAcronyms;
    }
}
