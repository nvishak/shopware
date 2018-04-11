<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\view\condition_list\window.js" */ ?>
<?php /*%%SmartyHeaderCode:303925acda8f0d28986-82421746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcde3ffa0ca6fde06d2b6d5ecbf3b5f78b72e312' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\view\\condition_list\\window.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '303925acda8f0d28986-82421746',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f0d5bcc9_20229913',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f0d5bcc9_20229913')) {function content_5acda8f0d5bcc9_20229913($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.ProductStream.view.condition_list.Window', {
    extend: 'Enlight.app.Window',
    alias: 'widget.product-stream-detail-window',
    title : '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail_window_title','default'=>'Product stream details','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail_window_title','default'=>'Product stream details','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product stream details<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail_window_title','default'=>'Product stream details','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
    height: '90%',
    width: '90%',
    layout: 'fit',

    initComponent: function() {
        var me = this;

        me.items = me.createItems();
        me.dockedItems = [me.createToolbar()];

        me.callParent(arguments);
        me.loadRecord(me.record);
    },

    loadRecord: function(record) {
        var me = this;

        me.formPanel.loadRecord(record);
        me.conditionPanel.removeAll();
        me.conditionPanel.loadConditions(record.get('conditions'));

        if (!record.get('id')) {
            return;
        }
        me.conditionPanel.loadPreview(record.get('conditions'));
        me.attributeForm.loadAttribute(record.get('id'));
    },

    createToolbar: function() {
        var me = this;

        me.saveButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'save','default'=>'Save','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'save','default'=>'Save','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'save','default'=>'Save','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'primary',
            handler: function () {
                me.fireEvent('save-condition-stream', me.record);
            }
        });

        me.toolbar = Ext.create('Ext.toolbar.Toolbar', {
            items: ['->', me.saveButton],
            dock: 'bottom'
        });
        return me.toolbar;
    },

    createItems: function() {
        var me = this, container;

        me.previewGrid = Ext.create('Shopware.apps.ProductStream.view.condition_list.PreviewGrid', {
            flex: 1
        });
        me.conditionPanel = Ext.create('Shopware.apps.ProductStream.view.condition_list.ConditionPanel', {
            flex: 1,
            margin: '0 10 0 0'
        });

        container = Ext.create('Ext.container.Container', {
            layout: { type: 'vbox', align: 'stretch'},
            flex: 1,
            padding: 10,
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration_title','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration_title','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Configuration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration_title','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            items: [
                me.createSettingPanel(),
                {
                    xtype: 'container',
                    flex: 1,
                    margin: '10 0 0',
                    layout: { type: 'hbox', align: 'stretch' },
                    items: [
                        me.conditionPanel,
                        me.previewGrid
                    ]
                }
            ]
        });

        me.tabPanel = Ext.create('Ext.tab.Panel', {
            flex: 1,
            items: [container]
        });

        me.formPanel = Ext.create('Ext.form.Panel', {
            layout: 'fit',
            items: [me.tabPanel],
            name: 'product-stream-main-form',
            border: false,
            plugins: [{
                ptype: 'translation',
                translationType: 'productStream'
            }]
        });

        me.attributeForm = Ext.create('Shopware.apps.ProductStream.view.common.Attributes', {
            tabPanel: me.tabPanel,
            translationForm: me.formPanel
        });
        me.tabPanel.add(me.attributeForm);

        return [me.formPanel];
    },

    createSettingPanel: function() {
        this.settingsPanel = Ext.create('Shopware.apps.ProductStream.view.common.Settings');
        return this.settingsPanel;
    }
});
//<?php }} ?>