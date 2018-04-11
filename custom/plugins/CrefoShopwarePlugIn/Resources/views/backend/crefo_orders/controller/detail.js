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
//{block name="backend/crefo_orders/controller/detail"}
Ext.define( 'Shopware.apps.CrefoOrders.controller.Detail', {
    extend: 'Enlight.app.Controller',

    refs: [
        { ref: 'detailWindow', selector: 'crefo-orders-view-detail-window' }
    ],
    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @return void
     */
    init: function(){
        var me = this;
        me.mainController = me.getController( 'Main' );
        me.callParent( arguments );
        me.control( {
            'crefo-orders-view-detail-window': {
                saveProposal: me.onSaveProposal,
                sendProposal: me.onSendProposal,
                deleteProposal: me.onDeleteProposal,
                printOrder: me.onPrintOrder
            },
            'crefo-orders-detail-container-proposal': {
                showErrors: me.onShowErrors
            }
        } );
    },
    onShowErrors: function( errors, panel ){
        var me = this;
        me.mainController.handleErrors( errors, panel );
    },
    onSaveProposal: function( panel, proposalRecord, list ){
        var me = this,
            formPnl = panel.getForm();
        me.trimDefinedFields( formPnl );
        if( !me.mainController.isFormValid( panel ) ) {
            me.mainController.showStickyMessage( '', me.mainController.snippets.validation.error );
            return false;
        }
        formPnl.updateRecord( proposalRecord );
        panel.up( 'window' ).setLoading( true );
        proposalRecord.save( {
            callback: function(){
                list.orderListingStore.reload();
                list.crefoProposalStore.reload();
                list.crefoOrdersStore.reload();
                list.store.reload( {
                    callback: function(){
                        panel.up( 'window' ).setLoading( false );
                        me.mainController.showStickyMessage( '', me.mainController.snippets.success );
                        panel.up( 'window' ).close();
                    }
                } );
            }
        } );
    },
    onSendProposal: function( panel, proposalRecord, list ){
        var me = this,
            input = Object.create( Object.prototype ),
            formPnl = panel.getForm();
        if( !me.mainController.isFormValid( panel ) ) {
            me.mainController.showStickyMessage( '', me.mainController.snippets.validation.error );
            return false;
        }
        formPnl.updateRecord( proposalRecord );
        input.proposalId = proposalRecord.get( 'id' );
        input.listingId = list.orderListingStore.findRecord( 'crefoOrderId', input.proposalId ).get( 'id' );
        panel.up( 'window' ).setLoading( true );
        proposalRecord.save( {
            callback: function(){
                Ext.Ajax.request( {
                    url: '{url module=backend controller=CrefoOrders action=sendProposal}',
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
                                throw result.errors;
                            }
                            panel.up( 'window' ).setLoading( false );
                            panel.up( 'window' ).close();
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
                                me.mainController.handleErrors( errors[ 0 ], formPnl );
                            } else {
                                me.mainController.handleErrors( result.errors, formPnl );
                            }
                            panel.up( 'window' ).setLoading( false );
                        } finally {
                            list.crefoProposalStore.reload();
                            list.crefoOrdersStore.reload();
                            list.orderListingStore.reload();
                            list.store.reload( {
                                callback: function(){
                                    if( result.success ) {
                                        me.mainController.showStickyMessage( '', me.mainController.snippets.success );
                                    }
                                }
                            } );
                        }
                    },
                    failure: function( response ){
                        var result = null;
                        var responseText = response.responseText.substr(0, response.responseText.lastIndexOf("}") + 1);
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
                                me.mainController.handleErrors( errors[ 0 ], formPnl );
                            } else {
                                me.mainController.handleErrors( result.errors, formPnl );
                            }
                        }finally {
                            panel.up( 'window' ).setLoading( false );
                        }
                    }
                } );
            }
        } );
    },
    onDeleteProposal: function( panel, proposalRecord, list ){
        var me = this;
        panel.up( 'window' ).setLoading( true );
        proposalRecord.destroy( {
            callback: function(){
                list.crefoProposalStore.reload();
                list.orderListingStore.reload();
                panel.up( 'window' ).setLoading( false );
                panel.up( 'window' ).close();
                list.store.reload( {
                    callback: function(){
                        me.mainController.showStickyMessage( '', me.mainController.snippets.success );
                    }
                } );
            }
        } );
    },
    onPrintOrder: function( panel, record ){
        var me = this,
            winProposal = panel.up( 'window' ),
            formPanel = panel.getForm();
        try {
            var w = window.open( '', '', 'width=800,height=900' );
            var firstBodyElement = w.document.getElementsByTagName( 'body' )[ 0 ];
            firstBodyElement.setAttribute( 'class', 'x-body x-container' );
            $printSection = w.document.createElement( "div" );
            $printSection.id = "printSection";
            w.document.body.appendChild( $printSection );
            titleDiv = w.document.createElement( "div" );
            titleDiv.innerHTML = winProposal.getHeader().title;
            printPanel = w.document.createElement( "table" );
            printPanel.style = "width: 100%;";
            printPanelTbody = w.document.createElement( "tbody" );
            printPanel.id = "bodyPrint";
            $printSection.appendChild( titleDiv );
            $printSection.appendChild( w.document.createElement( "br" ) );
            $printSection.appendChild( printPanel );
            printPanel.appendChild( printPanelTbody );
            tempDiv = w.document.createElement( "div" );

            me.createBodyPrint( printPanelTbody, tempDiv, w.document );

            w.document.title = formPanel.findField( "documentNumber" ).getValue();
            w.document.close(); // needed for chrome and safari
            w.focus();  // necessary for IE >= 10
            w.print();
            w.close();
        } catch( e ) {
            if( !Ext.isEmpty( console ) ) {
                console.error( e );
            }
        }

    },
    createBodyPrint: function( printPanelTbody, tempDiv, domDoc ){
        var me = this;
        var dom = Ext.dom.Query.select( 'td#crefo-orders-detail-container-document-bodyEl.x-form-item-body' );
        var bodyForm = Ext.get( dom[ 0 ] );
        Ext.each( bodyForm.dom, function( html, index, elem ){
            //{literal}
            var innerHtml = elem[ index ].innerHTML.replace( /<(div)([^>]|\w)+>/g, '<div>' );
            innerHtml = innerHtml.replace( /<(label)([^>]|\w)+>/g, '<label>' );
            innerHtml = innerHtml.replace( /<(table)([^>]|\w)*>/g, '' );
            innerHtml = innerHtml.replace( /<\/(table)>/g, '' );
            innerHtml = innerHtml.replace( /<(tbody)([^>]|\w)*>/g, '' );
            innerHtml = innerHtml.replace( /<\/(tbody)>/g, '' );
            innerHtml = innerHtml.replace( /<(tr)([^>]|\w)*>/g, '' );
            innerHtml = innerHtml.replace( /<\/(tr)>/g, '' );
            innerHtml = innerHtml.replace( /<(td)([^>]|\w)*>/g, '' );
            innerHtml = innerHtml.replace( /<\/(td)>/g, '' );
            innerHtml = innerHtml.replace( /<(fieldset)([^>]|\w)*><div><div><div>/g, '' );
            innerHtml = innerHtml.replace( /(<\/div>){3}<\/fieldset>/g, '' );
            innerHtml = innerHtml.replace( /(<div>){2,}/g, '<div class="print-group">' );
            innerHtml = innerHtml.replace( /(<\/div>){2,}/g, '</div></div>' );
            //{/literal}
            tempDiv.innerHTML = innerHtml;
        } );
        Ext.each( tempDiv, function( html, index, elem ){
            me.fillTbody( printPanelTbody, elem[ index ].children, domDoc );
        } );
    },
    fillTbody: function( printPanelTbody, component, domDoc ){
        var me = this,
            trElem;
        Ext.each( component, function( html, index, elem ){
            if( html.outerHTML.indexOf( '<div class="print-group">' ) !== -1 ) {
                Ext.each( html, function( obj, idx, array ){
                    trElem = me.computePrintGroupText( domDoc, array[ idx ].children );
                    printPanelTbody.appendChild( trElem );
                } );
            } else if( html.outerHTML.indexOf( '<label>' ) !== -1 ) {
                trElem = domDoc.createElement( 'tr' );
                if( html.innerHTML !== '' ) {
                    tdTemp = domDoc.createElement( 'td' );
                    tdTemp.innerHTML = html.innerHTML;
                    trElem.appendChild( tdTemp );
                }
            } else if( html.outerHTML.indexOf( '<div>' ) !== -1 ) {
                tdTemp = domDoc.createElement( 'td' );
                tdTemp.innerHTML = html.innerHTML;
                if( trElem.innerHTML === '' ) {
                    tdTemp.colSpan = 2;
                }
                trElem.appendChild( tdTemp );
                printPanelTbody.appendChild( trElem );
            }
        } );
    },
    computePrintGroupText: function( domDoc, component ){
        var text = '',
            trElem = domDoc.createElement( 'tr' );
        Ext.each( component, function( html, index, elem ){
            if( index === 0 ) {
                tdTemp = domDoc.createElement( 'td' );
                tdTemp.innerHTML = html.innerHTML;
                trElem.appendChild( tdTemp );
            } else if( html.innerHTML !== '' ) {
                text += html.innerHTML + " ";
            }
        } );
        tdTemp = domDoc.createElement( 'td' );
        tdTemp.innerHTML = text;
        trElem.appendChild( tdTemp );
        return trElem;
    },
    trimDefinedFields: function( formPnl ){
        var definedFieldsIds = [ 'invoiceNumber', 'remarks', 'customerReference' ];
        formPnl.getFields().each( function( f ){
            for( var i = 0, len = definedFieldsIds.length; i < len; i++ ) {
                if( f.id === definedFieldsIds[ i ] ) {
                    var cmpValue = Ext.getCmp( f.id ).getValue();
                    if( cmpValue !== null && Ext.isDefined( cmpValue ) ) {
                        Ext.getCmp( f.id ).setValue( Ext.String.trim( cmpValue ) );
                    }
                }
            }
        } );
    }
} );
//{/block}
