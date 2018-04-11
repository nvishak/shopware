<?php

namespace AvenFaxorder\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_faxquote")
 */
class Faxquotes extends ModelEntity
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
     * @var string $productId
     *
     * @ORM\Column(type="text")
     */
    private $productId;

    /**
     * @var string $productNumber
     *
     * @ORM\Column(type="text")
     */
    private $productNumber;


    /**
     * @var string $quantity
     *
     * @ORM\Column(type="text")
     */
    private $quantity;

    /**
     * @var string $faxId
     *
     * @ORM\Column(type="text")
     */
    private $faxId;

    /**
     * @var string $customerId
     *
     * @ORM\Column(type="text")
     */
    private $customerId;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @param string $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param string $productNumber
     */
    public function setProductNumber($productNumber)
    {
        $this->productNumber = $productNumber;
    }

    /**
     * @return string
     */
    public function getProductNumber()
    {
        return $this->productNumber;
    }

    /**
     * @return string
     */
    public function getFaxId()
    {
        return $this->faxId;
    }

    /**
     * @param string $faxId
     */
    public function setFaxId($faxId)
    {
        $this->faxId = $faxId;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }


}
