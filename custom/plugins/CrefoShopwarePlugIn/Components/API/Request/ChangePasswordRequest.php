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

namespace CrefoShopwarePlugIn\Components\API\Request;

use CrefoShopwarePlugIn\Components\API\Body\ChangePasswordRequestBody;
use CrefoShopwarePlugIn\Components\API\Body\RequestBody;
use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use CrefoShopwarePlugIn\Components\Core\CrefoSanitization;
use CrefoShopwarePlugIn\Components\Core\CrefoSanitizer;
use CrefoShopwarePlugIn\Components\Core\RequestObject;
use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class ChangePasswordRequest
 */
class ChangePasswordRequest extends RequestObject implements CrefoSanitization
{
    /**
     * @var ChangePasswordRequestBody
     */
    protected $body;

    /**
     * @codeCoverageIgnore
     * ChangePasswordRequest constructor.
     * {@inheritdoc}
     */
    public function __construct($config)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==ChangePasswordRequest::construct==',
            ['create change password request', 'config' => $config]);
        parent::__construct($config);
        $this->body = new ChangePasswordRequestBody();
        $this->body->setNewPassword('');
    }

    /**
     * @codeCoverageIgnore
     * @param ChangePasswordRequestBody $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @codeCoverageIgnore
     * @return RequestBody
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets the new password
     *
     * @param string $newPass
     */
    public function setNewPassword($newPass)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==ChangePasswordRequest::setNewPassword==',
            ['set new password']);
        $this->body->setNewPassword($newPass);
        $this->performSanitization();
    }

    /**
     * Gets the new password
     * @return string
     */
    public function getNewPassword()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==ChangePasswordRequest::getNewPassword==',
            ['get new password']);

        return $this->body->getNewPassword();
    }

    /**
     * @codeCoverageIgnore
     */
    public function performSanitization()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, '==ChangePasswordRequest::performSanitization==',
            ['perform sanitization']);
        $sanitizeObj = new CrefoSanitizer();
        $sanitizeObj->addSource(['new_pass' => $this->getNewPassword()]);
        $sanitizeObj->addRule('new_pass', 'string', 0, true);
        $sanitizeObj->run();
        $this->body->setNewPassword($sanitizeObj->sanitized['new_pass']);
    }

    /**
     * @method changePassword
     *
     * @throws CrefoCommunicationException
     *
     * @return mixed
     */
    public function changePassword()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::INFO, 'Call change password service.',
            ['change password request']);
        /**
         * @var \CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient $crefoSoapCl
         */
        $crefoSoapCl = $this->getCrefoSoapCl();
        /**
         * @var \SoapClient $soapCl
         */
        $soapCl = $crefoSoapCl->getSoapClient();
        // @codeCoverageIgnoreStart
        if (null === $soapCl) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        // @codeCoverageIgnoreStop

        return $soapCl->changepassword($this);
    }
}
