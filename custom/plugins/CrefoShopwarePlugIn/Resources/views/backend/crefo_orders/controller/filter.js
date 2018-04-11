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
//{block name="backend/crefo_orders/controller/filter"}
Ext.define('Shopware.apps.CrefoOrders.controller.Filter', {
    extend: 'Shopware.apps.Order.controller.Filter',

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @return void
     */
    init: function () {
        var me = this;
        me.callParent(arguments);
        me.control({
            'crefo-orders-list-main-window crefo-orders-list': {
                searchOrders: me.onSearchOrders
            },
            'crefo-orders-list-main-window crefo-orders-list-filter': {
                acceptFilters: me.onAcceptFilters,
                resetFilters: me.onResetFilters
            }
        });
    }

});
//{/block}
