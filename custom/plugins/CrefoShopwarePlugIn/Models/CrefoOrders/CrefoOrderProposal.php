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

namespace CrefoShopwarePlugIn\Models\CrefoOrders;

use \Shopware\Components\Model\ModelEntity;
use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\DBAL\Types\Type;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="crefo_orders")
 * @ORM\HasLifecycleCallbacks
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="integer")
 * @ORM\DiscriminatorMap({"1" = "CrefoOrderProposal", "2" = "CrefoOrders"})
 */
class CrefoOrderProposal extends ModelEntity
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
     * @var string $documentNumber
     *
     * @ORM\Column(name="documentNumber", nullable=false)
     */
    protected $documentNumber;

    /**
     * @var integer $proposalStatus
     *
     * @ORM\Column(name="proposalStatus", type="integer", nullable=false)
     */
    private $proposalStatus;

    /**
     * @var integer $crefoOrderType
     *
     * @ORM\Column(name="crefoOrderType", type="integer" ,nullable=false)
     */
    private $crefoOrderType;

    /**
     * @var string $creditor
     *
     * @ORM\Column(name="creditor", nullable=true)
     */
    protected $creditor;

    /**
     * @var string $orderTypeKey
     *
     * @ORM\Column(name="orderTypeKey", nullable=true)
     */
    protected $orderTypeKey;

    /**
     * @var integer $interestRateRadio
     *
     * @ORM\Column(name="interestRateRadio", type="integer", nullable=true)
     */
    private $interestRateRadio;

    /**
     * @var Type::DECIMAL $interestRateValue
     *
     * @ORM\Column(name="interestRateValue", type="decimal", precision=4, scale=2, nullable=true)
     */
    protected $interestRateValue;

    /**
     * @var string $customerReference
     *
     * @ORM\Column(name="customerReference", nullable=true)
     */
    protected $customerReference;

    /**
     * @var string $remarks
     *
     * @ORM\Column(name="remarks", type="text", nullable=true)
     */
    protected $remarks;

    /**
     * @var string $turnoverTypeKey
     *
     * @ORM\Column(name="turnoverTypeKey", nullable=true)
     */
    protected $turnoverTypeKey;

    /**
     * @var \DateTime $dateInvoice
     *
     * @ORM\Column(name="dateInvoice", type="datetime", nullable=true)
     */
    protected $dateInvoice;

    /**
     * @var \DateTime $dateContract
     *
     * @ORM\Column(name="dateContract", type="datetime", nullable=true)
     */
    protected $dateContract;

    /**
     * @var string $invoiceNumber
     *
     * @ORM\Column(name="invoiceNumber", nullable=true)
     */
    protected $invoiceNumber;

    /**
     * @var string $receivableReasonKey
     *
     * @ORM\Column(name="receivableReasonKey", nullable=true)
     */
    protected $receivableReasonKey;

    /**
     * @var \DateTime $valutaDate
     *
     * @ORM\Column(name="valutaDate", type="datetime", nullable=true)
     */
    protected $valutaDate;

    /**
     * @var \DateTime $dueDate
     *
     * @ORM\Column(name="dueDate", type="datetime", nullable=true)
     */
    protected $dueDate;

    /**
     * @var string $errorXML
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $errorXML;

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
     * @return string
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * @param string $documentNumber
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;
    }

    /**
     * @return int
     */
    public function getProposalStatus()
    {
        return $this->proposalStatus;
    }

    /**
     * @param int $proposalStatus
     */
    public function setProposalStatus($proposalStatus)
    {
        $this->proposalStatus = $proposalStatus;
    }

    /**
     * @return int
     */
    public function getCrefoOrderType()
    {
        return $this->crefoOrderType;
    }

    /**
     * @param int $crefoOrderType
     */
    public function setCrefoOrderType($crefoOrderType)
    {
        $this->crefoOrderType = $crefoOrderType;
    }

    /**
     * @return string
     */
    public function getCreditor()
    {
        return $this->creditor;
    }

    /**
     * @param string $creditor
     */
    public function setCreditor($creditor)
    {
        $this->creditor = $creditor;
    }

    /**
     * @return string
     */
    public function getOrderTypeKey()
    {
        return $this->orderTypeKey;
    }

    /**
     * @param string $orderTypeKey
     */
    public function setOrderTypeKey($orderTypeKey)
    {
        $this->orderTypeKey = $orderTypeKey;
    }

    /**
     * @return int
     */
    public function getInterestRateRadio()
    {
        return $this->interestRateRadio;
    }

    /**
     * @param int $interestRateRadio
     */
    public function setInterestRateRadio($interestRateRadio)
    {
        $this->interestRateRadio = $interestRateRadio;
    }

    /**
     * @return Type::DECIMAL
     */
    public function getInterestRateValue()
    {
        return $this->interestRateValue;
    }

    /**
     * @param Type ::DECIMAL $interestRateValue
     */
    public function setInterestRateValue($interestRateValue)
    {
        $this->interestRateValue = $interestRateValue;
    }

    /**
     * @return string
     */
    public function getCustomerReference()
    {
        return $this->customerReference;
    }

    /**
     * @param string $customerReference
     */
    public function setCustomerReference($customerReference)
    {
        $this->customerReference = $customerReference;
    }

    /**
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @param string $remarks
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }

    /**
     * @return string
     */
    public function getTurnoverTypeKey()
    {
        return $this->turnoverTypeKey;
    }

    /**
     * @param string $turnoverTypeKey
     */
    public function setTurnoverTypeKey($turnoverTypeKey)
    {
        $this->turnoverTypeKey = $turnoverTypeKey;
    }

    /**
     * @return \DateTime
     */
    public function getDateInvoice()
    {
        return $this->dateInvoice;
    }

    /**
     * @param \DateTime $dateInvoice
     */
    public function setDateInvoice($dateInvoice)
    {
        $this->dateInvoice = $dateInvoice;
    }

    /**
     * @return \DateTime
     */
    public function getDateContract()
    {
        return $this->dateContract;
    }

    /**
     * @param \DateTime $dateContract
     */
    public function setDateContract($dateContract)
    {
        $this->dateContract = $dateContract;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return string
     */
    public function getReceivableReasonKey()
    {
        return $this->receivableReasonKey;
    }

    /**
     * @param string $receivableReasonKey
     */
    public function setReceivableReasonKey($receivableReasonKey)
    {
        $this->receivableReasonKey = $receivableReasonKey;
    }

    /**
     * @return \DateTime
     */
    public function getValutaDate()
    {
        return $this->valutaDate;
    }

    /**
     * @param \DateTime $valutaDate
     */
    public function setValutaDate($valutaDate)
    {
        $this->valutaDate = $valutaDate;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTime $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return string
     */
    public function getErrorXML()
    {
        return $this->errorXML;
    }

    /**
     * @param string $errorXML
     */
    public function setErrorXML($errorXML)
    {
        $this->errorXML = $errorXML;
    }

}