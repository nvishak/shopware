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

namespace CrefoShopwarePlugIn\Components\API\Request;

use CrefoShopwarePlugIn\Components\API\Exceptions\CrefoCommunicationException;
use \CrefoShopwarePlugIn\Components\Core\CrefoSanitization;
use \CrefoShopwarePlugIn\Components\Core\CrefoSanitizer;
use \CrefoShopwarePlugIn\Components\Core\RequestObject;

/**
 * Class ChangePasswordRequest
 * @package CrefoShopwarePlugIn\Components\API\Request
 */
class ChangePasswordRequest extends RequestObject implements CrefoSanitization
{
    protected $body;

    /**
     * ChangePasswordRequest constructor.
     * @inheritdoc
     */
    public function __construct($config)
    {
        parent::__construct($config);
        $this->body = new \stdClass();
        $this->body->newpassword = '';
    }

    /**
     * Sets the new password
     *
     * @param string $newPass
     */
    public function setNewPassword($newPass)
    {
        $this->body->newpassword = $newPass;
        $this->performSanitization();
    }

    /**
     * Gets the new password
     *
     * @return string
     */
    public function getNewPassword()
    {
        return $this->body->newpassword;
    }

    public function performSanitization()
    {
        $sanitizeObj = new CrefoSanitizer();
        $sanitizeObj->addSource(["new_pass" => $this->getNewPassword()]);
        $sanitizeObj->addRule('new_pass', 'string', 0, true);
        $sanitizeObj->run();
        $this->body->newpassword = $sanitizeObj->sanitized['new_pass'];
    }

    /**
     * @method changePassword
     * @return CrefoCommunicationException|\SoapFault
     */
    public function changePassword()
    {
        /**
         * @var \CrefoShopwarePlugIn\Components\Soap\CrefoSoapClient $crefoSoapCl
         */
        $crefoSoapCl = $this->getCrefoSoapCl();
        /**
         * @var \SoapClient $soapCl
         */
        $soapCl = $crefoSoapCl->getSoapClient();
        if (is_null($soapCl)) {
            throw new CrefoCommunicationException($this->getCrefoSoapCl()->getSoapError());
        }
        return $soapCl->changepassword($this);
    }
}