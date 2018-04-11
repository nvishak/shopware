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

namespace CrefoShopwarePlugIn\Components\Versions\v1;

use CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion;

/**
 * Class PluginVersion_1_1_1
 * @package CrefoShopwarePlugIn\Components\Versions\v1
 */
class PluginVersion_1_1_1 extends AbstractPluginVersion
{
    const VERSION = "1.1.1";

    /**
     * PluginVersion_1_1_1 constructor.
     */
    public function __construct()
    {
    }

    /**
     * @inheritdoc
     */
    public function createSQLArray()
    {
        $commands = [];
        $update = "UPDATE `crefo_plugin_settings` SET `encryptionKey` = ? WHERE `id` = 1";
        $commands[$update] = ['def0000094b0eeabfc223e60c09305ec2b629c3167ec2300d9532fc11325c4fbf603e3af9582444bf9623611c80245de9a81b9681818c128d33810e4610ae53449a9c8f7'];
        return $commands;
    }
}
