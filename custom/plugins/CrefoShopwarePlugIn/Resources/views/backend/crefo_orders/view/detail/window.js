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
//{block name="backend/crefo_orders/view/detail/window"}
Ext.define( 'Shopware.apps.CrefoOrders.view.detail.Window', {
    extend: 'Enlight.app.Window',
    alias: 'widget.crefo-orders-view-detail-window',
    cls: Ext.baseCSSPrefix + 'crefo-orders-view-detail-window',
    layout: 'fit',
    border: false,
    autoShow: true,
    autoScroll: true,
    width: 900,
    height: Ext.getBody().getViewSize().height - 100,
    maximizable: true,
    minimizable: true,
    resizable: false,
    modal: true,
    stateful: true,
    ui: 'shopware-ui',
    stateId: 'crefo-orders-view-detail-window',
    snippets: {
        titleDoc: '{s name="crefo/orders/view/detail/window/title/document"}Creditreform-PlugIn: Details zum Inkasso-Auftrag{/s}',
        titleProposal: '{s name="crefo/orders/view/detail/window/title/proposal"}Creditreform-PlugIn: Vorschlag zum Inkasso-Auftrag{/s}',
        titleErrorProposal: '{s name="crefo/orders/view/detail/window/title/error-proposal"}Creditreform-PlugIn: Fehler bei der Abgabe des Inkasso-Auftrags{/s}',
        btn: {
            save: '{s name="crefo/orders/view/detail/window/btn/save"}Vorschlag speichern{/s}',
            send: '{s name="crefo/orders/view/detail/window/btn/send"}Inkasso-Auftrag senden{/s}',
            delete: '{s name="crefo/orders/view/detail/window/btn/delete"}Vorschlag löschen{/s}',
            cancel: '{s name="crefo/orders/view/detail/window/btn/cancel"}Abbrechen{/s}',
            print: '{s name="crefo/orders/view/detail/window/btn/print"}Drucken{/s}'
        }
    },

    /**
     * Initialize the view components
     *
     * @return void
     */
    initComponent: function(){
        var me = this;
        me.inkassoConfig = me.list.inkassoConfig;
        me.inkassoConfig.reload();
        if( me.editOrder ) {
            var status = me.crefoProposalRecord.get( 'proposalStatus' );
            if( parseInt( status ) === 0 ) {
                me.title = me.snippets.titleErrorProposal;
            } else {
                me.title = me.snippets.titleProposal;
            }
            me.inkassoValuesStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.inkasso.InkassoValues' ).load();
        } else {
            me.title = me.snippets.titleDoc;
        }
        me.items = [ me.createDetailPanel() ];
        me.callParent( arguments );
    },
    createDetailPanel: function(){
        var me = this,
            buttonsDetail,
            content;
        if( me.editOrder ) {
            buttonsDetail = me.createProposalButtons();
            content = Ext.create( 'Shopware.apps.CrefoOrders.view.detail.ContainerProposal', {
                inkassoValuesStore: me.inkassoValuesStore,
                inkassoCreditorsStore: me.inkassoCreditorsStore,
                displayErrors: me.displayErrors,
                inkassoConfig: me.inkassoConfig,
                crefoProposalRecord: me.crefoProposalRecord,
                listRecord: me.listRecord
            } );
        } else {
            buttonsDetail = me.createDocumentOrderButtons();
            content = Ext.create( 'Shopware.apps.CrefoOrders.view.detail.ContainerDocument', {
                record: me.crefoOrdersRecord
            } );
        }
        this.formPanel = Ext.create( 'Ext.form.Panel', {
            alias: 'widget.crefo-orders-view-detail-panel',
            border: false,
            layout: 'anchor',
            autoScroll: true,
            bodyPadding: 10,
            ui: 'shopware-ui',
            defaults: {
                labelWidth: '155',
                labelStyle: 'font-weight: 700; text-align: left;'
            },
            items: [
                content
            ],
            buttons: buttonsDetail
        } );
        this.formPanel.getForm().getFields().each( function( f ){
            if( f.xtype === "displayfield" ) {
                f.baseBodyCls = Ext.baseCSSPrefix + 'form-item-body crefo-remove-from-background';
            }
        } );
        return this.formPanel;
    },
    createProposalButtons: function(){
        var me = this,
            buttons = [];

        var saveButton = Ext.create( 'Ext.button.Button', {
            text: me.snippets.btn.save,
            action: 'save-proposal',
            cls: 'primary',
            handler: function(){
                me.fireEvent( 'saveProposal', me.down( 'panel' ), me.crefoProposalRecord, me.list );
            }
        } );
        buttons.push( saveButton );

        var cancelButton = Ext.create( 'Ext.button.Button', {
            text: me.snippets.btn.cancel,
            action: 'cancel-proposal',
            cls: 'secondary',
            handler: function(){
                me.close();
            }
        } );
        buttons.push( cancelButton );

        var sendButton = Ext.create( 'Ext.button.Button', {
            text: me.snippets.btn.send,
            action: 'send-proposal',
            disabled: me.inkassoConfig.first() === Ext.undefined,
            cls: 'primary',
            handler: function(){
                me.fireEvent( 'sendProposal', me.down( 'panel' ), me.crefoProposalRecord, me.list )
            }
        } );
        buttons.push( sendButton );

        var deleteButton = Ext.create( 'Ext.button.Button', {
            text: me.snippets.btn.delete,
            action: 'delete-proposal',
            cls: 'secondary',
            handler: function(){
                me.fireEvent( 'deleteProposal', me.down( 'panel' ), me.crefoProposalRecord, me.list )
            }
        } );
        buttons.push( deleteButton );

        return buttons;
    },
    createDocumentOrderButtons: function(){
        var me = this,
            buttons = [];

        var cancelButton = Ext.create( 'Ext.button.Button', {
            text: me.snippets.btn.cancel,
            action: 'cancel-proposal',
            cls: 'secondary',
            handler: function(){
                me.close();
            }
        } );
        buttons.push( cancelButton );

        var printButton = Ext.create( 'Ext.button.Button', {
            text: me.snippets.btn.print,
            action: 'print-order',
            cls: 'primary',
            handler: function(){
                me.fireEvent( 'printOrder', me.down( 'panel' ), me.crefoOrdersRecord )
            }
        } );
        buttons.push( printButton );

        return buttons;
    }
} );
//{/block}
