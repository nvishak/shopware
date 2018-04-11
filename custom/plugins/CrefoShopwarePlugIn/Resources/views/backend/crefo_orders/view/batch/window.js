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
//{block name="backend/crefo_orders/view/batch/window"}
Ext.define( 'Shopware.apps.CrefoOrders.view.batch.Window', {
    extend: 'Enlight.app.Window',
    cls: Ext.baseCSSPrefix + 'crefo-orders-batch-window',
    alias: 'widget.crefo-orders-batch-window',
    width: 600,
    height: Ext.getBody().getViewSize().height - 150,
    minWidth: 500,
    minHeight: 400,
    modal: true,
    resizable: true,
    maximizable: false,
    minimizable: false,
    autoScroll: false,
    footerButton: false,
    stateful: false,
    stateId: 'shopware-crefo-orders-batch-window',
    layout: {
        align: 'stretch',
        type: 'hbox'
    },
    snippets: {
        title: '{s name="crefoorders/view/batch/window/title"}Creditreform Bestellungen{/s}'
    },

    initComponent: function(){
        var me = this;
        me.title = me.snippets.title;
        me.items = Ext.create( 'Shopware.apps.CrefoOrders.view.batch.Form', {
            flex: 1,
            records: me.records,
            list: me.list
        } );

        me.callParent( arguments );
    }

} );
//{/block}
