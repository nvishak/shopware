//

Ext.define('Shopware.apps.AvenSupplier.store.Product', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'AvenSupplier'
        };
    },

    model: 'Shopware.apps.AvenSupplier.model.Product'
});