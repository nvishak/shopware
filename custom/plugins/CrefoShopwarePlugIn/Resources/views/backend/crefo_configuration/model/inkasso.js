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
Ext.define('Shopware.apps.CrefoConfiguration.model.Inkasso', {
    extend: 'Shopware.data.Model',
    alias: 'model.inkasso',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'creditor', type: 'string', useNull: true },
        { name: 'order_type', type: 'string', useNull: true },
        { name: 'interest_rate_radio', type: 'string', useNull: true },
        { name: 'interest_rate_value', type: 'decimal', useNull: true },
        { name: 'customer_reference', type: 'string', useNull: true },
        { name: 'turnover_type', type: 'string', useNull: true },
        { name: 'receivable_reason', type: 'string', useNull: true },
        { name: 'valuta_date', type: 'int', useNull: true },
        { name: 'due_date', type: 'int', useNull: true }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action=getInkassoInfo}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    },
    associations: [
        {
            type: 'hasOne',
            model: 'Shopware.apps.CrefoConfiguration.model.Account',
            name: 'getUserAccount',
            instanceName: 'UserAccount',
            associationKey: 'useraccount_id'
        }
    ]
});
