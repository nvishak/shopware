<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:43
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.GridView.js" */ ?>
<?php /*%%SmartyHeaderCode:145365acd97e38abbe4-18801255%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5e12ca3c3d92448cc3b1b0de33d2ff61abf8746' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.GridView.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145365acd97e38abbe4-18801255',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e38efba9_08998517',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e38efba9_08998517')) {function content_5acd97e38efba9_08998517($_smarty_tpl) {?>/**
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
 * @category    Shopware
 * @package     Base
 * @subpackage  Attribute
 * @version     $Id$
 * @author      shopware AG
 */

//

Ext.define('Shopware.form.field.GridView', {
    extend: 'Shopware.form.field.Grid',
    alias: 'widget.shopware-form-field-grid-view',

    createItems: function() {
        var me = this, items = [];
        me.grid = me.createGrid();
        me.toolbar = me.createToolbar();

        items.push(me.toolbar);
        items.push(me.grid);

        if (me.supportText) {
            items.push(me.createSupportText(me.supportText));
        }
        return items;
    },

    createSupportText: function(supportText) {
        return Ext.create('Ext.Component', {
            html: '<div>'+supportText+'</div>',
            cls: Ext.baseCSSPrefix +'form-support-text'
        });
    },

    createToolbar: function() {
        var me = this;

        return Ext.create('Ext.toolbar.Toolbar', {
            items: me.createToolbarItems(),
            ui: 'shopware-ui',
            dock: 'top'
        });
    },

    createToolbarItems: function() {
        var me = this;
        me.searchField = me.createSearchField();
        me.deleteButton = me.createDeleteButton();
        return [me.deleteButton, me.searchField]
    },

    createDeleteButton: function() {
        var me = this;
        return Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'grid/view/delete','namespace'=>'backend/attributes/fields')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'grid/view/delete','namespace'=>'backend/attributes/fields'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete selected items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'grid/view/delete','namespace'=>'backend/attributes/fields'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            disabled: true,
            iconCls: 'sprite-minus-circle-frame',
            handler: function () {
                me.onDeleteItems()
            }
        });
    },

    createGrid: function() {
        var me = this;
        return Ext.create('Ext.view.View', {
            store: me.store,
            itemSelector: '.item',
            flex: 1,
            multiSelect: true,
            height: 196,
            cls: 'form-field-grid-view',
            padding: 10,
            autoScroll: true,
            tpl: me.createTemplate(),
            listeners: {
                selectionchange: me.onSelectItem,
                scope: me
            }
        });
    },

    createTemplate: function() {
        var me = this;

        return new Ext.XTemplate(
            '<tpl for=".">',
                '<div class="item">' +
                    me.createItemTemplate() +
                '</div>' +
            '</tpl>'
        );
    },

    createItemTemplate: function() {
        return '<span>{label}</span>';
    },

    onDeleteItems: function() {
        var me = this;
        var selModel = me.grid.getSelectionModel();
        Ext.each(selModel.getSelection(), function(record) {
            me.removeItem(record);
        });
    },

    onSelectItem: function(view, records) {
        var me = this;

        if (records.length > 0) {
            me.deleteButton.enable();
        } else {
            me.deleteButton.disable()
        }
    }
});<?php }} ?>