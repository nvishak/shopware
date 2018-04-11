<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\view\backup\window.js" */ ?>
<?php /*%%SmartyHeaderCode:204565acda8f27e7490-41133478%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e620dfd976eb7bbdfd682fda0adc32f48e0fcd0f' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\view\\backup\\window.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204565acda8f27e7490-41133478',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f28151f5_15918872',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f28151f5_15918872')) {function content_5acda8f28151f5_15918872($_smarty_tpl) {?>/**
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
//
Ext.define('Shopware.apps.ArticleList.view.Backup.Window', {
    /**
     * Define that the plugin manager main window is an extension of the enlight application window
     * @string
     */
    extend: 'Enlight.app.Window',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.multi-edit-backup-window',

    /**
     * Set no border for the window
     * @boolean
     */
    border: false,

    /**
     * Set border layout for the window
     * @string
     */

    /**
     * Define window width
     * @integer
     */
    width: 820,

    /**
     * Define window height
     * @integer
     */
    height: 400,

    /**
     * True to display the 'maximize' tool button and allow the user to maximize the window, false to hide the button and disallow maximizing the window.
     * @boolean
     */
    maximizable: true,

    /**
     * True to display the 'minimize' tool button and allow the user to minimize the window, false to hide the button and disallow minimizing the window.
     * @boolean
     */
    minimizable: true,

    /**
     * A flag which causes the object to attempt to restore the state of internal properties from a saved state on startup.
     */
    stateful: false,

    /**
     * Title of the window.
     * @string
     */
    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'windowTitle','default'=>'Revert changes','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'windowTitle','default'=>'Revert changes','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Revert changes<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'windowTitle','default'=>'Revert changes','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    resizable: true,

    /**
     * Set the windows layout to "fit"
     */
    layout: 'fit',


    /**
     * Initializes the component.
     *
     * @public
     * @return void
     */
    initComponent: function () {
        var me = this;


        me.items = [{
            xtype: 'container',
            layout: {
                type: 'vbox',
                pack: 'start',
                align: 'stretch'
            },
            items: [
                me.getNotificationBox(),
                me.getLabel(),
                {
                    xtype: 'multi-edit-backup-grid',
                    store: me.backupStore,
                    flex: 1,
                    border: 0
                }
            ]
        }];

        me.callParent(arguments);
    },

    /**
     * Returns a label with additional descriptions
     *
     * @returns { { xtype: string, margin: string, items: Array } }
     */
    getLabel: function() {
        var me = this;

        return {
            xtype: 'container',
            margin: '0 10 10 10',
            items: [{
                xtype: 'label',
                html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'description','default'=>'A revert is not a full database backup. Only those fields modified during the batch edit will be reverted.','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'description','default'=>'A revert is not a full database backup. Only those fields modified during the batch edit will be reverted.','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
A revert is not a full database backup. Only those fields modified during the batch edit will be reverted.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'description','default'=>'A revert is not a full database backup. Only those fields modified during the batch edit will be reverted.','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            }]
        };
    },

    /**
     * Returns a warning block-message
     *
     * @returns Ext.container.Container
     */
    getNotificationBox: function() {
        var me = this,
            notification = Shopware.Notification.createBlockMessage('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'notice','default'=>'This functionality is not a replacement for backups','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'notice','default'=>'This functionality is not a replacement for backups','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
This functionality is not a replacement for backups<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'notice','default'=>'This functionality is not a replacement for backups','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'error');

        notification.margin = '10 5';

        return notification;
    }
});
//
<?php }} ?>