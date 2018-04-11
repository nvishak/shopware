//

Ext.define('Shopware.apps.AvenSupplier.view.list.Product', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    configure: function() {
        return {
            columns: {
                    name: { header: 'Company' },
                    firstName: {},
                    lastName: {},
                    email: {},
                    phoneNumber: {},
                    street: {},
                    zipcode: {},
                    place: {},
                    note: {},
                },
            detailWindow: 'Shopware.apps.AvenSupplier.view.detail.Window'
        };
    }
});
