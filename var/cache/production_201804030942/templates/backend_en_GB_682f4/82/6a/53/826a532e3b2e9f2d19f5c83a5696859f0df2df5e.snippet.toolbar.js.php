<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\detail\toolbar.js" */ ?>
<?php /*%%SmartyHeaderCode:173945acda8f1a65685-69627113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '826a532e3b2e9f2d19f5c83a5696859f0df2df5e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\detail\\toolbar.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173945acda8f1a65685-69627113',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f1b18748_90040567',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f1b18748_90040567')) {function content_5acda8f1b18748_90040567($_smarty_tpl) {?>/**
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
 * @author     shopware AG
 */

/**
 * Shopware UI - Article detail page
 * The toolbar component displays a small actions toolbar above the article base data.
 * It contains important article actions such as article deleting or duplication.
 */
//
//
Ext.define('Shopware.apps.Article.view.detail.Toolbar', {

    /**
     * Define that the actions toolbar is an extension of the Ext.toolbar.Toolbar
     * @string
     */
    extend: 'Ext.toolbar.Toolbar',

    /**
     * Set the toolbar position.
     * @string
     */
    dock: 'top',

    /**
     * Set ui styling for the toolbar
     * @string
     */
    ui: 'shopware-ui',

    /**
     * Set css class for this component
     * @string
     */
    cls: 'shopware-toolbar',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-actions-toolbar',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'actions'/'title','default'=>'Article actions','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'title','default'=>'Article actions','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product campaigns<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'title','default'=>'Article actions','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        duplicate: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'actions'/'duplicate','default'=>'Duplicate','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'duplicate','default'=>'Duplicate','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Duplicate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'duplicate','default'=>'Duplicate','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        delete: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'actions'/'delete','default'=>'Delete','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'delete','default'=>'Delete','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'delete','default'=>'Delete','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        translate: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'actions'/'translate','default'=>'Translate','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'translate','default'=>'Translate','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Translate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'translate','default'=>'Translate','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        preview: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'actions'/'preview','default'=>'Preview','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'preview','default'=>'Preview','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Preview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'preview','default'=>'Preview','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        previewLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'actions'/'preview_label','default'=>'Article preview','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'preview_label','default'=>'Article preview','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product preview:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'preview_label','default'=>'Article preview','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        previewShopSelect: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'actions'/'preview_select_shop','default'=>'Select shop','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'preview_select_shop','default'=>'Select shop','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select shop<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'actions'/'preview_select_shop','default'=>'Select shop','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * The initComponent template method is an important initialization step for a Component.
     * It is intended to be implemented by each subclass of Ext.Component to provide any needed constructor logic.
     * The initComponent method of the class being created is called first,
     * with each initComponent method up the hierarchy to Ext.Component being called thereafter.
     * This makes it easy to implement and, if needed, override the constructor logic of the Component at any step in the hierarchy.
     * The initComponent method must contain a call to callParent in order to ensure that the parent class' initComponent method is also called.
     *
     * @return void
     */
    initComponent: function() {
        var me = this,
            mainWindow = me.subApp.articleWindow;

        mainWindow.on('storesLoaded', me.onStoresLoaded, me);
        me.items = me.createToolbarElements();
        me.registerEvents();
        me.callParent(arguments);
    },

    /**
     * Registers additional component events
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the duplicate button
             * @event
             * @param [Ext.data.Model] - The article record
             */
            'duplicateArticle',

            /**
             * Event will be fired when the user clicks the delete button
             * @event
             * @param [Ext.data.Model] - The article record
             */
            'deleteArticle',

            /**
             * Event will be fired when the user clicks the preview button
             * @event
             * @param [Ext.data.Model] - The article record
             * @param [Ext.data.Model] - The selected shop record
             */
            'articlePreview'
        );
    },

    /**
     * Creates all elements for the toolbar
     * @returns Array
     */
    createToolbarElements: function() {
        var me = this,
            items = [];

        items.push(me.createShopComboBox());
        items.push(me.createPreviewButton());
        items.push({ xtype: 'tbspacer', width: 10 });
        items.push(me.createDuplicateButton());
        items.push(me.createDeleteButton());

        return items;
    },

    /**
     * Creates the article preview combobox
     * @returns Ext.container.Container
     */
    createShopComboBox: function() {
        var me = this;

        me.shopComboBox = Ext.create('Ext.form.field.ComboBox', {
            fieldLabel: me.snippets.previewLabel,
            store: me.shopStore,
            queryMode: 'local',
            valueField: 'id',
            displayField: 'name',
            editable: false,
            emptyText: me.snippets.previewShopSelect
        });

        return me.shopComboBox;
    },

    /**
     * Creates the article preview button
     * @returns Ext.button.Button
     */
    createPreviewButton: function() {
        var me = this;

        me.previewButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-globe--arrow',
            text: me.snippets.preview,
            handler: function() {
                me.fireEvent('articlePreview', me.article, me.shopComboBox);
            }
        });

        return me.previewButton;
    },

    /**
     * Creates the duplicate button
     * @returns Ext.button.Button
     */
    createDuplicateButton: function() {
        var me = this;

        me.duplicateButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-duplicate-article',
            text: me.snippets.duplicate,
            handler: function() {
                me.fireEvent('duplicateArticle', me.article);
            }
        });

        return me.duplicateButton;
    },

    /**
     * Creates the delete button
     * @returns Ext.button.Button
     */
    createDeleteButton: function() {
        var me = this;

        me.deleteButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-minus-circle-frame',
            text: me.snippets.delete,
            handler: function() {
                me.fireEvent('deleteArticle', me.article);
            }
        });

        return me.deleteButton;
    },

    /**
     * Event listener method which will be fired when the available batch store is loaded.
     * The batch store contains all necessary data for the product except variants and product attributes.
     * We're using this pattern to provide the fields in the module as soon as possible.
     * The data for example comboboxes or grids will be injected in his method.
     *
     * @param article
     * @param stores
     */
    onStoresLoaded: function(article, stores) {
        var me = this;
        me.article = article;
        me.shopStore = stores['shops'];
        me.shopComboBox.bindStore(me.shopStore);
    }
});
//<?php }} ?>