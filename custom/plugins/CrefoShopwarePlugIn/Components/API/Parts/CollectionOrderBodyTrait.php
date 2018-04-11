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
 * Class CollectionOrderBodyTrait
 * @package CrefoShopwarePlugIn\Components\API\Parts
 * @codeCoverageIgnore
 */
trait CollectionOrderBodyTrait
{

    private $collectionordertype;

    private $debtor;

    private $receivable;

    private $partreceivable;

    private $user;

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\Debtor
     */
    public function getDebtor()
    {
        return $this->debtor;
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\Receivable
     */
    public function getReceivable()
    {
        return $this->receivable;
    }

    /**
     * @return \CrefoShopwarePlugIn\Components\API\Parts\PartReceivable
     */
    public function getPartreceivable()
    {
        return $this->partreceivable;
    }


    /**
     * @return mixed
     */
    public function getCollectionordertype()
    {
        return $this->collectionordertype;
    }

    /**
     * @param mixed $collectionordertype
     */
    public function setCollectionordertype($collectionordertype)
    {
        $this->collectionordertype = $collectionordertype;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        if (null !== $user && strcmp((string)$user, '') != 0) {
            $this->user = $user;
        }
    }
}