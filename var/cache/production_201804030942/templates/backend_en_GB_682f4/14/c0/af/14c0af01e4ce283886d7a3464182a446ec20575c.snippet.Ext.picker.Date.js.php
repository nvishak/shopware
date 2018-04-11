<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:13
         compiled from "E:\wamp\www\shopware4\engine\Library\ExtJs\overrides\Ext.picker.Date.js" */ ?>
<?php /*%%SmartyHeaderCode:141985acda8e16b0a13-74899261%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14c0af01e4ce283886d7a3464182a446ec20575c' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Library\\ExtJs\\overrides\\Ext.picker.Date.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141985acda8e16b0a13-74899261',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e16b5c77_91511734',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e16b5c77_91511734')) {function content_5acda8e16b5c77_91511734($_smarty_tpl) {?>/**
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
Ext.override(Ext.picker.Date, {

    /**
     * Overrides the todayBtn to use our
     * fancy and shiny button kit.
     *
     * @private
     * @return void
     */
    beforeRender: function () {
        var me = this;
        me.callOverridden();
        if(me.todayBtn) {
            me.todayBtn.addCls('small').addCls('secondary');
        }
    }
});
<?php }} ?>