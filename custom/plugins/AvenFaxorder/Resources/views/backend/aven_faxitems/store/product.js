//

Ext.define('Shopware.apps.AvenFaxitems.store.Product', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'AvenFaxitems'
        };
    },

    model: 'Shopware.apps.AvenFaxitems.model.Product'
});