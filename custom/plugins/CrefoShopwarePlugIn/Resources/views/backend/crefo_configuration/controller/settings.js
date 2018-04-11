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
//{block name="backend/crefo_configuration/controller/settings"}
Ext.define( 'Shopware.apps.CrefoConfiguration.controller.Settings', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        general: {
            tabsGeneral: '{s name="crefoconfig/view/main/window/tab/general"}General{/s}'
        },
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}'
    },
    init: function(){
        var me = this;
        me.mainController = me.getController( 'Main' );
        me.control( {
            'crefoconfig-tabs-general-panel': {
                resetSettings: me.onResetSettings,
                saveSettings: me.onSaveSettings
            },
            'crefoconfig-tabs-general-container': {
                showErrorNotificationStatus: me.onShowErrorNotificationStatus
            }
        } );
        me.callParent( arguments );
    },
    onResetSettings: function( store, formPnl, event ){
        var me = this;
        event.up( 'window' ).setLoading( true );
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=resetGeneralSettings}',
            method: 'POST',
            success: function(){
                store.load( {
                    callback: function(){
                        formPnl.loadRecord( store.findRecord( 'id', 1 ) );
                        event.up( 'window' ).setLoading( false );
                    }
                } );
            },
            failure: function(){
                me.mainController.handleFailure( event.up( 'window' ), true );
            }
        } );
    },
    onSaveSettings: function( record, formPnl ){
        var me = this;

        if( !me.mainController.isFormValid( formPnl ) ) {
            return;
        }

        var values = formPnl.getForm().getValues();
        formPnl.getForm().updateRecord( record );

        formPnl.up( 'window' ).setLoading( true );
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=updateGeneralSettings}',
            method: 'POST',
            params: values,
            success: function(){
                formPnl.up( 'window' ).setLoading( false );
                me.mainController.showStickyMessage( '', me.snippets.success );
            },
            failure: function(){
                me.mainController.handleFailure( formPnl.up( 'window' ), true );
            }
        } );
    },
    onShowErrorNotificationStatus: function( event ){
        var me = this;
        event.up( 'window' ).setLoading( true );
        Ext.Ajax.request( {
            url: '{url module=backend controller=CrefoConfiguration action=getErrorNotificationStatus}',
            method: 'POST',
            success: function( response ){
                try {
                    var result = Ext.JSON.decode( response.responseText );
                    event.up( 'window' ).setLoading( false );
                    me.getView( 'tabs.general.popup.ErrorCounter' ).create( {
                        record: result.data
                    } );
                } finally {
                    event.up( 'window' ).setLoading( false );
                }
            },
            failure: function(){
                me.mainController.handleFailure( event.up( 'window' ), true );
            }
        } );
    }
} );
//{/block}
