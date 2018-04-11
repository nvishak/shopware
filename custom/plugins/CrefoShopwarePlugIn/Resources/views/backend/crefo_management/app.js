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
//{block name="backend/crefo_management/app" }
Ext.define('Shopware.apps.CrefoManagement', {
    extend: 'Enlight.app.SubApplication',
    name: 'Shopware.apps.CrefoManagement',
    loadPath: '{url action=load}',
    bulkLoad: true,
    controllers: ['Main'],
    views: [
        'content.Panel',

        'main.Window'
    ],
    defaultController: 'Main',
    launch: function () {
        Ext.require('CrefoUtil');
        CrefoUtil.loadSnippets(Ext.undefined);
        var me = this,
            controller = me.getController(me.defaultController);

        return controller.mainWindow;
    }
});
//{/block}
