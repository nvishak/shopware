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
//{block name="backend/crefo_configuration/controller/private_person_config"}
Ext.define( 'Shopware.apps.CrefoConfiguration.controller.PrivatePersonConfig', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        errors: {
            noProducts: '{s name="crefoconfig/reports/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,'
            + 'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
            hasRedProducts: '{s name="crefoconfig/reports/hasRedProducts"}ACHTUNG! Die Mitgliedskennung '
            + 'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung '
            + 'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}',
            unsuccessfulLogon: '{s name="crefo/messages/unsuccessful_logon"}Die Anmeldung konnte nicht durchgeführt werden.<br/>Bitte überprüfen Sie Ihre Zugangsdaten oder versuchen Sie es zu einem späteren Zeitpunkt nochmal.{/s}'
        },
        validation: {
            errorNoValidMessage: '{s name="crefo/validation/checkFields"}An error has occurred (plausibility check).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}',
            detailedError: '{s name="crefo/validation/detailedError"}Es gibt detaillierte Fehlermeldungen.{/s}'
        },
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}'
    },
    reportPrivatePersonDefaultValues: {
        legitimateInterest: 'LEIN-100'
    },
    init: function(){
        var me = this;
        me.mainController = me.getController( 'Main' );
        me.control( {
            'crefoconfig-tabs-report-private-person-panel': {
                saveReportPrivatePerson: me.onSaveReportPrivatePerson
            },
            'crefoconfig-tabs-report-private-person-header-container': {
                performLogonReportPrivatePerson: me.onPerformLogonReportPrivatePerson
            },
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            }
        } );
        me.callParent( arguments );
    },
    /**
     * Is fired, when the tab is changed
     * Automatically selects the countries/shops and sets the surcharge
     * @param tabsPanel Contains the tabs-panel
     * @param newTab Contains the new tab, which was clicked now
     * @param oldTab Contains the old tab, which was opened before the new tab
     * @param formPanel Contains the form-panel of the tab
     */
    onChangeTab: function( tabsPanel, newTab, oldTab, formPanel ){
        var me = this,
            newTabPanel = newTab.items.items[ 0 ];
        if( /ReportPrivatePersonPanel/ig.test( newTabPanel.id ) ) {
            try {
                Ext.getCmp( 'crefoConfig-reportPrivatePerson-saveBtn' ).setDisabled( true );
                newTabPanel.up( 'window' ).setLoading( true );
                if( newTabPanel.tabSeen ) {
                    me.resetRadioSelection( newTabPanel );
                    var useraccountCbx = Ext.getCmp( 'privatePersonUserAccountId' ),
                        userAccountValue = Ext.isEmpty( newTabPanel.reportPrivatePersonStore.first() ) ? null : newTabPanel.reportPrivatePersonStore.first().get( 'userAccountId' );
                    useraccountCbx.suspendEvents( false );
                    useraccountCbx.setValue( userAccountValue );
                    useraccountCbx.resumeEvents();
                } else {
                    newTabPanel.tabSeen = true;
                }
                if( !Ext.isDefined( Ext.getCmp( 'reportPrivatePersonContainer' ) ) ) {
                    me.mainController.changePanelContainer( newTabPanel, Ext.getCmp( 'reportPrivatePersonContainerError' ), 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Container', {
                        parentPanel: newTabPanel
                    } );
                }
                newTabPanel.reportPrivatePersonStore.load( {
                    callback: function(){
                        var recordReportStore = this.first();
                        var useraccountId = null;
                        if( !Ext.isEmpty( recordReportStore ) && Ext.isDefined( recordReportStore.get( 'userAccountId' ) ) ) {
                            useraccountId = recordReportStore.get( 'userAccountId' );
                        }
                        me.onPerformLogonReportPrivatePerson( useraccountId );
                    }
                } );
            } catch( e ) {
                if( !Ext.isEmpty( console ) ) {
                    console.error( e );
                }
                newTabPanel.up( 'window' ).setLoading( false );
            }
        }
    },
    onSaveReportPrivatePerson: function(){
        var me = this,
            panel = Ext.getCmp( 'ReportPrivatePersonPanel' ),
            windowConfig = Ext.getCmp( 'CrefoConfigurationWindow' );

        var values = panel.getForm().getValues();

        if( values.privatePersonUserAccountId !== '' && !me.mainController.isFormValid( panel ) ) {
            return;
        }

        if( values.privatePersonUserAccountId === '' ) {
            panel.getForm().reset();
            values = panel.getForm().getValues();
        }

        windowConfig.setLoading( true );
        Ext.Ajax.request( {
            url: '{url controller=CrefoConfiguration action=saveReportPrivatePerson}',
            method: 'POST',
            params: values,
            success: function( response ){
                try {
                    if( !me.mainController.isJson( response.responseText ) ) {
                        throw new Error( "no response" );
                    }
                    var result = Ext.JSON.decode( response.responseText );
                    if( !result.success ) {
                        throw new Error( "not successful" );
                    }
                    panel.reportPrivatePersonStore.load();
                    panel.productsDbStore.load( {
                        callback: function(){
                            me.removeRedUnselectedProducts();
                            windowConfig.setLoading( false );
                            me.mainController.showStickyMessage( '', me.snippets.success );
                        }
                    } );
                } catch( e ) {
                    // console.log( e );
                    windowConfig.setLoading( false );
                }
            },
            failure: function(){
                me.mainController.handleFailure( windowConfig, true );
            }
        } );
    },
    /**
     *
     * @param newAccount
     * @param takeValuesFromConfig boolean
     */
    onPerformLogonReportPrivatePerson: function( newAccount ){
        var me = this,
            panel = Ext.getCmp( 'ReportPrivatePersonPanel' ),
            windowConfig = Ext.getCmp( 'CrefoConfigurationWindow' ),
            input = Object.create( Object.prototype );
        input.useraccountId = newAccount;
        windowConfig.setLoading( true );
        if( !Ext.isDefined( Ext.getCmp( 'reportPrivatePersonContainer' ) ) ) {
            me.mainController.changePanelContainer( panel, Ext.getCmp( 'reportPrivatePersonContainerError' ), 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Container', {
                parentPanel: panel
            } );
        }
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=logonReportPrivatePerson}',
            method: 'POST',
            params: input,
            success: function( response ){
                try {
                    if( !me.mainController.isJson( response.responseText ) ) {
                        throw new Error( "no response" );
                    }
                    var result = Ext.JSON.decode( response.responseText );
                    if( !result.success && result.errors !== 'null-account' ) {
                        throw result.errors;
                    }
                    if( result.errors === 'null-account' ) {
                        panel.getForm().reset();
                        panel.legitimateInterestStore.loadData( [], false );
                        panel.productCwsStore.loadData( [], false );
                        var productsArea = Ext.getCmp( 'private_person_products_area' );
                        productsArea.removeAll( true );
                    } else {
                        me.processLogonResult( panel, result.data );
                        var recordPrivateConfig = panel.reportPrivatePersonStore.first();
                        if( !Ext.isEmpty( recordPrivateConfig ) && !Ext.isEmpty( recordPrivateConfig.get( 'userAccountId' ) ) ) {
                            me.mainController.isFormValid( panel );
                        } else {
                            Ext.getCmp( 'privatePersonUserAccountId' ).validate();
                        }
                        me.checkProductsAvailability( panel );
                    }
                    Ext.getCmp( 'crefoConfig-reportPrivatePerson-saveBtn' ).setDisabled( false );
                } catch( e ) {
                    if( !Ext.isEmpty( console ) ) {
                        console.error( e );
                    }
                    Ext.getCmp( 'crefoConfig-reportPrivatePerson-saveBtn' ).setDisabled( true );
                    var container = Ext.getCmp( 'reportPrivatePersonContainer' );
                    if( Ext.isDefined( container ) ) {
                        me.mainController.changePanelContainer( panel, container, 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.ContainerError', {
                            errorText: me.snippets.errors.unsuccessfulLogon
                        } );
                        Ext.getCmp( 'privatePersonUserAccountId' ).validate();
                    }
                    me.mainController.showStickyMessageFromError( e );
                } finally {
                    windowConfig.setLoading( false );
                    windowConfig.doLayout();
                }
            },
            failure: function( response ){
                Ext.getCmp( 'crefoConfig-reportPrivatePerson-saveBtn' ).setDisabled( true );
                var container = Ext.getCmp( 'reportPrivatePersonContainer' );
                if( Ext.isDefined( container ) ) {
                    me.mainController.changePanelContainer( panel, container, 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.ContainerError', {
                        errorText: me.snippets.errors.unsuccessfulLogon
                    } );
                    Ext.getCmp( 'privatePersonUserAccountId' ).validate();
                }
                var result = null,
                    responseText = response.responseText.substr( 0, response.responseText.lastIndexOf( "}" ) + 1 );
                try {
                    if( !me.mainController.isJson( responseText ) ) {
                        result = Object.create( Object.prototype );
                        result.errors = Object.create( Object.prototype );
                        result.errors.errorCode = true;
                        throw new Error( "no response" );
                    }
                    result = Ext.JSON.decode( responseText );
                    if( !result.success ) {
                        throw result.errors;
                    }
                } catch( e ) {
                    if( !Ext.isEmpty( console ) ) {
                        console.error( e );
                    }
                    if( Ext.isEmpty( e.errorCode ) && Ext.isObject( e ) ) {
                        var errors = [];
                        for( var i in e ) {
                            if( e.hasOwnProperty( i ) ) {
                                errors.push( e[ i ] );
                            }
                        }
                        me.mainController.showStickyMessageFromError( errors[ 0 ] );
                    } else {
                        me.mainController.showStickyMessageFromError( result.errors );
                    }
                } finally {
                    windowConfig.setLoading( false );
                    windowConfig.doLayout();
                }
            }
        } );
    },
    processLogonResult: function( panel, data ){
        var me = this,
            container = Ext.getCmp( 'reportPrivatePersonContainer' ),
            legitimateInterestCbx = Ext.getCmp( 'legitimateKeyPrivatePerson' );
        me.mainController.combineNewDataWithOldRecord( legitimateInterestCbx, data.legitimateInterests, me.reportPrivatePersonDefaultValues.legitimateInterest );
        panel.legitimateInterestStore.loadData( data.legitimateInterests, false );
        panel.productCwsStore.loadData( data.products, false );
        var productsArea = Ext.getCmp( 'private_person_products_area' );
        Ext.suspendLayouts();
        if( productsArea.items.getCount() > 0 ) {
            var cmpToRemove = [],
                checkRadioGroup = false;
            productsArea.items.each( function( cmp, id ){
                if( !Ext.isDefined( panel.productsDbStore.first() ) && !Ext.isDefined( panel.productCwsStore.first() ) ) {
                    cmpToRemove.push( cmp );
                } else {
                    if( !(/radio-group-bonima-products/i.test( cmp.id )) ) {
                        cmpToRemove.push( cmp );
                    } else {
                        checkRadioGroup = true;
                    }
                }
            } );
            for( i = 0; i < cmpToRemove.length; i++ ) {
                productsArea.remove( cmpToRemove[ i ], true );
            }
            if( checkRadioGroup ) {
                me.verifyRadioButtonProducts( panel, data.products );
            }
        }
        productsArea.add( container.createBonimaProductsView() );
        me.markRedBonimaProducts( panel, data.products );
        container.doLayout();
        Ext.resumeLayouts( true );
        if( legitimateInterestCbx.getValue() === null && panel.legitimateInterestStore.findRecord( 'keyWS', panel.reportPrivatePersonStore.first().get( "legitimateKey" ) ) !== null ) {
            legitimateInterestCbx.setValue( panel.reportPrivatePersonStore.first().get( "legitimateKey" ) );
        }
        if( legitimateInterestCbx.getValue() === null ) {
            legitimateInterestCbx.setValue( me.reportPrivatePersonDefaultValues.legitimateInterest );
        }
    },
    verifyRadioButtonProducts: function( panel, newProducts ){
        var BPIProduct = Ext.getCmp( 'bonimaPoolIdentContainer' ),
            BPIPProduct = Ext.getCmp( 'bonimaPoolIdentPremiumContainer' ),
            radioGroup = Ext.getCmp( 'radio-group-bonima-products' );
        if( Ext.isDefined( BPIProduct ) ) {
            var checked = Ext.getCmp( 'bonimaPoolIdentProductRadio' ).getValue(),
                key = panel.allowedBonimaProducts.findRecord( 'id', panel.productKeysIds.bonimaPoolIdent ).get( 'keyWS' ),
                foundProductInTheResponse = false;
            if( !Ext.isEmpty( newProducts ) ) {
                for( i = 0; i < newProducts.length; i++ ) {
                    if( key === newProducts[ i ].keyWS ) {
                        foundProductInTheResponse = true;
                    }
                }
            }
            if( !checked && !foundProductInTheResponse ) {
                radioGroup.remove( BPIProduct, true );
            }
            if( BPIProduct.isBPIProductChecked() ) {
                Ext.getCmp( 'bonimaPoolIdentProductRadio' ).setValue( true );
            }
        }
        if( Ext.isDefined( BPIPProduct ) ) {
            var checked = Ext.getCmp( 'bonimaPoolIdentPremiumProductRadio' ).getValue(),
                key = panel.allowedBonimaProducts.findRecord( 'id', panel.productKeysIds.bonimaPoolIdentPremium ).get( 'keyWS' ),
                foundProductInTheResponse = false;
            if( !Ext.isEmpty( newProducts ) ) {
                for( i = 0; i < newProducts.length; i++ ) {
                    if( key === newProducts[ i ].keyWS ) {
                        foundProductInTheResponse = true;
                    }
                }
            }
            if( !checked && !foundProductInTheResponse ) {
                radioGroup.remove( BPIPProduct, true );
            }
            if( BPIPProduct.isBPIPProductChecked() ) {
                Ext.getCmp( 'bonimaPoolIdentPremiumProductRadio' ).setValue( true );
            }
        }
    },
    markRedBonimaProducts: function( panel, newProducts ){
        var me = this;
        if( Ext.isEmpty( panel.productsDbStore.first() ) ) {
            return;
        }
        panel.productsDbStore.queryBy( function( record, id ){
            var key = panel.allowedBonimaProducts.findRecord( 'id', record.get( 'productKeyWS' ) ).get( 'keyWS' ),
                availability = false;
            if( !Ext.isEmpty( newProducts ) ) {
                for( i = 0; i < newProducts.length; i++ ) {
                    key === newProducts[ i ].keyWS ? availability = true : null;
                }
            }
            var radioCmp = Ext.getCmp( 'bonimaPoolIdentProductRadio' );
            if( panel.productKeysIds.bonimaPoolIdent === record.get( 'productKeyWS' ) && Ext.isDefined( radioCmp ) ) {
                me.colorRadioComponent( availability, radioCmp );
            }
            radioCmp = Ext.getCmp( 'bonimaPoolIdentPremiumProductRadio' );
            if( panel.productKeysIds.bonimaPoolIdentPremium === record.get( 'productKeyWS' ) && Ext.isDefined( radioCmp ) ) {
                me.colorRadioComponent( availability, radioCmp );
            }
            record.set( 'isProductAvailable', availability );
        } );
    },
    colorRadioComponent: function( availability, cmp ){
        if( availability && cmp.hasCls( 'crefo-red-product' ) ) {
            cmp.removeCls( 'crefo-red-product' );
            return;
        }
        if( !availability && !cmp.hasCls( 'crefo-red-product' ) ) {
            cmp.addCls( 'crefo-red-product' );
            return;
        }
    },
    checkProductsAvailability: function( panel ){
        var me = this,
            productsChecked = [];
        if( panel.productsDbStore.first() === null || Ext.isEmpty( panel.productsDbStore.first() ) ) {
            return;
        }
        panel.productsDbStore.queryBy( function( record, id ){
            if( Ext.isDefined( record.get( 'isProductAvailable' ) )
                && !record.get( 'isProductAvailable' )
                && !(parseInt( record.get( 'productKeyWS' ) ) in productsChecked) ) {
                var productKeyId = parseInt( record.get( 'productKeyWS' ) ),
                    containerId = panel.getBonimaContainerType( productKeyId ),
                    containerProduct = Ext.getCmp( containerId );
                productsChecked.push( productKeyId );
                var radio = containerProduct.down( 'radio' );
                radio.invalidText = me.snippets.errors.hasRedProducts;
                radio.markInvalid( me.snippets.errors.hasRedProducts );
            }
        } );
    },
    resetRadioSelection: function( panel ){
        var me = this,
            form = panel.getForm();
        form.getFields().each( function( f ){
            if( f.id === panel.bonimaRadioIds[ panel.productKeysIds.bonimaPoolIdent ] || f.id === panel.bonimaRadioIds[ panel.productKeysIds.bonimaPoolIdentPremium ] ) {
                f.reset();
            }
        } );
    },
    removeRedUnselectedProducts: function(){
        var me = this,
            panel = Ext.getCmp( 'ReportPrivatePersonPanel' ),
            BPIProduct = Ext.getCmp( 'bonimaPoolIdentContainer' ),
            BPIPProduct = Ext.getCmp( 'bonimaPoolIdentPremiumContainer' ),
            radioGroup = Ext.getCmp( 'radio-group-bonima-products' );
        Ext.suspendLayouts();
        if( Ext.isDefined( BPIProduct ) ) {
            radioButton = Ext.getCmp( panel.bonimaRadioIds[ panel.productKeysIds.bonimaPoolIdent ] );
            if( !radioButton.getValue() && radioButton.hasCls( 'crefo-red-product' ) ) {
                radioGroup.remove( BPIProduct, true );
            }
        }
        if( Ext.isDefined( BPIPProduct ) ) {
            radioButton = Ext.getCmp( panel.bonimaRadioIds[ panel.productKeysIds.bonimaPoolIdentPremium ] );
            if( !radioButton.getValue() && radioButton.hasCls( 'crefo-red-product' ) ) {
                radioGroup.remove( BPIPProduct, true );
            }
        }
        Ext.getCmp( 'reportPrivatePersonContainer' ).doLayout();
        Ext.resumeLayouts( true );
    }
} )
;
//{/block}
