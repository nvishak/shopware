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

namespace CrefoShopwarePlugIn\Models\CrefoInkassoConfig;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="crefo_inkasso_creditors")
 * @ORM\Entity(repositoryClass="InkassoConfigRepository")
 * @ORM\HasLifecycleCallbacks
 */
class InkassoCreditors extends ModelEntity
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
     * @var string $useraccount
     *
     * @ORM\Column(name="useraccount", nullable=false, unique=true)
     */
    private $useraccount;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", nullable=false)
     */
    private $name;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", nullable=false)
     */
    private $address;

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
    public function getUseraccount()
    {
        return $this->useraccount;
    }

    /**
     * @param string $useraccount
     */
    public function setUseraccount($useraccount)
    {
        $this->useraccount = $useraccount;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

}