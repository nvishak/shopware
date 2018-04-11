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

namespace CrefoShopwarePlugIn\Components\Updater;

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Versions\PluginVersionFactory;
use CrefoShopwarePlugIn\Components\Versions\QueryAdapter;

/**
 * Class PluginUpdater.
 */
class PluginUpdater
{
    /**
     * @var string
     */
    private $olderVersion;

    /**
     * @var string
     */
    private $newerVersion;

    /**
     * @var array
     */
    private $oldData = [];

    /**
     * @var array
     */
    private $versionsClasses = [];

    /**
     * @param string $oldVersion - the installed version of the plugin
     * @param string $newVersion - the new version to be installed
     * @param CrefoLogger $crefoLogger
     */
    public function __construct($oldVersion, $newVersion, $crefoLogger)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'PluginUpdater', ['Create']);
        $this->olderVersion = $oldVersion;
        $this->newerVersion = $newVersion;
    }

    /**
     * @method getVersionFilesTree
     * @return array $newerVersions - returns a tree with the newer versions to have to be called for updating
     */
    protected function getVersionFilesTree()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'getVersionFilesTree', ['get tree of the version files']);
        $pathToVersionsFolders = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'Versions' . DIRECTORY_SEPARATOR;
        $newVersionSplit = explode('.', $this->newerVersion);
        $oldVersionSplit = explode('.', $this->olderVersion);
        $phpVersionFiles = [];
        $majorFolderVersions = $this->computeMajorVersionsFolders(intval($newVersionSplit[0]),
            intval($oldVersionSplit[0]));
        foreach ($majorFolderVersions as $folderVersion) {
            // @codeCoverageIgnoreStart
            if (!file_exists($pathToVersionsFolders . $folderVersion)) {
                continue;
            }
            // @codeCoverageIgnoreEnd
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
     * @param int $newerMajorVersion
     * @param int $olderMajorVersion
     *
     * @return array
     */
    private function computeMajorVersionsFolders($newerMajorVersion, $olderMajorVersion)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Compute major version from folders.', ['computeMajorVersionsFolders']);
        $folderMajorVersions = [];
        if ($newerMajorVersion == $olderMajorVersion) {
            $folderMajorVersions[] = 'v' . $newerMajorVersion;
        } elseif ($newerMajorVersion > $olderMajorVersion) {
            while ($newerMajorVersion >= $olderMajorVersion) {
                $folderMajorVersions[] = 'v' . $newerMajorVersion;
                --$newerMajorVersion;
            }
        }

        return $folderMajorVersions;
    }

    /**
     * prepares the data for update
     * @codeCoverageIgnore
     * @param QueryAdapter $adapter
     */
    public function prepareUpdate(QueryAdapter $adapter)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'prepareUpdate', ['Start preparing the update.']);
        $newerVersionsArray = $this->getVersionFilesTree();
        if (empty($newerVersionsArray)) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::ERROR, 'prepareUpdate', ["Didn't find any Version file."]);
            return;
        }
        if(null === $adapter || empty($adapter)){
            new \Exception("Query Adapter not found");
        }
        ksort($newerVersionsArray);
        foreach ($newerVersionsArray as $fileVersion => $pathToFile) {
            /**
             * @var \CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion
             */
            $pluginAtVersion = PluginVersionFactory::createFromFile($pathToFile, $this->olderVersion,
                $this->newerVersion);
            if (null === $pluginAtVersion) {
                CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'prepareUpdate',
                    ['no need to update from this file:' . $fileVersion]);
                continue;
            }
            $pluginAtVersion->setQueryAdapter($adapter);
            $this->versionsClasses[$fileVersion] = $pluginAtVersion;
        }
        $this->saveOldData();
    }


    /**
     * @codeCoverageIgnore
     */
    private function saveOldData()
    {
        /**
         * @var \CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion $versionObject
         */
        foreach ($this->versionsClasses as $versionFileName => $versionObject) {
            $this->oldData[$versionFileName] = $versionObject->saveMigrationData();
        }
    }

    /**
     * @return int $result 1 - successful, 0 - error
     */
    public function performUpdate()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'performUpdate', ['Start to update.']);
        $result = 1;
        /**
         * @var \CrefoShopwarePlugIn\Components\Versions\AbstractPluginVersion $versionObject
         */
        foreach ($this->versionsClasses as $versionFileName => $versionObject) {
            CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'performUpdate',
                ['update from:' . $versionFileName]);
            $result &= $versionObject->modifyDB();
            if(isset($this->oldData[$versionFileName])) {
                $result &= $versionObject->migrate($this->oldData[$versionFileName]);
            }
        }
        return $result;
    }

}
