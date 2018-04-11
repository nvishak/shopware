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
//{block name="backend/crefo_configuration/view/tabs/general/panel"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.general.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefoconfig-tabs-general-panel',
    bodyPadding: 10,
    autoScroll: true,
    initComponent: function(){
        var me = this;

        me.items = [ {
            xtype: 'crefoconfig-tabs-general-container',
            generalStore: me.generalStore
        } ];

        me.dockedItems = [
            {
                xtype: 'toolbar',
                ui: 'shopware-ui',
                dock: 'bottom',
                cls: 'shopware-toolbar',
                items: me.getBottomButtons()
            } ];

        me.addEvents( 'resetSettings', 'saveSettings' );
        me.callParent( arguments );
    },
    getBottomButtons: function(){
        var me = this;
        return [ '->',
            {
                text: '{s name=crefo/buttons/reset}Reset{/s}',
                xtype: 'button',
                cls: 'secondary',
                handler: function( event ){
                    me.fireEvent( 'resetSettings', me.generalStore, me, event );
                }
            }, {
                xtype: 'button',
                cls: 'primary',
                text: '{s name=crefo/buttons/save}Save{/s}',
                handler: function( event ){
                    me.fireEvent( 'saveSettings', me.generalStore.first(), me );
                }
            } ];
    }
} );
// {/block}
