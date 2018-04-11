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
//{block name="backend/crefo_orders/view/list/filter"}
Ext.define('Shopware.apps.CrefoOrders.view.list.Filter', {
    extend: 'Shopware.apps.Order.view.list.Filter',
    alias: 'widget.crefo-orders-list-filter',
    cls: Ext.baseCSSPrefix + 'crefo-filter-options',
    autoScroll: true,

    initComponent: function () {
        var me = this;
        me.callParent(arguments);
    },

    /**
     * Creates the outer container for the filter options panel.
     * @return [Ext.container.Container]
     */
    createFieldContainer: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            border: false,
            padding: 10,
            items: [
                me.createFilterForm(),
                me.createFilterButtons()
            ]
        });
    }

});
//{/block}
