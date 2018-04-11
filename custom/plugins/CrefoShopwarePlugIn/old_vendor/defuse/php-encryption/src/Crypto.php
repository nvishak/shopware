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

namespace Old\Crypto;

use \Old\Crypto\Exception as Ex;

use \Old\Crypto\Core;
use \Old\Crypto\Key;
use \Old\Crypto\Encoding;
use \Old\Crypto\RuntimeTests;
use \Old\Crypto\Config;

/*
 * PHP Encryption Library
 * Copyright (c) 2014-2015, Taylor Hornby <https://defuse.ca>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
class Crypto
{
    // Ciphertext format: [____VERSION____][____HMAC____][____IV____][____CIPHERTEXT____].
    // Legacy format: [____HMAC____][____IV____][____CIPHERTEXT____].

    /**
     * Use this to generate a random encryption key.
     *
     * @return string
     */
    public static function createNewRandomKey()
    {
        return Key::CreateNewRandomKey(Core::CURRENT_VERSION);
    }

    /**
     * Encrypts a message.
     *
     * $plaintext is the message to encrypt.
     * $key is the encryption key, a value generated by CreateNewRandomKey().
     * You MUST catch exceptions thrown by this function. Read the docs.
     *
     * @param string $plaintext
     * @param string $key
     * @param boolean $raw_binary
     * @return string
     * @throws Ex\CannotPerformOperationException
     * @throws Ex\CryptoTestFailedException
     */
    public static function encrypt($plaintext, $key, $raw_binary = false)
    {
        RuntimeTests::runtimeTest();

        /* Attempt to validate that the key was generated safely. */
        if (!is_a($key, "\Old\Crypto\Key")) {
            throw new Ex\CannotPerformOperationException(
                "The given key is not a valid Key object."
            );
        }
        $key = $key->getRawBytes();

        $config = self::getVersionConfigFromHeader(Core::CURRENT_VERSION, Core::CURRENT_VERSION);

        if (Core::ourStrlen($key) !== $config->keyByteSize()) {
            throw new Ex\CannotPerformOperationException("Key is the wrong size.");
        }
        $salt = Core::secureRandom($config->saltByteSize());

        // Generate a sub-key for encryption.
        $ekey = Core::HKDF(
            $config->hashFunctionName(),
            $key,
            $config->keyByteSize(),
            $config->encryptionInfoString(),
            $salt,
            $config
        );

        // Generate a sub-key for authentication and apply the HMAC.
        $akey = Core::HKDF(
            $config->hashFunctionName(),
            $key,
            $config->keyByteSize(),
            $config->authenticationInfoString(),
            $salt,
            $config
        );

        // Generate a random initialization vector.
        Core::ensureFunctionExists("openssl_cipher_iv_length");
        $ivsize = \openssl_cipher_iv_length($config->cipherMethod());
        if ($ivsize === false || $ivsize <= 0) {
            throw new Ex\CannotPerformOperationException(
                "Could not get the IV length from OpenSSL"
            );
        }
        $iv = Core::secureRandom($ivsize);

        $ciphertext = $salt . $iv . self::plainEncrypt($plaintext, $ekey, $iv, $config);
        $auth = \hash_hmac($config->hashFunctionName(), Core::CURRENT_VERSION . $ciphertext, $akey, true);

        // We're now appending the header as of 2.00
        $ciphertext = Core::CURRENT_VERSION . $auth . $ciphertext;

        if ($raw_binary) {
            return $ciphertext;
        }
        return Encoding::binToHex($ciphertext);
    }

    /**
     * Decrypts a ciphertext.
     * $ciphertext is the ciphertext to decrypt.
     * $key is the key that the ciphertext was encrypted with.
     * You MUST catch exceptions thrown by this function. Read the docs.
     *
     * @param string $ciphertext
     * @param string $key
     * @param boolean $raw_binary
     * @return string
     * @throws Ex\CannotPerformOperationException
     * @throws Ex\CryptoTestFailedException
     * @throws Ex\InvalidCiphertextException
     */
    public static function decrypt($ciphertext, $key, $raw_binary = false)
    {
        RuntimeTests::runtimeTest();

        /* Attempt to validate that the key was generated safely. */
        if (!is_a($key, "\Old\Crypto\Key")) {
            throw new Ex\CannotPerformOperationException(
                "The given key is not a valid Key object."
            );
        }
        $key = $key->getRawBytes();

        if (!$raw_binary) {
            try {
                $ciphertext = Encoding::hexToBin($ciphertext);
            } catch (\RangeException $ex) {
                throw new Ex\InvalidCiphertextException(
                    "Ciphertext has invalid hex encoding."
                );
            }
        }

        // Grab the header tag
        $version = Core::ourSubstr($ciphertext, 0, Core::HEADER_VERSION_SIZE);

        // Load the configuration for this version
        $config = self::getVersionConfigFromHeader($version, Core::CURRENT_VERSION);

        // Now let's operate on the remainder of the ciphertext as normal
        $ciphertext = Core::ourSubstr($ciphertext, Core::HEADER_VERSION_SIZE, null);

        // Extract the HMAC from the front of the ciphertext.
        if (Core::ourStrlen($ciphertext) <= $config->macByteSize()) {
            throw new Ex\InvalidCiphertextException(
                "Ciphertext is too short."
            );
        }
        $hmac = Core::ourSubstr(
            $ciphertext, 
            0,
            $config->macByteSize()
        );
        if ($hmac === false) {
            throw new Ex\CannotPerformOperationException();
        }
        $salt = Core::ourSubstr(
            $ciphertext,
            $config->macByteSize(), 
            $config->saltByteSize()
        );
        if ($salt === false) {
            throw new Ex\CannotPerformOperationException();
        }
        
        $ciphertext = Core::ourSubstr(
            $ciphertext,
            $config->macByteSize() + $config->saltByteSize()
        );
        if ($ciphertext === false) {
            throw new Ex\CannotPerformOperationException();
        }

        // Regenerate the same authentication sub-key.
        $akey = Core::HKDF($config->hashFunctionName(), $key, $config->keyByteSize(), $config->authenticationInfoString(), $salt, $config);

        if (self::verifyHMAC($hmac, $version . $salt . $ciphertext, $akey, $config)) {
            // Regenerate the same encryption sub-key.
            $ekey = Core::HKDF($config->hashFunctionName(), $key, $config->keyByteSize(), $config->encryptionInfoString(), $salt, $config);

            // Extract the initialization vector from the ciphertext.
            Core::EnsureFunctionExists("openssl_cipher_iv_length");
            $ivsize = \openssl_cipher_iv_length($config->cipherMethod());
            if ($ivsize === false || $ivsize <= 0) {
                throw new Ex\CannotPerformOperationException(
                    "Could not get the IV length from OpenSSL"
                );
            }
            if (Core::ourStrlen($ciphertext) <= $ivsize) {
                throw new Ex\InvalidCiphertextException(
                    "Ciphertext is too short."
                );
            }
            $iv = Core::ourSubstr($ciphertext, 0, $ivsize);
            if ($iv === false) {
                throw new Ex\CannotPerformOperationException();
            }
            $ciphertext = Core::ourSubstr($ciphertext, $ivsize);
            if ($ciphertext === false) {
                throw new Ex\CannotPerformOperationException();
            }

            $plaintext = self::plainDecrypt($ciphertext, $ekey, $iv, $config);

            return $plaintext;
        } else {
            /*
             * We throw an exception instead of returning false because we want
             * a script that doesn't handle this condition to CRASH, instead
             * of thinking the ciphertext decrypted to the value false.
             */
            throw new Ex\InvalidCiphertextException(
                "Integrity check failed."
            );
        }
    }

    /**
     * Decrypts a ciphertext (legacy -- before version tagging)
     *
     * $ciphertext is the ciphertext to decrypt.
     * $key is the key that the ciphertext was encrypted with.
     * You MUST catch exceptions thrown by this function. Read the docs.
     *
     * @param string $ciphertext
     * @param string $key
     * @return string
     * @throws Ex\CannotPerformOperationException
     * @throws Ex\CryptoTestFailedException
     * @throws Ex\InvalidCiphertextException
     */
    public static function legacyDecrypt($ciphertext, $key)
    {
        RuntimeTests::runtimeTest();
        $config = self::getVersionConfigFromHeader(Core::LEGACY_VERSION, Core::LEGACY_VERSION);

        // Extract the HMAC from the front of the ciphertext.
        if (Core::ourStrlen($ciphertext) <= $config->macByteSize()) {
            throw new Ex\InvalidCiphertextException(
                "Ciphertext is too short."
            );
        }
        $hmac = Core::ourSubstr($ciphertext, 0, $config->macByteSize());
        if ($hmac === false) {
            throw new Ex\CannotPerformOperationException();
        }
        $ciphertext = Core::ourSubstr($ciphertext, $config->macByteSize());
        if ($ciphertext === false) {
            throw new Ex\CannotPerformOperationException();
        }

        // Regenerate the same authentication sub-key.
        $akey = Core::HKDF(
            $config->hashFunctionName(),
            $key,
            $config->keyByteSize(),
            $config->authenticationInfoString(),
            null,
            $config
        );

        if (self::verifyHMAC($hmac, $ciphertext, $akey, $config)) {
            // Regenerate the same encryption sub-key.
            $ekey = Core::HKDF(
                $config->hashFunctionName(),
                $key,
                $config->keyByteSize(),
                $config->encryptionInfoString(),
                null,
                $config
            );

            // Extract the initialization vector from the ciphertext.
            Core::EnsureFunctionExists("openssl_cipher_iv_length");
            $ivsize = \openssl_cipher_iv_length($config->cipherMethod());
            if ($ivsize === false || $ivsize <= 0) {
                throw new Ex\CannotPerformOperationException(
                    "Could not get the IV length from OpenSSL"
                );
            }
            if (Core::ourStrlen($ciphertext) <= $ivsize) {
                throw new Ex\InvalidCiphertextException(
                    "Ciphertext is too short."
                );
            }
            $iv = Core::ourSubstr($ciphertext, 0, $ivsize);
            if ($iv === false) {
                throw new Ex\CannotPerformOperationException();
            }
            $ciphertext = Core::ourSubstr($ciphertext, $ivsize);
            if ($ciphertext === false) {
                throw new Ex\CannotPerformOperationException();
            }

            $plaintext = self::plainDecrypt($ciphertext, $ekey, $iv, $config);

            return $plaintext;
        } else {
            /*
             * We throw an exception instead of returning false because we want
             * a script that doesn't handle this condition to CRASH, instead
             * of thinking the ciphertext decrypted to the value false.
             */
            throw new Ex\InvalidCiphertextException(
                "Integrity check failed."
            );
        }
    }

    /**
     * You MUST NOT call this method directly.
     *
     * Unauthenticated message encryption.
     *
     * @param string $plaintext
     * @param string $key
     * @param string $iv
     * @param array $config
     * @return string
     * @throws Ex\CannotPerformOperationException
     */
    protected static function plainEncrypt($plaintext, $key, $iv, $config)
    {
        Core::ensureConstantExists("OPENSSL_RAW_DATA");
        Core::ensureFunctionExists("openssl_encrypt");
        $ciphertext = \openssl_encrypt(
            $plaintext,
            $config->cipherMethod(),
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );

        if ($ciphertext === false) {
            throw new Ex\CannotPerformOperationException(
                "openssl_encrypt() failed."
            );
        }

        return $ciphertext;
    }

    /**
     * You MUST NOT call this method directly.
     *
     * Unauthenticated message deryption.
     *
     * @param string $ciphertext
     * @param string $key
     * @param string $iv
     * @param array $config
     * @return string
     * @throws Ex\CannotPerformOperationException
     */
    protected static function plainDecrypt($ciphertext, $key, $iv, $config)
    {
        Core::ensureConstantExists("OPENSSL_RAW_DATA");
        Core::ensureFunctionExists("openssl_decrypt");
        $plaintext = \openssl_decrypt(
            $ciphertext,
            $config->cipherMethod(),
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        if ($plaintext === false) {
            throw new Ex\CannotPerformOperationException(
                "openssl_decrypt() failed."
            );
        }

        return $plaintext;
    }

    /**
     * Verify an HMAC without timing/cache side-channel leakage.
     *
     * @param string $correct_hmac HMAC string (raw binary)
     * @param string $message Ciphertext (raw binary)
     * @param string $key Authentication key (raw binary)
     * @return boolean
     * @throws Ex\CannotPerformOperationException
     */
    protected static function verifyHMAC($correct_hmac, $message, $key, $config)
    {
        $message_hmac = \hash_hmac($config->hashFunctionName(), $message, $key, true);
        return Core::hashEquals($correct_hmac, $message_hmac);
    }

    /**
     * Get the encryption configuration based on the version in a header.
     *
     * @param string $header The header to read the version number from.
     * @param string $min_ver_header The header of the minimum version number allowed.
     * @return array
     * @throws Ex\InvalidCiphertextException
     */
    public static function getVersionConfigFromHeader($header, $min_ver_header)
    {
        if (Core::ourSubstr($header, 0, 2) !== Core::ourSubstr(Core::HEADER_MAGIC, 0, 2)) {
            throw new Ex\InvalidCiphertextException(
                "Ciphertext has a bad magic number."
            );
        }

        $major = \ord($header[2]);
        $minor = \ord($header[3]);

        $min_major = \ord($min_ver_header[2]);
        $min_minor = \ord($min_ver_header[3]);

        if ($major < $min_major || ($major === $min_major && $minor < $min_minor) ) {
            throw new Ex\InvalidCiphertextException(
                "Ciphertext is requesting an insecure fallback."
            );
        }

        $config = self::getVersionConfigFromMajorMinor($major, $minor);

        return $config;
    }

    /**
     *
     * @param int $major The major version number.
     * @param int $minor The minor version number.
     * @return array
     * @throws Ex\InvalidCiphertextException
     */
    protected static function getVersionConfigFromMajorMinor($major, $minor)
    {
        if ($major === 2) {
            switch ($minor) {
                case 0:
                    return new Config([
                        'cipher_method' => 'aes-256-ctr',
                        'block_byte_size' => 16,
                        'key_byte_size' => 32,
                        'salt_byte_size' => 32,
                        'hash_function_name' => 'sha256',
                        'mac_byte_size' => 32,
                        'encryption_info_string' => 'DefusePHP|V2|KeyForEncryption',
                        'authentication_info_string' => 'DefusePHP|V2|KeyForAuthentication'
                    ]);
                default:
                    throw new Ex\InvalidCiphertextException(
                        "Unsupported ciphertext version."
                    );
            }
        } elseif ($major === 1) {
            switch ($minor) {
                case 0:
                    return new Config([
                        'cipher_method' => 'aes-128-cbc',
                        'block_byte_size' => 16,
                        'key_byte_size' => 16,
                        'salt_byte_size' => false,
                        'hash_function_name' => 'sha256',
                        'mac_byte_size' => 32,
                        'encryption_info_string' => 'DefusePHP|KeyForEncryption',
                        'authentication_info_string' => 'DefusePHP|KeyForAuthentication'
                    ]);
                default:
                    throw new Ex\InvalidCiphertextException(
                        "Unsupported ciphertext version."
                    );
            }
        } else {
            throw new Ex\InvalidCiphertextException(
                "Unsupported ciphertext version."
            );
        }
    }

}
