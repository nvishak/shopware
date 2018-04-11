/*
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
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
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.general.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefoconfig-tabs-general-panel',
    id: 'settingsPanel',
    bodyPadding: 10,
    autoScroll: true,
    initComponent: function() {
        var me = this;

        me.items = [ {
            xtype: 'crefoconfig-tabs-general-container',
            parentPanel: me
        } ];

        me.dockedItems = [
            {
                xtype: 'toolbar',
                ui: 'shopware-ui',
                dock: 'bottom',
                cls: 'shopware-toolbar',
                items: me.getBottomButtons()
            } ];

        me.addEvents('saveSettings');
        me.callParent(arguments);
    },
    getBottomButtons: function() {
        var me = this;
        return [ '->',
            {
                text: '{s name=crefo/buttons/reset}Reset{/s}',
                xtype: 'button',
                cls: 'secondary',
                handler: function(event) {
                    var foundLastRestField = false,
                        container = me.down('container');
                    me.getForm().getFields().each(function(f) {
                        if (!foundLastRestField) {
                            f.reset();
                            if (f.id === 'general_error_notification') {
                                foundLastRestField = true;
                            }
                        }
                    });
                    container.loadSettings(false);
                }
            }, {
                xtype: 'button',
                cls: 'primary',
                text: '{s name=crefo/buttons/save}Save{/s}',
                handler: function() {
                    me.fireEvent('saveSettings', me);
                }
            } ];
    }
});
//{/block}
