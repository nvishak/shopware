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

namespace CrefoShopwarePlugIn\Components\Core;

/**
 * Class FileManager
 * @package CrefoShopwarePlugIn\Components\Core
 */
class FileManager implements Manager
{

    private $ignoredFiles = [];

    /**
     * @method setFilesToBeIgnored
     * @param array $files
     */
    public function setFilesToBeIgnored(array $files)
    {
        $this->ignoredFiles = $files;
    }

    /**
     * @method copyFolder
     * @param string $dir
     * @param string $dest
     * @param boolean $copyOnlyFolderContent
     * @return int success 1 failure 0
     */
    public function copyFolder($dir, $dest, $copyOnlyFolderContent = true)
    {
        $success = 1;
        if (!$copyOnlyFolderContent) {
            $dirName = basename($dir);
            !is_dir("$dest$dirName") ? ($success &= mkdir("$dest$dirName", 0777, false)) : null;
        }
        $dirContent = scandir($dir);
        if (is_array($dirContent)) {
            $files = array_diff($dirContent, ['.', '..']);
            $copyFiles = [];
            foreach ($files as $file) {
                if (is_dir("$dir$file")) {
                    if (is_null($this->ignoredFiles) || empty($this->ignoredFiles['folders']) || !in_array("$dir$file",
                            $this->ignoredFiles['folders'])
                    ) {
                        !is_dir("$dest$file") ? ($success &= mkdir("$dest/$file", 0777, false)) : null;
                        $success &= $this->copyFolder("$dir$file" . DIRECTORY_SEPARATOR,
                            "$dest$file" . DIRECTORY_SEPARATOR);
                    }
                } else {
                    if (is_null($this->ignoredFiles) || empty($this->ignoredFiles['files']) || !in_array("$dir$file",
                            $this->ignoredFiles['files'])
                    ) {
                        $copyFiles[] = ["old" => "$dir$file", "new" => "$dest$file"];
                    }
                }
            }
            if (!empty($copyFiles)) {
                $success &= $this->_copyFiles($copyFiles);
                //$success &= $this->_chmod($copyFiles);
            }
        }
        return $success;
    }

    /**
     * @method _deleteDir
     * @param string $p_dir
     * @return int $success 1 failure 0
     */
    public function _deleteDir($p_dir)
    {
        $dirContent = scandir($p_dir);
        $success = 1;
        if (is_array($dirContent)) {
            $files = array_diff($dirContent, ['.', '..']);

            foreach ($files as $file) {
                if (is_dir("$p_dir/$file")) {
                    $this->_deleteDir("$p_dir/$file");
                } else {
                    $success &= unlink("$p_dir/$file");
                }
            }
            $success &= rmdir($p_dir);
        }
        return $success;
    }

    /**
     * @method _deleteFiles
     * @param array $files
     * @return int success 1 failure 0
     */
    public function _deleteFiles(array $files)
    {
        $success = 1;
        foreach ($files as $file) {
            is_file($file) ? ($success &= unlink($file)) : null;
        }
        return $success;
    }

    /**
     * @method _moveFiles
     * @param array $files
     * @param string $rootServer
     * @return int success 1 failure 0
     */
    public function _moveFiles(array $files, $rootServer)
    {
        $success = 1;

        foreach ($files as $move) {
            $old = $rootServer . $move['old'];
            $new = $rootServer . $move['new'];

            if (file_exists($old) && !file_exists($new)) {
                $success &= rename($old, $new);
            } else {
                $success = 0;
            }
        }

        return $success;
    }

    /**
     * @method _copyFiles
     * @param array $files
     * @param boolean $overwrite
     * @return int success 1 failure 0
     */
    public function _copyFiles(array $files, $overwrite = true)
    {
        $success = 1;
        foreach ($files as $copy) {
            $old = $copy['old'];
            $new = $copy['new'];
            if (file_exists($old) && ($overwrite || !file_exists($new))) {
                $success &= copy($old, $new);
            } else {
                $success = 0;
            }
        }

        return $success;
    }

    /**
     * @method _chmod
     * @param array $files
     * @param int $mod
     * @return int success 1 failure 0
     */
    public function _chmod(array $files, $mod = 0777)
    {
        $success = 1;

        foreach ($files as $file) {
            $success &= chmod($file['new'], $mod);
        }

        return $success;
    }
}
