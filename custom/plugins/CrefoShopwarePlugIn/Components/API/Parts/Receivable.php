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
 * Class Receivable
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
class Receivable
{

    private $currency;

    private $interest;

    private $customerreference;

    private $remarks;

    /**
     * @param $field
     * @param $value
     */
    public function setInterestField($field, $value)
    {
        switch ($field) {
            case 1:
                $this->interest = ["legal" => []];
                break;
            case 2:
                $this->interest = ["variable" => ["spread" => $value]];
                break;
            case 3:
                $this->interest = ["fix" => ["interestrate" => $value]];
                break;
            default:
        }
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getInterestField($field)
    {
        switch ($field) {
            case 1:
                return isset($this->interest['legal']) ? $this->interest['legal'] : null;
                break;
            case 2:
                return isset($this->interest['variable']['spread']) ? $this->interest['variable']['spread'] : null;
                break;
            case 3:
                return isset($this->interest['fix']['interestrate']) ? $this->interest['fix']['interestrate'] : null;
                break;
            default:
                return null;
        }
    }

    public function getInterestArray()
    {
        return $this->interest;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getCustomerreference()
    {
        return $this->customerreference;
    }

    /**
     * @param mixed $customerreference
     */
    public function setCustomerreference($customerreference)
    {
        $this->customerreference = $customerreference;
    }

    /**
     * @return mixed
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @param mixed $remarks
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }


}