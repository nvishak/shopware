<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\main\wizard.js" */ ?>
<?php /*%%SmartyHeaderCode:320565acda8f1dc5a37-42266732%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd0291be32573aeab7c23386d189d3a67d159231' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\main\\wizard.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320565acda8f1dc5a37-42266732',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f1e634a7_22514653',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f1e634a7_22514653')) {function content_5acda8f1e634a7_22514653($_smarty_tpl) {?>/**
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
 * @subpackage Main
 * @version    $Id$
 * @author shopware AG
 */

// 
// 
Ext.define('Shopware.apps.Customer.view.main.Wizard', {
    extend: 'Ext.window.Window',
    layout: 'fit',
    autoShow: false,
    modal: true,
    cls: 'plugin-manager-loading-mask customer-wizard',
    bodyPadding: 20,
    header: false,
    width: 1250,
    height: 540,

    initComponent: function() {
        var me = this;

        me.dockedItems = me.createDockedItems();

        me.items = me.createItems();

        me.callParent(arguments);
    },

    nextPage: function() {
        var me = this;
        var layout = me.cardContainer.getLayout();

        me.nextButton.setText('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'next','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'next','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Next<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'next','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
        me.previousButton.show();

        if (layout.getNext()) {
            layout.next();

            if (!layout.getNext()) {
                me.nextButton.setText('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'finish','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'finish','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To module<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'finish','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            }
        } else {
            me.finish();
        }
    },

    previousPage: function() {
        var me = this;
        var layout = me.cardContainer.getLayout();

        me.nextButton.setText('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'next','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'next','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Next<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'next','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

        if (layout.getPrev()) {
            layout.prev();
        }
        me.previousButton.show();
        if (!layout.getPrev()) {
            me.previousButton.hide();
        }
    },

    finish: function() {
        var me = this;
        me.fireEvent('finish');
        me.destroy();
    },

    createItems: function() {
        var me = this;

        me.cardContainer = Ext.create('Ext.container.Container', {
            region: 'center',
            layout: 'card',
            items: [
                me.createFirstPage(),
                me.createSecondPage(),
                me.createFinishPage()
            ]
        });
        return [me.cardContainer];
    },

    createFirstPage: function() {
        var image = '/shopware4/themes/Backend/ExtJs/backend/_resources/images/customer_stream/quick_view.jpg';
        if (Ext.userLanguage === 'de') {
            image = '/shopware4/themes/Backend/ExtJs/backend/_resources/images/customer_stream/quick_view_de.jpg';
        }

        return Ext.create('Ext.container.Container', {
            html: '' +
            '<h1 class="headline">' +
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'wizard_customer_quick_view_headline','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_customer_quick_view_headline','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer overview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_customer_quick_view_headline','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' +
            '</h1>' +
            '<div class="description">' +
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'wizard_customer_quick_view_text','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_customer_quick_view_text','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<p>The customer overview offers a quick access to all registered customers. Every relevant customer information as well as a link to contact the customer can be found there.</p><p>Aside from the free text search, you\'ll find a filter panel on the left side where you can add multiple criteria to search for specific customers.</p><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_customer_quick_view_text','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' +
            '</div>' +
            '<div class="image">' +
                '<img src="' + image + '" />' +
            '</div>'
        });
    },

    createSecondPage: function() {
        var image = '/shopware4/themes/Backend/ExtJs/backend/_resources/images/customer_stream/stream_view.jpg';
        if (Ext.userLanguage === 'de') {
            image = '/shopware4/themes/Backend/ExtJs/backend/_resources/images/customer_stream/stream_view_de.jpg';
        }

        return Ext.create('Ext.container.Container', {
            html: '' +
            '<h1 class="headline">' +
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'wizard_stream_view_headline','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_stream_view_headline','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer Streams overview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_stream_view_headline','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' +
            '</h1>' +
            '<div class="description">' +
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'wizard_stream_view_text','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_stream_view_text','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<p>With the Customer Streams you are able to classify customers according to certain criteria.</p><p>Afterwards you are able to create evaluations, carry out marketing campaigns, publish individual shop content and do much more in terms of customer classification.</p><p>In order to ensure that working with the Customer Streams is easy and simple for you, the customer data will be analyzed on a daily basis.</p><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_stream_view_text','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' +
            '</div>' +
            '<div class="image">' +
                '<img src="' + image + '" />' +
            '</div>'
        });
    },

    createFinishPage: function() {
        var image = '/shopware4/themes/Backend/ExtJs/backend/_resources/images/customer_stream/ekw_usage.jpg';
        if (Ext.userLanguage === 'de') {
            image = '/shopware4/themes/Backend/ExtJs/backend/_resources/images/customer_stream/ekw_usage_de.jpg';
        }

        return Ext.create('Ext.container.Container', {
            html: '' +
            '<h1 class="headline">' +
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'wizard_usage_headline','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_usage_headline','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Usability<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_usage_headline','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' +
            '</h1>' +
            '<div class="description">' +
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'wizard_usage_text','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_usage_text','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<p>The Customer Streams offer a strong re-usability in your shop.</p><p>For instance, you can define your own shopping world by Customer Streams, to suit the individual wishes of your customers.</p><p>In addition to that, you are able to limit coupons for certain customers and send out newsletters to different streams.</p><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'wizard_usage_text','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' +
            '</div>' +
            '<div class="image">' +
                '<img src="' + image + '" />' +
            '</div>'
        });
    },

    createDockedItems: function() {
        var me = this;

        me.nextButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'next','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'next','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Next<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'next','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'primary',
            handler: Ext.bind(me.nextPage, me)
        });

        me.previousButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'back','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'back','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Back<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'back','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'secondary',
            hidden: true,
            handler: Ext.bind(me.previousPage, me)
        });

        me.skipButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'skip','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'skip','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Skip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'skip','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'secondary',
            handler: Ext.bind(me.finish, me)
        });

        return [{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'shopware-ui',
            items: [me.skipButton, '->', me.previousButton, me.nextButton]
        }];
    }
});
// <?php }} ?>