//

Ext.define('Shopware.apps.AvenNotes.store.Product', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'AvenNotes'
        };
    },

    model: 'Shopware.apps.AvenNotes.model.Product'
});