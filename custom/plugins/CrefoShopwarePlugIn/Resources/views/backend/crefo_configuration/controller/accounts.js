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
//{block name="backend/crefo_configuration/controller/accounts"}
Ext.define( 'Shopware.apps.CrefoConfiguration.controller.Accounts', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}',
        generalError: '{s name=crefo/validation/generalError}Allgemeiner Fehler{/s}',
        deleteAccConfirm: '{s name="crefoconfig/view/tabs/accounts/popup/delete/messageDeleteAccount"}Are you sure you want to delete the selected accounts?{/s}',
        deleteAccountTitle: '{s name="crefoconfig/view/tabs/accounts/popup/delete/titleDeleteAccount"}Delete account{/s}',
        userAcc: 'User Accounts',
        unknownError: '{s name="crefo/messages/unknownError"}Es ist ein unbekannter Fehler aufgetreten.{/s}',
        unknownErrorTitle: '{s name="crefo/messages/unknownError/title"}Fehler{/s}',
        validation: {
            error: '{s name="crefo/validation/checkFields"}Es ist ein Fehler aufgetreten (Plausibilitätsprüfung).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
        }
    },
    init: function(){
        var me = this;
        me.mainController = me.getController( 'Main' );
        me.control( {
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            },
            'crefoconfig-tabs-accounts-list': {
                addAccount: me.onAddAccount,
                editAccount: me.onEditAccount,
                deleteAccount: me.onDeleteAccount,
                deleteAccounts: me.onDeleteAccounts,
                changePassAccount: me.onChangePassAccount
            },
            'crefoconfig-tabs-accounts-popup-edit': {
                saveAccount: me.onSaveAccount,
                processChangeDefaultPasswordRequest: me.onProcessChangeDefaultPasswordRequest
            },
            'crefoconfig-tabs-accounts-popup-change-password': {
                changePassword: me.onChangePassword
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
        if( /crefoconfig-tabs-accounts-panel/ig.test( newTabPanel.id ) ) {
            newTabPanel.up( 'window' ).setLoading( true );
            newTabPanel.accountsInUseStore.read( {
                callback: function(){
                    newTabPanel.up( 'window' ).setLoading( false );
                    newTabPanel.accountStore.load();
                }
            } );

        }
    },
    onAddAccount: function( view ){
        this.getView( 'tabs.accounts.popup.Edit' ).create( {
            record: Ext.create( 'Shopware.apps.CrefoConfiguration.model.Account' ),
            view: view,
            edit: false
        } );
    },
    onChangePassword: function( record, formPnl, view, inUseAccounts ){
        var me = this,
            values = formPnl.getForm().getValues(),
            inputCheckIP = Object.create( Object.prototype ),
            isInUseAccount = false,
            activatePayment = null;

        inputCheckIP.individualpassword = values.individualpassword;
        inputCheckIP.id = record.get( 'id' );
        var inUseAccount = inUseAccounts.findRecord( 'id', inputCheckIP.id );
        if( inUseAccount !== null && !Ext.isEmpty( inUseAccount.get( 'serviceCallee' ) ) ) {
            isInUseAccount = true;
            inputCheckIP.inuseaccount = isInUseAccount;
        }
        me.checkIndividualPassword( inputCheckIP, formPnl, function(){
            if( !me.mainController.isFormValid( formPnl ) ) {
                return;
            }
            if( isInUseAccount ) {
                activatePayment = me.activatePayment( false );
                if( activatePayment === null ) {
                    me.mainController.showStickyMessage( me.snippets.unknownErrorTitle, me.snippets.unknownError );
                    return;
                }
            }
            values.useraccount = record.get( 'useraccount' );
            var input = Object.create( Object.prototype );
            input.useraccount = values.useraccount;
            input.newindividualpassword = values.newindividualpassword;
            formPnl.up( 'window' ).setLoading( true );
            Ext.Ajax.request( {
                url: '{url module=backend controller=CrefoConfiguration action=changePassword}',
                method: 'POST',
                params: input,
                success: function( response ){
                    var result = null;
                    try {
                        if( !me.mainController.isJson( response.responseText ) ) {
                            result = Object.create( Object.prototype );
                            result.errors = Object.create( Object.prototype );
                            result.errors.errorCode = true;
                            throw new Error( "no response" );
                        }
                        result = Ext.JSON.decode( response.responseText );
                        if( !result.success ) {
                            throw new Error( "not successful" );
                        }
                        formPnl.up( 'window' ).setLoading( false );
                        view.store.load();
                        formPnl.up( 'window' ).destroy();
                        me.mainController.showStickyMessage( '', me.snippets.success );
                    } catch( e ) {
                        if( !Ext.isEmpty( console ) ) {
                            console.error( e );
                        }
                        formPnl.up( 'window' ).setLoading( false );
                        me.mainController.handleErrors( result.errors, formPnl );
                    }
                },
                failure: function( response, opts ){
                    var errors = Object.create( Object.prototype );
                    errors.errorCode = true;
                    me.mainController.handleErrors( errors, formPnl );
                    me.mainController.handleFailure( formPnl.up( 'window' ), true );
                }
            } );
            if( isInUseAccount && activatePayment !== null ) {
                reactivatePayment = null;
                while( reactivatePayment === null ) {
                    reactivatePayment = me.activatePayment( activatePayment );
                }
            }
        } );
    },
    onProcessChangeDefaultPasswordRequest: function( record, formPnl, view, edit ){
        var me = this;
        if( !me.mainController.isFormValid( formPnl ) ) {
            return;
        }
        var values = formPnl.getForm().getValues();
        values.edit = edit;
        if( Ext.isEmpty( values.useraccount ) && !Ext.isEmpty( Ext.ComponentQuery.query( '#useraccount' )[ 0 ].getValue() ) ) {
            values.useraccount = Ext.ComponentQuery.query( '#useraccount' )[ 0 ].getValue();
        }

        formPnl.up( 'window' ).setLoading( true );
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=changeDefaultPassword}',
            method: 'POST',
            params: values,
            success: function( response ){
                var result = null;
                try {
                    if( !me.mainController.isJson( response.responseText ) ) {
                        result = Object.create( Object.prototype );
                        result.errors = Object.create( Object.prototype );
                        result.errors.errorCode = true;
                        throw new Error( "no response" );
                    }
                    result = Ext.JSON.decode( response.responseText );
                    if( !result.success ) {
                        throw new Error( "not successful" );
                    }
                    formPnl.up( 'window' ).setLoading( false );
                    view.store.load();
                    formPnl.up( 'window' ).destroy();
                    var windowConfig = Ext.getCmp( 'CrefoConfigurationWindow' );
                    windowConfig.disableTabs( false );
                    me.mainController.showStickyMessage( '', me.snippets.success );
                } catch( e ) {
                    if( !Ext.isEmpty( console ) ) {
                        console.error( e );
                    }
                    if( edit ) {
                        formPnl.down( 'textfield' ).setDisabled( true );
                    }
                    formPnl.up( 'window' ).setLoading( false );
                    me.mainController.handleErrors( result.errors, formPnl );
                }
            },
            failure: function( response, opts ){
                var errors = Object.create( Object.prototype );
                errors.errorCode = true;
                me.mainController.handleErrors( errors, formPnl );
                me.mainController.handleFailure( formPnl.up( 'window' ), true );
            }
        } );

    },
    onSaveAccount: function( record, formPnl, view, edit ){
        var me = this;

        if( !me.mainController.isFormValid( formPnl ) ) {
            return;
        }

        var values = formPnl.getForm().getValues();
        if( Ext.isEmpty( values.useraccount ) && !Ext.isEmpty( Ext.ComponentQuery.query( '#useraccount' )[ 0 ].getValue() ) ) {
            values.useraccount = Ext.ComponentQuery.query( '#useraccount' )[ 0 ].getValue();
        }

        formPnl.up( 'window' ).setLoading( true );
        hasAccount = view.store.findRecord( "useraccount", values.useraccount );
        if( !Ext.isEmpty( hasAccount ) && edit === false ) {
            formPnl.up( 'window' ).setLoading( false );
            formPnl.down( 'textfield[name=useraccount]' ).markInvalid( me.snippets.validation.invalidValue );
            me.mainController.showStickyMessage( '', me.snippets.validation.error );
            return false;
        }
        me.processLogonRequest( record, formPnl, view, edit );
    },
    processLogonRequest: function( record, formPnl, view, edit ){
        var me = this;
        var values = formPnl.getForm().getValues();
        if( Ext.isEmpty( values.useraccount ) && !Ext.isEmpty( Ext.ComponentQuery.query( '#useraccount' )[ 0 ].getValue() ) ) {
            values.useraccount = Ext.ComponentQuery.query( '#useraccount' )[ 0 ].getValue();
        }
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=logon}',
            method: 'POST',
            params: values,
            success: function( response ){
                var result = null;
                try {
                    if( !me.mainController.isJson( response.responseText ) ) {
                        result = Object.create( Object.prototype );
                        result.errors = Object.create( Object.prototype );
                        result.errors.errorCode = true;
                        throw new Error( "no response" );
                    }
                    result = Ext.JSON.decode( response.responseText );
                    if( !result.success ) {
                        throw new Error( "not successful" );
                    }
                    formPnl.getForm().updateRecord( record );
                    record.save( {
                        callback: function( record ){
                            var window = formPnl.up( 'window' );
                            window.setLoading( false );
                            window.destroy();
                            view.store.load();
                            var windowConfig = Ext.getCmp( 'CrefoConfigurationWindow' );
                            windowConfig.disableTabs( false );
                            me.mainController.showStickyMessage( '', me.snippets.success );
                        }
                    } );
                } catch( e ) {
                    if( !Ext.isEmpty( console ) ) {
                        console.error( e );
                    }
                    if( edit ) {
                        formPnl.down( 'textfield' ).setDisabled( true );
                    }
                    formPnl.up( 'window' ).setLoading( false );
                    me.mainController.handleErrors( result.errors, formPnl );
                    formPnl.up( 'window' ).doLayout();
                }
            },
            failure: function( response, opts ){
                var errors = Object.create( Object.prototype );
                errors.errorCode = true;
                me.mainController.handleErrors( errors, formPnl );
                me.mainController.handleFailure( formPnl.up( 'window' ), true );
            }
        } );
    },
    /**
     * Event that catches while editing backend users from grid
     * @param view
     * @param rowIndex
     */
    onEditAccount: function( view, rowIndex ){
        var me = this,
            accountStore = view.store,
            record = accountStore.getAt( rowIndex );
        me.getView( 'tabs.accounts.popup.Edit' ).create( {
            view: view,
            record: record,
            edit: true
        } );
    },
    /**
     * Event that catches while changing password event backend users from grid
     * @param view
     * @param rowIndex
     * @param inUseAccounts
     */
    onChangePassAccount: function( view, rowIndex, inUseAccounts ){
        var accountStore = view.store,
            record = accountStore.getAt( rowIndex );
        this.getView( 'tabs.accounts.popup.ChangePassword' ).create( {
            record: record,
            view: view,
            inUseAccounts: inUseAccounts
        } );
    },
    /**
     * Event that catches while deleting backend users from grid
     * @param view
     * @param rowIndex
     */
    onDeleteAccount: function( view, rowIndex ){
        var me = this,
            accountStore = view.store,
            record = accountStore.getAt( rowIndex );
        Ext.MessageBox.confirm( me.snippets.deleteAccountTitle, me.snippets.deleteAccConfirm, function( response ){
            if( response !== 'yes' ) {
                return false;
            }
            record.destroy( {
                success: function(){
                    accountStore.load( {
                        callback: function(){
                            if( this.first() === undefined ) {
                                var windowConfig = Ext.getCmp( 'CrefoConfigurationWindow' );
                                windowConfig.disableTabs( true );
                            }
                        }
                    } );
                    me.mainController.showStickyMessage( '', me.snippets.success );
                },
                failure: function( response, opts ){
                    me.mainController.handleFailure( view.up( 'window' ), false );
                }
            } );
        } );
    },
    /**
     * Event that catches batch user deleting
     * @param view
     */
    onDeleteAccounts: function( view ){
        var me = this,
            records = view.getSelectionModel().getSelection(),
            accountStore = view.store;

        if( records.length > 0 ) {
            Ext.MessageBox.confirm( me.snippets.deleteAccountTitle, me.snippets.deleteAccConfirm, function( response ){
                if( response !== 'yes' ) {
                    return false;
                }
                me.deleteMultipleRecords( records, function(){
                    accountStore.load( {
                        callback: function(){
                            if( Ext.isEmpty( this.first() ) ) {
                                var windowConfig = Ext.getCmp( 'CrefoConfigurationWindow' );
                                windowConfig.disableTabs( true );
                            }
                        }
                    } );
                    me.mainController.showStickyMessage( '', me.snippets.success );
                } );
            } );
        }
    },
    /**
     * Will delete a list of records one after another and finally call the callback method
     *
     * @param records
     * @param callback
     */
    deleteMultipleRecords: function( records, callback ){
        var me = this,
            record = records.pop();

        record.destroy( {
            callback: function(){
                if( records.length == 0 ) {
                    callback();
                } else {
                    me.deleteMultipleRecords( records, callback );
                }
            }
        } );
    },
    checkIndividualPassword: function( params, formPnl, callback ){
        var me = this;
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=checkIndividualPassword}',
            method: 'POST',
            params: params,
            success: function( response ){
                try {
                    if( !me.mainController.isJson( response.responseText ) ) {
                        throw new Error( "no response" );
                    }
                    var result = Ext.JSON.decode( response.responseText );
                    if( !result.success ) {
                        throw new Error( "not successful" );
                    }
                    callback();
                } catch( e ) {
                    if( !Ext.isEmpty( console ) ) {
                        console.error( e );
                    }
                    formPnl.up( 'window' ).setLoading( false );
                    formPnl.down( 'textfield[name=individualpassword]' ).markInvalid( me.snippets.validation.invalidValue );
                    me.mainController.showStickyMessage( '', me.snippets.validation.error );
                }
            },
            failure: function( response, opts ){
                me.mainController.handleFailure( formPnl.up( 'window' ), true );
                me.mainController.showStickyMessage( me.snippets.unknownErrorTitle, me.snippets.unknownError );
            }
        } );
    },
    activatePayment: function( state ){
        var me = this;
        return Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=activatePayment}',
            method: 'POST',
            params: state,
            success: function( response ){
                if( !me.mainController.isJson( response.responseText ) ) {
                    return null;
                }
                var result = Ext.JSON.decode( response.responseText );
                if( result.success ) {
                    return result.status;
                } else {
                    return null;
                }
            },
            failure: function( response, opts ){
                return null;
            }
        } );
    }
} );
//{/block}
