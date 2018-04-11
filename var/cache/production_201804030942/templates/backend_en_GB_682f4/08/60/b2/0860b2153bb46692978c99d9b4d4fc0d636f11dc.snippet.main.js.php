<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:47
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\login\view\main.js" */ ?>
<?php /*%%SmartyHeaderCode:13105acd97e7cf5c86-73696811%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0860b2153bb46692978c99d9b4d4fc0d636f11dc' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\login\\view\\main.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13105acd97e7cf5c86-73696811',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e7d137f8_15502862',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e7d137f8_15502862')) {function content_5acd97e7d137f8_15502862($_smarty_tpl) {?>/**
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
 * @package    Login
 * @subpackage Main
 * @version    $Id$
 * @author shopware AG
 */

//

/**
 * todo@all: Documentation
 */
Ext.define('Shopware.apps.Login.view.Main', {
    extend: 'Ext.window.Window',
    width: 360,
    height: 435,
    ui: 'shopware-ui',
    cls: 'login-window',
    shadow: false,
    preventHeader: true,
    footerButton: false,
    border: false,
    resizable: false,
    maximizable: false,
    plain: true,
    header: false,
    closable: false,

    /**
     * Initialize the component and bind an event listener to
     * the `onWindowResize` to center the window.
     *
     * @returns { Void }
     */
    initComponent: function() {
        var me = this;

        me.callParent();

        Ext.EventManager.onWindowResize(function() { me.center(); })
    }
});
<?php }} ?>