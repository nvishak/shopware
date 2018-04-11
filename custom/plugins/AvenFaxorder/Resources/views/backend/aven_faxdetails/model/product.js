
Ext.define('Shopware.apps.AvenFaxdetails.model.Product', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'AvenFaxdetails',
            detail: 'Shopware.apps.AvenFaxdetails.view.detail.Product'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'fname', type: 'string' },
        { name : 'lname', type: 'string' },
        { name : 'bcompany', type: 'string' },
        { name : 'baddress1', type: 'string' },
        { name : 'baddress2', type: 'string' },
        { name : 'bcity', type: 'string' },
        { name : 'bpostcode', type: 'string' },
        { name : 'bcountry', type: 'string' },
        { name : 'btelephone', type: 'string' },
        { name : 'bfax', type: 'string' },
        { name : 'scompany', type: 'string' },
        { name : 'saddress1', type: 'string' },
        { name : 'saddress2', type: 'string' },
        { name : 'scity', type: 'string' },
        { name : 'spostcode', type: 'string' },
        { name : 'scountry', type: 'string' },
        { name : 'stelephone', type: 'string' },
        { name : 'sfax', type: 'string' },
        { name : 'vatid', type: 'string' },
        { name : 'email', type: 'string' }
    ]
});

