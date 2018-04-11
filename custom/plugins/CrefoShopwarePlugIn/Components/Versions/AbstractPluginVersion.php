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

namespace CrefoShopwarePlugIn\Components\Versions;

use \CrefoShopwarePlugIn\Components\Core\FileManager;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;

/**
 * Class AbstractPluginVersion
 * @package CrefoShopwarePlugIn\Components\Versions
 */
abstract class AbstractPluginVersion implements PluginVersion
{

    /**
     * @inheritdoc
     */
    public function modifyDB()
    {
        /**
         * @var array $sqls
         */
        $sqls = $this->createSQLArray();
        $result = 1;
        if (!empty($sqls)) {
            foreach ($sqls as $sqlQuery => $valuesArray) {
                CrefoCrossCuttingComponent::runQuery($sqlQuery, $valuesArray);
            }
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function removeOldFiles()
    {
        $files = $this->createFilesArray();
        $result = 1;
        if (!empty($files)) {
            $result &= $this->removeFiles($files);
        }
        $dirs = $this->createDirArray();
        if (!empty($dirs)) {
            foreach ($dirs as $dir) {
                $result &= $this->deleteRecursiveFilesAndDir($dir);
            }
        }
        return $result;
    }

    /**
     * @method getSQLScripts
     * @param array $sqlArray
     * @return array the SQL scripts written in current version appended to the previous list
     */
    protected function getSQLScripts(array $sqlArray)
    {
        return array_merge($sqlArray, $this->createSQLArray());
    }

    /**
     * removes the files given in the array
     * @method removeFiles
     * @param array $filesArray
     * @return int $result 1 - successful, 0 - couldn't remove all files
     */
    protected function removeFiles(array $filesArray)
    {
        if (is_array($filesArray) && !empty($filesArray)) {
            /**
             * @var FileManager $crefoFileController
             */
            $crefoFileController = new FileManager();
            $result = $crefoFileController->_deleteFiles($filesArray);
            return $result;
        }
        return 1;
    }

    /**
     * deletes all the files in a directory and the directory itself
     * !!TO BE USED VERY CAREFUL ONLY ON OWN CREATED DIRECTORIES/FOLDERS!!
     * !!it can delete folders that are not intended to be deleted!!
     * @method deleteRecursiveFilesAndDir
     * @param string $dir
     * @return int $result 1 - successful, 0 - couldn't delete all files
     */
    protected function deleteRecursiveFilesAndDir($dir)
    {
        /**
         * @var FileManager $crefoFileController
         */
        $crefoFileController = new FileManager();
        $result = $crefoFileController->_deleteDir($dir);
        return $result;
    }
}
