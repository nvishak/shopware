<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:35
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\statistics\list.js" */ ?>
<?php /*%%SmartyHeaderCode:264005acda8f70042c6-67194270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad8fcf07f67b3200c32faa226fb3ca4755f6e990' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\statistics\\list.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '264005acda8f70042c6-67194270',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f7065f44_36151341',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f7065f44_36151341')) {function content_5acda8f7065f44_36151341($_smarty_tpl) {?>/**
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
 * Shopware UI - Article esd page
 */
//
//
Ext.define('Shopware.apps.Article.view.statistics.List', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-statistics-list',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-statistics-list',

    sortableColumns: false,
    features: [{
        ftype: 'summary'
    }],

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'title','default'=>'Overview','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'title','default'=>'Overview','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Overview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'title','default'=>'Overview','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        columns:{
            date: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'column'/'date','default'=>'Date','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'column'/'date','default'=>'Date','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'column'/'date','default'=>'Date','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            revenue: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'column'/'revenue','default'=>'Revenue','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'column'/'revenue','default'=>'Revenue','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Turnover<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'column'/'revenue','default'=>'Revenue','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            orders: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'column'/'orders','default'=>'Orders','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'column'/'orders','default'=>'Orders','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Orders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'column'/'orders','default'=>'Orders','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        toolbar:{
            from:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'toolbar'/'from','default'=>'From','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'toolbar'/'from','default'=>'From','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'toolbar'/'from','default'=>'From','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            to:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'toolbar'/'to','default'=>'To','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'toolbar'/'to','default'=>'To','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'toolbar'/'to','default'=>'To','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            filter:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'toolbar'/'filter','default'=>'Filter','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'toolbar'/'filter','default'=>'Filter','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Filter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'toolbar'/'filter','default'=>'Filter','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Initialize the Shopware.apps.Article.view.statistics.List and defines the necessary default configuration
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.title = me.snippets.title;

        me.registerEvents();

        me.columns = me.getColumns();
        me.toolbar = me.getToolbar();
        me.dockedItems = [ me.toolbar, me.pagingbar ];

        me.callParent(arguments);
    },

    /**
     * Defines additional events which will be fired from the component
     *
     * @return void
     */
    registerEvents:function () {
        this.addEvents(
                /**
                 * Event will be fired when the user clicks the delete button in the toolbar or
                 * use the action column of the grid to remove one or multiple statistics
                 * @event deleteEsd
                 * @param [array] Record - The selected records
                 */
                'dateChange'
        );
    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns: function () {
        var me = this;

        return [
            {
                header: me.snippets.columns.date,
                xtype: 'datecolumn',
                dataIndex: 'date',
                flex: 1
            },
            {
                header: me.snippets.columns.revenue,
                dataIndex: 'revenue',
                summaryType: 'sum',
                summaryRenderer: me.summaryRenderer,
                align: 'right',
                flex: 1
            },
            {
                header: me.snippets.columns.orders,
                dataIndex: 'orders',
                summaryType: 'sum',
                summaryRenderer: me.summaryRenderer,
                align: 'right',
                flex: 1
            }
        ];
    },

    /**
     * Creates the grid toolbar with the different buttons.
     * @return [Ext.toolbar.Toolbar] grid toolbar
     */
    getToolbar: function () {
        var me   = this,
        theFirst = new Date(),
        today    = new Date();

        theFirst.setDate(1);

        me.fromDate = Ext.create('Ext.form.field.Date', {
            fieldLabel: me.snippets.toolbar.from,
            name: 'from_date',
            maxValue: today,
            value: theFirst
        });

        me.toDate = Ext.create('Ext.form.field.Date', {
            fieldLabel: me.snippets.toolbar.to,
            name: 'to_date',
            maxValue: today,
            value: today
        });

        var filterButton = Ext.create('Ext.button.Button', {
            text: me.snippets.toolbar.filter,
            cls: 'small secondary',
            scope : this,
            handler: function() {
                me.fireEvent('dateChange', me.fromDate.getValue(), me.toDate.getValue());
            }
        });

        var toolbar = Ext.create('Ext.toolbar.Toolbar', {
            items: [ me.fromDate, me.toDate, filterButton]
        });

        return toolbar;
    },

    /**
     * Normalizes numbers
     *
     * @param [Object] value - The calculated value.
     * @return [string]
     */
    summaryRenderer: function(value) {
        if (value !== parseInt(value, 10)) {
            value = Ext.util.Format.number(value, '0.00');
        }

        return '<b>' + value + '</b>';
    }
});
//

<?php }} ?>