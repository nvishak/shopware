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
//{block name="backend/crefo_configuration/model/account"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.Account', {
    extend: 'Ext.data.Model',
    alias: 'model.crefo.account',
    fields: [
        //{block name="backend/crefo_configuration/model/account/fields"}{/block}
        'id', 'useraccount', 'generalpassword', 'individualpassword' ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action="getAccounts"}',
            create: '{url controller="CrefoConfiguration" action="createAccount"}',
            update: '{url controller="CrefoConfiguration" action="updateAccount"}',
            destroy: '{url controller="CrefoConfiguration" action="deleteAccount"}'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    },
    /**
     * Define the associations of the order model.
     * @array
     */
    associations: [
        {
            type: 'belongsTo',
            model: 'Shopware.apps.CrefoConfiguration.model.ReportPrivatePerson'
        }
    ],
    validations: [
        { field: 'generalpassword', type: 'length', min: 6 },
        { field: 'individualpassword', type: 'length', min: 6 },
        { field: 'useraccount', type: 'length', min: 12 }
    ],
    allowAccountDelete: function( inUseAccounts ){
        return inUseAccounts.findRecord( 'id', this.get( 'id' ) ) !== null;
    }
} );
//{/block}