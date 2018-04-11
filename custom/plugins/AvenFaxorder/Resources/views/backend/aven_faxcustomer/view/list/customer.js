//

Ext.define('Shopware.apps.AvenFaxcustomer.view.list.Customer', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.AvenFaxcustomer.view.detail.Window'
        };
    }
});
