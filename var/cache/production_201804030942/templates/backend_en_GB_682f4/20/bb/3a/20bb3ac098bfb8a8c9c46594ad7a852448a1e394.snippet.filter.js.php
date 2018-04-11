<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\view\list\filter.js" */ ?>
<?php /*%%SmartyHeaderCode:101085acda8f35c6777-46615447%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20bb3ac098bfb8a8c9c46594ad7a852448a1e394' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\view\\list\\filter.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101085acda8f35c6777-46615447',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f36dea63_96335708',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f36dea63_96335708')) {function content_5acda8f36dea63_96335708($_smarty_tpl) {?>/**
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
 * Shopware UI - Order list filter panel
 *
 * Displayed on the left side of the order list module.
 */
//
Ext.define('Shopware.apps.Order.view.list.Filter', {

    /**
     * Define that the additional information is an Ext.panel.Panel extension
     * @string
     */
    extend:'Ext.panel.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias:'widget.order-list-filter',

    /**
     * An optional extra CSS class that will be added to this component's Element.
     */
    cls: Ext.baseCSSPrefix + 'filter-options',

    /**
     * True to use overflow:'auto' on the components layout element and show scroll bars automatically when necessary, false to clip any overflowing content.
     */
    autoScroll: true,

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        title:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'title','default'=>'Filter options','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'title','default'=>'Filter options','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Filter options<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'title','default'=>'Filter options','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        from: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'from','default'=>'From','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'from','default'=>'From','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'from','default'=>'From','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        to: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'to','default'=>'To','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'to','default'=>'To','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'to','default'=>'To','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        orderState: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'orderState','default'=>'Order status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'orderState','default'=>'Order status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'orderState','default'=>'Order status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        paymentState: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'paymentState','default'=>'Payment status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'paymentState','default'=>'Payment status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Payment status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'paymentState','default'=>'Payment status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        paymentName: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'paymentName','default'=>'Payment method','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'paymentName','default'=>'Payment method','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Payment method<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'paymentName','default'=>'Payment method','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        dispatchName: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'dispatchName','default'=>'Shipping type','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'dispatchName','default'=>'Shipping type','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shipping type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'dispatchName','default'=>'Shipping type','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        customerGroup: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'customerGroup','default'=>'Customer group','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'customerGroup','default'=>'Customer group','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer group<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'customerGroup','default'=>'Customer group','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        shop: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'shop','default'=>'Shop','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'shop','default'=>'Shop','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shop<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'shop','default'=>'Shop','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        perform: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'perform','default'=>'Perform filters','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'perform','default'=>'Perform filters','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
OK<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'perform','default'=>'Perform filters','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        reset: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'reset','default'=>'Reset filters','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'reset','default'=>'Reset filters','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Reset<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'reset','default'=>'Reset filters','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        empty: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'empty','default'=>'Display all','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'empty','default'=>'Display all','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'empty','default'=>'Display all','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        article: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'article','default'=>'Article','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'article','default'=>'Article','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'article','default'=>'Article','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        partner: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'partner','default'=>'Partner','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'partner','default'=>'Partner','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Partner<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'partner','default'=>'Partner','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        shipping: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'shipping','default'=>'Shipping country','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'shipping','default'=>'Shipping country','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shipping country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'shipping','default'=>'Shipping country','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        billing: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter'/'billing','default'=>'Billing country','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'billing','default'=>'Billing country','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Billing country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter'/'billing','default'=>'Billing country','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        document: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'document'/'title','default'=>'Documents','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'title','default'=>'Documents','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Documents<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'title','default'=>'Documents','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            date: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'document'/'date','default'=>'Date','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'date','default'=>'Date','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'date','default'=>'Date','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            name:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'document'/'name','default'=>'Name','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'name','default'=>'Name','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'name','default'=>'Name','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Component event which is fired when the component is initials.
     * @return void
     */
    initComponent:function () {
        var me = this;
        me.registerEvents();
        me.items = [ me.createFieldContainer() ];
        me.title = me.snippets.title;
        me.callParent(arguments);
    },

    /**
     * Adds the specified events to the list of events which this Observable may fire.
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the "accept filter" button
             * which is placed in the filter options panel on the left hand of the order list.
             *
             * @event
             * @param [object] - Form values
             */
            'acceptFilters',

            /**
             * Event will be fired when the user clicks the "reset filter" button
             * which is placed in the filter options panel on the left hand of the order list.
             *
             * @event
             * @param [object] - Form
             */
            'resetFilters'
        );
    },

    /**
     * Creates the outer container for the filter options panel.
     * @return [Ext.container.Container]
     */
    createFieldContainer: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            border: false,
            padding: 10,
            items: [
                me.createFilterForm(),
                me.createFilterButtons(),
                me.createDocumentsGrid()
            ]
        });
    },

    /**
     * Creates the form filter fields which displayed on the left hand of
     * the order list. The filters will be perform by the "Perform filters" button
     * which displayed under the form.
     * @return [Ext.form.Panel]
     */
    createFilterForm: function() {
        var me = this;


        me.filterForm = Ext.create('Ext.form.Panel', {
            border: false,
            cls: Ext.baseCSSPrefix + 'filter-form',
            defaults:{
                anchor:'98%',
                labelWidth:155,
                minWidth:250,
                xtype:'pagingcombo',
                style: 'box-shadow: none;',
                labelStyle: 'font-weight:700;'
            },
            items: [
                me.createFromField(),
                me.createToField(),
                me.createOrderStatusField(),
                me.createPaymentStatusField(),
                me.createPaymentField(),
                me.createDispatchField(),
                me.createCustomerGroupField(),
                me.createArticleSearch(),
                me.createShopField(),
                me.createPartnerField(),
                me.createDeliveryCountrySelection(),
                me.createBillingCountrySelection()
            ]
        });
        return me.filterForm;
    },

    createFromField: function() {
        var me = this;
        return Ext.create('Ext.form.field.Date', {
            name: 'from',
            fieldLabel: me.snippets.from,
            submitFormat: 'd.m.Y'
        });
    },

    createToField: function() {
        var me = this;
        return Ext.create('Ext.form.field.Date', {
            name: 'to',
            fieldLabel: me.snippets.to,
            submitFormat: 'd.m.Y'
        });
    },

    createOrderStatusField: function() {
        var me = this;

        return Ext.create('Ext.form.field.ComboBox', {
            name: 'orders.status',
            queryMode: 'local',
            store: me.orderStatusStore,
            valueField: 'id',
            displayField: 'description',
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.orderState
        });
    },

    createPaymentStatusField: function() {
        var me = this;

        return Ext.create('Ext.form.field.ComboBox', {
            name: 'orders.cleared',
            pageSize: 7,
            queryMode: 'remote',
            store: me.paymentStatusStore,
            valueField: 'id',
            displayField: 'description',
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.paymentState
        });
    },

    createPaymentField: function() {
        var me = this;

        return Ext.create('Ext.form.field.ComboBox', {
            name: 'orders.paymentId',
            pageSize: 7,
            queryMode: 'remote',
            store: Ext.create('Shopware.store.Payment', { pageSize: 7 }),
            valueField: 'id',
            displayField: 'description',
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.paymentName
        });
    },

    createDispatchField: function() {
        var me = this;

        return Ext.create('Ext.form.field.ComboBox', {
            name: 'orders.dispatchId',
            pageSize: 7,
            queryMode: 'remote',
            store: Ext.create('Shopware.store.Dispatch', { pageSize: 7 }),
            valueField: 'id',
            displayField: 'name',
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.dispatchName
        });
    },


    createCustomerGroupField: function() {
        var me = this;

        return Ext.create('Ext.form.field.ComboBox', {
            name: 'customer.groupKey',
            store: Ext.create('Shopware.store.CustomerGroup', { pageSize: 7 }),
            valueField: 'key',
            pageSize: 7,
            queryMode: 'remote',
            displayField: 'name',
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.customerGroup
        });
    },

    createArticleSearch: function() {
        var me = this;

        return Ext.create('Shopware.form.field.ArticleSearch', {
            name: 'details.articleNumber',
            fieldLabel: me.snippets.article,
            store: Ext.create('Shopware.apps.Base.store.Variant')
        });
    },

    createShopField: function() {
        var me = this;

        return Ext.create('Ext.form.field.ComboBox', {
            name: 'orders.shopId',
            store: Ext.create('Shopware.store.Shop', { pageSize: 7 }),
            valueField: 'id',
            pageSize: 7,
            queryMode: 'remote',
            displayField: 'name',
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.shop
        });
    },

    createPartnerField: function() {
        var me = this;

        var store = Ext.create('Ext.data.Store', {
            fields: [
                {
                    name: 'name',
                    type: 'string'
                },
                {
                    name: 'value',
                    type: 'string'
                }
            ],
            remoteSort: true,
            remoteFilter: true,
            pageSize: 10,
            proxy: {
                type: 'ajax',
                url: '<?php echo '/shopware4/backend/Order/getPartners';?>',
                reader: {
                    type: 'json',
                    root: 'data'
                }
            }
        });

        return Ext.create('Ext.form.field.ComboBox', {
            name: 'orders.partnerId',
            store: store,
            displayField: 'name',
            valueField: 'value',
            queryMode: 'remote',
            pageSize: 10,
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.partner
        });
    },

    createDeliveryCountrySelection: function() {
        var selectionFactory = Ext.create('Shopware.attribute.SelectionFactory', {});
        return Ext.create('Ext.form.field.ComboBox', {
            name: 'shipping.countryId',
            store: selectionFactory.createEntitySearchStore("Shopware\\Models\\Country\\Country"),
            valueField: 'id',
            queryMode: 'remote',
            displayField: 'name',
            fieldLabel: this.snippets.shipping
        });
    },

    createBillingCountrySelection: function() {
        var selectionFactory = Ext.create('Shopware.attribute.SelectionFactory', {});
        return Ext.create('Ext.form.field.ComboBox', {
            name: 'billing.countryId',
            store: selectionFactory.createEntitySearchStore("Shopware\\Models\\Country\\Country"),
            valueField: 'id',
            queryMode: 'remote',
            displayField: 'name',
            fieldLabel: this.snippets.billing
        });
    },


    /**
     * Creates the "reset filters" and "perform filters" button
     * which displayed in the filter options panel on the left hand
     * of the order list.
     * @return [Ext.container.Container]
     */
    createFilterButtons: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            style: 'margin-top: 10px;',
            items: [
                {
                    xtype: 'button',
                    cls: 'small secondary',
                    text: me.snippets.reset,
                    handler: function() {
                        me.fireEvent('resetFilters', me.filterForm);
                    }
                },
                {
                    xtype: 'button',
                    text: me.snippets.perform,
                    style: 'float: right;',
                    cls: 'primary small',
                    handler: function() {
                        me.fireEvent('acceptFilters', me.filterForm.getValues());
                    }
                }
            ]
        });
    },

    /**
     * Creates a grid panel which displays the last created order documents.
     *
     * @return [Ext.grid.Panel]
     */
    createDocumentsGrid: function() {
        var me = this;

        me.documentGrid =  Ext.create('Shopware.apps.Order.view.list.Document', {
            height: 200,
            title: me.snippets.document.title,
            getColumns: function() {
                var grid = this;
                return [
                    {
                        header: grid.snippets.columns.date,
                        dataIndex: 'date',
                        flex: 1,
                        renderer: grid.dateColumn
                    }, {
                        header: grid.snippets.columns.name,
                        dataIndex: 'name',
                        flex: 2,
                        renderer: grid.nameColumn
                    }
                ];
            },
            store: me.documentStore
        });

        return Ext.create('Ext.container.Container', {
            style: 'margin-top: 15px',
            items: [ me.documentGrid ]
        });
    }

});
//
<?php }} ?>