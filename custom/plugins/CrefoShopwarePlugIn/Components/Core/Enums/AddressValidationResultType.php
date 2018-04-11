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
 * Class AddressValidationResultType
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class AddressValidationResultType
{
    const IDENTIFIED = 0;
    const IDENTIFIED_AND_CORRECTED = 2;
    const UNIDENTIFIED = 1;

    private static $addressAllowedKeys = [
        self::IDENTIFIED => 'CGADVARU-1',
        self::IDENTIFIED_AND_CORRECTED => 'CGADVARU-2',
        self::UNIDENTIFIED => 'CGADVARU-3'
    ];

    private static $positiveAddressIdentification = [
        self::IDENTIFIED => 'CGADVARU-1',
        self::IDENTIFIED_AND_CORRECTED => 'CGADVARU-2'
    ];

    private static $addressAcronyms = [
        self::IDENTIFIED => 'Adr V',
        self::IDENTIFIED_AND_CORRECTED => 'Adr VK',
        self::UNIDENTIFIED => 'X Adr'
    ];

    /**
     * @return array
     */
    final public static function getValidationAddresses()
    {
        return self::$addressAllowedKeys;
    }

    /**
     * @return array
     */
    final public static function getPositiveValidationAddresses()
    {
        return self::$positiveAddressIdentification;
    }

    /**
     * @return array
     */
    final public static function getAddressesAcronyms()
    {
        return self::$addressAcronyms;
    }

    /**
     * @param null|integer $id
     * @param null|string $key
     * @return string|null
     */
    final public static function getAddressAcronym($id = null, $key = null)
    {
        if (!is_null($id)) {
            return self::$addressAcronyms[$id];
        }
        if (!is_null($key)) {
            $flippedArray = array_flip(self::$addressAllowedKeys);
            return self::getAddressAcronym($flippedArray[$key]);
        }
        return null;
    }
}
