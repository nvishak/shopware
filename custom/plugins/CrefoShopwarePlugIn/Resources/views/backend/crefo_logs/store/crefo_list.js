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
//{block name="backend/crefo_logs/store/crefo_list"}
Ext.define('Shopware.apps.CrefoLogs.store.CrefoList', {
    extend: 'Ext.data.Store',
    autoLoad: true,
    /**
     * Enable remote sort.
     * @boolean
     */
    remoteSort: true,
    /**
     * Enable remote filtering
     * @boolean
     */
    remoteFilter: true,
    /**
     * Amount of data loaded at once
     * @integer
     */
    pageSize: 20,
    model: 'Shopware.apps.CrefoLogs.model.CrefoList'
});
//{/block}
