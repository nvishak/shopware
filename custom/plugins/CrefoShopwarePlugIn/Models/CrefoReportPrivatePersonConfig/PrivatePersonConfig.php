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

use \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount;
use \Doctrine\Common\Collections\ArrayCollection;
use \Shopware\Components\Model\ModelEntity;
use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="crefo_report_private_person_config")
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\HasLifecycleCallbacks
 */
class PrivatePersonConfig extends ModelEntity
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
     * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $userAccountId
     *
     * @ORM\OneToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount")
     * @ORM\JoinColumn(name="userAccountId", referencedColumnName="id")
     */
    private $userAccountId;

    /**
     * @var ArrayCollection $products
     *
     * @ORM\OneToMany(targetEntity="CrefoShopwarePlugIn\Models\CrefoReportPrivatePersonConfig\ProductsPrivatePerson", mappedBy="configId")
     */
    private $products;

    /**
     * @var integer $selectedProductKey
     *
     * @ORM\Column(name="selectedProductKey", type="integer", nullable=true)
     */
    private $selectedProductKey;

    /**
     * @var string $legitimateKey
     *
     * @ORM\Column(name="legitimateKey", nullable=true)
     */
    private $legitimateKey;

    /**
     * @var float $thresholdMin
     *
     * @ORM\Column(name="thresholdMin", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $thresholdMin;

    /**
     * @var float $thresholdMax
     *
     * @ORM\Column(name="thresholdMax", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $thresholdMax;

    /**
     * PrivatePersonConfig constructor.
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return CrefoAccount
     */
    public function getUserAccountId()
    {
        return $this->userAccountId;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getSelectedProductKey()
    {
        return $this->selectedProductKey;
    }

    /**
     * @return string
     */
    public function getLegitimateKey()
    {
        return $this->legitimateKey;
    }

    /**
     * @return float
     */
    public function getThresholdMin()
    {
        return floatval($this->thresholdMin);
    }

    /**
     * @return float|null
     */
    public function getThresholdMax()
    {
        return $this->thresholdMax;
    }

    /**
     * @param CrefoAccount $id
     */
    public function setUserAccountId($id)
    {
        $this->userAccountId = $id;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @param int $selectedProductKey
     */
    public function setSelectedProductKey($selectedProductKey)
    {
        $this->selectedProductKey = $selectedProductKey;
    }

    /**
     * @param string $key
     */
    public function setLegitimateKey($key)
    {
        $this->legitimateKey = $key;
    }


    /**
     * @param float $thresholdMin
     */
    public function setThresholdMin($thresholdMin)
    {
        $this->thresholdMin = $thresholdMin;
    }

    /**
     * @param float $thresholdMax
     */
    public function setThresholdMax($thresholdMax)
    {
        $this->thresholdMax = $thresholdMax;
    }
}
