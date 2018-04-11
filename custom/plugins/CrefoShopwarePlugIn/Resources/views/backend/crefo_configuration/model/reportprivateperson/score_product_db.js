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
//{block name="backend/crefo_configuration/model/report_private_person/score_product_db"}
Ext.define('Shopware.apps.CrefoConfiguration.model.reportprivateperson.ScoreProductDb', {
    extend: 'Shopware.data.Model',
    alias: 'model.report-private-person-score-product-db',
    idgen: 'sequential',
    fields: [
        { name: 'product_id', type: 'int', useNull: true },
        { name: 'visualSequence', type: 'int', useNull: false },
        { name: 'productScoreFrom', type: 'int', useNull: true },
        { name: 'productScoreTo', type: 'int', useNull: true },
        { name: 'identificationResult', type: 'int', useNull: true },
        { name: 'addressValidationResult', type: 'int', useNull: true }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'scoreProducts'
        }
    },
    /**
     * Define the associations of the order model.
     * @array
     */
    associations: [
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.ProductDb'
        }
    ]
});
//{/block}
