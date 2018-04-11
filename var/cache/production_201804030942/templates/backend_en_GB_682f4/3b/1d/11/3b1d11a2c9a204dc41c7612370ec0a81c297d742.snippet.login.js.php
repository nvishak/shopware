<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:42
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\account\login.js" */ ?>
<?php /*%%SmartyHeaderCode:314355acda8fed8c2a5-44949954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b1d11a2c9a204dc41c7612370ec0a81c297d742' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\account\\login.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '314355acda8fed8c2a5-44949954',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fedfcbf3_71841391',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fedfcbf3_71841391')) {function content_5acda8fedfcbf3_71841391($_smarty_tpl) {?>/**
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
 * @subpackage Account
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.account.Login', {
    extend: 'Ext.container.Container',

    cls: 'plugin-manager-login-window',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'login'/'title','default'=>'Already have an account?','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'title','default'=>'Already have an account?','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Login<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'title','default'=>'Already have an account?','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        shopwareId: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'login'/'shopwareId','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'shopwareId','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shopware ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'shopwareId','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        password: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'login'/'password','default'=>'Password','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'password','default'=>'Password','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'password','default'=>'Password','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        passwordMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'login'/'passwordMessage','default'=>'The passwords do not match.','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'passwordMessage','default'=>'The passwords do not match.','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The passwords do not match.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'passwordMessage','default'=>'The passwords do not match.','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        forgotPassword: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'login'/'forgotPassword','default'=>'Forgot your password?','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'forgotPassword','default'=>'Forgot your password?','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Forgot your password?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'forgotPassword','default'=>'Forgot your password?','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        forgotPasswordLink: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'login'/'forgotPasswordLink','default'=>'https://account.shopware.com/#/forgotPassword','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'forgotPasswordLink','default'=>'https://account.shopware.com/#/forgotPassword','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
https://account.shopware.com/#/forgotPassword<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'forgotPasswordLink','default'=>'https://account.shopware.com/#/forgotPassword','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        registerDomain: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'login'/'register_domain','default'=>'Register domain','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'register_domain','default'=>'Register domain','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Register domain<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'login'/'register_domain','default'=>'Register domain','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        cancelButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account/login/cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account/login/cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account/login/cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        loginButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account/login/login','default'=>'Login','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account/login/login','default'=>'Login','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Login<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account/login/login','default'=>'Login','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    width: 280,
    anchor: '100%',
    border: false,

    initComponent: function () {
        var me = this;

        me.items = [
            me.createForm()
        ];

        me.callParent(arguments);
    },

    createForgotLink: function () {
        var me = this;

        return Ext.create('Ext.Component', {
            html: '<a href="' + me.snippets.forgotPasswordLink + '" target="_blank">' + me.snippets.forgotPassword + '</a>',
            cls: 'forgot'
        });
    },

    createForm: function () {
        var me = this;

        me.formPanel = Ext.create('Ext.form.Panel', {
            border: false,
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            cls: 'form-panel',
            items: [
                me.createLoginText(),
                me.createShopwareIdField(),
                me.createPasswordField(),
                me.createForgotLink(),
                me.createRegisterDomainField(),
                me.createActionButtons()
            ]
        });

        return me.formPanel;
    },

    createLoginText: function() {
        var me = this;

        return {
            border: false,
            margin: '22 0 20 0',
            html: '<span class="section-title">' + me.snippets.title + '</span>'
        };
    },

    createActionButtons: function () {
        var me = this;

        me.registerButton = Ext.create('PluginManager.container.Container', {
            html: me.snippets.loginButton,
            cls: 'plugin-manager-action-button primary',
            margin: '0 0 0 0',
            handler: function () {
                me.applyLogin();
            }
        });

        me.actionButtons = Ext.create('Ext.container.Container', {
            margin: '10 0 0 0',
            padding: '10 0',
            width: 280,
            cls: 'action-buttons',
            items: [me.registerButton]
        });

        return me.actionButtons;

    },

    createRegisterDomainField: function() {
        var me = this;

        me.LoginRegisterDomain = Ext.create('Ext.form.field.Checkbox', {
            name: 'registerDomain',
            boxLabel: me.snippets.registerDomain,
            cls: 'input--field',
            labelWidth: 130,
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.applyLogin();
                    }
                }
            }
        });

        return me.LoginRegisterDomain;
    },

    createShopwareIdField: function () {
        var me = this;

        me.shopwareIdField = Ext.create('Ext.form.field.Text', {
            name: 'shopwareID',
            allowBlank: false,
            cls: 'input--field',
            emptyText: me.snippets.shopwareId,
            margin: '10 0',
            labelWidth: 130,
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.applyLogin();
                    }
                }
            }
        });

        return me.shopwareIdField;
    },

    createPasswordField: function () {
        var me = this;

        me.passwordField = Ext.create('Ext.form.field.Text', {
            name: 'password',
            allowBlank: false,
            labelWidth: 130,
            cls: 'input--field',
            emptyText: me.snippets.password,
            inputType: 'password',
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.applyLogin();
                    }
                }
            }
        });

        return me.passwordField;
    },

    applyLogin: function () {
        var me = this;

        if (!me.formPanel.getForm().isValid()) {
            return;
        }

        var loginData = me.formPanel.getForm().getValues();

        loginData.registerDomain = loginData.registerDomain === "on";
        loginData.shopwareId = loginData.shopwareID;

        Shopware.app.Application.fireEvent(
            'store-login',
            loginData,
            function () {
                me.callback();
            }
        );
    }
});
//<?php }} ?>