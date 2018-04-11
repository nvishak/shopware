<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:16
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\product_box_layout.js" */ ?>
<?php /*%%SmartyHeaderCode:301635acda8e48531b8-19744425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d47617f904060fe17fcec2b059f43d7db5723f7' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\product_box_layout.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '301635acda8e48531b8-19744425',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e4867b47_47726453',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e4867b47_47726453')) {function content_5acda8e4867b47_47726453($_smarty_tpl) {?>/**
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
 * @package    Base
 * @subpackage Model
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Model - Global Stores and Models
 *
 */
//
//
Ext.define('Shopware.apps.Base.model.ProductBoxLayout', {

    /**
     * Defines an alternate name for this class.
     */
    alternateClassName:'Shopware.model.ProductBoxLayout',

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend:'Shopware.data.Model',

    /**
     * The fields used for this model
     * @array
     */
    fields:[
        //
        { name: 'key', type: 'string' },
        { name: 'label', type: 'string' },
        { name: 'description', type: 'string' },
        { name: 'image', type: 'string' }
    ]
});
//
<?php }} ?>