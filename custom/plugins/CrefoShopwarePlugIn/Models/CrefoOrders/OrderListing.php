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

namespace CrefoShopwarePlugIn\Models\CrefoOrders;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="crefo_orders_listing")
 * @ORM\HasLifecycleCallbacks
 */
class OrderListing extends ModelEntity
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
     * @var \Shopware\Models\Order\Order $orderId
     *
     * @ORM\OneToOne(targetEntity="Shopware\Models\Order\Order")
     * @ORM\JoinColumn(name="orderId", referencedColumnName="id")
     */
    private $orderId;

    /**
     * @var \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $crefoOrderId
     *
     * @ORM\OneToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal")
     * @ORM\JoinColumn(name="crefoOrderId", referencedColumnName="id")
     */
    private $crefoOrderId;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Shopware\Models\Order\Order
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param \Shopware\Models\Order\Order $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal
     */
    public function getCrefoOrderId()
    {
        return $this->crefoOrderId;
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoOrders\CrefoOrderProposal $crefoOrderId
     */
    public function setCrefoOrderId($crefoOrderId)
    {
        $this->crefoOrderId = $crefoOrderId;
    }

}
