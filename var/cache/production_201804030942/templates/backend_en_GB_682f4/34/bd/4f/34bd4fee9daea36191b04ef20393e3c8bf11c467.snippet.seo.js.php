<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\category\seo.js" */ ?>
<?php /*%%SmartyHeaderCode:114455acda8f33cf0e3-75560728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34bd4fee9daea36191b04ef20393e3c8bf11c467' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\category\\seo.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114455acda8f33cf0e3-75560728',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f3429b00_04923697',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f3429b00_04923697')) {function content_5acda8f3429b00_04923697($_smarty_tpl) {?>/**
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
 * @package    Article
 * @subpackage List
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Article detail page - Category
 * The category list component contains the grid panel for the category listing which display all already assigned categories.
 * Each row have an action column to remove the category.
 */
//
//
Ext.define('Shopware.apps.Article.view.category.Seo', {
    extend:'Ext.grid.Panel',

    alias:'widget.article-category-seo-list',

    cls: Ext.baseCSSPrefix + 'category-seo-list',

    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'seo_category'/'list'/'title','default'=>'Seo categories of the product','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'title','default'=>'Seo categories of the product','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Seo categories of the product<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'title','default'=>'Seo categories of the product','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    initComponent: function() {
        var me = this;

        me.shopStore = Ext.create('Shopware.apps.Base.store.Shop');
        me.shopStore.clearFilter();
        me.shopStore.load();

        me.columns = me.createColumns();

        me.rowEditor = Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToEdit: 1,
            listeners: {
                validateedit: function(editor, e) {
                    var record = Ext.create('Shopware.apps.Article.model.SeoCategory', e.newValues);
                    if (!me.isSeoCategoryValid(record)) {
                        e.cancel = true;
                    }
                },
                canceledit: function(editor, e) {
                    if (!me.isSeoCategoryValid(e.record)) {
                        me.getStore().remove(e.record);
                    }
                }
            }
        });

        me.plugins = [me.rowEditor];

        me.dockedItems = [ me.createToolbar() ];

        me.callParent(arguments);
    },

    isSeoCategoryValid: function(record) {
        if (record.get('shopId') <= 0) {
            return false;
        }

        if (record.get('categoryId') <= 0) {
            return false;
        }

        return true;
    },

    createColumns: function() {
        var me = this;

        return [{
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'seo_category'/'list'/'shop','default'=>'Shop','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'shop','default'=>'Shop','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shop<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'shop','default'=>'Shop','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'shopId',
            editor: me.createShopEditor(),
            renderer: me.shopRenderer,
            flex: 1
        }, {
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'seo_category'/'list'/'category','default'=>'Category','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'category','default'=>'Category','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Category<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'category','default'=>'Category','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'categoryId',
            editor: me.createCategoryEditor(),
            renderer: me.categoryRenderer,
            flex: 1
        }, {
            xtype: 'actioncolumn',
            width: 30,
            items: [
                {
                    iconCls: 'sprite-minus-circle-frame',
                    handler: function (view, rowIndex, colIndex, item, event, record) {
                        me.store.remove(record);
                    }
                }
            ]
        }];
    },


    categoryRenderer: function(value, meta, record) {
        var me = this;

        var category = me.categoryStore.getById(value);

        if (category) {
            return category.get('name');
        } else {
            return value;
        }
    },

    shopRenderer: function(value, meta, record) {
        var me = this;

        var shop = me.shopStore.getById(value);

        if (shop) {
            return shop.get('name');
        } else {
            return value;
        }
    },

    createShopEditor: function() {
        var me = this;

        me.shopEditor = Ext.create('Ext.form.field.ComboBox', {
            store: me.shopStore,
            displayField: 'name',
            valueField: 'id',
            listeners: {
                beforeselect: function(combo, record) {
                    var valid = true;

                    me.store.each(function(shop) {
                        if (shop.get('shopId') == record.get('id')) {
                            valid = false;
                        }
                    });

                    return valid;
                }
            }
        });

        return me.shopEditor;
    },

    setCategoryStore: function(categoryStore) {
        var me = this;

        me.categoryStore = categoryStore;

        me.categoryEditor.bindStore(categoryStore);

    },

    createCategoryEditor: function() {
        var me = this;

        me.categoryEditor = Ext.create('Ext.form.field.ComboBox', {
            displayField: 'name',
            valueField: 'id',
            queryMode: 'local'
        });

        return me.categoryEditor;
    },

    createToolbar: function() {
        var me = this;

        return Ext.create('Ext.toolbar.Toolbar', {
            dock: 'top',
            items: me.createToolbarItems()
        });
    },

    createToolbarItems: function() {
        var me = this;

        me.addButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'seo_category'/'list'/'create','default'=>'Add','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'create','default'=>'Add','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'seo_category'/'list'/'create','default'=>'Add','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            iconCls: 'sprite-plus-circle-frame',
            handler: function() {
                if (me.store.getCount() >= me.shopStore.getCount()) {
                    return;
                }

                var record = Ext.create('Shopware.apps.Article.model.SeoCategory');

                me.store.add(record);
                me.rowEditor.startEdit(record, 0);
            }
        });

        return [me.addButton];
    }

});
//

<?php }} ?>