//

Ext.define('Shopware.apps.AvenFaxcustomer.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.product-list-window',
    height: 450,
    title : '{s name=window_title}Supplier{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.AvenFaxcustomer.view.list.Customer',
            listingStore: 'Shopware.apps.AvenFaxcustomer.store.Customer'
        };
    }
});