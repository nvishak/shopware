<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\customer_stream\listing.js" */ ?>
<?php /*%%SmartyHeaderCode:93205acda8f41d4239-05739025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e25c0c7b0913f1190b3cc336c3b82c6cd3dccbc1' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\customer_stream\\listing.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93205acda8f41d4239-05739025',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f4245610_73101212',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f4245610_73101212')) {function content_5acda8f4245610_73101212($_smarty_tpl) {?>/**
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
 * @package    Customer
 * @subpackage CustomerStream
 * @version    $Id$
 * @author shopware AG
 */

// 
// 
Ext.define('Shopware.apps.Customer.view.customer_stream.Listing', {
    extend: 'Shopware.grid.Panel',
    alias: 'widget.customer-stream-listing',
    cls: 'stream-listing',

    configure: function() {
        var me = this;

        return {
            pagingbar: false,
            toolbar: true,
            deleteButton: false,
            searchField: false,
            editColumn: false,
            displayProgressOnSingleDelete: false,
            deleteColumn: false,

            columns: {
                name: {
                    flex: 2,
                    renderer: me.nameRenderer
                },
                freezeUp: {
                    flex: 1,
                    renderer: me.freezeUpRenderer
                }
            }
        };
    },

    createAddButton: function() {
        var me = this,
            button = me.callParent(arguments);

        Ext.apply(button, {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'add_stream','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_stream','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_stream','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            margin: 5,
            handler: function() {
                me.fireEvent('add-stream');
            }
        });
        me.addButton = button;
        return button;
    },

    createSelectionModel: function() {
        var me = this;

        me.selModel = Ext.create('Ext.selection.RowModel', {
            mode: 'SINGLE',
            allowDeselect: true
        });
        return me.selModel;
    },

    createPlugins: function() {
        return [{
            ptype: 'grid-attributes',
            table: 's_customer_streams_attributes'
        }];
    },

    createColumns: function() {
        var me = this,
            columns = me.callParent(arguments);

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if (!$_tmp1){?>*/
            return columns;
        /*<?php }?>*/

        columns.push({
            xtype: 'actioncolumn',
            width: 0,
            items: []
        });

        return columns;
    },

    createActionColumnItems: function() {
        var me = this, items = me.callParent(arguments);

        items.push({
            iconCls: 'sprite-minus-circle-frame',
            action: 'deleteStream',
            handler: function (view, rowIndex, colIndex, item, ops, record) {
                me.fireEvent('delete-stream', record);
            },
            getClass: function (value, metadata, record) {
                if (!record.phantom) {
                    /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'delete'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if (!$_tmp2){?>*/
                    return 'x-hidden';
                    /*<?php }?>*/
                    return '';
                }
            }
        });

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if (!$_tmp3){?>*/
            return items;
        /*<?php }?>*/

        items.push({
            iconCls: 'sprite-duplicate-article',
            action: 'duplicateStream',
            handler: function (view, rowIndex, colIndex, item, ops, record) {
                me.fireEvent('save-as-new-stream', record);
            },
            getClass: function (value, metadata, record) {
                if (record.get('static') || record.phantom) {
                    return 'x-hidden';
                }
            }
        });

        items.push({
            iconCls: 'sprite-arrow-circle-315',
            tooltip: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'index_stream','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'index_stream','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Refresh stream customers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'index_stream','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            handler: function (view, rowIndex, colIndex, item, opts, record) {
                var node = me.getView().getNode(record),
                    el = Ext.get(node);
                el.addCls('rotate');

                me.fireEvent('save-stream-selection');

                me.fireEvent('index-stream', record, function () {
                    el.removeCls('rotate');
                    me.fireEvent('reset-progressbar');
                    me.getStore().load({
                        callback: function () {
                            me.fireEvent('restore-stream-selection');
                        }
                    });
                });
            },
            getClass: function (value, metadata, record) {
                if (record.get('freezeUp') || record.get('static') || record.phantom) {
                    return 'x-hidden';
                }
            }
        });

        return items;
    },

    freezeUpRenderer: function(value, meta, record) {
        var lockIcon = 'sprite-lock-unlock', freezeUp = '';

        if (value) {
            freezeUp = Ext.util.Format.date(value);
        }
        if (value || record.get('static')) {
            lockIcon = 'sprite-lock';
        }

        return '<span class="lock-icon ' + lockIcon + '">&nbsp;</span>' + freezeUp;
    },

    nameRenderer: function (value, meta, record) {
        var qtip = '<b>' + record.get('name') + '</b>';
        qtip += ' - ' + record.get('customer_count') + ' <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer(s)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';

        if (record.get('freezeUp')) {
            qtip += '<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'freeze_up_label','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'freeze_up_label','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Until<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'freeze_up_label','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: ' + Ext.util.Format.date(record.get('freezeUp')) + '</p>';
        }

        qtip += '<br><p>' + record.get('description') + '</p>';

        meta.tdAttr = 'data-qtip="' + qtip + '"';

        if (record.get('id') === null) {
            return record.get('name') + ' <span class="stream-name-column"><i style="color: #999;">(<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream/not_saved','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream/not_saved','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not saved<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream/not_saved','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)</i></span>';
        }

        return '<span class="stream-name-column"><b>' + value + '</b> - ' + record.get('customer_count') + ' <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer(s)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>';
    }
});
// 
<?php }} ?>