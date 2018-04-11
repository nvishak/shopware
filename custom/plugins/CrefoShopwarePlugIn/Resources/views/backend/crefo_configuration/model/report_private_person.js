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
//{block name="backend/crefo_configuration/model/report_private_person"}
Ext.define( 'Shopware.apps.CrefoConfiguration.model.ReportPrivatePerson', {
    extend: 'Shopware.data.Model',
    alias: 'model.reportPrivatePerson',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'userAccountId', type: 'int', useNull: true },
        { name: 'selectedProductKey', type: 'int', useNull: true },
        { name: 'legitimateKey', type: 'string', useNull: true },
        { name: 'thresholdMin', type: 'decimal', useNull: true },
        { name: 'thresholdMax', type: 'decimal', useNull: true }
    ],
    proxy: {
        type: 'ajax',
        api: {
            read: '{url controller="CrefoConfiguration" action=getReportPrivatePersonInfo}'
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
    associations:[
        {
            type: 'hasOne',
            model:'Shopware.apps.CrefoConfiguration.model.Account',
            name:'getUserAccount',
            associationKey:'user_account_id',
            foreignKey: 'id',
            primaryKey: 'userAccountId'
        },
        {
            type: 'hasMany',
            model: 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.ProductDb',
            name: 'getProducts',
            associationKey: 'products'
        }
    ]
} );
//{/block}