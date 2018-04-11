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
//{block name="backend/crefo_management/controller/main"}
Ext.define('Shopware.apps.CrefoManagement.controller.Main', {
    extend: 'Enlight.app.Controller',
    mainWindow: null,
    snippets: {
        error: {
            message: '{s name=crefomanagement/controller/main/error/message}ACHTUNG! Der Export ist fehlgeschlagen!{/s}'
        }
    },
    init: function () {
        var me = this;
        me.mainWindow = me.getView('main.Window').create().show();
        me.control({
            'crefo-management-content-panel': {
                exportZip: me.onExportZip
            }
        });
        me.callParent(arguments);
    },
    onExportZip: function (panel) {
        var me = this,
            form = panel.getForm(),
            values = form.getValues();
        Ext.Ajax.request({
            url: '{url controller=CrefoManagement action=exportCrefoZip}',
            method: 'POST',
            params: values,
            success: function(response) {
                try {
                    if (!CrefoUtil.isJson(response.responseText)) {
                        throw new Error('no response');
                    }
                    var result = Ext.JSON.decode(response.responseText);
                    if (!result.success) {
                        throw new Error('not successful');
                    }

                    Ext.create('Ext.Component', {
                        frameborder: 0,
                        style: {
                            display: 'none'
                        },
                        autoEl: {
                            tag: 'iframe',
                            src: 'CrefoManagement/downloadZip?zipName=' + result.zipName
                        },
                        renderTo: Ext.getBody()
                    });
                } catch (e) {
                    CrefoUtil.showStickyMessage('', me.snippets.error.message);
                }
            },
            failure: function() {
                CrefoUtil.showStickyMessage('', me.snippets.error.message);
            }
        });
    }
});
//{/block}
