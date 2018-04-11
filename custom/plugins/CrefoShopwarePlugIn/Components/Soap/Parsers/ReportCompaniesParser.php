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

namespace CrefoShopwarePlugIn\Components\Soap\Parsers;

use \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class ReportCompaniesParser
 * @package CrefoShopwarePlugIn\Components\Soap\Parsers
 */
class ReportCompaniesParser extends CrefoSoapParser
{

    const IDENTIFICATION_REPORT = "identificationreport";
    const PRODUCT_TYPE = "producttype";

    /**
     * @return array
     */
    public function extractProducts()
    {
        $products = [];
        try {
            $service = $this->getService(self::IDENTIFICATION_REPORT);
            $products = $this->getProductsKeys($service);
        } catch (\Exception $ex) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR,
                "==extractProducts>>Exception " . date("Y-m-d H:i:s") . "==", (array)$ex);
        }
        return $products;
    }

    /**
     * @param $service
     * @return array
     */
    private function getProductsKeys($service)
    {
        $products = [];
        foreach ($service->countryconstraint as $constraint) {
            $countryKey = $constraint->country->key;
            try {
                $productType = $this->getAllowedKeys($constraint, self::PRODUCT_TYPE);
            } catch (\Exception $e) {
                $productType = null;
            }
            $tempProducts = $this->getProductsFromCountry($productType, $countryKey);
            foreach ($tempProducts as $tempProduct) {
                $products[] = $tempProduct;
            }
        }
        return $products;
    }

    /**
     * @param $allowedKey
     * @param $countryKey
     * @return array
     */
    private function getProductsFromCountry($allowedKey, $countryKey)
    {
        $countryProducts = [];
        if (is_null($allowedKey)) {
            return [];
        }
        $i = 0;
        if (is_object($allowedKey->keyconstraint) && $allowedKey->keyconstraint instanceof \stdClass) {
            $countryProducts[$i]['keyWS'] = $allowedKey->keyconstraint->keycontent->key;
            $countryProducts[$i]['nameWS'] = $allowedKey->keyconstraint->keycontent->designation;
            $countryProducts[$i]['solvencyIndexWS'] = strcmp($allowedKey->keyconstraint->parameters->parameter->use,
                'required') === 0 ? true : false;
            $countryProducts[$i]['available'] = true;
            $countryProducts[$i]['country'] = $countryKey;
        } else {
            foreach ($allowedKey->keyconstraint as $keyconstraint) {
                $countryProducts[$i]['keyWS'] = $keyconstraint->keycontent->key;
                $countryProducts[$i]['nameWS'] = $keyconstraint->keycontent->designation;
                $countryProducts[$i]['solvencyIndexWS'] = strcmp($keyconstraint->parameters->parameter->use,
                    'required') === 0 ? true : false;
                $countryProducts[$i]['available'] = true;
                $countryProducts[$i]['country'] = $countryKey;
                $i++;
            }
        }
        return $this->filterUnallowedProducts($countryProducts);
    }

    /**
     * @param array $products
     * @return array
     */
    private function filterUnallowedProducts(array $products)
    {
        $allowedProductsKeys = $this->getApplicationAllowedCrefoProductsKeys();
        $filteredProducts = [];
        if (empty($products) || empty($allowedProductsKeys)) {
            return [];
        }
        foreach ($products as $product) {
            if (in_array($product['keyWS'], $allowedProductsKeys)) {
                $filteredProducts[] = $product;
            }
        }
        return $filteredProducts;
    }

    /**
     * loads ini file either the default or a given file
     * @method loadIni
     * @param file
     * @return array
     */
    private function getApplicationAllowedCrefoProductsKeys($file = null)
    {
        $allowedProductsKeys = [];
        if ($file == null) {
            $file = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "_resources" . DIRECTORY_SEPARATOR . "webservice.ini";
        }
        if (file_exists($file)) {
            $ini_array = parse_ini_file(filter_var($file, FILTER_SANITIZE_STRING), true);
            if (array_key_exists("application_allowed_products", $ini_array)) {
                $ws_config = $ini_array['application_allowed_products'];
                foreach ($ws_config as $key) {
                    $allowedProductsKeys[] = $key;
                }
            }
        }
        return $allowedProductsKeys;
    }
}
