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
//{block name="backend/crefo_configuration/store/reportprivateperson/product_cws"}
Ext.define('Shopware.apps.CrefoConfiguration.store.reportprivateperson.ProductCws', {
    extend: 'Ext.data.Store',
    autoLoad: true,
    autoSync: true,
    groupField: 'id',
    model: 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.ProductCws',
    sorters: [ {
        property: 'keyWS',
        direction: 'ASC'
    } ],
    sortOnLoad: true
});
//{/block}
