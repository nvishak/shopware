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

namespace CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig;

use \Shopware\Components\Model\ModelEntity;
use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

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
     * @var integer $productKeyWS
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productKeyWS;

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
     * @var integer $productScoreFrom
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productScoreFrom;

    /**
     * @var integer $productScoreTo
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productScoreTo;

    /**
     * @var integer $identificationResult
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $identificationResult;

    /**
     * @var integer $addressValidationResult
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $addressValidationResult;

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
     * @return integer
     */
    public function getProductKeyWS()
    {
        return $this->productKeyWS;
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
     * @return int
     */
    public function getProductScoreFrom()
    {
        return $this->productScoreFrom;
    }

    /**
     * @return int
     */
    public function getProductScoreTo()
    {
        return $this->productScoreTo;
    }

    /**
     * @return int
     */
    public function getIdentificationResult()
    {
        return $this->identificationResult;
    }

    /**
     * @return int
     */
    public function getAddressValidationResult()
    {
        return $this->addressValidationResult;
    }

    /**
     * @param PrivatePersonConfig $configId
     */
    public function setConfigId($configId)
    {
        $this->configId = $configId;
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

    /**
     * @param int $productScoreFrom
     */
    public function setProductScoreFrom($productScoreFrom)
    {
        $this->productScoreFrom = $productScoreFrom;
    }

    /**
     * @param int $productScoreTo
     */
    public function setProductScoreTo($productScoreTo)
    {
        $this->productScoreTo = $productScoreTo;
    }

    /**
     * @param int $identificationResult
     */
    public function setIdentificationResult($identificationResult)
    {
        $this->identificationResult = $identificationResult;
    }

    /**
     * @param int $addressValidationResult
     */
    public function setAddressValidationResult($addressValidationResult)
    {
        $this->addressValidationResult = $addressValidationResult;
    }


}
