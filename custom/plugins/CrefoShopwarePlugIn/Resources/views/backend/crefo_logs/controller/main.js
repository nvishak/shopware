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
//{namespace name=backend/creditreform/translation}
//{block name="backend/crefo_logs/controller/main"}
Ext.define('Shopware.apps.CrefoLogs.controller.Main', {
    extend: 'Enlight.app.Controller',
    mainWindow: null,
    init: function () {
        var me = this;
        Ext.require('Shopware.apps.CrefoOrders', function () {
            Ext.require('Shopware.apps.CrefoOrders.model.CrefoReportResults');
            me.subApplication.crefoListStore = me.getStore('CrefoList');
            me.subApplication.listServerStore = me.getStore('ServerList');
            me.subApplication.crefoListStore.load({
                callback: function (records) {
                    me.mainWindow = me.getView('main.Window').create({
                        crefoListStore: me.subApplication.crefoListStore,
                        listServerStore : me.subApplication.listServerStore
                    });
                }
            });
        });

        me.control({
            'crefologs-main-window': {
                changeTab: me.onChangeTab
            },
            'crefo-logs-server-list': {
                downloadServerLogs: me.onDownloadServerLogs
            }
        });
        me.callParent(arguments);
    },
    /**
     * Is fired, when the tab is changed
     * Automatically selects the countries/shops and sets the surcharge
     * @param tabPanel Contains the tabpanel
     * @param newTab Contains the new tab, which was clicked now
     * @param oldTab Contains the old tab, which was opened before the new tab
     * @param formPanel Contains the general formpanel
     */
    onChangeTab: function (tabPanel, newTab, oldTab, formPanel) {
        var grid = newTab.items.items[0],
            store = grid.getStore();
        if(Ext.isDefined(store)){
            store.load();
        }
    },
    onDownloadServerLogs: function (list) {
        var me = this;
        var records = list.getSelectionModel().getSelection();
        var files = [];
        Ext.each(records, function (record) {
            files.push(record.get('filename'));
        });
        Ext.Ajax.request({
            url: '{url controller=CrefoLogs action=createServerLogsZip}',
            method: 'GET',
            params: { records : Ext.JSON.encode(files) },
            success: function(response) {
                try{
                    if(!me.isJson(response.responseText)){
                        throw new Error("no response");
                    }
                    var result = Ext.JSON.decode(response.responseText);
                    if(!result.success){
                        throw new Error("not successful");
                    }

                    Ext.create('Ext.Component', {
                        frameborder: 0,
                        style: {
                            display : 'none'
                        },
                        autoEl : {
                            tag : "iframe",
                            src : 'CrefoLogs/downloadZip?zipName=' + result.zipName
                        },
                        renderTo: Ext.getBody()
                    });
                }catch(e){
                    // console.log(e);
                }
            }
        });
    },
    isJson: function (str) {
        try {
            Ext.JSON.decode(str, false);
            return true;
        } catch (e) {
            // console.log(e);
            return false;
        }
    }
});
//{/block}


