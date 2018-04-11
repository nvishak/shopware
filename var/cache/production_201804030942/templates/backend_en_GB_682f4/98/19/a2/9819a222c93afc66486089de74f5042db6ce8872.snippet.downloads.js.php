<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:35
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\resources\downloads.js" */ ?>
<?php /*%%SmartyHeaderCode:191145acda8f77f8f32-96148614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9819a222c93afc66486089de74f5042db6ce8872' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\resources\\downloads.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191145acda8f77f8f32-96148614',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f7869c70_36108830',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f7869c70_36108830')) {function content_5acda8f7869c70_36108830($_smarty_tpl) {?>/**
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
 * Shopware UI - Article resources - Downloads
 * The link component contains the configuration elements for the article links
 * and article downloads.
 */
//
//
Ext.define('Shopware.apps.Article.view.resources.Downloads', {
    /**
     * Define that the billing field set is an extension of the Ext.form.FieldSet
     * @string
     */
    extend: 'Ext.form.FieldSet',
    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-resources-downloads',
    /**
     * Set css class for this component
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-resources-downloads',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'resources'/'downloads'/'field_set','default'=>'Downloads','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'field_set','default'=>'Downloads','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Downloads<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'field_set','default'=>'Downloads','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        notice: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'resources'/'downloads'/'notice','default'=>'Optionally, add additional downloads (e.g. pdf files).','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'notice','default'=>'Optionally, add additional downloads (e.g. pdf files).','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add downloads (e.g., pdf files)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'notice','default'=>'Optionally, add additional downloads (e.g. pdf files).','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'resources'/'downloads'/'name','default'=>'Name','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'name','default'=>'Name','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'name','default'=>'Name','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        link: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'resources'/'downloads'/'link','default'=>'File','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'link','default'=>'File','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
File<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'link','default'=>'File','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        button: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'resources'/'downloads'/'button','default'=>'Add download','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'button','default'=>'Add download','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add download<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'button','default'=>'Add download','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        grid: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'resources'/'downloads'/'grid'/'title','default'=>'Created downloads','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'grid'/'title','default'=>'Created downloads','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Created downloads<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'grid'/'title','default'=>'Created downloads','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            delete: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'resources'/'downloads'/'grid'/'delete','default'=>'Remove download','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'grid'/'delete','default'=>'Remove download','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Remove download<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'resources'/'downloads'/'grid'/'delete','default'=>'Remove download','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
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
    initComponent: function () {
        var me = this;
        me.items = me.createElements();
        me.title = me.snippets.title;
        me.registerEvents();
        me.callParent(arguments);
    },

    /**
     * Creates the container for the download form panel and the download grid.
     * @return Ext.container.Container
     */
    createElements: function() {
        var me = this;

        me.downloadForm = me.createDownloadForm();
        me.downloadGrid = me.createDownloadGrid();

        me.downloadElements = Ext.create('Ext.container.Container', {
            layout: 'column',
            items: [
                {
                    xtype: 'container',
                    columnWidth: 0.35,
                    margin: '0 20 0 0',
                    items: [ me.downloadForm ]
                }, {
                    xtype: 'container',
                    columnWidth: 0.65,
                    items: [ me.downloadGrid ]
                }
            ]
        });

        return [ me.downloadElements ];
    },

    /**
     * Registers additional component events.
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user clicks on the add download button
             *
             * @event
             * @param [Ext.grid.Panel] The download grid
             * @param [Ext.form.Panel] The download panel for the link
             */
            'addDownload',
            /**
             * Event will be fired when the user clicks on the remove icon of a grid entry
             *
             * @event
             * @param [Ext.grid.Panel] The download grid
             * @param [Ext.data.Model] The download record
             */
            'removeDownload'
        );
    },

    /**
     * Creates the form panel for the download container.
     * @return Ext.form.Panel
     */
    createDownloadForm: function() {
        var me = this;

        // Media selection field
        me.mediaSelection = Ext.create('Shopware.MediaManager.MediaSelection', {
            fieldLabel: me.snippets.link,
            labelWidth: 155,
            name: 'file',
            multiSelect: false,
            anchor: '100%',
            allowBlank: false,
            buttonOnly: false,
            buttonText: false,
            // Setting width manually as firefox shows a very small button otherwise
            buttonConfig: {
                width: 30
            }
        });

        me.downloadFormElements = Ext.create('Ext.form.Panel', {
            cls: 'shopware-form',
            layout: 'anchor',
            border: false,
            defaults: {
                labelWidth: 155,
                anchor: '100%'
            },
            items: [
                {
                    xtype: 'container',
                    cls: Ext.baseCSSPrefix + 'global-notice-text',
                    html: me.snippets.notice
                }, {
                    xtype: 'textfield',
                    name: 'name',
                    fieldLabel: me.snippets.name,
                    allowBlank: true
                },
                me.mediaSelection,
                {
                    xtype: 'button',
                    cls: 'small primary',
                    text: me.snippets.button,
                    anchor: 'auto',
                    margin: '0 0 0 160',
                    handler: function() {
                        me.fireEvent('addDownload', me.downloadGrid, me.downloadForm)
                    }
                }
            ]
        });

        return me.downloadFormElements;
    },

    /**
     * Creates the grid for the already assigned article downloads
     * @return Ext.grid.Panel
     */
    createDownloadGrid: function() {
        var me = this;

        me.downloadGridElements = Ext.create('Ext.grid.Panel', {
            title: me.snippets.grid.title,
            store: me.article.getDownload(),
            name: 'download-listing',
            height: 180,
            plugins: [
                {
                    ptype: 'grid-attributes',
                    table: 's_articles_downloads_attributes'
                },
                Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 1
                })
            ],
            columns: [
                {
                    header: me.snippets.name,
                    dataIndex: 'name',
                    flex: 1,
                    editor: {
                        xtype: 'textfield'
                    }
                }, {
                    header: me.snippets.link,
                    dataIndex: 'file',
                    flex: 1
                }, {
                    xtype: 'actioncolumn',
                    width: 30,
                    items: [
                        {
                            iconCls: 'sprite-minus-circle-frame',
                            tooltip: me.snippets.grid.delete,
                            handler: function (view, rowIndex, colIndex, item,opts, record) {
                                me.fireEvent('removeDownload', me.downloadGrid, record)
                            }
                        }
                    ]
                }
            ]
        });

        return me.downloadGridElements;
    }
});
//<?php }} ?>