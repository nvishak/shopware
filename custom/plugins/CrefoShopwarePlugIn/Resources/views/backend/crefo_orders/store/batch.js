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
//{block name="backend/crefo_orders/store/batch"}
Ext.define('Shopware.apps.CrefoOrders.store.Batch', {
    extend:'Ext.data.Store',
    batch:true,
    model: 'Shopware.apps.CrefoOrders.model.ListOrders',
    proxy:{
        type:'ajax',
        api:{
            update:'{url controller="CrefoOrders" action="batchProcess" targetField=orders}'
        },
        // writer: {
        //     type: 'json',
        //     allowSingle: false
        // },
        reader:{
            type:'json',
            root:'data',
            totalProperty:'total'
        }
    }
});
//{/block}

