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
Ext.define('Shopware.apps.CrefoOrders.model.CrefoOrders', {
    extend: 'Shopware.apps.CrefoOrders.model.CrefoProposal',

    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'orderNumber', type: 'string' },
        { name : 'userAccountNumber', type: 'string' },
        { name : 'sentDate', type: 'date' },
        { name : 'languageIso', type: 'string' },
        { name : 'salutation', type: 'string', useNull: true },
        { name : 'lastName', type: 'string', useNull: true },
        { name : 'firstName', type: 'string', useNull: true },
        { name : 'companyName', type: 'string', useNull: true },
        { name : 'street', type: 'string' },
        { name : 'zipCode', type: 'string' },
        { name : 'city', type: 'string' },
        { name : 'country', type: 'string' },
        { name : 'email', type: 'string' },
        { name : 'orderType', type: 'string' },
        { name : 'interestRate', type: 'string' },
        { name : 'turnoverType', type: 'string' },
        { name : 'receivableReason', type: 'string' },
        { name : 'amount', type: 'string' },
        { name : 'currency', type: 'string' }
    ],

    proxy: {
        type: 'ajax',


        api: {
            read:'{url controller="CrefoOrders" action="getCrefoOrderDocument"}'
        },

        reader: {
            type: 'json',
            root: 'data'
        }
    }
});