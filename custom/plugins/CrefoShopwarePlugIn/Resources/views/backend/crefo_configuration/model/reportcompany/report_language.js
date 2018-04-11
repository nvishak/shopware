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
//{block name="backend/crefo_configuration/model/reportcompany/report_lanugage"}
Ext.define('Shopware.apps.CrefoConfiguration.model.reportcompany.ReportLanguage', {
    extend: 'Shopware.data.Model',
    alias: 'model.report-language',
    fields: [
        { name: 'id', type: 'int', useNull: true },
        { name: 'textWS', type: 'string', useNull: true },
        { name: 'keyWS', type: 'string', useNull: true }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'reportLanguages'
        }
    }
});
//{/block}