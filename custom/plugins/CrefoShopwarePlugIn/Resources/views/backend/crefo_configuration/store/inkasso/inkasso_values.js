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
//{block name="backend/crefo_configuration/store/inkasso/inkasso_values"}
Ext.define('Shopware.apps.CrefoConfiguration.store.inkasso.InkassoValues', {
    extend: 'Ext.data.Store',
    autoLoad: true,
    autoSync : true,
    groupField: 'id',
    keyFilter: function (prefixKey) {
        this.clearFilter();
        if(prefixKey !== null && prefixKey !== undefined) {
            this.filterBy(function (record, id) {
                return record.get('keyWS').toUpperCase().search(prefixKey.toUpperCase()) !== -1;
            });
        }
        return this;
    },
    sorters: [{
        property: 'keyWS',
        direction: 'ASC'
    }],
    sortOnLoad: true,
    model : 'Shopware.apps.CrefoConfiguration.model.inkasso.InkassoValues'
});
//{/block}