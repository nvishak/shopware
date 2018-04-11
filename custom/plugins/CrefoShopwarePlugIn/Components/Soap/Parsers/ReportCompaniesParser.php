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

namespace CrefoShopwarePlugIn\Components\Soap\Parsers;

use \CrefoShopwarePlugIn\Components\Core\Enums\CompanyProductsType;
use CrefoShopwarePlugIn\Components\Core\Enums\CountryType;
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
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==extractProducts==", ['start extracting products']);
        $products = [];
        try {
            $service = $this->getService(self::IDENTIFICATION_REPORT);
            if (null === $service) {
                throw new \Exception("Service not found");
            }
            $products = $this->getProductsKeys($service);
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==extractProducts::check-products==", [$products]);
        } catch (\Exception $ex) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                "==extractProducts>>Exception " . date("Y-m-d H:i:s") . "==", [$ex]);
        }
        return $products;
    }

    /**
     * @param $service
     * @return array
     */
    private function getProductsKeys($service)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==getProductsKeys::check-service==", [$service]);
        $products = [];
        foreach ($service->countryconstraint as $constraint) {
            $countryKey = $constraint->country->key;
            try {
                $productType = $this->getAllowedKeys($constraint, self::PRODUCT_TYPE);
            } catch (\Exception $e) {
                CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
                    "==getProductsKeys>>Exception " . date("Y-m-d H:i:s") . "==", [$e]);
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
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==getProductsFromCountry::allowedKey==", [$allowedKey]);
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==getProductsFromCountry::countryKey==", [$countryKey]);
        $countryProducts = [];
        if (null === $allowedKey) {
            return [];
        }
        $i = 0;
        if (is_object($allowedKey->keyconstraint) && $allowedKey->keyconstraint instanceof \stdClass) {
            $countryProducts[$i]['keyWS'] = $allowedKey->keyconstraint->keycontent->key;
            $countryProducts[$i]['nameWS'] = $allowedKey->keyconstraint->keycontent->designation;
            $countryProducts[$i]['hasSolvencyIndex'] = strcmp($allowedKey->keyconstraint->parameters->parameter->use,
                'required') === 0 ? true : false;
            $countryProducts[$i]['country'] = CountryType::getCountryIdFromISO2($countryKey);
        } else {
            foreach ($allowedKey->keyconstraint as $keyConstraint) {
                $countryProducts[$i]['keyWS'] = $keyConstraint->keycontent->key;
                $countryProducts[$i]['nameWS'] = $keyConstraint->keycontent->designation;
                $countryProducts[$i]['hasSolvencyIndex'] = strcmp($keyConstraint->parameters->parameter->use,
                    'required') === 0 ? true : false;
                $countryProducts[$i]['country'] = CountryType::getCountryIdFromISO2($countryKey);
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
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==filterUnallowedProducts::UnfilteredProducts==", $products);
        $allowedProductsKeys = CompanyProductsType::AllowedProducts();
        $filteredProducts = [];
        if (empty($products) || empty($allowedProductsKeys)) {
            return [];
        }
        foreach ($products as $product) {
            if (in_array($product['keyWS'], $allowedProductsKeys)) {
                $filteredProducts[] = $product;
            }
        }
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==filterUnallowedProducts::FilteredProducts==",
            $filteredProducts);
        return $filteredProducts;
    }

}
