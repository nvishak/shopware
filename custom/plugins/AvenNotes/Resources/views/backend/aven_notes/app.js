//

Ext.define('Shopware.apps.AvenNotes', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.AvenNotes',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.Product',

        'detail.Product',
        'detail.Window'
    ],

    models: [ 'Product' ],
    stores: [ 'Product' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});