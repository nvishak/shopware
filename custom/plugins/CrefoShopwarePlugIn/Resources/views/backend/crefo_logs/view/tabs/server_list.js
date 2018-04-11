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
//{block name="backend/crefo_logs/view/tabs/server_list"}
Ext.define('Shopware.apps.CrefoLogs.view.tabs.ServerList', {
    extend:'Ext.grid.Panel',
    alias:'widget.crefo-logs-server-list',
    cls:Ext.baseCSSPrefix + 'crefo-logs-server-list',
    region:'center',
    autoScroll:false,
    snippets:{
        columns:{
            fileName : '{s name="crefologs/view/main/tabs/columns/server/filename"}Log Name{/s}',
            dataindex:{
                fileName : 'filename'
            }
        },
        toolbar:{
            zipDownload: '{s name="crefologs/view/main/tabs/server/toolbar/zipDownload"}Log-Eintrag herunterladen{/s}'
        },
        paging: {
            pageSize: '{s name="crefologs/view/main/tabs/server/paging_bar/page_sie"}Zahl der Logs{/s}'
        }
    },
    viewConfig: {
        enableTextSelection: true
    },

    initComponent:function () {
        var me = this;
        me.registerEvents();
        me.store = me.listServerStore;
        me.selModel = me.getGridSelModel();
        me.columns = me.getColumns();
        me.toolbar = me.getToolbar();
        me.pagingbar = me.getPagingBar();
        me.dockedItems = [ me.toolbar, me.pagingbar ];
        me.callParent(arguments);
    },

    /**
     * Adds the specified events to the list of events which this Observable may fire.
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the tooltip button to Download the Zip
             *
             * @event
             * @param [object] - Form values
             */
            'downloadServerLogs'
        );
    },

    /**
     * Creates the paging toolbar for the customer grid to allow
     * and store paging. The paging toolbar uses the same store as the Grid
     *
     * @return Ext.toolbar.Paging The paging toolbar for the customer grid
     */
    getPagingBar:function () {
        var me = this;

        var pageSize = Ext.create('Ext.form.field.ComboBox', {
            fieldLabel: me.snippets.paging.pageSize,
            labelWidth: 120,
            cls: Ext.baseCSSPrefix + 'page-size',
            queryMode: 'local',
            width: 180,
            listeners: {
                scope: me,
                select: me.onPageSizeChange
            },
            store: Ext.create('Ext.data.Store', {
                fields: [ 'value' ],
                data: [
                    { value: '20' },
                    { value: '40' },
                    { value: '60' },
                    { value: '80' },
                    { value: '100' }
                ]
            }),
            displayField: 'value',
            valueField: 'value'
        });
        pageSize.setValue(me.listServerStore.pageSize);

        var pagingBar = Ext.create('Ext.toolbar.Paging', {
            store: me.listServerStore,
            dock:'bottom',
            displayInfo:true
        });

        pagingBar.insert(pagingBar.items.length - 2, [ { xtype: 'tbspacer', width: 6 }, pageSize ]);

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
    onPageSizeChange: function(combo, records) {
        var record = records[0],
            me = this;

        me.listServerStore.pageSize = record.get('value');
        me.listServerStore.loadPage(1);
    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns:function () {
        var me = this;

        return [
            {
                header: me.snippets.columns.fileName,
                dataIndex: me.snippets.columns.dataindex.fileName,
                flex:1
            }
        ];
    },
    /**
     * Creates the grid selection model for checkboxes
     *
     * @return [Ext.selection.CheckboxModel] grid selection model
     */
    getGridSelModel:function () {
        var me = this;

        return Ext.create('Ext.selection.CheckboxModel', {
            checkOnly: true,
            listeners:{
                // Unlocks the save button if the user has checked at least one checkbox
                selectionchange:function (sm, selections) {
                    if (me.downloadZipButton !== null ) {
                        me.downloadZipButton.setDisabled(selections.length === 0);
                    }
                }
            }
        });
    },

    /**
     * Creates the grid toolbar with the add and delete button
     *
     * @return [Ext.toolbar.Toolbar] grid toolbar
     */
    getToolbar:function () {
        var me = this;

        me.downloadZipButton = Ext.create('Ext.button.Button', {
            iconCls:'sprite-inbox-download',
            text:me.snippets.toolbar.zipDownload,
            action:'serverLogsZipDownloading',
            disabled:true,
            handler: function() {
                me.fireEvent('downloadServerLogs', me);
            }
        });


        return Ext.create('Ext.toolbar.Toolbar', {
            dock:'top',
            ui: 'shopware-ui',
            items:[
                me.downloadZipButton
            ]
        });
    }


});
//{/block}

