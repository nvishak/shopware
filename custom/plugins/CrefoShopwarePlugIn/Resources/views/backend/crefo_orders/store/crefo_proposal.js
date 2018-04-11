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
//{block name="backend/crefo_orders/store/crefo_proposal"}
Ext.define('Shopware.apps.CrefoOrders.store.CrefoProposal', {
    extend:'Ext.data.Store',
    autoLoad:false,
    model: 'Shopware.apps.CrefoOrders.model.CrefoProposal'
});
//{/block}

