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

namespace CrefoShopwarePlugIn\Components\Swag\Middleware;

use CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings;

/**
 * Class ConfigHeaderRequest
 * @package Components\Swag\Middleware
 */
class ConfigHeaderRequest
{
    const DEFAULT_COMMUNICATION_LANGUAGE = "de";
    const DEFAULT_CONFIG_ID = 1;
    /**
     * @var string
     */
    private $pluginVersion = '1.0.0';

    /**
     * @var string
     */
    private $communicationLanguage = 'de';

    /**
     * @var string
     */
    private $shopVersion = '1.0.0';

    /**
     * ConfigHeaderRequest constructor.
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->buildConfig();
    }

    /**
     * @return string
     */
    public function getPluginVersion()
    {
        return $this->pluginVersion;
    }

    /**
     * @return string
     */
    public function getCommunicationLanguage()
    {
        return $this->communicationLanguage;
    }

    /**
     * @return string
     */
    public function getShopVersion()
    {
        return $this->shopVersion;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getEncryptionKey()
    {
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $shopwareModels->find(PluginSettings::class, $configId);
        return null === $settings->getEncryptionKey() ? '' : $settings->getEncryptionKey();
    }

    /**
     * extracts lazy the needed information from the server
     * @codeCoverageIgnore
     */
    private function buildConfig()
    {
        $this->pluginVersion = $this->computePluginVersion();
        $this->communicationLanguage = $this->computeCommunicationLanguage();
        $this->shopVersion = $this->computeShopwareVersion();
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    private function computePluginVersion()
    {
        /**
         * @var \CrefoShopwarePlugIn\CrefoShopwarePlugIn $creditreform
         */
        $creditreform = CrefoCrossCuttingComponent::getCreditreformPlugin();
        if (null === $creditreform) {
            return $this->pluginVersion;
        }
        $pluginXml = $creditreform->getPath() . '/plugin.xml';
        $xmlReader = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('shopware.plugin_xml_plugin_info_reader')->read($pluginXml);
        return $xmlReader['version'];
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    private function computeCommunicationLanguage()
    {
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        $shopwareModels = CrefoCrossCuttingComponent::getShopwareInstance()->Models();
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $shopwareModels->find(PluginSettings::class, $configId);
        return null === $settings->getCommunicationLanguage() ? self::DEFAULT_COMMUNICATION_LANGUAGE : $settings->getCommunicationLanguage();
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    private function computeShopwareVersion()
    {
        if (!class_exists(\Shopware::class)) {
            return $this->shopVersion;
        }
        return \Shopware::VERSION;
    }
}
