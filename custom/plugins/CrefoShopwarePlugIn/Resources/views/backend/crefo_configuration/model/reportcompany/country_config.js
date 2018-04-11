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
//{block name="backend/crefo_configuration/model/reportcompany/country_config"}
Ext.define('Shopware.apps.CrefoConfiguration.model.reportcompany.CountryConfig', {
    extend: 'Shopware.data.Model',
    alias: 'model.reportcompany-country-config',
    idgen: 'sequential',
    fields: [
        { name: 'country', type: 'int', useNull: false },
        { name: 'config_id', type: 'int', useNull: false }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'countries'
        }
    },
    associations: [
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoConfiguration.model.ReportCompany'
        },
        {
            type: 'hasMany',
            model: 'Shopware.apps.CrefoConfiguration.model.reportcompany.ProductConfig',
            name: 'getProducts',
            foreignKey: 'country_config_id',
            associationKey: 'products'
        }
    ]
});
//{/block}
