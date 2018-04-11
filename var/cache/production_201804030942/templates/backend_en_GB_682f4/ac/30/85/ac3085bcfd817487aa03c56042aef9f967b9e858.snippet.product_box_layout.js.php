<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:40
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\product_box_layout.js" */ ?>
<?php /*%%SmartyHeaderCode:175135acd97e031ca98-15858783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac3085bcfd817487aa03c56042aef9f967b9e858' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\product_box_layout.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175135acd97e031ca98-15858783',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e03b3310_92812529',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e03b3310_92812529')) {function content_5acd97e03b3310_92812529($_smarty_tpl) {?>/**
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

/**
 * Shopware Store - Global Stores and Models
 */
//
Ext.define('Shopware.apps.Base.store.ProductBoxLayout', {
    extend: 'Ext.data.Store',

    alternateClassName: 'Shopware.store.ProductBoxLayout',

    storeId: 'base.ProductBoxLayout',

    model: 'Shopware.apps.Base.model.ProductBoxLayout',

    pageSize: 1000,

    defaultLayouts: {
        displayExtendLayout: false,
        displayBasicLayout: true,
        displayMinimalLayout: true,
        displayImageLayout: true,
        displayListLayout: false
    },

    snippets: {
        displayExtendLayout: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_parent_title','default'=>'Parent setting','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_parent_title','default'=>'Parent setting','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Parent settings<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_parent_title','default'=>'Parent setting','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_parent_description','default'=>'The layout of the product box will be set by the value of the parent category.','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_parent_description','default'=>'The layout of the product box will be set by the value of the parent category.','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The layout of the product box will be set by the value of the parent category.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_parent_description','default'=>'The layout of the product box will be set by the value of the parent category.','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        displayBasicLayout: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_basic_title','default'=>'Detailed information','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_basic_title','default'=>'Detailed information','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Detailed information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_basic_title','default'=>'Detailed information','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_basic_description','default'=>'The layout of the product box will show very detailed information.','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_basic_description','default'=>'The layout of the product box will show very detailed information.','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The layout of the product box will show very detailed information.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_basic_description','default'=>'The layout of the product box will show very detailed information.','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        displayMinimalLayout: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_minimal_title','default'=>'Only important information','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_minimal_title','default'=>'Only important information','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Only important information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_minimal_title','default'=>'Only important information','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_minimal_description','default'=>'The layout of the product box will only show the most important information.','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_minimal_description','default'=>'The layout of the product box will only show the most important information.','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The layout of the product box will only show the most important information.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_minimal_description','default'=>'The layout of the product box will only show the most important information.','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        displayImageLayout: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_image_title','default'=>'Big image','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_image_title','default'=>'Big image','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Big image<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_image_title','default'=>'Big image','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_image_description','default'=>'The layout of the product box is based on a big image of the product.','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_image_description','default'=>'The layout of the product box is based on a big image of the product.','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The layout of the product box is based on a big image of the product.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_image_description','default'=>'The layout of the product box is based on a big image of the product.','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        displayListLayout: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_list_title','default'=>'Product list','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_list_title','default'=>'Product list','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product list<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_list_title','default'=>'Product list','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'settings_box_layout_list_description','default'=>'The layout of the product box shows a small image and only one product in a row.','namespace'=>'backend/base/product_box_layout')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_list_description','default'=>'The layout of the product box shows a small image and only one product in a row.','namespace'=>'backend/base/product_box_layout'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The layout of the product box will show very detailed information but only one product in a row.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'settings_box_layout_list_description','default'=>'The layout of the product box shows a small image and only one product in a row.','namespace'=>'backend/base/product_box_layout'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    constructor: function(config) {
        var me = this,
            data = [];

        if (this.getConfigValue(config, 'displayExtendLayout')) {
            data.push({
                key: 'extend',
                label: me.snippets.displayExtendLayout.label,
                description: me.snippets.displayExtendLayout.description,
                image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/category/layout_box_parent.png'
            });
        }
        if (this.getConfigValue(config, 'displayBasicLayout')) {
            data.push({
                key: 'basic',
                label: me.snippets.displayBasicLayout.label,
                description: me.snippets.displayBasicLayout.description,
                image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/category/layout_box_basic.png'
            });
        }
        if (this.getConfigValue(config, 'displayMinimalLayout')) {
            data.push({
                key: 'minimal',
                label: me.snippets.displayMinimalLayout.label,
                description: me.snippets.displayMinimalLayout.description,
                image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/category/layout_box_minimal.png'
            });
        }
        if (this.getConfigValue(config, 'displayImageLayout')) {
            data.push({
                key: 'image',
                label: me.snippets.displayImageLayout.label,
                description: me.snippets.displayImageLayout.description,
                image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/category/layout_box_image.png'
            });
        }
        if (this.getConfigValue(config, 'displayListLayout')) {
            data.push({
                key: 'list',
                label: me.snippets.displayListLayout.label,
                description: me.snippets.displayListLayout.description,
                image: '/shopware4/themes/Backend/ExtJs/backend/_resources/images/category/layout_box_list.png'
            });
        }

        this.data = data;

        this.callParent(arguments);
    },

    getConfigValue: function(config, property) {
        if (!Ext.isObject(config)) {
            return this.defaultLayouts[property];
        }

        if (!config.hasOwnProperty(property)) {
            return this.defaultLayouts[property];
        }

        return config[property];
    }

});

<?php }} ?>