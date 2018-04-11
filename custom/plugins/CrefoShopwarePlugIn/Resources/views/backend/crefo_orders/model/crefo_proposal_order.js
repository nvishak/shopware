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
Ext.define('Shopware.apps.CrefoOrders.model.CrefoProposalOrder', {
    extend: 'Shopware.data.Model',

    fields: [
        { name: 'companyName', type: 'string', useNull: true },
        { name: 'salutation', type: 'string', useNull: true },
        { name: 'surname', type: 'string', useNull: true },
        { name: 'firstName', type: 'string', useNull: true },
        { name: 'email', type: 'string', useNull: true },
        { name: 'street', type: 'string', useNull: true },
        { name: 'houseNumber', type: 'string', useNull: true },
        { name: 'houseNumberAffix', type: 'string', useNull: true },
        { name: 'postcode', type: 'string', useNull: true },
        { name: 'city', type: 'string', useNull: true },
        { name: 'country', type: 'string', useNull: true },
        { name: 'countryIso', type: 'string', useNull: true },
        { name: 'invoiceAmount', type: 'float', useNull: true },
        { name: 'currencyFactor', type: 'float', useNull: true },
        {
            name: 'amount',
            type: 'float',
            useNull: true,
            convert: function(value, record) {
                var factor = record.get('currencyFactor');
                if (!Ext.isNumeric(factor)) {
                    factor = 1;
                }
                return Ext.util.Format.round(record.get('invoiceAmount') / factor, 2);
            }
        },
        { name: 'currency', type: 'string', useNull: true }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'proposalOrder'
        }
    },
    /**
     * Define the associations of the order model.
     * @array
     */
    associations: [
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoOrders.model.CrefoProposal'
        }
    ]
});
