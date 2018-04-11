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
//{block name="backend/crefo_orders/view/detail/container/proposal"}
Ext.define( 'Shopware.apps.CrefoOrders.view.detail.ContainerProposal',
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
            },
            filterValues: {
                collectionOrderType: 'CCORTY',
                turnoverType: 'CCTOTY',
                receivableReason: 'CCRCRS'
            }
        },
        listeners: {
            "afterrender": function(){
                var me = this;
                formPnl = me.up( 'panel' );
                formPnl.getForm().getFields().each( function( f ){
                    f.validate();
                } );
                if( Ext.isDefined( me.displayErrors ) ) {
                    me.fireEvent( 'showErrors', me.displayErrors, formPnl.getForm() );
                }
            }
        },
        /**
         * This function is called, when the component is initiated
         * It creates the columns of the grid
         */
        initComponent: function(){
            var me = this;
            me.registerEvents();
            me.data = me.crefoProposalRecord.data;
            Ext.applyIf( me, {
                items: me.getItems()
            } );

            Ext.apply( Ext.form.field.VTypes, {
                interestRateProposal: function( val, field ){
                    var success = true;
                    //{literal}
                    var patt = /^\d{0,2}([,|.]\d{1,2})*$/;
                    //{/literal}
                    if( val.length > 5 || !patt.test( val ) ) {
                        success = false;
                    }
                    return success;
                },
                interestRateProposalText: this.snippets.validation.invalidValue
            } );

            me.callParent( arguments );
        },

        registerEvents: function(){
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

        getItems: function(){
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
                            padding: '10 5 0 5',
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
                        }, {
                            xtype: 'container',
                            layout: 'hbox',
                            flex: 1,
                            width: '100%',
                            padding: '5 5 0 5',
                            // margin: '10 0 0 0',
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
                                tpl: '<tpl for=".">'
                                + '<div class="x-boundlist-item">{literal}{useraccount} - {name} {address}{/literal}</div>'
                                + '</tpl>'
                            },
                            listeners: {
                                afterrender: function(){
                                    this.setValue( me.getUpdatedCreditor() );
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
                            store: me.inkassoValuesStore.keyFilter( me.snippets.filterValues.collectionOrderType ),
                            queryMode: 'local',
                            allowBlank: false,
                            forceSelection: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.collectionOrderType );
                                    this.setValue( me.crefoProposalRecord.get( 'orderTypeKey' ) );
                                },
                                focus: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.collectionOrderType );
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
                            items: [ {
                                xtype: 'radiogroup',
                                columns: 1,
                                vertical: true,
                                items: [ {
                                    boxLabel: me.snippets.labels.interestRate.legal,
                                    name: 'interestRateRadio',
                                    itemId: 'interestRateRadioLegal',
                                    id: 'interestRateRadioLegal',
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
                                            itemId: 'interestRateRadioSpread',
                                            id: 'interestRateRadioSpread',
                                            name: 'interestRateRadio',
                                            flex: 2.9,
                                            inputValue: '2'
                                        }, {
                                            xtype: 'numberfield',
                                            name: 'interestRateValue',
                                            itemId: 'interestRateRadioSpreadText',
                                            id: 'interestRateRadioSpreadText',
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
                                            vtype: 'interestRateProposal',
                                            validateOnChange: false,
                                            validateOnBlur: false,
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
                                            itemId: 'interestRateRadioFix',
                                            id: 'interestRateRadioFix',
                                            name: 'interestRateRadio',
                                            flex: 2.9,
                                            inputValue: '3'
                                        }, {
                                            xtype: 'numberfield',
                                            itemId: 'interestRateRadioFixText',
                                            id: 'interestRateRadioFixText',
                                            name: 'interestRateValue',
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
                                            vtype: 'interestRateProposal',
                                            validateOnChange: false,
                                            validateOnBlur: false,
                                            flex: 7
                                        }, {
                                            xtype: 'displayfield',
                                            value: '%',
                                            flex: 0.1
                                        }
                                    ]
                                } ],
                                listeners: {
                                    "afterrender": function( checkbox, eOpts ){
                                        me.setInterestRate( me.crefoProposalRecord.get( 'interestRateRadio' ), me.crefoProposalRecord.get( 'interestRateValue' ) );
                                    },
                                    "change": function( checkbox, newValue, oldValue, eOpts ){
                                        var newRadio = parseInt( newValue.interestRateRadio ),
                                            variableSpread = Ext.ComponentQuery.query( '#interestRateRadioSpreadText' )[ 0 ],
                                            fix = Ext.ComponentQuery.query( '#interestRateRadioFixText' )[ 0 ];

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
                                'afterrender': function(){
                                    var customerReference = me.crefoProposalRecord.get( 'customerReference' );
                                    if( customerReference !== null && Ext.isDefined( customerReference ) ) {
                                        this.setValue( Ext.util.Format.trim( customerReference ) );
                                    }
                                }
                            }
                        }, {
                            xtype: 'textareafield',
                            // grow      : true,
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
                                'afterrender': function(){
                                    this.setValue( me.crefoProposalRecord.get( 'remarks' ) );
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
                            store: me.inkassoValuesStore.keyFilter( me.snippets.filterValues.turnoverType ),
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: false,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.turnoverType );
                                    this.setValue( me.crefoProposalRecord.get( 'turnoverTypeKey' ) );
                                },
                                focus: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.turnoverType );
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
                            renderer: function( value, metaData, record ){
                                if( value === Ext.undefined ) {
                                    return value;
                                }
                                return Ext.util.Format.date( value, 'Y-m-d' );
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
                                'afterrender': function(){
                                    this.setValue( me.crefoProposalRecord.get( 'invoiceNumber' ) );
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
                            store: me.inkassoValuesStore.keyFilter( me.snippets.filterValues.receivableReason ),
                            queryMode: 'local',
                            forceSelection: true,
                            allowBlank: false,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            listeners: {
                                afterrender: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.receivableReason );
                                    this.setValue( me.crefoProposalRecord.get( 'receivableReasonKey' ) );
                                },
                                focus: function(){
                                    this.getStore().keyFilter( me.snippets.filterValues.receivableReason );
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
                            // margin: '10 0 0 0',
                            items: [
                                {
                                    xtype: 'label',
                                    forId: 'amount',
                                    text: me.snippets.labels.amount + ":",
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
                                    renderer: function( value, metaData, record ){
                                        if( value === Ext.undefined ) {
                                            return value;
                                        }
                                        return Ext.util.Format.currency( value );
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
        getCheckText: function(){
            var me = this;
            if( me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined ) {
                return me.snippets.labels.checkText;
            }
            var status = me.crefoProposalRecord.get( 'proposalStatus' );
            if( parseInt( status ) === 0 ) {
                return me.snippets.labels.checkErrorText;
            } else {
                return me.snippets.labels.checkText;
            }
        },
        getReplacementText: function(){
            var me = this;
            if( me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined ) {
                return me.snippets.values.proposal;
            }
            var status = me.crefoProposalRecord.get( 'proposalStatus' );
            if( parseInt( status ) === 0 ) {
                return me.snippets.values.errorText;
            } else {
                return me.snippets.values.proposal;
            }
        },
        getDebtorType: function(){
            var me = this,
                debtorHead = null;
            if( me.hasDebtorCompany() ) {
                var companyName = me.getDebtorCompany();
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
                    fieldLabel: me.snippets.labels.debtor,
                    value: me.getDebtorCompany(),
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
                            text: me.snippets.labels.debtor + ":",
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
        getDebtorCompany: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.companyName;
            }
            return value;
        },
        hasDebtorCompany: function(){
            var me = this,
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder,
                company = (proposalOrder !== null && !Ext.isEmpty( proposalOrder.companyName )) ? proposalOrder.companyName : '';
            return company !== '';
        },
        getDebtorSalutation: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                if( proposalOrder.salutation === "mr" || proposalOrder.salutation === "SA-1" ) {
                    value = me.snippets.values.mr;
                } else if( proposalOrder.salutation === "ms" || proposalOrder.salutation === "SA-2" ) {
                    value = me.snippets.values.ms;
                }
            }
            return value;
        },
        getDebtorFirstName: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.firstName;
            }
            return value;
        },
        getDebtorLastName: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.surname;
            }
            return value;
        },
        getDebtorStreet: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.street;
                if( !Ext.isEmpty( proposalOrder.houseNumber ) ) {
                    value += ' ' + proposalOrder.houseNumber;
                }
                if( !Ext.isEmpty( proposalOrder.houseNumberAffix ) ) {
                    value += proposalOrder.houseNumberAffix;
                }
            }
            return value;
        },
        getDebtorZipCode: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.postcode;
            }
            return value;
        },
        getDebtorCity: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.city;
            }
            return value;
        },
        getDebtorCountry: function( realValue ){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.country;
                if( !realValue ) {
                    value = proposalOrder.countryIso;
                }
            }
            return value;
        },
        displayCountry: function(){
            var me = this,
                countryRawValue = me.getDebtorCountry( false ),
                countryRow = {
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
                            value: me.getDebtorCountry( true ),
                            rawValue: countryRawValue
                        }
                    ]
                };
            return countryRow;
        },
        getDebtorEmail: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.email;
            }
            return value;
        },
        displayDebtorEmail: function(){
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
                            text: me.snippets.labels.email + ":",
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
            if( email.length > 100 ) {
                emailRow.items.push( {
                    xtype: 'displayfield',
                    name: 'editEmailSign',
                    value: Ext.String.format( "&nbsp;<span data-qtip='[0]' class='sprite-exclamation' style='padding-left: 25px;'></span>", me.snippets.signs.toEdit )
                } );
            }
            return emailRow;
        },
        displayInvoiceDate: function(){
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
                        text: me.snippets.labels.invoiceDate + ":",
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
                            'afterrender': function(){
                                this.setValue( me.crefoProposalRecord.get( 'dateInvoice' ) );
                            }
                        }
                    }
                ]
            };
        },
        getContractDate: function(){
            var me = this;
            return me.listRecord.get( "orderTime" );
        },
        displayValutaDate: function(){
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
                        text: me.snippets.labels.valutaDate + ":",
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
                            'afterrender': function(){
                                if( me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined ) {
                                    return null;
                                }
                                this.setValue( me.crefoProposalRecord.get( 'valutaDate' ) );
                            }
                        }
                    },
                    {
                        xtype: 'button',
                        text: me.snippets.values.btnCalculate,
                        scale: 'small',
                        flex: 0.9,
                        listeners: {
                            click: function(){
                                var cmp = Ext.ComponentQuery.query( '#valutaDate' )[ 0 ],
                                    invoiceCmp = Ext.ComponentQuery.query( '#dateInvoice' )[ 0 ],
                                    dateToSet = (Ext.isDate( invoiceCmp.getValue() ) ? invoiceCmp.getValue() : new Date( Date.now() ));
                                if( me.inkassoConfig === null || me.inkassoConfig === Ext.undefined || me.inkassoConfig.first() === Ext.undefined ) {
                                    cmp.setValue( dateToSet );
                                    return false;
                                }
                                var extraDate = me.inkassoConfig.first().get( 'inkasso_valuta_date' );
                                if( Ext.isNumber( extraDate ) ) {
                                    cmp.setValue( Ext.Date.add( dateToSet, Ext.Date.DAY, extraDate ) );
                                }
                            }
                        }
                    }
                ]
            };
        },
        displayDueDate: function(){
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
                        text: me.snippets.labels.dueDate + ":",
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
                            'afterrender': function(){
                                if( me.crefoProposalRecord === null || me.crefoProposalRecord === Ext.undefined ) {
                                    return null;
                                }
                                this.setValue( me.crefoProposalRecord.get( 'dueDate' ) );
                            }
                        }
                    },
                    {
                        xtype: 'button',
                        text: me.snippets.values.btnCalculate,
                        scale: 'small',
                        flex: 0.9,
                        listeners: {
                            click: function(){
                                var cmp = Ext.ComponentQuery.query( '#dueDate' )[ 0 ],
                                    invoiceCmp = Ext.ComponentQuery.query( '#dateInvoice' )[ 0 ],
                                    dateToSet = (Ext.isDate( invoiceCmp.getValue() ) ? invoiceCmp.getValue() : new Date( Date.now() ));
                                if( me.inkassoConfig === null || me.inkassoConfig === Ext.undefined || me.inkassoConfig.first() === Ext.undefined ) {
                                    cmp.setValue( dateToSet );
                                    return false;
                                }
                                var extraDate = me.inkassoConfig.first().get( 'inkasso_due_date' );
                                if( Ext.isNumber( extraDate ) ) {
                                    cmp.setValue( Ext.Date.add( dateToSet, Ext.Date.DAY, extraDate ) );
                                }
                            }
                        }
                    }
                ]
            };
        },
        setInterestRate: function( radio, value ){
            if( parseInt( radio ) === 1 ) {
                Ext.ComponentQuery.query( '#interestRateRadioLegal' )[ 0 ].setValue( true );
                Ext.ComponentQuery.query( '#interestRateRadioSpreadText' )[ 0 ].setDisabled( true );
                Ext.ComponentQuery.query( '#interestRateRadioFixText' )[ 0 ].setDisabled( true );
            } else if( parseInt( radio ) === 2 ) {
                Ext.ComponentQuery.query( '#interestRateRadioSpreadText' )[ 0 ].setDisabled( false );
                Ext.ComponentQuery.query( '#interestRateRadioSpread' )[ 0 ].setValue( true );
                Ext.ComponentQuery.query( '#interestRateRadioSpreadText' )[ 0 ].setValue( value );
            } else {
                Ext.ComponentQuery.query( '#interestRateRadioFixText' )[ 0 ].setDisabled( false );
                Ext.ComponentQuery.query( '#interestRateRadioFix' )[ 0 ].setValue( true );
                Ext.ComponentQuery.query( '#interestRateRadioFixText' )[ 0 ].setValue( value );
            }
        },
        getAmount: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.invoiceAmount;
            }
            return value;
        },
        getCurrency: function(){
            var me = this,
                value = '',
                proposalOrder = me.crefoProposalRecord.raw.proposalOrder;
            if( !Ext.isEmpty( proposalOrder ) ) {
                value = proposalOrder.currency;
            }
            return value;
        },
        getUpdatedCreditor: function(){
            var me = this,
                value = me.crefoProposalRecord.get( 'creditor' );
            if( Ext.isEmpty( me.inkassoCreditorsStore.findRecord( 'useraccount', value ) ) ) {
                value = null;
            }
            return value;
        }
    } );
// {/block}

