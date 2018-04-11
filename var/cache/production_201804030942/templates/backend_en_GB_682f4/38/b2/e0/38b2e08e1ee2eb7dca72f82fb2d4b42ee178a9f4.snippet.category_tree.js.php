<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\view\main\category_tree.js" */ ?>
<?php /*%%SmartyHeaderCode:304165acda8f1d01004-71011573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38b2e08e1ee2eb7dca72f82fb2d4b42ee178a9f4' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\view\\main\\category_tree.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '304165acda8f1d01004-71011573',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f1d35f86_71298741',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f1d35f86_71298741')) {function content_5acda8f1d35f86_71298741($_smarty_tpl) {?>/**
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
 */

//
//
Ext.define('Shopware.apps.ArticleList.view.main.CategoryTree', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.multi-edit-category-tree',
    layout: 'fit',
    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'categories','default'=>'Categories','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'categories','default'=>'Categories','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Categories<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'categories','default'=>'Categories','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    initComponent: function () {
        var me = this;

        me.items = me.getPanels();

        me.addEvents(
            'filterByCategory',
            'showVariants'
        );

        me.callParent(arguments);
    },

    /**
     * Returns the tree panel with and a toolbar
     */
    getPanels: function () {
        var me = this;

        me.treePanel = Ext.create('Ext.panel.Panel', {
            border: false,
            layout: {
                type: 'vbox',
                pack: 'start',
                align: 'stretch'
            },
            items: [
                me.getToolbar(),
                me.createTree()
            ]
        });

        return [me.treePanel];
    },

    /**
     * Creates the toolbar with the "show variants" checkbox
     *
     * @returns Ext.toolbar.Toolbar
     */
    getToolbar: function () {
        var me = this;

        return Ext.create('Ext.toolbar.Toolbar', {
            ui: 'shopware-ui',
            items: [
                {
                    xtype: 'checkbox',
                    boxLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list'/'Variants','default'=>'Show variants','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'Variants','default'=>'Show variants','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Show variants<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'Variants','default'=>'Show variants','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    name: 'displayVariants',
                    uncheckedValue: false,
                    inputValue: true,
                    listeners: {
                        'change': function (field, newValue) {
                            var tree = me.up().down('treepanel'),
                                    selection = tree.getSelectionModel(),
                                    categoryId;

                            if (selection.selected.items.length <= 0) {
                                categoryId = 0;
                            } else {
                                categoryId = selection.selected.items[0].get('id');
                            }

                            me.fireEvent('showVariants', newValue);
                            me.fireEvent('filterByCategory', categoryId, newValue);
                        }
                    }
                }
            ]
        });


    },

    /**
     * Creates the category tree
     *
     * @return [Ext.tree.Panel]
     */
    createTree: function () {
        var me = this,
                tree;

        me.categoryStore = Ext.create('Shopware.store.CategoryTree');

        tree = Ext.create('Ext.tree.Panel', {
            border: false,
            rootVisible: true,
            expanded: true,
            useArrows: false,
            layout: 'fit',
            flex: 1,
            store: me.categoryStore,
            root: {
                text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'categories','default'=>'Categories','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'categories','default'=>'Categories','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Categories<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'categories','default'=>'Categories','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                expanded: true
            },
            listeners: {
                itemclick: {
                    fn: function (view, record) {
                        var me = this,
                                showVariants,
                                categoryId = record.get('id') === 'root' ? 0 : record.get('id');

                        showVariants = me.up().down('checkbox').getValue();

                        me.fireEvent('filterByCategory', categoryId, showVariants);
                    }
                },
                scope: me
            }
        });

        return tree;
    }

});
//
<?php }} ?>