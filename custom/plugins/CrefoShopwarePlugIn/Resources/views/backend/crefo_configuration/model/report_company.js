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
//{block name="backend/crefo_configuration/model/report_company"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.ReportCompany', {
    extend: 'Shopware.data.Model',
    alias: 'model.reportcompany',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'useraccountId', type: 'int', useNull: true },
        { name: 'legitimateKey', type: 'string', useNull: true },
        { name: 'reportLanguageKey', type: 'string', useNull: true }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action=getReportCompanyInfo}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
} );
//{/block}