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

namespace CrefoShopwarePlugIn\Components\Updater;

use \CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use \CrefoShopwarePlugIn\Components\Versions\PluginVersionFactory;

/**
 * Class PluginUpdater
 * @package CrefoShopwarePlugIn\Components\Updater
 */
class PluginUpdater
{
    private $olderVersion;

    private $newerVersion;

    /**
     * @var CrefoLogger $logger
     */
    private $logger;

    /**
     * @param string $oldVersion - the installed version of the plugin
     * @param string $newVersion - the new version to be installed
     * @param CrefoLogger $crefoLogger
     */
    public function __construct($oldVersion, $newVersion, $crefoLogger)
    {
        $this->logger = $crefoLogger;
        $this->logger->log(CrefoLogger::DEBUG, "PluginUpdater", ["Create"]);
        $this->olderVersion = $oldVersion;
        $this->newerVersion = $newVersion;
    }

    /**
     * @method getVersionFilesTree
     * @return array $newerVersions - returns a tree with the newer versions to have to be called for updating
     */
    protected function getVersionFilesTree()
    {
        $this->logger->log(CrefoLogger::DEBUG, "getVersionFilesTree", ["get tree of the version files"]);
        $pathToVersionsFolders = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Versions' . DIRECTORY_SEPARATOR;
        $newVersionSplit = explode(".", $this->newerVersion);
        $oldVersionSplit = explode(".", $this->olderVersion);
        $phpVersionFiles = [];
        $majorFolderVersions = $this->computeMajorVersionsFolders(intval($newVersionSplit[0]),
            intval($oldVersionSplit[0]));
        foreach ($majorFolderVersions as $folderVersion) {
            if (!file_exists($pathToVersionsFolders . $folderVersion)) {
                continue;
            }
            $phpVersionFilesInFolder = array_diff(scandir($pathToVersionsFolders . $folderVersion), ['..', '.']);
            foreach ($phpVersionFilesInFolder as $file) {
                if (strpos($file, '.php') !== false) {
                    $phpVersionFiles[$file] = $pathToVersionsFolders . $folderVersion . DIRECTORY_SEPARATOR . $file;
                }
            }
        }
        return $phpVersionFiles;
    }

    /**
     * @param integer $newerMajorVersion
     * @param integer $olderMajorVersion
     * @return array
     */
    private function computeMajorVersionsFolders($newerMajorVersion, $olderMajorVersion)
    {
        $folderMajorVersions = [];
        if ($newerMajorVersion == $olderMajorVersion) {
            $folderMajorVersions[] = 'v' . $newerMajorVersion;
        } elseif ($newerMajorVersion > $olderMajorVersion) {
            while ($newerMajorVersion >= $olderMajorVersion) {
                $folderMajorVersions[] = 'v' . $newerMajorVersion;
                $newerMajorVersion--;
            }
        }
        return $folderMajorVersions;
    }

    /**
     *
     * @method performUpdate
     * @return int $result 1 - successful, 0 - error
     */
    public function performUpdate()
    {
        $this->logger->log(CrefoLogger::DEBUG, "performUpdate", ["Start to update."]);
        $result = 1;
        $newerVersionsArray = $this->getVersionFilesTree();
        if (empty($newerVersionsArray)) {
            $this->logger->log(CrefoLogger::ERROR, "performUpdate", ["Didn't find any Version file."]);
            return 0;
        }
        ksort($newerVersionsArray);
        foreach ($newerVersionsArray as $fileVersion => $pathToFile) {
            /**
             * @var \CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion $pluginAtVersion
             */
            $pluginAtVersion = PluginVersionFactory::createFromFile($pathToFile, $this->olderVersion,
                $this->newerVersion);
            if (is_null($pluginAtVersion)) {
                $this->logger->log(CrefoLogger::DEBUG, "performUpdate",
                    ["no need to update from this file:" . $fileVersion]);
                continue;
            }
            $this->logger->log(CrefoLogger::DEBUG, "performUpdate",
                ["update from:" . $fileVersion]);
            $result &= $pluginAtVersion->modifyDB();
            $result &= $pluginAtVersion->removeOldFiles();
        }
        return $result;
    }
}
