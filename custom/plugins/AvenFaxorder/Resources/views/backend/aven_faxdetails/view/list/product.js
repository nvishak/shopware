//

Ext.define('Shopware.apps.AvenFaxdetails.view.list.Product', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    configure: function() {
        return {
            columns: {
                    id: { header: 'DetailId'},
                    fname: { header: 'Firstname' },
                    lname: { header: 'LastName' },
                    bcompany: { header: 'Billing-Company' },
                    baddress1: { header: 'Address1' },
                    baddress2: { header: 'Address2' },
                    bcity: { header: 'City' },
                    bpostcode: { header: 'Postcode' },
                    bcountry: { header: 'Country' },
                    btelephone: { header: 'Tel.' },
                    bfax: { header: 'Fax' },
                    scompany: { header: 'Shipping-Company' },
                    saddress1: { header: 'Address1' },
                    saddress2: { header: 'Address2' },
                    scity: { header: 'City' },
                    spostcode: { header: 'Postcode' },
                    scountry: { header: 'Country' },
                    stelephone: { header: 'Tel.' },
                    sfax: { header: 'Fax' },
                    vatid: { header: 'VATID' },
                    email: { header: 'E-mail' }
                },
            detailWindow: 'Shopware.apps.AvenFaxdetails.view.detail.Window'
        };
    }
});
