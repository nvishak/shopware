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

namespace CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProductsRepository")
 * @ORM\Table(name="crefo_products_private_person")
 */
class ProductsPrivatePerson extends ModelEntity
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
     * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig $configId
     *
     * @ORM\ManyToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\PrivatePersonConfig", inversedBy="products")
     * @ORM\JoinColumn(name="configId", referencedColumnName="id")
     */
    private $configId;

    /**
     * @var ArrayCollection $scoreProducts
     *
     * @ORM\OneToMany(targetEntity="CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductScoreConfig", mappedBy="productId")
     */
    private $scoreProducts;

    /**
     * @var integer $productKeyWS
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productKeyWS;

    /**
     * @var string $productNameWS
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $productNameWS;

    /**
     * @var boolean $isProductAvailable
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isProductAvailable = false;

    /**
     * @var integer $visualSequence
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $visualSequence;

    /**
     * @var boolean $isLastThresholdMax
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isLastThresholdMax = false;

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
     * ProductsPrivatePerson constructor.
     */
    public function __construct()
    {
        $this->scoreProducts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return PrivatePersonConfig
     */
    public function getConfigId()
    {
        return $this->configId;
    }

    /**
     * @return ArrayCollection
     */
    public function getScoreProducts()
    {
        return $this->scoreProducts;
    }

    /**
     * @return integer
     */
    public function getProductKeyWS()
    {
        return $this->productKeyWS;
    }

    /**
     * @return string
     */
    public function getProductNameWS()
    {
        return $this->productNameWS;
    }

    /**
     * @param string $productNameWS
     */
    public function setProductNameWS($productNameWS)
    {
        $this->productNameWS = $productNameWS;
    }

    /**
     * @return boolean
     */
    public function isProductAvailable()
    {
        return $this->isProductAvailable;
    }

    /**
     * @return int
     */
    public function getVisualSequence()
    {
        return $this->visualSequence;
    }

    /**
     * @return bool
     */
    public function isLastThresholdMax()
    {
        return $this->isLastThresholdMax;
    }

    /**
     * @param bool $isLastThresholdMax
     */
    public function setLastThresholdMax($isLastThresholdMax)
    {
        $this->isLastThresholdMax = $isLastThresholdMax;
    }

    /**
     * @return Type::DECIMAL
     */
    public function getThresholdMin()
    {
        return $this->thresholdMin;
    }

    /**
     * @param Type::DECIMAL $thresholdMin
     */
    public function setThresholdMin($thresholdMin)
    {
        $this->thresholdMin = $thresholdMin;
    }

    /**
     * @return Type::DECIMAL
     */
    public function getThresholdMax()
    {
        return $this->thresholdMax;
    }

    /**
     * @param Type::DECIMAL $thresholdMax
     */
    public function setThresholdMax($thresholdMax)
    {
        $this->thresholdMax = $thresholdMax;
    }

    /**
     * @param PrivatePersonConfig $configId
     */
    public function setConfigId($configId)
    {
        $this->configId = $configId;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setScoreProducts($products)
    {
        $this->scoreProducts = $products;
    }

    /**
     * @param integer $productKeyWS
     */
    public function setProductKeyWS($productKeyWS)
    {
        $this->productKeyWS = $productKeyWS;
    }

    /**
     * @param boolean $isProductAvailable
     */
    public function setProductAvailability($isProductAvailable)
    {
        $this->isProductAvailable = $isProductAvailable;
    }

    /**
     * @param int $visualSequence
     */
    public function setVisualSequence($visualSequence)
    {
        $this->visualSequence = $visualSequence;
    }
}
