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
Ext.define('Shopware.apps.CrefoConfiguration.model.Inkasso', {
    extend: 'Shopware.data.Model',
    alias: 'model.inkasso',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'inkasso_user_account', type: 'int', useNull: true },
        { name: 'inkasso_creditor', type: 'string', useNull: true },
        { name: 'inkasso_order_type', type: 'string', useNull: true },
        { name: 'inkasso_interest_rate_radio', type: 'string', useNull: true },
        { name: 'inkasso_interest_rate_value', type: 'decimal', useNull: true },
        { name: 'inkasso_customer_reference', type: 'string', useNull: true },
        { name: 'inkasso_turnover_type', type: 'string', useNull: true },
        { name: 'inkasso_receivable_reason', type: 'string', useNull: true },
        { name: 'inkasso_valuta_date', type: 'int', useNull: true },
        { name: 'inkasso_due_date', type: 'int', useNull: true }
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
    }
});