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
//{block name="backend/crefo_orders/view/main/window"}
Ext.define( 'Shopware.apps.CrefoOrders.view.main.Window', {
    extend: 'Enlight.app.Window',
    cls: Ext.baseCSSPrefix + 'crefo-orders-list-main-window',
    alias: 'widget.crefo-orders-list-main-window',
    id: 'CrefoOrdersWindow',
    border: false,
    autoShow: true,
    layout: 'border',
    width: Ext.getBody().getViewSize().width - 120,
    height: Ext.getBody().getViewSize().height - 100,
    maximizable: true,
    minimizable: true,
    /**
     * A flag which causes the object to attempt to restore the state of internal properties from a saved state on startup.
     */
    stateful: true,
    /**
     * The unique id for this object to use for state management purposes.
     */
    stateId: 'shopware-crefo-orders-main-window',
    title: '{s name="crefoorders/view/main/window/title"}Creditreform Bestellungen{/s}',

    initComponent: function(){
        var me = this;
        //add the order list grid panel and set the store
        me.items = [
            {
                xtype: 'container',
                layout: {
                    type: 'vbox',
                    align: 'stretch'
                },
                region: 'center',
                items: [ Ext.create( 'Shopware.apps.CrefoOrders.view.list.List', {
                    flex: 2,
                    orderListingStore: me.orderListingStore,
                    crefoProposalStore: me.crefoProposalStore,
                    crefoOrdersStore: me.crefoOrdersStore,
                    listStore: me.listStore,
                    orderStatusStore: me.orderStatusStore,
                    paymentStatusStore: me.paymentStatusStore,
                    reportResultStore: me.reportResultStore,
                    statusStore: me.statusStore,
                    inkassoConfig: me.inkassoConfig
                } ) ]
            }, Ext.create( 'Shopware.apps.CrefoOrders.view.list.Navigation', {
                region: 'west',
                orderStatusStore: me.orderStatusStore,
                paymentStatusStore: me.paymentStatusStore
            } )
        ];

        me.callParent( arguments );

    }

} );
//{/block}
