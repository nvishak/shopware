<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:23
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\index\model\merchant.js" */ ?>
<?php /*%%SmartyHeaderCode:247255acda8ebb874b1-28833700%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baf05c0f909f39b9ccbba35c2366afde1f62b6b2' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\index\\model\\merchant.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '247255acda8ebb874b1-28833700',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ebba1329_57190101',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ebba1329_57190101')) {function content_5acda8ebba1329_57190101($_smarty_tpl) {?>/**
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
 */

/**
 * todo@all: Documentation
 */
//
Ext.define('Shopware.apps.Index.model.Merchant', {
    extend: 'Ext.data.Model',
    fields: [
        //
        { name: 'id' },
        { name: 'company_name' },
        { name: 'customer' },
        { name: 'email' },
        { name: 'customergroup' },
        { name: 'customergroup_name' },
        { name: 'customergroup_id' },
        { name: 'date', type: 'date', dateFormat:'Y-m-d H:i:s' },
        { name: 'validation' }
    ]
});
//
<?php }} ?>