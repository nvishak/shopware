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

namespace CrefoShopwarePlugIn\Components\API\Parts;

/**
 * Class PartReceivable
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
class PartReceivable
{

    private $collectionturnovertype;
    private $dateinvoice;
    private $invoicenumber;
    private $receivablereason;
    private $datevaluta;
    private $datedue;
    private $amount;
    private $datecontract;

    const TIME_FORMAT = 'Y-m-d';

    /**
     * @return mixed
     */
    public function getCollectionturnovertype()
    {
        return $this->collectionturnovertype;
    }

    /**
     * @param mixed $collectionturnovertype
     */
    public function setCollectionturnovertype($collectionturnovertype)
    {
        $this->collectionturnovertype = $collectionturnovertype;
    }

    /**
     * @return mixed
     */
    public function getDateinvoice()
    {
        return $this->dateinvoice;
    }

    /**
     * @param \DateTime $dateinvoice
     */
    public function setDateinvoice(\DateTime $dateinvoice)
    {
        if (is_object($dateinvoice)) {
            $this->dateinvoice = $dateinvoice->format(self::TIME_FORMAT);
        }
    }

    /**
     * @return mixed
     */
    public function getInvoicenumber()
    {
        return $this->invoicenumber;
    }

    /**
     * @param mixed $invoicenumber
     */
    public function setInvoicenumber($invoicenumber)
    {
        $this->invoicenumber = $invoicenumber;
    }

    /**
     * @return mixed
     */
    public function getReceivablereason()
    {
        return $this->receivablereason;
    }

    /**
     * @param mixed $receivablereason
     */
    public function setReceivablereason($receivablereason)
    {
        $this->receivablereason = $receivablereason;
    }

    /**
     * @return mixed
     */
    public function getDatevaluta()
    {
        return $this->datevaluta;
    }

    /**
     * @param \DateTime $datevaluta
     */
    public function setDatevaluta(\DateTime $datevaluta)
    {
        if (is_object($datevaluta)) {
            $this->datevaluta = $datevaluta->format(self::TIME_FORMAT);
        }
    }

    /**
     * @return mixed
     */
    public function getDatedue()
    {
        return $this->datedue;
    }

    /**
     * @param \DateTime $datedue
     */
    public function setDatedue(\DateTime $datedue)
    {
        if (is_object($datedue)) {
            $this->datedue = $datedue->format(self::TIME_FORMAT);
        }
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getDatecontract()
    {
        return $this->datecontract;
    }

    /**
     * @param \DateTime $datecontract
     */
    public function setDatecontract(\DateTime $datecontract)
    {
        if (is_object($datecontract)) {
            $this->datecontract = $datecontract->format(self::TIME_FORMAT);
        }
    }


}