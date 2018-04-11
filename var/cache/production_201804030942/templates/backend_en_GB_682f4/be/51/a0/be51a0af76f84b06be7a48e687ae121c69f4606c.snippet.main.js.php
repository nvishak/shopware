<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:48
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\login\controller\main.js" */ ?>
<?php /*%%SmartyHeaderCode:199895acd97e807b1b2-84735956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be51a0af76f84b06be7a48e687ae121c69f4606c' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\login\\controller\\main.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199895acd97e807b1b2-84735956',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e80e4731_94444213',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e80e4731_94444213')) {function content_5acd97e80e4731_94444213($_smarty_tpl) {?>/**
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
 * @subpackage Controller
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Login - Login Controller
 *
 * todo@all: Documentation
 */
Ext.define('Shopware.apps.Login.controller.Main', {

    /**
     * Extend from the standard ExtJS 4 controller
     * @string
     */
    extend: 'Ext.app.Controller',

    /**
     * Creates the necessary event listener for this
     * specific controller and opens a new Ext.window.Window
     * to display the subapplication
     *
     * @return void
     */
    init: function() {
        var me = this;

        me.control({

            // Event listener to submit the form using the "ENTER"-key
            'login-main-form textfield': {
                specialkey: function(field, event) {
                    var form = field.up('form'),
                        btn = form.down('button');

                    if(event.getKey() !== event.ENTER) {
                        return false;
                    }
                    me.onLogin(btn);
                }
            },
            'login-main-form button[action=login]': {
                click: me.onLogin
            }
        });

        this.mainWindow = this.getView('Main').create({
            items: [ this.getView('main.Form').create({
                localeStore: this.getStore('Locale')
            }) ]
        }).show();
    },

    /**
     * Event listener method which handles the login process
     *
     * @param [object] btn - pressed Ext.button.Button
     * @return void
     */
    onLogin: function(btn) {
        var me = this,
            win = btn.up('window'),
            formPnl = win.down('form'),
            form = formPnl.getForm(),
            values = form.getValues();

        if(!form.isValid() || !values.password.length || !values.username.length) {
            return false;
        }
        form.submit({
            url: '<?php echo '/shopware4/backend/Login/login';?>',
            waitMsg: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'wait'/'message','default'=>'Login...','namespace'=>'backend/login/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wait'/'message','default'=>'Login...','namespace'=>'backend/login/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Login...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wait'/'message','default'=>'Login...','namespace'=>'backend/login/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            success: function(form, action) {
                window.location.href = window.location.href;
            },
            failure: function(form, action) {
                var lockedUntil, message;
                if(action.result.lockedUntil) {
                    action.result.lockedUntil = new Date(action.result.lockedUntil);
                    message = "<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'failure'/'locked_message','default'=>'Der Account ist bis zum [lockedUntil:date] um [lockedUntil:date(\'H:i:s\')] Uhr gesperrt.','namespace'=>'backend/login/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'locked_message','default'=>'Der Account ist bis zum [lockedUntil:date] um [lockedUntil:date(\'H:i:s\')] Uhr gesperrt.','namespace'=>'backend/login/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The account is frozen until [lockedUntil:date] by [lockedUntil:date('H:i:s')].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'locked_message','default'=>'Der Account ist bis zum [lockedUntil:date] um [lockedUntil:date(\'H:i:s\')] Uhr gesperrt.','namespace'=>'backend/login/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
";
                    message = new Ext.Template(message);
                    message = message.applyTemplate(action.result);
                } else {
                    message = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'failure'/'input_message','default'=>'Bitte überprüfen Sie Ihre Eingabe und probieren es erneut.','namespace'=>'backend/login/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'input_message','default'=>'Bitte überprüfen Sie Ihre Eingabe und probieren es erneut.','namespace'=>'backend/login/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please check your input and try again.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'input_message','default'=>'Bitte überprüfen Sie Ihre Eingabe und probieren es erneut.','namespace'=>'backend/login/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
                }
                Ext.Msg.alert('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'failure'/'title','default'=>'Login fehlgeschlagen','namespace'=>'backend/login/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'title','default'=>'Login fehlgeschlagen','namespace'=>'backend/login/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Login failed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'title','default'=>'Login fehlgeschlagen','namespace'=>'backend/login/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'failure'/'message','default'=>'Ihr Login war nicht erfolgreich. ','namespace'=>'backend/login/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'message','default'=>'Ihr Login war nicht erfolgreich. ','namespace'=>'backend/login/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Your login was not successful.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'failure'/'message','default'=>'Ihr Login war nicht erfolgreich. ','namespace'=>'backend/login/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' + message);
                return false;
            }
        });
    }
});
<?php }} ?>