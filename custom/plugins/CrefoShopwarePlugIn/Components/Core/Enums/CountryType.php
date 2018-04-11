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
 * Class CountryType
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class CountryType
{
    const AT = 0;
    const DE = 1;
    const LU = 2;

    public static $lowerCaseISO2Countries = [
        self::AT => 'at',
        self::DE => 'de',
        self::LU => 'lu',
    ];

    /**
     * @param null|int $countryType
     *
     * @return array|string
     */
    public static function uppercaseISO2Countries($countryType = null)
    {
        if (null !== $countryType) {
            return strtoupper(self::$lowerCaseISO2Countries[$countryType]);
        }

        return array_map('strtoupper', self::$lowerCaseISO2Countries);
    }

    /**
     * @param string $country
     *
     * @return int
     */
    public static function getCountryIdFromISO2($country)
    {
        $countries = array_flip(self::$lowerCaseISO2Countries);

        return $countries[strtolower($country)];
    }

    /**
     * @return array
     */
    public static function getAllowedCountriesISOForCompanies(){
        return [
            self::uppercaseISO2Countries(self::DE),
            self::uppercaseISO2Countries(self::AT),
            self::uppercaseISO2Countries(self::LU),
        ];
    }
    /**
     * @return array
     */
    public static function getAllowedCountriesISOForPrivatePerson(){
        return [
            self::uppercaseISO2Countries(self::DE),
        ];
    }
}
