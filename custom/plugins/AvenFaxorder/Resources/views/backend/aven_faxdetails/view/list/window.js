//

Ext.define('Shopware.apps.AvenFaxdetails.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.product-list-window',
    height: 450,
    title : '{s name=window_title}Fax Customer Details{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.AvenFaxdetails.view.list.Product',
            listingStore: 'Shopware.apps.AvenFaxdetails.store.Product'
        };
    }
});