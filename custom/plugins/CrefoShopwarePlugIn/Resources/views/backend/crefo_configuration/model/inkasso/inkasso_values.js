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
//{block name="backend/crefo_configuration/model/inkasso/inkasso_values"}
Ext.define('Shopware.apps.CrefoConfiguration.model.inkasso.InkassoValues', {
    extend: 'Shopware.data.Model',
    alias: 'model.inkasso.inkasso-values',
    fields: [
        { name: 'id', type: 'int', useNull: false },
        { name: 'textWS', type: 'string', useNull: true },
        { name: 'keyWS', type: 'string', useNull: true },
        { name: 'typeValue', type: 'int', useNull: false }
    ],
    proxy: {
        type: 'memory',
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//{/block}
