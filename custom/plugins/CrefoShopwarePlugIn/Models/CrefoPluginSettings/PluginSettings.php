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

namespace CrefoShopwarePlugIn\Models\CrefoPluginSettings;

use \CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest;
use \Shopware\Components\Model\ModelEntity;
use \Doctrine\ORM\Mapping as ORM;
use \CrefoShopwarePlugIn\Components\Core\CrefoValidator;
use \Symfony\Component\Validator\Constraints as Assert;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * @ORM\Entity(repositoryClass="SettingsRepository")
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
     * @ORM\Column(type="integer")
     */
    private $requestCheckAtValue;

    /**
     * @var string $errorTolerance
     *
     * @ORM\Column(type="integer")
     */
    private $errorTolerance;


    /**
     * @var null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger $crefoLogger
     */
    private $crefoLogger = null;

    /**
     * @return null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger
     */
    private function getCrefoLogger()
    {
        if ($this->crefoLogger === null) {
            $this->crefoLogger = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.logger');
        }
        return $this->crefoLogger;
    }

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
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @method getRequestCheckAtValue
     * @return int
     */
    public function getRequestCheckAtValue()
    {
        return $this->requestCheckAtValue;
    }

    /**
     * @method getErrorTolerance
     * @return int
     */
    public function getErrorTolerance()
    {
        return $this->errorTolerance;
    }

    /**
     * @param integer $numberOfRequests
     * @param float $percent
     * @return bool - true if the Errors are overcoming the thresholds (send mail), otherwise false
     */
    public function verifyErrorsOnRequest($numberOfRequests, $percent)
    {
        $intValPercent = intval($percent);
        $ceilPercent = ceil($percent);
        if ($ceilPercent == $intValPercent) {
            $hasGreaterTolerance = $intValPercent >= $this->getErrorToleranceIntVal();
        } else {
            $hasGreaterTolerance = $ceilPercent > $this->getErrorToleranceIntVal();
        }
        $hasPassedNumberOfRequests = $numberOfRequests >= $this->getRequestCheckAtValueIntValue();
        return $hasPassedNumberOfRequests && $hasGreaterTolerance;
    }

    /**
     * @param integer $numberOfRequests
     * @return bool
     */
    public function hasReachedNumberOfRequestAllowed($numberOfRequests)
    {
        return intval($numberOfRequests) === $this->getRequestCheckAtValueIntValue();
    }

    /**
     * @param integer $numberOfRequests
     * @param integer $numberOfFailedRequests
     * @param float $errorQuote
     * @throws \Enlight_Exception
     */
    public function sendEmail($numberOfRequests, $numberOfFailedRequests, $errorQuote)
    {
        /**
         * @var CrefoValidator $validator
         */
        $validator = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.validator');
        /**
         * @var ConfigHeaderRequest $configHeaderRequest
         */
        $configHeaderRequest = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('creditreform.config_header_request');
        if (strcmp(strtolower($this->getCommunicationLanguage()), 'de') == 0) {
            $mailTemplate = 'sCREFOERRORREQUESTNOTIFICATIONDE';
        } else {
            $mailTemplate = 'sCREFOERRORREQUESTNOTIFICATIONEN';
        }
        $configOverride = [
            "fromMail" => $this->getEmailAddress(),
            'fromName' => ''
        ]; //fromMail => '' , fromName => ''
        $mail = CrefoCrossCuttingComponent::getShopwareInstance()->TemplateMail()->createMail($mailTemplate, [
            'errorNotification' => [
                'softwareVersion' => $configHeaderRequest->getPluginVersion(),
                'webshopVersion' => $configHeaderRequest->getShopVersion(),
                'numberOfRequests' => $numberOfRequests,
                'numberOfFailedRequests' => $numberOfFailedRequests,
                'errorQuote' => $validator->formatCurrency($errorQuote, $this->getCommunicationLanguage()),
                'errorNotification' => 'TRUE',
                'emailAddress' => $this->getEmailAddress(),
                'numberOfRequestCheck' => $this->getRequestCheckAtValueIntValue(),
                'errorTolerance' => $this->getErrorToleranceIntVal()
            ]
        ], null, $configOverride);
        $mail->addTo($this->getEmailAddress());
        try {
            $mail->send();
        } catch (\Exception $e) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==sendEmail==", ["Couldn't send email."]);
        }
    }

    /**
     * @return int
     */
    public function getErrorToleranceIntVal()
    {
        $values = [25, 50, 75];
        return intval($values[$this->getErrorTolerance()]);
    }

    /**
     * @return int
     */
    public function getRequestCheckAtValueIntValue()
    {
        $values = [10, 50, 100, 500, 1000];
        return intval($values[$this->getRequestCheckAtValue()]);
    }
}
