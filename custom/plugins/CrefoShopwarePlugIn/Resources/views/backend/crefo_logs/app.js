/*
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */
//{block name="backend/crefo_logs/app" }
Ext.define('Shopware.apps.CrefoLogs', {
    extend: 'Enlight.app.SubApplication',
    name: 'Shopware.apps.CrefoLogs',
    loadPath: '{url action=load}',
    bulkLoad: true,
    controllers: ['Main', 'List'],
    views: [//important to have the views implemented!!
        'tabs.ServerList',
        'tabs.List',
        'main.Window'
    ],
    models: ['CrefoList', 'ServerList'],
    stores: ['CrefoList', 'ServerList'],
    defaultController: 'Main',
    onBeforeLaunch: function() {
        var me = this;
        Ext.require('CrefoUtil');
        CrefoUtil.loadSnippets(Ext.undefined);
        me._destroyOtherModuleInstances(function() {
        });
        me.callParent(arguments);
    },
    launch: function() {
        var me = this,
            controller = me.getController(me.defaultController);
        return controller.mainWindow;
    },
    _destroyOtherModuleInstances: function(cb, cbArgs) {
        var me = this, activeWindows = [], subAppId = me.$subAppId;
        me.windowClass = 'Shopware.apps.CrefoLogs.view.main.Window';
        cbArgs = cbArgs || [];

        Ext.each(Shopware.app.Application.subApplications.items, function(subApp) {
            if (!subApp || !subApp.windowManager || subApp.$subAppId === subAppId || !subApp.windowManager.hasOwnProperty('zIndexStack')) {
                return;
            }

            Ext.each(subApp.windowManager.zIndexStack, function(item) {
                if (typeof (item) !== 'undefined' && me.windowClass === item.$className) {
                    activeWindows.push(item);
                }
            });
        });

        if (activeWindows && activeWindows.length) {
            Ext.each(activeWindows, function(win) {
                win.destroy();
            });

            if (Ext.isFunction(cb)) {
                cb.apply(me, cbArgs);
            }
        } else {
            if (Ext.isFunction(cb)) {
                cb.apply(me, cbArgs);
            }
        }
    }
});
//{/block}
