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

interface StreamInterface
{
    /**
     * Encrypt the contents at $inputFilename, storing the result in $outputFilename
     * using HKDF of $key to perform authenticated encryption
     * 
     * @param string $inputFilename
     * @param string $outputFilename
     * @param Key $key
     * @return boolean
     */
    public static function encryptFile($inputFilename, $outputFilename, Key $key);

    /**
     * Decrypt the contents at $inputFilename, storing the result in $outputFilename
     * using HKDF of $key to decrypt then verify
     * 
     * @param string $inputFilename
     * @param string $outputFilename
     * @param Key $key
     * @return boolean
     */
    public static function decryptFile($inputFilename, $outputFilename, Key $key);

    /**
     * Encrypt the contents of a file handle $inputHandle and store the results
     * in $outputHandle using HKDF of $key to perform authenticated encryption
     * 
     * @param resource $inputHandle
     * @param resource $outputHandle
     * @param Key $key
     * @return boolean
     */
    public static function encryptResource($inputHandle, $outputHandle, Key $key);

    /**
     * Decrypt the contents of a file handle $inputHandle and store the results
     * in $outputHandle using HKDF of $key to decrypt then verify
     * 
     * @param resource $inputHandle
     * @param resource $outputHandle
     * @param Key $key
     * @return boolean
     */
    public static function decryptResource($inputHandle, $outputHandle, Key $key);
}
