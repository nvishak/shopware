<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\chart\meta_chart.js" */ ?>
<?php /*%%SmartyHeaderCode:320905acda8f3ee87a6-37100294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6eec44809d6543b4c803995eeed67c6115ae1344' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\chart\\meta_chart.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320905acda8f3ee87a6-37100294',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f3f24332_12842144',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f3f24332_12842144')) {function content_5acda8f3f24332_12842144($_smarty_tpl) {?>/**
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
 * @package    Customer
 * @subpackage Chart
 * @version    $Id$
 * @author shopware AG
 */

// 
// 
Ext.define('Shopware.apps.Customer.view.chart.MetaChart', {

    extend: 'Shopware.apps.Customer.view.chart.Chart',

    initComponent: function () {
        var me = this;

        me.store = Ext.create('Ext.data.Store', {
            fields: [
                { name: 'count_orders', type: 'int' },
                { name: 'invoice_amount_max', type: 'float' },
                { name: 'invoice_amount_min', type: 'float' },
                { name: 'product_avg', type: 'float' },
                { name: 'yearMonth', type: 'string' }
            ],
            proxy: {
                type: 'ajax',
                url: '<?php echo '/shopware4/backend/CustomerStream/loadChart';?>',
                reader: {
                    type: 'json',
                    root: 'data'
                }
            }
        });

        me.callParent(arguments);
    },

    getFields: function () {
        return [
            { name: 'count_orders',       title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'count_orders','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'count_orders','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order count<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'count_orders','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', currency: false },
            { name: 'invoice_amount_max', title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'max_order','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'max_order','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Most expensive order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'max_order','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', currency: true },
            { name: 'invoice_amount_min', title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'min_order','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'min_order','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Least expensive order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'min_order','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', currency: true },
            { name: 'product_avg',        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ø Product amount <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', currency: true }
        ];
    }
});
// 
<?php }} ?>