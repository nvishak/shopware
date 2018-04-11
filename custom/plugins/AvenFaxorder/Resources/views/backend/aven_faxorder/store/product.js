//

Ext.define('Shopware.apps.AvenFaxorder.store.Product', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'AvenFaxorder'
        };
    },

    model: 'Shopware.apps.AvenFaxorder.model.Product'
});