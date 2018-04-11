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
//{block name="backend/crefo_configuration/store/inkasso/inkasso_creditors"}
Ext.define('Shopware.apps.CrefoConfiguration.store.inkasso.InkassoCreditors', {
    extend: 'Ext.data.Store',
    autoLoad: true,
    autoSync : true,
    groupField: 'useraccount',
    sorters: [{
        property: 'useraccount',
        direction: 'ASC'
    }],
    sortOnLoad: true,
    model : 'Shopware.apps.CrefoConfiguration.model.inkasso.InkassoCreditors'
});
//{/block}