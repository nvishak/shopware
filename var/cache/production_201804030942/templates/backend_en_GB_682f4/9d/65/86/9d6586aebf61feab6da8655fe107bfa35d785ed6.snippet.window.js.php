<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\detail\window.js" */ ?>
<?php /*%%SmartyHeaderCode:43695acda8f20fb328-25410322%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d6586aebf61feab6da8655fe107bfa35d785ed6' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\detail\\window.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43695acda8f20fb328-25410322',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f220c7f3_93620138',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f220c7f3_93620138')) {function content_5acda8f220c7f3_93620138($_smarty_tpl) {?>/**
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
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */

// 

/**
 * Shopware UI - Customer list detail page
 *
 * This component represents the window for the detail page of a customer record.
 */
// 
Ext.define('Shopware.apps.Customer.view.detail.Window', {
    /**
     * Define that the customer detail window is an extension of the Enlight application window
     * @string
     */
    // extend:'Enlight.app.Window',
    extend: 'Enlight.app.Window',

    /**
     * Set the border layout for the detail window.
     * @string
     */
    layout: 'fit',
    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.customer-detail-window',
    /**
     * Define the width of the window
     * @integer
     */
    width: '80%',

    /**
     * Define the height of the window
     * @integer
     */
    height: '90%',

    /**
     * Set no border for the window
     * @boolean
     */
    border: false,

    /**
     * Set css class for sass styling
     * @string
     */
    cls: Ext.baseCSSPrefix + 'customer-detail-window',
    /**
     * A flag which causes the object to attempt to restore the state of internal properties from a saved state on startup.
     */
    stateful: true,
    /**
     * The unique id for this object to use for state management purposes.
     */
    stateId: 'shopware-customer-detail-window',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        titleCreate: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'create_title','default'=>'Customer administration - Create a customer','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'create_title','default'=>'Customer administration - Create a customer','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Create new customer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'create_title','default'=>'Customer administration - Create a customer','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        titleEdit: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'edit_title','default'=>'Customer account:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'edit_title','default'=>'Customer account:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer account:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'edit_title','default'=>'Customer account:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        cancel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'cancel','default'=>'Cancel','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'cancel','default'=>'Cancel','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'cancel','default'=>'Cancel','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        save: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'save','default'=>'Save','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'save','default'=>'Save','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'save','default'=>'Save','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        dataTab: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'data_tab','default'=>'Data','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'data_tab','default'=>'Data','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'data_tab','default'=>'Data','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        orderTab: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'order_tab','default'=>'Orders','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'order_tab','default'=>'Orders','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Orders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'order_tab','default'=>'Orders','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        addressTab: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'address_tab','default'=>'Addresses','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'address_tab','default'=>'Addresses','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Addresses<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'address_tab','default'=>'Addresses','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        from: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'from_date','default'=>'From','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'from_date','default'=>'From','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'from_date','default'=>'From','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        to: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'window'/'to_date','default'=>'To','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'to_date','default'=>'To','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'window'/'to_date','default'=>'To','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        field_title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'base'/'field_title','default'=>'Title','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'field_title','default'=>'Title','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Title<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'field_title','default'=>'Title','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        salutation: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'base'/'salutation','default'=>'Salutation','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'salutation','default'=>'Salutation','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Salutation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'salutation','default'=>'Salutation','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        firstname: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'base'/'firstname','default'=>'Firstname','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'firstname','default'=>'Firstname','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Firstname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'firstname','default'=>'Firstname','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        lastname: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'base'/'lastname','default'=>'Lastname','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'lastname','default'=>'Lastname','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Lastname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'lastname','default'=>'Lastname','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        birthday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'base'/'birthday','default'=>'Birthday','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'birthday','default'=>'Birthday','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Birthday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'base'/'birthday','default'=>'Birthday','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Component event method which is fired when the window is initialed.
     * @return void
     */
    initComponent: function () {
        var me = this;

        // Set the basic window title
        me.title = me.snippets.titleCreate;

        me.callParent(arguments);

        // Create the content if we're having an record on start up
        if (me.record) {
            me.createTabPanel();
        }
    },

    /**
     * @param stores
     */
    setStores: function(stores) {
        var me = this;

        me.baseFieldSet.customerGroupCombo.bindStore(stores.getCustomerGroupStore);
        me.baseFieldSet.shopStoreCombo.bindStore(stores.getShopStore);
        me.debitFieldSet.paymentCombo.bindStore(stores.getPaymentStore);
        me.paymentStore = stores.getPaymentStore;
        me.countryStore = stores.getCountryStore;

        if (me.hasOwnProperty('orderGrid')) {
            me.orderGrid.dispatchStore = stores.getDispatchStore;
            me.orderGrid.orderStatusStore = stores.getOrderStatusStore;
            me.orderGrid.paymentStore = stores.getPaymentStore;
            me.orderGrid.paymentStatusStore = stores.getPaymentStatusStore;
        }
        me.detailForm.loadRecord(me.record);

        if (!me.record.get('id')) {
            me.detailForm.getForm().clearInvalid();
        } else {
            me.countryStateStore = Ext.create('Shopware.apps.Base.store.CountryState');
            me.countryStateStore.load({
                callback: function() {
                    me.refreshTemplateContainer();
                }
            });
        }
    },

    refreshTemplateContainer: function() {
        var me = this;

        me.billingContainer.update(me.record.getBilling().first().getData());
        me.shippingContainer.update(me.record.getShipping().first().getData());
    },

    /**
     * Helper method which creates the tabpanel.
     *
     * @public
     * @return void
     */
    createTabPanel: function() {
        var me = this;

        // Add the tab panel to the window
        me.add(Ext.create('Ext.tab.Panel', {
            items: me.getTabs()
        }));

        // Change the window title
        me.setWindowTitle();
    },

    /**
     * Internal helper function which sets the window title
     *
     * @public
     * @return void
     */
    setWindowTitle: function () {
        var me = this;

        // set different titles for create and edit customers
        if (me.record.get('id')) {
            me.setTitle(Ext.String.format('[0] [1] [2] ([3])',
                me.snippets.titleEdit,
                me.record.get('firstname') || '',
                me.record.get('lastname') || '',
                me.record.get('number') || ' - '
            ));
        } else {
            me.setTitle(me.snippets.titleCreate);
        }
    },

    /**
     * Creates the tabs for the tab panel of the window.
     * Contains the detail form which is used to display the customer data for an existing customer
     * or to create a new customer.
     * Can contains additionally an second tab which displays the customer orders and a chart which
     * displays the orders grouped by the order year and month
     * @return [array] - Contains the data and order tab container
     */
    getTabs: function () {
        var me = this,
            tabs = [
                me.createFormTab()
            ];

        if (me.record.get('id')) {
            tabs.push(me.createAddressTab());
            /* <?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'order','privilege'=>'read'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?> */
            tabs.push(me.createOrderTab());
            /* <?php }?> */
        }

        return tabs;
    },

    /**
     * Creates the customer data tab which contains the different field sets
     * to edit or create a new customer.
     * @return [Ext.container.Container] - Contains the data and order tab
     */
    createFormTab: function () {
        var me = this, additional;

        // Create a customer? Then display only the form panel
        if (me.record.get('id')) {
            additional = Ext.create('Shopware.apps.Customer.view.detail.Additional', {
                region: 'east',
                width: 205,
                minSize: 205,
                maxSize: 250,
                record: me.record,
                collapsible: true
            });
        }

        me.baseFieldSet = Ext.create('Shopware.apps.Customer.view.detail.Base', { record: me.record });
        me.commentFieldSet = Ext.create('Shopware.apps.Customer.view.detail.Comment', { record: me.record });
        me.debitFieldSet = Ext.create('Shopware.apps.Customer.view.detail.Debit', { record: me.record });
        me.personalFieldSet = me.createPersonalFieldSet();

        if (me.record.get('id')) {
            me.addressFieldSet = me.createAddressFieldSet();
        } else {
            me.addressFieldSet = me.createAddressForm();
        }

        me.attributeForm = Ext.create('Shopware.attribute.Form', {
            table: 's_user_attributes'
        });

        if (me.record) {
            me.attributeForm.loadAttribute(me.record.get('id'));
        }

        me.detailForm = Ext.create('Ext.form.Panel', {
            collapsible: false,
            region: 'center',
            minWidth: 600,
            bodyPadding: 10,
            autoScroll: true,
            items: [
                me.baseFieldSet,
                me.personalFieldSet,
                me.addressFieldSet,
                me.debitFieldSet,
                me.commentFieldSet,
                me.attributeForm
            ],
            dockedItems: [{
                xtype: 'toolbar',
                dock: 'bottom',
                ui: 'shopware-ui',
                cls: 'shopware-toolbar',
                items: me.getFormButtons()
            }]
        });

        return Ext.create('Ext.container.Container', {
            layout: 'border',
            title: me.snippets.dataTab,
            items:
            [
                additional,
                me.detailForm
            ]
        });
    },

    createPersonalFieldSet: function() {
        var me = this;

        me.customerSalutation = Ext.create('Ext.form.field.ComboBox', {
            triggerAction: 'all',
            fieldLabel: me.snippets.salutation.label,
            labelWidth: 155,
            name: 'salutation',
            editable: false,
            allowBlank: false,
            valueField: 'key',
            displayField: 'label',
            store: Ext.create('Shopware.apps.Base.store.Salutation').load()
        });

        me.customerTitle = Ext.create('Ext.form.field.Text', {
            fieldLabel: me.snippets.field_title,
            labelWidth: 155,
            name: 'title',
            allowBlank: true
        });

        me.customerFirstname = Ext.create('Ext.form.field.Text', {
            fieldLabel: me.snippets.firstname,
            labelWidth: 155,
            name: 'firstname',
            allowBlank: false,
            required: true
        });

        me.customerLastname = Ext.create('Ext.form.field.Text', {
            fieldLabel: me.snippets.lastname,
            labelWidth: 155,
            name: 'lastname',
            allowBlank: false,
            required: true
        });

        me.customerBirthday = Ext.create('Ext.form.field.Date', {
            fieldLabel: me.snippets.birthday,
            labelWidth: 155,
            submitFormat: 'd.m.Y',
            name: 'birthday'
        });

        return Ext.create('Ext.form.FieldSet', {
            layout: 'column',
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'personal_field_set','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'personal_field_set','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Personal data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'personal_field_set','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            defaults: {
                xtype: 'container',
                columnWidth: 0.5,
                border: false,
                cls: Ext.baseCSSPrefix + 'field-set-container',
                layout: 'anchor',
                defaults: {
                    anchor: '95%',
                    labelWidth: 155,
                    minWidth: 250,
                    xtype: 'textfield'
                }
            },
            items: [
                { items: [me.customerSalutation, me.customerFirstname, me.customerBirthday] },
                { items: [me.customerTitle, me.customerLastname] }
            ]
        });
    },

    /**
     * Creates the customer addresses tab which contains all addresses of the customer
     * @return [Ext.container.Container]
     */
    createAddressTab: function() {
        var me = this;

        me.addressStore = Ext.create('Shopware.apps.Customer.store.Address');
        me.addressStore.getProxy().extraParams['customerId'] = me.record.get('id');
        me.addressStore.load();

        me.addressListWindow = Ext.create('Shopware.apps.Customer.view.address.List', {
            store: me.addressStore,
            customerRecord: me.record
        });

        me.addressTab = Ext.create('Ext.container.Container', {
            layout: 'border',
            title: me.snippets.addressTab,
            items: [
                me.addressListWindow
            ]
        });

        return me.addressTab;
    },

    /**
     * Creates the save and cancel button for the form panel.
     * @return [array] - Contains the cancel button and the save button
     */
    getFormButtons: function() {
        var me = this,
            buttons = [ '->' ];

        var cancelButton = Ext.create('Ext.button.Button', {
            text: me.snippets.cancel,
            scope: me,
            cls: 'secondary',
            handler: function () {
                me.destroy();
            }
        });
        buttons.push(cancelButton);

        var saveButton = Ext.create('Ext.button.Button', {
            text: me.snippets.save,
            action: 'save-customer',
            cls: 'primary'
        });

        // Create a customer? Then display only the form panel
        if (!me.record.get('id')) {
            buttons.push(saveButton);
        } else {
            /* <?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('privilege'=>'update'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?> */
            buttons.push(saveButton);
            /* <?php }?> */
        }
        return buttons;
    },

    /**
     * Creates the customer order tab which contains a grid with all customer orders and a chart
     * which displays the customer orders grouped by the order year and month
     * @return [Ext.container.Container] - Contains the order grid and the order chart
     */
    createOrderTab: function () {
        var me = this,
            gridStore = Ext.create('Shopware.apps.Customer.store.Orders'),
            chartStore = Ext.create('Shopware.apps.Customer.store.Chart');

        gridStore.getProxy().extraParams = { customerID: me.record.data.id };
        chartStore.getProxy().extraParams = { customerID: me.record.data.id };

        me.orderGrid = Ext.create('Shopware.apps.Customer.view.order.List', {
            flex: 1,
            gridStore: gridStore.load()
        });

        me.orderToolbar = me.createOrderToolbar();

        return Ext.create('Ext.container.Container', {
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            defaults: { flex: 1 },
            title: me.snippets.orderTab,
            items: [{
                xtype: 'panel',
                unstyled: true,
                layout: 'border',
                items: [{
                    xtype: 'customer-list-order-chart',
                    region: 'center',
                    store: chartStore.load()
                }],
                dockedItems: [ me.orderToolbar ]
            }, me.orderGrid ]
        });
    },

    /**
     * Creates the toolbar for the order tab.
     * The toolbar contains two date fields (from, to) which allows the user to filter the chart store.
     *
     * @return [Ext.toolbar.Toolbar] - Toolbar for the order tab which contains the from and to date field to filter the chart
     */
    createOrderToolbar: function () {
        var me = this,
            today = new Date();

        me.fromDateField = Ext.create('Ext.form.field.Date', {
            labelWidth: 45,
            name: 'fromDate',
            fieldLabel: me.snippets.from,
            value: new Date(today.getFullYear() - 1, today.getMonth(), today.getDate())
        });

        me.toDateField = Ext.create('Ext.form.field.Date', {
            labelWidth: 45,
            name: 'toDate',
            fieldLabel: me.snippets.to,
            value: today
        });

        return Ext.create('Ext.toolbar.Toolbar', {
            ui: 'shopware-ui',
            padding: '10 0 5',
            cls: Ext.baseCSSPrefix + 'order-chart-toolbar',
            items: [
                { xtype: 'tbspacer', width: 6 },
                me.fromDateField,
                { xtype: 'tbspacer', width: 12 },
                me.toDateField
            ]
        });
    },

    createAddressFieldSet: function() {
        var me = this;

        me.billingPanel = me.createBillingContainer();
        me.shippingPanel = me.createShippingContainer();

        me.addressContainer = Ext.create('Ext.container.Container', {
            minWidth: 250,
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            margin: '0 0 10 0',
            items: [
                me.billingPanel,
                { width: 10, border: 0 },
                me.shippingPanel
            ]
        });
        return me.addressContainer;
    },

    /**
     * Creates the Ext.panel.Panel for the billing information.
     */
    createBillingContainer: function() {
        var me = this;

        me.billingContainer = Ext.create('Ext.container.Container', {
            tpl: me.createBillingTemplate(),
            data: me.record.getBilling().first().getData()
        });

        return Ext.create('Ext.panel.Panel', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'billingContainerTitle','default'=>'Default billing address','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'billingContainerTitle','default'=>'Default billing address','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Default billing address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'billingContainerTitle','default'=>'Default billing address','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            bodyPadding: 10,
            flex: 1,
            paddingRight: 10,
            cls: 'shopware-form',
            items: [
                me.billingContainer
            ]
        });
    },

    /**
     * Creates the XTemplate for the billing information panel
     *
     * @return [Ext.XTemplate] generated Ext.XTemplate
     */
    createBillingTemplate: function () {
        var me = this;

        return new Ext.XTemplate(
            '<tpl for=".">',
                '<div class="customer-info-pnl">',
                    '<div class="base-info">',
                        '<p>',
                            '<span>{company}</span>',
                        '</p>',
                        '<p>',
                            '<span>{department}</span>',
                        '</p>',
                        '<p>',
                            '<span>{salutationSnippet}</span>&nbsp;',
                            '<tpl if="title"><span>{title}</span><br /></tpl>',
                            '<span>{firstName}</span>&nbsp;',
                            '<span>{lastName}</span>',
                        '</p>',
                        '<p>',
                            '<span>{street}</span>',
                        '</p>',
                        '<tpl if="additionalAddressLine1">',
                            '<p>',
                                '<span>{additionalAddressLine1}</span>',
                            '</p>',
                        '</tpl>',
                        '<tpl if="additionalAddressLine2">',
                            '<p>',
                                '<span>{additionalAddressLine2}</span>',
                            '</p>',
                        '</tpl>',
                        '<p>',
                            '<span>{zipCode}</span>&nbsp;',
                            '<span>{city}</span>',
                        '</p>',
                        '<p><span>{[this.getCountry(values.countryId)]}</span></p>',
                        '<p><span>{[this.getCountryState(values.stateId)]}</span></p>',
                    '</div>',
                '</div>',
            '</tpl>',
            {
                getCountry: function(countryId) {
                    return me.countryStore.getById(countryId).get('name');
                }
            },
            {
                getCountryState: function(stateId) {
                    if (stateId && me.countryStateStore.count() > 0) {
                        return me.countryStateStore.getById(stateId).get('name');
                    }
                }
            }
        );
    },

    /**
     * Creates the Ext.panel.Panel for the shipping information.
     */
    createShippingContainer: function() {
        var me = this,
            shipping = me.record.getShipping().first();

        if (shipping === Ext.undefined) {
            if (me.record.getBilling() === null || me.record.getBilling().first() === null) {
                return;
            }
            shipping = me.record.getBilling().first();
            if (shipping == null) {
                return;
            }
        }

        me.shippingContainer = Ext.create('Ext.container.Container', {
            tpl: me.createShippingTemplate(),
            data: me.record.getShipping().first().getData()
        });

        return Ext.create('Ext.panel.Panel', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'shippingContainerTitle','default'=>'Default shipping address','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'shippingContainerTitle','default'=>'Default shipping address','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Default shipping address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'shippingContainerTitle','default'=>'Default shipping address','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            bodyPadding: 10,
            flex: 1,
            marginLeft: 10,
            cls: 'shopware-form',
            items: [
                me.shippingContainer
            ]
        });
    },

    /**
     * Creates the XTemplate for the billing information panel
     *
     * @return [Ext.XTemplate] generated Ext.XTemplate
     */
    createShippingTemplate: function () {
        return this.createBillingTemplate();
    },

    /**
     * Refresh address info panels
     */
    reloadRecord: function() {
        var me = this;

        me.record.store.load({
            callback: function(updatedRecord) {
                me.record = updatedRecord[0];

                me.billingContainer.update(me.record.getBilling().first().raw);
                me.shippingContainer.update(me.record.getShipping().first().raw);
            }
        });
    },

    /**
     * Show address form for creation
     *
     * @returns Shopware.apps.Customer.view.address.detail.Address
     */
    createAddressForm: function() {
        var me = this;

        me.addressForm = Ext.create('Shopware.apps.Customer.view.address.detail.Address', {
            padding: 0,
            record: Ext.create('Shopware.apps.Customer.model.Address')
        });
        return me.addressForm;
    }

});
// 
<?php }} ?>