<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:43
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\account\upload.js" */ ?>
<?php /*%%SmartyHeaderCode:308875acda8ff3e0a59-31375260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40ae1c655ee47abbeabd31e43bca0abf14a7f052' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\account\\upload.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '308875acda8ff3e0a59-31375260',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ff4317a3_65458286',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ff4317a3_65458286')) {function content_5acda8ff4317a3_65458286($_smarty_tpl) {?>/**
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
 * @package    PluginManager
 * @subpackage Account
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.account.Upload', {
    cls: 'plugin-manager-upload-window',

    alias: 'widget.plugin-manager-upload-window',

    extend: 'Ext.window.Window',
    modal: true,

    header: false,

    layout: {
        type: 'vbox',
        align: 'stretch'
    },

    width: 500,
    height: 250,

    initComponent: function() {
        var me = this;

        me.items = me.createItems();

        me.dockedItems = [ me.createToolbar() ];
        me.callParent(arguments);
    },

    createItems: function() {
        var me = this;

        me.fileUpload = Ext.create('Ext.form.field.File', {
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'upload_plugin','default'=>'Upload plugin','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_plugin','default'=>'Upload plugin','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Upload plugin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_plugin','default'=>'Upload plugin','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            name: 'plugin',
            labelWidth: 125,
            flex: 1,
            allowBlank: false,
            margin: '10 0 0',
            buttonConfig: {
                cls: 'primary small',
                text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'upload_select','default'=>'Select','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_select','default'=>'Select','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_select','default'=>'Select','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            },
            listeners: {
                'change': function() {
                    if (me.fileUpload.getValue()) {
                        me.uploadButton.enable();
                    } else {
                        me.uploadButton.disable();
                    }
                }
            }
        });

        me.info = Ext.create('Ext.form.FieldSet', {
            cls : 'info',
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'upload_info_title','default'=>'Tip','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_info_title','default'=>'Tip','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_info_title','default'=>'Tip','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'upload_info_text','default'=>'Here you can upload and install your plugins manually. Please keep in mind that plugins have to be in a ZIP archive and the file size can´t exceed the configured upload size limit.','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_info_text','default'=>'Here you can upload and install your plugins manually. Please keep in mind that plugins have to be in a ZIP archive and the file size can´t exceed the configured upload size limit.','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Here you can upload and install your plugins manually. Please keep in mind that plugins have to be in a ZIP archive and the file size can´t exceed the configured upload size limit.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_info_text','default'=>'Here you can upload and install your plugins manually. Please keep in mind that plugins have to be in a ZIP archive and the file size can´t exceed the configured upload size limit.','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        me.form = Ext.create('Ext.form.Panel', {
            items: [ me.info, me.fileUpload ],
            bodyPadding: 20,
            border: false,
            url: '<?php echo '/shopware4/backend/PluginInstaller/upload';?>',
            flex: 1,
            layout: {
                type: 'vbox',
                align: 'stretch'
            }
        });

        return me.form;
    },

    createToolbar: function() {
        var me = this;

        me.cancelButton = Ext.create('Ext.button.Button', {
            cls: 'secondary',
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            handler: function() {
                me.destroy();
            }
        });

        me.uploadButton = Ext.create('Ext.button.Button', {
            cls: 'primary',
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'upload_plugin','default'=>'Upload plugin','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_plugin','default'=>'Upload plugin','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Upload plugin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'upload_plugin','default'=>'Upload plugin','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            disabled: true,
            handler: function() {
                if (!me.form.getForm().isValid()) {
                    return;
                }

                Shopware.app.Application.fireEvent('upload-plugin', me.form, function(success) {
                    me.destroy();
                    Shopware.app.Application.fireEvent('reload-local-listing');
                });
            }
        });

        return Ext.create('Ext.toolbar.Toolbar', {
            dock: 'bottom',
            items: [me.cancelButton, '->', me.uploadButton ]
        });
    }
});
//<?php }} ?>