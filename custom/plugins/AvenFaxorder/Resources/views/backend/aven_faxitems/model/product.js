
Ext.define('Shopware.apps.AvenFaxitems.model.Product', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'AvenFaxitems',
            detail: 'Shopware.apps.AvenFaxitems.view.detail.Product'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'productId', type: 'string' },
        { name : 'productNumber', type: 'string' },
        { name : 'quantity', type: 'string' },
        { name : 'faxId', type: 'string' },
        { name : 'customerId', type: 'string' }
    ]
});

