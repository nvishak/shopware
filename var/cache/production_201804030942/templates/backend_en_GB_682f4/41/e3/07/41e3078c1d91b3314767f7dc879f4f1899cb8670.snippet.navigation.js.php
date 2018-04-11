<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:41
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\list\navigation.js" */ ?>
<?php /*%%SmartyHeaderCode:148265acda8fdafff84-06827209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '41e3078c1d91b3314767f7dc879f4f1899cb8670' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\list\\navigation.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148265acda8fdafff84-06827209',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fdb6fe70_50917296',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fdb6fe70_50917296')) {function content_5acda8fdb6fe70_50917296($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.PluginManager.view.list.Navigation', {
    extend: 'Ext.container.Container',

    cls: 'plugin-manager-navigation',
    autoScroll: true,

    alias: 'widget.plugin-category-navigation',

    layout: 'anchor',

    initComponent: function() {
        var me = this;

        me.items = [
            me.createSearchField(),
            me.createAccountContainer(),
            { xtype: 'component', margin: 10, cls: 'navigation-headline', html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'administration','default'=>'Management','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'administration','default'=>'Management','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Management<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'administration','default'=>'Management','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
            me.createLocalContainer(),
            { xtype: 'component', margin: 10, cls: 'navigation-headline', html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'discover','default'=>'Discover','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'discover','default'=>'Discover','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Discover<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'discover','default'=>'Discover','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
            me.createCategoryTree()
        ];

        me.callParent(arguments);

        Shopware.app.Application.on('refresh-account-data', function(response) {
            if (response.hasOwnProperty('shopwareId')) {
                me.shopwareIdField.update(response.shopwareId);
            }
        });
    },

    setUpdateCount: function(count) {
        var me = this;

        if (count <= 0) {
            me.localUpdatesLink.update(
                '<div class="content has-badge"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Updates<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
            );
            me.localUpdatesLink.disable();
        } else {
            me.localUpdatesLink.update(
                '<div class="content has-badge"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Updates<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<div class="badge">'+count+'</div></div>'
            );
            me.localUpdatesLink.enable();
        }
    },

    createSearchField: function() {
        var me = this;

        me.searchField = Ext.create('Ext.form.field.Text', {
            cls: 'searchfield',
            margin: '10 10 20',
            width: 220,
            disabled: !Shopware.app.Application.sbpAvailable,
            emptyText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'search','default'=>'Search','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'search','default'=>'Search','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'search','default'=>'Search','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ...',
            enableKeyEvents: true,
            checkChangeBuffer: 500,
            listeners: {
                change: function (field, value) {
                    me.fireEvent('search-plugin', value);
                }
            }
        });

        return me.searchField;
    },

    createAccountContainer: function() {
        var me = this, html = '';

        me.shopwareIdField = Ext.create('Ext.Component', {
            cls: 'domain',
            html: ''
        });

        var rightSide = Ext.create('Ext.container.Container', {
            cls: 'right-side',
            items: [{
                xtype: 'component',
                cls: 'picture',
                html: '&nbsp;'
            },{
                cls: 'headline',
                xtype: 'component',
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account','default'=>'Account','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account','default'=>'Account','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account','default'=>'Account','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            },  me.shopwareIdField]
        });

        var cls = 'account-avatar';
        if (!Shopware.app.Application.sbpAvailable) {
            cls += ' disabled';
        }

        me.accountAvatar = Ext.create('PluginManager.container.Container', {
            cls: cls,
            items: [ rightSide ],
            margin: '0 0 10',
            handler: function() {
                if (Shopware.app.Application.sbpAvailable) {
                    Shopware.app.Application.fireEvent('open-login', function() { });
                }
            }
        });

        me.accountLink = Ext.create('PluginManager.container.Container', {
            html: '<div class="content">' +
                      '<a href="https://account.shopware.com/" target="_blank"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'open_account','default'=>'View account','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open_account','default'=>'View account','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
View account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open_account','default'=>'View account','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>' +
                  '</div>',
            cls: 'navigation-item',
            disabled: !Shopware.app.Application.sbpAvailable
        });

        me.accountLicenceLink = Ext.create('PluginManager.container.Container', {
            html: '<div class="content"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'my_purchases','default'=>'My purchases','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'my_purchases','default'=>'My purchases','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
My purchases<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'my_purchases','default'=>'My purchases','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            cls: 'navigation-item',
            disabled: !Shopware.app.Application.sbpAvailable,
            handler: function() {
                me.fireEvent('display-licences');
            }
        });

        me.accountContainer = Ext.create('Ext.container.Container', {
            cls: 'account-container',
            margin: '0 0 10',
            items: [
                me.accountAvatar,
                me.accountLink,
                me.accountLicenceLink
            ]
        });

        return me.accountContainer;
    },

    createLocalContainer: function() {
        var me = this;

        me.localHomeLink = Ext.create('PluginManager.container.Container', {
            cls: 'navigation-item active',
            html: '<div class="content"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'home','default'=>'Home','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'home','default'=>'Home','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Home<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'home','default'=>'Home','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            disabled: !Shopware.app.Application.sbpAvailable,
            handler: function() {
                me.fireEvent('display-home');
            }
        });

        me.localInstalledLink = Ext.create('PluginManager.container.Container', {
            cls: 'navigation-item',
            html: '<div class="content"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'navigation_installed','default'=>'Installed','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'navigation_installed','default'=>'Installed','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Installed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'navigation_installed','default'=>'Installed','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            handler: function() {
                me.fireEvent('display-installed');
            }
        });

        me.localUpdatesLink = Ext.create('PluginManager.container.Container', {
            cls: 'navigation-item',
            html: '<div class="content"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Updates<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'updates','default'=>'Updates','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            disabled: !Shopware.app.Application.sbpAvailable,
            handler: function() {
                me.fireEvent('display-updates');
            }
        });

        me.localContainer = Ext.create('Ext.container.Container', {
            cls: 'navigation-level',
            name: 'local-container',
            items: [
                me.localHomeLink,
                me.localInstalledLink,
                me.localUpdatesLink
            ]
        });

        return me.localContainer;
    },

    /**
     * @returns { PluginManager.container.Container }
     */
    createCategoryTree: function() {
        var me = this;

        me.categoryStore = Ext.create('Shopware.apps.PluginManager.store.Category');
        me.categoryStore.load();

        me.categoryTree = Ext.create('PluginManager.category.Tree', {
            store: me.categoryStore,
            flex: 1
        });

        return me.categoryTree;
    }
});
//<?php }} ?>