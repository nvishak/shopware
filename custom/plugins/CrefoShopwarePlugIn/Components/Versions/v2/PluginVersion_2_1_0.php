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

namespace CrefoShopwarePlugIn\Components\Versions\v2;

require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';


use CrefoShopwarePlugIn\Components\Core\Enums\CollectionOrderFieldType;
use CrefoShopwarePlugIn\Components\Core\Enums\CountryType;
use CrefoShopwarePlugIn\Components\Core\Enums\PrivatePersonProductsType;
use CrefoShopwarePlugIn\Components\Core\PasswordEncoder;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion;
use CrefoShopwarePlugIn\Components\Versions\Helper\PasswordCryptoUpdater;

/**
 * Class PluginVersion_2_1_0
 */
class PluginVersion_2_1_0 extends AbstractPluginVersion
{
    const VERSION = '2.1.0';

    /**
     * {@inheritdoc}
     */
    public function createSQLArray()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Create SQL commands.', []);
        $commands = [];
        $updateCollectionValues = 'UPDATE `crefo_inkasso_ws_values` SET `typeValue` = ? WHERE `keyWS` LIKE ?';
        $commands[self::MULTIPLE_QUERY] = [
            [ $updateCollectionValues => [CollectionOrderFieldType::ORDER, 'CCORTY-%']],
            [ $updateCollectionValues => [CollectionOrderFieldType::TURNOVER, 'CCTOTY-%']],
            [ $updateCollectionValues =>[CollectionOrderFieldType::RECEIVABLE_REASON, 'CCRCRS-%']],
        ];

