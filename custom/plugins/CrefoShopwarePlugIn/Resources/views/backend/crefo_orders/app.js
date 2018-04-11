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
Ext.define('Shopware.apps.CrefoOrders', {
    extend: 'Enlight.app.SubApplication',
    name: 'Shopware.apps.CrefoOrders',
    loadPath: '{url action=load}',
    bulkLoad: true,
    defaultController: 'Main',
    controllers: [
        'Main',
        'Batch',
        'Detail',
        'Filter',
        'List'
    ],
    views: [
        'main.Window',
        'batch.Form',
        'batch.List',
        'batch.Window',
        'detail.Window',
        'detail.ContainerDocument',
        'detail.ContainerProposal',
        'list.List',
        'list.Navigation',
        'list.Filter'

    ],
    models: [
        'CrefoOrders',
        'CrefoProposal',
        'CrefoProposalOrder',
        'CrefoReportResults',
        'ListBatch',
        'ListOrders',
        'OrderListing'
    ],
    stores: [
        'Batch',
        'CrefoOrders',
        'CrefoProposal',
        'CrefoProposalOrder',
        'CrefoReportResults',
        'ListBatch',
        'Order',
        'OrderListing'
    ],
    onBeforeLaunch: function() {
        var me = this;

        me._destroyOtherModuleInstances(function() {
        });

        me.callParent(arguments);
    },
    launch: function () {
        var me = this,
            controller = me.getController(me.defaultController);
        return controller.mainWindow;
    },
    _destroyOtherModuleInstances: function (cb, cbArgs) {
        var me = this, activeWindows = [], subAppId = me.$subAppId;
        me.windowClass= 'Shopware.apps.CrefoOrders.view.main.Window';
        cbArgs = cbArgs || [];

        Ext.each(Shopware.app.Application.subApplications.items, function (subApp) {

            if (!subApp || !subApp.windowManager || subApp.$subAppId === subAppId || !subApp.windowManager.hasOwnProperty('zIndexStack')) {
                return;
            }

            Ext.each(subApp.windowManager.zIndexStack, function (item) {
                if (typeof(item) !== 'undefined' && me.windowClass===item.$className) {
                    activeWindows.push(item);
                }
            });
        });

        if (activeWindows && activeWindows.length) {
            Ext.each(activeWindows, function (win) {
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
