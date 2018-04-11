<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:21
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field_handler\Shopware.attribute.ProductFeedFieldHandler.js" */ ?>
<?php /*%%SmartyHeaderCode:91965acda8e9987387-16803405%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd88f7639fdda6df19f2a6413a422b5d2fea8201' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field_handler\\Shopware.attribute.ProductFeedFieldHandler.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91965acda8e9987387-16803405',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e998c381_57321905',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e998c381_57321905')) {function content_5acda8e998c381_57321905($_smarty_tpl) {?>/**
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

Ext.define('Shopware.attribute.ProductFeedFieldHandler', {
    extend: 'Shopware.attribute.AbstractEntityFieldHandler',
    entity: "Shopware\\Models\\ProductFeed\\ProductFeed",
    singleSelectionClass: 'Shopware.form.field.ProductFeedSingleSelection',
    multiSelectionClass: 'Shopware.form.field.ProductFeedGrid'
});<?php }} ?>