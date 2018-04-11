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
//{block name="backend/crefo_orders/view/detail/container/document"}
Ext.define('Shopware.apps.CrefoOrders.view.detail.ContainerDocument',
    {
        extend: 'Ext.form.FieldContainer',
        autoShow: true,
        alias: 'widget.crefo-orders-detail-container-document',
        id: 'crefo-orders-detail-container-document',
        region: 'center',
        autoScroll: true,
        name: 'fieldContainerDocument',
        border: 0,
        ui: 'shopware-ui',
        layout: 'anchor',
        defaults: {
            labelWidth: 210,
            labelStyle: 'font-weight: 700;',
            anchor: '100%'
        },
        hidden: false,
        minWidth: 155,
        //overflowX: 'hidden',
        snippets: {
            labels: {
                account: '{s name="crefo/orders/view/detail/container/proposal/labels/useraccount"}Mitgliedskennung{/s}',
                sentDate: '{s name="crefo/orders/view/detail/container/proposal/labels/sentDate"}Abgabedatum{/s}',
                documentNumber: '{s name="crefo/orders/view/detail/container/proposal/labels/documentNumber"}Inkasso-Aktennummer{/s}',
                debtor: '{s name="crefo/orders/view/detail/container/proposal/labels/debtor"}Schuldner{/s}',
                email: '{s name="crefo/orders/view/detail/container/proposal/labels/email"}Email-Adresse{/s}',
                creditor: '{s name="crefo/orders/view/detail/container/proposal/labels/creditor"}Gläubiger{/s}',
                collectionOrderType: '{s name="crefo/orders/view/detail/container/proposal/labels/collection_order_type"}Inkasso-Auftragsart{/s}',
                interestRate: '{s name="crefo/orders/view/detail/container/proposal/labels/interest_rate/title"}Zinssatz{/s}',
                customerReference: '{s name="crefo/orders/view/detail/container/proposal/labels/customer_reference"}Geschäftszeichen{/s}',
                remarks: '{s name="crefo/orders/view/detail/container/proposal/labels/remarks"}Anmerkungen{/s}',
                turnoverType: '{s name="crefo/orders/view/detail/container/proposal/labels/turnover_type"}Inkasso-Umsatzart{/s}',
                contractDate: '{s name="crefo/orders/view/detail/container/proposal/labels/contractDate"}Vertragsdatum{/s}',
                invoiceDate: '{s name="crefo/orders/view/detail/container/proposal/labels/invoiceDate"}Rechnungsdatum{/s}',
                invoiceNumber: '{s name="crefo/orders/view/detail/container/proposal/labels/invoiceNumber"}Rechnungsnummer{/s}',
                receivableReason: '{s name="crefo/orders/view/detail/container/proposal/labels/receivable_reason"}Forderungsgrund{/s}',
                valutaDate: '{s name="crefo/orders/view/detail/container/proposal/labels/valuta_date"}Valuta Datum{/s}',
                dueDate: '{s name="crefo/orders/view/detail/container/proposal/labels/due_date"}Fälligkeitsdatum{/s}',
                amount: '{s name="crefo/orders/view/detail/container/proposal/labels/amount"}Betrag{/s}',
                extraInfo: '{s name="crefo/orders/view/detail/container/proposal/labels/extraInfo"}Weitere Informationen{/s}',
                checkText: '{s name="crefo/orders/view/detail/container/document/labels/checkText"}Diese Informationen wurden im initialen Inkasso-Auftrag an Creditreform übertragen.<br />Für aktuelle Informationen dazu wenden Sie Sich bitte an Ihren zuständigen Verein Creditreform.{/s}'
            },
            values: {
                mr: '{s name="crefo/orders/view/detail/container/proposal/mr"}Herr{/s}',
                ms: '{s name="crefo/orders/view/detail/container/proposal/ms"}Frau{/s}'
            }
        },
        /**
         * This function is called, when the component is initiated
         * It creates the columns of the grid
         */
        initComponent: function() {
            var me = this;
            me.data = me.record.data;
            Ext.applyIf(me, {
                items: me.getItems()
            });
            me.callParent(arguments);
        },
        getItems: function() {
            var me = this;

            return [
                {
                    xtype: 'fieldset',
                    id: 'fieldSetHeader',
                    title: '',
                    layout: 'vbox',
                    flex: 1,
                    align: 'center',
                    pack: 'start',
                    collapsible: false,
                    border: 0,
                    items: [
                        {
                            xtype: 'displayfield',
                            name: 'topCheckText',
                            value: me.snippets.labels.checkText
                        },
                        {
                            xtype: 'displayfield',
                            name: 'useraccount',
                            id: 'useraccount',
                            fieldLabel: me.snippets.labels.account,
                            value: me.data.userAccountNumber,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'sendDate',
                            id: 'sendDate',
                            fieldLabel: me.snippets.labels.sentDate,
                            value: me.data.sentDate,
                            renderer: function(value, metaData, record) {
                                if (value === Ext.undefined) {
                                    return value;
                                }
                                return Ext.util.Format.date(value, 'Y-m-d');
                            },
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'documentNumber',
                            id: 'documentNumber',
                            fieldLabel: me.snippets.labels.documentNumber,
                            value: me.data.documentNumber,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        }
                    ]
                },
                {
                    xtype: 'fieldset',
                    title: '',
                    id: 'fieldSetBody',
                    layout: 'vbox',
                    flex: 1,
                    align: 'center',
                    pack: 'start',
                    collapsible: false,
                    border: 0,
                    items: [
                        me.getDebtorType(),
                        {
                            xtype: 'container',
                            layout: 'hbox',
                            flex: 1,
                            width: '100%',
                            padding: '5 5 0 5',
                            items: [
                                {
                                    xtype: 'displayfield',
                                    name: 'emptySpace',
                                    width: '30%',
                                    value: ' '
                                },
                                {
                                    xtype: 'displayfield',
                                    name: 'debtorStreet',
                                    id: 'debtorStreet',
                                    value: me.data.street
                                }
                            ]
                        },
                        {
                            xtype: 'container',
                            layout: 'hbox',
                            flex: 1,
                            width: '100%',
                            padding: '5 5 0 5',
                            items: [
                                {
                                    xtype: 'displayfield',
                                    name: 'emptySpace',
                                    width: '30%',
                                    value: ' '
                                },
                                {
                                    xtype: 'displayfield',
                                    name: 'debtorZipCity',
                                    id: 'debtorZipCity',
                                    value: me.data.zipCode + ' ' + me.data.city
                                }
                            ]
                        },
                        {
                            xtype: 'container',
                            layout: 'hbox',
                            flex: 1,
                            width: '100%',
                            padding: '5 5 0 5',
                            items: [
                                {
                                    xtype: 'displayfield',
                                    name: 'emptySpace',
                                    width: '30%',
                                    value: ' '
                                },
                                {
                                    xtype: 'displayfield',
                                    name: 'debtorCountry',
                                    id: 'debtorCountry',
                                    value: me.data.country
                                }
                            ]
                        },
                        {
                            xtype: 'displayfield',
                            name: 'debtorEmail',
                            id: 'debtorEmail',
                            fieldLabel: me.snippets.labels.email,
                            value: me.data.email,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'creditor',
                            id: 'creditor',
                            fieldLabel: me.snippets.labels.creditor,
                            value: me.data.creditor,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'extraInfo',
                            value: me.snippets.labels.extraInfo
                        },
                        {
                            xtype: 'displayfield',
                            name: 'orderType',
                            id: 'orderType',
                            fieldLabel: me.snippets.labels.collectionOrderType,
                            value: me.data.orderType,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        me.displayInterestRate(),
                        {
                            xtype: 'displayfield',
                            name: 'customerReference',
                            id: 'customerReference',
                            fieldLabel: me.snippets.labels.customerReference,
                            value: me.data.customerReference,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'remarks',
                            id: 'remarks',
                            fieldLabel: me.snippets.labels.remarks,
                            value: me.data.remarks,
                            flex: 1,
                            width: '100%',
                            fieldBodyCls: 'crefo-wrap-text',
                            labelWidth: '30%',
                            padding: '5 5 0 5',
                            listeners: {
                                'beforerender': function(cmp, eOpts) {
                                    //15 - letter height; 76 - width of text in cmp
                                    var len = Math.ceil(me.data.remarks.length / 76);
                                    cmp.height = 15 * (len === 0 ? 1.2 : len);
                                }
                            }
                        },
                        {
                            xtype: 'displayfield',
                            name: 'turnoverType',
                            id: 'turnoverType',
                            fieldLabel: me.snippets.labels.turnoverType,
                            value: me.data.turnoverType,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'dateContract',
                            id: 'dateContract',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5',
                            renderer: function(value, metaData, record) {
                                if (value === Ext.undefined) {
                                    return value;
                                }
                                return Ext.util.Format.date(value, 'Y-m-d');
                            },
                            fieldLabel: me.snippets.labels.contractDate,
                            value: me.data.dateContract
                        },
                        {
                            xtype: 'displayfield',
                            name: 'dateInvoice',
                            id: 'dateInvoice',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5',
                            renderer: function(value, metaData, record) {
                                if (value === Ext.undefined) {
                                    return value;
                                }
                                return Ext.util.Format.date(value, 'Y-m-d');
                            },
                            fieldLabel: me.snippets.labels.invoiceDate,
                            value: me.data.dateInvoice
                        },
                        {
                            xtype: 'displayfield',
                            name: 'invoiceNumber',
                            id: 'invoiceNumber',
                            fieldLabel: me.snippets.labels.invoiceNumber,
                            value: me.data.invoiceNumber,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'receivableReason',
                            id: 'receivableReason',
                            fieldLabel: me.snippets.labels.receivableReason,
                            value: me.data.receivableReason,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'valutaDate',
                            id: 'valutaDate',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5',
                            renderer: function(value, metaData, record) {
                                if (value === Ext.undefined) {
                                    return value;
                                }
                                return Ext.util.Format.date(value, 'Y-m-d');
                            },
                            fieldLabel: me.snippets.labels.valutaDate,
                            value: me.data.valutaDate
                        },
                        {
                            xtype: 'displayfield',
                            name: 'dueDate',
                            id: 'dueDate',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5',
                            renderer: function(value, metaData, record) {
                                if (value === Ext.undefined) {
                                    return value;
                                }
                                return Ext.util.Format.date(value, 'Y-m-d');
                            },
                            fieldLabel: me.snippets.labels.dueDate,
                            value: me.data.dueDate
                        },
                        {
                            xtype: 'container',
                            layout: 'hbox',
                            width: '100%',
                            padding: '10 5 10 5',
                            flex: 1,
                            items: [
                                {
                                    xtype: 'label',
                                    forId: 'amount',
                                    text: me.snippets.labels.amount + ':',
                                    cls: 'x-form-item-label x-form-item-label-left',
                                    width: '30%'
                                },
                                {
                                    xtype: 'displayfield',
                                    name: 'amount',
                                    id: 'amount',
                                    value: me.data.amount,
                                    renderer: function(value, metaData, record) {
                                        if (value === Ext.undefined) {
                                            return value;
                                        }
                                        return Ext.util.Format.currency(value);
                                    }
                                }, {
                                    xtype: 'displayfield',
                                    name: 'currency',
                                    id: 'currency',
                                    value: me.data.currency
                                }
                            ]
                        },
                        {
                            xtype: 'displayfield',
                            name: 'bottomCheckText',
                            value: me.snippets.labels.checkText
                        }

                    ]
                } ];
        },
        getDebtorType: function() {
            var me = this,
                debtorHead = null,
                testVar = null;
            if (me.data.companyName !== null && Ext.isDefined(me.data.companyName)) {
                debtorHead = {
                    xtype: 'displayfield',
                    name: 'debtorCompany',
                    id: 'debtorCompany',
                    flex: 1,
                    width: '100%',
                    labelWidth: '30%',
                    padding: '0 5 0 5',
                    fieldLabel: me.snippets.labels.debtor,
                    value: me.data.companyName,
                    fieldBodyCls: 'crefo-wrap-text',
                    listeners: {
                        'beforerender': function(cmp, eOpts) {
                            //15 - letter height; 76 - width of text in cmp
                            cmp.height = 15 * Math.ceil(me.data.companyName.length / 76);
                        }
                    }
                };
            } else {
                debtorHead = {
                    xtype: 'container',
                    layout: 'hbox',
                    flex: 1,
                    width: '100%',
                    padding: '0 5 0 5',
                    items: [
                        {
                            xtype: 'label',
                            forId: 'debtorSalutation',
                            text: me.snippets.labels.debtor + ':',
                            cls: 'x-form-item-label x-form-item-label-left',
                            width: '30%'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'debtorSalutation',
                            id: 'debtorSalutation',
                            value: me.data.salutation
                        }, {
                            xtype: 'displayfield',
                            name: 'debtorFirstName',
                            id: 'debtorFirstName',
                            value: me.data.firstName
                        }, {
                            xtype: 'displayfield',
                            name: 'debtorLastName',
                            id: 'debtorLastName',
                            value: me.data.lastName
                        }
                    ]
                };
            }
            return debtorHead;
        },
        displayInterestRate: function() {
            var me = this,
                interestRateDisplay = {
                    xtype: 'container',
                    layout: 'hbox',
                    width: '100%',
                    padding: '10 5 10 5',
                    flex: 1,
                    items: [
                        {
                            xtype: 'label',
                            forId: 'amount',
                            text: me.snippets.labels.interestRate + ':',
                            cls: 'x-form-item-label x-form-item-label-left',
                            width: '30%'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'interestRate',
                            id: 'interestRate',
                            value: me.data.interestRate
                        }
                    ]
                };
            if (me.data.interestRateValue !== null && me.data.interestRateValue !== Ext.undefined) {
                var interestRateValueDisplay = {
                    xtype: 'displayfield',
                    name: 'interestRateValue',
                    id: 'interestRateValue',
                    value: me.data.interestRateValue,
                    renderer: function(value, metaData, record) {
                        if (value === Ext.undefined) {
                            return value;
                        }
                        return Ext.util.Format.currency(value) + ' %';
                    }
                };
                interestRateDisplay.items.push(interestRateValueDisplay);
            }
            return interestRateDisplay;
        }
    });
//{/block}
