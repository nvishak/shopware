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

namespace CrefoShopwarePlugIn\Components\Versions\Helper;
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'old_vendor' . DIRECTORY_SEPARATOR . 'defuse' . DIRECTORY_SEPARATOR . 'php-encryption' . DIRECTORY_SEPARATOR . 'autoload.php';

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

class PasswordCryptoUpdater
{
    /**
     * @param $encrypted_password
     * @param $savedKeyString
     * @return string|null
     */
    public static function decrypt($encrypted_password, $savedKeyString)
    {
        $key = \Old\Crypto\Key::LoadFromAsciiSafeString($savedKeyString);
        if (null === $encrypted_password || !mb_strlen($encrypted_password)) {
            return null;
        } else {
            try {
                $decrypted = \Old\Crypto\Crypto::decrypt(base64_decode($encrypted_password), $key);
                return $decrypted;
            } catch (\Old\Crypto\Exception\CryptoException $ex) {
                CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, "Legacy decrypting failed or is not a legacy encrypting.",
                    ['Cannot safely perform legacy decryption.']);
                return  null;
            }
        }
    }
}