<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:41
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\list\update_page.js" */ ?>
<?php /*%%SmartyHeaderCode:70325acda8fde14950-48169048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb34024ef4d088c50cf67655db47b6473a57115a' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\list\\update_page.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70325acda8fde14950-48169048',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fde21db1_01832892',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fde21db1_01832892')) {function content_5acda8fde21db1_01832892($_smarty_tpl) {?>/**
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
 * @subpackage List
 * @version    $Id$
 * @author shopware AG
 */

//
Ext.define('Shopware.apps.PluginManager.view.list.UpdatePage', {
    extend: 'Ext.container.Container',
    autoScroll: true,
    alias: 'widget.plugin-manager-update-page',

    initComponent: function() {
        var me = this;

        me.items = [ me.createStoreListing() ];

        me.callParent(arguments);
    },

    createStoreListing: function() {
        var me = this;

        me.updateStore = Ext.create('Shopware.apps.PluginManager.store.UpdatePlugins');

        me.listing = Ext.create('PluginManager.components.Listing', {
            store: me.updateStore,
            padding: 30,
            width: 1007
        });

        me.content = Ext.create('Ext.container.Container', {
            items: [
                me.listing
            ]
        });

        return me.content;
    }
});
//<?php }} ?>