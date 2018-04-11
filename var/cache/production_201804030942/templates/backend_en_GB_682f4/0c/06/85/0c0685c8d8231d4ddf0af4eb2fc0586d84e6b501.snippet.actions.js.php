<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:42
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\detail\actions.js" */ ?>
<?php /*%%SmartyHeaderCode:220855acda8febdb3b9-44623391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c0685c8d8231d4ddf0af4eb2fc0586d84e6b501' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\detail\\actions.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '220855acda8febdb3b9-44623391',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fec34ae9_91995443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fec34ae9_91995443')) {function content_5acda8fec34ae9_91995443($_smarty_tpl) {?>/**
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
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.detail.Actions', {

    extend: 'Ext.container.Container',

    cls: 'plugin-meta-data-container-actions',

    defaults: {
        minWidth: 270,
        margin: '15 10 0'
    },

    layout: 'vbox',

    margin: '10 0',

    padding: '0 0 10',

    mixins: {
        events: 'Shopware.apps.PluginManager.view.PluginHelper'
    },

    initComponent: function() {
        var me = this,
            items = [],
            button;

        if (me.plugin.allowUpdate()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'install_update','default'=>'Install update','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install_update','default'=>'Install update','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Install update<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install_update','default'=>'Install update','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 (v ' + me.plugin.get('availableVersion') + ')',
                cls: 'plugin-manager-action-button primary',
                handler: function() {
                    me.updatePluginEvent(me.plugin);
                }
            });
            items.push(button);
        }

        if (me.plugin.allowDummyUpdate()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Install<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                cls: 'plugin-manager-action-button primary',
                handler: function() {
                    me.updateDummyPluginEvent(me.plugin);
                }
            });
            items.push(button);
        }

        if (me.plugin.allowInstall()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Install<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                cls: 'plugin-manager-action-button primary',
                handler: function() {
                    me.installPluginEvent(me.plugin);
                }
            });
            items.push(button);
        }

        if (me.plugin.allowActivate()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'activate','default'=>'Activate','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'activate','default'=>'Activate','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Activate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'activate','default'=>'Activate','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                cls: 'plugin-manager-action-button primary',
                handler: function() {
                    me.activatePluginEvent(me.plugin);
                }
            });

            items.push(button);
        }

        if (me.plugin.allowReinstall()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'reinstall','default'=>'Reinstall','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'reinstall','default'=>'Reinstall','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Reinstall<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'reinstall','default'=>'Reinstall','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                cls: 'plugin-manager-action-button',
                handler: function() {
                    me.reinstallPluginEvent(me.plugin);
                }
            });
            items.push(button);
        }

        if (me.plugin.allowUninstall()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'uninstall','default'=>'Uninstall','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'uninstall','default'=>'Uninstall','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Uninstall<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'uninstall','default'=>'Uninstall','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                cls: 'plugin-manager-action-button',
                handler: function() {
                    me.uninstallPluginEvent(me.plugin);
                }
            });
            items.push(button);
        }

        if (me.plugin.allowDeactivate()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'deactivate','default'=>'Deactivate','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'deactivate','default'=>'Deactivate','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Deactivate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'deactivate','default'=>'Deactivate','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                cls: 'plugin-manager-action-button',
                handler: function() {
                    me.deactivatePluginEvent(me.plugin);
                }
            });
            items.push(button);
        }

        if (me.plugin.allowDelete()) {
            button = Ext.create('PluginManager.container.Container', {
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'delete','default'=>'Delete','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete','default'=>'Delete','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete','default'=>'Delete','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                cls: 'plugin-manager-action-button',
                handler: function() {
                    me.deletePluginEvent(me.plugin);
                }
            });
            items.push(button);
        }

        me.items = items;

        me.callParent(arguments);
    }
});
//<?php }} ?>