<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:16
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\captcha.js" */ ?>
<?php /*%%SmartyHeaderCode:214425acda8e47f34e1-33933992%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cd63353f540f2e0b518a3c6357a0075124d2e44' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\captcha.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214425acda8e47f34e1-33933992',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e4802a94_24893630',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e4802a94_24893630')) {function content_5acda8e4802a94_24893630($_smarty_tpl) {?>/**
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
 * The captcha model contains all fields for a single captcha.
 */
//
Ext.define('Shopware.apps.Base.model.Captcha', {

    /**
     * Defines an alternate name for this class.
     */
    alternateClassName: 'Shopware.model.Captcha',

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend:'Ext.data.Model',

    /**
     * The fields used for this model
     * @array
     */
    fields:[
        //
        { name: 'id', type: 'string' },
        { name: 'displayname', type: 'string' }
    ]

});
//


<?php }} ?>