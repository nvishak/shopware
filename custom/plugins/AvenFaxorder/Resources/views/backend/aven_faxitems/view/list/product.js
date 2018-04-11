//

Ext.define('Shopware.apps.AvenFaxitems.view.list.Product', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    configure: function() {
        return {
            columns: {
                productId: { header: 'ProductID' },
                productNumber: { header: 'ProductNumber' },
                quantity: { header: 'Quantity' },
                faxId: { header: 'FaxCustomerDetailID' }
            },
            detailWindow: 'Shopware.apps.AvenFaxitems.view.detail.Window'
        };
    }
});
