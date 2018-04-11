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
//{block name="backend/crefo_management/view/content/panel"}
Ext.define( 'Shopware.apps.CrefoManagement.view.content.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefo-management-content-panel',
    bodyPadding: 10,
    autoScroll: false,
    standardSubmit: true,
    snippets: {
        title: '{s name=crefomanagement/view/content/panel/title}Export{/s}',
        description: '{s name=crefomanagement/view/content/panel/description}Beim Export werden gespeicherte Ergebnisse von Bonitätsprüfungen und gespeicherte Inkasso-Informationen als lokale Sichtkopien exportiert.<br />Es ist nicht möglich, diese Sichtkopien künftig wieder zu importieren!{/s}',
        button: '{s name=crefomanagement/view/content/panel/download}Export starten{/s}'
    },
    initComponent: function(){
        var me = this;
        me.title = me.snippets.title;
        me.registerEvents();
        me.items = [
            me.createDescriptionContainer( me.snippets.description ),
            {
                xtype: 'hiddenfield',
                name: 'format',
                value: 'csv'
            }
        ];

        me.dockedItems = [ {
            xtype: 'toolbar',
            ui: 'shopware-ui',
            dock: 'bottom',
            cls: 'shopware-toolbar',
            items: me.getBottomButtons()
        } ];

        me.callParent( arguments );
    },

    registerEvents: function(){
        this.addEvents(
            /**
             * Event will be fired when the user clicks the button to Export the Zip
             *
             * @event
             * @param [object] - Form values
             */
            'exportZip'
        );
    },
    getBottomButtons: function(){
        var me = this;
        return [ '->', {
            xtype: 'button',
            cls: 'primary',
            text: me.snippets.button,
            formBind: true,
            handler: function(){
                me.fireEvent( 'exportZip', me );
            }
        } ];
    },
    createDescriptionContainer: function( html ){
        return Ext.create( 'Ext.container.Container', {
            style: 'color: #999; font-style: italic; margin: 0 0 15px 0;',
            html: html
        } );
    }

} );
// {/block}
