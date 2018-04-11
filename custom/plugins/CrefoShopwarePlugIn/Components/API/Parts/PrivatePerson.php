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

namespace CrefoShopwarePlugIn\Components\API\Parts;

/**
 * Class PrivatePerson
 * @package CrefoShopwarePlugIn\Components\API\Parts
 */
class PrivatePerson
{
    private $salutation;
    private $surname;
    private $firstname;

    /**
     * @return mixed
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param mixed $salutation
     */
    public function setSalutation($salutation)
    {
        if (is_string($salutation) && strcmp(strtolower($salutation), "mr") == 0) {
            $this->salutation = "SA-1";
        } else {
            $this->salutation = "SA-2";
        }
    }

    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @codeCoverageIgnore
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @codeCoverageIgnore
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @codeCoverageIgnore
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }


}