        return $commands;
    }

    public function saveMigrationData()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Save migration data.', []);
        $data = [];
        $configPrivatePersonArray = $this->getQueryAdapter()->execQuery('SELECT * FROM crefo_report_private_person_config WHERE id=1;', [], true);
        if (isset($configPrivatePersonArray[0]['thresholdMin']) && null !== $configPrivatePersonArray[0]['thresholdMin']) {
            $data['crefo_report_private_person_config'] = $configPrivatePersonArray[0];
        }
        $productPrivatePersonArray = $this->getQueryAdapter()->execQuery('SELECT * FROM crefo_products_private_person;', [], true);
        if (count($productPrivatePersonArray) > 0) {
            $data['crefo_products_private_person'] = $productPrivatePersonArray;
        }

        $productCompanyArray = $this->getQueryAdapter()->execQuery('SELECT * FROM crefo_products_config;', [], true);
        if (count($productCompanyArray) > 0) {
            $data['crefo_products_company'] = $productCompanyArray;
        }

        return $data;
    }

    public function migrate(array $oldData)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Start migration.', []);
        $result = 1;
        $this->getQueryAdapter()->execQuery('SET FOREIGN_KEY_CHECKS=0;');
        try {
            if (!empty($oldData) && isset($oldData['crefo_report_private_person_config']) && isset($oldData['crefo_products_private_person'])) {
                $configPrivatePerson = $oldData['crefo_report_private_person_config'];
                $this->getQueryAdapter()->execQuery('TRUNCATE TABLE `crefo_products_private_person`;');
                //                $this->getQueryAdapter()->execQuery("DELETE FROM crefo_products_private_person WHERE id>0;");
                $isProductAvailable = false;
                foreach ($oldData['crefo_products_private_person'] as $oldProduct) {
                    $this->getQueryAdapter()->execQuery('INSERT INTO crefo_private_person_product_score_config (productId, identificationResult, addressValidationResult, productScoreFrom, productScoreTo, visualSequence) VALUES (?, ?, ?, ?, ?, ?);',
                        [
                            1,
                            $oldProduct['identificationResult'],
                            $oldProduct['addressValidationResult'],
                            $oldProduct['productScoreFrom'],
                            $oldProduct['productScoreTo'],
                            $oldProduct['visualSequence'],
                        ]);
                    $isProductAvailable = $oldProduct['isProductAvailable'];
                }
                $productNameWS = $configPrivatePerson['selectedProductKey'] === PrivatePersonProductsType::BONIMA_SCORE_POOL_IDENT ? 'Bonima Score Pool Ident' : 'Bonima Score Pool Ident Premium';
                $this->getQueryAdapter()->execQuery('INSERT INTO `crefo_products_private_person` (id, productKeyWS, productNameWS, isProductAvailable, visualSequence, thresholdMin, thresholdMax, isLastThresholdMax, configId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);',
                    [
                        1,
                        $configPrivatePerson['selectedProductKey'],
                        $productNameWS,
                        $isProductAvailable,
                        0,
                        $configPrivatePerson['thresholdMin'],
                        $configPrivatePerson['thresholdMax'],
                        true,
                        1,
                    ]);
            }
            if (!empty($oldData) && isset($oldData['crefo_products_company'])) {
                $country = '';
                $countryId = 0;
                $sequence = 0;
                $insertOldData = [];
                foreach ($oldData['crefo_products_company'] as $key => $oldProduct) {
                    if ($country === $oldProduct['land']) {
                        ++$sequence;
                    } else {
                        $country = $oldProduct['land'];
                        $sequence = 0;
                        ++$countryId;
                        $this->getQueryAdapter()->execQuery('INSERT INTO crefo_countries_company (configId, country) VALUES (?, ?);', [
                            $oldProduct['configsId'],
                            CountryType::getCountryIdFromISO2($oldProduct['land']),
                        ]);
                    }
                    if ($oldProduct['productKeyWS'] === null) {
                        $insertOldData[$key - 1]['thresholdMax'] = $oldProduct['threshold'];
                        $insertOldData[$key - 1]['isLastThresholdMax'] = true;
                    } else {
                        $thresholdMax = null;
                        if (isset($oldData['crefo_products_company'][$key + 1]) && $oldData['crefo_products_company'][$key + 1]['land'] === $oldProduct['land']) {
                            $thresholdMax = $oldData['crefo_products_company'][$key + 1]['threshold'];
                        }
                        $insertOldData[$key]['productKeyWS'] = $oldProduct['productKeyWS'];
                        $insertOldData[$key]['productTextWS'] = $oldProduct['productTextWS'];
                        $insertOldData[$key]['thresholdMin'] = $oldProduct['threshold'];
                        $insertOldData[$key]['hasSolvencyIndex'] = $oldProduct['solvencyIndexWS'];
                        $insertOldData[$key]['sequence'] = $sequence;
                        $insertOldData[$key]['thresholdMax'] = $thresholdMax;
                        $insertOldData[$key]['isLastThresholdMax'] = !isset($oldData['crefo_products_company'][$key + 1]) || $oldData['crefo_products_company'][$key + 1]['land'] !== $oldProduct['land'];
                        $insertOldData[$key]['thresholdIndex'] = $oldProduct['threshold_index'];
                        $insertOldData[$key]['country'] = $countryId;
                    }
                }
                foreach ($insertOldData as $oldProduct) {
                    $this->getQueryAdapter()->execQuery('INSERT INTO `crefo_products_company` (productKeyWS, productTextWS, hasSolvencyIndex, sequence, thresholdMin, thresholdMax, isLastThresholdMax, thresholdIndex, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);',
                        [
                            $oldProduct['productKeyWS'],
                            $oldProduct['productTextWS'],
                            $oldProduct['hasSolvencyIndex'],
                            $oldProduct['sequence'],
                            $oldProduct['thresholdMin'],
                            $oldProduct['thresholdMax'],
                            $oldProduct['isLastThresholdMax'],
                            $oldProduct['thresholdIndex'],
                            $oldProduct['country'],
                        ]);
                }
                $this->getQueryAdapter()->execQuery('DROP TABLE crefo_products_config');
            }
            $this->updateEncryptedPasswords();
        } catch (\Exception $e) {
            $result = 0;
        }
        $this->getQueryAdapter()->execQuery('SET FOREIGN_KEY_CHECKS=1');

        return $result;
    }

    private function updateEncryptedPasswords()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Update legacy encrypted passwords.', []);
        $encryptionKeyArray = $this->getQueryAdapter()->execQuery('SELECT * FROM crefo_plugin_settings;', [], true);
        if (!is_array($encryptionKeyArray) && $encryptionKeyArray[0]['encryptionKey'] === null) {
            return;
        }
        $encryptionKey = $encryptionKeyArray[0]['encryptionKey'];
        $accountsArray = $this->getQueryAdapter()->execQuery('SELECT * FROM crefo_accounts;', [], true);
        $passwordEncoder = new PasswordEncoder();
        $modifyKey = false;
        $newKey = $passwordEncoder->generateKey();
        foreach ($accountsArray as $account) {
            $decryptedGP = PasswordCryptoUpdater::decrypt($account['generalpassword'], $encryptionKey);
            $decryptedIP = PasswordCryptoUpdater::decrypt($account['individualpassword'], $encryptionKey);
            if($decryptedGP !== null && $decryptedIP !== null) {
                $encryptedGP = $passwordEncoder->encrypt($decryptedGP, $newKey);
                $encryptedIP = $passwordEncoder->encrypt($decryptedIP, $newKey);
                $this->getQueryAdapter()->execQuery('UPDATE `crefo_accounts` SET `generalpassword` = ?, `individualpassword` = ? WHERE `id` = ?;',
                    [
                        $encryptedGP,
                        $encryptedIP,
                        $account['id'],
                    ]);
                $modifyKey = true;
            }
        }
        if($modifyKey){
            $this->getQueryAdapter()->execQuery('UPDATE `crefo_plugin_settings` SET `encryptionKey` = ? WHERE `id` = ?;',
                [
                    $newKey,
                    $encryptionKeyArray[0]['id'],
                ]);
        }
    }
}
