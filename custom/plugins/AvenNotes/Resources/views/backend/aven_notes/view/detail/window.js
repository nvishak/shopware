//

Ext.define('Shopware.apps.AvenNotes.view.detail.Window', {
    extend: 'Shopware.window.Detail',
    alias: 'widget.product-detail-window',
    title : '{s name=title}Delivery notes{/s}',
    height: 420,
    width: 900,
    createToolbarItems: function() {
        var me = this,
            items = me.callParent(arguments);

        items.push(me.createToolbarButton());

        return items;
    },

    createToolbarButton: function() {
        return Ext.create('Ext.button.Button', {
            text: 'Single Toolbar Button'
        });
    }
});
