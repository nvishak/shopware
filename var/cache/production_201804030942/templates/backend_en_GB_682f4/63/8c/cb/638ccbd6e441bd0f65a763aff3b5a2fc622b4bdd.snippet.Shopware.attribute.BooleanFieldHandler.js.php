<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:19
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field_handler\Shopware.attribute.BooleanFieldHandler.js" */ ?>
<?php /*%%SmartyHeaderCode:1135acda8e7cd10a0-50741679%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '638ccbd6e441bd0f65a763aff3b5a2fc622b4bdd' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field_handler\\Shopware.attribute.BooleanFieldHandler.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1135acda8e7cd10a0-50741679',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e7cd72b8_91546345',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e7cd72b8_91546345')) {function content_5acda8e7cd72b8_91546345($_smarty_tpl) {?>/**
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

Ext.define('Shopware.attribute.BooleanFieldHandler', {
    extend: 'Shopware.attribute.FieldHandlerInterface',

    supports: function(attribute) {
        return (attribute.get('columnType') == 'boolean');
    },

    create: function(field, attribute) {
        field.xtype = 'checkbox';
        field.uncheckedValue = 0;
        field.inputValue = 1;
        return field;
    }
});<?php }} ?>