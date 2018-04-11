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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/products/bonima_pool_ident_premium_container"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.products.BonimaPoolIdentPremiumContainer',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-report-private-person-bonimapoolident-premium-container',
        region: 'center',
        autoScroll: true,
        name: 'bonimaPoolIdentPremiumContainer',
        id: 'bonimaPoolIdentPremiumContainer',
        border: 0,
        layout: 'vbox',
        width: '100%',
        pack: 'start',
        align: 'center',
        ui: 'shopware-ui',
        hidden: false,
        minWidth: 155,
        snippets: {
            labels: {
                productName: '{s name="crefoconfig/view/tabs/report_private_person/products/bpip/labels/productName"}Bonima Score Pool Ident Premium{/s}',
                productExplanation: '{s name="crefoconfig/view/tabs/report_private_person/products/productExplanation"}Die Bonitätsprüfung ist bestanden, wenn die Auskunftsinhalte den folgenden Einstellungne entsprechen:{/s}',
                col: {
                    titles: {
                        addressResult: '{s name="crefoconfig/view/tabs/report_private_person/products/col/titles/addressResult"}Adressvalidierungsergebnis{/s}',
                        identResult: '{s name="crefoconfig/view/tabs/report_private_person/products/col/titles/identResult"}Identifizierungsergebnis{/s}',
                        score: '{s name="crefoconfig/view/tabs/report_private_person/products/col/titles/score"}Scorebereich\n(Bonima Score){/s}'
                    },
                    values: {
                        addressOk: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/addressOk"}Adresse in Ordnung{/s}',
                        personIdentified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/personIdentified"}Person Indetifiziert{/s}',
                        householdIdentified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/householdIdentified"}Haushalt Indetifiziert{/s}',
                        buildingIdentified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/buildingIdentified"}Gebäude Indetifiziert{/s}',
                        personNotIdentified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/personNotIdentified"}Nicht Indetifiziert{/s}',
                        and: '{s name="crefo/part/uppercase/and"}UND{/s}',
                        from: '{s name="crefo/part/lowercase/from"}ab{/s}',
                        to: '{s name="crefo/part/lowercase/to"}bis{/s}'
                    }
                },
                basket: {
                    minValue: '{s name="crefoconfig/view/tabs/report_private_person/products/minValue"}DE Warenkorb-Untergrenze:{/s}',
                    maxValue: '{s name="crefoconfig/view/tabs/report_private_person/products/maxValue"}DE Warenkorb-Obergrenze:{/s}',
                    currency: '{s name="crefoconfig/view/tabs/report_private_person/products/currency"}EUR{/s}'
                }
            },
            errors: {
                hasRedProducts: '{s name="crefoconfig/reports/hasRedProducts"}ACHTUNG! Die Mitgliedskennung '
                + 'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung '
                + 'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        initComponent: function(){
            var me = this;

            Ext.applyIf( me, {
                items: me.getItems()
            } );

            me.callParent( arguments );
        },
        getItems: function(){
            var me = this;
            return [
                {
                    xtype: 'radio',
                    boxLabel: me.snippets.labels.productName,
                    id: 'bonimaPoolIdentPremiumProductRadio',
                    name: 'selectedProductKey',
                    checked: me.isBPIPProductChecked(),
                    style: 'font-weight: bold;',
                    boxLabelCls: 'crefo-fix-label',
                    hidden: false,
                    flex: 1,
                    inputValue: '1',
                    listeners: {
                        'afterrender': function( cmp ){
                            enclosingElem = cmp.getResizeEl();
                            enclosingElem.on( 'mouseenter', function( elem, t ){
                                if( cmp.hasCls( 'crefo-red-product' ) ) {
                                    cmp.markInvalid( me.snippets.errors.hasRedProducts );
                                }
                            }, cmp );
                        },
                        'change': function( cmp, newValue, oldValue, eOpts ){
                            me.disableBPIPContainer( !newValue );
                        }
                    }
                },
                {
                    xtype: me.createTextContainer( '<div></div>', '' )
                },
                me.createSubContainer()
            ]
        },
        createSubContainer: function(){
            var me = this;
            return {
                xtype: 'container',
                layout: 'vbox',
                disabled: !me.isBPIPProductChecked(),
                id: 'bonimaPoolIdentPremiumProductSubContainer',
                flex: 1,
                autoShow: true,
                hidden: !me.isBPIPProductChecked(),
                width: '100%',
                pack: 'start',
                align: 'center',
                ui: 'shopware-ui',
                border: 0,
                items: [
                    {
                        xtype: me.createTextContainer( me.snippets.labels.productExplanation, 'margin-left:30px; font-size: 11px;' )
                    },
                    {
                        xtype: 'container',
                        layout: 'hbox',
                        width: '100%',
                        margin: '0 0 0 35',
                        padding: '10 5 10 5',
                        flex: 1,
                        items: [
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.titles.addressResult,
                                style: {
                                    fontWeight: 'bold',
                                    fontSize: '12px'
                                },
                                flex: 3
                            },
                            {
                                xtype: 'text',
                                text: " ",
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 0.9
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.titles.identResult,
                                style: {
                                    fontWeight: 'bold',
                                    fontSize: '12px'
                                },
                                flex: 2.7
                            },
                            {
                                xtype: 'text',
                                text: " ",
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 1.4
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.titles.score,
                                style: {
                                    fontWeight: 'bold',
                                    fontSize: '12px'
                                },
                                region: 'center',
                                flex: 3
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'hbox',
                        width: '100%',
                        margin: '0 0 0 35',
                        padding: '5 5 10 5',
                        flex: 1,
                        items: [
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.addressOk,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 3
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 0.9
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.personIdentified,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 2.7
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 1.4
                            },
                            {
                                xtype: 'container',
                                layout: 'vbox',
                                align: 'stretch',
                                defaults: {
                                    layout: 'fit',
                                    flex: 1
                                },
                                flex: 3,
                                items: [
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_from_2',
                                        id: 'bpip_person_identified_from',
                                        fieldLabel: me.snippets.labels.col.values.from,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreFromVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 2 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreFrom' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_person_identified_to' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_to_2',
                                        id: 'bpip_person_identified_to',
                                        fieldLabel: me.snippets.labels.col.values.to,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreToVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 2 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreTo' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_person_identified_from' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'hbox',
                        width: '100%',
                        margin: '0 0 0 35',
                        padding: '10 5 10 5',
                        flex: 1,
                        items: [
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.addressOk,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 3
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 0.9
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.householdIdentified,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 2.7
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 1.4
                            },
                            {
                                xtype: 'container',
                                layout: 'vbox',
                                align: 'stretch',
                                defaults: {
                                    layout: 'fit',
                                    flex: 1
                                },
                                flex: 3,
                                items: [
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_from_3',
                                        id: 'bpip_household_from',
                                        fieldLabel: me.snippets.labels.col.values.from,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreFromVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 3 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreFrom' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_household_to' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_to_3',
                                        id: 'bpip_household_to',
                                        fieldLabel: me.snippets.labels.col.values.to,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreToVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 3 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreTo' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_household_from' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'hbox',
                        width: '100%',
                        margin: '0 0 0 35',
                        padding: '10 5 10 5',
                        flex: 1,
                        items: [
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.addressOk,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 3
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 0.9
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.buildingIdentified,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 2.7
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 1.4
                            },
                            {
                                xtype: 'container',
                                layout: 'vbox',
                                align: 'stretch',
                                defaults: {
                                    layout: 'fit',
                                    flex: 1
                                },
                                flex: 3,
                                items: [
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_from_4',
                                        id: 'bpip_building_from',
                                        fieldLabel: me.snippets.labels.col.values.from,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreFromVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 4 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreFrom' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_building_to' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_to_4',
                                        id: 'bpip_building_to',
                                        fieldLabel: me.snippets.labels.col.values.to,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreToVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 4 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreTo' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_building_from' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'hbox',
                        width: '100%',
                        margin: '0 0 0 35',
                        padding: '10 5 10 5',
                        flex: 1,
                        items: [
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.addressOk,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 3
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 0.9
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.personNotIdentified,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 2.7
                            },
                            {
                                xtype: 'text',
                                text: me.snippets.labels.col.values.and,
                                padding: '20 0 0 0',
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 1.4
                            },
                            {
                                xtype: 'container',
                                layout: 'vbox',
                                align: 'stretch',
                                defaults: {
                                    layout: 'fit',
                                    flex: 1
                                },
                                flex: 3,
                                items: [
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_from_5',
                                        id: 'bpip_not_identified_from',
                                        fieldLabel: me.snippets.labels.col.values.from,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreFromVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 5 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreFrom' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_not_identified_to' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: 'ident_to_5',
                                        id: 'bpip_not_identified_to',
                                        fieldLabel: me.snippets.labels.col.values.to,
                                        blankText: me.snippets.validation.invalidValue,
                                        invalidText: me.snippets.validation.invalidValue,
                                        nanText: me.snippets.validation.invalidValue,
                                        labelWidth: 35,
                                        width: 90,
                                        allowBlank: true,
                                        allowDecimals: false,
                                        disableKeyFilter: true,
                                        allowOnlyWhitespace: false,
                                        minValue: 0,
                                        maxValue: 99999,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        enforceMaxLength: true,
                                        maxLength: 5,
                                        maskRe: /\d/,
                                        validateOnBlur: false,
                                        validateOnChange: false,
                                        vtype: 'bonimaScoreToVType',
                                        flex: 1,
                                        listeners: {
                                            'afterrender': function(){
                                                if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                                                    var record = me.parentPanel.productsDbStore.findRecord( 'identificationResult', 5 );
                                                    Ext.isEmpty( record ) ? record : this.setValue( record.get( 'productScoreTo' ) );
                                                }
                                            },
                                            'change': function( combo, newValue, oldValue, eOpt ){
                                                var pair = Ext.getCmp( 'bpip_not_identified_from' );
                                                if( Ext.isEmpty( newValue ) && Ext.isEmpty( pair.getValue() ) ) {
                                                    this.allowBlank = pair.allowBlank = true;
                                                } else {
                                                    this.allowBlank = pair.allowBlank = false;
                                                }
                                            },
                                            'paste': {
                                                element: 'inputEl',
                                                fn: function( event, inputEl ){
                                                    if( event.type == "paste" ) {
                                                        event.preventDefault();
                                                        return false;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'hbox',
                        width: '100%',
                        margin: '0 0 0 30',
                        padding: '5 5 10 5',
                        flex: 1,
                        items: [
                            {
                                xtype: 'text',
                                text: me.snippets.labels.basket.minValue,
                                style: {
                                    fontSize: '12px'
                                },
                                padding: '5 0 0 0',
                                flex: 2.5
                            },
                            {
                                xtype: 'numberfield',
                                name: 'thresholdMin',
                                id: 'bpip_basket_minVal',
                                hideLabel: true,
                                allowBlank: false,
                                blankText: me.snippets.validation.invalidValue,
                                invalidText: me.snippets.validation.invalidValue,
                                nanText: me.snippets.validation.invalidValue,
                                maxText: me.snippets.validation.invalidValue,
                                width: 50,
                                decimalPrecision: 2,
                                disableKeyFilter: true,
                                submitLocaleSeparator: false,
                                minValue: 0,
                                maxValue: 99999.99,
                                // Remove spinner buttons, and arrow key and mouse wheel listeners
                                hideTrigger: true,
                                keyNavEnabled: false,
                                mouseWheelEnabled: false,
                                enforceMaxLength: true,
                                maxLength: 8,
                                maskRe: /[\d,.]/,
                                validateOnBlur: false,
                                validateOnChange: false,
                                vtype: 'basketMinVType',
                                flex: 0.6,
                                listeners: {
                                    'afterrender': function(){
                                        if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.reportPrivatePersonStore.first() ) ) {
                                            var record = me.parentPanel.reportPrivatePersonStore.first();
                                            Ext.isEmpty( record.get( 'thresholdMin' ) ) ? record : this.setValue( record.get( 'thresholdMin' ) );
                                        }
                                    },
                                    'paste': {
                                        element: 'inputEl',
                                        fn: function( event, inputEl ){
                                            if( event.type == "paste" ) {
                                                event.preventDefault();
                                                return false;
                                            }
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'label',
                                forId: 'bpip_basket_minVal',
                                padding: '5 0 0 0',
                                text: me.snippets.labels.basket.currency,
                                margin: '0 0 0 10'
                            },
                            {
                                xtype: 'text',
                                text: " ",
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 2.5
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        layout: 'hbox',
                        width: '100%',
                        margin: '0 0 0 30',
                        padding: '0 5 10 5',
                        flex: 1,
                        items: [
                            {
                                xtype: 'text',
                                text: me.snippets.labels.basket.maxValue,
                                style: {
                                    fontSize: '12px'
                                },
                                padding: '5 0 0 0',
                                flex: 2.5
                            },
                            {
                                xtype: 'numberfield',
                                name: 'thresholdMax',
                                id: 'bpip_basket_maxVal',
                                hideLabel: true,
                                blankText: me.snippets.validation.invalidValue,
                                invalidText: me.snippets.validation.invalidValue,
                                nanText: me.snippets.validation.invalidValue,
                                maxText: me.snippets.validation.invalidValue,
                                width: 50,
                                decimalPrecision: 2,
                                disableKeyFilter: true,
                                submitLocaleSeparator: false,
                                minValue: 0,
                                maxValue: 99999.99,
                                // Remove spinner buttons, and arrow key and mouse wheel listeners
                                hideTrigger: true,
                                keyNavEnabled: false,
                                mouseWheelEnabled: false,
                                enforceMaxLength: true,
                                maxLength: 8,
                                maskRe: /[\d,.]/,
                                validateOnBlur: false,
                                validateOnChange: false,
                                vtype: 'basketMaxVType',
                                flex: 0.6,
                                listeners: {
                                    'afterrender': function(){
                                        if( me.isBPIPProductChecked() && !Ext.isEmpty( me.parentPanel.reportPrivatePersonStore.first() ) ) {
                                            var record = me.parentPanel.reportPrivatePersonStore.first();
                                            Ext.isEmpty( record.get( 'thresholdMax' ) ) ? record : this.setValue( record.get( 'thresholdMax' ) );
                                        }
                                    },
                                    'paste': {
                                        element: 'inputEl',
                                        fn: function( event, inputEl ){
                                            if( event.type == "paste" ) {
                                                event.preventDefault();
                                                return false;
                                            }
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'label',
                                forId: 'bpip_basket_maxVal',
                                padding: '5 0 0 0',
                                text: me.snippets.labels.basket.currency,
                                margin: '0 0 0 10'
                            },
                            {
                                xtype: 'text',
                                text: " ",
                                style: {
                                    fontSize: '12px'
                                },
                                flex: 2.5
                            }
                        ]
                    }
                ]
            }
        },
        createTextContainer: function( html, style ){
            if( !Ext.isDefined( style ) ) {
                style = 'color: #999; font-style: italic; margin: 0 0 15px 0;';
            }
            return Ext.create(
                'Ext.container.Container',
                {
                    flex: 1,
                    width: '100%',
                    padding: '10 5 0 5',
                    style: style,
                    html: html
                } );
        },
        isBPIPProductChecked: function(){
            var me = this;
            if( Ext.isDefined( me.parentPanel.reportPrivatePersonStore.first() ) && !Ext.isEmpty( me.parentPanel.reportPrivatePersonStore.first().get( 'selectedProductKey' ) ) ) {
                return me.parentPanel.reportPrivatePersonStore.first().get( 'selectedProductKey' ) === me.parentPanel.productKeysIds.bonimaPoolIdentPremium;
            }
            return false;
        },
        disableBPIPContainer: function( disabled ){
            if( Ext.isDefined( Ext.getCmp( 'bonimaPoolIdentPremiumProductSubContainer' ) ) ) {
                Ext.getCmp( 'bonimaPoolIdentPremiumProductSubContainer' ).setDisabled( disabled );
                if( disabled ) {
                    Ext.getCmp( 'bonimaPoolIdentPremiumProductSubContainer' ).hide();
                } else {
                    Ext.getCmp( 'bonimaPoolIdentPremiumProductSubContainer' ).show();
                }
            }
        }
    } );
// {/block}

