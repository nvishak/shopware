<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\controller\main.js" */ ?>
<?php /*%%SmartyHeaderCode:12505acda8f30301f9-41137936%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd7467b97d79d37ba0241f39253d0665ffd1b50c2' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\controller\\main.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12505acda8f30301f9-41137936',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f313de02_71821781',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f313de02_71821781')) {function content_5acda8f313de02_71821781($_smarty_tpl) {?>/**
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
 * @package    ProductStream
 * @subpackage Controller
 * @version    $Id$
 * @author shopware AG
 */
//
//
Ext.define('Shopware.apps.ProductStream.controller.Main', {
    extend: 'Enlight.app.Controller',

    refs: [
        { ref: 'conditionPanel', selector: 'product-stream-condition-panel' },
        { ref: 'previewGrid', selector: 'product-stream-preview-grid' },
        { ref: 'settingsPanel', selector: 'product-stream-settings' },
        { ref: 'formPanel', selector: 'form[name=product-stream-main-form]' },
        { ref: 'shopCombo', selector: 'product-stream-preview-grid combo[name=shop]' },
        { ref: 'currencyCombo', selector: 'product-stream-preview-grid combo[name=currency]' },
        { ref: 'customerGroupCombo', selector: 'product-stream-preview-grid combo[name=customerGroup]' },
        { ref: 'productStreamGrid', selector: 'product-stream-listing-grid' },
        { ref: 'productStreamDetailGrid', selector: 'product-stream-selected-list-grid' },
        { ref: 'attributeForm', selector: 'stream-attribute-form' }
    ],

    init: function() {
        var me = this;

        me.control({
            'product-stream-selected-list-window': {
                'save-selection-stream': me.saveSelectionStream
            },
            'product-stream-condition-panel': {
                'load-preview': me.loadPreview
            },
            'product-stream-preview-grid': {
                'load-preview': me.loadPreview
            },
            'product-stream-detail-window': {
                'save-condition-stream': me.saveConditionStream
            },
            'product-stream-listing-grid': {
                'open-selected-list-window': me.openSelectedListWindow,
                'stream-delete-item': me.onDeleteItem,
                'stream-duplicate-item': me.onDuplicateItem
            }
        });

        me.mainWindow = me.getView('list.Window').create({ }).show();
    },

    onDeleteItem: function(grid, record) {
        var message = Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'dialog_delete_stream_message','default'=>'Do you really want to delete "[0]"?','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'dialog_delete_stream_message','default'=>'Do you really want to delete "[0]"?','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Do you really want to delete "[0]"?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'dialog_delete_stream_message','default'=>'Do you really want to delete "[0]"?','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', record.get('name'));
        Ext.MessageBox.confirm('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'dialog_delete_stream_title','default'=>'Delete Prdoduct Stream','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'dialog_delete_stream_title','default'=>'Delete Prdoduct Stream','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete product stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'dialog_delete_stream_title','default'=>'Delete Prdoduct Stream','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', message, function (response) {
            if (response !== 'yes') {
                return false;
            }

            record.destroy({
                callback: function() {
                    grid.getStore().load();
                }
            });

        });

        return false;
    },

    saveConditionStream: function(record) {
        var me = this;
        var conditionPanel = me.getConditionPanel();
        var formPanel = me.getFormPanel();

        var valid = (
            conditionPanel.getForm().isValid() == true
            && formPanel.getForm().isValid() == true
        );

        if (!valid) {
            return;
        }

        formPanel.getForm().updateRecord(record);
        record.set('sorting', me.getSorting());
        record.set('conditions', me.getConditions());

        me.saveConditionStreamRecord(record);
    },

    saveConditionStreamRecord: function(record) {
        var me = this;
        record.save({
            callback: function() {
                var productGrid = me.getProductStreamGrid(),
                        store = productGrid.store;

                me.saveAttributes(record);

                store.reload({
                    callback: function() {
                        productGrid.reconfigure(store);
                    }
                });
                Shopware.Notification.createGrowlMessage(
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stream saved<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                );
            }
        });
    },

    saveAttributes: function(record) {
        var me = this;
        var attributeForm = me.getAttributeForm();
        attributeForm.saveAttribute(record.get('id'), function() {
            attributeForm.loadAttribute(record.get('id'));
        });
    },

    saveSelectionStream: function(record) {
        var me = this;

        var settingsPanel = me.getFormPanel();

        if (!settingsPanel.getForm().isValid()) {
            return;
        }

        settingsPanel.getForm().updateRecord(record);
        record.set('sorting', me.getSorting());
        record.set('conditions', null);
        this.saveSelectionStreamRecord(record);
    },

    saveSelectionStreamRecord: function(record) {
        var me = this;
        record.save({
            callback: function() {
                var productGrid = me.getProductStreamGrid(),
                    listStore = productGrid.store,
                    detailGrid = me.getProductStreamDetailGrid();

                detailGrid.streamId = record.get('id');
                me.saveAttributes(record);

                listStore.reload({
                    callback: function() {
                        productGrid.reconfigure(listStore);
                    }
                });
                Shopware.Notification.createGrowlMessage(
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stream saved<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                );
            }
        });
    },

    getConditions: function() {
        var me = this;
        var conditionPanel = me.getConditionPanel();
        var values = conditionPanel.getValues();

        var conditions = { };

        for (var key in values) {
            if (key.indexOf('condition.') == 0) {
                var newKey = key.replace('condition.', '');
                conditions[newKey] = values[key];
            }
        }

        return conditions;
    },

    openSelectedListWindow: function(record) {
        var me = this;
        me.getView('selected_list.Window').create({ record: record }).show();
    },

    loadPreview: function(conditions) {
        var me = this;

        var conditionPanel = me.getConditionPanel();
        var previewGrid = me.getPreviewGrid();
        var shopCombo = me.getShopCombo();
        var currencyCombo = me.getCurrencyCombo();
        var customerGroupCombo = me.getCustomerGroupCombo();

        if (!conditions || Object.getOwnPropertyNames(conditions).length === 0) {
            if (!conditionPanel.validateConditions()) {
                return;
            }
            conditions = me.getConditions();
        }

        var sort = me.getSorting();

        previewGrid.getStore().getProxy().extraParams = {
            sort: sort,
            conditions: Ext.JSON.encode(conditions),
            shopId: shopCombo.getValue(),
            currencyId: currencyCombo.getValue(),
            customerGroupKey: customerGroupCombo.getValue()
        };

        previewGrid.getStore().load();
    },

    getSorting: function() {
        var me = this,
            sort,
            record,
            settingsPanel = this.getSettingsPanel();

        sort = settingsPanel.sortingCombo.store.getById(
            settingsPanel.sortingCombo.getValue()
        );

        if (sort) {
            return sort.get('sortings');
        }

        record = me.getFormPanel().getForm().getRecord();

        if (record && record.get('sorting').length) {
            return record.get('sorting');
        }

        return {};
    },

    onDuplicateItem: function(grid, record) {
        var showNotificationAndRefresh = function() {
            Shopware.Notification.createGrowlMessage(
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_title','default'=>'Product stream','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stream saved<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved_description','default'=>'Stream saved','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            );
            grid.getStore().load();
        };

        Ext.MessageBox.prompt(
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_duplicate_title','default'=>'Duplicate Product Stream','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_duplicate_title','default'=>'Duplicate Product Stream','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Duplicate product stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_duplicate_title','default'=>'Duplicate Product Stream','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_duplicate_prompt','default'=>'New name','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_duplicate_prompt','default'=>'New name','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
New name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_duplicate_prompt','default'=>'New name','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:',
            function (result, value) {
                if (result !== "ok" || !value) {
                    return;
                }

                value = Ext.String.trim(value);

                if (value.length === 0) {
                    return;
                }

                var duplicatedRecord = JSON.parse(JSON.stringify(record.data));
                duplicatedRecord.name = value;
                duplicatedRecord.conditions = JSON.parse(duplicatedRecord.conditions);
                duplicatedRecord.sorting = JSON.parse(duplicatedRecord.sorting);
                delete duplicatedRecord.id;

                duplicatedRecord = Ext.create('Shopware.apps.ProductStream.model.Stream', duplicatedRecord);
                duplicatedRecord.save({
                    success: function (newRecord) {
                        if (newRecord.get('type') == 2) {
                            Ext.Ajax.request({
                                url: '<?php echo '/shopware4/backend/ProductStream/copySelectedProducts';?>',
                                params: {
                                    sourceStreamId: record.get('id'),
                                    targetStreamId: newRecord.get('id')
                                },
                                success: function() {
                                    showNotificationAndRefresh();
                                }
                            });
                        } else {
                            showNotificationAndRefresh();
                        }

                        Ext.Ajax.request({
                            url: '<?php echo '/shopware4/backend/ProductStream/copyStreamAttributes';?>',
                            params: {
                                sourceStreamId: record.get('id'),
                                targetStreamId: newRecord.get('id')
                            }
                        });

                    }
                });
            }, this, false, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_duplicate_copy','default'=>'Copy of ','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_duplicate_copy','default'=>'Copy of ','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Copy of <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_duplicate_copy','default'=>'Copy of ','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' + record.get('name'));
    }
});
//<?php }} ?>