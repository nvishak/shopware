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
//{block name="backend/crefo_configuration/store/report_private_person"}
Ext.define('Shopware.apps.CrefoConfiguration.store.ReportPrivatePerson', {
    extend: 'Ext.data.Store',
    autoLoad: false,
    autoSync: true,
    model: 'Shopware.apps.CrefoConfiguration.model.ReportPrivatePerson'
});
//{/block}
