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
//{block name="backend/crefo_orders/controller/batch"}
Ext.define('Shopware.apps.CrefoOrders.controller.Batch', {
    extend: 'Ext.app.Controller',

    refs: [
        { ref: 'orderListGrid', selector: 'crefo-orders-list-main-window crefo-orders-list' },
        { ref: 'batchWindow', selector: 'crefo-orders-batch-window' },
        { ref: 'batchList', selector: 'crefo-orders-batch-window crefo-batch-list' },
        { ref: 'settingsPanel', selector: 'crefo-orders-batch-window crefo-batch-settings-panel' }
    ],

    snippets: {
        error: '{s name="crefo/validation/batchError"}Es sind ein oder mehrere Fehler aufgetreten.{/s}'
    },

    init: function() {
        var me = this;
        me.mainController = me.getController('Main');
        me.control({
            'crefo-orders-batch-window crefo-batch-settings-panel': {
                processChanges: me.onProcessChanges
            }
        });

        me.callParent(arguments);
    },
    onProcessChanges: function(form) {
        var me = this,
            orders = form.records,
            grid = me.getBatchList(),
            windowGrid = grid.up('window'),
            values = form.getValues(),
            orderListGrid = me.getOrderListGrid(),
            gridStore = orderListGrid.getStore(),
            //create the batch store which is used to sent the batch request
            store = Ext.create('Shopware.apps.CrefoOrders.store.Batch'),
            operation,
            resultSet;

        if (values.inkassoSettings === Ext.undefined) {
            return null;
        }

        Ext.each(orders, function(order) {
            order.setDirty();
        });

        //add the extra parameters for Collection action.
        store.getProxy().extraParams = {
            actionCollection: values.inkassoSettings
        };

        windowGrid.setLoading(true);
        store.add(orders);
        store.sync({
            callback: function(batch) {
                operation = batch.operations[ 0 ];
                resultSet = operation.resultSet ? operation.resultSet.records : operation.records;
                grid.getStore().removeAll();
                grid.getStore().add(resultSet);
                if (!Ext.isEmpty(operation.response) && CrefoUtil.isJson(operation.response.responseText)) {
                    var result = Ext.JSON.decode(operation.response.responseText);
                    if (!Ext.isEmpty(result.errors)) {
                        CrefoUtil.showStickyMessage('', me.snippets.error);
                    }
                }
                //grid.reconfigure(store);
                orderListGrid.crefoProposalStore.reload();
                orderListGrid.crefoOrdersStore.reload();
                orderListGrid.orderListingStore.reload();
                gridStore.reload({
                    callback: function() {
                        windowGrid.setLoading(false);
                    }
                });
            }
        });
    }
});
//{/block}
