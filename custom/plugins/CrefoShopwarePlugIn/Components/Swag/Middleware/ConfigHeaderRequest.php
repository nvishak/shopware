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

namespace CrefoShopwarePlugIn\Components\Swag\Middleware;

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
     * @return string
     */
    public function getEncryptionKey()
    {
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\SettingsRepository $repositorySettings
         */
        $repositorySettings = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings');
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $repositorySettings->find($configId);
        return is_null($settings->getEncryptionKey()) ? '' : $settings->getEncryptionKey();
    }

    /**
     * extracts lazy the needed information from the server
     */
    private function buildConfig()
    {
        $this->pluginVersion = $this->computePluginVersion();
        $this->communicationLanguage = $this->computeCommunicationLanguage();
        $this->shopVersion = $this->computeShopwareVersion();
    }

    /**
     * @return string
     */
    private function computePluginVersion()
    {
        /**
         * @var \CrefoShopwarePlugIn\CrefoShopwarePlugIn $creditreform
         */
        $creditreform = CrefoCrossCuttingComponent::getCreditreformPlugin();
        if (is_null($creditreform)) {
            return $this->pluginVersion;
        }
        $pluginXml = $creditreform->getPath() . '/plugin.xml';
        $xmlReader = CrefoCrossCuttingComponent::getShopwareInstance()->Container()->get('shopware.plugin_xml_plugin_info_reader')->read($pluginXml);
        return $xmlReader['version'];
    }

    /**
     * @return string
     */
    private function computeCommunicationLanguage()
    {
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\SettingsRepository $repositorySettings
         */
        $repositorySettings = CrefoCrossCuttingComponent::getShopwareInstance()->Models()->getRepository('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings');
        $configId = CrefoCrossCuttingComponent::getCreditreformPlugin()->getConfigurationId(\CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings::class);
        /**
         * @var \CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings $settings
         */
        $settings = $repositorySettings->find($configId);
        return is_null($settings->getCommunicationLanguage()) ? self::DEFAULT_COMMUNICATION_LANGUAGE : $settings->getCommunicationLanguage();
    }

    /**
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
