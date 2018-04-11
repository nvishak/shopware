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
//{block name="backend/plugin_manager/view/detail/action" append}
Ext.define('Shopware.apps.ExtendPluginManager.view.detail.Actions', {
    override: 'Shopware.apps.PluginManager.view.detail.Actions',
    snippetsExt: {
        crefoPluginName: '{s name="pluginmanager/crefo/label" namespace="backend/creditreform/translation"}Creditreform{/s}',
        reinstall: '{s name="reinstall"}Reinstall{/s}'
    },
    initComponent: function () {
        var me = this, newItems = [];
        me.callParent(arguments);
        if (me.plugin.get('label') === me.snippetsExt.crefoPluginName) {
            Ext.each(me.items.items, function (item) {
                if (item.html !== me.snippetsExt.reinstall) {
                    newItems.push(item);
                }
            });
            me.items.items = newItems;
        }
    }
});
//{/block}