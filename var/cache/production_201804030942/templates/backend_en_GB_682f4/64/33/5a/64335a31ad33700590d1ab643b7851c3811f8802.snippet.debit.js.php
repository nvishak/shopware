<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\detail\debit.js" */ ?>
<?php /*%%SmartyHeaderCode:205995acda8f28266e4-17088859%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64335a31ad33700590d1ab643b7851c3811f8802' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\detail\\debit.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205995acda8f28266e4-17088859',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f28e3ef7_95911862',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f28e3ef7_95911862')) {function content_5acda8f28e3ef7_95911862($_smarty_tpl) {?>/**
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
 * Shopware UI - Customer detail page
 *
 * The debit field set contains the debit data of the customer
 * which is stored in the debit model and filled over the s_user_debit table
 */
// 
Ext.define('Shopware.apps.Customer.view.detail.Debit', {
    /**
     * Define that the debit field set is an extension of the Ext.form.FieldSet
     * @string
     */
    extend: 'Ext.form.FieldSet',
    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.customer-debit-field-set',
    /**
     * Set css class for this component
     * @string
     */
    cls: Ext.baseCSSPrefix + 'debit-field-set',
    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'title','default'=>'Payment data','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'title','default'=>'Payment data','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Payment information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'title','default'=>'Payment data','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        payment: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'current_payment','default'=>'Current payment method','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'current_payment','default'=>'Current payment method','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Current payment method<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'current_payment','default'=>'Current payment method','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            helpTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'payment_help_title','default'=>'Payment method','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'payment_help_title','default'=>'Payment method','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Payment method<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'payment_help_title','default'=>'Payment method','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            helpText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'payment_help_text','default'=>'If you change the payment on this menu item, the payment kind of the customer will not be considered by the risk management.','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'payment_help_text','default'=>'If you change the payment on this menu item, the payment kind of the customer will not be considered by the risk management.','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
If the payment method is changed here, it will not be taken into account by risk management.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'payment_help_text','default'=>'If you change the payment on this menu item, the payment kind of the customer will not be considered by the risk management.','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        account: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'account','default'=>'Account','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'account','default'=>'Account','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'account','default'=>'Account','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        accountHolder: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'account_holder','default'=>'Account holder','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'account_holder','default'=>'Account holder','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Account holder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'account_holder','default'=>'Account holder','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        bankName: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'bank_name','default'=>'Bank name','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'bank_name','default'=>'Bank name','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Bank name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'bank_name','default'=>'Bank name','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        bankCode: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'debit'/'bank_code','default'=>'Bank code','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'bank_code','default'=>'Bank code','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Bank code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'debit'/'bank_code','default'=>'Bank code','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Component event method which is fired when the component
     * is initials. The component is initials when the user
     * want to create a new customer or edit an existing customer
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.registerEvents();
        me.title = me.snippets.title;
        me.topContainer = Ext.create('Ext.container.Container', {
            layout: 'anchor',
            items: me.createDebitTopForm()
        });
        me.fieldContainer = Ext.create('Ext.container.Container', {
            layout: 'column',
            items: me.createDebitForm()
        });
        me.items = [ me.topContainer, me.fieldContainer ];

        me.callParent(arguments);

        if (me.record.get('paymentId') !== 2) {
            me.fieldContainer.hide();
        }
    },

    /**
     * Registers the "changePayment" event which is handled in the detail controller
     * and will be fired when the user change the payment combo box.
     * @return void
     */
    registerEvents: function () {
        this.addEvents(
            /**
             * Event will be fired when the user change the payment combo box which
             * is displayed on bottom of the detail page.
             *
             * @event
             * @param [object] value     - the new value of the combo box
             * @param [object] container - The field container which contains the debit account fields
             *
             */
            'changePayment'
        );
    },

    /**
     * Creates the container which contains the combo box
     * for the payments.
     *
     * @return [Array] Container which contains the payment combo box
     */
    createDebitTopForm: function () {
        var me = this;

        return me.createDebitFormTopElements();
    },

    /**
     * Creates the container which contains the combo box
     * for the payments.
     *
     * @return [Array] Container which contains the payment combo box
     */
    createDebitFormTopElements: function () {
        var me = this;

        me.paymentCombo = Ext.create('Ext.form.field.ComboBox', {
            name: 'paymentId',
            queryMode: 'local',
            triggerAction: 'all',
            fieldLabel: me.snippets.payment.label,
            helpTitle: me.snippets.payment.helpTitle,
            helpText: me.snippets.payment.helpText,
            valueField: 'id',
            displayField: 'description',
            allowBlank: false,
            required: true,
            anchor: '100%',
            labelWidth: 155,
            minWidth: 250,
            editable: false,
            tpl: Ext.create('Ext.XTemplate',
                '<tpl for=".">',
                '<tpl if="this.doHighlight(id)">',
                '<div class="x-boundlist-item" style="background-color:#F2DEDE; color: #A94442">{description}</div>',
                '<tpl else>',
                '<div class="x-boundlist-item">{description}</div>',
                '</tpl>',
                '</tpl>',
                {
                    doHighlight: function (id) {
                        // highlight all inactive payment methods of the boundlist
                        var record = me.paymentCombo.getStore().findRecord('id', id);
                        return !record.get('active');
                    }
                }
            ),
            listeners: {
                change: function (field, newValue) {
                    var store = field.getStore(),
                        selectedRecord = store.findRecord('id', newValue),
                        input = Ext.get(field.getEl().down('.x-form-field'));

                    if (!selectedRecord) {
                        input.setStyle({ 'color': '#A94442', 'background': '#F2DEDE' });
                        return;
                    }
                    if (!selectedRecord.get('active')) {
                        input.setStyle({ 'color': '#A94442', 'background': '#F2DEDE' });
                    } else {
                        input.setStyle({ 'background': '', 'color': '' });
                    }
                    me.fireEvent('changePayment', newValue, me.fieldContainer);
                }
            }
        });

        return [
            {
                xtype: 'container',
                columnWidth: 0.5,
                border: false,
                layout: 'anchor',
                cls: Ext.baseCSSPrefix + 'field-set-container',
                items: [ me.paymentCombo ]
            }
        ];
    },

    /**
     * Creates the both containers for the field set
     * to display the form fields in two columns.
     *
     * @return [Array] Contains the left and right container
     */
    createDebitForm: function () {
        var leftContainer, rightContainer, me = this;

        leftContainer = Ext.create('Ext.container.Container', {
            columnWidth: 0.5,
            border: false,
            layout: 'anchor',
            cls: Ext.baseCSSPrefix + 'field-set-container',
            defaults: {
                anchor: '100%',
                labelWidth: 155,
                minWidth: 250,
                xtype: 'textfield'
            },
            items: me.createDebitFormLeft()
        });

        rightContainer = Ext.create('Ext.container.Container', {
            columnWidth: 0.5,
            border: false,
            layout: 'anchor',
            cls: Ext.baseCSSPrefix + 'field-set-container',
            defaults: {
                anchor: '100%',
                labelWidth: 155,
                xtype: 'textfield'
            },
            items: me.createDebitFormRight()
        });

        return [ leftContainer, rightContainer ];
    },

    /**
     * Creates the form elements for the left container.
     *
     * @return [Array] Contains the account name and account holder
     */
    createDebitFormLeft: function () {
        var me = this;
        return [{
            name: 'debit[account]',
            alias: 'account',
            fieldLabel: me.snippets.account
        }, {
            name: 'debit[accountHolder]',
            alias: 'holder',
            fieldLabel: me.snippets.accountHolder
        }];
    },

    /**
     * Creates the form elements for the right container.
     *
     * @return [Array] Contains the bank name and code
     */
    createDebitFormRight: function () {
        var me = this;
        return [{
            name: 'debit[bankName]',
            alias: 'bankName',
            fieldLabel: me.snippets.bankName
        },
        {
            name: 'debit[bankCode]',
            alias: 'bankCode',
            fieldLabel: me.snippets.bankCode
        }];
    }
});
// 
Ext.define('Shopware.apps.Customer.view.detail.PaymentMethods', {
    override: 'Shopware.apps.Customer.view.detail.Debit',

    initComponent: function () {
        var me = this;

        me.snippets.sepaIban = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'iban','default'=>'IBAN')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'iban','default'=>'IBAN'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
IBAN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'iban','default'=>'IBAN'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
        me.snippets.sepaBic = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'bic','default'=>'BIC')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'bic','default'=>'BIC'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BIC<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'bic','default'=>'BIC'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
        me.snippets.sepaUseBillingData = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'use_billing_data','default'=>'Use billing data')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'use_billing_data','default'=>'Use billing data'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Use billing data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/detail','name'=>'sepa'/'use_billing_data','default'=>'Use billing data'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';

        me.callParent(arguments);

        if (me.record.getPaymentData().first() == Ext.undefined) {
            return;
        }
        if (me.record.getPaymentData().first().get('name') === 'sepa') {
            me.fieldContainer.show();
            me.accountHolderField.hide();
            me.accountNumberField.hide();
            me.bankCodeField.hide();
            me.ibanField.show();
            me.bicField.show();
        }
        if (me.record.getPaymentData().first().get('name') === 'debit') {
            me.fieldContainer.show();
            me.accountNumberField.show();
            me.accountHolderField.show();
            me.bankCodeField.show();
            me.ibanField.hide();
            me.bicField.hide();
        }
    },

    createDebitFormLeft: function () {
        var me = this;

        me.accountNumberField = Ext.create('Ext.form.field.Text', {
            name: 'paymentData[accountNumber]',
            alias: 'accountNumber',
            labelStyle: 'font-weight: 700;',
            style: {
                margin: '0 0 10px'
            },
            labelWidth: 150,
            minWidth: 250,
            fieldLabel: me.snippets.account
        });
        me.accountHolderField = Ext.create('Ext.form.field.Text', {
            name: 'paymentData[accountHolder]',
            alias: 'holder',
            labelStyle: 'font-weight: 700;',
            style: {
                margin: '0 0 10px'
            },
            labelWidth: 150,
            minWidth: 250,
            fieldLabel: me.snippets.accountHolder
        });
        me.ibanField = Ext.create('Ext.form.field.Text', {
            name: 'paymentData[iban]',
            alias: 'sepaIban',
            labelStyle: 'font-weight: 700;',
            labelWidth: 150,
            minWidth: 250,
            fieldLabel: me.snippets.sepaIban
        });
        me.useBillingDataField = Ext.create('Ext.form.field.Checkbox', {
            name: 'paymentData[useBillingData]',
            alias: 'sepaUseBillingData',
            labelStyle: 'font-weight: 700;',
            labelWidth: 150,
            minWidth: 250,
            inputValue: true,
            uncheckedValue: false,
            fieldLabel: me.snippets.sepaUseBillingData
        });

        return [ me.accountNumberField, me.accountHolderField, me.ibanField, me.useBillingDataField ];
    },

    createDebitFormRight: function () {
        var me = this;

        me.bankNameField = Ext.create('Ext.form.field.Text', {
            name: 'paymentData[bankName]',
            alias: 'bankName',
            labelWidth: 100,
            minWidth: 250,
            labelStyle: 'font-weight: 700;',
            style: {
                margin: '0 0 10px'
            },
            xtype: 'textfield',
            fieldLabel: me.snippets.bankName
        });
        me.bankCodeField = Ext.create('Ext.form.field.Text', {
            name: 'paymentData[bankCode]',
            alias: 'bankCode',
            labelWidth: 100,
            minWidth: 250,
            labelStyle: 'font-weight: 700;',
            style: {
                margin: '0 0 10px'
            },
            xtype: 'textfield',
            fieldLabel: me.snippets.bankCode
        });
        me.bicField = Ext.create('Ext.form.field.Text', {
            name: 'paymentData[bic]',
            alias: 'sepaBic',
            labelWidth: 100,
            minWidth: 250,
            labelStyle: 'font-weight: 700;',
            style: {
                margin: '0 0 10px'
            },
            xtype: 'textfield',
            fieldLabel: me.snippets.sepaBic
        });

        return [ me.bankNameField, me.bankCodeField, me.bicField ];
    }
});
//
<?php }} ?>