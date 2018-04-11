<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:42
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\list\expired_plugins_page.js" */ ?>
<?php /*%%SmartyHeaderCode:132395acda8fe1d4387-27902280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7c7a1906ef2bf099ca61c6ffcd154c139bc6038' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\list\\expired_plugins_page.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132395acda8fe1d4387-27902280',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fe1f3734_33924590',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fe1f3734_33924590')) {function content_5acda8fe1f3734_33924590($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.PluginManager.view.list.ExpiredPluginsPage', {
    extend: 'Ext.container.Container',
    autoScroll: true,
    cls: 'plugin-manager-listing-page',
    alias: 'widget.plugin-manager-expired-plugins-page',

    initComponent: function() {
        var me = this;

        me.expiredStore = Ext.create('Shopware.apps.PluginManager.store.ExpiredPlugins', {
            autoLoad: true
        });
        me.items = [ me.createFilterPanel(), me.createStoreListing() ];

        me.callParent(arguments);
    },

    createFilterPanel: function() {
        return Ext.create('Ext.container.Container', {
            border: false,
            items: [
                Ext.create('Ext.container.Container', {
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'expired_plugins/headline','default'=>'We hope you enjoyed using the plugins','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expired_plugins/headline','default'=>'We hope you enjoyed using the plugins','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Continue benefiting from your tested plugins<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expired_plugins/headline','default'=>'We hope you enjoyed using the plugins','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    cls: 'headline',
                    padding: '30 30 0 30'
                }),
                Ext.create('Ext.container.Container', {
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'expired_plugins/description_text','default'=>'The test phase for the following plugins is expired. You can now easily buy the plugins via Plugin Manager. If you did not like the plugin you can easily uninstall it.','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expired_plugins/description_text','default'=>'The test phase for the following plugins is expired. You can now easily buy the plugins via Plugin Manager. If you did not like the plugin you can easily uninstall it.','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Your free trial version of the following plugins <b>expired</b>. To continue using these plugins in your online shop, you can <b>purchase</b> them directly from the Plugin Manager in your Shopware backend. Alternatively, these extensions can also be <b>uninstalled</b>.<br><br>Do you have any <b>suggestions</b> for improvement or feature wishes? Then <b>leave a review</b> through your Shopware Account!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expired_plugins/description_text','default'=>'The test phase for the following plugins is expired. You can now easily buy the plugins via Plugin Manager. If you did not like the plugin you can easily uninstall it.','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    padding: '10 30 0 30'
                })
            ]
        });
    },

    createStoreListing: function() {
        var me = this;

        me.listing = Ext.create('PluginManager.components.Listing', {
            store: me.expiredStore,
            padding: 30,
            width: 1007,
            addItems: function(records) {
                var me = this, plugins = [];

                Ext.each(records, function(record) {
                    var item = Ext.create('PluginManager.components.ExpiredPlugin', {
                        record: record
                    });

                    plugins.push(item);
                });
                me.listingContainer.add(plugins);
            }
        });

        me.content = Ext.create('Ext.container.Container', {
            items: [
                me.listing
            ]
        });

        return me.content;
    }
});
//<?php }} ?>