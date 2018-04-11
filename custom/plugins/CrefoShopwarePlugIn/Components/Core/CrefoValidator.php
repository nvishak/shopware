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

namespace CrefoShopwarePlugIn\Components\Core;

/**
 * Class CrefoValidator
 * @package CrefoShopwarePlugIn\Components\Core
 */
class CrefoValidator
{

    /**
     * CrefoValidator constructor.
     */
    public function __construct()
    {
        mb_internal_encoding("UTF-8");
    }

    /**
     * @param $postcodeRaw
     * @param string $country
     * @return bool|mixed|string
     */
    public function checkPostalCode($postcodeRaw, $country = "de")
    {
        if (is_array($postcodeRaw) || is_object($postcodeRaw)) {
            return false;
        }
        $postcode = trim($postcodeRaw);
        switch (mb_strtolower($country)) {
            case "lu":
            case "at":
                $postcode_length = 4;
                $postcode = preg_replace('/([^\d]+)/i', '', $postcode);
                break;
            case "de":
                $postcode_length = 5;
                $postcode = preg_replace('/([^\d]+)/i', '', $postcode);
                break;
            default:
                $postcode_length = 8;
        }
        if (mb_strlen($postcode) > $postcode_length) {
            $postcode = mb_substr($postcode, 0, $postcode_length - mb_strlen($postcode));
        }
        return $postcode;
    }

    /**
     * compute the street, house number and house affix
     * @param $rawAddress
     * @return array ['street', 'addressWithoutStreet', 'number', 'affix']
     */
    public function computeRawAddress($rawAddress)
    {
        $address = [];
        if (!is_string($rawAddress) && !is_numeric($rawAddress)) {
            return null;
        }
        $rawAddress = trim(strval($rawAddress));
        $addressTemp = $this->extractStreet($rawAddress);
        $address['street'] = trim($addressTemp['street']);
        $address['addressWithoutStreet'] = trim($addressTemp['addressWithoutStreet']);
        $addressTemp = $this->extractHouseNumber($addressTemp);
        $addressTemp = $this->extractHouseNumberAffix($addressTemp);
        if (array_key_exists('number', $addressTemp)) {
            $address['number'] = trim($addressTemp['number']);
        }
        if (array_key_exists('affix', $addressTemp)) {
            $address['affix'] = trim($addressTemp['affix']);
        }
        return $address;
    }

    /**
     * @param array $address
     * @return array
     */
    private function extractHouseNumber(array $address)
    {
        preg_match('/^[\d]+/', $address['addressWithoutStreet'], $matchesNum);
        if (count($matchesNum) > 0) {
            $address['number'] = trim($matchesNum[0]);
        }
        return $address;
    }

    /**
     * @param array $address
     * @return array
     */
    private function extractHouseNumberAffix(array $address)
    {
        $number = null;
        if (array_key_exists('number', $address)) {
            $affix = substr_replace($address['addressWithoutStreet'], "", 0, mb_strlen($address['number']));
            $affix === '' ? null : $address['affix'] = $affix;
        } elseif ($address['addressWithoutStreet'] !== '') {
            $address['affix'] = $address['addressWithoutStreet'];
        }
        return $address;
    }

    /**
     * @param string $rawAddress
     * @return array
     */
    private function extractStreet($rawAddress)
    {
        $address = [];
        //ignore the first 3 characters
        $prefix = mb_substr($rawAddress, 0, 3);
        $addressWithoutPrefix = mb_substr($rawAddress, 3);

        //extract the street
        preg_match('/^[\D]+/', $addressWithoutPrefix, $matches);
        if (count($matches) > 0) {
            $suffix = $matches[0]; //take only the first entry 0-is the full text
        } else {
            $suffix = "";
        }
        $address['street'] = $prefix . $suffix;

        if (mb_strlen($suffix) === 0) {
            $remainingAddress = $addressWithoutPrefix;
        } else {
            $remainingAddress = mb_substr($addressWithoutPrefix, mb_strlen($suffix), mb_strlen($addressWithoutPrefix));
        }
        $address['addressWithoutStreet'] = $remainingAddress;
        return $address;
    }

    /**
     * Formats float as currency based on given language
     *
     * @param float $currency
     * @param string $lang
     * @return string
     */
    public function formatCurrency($currency, $lang = 'de')
    {
        if (preg_match('/[a-z]{2}/i', $lang) == false) {
            $lang = 'de';
        }
        if (extension_loaded('intl')) {
            $formatter = new \NumberFormatter($lang, \NumberFormatter::DECIMAL);
            $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 2);
            if (preg_match('/\.|,/', $currency)) {
                $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 2);
            }
            return $formatter->format($currency);
        } else {
            if (is_numeric($currency) && (strlen($currency) > 2 && floatval($currency) >= 0 || strlen($currency) > 3 && floatval($currency) < 0)) {
                if (preg_match('/\.|,/', $currency)) {
                    return number_format(floatval($currency), 2, $this->getDecimalPoint($lang),
                        $this->getThousandsPoint($lang));
                } else {
                    return number_format(floatval($currency), 0, $this->getDecimalPoint($lang),
                        $this->getThousandsPoint($lang));
                }
            } else {
                $newCurrency = floatval($currency);
                if (strlen($newCurrency) != strlen($currency) && preg_match('/\d/', $currency)) {
                    $newCurrency .= $this->getDecimalPoint($lang) . '00';
                }
                if (strpos((string)$newCurrency, '.') !== false) {
                    return $this->formatCurrency($newCurrency, $lang);
                }
                return (string)$newCurrency;
            }
        }
    }

    /**
     * @param array $sourceArray
     * @param array $rulesArray
     * @return array
     */
    public function sanitizeInput(array $sourceArray, array $rulesArray)
    {
        $sanitizeObj = new CrefoSanitizer();
        $sanitizeObj->addRules($rulesArray);
        $sanitizeObj->addSource($sourceArray);
        $sanitizeObj->run();
        return $sanitizeObj->getSanitizedArray();
    }

    /**
     * @param string $lang
     * @return string
     */
    private function getDecimalPoint($lang = "de")
    {
        switch (strtolower($lang)) {
            case "de":
            case "lu":
            case "at":
                return ',';
            default:
                return '.';
        }
    }

    /**
     * @param $lang
     * @return string
     */
    private function getThousandsPoint($lang)
    {
        switch (strtolower($lang)) {
            case "de":
            case "lu":
            case "at":
                return '.';
            case "en":
                return ',';
            default:
                return ' ';
        }
    }
}
