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
//{block name="backend/crefo_orders/model/crefo_report_results"}
Ext.define('Shopware.apps.CrefoOrders.model.CrefoReportResults', {
    extend: 'Ext.data.Model',
    fields: [
        //{block name="backend/crefo_orders/model/crefo_report_results/fields"}{/block}
        { name : 'id', type: 'int', useNull: false },
        { name : 'orderNumber', type: 'string', useNull: true },
        { name : 'textReportName', type: 'string', useNull: false },
        { name : 'successfulSolvency', type: 'boolean', useNull: false },
        //company response results
        { name : 'riskJudgement', type: 'text', useNull: true },
        { name : 'indexThreshold', type: 'int', useNull: true },
        //private person results
        { name : 'privatePersonResult', type: 'string', useNull: true }
    ],

    proxy: {
        type: 'ajax',


        api: {
            read:'{url controller="CrefoOrders" action="getReportResultsList"}'
        },

        reader: {
            type: 'json',
            root: 'data'
        }
    },
    associations:[
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoOrders.model.ListOrders'
        }
    ]
});
//{/block}

