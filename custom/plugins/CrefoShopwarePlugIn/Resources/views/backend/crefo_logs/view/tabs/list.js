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
//{block name="backend/crefo_logs/view/tabs/list"}
Ext.define( 'Shopware.apps.CrefoLogs.view.tabs.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.crefo-logs-interface-list',
    cls: Ext.baseCSSPrefix + 'crefo-logs-interface-list',
    region: 'center',
    autoScroll: false,
    snippets: {
        columns: {
            logId: '{s name="crefologs/view/main/tabs/columns/logId"}Log-ID{/s}',
            requestXml: '{s name="crefologs/view/main/tabs/columns/requestXml"}Request-XML{/s}',
            responseXml: '{s name="crefologs/view/main/tabs/columns/responseXml"}Response-XML{/s}',
            responsePdf: '{s name="crefologs/view/main/tabs/columns/responsePdf"}Response-PDF{/s}',
            tsProcessEnd: '{s name="crefologs/view/main/tabs/columns/tsResponse"}Zeitstempel des WebShops{/s}',
            tsResponse: '{s name="crefologs/view/main/tabs/columns/tsProcessEnd"}Zeitstempel der Creditreform-Response{/s}',
            dataindex: {
                logId: 'id',
                requestXMLDescription: 'requestXMLDescription',
                responseXMLDescription: 'responseXMLDescription',
                reportResultId: 'reportResultId',
                tsResponse: 'tsResponse',
                tsProcessEnd: 'tsProcessEnd'
            }
        },
        toolbar: {
            zipDownload: '{s name="crefologs/view/main/tabs/toolbar/zipDownload"}Log-Eintrag herunterladen{/s}'
        },
        values: {
            textReport: '{s name="crefologs/view/main/tabs/values/textReport"}Textreport{/s}'
        },
        paging: {
            pageSize: '{s name="crefologs/view/main/tabs/paging_bar/page_sie"}Zahl der Logs{/s}'
        },
        fault: 'fault',
        errorText: '{s name="crefologs/view/main/tabs/fault"}Error{/s}'
    },
    viewConfig: {
        enableTextSelection: true
    },
    listeners: {
        "cellclick": function( iView, iCellEl, iColIdx, iStore, iRowEl, iRowIdx, iEvent ){
            var me = this;
            if( iEvent.target.tagName.toLowerCase() === 'span' && iColIdx > 1 && iColIdx < 4 ) {
                me.fireEvent( 'showData', iStore.get( 'id' ), iColIdx );
            }
        }
    },

    initComponent: function(){
        var me = this;
        me.registerEvents();
        me.store = me.crefoListStore;
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
             * Event will be fired when the user clicks the log specific entry
             *
             * @event
             * @param [object] - Form values
             */
            'showData',
            /**
             * Event will be fired when the user clicks the tooltip button to Download the Zip
             *
             * @event
             * @param [object] - Form values
             */
            'downloadZip'
        );
    },

    /**
     * Creates the paging toolbar for the customer grid to allow
     * and store paging. The paging toolbar uses the same store as the Grid
     *
     * @return Ext.toolbar.Paging The paging toolbar for the customer grid
     */
    getPagingBar: function(){
        var me = this;

        var pageSize = Ext.create( 'Ext.form.field.ComboBox', {
            fieldLabel: me.snippets.paging.pageSize,
            labelWidth: 120,
            cls: Ext.baseCSSPrefix + 'page-size',
            queryMode: 'local',
            width: 180,
            listeners: {
                scope: me,
                select: me.onPageSizeChange
            },
            store: Ext.create( 'Ext.data.Store', {
                fields: [ 'value' ],
                data: [
                    { value: '20' },
                    { value: '40' },
                    { value: '60' },
                    { value: '80' },
                    { value: '100' }
                ]
            } ),
            displayField: 'value',
            valueField: 'value'
        } );
        pageSize.setValue( me.crefoListStore.pageSize );

        var pagingBar = Ext.create( 'Ext.toolbar.Paging', {
            store: me.crefoListStore,
            dock: 'bottom',
            displayInfo: true
        } );

        pagingBar.insert( pagingBar.items.length - 2, [ { xtype: 'tbspacer', width: 6 }, pageSize ] );

        return pagingBar;

    },

    /**
     * Event listener method which fires when the user selects
     * a entry in the "number of orders"-combo box.
     *
     * @event select
     * @param [object] combo - Ext.form.field.ComboBox
     * @param [array] records - Array of selected entries
     * @return void
     */
    onPageSizeChange: function( combo, records ){
        var record = records[ 0 ],
            me = this;

        me.crefoListStore.pageSize = record.get( 'value' );
        me.crefoListStore.loadPage( 1 );
    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns: function(){
        var me = this;

        return [
            {
                header: me.snippets.columns.logId,
                dataIndex: me.snippets.columns.dataindex.logId,
                flex: 0.3
            },
            {
                header: me.snippets.columns.requestXml,
                dataIndex: me.snippets.columns.dataindex.requestXMLDescription,
                flex: 1,
                renderer: me.requestXMLRender
            },
            {
                header: me.snippets.columns.responseXml,
                dataIndex: me.snippets.columns.dataindex.responseXMLDescription,
                flex: 1,
                renderer: me.responseXMLRender
            },
            {
                header: me.snippets.columns.responsePdf,
                dataIndex: me.snippets.columns.dataindex.reportResultId,
                flex: 1,
                renderer: me.reportResultRender
            },
            {
                header: me.snippets.columns.tsResponse,
                dataIndex: me.snippets.columns.dataindex.tsResponse,
                flex: 1.5,
                renderer: function( value, metaData, record ){
                    if( value === Ext.undefined ) {
                        return value;
                    }
                    return Ext.util.Format.date( value, 'Y-m-d H:i:s' );
                }
            },
            {
                header: me.snippets.columns.tsProcessEnd,
                dataIndex: me.snippets.columns.dataindex.tsProcessEnd,
                flex: 1.5,
                renderer: function( value, metaData, record ){
                    if( value === Ext.undefined ) {
                        return value;
                    }
                    return Ext.util.Format.date( value, 'Y-m-d H:i:s' );
                }
            }
        ];
    },
    /**
     * Creates the grid selection model for checkboxes
     *
     * @return [Ext.selection.CheckboxModel] grid selection model
     */
    getGridSelModel: function(){
        var me = this;

        return Ext.create( 'Ext.selection.CheckboxModel', {
            checkOnly: true,
            listeners: {
                // Unlocks the save button if the user has checked at least one checkbox
                selectionchange: function( sm, selections ){
                    if( me.downloadZipButton !== null ) {
                        me.downloadZipButton.setDisabled( selections.length !== 1 );
                    }
                }
            }
        } );
    },

    /**
     * Creates the grid toolbar with the add and delete button
     *
     * @return [Ext.toolbar.Toolbar] grid toolbar
     */
    getToolbar: function(){
        var me = this;

        me.downloadZipButton = Ext.create( 'Ext.button.Button', {
            iconCls: 'sprite-inbox-download',
            text: me.snippets.toolbar.zipDownload,
            action: 'zipDownloading',
            disabled: true,
            handler: function(){
                me.fireEvent( 'downloadZip', me );
            }
        } );


        return Ext.create( 'Ext.toolbar.Toolbar', {
            dock: 'top',
            ui: 'shopware-ui',
            items: [
                me.downloadZipButton
            ]
        } );
    },
    requestXMLRender: function( value, metaData, record ){
        var me = this;

        if( Ext.isDefined( value ) === false ) {
            return value;
        }

        if( record instanceof Ext.data.Model ) {
            var showText = record.get( 'requestXMLDescription' );
            if( showText.toLowerCase() === me.snippets.fault ) {
                showText = me.snippets.errorText;
            }
            Ext.isDefined( showText ) ? value = Ext.String.format( "<span class='fake-link'>[0]</span>", showText ) : null;
        }

        return value;
    },
    responseXMLRender: function( value, metaData, record ){
        var me = this;

        if( Ext.isDefined( value ) === false ) {
            return value;
        }

        if( record instanceof Ext.data.Model ) {
            var showText = record.get( 'responseXMLDescription' );
            if( showText.toLowerCase() === me.snippets.fault ) {
                showText = me.snippets.errorText;
            }
            Ext.isDefined( showText ) ? value = Ext.String.format( "<span class='fake-link'>[0]</span>", showText ) : null;
        }

        return value;
    },
    reportResultRender: function( value, metaData, record ){
        var me = this;

        if( Ext.isDefined( value ) === false ) {
            return value;
        }
        if( record instanceof Ext.data.Model && Ext.isDefined( record.raw.crefoReportResult ) ) {
            var reportResultId = parseInt( record.raw.crefoReportResult.id );
            value = record.raw.crefoReportResult.riskJudgement !== me.snippets.fault ?
                Ext.String.format( "<a href='{url module=backend controller=CrefoLogs action=openSolvencyPdf}?id=[1]' target='_blank'>[0]</a>",
                    me.snippets.values.textReport, reportResultId ) : null;
        } else {
            value = null;
        }
        return value;
    }
} );
//{/block}

