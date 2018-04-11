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
 * Class PluginVersion_1_1_0
 * @package CrefoShopwarePlugIn\Components\Versions\v1
 */
class PluginVersion_1_1_0 extends AbstractPluginVersion
{
    const VERSION = "1.1.0";

    /**
     * PluginVersion_1_1_0 constructor.
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
        $update = "UPDATE `crefo_plugin_settings` SET `consentDeclaration` = ? WHERE `id` = 1";
        $commands[$update] = [1];
        $insert = "INSERT INTO `crefo_report_private_person_config` (`id`)  VALUES (?)";
        $commands[$insert] = [1];
        return $commands;
    }
}
