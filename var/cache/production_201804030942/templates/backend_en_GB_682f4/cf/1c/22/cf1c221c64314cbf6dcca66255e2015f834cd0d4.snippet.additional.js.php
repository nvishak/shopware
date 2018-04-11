<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\detail\additional.js" */ ?>
<?php /*%%SmartyHeaderCode:286745acda8f2c0da10-18907895%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf1c221c64314cbf6dcca66255e2015f834cd0d4' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\detail\\additional.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '286745acda8f2c0da10-18907895',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f2cc46e8_98363981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f2cc46e8_98363981')) {function content_5acda8f2cc46e8_98363981($_smarty_tpl) {?>/**
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
 * Shopware UI - Customer detail page additional panel
 *
 * Displayed on the right side of the detail page when a customer is edit.
 *
 */
// 
Ext.define('Shopware.apps.Customer.view.detail.Additional', {

    /**
     * Define that the additional information is an Ext.panel.Panel extension
     * @string
     */
    extend: 'Ext.panel.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.customer-additional-panel',

    /**
     * Set css class for this component
     * @string
     */
    cls: Ext.baseCSSPrefix + 'more-info',

    /**
     * Allow to scroll within the panel
     * @boolean
     */
    autoScroll: true,

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        registeredSince: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'registered_since','default'=>'Registered since:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'registered_since','default'=>'Registered since:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Registered since:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'registered_since','default'=>'Registered since:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        lastLogin: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'last_login','default'=>'Last login:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'last_login','default'=>'Last login:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last login:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'last_login','default'=>'Last login:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        language: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'language','default'=>'Language:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'language','default'=>'Language:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Language:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'language','default'=>'Language:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        shop: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'shop','default'=>'Shop:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'shop','default'=>'Shop:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shop:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'shop','default'=>'Shop:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        orders: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'orders_since_registration','default'=>'Orders since registration:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'orders_since_registration','default'=>'Orders since registration:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Orders since registration:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'orders_since_registration','default'=>'Orders since registration:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        sales: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'sales','default'=>'Turnover:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'sales','default'=>'Turnover:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Turnover:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'sales','default'=>'Turnover:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        paymentDefaults: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'payment_defaults','default'=>'Payment defaults:','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'payment_defaults','default'=>'Payment defaults:','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Payment defaults:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'payment_defaults','default'=>'Payment defaults:','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        emptyText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'empty','default'=>'No additional information found','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'empty','default'=>'No additional information found','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No additional information found<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'empty','default'=>'No additional information found','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        performOrderBtn: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'do_order','default'=>'Perform order','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'do_order','default'=>'Perform order','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Perform order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'do_order','default'=>'Perform order','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        quickOrder: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'quick_order','default'=>'For this customer, no account has been created (quick order)','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'quick_order','default'=>'For this customer, no account has been created (quick order)','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
For this customer, no account has been created (quick order)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'quick_order','default'=>'For this customer, no account has been created (quick order)','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'title','default'=>'Further information','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'title','default'=>'Further information','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Additional information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'title','default'=>'Further information','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        createAccountBtn: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'additional'/'create_account','default'=>'Create account','namespace'=>'backend/customer/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'create_account','default'=>'Create account','namespace'=>'backend/customer/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Create account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'additional'/'create_account','default'=>'Create account','namespace'=>'backend/customer/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Component event which is fired when the component is initials.
     * @return void
     */
    initComponent: function () {
        var me = this;
        me.title = me.snippets.title;
        me.registerEvents();
        me.items = [ me.createButtonsContainer(), me.createInfoView() ];
        me.callParent(arguments);
    },

    /**
     * Registers the "performOrder" event which is handled in the detail controller
     * and will be fired when the user clicks on the associated "perform order" button
     * which is displayed on bottom of the additional panel.
     * @return void
     */
    registerEvents: function () {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the "Perform order" button
             * which is placed in the additional panel at the bottom.
             *
             * @event
             * @param [Ext.data.Model] record - The current form record
             */
            'performOrder',

            /**
             * Event will be fired when the user clicks the "Create customer account" button
             * which is placed in the additional panel at the bottom.
             *
             * @event
             * @param [Ext.data.Model]          customer - The current record of the detail window.
             * @param [Ext.container.Container] infoView - The info view container
             * @param [Ext.XTemplate]           tpl - The view template
             * @param [Ext.button.Button]       btn - The "create account" button which has to be hide when the operation was successfully
             */
            'createAccount'
        );
    },

    /**
     * Creates the container for the "Perform order" button which
     * is displayed on bottom of the panel.
     * @return [Ext.container.Container] - Contains the perform order button and the create account button when the accountMode of the customer is set to 1
     */
    createButtonsContainer: function () {
        var me = this,
            buttons = [];

        /* <?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('privilege'=>'perform_order'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?> */
        me.performOrderBtn = Ext.create('Ext.button.Button', {
            text: me.snippets.performOrderBtn,
            handler: function () {
                me.fireEvent('performOrder', me.record);
            }
        });
        buttons.push(me.performOrderBtn);
        /* <?php }?> */

        /* <?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('privilege'=>'update'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?> */
        if (me.record.get('accountMode') == 1) {
            me.createAccountButton = Ext.create('Ext.button.Button', {
                text: me.snippets.createAccountBtn,
                handler: function () {
                    var tpl = me.createInfoPanelTemplate();
                    me.fireEvent('createAccount', me.record, me.infoView, tpl, me.createAccountButton);
                }
            });
            buttons.push(me.createAccountButton);
        }
        /* <?php }?> */

        return Ext.create('Ext.container.Container', {
            height: 40,
            cls: Ext.baseCSSPrefix + 'button-container',
            items: buttons
        });
    },

    /**
     * Creates the XTemplate for the information panel
     *
     * Note that the template has different member methods
     * which are only callable in the actual template.
     *
     * @return [Ext.XTemplate] generated Ext.XTemplate
     */
    createInfoPanelTemplate: function () {
        var me = this;

        return new Ext.XTemplate(
            '<tpl for=".">',
                '<div class="media-info-pnl">',
                    '<div class="base-info">',
                        // If the type is image, then show the image
                        '<tpl if="accountMode == 1">',
                            '<p>',
                                '<strong>' + me.snippets.quickOrder + '</strong>',
                            '</p>',
                        '</tpl>',
                        '<p>',
                            '<strong>' + me.snippets.registeredSince + '</strong>',
                            '<span>{[this.formatDate(values.firstLogin)]}</span>',
                        '</p>',
                        '<p>',
                            '<strong>' + me.snippets.lastLogin + '</strong>',
                            '<span>{[this.formatDate(values.lastLogin)]}</span>',
                        '</p>',
                        '<p>',
                            '<strong>' + me.snippets.language + '</strong>',
                            '<span>{language}</span>',
                        '</p>',
                        '<p>',
                            '<strong>' + me.snippets.shop + '</strong>',
                            '<span>{shopName}</span>',
                        '</p>',
                        '<p>',
                            '<strong>' + me.snippets.orders + '</strong>',
                            '<span>{orderCount}</span>',
                        '</p>',
                        '<p>',
                            '<strong>' + me.snippets.sales + '</strong>',
                            '<span>{[this.formatCurrency(values.amount)]}</span>',
                        '</p>',
                        '<p>',
                            '<strong>' + me.snippets.paymentDefaults + '</strong>',
                            '<span>{[this.formatCurrency(values.canceledOrderAmount)]}</span>',
                        '</p>',
                    '</div>',
                '</div>',
                '</tpl>',
            {
                    /**
                     * Member function of the template which formats a date string
                     *
                     * @param value [string] value - Date string in the following format: Y-m-d H:i:s
                     * @return [string] - The passed value, formatted with Ext.util.Format.date
                     */
                formatDate: function (value) {
                    if (value === Ext.undefined) {
                        return value;
                    }
                    return Ext.util.Format.date(value);
                }
            },
            {
                /**
                 * Member function of the template which format a currency string
                 * @param value [string] - The currency value to be format
                 * @return [string] - The passed value, formatted with Ext.util.Format.currency
                 */
                formatCurrency: function (value) {
                    if (value === Ext.undefined) {
                        return value;
                    }

                    return Ext.util.Format.currency(value);
                }
            }
        );
    },

    /**
     * Creates a new panel which displays additional information
     * about the selected media.
     *
     * @return [object] this.infoPanel - generated Ext.panel.Panel
     */
    createInfoView: function () {
        var me = this;

        me.infoView = Ext.create('Ext.container.Container', {
            cls: Ext.baseCSSPrefix + 'outer-customer-info-pnl',
            emptyText: me.snippets.emptyText,
            autoScroll: true,
            renderTpl: me.createInfoPanelTemplate(),
            renderData: me.record.data
        });

        return me.infoView;
    }

});
// 
<?php }} ?>