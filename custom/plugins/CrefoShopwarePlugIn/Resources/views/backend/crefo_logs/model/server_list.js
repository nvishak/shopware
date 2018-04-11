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
//{block name="backend/crefo_logs/model/server_list"}
Ext.define('Shopware.apps.CrefoLogs.model.ServerList', {
    extend: 'Shopware.data.Model',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'filename', type: 'string', useNull: false }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller=CrefoLogs action=getServerLogs}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//{/block}
