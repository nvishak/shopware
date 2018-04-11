<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\view\condition_list\condition_panel.js" */ ?>
<?php /*%%SmartyHeaderCode:196015acda8f0dfaa80-35624020%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b4e80db23aeca9d7e1cdb48442a39e42308c093' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\view\\condition_list\\condition_panel.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196015acda8f0dfaa80-35624020',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f0e5f4f8_05461068',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f0e5f4f8_05461068')) {function content_5acda8f0e5f4f8_05461068($_smarty_tpl) {?>/**
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
 * @subpackage Window
 * @version    $Id$
 * @author shopware AG
 */
//
//
Ext.define('Shopware.apps.ProductStream.view.condition_list.ConditionPanel', {
    extend: 'Ext.form.Panel',
    cls: 'shopware-form',
    alias: 'widget.product-stream-condition-panel',
    autoScroll: true,
    layout: { type: 'vbox', align: 'stretch'},
    bodyPadding: '10 20',
    conditions: [],

    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'conditions','default'=>'Conditions','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'conditions','default'=>'Conditions','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Conditions<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'conditions','default'=>'Conditions','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    initComponent: function() {
        var me = this;

        me.conditions = [];
        me.items = [];
        me.conditionHandlers = me.sort(
            me.createConditionHandlers()
        );
        me.dockedItems = [me.createToolbar()];

        me.callParent(arguments);
    },

    sort: function(handlers) {
        return handlers.sort(function(a, b) {
            return a.getLabel().localeCompare(b.getLabel());
        });
    },

    loadPreview: function(conditions) {
        this.fireEvent('load-preview', conditions);
    },

    validateConditions: function() {
        return this.getForm().isValid();
    },

    getConditions: function() {
        var me = this;

        var values = me.getValues();
        var conditions = { };

        for (var key in values) {
            if (key.indexOf('condition.') == 0) {
                var newKey = key.replace('condition.', '');
                conditions[newKey] = values[key];
            }
        }
        return conditions;
    },

    putItemInContainer: function(item, container) {
        var me = this;

        container.name = item.getName();
        container.add(item);
        me.conditions.push(item.getName());
        me.add(container);
    },

    loadConditions: function(conditions) {
        var me = this;

        for (var key in conditions) {
            var condition = conditions[key];

            Ext.each(me.conditionHandlers, function(handler) {
                var container = me.createConditionContainer(handler);
                var item = handler.load(key, condition, container, conditions);
                if (item) {
                    container.collapsed = true;
                    me.putItemInContainer(item, container);
                }
            });
        }
    },

    createConditionHandlers: function() {
        return [
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Price'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Manufacturer'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Property'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Attribute'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Category'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.ImmediateDelivery'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Closeout'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.HasPseudoPrice'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.IsNew'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.CreateDate'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.ReleaseDate'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.VoteAverage'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Sales'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.SearchTerm'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Height'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Width'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Length'),
            Ext.create('Shopware.apps.ProductStream.view.condition_list.condition.Weight')
        ];
    },

    addCondition: function(conditionHandler) {
        var me = this;

        var container = me.createConditionContainer(conditionHandler);
        conditionHandler.create(function(item) {
            var singleton = conditionHandler.isSingleton();
            var name = item.getName();


            if (singleton && me.conditions.indexOf(name) > -1) {
                Shopware.Notification.createGrowlMessage(
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'singleton_filter_title','default'=>'Unique filter','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'singleton_filter_title','default'=>'Unique filter','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Unique filter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'singleton_filter_title','default'=>'Unique filter','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'singleton_filter_description','default'=>'Each filter type can only be added once','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'singleton_filter_description','default'=>'Each filter type can only be added once','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Each filter type can only be added once<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'singleton_filter_description','default'=>'Each filter type can only be added once','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                );
                return;
            }

            me.putItemInContainer(item, container);

        }, container, me.conditions);
    },

    createConditionContainer: function(conditionHandler) {
        var me = this;

        return Ext.create('Ext.panel.Panel', {
            title: conditionHandler.getLabel(),
            items: [],
            collapsible: true,
            closable: true,
            bodyPadding: 5,
            margin: '0 0 5',
            fixToggleTool: function() {
                this.addTool(Ext.widget({
                    xtype: 'tool',
                    type: (this.collapsed && !this.isPlaceHolderCollapse()) ? ('expand-' + this.getOppositeDirection(this.collapseDirection)) : ('collapse-' + this.collapseDirection),
                    handler: this.toggleCollapse,
                    scope: this
                }));
            },
            listeners: {
                close: function() {
                    var index = me.conditions.indexOf(this.name);
                    delete me.conditions[index];
                }
            },
            layout: { type: 'vbox', align: 'stretch' }
        });
    },

    createToolbar: function() {
        var me = this;

        me.toolbar = Ext.create('Ext.toolbar.Toolbar', {
            items: me.createToolbarItems(),
            style: 'border: 1px solid #9aacb8;',
            ui: 'shopware-ui'
        });
        return me.toolbar;
    },

    createToolbarItems: function() {
        var me = this,
            items = [];

        items.push(me.createAddButton());
        items.push('->');
        items.push(me.createPreviewButton());
        return items;
    },

    createAddButton: function() {
        var me = this;

        me.addButton =Ext.create('Ext.button.Split', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'add_condition','default'=>'Add condition','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_condition','default'=>'Add condition','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add condition<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_condition','default'=>'Add condition','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            iconCls: 'sprite-plus-circle-frame',
            menu: me.createMenu()
        });
        return me.addButton;
    },

    createPreviewButton: function() {
        var me = this;

        me.previewButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'refresh_preview','default'=>'Refresh preview','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'refresh_preview','default'=>'Refresh preview','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Refresh preview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'refresh_preview','default'=>'Refresh preview','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            iconCls: 'sprite-arrow-circle-225-left',
            handler: function() {
                me.loadPreview();
            }
        });
        return me.previewButton;
    },

    createMenu: function() {
        var me = this, items = [];

        Ext.each(me.conditionHandlers, function(handler) {
            items.push({
                text: handler.getLabel(),
                conditionHandler: handler,
                handler: function() {
                    me.addCondition(this.conditionHandler);
                }
            });
        });

        return new Ext.menu.Menu({ items: items });
    }
});
//<?php }} ?>