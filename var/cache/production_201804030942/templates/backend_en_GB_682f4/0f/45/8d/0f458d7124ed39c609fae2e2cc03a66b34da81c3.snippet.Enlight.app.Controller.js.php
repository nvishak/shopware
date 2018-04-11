<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:13
         compiled from "E:\wamp\www\shopware4\engine\Library\ExtJs\components\Enlight.app.Controller.js" */ ?>
<?php /*%%SmartyHeaderCode:6025acda8e1bcba13-74747406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f458d7124ed39c609fae2e2cc03a66b34da81c3' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Library\\ExtJs\\components\\Enlight.app.Controller.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6025acda8e1bcba13-74747406',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e1be51d4_35825627',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e1be51d4_35825627')) {function content_5acda8e1be51d4_35825627($_smarty_tpl) {?>/**
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
 * Enlight.app.Controller
 *
 * Override the default ext application
 * to add our sub application functionality
 */
Ext.define('Enlight.app.Controller', {

    /**
     * Extend from the standard ExtJS 4 controller
     * @string
     */
    extend: 'Ext.app.Controller',

    /**
     * Returns instance of a { @link Ext.app.Controller controller } with the given name.
     * When controller doesn't exist yet, it's created.
     * @param { String } name
     * @return { Ext.app.Controller } a controller instance.
     */
    getController: function(name) {
        return this.subApplication.getController(name);
    },

    /**
     * Returns instance of a { @link Ext.data.Store Store } with the given name.
     * When store doesn't exist yet, it's created.
     * @param { String } name
     * @return { Ext.data.Store } a store instance.
     */
    getStore: function(name) {
        return this.subApplication.getStore(name);
    },

    /**
     * Returns a { @link Ext.data.Model Model } class with the given name.
     * A shorthand for using { @link Ext.ModelManager#getModel }.
     * @param { String } name
     * @return { Ext.data.Model } a model class.
     */
    getModel: function(model) {
        return this.subApplication.getModel(model);
    },

    /**
     * Returns a View class with the given name.  To create an instance of the view,
     * you can use it like it's used by Application to create the Viewport:
     *
     *     this.getView('Viewport').create();
     *
     * @param { String } name
     * @return { Ext.Base } a view class.
     */
    getView: function(view) {
        return this.subApplication.getView(view);
    },

    /**
     * Returns the event bus for this subapplication.
     *
     * @public
     * @return [object] Ext.app.EventBus
     */
    getEventBus: function() {
        return this.subApplication.eventbus;
    },

    /**
     * Adds listeners to components selected via Ext.ComponentQuery. Accepts an
     * object containing component paths mapped to a hash of listener functions.
     *
     * @param [string|object] selectors If a String, the second argument is used as the
     * listeners, otherwise an object of selectors -> listeners is assumed
     * @param [object] listeners
     */
    control: function(selectors, listeners) {
        var me = this;

        /**
         * If the controller is associated with a sub application (e.g. it's a module)
         * we're using the event bus which is associated with the sub application.
         *
         * Otherwise we're using the default behavior and bind the events globally
         */
        if(me.subApplication) {
            me.subApplication.control(selectors, listeners, me);
        } else {
            me.application.control(selectors, listeners, me);
        }
    }
});
<?php }} ?>