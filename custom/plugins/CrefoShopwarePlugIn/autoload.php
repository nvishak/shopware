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

if (isset($_SERVER['argv'][0]) && strpos($_SERVER['argv'][0], 'phpunit') !== false) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . "tests" . DIRECTORY_SEPARATOR . "autoload.php";
}
/**
 * PSR-4 compatible autoloader
 */
\spl_autoload_register(function ($class) {
    // Project-specific namespace prefix
    $prefix = 'CrefoShopwarePlugIn\\';

    // Base directory for the namespace prefix
    $base_dir = __DIR__ . DIRECTORY_SEPARATOR;

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);


    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

$pathLoader = __DIR__ . '/vendor/autoload.php';
if (file_exists($pathLoader)) {
    $loader = require $pathLoader;
    return $loader;
}