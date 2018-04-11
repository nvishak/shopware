<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:25
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\index\controller\theme_cache_warm_up.js" */ ?>
<?php /*%%SmartyHeaderCode:157945acda8ed62a9a9-89930139%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21bc1da312d7bbd5bd3d8a159f0125acd618e351' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\index\\controller\\theme_cache_warm_up.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157945acda8ed62a9a9-89930139',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ed6f13f1_75461556',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ed6f13f1_75461556')) {function content_5acda8ed6f13f1_75461556($_smarty_tpl) {?>/**
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
 * Shopware Core - Theme cache warm up controller
 *
 * This class handles all theme cache warm up actions
 */
//
//
Ext.define('Shopware.apps.Index.controller.ThemeCacheWarmUp', {
    extend: 'Ext.app.Controller',

    /**
     * Shop store
     */
    shopStore: null,

    /**
     * Url to which the theme cache warm up requests are sent
     */
    requestUrl: '<?php echo '/shopware4/backend/cache/themeCacheWarmUp';?>',

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

        me.control({
            'theme-cache-warm-up-window': {
                'themeCacheWarmUpStartProcess': me.onThemeCacheWarmUpStartProcess,
                'themeCacheWarmUpCancelProcess': me.onThemeCacheWarmUpCancelProcess
            }
        });

        Shopware.app.Application.on('shopware-theme-cache-warm-up-request', function(shopId, forceShow) {
            me.forceShow = forceShow;

            me.window = Ext.create('Shopware.apps.Index.view.themeCache.ThemeCacheWarmUp');

            me.shopStore = Ext.create('Shopware.apps.Index.store.ThemeCacheWarmUp');

            if (Ext.isNumber(shopId)) {
                me.shopStore.getProxy().extraParams.shopId = shopId;

                me.window.setSingleShopId(shopId);
                me.window.shopSelector.hide();
            }

            me.shopStore.load({
                callback: function(records, operation, success) {
                    if (records.length == 0 && forceShow !== true) {
                        me.window.close();
                    } else {
                        me.window.setShops(records);
                        if (me.window.shopSelector.isVisible()) {
                            me.window.shopSelector.bindStore(me.shopStore);
                        }
                        me.window.show();
                    }
                }
            });
        });
    },

    onThemeCacheWarmUpStartProcess: function() {
        var me = this,
            data = [];

        me.cancelOperation = false;

        me.shopStore.each(function(elem) {
            data.push(elem);
        });

        me.runRequest(data, 0);
    },

    onThemeCacheWarmUpCancelProcess: function() {
        var me = this;

        me.cancelOperation = true;

        me.window.progressBar.updateText(
            Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'progress_bar'/'cancelling','default'=>'Cancelling process ...','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_bar'/'cancelling','default'=>'Cancelling process ...','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancelling process ...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_bar'/'cancelling','default'=>'Cancelling process ...','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
')
        );
    },

    /**
     * Runs the actual request
     * Method is called recursively until all data was processed
     */
    runRequest: function(shops, offset) {
        var me = this,
            shop = shops[offset],
            batchSize = shops.length + 1;

        //cancel button pushed?
        if (me.cancelOperation) {
            me.shopStore.load({
                callback: function(records, operation, success) {
                    me.window.setShops(records);
                }
            });

            Shopware.Notification.createGrowlMessage(
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'cancelled'/'title','default'=>'Cancelled','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'cancelled'/'title','default'=>'Cancelled','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancelled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'cancelled'/'title','default'=>'Cancelled','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'cancelled'/'detail','default'=>'The process was cancelled. [0] of [1] caches were correctly warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'cancelled'/'detail','default'=>'The process was cancelled. [0] of [1] caches were correctly warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The process was cancelled. [0] of [1] theme files were correctly warmed up<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'cancelled'/'detail','default'=>'The process was cancelled. [0] of [1] caches were correctly warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', offset, batchSize)
            );

            return;
        }

        if (me.window.progressBar) {
            // updates the progress bar value and text, the last parameter is the animation flag
            me.window.progressBar.updateProgress(
                (offset) / batchSize,
                Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'progress_bar'/'processing','default'=>'Processing [0] ...','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_bar'/'processing','default'=>'Processing [0] ...','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Processing shop "[0]" ...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_bar'/'processing','default'=>'Processing [0] ...','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', shop.get('name')),
                true
            );
        }

        Ext.Ajax.request({
            url: me.requestUrl,
            method: 'POST',
            params: {
                shopId: shop.get('id')
            },
            timeout: 4000000,
            callback: function(options, success, response) {
                var json, message;

                if (!Ext.isEmpty(response.responseText)) {
                    json = Ext.decode(response.responseText)
                } else {
                    json = {
                        success: success
                    }
                }

                if (success && json.success) {
                    if (offset+2 == batchSize) {
                        if (me.window.progressBar) {
                            me.window.progressBar.updateProgress(
                                (offset+1) / batchSize,
                                Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'progress_bar'/'clearing_http_cache','default'=>'Clearing HTTP cache','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_bar'/'clearing_http_cache','default'=>'Clearing HTTP cache','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Clearing HTTP cache<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_bar'/'clearing_http_cache','default'=>'Clearing HTTP cache','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'),
                                true
                            );
                        }

                        me.moveThemeFiles(function() {
                            me.clearHttpCache();
                        });
                    } else {
                        me.runRequest(shops, offset+1);
                    }
                } else {
                    message = Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'error'/'detail','default'=>'A server error occurred while processing your request for shop [0]','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'detail','default'=>'A server error occurred while processing your request for shop [0]','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
A server error occurred while processing your request for shop "[0]"<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'detail','default'=>'A server error occurred while processing your request for shop [0]','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', shop.get('name'));
                    if (!Ext.isEmpty(json.message)) {
                        message = message + ': ' + json.message;
                    }
                    Shopware.Notification.createGrowlMessage(
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'error'/'title','default'=>'An error occurred','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'title','default'=>'An error occurred','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'title','default'=>'An error occurred','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        message
                    );

                    me.window.hide();
                }
            }
        });
    },

    moveThemeFiles: function(callback) {
        var me = this;

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/Cache/moveThemeFiles';?>',
            method: 'POST',
            timeout: 4000000,
            success: function(response) {
                callback();
            },
            failure: function(response) {
            }
        });
    },

    clearHttpCache: function() {
        var me = this;

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/Cache/clearCache';?>',
            method: 'POST',
            params: {
                'cache[http]' : 'on'
            },
            timeout: 4000000,
            success: function(response) {
                if (Ext.isNumber(me.window.singleShopId)) {
                    Shopware.Notification.createGrowlMessage(
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'success'/'title','default'=>'Theme shop cache warm up','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'title','default'=>'Theme shop cache warm up','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Theme compiling<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'title','default'=>'Theme shop cache warm up','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'success'/'detail_single','default'=>'Theme shop cache has been successfully warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'detail_single','default'=>'Theme shop cache has been successfully warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Theme compiling was successfully<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'detail_single','default'=>'Theme shop cache has been successfully warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                    );
                } else {
                    Shopware.Notification.createGrowlMessage(
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'success'/'title','default'=>'Theme shop cache warm up','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'title','default'=>'Theme shop cache warm up','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Theme compiling<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'title','default'=>'Theme shop cache warm up','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'success'/'detail_multiple','default'=>'All theme shop caches have been successfully warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'detail_multiple','default'=>'All theme shop caches have been successfully warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
All theme shop files have been successfully warmed up<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'success'/'detail_multiple','default'=>'All theme shop caches have been successfully warmed up','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                    );
                }

                me.window.hide();
            },
            failure: function(response) {
                //has the current request a progress bar?
                if (me.window.progressBar) {
                    me.window.progressBar.updateProgress(
                        0,
                        Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'error'/'progress_bar','default'=>'Error','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'progress_bar','default'=>'Error','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'progress_bar','default'=>'Error','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'),
                        true
                    );
                }

                Shopware.Notification.createGrowlMessage(
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'error'/'title','default'=>'An error occurred','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'title','default'=>'An error occurred','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'title','default'=>'An error occurred','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'response'/'error'/'detail','default'=>'A server error occurred while processing your request for shop [0]','namespace'=>'backend/index/controller/theme_cache_warm_up')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'detail','default'=>'A server error occurred while processing your request for shop [0]','namespace'=>'backend/index/controller/theme_cache_warm_up'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
A server error occurred while processing your request for shop "[0]"<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'response'/'error'/'detail','default'=>'A server error occurred while processing your request for shop [0]','namespace'=>'backend/index/controller/theme_cache_warm_up'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', shop.get('name'))
                );
            }
        });
    }

});
//
<?php }} ?>