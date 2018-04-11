//

Ext.define('Shopware.apps.AvenFaxitems.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.product-list-window',
    height: 450,
    title : '{s name=window_title}Article Details Fax order{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.AvenFaxitems.view.list.Product',
            listingStore: 'Shopware.apps.AvenFaxitems.store.Product'
        };
    }
});