<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:35
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\crossselling\product_streams.js" */ ?>
<?php /*%%SmartyHeaderCode:218365acda8f7510b98-79993804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '399990e052b8b77a7c1bf216abf89a513da542ac' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\crossselling\\product_streams.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '218365acda8f7510b98-79993804',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f758a517_55330559',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f758a517_55330559')) {function content_5acda8f758a517_55330559($_smarty_tpl) {?>/**
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
 * @subpackage Esd
 * @version    $Id$
 * @author     shopware AG
 */

/**
 * Shopware UI - Article crosselling page
 */
//
//
Ext.define('Shopware.apps.Article.view.crossselling.ProductStreams', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.form.FieldSet',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-crossselling-product-streams',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-crossselling-product-streams',

    /**
     * Padding of the body element of the component
     * @number
     */
    bodyPadding: 10,

    /**
     * Layout type of the component.
     * @string
     */
    layout: 'column',

    /**
     * Default snippets for the component. The snippets will be merged with the
     * provided snippets at initialization of the component.
     * @object
     */
    snippets: {
        'title': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'title','default'=>'Product streams','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'title','default'=>'Product streams','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product Streams<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'title','default'=>'Product streams','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'gridTitle': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'grid_title','default'=>'Assigned product streams','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'grid_title','default'=>'Assigned product streams','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigned Product Streams<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'grid_title','default'=>'Assigned product streams','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'notice': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'notice','default'=>'Custom product streams can be assigned to the article. The product streams will be shown as additional tab panels on the article detail page.','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'notice','default'=>'Custom product streams can be assigned to the article. The product streams will be shown as additional tab panels on the article detail page.','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Products can be assigned to custom Product Streams. The Product Streams will be shown as additional tab panels on the product detail page.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'notice','default'=>'Custom product streams can be assigned to the article. The product streams will be shown as additional tab panels on the article detail page.','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'streamId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'stream_id','default'=>'Stream ID','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_id','default'=>'Stream ID','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stream ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_id','default'=>'Stream ID','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'streamName': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'stream_name','default'=>'Name','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_name','default'=>'Name','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_name','default'=>'Name','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'streamDescription': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'stream_description','default'=>'Description','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_description','default'=>'Description','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_description','default'=>'Description','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'addStream': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'stream_add','default'=>'Add product stream','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_add','default'=>'Add product stream','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add Product Stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_add','default'=>'Add product stream','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'removeStream': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cross_selling'/'streams'/'stream_remove','default'=>'Delete product stream','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_remove','default'=>'Delete product stream','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Remove Product Stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cross_selling'/'streams'/'stream_remove','default'=>'Delete product stream','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
     * @returns void
     */
    initComponent: function() {
        var me = this;

        me.title = me.snippets.title;

        me.items = [ me.createFormElements(), me.createGridPanel() ];

        me.callParent(arguments);
    },

    /**
     * Registers additional component events.
     */
    registerEvents: function() {
        this.addEvents(

            /**
             * Event will be fired when the user clicks on the add Product-Stream button.
             *
             * @event
             * @param { Ext.form.Panel } The stream form
             * @param { Ext.grid.Panel } The grid for the assigned streams
             * @param { Shopware.form.field.ProductStreamSelection }
             *        The stream selection component
             */
            'addStream',

            /**
             * Event will be fired when the user clicks on the remove Product-Stream button
             * within the Product-Streams grid.
             *
             * @event
             * @param { Ext.grid.View } The grid view
             * @param { Ext.data.Model } The streams record
             */
            'removeStream'
        )
    },

    /**
     * Creates the form panel and the necessary fields for the component
     * @returns { Ext.form.Panel }
     */
    createFormElements: function() {
        var me = this;

        return me.streamForm = Ext.create('Ext.form.Panel', {
            margin: '0 20 0 0',
            layout: 'anchor',
            border: false,
            columnWidth: 0.35,
            defaults: {
                labelWidth: 155,
                anchor: '100%'
            },
            items: [
                me.createNoticeContainer(),
                me.createStreamSelection(),
                me.createAddButton()
            ]
        });
    },

    /**
     * Creates a special product stream search field.
     *
     * @returns { Shopware.form.field.ProductStreamSelection }
     */
    createStreamSelection: function() {
        return this.streamSelection = Ext.create('Shopware.form.field.ProductStreamSelection', {
            name: 'id',
            allowBlank: false
        });
    },

    /**
     * Creates the add button to the form of the component. The button adds the provided
     * data as a new model to the grid panel.
     *
     * @returns { Ext.button.Button }
     */
    createAddButton: function() {
        var me = this;

        return me.streamAddButton = Ext.create('Ext.button.Button', {
            cls: 'small primary',
            anchor: 'auto',
            margin: '0 0 0 160',
            text: me.snippets.addStream,
            handler: function() {
                me.fireEvent('addStream', me.streamForm, me.streamGrid, me.streamSelection);
            }
        });
    },

    /**
     * Creates the grid panel which displays the provided data of the component.
     *
     * @returns { Ext.grid.Panel }
     */
    createGridPanel: function() {
        var me = this;

        return me.streamGrid = Ext.create('Ext.grid.Panel', {
            title: me.snippets.gridTitle,
            cls: Ext.baseCSSPrefix + 'free-standing-grid',
            name: 'streams-listing',
            minHeight: 180,
            store: me.streamStore,
            columnWidth: 0.65,
            columns: [
                {
                    header: me.snippets.streamId,
                    dataIndex: 'id',
                    width: 100
                }, {
                    header: me.snippets.streamName,
                    dataIndex: 'name',
                    flex: 1
                }, {
                    header: me.snippets.streamDescription,
                    dataIndex: 'description',
                    flex: 1
                }, {
                    xtype: 'actioncolumn',
                    width: 30,
                    items: [
                        {
                            iconCls: 'sprite-minus-circle-frame',
                            tooltip: me.snippets.removeStream,
                            handler: function (view, rowIndex, colIndex, item, opts, record) {
                                me.fireEvent('removeStream', view, record);
                            }
                        }
                    ]
                }
            ]
        });
    },

    /**
     * Creates a new container which acts as a notice for the user.
     *
     * @returns { Ext.container.Container }
     */
    createNoticeContainer: function() {
        var me = this;

        return me.streamNotice = Ext.create('Ext.container.Container', {
            cls: Ext.baseCSSPrefix + 'global-notice-text',
            html: me.snippets.notice
        });
    }
});
//<?php }} ?>