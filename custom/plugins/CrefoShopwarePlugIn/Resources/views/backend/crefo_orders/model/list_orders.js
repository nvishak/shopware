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
//{block name="backend/crefo_orders/model/order"}
Ext.define('Shopware.apps.CrefoOrders.model.ListOrders', {
    extend: 'Shopware.apps.Order.model.Order',

    fields: [
        //{block name="backend/crefo_orders/model/list_orders/fields"}{/block}
        { name : 'id', type: 'int' },
        { name : 'solvencyId', type: 'int', useNull: true },
        { name : 'collectionId', type: 'int', useNull: true }
    ],
        requires:[
        'Shopware.apps.CrefoOrders.model.OrderListing',
        'Shopware.apps.CrefoOrders.model.CrefoReportResults'
    ],
        proxy: {
        type: 'ajax',

            api: {
            read:'{url controller="CrefoOrders" action="getListOrders"}'
        },

        reader: {
            type: 'json',
                root: 'data'
        }
    },
    associations:[
        {
            type:'hasOne',
            model:'Shopware.apps.CrefoOrders.model.OrderListing',
            name:'crefoOrderListing',
            getterName:'getCrefoOrderListing',
            associationKey:'crefoOrderListing',
            foreignKey : 'orderId'
        },
        {
            type:'hasOne',
            model:'Shopware.apps.CrefoOrders.model.CrefoReportResults',
            name:'crefoReportResults',
            getterName:'getCrefoReportResults',
            associationKey: 'crefoReportResults',
            foreignKey : 'orderNumber',
            primaryKey : 'number'
        }
    ]
});
//{/block}

