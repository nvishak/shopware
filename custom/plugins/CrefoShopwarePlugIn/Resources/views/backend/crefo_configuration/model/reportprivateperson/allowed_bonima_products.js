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
//{block name="backend/crefo_configuration/model/report_private_person/allowed_bonima_products"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.AllowedBonimaProducts', {
    extend: 'Shopware.data.Model',
    alias: 'model.report-private-person-allowed-bonima-products',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'keyWS', type: 'string', useNull: false }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action="getAllowedBonimaProducts"}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
} );
//{/block}