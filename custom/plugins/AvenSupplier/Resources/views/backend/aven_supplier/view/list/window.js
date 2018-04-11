//

Ext.define('Shopware.apps.AvenSupplier.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.product-list-window',
    height: 450,
    title : '{s name=window_title}Supplier{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.AvenSupplier.view.list.Product',
            listingStore: 'Shopware.apps.AvenSupplier.store.Product'
        };
    }
});