/*
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */
//{namespace name=backend/creditreform/translation}
//{block name="backend/crefo_orders/controller/list"}
Ext.define('Shopware.apps.CrefoOrders.controller.List', {
    extend: 'Shopware.apps.Order.controller.List',
    /**
     * all references to get the elements by the applicable selector
     */
    refs: [
        { ref: 'orderListGrid', selector: 'crefo-orders-list-main-window crefo-orders-list' }
    ],
    snippetsExt: {
        unknownError: '{s name="crefo/messages/unknownError"}Es ist ein unbekannter Fehler aufgetreten.{/s}',
        unknownErrorTitle: '{s name="crefo/messages/unknownError/title"}Fehler{/s}',
        errors: {
            createProposal: '{s name="crefo/orders/controller/list/errors/createProposal"}Der Inkasso-Vorschlag kann nicht erzeugt werden. Die Währung ist ungültig.{/s}'
        }
    },
    proposalStatus: {
        readyToSend: 1,
        needsEditing: 2,
        sent: 3,
        error: 0
    },
    orderType: {
        proposal: 1,
        document: 2
    },
    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @return void
     */
    init: function() {
        var me = this;
        me.mainController = me.getController('Main');
        me.control({
            'crefo-orders-list-main-window crefo-orders-list': {
                showBatch: me.onShowBatch,
                openError: me.onOpenErrorSolvency,
                openXml: me.onOpenXmlSolvency,
                openProposal: me.onOpenProposal,
                createProposal: me.onCreateProposal,
                deleteProposal: me.onDeleteProposal,
                sendProposal: me.onSendProposal,
                loadCollectionData: me.onLoadCollectionData
            }
        });
        me.callParent(arguments);
    },

    onShowBatch: function(list) {
        var me = this;
        var records = list.getSelectionModel().getSelection();
        if (!Ext.isEmpty(records)) {
            //open the order listing window
            me.mainWindow = me.getView('batch.Window').create({
                list: list,
                records: records
            }).show();
        }
    },
    onOpenErrorSolvency: function(list, iStore) {
        var me = this;
        Ext.Ajax.request({
            url: '{url controller=CrefoOrders action=openSolvencyError}',
            method: 'POST',
            params: { solvencyId: iStore.get('solvencyId') },
            success: function(response) {
                try {
                    if (!CrefoUtil.isJson(response.responseText)) {
                        throw new Error('no response');
                    }
                    var result = Ext.JSON.decode(response.responseText);
                    if (!result.success) {
                        throw new Error('not successful');
                    }
                    me.mainController.handleErrors(result.displayError, null);
                } catch (e) {
                    CrefoUtil.showStickyMessage(me.snippetsExt.unknownErrorTitle, me.snippetsExt.unknownError);
                }
            }
        });
    },
    onOpenXmlSolvency: function(list, iStore) {
        var me = this;
        Ext.Ajax.request({
            url: '{url controller=CrefoOrders action=openXml}',
            method: 'POST',
            params: { solvencyId: iStore.get('solvencyId') },
            success: function(response) {
                try {
                    if (!CrefoUtil.isJson(response.responseText)) {
                        throw new Error('no response');
                    }
                    var result = Ext.JSON.decode(response.responseText);
                    if (!result.success) {
                        throw new Error('not successful');
                    }
                    var myWindow = Ext.create('Ext.window.Window', {
                        title: result.title,
                        height: '90%',
                        maximizable: false,
                        minimizable: false,
                        resizable: false,
                        autoShow: true,
                        autoScroll: false,
                        width: 1000,
                        layout: 'fit',
                        items: [
                            {
                                xtype: 'textareafield',
                                grow: true,
                                border: 0,
                                readOnly: true,
                                height: '100%',
                                width: '100%',
                                name: 'message',
                                value: result.dataXml
                            }
                        ]
                    });
                    myWindow.show();
                } catch (e) {
                    CrefoUtil.showStickyMessage(me.snippetsExt.unknownErrorTitle, me.snippetsExt.unknownError);
                }
            }
        });
    },
    onOpenProposal: function(list, record) {
        var me = this;
        if (Ext.isEmpty(record.get('collectionId'))) {
            return false;
        }
        var recordListing = record.getAssociatedData().crefoOrderListing,
            edit = false,
            proposalRecord = recordListing.crefoOrderProposal,
            errorProposal = proposalRecord.proposalStatus === me.proposalStatus.error;
        if (recordListing !== null) {
            edit = recordListing.crefoOrderType === me.orderType.proposal;
        }
        if (edit) {
            me.onLoadCollectionData(list);
        }
        if (errorProposal) {
            Ext.Ajax.request({
                url: '{url module=backend controller=CrefoOrders action=openProposalWithErrors}',
                method: 'POST',
                params: { proposalId: proposalRecord.id },
                success: function(response) {
                    var result = null;
                    try {
                        if (!CrefoUtil.isJson(response.responseText)) {
                            throw new Error('no response');
                        }
                        result = Ext.JSON.decode(response.responseText);
                        if (!result.success) {
                            throw new Error('not successful');
                        }
                        me.createDetailWindow(list, proposalRecord.id, record, edit, errorProposal, result.displayErrors);
                    } catch (e) {
                        CrefoUtil.showStickyMessage(me.snippetsExt.unknownErrorTitle, me.snippetsExt.unknownError);
                    }
                },
                failure: function() {
                    CrefoUtil.showStickyMessage(me.snippetsExt.unknownErrorTitle, me.snippetsExt.unknownError);
                }
            });
        } else {
            me.createDetailWindow(list, recordListing.crefoOrderId, record, edit, errorProposal);
        }
    },
    onCreateProposal: function(list, record) {
        if (record.get('collectionId') !== Ext.undefined && record.get('collectionId') !== null) {
            return false;
        }
        list.setLoading(true);
        var values = Object.create(Object.prototype),
            me = this;
        values.orderId = record.get('id');
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoOrders action=createProposal}',
            method: 'POST',
            params: values,
            success: function(response) {
                var result = null;
                try {
                    if (!CrefoUtil.isJson(response.responseText)) {
                        throw new Error('no response');
                    }
                    result = Ext.JSON.decode(response.responseText);
                    if (!result.success) {
                        throw new Error('not successful');
                    }
                    if (result.error) {
                        CrefoUtil.showStickyMessage('', me.snippetsExt.errors.createProposal);
                    }
                    list.crefoProposalStore.load();
                    list.orderListingStore.load({
                        callback: function() {
                            list.setLoading(false);
                            list.store.load();
                        }
                    });
                } catch (e) {
                    CrefoUtil.showStickyMessage(me.snippetsExt.unknownErrorTitle, me.snippetsExt.unknownError);
                }
            },
            failure: function() {
                list.setLoading(false);
            }
        });
    },
    onDeleteProposal: function(list, record) {
        var recordListing = list.orderListingStore.findRecord('orderId', record.get('id')),
            proposalRecord = list.crefoProposalStore.findRecord('id', recordListing.get('crefoOrderId'));
        if (record.get('collectionId') === Ext.undefined || record.get('collectionId') === '' ||
            (recordListing !== Ext.undefined && recordListing.get('crefoOrderType') === 2)) {
            return false;
        }
        list.setLoading(true);
        proposalRecord.destroy({
            callback: function() {
                list.orderListingStore.load();
                list.setLoading(false);
                list.store.reload();
            }
        });
    },
    onSendProposal: function(list, record) {
        var me = this,
            recordListing = list.orderListingStore.findRecord('orderId', record.get('id')),
            proposalRecord = list.crefoProposalStore.findRecord('id', recordListing.get('crefoOrderId'));
        if (record.get('collectionId') === Ext.undefined || record.get('collectionId') === '' ||
            (recordListing !== Ext.undefined && recordListing.get('crefoOrderType') === 2) ||
            proposalRecord === null || proposalRecord === Ext.undefined) {
            return false;
        }
        list.setLoading(true);
        var input = Object.create(Object.prototype);
        input.proposalId = proposalRecord.get('id');
        input.listingId = list.orderListingStore.findRecord('crefoOrderId', input.proposalId).get('id');
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoOrders action=sendProposal}',
            method: 'POST',
            params: input,
            success: function(response) {
                var result = null;
                try {
                    if (!CrefoUtil.isJson(response.responseText)) {
                        result = Object.create(Object.prototype);
                        result.errors = Object.create(Object.prototype);
                        result.errors.errorCode = true;
                        throw new Error('no response');
                    }
                    result = Ext.JSON.decode(response.responseText);
                    if (!result.success) {
                        throw result.errors;
                    }
                } catch (e) {
                    var errors = [];
                    for (var i in e) {
                        if (e.hasOwnProperty(i)) {
                            errors.push(e[ i ]);
                        }
                    }
                    if (Ext.isEmpty(errors[ 0 ]) || !me.checkFaultsToHaveErrorFields(errors[ 0 ])) {
                        me.mainController.handleErrors(errors[ 0 ], null);
                        me.openBadProposal = false;
                    } else {
                        me.openBadProposal = true;
                    }
                } finally {
                    list.setLoading(false);
                    list.crefoProposalStore.reload();
                    list.crefoOrdersStore.reload();
                    list.orderListingStore.reload();
                    list.store.reload({
                        callback: function() {
                            if (result.success) {
                                CrefoUtil.showStickyMessage('', me.mainController.snippets.success);
                            } else if (!Ext.isEmpty(me.openBadProposal) && me.openBadProposal) {
                                me.onOpenProposal(list, list.store.getById(record.get('id')));
                            }
                        }
                    });
                }
            },
            failure: function(response) {
                var result = null;
                var responseText = response.responseText.substr(0, response.responseText.lastIndexOf('}') + 1);
                try {
                    if (!CrefoUtil.isJson(responseText)) {
                        result = Object.create(Object.prototype);
                        result.errors = Object.create(Object.prototype);
                        result.errors.errorCode = true;
                        throw new Error('no response');
                    }
                    result = Ext.JSON.decode(responseText);
                    if (!result.success) {
                        throw result.errors;
                    }
                } catch (e) {
                    if (Ext.isEmpty(e.errorCode) && Ext.isObject(e)) {
                        var errors = [];
                        for (var i in e) {
                            if (e.hasOwnProperty(i)) {
                                errors.push(e[ i ]);
                            }
                        }
                        me.mainController.handleErrors(errors[ 0 ], null);
                    } else {
                        me.mainController.handleErrors(result.errors, null);
                    }
                } finally {
                    list.setLoading(false);
                    list.crefoProposalStore.reload();
                    list.crefoOrdersStore.reload();
                    list.orderListingStore.reload();
                    list.store.reload({
                        callback: function() {
                            if (result.success) {
                                CrefoUtil.showStickyMessage('', me.mainController.snippets.success);
                            } else if (!Ext.isEmpty(me.openBadProposal) && me.openBadProposal) {
                                me.onOpenProposal(list, list.store.getById(record.get('id')));
                            }
                        }
                    });
                }
            }
        });
    },
    /**
     * check in the error message to find at least one error field
     * @param errors
     * @returns boolean | false - if doesn't have error fields, otherwise true
     */
    checkFaultsToHaveErrorFields: function(errors) {
        var hasErrorFields = false;
        if (Ext.isEmpty(errors.faults)) {
            return hasErrorFields;
        }
        for (var index = 0; index < errors.faults.length; index++) {
            var fault = errors.faults[ index ];
            if (!Ext.isEmpty(fault.errorfield)) {
                hasErrorFields = true;
            }
        }
        return hasErrorFields;
    },
    onLoadCollectionData: function (list) {
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoOrders action=loadCollectionCreditors}',
            method: 'POST',
            success: function(response) {
                if (Ext.isEmpty(response) || Ext.isEmpty(response.responseText)) {
                    return;
                }
                var result = Ext.JSON.decode(response.responseText);
                if (Ext.isDefined(result.data)) {
                    list.collectionCreditors.loadData(result.data, false);
                }
            }
        });
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoOrders action=loadCollectionValues}',
            method: 'POST',
            success: function(response) {
                if (Ext.isEmpty(response) || Ext.isEmpty(response.responseText)) {
                    return;
                }
                var result = Ext.JSON.decode(response.responseText);
                if (Ext.isDefined(result.data)) {
                    list.collectionValues.loadData(result.data, false);
                }
            }
        });
    },
    createDetailWindow: function (list, orderTypeId, record, edit, errorProposal, displayErrors) {
        var args = Object.create(Object.prototype);
        args.crefoProposalRecord = list.crefoProposalStore.findRecord('id', orderTypeId);
        args.listRecord = record;
        args.list = list;
        args.editOrder = edit;
        if (errorProposal) {
            args.displayErrors = displayErrors;
        } else {
            args.crefoOrdersRecord = list.crefoOrdersStore.findRecord('id', orderTypeId);
        }
        if (edit) {
            list.inkassoConfig.reload({
                callback: function() {
                    Ext.create('Shopware.apps.CrefoOrders.view.detail.Window', args);
                }
            });
        } else {
            Ext.create('Shopware.apps.CrefoOrders.view.detail.Window', args);
        }
    }
});
//{/block}
