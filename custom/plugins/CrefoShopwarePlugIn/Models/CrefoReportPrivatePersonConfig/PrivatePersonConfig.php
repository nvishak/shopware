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

use \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount;
use \Doctrine\Common\Collections\ArrayCollection;
use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="crefo_report_private_person_config")
 * @ORM\Entity(repositoryClass="ProductsRepository")
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
     * @var string $legitimateKey
     *
     * @ORM\Column(name="legitimateKey", nullable=true)
     */
    private $legitimateKey;

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
     * @return string
     */
    public function getLegitimateKey()
    {
        return $this->legitimateKey;
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
     * @param string $key
     */
    public function setLegitimateKey($key)
    {
        $this->legitimateKey = $key;
    }
}
