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
//{block name="backend/crefo_configuration/controller/settings"}
Ext.define('Shopware.apps.CrefoConfiguration.controller.Settings', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        general: {
            tabsGeneral: '{s name="crefoconfig/view/main/window/tab/general"}General{/s}'
        },
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}'
    },
    init: function() {
        var me = this;
        me.control({
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            },
            'crefoconfig-tabs-general-panel': {
                saveSettings: me.onSaveSettings
            },
            'crefoconfig-tabs-general-container': {
                showErrorNotificationStatus: me.onShowErrorNotificationStatus
            }
        });
        me.callParent(arguments);
    },
    onChangeTab: function(tabsPanel, newTab, oldTab, formPanel) {
        var newTabPanel = newTab.items.items[ 0 ];

        if (/settingsPanel/ig.test(newTabPanel.id)) {
            newTabPanel.up('window').setLoading(true);
            var container = newTabPanel.down('container'),
                foundLastRestField = false;
            newTabPanel.getForm().getFields().each(function(f) {
                if (!foundLastRestField) {
                    f.reset();
                    if (f.id === 'general_error_notification') {
                        foundLastRestField = true;
                    }
                }
            });
            newTabPanel.generalStore.load({
                callback: function () {
                    container.loadSettings(true);
                    newTabPanel.up('window').setLoading(false);
                }
            });
        }
    },
    onSaveSettings: function(panel) {
        var me = this;

        if (!CrefoUtil.isFormValid(panel)) {
            return;
        }
        var values = panel.getForm().getValues();
        panel.up('window').setLoading(true);
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoConfiguration action=updateGeneralSettings}',
            method: 'POST',
            params: values,
            success: function() {
                panel.generalStore.load({
                    callback: function () {
                        panel.up('window').setLoading(false);
                        CrefoUtil.showStickyMessage('', me.snippets.success);
                    }
                });
            },
            failure: function() {
                CrefoUtil.handleFailure(panel.up('window'), true);
            }
        });
    },
    onShowErrorNotificationStatus: function(event) {
        var me = this;
        event.up('window').setLoading(true);
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoConfiguration action=getErrorNotificationStatus}',
            method: 'POST',
            success: function(response) {
                try {
                    var result = Ext.JSON.decode(response.responseText);
                    event.up('window').setLoading(false);
                    me.getView('tabs.general.popup.ErrorCounter').create({
                        record: result.data
                    });
                } finally {
                    event.up('window').setLoading(false);
                }
            },
            failure: function() {
                CrefoUtil.handleFailure(event.up('window'), true);
            }
        });
    }
});
//{/block}
