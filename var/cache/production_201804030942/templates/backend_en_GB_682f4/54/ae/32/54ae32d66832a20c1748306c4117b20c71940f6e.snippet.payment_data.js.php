<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\model\payment_data.js" */ ?>
<?php /*%%SmartyHeaderCode:140045acda8f0c3df57-17826909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54ae32d66832a20c1748306c4117b20c71940f6e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\model\\payment_data.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '140045acda8f0c3df57-17826909',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f0c54816_06244261',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f0c54816_06244261')) {function content_5acda8f0c54816_06244261($_smarty_tpl) {?>/**
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
 * @subpackage Model
 * @version    $Id$
 * @author shopware AG
 */

// 

/**
 * Shopware Model - Customer list backend module.
 *
 * The payment data model represents a single data row of the s_user_debit or
 * the Shopware\Models\Customer\PaymentData doctrine model which contains all data about the
 * customer payment data.
 */
// 
Ext.define('Shopware.apps.Customer.model.PaymentData', {

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend: 'Ext.data.Model',

    /**
     * Unique identifier field
     * @string
     */
    idProperty: 'id',
    /**
     * The fields used for this model
     * @array
     */
    fields: [
        // 
        { name: 'accountNumber', type: 'string' },
        { name: 'bankCode', type: 'string' },
        { name: 'bankName', type: 'string' },
        { name: 'accountHolder', type: 'string' },
        { name: 'bic', type: 'string' },
        { name: 'iban', type: 'string' },
        { name: 'useBillingData', type: 'boolean' }
    ]
});
// 
<?php }} ?>