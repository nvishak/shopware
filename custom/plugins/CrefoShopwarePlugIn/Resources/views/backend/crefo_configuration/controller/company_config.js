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
//{block name="backend/crefo_configuration/controller/company_config"}
Ext.define( 'Shopware.apps.CrefoConfiguration.controller.CompanyConfig', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        errors: {
            noProducts: '{s name="crefoconfig/controller/crefo_configuration/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,'
            + 'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
            hasRedProducts: '{s name="crefoconfig/controller/crefo_configuration/hasRedProducts"}ACHTUNG! Die Mitgliedskennung '
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
    reportCompaniesDefaultValues: {
        reportLanguage: 'de',
        legitimateInterest: 'LEIN-100'
    },
    init: function(){
        var me = this;
        me.mainController = me.getController( 'Main' );
        me.control( {
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            },
            'crefoconfig-tabs-reportcompany-container-header': {
                performLogonReport: me.onPerformLogonReportCompany
            },
            'crefoconfig-tabs-reportcompany-panel': {
                saveReportCompanies: me.onSaveReportCompanies
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
        if( /reportCompanyPanel/ig.test( newTabPanel.id ) ) {
            try {
                newTabPanel.up( 'window' ).down( "button[name=crefoConfig-reportCompany-saveBtn]" ).setDisabled( true );
                newTabPanel.up( 'window' ).setLoading( true );
                if( newTabPanel.tabSeen ) {
                    var userAccountCbx = Ext.getCmp( 'useraccountId' ),
                        userAccountValue = Ext.isEmpty( newTabPanel.reportCompanyStore.first() ) ? null : newTabPanel.reportCompanyStore.first().get( 'useraccountId' );
                    userAccountCbx.suspendEvents( false );
                    userAccountCbx.setValue( userAccountValue );
                    userAccountCbx.resumeEvents();
                } else {
                    newTabPanel.tabSeen = true;
                }
                if( Ext.isDefined( Ext.getCmp( 'reportCompanyContainerError' ) ) ) {
                    me.mainController.changePanelContainer( newTabPanel, Ext.getCmp( 'reportCompanyContainerError' ), 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Container', {
                        parentPanel: newTabPanel
                    } );
                }
                newTabPanel.reportCompanyStore.load( {
                    callback: function(){
                        var recordRCS = this.first();
                        var userAccountId = null;
                        if( !Ext.isEmpty( recordRCS ) && recordRCS.get( 'useraccountId' ) !== undefined ) {
                            userAccountId = recordRCS.get( 'useraccountId' );
                        }
                        me.onPerformLogonReportCompany( userAccountId, newTabPanel, true );
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
    onSaveReportCompanies: function( panel ){
        var me = this,
            reportCompanyStore = panel.reportCompanyStore,
            productConfigStore = panel.productConfigStore,
            window = Ext.getCmp( 'CrefoConfigurationWindow' );

        var values = panel.getForm().getValues();

        if( values.useraccountId !== '' && !me.mainController.isFormValid( panel ) ) {
            return;
        }

        if( values.useraccountId === '' ) {
            panel.getForm().reset();
            values = panel.getForm().getValues();
        }

        window.setLoading( true );
        Ext.Ajax.request( {
            url: '{url controller=CrefoConfiguration action=saveReportCompanies}',
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
                    reportCompanyStore.load();
                    productConfigStore.load( {
                        callback: function(){
                            me.resetThresholdIndexes( panel );
                            window.setLoading( false );
                            me.mainController.showStickyMessage( '', me.snippets.success );
                        }
                    } );
                } catch( e ) {
                    window.setLoading( false );
                }
            },
            failure: function(){
                me.mainController.handleFailure( window, true );
            }
        } );
    },
    /**
     *
     * @param newAccount
     * @param panel
     * @param takeValuesFromConfig boolean
     */
    onPerformLogonReportCompany: function( newAccount, panel, takeValuesFromConfig ){
        var me = this,
            input = Object.create( Object.prototype ),
            window = Ext.getCmp( 'CrefoConfigurationWindow' );
        input.useraccountId = newAccount;
        window.setLoading( true );
        if( !Ext.isDefined( Ext.getCmp( 'reportCompanyContainer' ) ) && Ext.isDefined( Ext.getCmp( 'reportCompanyContainerError' ) ) ) {
            me.mainController.changePanelContainer( panel, Ext.getCmp( 'reportCompanyContainerError' ), 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Container', {
                parentPanel: panel
            } );
        }
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=logonReportCompany}',
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
                        panel.reportLanguageStore.loadData( [], false );
                        panel.legitimateInterestStore.loadData( [], false );
                        panel.productStore.loadData( [], false );
                    } else {
                        me.processLogonReportCompanies( panel, result.data, takeValuesFromConfig );
                        var recordReportCompany = panel.reportCompanyStore.first();
                        if( !Ext.isEmpty( recordReportCompany ) && !Ext.isEmpty( recordReportCompany.get( 'useraccountId' ) ) ) {
                            me.mainController.isFormValid( panel );
                        } else {
                            me.validateSelectedRedProducts( panel );
                        }
                        Ext.getCmp( 'reportCompanyContainer' ).getProductBlankText();
                        Ext.getCmp( 'useraccountId' ).validate();
                    }
                    window.down( "button[name=crefoConfig-reportCompany-saveBtn]" ).setDisabled( false );
                } catch( e ) {
                    if( !Ext.isEmpty( console ) ) {
                        console.error( e );
                    }
                    window.down( "button[name=crefoConfig-reportCompany-saveBtn]" ).setDisabled( true );
                    if( !Ext.isDefined( Ext.getCmp( 'reportCompanyContainerError' ) ) ) {
                        me.mainController.changePanelContainer( panel, Ext.getCmp( 'reportCompanyContainer' ), 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.ContainerError', {
                            errorText: me.snippets.errors.unsuccessfulLogon
                        } );
                        Ext.getCmp( 'useraccountId' ).validate();
                    }
                    me.mainController.showStickyMessageFromError( e );
                } finally {
                    window.setLoading( false );
                    window.doLayout();
                }
            },
            failure: function( response ){
                var result = null;
                var responseText = response.responseText.substr( 0, response.responseText.lastIndexOf( "}" ) + 1 );
                window.down( "button[name=crefoConfig-reportCompany-saveBtn]" ).setDisabled( true );
                if( !Ext.isDefined( Ext.getCmp( 'reportCompanyContainerError' ) ) ) {
                    me.mainController.changePanelContainer( panel, Ext.getCmp( 'reportCompanyContainer' ), 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.ContainerError', {
                        errorText: me.snippets.errors.unsuccessfulLogon
                    } );
                    Ext.getCmp( 'useraccountId' ).validate();
                }
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
                    window.setLoading( false );
                    window.doLayout();
                }
            }
        } );
    },
    processLogonReportCompanies: function( panel, reportCompaniesData, takeValuesFromConfig ){
        var me = this,
            reportLanguageCbx = Ext.getCmp( 'reportLanguageKey' ),
            legitimateInterestCbx = Ext.getCmp( 'legitimateKey' ),
            useraccountCbx = Ext.getCmp( 'useraccountId' );
        if( takeValuesFromConfig ) {
            panel.reportLanguageStore.loadData( reportCompaniesData.reportLanguages, false );
            panel.legitimateInterestStore.loadData( reportCompaniesData.legitimateInterests, false );
            panel.productStore.loadData( reportCompaniesData.products, false );
            var reportCompanyRecord = panel.reportCompanyStore.findRecord( 'id', 1 ),
                productConfigStore = panel.productConfigStore;
            if( reportCompanyRecord.get( 'useraccountId' ) !== null ) {
                useraccountCbx.suspendEvents( false );
                useraccountCbx.setValue( reportCompanyRecord.get( 'useraccountId' ) );
                useraccountCbx.resumeEvents();
                reportLanguageCbx.setValue( reportCompanyRecord.get( 'reportLanguageKey' ) );
                legitimateInterestCbx.setValue( reportCompanyRecord.get( 'legitimateKey' ) );
                if( productConfigStore.getCount() > 0 ) {
                    productConfigStore.queryBy( function( record, id ){
                        var baseId = record.get( 'land' ).toLowerCase() + '-' + record.get( 'sequence' ),
                            hasProduct = false,
                            valueIndexCmp = Ext.getCmp( baseId + '-value-index' ),
                            productCmp = Ext.getCmp( baseId + '-product' );
                        Ext.getCmp( baseId + '-value' ).setValue( record.get( 'threshold' ) );
                        if( record.get( 'solvencyIndexWS' ) ) {
                            valueIndexCmp.setValue( record.get( 'threshold_index' ) );
                        } else if( valueIndexCmp !== undefined ) {
                            valueIndexCmp.setValue( null );
                        }
                        if( !Ext.isEmpty( productCmp ) ) {
                            productCmp.setValue( record.get( 'productKeyWS' ) );
                            for( i = 0; i < reportCompaniesData.products.length; i++ ) {
                                if( reportCompaniesData.products[ i ].keyWS === record.get( 'productKeyWS' )
                                    && reportCompaniesData.products[ i ].country.toLowerCase() === record.get( 'land' ).toLowerCase() ) {
                                    hasProduct = true;
                                }
                            }
                            if( !hasProduct ) {
                                Ext.getCmp( baseId + '-product' ).setRawValue( record.get( 'productTextWS' ) );
                                me.mainController.markProductMissing( baseId + '-product' );
                            } else {
                                me.mainController.removeMarkProductMissing( baseId + '-product' );
                            }
                        }
                    } );
                }
            }
        } else {
            me.mainController.combineNewDataWithOldRecord( reportLanguageCbx, reportCompaniesData.reportLanguages, me.reportCompaniesDefaultValues.reportLanguage );
            me.mainController.combineNewDataWithOldRecord( legitimateInterestCbx, reportCompaniesData.legitimateInterests, me.reportCompaniesDefaultValues.legitimateInterest );
            me.markRedProducts( reportCompaniesData.products );
            panel.reportLanguageStore.loadData( reportCompaniesData.reportLanguages, false );
            panel.legitimateInterestStore.loadData( reportCompaniesData.legitimateInterests, false );
            panel.productStore.loadData( reportCompaniesData.products, false );
            me.setConfigValuesIfEmpty( panel );
        }
        if( reportLanguageCbx.getValue() === null ) {
            reportLanguageCbx.setValue( me.reportCompaniesDefaultValues.reportLanguage );
        }
        if( legitimateInterestCbx.getValue() === null ) {
            legitimateInterestCbx.setValue( me.reportCompaniesDefaultValues.legitimateInterest );
        }
    },
    getProductTypesOldValues: function(){
        var me = this,
            productTypesOldRecords = [];
        var countries = [ 'de', 'at', 'lu' ];
        for( i = 1; i < 12; i++ ) {
            var country = countries[ parseInt( i / 4 ) ];
            if( i % 4 !== 0 ) {
                var product = Object.create( Object.prototype ),
                    component = Ext.getCmp( country + '-' + i + '-product' );
                product.country = country;
                product.sequence = i;
                product.keyWS = component.getValue();
                product.textWS = component.getRawValue();
                productTypesOldRecords.push( product );
            }
        }
        return productTypesOldRecords;
    },
    markRedProducts: function( newProductsArray ){
        var me = this,
            oldProductsArray = me.getProductTypesOldValues();

        Ext.each( oldProductsArray, function( oldProduct ){
            if( !Ext.isEmpty( oldProduct.keyWS ) ) {
                me.mainController.markProductMissing( oldProduct.country.toLowerCase() + '-' + oldProduct.sequence + '-product' );
            }
        } );

        Ext.each( newProductsArray, function( newProduct ){
            Ext.each( oldProductsArray, function( oldProduct ){
                var cmpId = null;
                if( !Ext.isEmpty( oldProduct.keyWS ) ) {
                    if( newProduct.country.toLowerCase() === oldProduct.country.toLowerCase() && newProduct.nameWS.toLowerCase() === oldProduct.keyWS.toLowerCase() ) {
                        cmpId = oldProduct.country.toLowerCase() + '-' + oldProduct.sequence + '-product';
                        Ext.getCmp( cmpId ).setRawValue( newProduct.keyWS );
                        Ext.getCmp( cmpId ).setValue( newProduct.nameWS );
                        oldProduct.keyWS = newProduct.keyWS;
                        me.mainController.removeMarkProductMissing( cmpId );
                    } else if( newProduct.keyWS === oldProduct.keyWS && newProduct.country.toLowerCase() === oldProduct.country.toLowerCase() ) {
                        cmpId = oldProduct.country.toLowerCase() + '-' + oldProduct.sequence + '-product';
                        me.mainController.removeMarkProductMissing( cmpId );
                    }
                }
            } );
        } );
    },
    setConfigValuesIfEmpty: function( panel ){
        var me = this,
            reportLanguageCbx = Ext.getCmp( 'reportLanguageKey' ),
            legitimateInterestCbx = Ext.getCmp( 'legitimateKey' ),
            reportCompanyRecord = panel.reportCompanyStore.findRecord( 'id', 1 ),
            productConfigStore = panel.productConfigStore;
        if( reportCompanyRecord === null ) {
            return;
        }
        if( reportLanguageCbx.getValue() === null && panel.reportLanguageStore.findRecord( 'keyWS', reportCompanyRecord.get( "reportLanguageKey" ) ) !== null ) {
            reportLanguageCbx.setValue( reportCompanyRecord.get( "reportLanguageKey" ) );
        }
        if( legitimateInterestCbx.getValue() === null && panel.legitimateInterestStore.findRecord( 'keyWS', reportCompanyRecord.get( "legitimateKey" ) ) !== null ) {
            legitimateInterestCbx.setValue( reportCompanyRecord.get( "legitimateKey" ) );
        }

        if( productConfigStore === null ) {
            return;
        }
        var countries = [ "DE", "AT", "LU" ];
        //are 12 components in the design
        for( i = 1; i < 13; i++ ) {
            //the 4h sequence doesn't have Product Type
            if( i % 4 !== 0 ) {
                var country = countries[ parseInt( i / 4 ) ];
                var productType = Ext.getCmp( country.toLowerCase() + '-' + i + '-product' );
                var recordConfig = productConfigStore.findRecord( 'sequence', i );
                if( productType.getValue() === null && recordConfig !== null && recordConfig.get( 'land' ).toLowerCase() === country.toLowerCase() ) {
                    var productInStore = panel.productStore.countryFilter( recordConfig.get( 'land' ) ).findRecord( 'keyWS', recordConfig.get( 'productKeyWS' ) );
                    if( productInStore !== null ) {
                        productType.setValue( recordConfig.get( 'productKeyWS' ) );
                    } else {
                        productType.setValue( recordConfig.get( 'productKeyWS' ) );
                        productType.setRawValue( recordConfig.get( 'productTextWS' ) );
                        productType.markInvalid( me.snippets.errors.hasRedProducts );
                        me.mainController.markProductMissing( productType.getId() );
                    }
                }
            }
        }
    },
    resetThresholdIndexes: function( panel ){
        var countries = [ "DE", "AT", "LU" ];
        //are 12 components in the design
        for( i = 1; i < 13; i++ ) {
            //the 4h sequence doesn't have Product Type
            if( i % 4 !== 0 ) {
                var country = countries[ parseInt( i / 4 ) ];
                var threshold = Ext.getCmp( country.toLowerCase() + '-' + i + '-value-index' );
                var product = Ext.getCmp( country.toLowerCase() + '-' + i + '-product' );
                if( product.getValue() !== null ) {
                    var recordProduct = panel.productStore.countryFilter( country.toLowerCase() ).findRecord( 'keyWS', product.getValue() );
                    if( recordProduct.get( 'solvencyIndexWS' ) === false ) {
                        threshold.setValue( null );
                    }
                } else {
                    threshold.setValue( null );
                }
            }
        }
    },
    validateSelectedRedProducts: function( panel ){
        var me = this,
            hasRedProducts = false;
        panel.getForm().getFields().each( function( f ){
            if( f.id.includes( '-product' ) && !Ext.isEmpty( f.getValue() ) ) {
                f.validate();
                hasRedProducts = true;
            }
        } );
        return hasRedProducts;
    }
} );
//{/block}