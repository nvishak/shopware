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
//{block name="backend/crefo_orders/store/list"}
Ext.define('Shopware.apps.CrefoOrders.store.Order', {
    //extend:'Shopware.apps.Order.store.Order',
    extend: 'Ext.data.Store',
    autoLoad: false,
    remoteSort: true,
    remoteFilter: true,
    pageSize: 20,
    batch: true,
    model: 'Shopware.apps.CrefoOrders.model.ListOrders'
});
//{/block}
