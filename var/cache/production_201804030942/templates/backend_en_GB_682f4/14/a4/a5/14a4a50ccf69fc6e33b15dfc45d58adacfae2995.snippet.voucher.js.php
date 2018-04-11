<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\store\voucher.js" */ ?>
<?php /*%%SmartyHeaderCode:56305acda8f4e4ee08-73494754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14a4a50ccf69fc6e33b15dfc45d58adacfae2995' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\store\\voucher.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56305acda8f4e4ee08-73494754',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f4e5c0c3_38556500',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f4e5c0c3_38556500')) {function content_5acda8f4e5c0c3_38556500($_smarty_tpl) {?>/**
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
 * @package    Order
 * @subpackage Store
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Store - Order list backend module
 *
 * The voucher store is used for the document configuration in the document tab on the detail page.
 */
//
Ext.define('Shopware.apps.Order.store.Voucher', {
    /**
     * Extend for the standard ExtJS 4
     * @string
     */
    extend:'Ext.data.Store',
    /**
     * Define the used model for this store
     * @string
     */
    model:'Shopware.apps.Order.model.Voucher'
});
//

<?php }} ?>