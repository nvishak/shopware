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
//{block name="backend/crefo_configuration/store/reportcompany/product"}
Ext.define( 'Shopware.apps.CrefoConfiguration.store.reportcompany.Product', {
    extend: 'Ext.data.Store',
    autoLoad: true,
    autoSync: true,
    groupField: 'id',
    countryFilter: function( countryId ){
        this.clearFilter();
        this.filter( 'country', countryId.toUpperCase() );
        return this;
    },
    model: 'Shopware.apps.CrefoConfiguration.model.reportcompany.Product',
    sorters: [ {
        property: 'keyWS',
        direction: 'ASC'
    } ],
    sortOnLoad: true
} );
//{/block}