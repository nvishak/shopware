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
//{block name="backend/crefo_configuration/store/inkasso"}
Ext.define('Shopware.apps.CrefoConfiguration.store.Inkasso', {
    extend: 'Ext.data.Store',
    autoLoad: true,
    autoSync : true,
    model: 'Shopware.apps.CrefoConfiguration.model.Inkasso'
});
//{/block}