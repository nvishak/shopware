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

namespace CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="crefo_products_company")
 */
class ProductsConfig extends ModelEntity
{
    /**
     * @var int $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $productKeyWS
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $productKeyWS;

    /**
     * @var string $productTextWS
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $productTextWS;

    /**
     * @var string $hasSolvencyIndex
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hasSolvencyIndex;

    /**
     * @var int $sequence
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $sequence;

    /**
     * @var Type::DECIMAL $thresholdMin
     *
     * @ORM\Column(type="decimal", precision=7, scale=2, nullable=false)
     */
    private $thresholdMin;

    /**
     * @var Type::DECIMAL $thresholdMax
     *
     * @ORM\Column(type="decimal", precision=7, scale=2, nullable=true)
     */
    private $thresholdMax;

    /**
     * @var bool $isLastThresholdMax
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isLastThresholdMax = false;

    /**
     * @var int $thresholdIndex
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $thresholdIndex;

    /**
     * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\CountriesForCompanies $country
     *
     * @ORM\ManyToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\CountriesForCompanies", inversedBy="products")
     * @ORM\JoinColumn(name="country", referencedColumnName="id")
     */
    private $country;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProductKeyWS()
    {
        return $this->productKeyWS;
    }

    /**
     * @return string
     */
    public function getProductTextWS()
    {
        return $this->productTextWS;
    }

    /**
     * @return boolean
     */
    public function getHasSolvencyIndex()
    {
        return $this->hasSolvencyIndex;
    }

    /**
     * @return integer
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @return Type::DECIMAL
     */
    public function getThresholdMin()
    {
        return $this->thresholdMin;
    }

    /**
     * @return Type::DECIMAL
     */
    public function getThresholdMax()
    {
        return $this->thresholdMax;
    }

    /**
     * @return bool
     */
    public function isLastThresholdMax()
    {
        return (bool) $this->isLastThresholdMax;
    }

    /**
     * @return integer
     */
    public function getThresholdIndex()
    {
        return $this->thresholdIndex;
    }

    /**
     * @return CountriesForCompanies
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param int $sequence
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * @param string $key
     */
    public function setProductKeyWS($key)
    {
        $this->productKeyWS = $key;
    }

    /**
     * @param string $text
     */
    public function setProductTextWS($text)
    {
        $this->productTextWS = $text;
    }

    /**
     * @param bool $index
     */
    public function setHasSolvencyIndex($index)
    {
        $this->hasSolvencyIndex = $index;
    }

    /**
     * @param Type::DECIMAL $threshold
     */
    public function setThresholdMin($thresholdMin)
    {
        $this->thresholdMin = $thresholdMin;
    }

    /**
     * @param Type::DECIMAL $thresholdMax
     */
    public function setThresholdMax($thresholdMax)
    {
        $this->thresholdMax = $thresholdMax;
    }

    /**
     * @param bool $isLastThresholdMax
     */
    public function setLastThresholdMax($isLastThresholdMax)
    {
        $this->isLastThresholdMax = $isLastThresholdMax;
    }

    /**
     * @param int $thresholdIndex
     */
    public function setThresholdIndex($thresholdIndex)
    {
        $this->thresholdIndex = $thresholdIndex;
    }

    /**
     * @param CountriesForCompanies $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
}
