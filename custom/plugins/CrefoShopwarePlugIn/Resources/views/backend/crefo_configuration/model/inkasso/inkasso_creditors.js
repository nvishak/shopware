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
//{block name="backend/crefo_configuration/model/inkasso/inkasso_creditors"}
Ext.define('Shopware.apps.CrefoConfiguration.model.inkasso.InkassoCreditors', {
    extend: 'Shopware.data.Model',
    alias: 'model.inkasso.inkasso-creditors',
    fields: [
        { name: 'id', type: 'int', useNull: true },
        { name: 'useraccount', type: 'string', useNull: true },
        { name: 'name', type: 'string', useNull: true },
        { name: 'address', type: 'string', useNull: true },
        {
            name: 'creditorDisplay',
            mapping: 'useraccount',
            convert: function (value, record) {
                if (record.get('name') !== null && record.get('name') !== undefined && record.get('name') !== '') {
                    return record.get('useraccount') + ' - ' + record.get('name') + ' ' + record.get('address');
                } else {
                    return '';
                }
            }
        }
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
