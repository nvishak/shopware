
Ext.define('Shopware.apps.AvenNotes.model.Product', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'AvenNotes',
            detail: 'Shopware.apps.AvenNotes.view.detail.Product'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'orderID', type: 'string' },
        { name : 'documentID', type: 'string' },
        { name : 'hash', type:'string' },
        { name: 'orderNumber', type:'string'}
        ]
});

