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
//{block name="backend/crefo_configuration/store/inkasso/inkasso_values"}
Ext.define('Shopware.apps.CrefoConfiguration.store.inkasso.InkassoValues', {
    extend: 'Ext.data.Store',
    autoLoad: false,
    autoSync: false,
    groupField: 'id',
    getRecordsOfTypeValue: function (typeValue) {
        var records = [];
        this.findBy(function (record) {
            if (record.get('typeValue') === typeValue) {
                records.push(record.copy());
            }
        });
        return records;
    },
    sorters: [{
        property: 'keyWS',
        direction: 'ASC'
    }],
    sortOnLoad: true,
    model: 'Shopware.apps.CrefoConfiguration.model.inkasso.InkassoValues'
});
//{/block}
