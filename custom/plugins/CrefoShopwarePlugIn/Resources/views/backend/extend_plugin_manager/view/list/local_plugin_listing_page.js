/*
 * Copyright (c) 2016 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */
//{namespace name=backend/plugin_manager/translation}
//{block name="backend/plugin_manager/view/list/local_plugin_listing_page" append}
Ext.define('Shopware.apps.ExtendPluginManager.view.list.LocalPluginListingPage', {
    override: 'Shopware.apps.PluginManager.view.list.LocalPluginListingPage',
    snippetsExt: {
        crefoPluginName: '{s name="pluginmanager/crefo/label" namespace="backend/creditreform/translation"}Creditreform{/s}',
        title: '{s name="pluginmanager/crefo/window/delete/title" namespace="backend/creditreform/translation"}Creditreform Plugin Löschung{/s}',
        message: '{s name="pluginmanager/crefo/window/delete/text" namespace="backend/creditreform/translation"}ACHTUNG! Sie sind dabei, alle Daten endgültig zu löschen!<br />Dies beinhaltet gespeicherte Ergebnisse von Bonitätsprüfungen und gespeicherte Inkasso-Informationen!<br />Es empfiehlt sich, vor der Deinstallation unter einen Datenexport durchzuführen und die Daten als lokale Sichtkopie zu speichern.{/s}',
        answerYes: 'yes',
        uninstall: '{s name="install_uninstall"}Install / Uninstall{/s}',
        reinstall: '{s name="reinstall"}Reinstall{/s}'
    },

    createActionColumnItems: function () {
        var me = this,
            items = me.callParent(arguments),
            newItems = [];

        Ext.each(items, function (item) {
            if (item.tooltip === me.snippetsExt.reinstall) {
                item.getClass = function (value, metaData, record) {
                    if (Ext.isDefined(record) && (!record.allowReinstall() || record.get('label') === me.snippetsExt.crefoPluginName)) {
                        return Ext.baseCSSPrefix + 'hidden';
                    }
                };
            }
            if (item.tooltip === me.snippetsExt.uninstall) {
                item.handler = function (grid, rowIndex, colIndex, item, eOpts, record) {
                    var pluginName = record.get('label');
                    if (record.allowInstall()) {
                        me.registerConfigRequiredEvent(record);
                        me.installPluginEvent(record);
                    } else if (pluginName === me.snippetsExt.crefoPluginName) {
                        record.data.capabilitySecureUninstall = false;
                        Ext.MessageBox.confirm(me.snippetsExt.title, me.snippetsExt.message, function (apply) {
                            if (apply !== me.snippetsExt.answerYes) {
                                return;
                            }
                            me.uninstallPluginEvent(record);
                        });
                    } else {
                        me.uninstallPluginEvent(record);
                    }
                };
            }
            newItems.push(item);
        });
        return newItems;
    }
});
//{/block}