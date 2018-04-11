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

namespace CrefoShopwarePlugIn\Components\Core;

if (file_exists(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'defuse' . DIRECTORY_SEPARATOR . 'php-encryption' . DIRECTORY_SEPARATOR . 'autoload.php')) {
    $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'defuse' . DIRECTORY_SEPARATOR . 'php-encryption' . DIRECTORY_SEPARATOR . 'autoload.php';
    require_once $path;
}

use \Defuse\Crypto\Crypto;
use \Defuse\Crypto\Key;
use \Defuse\Crypto\Exception as Ex;
use \Defuse;
use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class PasswordEncoder
 * @package CrefoShopwarePlugIn\Components\Core
 */
class PasswordEncoder
{
    /**
     * @var null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger $crefoLogger
     */
    private $crefoLogger = null;

    /**
     * @return null|\CrefoShopwarePlugIn\Components\Logger\CrefoLogger
     */
    protected function getCrefoLogger()
    {
        if ($this->crefoLogger === null) {
            $this->crefoLogger = new CrefoLogger();
        }
        return $this->crefoLogger;
    }

    /**
     * PasswordEncoder constructor.
     */
    public function __construct()
    {
        mb_internal_encoding("UTF-8");
    }

    /**
     * @param $password
     * @param $savedKeyString
     * @return string
     */
    public function encrypt($password, $savedKeyString)
    {
        $key = Defuse\Crypto\Key::LoadFromAsciiSafeString($savedKeyString);
        if (is_null($password) || !mb_strlen($password)) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password encrypt" . date("Y-m-d H:i:s") . "==",
                ['No password to encrypt']);
            return ""; //empty password
        } else {
            try {
                $ecrypted = base64_encode(Crypto::encrypt($password, $key));
                return $ecrypted;
            } catch (Ex\CryptoTestFailedException $ex) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password encrypt" . date("Y-m-d H:i:s") . "==",
                    ['Cannot safely perform encryption']);
                return ''; //empty password
            } catch (Ex\CannotPerformOperationException $ex) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password encrypt" . date("Y-m-d H:i:s") . "==",
                    ['Cannot safely perform encryption']);
                return ''; //empty password
            }
        }
    }

    /**
     * @param $encrypted_password
     * @param $savedKeyString
     * @return string
     */
    public function decrypt($encrypted_password, $savedKeyString)
    {
        $key = Defuse\Crypto\Key::LoadFromAsciiSafeString($savedKeyString);
        if (is_null($encrypted_password) || !mb_strlen($encrypted_password)) {
            return "";
        } else {
            try {
                $decrypted = Crypto::decrypt(base64_decode($encrypted_password), $key);
                return $decrypted;
            } catch (Ex\InvalidCiphertextException $ex) {
                // VERY IMPORTANT
                // Either:
                // 1. The ciphertext was modified by the attacker,
                // 2. The key is wrong, or
                // 3. $ciphertext is not a valid ciphertext or was corrupted.
                // Assume the worst.
                $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password decrypt" . date("Y-m-d H:i:s") . "==",
                    ['Cannot safely perform encryption']);
                return ''; //empty password
            } catch (Ex\CryptoTestFailedException $ex) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password decrypt" . date("Y-m-d H:i:s") . "==",
                    ['Cannot safely perform encryption']);
                return ''; //empty password
            } catch (Ex\CannotPerformOperationException $ex) {
                $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password decrypt" . date("Y-m-d H:i:s") . "==",
                    ['Cannot safely perform encryption']);
                return ''; //empty password
            }
        }
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
            $key = Crypto::createNewRandomKey();
            return $key->saveToAsciiSafeString();
        } catch (Ex\CryptoTestFailedException $ex) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password createKey" . date("Y-m-d H:i:s") . "==",
                ['Cannot safely create a key']);
        } catch (Ex\CannotPerformOperationException $ex) {
            $this->getCrefoLogger()->log(CrefoLogger::ERROR, "==Password createKey" . date("Y-m-d H:i:s") . "==",
                ['Cannot safely create a key']);
        }
        return null;
    }
}
