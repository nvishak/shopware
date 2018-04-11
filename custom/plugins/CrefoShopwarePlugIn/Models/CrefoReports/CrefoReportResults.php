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

namespace CrefoShopwarePlugIn\Models\CrefoReports;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator_column", type="integer")
 * @ORM\DiscriminatorMap({"0" = "CompanyReportResults", "1" = "PrivatePersonReportResults"})
 * @ORM\Table(name="crefo_report_results")
 */
abstract class CrefoReportResults extends ModelEntity
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
     * @var string $orderNumber
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $orderNumber;

    /**
     * @var string $textReportName
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $textReportName;

    /**
     * @var integer $successfulSolvency
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $successfulSolvency = false;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @method setOrderId
     * @param string
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @method setTextReportName
     * @param  string $textReportName
     */
    public function setTextReportName($textReportName)
    {
        $this->textReportName = $textReportName;
    }

    /**
     * @param int $successfulSolvency
     */
    public function setSuccessfulSolvency($successfulSolvency)
    {
        $this->successfulSolvency = $successfulSolvency;
    }


    //==============getters==================


    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @method getTextReportName
     * @return  string
     */
    public function getTextReportName()
    {
        return $this->textReportName;
    }

    /**
     * @return int
     */
    public function getSuccessfulSolvency()
    {
        return $this->successfulSolvency;
    }
}
