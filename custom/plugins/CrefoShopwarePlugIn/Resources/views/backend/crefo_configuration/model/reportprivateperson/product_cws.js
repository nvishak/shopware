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
//{block name="backend/crefo_configuration/model/reportprivateperson/product_cws"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.ProductCws', {
    extend: 'Shopware.data.Model',
    alias: 'model.report-private-person-product-cws',
    idgen: 'sequential',
    fields: [
        { name: 'available', type: 'boolean', useNull: true },
        { name: 'country', type: 'string', useNull: true },
        { name: 'keyWS', type: 'string', useNull: true },
        { name: 'nameWS', type: 'string', useNull: true }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'products'
        }
    }
} );
//{/block}