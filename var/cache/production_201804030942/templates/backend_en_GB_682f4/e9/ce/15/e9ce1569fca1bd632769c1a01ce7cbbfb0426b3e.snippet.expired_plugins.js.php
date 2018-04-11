<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:43
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\store\expired_plugins.js" */ ?>
<?php /*%%SmartyHeaderCode:254065acda8ff76a0b0-37936027%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9ce1569fca1bd632769c1a01ce7cbbfb0426b3e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\store\\expired_plugins.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '254065acda8ff76a0b0-37936027',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ff77b4c8_61707275',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ff77b4c8_61707275')) {function content_5acda8ff77b4c8_61707275($_smarty_tpl) {?>/**
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
 * @subpackage Store
 * @version    $Id$
 * @author shopware AG
 */

//
Ext.define('Shopware.apps.PluginManager.store.ExpiredPlugins', {
    extend: 'Ext.data.Store',

    model: 'Shopware.apps.PluginManager.model.Plugin',

    pageSize: 500,

    proxy: {
        type: 'ajax',
        api: {
            read: '<?php echo '/shopware4/backend/PluginManager/expiredListing';?>'
        },
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        }
    }
});
//<?php }} ?>