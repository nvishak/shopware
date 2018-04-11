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

/**
 * Interface PluginVersion
 * @package CrefoShopwarePlugIn\Components\Versions
 */
interface PluginVersion
{

    /**
     * method used to modify DB (alter/create/insert/update/delete)
     * @method modifyDB
     */
    public function modifyDB();

    /**
     * method used to remove unlinked/not used files on the server side
     * @method removeFiles
     */
    public function removeOldFiles();

    /**
     * method used to create the path to the files that will be deleted
     * @method createFilesArray
     * return array
     */
    public function createFilesArray();

    /**
     * method used to create the path to the directories that will be deleted
     * @method createDirArray
     * @return array
     */
    public function createDirArray();

    /**
     * method used to create the sql commands
     *
     * one entry will be used as in one of the examples:
     *
     * ----INSERT----
     * $sql = 'INSERT INTO `table_name` (`id` ,`test` ,`date`)
     * VALUES (?, ?, ?);';
     * Shopware()->Db()->query($sql, array( 1, "Test", NOW()));
     *
     * OR
     *
     *----DELETE----
     * CrefoShopwareFactory::getShopwareInstance()->Db()->query('DELETE FROM table_name WHERE id=?', array(1));
     *
     * OR
     *
     *----UPDATE----
     * $update = "UPDATE `table_name` SET `date` = now(),`id` = ? WHERE `type` = ? AND userID = ? AND orderID = ? LIMIT 1";
     * Shopware()->Db()->query($update, array(1,"type",3,222222));
     *
     * OR
     *
     *----ALTER----
     * $sql = 'ALTER TABLE ' . $table . ' ADD ' . $name . ' ' . $type . ' ' . $null . ' DEFAULT ' . $defaultValue;
     * Shopware()->Db()->query($sql, array($table, $prefix, $column, $type, $null, $defaultValue));
     *
     * @method createSQLArray
     * @return array ( $keys - query strings & $values - array with parameters for the query strings
     */
    public function createSQLArray();

}
