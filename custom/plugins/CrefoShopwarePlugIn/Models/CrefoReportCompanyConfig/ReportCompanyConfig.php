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

namespace CrefoShopwarePlugIn\Models\CrefoReportCompanyConfig;

use \Shopware\Components\Model\ModelEntity;
use \Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="crefo_report_company_config")
 * @ORM\Entity(repositoryClass="ReportCompanyRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ReportCompanyConfig extends ModelEntity
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
     * @var string $legitimateKey
     *
     * @ORM\Column(name="legitimateKey", nullable=true)
     */
    private $legitimateKey;

    /**
     * @var string $reportLanguageKey
     *
     * @ORM\Column(name="reportLanguageKey", nullable=true)
     */
    private $reportLanguageKey;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return object
     */
    public function getUserAccountId()
    {
        return $this->useraccountId;
    }

    /**
     * @return string
     */
    public function getLegitimateKey()
    {
        return $this->legitimateKey;
    }

    /**
     * @return string
     */
    public function getReportLanguageKey()
    {
        return $this->reportLanguageKey;
    }


    /**
     * @param object $id
     */
    public function setUserAccountId($id)
    {
        $this->useraccountId = $id;
    }

    /**
     * @param string $key
     */
    public function setLegitimateKey($key)
    {
        $this->legitimateKey = $key;
    }

    /**
     * @param string $key
     */
    public function setReportLanguageKey($key)
    {
        $this->reportLanguageKey = $key;
    }

}