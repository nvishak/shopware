<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:25
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\index\controller\error_reporter.js" */ ?>
<?php /*%%SmartyHeaderCode:255335acda8ed5863d1-07720318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a39978e20fe3a27c50fbb66dc094a0ac55bbf02' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\index\\controller\\error_reporter.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '255335acda8ed5863d1-07720318',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ed5ac531_05590798',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ed5ac531_05590798')) {function content_5acda8ed5ac531_05590798($_smarty_tpl) {?>/**
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

/**
 * Shopware Core - Global Error Handling Controller
 *
 * This class handles all error which are raised
 * in the application and it's subapplications.
 *
 * The user of the controller has the ability
 * to log the errors and open them up in a grid panel.
 */
//
//
Ext.define('Shopware.apps.Index.controller.ErrorReporter', {
    extend: 'Ext.app.Controller',

    /**
     * Controls if errors are logged to the default window.console
     * @boolean
     */
    displayErrors: true,

    /**
     * Controls if the default javascript error handlers should be overrides
     * with custom handler.
     *
     * Truthy to use the default error handlers, falsy to define your custom error
     * handlers.
     *
     * To provide custom error handlers, please override the method `bindCustomErrorHandler`
     *
     * @type { Boolean }
     * @default true
     */
    useDefaultErrorHandler: true,

    /**
     * Creates the necessary event listener for this
     * specific controller and opens a new Ext.window.Window
     * to display the subapplication.
     *
     * @public
     * @constructor
     * @return void
     */
    init: function() {
        var me = this;

        if(!me.useDefaultErrorHandler) {
            me.bindCustomErrorHandler();
        }
    },

    /**
     * Binds the custom error reporter.
     *
     * @returns { Void }
     */
    bindCustomErrorHandler: function() {
        var me = this;

        // Override the default error reporter
        window.onerror = function(message, file, lineNumber) {
            //alert('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'error_reporter/file','default'=>'File:','namespace'=>'backend/index/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error_reporter/file','default'=>'File:','namespace'=>'backend/index/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
File:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error_reporter/file','default'=>'File:','namespace'=>'backend/index/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + file + "\r" + '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'error_reporter/line','default'=>'Line number:','namespace'=>'backend/index/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error_reporter/line','default'=>'Line number:','namespace'=>'backend/index/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Line number:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error_reporter/line','default'=>'Line number:','namespace'=>'backend/index/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + lineNumber + "\n\r" + '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'error_reporter/message','default'=>'Message:','namespace'=>'backend/index/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error_reporter/message','default'=>'Message:','namespace'=>'backend/index/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Message:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error_reporter/message','default'=>'Message:','namespace'=>'backend/index/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + message);
            return !me.displayErrors;
        };

        Ext.Error.handle = function() {
            return !me.displayErrors;
        }
    }
});
//
<?php }} ?>