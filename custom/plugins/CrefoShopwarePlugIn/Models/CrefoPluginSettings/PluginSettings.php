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

namespace CrefoShopwarePlugIn\Models\CrefoPluginSettings;

use \Shopware\Components\Model\ModelEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="crefo_plugin_settings")
 */
class PluginSettings extends ModelEntity
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
     * @var string $communicationLanguage
     * @ORM\Column(type="text")
     */
    private $communicationLanguage;

    /**
     * @var string $encryptionKey
     * @ORM\Column(type="text", nullable=true)
     */
    private $encryptionKey;

    /**
     * @var integer $consentDeclaration
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $consentDeclaration = true;

    /**
     * @var string $logsMaxNumberOfRequest
     *
     * @ORM\Column(type="integer")
     */
    private $logsMaxNumberOfRequest;

    /**
     * @var string $logsMaxStorageTime
     *
     * @ORM\Column(type="integer")
     */
    private $logsMaxStorageTime;

    /**
     * @var integer $errorNotificationStatus
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $errorNotificationStatus = false;

    /**
     * @var string $emailAddress
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $emailAddress;

    /**
     * @var string $requestCheckAtValue
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $requestCheckAtValue;

    /**
     * @var string $errorTolerance
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $errorTolerance;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @method setCommunicationLanguage
     * @param  string $communicationLanguage
     */
    public function setCommunicationLanguage($communicationLanguage)
    {
        $this->communicationLanguage = $communicationLanguage;
    }

    /**
     * @param string $encryptionKey
     */
    public function setEncryptionKey($encryptionKey)
    {
        $this->encryptionKey = $encryptionKey;
    }

    /**
     * @param int $consentDeclaration
     */
    public function setConsentDeclaration($consentDeclaration)
    {
        $this->consentDeclaration = $consentDeclaration;
    }


    /**
     * @method setLogsMaxNumberOfRequests
     * @param  int $logsMaxNumberOfRequest
     */
    public function setLogsMaxNumberOfRequests($logsMaxNumberOfRequest)
    {
        $this->logsMaxNumberOfRequest = $logsMaxNumberOfRequest;
    }

    /**
     * @method setLogsMaxStorageTime
     * @param  int $logsMaxStorageTime
     */
    public function setLogsMaxStorageTime($logsMaxStorageTime)
    {
        $this->logsMaxStorageTime = $logsMaxStorageTime;
    }

    /**
     * @method setErrorNotificationActive
     * @param  boolean $errorNotficationStatus
     */
    public function setErrorNotificationActive($errorNotficationStatus)
    {
        $this->errorNotificationStatus = $errorNotficationStatus;
    }

    /**
     * @method setEmailAddress
     * @param  string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        if (strcmp($emailAddress, '') === 0) {
            $emailAddress = null;
        }
        $this->emailAddress = $emailAddress;
    }

    /**
     * @method setRequestCheckAtValue
     * @param  int $requestCheckAtValue
     */
    public function setRequestCheckAtValue($requestCheckAtValue)
    {
        $this->requestCheckAtValue = $requestCheckAtValue;
    }

    /**
     * @method setErrorTolerance
     * @param  int $errorTolerance
     */
    public function setErrorTolerance($errorTolerance)
    {
        $this->errorTolerance = $errorTolerance;
    }

    //==============getters==================

    /**
     * @method getCommunicationLanguage
     * @return string
     */
    public function getCommunicationLanguage()
    {
        return $this->communicationLanguage;
    }

    /**
     * @return string
     */
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }

    /**
     * @return int
     */
    public function getConsentDeclaration()
    {
        return $this->consentDeclaration;
    }


    /**
     * @method getLogsMaxNumberOfRequests
     * @return int
     */
    public function getLogsMaxNumberOfRequests()
    {
        return $this->logsMaxNumberOfRequest;
    }

    /**
     * @method getLogsMaxStorageTime
     * @return int
     */
    public function getLogsMaxStorageTime()
    {
        return $this->logsMaxStorageTime;
    }

    /**
     * @method isErrorNotificationActive
     * @return boolean
     */
    public function isErrorNotificationActive()
    {
        return boolval($this->errorNotificationStatus);
    }

    /**
     * @method getEmailAddress
     * @return string|null
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @method getRequestCheckAtValue
     * @return int|null
     */
    public function getRequestCheckAtValue()
    {
        return $this->requestCheckAtValue;
    }

    /**
     * @method getErrorTolerance
     * @return int|null
     */
    public function getErrorTolerance()
    {
        return $this->errorTolerance;
    }
}
