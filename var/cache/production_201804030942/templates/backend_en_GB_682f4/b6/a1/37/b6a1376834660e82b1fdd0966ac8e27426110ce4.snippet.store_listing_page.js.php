<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:41
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\list\store_listing_page.js" */ ?>
<?php /*%%SmartyHeaderCode:94355acda8fdc80bd8-53070232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6a1376834660e82b1fdd0966ac8e27426110ce4' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\list\\store_listing_page.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94355acda8fdc80bd8-53070232',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fdcf51b2_47871449',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fdcf51b2_47871449')) {function content_5acda8fdcf51b2_47871449($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.PluginManager.view.list.StoreListingPage', {
    extend: 'Ext.container.Container',
    cls: 'plugin-manager-listing-page',
    alias: 'widget.plugin-manager-store-listing-page',
    autoScroll: true,

    initComponent: function() {
        var me = this;

        me.items = [ me.createStoreListing() ];

        me.callParent(arguments);
    },

    displayContent: function() {
        var me = this;
        me.content.show();
    },

    hideContent: function() {
        var me = this;
        me.content.hide();
    },

    createStoreListing: function() {
        var me = this;

        me.communityStore = Ext.create('Shopware.apps.PluginManager.store.StorePlugin');
        me.storeListing = me.createListing();

        me.filterPanel = me.createFilterPanel();

        me.content = Ext.create('Ext.container.Container', {
            items: [
                me.filterPanel,
                me.storeListing
            ]
        });

        return me.content;
    },

    createListing: function() {
        var me = this;

        me.storeListing = Ext.create('PluginManager.components.Listing', {
            store: me.communityStore,
            name: 'community-store-listing',
            scrollContainer: me,
            padding: 30,
            width: 1007
        });
        return me.storeListing;
    },

    createFilterPanel: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            cls: 'filter-panel',
            layout: 'hbox',
            padding: '15 0 15',
            margin: '0 30',
            items: [
                me.createPriceFilter(),
                me.createCertifiedFilter(),
                me.createSorting()
            ]
        });
    },

    createSorting: function() {
        var me = this;

        me.sortStore = Ext.create('Ext.data.Store', {
            fields: [ 'key', 'name' ],
            data: [
                { key: 'release', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sort_release_date','default'=>'Release date','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sort_release_date','default'=>'Release date','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Release date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sort_release_date','default'=>'Release date','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { key: 'popularity', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sort_popularity','default'=>'Popularity','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sort_popularity','default'=>'Popularity','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Popularity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sort_popularity','default'=>'Popularity','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { key: 'description', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sort_description','default'=>'Description','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sort_description','default'=>'Description','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sort_description','default'=>'Description','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' }
            ]
        });

        me.sortField = Ext.create('Ext.form.field.ComboBox', {
            cls: 'sort-field',
            store: me.sortStore,
            queryMode: 'local',
            displayField: 'name',
            valueField: 'key',
            value: 'release',
            forceSelection: true,
            editable: false,
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sorting','default'=>'Sort by','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sorting','default'=>'Sort by','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Sort by<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sorting','default'=>'Sort by','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            margin: '0 0 0 10',
            listeners: {
                expand: function() {
                    if (this.picker) {
                        this.picker.addCls('plugin-manager-filter-picker');
                    }
                },
                select: function(combo, record) {
                    me.fireEvent('filter-store-listing', me);
                }
            }
        });

        return me.sortField;
    },

    createCertifiedFilter: function() {
        var me = this;

        me.certifiedField = Ext.create('Ext.form.field.Checkbox', {
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'certified_filter','default'=>'Only certified','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'certified_filter','default'=>'Only certified','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Only certified<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'certified_filter','default'=>'Only certified','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            inputValue: true,
            labelWidth: 130,
            uncheckedValue: false,
            name: 'certified',
            cls: 'certified-field',
            margin: '0 25',
            value: false,
            listeners: {
                'change': function(field, value) {
                    me.fireEvent('filter-store-listing', me);
                }
            }
        });

        return me.certifiedField;
    },

    createPriceFilter: function() {
        var me = this;

        me.priceStore = Ext.create('Ext.data.Store', {
            fields: ['key', 'name'],
            data: [
                { key: 'all', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter_price_all','default'=>'All','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_all','default'=>'All','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
All<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_all','default'=>'All','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { key: 'buy', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter_price_buy','default'=>'Buy','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_buy','default'=>'Buy','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Buy<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_buy','default'=>'Buy','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { key: 'rent', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter_price_rent','default'=>'Rent','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_rent','default'=>'Rent','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Rent<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_rent','default'=>'Rent','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { key: 'test', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter_price_test','default'=>'Test','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_test','default'=>'Test','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Test<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_test','default'=>'Test','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { key: 'free', name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter_price_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' }
            ]
        });

        me.priceFilter = Ext.create('Ext.form.field.ComboBox', {
            cls: 'price-filter',
            store: me.priceStore,
            queryMode: 'local',
            displayField: 'name',
            valueField: 'key',
            value: 'all',
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter_price','default'=>'Purchase type','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price','default'=>'Purchase type','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Purchase type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_price','default'=>'Purchase type','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            margin: '0 15 0 0',
            listeners: {
                expand: function() {
                    if (this.picker) {
                        this.picker.addCls('plugin-manager-filter-picker');
                    }
                },
                select: function(combo, record) {
                    me.fireEvent('filter-store-listing', me);
                }
            }
        });

        return me.priceFilter;
    }
});
//<?php }} ?>