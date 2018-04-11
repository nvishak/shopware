//

Ext.define('Shopware.apps.AvenSupplier.view.detail.Product', {
    extend: 'Shopware.model.Container',
    padding: 20,
    configure: function() {
        return {
            controller: 'AvenSupplier',
            fieldSets: [{
                fields: {
                    name: { fieldLabel: 'Company' },
                    firstName: {},
                    lastName: {},
                    email: {},
                    phoneNumber: {},
                    street: {},
                    zipcode: {},
                    place: {},
                    note: this.createDescription
                }
            }]
        };
    },
    
    createDescription: function(model, formField) {
      formField.xtype = 'textarea';
      formField.height = 90;
      return formField;
   }
});