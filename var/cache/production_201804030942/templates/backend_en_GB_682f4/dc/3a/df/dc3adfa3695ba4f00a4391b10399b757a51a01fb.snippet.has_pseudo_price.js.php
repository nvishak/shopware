<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\view\condition_list\condition\has_pseudo_price.js" */ ?>
<?php /*%%SmartyHeaderCode:120155acda8f17d8654-83254332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc3adfa3695ba4f00a4391b10399b757a51a01fb' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\view\\condition_list\\condition\\has_pseudo_price.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120155acda8f17d8654-83254332',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f1823e75_25335200',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f1823e75_25335200')) {function content_5acda8f1823e75_25335200($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.ProductStream.view.condition_list.condition.HasPseudoPrice', {
    extend: 'ProductStream.filter.AbstractCondition',

    getName: function() {
        return 'Shopware\\Bundle\\SearchBundle\\Condition\\HasPseudoPriceCondition';
    },

    getLabel: function() {
        return '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'has_pseudo_price_condition','default'=>'Has pseudo price condition','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'has_pseudo_price_condition','default'=>'Has pseudo price condition','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Has pseudo price condition<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'has_pseudo_price_condition','default'=>'Has pseudo price condition','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
    },

    isSingleton: function() {
        return true;
    },

    create: function(callback) {
        callback(this.createField());
    },

    load: function(key, value) {
        if (key !== this.getName()) {
            return;
        }
        return this.createField();
    },

    createField: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            getName: function() {
                return 'condition.' + me.getName();
            },
            items: [{
                xtype: 'displayfield',
                value: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'has_pseudo_price'/'display_text','default'=>'Only products having pseudo price will be displayed','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'has_pseudo_price'/'display_text','default'=>'Only products having pseudo price will be displayed','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Only products with pseudo price will be displayed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'has_pseudo_price'/'display_text','default'=>'Only products having pseudo price will be displayed','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            }, {
                xtype: 'numberfield',
                name: 'condition.' + this.getName(),
                hidden: true,
                value: 1
            }]
        });
    }
});
//<?php }} ?>