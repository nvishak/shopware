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

use \ZipArchive;

/**
 * Class ZipManager
 * @package CrefoShopwarePlugIn\Components\Core
 */
class ZipManager implements Manager
{

    /**
     * ZipManager constructor.
     */
    public function __construct()
    {
        mb_internal_encoding("UTF-8");
    }

    /**
     * http://davidwalsh.name/create-zip-php
     * Copyright (c) <2015> <David Walsh>
     * MIT License
     * @method create_zip
     * @date   2015-07-24
     * @param  array $files
     * @param  string $destination
     * @param  boolean $overwrite
     * @return boolean
     */
    public function create_zip($files = [], $destination = '', $overwrite = false)
    {
        //if the zip file already exists and overwrite is false, return false
        if (file_exists($destination) && !$overwrite) {
            return false;
        }
        //proof that the directory exists!
        $fileName = basename($destination);
        $dirDestination = substr($destination, 0, strlen($destination) - strlen($fileName) - 1);
        if (!is_dir($dirDestination)) {
            return false;
        }
        //valid/existing files
        $valid_files = [];
        //if files were passed in...
        if (is_array($files)) {
            //cycle through each file
            foreach ($files as $file) {
                //make sure the file exists
                if (file_exists($file)) {
                    $valid_files[] = $file;
                }
            }
        }
        if (count($valid_files)) {
            //create the archive
            $zip = new ZipArchive();
            $overwriteType = file_exists($destination) && $overwrite ? ZipArchive::OVERWRITE : ZipArchive::CREATE;
            if ($zip->open($destination, $overwriteType) !== true
            ) {
                return false;
            }
            //add the files
            foreach ($valid_files as $file) {
                $afile = explode(DIRECTORY_SEPARATOR, $file);
                $zip->addFile($file, $afile[count($afile) - 1]);
            }
            //debug
            //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
            //close the zip -- done!
            $zip->close();

            //check to make sure the file exists
            return file_exists($destination);
        } else {
            return false;
        }
    }
}
