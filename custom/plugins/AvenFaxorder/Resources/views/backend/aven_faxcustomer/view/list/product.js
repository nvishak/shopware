//

Ext.define('Shopware.apps.AvenFaxcustomer.view.list.Product', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.AvenFaxcustomer.view.detail.Window'
        };
    }
});
