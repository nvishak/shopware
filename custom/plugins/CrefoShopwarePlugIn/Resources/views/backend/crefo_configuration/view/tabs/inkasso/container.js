/*
 * Copyright (c) 2016 Verband der Vereine Creditreform.
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
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Container',
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
            },
            filterValues: {
                collectionOrderType: 'CCORTY',
                turnoverType: 'CCTOTY',
                receivableReason: 'CCRCRS'
            }
        },
        initComponent: function(){
            var me = this;
            me.items = me.getItems();

            // Add own vtypes to validate password fields
            Ext.apply( Ext.form.field.VTypes, {
                inkassoConfigDatum: function( val, field ){
                    var success = true;
                    //{literal}
                    var patt = /^\d{0,3}$/;
                    //{/literal}
                    if( !patt.test( val ) ) {
                        success = false;
                    }
                    return success;
                },
                inkassoConfigDatumText: this.snippets.validation.invalidValue,
                interestRateInkasso: function( val, field ){
                    var success = true;
                    //{literal}
                    var patt = /^\d{0,2}([,|.]\d{1,2})*$/;
                    //{/literal}
                    if( val.length > 5 || !patt.test( val ) ) {
                        success = false;
                    }
                    return success;
                },
                interestRateInkassoText: this.snippets.validation.invalidValue
            } );

            me.callParent( arguments );
        },
        getItems: function(){
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
                            name: 'inkasso_creditor',
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
                                tpl: '<tpl for=".">'
                                + '<div class="x-boundlist-item">{literal}{useraccount} - {name} {address}{/literal}</div>'
                                + '</tpl>'
                            }
                        },
                        {
                            fieldLabel: me.snippets.labels.collectionOrderType,
                            xtype: 'combo',
                            name: 'inkasso_order_type',
                            id: 'inkasso_order_type',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.collectionOrderType,
                            store: me.parentPanel.inkassoValuesStore.keyFilter( me.snippets.filterValues.collectionOrderType ),
                            queryMode: 'local',
                            allowBlank: true,
                            forceSelection: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.collectionOrderType );
                                },
                                focus: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.collectionOrderType );
                                }
                            }
                        },
                        {
                            xtype: 'fieldset',
                            title: me.snippets.labels.interestRate.title,
                            flex: 1,
                            width: '100%',
                            margin: '5 5 0 5',
                            items: [ {
                                xtype: 'radiogroup',
                                columns: 1,
                                vertical: true,
                                items: [ {
                                    boxLabel: me.snippets.labels.interestRate.legal,
                                    name: 'inkasso_interest_rate_radio',
                                    id: 'inkasso_interest_rate_legal',
                                    inputValue: '1',
                                    width: '100%',
                                    checked: true
                                }, {
                                    xtype: 'container',
                                    layout: 'hbox',
                                    width: '100%',
                                    margin: '10 0 0 0',
                                    items: [
                                        {
                                            xtype: 'radio',
                                            boxLabel: me.snippets.labels.interestRate.variableSpread + me.snippets.labels.parts.column,
                                            id: 'inkasso_interest_rate_variable_spread',
                                            name: 'inkasso_interest_rate_radio',
                                            flex: 2.9,
                                            inputValue: '2'
                                        }, {
                                            xtype: 'numberfield',
                                            name: 'inkasso_interest_rate_value',
                                            id: 'inkasso_interest_rate_variable_spread_text',
                                            disabled: true,
                                            allowBlank: false,
                                            blankText: me.snippets.validation.invalidValue,
                                            decimalPrecision: 2,
                                            minValue: 0,
                                            // Remove spinner buttons, and arrow key and mouse wheel listeners
                                            hideTrigger: true,
                                            keyNavEnabled: false,
                                            mouseWheelEnabled: false,
                                            maxLength: 5,
                                            maskRe: /[\d,.]/,
                                            enforceMaxLength: true,
                                            vtype: 'interestRateInkasso',
                                            flex: 7
                                        }, {
                                            xtype: 'displayfield',
                                            value: '%',
                                            flex: 0.1
                                        }
                                    ]
                                }, {
                                    xtype: 'container',
                                    layout: 'hbox',
                                    width: '100%',
                                    margin: '10 0 0 0',
                                    items: [
                                        {
                                            xtype: 'radio',
                                            boxLabel: me.snippets.labels.interestRate.fix + me.snippets.labels.parts.column,
                                            id: 'inkasso_interest_rate_fix',
                                            name: 'inkasso_interest_rate_radio',
                                            flex: 2.9,
                                            inputValue: '3'
                                        }, {
                                            xtype: 'numberfield',
                                            id: 'inkasso_interest_rate_fix_text',
                                            name: 'inkasso_interest_rate_value',
                                            disabled: true,
                                            allowBlank: false,
                                            blankText: me.snippets.validation.invalidValue,
                                            decimalPrecision: 2,
                                            minValue: 0,
                                            // Remove spinner buttons, and arrow key and mouse wheel listeners
                                            hideTrigger: true,
                                            keyNavEnabled: false,
                                            mouseWheelEnabled: false,
                                            maxLength: 5,
                                            maskRe: /[\d,.]/,
                                            enforceMaxLength: true,
                                            vtype: 'interestRateInkasso',
                                            flex: 7
                                        }, {
                                            xtype: 'displayfield',
                                            value: '%',
                                            flex: 0.1
                                        }
                                    ]
                                } ],
                                listeners: {
                                    change: function( checkbox, newValue, oldValue, eOpts ){
                                        var newRadio = parseInt( newValue.inkasso_interest_rate_radio ),
                                            variableSpread = Ext.getCmp( 'inkasso_interest_rate_variable_spread_text' ),
                                            fix = Ext.getCmp( 'inkasso_interest_rate_fix_text' );

                                        if( newRadio === 1 ) {
                                            variableSpread.setDisabled( true );
                                            fix.setDisabled( true );
                                        } else if( newRadio === 2 ) {
                                            variableSpread.setDisabled( false );
                                            fix.setDisabled( true );
                                        } else {
                                            variableSpread.setDisabled( true );
                                            fix.setDisabled( false );
                                        }
                                    }
                                }
                            } ]
                        }, {
                            fieldLabel: me.snippets.labels.customerReference,
                            xtype: 'combo',
                            name: 'inkasso_customer_reference',
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
                            displayField: 'label',
                            valueField: 'id',
                            listeners: {

                                /**
                                 * Prevents "&nbsp;" text from being displayed on selection
                                 */
                                select: function( comp, record, index ){
                                    if( comp.getValue() == "" || comp.getValue() == "&nbsp;" )
                                        comp.setValue( null );
                                }

                            }
                        }, {
                            fieldLabel: me.snippets.labels.turnoverType,
                            xtype: 'combo',
                            name: 'inkasso_turnover_type',
                            id: 'inkasso_turnover_type',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.turnoverType,
                            store: me.parentPanel.inkassoValuesStore.keyFilter( me.snippets.filterValues.turnoverType ),
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.turnoverType );
                                },
                                focus: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.turnoverType );
                                }
                            }
                        }, {
                            fieldLabel: me.snippets.labels.receivableReason,
                            xtype: 'combo',
                            name: 'inkasso_receivable_reason',
                            id: 'inkasso_receivable_reason',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            emptyText: me.snippets.labels.receivableReason,
                            store: me.parentPanel.inkassoValuesStore.keyFilter( me.snippets.filterValues.receivableReason ),
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.receivableReason );
                                },
                                focus: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.receivableReason );
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
                                    name: 'inkasso_valuta_date',
                                    id: 'inkasso_valuta_date',
                                    blankText: me.snippets.validation.invalidValue,
                                    emptyText: me.snippets.labels.days,
                                    decimalPrecision: 0,
                                    minValue: 0,
                                    maxValue: 999,
                                    // Remove spinner buttons, and arrow key and mouse wheel listeners
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false,
                                    enforceMaxLength: true,
                                    maxLength: 3,
                                    maskRe: /\d/,
                                    vtype: 'inkassoConfigDatum',
                                    flex: 1.4
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
                                    name: 'inkasso_due_date',
                                    id: 'inkasso_due_date',
                                    blankText: me.snippets.validation.invalidValue,
                                    emptyText: me.snippets.labels.days,
                                    decimalPrecision: 0,
                                    minValue: 0,
                                    maxValue: 999,
                                    // Remove spinner buttons, and arrow key and mouse wheel listeners
                                    hideTrigger: true,
                                    keyNavEnabled: false,
                                    mouseWheelEnabled: false,
                                    enforceMaxLength: true,
                                    maxLength: 3,
                                    maskRe: /\d/,
                                    vtype: 'inkassoConfigDatum',
                                    flex: 1.4
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
        getCustomerReferenceStore: function(){
            var me = this;
            return new Ext.data.SimpleStore( {
                fields: [ 'id', 'label' ],
                data: [
                    [ 0, '&nbsp;' ],
                    [ 1, me.snippets.labels.customerReferenceStore ]
                ]
            } );
        },
        setInterestRate: function( radio, value ){
            if( parseInt( radio ) === 1 ) {
                Ext.getCmp( 'inkasso_interest_rate_legal' ).setValue( true );
                Ext.getCmp( 'inkasso_interest_rate_variable_spread_text' ).setDisabled( true );
                Ext.getCmp( 'inkasso_interest_rate_fix_text' ).setDisabled( true );
            } else if( parseInt( radio ) === 2 ) {
                Ext.getCmp( 'inkasso_interest_rate_variable_spread_text' ).setDisabled( false );
                Ext.getCmp( 'inkasso_interest_rate_variable_spread' ).setValue( true );
                Ext.getCmp( 'inkasso_interest_rate_variable_spread_text' ).setValue( value );
            } else {
                Ext.getCmp( 'inkasso_interest_rate_fix_text' ).setDisabled( false );
                Ext.getCmp( 'inkasso_interest_rate_fix' ).setValue( true );
                Ext.getCmp( 'inkasso_interest_rate_fix_text' ).setValue( value );
            }
        }
    } );
// {/block}

