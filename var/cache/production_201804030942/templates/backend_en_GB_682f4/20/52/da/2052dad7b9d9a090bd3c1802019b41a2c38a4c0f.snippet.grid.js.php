<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\view\backup\grid.js" */ ?>
<?php /*%%SmartyHeaderCode:261135acda8f2914279-87312850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2052dad7b9d9a090bd3c1802019b41a2c38a4c0f' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\view\\backup\\grid.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '261135acda8f2914279-87312850',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f29636c6_81450324',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f29636c6_81450324')) {function content_5acda8f29636c6_81450324($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.ArticleList.view.Backup.Grid', {
    extend: 'Ext.grid.Panel',


    alias: 'widget.multi-edit-backup-grid',

    /**
     * Init the grid
     */
    initComponent: function() {
        var me = this;

        me.bbar = me.getPagingBar();
        me.columns = me.getColumns();

        me.addEvents('deleteBackup', 'restoreBackup');

        me.callParent(arguments);
    },

    /**
     * Returns the columns for the grid
     *
     * @returns Array
     */
    getColumns: function()  {
        var me = this;

        return [{
            width: 120,
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup/date','default'=>'Date','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/date','default'=>'Date','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/date','default'=>'Date','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'date',
            xtype: 'datecolumn',
            format: 'Y-m-d H:i',
            menuDisabled: true,
            sortable: true
        },{
            width: 120,
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup/items','default'=>'Affected products','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/items','default'=>'Affected products','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Affected products<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/items','default'=>'Affected products','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'items',
            menuDisabled: true,
            sortable: true
        },{
            flex: 1,
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup/filter','default'=>'Filter string','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/filter','default'=>'Filter string','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Filtered products<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/filter','default'=>'Filter string','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'filterString',
            menuDisabled: true,
            sortable: false,
            renderer: me.nl2brRenderer
        },{
            flex: 1,
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup/operations','default'=>'Operations applied','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/operations','default'=>'Operations applied','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Former changes<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/operations','default'=>'Operations applied','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'operationString',
            menuDisabled: true,
            sortable: false,
            renderer: me.nl2brRenderer
        }, {
            width: 80,
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup/size','default'=>'Size','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/size','default'=>'Size','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Size<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup/size','default'=>'Size','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'size',
            menuDisabled: true,
            sortable: true,
            renderer: function(value) {
                value = Math.round(value / 1024 / 1024);
                if (value == 0) {
                    value = '< 1';
                }
                return value + ' MB';
            }
        }, {
            /**
             * Special column type which provides
             * clickable icons in each row
             */
            xtype: 'actioncolumn',
            width: 50,
            items: [
                {
                    iconCls: 'sprite-arrow-circle-225-left',
                    tooltip: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'restoreBackup','default'=>'Restore','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoreBackup','default'=>'Restore','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Revert changes<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoreBackup','default'=>'Restore','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function (view, rowIndex, colIndex, item, e) {
                        me.fireEvent('restoreBackup', rowIndex);
                    }
                },
                {
                    iconCls: 'sprite-minus-circle-frame',
                    tooltip: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'deleteBackup','default'=>'Delete backup','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'deleteBackup','default'=>'Delete backup','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete backup<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'deleteBackup','default'=>'Delete backup','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function (view, rowIndex, colIndex, item, e) {
                        me.fireEvent('deleteBackup', rowIndex);
                    }
                }
            ]
        }];

    },

    /**
     * Replaces newline chars with <br>
     *
     * @param value
     * @returns string
     */
    nl2brRenderer: function(value) {
        value = value.replace(' AND ', "\nAND\n");
        value = value.replace(' OR ', "\nOR\n");
        return value.replace(/[\r\n]+/g, "<br>");
    },


    /**
     * Creates pagingbar
     *
     * @return Ext.toolbar.Paging
     */
    getPagingBar: function() {
        var me = this;

        var pagingBar = Ext.create('Ext.toolbar.Paging', {
            store: me.store,
            dock:'bottom',
            displayInfo:true
        });

        return pagingBar;
    }
});
//
<?php }} ?>