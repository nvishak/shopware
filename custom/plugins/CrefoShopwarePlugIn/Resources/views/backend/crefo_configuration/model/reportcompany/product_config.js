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
//{block name="backend/crefo_configuration/model/reportcompany/product_config"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.reportcompany.ProductConfig', {
    extend: 'Shopware.data.Model',
    alias: 'model.reportcompany-product-config',
    fields: [
        { name: 'id', type: 'int', useNull: true },
        { name: 'configsId', type: 'int', useNull: true },
        { name: 'land', type: 'string', useNull: true },
        { name: 'productKeyWS', type: 'string', useNull: true },
        { name: 'productTextWS', type: 'string', useNull: true },
        { name: 'sequence', type: 'int', useNull: true },
        { name: 'threshold', type: 'decimal', useNull: true },
        { name: 'threshold_index', type: 'int', useNull: true },
        { name: 'solvencyIndexWS', type: 'boolean', useNull: true }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action="getReportCompaniesProductConfig"}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
} );
//{/block}