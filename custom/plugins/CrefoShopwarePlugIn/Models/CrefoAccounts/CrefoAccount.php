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

namespace CrefoShopwarePlugIn\Models\CrefoAccounts;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="crefo_accounts")
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\HasLifecycleCallbacks
 */
class CrefoAccount extends ModelEntity
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
     * @var string $useraccount
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $useraccount;

    /**
     * @var string $generalpassword
     *
     * @ORM\Column(type="text")
     */
    private $generalpassword;

    /**
     * @var string $individualpassword
     *
     * @ORM\Column(type="text")
     */
    private $individualpassword;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @method setUserAccount
     * @param  string $useraccount
     */
    public function setUserAccount($useraccount)
    {
        $this->useraccount = $useraccount;
    }

    /**
     * @method setGeneralPassword
     * @param  string $generalpassword
     */
    public function setGeneralPassword($generalpassword)
    {
        $this->generalpassword = $generalpassword;
    }

    /**
     * @method setIndividualPassword
     * @param  string $individualpassword
     */
    public function setIndividualPassword($individualpassword)
    {
        $this->individualpassword = $individualpassword;
    }

    /**
     * @param array $arrayResult
     */
    public function setAccountFromQuery($arrayResult)
    {
        $this->id = $arrayResult[0]['id'];
        $this->useraccount = $arrayResult[0]['useraccount'];
        $this->generalpassword = $arrayResult[0]['generalpassword'];
        $this->individualpassword = $arrayResult[0]['individualpassword'];
    }

    //==============getters==================

    /**
     * @method getUserAccount
     * @return string
     */
    public function getUserAccount()
    {
        return $this->useraccount;
    }

    /**
     * @method getGeneralPassword
     * @return string
     */
    public function getGeneralPassword()
    {
        return $this->generalpassword;
    }

    /**
     * @method getIndividualPassword
     * @return string
     */
    public function getIndividualPassword()
    {
        return $this->individualpassword;
    }
}
