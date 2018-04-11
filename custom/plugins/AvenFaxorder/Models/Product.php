<?php

namespace AvenFaxorder\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_faxorder")
 */
class Product extends ModelEntity
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
     * @var string $orderID
     *
     * @ORM\Column(type="text")
     */
    private $orderID;
    
    /**
     * @var string $$orderNumber
     *
     * @ORM\Column(type="text")
     */
    private $orderNumber;

    /**
     * @var string $quoteID
     *
     * @ORM\Column(type="text")
     */
    private $quoteID;
    
    /**
     * @var string $faxID
     *
     * @ORM\Column(type="text")
     */
    private $faxID;
    
    /**
     * @var string $custID
     *
     * @ORM\Column(type="text")
     */
    private $custID;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param string $orderID
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
    }

    /**
     * @return string
     */
    public function getOrderID()
    {
        return $this->orderID;
    }
    
     /**
     * @param string $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param string $quoteID
     */
    public function setQuoteID($quoteID)
    {
        $this->quoteID = $quoteID;
    }

    /**
     * @return string
     */
    public function getQuoteID()
    {
        return $this->quoteID;
    }
    
    /**
     * @param string $faxID
     */
    public function setFaxID($faxID)
    {
        $this->faxID = $faxID;
    }

    /**
     * @return string
     */
    public function getFaxID()
    {
        return $this->faxID;
    }
    
    /**
     * @param string $custID
     */
    public function setCustID($custID)
    {
        $this->custID = $custID;
    }

    /**
     * @return string
     */
    public function getCustID()
    {
        return $this->custID;
    }


}
