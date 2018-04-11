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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/container"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Container',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-report-private-person-container',
        region: 'center',
        autoScroll: true,
        name: 'reportPrivatePersonContainer',
        id: 'reportPrivatePersonContainer',
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
                legitimateInterest: '{s name="crefoconfig/view/tabs/reportprivateperson/panel/labels/legitimate_interest"}Berechtigtes Interesse{/s}',
                productTitle: '{s name="crefoconfig/view/tabs/reportprivateperson/container/labels/title_products_area"}Produktarten{/s}',
            },
            tooltips: {
                infoProducts: '{s name="crefoconfig/view/tabs/reportprivateperson/container/infoProducts"}Diese Software-Version kann die folgenden Produktarten für Privatpersonen verarbeiten:' +
                '<br/><br/><p>Bonima Score Pool Ident</p><p>Bonima Score Pool Ident Premium</p><br/><br/>' +
                'Bei beiden Produktarten ist die Eingabe von Scorebereichen notwendig,innerhalb derer die Bonitätsprüfung bestanden ist (Wertebereich 0-99999).{/s}'
            },
            errors: {
                noProducts: '{s name="crefoconfig/reports/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,'
                + 'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
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

            me.items = me.getItems();

            Ext.apply( Ext.form.field.VTypes, {
                legitimateVType: function( val, field ){
                    var account = Ext.getCmp( 'privatePersonUserAccountId' );
                    if( account === null || !Ext.isDefined( account ) || account === '' ) {
                        return true;
                    }
                    if( val !== null || Ext.isDefined( val ) ) {
                        return true;
                    }
                    return false;
                },
                legitimateVTypeText: me.snippets.validation.invalidValue,
                basketMinVType: function( val, field ){
                    var arrayId = field.id.split( "_" ),
                        basketMaxId = arrayId[ 0 ] + "_" + arrayId[ 1 ] + "_maxVal",
                        basketMaxCmp = Ext.getCmp( basketMaxId );
                    if( Ext.isEmpty( basketMaxCmp.getValue() ) ) {
                        return true;
                    }
                    return field.getValue() < basketMaxCmp.getValue();
                },
                basketMinVTypeText: me.snippets.validation.invalidValue,
                basketMaxVType: function( val, field ){
                    var arrayId = field.id.split( "_" ),
                        basketMinId = arrayId[ 0 ] + "_" + arrayId[ 1 ] + "_minVal",
                        basketMinCmp = Ext.getCmp( basketMinId );
                    return basketMinCmp.getValue() < field.getValue();
                },
                basketMaxVTypeText: me.snippets.validation.invalidValue,
                bonimaScoreFromVType: function( val, field ){
                    var arrayId = field.id.split( "_" ),
                        toCmpId = '';
                    for( var i = 0; i < arrayId.length - 1; i++ ) {
                        toCmpId += arrayId[ i ] + "_";
                    }
                    toCmpId += "to";
                    var toCmp = Ext.getCmp( toCmpId );
                    if( Ext.isEmpty( toCmp.getValue() ) ) {
                        return true;
                    }
                    return parseInt( field.getValue() ) <= parseInt( toCmp.getValue() );
                },
                bonimaScoreFromVTypeText: me.snippets.validation.invalidValue,
                bonimaScoreToVType: function( val, field ){
                    var arrayId = field.id.split( "_" ),
                        fromCmpId = '';
                    for( var i = 0; i < arrayId.length - 1; i++ ) {
                        fromCmpId += arrayId[ i ] + "_";
                    }
                    fromCmpId += "from";
                    var fromCmp = Ext.getCmp( fromCmpId );
                    if( Ext.isEmpty( fromCmp.getValue() ) ) {
                        return true;
                    }
                    return parseInt( fromCmp.getValue() ) <= parseInt( field.getValue() );
                },
                bonimaScoreToVTypeText: me.snippets.validation.invalidValue
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
                            xtype: me.createTextContainer( '' )
                        },
                        {
                            fieldLabel: me.snippets.labels.legitimateInterest,
                            emptyText: me.snippets.labels.legitimateInterest,
                            xtype: 'combo',
                            flex: 1,
                            id: 'legitimateKeyPrivatePerson',
                            name: 'legitimateKeyPrivatePerson',
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
                            validateOnChange: false,
                            vtype: 'legitimateVType'
                        }
                    ]
                }, {
                    xtype: 'fieldset',
                    id: 'private_person_products_area',
                    name: 'private_person_products_area',
                    width: '100%',
                    margin: '5 5 10 5',
                    title: '<div class="x-tool" style="border: none !important;" width="24" valign="top"><span id="report_private_person_products_icon" class="x-form-help-icon" style="margin: 0;" data-qtip="' + me.snippets.tooltips.infoProducts + '" role="presentation"></span></div><div class="x-component x-fieldset-header-text x-component-default">' + me.snippets.labels.productTitle + '</div><div class="x-clear" role="presentation"></div>',
                    items: me.createBonimaProductsView(),
                    defaults: {
                        labelWidth: 90,
                        anchor: '100%',
                        layout: {
                            type: 'vbox',
                            defaultMargins: { top: 0, right: 5, bottom: 0, left: 0 }
                        }
                    }
                }
            ];
        },
        createBonimaProductsView: function(){
            var me = this,
                productsView = [],
                radioGroupItems = [],
                account = Ext.getCmp( 'privatePersonUserAccountId' );

            if( account.getValue() === null || !Ext.isDefined( account.getValue() ) || account.getValue().length === 0 ) {
                return productsView;
            }
            if( !Ext.isDefined( me.parentPanel.productsDbStore.first() ) && !Ext.isDefined( me.parentPanel.productCwsStore.first() ) ) {
                productsView.push( { xtype: me.createTextContainer( me.snippets.errors.noProducts ) } );
            } else {
                if( me.hasBonimaPoolIdentProduct() && !Ext.isDefined( Ext.getCmp( 'bonimaPoolIdentContainer' ) ) ) {
                    radioGroupItems.push( Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.products.BonimaPoolIdentContainer', {
                        parentPanel: me.parentPanel
                    } ) );
                }
                if( me.hasBonimaPoolIdentPremiumProduct() && !Ext.isDefined( Ext.getCmp( 'bonimaPoolIdentPremiumContainer' ) ) ) {
                    radioGroupItems.push( Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.products.BonimaPoolIdentPremiumContainer', {
                        parentPanel: me.parentPanel
                    } ) );
                }
                if( radioGroupItems.length > 0 && !Ext.isDefined( Ext.getCmp( 'radio-group-bonima-products' ) ) ) {
                    var radioGroup = {
                        xtype: 'radiogroup',
                        id: 'radio-group-bonima-products',
                        columns: 1,
                        width: '100%',
                        vertical: true,
                        items: radioGroupItems,
                        allowBlank: false,
                        blankText: me.snippets.validation.invalidValue
                    };
                    productsView.push( radioGroup );
                } else if( radioGroupItems.length > 0 ) {
                    var radioGroup = Ext.getCmp( 'radio-group-bonima-products' );
                    Ext.Array.each( radioGroupItems, function( cmp, index, radioGroupItSelf ){
                        radioGroup.add( cmp );
                    } );
                    productsView.push( radioGroup );
                }
            }
            return productsView;
        },
        hasBonimaPoolIdentProduct: function(){
            var me = this,
                key = me.parentPanel.allowedBonimaProducts.findRecord( 'id', me.parentPanel.productKeysIds.bonimaPoolIdent ).get( 'keyWS' );
            recordDB = me.parentPanel.productsDbStore.findRecord( 'productKeyWS', me.parentPanel.productKeysIds.bonimaPoolIdent );
            recordCWS = me.parentPanel.productCwsStore.findRecord( 'keyWS', key );
            return !Ext.isEmpty( recordDB ) || !Ext.isEmpty( recordCWS );
        },
        hasBonimaPoolIdentPremiumProduct: function(){
            var me = this,
                key = me.parentPanel.allowedBonimaProducts.findRecord( 'id', me.parentPanel.productKeysIds.bonimaPoolIdentPremium ).get( 'keyWS' );
            recordDB = me.parentPanel.productsDbStore.findRecord( 'productKeyWS', me.parentPanel.productKeysIds.bonimaPoolIdentPremium );
            recordCWS = me.parentPanel.productCwsStore.findRecord( 'keyWS', key );
            return !Ext.isEmpty( recordDB ) || !Ext.isEmpty( recordCWS );
        },
        validateReportPrivatePersonPanel: function(){
            var me = this;
            formPnl = Ext.getCmp( 'ReportPrivatePersonPanel' );
            formPnl.getForm().getFields().each( function( f ){
                f.validate();
            } );
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
        }
    } );
// {/block}

