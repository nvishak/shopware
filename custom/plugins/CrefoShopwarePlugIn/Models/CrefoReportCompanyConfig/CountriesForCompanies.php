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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="crefo_countries_company")
 */
class CountriesForCompanies extends ModelEntity
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
     * @var \CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig
     *
     * @ORM\ManyToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ReportCompanyConfig", inversedBy="countries")
     * @ORM\JoinColumn(name="configId", referencedColumnName="id")
     */
    private $configId;

    /**
     * @var int $country
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $country;

    /**
     * @var ArrayCollection $products
     *
     * @ORM\OneToMany(targetEntity="CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig\ProductsConfig", mappedBy="country")
     */
    private $products;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ReportCompanyConfig
     */
    public function getConfigId()
    {
        return $this->configId;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ReportCompanyConfig $configId
     */
    public function setConfigId(ReportCompanyConfig $configId)
    {
        $this->configId = $configId;
    }

    /**
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param int $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }
}
