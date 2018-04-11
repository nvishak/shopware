<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\view\list\document.js" */ ?>
<?php /*%%SmartyHeaderCode:162325acda8f4241c15-11943038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b3cea3061b9e235af9429dc4101993d3f35eece' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\view\\list\\document.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162325acda8f4241c15-11943038',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f42a0168_26927467',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f42a0168_26927467')) {function content_5acda8f42a0168_26927467($_smarty_tpl) {?>/**
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
 * @package    Order
 * @subpackage View
 * @version    $Id$
 * @author shopware AG
 */

//

/**
 * Shopware UI - Order list backend module
 *
 * The order document list
 */
//
Ext.define('Shopware.apps.Order.view.list.Document', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.order-document-list',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'document-grid',

    /**
     * The view needs to be scrollable
     * @string
     */
    autoScroll: true,

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        columns: {
            name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'name','default'=>'Name','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'name','default'=>'Name','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'name','default'=>'Name','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            date: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'date','default'=>'Date','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'date','default'=>'Date','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'date','default'=>'Date','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            amount: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'amount','default'=>'Amount','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'amount','default'=>'Amount','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'amount','default'=>'Amount','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            downloadDocument: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'download','default'=>'Download','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'download','default'=>'Download','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Download<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'download','default'=>'Download','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    plugins: [{
        ptype: 'grid-attributes',
        table: 's_order_documents_attributes'
    }],

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
        var me = this;
        me.columns = me.getColumns();
        me.pagingbar = me.getPagingBar();
        me.callParent(arguments);
    },

    /**
     * Creates the grid columns.
     */
    getColumns: function() {
        var me = this;

        return [
            {
                header: me.snippets.columns.date,
                dataIndex: 'date',
                flex: 1,
                renderer: me.dateColumn
            }, {
                header: me.snippets.columns.name,
                dataIndex: 'name',
                flex: 2,
                renderer: me.nameColumn
            }, {
                header: me.snippets.columns.amount,
                dataIndex: 'amount',
                flex: 1,
                renderer: me.amountColumn
            },
            me.createActionColumn()
        ];
    },

    /**
     * Creates the action columns
     *
     * @returns { Ext.grid.column.Action }
     */
    createActionColumn: function() {
        var me = this;

        return Ext.create('Ext.grid.column.Action', {
            width: 60,
            items: [
                me.createDeleteColumn(),
                me.createSendColumn()
            ]
        });
    },

    /**
     * Creates the delete action column item for the grid.
     *
     * @return Object
     */
    createDeleteColumn: function() {
        var me = this;

        return {
            iconCls: 'sprite-minus-circle-frame',
            handler: Ext.bind(me.deleteDocument, me)
        };
    },

    /**
     * Handler for the delete action column.
     *
     * @param { Ext.grid.Panel } view
     * @param { number } rowIndex
     * @param { number } colIndex
     * @param { object } item
     * @param { object } opts
     * @param { Ext.data.Model } record
     */
    deleteDocument: function(view, rowIndex, colIndex, item, opts, record) {
        var me = this;

        me.fireEvent('delete-document', view, record);
    },

    /**
     * Creates the send mail action column item for the grid.
     *
     * @return Object
     */
    createSendColumn: function() {
        var me = this;

        return {
            iconCls: 'sprite-mail-send',
            handler: Ext.bind(me.openMail, me)
        };
    },

    /**
     * Handler for the send mail action column.
     *
     * @param { Ext.grid.Panel } view
     * @param { number } rowIndex
     * @param { number } colIndex
     * @param { object } item
     * @param { object } opts
     * @param { Ext.data.Model } record
     */
    openMail: function(view, rowIndex, colIndex, item, opts, record) {
        var me = this;

        me.fireEvent('open-mail', record);
    },

    /**
     * Creates the paging bar for the document grid.
     */
    getPagingBar: function() {
        var me = this;

        return Ext.create('Ext.toolbar.Paging', {
            store: me.store,
            dock: 'bottom'
        })
    },

    /**
     * Column renderer function which formats the date column of the document grid.
     * @param value
     */
    dateColumn: function(value) {

        if (!Ext.isDate(value)) {
            return value;
        }
        return Ext.util.Format.date(value);
    },

    /**
     * Columns renderer for the name column
     * @param value
     */
    nameColumn: function(value, metaData, record, rowIndex, colIndex, store, view) {
        var helper = new Ext.dom.Helper,
            type = record.getDocType().first(),
            display = type.get('name');

        if (record.get('documentId')) {
            display += ' ' + Ext.String.leftPad(record.get('documentId'), 8, '0');
        }

        var spec = {
            tag: 'a',
            html: display,
            href: '<?php echo '/shopware4/backend/Order/openPdf';?>?id=' + record.get('hash'),
            target: '_blank'
        };

        return helper.markup(spec);
    },

    /**
     * Column renderer function which formats the amount column with the Ext.util.Format.currency() function.
     * @param value
     */
    amountColumn: function(value) {
        if (!Ext.isNumeric(value)) {
            return value;
        }
        return Ext.util.Format.currency(value);
    }

});
//

<?php }} ?>