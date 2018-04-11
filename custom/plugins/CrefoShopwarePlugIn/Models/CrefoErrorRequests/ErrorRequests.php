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

namespace CrefoShopwarePlugIn\Models\CrefoErrorRequests;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="crefo_error_requests")
 */
class ErrorRequests extends ModelEntity
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
     * @var integer $numberOfRequests
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $numberOfRequests;

    /**
     * @var integer $numberOfFailedRequests
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $numberOfFailedRequests;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumberOfRequests()
    {
        return $this->numberOfRequests;
    }

    /**
     * @param int $numberOfRequests
     */
    public function setNumberOfRequests($numberOfRequests)
    {
        $this->numberOfRequests = $numberOfRequests;
    }

    /**
     * @return int
     */
    public function getNumberOfFailedRequests()
    {
        return $this->numberOfFailedRequests;
    }

    /**
     * @param int $numberOfFailedRequests
     */
    public function setNumberOfFailedRequests($numberOfFailedRequests)
    {
        $this->numberOfFailedRequests = $numberOfFailedRequests;
    }

    /**
     * @return float
     */
    public function getFailurePercent()
    {
        if ($this->getNumberOfRequests() === 0) {
            return 0;
        }
        return ($this->getNumberOfFailedRequests() * 100) / $this->getNumberOfRequests();
    }

    public function addRequest()
    {
        $this->setNumberOfRequests($this->getNumberOfRequests() + 1);
    }

    public function addFailedRequest()
    {
        $this->setNumberOfFailedRequests($this->getNumberOfFailedRequests() + 1);
    }

    public function resetCounters(){
        $this->setNumberOfFailedRequests(0);
        $this->setNumberOfRequests(0);
    }
}
