<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:19
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field_handler\Shopware.attribute.HtmlFieldHandler.js" */ ?>
<?php /*%%SmartyHeaderCode:129735acda8e7e39ee8-14963965%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e85016e72792079cdf9bf3e6601e65bdae42fc2c' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field_handler\\Shopware.attribute.HtmlFieldHandler.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129735acda8e7e39ee8-14963965',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e7e404d2_43284167',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e7e404d2_43284167')) {function content_5acda8e7e404d2_43284167($_smarty_tpl) {?>/**
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

Ext.define('Shopware.attribute.HtmlFieldHandler', {
    extend: 'Shopware.attribute.FieldHandlerInterface',

    supports: function(attribute) {
        return (attribute.get('columnType') == 'html');
    },

    create: function(field, attribute) {
        field.xtype = 'tinymce';
        field.height = 150;
        return field;
    }
});<?php }} ?>