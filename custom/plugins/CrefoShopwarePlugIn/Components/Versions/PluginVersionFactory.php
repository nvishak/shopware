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

namespace CrefoShopwarePlugIn\Components\Versions;

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;

/**
 * Class PluginVersionFactory
 * @package CrefoShopwarePlugIn\Components\Versions
 */
class PluginVersionFactory
{
    const VERSION_CLASS_NS = "CrefoShopwarePlugIn\\Components\\Versions\\";

    /**
     * @param string $pathToFile
     * @param string $olderVersion
     * @param string $newerVersion
     * @return null|\CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion
     */
    public static function createFromFile($pathToFile, $olderVersion, $newerVersion)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Create class from file.', [$pathToFile, $olderVersion, $newerVersion]);
        if (!file_exists($pathToFile)) {
            return null;
        }
        include_once($pathToFile);
        $className = self::getClassNameFromPath($pathToFile);
        if (version_compare($className::VERSION, $olderVersion) < 1) {
            return null;
        }
        if (version_compare($className::VERSION, $newerVersion) == 1) {
            return null;
        }
        return new $className();
    }

    /**
     * @param string $pathToFile
     * @return string
     */
    private static function getClassNameFromPath($pathToFile)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Get class name from path.', [$pathToFile]);
        $pathSplit = explode(DIRECTORY_SEPARATOR, $pathToFile);
        $lenPath = count($pathSplit);
        $className = explode(".", $pathSplit[$lenPath - 1])[0];
        $classNameWithNS = self::VERSION_CLASS_NS . $pathSplit[$lenPath - 2] . "\\" . $className;
        return $classNameWithNS;
    }
}
