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
//{block name="backend/crefo_configuration/model/reportcompany/product_config"}
Ext.define('Shopware.apps.CrefoConfiguration.model.reportcompany.ProductConfig', {
    extend: 'Shopware.data.Model',
    alias: 'model.reportcompany-product-config',
    fields: [
        { name: 'id', type: 'int', useNull: true },
        { name: 'available', type: 'boolean', useNull: false, defaultValue: true },
        { name: 'country_config_id', type: 'int', useNull: false },
        { name: 'productKeyWS', type: 'string', useNull: false },
        { name: 'productTextWS', type: 'string', useNull: false },
        { name: 'sequence', type: 'int', useNull: false },
        { name: 'thresholdMin', type: 'decimal', useNull: false },
        { name: 'thresholdMax', type: 'decimal', useNull: true },
        { name: 'thresholdIndex', type: 'int', useNull: true },
        { name: 'isLastThresholdMax', type: 'boolean', useNull: false },
        { name: 'hasSolvencyIndex', type: 'boolean', useNull: true }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'products'
        }
    },
    associations: [
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoConfiguration.model.reportcompany.CountryConfig'
        }
    ]
});
//{/block}
