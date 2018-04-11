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

namespace CrefoShopwarePlugIn\Models\CrefoInkassoConfig;

use \Shopware\Components\Model\ModelEntity;
use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\DBAL\Types\Type;

/**
 * @ORM\Table(name="crefo_inkasso_config")
 * @ORM\Entity(repositoryClass="InkassoConfigRepository")
 * @ORM\HasLifecycleCallbacks
 */
class InkassoConfig extends ModelEntity
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
     * @var \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $useraccountId
     *
     * @ORM\OneToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount")
     * @ORM\JoinColumn(name="useraccountId", referencedColumnName="id")
     */
    private $useraccountId;

    /**
     * @var string $creditor
     *
     * @ORM\Column(name="creditor", nullable=true)
     */
    private $creditor;

    /**
     * @var string $order_type
     *
     * @ORM\Column(name="order_type", nullable=true)
     */
    private $order_type;

    /**
     * @var integer $interest_rate_radio
     *
     * @ORM\Column(name="interest_rate_radio", nullable=true)
     */
    private $interest_rate_radio;

    /**
     * @var Type::DECIMAL $interest_rate_value
     *
     * @ORM\Column(name="interest_rate_value", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $interest_rate_value;

    /**
     * @var integer $customer_reference
     *
     * @ORM\Column(name="customer_reference", nullable=true)
     */
    private $customer_reference;

    /**
     * @var string $turnover_type
     *
     * @ORM\Column(name="turnover_type", nullable=true)
     */
    private $turnover_type;

    /**
     * @var string $receivable_reason
     *
     * @ORM\Column(name="receivable_reason", nullable=true)
     */
    private $receivable_reason;

    /**
     * @var integer $valuta_date
     *
     * @ORM\Column(name="valuta_date", nullable=false)
     */
    private $valuta_date;

    /**
     * @var integer $due_date
     *
     * @ORM\Column(name="due_date", nullable=false)
     */
    private $due_date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \CrefoShopwarePlugIn\Models\CrefoAccounts\CrefoAccount $userAccountId
     */
    public function getUserAccountId()
    {
        return $this->useraccountId;
    }

    /**
     * @return string
     */
    public function getCreditor()
    {
        return $this->creditor;
    }

    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->order_type;
    }

    /**
     * @return integer
     */
    public function getInterestRateRadio()
    {
        return $this->interest_rate_radio;
    }

    /**
     * @return Type::DECIMAL
     */
    public function getInterestRateValue()
    {
        return $this->interest_rate_value;
    }

    /**
     * @return integer
     */
    public function getCustomerReference()
    {
        return $this->customer_reference;
    }

    /**
     * @return string
     */
    public function getTurnoverType()
    {
        return $this->turnover_type;
    }

    /**
     * @return string
     */
    public function getReceivableReason()
    {
        return $this->receivable_reason;
    }

    /**
     * @return int
     */
    public function getValutaDate()
    {
        return $this->valuta_date;
    }

    /**
     * @return int
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * @param object $id
     */
    public function setUserAccountId($id)
    {
        $this->useraccountId = $id;
    }

    /**
     * @param string $creditor
     */
    public function setCreditor($creditor)
    {
        if (strcmp($creditor, '') === 0) {
            $value = null;
        }
        $this->creditor = $creditor;
    }

    /**
     * @param string $value
     */
    public function setOrderType($value)
    {
        if (strcmp($value, '') === 0) {
            $value = null;
        }
        $this->order_type = $value;
    }

    /**
     * @param integer $value
     */
    public function setInterestRateRadio($value)
    {
        $this->interest_rate_radio = $value;
    }

    /**
     * @param Type ::DECIMAL
     */
    public function setInterestRateValue($value)
    {
        $this->interest_rate_value = $value;
    }

    /**
     * @param integer $value
     */
    public function setCustomerReference($value)
    {
        if (strcmp($value, '') === 0) {
            $value = null;
        }
        $this->customer_reference = $value;
    }

    /**
     * @param string $value
     */
    public function setTurnoverType($value)
    {
        if (strcmp($value, '') === 0) {
            $value = null;
        }
        $this->turnover_type = $value;
    }

    /**
     * @param string $value
     */
    public function setReceivableReason($value)
    {
        if (strcmp($value, '') === 0) {
            $value = null;
        }
        $this->receivable_reason = $value;
    }

    /**
     * @param int $value
     */
    public function setValutaDate($value)
    {
        $this->valuta_date = $value;
    }

    /**
     * @param int $value
     */
    public function setDueDate($value)
    {
        $this->due_date = $value;
    }

}