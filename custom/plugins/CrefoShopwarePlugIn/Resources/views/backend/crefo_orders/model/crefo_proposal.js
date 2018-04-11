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
Ext.define( 'Shopware.apps.CrefoOrders.model.CrefoProposal', {
    extend: 'Shopware.data.Model',

    fields: [
        { name: 'id', type: 'int', useNull: true },
        { name: 'orderId', type: 'int' },
        { name: 'crefoOrderType', type: 'int' },
        { name: 'documentNumber', type: 'string' },
        { name: 'proposalStatus', type: 'int' },
        { name: 'creditor', type: 'string', useNull: true },
        { name: 'orderTypeKey', type: 'string' },
        { name: 'interestRateRadio', type: 'integer' },
        { name: 'interestRateValue', type: 'decimal', useNull: true },
        { name: 'customerReference', type: 'string', useNull: true },
        { name: 'remarks', type: 'string', useNull: true },
        { name: 'turnoverTypeKey', type: 'string' },
        { name: 'dateInvoice', type: 'date', useNull: true },
        { name: 'dateContract', type: 'date', useNull: true },
        { name: 'valutaDate', type: 'date', useNull: true },
        { name: 'dueDate', type: 'date', useNull: true },
        { name: 'invoiceNumber', type: 'string', useNull: true },
        { name: 'receivableReasonKey', type: 'string' }
    ],

    proxy: {
        type: 'ajax',


        api: {
            read: '{url controller="CrefoOrders" action="getCrefoProposal"}',
            update: '{url controller="CrefoOrders" action="updateCrefoProposal"}',
            destroy: '{url controller="CrefoOrders" action="deleteCrefoProposal"}'
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
            type: 'hasOne',
            model: 'Shopware.apps.Order.model.Order',
            name: 'getOrder',
            associationKey: 'orderId',
            foreignKey: 'id',
            primaryKey: 'orderId'
        },
        {
            type: 'hasOne',
            model: 'Shopware.apps.CrefoOrders.model.CrefoProposalOrder',
            getterName: 'getProposalOrder',
            associationKey: 'proposalOrder'
        },
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoOrders.model.OrderListing'
        }
    ]
} );