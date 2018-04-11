<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:18
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\Shopware.global.ErrorReporter.js" */ ?>
<?php /*%%SmartyHeaderCode:260015acda8e68001a8-14242869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a45544e63f65d97e7b31797dcd0c92e706149679' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\Shopware.global.ErrorReporter.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260015acda8e68001a8-14242869',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e696b0e7_85294981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e696b0e7_85294981')) {function content_5acda8e696b0e7_85294981($_smarty_tpl) {?>/**
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
 * @package    Shopware.global.ErrorReporter
 * @subpackage Controller
 * @version    $Id$
 * @author shopware AG
 */

//

//
Ext.define('Shopware.global.ErrorReporter', {

    /**
     * The parent class that this class extends
     *
     * @type String
     * @default Ext.app.Controller
     */
    extend: 'Ext.app.Controller',

    /**
     * Component main window
     *
     * @type Ext.window.Window
     * @default null
     */
    mainWindow: null,

    /**
     * Snippets which are used in the component.
     *
     * @type Object
     */
    snippets: {

        /**
         * General snippets e.g. titles, tab titles
         *
         * @type Object
         */
        general: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'general'/'title','default'=>'Shopware Error Reporter','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'title','default'=>'Shopware Error Reporter','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shopware Error Reporter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'title','default'=>'Shopware Error Reporter','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            error_title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'general'/'error_title','default'=>'Error information','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'error_title','default'=>'Error information','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'error_title','default'=>'Error information','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            browser_title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'general'/'browser_title','default'=>'Browser information','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'browser_title','default'=>'Browser information','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Browser information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'browser_title','default'=>'Browser information','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cancel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'general'/'cancel','default'=>'Cancel','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'cancel','default'=>'Cancel','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'general'/'cancel','default'=>'Cancel','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        /**
         * Specific snippets for XHR error reports.
         *
         * @type Object
         */
        xhr: {
            module: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'module','default'=>'Module','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'module','default'=>'Module','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Module<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'module','default'=>'Module','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            request_path: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'request_path','default'=>'Request path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'request_path','default'=>'Request path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Request path<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'request_path','default'=>'Request path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            http_error: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'http_error','default'=>'HTTP error message','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'http_error','default'=>'HTTP error message','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
HTTP error message<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'http_error','default'=>'HTTP error message','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            http_status: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'http_status','default'=>'HTTP status code','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'http_status','default'=>'HTTP status code','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
HTTP status code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'http_status','default'=>'HTTP status code','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            error_desc: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'error_desc','default'=>'Error description','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'error_desc','default'=>'Error description','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'error_desc','default'=>'Error description','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            module_files: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'module_files','default'=>'Module files','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'module_files','default'=>'Module files','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Module files<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'module_files','default'=>'Module files','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            class_name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'class_name','default'=>'Class name','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'class_name','default'=>'Class name','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Class name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'class_name','default'=>'Class name','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            path: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'path','default'=>'Path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'path','default'=>'Path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Path<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'path','default'=>'Path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            type: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'type','default'=>'Type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'type','default'=>'Type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'type','default'=>'Type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            unknown_type: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'unknown_type','default'=>'Unknown type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'unknown_type','default'=>'Unknown type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Unknown type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'unknown_type','default'=>'Unknown type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            reload_module: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'xhr'/'reload_module','default'=>'Reload module','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'reload_module','default'=>'Reload module','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Reload module<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'xhr'/'reload_module','default'=>'Reload module','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        /**
         * Specific snippets for eval error reports.
         *
         * @type Object
         */
        eval: {
            reload_admin: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'eval'/'reload_admin','default'=>'Reload administration','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'eval'/'reload_admin','default'=>'Reload administration','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Reload administration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'eval'/'reload_admin','default'=>'Reload administration','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            error_type: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'eval'/'error_type','default'=>'Error type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'eval'/'error_type','default'=>'Error type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'eval'/'error_type','default'=>'Error type','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            error_msg: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'eval'/'error_msg','default'=>'Error message','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'eval'/'error_msg','default'=>'Error message','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error message<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'eval'/'error_msg','default'=>'Error message','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        /**
         * Specific snippets the for browser information.
         *
         * @type Object
         */
        browser: {
            os: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'os','default'=>'Operating system','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'os','default'=>'Operating system','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Operating system<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'os','default'=>'Operating system','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            browser_engine: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'browser_engine','default'=>'Browser engine','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'browser_engine','default'=>'Browser engine','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Browser engine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'browser_engine','default'=>'Browser engine','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            window_size: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'window_size','default'=>'Window size','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'window_size','default'=>'Window size','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Window size<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'window_size','default'=>'Window size','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            java_enabled: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'java_enabled','default'=>'Java enabled','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'java_enabled','default'=>'Java enabled','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Java enabled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'java_enabled','default'=>'Java enabled','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cookies_enabled: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'cookie_enabled','default'=>'Cookies enabled','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'cookie_enabled','default'=>'Cookies enabled','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cookies enabled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'cookie_enabled','default'=>'Cookies enabled','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            lang: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'lang','default'=>'Language','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'lang','default'=>'Language','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Language<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'lang','default'=>'Language','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            plugins: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'plugins','default'=>'Browser plugins','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'plugins','default'=>'Browser plugins','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Browser plugins<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'plugins','default'=>'Browser plugins','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            plugin_name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'plugin_name','default'=>'Plugin name','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'plugin_name','default'=>'Plugin name','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'plugin_name','default'=>'Plugin name','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            plugin_path: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'browser'/'plugin_path','default'=>'Plugin path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'plugin_path','default'=>'Plugin path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin path<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'browser'/'plugin_path','default'=>'Plugin path','namespace'=>'backend/base/component/Shopware.global.ErrorReporter'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Initializes the event listener. Please note that
     * this method will be fired in the `launch()`-method
     * of the global `Shopware.app.Application`
     *
     * @param { Shopware.app.Application } cmp - Application which fires the event
     * @returns { Void }
     */
    bindEvents: function(cmp) {
        var me = this;
        cmp.on('Ext.Loader:xhrFailed', me.onXhrErrorOccurs, me);
        cmp.on('Ext.Loader:evalFailed', me.onEvalErrorOccurs, me);
    },

    /**
     * Event listener method which will be fired when the loader couldn't
     * load a module properly.
     *
     * @this Shopware.global.ErrorReporter
     * @event Ext.Loader:xhrFailed
     * @param { XMLHttpRequest } xhr
     * @param { Object } namespace
     * @param { String } requestType
     * @returns { Void }
     */
    onXhrErrorOccurs: function(xhr, namespace, requestType) {
        var me = this;

        me.mainWindow = Ext.create('Ext.window.Window', {
            width: 800,
            height: 600,
            modal: true,
            title: me.snippets.general.title,
            dockedItems: [ me.createActionToolbar(namespace, true) ] ,
            renderTo: Ext.getBody(),
            items: [{
                xtype: 'tabpanel',
                defaults: { bodyPadding: 15 },
                items: [{
                    title: me.snippets.general.error_title,
                    items: [
                        me.createErrorInformation(xhr, namespace, requestType),
                        me.createErrorDescription(xhr),
                        me.createErrorFilesList(namespace)
                    ]
                }, {
                    title: me.snippets.general.browser_title,
                    items: [
                        me.createBrowserInformation(),
                        me.createUserAgentInformation(),
                        me.createBrowserPluginList()
                    ]
                }]
            }]
        }).show();
    },

    /**
     * Event listener method which will be called when the loader
     * couldn't evaluate a module to due parser errors.
     *
     * @this Shopware.global.ErrorReporter
     * @event Ext.Loader:evalFailed
     * @param { Error } err
     * @param { XMLHttpRequest } xhr
     * @param { Object } namespace
     * @param { String } requestType
     */
    onEvalErrorOccurs: function(err, xhr, namespace, requestType) {
        var me = this;

        me.mainWindow = Ext.create('Ext.window.Window', {
            width: 800,
            height: 600,
            modal: true,
            title: me.snippets.general.title,
            dockedItems: [ me.createActionToolbar(namespace, false) ] ,
            renderTo: Ext.getBody(),
            items: [{
                xtype: 'tabpanel',
                defaults: { bodyPadding: 15 },
                items: [{
                    title: me.snippets.general.error_title,
                    items: [
                        me.createEvalErrorInformation(err, xhr, namespace, requestType),
                        me.createEvalErrorDescription(err),
                        me.createErrorFilesList(namespace)
                    ]
                }, {
                    title: me.snippets.general.browser_title,
                    items: [
                        me.createBrowserInformation(),
                        me.createUserAgentInformation(),
                        me.createBrowserPluginList()
                    ]
                }]
            }]
        }).show();
    },

    /**
     * Creates the basic error information fieldset
     *
     * @param { XMLHttpRequest } xhr
     * @param { Object } namespace
     * @param { String } requestType
     * @returns { Object } fieldset configuration object
     */
    createErrorInformation: function(xhr, namespace, requestType) {
        var me = this;

        return {
            xtype: 'fieldset',
            title: me.snippets.general.error_title,
            layout: 'column',
            defaults: { xtype: 'container', columnWidth: 0.5, layout: 'anchor', defaults: {
                anchor: '100%', readOnly: true, xtype: 'displayfield', labelWidth: 155, labelStyle: 'margin-top: 0'
            } },
            items: [{
                items: [{
                    fieldLabel: me.snippets.xhr.module,
                    value: namespace.prefix
                }, {
                    fieldLabel: me.snippets.xhr.request_path,
                    value: namespace.path
                }]
            }, {
                margin: '0 0 0 15',
                items: [{
                    fieldLabel: me.snippets.xhr.http_error,
                    value: xhr.statusText
                }, {
                    fieldLabel: me.snippets.xhr.http_status,
                    value: Ext.String.format('[0] / [1]', xhr.status, requestType.toUpperCase())
                }]
            }]
        };
    },

    /**
     * Creates a fieldset with the error description
     *
     * @param { XMLHttpRequest } xhr
     * @returns { Object } fieldset configuration object
     */
    createErrorDescription: function(xhr) {
        var me = this;

        return {
            xtype: 'fieldset',
            title: me.snippets.xhr.error_desc,
            layout: 'anchor',
            height: 175,
            items: [{
                xtype: 'textarea',
                anchor: '100%',
                height: 125,
                value: xhr.responseText
            }]
        }
    },

    /**
     * Creates a grid (with the associated column model and store) which
     * displays the loaded files, grouped by it's type.
     *
     * @param { Object } namespace
     * @returns { Object } Grid panel configuration
     */
    createErrorFilesList: function(namespace) {
        var data = [], me = this, store;

        var getFileType = function(path) {
            var regEx = /^([a-zA-Z]+)\//,
                result = regEx.exec(path);

            if(!result) {
                return me.snippets.xhr.unknown_type;
            }

            result = result[1];
            return result.charAt(0).toUpperCase() + result.slice(1);
        };

        Ext.each(namespace.classNames, function(cls, i) {
            data.push({
                id: i + 1,
                name: cls,
                path: namespace.files[i],
                type: getFileType(namespace.files[i])
            });
        });

        store = Ext.create('Ext.data.Store', {
            fields: [ 'id', 'name', 'path', 'type' ],
            groupField: 'type',
            data: data
        });

        return {
            xtype: 'gridpanel',
            store: store,
            title: me.snippets.xhr.module_files,
            height: 175,
            features: [{
                ftype:'grouping',
                groupHeaderTpl: '{name} ({rows.length})'
            }],
            columns: [{
                dataIndex: 'id',
                header: '#',
                width: 35
            }, {
                dataIndex: 'name',
                header: me.snippets.xhr.class_name,
                flex: 1,
                renderer: function(val) {
                    return '<strong>' + val + '</strong>';
                }
            }, {
                dataIndex: 'path',
                header: me.snippets.xhr.path,
                flex: 1
            }, {
                dataIndex: 'type',
                header: me.snippets.xhr.type,
                flex: 1
            }]
        };
    },

    /**
     * Creates a toolbar with action buttons which is located
     * at the bottom of the window.
     *
     * @param { Object } namespace
     * @returns { Ext.toolbar.Toolbar } Instance of the Ext.toolbar.Toolbar
     */
    createActionToolbar: function(namespace, showReload) {
        var me = this, reloadButton, toolbar;

        reloadButton = Ext.create('Ext.button.Button', {
            text: me.snippets.xhr.reload_module,
            cls: 'primary',
            handler: function() {
                Ext.require(namespace.classNames);
                me.mainWindow.destroy();
            }
        });

        toolbar = Ext.create('Ext.toolbar.Toolbar', {
            dock: 'bottom',
            padding: 5,
            items: [ '->', {
                xtype: 'button',
                text: me.snippets.general.cancel,
                cls: 'secondary',
                handler: function() {
                    me.mainWindow.destroy();
                }
            }]
        });

        if(showReload) {
            toolbar.add(reloadButton);
        } else {
            toolbar.add({
                xtype: 'button',
                text: me.snippets.eval.reload_admin,
                cls: 'primary',
                handler: function() {
                    window.location.reload();
                }
            });
        }

        return toolbar;
    },

    /**
     * Creates the eval error information fieldset
     *
     * @param { Error } err
     * @param { XMLHttpRequest } xhr
     * @param { Object } namespace
     * @returns { Object } fieldset configuration object
     */
    createEvalErrorInformation: function(err, xhr, namespace) {
        var me = this;

        return {
            xtype: 'fieldset',
            title: me.snippets.general.error_title,
            layout: 'column',
            defaults: { xtype: 'container', columnWidth: 0.5, layout: 'anchor', defaults: {
                anchor: '100%', readOnly: true, xtype: 'displayfield', labelWidth: 155, labelStyle: 'margin-top: 0'
            } },
            items: [{
                items: [{
                    fieldLabel: me.snippets.xhr.module,
                    value: namespace.prefix
                }, {
                    fieldLabel: me.snippets.xhr.request_path,
                    value: namespace.path
                }]
            }, {
                margin: '0 0 0 15',
                items: [{
                    fieldLabel: me.snippets.eval.error_type,
                    value: err.name
                }, {
                    fieldLabel: me.snippets.eval.error_msg,
                    value: err.message
                }]
            }]
        };
    },

    /**
     * Creates a fieldset which displays the stack trace.
     *
     * @param { Error } err
     * @returns { Object } Fieldset configuration
     */
    createEvalErrorDescription: function(err) {
        return {
            xtype: 'fieldset',
            title: 'Stack-Trace',
            layout: 'anchor',
            height: 175,
            items: [{
                xtype: 'textarea',
                anchor: '100%',
                height: 125,
                value: err.stack
            }]
        }
    },

    /**
     * Creates a textarea which contains the user agent.
     *
     * @returns { Object } Fieldset configuration
     */
    createUserAgentInformation: function() {
        return {
            xtype: 'fieldset',
            title: 'User-Agent',
            layout: 'anchor',
            height: 125,
            items: [{
                xtype: 'textarea',
                anchor: '100%',
                height: 75,
                value: navigator.userAgent
            }]
        }
    },

    /**
     * Provides basic informations about the used browser.
     *
     * @returns { Object } Fieldset configuration
     */
    createBrowserInformation: function() {
        var me = this, uaParser = new UAParser(), uaResult = uaParser.getResult();

        return {
            xtype: 'fieldset',
            title: me.snippets.general.browser_title,
            layout: 'column',
            defaults: { xtype: 'container', columnWidth: 0.5, layout: 'anchor', defaults: {
                anchor: '100%', readOnly: true, xtype: 'displayfield', labelWidth: 155, labelStyle: 'margin-top: 0'
            } },
            items: [{
                items: [{
                    fieldLabel: 'Browser',
                    value: Ext.String.format('[0] [1]', uaResult.browser.name || 'No data', uaResult.browser.version || 'No data')
                }, {
                    fieldLabel: me.snippets.browser.browser_engine,
                    value: Ext.String.format('[0] [1]', uaResult.engine.name || 'No data', uaResult.engine.version || 'No data')
                }, {
                    fieldLabel: me.snippets.browser.os,
                    value: Ext.String.format('[0] [1]', uaResult.os.name || 'No data', uaResult.os.version || 'No data')
                }, {
                    fieldLabel: 'ExtJS',
                    value: Ext.versions.extjs.version
                }]
            }, {
                margin: '0 0 0 15',
                items: [{
                    fieldLabel: me.snippets.browser.window_size,
                    value: Ext.String.format('[0]x[1] Pixel', window.outerWidth, window.outerHeight)
                }, {
                    xtype: 'checkbox',
                    labelStyle: 'margin-top: 5px',
                    fieldLabel: me.snippets.browser.java_enabled,
                    checked: !!navigator.javaEnabled()
                }, {
                    xtype: 'checkbox',
                    labelStyle: 'margin-top: 5px',
                    fieldLabel: me.snippets.browser.cookies_enabled,
                    checked: !!navigator.cookieEnabled
                }, {
                    fieldLabel: me.snippets.browser.lang,
                    value: navigator.language || navigator.userLanguage
                }]
            }]
        };
    },

    /**
     * Creates a list which contains all available browser plugins.
     *
     * @returns { Object } Grid panel configuration
     */
    createBrowserPluginList: function() {
        var me = this, data = [], store;

        Ext.each(navigator.plugins, function(plugin, i) {
            data.push({
                id: i + 1,
                name: plugin.description || plugin.name,
                path: plugin.filename
            });
        });

        store = Ext.create('Ext.data.Store', {
            fields: [ 'id', 'name', 'path' ],
            data: data
        });

        return {
            xtype: 'gridpanel',
            store: store,
            title: me.snippets.browser.plugins,
            height: 175,
            columns: [{
                dataIndex: 'id',
                header: '#',
                width: 35
            }, {
                dataIndex: 'name',
                header: me.snippets.browser.plugin_name,
                flex: 1,
                renderer: function(val) {
                    return '<strong>' + val + '</strong>';
                }
            }, {
                dataIndex: 'path',
                header: me.snippets.browser.plugin_path,
                flex: 1
            }]
        };
    }
});

/**
 * UAParser.js
 *
 * Lightweight JavaScript-based User-Agent string parser.
 *
 * Extract detailed type of web browser, layout engine, operating system, cpu architecture, and device purely from user-agent string with relatively lightweight footprint (~7KB minified / ~3KB gzipped). Written in vanilla js, which means it doesn't depends on any other library.
 *
 * @repository https://github.com/faisalman/ua-parser-js
 * @author Faisalman <fyzlman@gmail.com>
 * @license Dual licensed under GPLv2 & MIT (https://github.com/faisalman/ua-parser-js#license
 */
//
!function(window,undefined){"use strict";var EMPTY="",UNKNOWN="?",FUNC_TYPE="function",UNDEF_TYPE="undefined",OBJ_TYPE="object",MAJOR="major",MODEL="model",NAME="name",TYPE="type",VENDOR="vendor",VERSION="version",ARCHITECTURE="architecture",CONSOLE="console",MOBILE="mobile",TABLET="tablet";var util={has:function(str1,str2){return str2.toLowerCase().indexOf(str1.toLowerCase())!==-1},lowerize:function(str){return str.toLowerCase()}};var mapper={rgx:function(){for(var result,i=0,j,k,p,q,matches,match,args=arguments;i<args.length;i+=2){var regex=args[i],props=args[i+1];if(typeof result===UNDEF_TYPE){result={};for(p in props){q=props[p];if(typeof q===OBJ_TYPE){result[q[0]]=undefined}else{result[q]=undefined}}}for(j=k=0;j<regex.length;j++){matches=regex[j].exec(this.getUA());if(!!matches){for(p in props){match=matches[++k];q=props[p];if(typeof q===OBJ_TYPE&&q.length>0){if(q.length==2){if(typeof q[1]==FUNC_TYPE){result[q[0]]=q[1].call(this,match)}else{result[q[0]]=q[1]}}else if(q.length==3){if(typeof q[1]===FUNC_TYPE&&!(q[1].exec&&q[1].test)){result[q[0]]=match?q[1].call(this,match,q[2]):undefined}else{result[q[0]]=match?match.replace(q[1],q[2]):undefined}}else if(q.length==4){result[q[0]]=match?q[3].call(this,match.replace(q[1],q[2])):undefined}}else{result[q]=match?match:undefined}}break}}if(!!matches)break}return result},str:function(str,map){for(var i in map){if(typeof map[i]===OBJ_TYPE&&map[i].length>0){for(var j=0;j<map[i].length;j++){if(util.has(map[i][j],str)){return i===UNKNOWN?undefined:i}}}else if(util.has(map[i],str)){return i===UNKNOWN?undefined:i}}return str}};var maps={browser:{oldsafari:{major:{1:["/8","/1","/3"],2:"/4","?":"/"},version:{"1.0":"/8",1.2:"/1",1.3:"/3","2.0":"/412","2.0.2":"/416","2.0.3":"/417","2.0.4":"/419","?":"/"}}},device:{sprint:{model:{"Evo Shift 4G":"7373KT"},vendor:{HTC:"APA",Sprint:"Sprint"}}},os:{windows:{version:{ME:"4.90","NT 3.11":"NT3.51","NT 4.0":"NT4.0",2000:"NT 5.0",XP:["NT 5.1","NT 5.2"],Vista:"NT 6.0",7:"NT 6.1",8:"NT 6.2",RT:"ARM"}}}};var regexes={browser:[[/(opera\smini)\/((\d+)?[\w\.-]+)/i,/(opera\s[mobiletab]+).+version\/((\d+)?[\w\.-]+)/i,/(opera).+version\/((\d+)?[\w\.]+)/i,/(opera)[\/\s]+((\d+)?[\w\.]+)/i],[NAME,VERSION,MAJOR],[/\s(opr)\/((\d+)?[\w\.]+)/i],[[NAME,"Opera"],VERSION,MAJOR],[/(kindle)\/((\d+)?[\w\.]+)/i,/(lunascape|maxthon|netfront|jasmine|blazer)[\/\s]?((\d+)?[\w\.]+)*/i,/(avant\s|iemobile|slim|baidu)(?:browser)?[\/\s]?((\d+)?[\w\.]*)/i,/(?:ms|\()(ie)\s((\d+)?[\w\.]+)/i,/(rekonq)((?:\/)[\w\.]+)*/i,/(chromium|flock|rockmelt|midori|epiphany|silk|skyfire|ovibrowser|bolt)\/((\d+)?[\w\.-]+)/i],[NAME,VERSION,MAJOR],[/(yabrowser)\/((\d+)?[\w\.]+)/i],[[NAME,"Yandex"],VERSION,MAJOR],[/(comodo_dragon)\/((\d+)?[\w\.]+)/i],[[NAME,/_/g," "],VERSION,MAJOR],[/(chrome|omniweb|arora|[tizenoka]{5}\s?browser)\/v?((\d+)?[\w\.]+)/i],[NAME,VERSION,MAJOR],[/(dolfin)\/((\d+)?[\w\.]+)/i],[[NAME,"Dolphin"],VERSION,MAJOR],[/((?:android.+)crmo|crios)\/((\d+)?[\w\.]+)/i],[[NAME,"Chrome"],VERSION,MAJOR],[/version\/((\d+)?[\w\.]+).+?mobile\/\w+\s(safari)/i],[VERSION,MAJOR,[NAME,"Mobile Safari"]],[/version\/((\d+)?[\w\.]+).+?(mobile\s?safari|safari)/i],[VERSION,MAJOR,NAME],[/webkit.+?(mobile\s?safari|safari)((\/[\w\.]+))/i],[NAME,[MAJOR,mapper.str,maps.browser.oldsafari.major],[VERSION,mapper.str,maps.browser.oldsafari.version]],[/(konqueror)\/((\d+)?[\w\.]+)/i,/(webkit|khtml)\/((\d+)?[\w\.]+)/i],[NAME,VERSION,MAJOR],[/(navigator|netscape)\/((\d+)?[\w\.-]+)/i],[[NAME,"Netscape"],VERSION,MAJOR],[/(swiftfox)/i,/(iceweasel|camino|chimera|fennec|maemo\sbrowser|minimo|conkeror)[\/\s]?((\d+)?[\w\.\+]+)/i,/(firefox|seamonkey|k-meleon|icecat|iceape|firebird|phoenix)\/((\d+)?[\w\.-]+)/i,/(mozilla)\/((\d+)?[\w\.]+).+rv\:.+gecko\/\d+/i,/(uc\s?browser|polaris|lynx|dillo|icab|doris|amaya|w3m|netsurf)[\/\s]?((\d+)?[\w\.]+)/i,/(links)\s\(((\d+)?[\w\.]+)/i,/(gobrowser)\/?((\d+)?[\w\.]+)*/i,/(ice\s?browser)\/v?((\d+)?[\w\._]+)/i,/(mosaic)[\/\s]((\d+)?[\w\.]+)/i],[NAME,VERSION,MAJOR]],cpu:[[/(?:(amd|x(?:(?:86|64)[_-])?|wow|win)64)[;\)]/i],[[ARCHITECTURE,"amd64"]],[/((?:i[346]|x)86)[;\)]/i],[[ARCHITECTURE,"ia32"]],[/windows\s(ce|mobile);\sppc;/i],[[ARCHITECTURE,"arm"]],[/((?:ppc|powerpc)(?:64)?)(?:\smac|;|\))/i],[[ARCHITECTURE,/ower/,"",util.lowerize]],[/(sun4\w)[;\)]/i],[[ARCHITECTURE,"sparc"]],[/(ia64(?=;)|68k(?=\))|arm(?=v\d+;)|(?:irix|mips|sparc)(?:64)?(?=;)|pa-risc)/i],[ARCHITECTURE,util.lowerize]],device:[[/\((ipad|playbook);[\w\s\);-]+(rim|apple)/i],[MODEL,VENDOR,[TYPE,TABLET]],[/(hp).+(touchpad)/i,/(kindle)\/([\w\.]+)/i,/\s(nook)[\w\s]+build\/(\w+)/i,/(dell)\s(strea[kpr\s\d]*[\dko])/i],[VENDOR,MODEL,[TYPE,TABLET]],[/\((ip[honed]+);.+(apple)/i],[MODEL,VENDOR,[TYPE,MOBILE]],[/(blackberry)[\s-]?(\w+)/i,/(blackberry|benq|palm(?=\-)|sonyericsson|acer|asus|dell|huawei|meizu|motorola)[\s_-]?([\w-]+)*/i,/(hp)\s([\w\s]+\w)/i,/(asus)-?(\w+)/i],[VENDOR,MODEL,[TYPE,MOBILE]],[/\((bb10);\s(\w+)/i],[[VENDOR,"BlackBerry"],MODEL,[TYPE,MOBILE]],[/android.+((transfo[prime\s]{4,10}\s\w+|eeepc|slider\s\w+))/i],[[VENDOR,"Asus"],MODEL,[TYPE,TABLET]],[/(sony)\s(tablet\s[ps])/i],[VENDOR,MODEL,[TYPE,TABLET]],[/(nintendo)\s([wids3u]+)/i],[VENDOR,MODEL,[TYPE,CONSOLE]],[/((playstation)\s[3portablevi]+)/i],[[VENDOR,"Sony"],MODEL,[TYPE,CONSOLE]],[/(sprint\s(\w+))/i],[[VENDOR,mapper.str,maps.device.sprint.vendor],[MODEL,mapper.str,maps.device.sprint.model],[TYPE,MOBILE]],[/(htc)[;_\s-]+([\w\s]+(?=\))|\w+)*/i,/(zte)-(\w+)*/i,/(alcatel|geeksphone|huawei|lenovo|nexian|panasonic|(?=;\s)sony)[_\s-]?([\w-]+)*/i],[VENDOR,[MODEL,/_/g," "],[TYPE,MOBILE]],[/\s((milestone|droid[2x]?))[globa\s]*\sbuild\//i,/(mot)[\s-]?(\w+)*/i],[[VENDOR,"Motorola"],MODEL,[TYPE,MOBILE]],[/android.+\s((mz60\d|xoom[\s2]{0,2}))\sbuild\//i],[[VENDOR,"Motorola"],MODEL,[TYPE,TABLET]],[/android.+((sch-i[89]0\d|shw-m380s|gt-p\d{4}|gt-n8000|sgh-t8[56]9))/i],[[VENDOR,"Samsung"],MODEL,[TYPE,TABLET]],[/((s[cgp]h-\w+|gt-\w+|galaxy\snexus))/i,/(sam[sung]*)[\s-]*(\w+-?[\w-]*)*/i,/sec-((sgh\w+))/i],[[VENDOR,"Samsung"],MODEL,[TYPE,MOBILE]],[/(sie)-(\w+)*/i],[[VENDOR,"Siemens"],MODEL,[TYPE,MOBILE]],[/(maemo|nokia).*(n900|lumia\s\d+)/i,/(nokia)[\s_-]?([\w-]+)*/i],[[VENDOR,"Nokia"],MODEL,[TYPE,MOBILE]],[/android\s3\.[\s\w-;]{10}((a\d{3}))/i],[[VENDOR,"Acer"],MODEL,[TYPE,TABLET]],[/android\s3\.[\s\w-;]{10}(lg?)-([06cv9]{3,4})/i],[[VENDOR,"LG"],MODEL,[TYPE,TABLET]],[/((nexus\s4))/i,/(lg)[e;\s-\/]+(\w+)*/i],[[VENDOR,"LG"],MODEL,[TYPE,MOBILE]],[/(mobile|tablet);.+rv\:.+gecko\//i],[TYPE,VENDOR,MODEL]],engine:[[/(presto)\/([\w\.]+)/i,/(webkit|trident|netfront|netsurf|amaya|lynx|w3m)\/([\w\.]+)/i,/(khtml|tasman|links)[\/\s]\(?([\w\.]+)/i,/(icab)[\/\s]([23]\.[\d\.]+)/i],[NAME,VERSION],[/rv\:([\w\.]+).*(gecko)/i],[VERSION,NAME]],os:[[/(windows)\snt\s6\.2;\s(arm)/i,/(windows\sphone(?:\sos)*|windows\smobile|windows)[\s\/]?([ntce\d\.\s]+\w)/i],[NAME,[VERSION,mapper.str,maps.os.windows.version]],[/(win(?=3|9|n)|win\s9x\s)([nt\d\.]+)/i],[[NAME,"Windows"],[VERSION,mapper.str,maps.os.windows.version]],[/\((bb)(10);/i],[[NAME,"BlackBerry"],VERSION],[/(blackberry)\w*\/?([\w\.]+)*/i,/(tizen)\/([\w\.]+)/i,/(android|webos|palm\os|qnx|bada|rim\stablet\sos|meego)[\/\s-]?([\w\.]+)*/i],[NAME,VERSION],[/(symbian\s?os|symbos|s60(?=;))[\/\s-]?([\w\.]+)*/i],[[NAME,"Symbian"],VERSION],[/mozilla.+\(mobile;.+gecko.+firefox/i],[[NAME,"Firefox OS"],VERSION],[/(nintendo|playstation)\s([wids3portablevu]+)/i,/(mint)[\/\s\(]?(\w+)*/i,/(joli|[kxln]?ubuntu|debian|[open]*suse|gentoo|arch|slackware|fedora|mandriva|centos|pclinuxos|redhat|zenwalk)[\/\s-]?([\w\.-]+)*/i,/(hurd|linux)\s?([\w\.]+)*/i,/(gnu)\s?([\w\.]+)*/i],[NAME,VERSION],[/(cros)\s[\w]+\s([\w\.]+\w)/i],[[NAME,"Chromium OS"],VERSION],[/(sunos)\s?([\w\.]+\d)*/i],[[NAME,"Solaris"],VERSION],[/\s([frentopc-]{0,4}bsd|dragonfly)\s?([\w\.]+)*/i],[NAME,VERSION],[/(ip[honead]+)(?:.*os\s*([\w]+)*\slike\smac|;\sopera)/i],[[NAME,"iOS"],[VERSION,/_/g,"."]],[/(mac\sos\sx)\s?([\w\s\.]+\w)*/i],[NAME,[VERSION,/_/g,"."]],[/(haiku)\s(\w+)/i,/(aix)\s((\d)(?=\.|\)|\s)[\w\.]*)*/i,/(macintosh|mac(?=_powerpc)|plan\s9|minix|beos|os\/2|amigaos|morphos|risc\sos)/i,/(unix)\s?([\w\.]+)*/i],[NAME,VERSION]]};var UAParser=function(uastring){var ua=uastring||(window&&window.navigator&&window.navigator.userAgent?window.navigator.userAgent:EMPTY);if(!(this instanceof UAParser)){return new UAParser(uastring).getResult()}this.getBrowser=function(){return mapper.rgx.apply(this,regexes.browser)};this.getCPU=function(){return mapper.rgx.apply(this,regexes.cpu)};this.getDevice=function(){return mapper.rgx.apply(this,regexes.device)};this.getEngine=function(){return mapper.rgx.apply(this,regexes.engine)};this.getOS=function(){return mapper.rgx.apply(this,regexes.os)};this.getResult=function(){return{ua:this.getUA(),browser:this.getBrowser(),engine:this.getEngine(),os:this.getOS(),device:this.getDevice(),cpu:this.getCPU()}};this.getUA=function(){return ua};this.setUA=function(uastring){ua=uastring;return this};this.setUA(ua)};if(typeof exports!==UNDEF_TYPE){if(typeof module!==UNDEF_TYPE&&module.exports){exports=module.exports=UAParser}exports.UAParser=UAParser}else{window.UAParser=UAParser;if(typeof define===FUNC_TYPE&&define.amd){define(function(){return UAParser})}if(typeof window.jQuery!==UNDEF_TYPE){var $=window.jQuery;var parser=new UAParser;$.ua=parser.getResult();$.ua.get=function(){return parser.getUA()};$.ua.set=function(uastring){parser.setUA(uastring);var result=parser.getResult();for(var prop in result){$.ua[prop]=result[prop]}}}}}(this);
//

//
<?php }} ?>