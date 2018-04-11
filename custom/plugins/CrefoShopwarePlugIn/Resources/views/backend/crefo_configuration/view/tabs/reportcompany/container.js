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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/container"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Container',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-reportcompany-container',
        region: 'center',
        autoScroll: true,
        name: 'reportCompanyContainer',
        id: 'reportCompanyContainer',
        border: 0,
        layout: 'anchor',
        ui: 'shopware-ui',
        defaults: {
            labelWidth: 210,
            labelStyle: 'font-weight: 700;',
            anchor: '100%'
        },
        hidden: false,
        minWidth: 155,
        snippets: {
            labels: {
                parts: {
                    'column': ':'
                },
                reportLanguage: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/report_language"}Auskunftssprache{/s}',
                legitimateInterest: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/legetimate_interest"}Berechtigtes Interesse{/s}',
                productTitle: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/title_products_area"}Produktarten{/s}',
                products: {
                    titles: {
                        threshold: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/basket_threshold"}Warenkorb-Schwellwert{/s}',
                        productType: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/product_type"}Produktart{/s}',
                        creditRiskIndex: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/solvency_index"}Bonitaetsindex-Schwellwert{/s}'
                    },
                    countries: {
                        de: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/countries/de"}DE-Firmen:{/s}',
                        at: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/countries/at"}AT-Firmen:{/s}',
                        lu: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/countries/lu"}LU-Firmen:{/s}'
                    },
                    currency: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/currency"}EUR{/s}',
                    values: {
                        first: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/basket_lower_limit"}Warenkorb-Untergrenze{/s}',
                        last: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/basket_upper_limit"}Warenkorb-Obergrenze{/s}',
                        between: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/from"}ab{/s}'
                    }
                }
            },
            tooltips: {
                infoProducts: '{s name="crefoconfig/view/tabs/reportcompany/panel/tooltips/title_products_area"}Diese Software-Version kann die folgenden'
                + 'Produktarten verarbeiten:<br/><br/><p>RisikoCheck</p><p>eCrefo</p><br/><br/>Bei Auswahl der Produktart eCrefo ist die '
                + 'Eingabe eines Bonitätsindex-Schwellwertes notwendig (Wertebereich 100-600).{/s}'
            },
            errors: {
                noProducts: '{s name="crefoconfig/controller/crefo_configuration/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,'
                + 'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
                hasRedProducts: '{s name="crefoconfig/controller/crefo_configuration/hasRedProducts"}ACHTUNG! Die Mitgliedskennung '
                + 'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung '
                + 'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        initComponent: function(){
            var me = this;
            me.items = me.getItems();

            me.basketValueThresholdRegex = /^[\d.,]*$/i;
            me.solvencyIndexRegex = /^([1-5]\d\d)|(600)$/i;
            // Add own vtypes to validate password fields
            Ext.apply( Ext.form.field.VTypes, {
                basketValueThresholdA: function( val, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    var success = me.basketValueThresholdRegex.test( val );
                    var country = field.id.substring( 0, 2 );
                    var sequence = field.id.substring( 3, field.id.indexOf( "-value" ) );
                    var valueB = Ext.getCmp( country + '-' + (parseInt( sequence ) + 1) + '-value' );
                    var valueC = Ext.getCmp( country + '-' + (parseInt( sequence ) + 2) + '-value' );
                    var valueD = Ext.getCmp( country + '-' + (parseInt( sequence ) + 3) + '-value' );
                    if( val !== '' && !Ext.isEmpty( valueB.getValue() ) && ( valueB.getValue() <= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueC.getValue() ) && (valueC.getValue() <= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueD.getValue() ) && ( valueD.getValue() <= field.getValue()) ) {
                        success = false;
                    }
                    var productA = Ext.getCmp( country + '-' + sequence + '-product' );
                    if( val === '' && productA.getValue() !== null && productA.getValue() !== '' ) {
                        success = false;
                    }
                    return success;
                },
                basketValueThresholdAText: this.snippets.validation.invalidValue,
                basketValueThresholdAMask: /^[\d.,]+$/i,
                basketValueThresholdB: function( val, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    var success = me.basketValueThresholdRegex.test( val );
                    var country = field.id.substring( 0, 2 );
                    var sequence = field.id.substring( 3, field.id.indexOf( "-value" ) );
                    var valueA = Ext.getCmp( country + '-' + (parseInt( sequence ) - 1) + '-value' );
                    var valueC = Ext.getCmp( country + '-' + (parseInt( sequence ) + 1) + '-value' );
                    var valueD = Ext.getCmp( country + '-' + (parseInt( sequence ) + 2) + '-value' );
                    if( val !== '' && !Ext.isEmpty( valueA.getValue() ) && ( valueA.getValue() >= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueC.getValue() ) && ( valueC.getValue() <= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueD.getValue() ) && ( valueD.getValue() <= field.getValue()) ) {
                        success = false;
                    }
                    var productB = Ext.getCmp( country + '-' + sequence + '-product' );
                    if( val === '' && productB.getValue() !== null && productB.getValue() !== '' ) {
                        success = false;
                    }
                    return success;
                },
                basketValueThresholdBText: this.snippets.validation.invalidValue,
                basketValueThresholdBMask: /^[\d.,]*$/i,
                basketValueThresholdC: function( val, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    var success = me.basketValueThresholdRegex.test( val );
                    var country = field.id.substring( 0, 2 );
                    var sequence = field.id.substring( 3, field.id.indexOf( "-value" ) );
                    var valueA = Ext.getCmp( country + '-' + (parseInt( sequence ) - 2) + '-value' );
                    var valueB = Ext.getCmp( country + '-' + (parseInt( sequence ) - 1) + '-value' );
                    var valueD = Ext.getCmp( country + '-' + (parseInt( sequence ) + 1) + '-value' );
                    if( val !== '' && !Ext.isEmpty( valueA.getValue() ) && ( valueA.getValue() >= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueB.getValue() ) && ( valueB.getValue() >= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueD.getValue() ) && ( valueD.getValue() <= field.getValue()) ) {
                        success = false;
                    }
                    var productC = Ext.getCmp( country + '-' + sequence + '-product' );
                    if( val === '' && productC.getValue() !== null && productC.getValue() !== '' ) {
                        success = false;
                    }
                    return success;
                },
                basketValueThresholdCText: this.snippets.validation.invalidValue,
                basketValueThresholdCMask: /^[\d.,]*$/i,
                basketValueThresholdD: function( val, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    var success = me.basketValueThresholdRegex.test( val );
                    var country = field.id.substring( 0, 2 );
                    var sequence = field.id.substring( 3, field.id.indexOf( "-value" ) );
                    var valueA = Ext.getCmp( country + '-' + (parseInt( sequence ) - 3) + '-value' );
                    var valueB = Ext.getCmp( country + '-' + (parseInt( sequence ) - 2) + '-value' );
                    var valueC = Ext.getCmp( country + '-' + (parseInt( sequence ) - 1) + '-value' );
                    if( val !== '' && !Ext.isEmpty( valueA.getValue() ) && ( valueA.getValue() >= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueB.getValue() ) && ( valueB.getValue() >= field.getValue()) ) {
                        success = false;
                    }
                    if( val !== '' && !Ext.isEmpty( valueC.getValue() ) && ( valueC.getValue() >= field.getValue()) ) {
                        success = false;
                    }
                    return success;
                },
                basketValueThresholdDText: this.snippets.validation.invalidValue,
                basketValueThresholdDMask: /^[\d.,]*$/i,
                productType: function( valName, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    var success = true;
                    var country = field.id.substring( 0, 2 );
                    var currRec = me.parentPanel.productStore.queryBy( function( record, id ){
                        return (record.get( 'country' ).toUpperCase() === country.toUpperCase() && record.get( 'keyWS' ) === field.getValue());
                    } );
                    /**
                     * handle red products
                     */
                    if( currRec !== null && currRec.items.length === 0 && valName !== null && valName !== '' ) {
                        success = false;
                    }
                    return success;
                },
                productTypeText: this.snippets.errors.hasRedProducts,
                solvencyIndexA: function( val, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    if( val.length !== 3 ) {
                        return false;
                    }
                    var success = me.solvencyIndexRegex.test( val );
                    var country = field.id.substring( 0, 2 );
                    var sequence = field.id.substring( 3, field.id.indexOf( "-value" ) );
                    var indexB = Ext.getCmp( country + '-' + (parseInt( sequence ) + 1) + '-value-index' );
                    var indexC = Ext.getCmp( country + '-' + (parseInt( sequence ) + 2) + '-value-index' );
                    if( !indexB.isDisabled() && val !== '' && indexB.getValue() !== '' && (parseInt( indexB.getValue() ) > parseInt( val )) ) {
                        success = false;
                    }
                    if( !indexC.isDisabled() && val !== '' && indexC.getValue() !== '' && (parseInt( indexC.getValue() ) > parseInt( val )) ) {
                        success = false;
                    }
                    return success;
                },
                solvencyIndexAText: this.snippets.validation.invalidValue,
                solvencyIndexB: function( val, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    if( val.length !== 3 ) {
                        return false;
                    }
                    var success = me.solvencyIndexRegex.test( val );
                    var country = field.id.substring( 0, 2 );
                    var sequence = field.id.substring( 3, field.id.indexOf( "-value" ) );
                    var indexA = Ext.getCmp( country + '-' + (parseInt( sequence ) - 1) + '-value-index' );
                    var indexC = Ext.getCmp( country + '-' + (parseInt( sequence ) + 1) + '-value-index' );
                    if( !indexA.isDisabled() && val !== '' && indexA.getValue() !== '' && (parseInt( indexA.getValue() ) < parseInt( val )) ) {
                        success = false;
                    }
                    if( !indexC.isDisabled() && val !== '' && indexC.getValue() !== '' && (parseInt( indexC.getValue() ) > parseInt( val )) ) {
                        success = false;
                    }
                    return success;
                },
                solvencyIndexBText: this.snippets.validation.invalidValue,
                solvencyIndexC: function( val, field ){
                    if( Ext.getCmp( 'useraccountId' ).getValue() === null ) {
                        return true;
                    }
                    if( val.length !== 3 ) {
                        return false;
                    }
                    var success = me.solvencyIndexRegex.test( val );
                    var country = field.id.substring( 0, 2 );
                    var sequence = field.id.substring( 3, field.id.indexOf( "-value" ) );
                    var indexA = Ext.getCmp( country + '-' + (parseInt( sequence ) - 2) + '-value-index' );
                    var indexB = Ext.getCmp( country + '-' + (parseInt( sequence ) - 1) + '-value-index' );
                    if( !indexA.isDisabled() && val !== '' && indexA.getValue() !== '' && (parseInt( indexA.getValue() ) < parseInt( val )) ) {
                        success = false;
                    }
                    if( !indexB.isDisabled() && val !== '' && indexB.getValue() !== '' && (parseInt( indexB.getValue() ) < parseInt( val )) ) {
                        success = false;
                    }
                    return success;
                },
                solvencyIndexCText: this.snippets.validation.invalidValue
            } );

            me.callParent( arguments );
        },
        getItems: function(){
            var me = this;
            return [
                {
                    xtype: 'container',
                    layout: 'fit',
                    flex: 1,
                    align: 'center',
                    pack: 'start',
                    border: 0,
                    items: [
                        {
                            fieldLabel: me.snippets.labels.legitimateInterest,
                            emptyText: me.snippets.labels.legitimateInterest,
                            xtype: 'combo',
                            flex: 1,
                            id: 'legitimateKey',
                            name: 'legitimateKey',
                            width: '100%',
                            labelWidth: '30%',
                            padding: '20 5 0 5',
                            store: me.parentPanel.legitimateInterestStore,
                            queryMode: 'local',
                            forceSelection: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            validateOnBlur: false,
                            validateOnChange: false
                        },
                        {
                            fieldLabel: me.snippets.labels.reportLanguage,
                            emptyText: me.snippets.labels.reportLanguage,
                            xtype: 'combo',
                            flex: 1,
                            id: 'reportLanguageKey',
                            name: 'reportLanguageKey',
                            width: '100%',
                            labelWidth: '30%',
                            padding: '5 5 0 5',
                            store: me.parentPanel.reportLanguageStore,
                            queryMode: 'local',
                            forceSelection: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            validateOnBlur: false,
                            validateOnChange: false
                        }
                    ]
                }, {
                    xtype: 'fieldset',
                    id: 'fs_products_area',
                    name: 'fs_products_area',
                    region: 'center',
                    layout: 'anchor',
                    margin: '5 5 10 5',
                    title: '<div class="x-tool" style="border: none !important;" width="24" valign="top"><span id="reportcompany_prodtype_icon" class="x-form-help-icon" style="margin: 0;" data-qtip="' + me.snippets.tooltips.infoProducts + '" role="presentation"></span></div><div class="x-component x-fieldset-header-text x-component-default">' + me.snippets.labels.productTitle + '</div><div class="x-clear" role="presentation"></div>',
                    items: me.createCrefoProductsView()
                } ];
        },
        createCrefoProductsView: function(){
            var me = this;
            return [ me.createCountryProduct( me.snippets.labels.products.countries.de, "de", 1 ),
                {
                    xtype: 'box',
                    autoEl: {
                        tag: 'hr'
                    }
                },
                me.createCountryProduct( me.snippets.labels.products.countries.at, "at", 5 ),
                {
                    xtype: 'box',
                    autoEl: {
                        tag: 'hr'
                    }
                },
                me.createCountryProduct( me.snippets.labels.products.countries.lu, "lu", 9 )
            ];
        },
        createCountryProduct: function( labelCountry, idCountry, sequence ){
            var me = this;
            return Ext.create( 'Ext.container.Container', {
                autoShow: true,
                alias: 'widget.crefoconfig-tabs-reportcompany-container-product-' + idCountry,
                region: 'center',
                autoScroll: true,
                name: 'product-container-' + idCountry,
                border: 0,
                flex: 1,
                ui: 'shopware-ui',
                layout: 'anchor',
                defaults: {
                    anchor: '100%'
                },
                hidden: false,
                items: [
                    {
                        xtype: 'fieldcontainer',
                        hideLabel: true,
                        layout: 'hbox',
                        align: 'stretch',
                        defaults: {
                            flex: 1
                        },
                        items: [
                            {
                                xtype: 'label',
                                text: labelCountry,
                                flex: 0.4
                            },
                            {
                                xtype: 'label',
                                text: me.snippets.labels.products.titles.threshold,
                                flex: 1.3
                            },
                            {
                                xtype: 'label',
                                text: me.snippets.labels.products.titles.productType,
                                flex: 0.7
                            },
                            {
                                xtype: 'label',
                                text: me.snippets.labels.products.titles.creditRiskIndex,
                                flex: 1
                            }
                        ]
                    },
                    {
                        xtype: 'fieldcontainer',
                        hideLabel: true,
                        layout: 'hbox',
                        align: 'stretch',
                        // width: 0,
                        defaults: {
                            flex: 1
                        },
                        items: [
                            { xtype: 'label', text: "", flex: 0.4 },
                            {
                                xtype: 'fieldcontainer',
                                flex: 1.3,
                                hideLabel: true,
                                layout: 'hbox',
                                align: 'stretch',
                                items: [
                                    {
                                        xtype: 'label',
                                        style: 'text-align:right; padding-right: 10px; padding-top:5px;',
                                        text: me.snippets.labels.products.values.first + me.snippets.labels.parts.column,
                                        flex: 0.7
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: idCountry + '-' + sequence + '-value',
                                        id: idCountry + '-' + sequence + '-value',
                                        allowDecimals: true,
                                        decimalPrecision: 2,
                                        minValue: 0,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        vtype: 'basketValueThresholdA',
                                        validateOnChange: false,
                                        validateOnBlur: false,
                                        width: 70,
                                        allowBlank: false,
                                        blankText: me.snippets.validation.invalidValue,
                                        listeners: {
                                            'afterrender': function(){
                                                var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence );
                                                if( currRec !== null && currRec.get( 'threshold' ) !== undefined ) {
                                                    this.setValue( currRec.get( 'threshold' ) );
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
                                        style: 'padding-top:5px;',
                                        text: me.snippets.labels.products.currency,
                                        flex: 0.15
                                    }
                                ]
                            },
                            {
                                xtype: 'combo',
                                flex: 0.7,
                                queryMode: 'local',
                                triggerAction: 'all',
                                forceSelection: true,
                                editable: false,
                                hideLabel: true,
                                allowBlank: false,
                                blankText: me.snippets.validation.invalidValue,
                                name: idCountry + '-' + sequence + '-product',
                                id: idCountry + '-' + sequence + '-product',
                                displayField: 'nameWS',
                                valueField: 'keyWS',
                                store: me.parentPanel.productStore.countryFilter( idCountry ),
                                vtype: 'productType',
                                validateOnChange: false,
                                validateOnBlur: false,
                                listConfig: {
                                    tpl: new Ext.XTemplate(
                                        '<div class="my-boundlist-item-menu" style="font-size: 11px; padding: 4px 6px;cursor: pointer;position: relative;">&nbsp;</div>'
                                        + '<tpl for=".">'
                                        + '<div class="x-boundlist-item" style="color:black;">{literal}{nameWS}{/literal}</div>'
                                        + '</tpl>' ),
                                    listeners: {
                                        el: {
                                            delegate: '.my-boundlist-item-menu',
                                            'click': function(){
                                                var product = Ext.getCmp( idCountry + '-' + sequence + '-product' );
                                                product.clearValue();
                                                product.collapse();
                                            }
                                        }
                                    }
                                },
                                listeners: {
                                    'change': function( element, newValue ){
                                        if( Ext.isDefined( element.inputCell ) ) {
                                            var inputEl = element.inputCell.child( 'input' );
                                            inputEl.removeCls( "crefo-red-product" );
                                        }
                                        var currRec = this.getStore().countryFilter( idCountry ).findRecord( "keyWS", newValue );
                                        var solvencyIndex = Ext.getCmp( idCountry + '-' + sequence + '-value-index' );
                                        if( newValue === null ) {
                                            solvencyIndex.setDisabled( true );
                                        }
                                        if( currRec !== null ) {
                                            solvencyIndex.allowBlank = !currRec.get( 'solvencyIndexWS' );
                                            if( !currRec.get( 'solvencyIndexWS' ) ) {
                                                solvencyIndex.setDisabled( true );
                                            } else {
                                                solvencyIndex.setDisabled( false );
                                            }
                                            Ext.getCmp( idCountry + '-' + sequence + '-solvencyIndex' ).setValue( currRec.get( 'solvencyIndexWS' ) );
                                        }
                                        Ext.getCmp( idCountry + '-' + sequence + '-rawProduct' ).setValue( element.getRawValue() );
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
                                xtype: 'hiddenfield',
                                name: idCountry + '-' + sequence + '-rawProduct',
                                id: idCountry + '-' + sequence + '-rawProduct',
                                value: '',
                                hidden: true,
                                flex: 0,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence );
                                        if( currRec !== null ) {
                                            this.setValue( currRec.get( 'productTextWS' ) );
                                        } else {
                                            this.setValue( Ext.getCmp( idCountry + '-' + sequence + '-product' ).getRawValue() );
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'numberfield',
                                name: idCountry + '-' + sequence + '-value-index',
                                id: idCountry + '-' + sequence + '-value-index',
                                hideLabel: true,
                                disabled: true,
                                blankText: me.snippets.validation.invalidValue,
                                decimalPrecision: 0,
                                minValue: 100,
                                maxValue: 600,
                                minText: '',
                                maxText: '',
                                // Remove spinner buttons, and arrow key and mouse wheel listeners
                                hideTrigger: true,
                                keyNavEnabled: false,
                                mouseWheelEnabled: false,
                                enforceMaxLength: true,
                                maxLength: 3,
                                vtype: 'solvencyIndexA',
                                validateOnChange: false,
                                validateOnBlur: false,
                                maskRe: /\d/,
                                regex: /^\d\d\d$/,
                                regexText: '',
                                invalidText: '',
                                flex: 0.9,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence );
                                        if( currRec !== null && currRec.get( 'solvencyIndexWS' ) && currRec.get( 'threshold_index' ) !== undefined ) {
                                            this.setDisabled( false );
                                            this.setValue( currRec.get( 'threshold_index' ) );
                                            this.allowBlank = !currRec.get( 'solvencyIndexWS' );
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
                                xtype: 'hiddenfield',
                                name: idCountry + '-' + sequence + '-solvencyIndex',
                                id: idCountry + '-' + sequence + '-solvencyIndex',
                                value: '',
                                hidden: true,
                                flex: 0,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence );
                                        if( currRec !== null ) {
                                            this.setValue( currRec.get( 'solvencyIndexWS' ) );
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'label',
                                text: '',
                                flex: 0.1
                            }
                        ]
                    },
                    {
                        xtype: 'fieldcontainer',
                        hideLabel: true,
                        layout: 'hbox',
                        align: 'stretch',
                        defaults: {
                            flex: 1
                        },
                        items: [
                            { xtype: 'label', text: "", flex: 0.4 },
                            {
                                xtype: 'fieldcontainer',
                                flex: 1.3,
                                hideLabel: true,
                                layout: 'hbox',
                                align: 'stretch',
                                items: [
                                    {
                                        xtype: 'label',
                                        style: 'text-align:right; padding-right: 10px; padding-top:5px;',
                                        text: me.snippets.labels.products.values.between + me.snippets.labels.parts.column,
                                        flex: 0.7
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: idCountry + '-' + (sequence + 1) + '-value',
                                        id: idCountry + '-' + (sequence + 1) + '-value',
                                        decimalPrecision: 2,
                                        minValue: 0,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        width: 70,
                                        vtype: 'basketValueThresholdB',
                                        validateOnChange: false,
                                        validateOnBlur: false,
                                        blankText: me.snippets.validation.invalidValue,
                                        listeners: {
                                            'afterrender': function(){
                                                var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 1 );
                                                if( currRec !== null && currRec.get( 'threshold' ) !== undefined ) {
                                                    this.setValue( currRec.get( 'threshold' ) );
                                                }
                                            },
                                            'change': function( element, newValue ){
                                                var product = Ext.getCmp( idCountry + '-' + (sequence + 1) + '-product' );
                                                if( newValue !== null && newValue !== '' ) {
                                                    product.allowBlank = false;
                                                } else {
                                                    product.allowBlank = true;
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
                                        style: 'padding-top:5px;',
                                        text: me.snippets.labels.products.currency,
                                        flex: 0.15
                                    }
                                ]
                            },
                            {
                                xtype: 'combo',
                                flex: 0.7,
                                queryMode: 'local',
                                triggerAction: 'all',
                                blankText: me.snippets.validation.invalidValue,
                                forceSelection: true,
                                editable: false,
                                hideLabel: true,
                                name: idCountry + '-' + (sequence + 1) + '-product',
                                id: idCountry + '-' + (sequence + 1) + '-product',
                                displayField: 'nameWS',
                                valueField: 'keyWS',
                                store: me.parentPanel.productStore.countryFilter( idCountry ),
                                vtype: 'productType',
                                validateOnChange: false,
                                validateOnBlur: false,
                                listConfig: {
                                    tpl: new Ext.XTemplate(
                                        '<div class="my-boundlist-item-menu" style="font-size: 11px; padding: 4px 6px;cursor: pointer;position: relative;">&nbsp;</div>'
                                        + '<tpl for=".">'
                                        + '<div class="x-boundlist-item" style="color:black;">{literal}{nameWS}{/literal}</div>'
                                        + '</tpl>' ),
                                    listeners: {
                                        el: {
                                            delegate: '.my-boundlist-item-menu',
                                            'click': function(){
                                                var product = Ext.getCmp( idCountry + '-' + (sequence + 1) + '-product' );
                                                product.clearValue();
                                                product.collapse();
                                            }
                                        }
                                    }
                                },
                                listeners: {
                                    'change': function( element, newValue ){
                                        if( Ext.isDefined( element.inputCell ) ) {
                                            var inputEl = element.inputCell.child( 'input' );
                                            inputEl.removeCls( "crefo-red-product" );
                                        }
                                        var currRec = this.getStore().countryFilter( idCountry ).findRecord( "keyWS", newValue );
                                        var solvencyIndex = Ext.getCmp( idCountry + '-' + (sequence + 1) + '-value-index' );
                                        var basket = Ext.getCmp( idCountry + '-' + (sequence + 1) + '-value' );
                                        if( newValue === null ) {
                                            solvencyIndex.setDisabled( true );
                                            basket.allowBlank = true;
                                        } else {
                                            basket.allowBlank = false;
                                        }
                                        if( currRec !== null ) {
                                            solvencyIndex.allowBlank = !currRec.get( 'solvencyIndexWS' );
                                            if( !currRec.get( 'solvencyIndexWS' ) ) {
                                                solvencyIndex.setDisabled( true );
                                            } else {
                                                solvencyIndex.setDisabled( false );
                                            }
                                            Ext.getCmp( idCountry + '-' + (sequence + 1) + '-solvencyIndex' ).setValue( currRec.get( 'solvencyIndexWS' ) );
                                        }
                                        Ext.getCmp( idCountry + '-' + (sequence + 1) + '-rawProduct' ).setValue( element.getRawValue() );
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
                                xtype: 'hiddenfield',
                                name: idCountry + '-' + (sequence + 1) + '-rawProduct',
                                id: idCountry + '-' + (sequence + 1) + '-rawProduct',
                                value: '',
                                hidden: true,
                                flex: 0,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 1 );
                                        if( currRec !== null ) {
                                            this.setValue( currRec.get( 'productTextWS' ) );
                                        } else {
                                            this.setValue( Ext.getCmp( idCountry + '-' + (sequence + 1) + '-product' ).getRawValue() );
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'numberfield',
                                name: idCountry + '-' + (sequence + 1) + '-value-index',
                                id: idCountry + '-' + (sequence + 1) + '-value-index',
                                hideLabel: true,
                                layout: 'fit',
                                disabled: true,
                                blankText: me.snippets.validation.invalidValue,
                                decimalPrecision: 0,
                                minValue: 100,
                                maxValue: 600,
                                minText: '',
                                maxText: '',
                                // Remove spinner buttons, and arrow key and mouse wheel listeners
                                hideTrigger: true,
                                keyNavEnabled: false,
                                mouseWheelEnabled: false,
                                enforceMaxLength: true,
                                maxLength: 3,
                                vtype: 'solvencyIndexB',
                                validateOnChange: false,
                                validateOnBlur: false,
                                maskRe: /\d/,
                                regex: /^\d\d\d$/,
                                regexText: '',
                                invalidText: '',
                                flex: 0.9,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 1 );
                                        if( currRec !== null && currRec.get( 'solvencyIndexWS' ) && currRec.get( 'threshold_index' ) !== undefined ) {
                                            this.setDisabled( false );
                                            this.setValue( currRec.get( 'threshold_index' ) );
                                            this.allowBlank = !currRec.get( 'solvencyIndexWS' );
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
                                xtype: 'hiddenfield',
                                name: idCountry + '-' + (sequence + 1) + '-solvencyIndex',
                                id: idCountry + '-' + (sequence + 1) + '-solvencyIndex',
                                value: '',
                                hidden: true,
                                flex: 0,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 1 );
                                        if( currRec !== null ) {
                                            this.setValue( currRec.get( 'solvencyIndexWS' ) );
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'label',
                                text: '',
                                flex: 0.1
                            }
                        ]
                    },
                    {
                        xtype: 'fieldcontainer',
                        hideLabel: true,
                        layout: 'hbox',
                        align: 'stretch',
                        defaults: {
                            flex: 1
                        },
                        items: [
                            { xtype: 'label', text: "", flex: 0.4 },
                            {
                                xtype: 'fieldcontainer',
                                flex: 1.3,
                                hideLabel: true,
                                layout: 'hbox',
                                align: 'stretch',
                                items: [
                                    {
                                        xtype: 'label',
                                        style: 'text-align:right; padding-right: 10px; padding-top:5px;',
                                        text: me.snippets.labels.products.values.between + me.snippets.labels.parts.column,
                                        flex: 0.7
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: idCountry + '-' + (sequence + 2) + '-value',
                                        id: idCountry + '-' + (sequence + 2) + '-value',
                                        decimalPrecision: 2,
                                        minValue: 0,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        vtype: 'basketValueThresholdC',
                                        validateOnChange: false,
                                        validateOnBlur: false,
                                        blankText: me.snippets.validation.invalidValue,
                                        width: 70,
                                        listeners: {
                                            'afterrender': function(){
                                                var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 2 );
                                                if( currRec !== null && currRec.get( 'threshold' ) !== undefined ) {
                                                    this.setValue( currRec.get( 'threshold' ) );
                                                }
                                            },
                                            'change': function( element, newValue ){
                                                var product = Ext.getCmp( idCountry + '-' + (sequence + 2) + '-product' );
                                                if( newValue !== null && newValue !== '' ) {
                                                    product.allowBlank = false;
                                                } else {
                                                    product.allowBlank = true;
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
                                        style: 'padding-top:5px;',
                                        text: me.snippets.labels.products.currency,
                                        flex: 0.15
                                    }
                                ]
                            },
                            {
                                xtype: 'combo',
                                flex: 0.7,
                                queryMode: 'local',
                                triggerAction: 'all',
                                forceSelection: true,
                                editable: false,
                                hideLabel: true,
                                blankText: me.snippets.validation.invalidValue,
                                name: idCountry + '-' + (sequence + 2) + '-product',
                                id: idCountry + '-' + (sequence + 2) + '-product',
                                displayField: 'nameWS',
                                valueField: 'keyWS',
                                store: me.parentPanel.productStore.countryFilter( idCountry ),
                                vtype: 'productType',
                                validateOnChange: false,
                                validateOnBlur: false,
                                listConfig: {
                                    tpl: new Ext.XTemplate(
                                        '<div class="my-boundlist-item-menu" style="font-size: 11px; padding: 4px 6px;cursor: pointer;position: relative;">&nbsp;</div>'
                                        + '<tpl for=".">'
                                        + '<div class="x-boundlist-item" style="color:black;">{literal}{nameWS}{/literal}</div>'
                                        + '</tpl>' ),
                                    listeners: {
                                        el: {
                                            delegate: '.my-boundlist-item-menu',
                                            'click': function(){
                                                var product = Ext.getCmp( idCountry + '-' + (sequence + 2) + '-product' );
                                                product.clearValue();
                                                product.collapse();
                                            }
                                        }
                                    }
                                },
                                listeners: {
                                    'change': function( element, newValue ){
                                        if( Ext.isDefined( element.inputCell ) ) {
                                            var inputEl = element.inputCell.child( 'input' );
                                            inputEl.removeCls( "crefo-red-product" );
                                        }
                                        Ext.getCmp( 'useraccountId' ).validate();
                                        var currRec = this.getStore().countryFilter( idCountry ).findRecord( "keyWS", newValue );
                                        var solvencyIndex = Ext.getCmp( idCountry + '-' + (sequence + 2) + '-value-index' );
                                        var basket = Ext.getCmp( idCountry + '-' + (sequence + 2) + '-value' );
                                        if( newValue === null ) {
                                            solvencyIndex.setDisabled( true );
                                            basket.allowBlank = true;
                                        } else {
                                            basket.allowBlank = false;
                                        }
                                        if( currRec !== null ) {
                                            solvencyIndex.allowBlank = !currRec.get( 'solvencyIndexWS' );
                                            if( !currRec.get( 'solvencyIndexWS' ) ) {
                                                solvencyIndex.setDisabled( true );
                                            } else {
                                                solvencyIndex.setDisabled( false );
                                            }
                                            Ext.getCmp( idCountry + '-' + (sequence + 2) + '-solvencyIndex' ).setValue( currRec.get( 'solvencyIndexWS' ) );
                                        }
                                        Ext.getCmp( idCountry + '-' + (sequence + 2) + '-rawProduct' ).setValue( element.getRawValue() );
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
                                xtype: 'hiddenfield',
                                name: idCountry + '-' + (sequence + 2) + '-rawProduct',
                                id: idCountry + '-' + (sequence + 2) + '-rawProduct',
                                value: '',
                                hidden: true,
                                flex: 0,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 2 );
                                        if( currRec !== null ) {
                                            this.setValue( currRec.get( 'productTextWS' ) );
                                        } else {
                                            this.setValue( Ext.getCmp( idCountry + '-' + (sequence + 2) + '-product' ).getRawValue() );
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'numberfield',
                                name: idCountry + '-' + (sequence + 2) + '-value-index',
                                id: idCountry + '-' + (sequence + 2) + '-value-index',
                                hideLabel: true,
                                disabled: true,
                                blankText: me.snippets.validation.invalidValue,
                                decimalPrecision: 0,
                                minValue: 100,
                                maxValue: 600,
                                minText: '',
                                maxText: '',
                                // Remove spinner buttons, and arrow key and mouse wheel listeners
                                hideTrigger: true,
                                keyNavEnabled: false,
                                mouseWheelEnabled: false,
                                enforceMaxLength: true,
                                maxLength: 3,
                                vtype: 'solvencyIndexC',
                                validateOnChange: false,
                                validateOnBlur: false,
                                maskRe: /\d/,
                                regex: /^\d\d\d$/,
                                regexText: '',
                                invalidText: '',
                                flex: 0.9,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 2 );
                                        if( currRec !== null && currRec.get( 'solvencyIndexWS' ) && currRec.get( 'threshold_index' ) !== undefined ) {
                                            this.setDisabled( false );
                                            this.setValue( currRec.get( 'threshold_index' ) );
                                            this.allowBlank = !currRec.get( 'solvencyIndexWS' );
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
                                xtype: 'hiddenfield',
                                name: idCountry + '-' + (sequence + 2) + '-solvencyIndex',
                                id: idCountry + '-' + (sequence + 2) + '-solvencyIndex',
                                value: '',
                                hidden: true,
                                flex: 0,
                                listeners: {
                                    'afterrender': function(){
                                        var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 2 );
                                        if( currRec !== null ) {
                                            this.setValue( currRec.get( 'solvencyIndexWS' ) );
                                        }
                                    }
                                }
                            },
                            {
                                xtype: 'label',
                                text: '',
                                flex: 0.1
                            }
                        ]
                    },
                    {
                        xtype: 'fieldcontainer',
                        hideLabel: true,
                        layout: 'hbox',
                        align: 'stretch',
                        defaults: {
                            flex: 1
                        },
                        items: [
                            { xtype: 'label', text: "", flex: 0.4 },
                            {
                                xtype: 'fieldcontainer',
                                flex: 1.28,
                                hideLabel: true,
                                layout: 'hbox',
                                items: [
                                    {
                                        xtype: 'label',
                                        style: 'text-align:right; padding-right: 10px; padding-top:5px;',
                                        text: me.snippets.labels.products.values.last + me.snippets.labels.parts.column,
                                        flex: 0.7
                                    },
                                    {
                                        xtype: 'numberfield',
                                        name: idCountry + '-' + (sequence + 3) + '-value',
                                        id: idCountry + '-' + (sequence + 3) + '-value',
                                        decimalPrecision: 2,
                                        minValue: 0,
                                        // Remove spinner buttons, and arrow key and mouse wheel listeners
                                        hideTrigger: true,
                                        keyNavEnabled: false,
                                        mouseWheelEnabled: false,
                                        vtype: 'basketValueThresholdD',
                                        validateOnChange: false,
                                        validateOnBlur: false,
                                        width: 70,
                                        listeners: {
                                            'afterrender': function(){
                                                var currRec = me.parentPanel.productConfigStore.findRecord( 'sequence', sequence + 3 );
                                                if( currRec !== null && currRec.get( 'threshold' ) !== undefined ) {
                                                    this.setValue( currRec.get( 'threshold' ) );
                                                }
                                            }
                                        }
                                    },
                                    {
                                        xtype: 'label',
                                        style: 'padding-top:5px;',
                                        text: me.snippets.labels.products.currency,
                                        flex: 0.15
                                    }
                                ]
                            },
                            {
                                xtype: "displayfield",
                                value: '',
                                flex: 1.7
                            }
                        ]
                    }
                ]
            } );
        },
        getProductBlankText: function(){
            var me = this;
            if( me.parentPanel.productStore.getCount() === 0 ) {
                me.parentPanel.getForm().getFields().each( function( f ){
                    if( !f.allowBlank && f.id.indexOf( "-product" ) > -1 && (f.getValue() === null || !Ext.isDefined( f.getValue() )) ) {
                        Ext.getCmp( f.id ).markInvalid( me.snippets.errors.noProducts );
                    }
                } );
            }
        }
    } );
// {/block}

