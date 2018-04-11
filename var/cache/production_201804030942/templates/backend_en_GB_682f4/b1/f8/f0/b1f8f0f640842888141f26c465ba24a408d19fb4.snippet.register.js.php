<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:43
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\account\register.js" */ ?>
<?php /*%%SmartyHeaderCode:45455acda8ff0454c1-77377161%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1f8f0f640842888141f26c465ba24a408d19fb4' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\account\\register.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45455acda8ff0454c1-77377161',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ff0dfd90_52482221',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ff0dfd90_52482221')) {function content_5acda8ff0dfd90_52482221($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.PluginManager.view.account.Register', {
    extend: 'Ext.container.Container',

    cls: 'plugin-manager-login-window',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'title','default'=>'New to Shopware?','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'title','default'=>'New to Shopware?','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Register<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'title','default'=>'New to Shopware?','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        shopwareId: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'shopwareId','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'shopwareId','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shopware ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'shopwareId','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        password: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'password','default'=>'Password','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'password','default'=>'Password','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'password','default'=>'Password','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        passwordMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'passwordMessage','default'=>'The passwords do not match.','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'passwordMessage','default'=>'The passwords do not match.','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The passwords do not match.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'passwordMessage','default'=>'The passwords do not match.','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        confirmPassword: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'confirmPassword','default'=>'Confirm password','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'confirmPassword','default'=>'Confirm password','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Confirm password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'confirmPassword','default'=>'Confirm password','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        email: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'email','default'=>'Email','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'email','default'=>'Email','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Email<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'email','default'=>'Email','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        registerButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'register_button','default'=>'Register','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'register_button','default'=>'Register','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Register<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'register_button','default'=>'Register','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        cancelButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'cancel_button','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'cancel_button','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'cancel_button','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        registerDomain: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'account'/'register'/'register_domain','default'=>'Register domain','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'register_domain','default'=>'Register domain','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Register domain<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'account'/'register'/'register_domain','default'=>'Register domain','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    width: 400,
    border: false,
    layout: 'fit',

    initComponent: function () {
        var me = this;

        me.items = [
            me.createFormPanel()
        ];

        me.callParent(arguments);
    },

    createFormPanel: function () {
        var me = this;

        me.formPanel = Ext.create('Ext.form.Panel', {
            border: false,
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            cls: 'form-panel',
            items: [
                me.createRegisterText(),
                me.createShopwareIdField(),
                me.createPasswordField(),
                me.createPasswordConfirmationField(),
                me.createEmailField(),
                me.createRegisterDomainCheckbox(),
                me.createActionButtons()
            ]
        });

        return me.formPanel;
    },

    createRegisterText: function () {
        var me = this;

        me.newRegistrationRegisterText = {
            border: false,
            margin: '0 0 20 0',
            html: '<span class="section-title">' + me.snippets.title + '</span>'
        };

        return me.newRegistrationRegisterText;
    },

    createShopwareIdField: function () {
        var me = this;

        me.newRegistrationShopwareId = Ext.create('Ext.form.field.Text', {
            name: 'shopwareID',
            allowBlank: false,
            cls: 'input--field',
            emptyText: me.snippets.shopwareId,
            required: true,
            enableKeyEvents: true,
            checkChangeBuffer: 700,
            margin: '10 0',
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.sendRegisterForm();
                    }
                }
            }
        });

        return me.newRegistrationShopwareId;
    },

    createPasswordField: function () {
        var me = this;

        me.newRegistrationPasswordField = Ext.create('Ext.form.field.Text', {
            name: 'password',
            inputType: 'password',
            emptyText: me.snippets.password,
            allowBlank: false,
            required: true,
            cls: Ext.baseCSSPrefix + 'password-field input--field',
            minLength: 5,
            validator: function (value) {
                if (Ext.String.trim(value) === Ext.String.trim(me.newRegistrationPasswordConfirmationField.getValue())) {
                    me.newRegistrationPasswordConfirmationField.clearInvalid();
                    return true;
                } else {
                    return me.snippets.passwordMessage;
                }
            },
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.sendRegisterForm();
                    }
                }
            }
        });

        return me.newRegistrationPasswordField;
    },

    createPasswordConfirmationField: function () {
        var me = this;

        me.newRegistrationPasswordConfirmationField = Ext.create('Ext.form.field.Text', {
            name: 'passwordConfirmation',
            inputType: 'password',
            emptyText: me.snippets.confirmPassword,
            allowBlank: false,
            required: true,
            minLength: 5,
            cls: 'input--field',
            validator: function (value) {
                if (Ext.String.trim(value) === Ext.String.trim(me.newRegistrationPasswordField.getValue())) {
                    me.newRegistrationPasswordField.clearInvalid();
                    return true;
                } else {
                    return me.snippets.passwordMessage;
                }
            },
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.sendRegisterForm();
                    }
                }
            }
        });

        return me.newRegistrationPasswordConfirmationField;
    },

    createEmailField: function () {
        var me = this;

        me.newRegistrationEmail = Ext.create('Ext.form.field.Text', {
            name: 'email',
            emptyText: me.snippets.email,
            vtype: 'remote',
            cls: 'input--field',
            validationUrl: '<?php echo '/shopware4/backend/base/validateEmail';?>',
            validationErrorMsg: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'invalid_email','namespace'=>'backend/plugin_manager/translation','default'=>'The email address entered is not valid')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'invalid_email','namespace'=>'backend/plugin_manager/translation','default'=>'The email address entered is not valid'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The email address entered is not valid<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'invalid_email','namespace'=>'backend/plugin_manager/translation','default'=>'The email address entered is not valid'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            allowBlank: false,
            required: true,
            enableKeyEvents: true,
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.sendRegisterForm();
                    }
                }
            }
        });

        return me.newRegistrationEmail;
    },

    createRegisterDomainCheckbox: function () {
        var me = this;

        me.newRegistrationRegisterDomain = Ext.create('Ext.form.field.Checkbox', {
            name: 'registerDomain',
            boxLabel: me.snippets.registerDomain,
            cls: 'input--field',
            checked: true,
            listeners: {
                specialkey: function (field, e) {
                    if (e.getKey() == e.ENTER) {
                        me.sendRegisterForm();
                    }
                }
            }
        });

        return me.newRegistrationRegisterDomain;
    },

    createActionButtons: function () {
        var me = this;

        me.registerButton = Ext.create('PluginManager.container.Container', {
            html: me.snippets.registerButton,
            cls: 'plugin-manager-action-button primary',
            margin: '0 0 0 0',
            handler: function () {
                me.sendRegisterForm();
            }
        });

        me.actionButtons = Ext.create('Ext.container.Container', {
            margin: '10 0 0 0',
            width: 400,
            cls: 'action-buttons',
            items: [me.registerButton]
        });

        return me.actionButtons;
    },

    sendRegisterForm: function () {
        var me = this;

        if (!me.formPanel.getForm().isValid()) {
            return;
        }

        var formValues = me.formPanel.getForm().getValues();

        formValues.registerDomain = formValues.registerDomain === 'on';

        Shopware.app.Application.fireEvent(
            'store-register',
            formValues,
            function () {
                me.callback();
            }
        );
    }
});
// 
<?php }} ?>