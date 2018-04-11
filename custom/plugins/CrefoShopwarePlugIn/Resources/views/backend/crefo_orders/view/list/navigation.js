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
//{block name="backend/crefo_orders/view/list/navigation"}
Ext.define('Shopware.apps.CrefoOrders.view.list.Navigation', {
    extend: 'Shopware.apps.Order.view.list.Navigation',
    alias: 'widget.crefo-orders-list-navigation',
    layout: 'anchor',
    cls: Ext.baseCSSPrefix + 'crefo-orders-list-navigation',
    width: 300,
    collapsed: false,
    collapsible: true,

    initComponent: function () {
        var me = this;
        me.callParent(arguments);
    },

    getPanels: function() {
        var me = this;

        return [
            Ext.create('Shopware.apps.CrefoOrders.view.list.Filter', {
                orderStatusStore: me.orderStatusStore,
                paymentStatusStore: me.paymentStatusStore
            })
        ];
    }
});
//{/block}
