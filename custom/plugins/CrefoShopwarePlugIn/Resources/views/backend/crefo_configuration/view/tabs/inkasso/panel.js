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
//{block name="backend/crefo_configuration/view/tabs/inkasso/panel"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefoconfig-tabs-inkasso-panel',
    bodyPadding: 10,
    autoScroll: true,
    snippets: {
        buttons: {
            save: '{s name=crefo/buttons/save}Save{/s}'
        }
    },
    defaults: {
        dateFields: 0,
        customerReferenceId: 1
    },
    initComponent: function(){
        var me = this;
        me.inkassoStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.Inkasso' );
        me.inkassoValuesStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.inkasso.InkassoValues' );
        me.inkassoCreditorsStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.inkasso.InkassoCreditors' );
        me.inkassoStore.load();
        me.inkassoValuesStore.load();
        me.inkassoCreditorsStore.load();
        me.items = [
            Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.ContainerHeader', {
                parentPanel: me
            } ),
            Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Container', {
                parentPanel: me
            } )
        ];

        me.dockedItems = [ {
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items: me.getButtons()
        } ];

        me.callParent( arguments );
    },
    getButtons: function(){
        var me = this;

        return [ '->', {
            text: me.snippets.buttons.save,
            id: 'crefoConfig-inkasso-saveBtn',
            name: 'crefoConfig-inkasso-saveBtn',
            action: 'save-inkasso',
            cls: 'primary',
            handler: function( event ){
                me.fireEvent( 'saveInkasso', me );
            }
        }
        ];
    }

} );
// {/block}
