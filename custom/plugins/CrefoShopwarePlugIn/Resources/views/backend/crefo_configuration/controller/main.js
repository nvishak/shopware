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
//{block name="backend/crefo_configuration/controller/main"}
Ext.define( 'Shopware.apps.CrefoConfiguration.controller.Main', {
    extend: 'Enlight.app.Controller',
    mainWindow: null,
    init: function(){
        var me = this;
        me.subApplication.accountStore = me.getStore( 'Account' );
        me.subApplication.accountStore.load( {
            callback: function(){
                me.subApplication.generalStore = me.getStore( 'General' );
                me.subApplication.generalStore.load( {
                    callback: function(){
                        me.mainWindow = me.getView( 'main.Window' ).create( {
                            generalStore: me.subApplication.generalStore,
                            accountStore: me.subApplication.accountStore
                        } );
                    }
                } );
            }
        } );
        me.callParent( arguments );
    },
    snippets: {
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}',
        generalError: '{s name=crefo/validation/generalError}Allgemeiner Fehler{/s}',
        main: 'Main',
        validation: {
            error: '{s name="crefo/validation/checkFields"}Es ist ein Fehler aufgetreten (Plausibilitätsprüfung).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}',
            fault: {
                title: '{s name="crefo/validation/fault/title"}Es ist ein Fehler aufgetreten (validationfault).{/s}',
                contactText: '{s name="crefo/validation/fault/contactText"}Bitte kontaktieren Sie den Creditreform-Support.{/s}'
            }
        }
    },
    handleFailure: function( window, endLoadingScreen ){
        var me = this;
        if( endLoadingScreen ) {
            window.setLoading( !endLoadingScreen );
        }
    },
    handleErrors: function( errors, formPnl ){
        var me = this;
        if( Ext.isArray( errors ) === false && Ext.isObject( errors ) === false ) {
            return;
        }
        if( !Ext.isEmpty( errors.errorCode ) ) {
            var errorText = me.snippets.generalError;
            if( Ext.isEmpty( errors.errorText ) ) {
                errorText = Ext.isEmpty( errors.title ) || errors.title === '' ? me.snippets.generalError : errors.title;
            } else {
                errorText = errors.errorText;
            }
            me.showStickyMessage( '', errorText );
            return;
        }
        if( !Ext.isEmpty( errors.validationfault ) ) {
            var validationFault = me.snippets.validation.fault.contactText;
            me.showStickyMessage( me.snippets.validation.fault.title, validationFault );
            return;
        }

        if( !Ext.isEmpty( errors.faults ) ) {
            var errorsText, index;
            for( index = 0; index < errors.faults.length; index++ ) {
                var fault = errors.faults[ index ];
                if( Ext.isDefined( fault.errorfield ) && Ext.isDefined( formPnl ) && Ext.isDefined( formPnl.down( 'textfield[name=' + fault.errorfield + ']' ) ) ) {
                    var component = formPnl.down( 'textfield[name=' + fault.errorfield + ']' );
                    component.markInvalid( fault.errortext );
                } else {
                    if( errorsText === undefined ) errorsText = '';
                    errorsText += Ext.isDefined( fault.errorFieldLabel ) ? fault.errorFieldLabel + ": " : "";
                    errorsText += fault.errortext + "<br/>";
                }
            }
            me.showStickyMessage( errors.title, errorsText );
        }
    },
    showStickyMessageFromError: function( e ){
        var me = this,
            errorText = me.snippets.generalError;
        if( !Ext.isEmpty( e ) && Ext.isObject( e ) && Ext.isDefined( e.faults ) ) {
            errorText = e.title;
        } else if( !Ext.isEmpty( e ) && Ext.isObject( e ) && Ext.isDefined( e.validationfault ) ) {
            errorText = me.snippets.validation.fault.title;
        } else {
            if( Ext.isEmpty( e.errorText ) ) {
                errorText = Ext.isEmpty( e.title ) || e.title === '' ? me.snippets.generalError : e.title;
            } else {
                errorText = e.errorText;
            }
        }
        me.showStickyMessage( '', errorText );
    },
    showStickyMessage: function( title, text ){
        var opts = {
            title: title,
            text: text
        };
        Shopware.Notification.createStickyGrowlMessage( opts, this.snippets.main );
    },
    isFormValid: function( formPnl ){
        var me = this;
        if( !formPnl.getForm().isValid() ) {
            formPnl.getForm().getFields().each( function( f ){
                f.validate();
            } );
            me.showStickyMessage( '', me.snippets.validation.error );
            return false;
        }
        return true;
    },
    isJson: function( str ){
        try {
            Ext.JSON.decode( str, false );
            return true;
        } catch( e ) {
            return false;
        }
    },
    /**
     * the cbx store key must be "keyWS"
     * @param cbx
     * @param newData
     * @param defaultValue
     */
    combineNewDataWithOldRecord: function( cbx, newData, defaultValue ){
        var me = this,
            oldValue = defaultValue,
            foundValue = false,
            oldRecord = me.getComboBoxOldRecord( cbx );
        if( newData.length === 0 ) {
            cbx.setValue( null );
            return;
        }

        if( oldRecord !== null ) {
            oldValue = oldRecord.get( "keyWS" );
        }

        for( i = 0; i < newData.length; i++ ) {
            if( newData[ i ].keyWS === oldValue && foundValue === false ) {
                cbx.setValue( oldValue );
                foundValue = true;
            }
        }
        if( !foundValue ) {
            cbx.setValue( newData[ 0 ].keyWS );
        }
    },
    getComboBoxOldRecord: function( cbx ){
        return cbx.getStore().findRecord( 'keyWS', cbx.getValue() );
    },
    markProductMissing: function( cmpId ){
        var cmp = Ext.getCmp( cmpId );
        if( !Ext.isEmpty( cmp.getValue() ) && Ext.isDefined( cmp.inputCell ) ) {
            cmp.inputCell.child( 'input' ).addCls( 'crefo-red-product' );
        }
    },
    removeMarkProductMissing: function( cmpId ){
        var cmp = Ext.getCmp( cmpId );
        if( Ext.isDefined( cmp.inputCell ) ) {
            cmp.inputCell.child( 'input' ).removeCls( 'crefo-red-product' );
            cmp.clearInvalid();
        }
    },
    changePanelContainer: function( panel, removeContainer, containerDefinition, args ){
        Ext.suspendLayouts();
        panel.remove( removeContainer, true );
        panel.add( [
            Ext.create( containerDefinition, args )
        ] );
        panel.doLayout();
        Ext.resumeLayouts( true );
    }
} );
//{/block}