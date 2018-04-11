<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:42
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\detail\prices.js" */ ?>
<?php /*%%SmartyHeaderCode:67935acda8fe6eb260-99990673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97ba681e47b8d26847010cafa076833b6ff36fa8' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\detail\\prices.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '67935acda8fe6eb260-99990673',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fe7b4766_52884176',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fe7b4766_52884176')) {function content_5acda8fe7b4766_52884176($_smarty_tpl) {?>/**
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
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.detail.Prices', {
    extend: 'PluginManager.tab.Panel',
    cls: 'store-plugin-detail-prices-tab shopware-plugin-manager-tab',
    margin: '10 0',

    mixins: {
        events: 'Shopware.apps.PluginManager.view.PluginHelper'
    },

    tabIndex: { },

    initComponent: function() {
        var me = this,
            items = [],
            index = 0,
            buyPrice = me.getPriceByType(me.prices, 'buy'),
            rentPrice = me.getPriceByType(me.prices, 'rent'),
            testPrice = me.getPriceByType(me.prices, 'test'),
            freePrice = me.getPriceByType(me.prices, 'free'),
            redirectToStore = me.plugin.get('redirectToStore'),
            lowestPrice = me.plugin.get('lowestPrice'),
            price;

        if (redirectToStore) {
            price = me.getLowestPrice({
                lowestPrice: lowestPrice,
                buyPrice: buyPrice,
                freePrice: freePrice
            });

            items.push(me.createCommunityTab(price));
            me.tabIndex['bye'] = index;
            index++;

            // In this case we only want to add the "test tab" if it exists.
            // For this reason set the other prices to "null"
            buyPrice = null;
            rentPrice = null;
            freePrice = null;
        }

        if (buyPrice) {
            items.push(me.createBuyTab(buyPrice));
            me.tabIndex['buy'] = index;
            index++;
        }
        if (rentPrice) {
            items.push(me.createRentTab(rentPrice));
            me.tabIndex['rent'] = index;
            index++;
        }
        if (testPrice) {
            items.push(me.createTestTab(testPrice));
            me.tabIndex['test'] = index;
            index++;
        }
        if (freePrice) {
            items.push(me.createFreeTab(freePrice));
            me.tabIndex['free'] = index;
            index++;
        }
        if (items.length <= 0 && me.plugin.get('useContactForm')) {
            items.push(me.createContactTab());
            me.tabIndex['contact'] = index;
            index++;
        }

        me.items = items;

        me.callParent(arguments);
    },

    /**
     * @param { Shopware.apps.PluginManager.model.Price } price
     * @returns { Ext.container.Container }
     */
    createCommunityTab: function(price) {
        var me = this,
            items = [];

        items.push({
            xtype: 'plugin-manager-container-container',
            cls: 'button buy',
            html: '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'show/in/community/store','default'=>'Show in store','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'show/in/community/store','default'=>'Show in store','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Show in store<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'show/in/community/store','default'=>'Show in store','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            handler: Ext.bind(me.onShowInCommunityStore, me)
        });

        items.push({
            xtype: 'component',
            cls: 'price',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'from/price/prefix','default'=>'from','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'from/price/prefix','default'=>'from','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
from<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'from/price/prefix','default'=>'from','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + me.formatPrice(price.get('price')) + ' *'
        });

        if (price.get('subscription')) {
            items.push({
                xtype: 'component',
                cls: 'subscription',
                html: '<div class="icon">U</div>' +
                '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'subscription_info','default'=>'Incl. updates for 12 Months (subscription)','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'subscription_info','default'=>'Incl. updates for 12 Months (subscription)','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Incl. updates for 12 Months (subscription)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'subscription_info','default'=>'Incl. updates for 12 Months (subscription)','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
            });
        }

        return Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'community/store/tab/header','default'=>'Community store','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'community/store/tab/header','default'=>'Community store','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Community store<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'community/store/tab/header','default'=>'Community store','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'tab buy-tab',
            height: 110,
            items: items
        });
    },

    /**
     * This is the event handler for the buy button. If the buy button is
     * clicked open a new window with the given URL to the Store.
     */
    onShowInCommunityStore: function() {
        var me = this;

        window.open(me.plugin.get('link'));
    },

    /**
     * @param { object } prices
     */
    getLowestPrice: function(prices) {
        var me = this;

        if (prices.lowestPrice) {
            return Ext.create('Shopware.apps.PluginManager.model.Price', {
                price: prices.lowestPrice,
                subscription: prices.buyPrice && prices.buyPrice.get('subscription') ? prices.buyPrice.get('subscription') : false,
                type: 'buy'
            });
        }

        if (prices.freePrice) {
            return prices.freePrice;
        }

        if(prices.buyPrice) {
            return prices;
        }

        return Ext.create('Shopware.apps.PluginManager.model.Price', {
            price: 0,
            subscription: false,
            type: 'free'
        });
    },

    createContactTab: function() {
        var me = this, items = [];

        items.push({
            xtype: 'plugin-manager-container-container',
            cls: 'button contact',
            html: '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'contact_text','default'=>'Contact producer','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_text','default'=>'Contact producer','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Contact producer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_text','default'=>'Contact producer','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            handler: function() {
                var link = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'contact_link','default'=>'http://store.shopware.com/en/contact-producer','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_link','default'=>'http://store.shopware.com/en/contact-producer','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
http://store.shopware.com/en/contact-producer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_link','default'=>'http://store.shopware.com/en/contact-producer','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
?technicalName=' + me.plugin.get('technicalName');
                window.open(link);
            }
        });

        return Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'contact_version','default'=>'Contact','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_version','default'=>'Contact','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Contact<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_version','default'=>'Contact','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'tab',
            height: 110,
            items: items
        });
    },

    createFreeTab: function(price) {
        var me = this, items = [];

        items.push({
            xtype: 'plugin-manager-container-container',
            cls: 'button free',
            html: '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'download_now','default'=>'Download now','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'download_now','default'=>'Download now','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Download now<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'download_now','default'=>'Download now','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            handler: function() {
                me.downloadFreePluginEvent(me.plugin, price);
            }
        });

        items.push({
            xtype: 'component',
            cls: 'price-free',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'for_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'for_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'for_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        return Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'free_version','default'=>'Free version','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'free_version','default'=>'Free version','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'free_version','default'=>'Free version','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'tab',
            height: 110,
            items: items
        });
    },

    createBuyTab: function(price) {
        var me = this, items = [];

        items.push({
            xtype: 'plugin-manager-container-container',
            cls: 'button buy',
            html: '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'buy_now','default'=>'Buy now','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'buy_now','default'=>'Buy now','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Buy now<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'buy_now','default'=>'Buy now','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            handler: function() {
                me.buyPluginEvent(me.plugin, price);
            }
        });

        items.push({
            xtype: 'component',
            cls: 'price',
            html: me.formatPrice(price.get('price')) + ' *'
        });

        if (price.get('subscription')) {
            items.push({
                xtype: 'component',
                cls: 'subscription',
                html: '<div class="icon">U</div>' +
                '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'subscription_info','default'=>'Incl. updates for 12 Months (subscription)','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'subscription_info','default'=>'Incl. updates for 12 Months (subscription)','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Incl. updates for 12 Months (subscription)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'subscription_info','default'=>'Incl. updates for 12 Months (subscription)','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
            });
        }

        return Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'buy_version','default'=>'Purchase version','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'buy_version','default'=>'Purchase version','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Purchase version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'buy_version','default'=>'Purchase version','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'tab buy-tab',
            height: 110,
            items: items
        });
    },

    createRentTab: function(price) {
        var me = this, items = [];

        items.push({
            xtype: 'plugin-manager-container-container',
            cls: 'button rent',
            html: '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'rent_now','default'=>'Rent now','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_now','default'=>'Rent now','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Rent now<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_now','default'=>'Rent now','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            handler: function() {
                me.rentPluginEvent(me.plugin, price);
            }
        });

        items.push({
            xtype: 'component',
            cls: 'price',
            html: me.formatPrice(price.get('price')) + ' * <div class="month">/ <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'per_month','default'=>'per month','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'per_month','default'=>'per month','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
per month<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'per_month','default'=>'per month','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
        });

        items.push({
            xtype: 'component',
            cls: 'subscription',
            html: '<div class="icon">U</div>' +
            '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'rent_subscription_info','default'=>'All updates included during renting period','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_subscription_info','default'=>'All updates included during renting period','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
All updates included during renting period<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_subscription_info','default'=>'All updates included during renting period','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
        });

        items.push({
            xtype: 'component',
            cls: 'dismissal',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'rent_cancel','default'=>'Is cancelable on a monthly basis.','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_cancel','default'=>'Is cancelable on a monthly basis.','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Three months minimum duration for rent.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_cancel','default'=>'Is cancelable on a monthly basis.','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        return Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'rent_version','default'=>'Rent version','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_version','default'=>'Rent version','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Rent version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rent_version','default'=>'Rent version','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'tab rent-tab',
            height: 110,
            items: items
        });
    },

    createTestTab: function(price) {
        var me = this, items = [];

        items.push({
            xtype: 'plugin-manager-container-container',
            cls: 'button test',
            html: '<div class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'request_test_version','default'=>'Request test version','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'request_test_version','default'=>'Request test version','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Request test version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'request_test_version','default'=>'Request test version','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>',
            handler: function() {
                me.requestPluginTestVersionEvent(me.plugin, price);
            }
        });

        items.push({
            xtype: 'component',
            cls: 'price-free',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'for_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'for_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'for_free','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        return Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'test_version','default'=>'Test version','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'test_version','default'=>'Test version','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Test version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'test_version','default'=>'Test version','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'tab',
            height: 110,
            items: items
        });
    },

    getPriceByType: function(prices, type) {
        var me = this, price = null;

        prices.each(function(item) {
            if (item.get('type') == type) {
                price = item;
            }
        });
        return price;
    },

    formatPrice: function(value) {
        return Ext.util.Format.currency(value, ' €', 2, true);
    }

});
//<?php }} ?>