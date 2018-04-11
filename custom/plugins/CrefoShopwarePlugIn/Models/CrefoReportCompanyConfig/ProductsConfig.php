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

namespace CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig;

use \Shopware\Components\Model\ModelEntity;
use \Doctrine\DBAL\Types\Type;
use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="ReportCompanyRepository")
 * @ORM\Table(name="crefo_products_config")
 */
class ProductsConfig extends ModelEntity
{

    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $configsId
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $configsId;

    /**
     * @var string $productKeyWS
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $productKeyWS;

    /**
     * @var string $productTextWS
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $productTextWS;

    /**
     * @var string $solvencyIndexWS
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $solvencyIndexWS;

    /**
     * @var integer $sequence
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $sequence;

    /**
     * @var Type::DECIMAL $threshold
     *
     * @ORM\Column(type="decimal", precision=7, scale=2, nullable=false)
     */
    private $threshold;

    /**
     * @var integer $threshold_index
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $threshold_index;

    /**
     * @var string $land
     *
     * @ORM\Column(type="text", nullable=false)
     */
    private $land;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getConfigId()
    {
        return $this->configsId;
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
    public function getSolvencyIndexWS()
    {
        return $this->solvencyIndexWS;
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
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @return integer
     */
    public function getThresholdIndex()
    {
        return $this->threshold_index;
    }

    /**
     * @return string
     */
    public function getLand()
    {
        return $this->land;
    }


    /**
     * @param integer $sequence
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * @param integer $id
     */
    public function setConfigId($id)
    {
        $this->configsId = $id;
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
     * @param boolean $index
     */
    public function setSolvencyIndexWS($index)
    {
        $this->solvencyIndexWS = $index;
    }


    /**
     * @param Type ::DECIMAL $threshold
     */
    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    /**
     * @param integer $thresholdIndex
     */
    public function setThresholdIndex($thresholdIndex)
    {
        $this->threshold_index = $thresholdIndex;
    }

    /**
     * @param string $land
     */
    public function setLand($land)
    {
        $this->land = $land;
    }

}
