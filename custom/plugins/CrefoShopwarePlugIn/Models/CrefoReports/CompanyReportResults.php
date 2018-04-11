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

namespace CrefoShopwarePlugIn\Models\CrefoReports;

use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="crefo_company_report_results")
 */
class CompanyReportResults extends CrefoReportResults
{
    /**
     * @var integer $textReportPdf
     *
     * @ORM\Column(type="blob", nullable=true)
     */
    private $textReportPdf;

    /**
     * @var string $riskJudgement
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $riskJudgement;

    /**
     * @var integer $indexThreshold
     *
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $indexThreshold;

    /**
     * @method setTextReportPdf
     * @param  string $textReportPdf
     */
    public function setTextReportPdf($textReportPdf)
    {
        $this->textReportPdf = $textReportPdf;
    }

    /**
     * @method setRiskJudgement
     * @param  string $riskJudgement
     */
    public function setRiskJudgement($riskJudgement)
    {
        $this->riskJudgement = $riskJudgement;
    }

    /**
     * @method setIndexThreshold
     * @param  string $indexThreshold
     */
    public function setIndexThreshold($indexThreshold)
    {
        $this->indexThreshold = $indexThreshold;
    }

    /**
     * @method getTextReportPdf
     * @return  string
     */
    public function getTextReportPdf()
    {
        return $this->textReportPdf;
    }

    /**
     * @param  string $lastCallTitle
     */
    public function setTextReportNameFromValues($lastCallTitle)
    {
        if (strcmp(strtolower($lastCallTitle), 'fault') === 0) {
            $this->setTextReportName('fault');
        } else {
            $textReportName = '';
            if (is_null($this->getRiskJudgement())) {
                $textReportName .= 'novalue';
            } else {
                $textReportName .= $this->getRiskJudgement();
            }
            $this->setTextReportName($textReportName);
        }
    }

    /**
     * @method getRiskJudgement
     * @return  string
     */
    public function getRiskJudgement()
    {
        return $this->riskJudgement;
    }

    /**
     * @method getIndexThreshold
     * @return  string
     */
    public function getIndexThreshold()
    {
        return $this->indexThreshold;
    }
}