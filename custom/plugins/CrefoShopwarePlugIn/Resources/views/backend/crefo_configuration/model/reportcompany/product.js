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
//{block name="backend/crefo_configuration/model/reportcompany/product"}
Ext.define('Shopware.apps.CrefoConfiguration.model.reportcompany.Product', {
    extend: 'Shopware.data.Model',
    alias: 'model.reportcompany-product',
    idgen: 'sequential',
    fields: [
        { name: 'available', type: 'boolean', useNull: false, defaultValue: true },
        { name: 'country', type: 'int', useNull: false },
        { name: 'hasSolvencyIndex', type: 'boolean', useNull: true },
        { name: 'keyWS', type: 'string', useNull: false },
        { name: 'nameWS', type: 'string', useNull: false }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'products'
        }
    }
});
//{/block}
