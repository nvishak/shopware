//

Ext.define('Shopware.apps.AvenFaxdetails.view.detail.Product', {
    extend: 'Shopware.model.Container',
    padding: 20,

    configure: function() {
        return {
            controller: 'AvenFaxdetails',
            fieldSets: [{
                    title: 'Contact Person',
                    fields: {
                        fname: 'Firstname',
                        lname: 'LastName'
                    }
                }, {
                    title: 'Billing Address',
                    fields: {
                        bcompany: 'Company',
                        baddress1: 'Address1',
                        baddress2: 'Address2',
                        bcity: 'City',
                        bpostcode: 'Postcode',
                        bcountry: 'Country',
                        btelephone: 'Tel.',
                        bfax: 'Fax'
                    }
                }, {
                    title: 'Shipping Address',
                    fields: {
                        scompany: 'Company',
                        saddress1: 'Address1',
                        saddress2: 'Address2',
                        scity: 'City',
                        spostcode: 'Postcode',
                        scountry: 'Country',
                        stelephone: 'Tel.',
                        sfax: 'Fax'
                    }
                }, {
                    title: 'Further Information',
                    fields: {
                        vatid: 'VATID',
                        email: 'E-mail'
                    }
                }]
        };
    }
});