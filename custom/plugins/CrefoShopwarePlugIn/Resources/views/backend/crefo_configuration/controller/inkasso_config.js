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
//{block name="backend/crefo_configuration/controller/inkasso_config"}
Ext.define( 'Shopware.apps.CrefoConfiguration.controller.InkassoConfig', {
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
    inkassoDefaultValues: {
        orderType: 'CCORTY-1',
        turnoverType: 'CCTOTY-1',
        receivableReason: 'CCRCRS-11'
    },
    init: function(){
        var me = this;
        me.mainController = me.getController( 'Main' );
        me.control( {
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            },
            'crefoconfig-tabs-inkasso-container-header': {
                performLogonInkasso: me.onPerformLogonInkasso
            },
            'crefoconfig-tabs-inkasso-panel': {
                saveInkasso: me.onSaveInkasso
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
            container = Ext.getCmp( 'inkassoContainer' ),
            newTabPanel = newTab.items.items[ 0 ];
        if( /crefoconfig-tabs-inkasso-panel/ig.test( newTabPanel.id ) ) {
            try {
                newTabPanel.up( 'window' ).down( "button[name=crefoConfig-inkasso-saveBtn]" ).setDisabled( true );
                newTabPanel.up( 'window' ).setLoading( true );
                if( newTabPanel.tabSeen ) {
                    var userAccountCbx = Ext.getCmp( 'inkasso_user_account' ),
                        userAccountValue = Ext.isEmpty( newTabPanel.inkassoStore.first() ) ? null : newTabPanel.inkassoStore.first().get( 'inkasso_user_account' );
                    userAccountCbx.suspendEvents( false );
                    userAccountCbx.setValue( userAccountValue );
                    userAccountCbx.resumeEvents();
                } else {
                    newTabPanel.tabSeen = true;
                }
                if( !Ext.isDefined( container ) ) {
                    me.mainController.changePanelContainer( newTabPanel, Ext.getCmp( 'inkassoContainerError' ), 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Container', {
                        parentPanel: newTabPanel
                    } );
                }
                newTabPanel.inkassoStore.load( {
                    callback: function(){
                        var recordIS = this.first();
                        var useraccountId = null;
                        if( !Ext.isEmpty( recordIS ) && recordIS.get( 'inkasso_user_account' ) !== undefined ) {
                            useraccountId = recordIS.get( 'inkasso_user_account' );
                        }
                        me.onPerformLogonInkasso( useraccountId, useraccountId, newTab.down( 'panel' ), true );
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
    onSaveInkasso: function( panel ){
        var me = this,
            inkassoStore = panel.inkassoStore,
            inkassoValuesStore = panel.inkassoValuesStore,
            inkassoCreditorsStore = panel.inkassoCreditorsStore,
            window = Ext.getCmp( 'CrefoConfigurationWindow' );

        var values = panel.getForm().getValues();

        if( values.useraccountId !== '' && !me.mainController.isFormValid( panel ) ) {
            return;
        }

        if( values.useraccountId === '' ) {
            panel.getForm().reset();
            values = panel.getForm().getValues();
        }
        inkassoValuesStore.clearFilter();
        var input = [];
        inkassoValuesStore.data.items.forEach( function( entry ){
            input.push( entry.data );
        } );
        var inputParam = Ext.JSON.encode( input );

        window.setLoading( true );
        Ext.Ajax.request( {
            url: '{url controller=CrefoConfiguration action=saveInkassoConfig}',
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
                    inkassoValuesStore.destroy( {
                        callback: function(){
                            Ext.Ajax.request( {
                                url: '{url controller=CrefoConfiguration action=saveInkassoWSValues}',
                                method: 'POST',
                                params: {
                                    inkasso_values: inputParam
                                },
                                success: function( response ){
                                    try {
                                        if( !me.mainController.isJson( response.responseText ) ) {
                                            throw new Error( "no response" );
                                        }
                                        var result = Ext.JSON.decode( response.responseText );
                                        if( !result.success ) {
                                            throw new Error( "not successful" );
                                        }
                                        inkassoValuesStore.load();
                                        inkassoStore.load();
                                        inkassoCreditorsStore.destroy( {
                                            callback: function(){
                                                var inputCreditors = [];
                                                inkassoCreditorsStore.data.items.forEach( function( entry ){
                                                    inputCreditors.push( entry.data );
                                                } );
                                                var inputCreditorsParam = Ext.JSON.encode( inputCreditors );
                                                Ext.Ajax.request( {
                                                    url: '{url controller=CrefoConfiguration action=saveInkassoCreditors}',
                                                    method: 'POST',
                                                    params: {
                                                        inkasso_creditors: inputCreditorsParam
                                                    },
                                                    success: function( response ){
                                                        try {
                                                            if( !me.mainController.isJson( response.responseText ) ) {
                                                                throw new Error( "no response" );
                                                            }
                                                            var result = Ext.JSON.decode( response.responseText );
                                                            if( !result.success ) {
                                                                throw new Error( "not successful" );
                                                            }
                                                            inkassoCreditorsStore.load();
                                                            var variableSpread = Ext.getCmp( 'inkasso_interest_rate_variable_spread_text' ),
                                                                fix = Ext.getCmp( 'inkasso_interest_rate_fix_text' ),
                                                                radioValue = parseInt( values.inkasso_interest_rate_radio );
                                                            if( radioValue === 1 ) {
                                                                fix.setValue( '' );
                                                                variableSpread.setValue( '' );
                                                            } else if( radioValue === 2 ) {
                                                                fix.setValue( '' );
                                                            } else {
                                                                variableSpread.setValue( '' );
                                                            }
                                                            window.setLoading( false );
                                                            me.mainController.showStickyMessage( '', me.snippets.success );
                                                        } catch( e ) {
                                                            window.setLoading( false );
                                                        }
                                                    },
                                                    failure: function(){
                                                        me.mainController.handleFailure( window, true );
                                                    }
                                                } );
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
    onPerformLogonInkasso: function( newAccount, oldAccount, panel, takeValuesFromConfig ){
        var me = this,
            input = Object.create( Object.prototype ),
            window = Ext.getCmp( 'CrefoConfigurationWindow' );
        input.useraccountId = newAccount;
        window.setLoading( true );
        if( !Ext.isDefined( Ext.getCmp( 'inkassoContainer' ) ) ) {
            me.mainController.changePanelContainer( panel, Ext.getCmp( 'inkassoContainerError' ), 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Container', {
                parentPanel: panel
            } );
        }
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=logonInkasso}',
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
                        Ext.getCmp( 'inkasso_customer_reference' ).getStore().loadData( [], false );
                        panel.inkassoValuesStore.loadData( [], false );
                        panel.inkassoCreditorsStore.loadData( [], false );
                        window.down( "button[name=crefoConfig-inkasso-saveBtn]" ).setDisabled( false );
                    } else {
                        var enabled = me.processLogonInkasso( panel, result.data, takeValuesFromConfig );
                        if( !Ext.isEmpty( newAccount ) && Ext.isEmpty( oldAccount ) ) {
                            var customerReferenceCbx = Ext.getCmp( 'inkasso_customer_reference' ),
                                valutaDate = Ext.getCmp( 'inkasso_valuta_date' ),
                                dueDate = Ext.getCmp( 'inkasso_due_date' );
                            dueDate.setValue( panel.defaults.dateFields );
                            valutaDate.setValue( panel.defaults.dateFields );
                            customerReferenceCbx.setValue( panel.defaults.customerReferenceId )
                        }
                        if( enabled ) {
                            me.mainController.isFormValid( panel );
                        }
                        window.down( "button[name=crefoConfig-inkasso-saveBtn]" ).setDisabled( !enabled );
                    }
                } catch( e ) {
                    if( !Ext.isEmpty( console ) ) {
                        console.error( e );
                    }
                    window.down( "button[name=crefoConfig-inkasso-saveBtn]" ).setDisabled( true );
                    var container = Ext.getCmp( 'inkassoContainer' );
                    if( Ext.isDefined( container ) ) {
                        me.mainController.changePanelContainer( panel, container, 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.ContainerError', {
                            errorText: me.snippets.errors.unsuccessfulLogon
                        } );
                        Ext.getCmp( 'inkasso_user_account' ).validate();
                    }
                    me.mainController.showStickyMessageFromError( e );
                } finally {
                    window.setLoading( false );
                    window.doLayout();
                }
            },
            failure: function( response ){
                window.down( "button[name=crefoConfig-inkasso-saveBtn]" ).setDisabled( true );
                var container = Ext.getCmp( 'inkassoContainer' );
                if( Ext.isDefined( container ) ) {
                    me.mainController.changePanelContainer( panel, container, 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.ContainerError', {
                        errorText: me.snippets.errors.unsuccessfulLogon
                    } );
                    Ext.getCmp( 'inkasso_user_account' ).validate();
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
                    window.setLoading( false );
                    window.doLayout();
                }
            }
        } );
    },
    processLogonInkasso: function( panel, inkassoData, takeValuesFromConfig ){
        var me = this,
            creditorCbx = Ext.getCmp( 'inkasso_creditor' ),
            orderTypeCbx = Ext.getCmp( 'inkasso_order_type' ),
            turnoverTypeCbx = Ext.getCmp( 'inkasso_turnover_type' ),
            receivableReasonCbx = Ext.getCmp( 'inkasso_receivable_reason' ),
            customerReferenceCbx = Ext.getCmp( 'inkasso_customer_reference' ),
            useraccountCbx = Ext.getCmp( 'inkasso_user_account' ),
            container = Ext.getCmp( 'inkassoContainer' ),
            valutaDate = Ext.getCmp( 'inkasso_valuta_date' ),
            dueDate = Ext.getCmp( 'inkasso_due_date' );

        if( !Ext.isEmpty( inkassoData.data ) && !Ext.isEmpty( inkassoData.data[ 0 ] ) && inkassoData.data[ 0 ].no_service === true ) {
            creditorCbx.getStore().loadData( [] );
            panel.inkassoValuesStore.loadData( [] );
            customerReferenceCbx.getStore().loadData( [] );
            var tempUserAccount = Ext.getCmp( 'inkasso_user_account' ).getValue();
            useraccountCbx.suspendEvents( false );
            panel.getForm().reset();
            useraccountCbx.setValue( tempUserAccount );
            useraccountCbx.resumeEvents();
            return false;
        }

        panel.inkassoValuesStore.loadRawData( inkassoData, false );
        panel.inkassoCreditorsStore.loadRawData( inkassoData, false );
        customerReferenceCbx.bindStore( container.getCustomerReferenceStore() );
        if( takeValuesFromConfig ) {
            var inkassoConfigRecord = panel.inkassoStore.findRecord( 'id', 1 );
            if( inkassoConfigRecord.get( 'inkasso_user_account' ) !== null ) {
                useraccountCbx.suspendEvents( false );
                useraccountCbx.setValue( inkassoConfigRecord.get( 'inkasso_user_account' ) );
                useraccountCbx.resumeEvents();
                creditorCbx.setValue( inkassoConfigRecord.get( 'inkasso_creditor' ) );
                orderTypeCbx.setValue( inkassoConfigRecord.get( 'inkasso_order_type' ) );
                customerReferenceCbx.setValue( parseInt( inkassoConfigRecord.get( 'inkasso_customer_reference' ) ) );
                turnoverTypeCbx.setValue( inkassoConfigRecord.get( 'inkasso_turnover_type' ) );
                receivableReasonCbx.setValue( inkassoConfigRecord.get( 'inkasso_receivable_reason' ) );
                valutaDate.setValue( parseInt( inkassoConfigRecord.get( 'inkasso_valuta_date' ) ) );
                dueDate.setValue( parseInt( inkassoConfigRecord.get( 'inkasso_due_date' ) ) );
                container.setInterestRate( inkassoConfigRecord.get( 'inkasso_interest_rate_radio' ), inkassoConfigRecord.get( 'inkasso_interest_rate_value' ) );
            }
        } else {
            if( Ext.isEmpty( panel.inkassoCreditorsStore.findRecord( 'useraccount', creditorCbx.getValue() ) ) ) {
                creditorCbx.setValue( null );
            }
        }
        if( orderTypeCbx.getValue() === null && panel.inkassoValuesStore.findRecord( 'keyWS', me.inkassoDefaultValues.orderType ) !== null ) {
            orderTypeCbx.setValue( me.inkassoDefaultValues.orderType );
        }
        if( turnoverTypeCbx.getValue() === null && panel.inkassoValuesStore.findRecord( 'keyWS', me.inkassoDefaultValues.turnoverType ) !== null ) {
            turnoverTypeCbx.setValue( me.inkassoDefaultValues.turnoverType );
        }
        if( receivableReasonCbx.getValue() === null && panel.inkassoValuesStore.findRecord( 'keyWS', me.inkassoDefaultValues.receivableReason ) !== null ) {
            receivableReasonCbx.setValue( me.inkassoDefaultValues.receivableReason );
        }
        return true;
    }
} );
//{/block}
