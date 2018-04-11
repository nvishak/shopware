
Ext.define('Shopware.apps.AvenFaxorder.model.Product', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'AvenFaxorder',
            detail: 'Shopware.apps.AvenFaxorder.view.detail.Product'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'orderNumber', type: 'string' },
        { name : 'quoteID', type: 'string' },
        { name : 'faxID', type: 'string' },
        { name : 'orderID', type: 'string' },
    ]
});

