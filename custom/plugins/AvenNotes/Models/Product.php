<?php

namespace AvenNotes\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ProductRepository")
 * @ORM\Table(name="s_deliverynotes")
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
     * @var string $orderNumber
     *
     * @ORM\Column(type="text")
     */
    private $orderNumber;

    /**
     * @var string $documentID
     *
     * @ORM\Column(type="text")
     */
    private $documentID;

    /**
     * @var string $hash
     *
     * @ORM\Column(type="string" ,length=255,)
     */
    private $hash;


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
     * @param string $documentID
     */
    public function setDocumentID($documentID)
    {
        $this->documentID = $documentID;
    }

    /**
     * @return string
     */
    public function getDocumentID()
    {
        return $this->documentID;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getHash(){
        return $this->hash;
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


}
