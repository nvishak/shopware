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

use \CrefoShopwarePlugIn\Components\Soap\CrefoSoapParser;

/**
 * Class IdentificationReportParser
 * @package CrefoShopwarePlugIn\Components\Soap\Parsers
 */
class IdentificationReportParser extends CrefoSoapParser
{

    const REPORT_DATA = "reportdata";

    /**
     * @return null
     */
    public function extractRiskJudgementColour()
    {
        $reportData = $this->getReportData();
        if (is_bool($reportData)) {
            return null;
        }
        return $reportData->riskjudgement->colour;
    }

    /**
     * @return null|string
     */
    public function extractTextReport()
    {
        $reportData = $this->getReportData();
        if (is_bool($reportData)) {
            return null;
        }
        return serialize((string)$reportData->textreport);
    }

    /**
     * @return bool|null|Object
     */
    private function getReportData()
    {
        if (is_object($this->rawResponse)) {
            return $this->getBody(self::REPORT_DATA);
        }
        return false;
    }
}
