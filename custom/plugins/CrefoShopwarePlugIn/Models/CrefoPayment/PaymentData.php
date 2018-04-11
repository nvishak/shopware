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

namespace CrefoShopwarePlugIn\Models\CrefoPayment;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="crefo_payment_data")
 * @ORM\HasLifecycleCallbacks
 */
class PaymentData extends ModelEntity
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
     * @var \Shopware\Models\Customer\Customer $userId
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Customer\Customer")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var integer $consent
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $consent;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Shopware\Models\Customer\Customer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param \Shopware\Models\Customer\Customer $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getConsent()
    {
        return $this->consent;
    }

    /**
     * @param int $consent
     */
    public function setConsent($consent)
    {
        $this->consent = $consent;
    }
}