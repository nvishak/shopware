<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:41
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\list\home_page.js" */ ?>
<?php /*%%SmartyHeaderCode:252285acda8fd66a272-25954699%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f44633272a747c9161e4a09ef6b328c35e017297' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\list\\home_page.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '252285acda8fd66a272-25954699',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fd695597_74146199',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fd695597_74146199')) {function content_5acda8fd695597_74146199($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.PluginManager.view.list.HomePage', {
    extend: 'Ext.container.Container',
    alias: 'widget.plugin-manager-home-page',
    cls: 'plugin-manager-listing-page plugin-manager-home-page',

    autoScroll: true,

    initComponent: function () {
        var me = this;

        me.content = Ext.create('Ext.container.Container', {
            padding: '30 0 0',
            items: [
                { xtype: 'component', cls: 'headline', html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'store_newcomer','default'=>'New in the store','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'store_newcomer','default'=>'New in the store','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
New in the store<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'store_newcomer','default'=>'New in the store','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                me.createNewcomerListing(),
                { xtype: 'component', cls: 'headline', html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ready_for_integration','default'=>'Ready for integration','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ready_for_integration','default'=>'Ready for integration','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ready for integration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ready_for_integration','default'=>'Ready for integration','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                me.createDummyListing()
            ]
        });

        me.items = [me.content];

        me.callParent(arguments);
    },

    displayContent: function () {
        var me = this;
        this.content.show();
    },

    hideContent: function () {
        var me = this;
        me.content.hide();
    },

    createNewcomerListing: function () {
        var me = this;

        me.newcomerStore = Ext.create('Shopware.apps.PluginManager.store.StorePlugin', {
            pageSize: 5,
            filters: [{
                property: 'newcomer',
                value: true
            }]
        });

        me.newcomerListing = Ext.create('PluginManager.components.Listing', {
            store: me.newcomerStore,
            name: 'new-comer-listing',
            padding: 30,
            width: 1007
        });

        me.newcomerStore.on('load', function() {
            var moreLink = Ext.create('PluginManager.container.Container', {
                html: '<div class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'display_all_newcomer','default'=>'Display all new','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'display_all_newcomer','default'=>'Display all new','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Display all new<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'display_all_newcomer','default'=>'Display all new','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
                cls: 'more-link',
                handler: function() {
                    me.fireEvent('display-newcomer');
                }
            });

            me.newcomerListing.listingContainer.add(moreLink);
        });

        me.newcomerStore.load();

        return me.newcomerListing;
    },

    createDummyListing: function () {
        var me = this;

        me.dummyStore = Ext.create('Shopware.apps.PluginManager.store.StorePlugin', {
            pageSize: 50,
            filters: [{
                property: 'dummy',
                value: true
            }]
        }).load();

        me.dummyListing = Ext.create('PluginManager.components.Listing', {
            store: me.dummyStore,
            name: 'dummy-listing',
            scrollContainer: me,
            padding: 30,
            width: 1007
        });

        return me.dummyListing;
    }
});
//<?php }} ?>