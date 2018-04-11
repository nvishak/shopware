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

use \Old\Crypto\Crypto;

require_once 'autoload.php';

function showResults($type, $start, $end, $count)
{
    $time = $end - $start;
    $rate = $count / $time;
    echo $type, ': ', $rate, ' calls/s', "\n";
}

// Note: By default, the runtime tests are "cached" and not re-executed for
// every call. To disable this, look at the RuntimeTest() function.

$start = \microtime(true);
for ($i = 0; $i < 1000; $i++) {
    $key = Crypto::createNewRandomKey();
}
$end = \microtime(true);
showResults("createNewRandomKey()", $start, $end, 1000);

$start = \microtime(true);
for ($i = 0; $i < 100; $i++) {
    $ciphertext = Crypto::encrypt(
        \str_repeat("A", 1024*1024),
        \str_repeat("B", 16)
    );
}
$end = microtime(true);
showResults("encrypt(1MB)", $start, $end, 100);

$start = microtime(true);
for ($i = 0; $i < 1000; $i++) {
    $ciphertext = Crypto::encrypt(
        \str_repeat("A", 1024),
        \str_repeat("B", 16)
    );
}
$end = \microtime(true);
showResults("encrypt(1KB)", $start, $end, 1000);
