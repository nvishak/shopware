//

Ext.define('Shopware.apps.AvenNotes.view.list.Product', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    configure:function () {
        return {
            columns:{
                orderID:{
                    header: 'OrderId',
                    dataIndex: 'orderNumber',

                    flex: 1
        },
                documentID:{
                    header: 'DocumentId',
                    dataIndex: 'documentID',
                    allowHtml:true,
                    flex: 1,
                    renderer:this.nameColumn
                }

    },
            detailWindow: 'Shopware.apps.AvenNotes.view.detail.Window',
            deleteColumn: false,
            addButton: false,
    }
    },

    orderColumn: function (value, metaData, record, rowIndex, colIndex, store, view) {
        var me = this;
        var helper = new Ext.dom.Helper,
            type = 2,
            display = "";
        var orderId = record.get('orderID');
        if (record.get('orderNumber')) {
            display += ' ' + Ext.String.leftPad(record.get('orderNumber'), 8, '0');
        }

        var spec = {
            tag: 'a',
            html: display,
            id:"orderId-btn"
        };

        return helper.markup(spec);
    },


    /**
     * Columns renderer for the name column
     * @param value
     */
    nameColumn: function(value, metaData, record, rowIndex, colIndex, store, view) {
        var helper = new Ext.dom.Helper,
            type = 2,
            display = "Delivery note";

        if (record.get('documentID')) {
            display += ' ' + Ext.String.leftPad(record.get('documentID'), 8, '0');
        }

        var spec = {
            tag: 'a',
            html: display,
            href: '{url action="openPdf"}?id=' + record.get('hash'),
            target: '_blank'
        };

        return helper.markup(spec);
    },


    createActionColumnItems: function () {
        var me = this,
        items = me.callParent(arguments);


        items.push({
    action: 'notice',
    iconCls: 'sprite-arrow-045',

    handler: function (view, rowIndex, colIndex, item, opts, record) {
        console.log(record.data);
        this.orderID = record.data.orderID;
        Shopware.app.Application.addSubApplication({
            name: 'Shopware.apps.Order',
            action: 'detail',
            params: {
                orderId:record.data.orderID
            }
        });
    }
});
return items;
}

});
