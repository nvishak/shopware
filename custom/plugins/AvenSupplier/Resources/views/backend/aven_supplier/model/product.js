
Ext.define('Shopware.apps.AvenSupplier.model.Product', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'AvenSupplier',
            detail: 'Shopware.apps.AvenSupplier.view.detail.Product'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'name', type: 'string' },
        { name : 'firstName', type: 'string' },
        { name : 'lastName', type: 'string' },
        { name : 'email', type: 'string'},
        { name : 'street', type: 'string'},
        { name : 'place', type: 'string'},
        { name : 'note', type: 'string'},
        { name : 'zipcode' , type: 'string'},
        { name : 'phoneNumber', type: 'string'}
    ]
});

