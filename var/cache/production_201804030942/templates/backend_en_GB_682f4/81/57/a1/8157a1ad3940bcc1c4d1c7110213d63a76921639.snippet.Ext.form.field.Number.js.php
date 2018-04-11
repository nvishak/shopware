<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:35
         compiled from "E:\wamp\www\shopware4\engine\Library\ExtJs\overrides\Ext.form.field.Number.js" */ ?>
<?php /*%%SmartyHeaderCode:137525acd97db5aa428-17913456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8157a1ad3940bcc1c4d1c7110213d63a76921639' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Library\\ExtJs\\overrides\\Ext.form.field.Number.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137525acd97db5aa428-17913456',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97db5cc4a7_87903414',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97db5cc4a7_87903414')) {function content_5acd97db5cc4a7_87903414($_smarty_tpl) {?>/**
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
 * Shopware UI - Number field Override
 *
 * Sets the default submitLocaleSeparator value to false
 * so we can easily handle i18n number separators
 *
 * Shopware AG (c) 2014. All rights reserved.
 *
 * @link http://www.shopware.de/
 * @author t.garcia
 * @date 2014-06-20
 * @license http://www.shopware.de/license
 * @package overrides
 */
Ext.override(Ext.form.field.Number,
/** @lends Ext.form.field.Number */
{
    submitLocaleSeparator: false
});
<?php }} ?>