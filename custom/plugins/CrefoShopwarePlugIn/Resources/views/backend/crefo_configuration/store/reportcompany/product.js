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
//{block name="backend/crefo_configuration/store/reportcompany/product"}
Ext.define('Shopware.apps.CrefoConfiguration.store.reportcompany.Product', {
    extend: 'Ext.data.Store',
    autoLoad: false,
    autoSync: false,
    groupField: 'id',
    countryFilter: function(countryId) {
        this.clearFilter();
        this.filter('country', countryId);
        return this;
    },
    getRecordsForCountry: function (countryId) {
        var records = [];
        this.findBy(function (record) {
            if (record.get('country') === countryId) {
                records.push(record.copy());
            }
        });
        return records;
    },
    model: 'Shopware.apps.CrefoConfiguration.model.reportcompany.Product',
    sorters: [ {
        property: 'keyWS',
        direction: 'ASC'
    } ],
    sortOnLoad: true
});
//{/block}
