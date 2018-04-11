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
//{block name="backend/crefo_configuration/model/accounts_in_use"}
Ext.define('Shopware.apps.CrefoConfiguration.model.AccountsInUse', {
    extend: 'Ext.data.Model',
    alias: 'model.crefo.accounts_in_use',
    fields: [
        'id', 'serviceCallee'],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action="getInUseAccounts"}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//{/block}