<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:23
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\index\model\visitors.js" */ ?>
<?php /*%%SmartyHeaderCode:239665acda8eba73c36-16298884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2bf732e7c4d552fa80222c25d88cd4b6168db98' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\index\\model\\visitors.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '239665acda8eba73c36-16298884',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8eba81491_79809383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8eba81491_79809383')) {function content_5acda8eba81491_79809383($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Index.model.Visitors', {
    extend: 'Ext.data.Model',
    fields: [
        //
        'date', { name: 'visitors', type: 'int'}, 'timestamp']
});
//
<?php }} ?>