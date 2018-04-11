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

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProductsRepository")
 * @ORM\Table(name="crefo_private_person_product_score_config")
 */
class ProductScoreConfig extends ModelEntity
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson
     *
     * @ORM\ManyToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson", inversedBy="scoreProducts")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id")
     */
    private $productId;

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
     * @var integer $visualSequence
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $visualSequence;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ProductsPrivatePerson
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param ProductsPrivatePerson $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return int
     */
    public function getProductScoreFrom()
    {
        return $this->productScoreFrom;
    }

    /**
     * @param int $productScoreFrom
     */
    public function setProductScoreFrom($productScoreFrom)
    {
        $this->productScoreFrom = $productScoreFrom;
    }

    /**
     * @return int
     */
    public function getProductScoreTo()
    {
        return $this->productScoreTo;
    }

    /**
     * @param int $productScoreTo
     */
    public function setProductScoreTo($productScoreTo)
    {
        $this->productScoreTo = $productScoreTo;
    }

    /**
     * @return int
     */
    public function getIdentificationResult()
    {
        return $this->identificationResult;
    }

    /**
     * @param int $identificationResult
     */
    public function setIdentificationResult($identificationResult)
    {
        $this->identificationResult = $identificationResult;
    }

    /**
     * @return int
     */
    public function getAddressValidationResult()
    {
        return $this->addressValidationResult;
    }

    /**
     * @param int $addressValidationResult
     */
    public function setAddressValidationResult($addressValidationResult)
    {
        $this->addressValidationResult = $addressValidationResult;
    }

    /**
     * @return int
     */
    public function getVisualSequence()
    {
        return $this->visualSequence;
    }

    /**
     * @param int $visualSequence
     */
    public function setVisualSequence($visualSequence)
    {
        $this->visualSequence = $visualSequence;
    }
}
