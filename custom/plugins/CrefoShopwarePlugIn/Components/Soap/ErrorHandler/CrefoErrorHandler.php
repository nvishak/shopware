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

namespace CrefoShopwarePlugIn\Components\Soap\ErrorHandler;

/**
 * @codeCoverageIgnore
 * Class CrefoErrorHandler
 * @package CrefoShopwarePlugIn\Components\Soap\ErrorHandler
 */
class CrefoErrorHandler
{
    /**
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @param array $errcontext
     * @return bool
     */
    public static function handle_error($errno, $errstr, $errfile, $errline, array $errcontext)
    {
        // error was suppressed with the @-operator
//        if (!(error_reporting(0) & $errno)) {
//            return false;
//        }
        return true;
    }
}