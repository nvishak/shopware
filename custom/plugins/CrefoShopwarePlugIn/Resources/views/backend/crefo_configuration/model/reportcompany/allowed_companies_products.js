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
//{block name="backend/crefo_configuration/model/report_company/allowed_companies_products"}
Ext.define('Shopware.apps.CrefoConfiguration.model.reportcompany.AllowedCompaniesProducts', {
    extend: 'Shopware.data.Model',
    alias: 'model.report-company-allowed-companies-products',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'keyWS', type: 'string', useNull: false }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action="getAllowedCompaniesProducts"}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//{/block}
