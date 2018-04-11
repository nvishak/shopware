<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:40
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\model\comment.js" */ ?>
<?php /*%%SmartyHeaderCode:206875acda8fcb65946-79315171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccd4c78da7a4d05e3da47e81f3407c90d812f02e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\model\\comment.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206875acda8fcb65946-79315171',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fcb75607_15413680',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fcb75607_15413680')) {function content_5acda8fcb75607_15413680($_smarty_tpl) {?>/**
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
 * @package    PluginManager
 * @subpackage Model
 * @version    $Id$
 * @author shopware AG
 */

//
Ext.define('Shopware.apps.PluginManager.model.Comment', {
    extend: 'Ext.data.Model',

    fields: [
        { name: 'rating', type: 'int' },
        { name: 'creationDate', type: 'datetime' },
        { name: 'headline', type: 'string' },
        { name: 'author', type: 'string' },
        { name: 'text', type: 'string' }
    ]
});
//<?php }} ?>