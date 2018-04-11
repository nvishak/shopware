//

Ext.define('Shopware.apps.AvenFaxcustomer.store.Customer', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'AvenFaxdetails'
        };
    },

    model: 'Shopware.apps.AvenFaxcustomer.model.Customer'
});