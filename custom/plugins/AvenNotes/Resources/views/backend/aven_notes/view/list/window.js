//

Ext.define('Shopware.apps.AvenNotes.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.product-list-window',
    height: 450,
    title : '{s name=window_title}Delivery notes{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.AvenNotes.view.list.Product',
            listingStore: 'Shopware.apps.AvenNotes.store.Product'
        };
    }
});