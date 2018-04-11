<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:43
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\account\checkout.js" */ ?>
<?php /*%%SmartyHeaderCode:34305acda8ff1d9020-03098431%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92bad999272aa93161705a86de6a85e1a20aac0f' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\account\\checkout.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34305acda8ff1d9020-03098431',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ff278af2_83883777',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ff278af2_83883777')) {function content_5acda8ff278af2_83883777($_smarty_tpl) {?>/**
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
 * @package    PluginManager
 * @subpackage Account
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.account.Checkout', {
    extend: 'Ext.window.Window',

    modal: true,

    cls: 'plugin-manager-checkout-window',

    header: false,

    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    width: 900,

    bodyPadding: 30,

    mixins: {
        events: 'Shopware.apps.PluginManager.view.PluginHelper'
    },

    initComponent: function() {
        var me = this;

        me.items = [
            me.createHeadline(),
            me.createBookingInformation(),
            me.createPositions(),
            me.createTotal(),
            me.createGtcBox()
        ];

        me.dockedItems = [ me.createButtons() ];

        me.callParent(arguments);
    },

    createGtcBox: function() {
        var me = this;

        me.gtcBox = Ext.create('Ext.form.field.Checkbox', {
            name: 'gtc',
            inputValue: true,
            cls: 'gtc',
            uncheckedValue: false,
            boxLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'gtc_accept','default'=>'I have read and agree with the <a href="https://en.shopware.com/gtc" target="_blank">GTC</a> of your shop.','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'gtc_accept','default'=>'I have read and agree with the <a href="https://en.shopware.com/gtc" target="_blank">GTC</a> of your shop.','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
I have read and agree with the <a href="https://en.shopware.com/gtc" target="_blank">GTC</a> of your shop.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'gtc_accept','default'=>'I have read and agree with the <a href="https://en.shopware.com/gtc" target="_blank">GTC</a> of your shop.','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            value: false,
            listeners: {
                change: function() {
                    if (me.gtcBox.getValue()) {
                        me.applyButton.enable();
                    } else {
                        me.applyButton.disable();
                    }
                }
            }
        });

        return Ext.create('Ext.container.Container', {
            layout: 'hbox',
            items: [ me.gtcBox ]
        });
    },

    createHeadline: function() {
        return Ext.create('Ext.Component', {
            cls: 'headline',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'finish_order','default'=>'Complete order','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'finish_order','default'=>'Complete order','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Complete order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'finish_order','default'=>'Complete order','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            height: 65,
            margin: '0 0 5'
        });
    },

    createBookingInformation: function() {
        var me = this;

        var address = me.basket['getAddressStore'].first();

        me.billingAddress = Ext.create('Ext.container.Container', {
            cls: 'booking-container billing-address',
            flex: 1,
            html: '<div class="headline"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'billing_address','default'=>'Billing address','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'billing_address','default'=>'Billing address','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Billing address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'billing_address','default'=>'Billing address','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>' +
                  '<div>' + address.get('firstName') + ' ' + address.get('lastName') + '</div>' +
                  '<div>' + address.get('street')  + '</div>' +
                  '<div>' + address.get('zipCode') + ' ' + address.get('city') + '</div>' +
                  '<div>' + address.get('countryName') +'</div>'
        });

        me.licenceDomain = Ext.create('Ext.container.Container', {
            cls: 'booking-container licence-domain',
            flex: 1,
            margin: '0 20',
            html: '<div class="headline"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_domain','default'=>'License domain','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_domain','default'=>'License domain','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
License domain<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_domain','default'=>'License domain','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>' +
                  '<div class="content"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence_domain_notice','default'=>'Your purchase will be registered for the following domain','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_domain_notice','default'=>'Your purchase will be registered for the following domain','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Your purchase will be registered for the following domain<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence_domain_notice','default'=>'Your purchase will be registered for the following domain','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>' +
                  '<div class="domain">' + me.basket.get('licenceDomain') + '</div>'
        });

        var bookingDomainHeadline = Ext.create('Ext.Component', {
            html: '<div class="headline"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'booking_domain','default'=>'Domain booking','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'booking_domain','default'=>'Domain booking','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Domain booking<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'booking_domain','default'=>'Domain booking','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
        });

        me.bookingDomainAmount = Ext.create('Ext.Component', {
            html: '',
            margin: '10 0 0',
            cls: 'booking-domain-amount'
        });

        var store = me.basket['getDomainsStore'];

        me.bookingDomainSelection = Ext.create('Ext.form.field.ComboBox', {
            displayField: 'domain',
            valueField: 'domain',
            store: store,
            queryMode: 'local',
            margin: '8 0 0',
            anchor: '100%',
            forceSelection: true,
            allowBlank: false,
            listeners: {
                change: function(combo, records) {
                    var record = combo.lastSelection[0];

                    me.basket.set('bookingDomain', record.get('domain'));

                    me.bookingDomainAmount.update(
                        me.formatPrice(record.get('balance'))
                    );

                    if (record.get('balance') >= 0) {
                        me.bookingDomainAmount.addCls('positive');
                        me.bookingDomainAmount.removeCls('negative');
                    } else {
                        me.bookingDomainAmount.addCls('negative');
                        me.bookingDomainAmount.removeCls('positive');
                    }
                }
            }
        });

        me.chargeDomainButton = Ext.create('PluginManager.container.Container', {
            cls: 'plugin-manager-action-button primary charge-amount',
            html: '<a href="https://account.shopware.com/#/accountCharging" target="_blank"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'charge_amount','default'=>'Charge amount','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'charge_amount','default'=>'Charge amount','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Charge amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'charge_amount','default'=>'Charge amount','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>'
        });

        me.bookingDomain = Ext.create('Ext.container.Container', {
            cls: 'booking-container booking-domain',
            flex: 1,
            layout: 'anchor',
            items: [
                bookingDomainHeadline,
                me.bookingDomainAmount,
                me.bookingDomainSelection,
                me.chargeDomainButton
            ]
        });

        me.basket.set('bookingDomain', me.basket.get('licenceDomain'));
        me.bookingDomainSelection.select(me.basket.get('bookingDomain'));

        return Ext.create('Ext.container.Container', {
            cls: 'booking-information',
            margin: '25 0',
            padding: '10 0',
            height: 230,
            layout: {
                type: 'hbox',
                align: 'stretch'
            },
            items: [ me.bookingDomain, me.licenceDomain, me.billingAddress ]
        });
    },

    createPositions: function() {
        var me = this;

        var positions = [];

        var header = Ext.create('Ext.Component', {
            cls: 'position-header',
            height: 30,
            html: '<div class="name-header"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'product','default'=>'Article','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product','default'=>'Article','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product','default'=>'Article','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>' +
            '<div class="price-header"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'price','default'=>'Price','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'price','default'=>'Price','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'price','default'=>'Price','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
        });

        positions.push(header);

        me.basket['getPositionsStore'].each(function(position) {
            var plugin = position['getPluginStore'].first();

            var icon = Ext.create('Ext.Component', {
                cls: 'image',
                width: 58,
                height: 58,
                html: '<img src="' + plugin.get('iconPath') + '" />'
            });

            var type = me.getTextForPriceType(position.get('priceType'));

            var name = Ext.create('Ext.Component', {
                cls: 'plugin-data',
                width: 500,
                html: '<div class="name">' + plugin.get('label') + '</div>' +
                '<div class="number"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'product_number','default'=>'Article nr.:','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product_number','default'=>'Article nr.:','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product nr.:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product_number','default'=>'Article nr.:','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'+ plugin.get('code') + '</div>' +
                '<div class="type">'+ type +'</div>'
            });

            var price = Ext.create('Ext.Component', {
                cls: 'plugin-price',
                width: 90,
                html: me.formatPrice(position.get('price')) + ' *'
            });

            var row = Ext.create('Ext.container.Container', {
                cls: 'row',
                minHeight: 120,
                layout: {
                    type: 'hbox',
                    align: 'stretch'
                },
                items: [ icon, name, price ]
            });

            positions.push(row);
        });

        return Ext.create('Ext.container.Container', {
            items: positions,
            minHeight: 165,
            cls: 'position-wrapper'
        })
    },

    createTotal: function() {
        var me = this, items = [];

        var total = Ext.create('Ext.Component', {
            cls: 'amount',
            html: '<div class="label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'total_amount','default'=>'Total amount','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'total_amount','default'=>'Total amount','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Total amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'total_amount','default'=>'Total amount','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>' +
                  '<div class="value">'+ me.formatPrice(me.basket.get('grossPrice')) +'</div>'
        });
        items.push(total);

        var net = Ext.create('Ext.Component', {
            cls: 'amount-net',
            html: '<div class="label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'total_amount_without_tax','default'=>'Total amount excl. VAT:','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'total_amount_without_tax','default'=>'Total amount excl. VAT:','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Total amount excl. VAT:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'total_amount_without_tax','default'=>'Total amount excl. VAT:','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>' +
                  '<div class="value">'+ me.formatPrice(me.basket.get('netPrice')) +'</div>'
        });

        var tax =  Ext.create('Ext.Component', {
            cls: 'tax',
            html: '<div class="label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tax_rate_label','default'=>'plus','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tax_rate_label','default'=>'plus','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
plus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tax_rate_label','default'=>'plus','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 '+ me.basket.get('taxRate') +'% <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tax_value_label','default'=>'VAT:','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tax_value_label','default'=>'VAT:','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
VAT:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tax_value_label','default'=>'VAT:','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>' +
                  '<div class="value">'+ me.formatPrice(me.basket.get('taxPrice')) +'</div>'
        });

        if (me.basket.get('taxPrice') > 0) {
            items.push(net);
            items.push(tax);
        }

        var container = Ext.create('Ext.container.Container', {
            cls: 'basket-amount-container',
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            width: 390,
            items: items
        });

        return Ext.create('Ext.container.Container', {
            cls: 'basket-amount-wrapper',
            height: 185,
            items: [ container ]
        });
    },

    createButtons: function() {
        var me = this;

        var cancelButton = Ext.create('PluginManager.container.Container', {
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'plugin-manager-action-button cancel',
            handler: function() {
                me.destroy();
            }
        });

        me.applyButton = Ext.create('PluginManager.container.Container', {
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'purchase_button','default'=>'Complete payment','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'purchase_button','default'=>'Complete payment','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Complete payment<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'purchase_button','default'=>'Complete payment','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'plugin-manager-action-button primary buy',
            disabled: true,
            handler: function() {
                if (me.gtcBox.getValue() && me.bookingDomainSelection.validate()) {
                    me.callback(me.basket);
                }
            }
        });

        return Ext.create('Ext.toolbar.Toolbar', {
            dock: 'bottom',
            cls: 'toolbar',
            items: [ cancelButton , '->', me.applyButton]
        });
    },

    formatPrice: function(value) {
        return Ext.util.Format.currency(value, ' €', 2, true);
    }

});
//<?php }} ?>