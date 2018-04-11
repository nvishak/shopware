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

use CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;

/**
 * Class BonimaReportParser
 * @package CrefoShopwarePlugIn\Components\Soap\Parsers
 */
class BonimaReportParser extends CrefoSoapParser
{

    /**
     * @return array|null|object
     */
    public function getAddressCheckResultKey()
    {
        $addressCheckData = $this->getBody("addresscheckdata");
        return null !== $addressCheckData ? $this->getFieldFromContainer($addressCheckData->addressvalidationresult,
            "key") : null;
    }

    /**
     * @return array|null|object
     */
    public function getIdentificationResultKey()
    {
        $identificationData = $this->getBody("identificationdata");
        return null !== $identificationData ? $this->getFieldFromContainer($identificationData->identificationresult,
            "key") : null;
    }

    /**
     * @return array|null|object
     */
    public function extractScoreTypeResult()
    {
        $scoreData = $this->getBody("scoredata");
        return null !== $scoreData ? $this->getFieldFromContainer($scoreData->scoreentry, "scoretype") : null;
    }

    /**
     * @return mixed
     */
    public function getScoreTypeResultKey()
    {
        return isset($this->extractScoreTypeResult()->key) ? $this->extractScoreTypeResult()->key : null;
    }

    /**
     * @return array|null|object
     */
    public function extractScoreValueResult()
    {
        $scoreData = $this->getBody("scoredata");
        return null !== $scoreData ? $this->getFieldFromContainer($scoreData->scoreentry, "scorevalue") : null;
    }
}
