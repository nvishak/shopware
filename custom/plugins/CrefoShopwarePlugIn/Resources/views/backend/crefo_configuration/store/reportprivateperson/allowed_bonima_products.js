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
//{block name="backend/crefo_configuration/store/report_private_person/allowed_bonima_products"}
Ext.define( 'Shopware.apps.CrefoConfiguration.store.reportprivateperson.AllowedBonimaProducts', {
    extend: 'Ext.data.Store',
    autoLoad: true,
    autoSync: true,
    groupField: 'id',
    model: 'Shopware.apps.CrefoConfiguration.model.reportprivateperson.AllowedBonimaProducts'
} );
//{/block}