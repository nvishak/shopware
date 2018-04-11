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

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="crefo_private_person_report_results")
 */
class PrivatePersonReportResults extends CrefoReportResults
{

    /**
     * @var string $addressValidationResult
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $addressValidationResult;

    /**
     * @var string $identificationResult
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $identificationResult;

    /**
     * @var string $scoreType
     *
     * @ORM\Column(type="text",  nullable=false)
     */
    private $scoreType;

    /**
     * @var integer $scoreValue
     *
     * @ORM\Column(type="integer",  nullable=false)
     */
    private $scoreValue;

    /**
     * @return string
     */
    public function getAddressValidationResult()
    {
        return $this->addressValidationResult;
    }

    /**
     * @param string $addressValidationResult
     */
    public function setAddressValidationResult($addressValidationResult)
    {
        $this->addressValidationResult = $addressValidationResult;
    }

    /**
     * @return string
     */
    public function getIdentificationResult()
    {
        return $this->identificationResult;
    }

    /**
     * @return string
     */
    public function getScoreType()
    {
        return $this->scoreType;
    }

    /**
     * @param string $scoreType
     */
    public function setScoreType($scoreType)
    {
        $this->scoreType = $scoreType;
    }

    /**
     * @param string $identificationResult
     */
    public function setIdentificationResult($identificationResult)
    {
        $this->identificationResult = $identificationResult;
    }

    /**
     * @return int
     */
    public function getScoreValue()
    {
        return $this->scoreValue;
    }

    /**
     * @param int $scoreValue
     */
    public function setScoreValue($scoreValue)
    {
        $this->scoreValue = $scoreValue;
    }

}