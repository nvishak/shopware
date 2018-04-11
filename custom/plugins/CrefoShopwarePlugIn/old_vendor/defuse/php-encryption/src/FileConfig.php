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
use \Old\Crypto\Config;

class FileConfig extends Config
{
    private $buffer_byte_size;

    public function __construct($config_array)
    {
        if (!array_key_exists("buffer_byte_size", $config_array)) {
            throw new Ex\CannotPerformOperationException(
                "Trying to instantiate a bad file configuration."
            );
        }

        $this->buffer_byte_size = $config_array["buffer_byte_size"];
        if (!is_int($this->buffer_byte_size) || $this->buffer_byte_size <= 0) {
            throw new Ex\CannotPerformOperationException(
                "Configuration contains an invalid buffer byte size."
            );
        }

        unset($config_array["buffer_byte_size"]);
        parent::__construct($config_array);
    }

    public function bufferByteSize()
    {
        return $this->buffer_byte_size;
    }
}
