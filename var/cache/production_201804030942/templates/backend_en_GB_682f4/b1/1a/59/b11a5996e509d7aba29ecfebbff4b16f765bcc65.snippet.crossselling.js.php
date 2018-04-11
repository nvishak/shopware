<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:37
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\controller\crossselling.js" */ ?>
<?php /*%%SmartyHeaderCode:5155acda8f95b4e61-37615884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b11a5996e509d7aba29ecfebbff4b16f765bcc65' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\controller\\crossselling.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5155acda8f95b4e61-37615884',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f96134b8_87019800',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f96134b8_87019800')) {function content_5acda8f96134b8_87019800($_smarty_tpl) {?>/**
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
 * @package    Article
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Controller - Detail
 * The detail controller handles all events of the detail page main form element and the sidebar.
 */
//
//
Ext.define('Shopware.apps.Article.controller.Crossselling', {

    /**
     * Extend from the standard ExtJS 4 controller
     * @string
     */
    extend: 'Enlight.app.Controller',

    /**
     * System texts for the controller.
     *
     * @object
     */
    snippets: {
        growlMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'growl_message','default'=>'Article','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growl_message','default'=>'Article','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growl_message','default'=>'Article','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        existTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sidebar'/'accessory'/'already_assigned_title','default'=>'Already exists','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sidebar'/'accessory'/'already_assigned_title','default'=>'Already exists','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Already exists<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sidebar'/'accessory'/'already_assigned_title','default'=>'Already exists','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        similar: {
            exist: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sidebar'/'similar'/'already_assigned_message','default'=>'The article [0] has been assigned as similar article!','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sidebar'/'similar'/'already_assigned_message','default'=>'The article [0] has been assigned as similar article!','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The item [0] has already been assigned as a similar item!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sidebar'/'similar'/'already_assigned_message','default'=>'The article [0] has been assigned as similar article!','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        accessory: {
            exist: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sidebar'/'accessory'/'already_assigned_message','default'=>'The article [0] has been already assigned as accessory article!','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sidebar'/'accessory'/'already_assigned_message','default'=>'The article [0] has been already assigned as accessory article!','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The item [0] has already been assigned as an accessory item!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sidebar'/'accessory'/'already_assigned_message','default'=>'The article [0] has been already assigned as accessory article!','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        streams: {
            exist: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'already_assigned_message','default'=>'The stream with the ID [0] has already been assigned to this article.','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'already_assigned_message','default'=>'The stream with the ID [0] has already been assigned to this article.','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The Product Stream with the ID [0] has already been assigned to this product.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'already_assigned_message','default'=>'The stream with the ID [0] has already been assigned to this article.','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        saved: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'article_saved'/'title','default'=>'Successful','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'title','default'=>'Successful','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Successful<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'title','default'=>'Successful','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            errorTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'article_saved'/'error_title','default'=>'Error','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'error_title','default'=>'Error','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'error_title','default'=>'Error','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @params  - The main controller can handle a orderId parameter to open the order detail page directly
     * @return void
     */
    init:function () {
        var me = this;

        me.control({
            'article-detail-window article-crossselling-base': {
                addSimilarArticle: me.onAddSimilarArticle,
                removeSimilarArticle: me.onRemoveSimilarArticle,
                addAccessoryArticle: me.onAddAccessoryArticle,
                removeAccessoryArticle: me.onRemoveAccessoryArticle
            },
            'article-detail-window article-crossselling-product-streams': {
                addStream: me.onAddStream,
                removeStream: me.onRemoveStream
            }
        });

        me.callParent(arguments);
    },

    /**
     * Event will be fired when the user want to add a similar article
     *
     * @event
     */
    onAddSimilarArticle: function(form, grid, searchField) {
        var me = this,
            selected = searchField.returnRecord,
            store = grid.getStore(),
            values = form.getValues();

        if (!form.getForm().isValid() || !(selected instanceof Ext.data.Model)) {
            return false;
        }
        var model = Ext.create('Shopware.apps.Article.model.Similar', values);
        model.set('id', selected.get('id'));
        model.set('name', selected.get('name'));
        model.set('number', selected.get('number'));

        //check if the article is already assigned
        var exist = store.getById(model.get('id'));
        if (!(exist instanceof Ext.data.Model)) {
            store.add(model);
            form.getForm().reset();
        } else {
            Shopware.Notification.createGrowlMessage(me.snippets.existTitle,  Ext.String.format(me.snippets.similar.exist, model.get('number')), me.snippets.growlMessage);
        }
    },

    /**
     * Event will be fired when the user want to remove an assigned similar article
     *
     * @event
     */
    onRemoveSimilarArticle: function(grid, record) {
        var me = this,
            store = grid.getStore();

        if (record instanceof Ext.data.Model) {
            store.remove(record);
        }
    },

    /**
     * Event will be fired when the user want to add a similar article
     *
     * @event
     */
    onAddAccessoryArticle: function(form, grid, searchField) {
        var me = this,
            selected = searchField.returnRecord,
            store = grid.getStore(),
            values = form.getValues();

        if (!form.getForm().isValid() || !(selected instanceof Ext.data.Model)) {
            return false;
        }
        var model = Ext.create('Shopware.apps.Article.model.Accessory', values);
        model.set('id', selected.get('id'));
        model.set('name', selected.get('name'));
        model.set('number', selected.get('number'));

        //check if the article is already assigned
        var exist = store.getById(model.get('id'));
        if (!(exist instanceof Ext.data.Model)) {
            store.add(model);
            form.getForm().reset();
        } else {
            Shopware.Notification.createGrowlMessage(me.snippets.existTitle,  Ext.String.format(me.snippets.similar.exist, model.get('number')), me.snippets.growlMessage);
        }

    },

    /**
     * Event will be fired when the user want to remove an assigned similar article
     *
     * @event
     */
    onRemoveAccessoryArticle: function(grid, record) {
        var me = this,
            store = grid.getStore();

        if (record instanceof Ext.data.Model) {
            store.remove(record);
        }
    },

    /**
     * Event will be fired when the user wants to assign a product stream
     *
     * @event
     */
    onAddStream: function(form, grid, streamSelection) {
        var me = this,
            store = grid.getStore(),
            values = form.getValues(),
            streamModel, model, exist;

        if (!form.getForm().isValid()) {
            return;
        }

        streamModel = streamSelection.store.getById(values.id);
        if(streamModel instanceof Ext.data.Model) {
            values.description = streamModel.get('description');
            values.name = streamModel.get('name');
        }

        model = Ext.create('Shopware.apps.Article.model.Stream', values);

        // Check if product stream is already assigned
        exist = store.getById(model.get('id'));
        if (!(exist instanceof Ext.data.Model)) {
            store.add(model);
            form.getForm().reset();
        } else {
            Shopware.Notification.createGrowlMessage(
                me.snippets.existTitle,
                Ext.String.format(me.snippets.streams.exist, model.get('id'))
            );
        }
    },

    /**
     * Event will be fired when the user wants to remove an assigned product stream.
     *
     * @event
     */
    onRemoveStream: function(grid, record) {
        var store = grid.getStore();

        if (record instanceof Ext.data.Model) {
            store.remove(record);
        }
    }
});
//
<?php }} ?>