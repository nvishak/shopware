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
//{block name="backend/crefo_orders/model/order_listing"}
Ext.define('Shopware.apps.CrefoOrders.model.OrderListing', {
    extend: 'Shopware.data.Model',

    fields: [
        { name : 'id', type: 'int' },
        { name : 'orderId', type: 'int' },
        { name : 'crefoOrderId', type: 'int' },
        { name : 'crefoOrderType', type: 'int' }
    ],
    requires:[
        'Shopware.apps.CrefoOrders.model.CrefoProposal'
    ],
    proxy: {
        type: 'ajax',
        api: {
            read:'{url controller="CrefoOrders" action="getCrefoOrderList"}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    },

    /**
     * Define the associations of the order model.
     * @array
     */
    associations:[
        {
            type:'hasOne',
            model:'Shopware.apps.CrefoOrders.model.CrefoProposal',
            name:'crefoOrderProposal',
            associationKey:'crefoOrderProposal',
            primaryKey : 'crefoOrderId',
            foreignKey: 'id'
        },
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoOrders.model.ListOrders'
        }
    ]
});
//{/block}