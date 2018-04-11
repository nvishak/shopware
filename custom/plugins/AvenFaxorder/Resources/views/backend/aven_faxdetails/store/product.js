//

Ext.define('Shopware.apps.AvenFaxdetails.store.Product', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'AvenFaxdetails'
        };
    },

    model: 'Shopware.apps.AvenFaxdetails.model.Product'
});