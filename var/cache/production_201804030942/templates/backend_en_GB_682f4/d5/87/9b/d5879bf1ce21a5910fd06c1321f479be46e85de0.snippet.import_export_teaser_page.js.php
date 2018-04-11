<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:42
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\list\import_export_teaser_page.js" */ ?>
<?php /*%%SmartyHeaderCode:252295acda8fe303350-40263969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5879bf1ce21a5910fd06c1321f479be46e85de0' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\list\\import_export_teaser_page.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '252295acda8fe303350-40263969',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fe3530f8_54545874',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fe3530f8_54545874')) {function content_5acda8fe3530f8_54545874($_smarty_tpl) {?>/**
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
 * @subpackage List
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.list.ImportExportTeaserPage', {
    extend: 'Ext.container.Container',
    alias: 'widget.plugin-manager-importexport-teaser-page',

    border: false,
    cls: 'plugin-manager-listing-page',
    autoScroll: true,
    layout: 'anchor',
    defaults: {
        anchor: '100%'
    },

    initComponent: function() {
        var me = this;

        me.items = me.buildItems();

        me.callParent(arguments);
    },

    buildItems: function() {
        var me = this,
            image1 = '/shopware4/themes/Backend/ExtJs/backend/_resources/resources/themes/images/shopware-ui/importexport_plugin.png',
            image2 = '/shopware4/themes/Backend/ExtJs/backend/_resources/resources/themes/images/shopware-ui/migration_plugin.png';

        me.headlineCt = Ext.create('Ext.container.Container', {
            cls: 'headline',
            margin: '20px 0 0 20px',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'import_export_teaser/headline','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/headline','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
How do you wish to proceed?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/headline','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        me.importExportFieldSet = Ext.create('Ext.form.FieldSet', {
            margin: '20px 20px 0 20px',
            padding: '40px 0 40px 0',
            layout: 'fit',
            items: [{
                xtype: 'container',
                layout: {
                    type: 'hbox',
                    align: 'stretch'
                },
                items: [{
                    xtype: 'container',
                    margins: '0 0 0 140px;',
                    html: '<img class="teaser-icon" src="'+ image1 +'" />'
                }, {
                    xtype: 'container',
                    flex: 1,
                    margins: '0 0 0 20px;',
                    items: [{
                        xtype: 'container',
                        cls: 'teaser-headline',
                        html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'import_export_teaser/import_export_header','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/import_export_header','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Import and export data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/import_export_header','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                    }, {
                        xtype: 'container',
                        margin: '10 0 0 0',
                        padding: '0 120 0 0',
                        html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'import_export_teaser/import_export_description','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/import_export_description','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Use this plugin to im/export product, customer and order data etc. directly into your shop.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/import_export_description','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                    }, {
                        xtype: 'button',
                        width: 252,
                        margin: '13 0 0 0',
                        text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'import_export_teaser/import_export_button_text','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/import_export_button_text','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Install import / export for free<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/import_export_button_text','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        cls: 'primary',
                        handler: function() {
                            me.fireEvent('install-import-export-plugin');
                        }
                    }]
                }]
            }]
        });

        me.migrationFieldSet = Ext.create('Ext.form.FieldSet', {
            itemId: 'migrationteaser',
            margin: '20px 20px 0 20px',
            padding: '40px 0 40px 0',
            items: [{
                xtype: 'container',
                layout: {
                    type: 'hbox',
                    align: 'stretch'
                },
                items: [{
                    xtype: 'container',
                    margins: '0 0 0 140px;',
                    html: '<img class="teaser-icon" src="'+ image2 +'" />'
                }, {
                    xtype: 'container',
                    flex: 1,
                    margins: '0 0 0 20px;',
                    items: [{
                        xtype: 'container',
                        cls: 'teaser-headline',
                        html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'import_export_teaser/migration_header','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/migration_header','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Migration from other shop systems<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/migration_header','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                    }, {
                        xtype: 'container',
                        margin: '10 0 0 0',
                        padding: '0 120 0 0',
                        html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'import_export_teaser/migration_description','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/migration_description','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The migration plugin automatically transfers your existing data to your new Shopware 5 shop.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/migration_description','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                    }, {
                        xtype: 'button',
                        width: 252,
                        margin: '13 0 0 0',
                        text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'import_export_teaser/migration_button_text','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/migration_button_text','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Install migration for free<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'import_export_teaser/migration_button_text','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        cls: 'primary',
                        handler: function() {
                            me.fireEvent('install-migration-plugin');
                        }
                    }]
                }]
            }]
        });

        return [
            me.headlineCt,
            me.importExportFieldSet,
            me.migrationFieldSet
        ];
    }
});
//<?php }} ?>