<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:39
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\value.js" */ ?>
<?php /*%%SmartyHeaderCode:254105acd97df1880a1-40144825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77c161daa2ade6d5084d2dc1f87d5fe47f4a4ff8' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\value.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '254105acd97df1880a1-40144825',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97df1abe26_19629177',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97df1abe26_19629177')) {function content_5acd97df1abe26_19629177($_smarty_tpl) {?>/**
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
 * @package    Shopware_Base
 * @subpackage Config
 * @version    $Id$
 * @author shopware AG
 */
//
Ext.define('Shopware.apps.Base.model.Value', {
    extend: 'Ext.data.Model',

    alternateClassName: 'Shopware.model.Value',

    fields: [
        //
        { name: 'id', type: 'int', useNull: true },
        { name: 'shopId', type: 'int' },
        { name: 'value', defaultValue: null, useNull: true }
    ]
});
//
<?php }} ?>