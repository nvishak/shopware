<?php

namespace AvenFaxorder\Models;

use Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="s_faxorderdetails")
 */
class Orderdetails extends ModelEntity
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
     * @var string $fName
     *
     * @ORM\Column(type="text")
     */
    private $fname;

    /**
     * @var string $lName
     *
     * @ORM\Column(type="text")
     */
    private $lname;

    /**
     * @var string $bcompany
     *
     * @ORM\Column(type="text")
     */
    private $bcompany;

    /**
     * @var string $baddress1
     *
     * @ORM\Column(type="text")
     */
    private $baddress1;

    /**
     * @var string $baddress2
     *
     * @ORM\Column(type="text")
     */
    private $baddress2;

    /**
     * @var string $bcity
     *
     * @ORM\Column(type="text")
     */
    private $bcity;

    /**
     * @var string $bpostcode
     *
     * @ORM\Column(type="text")
     */
    private $bpostcode;

    /**
     * @var string $bcountry
     *
     * @ORM\Column(type="text")
     */
    private $bcountry;

    /**
     * @var string $btelephone
     *
     * @ORM\Column(type="text")
     */
    private $btelephone;

    /**
     * @var string $bfax
     *
     * @ORM\Column(type="text")
     */
    private $bfax;

    /**
     * @var string $scompany
     *
     * @ORM\Column(type="text")
     */
    private $scompany;

    /**
     * @var string $saddress1
     *
     * @ORM\Column(type="text")
     */
    private $saddress1;

    /**
     * @var string $saddress2
     *
     * @ORM\Column(type="text")
     */
    private $saddress2;

    /**
     * @var string $scity
     *
     * @ORM\Column(type="text")
     */
    private $scity;

    /**
     * @var string $spostcode
     *
     * @ORM\Column(type="text")
     */
    private $spostcode;

    /**
     * @var string $scountry
     *
     * @ORM\Column(type="text")
     */
    private $scountry;

    /**
     * @var string $stelephone
     *
     * @ORM\Column(type="text")
     */
    private $stelephone;

    /**
     * @var string $sfax
     *
     * @ORM\Column(type="text")
     */
    private $sfax;

    /**
     * @var string $vatid
     *
     * @ORM\Column(type="text")
     */
    private $vatid;

    /**
     * @var string $email
     *
     * @ORM\Column(type="text")
     */
    private $email;
//
//    /**
//     * @var string $iordernumber
//     *
//     * @ORM\Column(type="text")
//     */
//    private $iordernumber;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getVatid()
    {
        return $this->vatid;
    }

    /**
     * @param string $vatid
     */
    public function setVatid($vatid)
    {
        $this->vatid = $vatid;
    }

    /**
     * @return string
     */
    public function getBaddress1()
    {
        return $this->baddress1;
    }

    /**
     * @param string $baddress1
     */
    public function setBaddress1($baddress1)
    {
        $this->baddress1 = $baddress1;
    }

    /**
     * @return string
     */
    public function getBaddress2()
    {
        return $this->baddress2;
    }

    /**
     * @param string $baddress2
     */
    public function setBaddress2($baddress2)
    {
        $this->baddress2 = $baddress2;
    }

    /**
     * @return string
     */
    public function getBcity()
    {
        return $this->bcity;
    }

    /**
     * @param string $bcity
     */
    public function setBcity($bcity)
    {
        $this->bcity = $bcity;
    }

    /**
     * @return string
     */
    public function getBcompany()
    {
        return $this->bcompany;
    }

    /**
     * @param string $bcompany
     */
    public function setBcompany($bcompany)
    {
        $this->bcompany = $bcompany;
    }

    /**
     * @return string
     */
    public function getBcountry()
    {
        return $this->bcountry;
    }

    /**
     * @param string $bcountry
     */
    public function setBcountry($bcountry)
    {
        $this->bcountry = $bcountry;
    }

    /**
     * @return string
     */
    public function getBfax()
    {
        return $this->bfax;
    }

    /**
     * @param string $bfax
     */
    public function setBfax($bfax)
    {
        $this->bfax = $bfax;
    }

    /**
     * @return string
     */
    public function getBpostcode()
    {
        return $this->bpostcode;
    }

    /**
     * @param string $bpostcode
     */
    public function setBpostcode($bpostcode)
    {
        $this->bpostcode = $bpostcode;
    }

    /**
     * @return string
     */
    public function getBtelephone()
    {
        return $this->btelephone;
    }

    /**
     * @param string $btelephone
     */
    public function setBtelephone($btelephone)
    {
        $this->btelephone = $btelephone;
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
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param string $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    /**
     * @return string
     */
//    public function getIordernumber()
//    {
//        return $this->iordernumber;
//    }

    /**
     * @param string $iordernumber
     */
//    public function setIordernumber($iordernumber)
//    {
//        $this->iordernumber = $iordernumber;
//    }
    /**
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * @param string $lname
     */
    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    /**
     * @return string
     */
    public function getSaddress1()
    {
        return $this->saddress1;
    }

    /**
     * @param string $saddress1
     */
    public function setSaddress1($saddress1)
    {
        $this->saddress1 = $saddress1;
    }

    /**
     * @return string
     */
    public function getSaddress2()
    {
        return $this->saddress2;
    }

    /**
     * @param string $saddress2
     */
    public function setSaddress2($saddress2)
    {
        $this->saddress2 = $saddress2;
    }

    /**
     * @return string
     */
    public function getScity()
    {
        return $this->scity;
    }

    /**
     * @param string $scity
     */
    public function setScity($scity)
    {
        $this->scity = $scity;
    }

    /**
     * @return string
     */
    public function getScompany()
    {
        return $this->scompany;
    }

    /**
     * @param string $scompany
     */
    public function setScompany($scompany)
    {
        $this->scompany = $scompany;
    }
    /**
     * @return string
     */
    public function getScountry()
    {
        return $this->scountry;
    }

    /**
     * @param string $scountry
     */
    public function setScountry($scountry)
    {
        $this->scountry = $scountry;
    }

    /**
     * @return string
     */
    public function getSfax()
    {
        return $this->sfax;
    }

    /**
     * @param string $sfax
     */
    public function setSfax($sfax)
    {
        $this->sfax = $sfax;
    }

    /**
     * @return string
     */
    public function getSpostcode()
    {
        return $this->spostcode;
    }

    /**
     * @param string $spostcode
     */
    public function setSpostcode($spostcode)
    {
        $this->spostcode = $spostcode;
    }

    /**
     * @return string
     */
    public function getStelephone()
    {
        return $this->stelephone;
    }

    /**
     * @param string $stelephone
     */
    public function setStelephone($stelephone)
    {
        $this->stelephone = $stelephone;
    }

}
