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
//{block name="backend/crefo_logs/controller/list"}
Ext.define( 'Shopware.apps.CrefoLogs.controller.List', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefologs-main-window' },
        { ref: 'tabList', selector: 'crefo-logs-interface-list' }
    ],
    init: function(){
        var me = this;
        me.mainController = me.getController( 'Main' );

        me.control( {
            'crefo-logs-interface-list': {
                showData: me.onShowData,
                downloadZip: me.onDownloadZip
            }
        } );
        me.callParent( arguments );
    },

    onShowData: function( xmlId, iColIdx ){
        var me = this,
            window = Ext.getCmp( 'CrefoLogsWindow' );
        window.setLoading( true );
        Ext.Ajax.request( {
            url: '{url controller=CrefoLogs action=openXml}',
            method: 'POST',
            params: { xmlId: xmlId, columnId: iColIdx },
            success: function( response ){
                try {
                    if( !me.mainController.isJson( response.responseText ) ) {
                        throw new Error( "no response" );
                    }
                    var result = Ext.JSON.decode( response.responseText );
                    if( !result.success ) {
                        throw new Error( "not successful" );
                    }

                    var myWindow = Ext.create( "Ext.window.Window", {
                        title: result.title,
                        height: '90%',
                        width: Ext.getBody().getViewSize().width / 1.4,
                        maximizable: false,
                        minimizable: false,
                        resizable: false,
                        autoShow: true,
                        autoScroll: false,
                        layout: 'fit',
                        items: [
                            {
                                xtype: 'textareafield',
                                grow: true,
                                border: 0,
                                readOnly: true,
                                height: '100%',
                                width: '100%',
                                name: 'message',
                                value: result.dataXml,
                                listeners: {
                                    'afterrender': function( cmp, eOpts ){
                                        window.setLoading( false );
                                    }
                                }
                            }
                        ]
                    } );
                    myWindow.show();
                } catch( e ) {
                    console.log( e );
                }
            }
        } );
    },
    onDownloadZip: function( list ){
        var me = this;
        var records = list.getSelectionModel().getSelection();
        Ext.Ajax.request( {
            url: '{url controller=CrefoLogs action=exportLogsZip}',
            method: 'GET',
            params: { xmlRowId: records[ 0 ].get( 'id' ), reportResultId: records[ 0 ].get( 'reportResultId' ) },
            success: function( response ){
                try {
                    if( !me.mainController.isJson( response.responseText ) ) {
                        throw new Error( "no response" );
                    }
                    var result = Ext.JSON.decode( response.responseText );
                    if( !result.success ) {
                        throw new Error( "not successful" );
                    }

                    Ext.create( 'Ext.Component', {
                        frameborder: 0,
                        style: {
                            display: 'none'
                        },
                        autoEl: {
                            tag: "iframe",
                            src: 'CrefoLogs/downloadZip?zipName=' + result.zipName
                        },
                        renderTo: Ext.getBody()
                    } );
                } catch( e ) {
                    // console.log(e);
                }
            }
        } );
    }
} );
//{/block}
