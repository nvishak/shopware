<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\controller\split_view.js" */ ?>
<?php /*%%SmartyHeaderCode:7925acda8f466ef67-96415545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d1b099aacc5b6ea40c45f31710a22d0446c190e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\controller\\split_view.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7925acda8f466ef67-96415545',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f46a61f4_94188739',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f46a61f4_94188739')) {function content_5acda8f46a61f4_94188739($_smarty_tpl) {?>/**
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
 * The list controller handles the split view mode
 */
//
//
Ext.define('Shopware.apps.ArticleList.controller.SplitView', {

    /**
     * The parent class that this class extends.
     * @string
     */
    extend: 'Ext.app.Controller',

    // Is the split mode active?
    splitViewMode: false,

    /**
     * Here the dimension / position of the listing window *before* split mode
     * can be saved
     */
    defaultState: {
        x: 0,
        y: 0,
        width: 0,
        height: 0
    },

    refs: [
        { ref:'sidebar', selector:'multi-edit-sidebar' },
    ],

    /**
     * Ref to the main window, set up on init, when we are sure the main window exists.
     */
    mainWindow: null,

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @return void
     */
    init: function () {
        var me = this;

        me.control({
            'multi-edit-main-grid': {
                triggerSplitView: me.onTriggerSplitView,
                productchange: me.onProductChange
            }
        });

        Shopware.app.Application.addEvents(
            'moduleConnector:splitView',
            'moduleConnector:splitViewClose'
        );

        Shopware.app.Application.on('moduleConnector:splitViewClose', me.onCloseSplitView, me);

        me.mainWindow = me.getController('Main').mainWindow;

        me.callParent(arguments);
    },

    /**
     * Called when the split view should be triggered.
     * Will minimize the sidebar, resize the list window and
     * open the article detail window
     *
     * @param btn
     * @param record
     * @returns boolean
     */
    onTriggerSplitView: function(btn, record) {
        var me = this,
            mainWindow = me.getController('Main').mainWindow,
            tmpPosition = mainWindow.getPosition(),
            position = {
                x: tmpPosition[0],
                y: tmpPosition[1] - 40
            };

        if(!record) {
            return;
        }

        // Is a split view already been up and running...
        if(me.splitViewMode) {
            Ext.MessageBox.alert('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'splitview_title','default'=>'Split-View','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'splitview_title','default'=>'Split-View','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Split-View<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'splitview_title','default'=>'Split-View','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'split_view_already_active','default'=>'The split view mode has already been activated. Please close the product mask window and start a new instance of the split view.','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'split_view_already_active','default'=>'The split view mode has already been activated. Please close the product mask window and start a new instance of the split view.','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The split view mode has already been activated. Please close the product mask window and start a new instance of the split view.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'split_view_already_active','default'=>'The split view mode has already been activated. Please close the product mask window and start a new instance of the split view.','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            return false;
        }

        // Add inidicator to the class that the split view mode is up and running...
        if(!me.hasOwnProperty('splitViewMode') || !me.splitViewMode) {
            me.splitViewMode = true;
        }

        Shopware.Notification.createGrowlMessage('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'splitview_title','default'=>'Split-View','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'splitview_title','default'=>'Split-View','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Split-View<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'splitview_title','default'=>'Split-View','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'splitview_text','default'=>'The split view mode has been activated.','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'splitview_text','default'=>'The split view mode has been activated.','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The split view mode has been activated.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'splitview_text','default'=>'The split view mode has been activated.','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

        // Save the position and the size of the product list
        me.defaultState = Ext.Object.merge(me.defaultState, mainWindow.getSize());
        me.defaultState = Ext.Object.merge(me.defaultState, position);

        // Prepare the article list
        me.getSidebar().collapse();
        mainWindow.setPosition(0,0);
        mainWindow.setSize(Ext.Element.getViewportWidth() / 2, Ext.Element.getViewportHeight() - 90);

        // Open the product module and set it up for the splitview mode
        Shopware.app.Application.addSubApplication({
            name: 'Shopware.apps.Article',
            action: 'detail',
            params: {
                splitViewMode: true,
                articleId: record.get('Article_id')
            }
        });
    },

    /**
     * Called when the selected product changed. Will trigger an even in order
     * to show another article in the article detail window
     *
     * @param selection
     * @returns boolean
     */
    onProductChange: function(selection) {
        var me = this,
            record = selection[0];

        // No record was selected...
        if(!record) {
            return false;
        }

        Shopware.app.Application.fireEvent('moduleConnector:splitView', me, {
            articleId: record.get('Article_id')
        });
    },

    /**
     * Called when the article window was closed. Will restore the old
     * article list dimension / position
     */
    onCloseSplitView: function() {
        var me = this,
            mainWindow = me.mainWindow;

        if (!Ext.isEmpty(mainWindow)) {
            mainWindow.setSize(me.defaultState);
            mainWindow.setPosition(me.defaultState.x, me.defaultState.y);
        }
        me.splitViewMode = false;
    }

});
//
<?php }} ?>