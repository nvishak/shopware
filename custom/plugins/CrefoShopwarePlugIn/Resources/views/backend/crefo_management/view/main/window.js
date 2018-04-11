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
//{block name="backend/crefo_management/view/main/window" }
Ext.define('Shopware.apps.CrefoManagement.view.main.Window', {
    extend: 'Enlight.app.Window',
    alias: 'widget.crefo-management-main-window',
    height: 250,
    width: 550,
    minWidth: 500,
    minHeight: 200,
    stateful: true,
    stateId: 'shopware-crefo-management-window',
    layout: 'border',
    resizable: true,
    maximizable: false,
    autoScroll: false,
    snippets: {
        title: '{s name=crefomanagement/view/main/window/title}Creditreform Verwaltung{/s}'
    },
    /**
     * Initializes the component and builds up the main interface
     *
     * @return void
     */
    initComponent: function () {
        var me = this;
        me.title = me.snippets.title;
        me.panel = me.createPanel();
        me.items = [me.panel];
        me.callParent(arguments);
    },
    createPanel: function () {
        var me = this;
        me.manPanel = Ext.create('Shopware.apps.CrefoManagement.view.content.Panel');
        return Ext.create('Ext.form.Panel', {
            autoShow: true,
            layout: 'fit',
            region: 'center',
            border: 0,
            bodyBorder: false,
            defaults: {
                layout: 'fit'
            },
            items: [{
                xtype: 'container',
                autoRender: true,
                items: [me.manPanel]
            }]
        });
    }
});
//{/block}
