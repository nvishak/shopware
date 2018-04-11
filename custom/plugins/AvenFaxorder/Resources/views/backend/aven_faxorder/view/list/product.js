
Ext.define('Shopware.apps.AvenFaxorder.view.list.Product', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.product-listing-grid',
    region: 'center',

    configure: function() {
        return {
            columns: {
                orderNumber: { header: 'OrderNumber' }
            },
            detailWindow: 'Shopware.apps.AvenFaxorder.view.detail.Window'
        };
    },
    createActionColumnItems: function () {
        var me = this,
            items = me.callParent(arguments);


        items.push({
            action: 'notice',
            iconCls: 'sprite-arrow-045',

            handler: function (view, rowIndex, colIndex, item, opts, record) {
                console.log(record.data);
                Shopware.app.Application.addSubApplication({
                    name: 'Shopware.apps.AvenFaxdetails',
                    action: 'detail',
                    params: {
                       id:record.data.faxID
                    }
                });
//                Shopware.app.Application.addSubApplication({
//                    name: 'Shopware.apps.AvenFaxitems',
//                    action: 'detail',
//                    params: {
//                        id:record.data.quoteID
//                    }
//                });
                
                Shopware.app.Application.addSubApplication({
                    name: 'Shopware.apps.Order',
                    action: 'detail',
                    params: {
                        orderId:record.data.orderID
                    }
                });
                // Shopware.app.Application.addSubApplication({
                //     name: 'Shopware.apps.SwagBackendOrder'
                // });
            }
        });
        return items;
    }
});
