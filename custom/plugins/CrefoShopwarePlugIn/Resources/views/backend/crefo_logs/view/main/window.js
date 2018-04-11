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
//{namespace name=backend/creditreform/translation}
//{block name="backend/crefo_logs/view/main/window"}
Ext.define('Shopware.apps.CrefoLogs.view.main.Window', {
    extend: 'Enlight.app.Window',
    alias: 'widget.crefo-logs-main-window',
    id: 'CrefoLogsWindow',
    cls: Ext.baseCSSPrefix + 'crefo-logs-window',
    height: Ext.getBody().getViewSize().height - 100,
    width: Ext.getBody().getViewSize().width - 120,
    minWidth: 575,
    minHeight: 400,
    border: false,
    autoShow: true,
    autoScroll: false,
    resizable: true,
    layout: 'border',
    snippets: {
        title: '{s name=crefologs/view/main/window/title}Creditreform Logs{/s}',
        tabs: {
            interfaceLogs: '{s name="crefologs/view/main/window/tabs/title/interface"}Interface Logs{/s}',
            serverLogs: '{s name="crefologs/view/main/window/tabs/title/server"}Server Logs{/s}'
        }
    },

    initComponent: function() {
        var me = this;
        me.title = me.snippets.title;
        me.registerEvents();
        me.tabPanel = me.createTabPanel();
        me.items = [ {
            xtype: 'container',
            region: 'center',
            layout: 'border',
            crefoListStore: me.crefoListStore,
            items: [ me.tabPanel ]
        } ];

        me.callParent(arguments);
    },
    registerEvents: function() {
        this.addEvents(
            /**
             * This event is fired, when the user changes the active tab
             * @param tabPanel Contains the tabPanel
             * @param newTab Contains the new active tab
             * @param oldTab Contains the old tab, which was active before
             * @param generalForm Contains the general form-panel
             */
            'changeTab'
        );
    },
    createTabPanel: function() {
        var me = this;

        //me.serverPanel = Ext.create('Shopware.apps.CrefoLogs.view.tabs.ServerPanel');

        me.serverList = Ext.create('Shopware.apps.CrefoLogs.view.tabs.ServerList', {
            listServerStore: me.listServerStore
        });

        me.listTab = Ext.create('Shopware.apps.CrefoLogs.view.tabs.List', {
            crefoListStore: me.crefoListStore
        });

        return Ext.create('Ext.tab.Panel', {
            autoShow: true,
            layout: 'fit',
            region: 'center',
            autoScroll: false,
            border: 0,
            bodyBorder: false,
            defaults: {
                layout: 'fit'
            },
            items: [
                {
                    xtype: 'container',
                    autoRender: true,
                    title: me.snippets.tabs.interfaceLogs,
                    items: [ me.listTab ]
                },
                {
                    xtype: 'container',
                    autoRender: true,
                    //tabConfig: {
                    //tooltip: me.snippets.tabs.tooltip
                    //},
                    title: me.snippets.tabs.serverLogs,
                    items: [ me.serverList ]
                }
            ],
            listeners: {
                tabchange: function(tabPanel, newTab, oldTab) {
                    me.fireEvent('changeTab', tabPanel, newTab, oldTab);
                }
            }
        });
    }
});
//{/block}
