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

namespace CrefoShopwarePlugIn\Models\CrefoLogs;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Repository")
 * @ORM\Table(name="crefo_logs")
 * @ORM\HasLifecycleCallbacks
 */
class CrefoLogs extends ModelEntity
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
     * @var integer $id
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $statusLogs;

    /**
     * @var string $requestXMLDescription
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $requestXMLDescription = null;

    /**
     * @var string $requestXML
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $requestXML = null;

    /**
     * @var string $responseXMLDescription
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $responseXMLDescription = null;

    /**
     * @var string $responseXML
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $responseXML = null;


    /**
     * @var \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults reportResultId
     *
     * @ORM\OneToOne(targetEntity="CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults")
     * @ORM\JoinColumn(name="reportResultId", referencedColumnName="id")
     */
    private $reportResultId = null;

    /**
     * @var \DateTime $tsResponse
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tsResponse = null;

    /**
     * @var \DateTime $tsProcessEnd
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tsProcessEnd = null;

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
    public function getStatusLogs()
    {
        return $this->statusLogs;
    }

    /**
     * @param string $statusLogs
     */
    public function setStatusLogs($statusLogs)
    {
        $this->statusLogs = $statusLogs;
    }

    /**
     * @return string
     */
    public function getRequestXMLDescription()
    {
        return $this->requestXMLDescription;
    }

    /**
     * @param string $requestXMLDescription
     */
    public function setRequestXMLDescription($requestXMLDescription)
    {
        $this->requestXMLDescription = $requestXMLDescription;
    }

    /**
     * @return string
     */
    public function getRequestXML()
    {
        return $this->requestXML;
    }

    /**
     * @param string $requestXML
     */
    public function setRequestXML($requestXML)
    {
        $this->requestXML = $requestXML;
    }

    /**
     * @return string
     */
    public function getResponseXMLDescription()
    {
        return $this->responseXMLDescription;
    }

    /**
     * @param string $responseXMLDescription
     */
    public function setResponseXMLDescription($responseXMLDescription)
    {
        $this->responseXMLDescription = $responseXMLDescription;
    }

    /**
     * @return string
     */
    public function getResponseXML()
    {
        return $this->responseXML;
    }

    /**
     * @param string $responseXML
     */
    public function setResponseXML($responseXML)
    {
        $this->responseXML = $responseXML;
    }

    /**
     * @return \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults
     */
    public function getReportResultId()
    {
        return $this->reportResultId;
    }

    /**
     * @param \CrefoShopwarePlugIn\Models\CrefoReports\CrefoReportResults $reportResultId
     */
    public function setReportResultId($reportResultId)
    {
        $this->reportResultId = $reportResultId;
    }

    /**
     * @return \DateTime
     */
    public function getTsResponse()
    {
        return $this->tsResponse;
    }

    /**
     * @param \DateTime $tsResponse
     */
    public function setTsResponse($tsResponse)
    {
        $this->tsResponse = $tsResponse;
    }

    /**
     * @return \DateTime
     */
    public function getTsProcessEnd()
    {
        return $this->tsProcessEnd;
    }

    /**
     * @param \DateTime $tsProcessEnd
     */
    public function setTsProcessEnd($tsProcessEnd)
    {
        $this->tsProcessEnd = $tsProcessEnd;
    }
}
