//

Ext.define('Shopware.apps.AvenFaxcustomer', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.AvenFaxcustomer',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.Customer',

        'detail.Customer',
        'detail.Window'
    ],

    models: [ 'Customer' ],
    stores: [ 'Customer' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});