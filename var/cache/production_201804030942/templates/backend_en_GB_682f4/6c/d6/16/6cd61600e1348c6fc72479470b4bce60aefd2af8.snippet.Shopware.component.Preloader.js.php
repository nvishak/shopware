<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:41
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\Shopware.component.Preloader.js" */ ?>
<?php /*%%SmartyHeaderCode:313515acd97e18be3e5-70348705%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cd61600e1348c6fc72479470b4bce60aefd2af8' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\Shopware.component.Preloader.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '313515acd97e18be3e5-70348705',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e19ada33_67027929',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e19ada33_67027929')) {function content_5acd97e19ada33_67027929($_smarty_tpl) {?>/**
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
//
Ext.define('Shopware.component.Preloader', {

    /**
     * The active priority. The priority will be needed to
     * support priority preloading
     *
     * @default 0
     * @integer
     */
    activePrio: 0,

    /**
     * Component which fires the events to start the preloading
     *
     * @default undefined
     * @object
     */
    eventProvider: undefined,

    /**
     * Is the preloading process finished
     *
     * @default false
     * @boolean
     */
    finished: false,

    /**
     * Required components which needs to be preloaded.
     * The components / modules are loaded based on the priority.
     *
     * @array
     */
    requiredComponents: [{
        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'article','privilege'=>'read'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>*/
        'Shopware.apps.Article': false,
        /*<?php }?>*/
        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'articlelist','privilege'=>'read'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?>*/
        'Shopware.apps.ArticleList': false,
        /*<?php }?>*/
        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'order','privilege'=>'read'),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3){?>*/
        'Shopware.apps.Order': false,
        /*<?php }?>*/
        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customer','privilege'=>'read'),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4){?>*/
        'Shopware.apps.Customer': false,
        /*<?php }?>*/

        'Shopware.apps.ProductStream': false
    }, {
        'Shopware.apps.Emotion': false,
        'Shopware.apps.MediaManager': false
    }, {
        'Shopware.apps.Blog': false
    }],

    /**
     * Binds the necessary event listener to trigger the preloading.
     *
     * @public
     * @param cmp - Component which provides the events
     * @return void
     */
    bindEvents: function(cmp) {
        var me = this;
        me.eventProvider = cmp;
        me.eventProvider.on('baseComponentsReady', me.onBaseComponentsReady, me, { single: true });
        me.eventProvider.on('subAppLoaded', me.onSubAppLoaded, me);
    },

    /**
     * Event listener method which will be fired when the [eventProvider]
     * fires the "baseComponentsReady" event.
     *
     * The method triggers the preloading.
     *
     * @event baseComponentsReady
     * @return void
     */
    onBaseComponentsReady: function() {
        var me = this;
        me.triggerLoadPrio();
    },

    /**
     * Event listener method which will be fired when the [eventProvider]
     * triggers that a new sub application was loaded successfully.
     *
     * Handles the priority management and removes the event listener
     * if all required components / modules are loaded.
     *
     * @event subAppLoaded
     * @param subApp - Instance of the loaded sub application
     * @return void
     */
    onSubAppLoaded: function(subApp) {
        var me = this,
            clsName = subApp.$className;

        if(me.finished) {
            return;
        }

        if(!me.requiredComponents[me.activePrio].hasOwnProperty(clsName)) {
            return;
        }
        me.requiredComponents[me.activePrio][clsName] = true;

        if(me.isPrioLoaded(me.activePrio)) {
            me.activePrio += 1;
            if(!me.requiredComponents[me.activePrio]) {
                me.finished = true;
                me.eventProvider.removeListener('subAppLoaded', me.onSubAppLoaded, me);
                return;
            }
            me.triggerLoadPrio();
        }
    },

    /**
     * Checks if the given priority group key are loaded.
     *
     * @param prio - key of the priority group
     * @return boolean
     */
    isPrioLoaded: function(prio) {
        var me = this,
            prioGroup = me.requiredComponents[prio],
            allLoaded = true;

        Ext.iterate(prioGroup, function(index, item) {
            if(!item) {
                allLoaded = false;
                return false;
            }
        });
        return allLoaded;
    },

    /**
     * Iterates through a list of modules and preloads
     * them based on the priority list.
     *
     * @return void
     */
    triggerLoadPrio: function() {
        var me = this,
            prioGroup = me.requiredComponents[me.activePrio];

        Ext.iterate(prioGroup, function(name, item) {
            if(!Ext.ClassManager.isCreated(name)) {
                Ext.require(name);
            }
        });
    }
});
//
<?php }} ?>