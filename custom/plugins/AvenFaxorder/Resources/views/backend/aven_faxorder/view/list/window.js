//

Ext.define('Shopware.apps.AvenFaxorder.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.product-list-window',
    height: 450,
    title : '{s name=window_title}Fax Orders{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.AvenFaxorder.view.list.Product',
            listingStore: 'Shopware.apps.AvenFaxorder.store.Product'
        };
    }
});