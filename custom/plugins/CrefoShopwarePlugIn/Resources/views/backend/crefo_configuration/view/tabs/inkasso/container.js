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
//{block name="backend/crefo_configuration/view/tabs/inkasso/container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Container',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-inkasso-container',
        region: 'center',
        autoScroll: true,
        name: 'inkassoContainer',
        id: 'inkassoContainer',
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
        useDefaults: true,
        snippets: {
            labels: {
                parts: {
                    'column': ':'
                },
                creditor: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/creditor"}Gläubiger{/s}',
                collectionOrderType: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/collection_order_type"}Inkasso-Auftragsart{/s}',
                interestRate: {
                    title: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/interest_rate/title"}Zinssatz{/s}',
                    legal: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/interest_rate/legal"}Gesetzlich{/s}',
                    variableSpread: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/interest_rate/variable_spread"}Variabel-Aufschlag{/s}',
                    fix: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/interest_rate/fix"}Fest{/s}'
                },
                customerReference: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/customer_reference"}Geschäftszeichen{/s}',
                customerReferenceStore: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/customer_reference_store"}Kundennummer - Bestellnummer{/s}',
                turnoverType: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/turnover_type"}Inkasso-Umsatzart{/s}',
                receivableReason: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/receivable_reason"}Forderungsgrund{/s}',
                valutaDate: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/valuta_date"}Valuta Datum{/s}',
                dueDate: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/due_date"}Fälligkeitsdatum{/s}',
                invoiceDateText: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/invoice_date_text"}Rechnungsdatum +&nbsp;{/s}',
                days: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/days"}Tage{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        initComponent: function() {
            var me = this;
            me.items = me.getItems();
            Ext.apply(Ext.form.field.VTypes, {
                inkassoConfigDatum: function(val, field) {
                    var success = true;
                    //{literal}
                    var patt = /^\d{0,3}$/;
                    //{/literal}
                    if (!patt.test(val)) {
                        success = false;
                    }
                    return success;
                },
                inkassoConfigDatumText: this.snippets.validation.invalidValue,
                interestRateInkasso: function(val, field) {
                    var success = true;
                    //{literal}
                    var patt = /^\d{0,2}([,|.]\d{1,2})*$/;
                    //{/literal}
                    if (val.length > 5 || !patt.test(val)) {
                        success = false;
                    }
                    return success;
                },
                interestRateInkassoText: this.snippets.validation.invalidValue
            });

            me.callParent(arguments);
        },
        getItems: function() {
            var me = this;

            return [
                {
                    xtype: 'container',
                    layout: 'vbox',
                    flex: 1,
                    align: 'center',
                    pack: 'start',
                    border: 0,
                    items: [
                        {
                            fieldLabel: me.snippets.labels.creditor,
                            xtype: 'combo',
                            name: 'creditor',
                            id: 'inkasso_creditor',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '20 5 0 5',
                            editable: false,
                            emptyText: me.snippets.labels.creditor,
                            store: me.parentPanel.inkassoCreditorsStore,
                            queryMode: 'local',
                            displayField: 'creditorDisplay',
                            value: '',
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
                                    if (me.useDefaults) {
                                        this.setValue(null);
                                    } else {
                                        var config = me.parentPanel.inkassoStore.first();
                                        if (!Ext.isEmpty(config) && !Ext.isEmpty(config.get('creditor')) &&
                                          !Ext.isEmpty(me.parentPanel.inkassoCreditorsStore.findRecord('useraccount', config.get('creditor')))) {
                                            this.setValue(config.get('creditor'));
                                        } else {
                                            this.setValue(null);
                                        }
                                    }
                                }
                            }
                        },
                        {
                            fieldLabel: me.snippets.labels.collectionOrderType,
                            xtype: 'combo',
                            name: 'order_type',
                            id: 'inkasso_order_type',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.collectionOrderType,
                            store: me.parentPanel.collectionOrderTypeStore,
                            queryMode: 'local',
                            allowBlank: false,
                            forceSelection: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function() {
                                    if (me.useDefaults) {
                                        this.setValue(me.parentPanel.defaults.filterValues.collectionOrderType);
                                    } else {
                                        var config = me.parentPanel.inkassoStore.first();
                                        if (!Ext.isEmpty(config)) {
                                            this.setValue(config.get('order_type'));
                                        }
                                    }
                                }
                            }
                        },
                        {
                            xtype: 'fieldset',
                            title: me.snippets.labels.interestRate.title,
                            flex: 1,
                            width: '100%',
                            margin: '5 5 0 5',
                            items: [
                                {
                                    xtype: 'radiogroup',
                                    columns: 1,
                                    vertical: true,
                                    itemId: 'collectionInterestRateRadioGroup',
                                    useDBValues: !me.useDefaults,
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
                                                    name: 'interest_rate_radio',
                                                    id: 'inkasso_interest_rate_legal',
                                                    fieldStyle: {
                                                        verticalAlign: '-2px'
                                                    },
                                                    inputValue: '1',
                                                    width: '100%',
                                                    columnWidth: 1,
                                                    listeners: {
                                                        afterrender: function () {
                                                            if (me.useDefaults) {
                                                                this.setValue(true);
                                                            } else {
                                                                this.checked = false;
                                                                var config = me.parentPanel.inkassoStore.first();
                                                                if (!Ext.isEmpty(config) && parseInt(config.get('interest_rate_radio')) === 1) {
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
                                                    id: 'inkasso_interest_rate_variable_spread',
                                                    name: 'interest_rate_radio',
                                                    columnWidth: 0.29,
                                                    inputValue: '2',
                                                    fieldStyle: {
                                                        verticalAlign: '-2px'
                                                    },
                                                    listeners: {
                                                        beforerender: function () {
                                                            if (me.useDefaults) {
                                                                this.setValue(false);
                                                            } else {
                                                                this.checked = false;
                                                                var config = me.parentPanel.inkassoStore.first();
                                                                if (!Ext.isEmpty(config) && parseInt(config.get('interest_rate_radio')) === 2) {
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
                                                }, {
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
                                                    name: 'interest_rate_value',
                                                    itemId: 'inkasso_interest_rate_variable_spread_text',
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
                                                    vtype: 'interestRateInkasso',
                                                    columnWidth: 0.7,
                                                    listeners: {
                                                        afterrender: function (cmp) {
                                                            var radioGroup = cmp.findParentByType('container').findParentByType('radiogroup');
                                                            if (!me.useDefaults && radioGroup.useDBValues) {
                                                                radioGroup.useDBValues = false;
                                                                var config = me.parentPanel.inkassoStore.first();
                                                                if (!Ext.isEmpty(config) && !Ext.isEmpty(config.get('interest_rate_value'))) {
                                                                    cmp.setValue(config.get('interest_rate_value'));
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
                                                container.remove(container.getComponent('inkasso_interest_rate_variable_spread_text'), true);
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
                                                    id: 'inkasso_interest_rate_fix',
                                                    name: 'interest_rate_radio',
                                                    columnWidth: 0.29,
                                                    fieldStyle: {
                                                        verticalAlign: '-2px'
                                                    },
                                                    inputValue: '3',
                                                    listeners: {
                                                        beforerender: function () {
                                                            if (me.useDefaults) {
                                                                this.setValue(false);
                                                            } else {
                                                                this.checked = false;
                                                                var config = me.parentPanel.inkassoStore.first();
                                                                if (!Ext.isEmpty(config) && parseInt(config.get('interest_rate_radio')) === 3) {
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
                                                }, {
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
                                                    itemId: 'inkasso_interest_rate_fix_text',
                                                    name: 'interest_rate_value',
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
                                                    vtype: 'interestRateInkasso',
                                                    columnWidth: 0.7,
                                                    listeners: {
                                                        afterrender: function (cmp) {
                                                            var radioGroup = cmp.findParentByType('container').findParentByType('radiogroup');
                                                            if (!me.useDefaults && radioGroup.useDBValues) {
                                                                radioGroup.useDBValues = false;
                                                                var config = me.parentPanel.inkassoStore.first();
                                                                if (!Ext.isEmpty(config) && !Ext.isEmpty(config.get('interest_rate_value'))) {
                                                                    cmp.setValue(config.get('interest_rate_value'));
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
                                                container.remove(container.getComponent('inkasso_interest_rate_fix_text'), true);
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
                            xtype: 'combo',
                            name: 'customer_reference',
                            id: 'inkasso_customer_reference',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.customerReference,
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: true,
                            editable: false,
                            store: me.getCustomerReferenceStore(),
                            displayField: 'label',
                            valueField: 'id',
                            listeners: {
                                afterrender: function() {
                                    if (me.useDefaults) {
                                        this.setValue(me.parentPanel.defaults.customerReferenceId);
                                    } else {
                                        var config = me.parentPanel.inkassoStore.first();
                                        if (!Ext.isEmpty(config)) {
                                            this.setValue(parseInt(config.get('customer_reference')));
                                        }
                                    }
                                },
                                /**
                                 * Prevents "&nbsp;" text from being displayed on selection
                                 */
                                select: function(combo) {
                                    if (Ext.isEmpty(combo.getValue()) || combo.getRawValue() === '&nbsp;') {
                                        combo.setValue(null);
                                    }
                                }

                            }
                        }, {
                            fieldLabel: me.snippets.labels.turnoverType,
                            xtype: 'combo',
                            name: 'turnover_type',
                            id: 'inkasso_turnover_type',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.turnoverType,
                            store: me.parentPanel.collectionTurnoverTypeStore,
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: false,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function() {
                                    if (me.useDefaults) {
                                        this.setValue(me.parentPanel.defaults.filterValues.turnoverType);
                                    } else {
                                        var config = me.parentPanel.inkassoStore.first();
                                        if (!Ext.isEmpty(config)) {
                                            this.setValue(config.get('turnover_type'));
                                        }
                                    }
                                }
                            }
                        }, {
                            fieldLabel: me.snippets.labels.receivableReason,
                            xtype: 'combo',
                            name: 'receivable_reason',
                            id: 'inkasso_receivable_reason',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.receivableReason,
                            store: me.parentPanel.collectionReceivableReasonsStore,
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: false,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function() {
                                    if (me.useDefaults) {
                                        this.setValue(me.parentPanel.defaults.filterValues.receivableReason);
                                    } else {
                                        var config = me.parentPanel.inkassoStore.first();
                                        if (!Ext.isEmpty(config)) {
                                            this.setValue(config.get('receivable_reason'));
                                        }
                                    }
                                }
                            }
                        },
                        {
                            xtype: 'container',
                            layout: 'hbox',
                            width: '100%',
                            margin: '10 0 0 0',
                            padding: '10 5 0 5',
                            items: [
                                {
                                    xtype: 'displayfield',
                                    fieldLabel: me.snippets.labels.valutaDate,
                                    value: '',
                                    flex: 0.9
                                },
                                {
                                    xtype: 'displayfield',
                                    value: me.snippets.labels.invoiceDateText,
                                    flex: 0.5
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'valuta_date',
                                    id: 'inkasso_valuta_date',
                                    blankText: me.snippets.validation.invalidValue,
                                    emptyText: me.snippets.labels.days,
                                    decimalPrecision: 0,
                                    minValue: 0,
                                    maxValue: 999,
                                    //Remove spinner buttons, and arrow key and mouse wheel listeners
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false,
                                    enforceMaxLength: true,
                                    allowBlank: false,
                                    maxLength: 3,
                                    maskRe: /\d/,
                                    vtype: 'inkassoConfigDatum',
                                    flex: 1.4,
                                    listeners: {
                                        afterrender: function() {
                                            if (me.useDefaults) {
                                                this.setValue(me.parentPanel.defaults.dateFields);
                                            } else {
                                                var config = me.parentPanel.inkassoStore.first();
                                                if (!Ext.isEmpty(config)) {
                                                    this.setValue(config.get('valuta_date'));
                                                }
                                            }
                                        }
                                    }
                                }, {
                                    xtype: 'displayfield',
                                    value: '&nbsp;' + me.snippets.labels.days,
                                    flex: 0.2
                                }
                            ]
                        }, {
                            xtype: 'container',
                            layout: 'hbox',
                            width: '100%',
                            margin: '10 0 0 0',
                            padding: '10 5 0 5',
                            items: [
                                {
                                    xtype: 'displayfield',
                                    fieldLabel: me.snippets.labels.dueDate,
                                    value: '',
                                    flex: 0.9
                                },
                                {
                                    xtype: 'displayfield',
                                    value: me.snippets.labels.invoiceDateText,
                                    flex: 0.5
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'due_date',
                                    id: 'inkasso_due_date',
                                    blankText: me.snippets.validation.invalidValue,
                                    emptyText: me.snippets.labels.days,
                                    decimalPrecision: 0,
                                    minValue: 0,
                                    maxValue: 999,
                                    //Remove spinner buttons, and arrow key and mouse wheel listeners
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false,
                                    enforceMaxLength: true,
                                    allowBlank: false,
                                    maxLength: 3,
                                    maskRe: /\d/,
                                    vtype: 'inkassoConfigDatum',
                                    flex: 1.4,
                                    listeners: {
                                        afterrender: function() {
                                            if (me.useDefaults) {
                                                this.setValue(me.parentPanel.defaults.dateFields);
                                            } else {
                                                var config = me.parentPanel.inkassoStore.first();
                                                if (!Ext.isEmpty(config)) {
                                                    this.setValue(config.get('due_date'));
                                                }
                                            }
                                        }
                                    }
                                }, {
                                    xtype: 'displayfield',
                                    value: '&nbsp;' + me.snippets.labels.days,
                                    flex: 0.2
                                }
                            ]
                        }
                    ]
                } ];
        },
        getCustomerReferenceStore: function() {
            var me = this;
            return new Ext.data.SimpleStore({
                fields: [ 'id', 'label' ],
                data: [
                    [ 0, '&nbsp;' ],
                    [ 1, me.snippets.labels.customerReferenceStore ]
                ]
            });
        }
    });
//{/block}
