<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:40
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\listing_filter_mode.js" */ ?>
<?php /*%%SmartyHeaderCode:202065acd97e04b2be9-00453782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '195f108dc08d448bb15fd956e1025e8a88e3fa96' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\listing_filter_mode.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202065acd97e04b2be9-00453782',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e0519d18_17608866',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e0519d18_17608866')) {function content_5acd97e0519d18_17608866($_smarty_tpl) {?>/**
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
 * @package    Base
 * @subpackage Store
 * @version    $Id$
 * @author shopware AG
 */


//

Ext.define('Shopware.apps.Base.store.ListingFilterMode', {
    extend: 'Ext.data.Store',

    alternateClassName: 'Shopware.store.ListingFilterMode',

    storeId: 'base.ListingFilterMode',

    fields: [
        { name: 'key', type: 'string' },
        { name: 'label', type: 'string' },
        { name: 'description', type: 'string' },
        { name: 'image', type: 'string' }
    ],

    pageSize: 1000,

    defaultModes: {
        displayFullPageReload: true,
        displayReloadProductsMode: true,
        displayReloadFiltersMode: true
    },

    fullPageReload: {
        key: 'full_page_reload',
        label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'listing_mode_reload_label','namespace'=>'backend/base/listing_filter_mode')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_reload_label','namespace'=>'backend/base/listing_filter_mode'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Display filter button<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_reload_label','namespace'=>'backend/base/listing_filter_mode'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'listing_mode_reload_description','namespace'=>'backend/base/listing_filter_mode')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_reload_description','namespace'=>'backend/base/listing_filter_mode'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product listing will be reloaded using a button.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_reload_description','namespace'=>'backend/base/listing_filter_mode'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/listing_mode/full_page_reload.jpg'
    },

    reloadProductsMode: {
        key: 'product_ajax_reload',
        label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'listing_mode_product_reload_label','namespace'=>'backend/base/listing_filter_mode')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_product_reload_label','namespace'=>'backend/base/listing_filter_mode'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Live product reloading<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_product_reload_label','namespace'=>'backend/base/listing_filter_mode'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'listing_mode_product_reload_description','namespace'=>'backend/base/listing_filter_mode')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_product_reload_description','namespace'=>'backend/base/listing_filter_mode'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
When a product list gets filtered, it will reload immediately.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_product_reload_description','namespace'=>'backend/base/listing_filter_mode'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/listing_mode/product_ajax_reload.jpg'
    },

    reloadFiltersMode: {
        key: 'filter_ajax_reload',
        label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'listing_mode_filter_reload_label','namespace'=>'backend/base/listing_filter_mode')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_filter_reload_label','namespace'=>'backend/base/listing_filter_mode'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Live product and filter reloading<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_filter_reload_label','namespace'=>'backend/base/listing_filter_mode'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'listing_mode_filter_reload_description','namespace'=>'backend/base/listing_filter_mode')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_filter_reload_description','namespace'=>'backend/base/listing_filter_mode'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
When a product list gets filtered, it will reload immediately. Filters which are not combinable will be deactivated.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'listing_mode_filter_reload_description','namespace'=>'backend/base/listing_filter_mode'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/listing_mode/filter_ajax_reload.jpg'
    },

    constructor: function(config) {
        var me = this,
            data = [];

        if (this.getConfigValue(config, 'displayFullPageReload')) {
            data.push(me.fullPageReload);
        }
        if (this.getConfigValue(config, 'displayReloadProductsMode')) {
            data.push(me.reloadProductsMode);
        }
        if (this.getConfigValue(config, 'displayReloadFiltersMode')) {
            data.push(me.reloadFiltersMode);
        }

        this.data = data;
        this.callParent(arguments);
    },

    getConfigValue: function(config, property) {
        if (!Ext.isObject(config)) {
            return this.defaultModes[property];
        }

        if (!config.hasOwnProperty(property)) {
            return this.defaultModes[property];
        }

        return config[property];
    }
});
<?php }} ?>