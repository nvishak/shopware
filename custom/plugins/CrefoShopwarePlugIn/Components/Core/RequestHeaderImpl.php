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

namespace CrefoShopwarePlugIn\Components\Core;

use CrefoShopwarePlugIn\Components\Logger\CrefoLogger;
use CrefoShopwarePlugIn\Components\Swag\Middleware\ConfigHeaderRequest;

/**
 * Class RequestHeaderImpl
 */
class RequestHeaderImpl implements CrefoSanitization
{
    use RequestHeaderTrait;
    const ERROR_VERSION = '000000';
    const MAX_VERSION_GROUPS = 3;
    const MAX_VERSION_LENGTH = 2;
    const VERSION_FILL_POSITION = '0';

    const CLIENT_APPLICATION_NAME = 'CrefoShopwarePlugIn';
    const KEY_LIST_VERSION = '21';

    /**
     * Constructor
     *
     * @codeCoverageIgnore
     * @param ConfigHeaderRequest $config
     * @param null|array          $account
     */
    public function __construct(ConfigHeaderRequest $config, array $account = null)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Create Header Config for requests.', [$config]);
        $this->setClientApplicationName(self::CLIENT_APPLICATION_NAME);
        $this->setClientApplicationVersion($this->getPluginVersionWithZeros($config->getPluginVersion()));
        $this->setCommunicationLanguage($config->getCommunicationLanguage());
        $this->setKeylistVersion(self::KEY_LIST_VERSION);
        $this->setTransactionReference($config->getShopVersion());
        $date = new \DateTime();
        $this->setTransmissionTimestamp($date->format('Y-m-d\TH:i:s')); //e.g. "2016-03-07T13:07:15"
        if (null !== $account) {
            $this->setUserAccount($account['userAccount']);
            $this->setGeneralPassword($account['generalPassword']);
            $this->setIndividualPassword($account['individualPassword']);
        }
    }

    /**
     * performs sanitization of the input
     * @codeCoverageIgnore
     */
    public function performSanitization()
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Perform sanitization.', []);
        $sanitizeObj = new CrefoSanitizer();
        $sourceArray = [
            'comm_lang' => $this->getCommunicationLanguage(),
            'user_acount' => $this->getUserAccount(),
            'general_pass' => $this->getGeneralPassword(),
            'individual_pass' => $this->getIndividualPassword(),
        ];
        $sanitizeObj->addSource($sourceArray);
        $sanitizeObj->addRule('comm_lang', 'string', self::MAX_VERSION_LENGTH, true);
        $sanitizeObj->addRule('user_acount', 'string_numeric', 12, true);
        $sanitizeObj->addRule('general_pass', 'string', 1024, false);
        $sanitizeObj->addRule('individual_pass', 'string', 1024, false);
        $sanitizeObj->run();
        $this->setCommunicationLanguage($sanitizeObj->sanitized['comm_lang']);
        $this->setUserAccount($sanitizeObj->sanitized['user_acount']);
        $this->setGeneralPassword($sanitizeObj->sanitized['general_pass']);
        $this->setIndividualPassword($sanitizeObj->sanitized['individual_pass']);
    }

    /**
     * @param string $pluginVersion
     *
     * @return string
     */
    private function getPluginVersionWithZeros($pluginVersion)
    {
        CrefoLogger::getCrefoLogger()->log(CrefoLogger::DEBUG, 'Get versions filled with zeros.', []);
        if(null === $pluginVersion){
            return self::ERROR_VERSION;
        }
        $versionArray = explode('.', $pluginVersion);
        $result = '';
        for ($i = 0; $i < self::MAX_VERSION_GROUPS; ++$i) {
            if (count($versionArray) >= $i + 1) {
                $value = $versionArray[$i];
            } else {
                $value = self::VERSION_FILL_POSITION . self::VERSION_FILL_POSITION;
            }
            if (strlen($value) < self::MAX_VERSION_LENGTH) {
                $subPartVersion = self::VERSION_FILL_POSITION . $value;
            } else {
                $subPartVersion = substr($value, 0, self::MAX_VERSION_LENGTH);
            }
            $result .= $subPartVersion;
        }
        return $result;
    }
}
