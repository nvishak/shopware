<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\customer_stream\preview.js" */ ?>
<?php /*%%SmartyHeaderCode:247055acda8f434f308-77924029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76eb08a3a647b63ce1cf33093b8139076f224fa3' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\customer_stream\\preview.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '247055acda8f434f308-77924029',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f449d054_10275111',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f449d054_10275111')) {function content_5acda8f449d054_10275111($_smarty_tpl) {?>/**
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
 * @package    Customer
 * @subpackage List
 * @version    $Id$
 * @author shopware AG
 */

// 

/**
 * Shopware UI - Customer list backend module
 * The customer list view displays the data of the list store.
 * One row displays the head data of a customer.
 */
// 
Ext.define('Shopware.apps.Customer.view.customer_stream.Preview', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
    */
    alias: 'widget.customer-list',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'customer-grid',

    /**
     * The view needs to be scrollable
     * @string
     */
    autoScroll: true,

    /**
     * Defaults for the grid panel.
     * @object
     */
    defaults: { flex: 1 },

    displayDeleteIcon: false,

    /**
     * Initialize the Shopware.apps.Customer.view.main.List and defines the necessary
     * default configuration
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.columns = me.getColumns();

        me.dockedItems = [ me.getPagingBar() ];

        me.callParent(arguments);

        var header = me.headerCt;

        header.on('menucreate', function (ct, menu) {
            menu.remove(menu.items.items[2]);
            menu.remove(menu.items.items[1]);
            menu.remove(menu.items.items[0]);

            menu.add([
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'number','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'number','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'number','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\NumberSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'first_login','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'first_login','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer since<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'first_login','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\CustomerSinceSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'customer_group','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_group','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer group<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_group','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\CustomerGroupSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lastname','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lastname','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lastname','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\LastNameSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'city','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'city','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
City<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'city','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\CitySorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'zip_code','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'zip_code','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Zip code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'zip_code','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\ZipCodeSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'street','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'street','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Street<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'street','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\StreetNameSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'invoice_amount_sum','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'invoice_amount_sum','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Total amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'invoice_amount_sum','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\TotalAmountSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'average_amount','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_amount','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ø Amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_amount','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\AverageAmountSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ø Product amount <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\AverageProductAmountSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'count_orders','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'count_orders','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order count<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'count_orders','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\TotalOrderSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'last_order_time','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'last_order_time','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last order time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'last_order_time','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\LastOrderSorting'),
                me.createSortingItem('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'age','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'age','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Age<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'age','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\AgeSorting')
            ]);
        });

        header.on('headerclick', Ext.bind(me.handleColumnSorting, me));
    },

    handleColumnSorting: function(ct, column, e, t, eOpts) {
        var me = this,
            colSortClsPrefix = Ext.baseCSSPrefix + 'column-header-sort-',
            ascCls = colSortClsPrefix + 'ASC',
            descCls = colSortClsPrefix + 'DESC',
            ownerHeaderCt = column.getOwnerHeaderCt(),
            oldSortState = column.mySortState,
            state = 'ASC',
            headers = ownerHeaderCt.getGridColumns();

        if (oldSortState === 'ASC') {
            state = 'DESC';
        }

        column.addCls(colSortClsPrefix + state);

        switch (state) {
            case 'DESC':
                column.removeCls([ascCls]);
                break;
            case 'ASC':
                column.removeCls([descCls]);
                break;
        }

        if (ownerHeaderCt && !column.triStateSort) {
            for (var i = 0; i < headers.length; i++) {
                if (headers[i] !== column) {
                    headers[i].removeCls([ascCls, descCls]);
                }
            }
        }
        column.mySortState = state;

        me.sortingHandler(column.sortingClass, state);
    },

    createSortingItem: function(text, sortingClass) {
        var me = this;

        return {
            text: text,
            sortingClass: sortingClass,
            menu: {
                items: [
                    { text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ascending','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ascending','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ascending<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ascending','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        handler: function () {
                            me.sortingHandler(sortingClass, 'ASC');
                        } },
                    { text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'descending','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'descending','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Descending<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'descending','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        handler: function () {
                            me.sortingHandler(sortingClass, 'DESC');
                        } }
                ]
            }
        };
    },

    sortingHandler: function(sortingClass, direction) {
        var me = this;

        var sorting = { };
        sorting[sortingClass] = {
            direction: direction
        };
        me.getStore().getProxy().extraParams.sorting = Ext.JSON.encode(sorting);
        me.getStore().load();
    },

    renderCurrency: function(value) {
        value = value * 1;
        return Ext.util.Format.currency(value, this.subApp.currencySign, 2, (this.subApp.currencyAtEnd == 1));
    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns: function () {
        var me = this;

        return [{
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'information','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'information','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'information','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'customernumber',
            sortable: false,
            sortingClass: 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\NumberSorting',
            flex: 2,
            renderer: function (value, meta, record) {
                return '<b>' + record.get('customernumber') + '</b> - ' + record.get('customer_group_name') +
                    '<br><i><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'first_login','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'first_login','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer since<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'first_login','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: ' + Ext.util.Format.date(record.get('firstlogin')) + '</i></span>';
            }
        }, {
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'customer','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'lastname',
            sortable: false,
            sortingClass: 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\LastNameSorting',
            flex: 2,
            renderer: function (v, meta, record) {
                var names = [
                    record.get('title'),
                    record.get('firstname'),
                    record.get('lastname')
                ];

                var name = '<b>' + names.join(' ') + '</b>';
                var age = '';
                if (record.get('age')) {
                    age = ' (' + record.get('age') + ')';
                }
                var company = '';
                if (record.get('company')) {
                    company = '<br>' + record.get('company') + '';
                }

                var mail = Ext.String.format('<a href="mailto:[0]" data-qtip="[0]">[0]</a>', record.get('email'));

                return name + age + company + '<br>' + mail;
            }
        }, {
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'address','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'address','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'address','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'city',
            sortable: false,
            sortingClass: 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\CitySorting',
            flex: 3,
            renderer: function(v, meta, record) {
                var lines = [
                    record.get('street'),
                    [record.get('zipcode'), record.get('city'), record.get('country_name')].join(' '),
                    record.get('additional_address_line1'),
                    record.get('additional_address_line2')
                ];
                return lines.join('<br>');
            }
        }, {
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'amount_header','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'amount_header','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Amounts<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'amount_header','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'invoice_amount_sum',
            sortable: false,
            sortingClass: 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\TotalAmountSorting',
            flex: 2,
            renderer: function(v, meta, record) {
                return '' +
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'invoice_amount_sum','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'invoice_amount_sum','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Total amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'invoice_amount_sum','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <b>' + me.renderCurrency(record.get('invoice_amount_sum')) + '</b>' +
                    '<br><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'average_amount','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_amount','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ø Amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_amount','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <b>' + me.renderCurrency(record.get('invoice_amount_avg')) + '</b>' +
                    '<br><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ø Product amount <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'average_product_amount','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: <b>' + me.renderCurrency(record.get('product_avg')) + '</b>';
            }
        }, {
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'order_header','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'order_header','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'order_header','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'count_orders',
            flex: 3,
            sortable: false,
            sortingClass: 'Shopware\\Bundle\\CustomerSearchBundle\\Sorting\\TotalOrderSorting',
            renderer: function(v, meta, record) {
                return '<b><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'count_orders','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'count_orders','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order count<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'count_orders','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: ' + record.get('count_orders') * 1 + '</b>' +
                    '<br><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'last_order_time','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'last_order_time','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last order time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'last_order_time','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: ' + Ext.util.Format.date(record.get('last_order_time'));
            }
        }, {
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'assigned_streams','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'assigned_streams','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigned streams<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'assigned_streams','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dataIndex: 'streams',
            flex: 2,
            sortable: false,
            renderer: function(streams) {
                if (streams.length <= 0) {
                    return;
                }

                var names = [];
                Ext.each(streams, function(item) {
                    names.push('<a href="#" class="stream-inline" data-id="' + item.id + '">' + item.name + '</a>');
                });

                return names.join('<br>');
            }
        }
        , {
            xtype: 'actioncolumn',
            width: 60,
            items: [
                /* <?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('privilege'=>'detail'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?> */
                {
                    iconCls: 'sprite-pencil',
                    action: 'editCustomer',
                    handler: function (view, rowIndex, colIndex, item, opts, record) {
                        me.fireEvent('edit', record);
                    }
                },
                /* <?php }?> */
                /* <?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('privilege'=>'delete'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?> */
                {
                    action: 'delete',
                    iconCls: 'sprite-cross',
                    getClass: function() {
                        if (!me.displayDeleteIcon) {
                            return 'x-hidden';
                        }
                        return '';
                    },
                    handler: function (view, rowIndex, colIndex, item, opts, record) {
                        me.fireEvent('delete', record);
                    }
                }
                /* <?php }?> */
            ]
        }

        ];
    },

    /**
     * Creates the paging toolbar for the customer grid to allow
     * and store paging. The paging toolbar uses the same store as the Grid
     *
     * @return Ext.toolbar.Paging The paging toolbar for the customer grid
     */
    getPagingBar: function () {
        var me = this;

        var comboStore = Ext.create('Ext.data.Store', {
            fields: [ 'value', 'display' ],
            data: [
                { value: 10, display: '10 <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'items','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { value: 20, display: '20 <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'items','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { value: 50, display: '50 <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'items','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { value: 100, display: '100 <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'items','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' },
                { value: 200, display: '200 <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'items','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' }
            ]
        });

        var combo = Ext.create('Ext.form.field.ComboBox', {
            store: comboStore,
            valueField: 'value',
            displayField: 'display',
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'items_per_page','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items_per_page','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Items per page<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'items_per_page','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            labelStyle: 'margin-top: 2px',
            width: 220,
            labelWidth: 110,
            listeners: {
                scope: me,
                change: Ext.bind(me.onPerPageChange, me)
            }
        });

        var toolbar = Ext.create('Ext.toolbar.Paging', {
            store: me.store,
            dock: 'bottom',
            displayInfo: true
        });

        toolbar.add([{ xtype: 'tbspacer' }, combo]);
        combo.setValue(toolbar.store.pageSize);

        return toolbar;
    },

    /**
     * Formats the date column
     *
     * @param value [string] - The order time value
     * @return [string] - The passed value, formatted with Ext.util.Format.date()
     */
    dateColumn: function (value) {
        return !value ? value : Ext.util.Format.date(value);
    },

    onPerPageChange: function(comp, newValue) {
        var me = this;

        me.store.pageSize = newValue;
        me.store.load();
    }
});
// 
<?php }} ?>