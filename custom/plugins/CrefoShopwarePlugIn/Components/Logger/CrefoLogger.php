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

namespace CrefoShopwarePlugIn\Components\Logger;

use \Monolog\Processor\IntrospectionProcessor;
use \Monolog\Handler\RotatingFileHandler;
use \Shopware\Components\Logger as ShopwareLogger;
use \CrefoShopwarePlugIn\Components\Swag\Middleware\CrefoCrossCuttingComponent;

/**
 * Class CrefoLogger
 * @package Components\Logger
 */
class CrefoLogger extends ShopwareLogger
{

    const PATH_LOGFILE = "var/log/crefo.log";
    const CREFO_LOGGER_NAME = "crefologger";
    const MAXFILENR = 31; //0 = unlimited

    /**
     * Detailed debug information
     */
    const DEBUG = 100;

    /**
     * Interesting events
     *
     * Examples: User logs in, SQL logs.
     */
    const INFO = 200;

    /**
     * Uncommon events
     */
    const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    const WARNING = 300;

    /**
     * Runtime errors
     */
    const ERROR = 400;

    /**
     * Critical conditions
     *
     * Example: Application component unavailable, unexpected exception.
     */
    const CRITICAL = 500;

    /**
     * Action must be taken immediately
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    const ALERT = 550;

    /**
     * Urgent alert.
     */
    const EMERGENCY = 600;

    /**
     * CrefoLogger constructor.
     */
    public function __construct()
    {
        $rotatingFieldHandler = new RotatingFileHandler(CrefoCrossCuttingComponent::getShopwareInstance()->DocPath() . self::PATH_LOGFILE,
            self::MAXFILENR);
        $proc = new IntrospectionProcessor();
        parent::__construct(self::CREFO_LOGGER_NAME, [$rotatingFieldHandler], [$proc]);
    }

}
