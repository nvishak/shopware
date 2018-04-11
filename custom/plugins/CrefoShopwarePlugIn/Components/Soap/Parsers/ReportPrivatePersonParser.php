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

use CrefoShopwarePlugIn\Components\Core\Enums\PrivatePersonProductsType;
use CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class ReportPrivatePersonParser
 * @package CrefoShopwarePlugIn\Components\Soap\Parsers
 */
class ReportPrivatePersonParser extends CrefoSoapParser
{

    const BONIMA_REPORT = "bonimareport";
    const PRODUCT_TYPE = "producttype";

    /**
     * @return array
     */
    public function extractProducts()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==extractProducts==", ['start extracting products']);
        $products = [];
        try {
            $service = $this->getService(self::BONIMA_REPORT);
            $products = $this->getProductsKeys($service);
        } catch (\Exception $ex) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR,
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
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==getProductsKeys::check-service==", [$service]);
        $products = [];
        if (is_object($service->countryconstraint) && $service->countryconstraint instanceof \stdClass) {
            $countryKey = $service->countryconstraint->country->key;
            try {
                $productType = $this->getAllowedKeys($service->countryconstraint, self::PRODUCT_TYPE);
            } catch (\Exception $e) {
                $productType = null;
            }
            $tempProducts = $this->getProductsFromCountry($productType, $countryKey);
            foreach ($tempProducts as $tempProduct) {
                $products[] = $tempProduct;
            }
        } else {
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
            $countryProducts[$i]['available'] = true;
            $countryProducts[$i]['country'] = $countryKey;
        } else {
            foreach ($allowedKey->keyconstraint as $keyconstraint) {
                $countryProducts[$i]['keyWS'] = $keyconstraint->keycontent->key;
                $countryProducts[$i]['nameWS'] = $keyconstraint->keycontent->designation;
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
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "==filterUnallowedProducts::UnfilteredProducts==", $products);
        $allowedProductsKeys = PrivatePersonProductsType::AllowedProducts();
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
