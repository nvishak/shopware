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

use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\AssociationOverrides({
 *      @ORM\AssociationOverride(name="orderId",
 *          joinColumns=@ORM\JoinColumn(
 *              name="orderId", referencedColumnName="id"
 *          )
 *      )
 * })
 */
class CrefoOrders extends CrefoOrderProposal
{

    /**
     * @var string $orderNumber
     *
     * @ORM\Column(name="orderNumber", type="string", length=30, nullable=false)
     */
    private $orderNumber;

    /**
     * @var \DateTime $sentDate
     *
     * @ORM\Column(name="sentDate", type="datetime", nullable=true)
     */
    private $sentDate;

    /**
     * @var string $userAccountNumber
     *
     * @ORM\Column(name="userAccountNumber", type="string", nullable=false)
     */
    private $userAccountNumber;

    /**
     * @var string $languageIso
     * @ORM\Column(name="languageIso", type="string", length=10, nullable=false)
     */
    private $languageIso;

    /**
     * @var string $salutation
     *
     * @ORM\Column(name="salutation", type="string", nullable=true)
     */
    private $salutation;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="lastName", type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="firstName", type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string $companyName
     *
     * @ORM\Column(name="companyName", type="string", nullable=true)
     */
    private $companyName;

    /**
     * @var string $street
     *
     * @ORM\Column(name="street", type="string", nullable=false)
     */
    private $street;

    /**
     * @var string $zipCode
     *
     * @ORM\Column(name="zipCode", type="string", nullable=false)
     */
    private $zipCode;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", nullable=false)
     */
    private $city;

    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string", nullable=false)
     */
    private $country;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @var string $orderType
     *
     * @ORM\Column(name="orderType", type="string", nullable=false)
     */
    private $orderType;

    /**
     * @var string $interestRate
     *
     * @ORM\Column(name="interestRate", type="string", nullable=false)
     */
    private $interestRate;

    /**
     * @var string $turnoverType
     *
     * @ORM\Column(name="turnoverType", type="string", nullable=false)
     */
    private $turnoverType;

    /**
     * @var string $receivableReason
     *
     * @ORM\Column(name="receivableReason", type="string", nullable=false)
     */
    private $receivableReason;

    /**
     * @var float $amount
     *
     * @ORM\Column(name="amount", type="float", nullable=false)
     */
    private $amount;

    /**
     * @var string $currency
     *
     * @ORM\Column(name="currency", type="string", length=5, nullable=false)
     */
    private $currency;

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
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
    public function getLanguageIso()
    {
        return $this->languageIso;
    }

    /**
     * @param string $languageIso
     */
    public function setLanguageIso($languageIso)
    {
        $this->languageIso = $languageIso;
    }


    /**
     * @return string
     */
    public function getUserAccountNumber()
    {
        return $this->userAccountNumber;
    }

    /**
     * @param string $userAccountNumber
     */
    public function setUserAccountNumber($userAccountNumber)
    {
        $this->userAccountNumber = $userAccountNumber;
    }

    /**
     * @return \DateTime
     */
    public function getSentDate()
    {
        return $this->sentDate;
    }

    /**
     * @param \DateTime $sentDate
     */
    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;
    }

    /**
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param string $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
    }

    /**
     * @return string
     */
    public function getInterestRate()
    {
        return $this->interestRate;
    }

    /**
     * @param string $interestRate
     */
    public function setInterestRate($interestRate)
    {
        $this->interestRate = $interestRate;
    }

    /**
     * @return string
     */
    public function getTurnoverType()
    {
        return $this->turnoverType;
    }

    /**
     * @param string $turnoverType
     */
    public function setTurnoverType($turnoverType)
    {
        $this->turnoverType = $turnoverType;
    }

    /**
     * @return string
     */
    public function getReceivableReason()
    {
        return $this->receivableReason;
    }

    /**
     * @param string $receivableReason
     */
    public function setReceivableReason($receivableReason)
    {
        $this->receivableReason = $receivableReason;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}
