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
 * Class AbstractPluginVersion
 * @package CrefoShopwarePlugIn\Components\Versions
 * @codeCoverageIgnore
 */
abstract class AbstractPluginVersion implements PluginVersion
{
    const MULTIPLE_QUERY = 'same-command';

    /**
     * @var QueryAdapter
     */
    private $adapter;

    /**
     * @inheritdoc
     */
    public final function modifyDB()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Modify DB.', []);
        /**
         * @var array $sqlCommands
         */
        $sqlCommands = $this->createSQLArray();
        foreach ($sqlCommands as $sqlQuery => $valuesArray) {
            if($sqlQuery === self::MULTIPLE_QUERY){
                foreach ($valuesArray as $value){
                    $cmdArray = array_keys($value);
                    $args = array_shift($value);
                    $this->adapter->execQuery($cmdArray[0], $args);
                }
            }else {
                $this->adapter->execQuery($sqlQuery, $valuesArray);
            }
        }
        return 1;
    }

    /**
     * @inheritdoc
     */
    public function saveMigrationData()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Save data from DB to reuse when migrating.', []);
        return [];
    }

    /**
     * @inheritdoc
     */
    public function migrate(array $oldData)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Do migration.', []);
        return 1;
    }

    /**
     * @inheritdoc
     */
    public function createSQLArray()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Perform SQL commands.', []);
        return [];
    }

    /**
     * @param QueryAdapter $adapter
     */
    public final function setQueryAdapter(QueryAdapter $adapter){
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Set query adapter.', [$adapter]);
        $this->adapter = $adapter;
    }

    /**
     * @return QueryAdapter
     */
    public final function getQueryAdapter(){
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Get query adapter', []);
        return $this->adapter;
    }
}
