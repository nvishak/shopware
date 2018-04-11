<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:43
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\controller\plugin.js" */ ?>
<?php /*%%SmartyHeaderCode:232215acda8ffa2f061-34961733%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1e9b90af019c01ad3b0bba9bd22af9dfc2fd50c' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\controller\\plugin.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '232215acda8ffa2f061-34961733',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ffda6b89_55015015',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ffda6b89_55015015')) {function content_5acda8ffda6b89_55015015($_smarty_tpl) {?>/**
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
 * @subpackage Controller
 * @version    $Id$
 * @author shopware AG
 */

//
//
Ext.define('Shopware.apps.PluginManager.controller.Plugin', {

    extend:'Ext.app.Controller',

    refs: [
        { ref: 'localListing', selector: 'plugin-manager-local-plugin-listing' }
    ],

    mixins: {
        events: 'Shopware.apps.PluginManager.view.PluginHelper'
    },

    snippets: {
        'licencePluginDownloadInstall':  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_plugin_download_and_install','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not present in your system. <br><br><strong>Do you want to download and install the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_download_and_install','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not present in your system. <br><br><strong>Do you want to download and install the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The Shopware License Manager plugin is needed to install this plugin, but is currently not present in your system. <br><br><strong>Do you want to download and install the Shopware License Manager plugin?<strong><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_download_and_install','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not present in your system. <br><br><strong>Do you want to download and install the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'licencePluginDownloadActivate': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_plugin_install_and_activate','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not installed on your system. <br><br><strong>Do you want to install the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_install_and_activate','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not installed on your system. <br><br><strong>Do you want to install the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The Shopware License Manager plugin is needed to install this plugin, but is currently not installed on your system. <br><br><strong>Do you want to install the Shopware License Manager plugin?<strong><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_install_and_activate','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not installed on your system. <br><br><strong>Do you want to install the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'licencePluginActivate':         '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_plugin_activate','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not active on your system. <br><br>Do you want to activate the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_activate','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not active on your system. <br><br>Do you want to activate the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The Shopware License Manager plugin is needed to install this plugin, but is currently not active on your system. <br><br>Do you want to activate the Shopware License Manager plugin?<strong><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_activate','default'=>'The Shopware License Manager plugin is needed to install this plugin, but is currently not active on your system. <br><br>Do you want to activate the Shopware License Manager plugin?<strong>','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

        newRegistrationForm: {
            successTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'newRegistrationForm'/'successTitle','default'=>'Shopware ID registration','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'successTitle','default'=>'Shopware ID registration','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shopware ID registration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'successTitle','default'=>'Shopware ID registration','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'newRegistrationForm'/'successMessage','default'=>'Your Shopware ID has been successfully registered','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'successMessage','default'=>'Your Shopware ID has been successfully registered','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Your Shopware ID has been successfully registered<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'successMessage','default'=>'Your Shopware ID has been successfully registered','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            waitTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'newRegistrationForm'/'waitTitle','default'=>'Registering your Shopware ID','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'waitTitle','default'=>'Registering your Shopware ID','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Registering your Shopware ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'waitTitle','default'=>'Registering your Shopware ID','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            waitMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'newRegistrationForm'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
This process might take a few seconds<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newRegistrationForm'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        domainRegistration: {
            successTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'domainRegistration'/'successTitle','default'=>'Domain registration','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'successTitle','default'=>'Domain registration','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Domain registration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'successTitle','default'=>'Domain registration','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'domainRegistration'/'successMessage','default'=>'Domain registration successful','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'successMessage','default'=>'Domain registration successful','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Domain registration successful<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'successMessage','default'=>'Domain registration successful','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            waitTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'domainRegistration'/'waitTitle','default'=>'Registering domain','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'waitTitle','default'=>'Registering domain','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Registering domain<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'waitTitle','default'=>'Registering domain','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            waitMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'domainRegistration'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
This process might take a few seconds<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            validationFailed: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'domainRegistration'/'validationFailed','default'=>'<p>You have successfully logged in using your Shopware ID, but the domain validation process failed.<br><p>Please click <a href=\'http://en.wiki.shopware.com/Shopware-ID-Shopware-Account_detail_1433.html#Add_shop_.2F_domain\' target=\'_blank\'>here</a> to use manual domain validation.</p>','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'validationFailed','default'=>'<p>You have successfully logged in using your Shopware ID, but the domain validation process failed.<br><p>Please click <a href=\'http://en.wiki.shopware.com/Shopware-ID-Shopware-Account_detail_1433.html#Add_shop_.2F_domain\' target=\'_blank\'>here</a> to use manual domain validation.</p>','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<p>You have successfully logged in using your Shopware ID, but the domain validation process failed.<br><p>Please click <a href='http://en.wiki.shopware.com/Shopware-ID-Shopware-Account_detail_1433.html#Add_shop_.2F_domain' target='_blank'>here</a> to use manual domain validation.</p><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'domainRegistration'/'validationFailed','default'=>'<p>You have successfully logged in using your Shopware ID, but the domain validation process failed.<br><p>Please click <a href=\'http://en.wiki.shopware.com/Shopware-ID-Shopware-Account_detail_1433.html#Add_shop_.2F_domain\' target=\'_blank\'>here</a> to use manual domain validation.</p>','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"
        },

        login: {
            successTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'login'/'successTitle','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'successTitle','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shopware ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'successTitle','default'=>'Shopware ID','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'login'/'successMessage','default'=>'Login successful','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'successMessage','default'=>'Login successful','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Login successful<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'successMessage','default'=>'Login successful','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            waitTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'login'/'waitTitle','default'=>'Logging in...','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'waitTitle','default'=>'Logging in...','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Logging in...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'waitTitle','default'=>'Logging in...','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            waitMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'login'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
This process might take a few seconds<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'login'/'waitMessage','default'=>'This process might take a few seconds','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        growlMessage:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'growlMessage','default'=>'Plugin Manager','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growlMessage','default'=>'Plugin Manager','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin Manager<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growlMessage','default'=>'Plugin Manager','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    init: function() {
        var me = this;

        Shopware.app.Application.on(me.getEventListeners());

        me.callParent(arguments);
    },

    getEventListeners: function() {
        var me = this;

        return {
            'install-plugin':              me.installPlugin,
            'uninstall-plugin':            me.uninstallPlugin,
            'secure-uninstall-plugin':     me.secureUninstallPlugin,
            'reinstall-plugin':            me.reinstallPlugin,
            'activate-plugin':             me.activatePlugin,
            'deactivate-plugin':           me.deactivatePlugin,
            'execute-plugin-update':       me.executePluginUpdate,

            'download-plugin-licence':     me.downloadPluginLicenceDirect,
            'update-plugin':               me.updatePlugin,
            'update-dummy-plugin':         me.updateDummyPlugin,
            'buy-plugin':                  me.purchasePlugin,
            'rent-plugin':                 me.purchasePlugin,
            'download-free-plugin':        me.purchasePlugin,
            'request-plugin-test-version': me.purchasePlugin,
            'import-plugin-licence':       me.importLicenceKey,

            'upload-plugin':               me.uploadPlugin,
            'delete-plugin':               me.deletePlugin,
            'reload-plugin':               me.reloadPlugin,
            'reload-local-listing':        me.reloadLocalListing,
            'save-plugin-configuration':   me.saveConfiguration,
            'store-login':                 me.login,
            'check-store-login':           me.checkLogin,
            'open-login':                  me.openLogin,
            'destroy-login':               me.destroyLogin,
            'store-register':              me.register,
            'check-licence-plugin':        me.checkLicencePlugin,
            'clear-all-cache':             me.clearAllCache,
            scope: me
        };
    },

    uploadPlugin: function(form, callback) {
        var me = this;

        form.submit({
            onSuccess: function(response) {
                var result = Ext.decode(response.responseText);
                if (!result) {
                    result = Ext.decode(response.responseXML.body.childNodes[0].innerHTML);
                }

                if (result.success) {
                    Shopware.Notification.createGrowlMessage('', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_file_uploaded','default'=>'Plugin uploaded','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_file_uploaded','default'=>'Plugin uploaded','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin uploaded<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_file_uploaded','default'=>'Plugin uploaded','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                    if (Ext.isFunction(callback)) {
                        callback();
                    }
                } else {
                    me.displayErrorMessage(result);
                }
            }
        });
    },

    reloadLocalListing: function() {
        var me = this,
            localListing = me.getLocalListing();

        localListing.getStore().load();
    },

    saveConfiguration: function(plugin, form) {
        var me = this;

        form.onSaveForm(form, false, function() {

        });
    },

    updatePlugin: function(plugin, callback) {
        var me = this,
            localListing = me.getLocalListing();

        me.authenticateForUpdate(plugin, function() {
            me.startPluginDownload(plugin, function() {
                me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'execute_update','default'=>'Plugin is being updated','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'execute_update','default'=>'Plugin is being updated','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin is being updated<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'execute_update','default'=>'Plugin is being updated','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', false);
                localListing.getStore().load({
                    callback: function(records, operation, success) {
                        me.executePluginUpdate(plugin, function() {
                            Shopware.app.Application.fireEvent('load-update-listing', function(records) {
                                if (records.length === 0) {
                                    me.subApplication.getController('Navigation').displayLocalPluginPage();
                                }
                                me.hideLoadingMask();
                                callback();
                            });
                        });
                    }
                });
            });
        });
    },

    updateDummyPlugin: function(plugin, callback) {
        var me = this;

        if (plugin.get('technicalName') == 'SwagLicense') {
            me.checkIonCube(plugin, function() {
                me.startPluginDownload(plugin, callback);
            });
        } else {
            me.startPluginDownload(plugin, callback);
        }
    },

    startPluginDownload: function(plugin, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'initial_download','default'=>'Initial plugin download','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'initial_download','default'=>'Initial plugin download','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Initial plugin download<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'initial_download','default'=>'Initial plugin download','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginManager/metaDownload';?>',
            { technicalName: plugin.get('technicalName') },
            function(response) {
                me.hideLoadingMask();

                var mask = me.createDownloadMask(plugin, response.data, function(fileName) {
                    me.sendAjaxRequest(
                        '<?php echo '/shopware4/backend/PluginManager/extract';?>',
                        { technicalName: plugin.get('technicalName'), fileName: fileName },
                        function(extractResponse) {
                            me.sendAjaxRequest(
                                '<?php echo '/shopware4/backend/PluginManager/refreshPluginList';?>',
                                { },
                                function() {
                                    callback(extractResponse);
                                }
                            );
                        }
                    );
                });

                mask.show();
                mask.startDownload(0);
            }
        );
    },

    purchasePlugin: function(plugin, price, callback) {
        var me = this;

        me.checkout(plugin, price, function(basket) {

            me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'order_is_being_executed','default'=>'Order is being processed','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'order_is_being_executed','default'=>'Order is being processed','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order is being processed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'order_is_being_executed','default'=>'Order is being processed','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

            me.sendAjaxRequest(
                '<?php echo '/shopware4/backend/PluginManager/purchasePlugin';?>',
                {
                    orderNumber: plugin.get('code'),
                    price: basket.get('netPrice'),
                    bookingDomain: basket.get('bookingDomain'),
                    priceType: price.get('type')
                },
                function(response) {
                    me.checkoutWindow.hide();

                    me.startPluginDownload(plugin, function() {
                        me.importPluginLicence(plugin, function() {
                            me.pluginBoughtEvent(plugin);
                            callback();
                        });
                    });
                }
            );
        });
    },

    importPluginLicence: function(plugin, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin license is being imported<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginManager/importPluginLicence';?>',
            { technicalName: plugin.get('technicalName') },
            callback
        );
    },

    importLicenceKey: function(licence, callback) {
        var me = this;

        me.displayLoadingMask(licence, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin license is being imported<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

        if (!licence.get('licenseKey')) {
            me.hideLoadingMask();
            callback();
            return;
        }

        me.checkIonCube(licence, function() {

            me.checkLicencePlugin(licence, function () {

                me.displayLoadingMask(licence, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin license is being imported<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_is_being_imported','default'=>'Plugin license is being imported','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

                me.sendAjaxRequest(
                    '<?php echo '/shopware4/backend/PluginManager/importLicenceKey';?>',
                    {
                        licenceKey: licence.get('licenseKey')
                    },
                    callback
                );

            }, true);
        });
    },

    downloadPluginLicenceDirect: function(licence, callback) {
        var me = this;

        me.checkIonCube(licence, function() {
            me.checkLicencePlugin(licence, function () {
                me.startPluginDownload(licence, function() {
                    me.importLicenceKey(licence, callback);
                });
            });
        });
    },

    checkout: function(plugin, price, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'open_basket','default'=>'Preparing order process','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open_basket','default'=>'Preparing order process','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Preparing order process<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open_basket','default'=>'Preparing order process','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
        me.checkIonCube(plugin, function() {

            me.checkLicencePlugin(plugin, function() {

                me.checkLogin(function() {

                    var store = Ext.create('Shopware.apps.PluginManager.store.Basket');

                    var positions = [{
                        orderNumber: plugin.get('code'),
                        price: price.get('price'),
                        type: price.get('type'),
                        technicalName: plugin.get('technicalName')
                    }];

                    store.getProxy().extraParams = {
                        positions: Ext.encode(positions)
                    };

                    //add event listener to the model proxy to get access on thrown exceptions
                    store.getProxy().on('exception', function (proxy, response) {
                        response = Ext.decode(response.responseText);
                        me.displayErrorMessage(response);
                    }, me, { single: true });

                    store.load({
                        callback: function(records) {
                            if (records) {
                                var basket = records[0];

                                me.hideLoadingMask();

                                me.checkoutWindow = me.getView('account.Checkout').create({
                                    basket: basket,
                                    callback: callback
                                });

                                me.checkoutWindow.show();
                            }
                        }
                    });

                });
            });
        });
    },

    checkLicencePlugin: function(plugin, callback, force) {
        var me = this;

        if (plugin && !plugin.get('licenceCheck') && !force) {
            callback();
            return;
        }

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/PluginManager/checkLicencePlugin';?>',
            method: 'POST',
            success: function(operation, opts) {
                var response = Ext.decode(operation.responseText);

                if (response.success === true && Ext.isFunction(callback)) {
                    callback(response);
                    return;
                }

                var licence = Ext.create('Shopware.apps.PluginManager.model.Plugin', response.data);

                switch(response.state) {
                    case 'download':
                        me.confirmMessage(
                            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
License plugin required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                            me.snippets.licencePluginDownloadInstall,
                            function() {
                                me.updateDummyPlugin(licence, function () {
                                    me.installPlugin(licence, function () {
                                        me.activatePlugin(licence, callback);
                                    });
                                });
                            }
                        );
                        break;

                    case 'install':
                        me.confirmMessage(
                            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
License plugin required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                            me.snippets.licencePluginDownloadActivate,
                            function() {
                                me.installPlugin(licence, function() {
                                    me.activatePlugin(licence, callback);
                                });
                            }
                        );

                        break;

                    case 'activate':
                        me.confirmMessage(
                            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
License plugin required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_plugin_required_title','default'=>'License plugin required','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                            me.snippets.licencePluginActivate,
                            function() {
                                me.activatePlugin(licence, callback);
                            }
                        );

                        break;
                }

            }
        });
    },

    checkIonCube: function(plugin, callback) {
        var me = this;

        if (!plugin.get('encrypted') && !plugin.get('licenceCheck') && !plugin.get('licenceKey')) {
            callback();
            return;
        }

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/PluginManager/checkIonCubeLoader';?>',
            method: 'POST',
            success: function(operation, opts) {
                var response = Ext.decode(operation.responseText);

                if (response.success === false) {
                    Ext.Msg.alert(
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ion_cube_required_title','default'=>'Encrypted plugins','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ion_cube_required_title','default'=>'Encrypted plugins','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Encrypted plugins<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ion_cube_required_title','default'=>'Encrypted plugins','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ion_cube_required_text','default'=>'The requested plugin is encrypted. You need the Ioncube Loader Extension to download the plugin','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ion_cube_required_text','default'=>'The requested plugin is encrypted. You need the Ioncube Loader Extension to download the plugin','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The requested plugin is encrypted. You need the Ioncube Loader Extension to download the plugin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ion_cube_required_text','default'=>'The requested plugin is encrypted. You need the Ioncube Loader Extension to download the plugin','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                    );

                    return;
                }

                callback();
            }
        });

    },

    authenticateForUpdate: function(plugin, callback) {
        var me = this;

        if (plugin.flaggedAsDummyPlugin()) {
            callback();
        } else {
            me.checkLogin(callback);
        }
    },

    executePluginUpdate: function(plugin, callback) {
        var me = this;

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginInstaller/update';?>',
            { technicalName: plugin.get('technicalName') },
            function(response) {
                me.handleCrudResponse(response, plugin, function() {
                    me.reloadMenu();
                }, me);
                callback(response);
            },
            null,
            300000
        );
    },

    checkLogin: function(callback) {
        var me = this;

        me.checkAccessToken(function(response) {

            if (response.success == false) {
                me.openLogin(callback);
            } else {

                if (response.hasOwnProperty('shopwareId')) {
                    me.fireRefreshAccountData(response);
                }

                callback();
                return;
            }
        });
    },

    checkAccessToken: function(callback) {
        var me = this;

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/PluginManager/getAccessToken';?>',
            method: 'POST',
            success: function (operation, opts) {
                var response = Ext.decode(operation.responseText);
                callback(response);
            }
        });
    },

    destroyLogin: function(comp) {
        var me = this;

        comp.destroy();
        me.loginMask = null;
    },

    openLogin: function(callback) {
        var me = this;

        if(!me.loginMask) {
            me.loginMask = Ext.create('Shopware.apps.PluginManager.view.account.LoginWindow', {
                callback: callback
            }).show();
        }
    },

    login: function(params, callback) {
        var me = this;

        me.splashScreen = Ext.Msg.wait(
            me.snippets.login.waitMessage,
            me.snippets.login.waitTitle
        );

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginManager/login';?>',
            params,
            function(response) {

                response.shopwareId = params.shopwareID;
                me.splashScreen.close();

                if (response.success == true) {
                    Ext.create('Shopware.notification.SubscriptionWarning').checkSecret();

                    Shopware.Notification.createGrowlMessage(
                        me.snippets.login.successTitle,
                        me.snippets.login.successMessage,
                        me.snippets.growlMessage
                    );

                    me.fireRefreshAccountData(response);

                    if (params.registerDomain !== false) {
                        me.submitShopwareDomainRequest(params, callback);
                    } else {
                        me.destroyLogin(me.loginMask);
                        callback(response);
                    }
                }
            },
            function(response) {
                me.splashScreen.close();
                me.displayErrorMessage(response, callback);
            }
        );
    },

    register: function(registerData, callback) {
        var me = this;

        me.submitShopwareIdRequest(
            registerData,
            '<?php echo '/shopware4/backend/firstRunWizard/registerNewId';?>',
            callback
        );

    },

    submitShopwareIdRequest: function(params, url, callback) {
        var me = this;

        me.splashScreen = Ext.Msg.wait(
            me.snippets.newRegistrationForm.waitMessage,
            me.snippets.newRegistrationForm.waitTitle
        );

        Ext.Ajax.request({
            url: url,
            method: 'POST',
            params: params,
            callback: function(options, success, response) {
                var result = Ext.JSON.decode(response.responseText, true);

                if (!result || result.success == false) {

                    response = Ext.decode(response.responseText);
                    me.displayErrorMessage(response);

                    me.splashScreen.close();

                } else if (result.success) {
                    Shopware.Notification.createGrowlMessage(
                        me.snippets.newRegistrationForm.successTitle,
                        me.snippets.newRegistrationForm.successMessage,
                        me.snippets.growlMessage
                    );

                    Ext.create('Shopware.notification.SubscriptionWarning').checkSecret();

                    if (params.registerDomain !== false) {
                        me.submitShopwareDomainRequest(params, callback);
                    }

                    response.shopwareId = params.shopwareID;
                    me.fireRefreshAccountData(response);
                    callback(response);
                }
            }
        });
    },

    submitShopwareDomainRequest: function(params, callback) {
        var me = this;

        me.splashScreen = Ext.Msg.wait(
            me.snippets.domainRegistration.waitMessage,
            me.snippets.domainRegistration.waitTitle
        );

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/firstRunWizard/registerDomain';?>',
            method: 'POST',
            params: params,
            success: function(response) {
                var result = Ext.JSON.decode(response.responseText);

                if (!result || result.success == false) {

                    response = Ext.decode(response.responseText);
                    me.displayErrorMessage({ message: me.snippets.domainRegistration.validationFailed });
                    me.displayErrorMessage(response);

                    me.splashScreen.close();

                } else if (result.success) {
                    Shopware.Notification.createGrowlMessage(
                        me.snippets.domainRegistration.successTitle,
                        me.snippets.domainRegistration.successMessage,
                        me.snippets.growlMessage
                    );
                    callback(response);
                }


            }
        });
    },

    installPlugin: function(plugin, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_is_being_installed','default'=>'Plugin is being installed','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_installed','default'=>'Plugin is being installed','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin is being installed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_installed','default'=>'Plugin is being installed','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', false);

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginInstaller/installPlugin';?>',
            { technicalName: plugin.get('technicalName') },
            function(response) {
                me.handleCrudResponse(response, plugin);
                callback(response);
            },
            null,
            300000
        );
    },

    uninstallPlugin: function(plugin, callback) {
        var me = this;

        if (plugin.allowSecureUninstall()) {
            me.confirmMessage(
                '',
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'uninstall_remove_data','default'=>'The plugin will be uninstalled. Do you also like to remove the saved data of the plugin?','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'uninstall_remove_data','default'=>'The plugin will be uninstalled. Do you also like to remove the saved data of the plugin?','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The plugin will be uninstalled. Do you also like to remove the saved data of the plugin?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'uninstall_remove_data','default'=>'The plugin will be uninstalled. Do you also like to remove the saved data of the plugin?','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                function() {
                    me.doUninstall(plugin, callback);
                },
                function() {
                    me.secureUninstallPlugin(plugin, callback);
                }
            );
        } else {
            me.doUninstall(plugin, callback);
        }

    },

    doUninstall: function(plugin, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_is_being_uninstalled','default'=>'Plugin is being uninstalled','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_uninstalled','default'=>'Plugin is being uninstalled','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin is being uninstalled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_uninstalled','default'=>'Plugin is being uninstalled','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', false);

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginInstaller/uninstallPlugin';?>',
            { technicalName: plugin.get('technicalName') },
            function(response) {
                me.handleCrudResponse(response, plugin, function() {
                    me.reloadMenu();
                }, me);
                callback(response);
            },
            null,
            300000
        );
    },

    reinstallPlugin: function(plugin, callback) {
        var me = this,
            wasActive = plugin.get('active');

        me.secureUninstallPlugin(plugin, function() {
            me.installPlugin(plugin, function(response) {
                if (wasActive) {
                    me.activatePlugin(plugin, callback);
                } else {
                    callback(response);
                }
            });
        });
    },

    secureUninstallPlugin: function(plugin, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_is_being_uninstalled','default'=>'Plugin is being uninstalled','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_uninstalled','default'=>'Plugin is being uninstalled','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin is being uninstalled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_uninstalled','default'=>'Plugin is being uninstalled','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', false);

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginInstaller/secureUninstallPlugin';?>',
            { technicalName: plugin.get('technicalName') },
            function(response) {
                me.handleCrudResponse(response, plugin, function() {
                    me.reloadMenu();
                }, me);
                callback(response);
            },
            null,
            300000
        );
    },

    deletePlugin: function(plugin, callback) {
        var me = this;

        me.confirmMessage(
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'delete_plugin_title','default'=>'Delete plugin','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_plugin_title','default'=>'Delete plugin','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete plugin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_plugin_title','default'=>'Delete plugin','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'delete_plugin_confirm','default'=>'Are you sure you want to delete the plugin:','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_plugin_confirm','default'=>'Are you sure you want to delete the plugin:','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Are you sure you want to delete the plugin:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_plugin_confirm','default'=>'Are you sure you want to delete the plugin:','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + plugin.get('label'),
            function() {
                me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_is_being_deleted','default'=>'Plugin is being deleted','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_deleted','default'=>'Plugin is being deleted','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin is being deleted<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_deleted','default'=>'Plugin is being deleted','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                me.sendAjaxRequest(
                    '<?php echo '/shopware4/backend/PluginInstaller/deletePlugin';?>',
                    { technicalName: plugin.get('technicalName') },
                    callback
                );
            }
        );
    },

    activatePlugin: function(plugin, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_is_being_activated','default'=>'Plugin is being activated','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_activated','default'=>'Plugin is being activated','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin is being activated<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_activated','default'=>'Plugin is being activated','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginInstaller/activatePlugin';?>',
            { technicalName: plugin.get('technicalName') },
            function(response) {
                me.handleCrudResponse(response, plugin, function() {
                    me.reloadMenu();
                }, me);
                callback(response);
            }
        );
    },

    deactivatePlugin: function(plugin, callback) {
        var me = this;

        me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_is_being_deactivated','default'=>'Plugin is being deactivated','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_deactivated','default'=>'Plugin is being deactivated','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin is being deactivated<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_is_being_deactivated','default'=>'Plugin is being deactivated','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

        me.sendAjaxRequest(
            '<?php echo '/shopware4/backend/PluginInstaller/deactivatePlugin';?>',
            { technicalName: plugin.get('technicalName') },
            function(response) {
                me.handleCrudResponse(response, plugin, function() {
                    me.reloadMenu();
                }, me);
                callback(response);
            }
        );
    },

    handleCrudResponse: function(response, plugin, callback, scope) {
        response = response.result;

        callback = callback || Ext.emptyFn;
        scope = scope || this;

        if (!response) {
            return;
        }

        var message = this.getResponseMessage(response);

        if (Ext.isObject(message)) {
            Shopware.Notification.createStickyGrowlMessage(message);
        } else if (Ext.isString(message)) {
            Shopware.Notification.createStickyGrowlMessage({ text: message });
        }

        Shopware.app.Application.fireEvent('plugin-state-changed', plugin);

        var caches = this.getResponseCacheClearTask(response);
        if (caches !== null) {
            this.clearCache(caches, plugin, callback, scope);
        } else {
            Ext.callback(callback, scope)
        }
    },

    getResponseMessage: function(response) {
        if (response.hasOwnProperty('message')) {
            return response.message;
        }

        if (response.hasOwnProperty('scheduled') && response.scheduled.hasOwnProperty('message')) {
            return response.scheduled.message;
        }
        return null;
    },

    getResponseCacheClearTask: function(response) {
        if (response.hasOwnProperty('invalidateCache')) {
            return response.invalidateCache;
        }
        if (response.hasOwnProperty('scheduled') && response.scheduled.hasOwnProperty('cache')) {
            return response.scheduled.cache;
        }
        return null;
    },

    clearAllCache: function () {
        var me = this;

        var getCaches = Ext.Ajax.request({
            async: false,
            url: '<?php echo '/shopware4/backend/PluginManager/getAllCaches';?>',
            method: 'GET'
        });

        var response = Ext.decode(getCaches.responseText);

        me.clearCache(response.caches);
    },

    clearCache: function(caches, plugin, callback, scope) {
        var me = this;

        var message = Ext.String.format(
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'clear_cache','default'=>'This plugin needs a new initialisation in the following caches: [0]Clear cache?','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'clear_cache','default'=>'This plugin needs a new initialisation in the following caches: [0]Clear cache?','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
This plugin needs a new initialisation in the following caches: [0]Clear cache?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'clear_cache','default'=>'This plugin needs a new initialisation in the following caches: [0]Clear cache?','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            '<br><br>- ' + caches.join('<br>- ') + '<br><br>'
        );

        me.confirmMessage(
            '',
            message,
            function() {
                if (plugin) {
                    me.displayLoadingMask(plugin, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cache_process','default'=>'Cache will be cleared','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cache_process','default'=>'Cache will be cleared','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cache will be cleared<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cache_process','default'=>'Cache will be cleared','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                }

                var params = {};

                Ext.each(caches, function(cacheKey) {
                    params['cache[' + cacheKey + ']'] = 'on';
                });

                Ext.Ajax.request({
                    url:'<?php echo '/shopware4/backend/Cache/clearCache';?>',
                    method: 'POST',
                    params: params,
                    callback: function() {
                        if (caches.indexOf('theme') >= 0 || caches.indexOf('frontend') >= 0) {
                            Shopware.app.Application.fireEvent('shopware-theme-cache-warm-up-request');
                        }
                        if (Ext.isFunction(callback)) {
                            Ext.callback(callback, scope);
                        }
                        me.hideLoadingMask();
                    }
                });
            },
            function() {
                Ext.callback(callback, scope);
            }
        );
    },

    reloadMenu: function() {
        Shopware.app.Application.fireEvent('reload-main-menu');
    }
});
//
<?php }} ?>