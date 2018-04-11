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
//{block name="backend/crefo_orders/controller/main"}
Ext.define('Shopware.apps.CrefoOrders.controller.Main', {
    extend: 'Enlight.app.Controller',
    mainWindow: null,
    snippets: {
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}',
        generalError: '{s name=crefo/validation/generalError}Allgemeiner Fehler{/s}',
        main: 'Main',
        validation: {
            error: '{s name="crefo/validation/checkFields"}Es ist ein Fehler aufgetreten (Plausibilitätsprüfung).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}',
            fault: {
                title: '{s name="crefo/validation/fault/title"}Es ist ein Fehler aufgetreten (validationfault).{/s}',
                contactText: '{s name="crefo/validation/fault/contactText"}Bitte kontaktieren Sie den Creditreform-Support.{/s}'
            }
        }
    },
    init: function() {
        var me = this;
        CrefoUtil.loadSnippets(me.snippets);
        Ext.require('Shopware.apps.CrefoConfiguration', function () {
            var listBatchStore = Ext.create('Shopware.apps.CrefoOrders.store.ListBatch'),
                inkConfig = Ext.create('Shopware.apps.CrefoConfiguration.store.Inkasso'),
                reportResultStore = me.subApplication.getStore('CrefoReportResults').load(),
                crefoProposalStore = Ext.create('Shopware.apps.CrefoOrders.store.CrefoProposal').load(),
                crefoOrdersStore = Ext.create('Shopware.apps.CrefoOrders.store.CrefoOrders').load(),
                listStore = me.subApplication.getStore('Order').load();
            inkConfig.load({
                callback: function(records) {
                    listBatchStore.load({
                        callback: function(records) {
                            var record = records[ 0 ],
                                stores = me.getAssociationStores(record);
                            //open the order listing window
                            var task = new Ext.util.DelayedTask(function() {
                                me.mainWindow = me.getView('main.Window').create({
                                    orderStatusStore: stores[ 'orderStatusStore' ],
                                    paymentStatusStore: stores[ 'paymentStatusStore' ],
                                    statusStore: stores[ 'statusStore' ],
                                    orderListingStore: stores[ 'orderListingStore' ],
                                    reportResultStore: reportResultStore,
                                    crefoProposalStore: crefoProposalStore,
                                    crefoOrdersStore: crefoOrdersStore,
                                    listStore: listStore,
                                    inkassoConfig: inkConfig
                                });
                            });
                            task.delay(200);
                        }
                    });
                }
            }
            );
        });
        me.callParent(arguments);
    },
    getAssociationStores: function(record) {
        var me = this,
            orderStatusStore = Ext.create('Shopware.apps.Base.store.OrderStatus'),
            paymentStatusStore = Ext.create('Shopware.apps.Base.store.PaymentStatus'),
            statusStore = Ext.create('Shopware.apps.Base.store.PositionStatus'),
            orderListingStore = me.subApplication.getStore('OrderListing');

        orderStatusStore.add(record.raw.orderStatus);
        paymentStatusStore.add(record.raw.paymentStatus);
        statusStore.add(record.raw.positionStatus);
        orderListingStore.add(record.raw.crefoOrderListing);

        var stores = [];
        stores[ 'orderStatusStore' ] = orderStatusStore;
        stores[ 'statusStore' ] = statusStore;
        stores[ 'paymentStatusStore' ] = paymentStatusStore;
        stores[ 'orderListingStore' ] = orderListingStore;

        return stores;
    },
    handleErrors: function(errors, formPnl) {
        var me = this;
        if (Ext.isArray(errors) === false && Ext.isObject(errors) === false) {
            return;
        }
        if (Ext.isDefined(errors.errorCode)) {
            var errorText = me.snippets.generalError;
            if (Ext.isEmpty(errors.errorText)) {
                errorText = Ext.isEmpty(errors.title) || errors.title === '' ? me.snippets.generalError : errors.title;
            } else {
                errorText = errors.errorText;
            }
            errorText += Ext.isDefined(errors.timestamp) ? '<br />' + errors.timestamp : '';
            CrefoUtil.showStickyMessage('', errorText);
            return;
        }
        if (Ext.isDefined(errors.validationfault)) {
            var validationFault = Ext.isDefined(errors.timestamp) ? errors.timestamp + '<br />' : '';
            validationFault += me.snippets.validation.fault.contactText;
            CrefoUtil.showStickyMessage(me.snippets.validation.fault.title, validationFault);
            return;
        }

        if (Ext.isDefined(errors.faults)) {
            var errorsText, index, title;
            errorsText = Ext.isDefined(errors.timestamp) ? errors.timestamp + '<br />' : '';
            for (index = 0; index < errors.faults.length; index++) {
                var fault = errors.faults[ index ],
                    faultErrorText;
                if (Ext.isObject(fault.errortext)) {
                    var textArray = CrefoUtil.getArrayFromObject(fault.errortext);
                    faultErrorText = textArray[ 0 ];
                } else {
                    faultErrorText = fault.errortext;
                }
                if (!Ext.isEmpty(fault.errorfield) && Ext.isDefined(formPnl) && (Ext.isDefined(Ext.getCmp(fault.errorfield)) || Ext.isDefined(Ext.ComponentQuery.query('#' + fault.errorfield)[ 0 ]))) {
                    var component = Ext.getCmp(fault.errorfield) || Ext.ComponentQuery.query('#' + fault.errorfield)[ 0 ];
                    if (!Ext.isEmpty(component)) { component.markInvalid(faultErrorText); }
                } else {
                    if (errorsText === undefined) errorsText = '';
                    errorsText += Ext.isDefined(fault.errorFieldLabel) ? fault.errorFieldLabel + ': ' : '';
                    errorsText += faultErrorText + '<br/>';
                }
            }
            if (Ext.isObject(errors.title)) {
                var titleArray = CrefoUtil.getArrayFromObject(errors.title);
                title = titleArray[ 0 ];
            } else {
                title = errors.title;
            }
            CrefoUtil.showStickyMessage(title, errorsText);
        }
    }
});
//{/block}
