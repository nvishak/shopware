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
//{block name="backend/crefo_logs/model/crefo_list"}
Ext.define('Shopware.apps.CrefoLogs.model.CrefoList', {
    extend: 'Shopware.data.Model',
    require: [
        'Shopware.apps.CrefoOrders.model.CrefoReportResults'
    ],
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'statusLogs', type: 'string', useNull: true },
        { name: 'requestXMLDescription', type: 'string', useNull: false },
        { name: 'reportResultId', type: 'integer', useNull: true },
        { name: 'responseXMLDescription', type: 'string', useNull: false },
        { name: 'tsResponse', type: 'date' },
        { name: 'tsProcessEnd', type: 'date' }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller=CrefoLogs action=getCrefoLogs}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    },
    associations: [
        {
            type: 'hasOne',
            model: 'Shopware.apps.CrefoOrders.model.CrefoReportResults',
            name: 'reportResult',
            associationKey: 'crefoReportResult',
            foreignKey: 'id',
            primaryKey: 'reportResultId'
        }
    ]
});
//{/block}
