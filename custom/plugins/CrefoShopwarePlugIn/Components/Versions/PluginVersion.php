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

/**
 * Interface PluginVersion
 * @package CrefoShopwarePlugIn\Components\Versions
 */
interface PluginVersion
{

    /**
     * method used to save the data that will be lost by modifying the schema of the database
     *
     * @return array
     */
    public function saveMigrationData();

    /**
     * method used to migrate specific date to a version of the plugin
     *
     * @param array $oldData
     * @return int
     */
    public function migrate(array $oldData);

    /**
     *  method used to modify DB (alter/create/insert/update/delete)
     *
     * @return int
     */
    public function modifyDB();

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
