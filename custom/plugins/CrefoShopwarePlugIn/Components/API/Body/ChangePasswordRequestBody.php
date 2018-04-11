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

namespace CrefoShopwarePlugIn\Components\API\Body;

/**
 * @codeCoverageIgnore
 * Class ChangePasswordRequestBody
 * @package CrefoShopwarePlugIn\Components\API\Body
 */
class ChangePasswordRequestBody implements RequestBody
{
    /**
     * @var string
     */
    private $newpassword;

    /**
     * @param string $newPass
     */
    public function setNewPassword($newPass){
        $this->newpassword = $newPass;
    }

    /**
     * @return string
     */
    public function getNewPassword(){
        return $this->newpassword;
    }
}