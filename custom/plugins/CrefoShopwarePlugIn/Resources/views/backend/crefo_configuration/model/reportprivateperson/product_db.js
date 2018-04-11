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
//{block name="backend/crefo_configuration/model/report_private_person/product_db"}
Ext.define('Shopware.apps.CrefoConfiguration.model.reportprivateperson.ProductDb', {
    extend: 'Shopware.data.Model',
    alias: 'model.report-private-person-product-db',
    idgen: 'sequential',
    fields: [
        { name: 'config_id', type: 'int', useNull: true },
        { name: 'productKeyWS', type: 'int', useNull: true },
        { name: 'productNameWS', type: 'string', useNull: true },
        { name: 'isProductAvailable', type: 'boolean', useNull: false },
        { name: 'isLastThresholdMax', type: 'boolean', useNull: false },
        { name: 'visualSequence', type: 'int', useNull: false },
        { name: 'thresholdMin', type: 'decimal', useNull: true },
        { name: 'thresholdMax', type: 'decimal', useNull: true }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'products'
        }
    },
    /**
     * Define the associations of the order model.
     * @array
     */
    associations: [
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoConfiguration.model.ReportPrivatePerson'
        },
        {
            type: 'hasMany',
            model: 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.ScoreProductDb',
            name: 'getScoreProducts',
            associationKey: 'scoreProducts'
        }
    ]
});
//{/block}
