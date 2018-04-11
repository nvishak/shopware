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

namespace CrefoShopwarePlugIn\Components\Logger;

use CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Logger;

/**
 * Class CrefoLogger
 * @codeCoverageIgnore
 */
class CrefoLogger extends Logger
{
    const FILE_LOGGER_INI = __DIR__ . DIRECTORY_SEPARATOR . 'logger.ini';
    const INI_LOGGER_CONFIG = 'config';

    /**
     * @var CrefoLogger
     */
    private static $crefoLogger = null;

    /**
     * CrefoLogger constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('Europe/Berlin');
        $configLogger = $this->getLoggerIni();
        $rotatingFieldHandler = new RotatingFileHandler(CrefoCrossCuttingComponent::getShopwareInstance()->DocPath() . $configLogger['pathLogFile'],
            $configLogger['logFiles'], $configLogger['level']);
        $processor = new IntrospectionProcessor($configLogger['level']);
        parent::__construct($configLogger['loggerName'], [$rotatingFieldHandler], [$processor]);
    }

    /**
     * @return CrefoLogger
     */
    public static function getCrefoLogger()
    {
        if (self::$crefoLogger == null) {
            self::$crefoLogger = new self();
        }

        return self::$crefoLogger;
    }

    /**
     * @return array
     */
    private function getLoggerIni()
    {
        $ini_array = parse_ini_file(filter_var(self::FILE_LOGGER_INI, FILTER_SANITIZE_STRING), true);
        if (array_key_exists(self::INI_LOGGER_CONFIG, $ini_array)) {
            $config = $ini_array[self::INI_LOGGER_CONFIG];

            return $config;
        }

        return [];
    }
}
