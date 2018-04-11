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

final class KeyConfig
{
    private $key_byte_size;
    private $checksum_hash_function;
    private $checksum_byte_size;

    public function __construct($config_array)
    {
        $expected_keys = array(
            "key_byte_size",
            "checksum_hash_function",
            "checksum_byte_size"
        );
        if (sort($expected_keys) !== true) {
            throw Ex\CannotPerformOperationException(
                "sort() failed."
            );
        }

        $actual_keys = array_keys($config_array);
        if (sort($actual_keys) !== true) {
            throw Ex\CannotPerformOperationException(
                "sort() failed."
            );
        }

        if ($expected_keys !== $actual_keys) {
            throw new Ex\CannotPerformOperationException(
                "Trying to instantiate a bad key configuration."
            );
        }

        $this->key_byte_size = $config_array["key_byte_size"];
        $this->checksum_hash_function = $config_array["checksum_hash_function"];
        $this->checksum_byte_size = $config_array["checksum_byte_size"];

        if (!\is_int($this->key_byte_size) || $this->key_byte_size <= 0) {
            throw new Ex\CannotPerformOperationException(
                "Invalid key byte size."
            );
        }

        if (\in_array($this->checksum_hash_function, \hash_algos()) === false) {
            throw new Ex\CannotPerformOperationException(
                "Invalid hash function name."
            );
        }

        if (!\is_int($this->checksum_byte_size) || $this->checksum_byte_size <= 0) {
            throw new Ex\CannotPerformOperationException(
                "Invalid checksum byte size."
            );
        }
    }

    public function keyByteSize()
    {
        return $this->key_byte_size;
    }

    public function checksumHashFunction()
    {
        return $this->checksum_hash_function;
    }

    public function checksumByteSize()
    {
        return $this->checksum_byte_size;
    }
}