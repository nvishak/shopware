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

namespace CrefoShopwarePlugIn\Components\Soap;

use \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig;

/**
 * Class CrefoMapper
 * @package CrefoShopwarePlugIn\Components\Soap
 */
class CrefoMapper
{
    /**
     * @param $serviceCallee
     * @return int
     */
    public static function getServiceCalleeConfigId($serviceCallee)
    {
        switch ($serviceCallee) {
            case ReportCompanyConfig::class :
                $id = 1;
                break;
            default:
                $id = 0;
        }
        return $id;
    }

    /**
     * @param string|array $fieldIdFromService
     * @return string
     */
    public function getFieldId($fieldIdFromService)
    {
        $fieldId = $this->getIdFromService($fieldIdFromService);

        $mappingArray = $this->getMappingArray();
        if (array_key_exists($fieldId, $mappingArray)) {
            $fieldId = $mappingArray[$fieldId];
        }
        return $fieldId;
    }

    /**
     * @param string|array $fieldIdFromService
     * @param string $lang
     * @return string
     */
    public function getFieldLabel($fieldIdFromService, $lang)
    {
        $fieldId = $this->getIdFromService($fieldIdFromService);
        $labelsArray = $this->getLabelsMappingArray($lang);
        if (array_key_exists($fieldId, $labelsArray)) {
            $fieldId = $labelsArray[$fieldId];
        }
        return $fieldId;
    }

    /**
     * @param $fieldIdFromService
     * @return mixed|string
     */
    private function getIdFromService($fieldIdFromService)
    {
        if (is_string($fieldIdFromService)) {
            $fieldId = $fieldIdFromService;
        } elseif (is_array($fieldIdFromService) || is_object($fieldIdFromService)) {
            $tempArray = (array)$fieldIdFromService;
            $fieldId = $tempArray[0];
        } else {
            $fieldId = '';
        }
        /**
         * get just last part of the id
         */
        $found = preg_match('/\//', $fieldId, $matches);
        if ($found === 1) {
            $fieldId = preg_split('/\//', $fieldId);
            $fieldId = $fieldId[count($fieldId) - 1];
        }
        return $fieldId;
    }

    /**
     * ctws => shop design ids
     * @return array
     */
    protected function getMappingArray()
    {
        return [
            'individualpassword' => 'individualpassword',
            'generalpassword' => 'generalpassword',
            'newpassword' => 'newindividualpassword'
        ];
    }

    /**
     * ctws => shop design labels
     * @param string $lang
     * @return array
     */
    protected function getLabelsMappingArray($lang = 'de')
    {
        $languagesArray = [
            'de' => [
                'communicationlanguage' => 'Kommunikationssprache',
                'useraccount' => 'Mitgliedskennung',
                'individualpassword' => 'Persönliches Kennwort',
                'generalpassword' => 'Allgemeines Kennwort'
            ],
            'en' => [
                'communicationlanguage' => 'Communication Language',
                'useraccount' => 'User Account',
                'individualpassword' => 'Individual Password',
                'generalpassword' => 'General Password'
            ]
        ];
        return $languagesArray[strtolower($lang)];
    }
}