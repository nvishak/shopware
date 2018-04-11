<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:13
         compiled from "E:\wamp\www\shopware4\engine\Library\ExtJs\overrides\Ext.Ajax.js" */ ?>
<?php /*%%SmartyHeaderCode:217625acda8e183c7a3-76493543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1705a17b5ccb55b441c4ad5a583974fe9dd8351a' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Library\\ExtJs\\overrides\\Ext.Ajax.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '217625acda8e183c7a3-76493543',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e1861c12_91626210',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e1861c12_91626210')) {function content_5acda8e1861c12_91626210($_smarty_tpl) {?>/**
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

Ext.CSRFService = (function() {
    var me = this;

    /**
     * Indicates if the token has returned from the backend
     * @type { boolean }
     */
    me.tokenReceived = false;

    /**
     * CSRFToken for the requests
     * @type { string }
     */
    me.csrfToken = "";

    /**
     * Dummy method
     */
    me.requestMethod = function() { };

    /**
     * List of waiting requests
     *
     * Example:
     *
     * {
     *      context: this, // Ext.Ajax.request()'s this
     *      options: {
     *          url: ...,
     *          headers: ...,
     *          ...
     *          }
     *      }
     * }
     *
     * @type { Array }
     */
    me.interceptedRequests = [];

    /**
     * Generate X-CSRF-Token cookie
     */
    me.requestToken = function() {
        Ext.Ajax.request({
            headers: {
                ignoreCSRFToken: true
            },
            url: '<?php echo '/shopware4/backend/CSRFToken/generate';?>',
            success: function(response) {
                me.csrfToken = response.getResponseHeader('x-csrf-token');
                me.tokenReceived = true;
                me.continueRequests();
            }
        });
    };

    /**
     * Returns the token
     * @returns { string }
     */
    me.getToken = function() {
        return me.csrfToken;
    };

    /**
     * Capture every requests and append the X-CSRF-Token as header
     *
     * @param conn
     * @param options
     */
    me.onBeforeRequest = function(conn, options) {
        if (me.csrfToken.length === 0) {
            return;
        }

        if (typeof options.headers === "undefined") {
            options.headers = { };
        }

        options.headers['X-CSRF-Token'] = me.csrfToken;
    };

    /**
     * Decorate Ext.Ajax.request() method to wait for the CSRF-Token
     */
    me.registerAjaxInterceptor = function () {
        var me = this;

        me.requestMethod = Ext.Ajax.request;

        Ext.merge(Ext.Ajax, {
            request: function(options) {

                if (me.tokenReceived || (options.headers && options.headers.ignoreCSRFToken === true)) {
                    return me.requestMethod.apply(this,  [options]);
                }

                me.interceptedRequests.push({ context: this, options: options });
            }
        });
    };

    /**
     * Process waiting requests
     */
    me.continueRequests = function() {
        var me = this;

        if (me.interceptedRequests.length === 0) {
            return;
        }

        Ext.each(me.interceptedRequests, function(request) {
            me.requestMethod.apply(request.context, [request.options]);
        });

        me.interceptedRequests.length = 0;
    };

    /**
     * Enable CSRF-Protection
     */
    me.registerAjaxEvent = function () {
        var me = this;

        Ext.Ajax.on('beforerequest', me.onBeforeRequest);
    };

    me.init = function() {
        me.registerAjaxInterceptor();
        me.registerAjaxEvent();
        me.requestToken();
    };

    me.init();

    return me;
})();<?php }} ?>