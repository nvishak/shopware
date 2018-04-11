<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\model\address.js" */ ?>
<?php /*%%SmartyHeaderCode:25925acda8f0ec24f9-85789428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd78a0e94368a0cb0994670d7d591f17f9715248' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\model\\address.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25925acda8f0ec24f9-85789428',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f0eea6c3_01589915',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f0eea6c3_01589915')) {function content_5acda8f0eea6c3_01589915($_smarty_tpl) {?>/**
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
 * The address model contains all fields for a single address.
 */
// 
Ext.define('Shopware.apps.Customer.model.Address', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'Address',
            detail: 'Shopware.apps.Customer.view.address.detail.Address'
        };
    },

    /**
     * The fields used for this model
     * @array
     */
    fields: [
        // 
        { name: 'defaultAddress', type: 'string', useNull: true }, // fake field
        { name: 'setDefaultBillingAddress', type: 'boolean', useNull: true }, // fake field
        { name: 'setDefaultShippingAddress', type: 'boolean', useNull: true }, // fake field
        { name: 'user_id', type: 'string', useNull: true }, // fake field
        { name: 'company', type: 'string', useNull: true },
        { name: 'department', type: 'string', useNull: true },
        { name: 'vatId', type: 'string', useNull: true },
        { name: 'salutation', type: 'string' },
        { name: 'title', type: 'string' },
        { name: 'firstname', type: 'string' },
        { name: 'lastname', type: 'string' },
        { name: 'street', type: 'string' },
        { name: 'zipcode', type: 'string' },
        { name: 'city', type: 'string' },
        { name: 'additionalAddressLine1', type: 'string', useNull: true },
        { name: 'additionalAddressLine2', type: 'string', useNull: true },
        { name: 'country_id', type: 'int' },
        { name: 'state_id', type: 'int', useNull: true },
        { name: 'phone', type: 'string', useNull: true }
    ],

    associations: [
        { type: 'hasMany', model: 'Shopware.apps.Base.model.Customer', name: 'getCustomer', associationKey: 'customer' },
        { type: 'hasMany', model: 'Shopware.apps.Base.model.Country', name: 'getCountry', associationKey: 'country', relation: 'ManyToOne', field: 'country_id' },
        { type: 'hasMany', model: 'Shopware.apps.Base.model.CountryState', name: 'getState', associationKey: 'state', relation: 'ManyToOne', field: 'state_id' }
    ]

});
// 
<?php }} ?>