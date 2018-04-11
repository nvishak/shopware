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
//{block name="backend/crefo_orders/view/list/list"}
Ext.define( 'Shopware.apps.CrefoOrders.view.list.List', {
    extend: 'Shopware.apps.Order.view.list.List',
    alias: 'widget.crefo-orders-list',
    cls: Ext.baseCSSPrefix + 'crefo-orders-grid',
    region: 'center',
    autoScroll: false,
    snippetsExt: {
        columns: {
            solvency: '{s name="crefoorders/view/list/colheader/solvency"}Bonität{/s}',
            inkasso: '{s name="crefoorders/view/list/colheader/collection"}Inkasso{/s}',
            dataindex: {
                solvency: 'solvencyId',
                collection: 'collectionId'
            }
        },
        tooltips: {
            createProposal: '{s name="crefoorders/view/list/col/btn/tooltips/create"}Inkasso-Vorschlag erzeugen{/s}',
            sendProposal: '{s name="crefoorders/view/list/col/btn/tooltips/send"}Inkasso-Auftrag senden{/s}',
            deleteProposal: '{s name="crefoorders/view/list/col/btn/tooltips/delete"}Inkasso-Vorschlag löschen{/s}'
        },
        solvencyAnswers: {
            error: '{s name="crefoorders/view/list/col/solvency/answers/fault"}Error{/s}',
            noValue: '{s name="crefoorders/view/list/col/solvency/answers/novalue"}Kein Wert{/s}',
            white: '{s name="crefoorders/view/list/col/solvency/answers/RIJM-10"}Weiß{/s}',
            black: '{s name="crefoorders/view/list/col/solvency/answers/RIJM-30"}Schwarz{/s}',
            for: '{s name="crefoorders/view/list/col/solvency/answers/for"}für{/s}',
            values: {
                fault: 'fault',
                noValue: 'novalue',
                white: 'RIJM-10',
                black: 'RIJM-30'
            }
        },
        solvencyResults: {
            passed: '{s name="crefoorders/view/list/col/solvency/results/passed"}Bestanden{/s}',
            rejected: '{s name="crefoorders/view/list/col/solvency/results/rejected"}Abgelehnt{/s}'
        },
        collectionAnswers: {
            documentType: {
                proposal: '{s name="crefoorders/view/list/col/collection/answers/doc/proposal"}Vorschlag{/s}',
                errorText: '{s name="crefoorders/view/list/col/collection/answers/doc/error"}Error{/s}',
                toEdit: '{s name="crefoorders/view/list/col/collection/answers/doc/edit"}Bearbeitung erforderlich{/s}',
                toEditError: '{s name="crefoorders/view/list/col/collection/answers/doc/editError"}Error{/s}'
            }
        }
    },
    viewConfig: {
        enableTextSelection: true
    },
    listeners: {
        "cellclick": function( iView, iCellEl, iColIdx, iStore, iRowEl, iRowIdx, iEvent ){
            var me = this;
            if( iView.getGridColumns()[ iColIdx ].dataIndex === me.snippetsExt.columns.dataindex.collection && iEvent.target.tagName.toLowerCase() === 'span' ) {
                me.fireEvent( 'openProposal', me, iStore );
            }
            if( iView.getGridColumns()[ iColIdx ].dataIndex === me.snippetsExt.columns.dataindex.solvency && iEvent.target.tagName.toLowerCase() === 'span' ) {
                iEvent.target.hasAttribute( 'data-openxml' ) ? me.fireEvent( 'openXml', me, iStore ) : me.fireEvent( 'openError', me, iStore );
            }
        }
    },
    initComponent: function(){
        var me = this;
        me.store = me.listStore;
        me.selModel = me.getGridSelModel();
        me.columns = me.getColumns();
        me.toolbar = me.getToolbar();
        me.pagingbar = me.getPagingBar();
        me.dockedItems = [ me.toolbar, me.pagingbar ];
        me.callParent( arguments );
    },
    /**
     * Adds the specified events to the list of events which this Observable may fire.
     */
    registerEvents: function(){
        this.addEvents(
            /**
             * Event will be fired when the user clicks the "create proposal" action column icon
             * which is placed in the order list in the options column
             *
             * @event
             * @param [object] - Form values
             */
            'createProposal',

            /**
             * Event will be fired when the user clicks the "send proposal" action column icon
             * which is placed in the order list in the options column
             *
             * @event
             * @param [object] - Form values
             */
            'sendProposal',

            /**
             * Event will be fired when the user clicks the "delete proposal" action column icon
             * which is placed in the order list in the options column
             *
             * @event
             * @param [object] - Form
             */
            'deleteProposal',
            /**
             * Event will be fired when the user clicks the "open proposal" action column icon
             * which is placed in the order list in the options column
             *
             * @event
             * @param [object] - Form
             */
            'openProposal',
            /**
             * Event will be fired when the user clicks the "open solvency" action column icon
             * which is placed in the order list in the options column
             *
             * @event
             * @param [object] - Form
             */
            'openSolvency',
            /**
             * Event will be fired when the user insert a search string into the search field which displayed
             * in the grid toolbar on the right hand. Will be handled in the filter controller.
             *
             * @event
             * @param [string] - Text field value
             */
            'searchOrders',
            /**
             * Event will be fired when the user select some orders and clicks the batch button
             *
             * @event
             * @param [Ext.grid.Panel] This component
             */
            'showBatch',
            /**
             * Event will be fired when the user clicks on a Error-Link
             *
             * @event
             * @param [Ext.grid.Panel] This component
             */
            'openError',
            /**
             * Event will be fired when the user clicks on a XML-Link
             *
             * @event
             * @param [Ext.grid.Panel] This component
             */
            'openXml'
        );
    },
    createPlugins: function(){
        return [];
    },


    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns: function(){
        var me = this;
        var columnsParent = me.callParent( arguments ),
            colAction = columnsParent[ columnsParent.length - 1 ],
            colUntilAction = columnsParent.slice( 0, columnsParent.length - 1 );

        colUntilAction.push( {
            header: me.snippetsExt.columns.solvency,
            dataIndex: me.snippetsExt.columns.dataindex.solvency,
            flex: 2.5,
            renderer: me.solvencyColumn
        } );
        colUntilAction.push( {
            header: me.snippetsExt.columns.inkasso,
            dataIndex: me.snippetsExt.columns.dataindex.collection,
            flex: 2.5,
            renderer: me.inkassoColumn
        } );
        return colUntilAction.concat( colAction );
    },

    createActionColumn: function(){
        var me = this;
        me.actionColumn = Ext.create( 'Ext.grid.column.Action', {
            width: 90,
            items: [
                me.createCreateProposal(),
                me.createSendProposal(),
                me.createDeleteProposal()
            ]
        } );
        me.actionColumn.on( 'beforerender', function( column, eOpts ){
            var config = me.inkassoConfig.first();
            me.hasInkassoConfig = Ext.isDefined( config ) && Ext.isDefined( config.get( 'inkasso_user_account' ) ) && config.get( 'inkasso_user_account' ) !== null;
        } );
        return me.actionColumn;
    },

    getPagingBar: function(){
        var me = this;
        var pagingBar = me.callParent();
        pagingBar.on( 'beforechange', function(){
            me.orderListingStore.reload();
            me.crefoProposalStore.reload();
            me.crefoOrdersStore.reload();
            me.reportResultStore.reload();
            me.inkassoConfig.reload( {
                callback: function(){
                    if( me.actionColumn !== Ext.undefined ) {
                        me.actionColumn.fireEvent( 'beforerender' );
                    }
                }
            } );
        } );
        return pagingBar;

    },

    onPageSizeChange: function( combo, records ){
        var me = this;
        me.callParent( arguments );
        me.orderListingStore.reload();
        me.crefoProposalStore.reload();
        me.crefoOrdersStore.reload();
        me.reportResultStore.reload();
        me.inkassoConfig.reload();
    },

    createCreateProposal: function(){
        var me = this;
        return {
            iconCls: 'sprite-plus-circle-frame',
            action: 'createProposal',
            tooltip: me.snippetsExt.tooltips.createProposal,
            getClass: function( value, meta, record ){
                if( Ext.isDefined( record.get( "collectionId" ) )
                    && record.get( "collectionId" ) !== null
                    || me.hasInkassoConfig === false
                ) {
                    return 'x-hidden';
                } else {
                    return 'x-grid-icon';
                }
            },
            handler: function( view, rowIndex, colIndex, item ){
                var store = view.getStore(),
                    record = store.getAt( rowIndex );
                me.fireEvent( 'createProposal', me, record );
            }
        };
    },

    createSendProposal: function(){
        var me = this;
        return {
            iconCls: 'sprite-mail-forward',
            action: 'sendProposal',
            tooltip: me.snippetsExt.tooltips.sendProposal,
            getClass: function( value, meta, record ){
                var recordProposal = null,
                    recordListing = me.orderListingStore.findRecord( 'orderId', record.get( "id" ) );
                if( recordListing !== Ext.undefined && recordListing !== null && recordListing.get( "crefoOrderType" ) !== 2 ) {
                    recordProposal = me.crefoProposalStore.findRecord( 'id', recordListing.get( 'crefoOrderId' ) );
                }
                if( Ext.isDefined( record.get( "collectionId" ) )
                    && Ext.isDefined( recordProposal )
                    && recordProposal !== null
                    && recordProposal.get( "proposalStatus" ) === 1
                    && me.hasInkassoConfig === true
                ) {
                    return 'x-grid-icon';
                } else {
                    return 'x-hidden';
                }
            },
            handler: function( view, rowIndex, colIndex, item ){
                var store = view.getStore(),
                    record = store.getAt( rowIndex );
                me.fireEvent( 'sendProposal', me, record );
            }
        };
    },
    createDeleteProposal: function(){
        var me = this;
        return {
            iconCls: 'sprite-minus-circle-frame',
            action: 'deleteProposal',
            tooltip: me.snippetsExt.tooltips.deleteProposal,
            getClass: function( value, meta, record ){
                var recordListing = me.orderListingStore.findRecord( 'orderId', record.get( "id" ) );
                if( Ext.isDefined( record.get( "collectionId" ) )
                    && record.get( "collectionId" ) !== ""
                    && recordListing !== Ext.undefined
                    && recordListing !== null
                    && recordListing.get( "crefoOrderType" ) !== 2
                ) {
                    return 'x-grid-icon';
                } else {
                    return 'x-hidden';
                }
            },
            handler: function( view, rowIndex, colIndex, item ){
                var store = view.getStore(),
                    record = store.getAt( rowIndex );
                me.fireEvent( 'deleteProposal', me, record );
            }
        };
    },
    /**
     * Column renderer function for the payment column of the list grid.
     * @param value    - The field value
     * @param metaData - The model meta data
     * @param record   - The whole data model
     */
    solvencyColumn: function( value, metaData, record ){
        var me = this;

        if( value === Ext.undefined || value === '' ) {
            return value;
        }

        var resultReport = record.getCrefoReportResults();
        if( Ext.isEmpty( resultReport ) ) {
            return value;
        }
        if( Ext.isEmpty( resultReport.get( 'privatePersonResult' ) ) ) {
            value = me.processRenderSolvency( value, resultReport );
        } else {
            value = me.processRenderSolvencyBonima( value, resultReport );
        }
        return value;
    },
    /**
     * Column renderer function for the payment column of the list grid.
     * @param value    - The field value
     * @param metaData - The model meta data
     * @param record   - The whole data model
     */
    inkassoColumn: function( value, metaData, record ){
        var me = this;
        if( value === Ext.undefined ) {
            return value;
        }
        var recordListing = me.orderListingStore.findRecord( 'id', value );
        if( recordListing instanceof Ext.data.Model ) {
            value = me.processRenderCollection( value, recordListing );
        }
        return value;
    },
    /**
     *
     * @param value
     * @param record
     * @returns string|html
     */
    processRenderCollection: function( value, record ){
        var me = this,
            showText = value,
            hasExtension = false,
            hasError = false;
        if( parseInt( record.get( 'crefoOrderType' ) ) === 1 ) {
            var proposalRecord = me.crefoProposalStore.findRecord( 'id', record.get( 'crefoOrderId' ) );
            if( !Ext.isEmpty( proposalRecord ) ) {
                var status = proposalRecord.get( 'proposalStatus' );
                showText = me.snippetsExt.collectionAnswers.documentType.proposal;
                hasExtension = (parseInt( status ) === 2);
                hasError = (parseInt( status ) === 0);
                if( hasError ) {
                    showText = me.snippetsExt.collectionAnswers.documentType.errorText;
                }
            }
        } else if( parseInt( record.get( 'crefoOrderType' ) ) === 2 ) {
            var documentRecord = me.crefoOrdersStore.findRecord( 'id', record.get( 'crefoOrderId' ) );
            if( !Ext.isEmpty( documentRecord ) && !Ext.isEmpty( documentRecord.get( 'documentNumber' ) ) ) {
                showText = documentRecord.get( 'documentNumber' );
            }
        }
        if( hasExtension ) {
            var extensionText = Ext.String.format( "&nbsp;<span data-qtip='[0]' class='sprite-exclamation' style='padding-left: 25px;'></span>", me.snippetsExt.collectionAnswers.documentType.toEdit );
            value = Ext.String.format( "<span class='fake-link'>[0]</span>[1]", showText, extensionText );
        } else {
            value = Ext.String.format( "<span class='fake-link'>[0]</span>", showText );
        }
        return value;
    },
    /**
     * Renders the Solvency text based on the input
     *
     * @param returnValue
     * @param record
     * @returns string|html
     */
    processRenderSolvency: function( returnValue, record ){
        var me = this;
        var riskJudgement = record.get( 'riskJudgement' );
        var indexThreshold = record.get( 'indexThreshold' );
        var orderNumber = record.get( 'orderNumber' );
        if( riskJudgement.toLowerCase() === me.snippetsExt.solvencyAnswers.values.fault ) {
            returnValue = Ext.String.format( "<span class='fake-link'>[0]</span>", me.snippetsExt.solvencyAnswers.error );
        } else if( riskJudgement.toLowerCase() === me.snippetsExt.solvencyAnswers.values.noValue ) {
            returnValue = me.snippetsExt.solvencyAnswers.noValue + '<br/>' + (record.get( 'successfulSolvency' ) ? me.snippetsExt.solvencyResults.passed : me.snippetsExt.solvencyResults.rejected);
            returnValue = Ext.String.format( "<a href='{url module=backend controller=CrefoOrders action=openSolvencyPdf}?orderNumber=[1]' target='_blank'>[0]</a>",
                returnValue, orderNumber );
        } else if( riskJudgement.toUpperCase() === me.snippetsExt.solvencyAnswers.values.white ) {
            returnValue = me.snippetsExt.solvencyAnswers.white;
            if( indexThreshold > 0 ) {
                returnValue += ' ' + me.snippetsExt.solvencyAnswers.for + ' ' + indexThreshold;
            }
            returnValue += '<br/>' + (record.get( 'successfulSolvency' ) ? me.snippetsExt.solvencyResults.passed : me.snippetsExt.solvencyResults.rejected);
            returnValue = Ext.String.format( "<a href='{url module=backend controller=CrefoOrders action=openSolvencyPdf}?orderNumber=[1]' target='_blank'>[0]</a>",
                returnValue, orderNumber );
        } else if( riskJudgement.toUpperCase() === me.snippetsExt.solvencyAnswers.values.black ) {
            returnValue = me.snippetsExt.solvencyAnswers.black;
            if( indexThreshold > 0 ) {
                returnValue += ' ' + me.snippetsExt.solvencyAnswers.for + ' ' + indexThreshold;
            }
            returnValue += '<br/>' + (record.get( 'successfulSolvency' ) ? me.snippetsExt.solvencyResults.passed : me.snippetsExt.solvencyResults.rejected);
            returnValue = Ext.String.format( "<a href='{url module=backend controller=CrefoOrders action=openSolvencyPdf}?orderNumber=[1]' target='_blank'>[0]</a>",
                returnValue, orderNumber );
        }
        return returnValue;
    },
    /**
     * Renders the Solvency text based on the input
     *
     * @param returnValue
     * @param record
     * @returns string|html
     */
    processRenderSolvencyBonima: function( returnValue, record ){
        var me = this;

        var textReportName = record.get( 'textReportName' );
        if( textReportName.toLowerCase() === me.snippetsExt.solvencyAnswers.values.fault ) {
            returnValue = Ext.String.format( "<span class='fake-link'>[0]</span>", me.snippetsExt.solvencyAnswers.error );
        } else {
            returnValue = record.get( 'privatePersonResult' ) + '<br/>' + (record.get( 'successfulSolvency' ) ? me.snippetsExt.solvencyResults.passed : me.snippetsExt.solvencyResults.rejected);
            returnValue = Ext.String.format( "<span class='fake-link' data-openXml='true'>[0]</span>", returnValue );
        }
        return returnValue;
    }
} );
//{/block}

