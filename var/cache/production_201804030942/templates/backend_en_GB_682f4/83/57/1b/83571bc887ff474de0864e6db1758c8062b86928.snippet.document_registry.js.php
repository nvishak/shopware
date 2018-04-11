<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:33
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\store\document_registry.js" */ ?>
<?php /*%%SmartyHeaderCode:109935acda8f52a2386-25606095%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83571bc887ff474de0864e6db1758c8062b86928' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\store\\document_registry.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109935acda8f52a2386-25606095',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f52c58a0_35653324',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f52c58a0_35653324')) {function content_5acda8f52c58a0_35653324($_smarty_tpl) {?>/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   Shopware
 * @author shopware AG
 */

//
Ext.define('Shopware.apps.Order.store.DocumentRegistry', {
    extend: 'Ext.data.Store',
    model: 'Shopware.apps.Order.model.Receipt',
    groupField: 'active',
    sorters: [{
        property: 'active',
        direction: 'DESC'
    }],

    /**
     * Init the documentRegistry
     *
     * @override
     */
    init: function() {
        var me = this;

        me.callParent(arguments);

        me.lastDocumentId = 0;
    },

    /**
     * Adds a document if it is not in store
     *
     * @override
     * @param { Shopware.apps.Order.model.Receipt } injectedDocument
     */
    add: function(injectedDocument) {
        var me = this,
            document = me.getDocumentById(injectedDocument.get('id'));

        if (document) {
            return;
        }

        me.lastDocumentId = injectedDocument.get('id');
        me.callParent(arguments);
    },

    /**
     * Returns the last added document
     *
     * @returns { Shopware.apps.Order.model.Receipt|null }
     */
    getLastDocument: function() {
        var me = this;

        return this.getDocumentById(me.lastDocumentId);
    },

    /**
     * Tries to find a Shopware.apps.Order.model.Receipt by id
     *
     * @param { number } documentId
     * @returns { Shopware.apps.Order.model.Receipt|null }
     */
    getDocumentById: function(documentId) {
        return this.getById(documentId)
    },

    /**
     * Returns all active Shopware.apps.Order.model.Receipt in a Array
     *
     * @returns { Shopware.apps.Order.model.Receipt[] }
     */
    getActiveDocuments: function() {
        var me = this,
            activeDocuments = [];

        me.each(function(document) {
            if (document.get('active')) {
                activeDocuments.push(document);
            }
        });

        return activeDocuments;
    },

    /**
     * Overwritten to set the last documentId to default value
     *
     * @override
     */
    removeAll: function() {
        var me = this;

        me.callParent(arguments);
        me.lastDocumentId = 0;
    },

    /**
     * Overwritten to set the last documentId to default value
     *
     * @override
     */
    removeAt: function(index) {
        var me = this,
            record = me.getAt(index);

        if (record && record.get('id') == me.lastDocumentId) {
            me.lastDocumentId = 0;
        }

        me.callParent(arguments);
    },

    /**
     * Overwritten to set the last documentId to default value
     *
     * @override
     * @param records
     */
    remove: function(records) {
        var me = this;

        me.callParent(arguments);

        if (!Ext.isArray(records)) {
            if (records.get('id') == me.lastDocumentId) {
                me.lastDocumentId = 0;
                return;
            }
        }

        records.each(function(record) {
            if (record.get('id') == me.lastDocumentId) {
                me.lastDocumentId = 0;
                return false;
            }
        });
    },

    /**
     * Resets all documents to active = false
     */
    resetDocuments: function() {
        var me = this;

        me.each(function(record) {
            record.set('active', false);
        });
    }
});
//<?php }} ?>