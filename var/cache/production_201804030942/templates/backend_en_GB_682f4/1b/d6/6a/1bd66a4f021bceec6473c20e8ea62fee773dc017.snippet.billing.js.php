<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\model\billing.js" */ ?>
<?php /*%%SmartyHeaderCode:321615acda8f0abfa46-34260922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1bd66a4f021bceec6473c20e8ea62fee773dc017' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\model\\billing.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '321615acda8f0abfa46-34260922',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f0ad10a1_48163219',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f0ad10a1_48163219')) {function content_5acda8f0ad10a1_48163219($_smarty_tpl) {?>/**
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
 * The billing model represents a single data row of the s_user_billingaddress or
 * the Shopware\Models\Customer\Billing.
 */
// 
Ext.define('Shopware.apps.Customer.model.Billing', {

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend: 'Shopware.apps.Base.model.BillingAddress',

    /**
     * The fields used for this model
     * @array
     */
    fields: [
        // 
        { name: 'stateId', type: 'int', useNull: true }
    ],

    /**
     * Copy properties from the new address structure to legacy billing structure
     * @param Shopware.apps.Customer.model.Address
     * @returns Shopware.apps.Customer.model.Billing
     */
    fromAddress: function (address) {
        this.set('company', address.get('company'));
        this.set('department', address.get('department'));
        this.set('salutation', address.get('salutation'));
        this.set('title', address.get('title'));
        this.set('firstName', address.get('firstname'));
        this.set('lastName', address.get('lastname'));
        this.set('street', address.get('street'));
        this.set('city', address.get('city'));
        this.set('zipCode', address.get('zipcode'));
        this.set('additionalAddressLine1', address.get('additionalAddressLine1'));
        this.set('additionalAddressLine2', address.get('additionalAddressLine2'));
        this.set('phone', address.get('phone'));
        this.set('vatId', address.get('vatId'));
        this.set('countryId', address.get('country_id'));
        this.set('stateId', address.get('state_id'));

        return this;
    }
});
// 
<?php }} ?>