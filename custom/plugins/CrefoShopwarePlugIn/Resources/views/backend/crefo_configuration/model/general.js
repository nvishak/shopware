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
//{block name="crefo_configuration/model/general"}
Ext.define('Shopware.apps.CrefoConfiguration.model.General', {
    extend: 'Shopware.data.Model',
    alias: 'model.general',
    configure: function() {
        return {
            controller: 'CrefoConfiguration'
        };
    },
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'communicationLanguage', type: 'string', useNull: false },
        { name: 'consentDeclaration', type: 'boolean' },
        { name: 'logsMaxNumberOfRequest', type: 'integer', useNull: false },
        { name: 'logsMaxStorageTime', type: 'integer', useNull: false },
        { name: 'errorNotificationStatus', type: 'boolean' },
        { name: 'emailAddress', type: 'string', useNull: true },
        { name: 'requestCheckAtValue', type: 'integer', useNull: true },
        { name: 'errorTolerance', type: 'integer', useNull: true }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action="getGeneralSettings"}',
            update: '{url controller="CrefoConfiguration" action="updateGeneralSettings"}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//{/block}
