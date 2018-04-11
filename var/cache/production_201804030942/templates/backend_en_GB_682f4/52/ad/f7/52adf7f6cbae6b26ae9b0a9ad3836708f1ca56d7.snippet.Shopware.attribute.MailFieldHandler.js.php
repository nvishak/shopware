<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:21
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field_handler\Shopware.attribute.MailFieldHandler.js" */ ?>
<?php /*%%SmartyHeaderCode:11565acda8e9c12b55-26059264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52adf7f6cbae6b26ae9b0a9ad3836708f1ca56d7' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field_handler\\Shopware.attribute.MailFieldHandler.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11565acda8e9c12b55-26059264',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e9c17939_61206396',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e9c17939_61206396')) {function content_5acda8e9c17939_61206396($_smarty_tpl) {?>/**
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
 * @category    Shopware
 * @package     Base
 * @subpackage  Attribute
 * @version     $Id$
 * @author      shopware AG
 */

Ext.define('Shopware.attribute.MailFieldHandler', {
    extend: 'Shopware.attribute.AbstractEntityFieldHandler',
    entity: "Shopware\\Models\\Mail\\Mail",
    singleSelectionClass: 'Shopware.form.field.MailSingleSelection',
    multiSelectionClass: 'Shopware.form.field.MailGrid'
});<?php }} ?>