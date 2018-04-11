<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:34
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\esd\serials.js" */ ?>
<?php /*%%SmartyHeaderCode:138595acda8f6d4ddb1-62960914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15a8114b1d910a45f78eecf4af649dac7bf6f589' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\esd\\serials.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138595acda8f6d4ddb1-62960914',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f6e1f062_26300566',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f6e1f062_26300566')) {function content_5acda8f6e1f062_26300566($_smarty_tpl) {?>/**
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
 * @subpackage Esd
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Article ESD serials page
 */
//
//
Ext.define('Shopware.apps.Article.view.esd.Serials', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-esd-serials',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-esd-serials',

    /**
     * The view needs to be scrollable
     * @string
     */
    autoScroll: true,

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        title:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'title','default'=>'Serialnumber Administration','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'title','default'=>'Serialnumber Administration','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Serial number administration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'title','default'=>'Serialnumber Administration','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        columns:{
            serial:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'column'/'serial','default'=>'Serialnumber','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'serial','default'=>'Serialnumber','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Serial number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'serial','default'=>'Serialnumber','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            assignedCustomer:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'column'/'assigned_customer','default'=>'Assigned Customer','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'assigned_customer','default'=>'Assigned Customer','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigned customer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'assigned_customer','default'=>'Assigned Customer','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            assignedDate:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serialsals'/'column'/'assigned_date','default'=>'Assigned at','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serialsals'/'column'/'assigned_date','default'=>'Assigned at','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigned to<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serialsals'/'column'/'assigned_date','default'=>'Assigned at','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

            remove: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'column'/'remove','default'=>'Delete serial','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'remove','default'=>'Delete serial','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete serial<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'remove','default'=>'Delete serial','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            openCustomer: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'column'/'open_customer','default'=>'Open Customer','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'open_customer','default'=>'Open Customer','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Open customer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'open_customer','default'=>'Open Customer','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            guest: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'column'/'guest','default'=>'Guest','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'guest','default'=>'Guest','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Guest<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'column'/'guest','default'=>'Guest','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        toolbar:{
            add:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'toolbar'/'button_add','default'=>'Add Serials','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'button_add','default'=>'Add Serials','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add serials<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'button_add','default'=>'Add Serials','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            remove:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'toolbar'/'button_delete','default'=>'Delete selected','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'button_delete','default'=>'Delete selected','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete selected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'button_delete','default'=>'Delete selected','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            search:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Search...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            removeUnused: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'serials'/'toolbar'/'button_delete_unused','default'=>'Delete not assigned Serials','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'button_delete_unused','default'=>'Delete not assigned Serials','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete not assigned serials<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'serials'/'toolbar'/'button_delete_unused','default'=>'Delete not assigned Serials','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Initialize the Shopware.apps.Article.view.esd.Serials and defines the necessary default configuration
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.registerEvents();

        me.title = me.snippets.title;

        me.selModel = me.getGridSelectionModel();

        me.columns = me.getColumns();
        me.toolbar = me.getToolbar();
        me.pagingbar = me.getPagingBar();

        me.dockedItems = [ me.toolbar, me.pagingbar ];

        me.callParent(arguments);
    },

    /**
     * Defines additional events which will be fired from the component
     *
     * @return void
     */
    registerEvents:function () {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the delete button
             * in the toolbar or the action column of the grid
             * @event deleteSerials
             * @param [array] Records - The selected records
             */
            'deleteSerials',

            /**
             * @event addSerials
             */
            'addSerials',

            /**
             * @event deleteUnusedSerials
             */
            'deleteUnusedSerials',

            /**
             * @event searchSerials
             */
            'searchSerials',

            /**
             * @event openCustomer
             * @param [Ext.data.Model] Record - The selected record
             */
            'openCustomer'
        );
    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns: function() {
        var me = this;

        return [
            {
                header: me.snippets.columns.serial,
                dataIndex: 'serialnumber',
                flex: 2
            },
            {
                header: me.snippets.columns.assignedCustomer,
                flex: 2,
                renderer: me.assignedCustomerColumnRenderer
            },
            {
                header: me.snippets.columns.assignedDate,
                xtype: 'datecolumn',
                dataIndex: 'date',
                flex: 1
            },
            {
                /**
                 * Special column type which provides clickable icons in each row
                 */
                xtype: 'actioncolumn',
                width: 70,
                items:[
                    {
                        iconCls: 'sprite-minus-circle-frame',
                        action: 'deleteSerial',
                        tooltip: me.snippets.columns.remove,
                        handler: function (view, rowIndex, colIndex, item, opts, record) {
                            var serials = [ record ];
                            me.fireEvent('deleteSerials', serials);
                        }
                    },
                    {
                        iconCls: 'sprite-user--arrow',
                        action: 'openCustomer',
                        tooltip:  me.snippets.columns.openCustomer,
                        handler: function (view, rowIndex, colIndex, item, opts, record) {
                            me.fireEvent('openCustomer', record);
                        },
                        getClass: function(value, metadata, record) {
                            if (!record.get('customerId')) {
                                return 'x-hidden';
                            }

                            if (record.get('accountMode') !== 0) {
                                return 'x-hidden';
                            }

                        }
                    }
                ]
            }
        ];
    },

    /**
     * Creates the grid selection model for checkboxes
     *
     * @return [Ext.selection.CheckboxModel] grid selection model
     */
    getGridSelectionModel: function() {
        var me = this;

        return Ext.create('Ext.selection.CheckboxModel', {
            listeners:{
                // Unlocks the delete button if the user has checked at least one checkbox
                selectionchange: function(sm, selections) {
                    me.deleteButton.setDisabled(selections.length === 0);
                }
            }
        });
    },

    /**
     * Creates the grid toolbar with the different buttons.
     * @return [Ext.toolbar.Toolbar] grid toolbar
     */
    getToolbar: function() {
        var me = this;

        me.deleteButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-minus-circle-frame',
            text: me.snippets.toolbar.remove,
            disabled: true,
            action: 'deleteSerials',
            handler: function() {
                var selectionModel = me.getSelectionModel(),
                    records = selectionModel.getSelection();

                if (records.length > 0) {
                    me.fireEvent('deleteSerials', records);
                }
            }
        });

        me.searchField = Ext.create('Ext.form.field.Text', {
            name: 'searchfield',
            cls: 'searchfield',
            width: 170,
            emptyText: me.snippets.toolbar.search,
            enableKeyEvents:true,
            checkChangeBuffer: 500,
            listeners: {
                change: function(field, value) {
                    me.fireEvent('searchSerials', value);
                }
            }
        });

        return {
            xtype: 'toolbar',
            dock: 'top',
            items: [
                {
                    xtype: 'button',
                    text: me.snippets.toolbar.add,
                    iconCls:'sprite-plus-circle-frame',
                    handler: function() {
                        me.fireEvent('addSerials');
                    }
                },
                me.deleteButton,
                { xtype: 'tbseparator' },
                {
                    xtype: 'button',
                    iconCls: 'sprite-minus-circle-frame',
                    text: me.snippets.toolbar.removeUnused,
                    handler: function() {
                        me.fireEvent('deleteUnusedSerials');
                    }
                },
                { xtype: 'tbfill' },
                me.searchField,
                { xtype: 'tbspacer' }
            ]
        };
    },

    /**
     * Creates the paging toolbar for the grid to allow store paging. The paging toolbar uses the same store as the Grid
     *
     * @return [Ext.toolbar.Paging] The paging toolbar for the serials grid
     */
    getPagingBar: function() {
        var me = this;

        return {
            store: me.store,
            xtype: 'pagingtoolbar',
            displayInfo: true,
            dock: 'bottom'
        };
    },

    /**
     * Formats the customer column
     *
     * @param [string] value - Name of the disptach
     * @param [object] metaData - Meta data for this column
     * @param [object] record - current record
     */
    assignedCustomerColumnRenderer: function(value, metaData, record) {
        var me = this;

        if (!record.get('customerId')) {
            return '';
        }

        if (record.get('accountMode') === 0) {
            return record.get('customerEmail');
        } else {
            return Ext.String.format('{0} ({1})</b>', record.get('customerEmail'), me.snippets.guest);
        }
    }
});
//

<?php }} ?>