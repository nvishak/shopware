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

namespace CrefoShopwarePlugIn\Components\Versions\v1;

use \CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion;

/**
 * Class PluginVersion_1_0_3
 * @package CrefoShopwarePlugIn\Components\Versions\v1
 */
class PluginVersion_1_0_3 extends AbstractPluginVersion
{

    const VERSION = "1.0.3";

    /**
     * PluginVersion_1_0_3 constructor.
     */
    public function __construct()
    {
    }

    /**
     * @inheritdoc
     */
    public function createFilesArray()
    {
        $files = [];
        return $files;
    }

    /**
     * @inheritdoc
     */
    public function createDirArray()
    {
        $dir = [];
        return $dir;
    }

    /**
     * @inheritdoc
     */
    public function createSQLArray()
    {
        $commands = [];
        return $commands;
    }

}
