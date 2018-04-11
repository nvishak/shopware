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

namespace CrefoShopwarePlugIn\Components\Core;

// @codeCoverageIgnoreStart
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';
// @codeCoverageIgnoreEnd

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use Defuse;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception as Ex;
use Defuse\Crypto\Key;

/**
 * Class PasswordEncoder
 */
class PasswordEncoder
{
    /**
     * PasswordEncoder constructor.
     */
    public function __construct()
    {
        mb_internal_encoding('UTF-8');
    }

    /**
     * @param $password
     * @param $savedKeyString
     *
     * @return string
     */
    public function encrypt($password, $savedKeyString)
    {
        $key = Key::LoadFromAsciiSafeString($savedKeyString);
        if (null === $password || !mb_strlen($password)) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Password encrypt' . date('Y-m-d H:i:s') . '==',
                ['No password to encrypt']);

            return ''; //empty password
        }
        try {
            $encrypted = base64_encode(Crypto::encrypt($password, $key));

            return $encrypted;
            // @codeCoverageIgnoreStart
        } catch (Ex\BadFormatException $ex) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Password encrypt' . date('Y-m-d H:i:s') . '==',
                    ['Cannot safely perform encryption']);

            return ''; //empty password
        } catch (Ex\CryptoException $ex) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Password encrypt' . date('Y-m-d H:i:s') . '==',
                    ['Cannot safely perform encryption']);

            return ''; //empty password
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * @param $encrypted_password
     * @param $savedKeyString
     *
     * @return string
     */
    public function decrypt($encrypted_password, $savedKeyString)
    {
        try {
            $key = Key::LoadFromAsciiSafeString($savedKeyString);
            if (null === $encrypted_password || !mb_strlen($encrypted_password)) {
                return '';
            }
            $decrypted = Crypto::decrypt(base64_decode($encrypted_password), $key);
            return $decrypted;
            // @codeCoverageIgnoreStart
        } catch (Ex\WrongKeyOrModifiedCiphertextException $ex) {
            // VERY IMPORTANT
            // Either:
            // 1. The ciphertext was modified by the attacker,
            // 2. The key is wrong, or
            // 3. $ciphertext is not a valid ciphertext or was corrupted.
            // Assume the worst.
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Password decrypt' . date('Y-m-d H:i:s') . '==',
                    ['Cannot safely perform encryption']);

            return ''; //empty password
        } catch (Ex\CryptoException $ex) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Password decrypt' . date('Y-m-d H:i:s') . '==',
                    ['Cannot safely perform encryption']);

            return ''; //empty password
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * @return string|null
     */
    public function generateKey()
    {
        try {
            /**
             * @var Key $key
             */
            $key = Key::createNewRandomKey();

            return $key->saveToAsciiSafeString();
            // @codeCoverageIgnoreStart
        } catch (Ex\EnvironmentIsBrokenException $ex) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Password createKey' . date('Y-m-d H:i:s') . '==',
                ['Cannot safely create a key']);
        } catch (Ex\CryptoException $ex) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, '==Password createKey' . date('Y-m-d H:i:s') . '==',
                ['Cannot safely create a key']);
        }
        return null;
        // @codeCoverageIgnoreEnd
    }
}
