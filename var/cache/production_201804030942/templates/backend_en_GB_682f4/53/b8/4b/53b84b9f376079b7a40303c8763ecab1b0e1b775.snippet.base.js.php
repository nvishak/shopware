<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:35
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\crossselling\base.js" */ ?>
<?php /*%%SmartyHeaderCode:44795acda8f73f0601-84679843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53b84b9f376079b7a40303c8763ecab1b0e1b775' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\crossselling\\base.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44795acda8f73f0601-84679843',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f745ff50_15593806',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f745ff50_15593806')) {function content_5acda8f745ff50_15593806($_smarty_tpl) {?>/**
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
 * @author shopware AG
 */

/**
 * Shopware UI - Article crosselling page
 */
//
//
Ext.define('Shopware.apps.Article.view.crossselling.Base', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.form.FieldSet',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-crossselling-base',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-crossselling-base',

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
    systemTexts: {
        'productSearch':'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'article_search','default'=>'Article','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'article_search','default'=>'Article','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'article_search','default'=>'Article','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'crossField': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'assignment_field','default'=>'Assignment','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'assignment_field','default'=>'Assignment','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Designation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'assignment_field','default'=>'Assignment','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'crossBox': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'assignment_box','default'=>'Assign each other','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'assignment_box','default'=>'Assign each other','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assign items mutually<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'assignment_box','default'=>'Assign each other','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'delete': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'delete','default'=>'Remove entry','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'delete','default'=>'Remove entry','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Remove entry<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'delete','default'=>'Remove entry','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'name': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'name','default'=>'Article name','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'name','default'=>'Article name','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'name','default'=>'Article name','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Additional events which needs to be registered.
     * @object
     */
    customEvents: {
        addEvent: '',
        removeEvent: ''
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

        me.systemTexts = Ext.apply({ }, me.systemTexts, me.snippets);
        me.title = me.systemTexts.title;

        me.registerAdditionalEvents();

        me.items = [ me.createFormElements(), me.createGridPanel() ];

        me.callParent(arguments);
    },

    /**
     * Registers additional events for the component based on { @link this.customEvents }.
     *
     * @returns void
     */
    registerAdditionalEvents: function() {
        var me = this,
            events = {};

        Ext.iterate(me.customEvents, function(key, value) {
            events[value] = true;
        });

        me.addEvents(events);
    },

    /**
     * Creates the form panel and the necessary fields for the component
     * @returns { Ext.form.Panel }
     */
    createFormElements: function() {
        var me = this;

        return me.form = Ext.create('Ext.form.Panel', {
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
                me.createProductSearch(),
                me.createCheckbox(),
                me.createAddButton()
            ]
        });
    },

    /**
     * Creates a special product search field for the form of the component.
     *
     * @returns { Shopware.form.field.ArticleSearch }
     */
    createProductSearch: function() {
        var me = this;

        return me.productSearch = Ext.create('Shopware.form.field.ArticleSearch', {
            name: 'number',
            fieldLabel: me.systemTexts.productSearch,
            returnValue: 'name',
            hiddenReturnValue: 'number',
            articleStore: Ext.create('Shopware.store.Article'),
            width: '100%',
            anchor: '100%',
            formFieldConfig: {
                labelWidth: 155
            },
            allowBlank: false,
            getValue: function() {
                return this.getSearchField().getValue();
            },
            setValue: function(value) {
                this.getSearchField().setValue(value);
            }
        });
    },

    /**
     * Creates the cross assignment checkbox for the form of the component.
     *
     * @returns { Ext.form.field.Checkbox }
     */
    createCheckbox: function() {
        var me = this;

        return Ext.create('Ext.form.field.Checkbox', {
            name: 'cross',
            labelWidth: 155,
            fieldLabel: me.systemTexts.crossField,
            boxLabel: me.systemTexts.crossBox,
            inputValue: true,
            uncheckedValue: false
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

        return Ext.create('Ext.button.Button', {
            cls: 'small primary',
            text: me.systemTexts.add,
            anchor: 'auto',
            margin: '0 0 0 160',
            handler: function() {
                me.fireEvent(me.customEvents.addEvent, me.form, me.productGrid, me.productSearch);
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

        return me.productGrid = Ext.create('Ext.grid.Panel', {
            title: me.systemTexts.gridTitle,
            cls: Ext.baseCSSPrefix + 'free-standing-grid',
            store: me.gridStore,
            name: me.listingName,
            height: 180,
            columnWidth: 0.65,
            columns: [
                {
                    header: me.systemTexts.productSearch,
                    dataIndex: 'number',
                    width: 120
                }, {
                    header: me.systemTexts.name,
                    dataIndex: 'name',
                    flex: 1
                }, {
                    xtype: 'actioncolumn',
                    width: 30,
                    items: [
                        {
                            iconCls: 'sprite-minus-circle-frame',
                            tooltip: me.systemTexts.delete,
                            handler: function (view, rowIndex, colIndex, item, opts, record) {
                                me.fireEvent(me.customEvents.removeEvent, view, record);
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

        return Ext.create('Ext.container.Container', {
            cls: Ext.baseCSSPrefix + 'global-notice-text',
            html: me.systemTexts.notice
        });
    }
});
//<?php }} ?>