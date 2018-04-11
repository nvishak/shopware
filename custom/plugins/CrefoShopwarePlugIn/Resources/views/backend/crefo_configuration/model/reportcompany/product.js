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
//{block name="backend/crefo_configuration/model/reportcompany/product"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.reportcompany.Product', {
    extend: 'Shopware.data.Model',
    alias: 'model.reportcompany-product',
    idgen: 'sequential',
    fields: [
        { name: 'available', type: 'boolean', useNull: true },
        { name: 'country', type: 'string', useNull: true },
        { name: 'solvencyIndexWS', type: 'boolean', useNull: true },
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