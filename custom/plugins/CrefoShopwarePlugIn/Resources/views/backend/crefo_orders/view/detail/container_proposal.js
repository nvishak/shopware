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
//{block name="backend/crefo_orders/view/detail/container/proposal"}
Ext.define('Shopware.apps.CrefoOrders.view.detail.ContainerProposal',
    {
        extend: 'Ext.form.FieldContainer',
        autoShow: true,
        alias: 'widget.crefo-orders-detail-container-proposal',
        region: 'center',
        autoScroll: true,
        name: 'fieldContainerProposal',
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
        overflowX: 'hidden',
        snippets: {
            labels: {
                parts: {
                    'column': ':'
                },
                account: '{s name="crefo/orders/view/detail/container/proposal/labels/useraccount"}Mitgliedskennung{/s}',
                sentDate: '{s name="crefo/orders/view/detail/container/proposal/labels/sentDate"}Abgabedatum{/s}',
                documentNumber: '{s name="crefo/orders/view/detail/container/proposal/labels/documentNumber"}Inkasso-Aktennummer{/s}',
                debtor: '{s name="crefo/orders/view/detail/container/proposal/labels/debtor"}Schuldner{/s}',
                email: '{s name="crefo/orders/view/detail/container/proposal/labels/email"}Email-Adresse{/s}',
                creditor: '{s name="crefo/orders/view/detail/container/proposal/labels/creditor"}Gläubiger{/s}',
                collectionOrderType: '{s name="crefo/orders/view/detail/container/proposal/labels/collection_order_type"}Inkasso-Auftragsart{/s}',
                interestRate: {
                    title: '{s name="crefo/orders/view/detail/container/proposal/labels/interest_rate/title"}Zinssatz{/s}',
                    legal: '{s name="crefo/orders/view/detail/container/proposal/labels/interest_rate/legal"}Gesetzlich{/s}',
                    variableSpread: '{s name="crefo/orders/view/detail/container/proposal/labels/interest_rate/variable_spread"}Variabel-Aufschlag{/s}',
                    fix: '{s name="crefo/orders/view/detail/container/proposal/labels/interest_rate/fix"}Fest{/s}'
                },
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
                checkText: '{s name="crefo/orders/view/detail/container/proposal/labels/checkText"}Bitte prüfen und ergänzen Sie noch fehlende Informationen vor Abgabe des Inkasso-Auftrags.{/s}',
                checkErrorText: '{s name="crefo/orders/view/detail/container/proposal/labels/checkErrorText"}Creditreform hat eine Fehlermeldung geliefert. <br />Bitte prüfen und ergänzen Sie noch fehlende Informationen vor einer erneuten Abgabe des Inkasso-Auftrags.{/s}'
            },
            values: {
                proposal: '{s name="crefo/orders/view/detail/container/proposal/proposal"}VORSCHLAG{/s}',
                errorText: '{s name="crefo/orders/view/detail/container/proposal/errorText"}FEHLER{/s}',
                mr: '{s name="crefo/orders/view/detail/container/proposal/mr"}Herr{/s}',
                ms: '{s name="crefo/orders/view/detail/container/proposal/ms"}Frau{/s}',
                btnCalculate: '{s name="crefo/orders/view/detail/container/proposal/labels/btnCalculate"}Berechnen{/s}'
            },
            signs: {
                toEdit: '{s name="crefoorders/view/detail/container/proposal/editExclamation"}Bearbeitung erforderlich!{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        collectionValueTypes: {
            collectionOrderType: 0,
            collectionTurnoverType: 1,
            receivableReason: 2
        },
        listeners: {
            'afterrender': function() {
                var me = this,
                    formPnl = me.up('panel');
                formPnl.getForm().getFields().each(function(f) {
                    f.validate();
                });
                if (Ext.isDefined(me.displayErrors)) {
                    me.fireEvent('showErrors', me.displayErrors, formPnl.getForm());
                }
            }
        },
        /**
         * This function is called, when the component is initiated
         * It creates the columns of the grid
         */
        initComponent: function() {
            var me = this;
            me.registerEvents();
            me.data = me.crefoProposalRecord.data;
            me.collectionOrderTypeStore = Ext.create('Shopware.apps.CrefoConfiguration.store.inkasso.InkassoValues');
            me.collectionTurnoverTypeStore = Ext.create('Shopware.apps.CrefoConfiguration.store.inkasso.InkassoValues');
            me.collectionReceivableReasonStore = Ext.create('Shopware.apps.CrefoConfiguration.store.inkasso.InkassoValues');
            me.collectionOrderTypeStore.loadRecords(me.inkassoValuesStore.getRecordsOfTypeValue(me.collectionValueTypes.collectionOrderType));
            me.collectionTurnoverTypeStore.loadRecords(me.inkassoValuesStore.getRecordsOfTypeValue(me.collectionValueTypes.collectionTurnoverType));
            me.collectionReceivableReasonStore.loadRecords(me.inkassoValuesStore.getRecordsOfTypeValue(me.collectionValueTypes.receivableReason));

            Ext.applyIf(me, {
                items: me.getItems()
            });

            Ext.apply(Ext.form.field.VTypes, {
                interestRateProposal: function(val, field) {
                    var success = true;
                    //{literal}
                    var patt = /^\d{0,2}([,|.]\d{1,2})*$/;
                    //{/literal}
                    if (val.length > 5 || !patt.test(val)) {
                        success = false;
                    }
                    return success;
                },
                interestRateProposalText: this.snippets.validation.invalidValue
            });

            me.callParent(arguments);
        },

        registerEvents: function() {
            this.addEvents(
                /**
                 * Event will be fired when proposal errors exists
                 * displayed within the form field set.
                 *
                 * @event
                 * @param [Ext.form.Panel] - This component
                 */
                'showErrors'
            );
        },

        getItems: function() {
            var me = this;

            return [
                {
                    xtype: 'fieldset',
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
                            value: me.getCheckText()
                        },
                        {
                            xtype: 'displayfield',
                            name: 'useraccount',
                            itemId: 'useraccount',
                            id: 'useraccount',
                            fieldLabel: me.snippets.labels.account,
                            value: me.getReplacementText(),
                            fieldCls: 'crefo-proposal',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'sendDate',
                            itemId: 'sendDate',
                            id: 'sendDate',
                            fieldLabel: me.snippets.labels.sentDate,
                            value: me.getReplacementText(),
                            fieldCls: 'crefo-proposal',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'documentNumber',
                            itemId: 'documentNumber',
                            id: 'documentNumber',
                            fieldLabel: me.snippets.labels.documentNumber,
                            value: me.getReplacementText(),
                            fieldCls: 'crefo-proposal',
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
                    layout: 'vbox',
                    flex: 1,
                    align: 'center',
                    pack: 'start',
                    collapsible: false,
                    border: 0,
                    items: [
                        me.getDebtorType(),
                        {
                            xtype: 'displayfield',
                            name: 'debtorStreet',
                            itemId: 'debtorStreet',
                            id: 'debtorStreet',
                            flex: 1,
                            width: '100%',
                            labelSeparator: '',
                            fieldLabel: ' ',
                            labelWidth: '30%',
                            padding: '5 5 0 5',
                            submitValue: true,
                            value: me.getDebtorStreet()
                        },
                        {
                            xtype: 'container',
                            layout: 'hbox',
                            flex: 1,
                            width: '100%',
                            padding: '5 5 0 5',
                            //margin: '10 0 0 0',
                            items: [
                                {
                                    xtype: 'displayfield',
                                    name: 'emptySpace',
                                    width: '30%',
                                    value: ' '
                                },
                                {
                                    xtype: 'displayfield',
                                    name: 'debtorZipCode',
                                    itemId: 'debtorZipCode',
                                    id: 'debtorZipCode',
                                    padding: '0 3 0 0',
                                    submitValue: true,
                                    value: me.getDebtorZipCode()
                                }, {
                                    xtype: 'displayfield',
                                    name: 'debtorCity',
                                    itemId: 'debtorCity',
                                    id: 'debtorCity',
                                    submitValue: true,
                                    value: me.getDebtorCity()
                                }
                            ]
                        },
                        me.displayCountry(),
                        me.displayDebtorEmail(),
                        {
                            fieldLabel: me.snippets.labels.creditor,
                            xtype: 'combo',
                            name: 'creditor',
                            itemId: 'creditor',
                            id: 'creditor',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            editable: false,
                            emptyText: me.snippets.labels.creditor,
                            store: me.inkassoCreditorsStore,
                            queryMode: 'local',
                            displayField: 'creditorDisplay',
                            value: null,
                            valueField: 'useraccount',
                            listConfig: {
                                tpl: '<tpl for=".">' +
                                  '<tpl if="useraccount.length &gt; 0">' +
                                  '<div class="x-boundlist-item">{literal}{useraccount} - {name} {address}{/literal}</div>' +
                                  '<tpl else>' +
                                  '<div class="x-boundlist-item">&nbsp;</div>' +
                                  '</tpl>' +
                                  '</tpl>'
                            },
                            listeners: {
                                afterrender: function() {
                                    this.setValue(me.getUpdatedCreditor());
                                }
                            }
                        },
                        {
                            xtype: 'displayfield',
                            name: 'extraInfo',
                            padding: '10 5 0 5',
                            value: me.snippets.labels.extraInfo
                        },
                        {
                            fieldLabel: me.snippets.labels.collectionOrderType,
                            xtype: 'combo',
                            name: 'orderTypeKey',
                            itemId: 'orderTypeKey',
                            id: 'orderTypeKey',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.collectionOrderType,
                            store: me.collectionOrderTypeStore,
                            queryMode: 'local',
                            allowBlank: false,
                            forceSelection: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function() {
                                    this.setValue(me.crefoProposalRecord.get('orderTypeKey'));
                                }
                            }
                        },
                        {
                            xtype: 'fieldset',
                            title: me.snippets.labels.interestRate.title,
                            itemId: 'interestRateFieldSet',
                            id: 'interestRateFieldSet',
                            flex: 1,
                            width: '100%',
                            margin: '5 5 0 5',
                            items: [
                                {
                                    xtype: 'radiogroup',
                                    columns: 1,
                                    vertical: true,
                                    useDBValues: true,
                                    items: [
                                        {
                                            xtype: 'container',
                                            layout: 'column',
                                            defaults: {
                                                height: '28px'
                                            },
                                            items: [
                                                {
                                                    xtype: 'radio',
                                                    boxLabel: me.snippets.labels.interestRate.legal,
                                                    name: 'interestRateRadio',
                                                    itemId: 'interestRateRadioLegal',
                                                    id: 'interestRateRadioLegal',
                                                    inputValue: '1',
                                                    fieldStyle: {
                                                        verticalAlign: '-2px'
                                                    },
                                                    columnWidth: 1,
                                                    width: '100%',
                                                    listeners: {
                                                        afterrender: function () {
                                                            var radioInput = me.crefoProposalRecord.get('interestRateRadio');
                                                            if (!Ext.getCmp('interestRateFieldSet').down('radiogroup').useDBValues) {
                                                                this.setValue(true);
                                                            } else {
                                                                this.checked = false;
                                                                if (parseInt(radioInput) === 1) {
                                                                    this.setValue(true);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            ]
                                        },
                                        {
                                            xtype: 'container',
                                            layout: 'column',
                                            defaults: {
                                                height: '28px'
                                            },
                                            items: [
                                                {
                                                    xtype: 'radio',
                                                    boxLabel: me.snippets.labels.interestRate.variableSpread + me.snippets.labels.parts.column,
                                                    itemId: 'interestRateRadioSpread',
                                                    id: 'interestRateRadioSpread',
                                                    name: 'interestRateRadio',
                                                    columnWidth: 0.29,
                                                    inputValue: '2',
                                                    fieldStyle: {
                                                        verticalAlign: '-2px'
                                                    },
                                                    listeners: {
                                                        beforerender: function () {
                                                            var radioInput = me.crefoProposalRecord.get('interestRateRadio');
                                                            if (!Ext.getCmp('interestRateFieldSet').down('radiogroup').useDBValues) {
                                                                this.setValue(true);
                                                            } else {
                                                                this.checked = false;
                                                                if (parseInt(radioInput) === 2) {
                                                                    this.setValue(true);
                                                                }
                                                            }
                                                        },
                                                        change: function (cmp, newValue) {
                                                            var container = cmp.findParentByType('container');
                                                            if (newValue) {
                                                                container.addValueField();
                                                            } else {
                                                                container.removeValueField();
                                                            }
                                                        }
                                                    }
                                                },
                                                {
                                                    xtype: 'displayfield',
                                                    itemId: 'interestRateVariableDisplayField',
                                                    html: '&nbsp;',
                                                    columnWidth: 0.71,
                                                    padding: '3 0 0 0'
                                                }
                                            ],
                                            addValueField: function () {
                                                var container = this;
                                                container.remove(container.getComponent('interestRateVariableDisplayField'), true);
                                                container.add({
                                                    xtype: 'numberfield',
                                                    name: 'interestRateValue',
                                                    itemId: 'interestRateRadioSpreadText',
                                                    id: 'interestRateRadioSpreadText',
                                                    allowBlank: false,
                                                    blankText: me.snippets.validation.invalidValue,
                                                    decimalPrecision: 2,
                                                    minValue: 0,
                                                    //Remove spinner buttons, and arrow key and mouse wheel listeners
                                                    hideTrigger: true,
                                                    keyNavEnabled: false,
                                                    mouseWheelEnabled: false,
                                                    maxLength: 5,
                                                    maskRe: /[\d,.]/,
                                                    enforceMaxLength: true,
                                                    vtype: 'interestRateProposal',
                                                    validateOnChange: false,
                                                    validateOnBlur: false,
                                                    columnWidth: 0.7,
                                                    listeners: {
                                                        afterrender: function (cmp) {
                                                            var radioGroup = cmp.findParentByType('container').findParentByType('radiogroup');
                                                            if (radioGroup.useDBValues) {
                                                                radioGroup.useDBValues = false;
                                                                var radioValue = me.crefoProposalRecord.get('interestRateValue');
                                                                if (!Ext.isEmpty(radioValue)) {
                                                                    cmp.setValue(radioValue);
                                                                }
                                                            }
                                                        }
                                                    }
                                                });
                                                container.add({
                                                    xtype: 'displayfield',
                                                    itemId: 'interestRateVariableDisplayField',
                                                    value: '%',
                                                    columnWidth: 0.01,
                                                    padding: '3 0 0 0'
                                                });
                                            },
                                            removeValueField: function () {
                                                var container = this;
                                                container.remove(container.getComponent('interestRateVariableDisplayField'), true);
                                                container.remove(container.getComponent('interestRateRadioSpreadText'), true);
                                                container.add({
                                                    xtype: 'displayfield',
                                                    itemId: 'interestRateVariableDisplayField',
                                                    html: '&nbsp;',
                                                    columnWidth: 0.71,
                                                    padding: '3 0 0 0'
                                                });
                                            }
                                        },
                                        {
                                            xtype: 'container',
                                            layout: 'column',
                                            defaults: {
                                                height: '28px'
                                            },
                                            items: [
                                                {
                                                    xtype: 'radio',
                                                    boxLabel: me.snippets.labels.interestRate.fix + me.snippets.labels.parts.column,
                                                    itemId: 'interestRateRadioFix',
                                                    id: 'interestRateRadioFix',
                                                    name: 'interestRateRadio',
                                                    columnWidth: 0.29,
                                                    inputValue: '3',
                                                    fieldStyle: {
                                                        verticalAlign: '-2px'
                                                    },
                                                    listeners: {
                                                        beforerender: function () {
                                                            var radioInput = me.crefoProposalRecord.get('interestRateRadio');
                                                            if (!Ext.getCmp('interestRateFieldSet').down('radiogroup').useDBValues) {
                                                                this.setValue(true);
                                                            } else {
                                                                this.checked = false;
                                                                if (parseInt(radioInput) === 3) {
                                                                    this.setValue(true);
                                                                }
                                                            }
                                                        },
                                                        change: function (cmp, newValue) {
                                                            var container = cmp.findParentByType('container');
                                                            if (newValue) {
                                                                container.addValueField();
                                                            } else {
                                                                container.removeValueField();
                                                            }
                                                        }
                                                    }
                                                },
                                                {
                                                    xtype: 'displayfield',
                                                    itemId: 'interestRateFixDisplayField',
                                                    html: '&nbsp;',
                                                    columnWidth: 0.71,
                                                    padding: '3 0 0 0'
                                                }
                                            ],
                                            addValueField: function () {
                                                var container = this;
                                                container.remove(container.getComponent('interestRateFixDisplayField'), true);
                                                container.add({
                                                    xtype: 'numberfield',
                                                    itemId: 'interestRateRadioFixText',
                                                    id: 'interestRateRadioFixText',
                                                    name: 'interestRateValue',
                                                    allowBlank: false,
                                                    blankText: me.snippets.validation.invalidValue,
                                                    decimalPrecision: 2,
                                                    minValue: 0,
                                                    //Remove spinner buttons, and arrow key and mouse wheel listeners
                                                    hideTrigger: true,
                                                    keyNavEnabled: false,
                                                    mouseWheelEnabled: false,
                                                    maxLength: 5,
                                                    maskRe: /[\d,.]/,
                                                    enforceMaxLength: true,
                                                    vtype: 'interestRateProposal',
                                                    validateOnChange: false,
                                                    validateOnBlur: false,
                                                    columnWidth: 0.7,
                                                    listeners: {
                                                        afterrender: function (cmp) {
                                                            var radioGroup = cmp.findParentByType('container').findParentByType('radiogroup');
                                                            if (radioGroup.useDBValues) {
                                                                radioGroup.useDBValues = false;
                                                                var radioValue = me.crefoProposalRecord.get('interestRateValue');
                                                                if (!Ext.isEmpty(radioValue)) {
                                                                    cmp.setValue(radioValue);
                                                                }
                                                            }
                                                        }
                                                    }
                                                });
                                                container.add({
                                                    xtype: 'displayfield',
                                                    itemId: 'interestRateFixDisplayField',
                                                    value: '%',
                                                    columnWidth: 0.01,
                                                    padding: '3 0 0 0'
                                                });
                                            },
                                            removeValueField: function () {
                                                var container = this;
                                                container.remove(container.getComponent('interestRateFixDisplayField'), true);
                                                container.remove(container.getComponent('interestRateRadioFixText'), true);
                                                container.add({
                                                    xtype: 'displayfield',
                                                    itemId: 'interestRateFixDisplayField',
                                                    html: '&nbsp;',
                                                    columnWidth: 0.71,
                                                    padding: '3 0 0 0'
                                                });
                                            }
                                        }
                                    ]
                                } ]
                        }, {
                            fieldLabel: me.snippets.labels.customerReference,
                            xtype: 'textfield',
                            name: 'customerReference',
                            itemId: 'customerReference',
                            id: 'customerReference',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.customerReference,
                            allowBlank: true,
                            maxLength: 30,
                            maxLengthText: me.snippets.validation.invalidValue,
                            listeners: {
                                'afterrender': function() {
                                    var customerReference = me.crefoProposalRecord.get('customerReference');
                                    if (customerReference !== null && Ext.isDefined(customerReference)) {
                                        this.setValue(Ext.util.Format.trim(customerReference));
                                    }
                                }
                            }
                        }, {
                            xtype: 'textareafield',
                            //grow      : true,
                            name: 'remarks',
                            itemId: 'remarks',
                            id: 'remarks',
                            fieldLabel: me.snippets.labels.remarks,
                            emptyText: me.snippets.labels.remarks,
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '20 5 0 5',
                            maxLength: 500,
                            maxLengthText: me.snippets.validation.invalidValue,
                            validateOnChange: false,
                            validateOnBlur: false,
                            listeners: {
                                'afterrender': function() {
                                    this.setValue(me.crefoProposalRecord.get('remarks'));
                                }
                            }
                        },
                        {
                            fieldLabel: me.snippets.labels.turnoverType,
                            xtype: 'combo',
                            name: 'turnoverTypeKey',
                            itemId: 'turnoverTypeKey',
                            id: 'turnoverTypeKey',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.turnoverType,
                            store: me.collectionTurnoverTypeStore,
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: false,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function() {
                                    this.setValue(me.crefoProposalRecord.get('turnoverTypeKey'));
                                }
                            }
                        },
                        {
                            xtype: 'displayfield',
                            name: 'dateContract',
                            itemId: 'dateContract',
                            id: 'dateContract',
                            flex: 1,
                            submitValue: true,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            renderer: function(value, metaData, record) {
                                if (value === Ext.undefined) {
                                    return value;
                                }
                                return Ext.util.Format.date(value, 'Y-m-d');
                            },
                            fieldLabel: me.snippets.labels.contractDate,
                            value: me.getContractDate()
                        },
                        me.displayInvoiceDate(),
                        {
                            fieldLabel: me.snippets.labels.invoiceNumber,
                            xtype: 'textfield',
                            name: 'invoiceNumber',
                            itemId: 'invoiceNumber',
                            id: 'invoiceNumber',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.invoiceNumber,
                            allowBlank: true,
                            maxLength: 30,
                            maxLengthText: me.snippets.validation.invalidValue,
                            validateOnChange: false,
                            validateOnBlur: false,
                            listeners: {
                                'afterrender': function() {
                                    this.setValue(me.crefoProposalRecord.get('invoiceNumber'));
                                }
                            }
                        },
                        {
                            fieldLabel: me.snippets.labels.receivableReason,
                            xtype: 'combo',
                            name: 'receivableReasonKey',
                            itemId: 'receivableReasonKey',
                            id: 'receivableReasonKey',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.receivableReason,
                            store: me.collectionReceivableReasonStore,
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: false,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function() {
                                    this.setValue(me.crefoProposalRecord.get('receivableReasonKey'));
                                }
                            }
                        },
                        me.displayValutaDate(),
                        me.displayDueDate(),
                        {
                            xtype: 'container',
                            layout: 'hbox',
                            width: '100%',
                            padding: '10 5 10 5',
                            flex: 1,
                            //margin: '10 0 0 0',
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
                                    itemId: 'amount',
                                    id: 'amount',
                                    padding: '0 3 0 0',
                                    submitValue: true,
                                    value: me.getAmount(),
                                    renderer: function(value, metaData, record) {
                                        if (value === Ext.undefined) {
                                            return value;
                                        }
                                        return Ext.util.Format.currency(value);
                                    }
                                }, {
                                    xtype: 'displayfield',
                                    name: 'currency',
                                    itemId: 'currency',
                                    id: 'currency',
                                    submitValue: true,
                                    value: me.getCurrency()
                                }
                            ]
                        },
                        {
                            xtype: 'displayfield',
                            name: 'bottomCheckText',
                            value: me.getCheckText()
                        }

                    ]
                } ];
        },
        getCheckText: function() {
            var me = this;
            if (me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined) {
                return me.snippets.labels.checkText;
            }
            var status = me.crefoProposalRecord.get('proposalStatus');
            if (parseInt(status) === 0) {
                return me.snippets.labels.checkErrorText;
            } else {
                return me.snippets.labels.checkText;
            }
        },
        getReplacementText: function() {
            var me = this;
            if (me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined) {
                return me.snippets.values.proposal;
            }
            var status = me.crefoProposalRecord.get('proposalStatus');
            if (parseInt(status) === 0) {
                return me.snippets.values.errorText;
            } else {
                return me.snippets.values.proposal;
            }
        },
        getDebtorType: function() {
            var me = this,
                debtorHead = null;
            if (me.hasDebtorCompany()) {
                var textCompany = me.getDebtorCompany();
                var marginValues = '0 0 0 0';
                if (textCompany.length > 105 && textCompany.length < 210) {
                    marginValues = '0 0 15 0';
                } else if (textCompany.length >= 210) {
                    marginValues = '0 0 30 0';
                }
                debtorHead = {
                    xtype: 'displayfield',
                    name: 'debtorCompany',
                    itemId: 'debtorCompany',
                    id: 'debtorCompany',
                    submitValue: true,
                    flex: 1,
                    width: '100%',
                    labelWidth: '30%',
                    padding: '0 5 0 5',
                    margin: marginValues,
                    fieldLabel: me.snippets.labels.debtor,
                    value: textCompany,
                    fieldBodyCls: 'crefo-wrap-text'
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
                            itemId: 'debtorSalutation',
                            id: 'debtorSalutation',
                            padding: '0 3 0 0',
                            submitValue: true,
                            value: me.getDebtorSalutation()
                        },
                        {
                            xtype: 'displayfield',
                            name: 'debtorFirstName',
                            itemId: 'debtorFirstName',
                            id: 'debtorFirstName',
                            padding: '0 3 0 0',
                            submitValue: true,
                            value: me.getDebtorFirstName()
                        },
                        {
                            xtype: 'displayfield',
                            name: 'debtorLastName',
                            itemId: 'debtorLastName',
                            id: 'debtorLastName',
                            submitValue: true,
                            value: me.getDebtorLastName()
                        }
                    ]
                };
            }
            return debtorHead;
        },
        getDebtorCompany: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.companyName;
            }
            return value;
        },
        hasDebtorCompany: function() {
            var me = this,
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder,
                company = (proposalOrder !== null && !Ext.isEmpty(proposalOrder.companyName)) ? proposalOrder.companyName : '';
            return company !== '';
        },
        getDebtorSalutation: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                if (proposalOrder.salutation === 'mr' || proposalOrder.salutation === 'SA-1') {
                    value = me.snippets.values.mr;
                } else if (proposalOrder.salutation === 'ms' || proposalOrder.salutation === 'SA-2') {
                    value = me.snippets.values.ms;
                }
            }
            return value;
        },
        getDebtorFirstName: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.firstName;
            }
            return value;
        },
        getDebtorLastName: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.surname;
            }
            return value;
        },
        getDebtorStreet: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.street;
                if (!Ext.isEmpty(proposalOrder.houseNumber)) {
                    value += ' ' + proposalOrder.houseNumber;
                }
                if (!Ext.isEmpty(proposalOrder.houseNumberAffix)) {
                    value += proposalOrder.houseNumberAffix;
                }
            }
            return value;
        },
        getDebtorZipCode: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.postcode;
            }
            return value;
        },
        getDebtorCity: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.city;
            }
            return value;
        },
        getDebtorCountry: function(realValue) {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.country;
                if (!realValue) {
                    value = proposalOrder.countryIso;
                }
            }
            return value;
        },
        displayCountry: function() {
            var me = this,
                countryRawValue = me.getDebtorCountry(false);
            return {
                xtype: 'container',
                layout: 'hbox',
                width: '100%',
                padding: '10 5 10 5',
                flex: 1,
                items: [
                    {
                        xtype: 'displayfield',
                        name: 'emptySpace',
                        width: '30%',
                        value: ' '
                    }, {
                        xtype: 'displayfield',
                        name: 'debtorCountry',
                        itemId: 'debtorCountry',
                        id: 'debtorCountry',
                        submitValue: true,
                        value: me.getDebtorCountry(true),
                        rawValue: countryRawValue
                    }
                ]
            };
        },
        getDebtorEmail: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.email;
            }
            return value;
        },
        displayDebtorEmail: function() {
            var me = this,
                email = me.getDebtorEmail(),
                emailRow = {
                    xtype: 'container',
                    layout: 'hbox',
                    width: '100%',
                    padding: '10 5 10 5',
                    flex: 1,
                    items: [
                        {
                            xtype: 'label',
                            forId: 'debtorEmail',
                            text: me.snippets.labels.email + ':',
                            cls: 'x-form-item-label x-form-item-label-left',
                            width: '30%'
                        },
                        {
                            xtype: 'displayfield',
                            name: 'debtorEmail',
                            itemId: 'debtorEmail',
                            id: 'debtorEmail',
                            invalidText: me.snippets.validation.invalidValue,
                            submitValue: true,
                            value: email,
                            fieldBodyCls: 'crefo-wrap-text'
                        }
                    ]
                };
            if (email.length > 100) {
                emailRow.items.push({
                    xtype: 'displayfield',
                    name: 'editEmailSign',
                    value: Ext.String.format("&nbsp;<span data-qtip='[0]' class='sprite-exclamation' style='padding-left: 25px;'></span>", me.snippets.signs.toEdit)
                });
            }
            return emailRow;
        },
        displayInvoiceDate: function() {
            var me = this;
            return {
                xtype: 'container',
                layout: 'hbox',
                width: '100%',
                padding: '10 5 10 5',
                flex: 1,
                items: [
                    {
                        xtype: 'label',
                        forId: 'dateInvoice',
                        text: me.snippets.labels.invoiceDate + ':',
                        cls: 'x-form-item-label x-form-item-label-left',
                        flex: 3
                    },
                    {
                        xtype: 'datefield',
                        name: 'dateInvoice',
                        itemId: 'dateInvoice',
                        id: 'dateInvoice',
                        emptyText: me.snippets.labels.invoiceDate,
                        allowBlank: false,
                        format: 'Y-m-d',
                        blankText: me.snippets.validation.invalidValue,
                        invalidText: me.snippets.validation.invalidValue,
                        validateOnChange: false,
                        validateOnBlur: false,
                        flex: 7,
                        listeners: {
                            'afterrender': function() {
                                this.setValue(me.crefoProposalRecord.get('dateInvoice'));
                            }
                        }
                    }
                ]
            };
        },
        getContractDate: function() {
            var me = this;
            return me.listRecord.get('orderTime');
        },
        displayValutaDate: function() {
            var me = this;
            return {
                xtype: 'container',
                layout: 'hbox',
                width: '100%',
                padding: '10 5 10 5',
                flex: 1,
                items: [
                    {
                        xtype: 'label',
                        forId: 'valutaDate',
                        text: me.snippets.labels.valutaDate + ':',
                        cls: 'x-form-item-label x-form-item-label-left',
                        flex: 3
                    },
                    {
                        xtype: 'datefield',
                        name: 'valutaDate',
                        itemId: 'valutaDate',
                        id: 'valutaDate',
                        emptyText: me.snippets.labels.valutaDate,
                        allowBlank: false,
                        format: 'Y-m-d',
                        blankText: me.snippets.validation.invalidValue,
                        invalidText: me.snippets.validation.invalidValue,
                        validateOnChange: false,
                        validateOnBlur: false,
                        flex: 6.1,
                        listeners: {
                            'afterrender': function() {
                                if (me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined) {
                                    return null;
                                }
                                this.setValue(me.crefoProposalRecord.get('valutaDate'));
                            }
                        }
                    },
                    {
                        xtype: 'button',
                        text: me.snippets.values.btnCalculate,
                        scale: 'small',
                        flex: 0.9,
                        listeners: {
                            click: function() {
                                var cmp = Ext.getCmp('valutaDate'),
                                    invoiceCmp = Ext.getCmp('dateInvoice'),
                                    dateToSet = (Ext.isDate(invoiceCmp.getValue()) ? invoiceCmp.getValue() : new Date(Date.now()));
                                if (Ext.isEmpty(me.inkassoConfig) || Ext.isEmpty(me.inkassoConfig.first())) {
                                    cmp.setValue(dateToSet);
                                    return false;
                                }
                                var extraDate = me.inkassoConfig.first().get('valuta_date');
                                if (Ext.isNumber(extraDate)) {
                                    cmp.setValue(Ext.Date.add(dateToSet, Ext.Date.DAY, extraDate));
                                }
                            }
                        }
                    }
                ]
            };
        },
        displayDueDate: function() {
            var me = this;
            return {
                xtype: 'container',
                layout: 'hbox',
                width: '100%',
                padding: '10 5 10 5',
                flex: 1,
                items: [
                    {
                        xtype: 'label',
                        forId: 'dueDate',
                        text: me.snippets.labels.dueDate + ':',
                        cls: 'x-form-item-label x-form-item-label-left',
                        flex: 3
                    },
                    {
                        xtype: 'datefield',
                        name: 'dueDate',
                        itemId: 'dueDate',
                        id: 'dueDate',
                        emptyText: me.snippets.labels.dueDate,
                        allowBlank: false,
                        format: 'Y-m-d',
                        blankText: me.snippets.validation.invalidValue,
                        invalidText: me.snippets.validation.invalidValue,
                        validateOnChange: false,
                        validateOnBlur: false,
                        flex: 6.1,
                        listeners: {
                            'afterrender': function() {
                                if (me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined) {
                                    return null;
                                }
                                this.setValue(me.crefoProposalRecord.get('dueDate'));
                            }
                        }
                    },
                    {
                        xtype: 'button',
                        text: me.snippets.values.btnCalculate,
                        scale: 'small',
                        flex: 0.9,
                        listeners: {
                            click: function() {
                                var cmp = Ext.getCmp('dueDate'),
                                    invoiceCmp = Ext.getCmp('dateInvoice'),
                                    dateToSet = (Ext.isDate(invoiceCmp.getValue()) ? invoiceCmp.getValue() : new Date(Date.now()));
                                if (Ext.isEmpty(me.inkassoConfig) || Ext.isEmpty(me.inkassoConfig.first())) {
                                    cmp.setValue(dateToSet);
                                    return false;
                                }
                                var extraDate = me.inkassoConfig.first().get('due_date');
                                if (Ext.isNumber(extraDate)) {
                                    cmp.setValue(Ext.Date.add(dateToSet, Ext.Date.DAY, extraDate));
                                }
                            }
                        }
                    }
                ]
            };
        },
        setInterestRate: function(radio, value) {
            if (parseInt(radio) === 1) {
                Ext.ComponentQuery.query('#interestRateRadioLegal')[ 0 ].setValue(true);
                Ext.ComponentQuery.query('#interestRateRadioSpreadText')[ 0 ].setDisabled(true);
                Ext.ComponentQuery.query('#interestRateRadioFixText')[ 0 ].setDisabled(true);
            } else if (parseInt(radio) === 2) {
                Ext.ComponentQuery.query('#interestRateRadioSpreadText')[ 0 ].setDisabled(false);
                Ext.ComponentQuery.query('#interestRateRadioSpread')[ 0 ].setValue(true);
                Ext.ComponentQuery.query('#interestRateRadioSpreadText')[ 0 ].setValue(value);
            } else {
                Ext.ComponentQuery.query('#interestRateRadioFixText')[ 0 ].setDisabled(false);
                Ext.ComponentQuery.query('#interestRateRadioFix')[ 0 ].setValue(true);
                Ext.ComponentQuery.query('#interestRateRadioFixText')[ 0 ].setValue(value);
            }
        },
        getAmount: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.invoiceAmount;
            }
            return value;
        },
        getCurrency: function() {
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if (!Ext.isEmpty(proposalOrder)) {
                value = proposalOrder.currency;
            }
            return value;
        },
        getUpdatedCreditor: function() {
            var me = this,
                value = me.crefoProposalRecord.get('creditor');
            if (Ext.isEmpty(me.inkassoCreditorsStore.findRecord('useraccount', value))) {
                value = null;
            }
            return value;
        }
    });
//{/block}
