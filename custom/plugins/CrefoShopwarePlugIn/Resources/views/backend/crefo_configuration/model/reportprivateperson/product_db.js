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
//{block name="backend/crefo_configuration/model/report_private_person/product_db"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.ProductDb', {
    extend: 'Shopware.data.Model',
    alias: 'model.report-private-person-product-db',
    fields: [
        { name: 'id', type: 'int', useNull: true },
        { name: 'configId', type: 'int', useNull: true },
        { name: 'productKeyWS', type: 'int', useNull: true },
        { name: 'isProductAvailable', type: 'boolean', useNull: false },
        { name: 'visualSequence', type: 'int', useNull: false },
        { name: 'productScoreFrom', type: 'int', useNull: true },
        { name: 'productScoreTo', type: 'int', useNull: true },
        { name: 'identificationResult', type: 'int', useNull: true },
        { name: 'addressValidationResult', type: 'int', useNull: true }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action="getReportPrivatePersonProducts"}',
            update: '{url controller="CrefoConfiguration" action="updateReportPrivatePersonProducts"}'
        },
        reader: {
            type: 'json',
            root: 'data'
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
        }
    ]
} );
//{/block}