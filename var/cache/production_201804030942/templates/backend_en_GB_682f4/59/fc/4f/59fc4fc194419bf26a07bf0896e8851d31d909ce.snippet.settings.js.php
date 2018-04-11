<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\detail\settings.js" */ ?>
<?php /*%%SmartyHeaderCode:22405acda8f25240c3-35822719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59fc4fc194419bf26a07bf0896e8851d31d909ce' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\detail\\settings.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22405acda8f25240c3-35822719',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f26c0343_41514731',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f26c0343_41514731')) {function content_5acda8f26c0343_41514731($_smarty_tpl) {?>/**
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
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Article detail page
 * The settings component contains the settings elements for the article, like delivery time, supplier number,
 * the article stock, etc.
 */
//
//
Ext.define('Shopware.apps.Article.view.detail.Settings', {
    /**
     * Define that the billing field set is an extension of the Ext.form.FieldSet
     * @string
     */
    extend:'Ext.form.FieldSet',

    /**
     * The Ext.container.Container.layout for the fieldset's immediate child items.
     * @object
     */
    layout: 'column',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias:'widget.article-settings-field-set',
    /**
     * Set css class for this component
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-settings-field-set',
    /**
     * Contains the field set defaults.
     */
    defaults: {
        labelWidth: 155
    },
    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        title:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'title','default'=>'Settings','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'title','default'=>'Settings','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Settings<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'title','default'=>'Settings','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        supplierNumber:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'supplier_number','default'=>'Supplier number','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'supplier_number','default'=>'Supplier number','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Manufacturer number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'supplier_number','default'=>'Supplier number','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        avoidCustomerGroups: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'avoid_customer_groups_label','default'=>'Avoid customer groups','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'avoid_customer_groups_label','default'=>'Avoid customer groups','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Avoid customer groups<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'avoid_customer_groups_label','default'=>'Avoid customer groups','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            support: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'avoid_customer_groups_support','default'=>'Here you have the opportunity to deactivate the article for different customer groups.','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'avoid_customer_groups_support','default'=>'Here you have the opportunity to deactivate the article for different customer groups.','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Here you have the option of deactivating the item for different customer groups.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'avoid_customer_groups_support','default'=>'Here you have the opportunity to deactivate the article for different customer groups.','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        emailNotification: {
            field: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'email_notification_field','default'=>'Email notification','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'email_notification_field','default'=>'Email notification','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Email notification<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'email_notification_field','default'=>'Email notification','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            box: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'email_notification_box','default'=>'Show notification feature','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'email_notification_box','default'=>'Show notification feature','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Show notification feature<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'email_notification_box','default'=>'Show notification feature','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        deliveryTime: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'delivery_time','default'=>'Delivery time (days)','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'delivery_time','default'=>'Delivery time (days)','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delivery time (days)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'delivery_time','default'=>'Delivery time (days)','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        stock: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'stock','default'=>'Stock','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'stock','default'=>'Stock','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'stock','default'=>'Stock','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        minStock: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'min_stock','default'=>'Minimum storage inventory','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'min_stock','default'=>'Minimum storage inventory','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Minimum storage inventory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'min_stock','default'=>'Minimum storage inventory','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        releaseDate: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'release_date','default'=>'Release date','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'release_date','default'=>'Release date','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Release date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'release_date','default'=>'Release date','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        createdAt: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'created_at','default'=>'Date of creation','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'created_at','default'=>'Date of creation','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Date of creation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'created_at','default'=>'Date of creation','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        pseudoSales: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'pseudo_sales','default'=>'Pseudo sales','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'pseudo_sales','default'=>'Pseudo sales','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Pseudo sales<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'pseudo_sales','default'=>'Pseudo sales','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        weight: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'weight_bw','default'=>'Weight (bw)','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'weight_bw','default'=>'Weight (bw)','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Weight (bw)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'weight_bw','default'=>'Weight (bw)','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        shippingFree: {
            field: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'shipping_free_field','default'=>'Free shipping','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'shipping_free_field','default'=>'Free shipping','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free shipping<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'shipping_free_field','default'=>'Free shipping','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            box: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'shipping_free_box','default'=>'Select article as free shipping','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'shipping_free_box','default'=>'Select article as free shipping','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select item as free shipping<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'shipping_free_box','default'=>'Select article as free shipping','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        highlight: {
            field: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'highlight_field','default'=>'Highlight article','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'highlight_field','default'=>'Highlight article','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Highlight item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'highlight_field','default'=>'Highlight article','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            box: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'highlight_box','default'=>'Highlight article in shop','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'highlight_box','default'=>'Highlight article in shop','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Highlight item in shop<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'highlight_box','default'=>'Highlight article in shop','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        onSale: {
            field: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'on_sale_field','default'=>'On sale','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'on_sale_field','default'=>'On sale','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
On sale<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'on_sale_field','default'=>'On sale','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            box: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'on_sale_box','default'=>'If instock <= 0, article isn\'t orderable','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'on_sale_box','default'=>'If instock <= 0, article isn\'t orderable','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
If the stock is <= 0, the item is not available<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'on_sale_box','default'=>'If instock <= 0, article isn\'t orderable','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"
        },
        minimumOrder: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'minimum_order','default'=>'Minimum order','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'minimum_order','default'=>'Minimum order','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Minimum order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'minimum_order','default'=>'Minimum order','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        graduation: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'graduation','default'=>'Graduation','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'graduation','default'=>'Graduation','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Graduation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'graduation','default'=>'Graduation','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        maximumOrder: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'maximum_order','default'=>'Maximum order','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'maximum_order','default'=>'Maximum order','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Maximum order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'maximum_order','default'=>'Maximum order','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        ean: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'ean','default'=>'EAN','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'ean','default'=>'EAN','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EAN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'ean','default'=>'EAN','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        width: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'width','default'=>'Width','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'width','default'=>'Width','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Width<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'width','default'=>'Width','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        height: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'height','default'=>'Height','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'height','default'=>'Height','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Height<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'height','default'=>'Height','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        len: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'settings'/'length','default'=>'Length','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'length','default'=>'Length','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Length<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'settings'/'length','default'=>'Length','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

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
    initComponent:function () {
        var me = this,
            mainWindow = me.subApp.articleWindow;

        mainWindow.on('storesLoaded', me.onStoresLoaded, me);

        me.title = me.snippets.title;
        me.items = me.createElements();
        me.callParent(arguments);
    },

    /**
     * Creates the both containers for the field set
     * to display the form fields in two columns.
     *
     * @return array Contains the left and right container
     */
    createElements:function () {
        var leftContainer, rightContainer, me = this, bottomContainer;

        bottomContainer = Ext.create('Ext.container.Container', {
            columnWidth:1,
            defaults: {
                labelWidth: 155,
                anchor: '100%'
            },
            layout: 'anchor',
            border:false,
            items: me.createBottomElements()
        });

        leftContainer = Ext.create('Ext.container.Container', {
            columnWidth:0.5,
            defaults: {
                labelWidth: 155,
                anchor: '100%'
            },
            padding: '0 20 0 0',
            layout: 'anchor',
            border:false,
            items:me.createLeftElements()
        });

        rightContainer = Ext.create('Ext.container.Container', {
            columnWidth:0.5,
            layout: 'anchor',
            defaults: {
                labelWidth: 155,
                anchor: '100%'
            },
            border:false,
            items:me.createRightElements()
        });

        return [ leftContainer, rightContainer, bottomContainer ] ;
    },

    createBottomElements: function() {
        var me = this;
        me.avoidCustomerGroupsCombo = Ext.create('Ext.ux.form.field.BoxSelect', {
            forceSelection: true,
            delimiter: ', ',
            displayField: 'name',
            valueField: 'id',
            queryMode: 'local',
            name: 'avoidCustomerGroups',
            labelWidth: 155,
            width: '100%',
            anchor: '100%',
            fieldLabel: me.snippets.avoidCustomerGroups.label,
            supportText: me.snippets.avoidCustomerGroups.support
        });
        return [ me.avoidCustomerGroupsCombo ]
    },

    /**
     * Creates the field set items which displayed in the left column of the settings field set
     * @return Array
     */
    createLeftElements: function() {
        var me =this;

        return [
            {
                xtype: 'checkboxfield',
                name: 'notification',
                fieldLabel: me.snippets.emailNotification.field,
                boxLabel: me.snippets.emailNotification.box,
                inputValue: true,
                uncheckedValue: false
            }, {
                xtype: 'textfield',
                name: 'mainDetail[shippingTime]',
                translationName: 'shippingTime',
                translatable: true,
                fieldLabel: me.snippets.deliveryTime
            }, {
                xtype: 'numberfield',
                name: 'mainDetail[inStock]',
                decimalPrecision: 0,
                fieldLabel: me.snippets.stock
            }, {
                xtype: 'numberfield',
                name: 'mainDetail[stockMin]',
                decimalPrecision: 0,
                fieldLabel: me.snippets.minStock
            }, {
                xtype: 'datefield',
                name: 'mainDetail[releaseDate]',
                submitFormat: 'd.m.Y',
                fieldLabel: me.snippets.releaseDate
            }, {
                xtype: 'datefield',
                name: 'added',
                submitFormat: 'd.m.Y',
                fieldLabel: me.snippets.createdAt
            }, {
                xtype: 'numberfield',
                name: 'pseudoSales',
                fieldLabel: me.snippets.pseudoSales
            } , {
               xtype: 'numberfield',
               name: 'mainDetail[minPurchase]',
               decimalPrecision: 0,
               minValue: 1,
               value: 1,
               fieldLabel: me.snippets.minimumOrder
           }, {
               xtype: 'numberfield',
               name: 'mainDetail[purchaseSteps]',
               decimalPrecision: 0,
               fieldLabel: me.snippets.graduation
           }, {
               xtype: 'numberfield',
               name: 'mainDetail[maxPurchase]',
               decimalPrecision: 0,
               fieldLabel: me.snippets.maximumOrder
           }
        ];
    },

    /**
     * Creates the field set items which displayed in the right column of the settings field set
     * @return Array
     */
    createRightElements: function() {
        var me = this;

        return [
            {
                xtype: 'textfield',
                name: 'mainDetail[supplierNumber]',
                fieldLabel: me.snippets.supplierNumber
            }, {
                xtype: 'numberfield',
                name: 'mainDetail[weight]',
                decimalPrecision: 3,
                submitLocaleSeparator: false,
                fieldLabel: me.snippets.weight
            }, {
                xtype: 'checkboxfield',
                name: 'mainDetail[shippingFree]',
                fieldLabel: me.snippets.shippingFree.field,
                boxLabel: me.snippets.shippingFree.box,
                inputValue: true,
                uncheckedValue:false
            }, {
                xtype: 'checkboxfield',
                name: 'highlight',
                fieldLabel: me.snippets.highlight.field,
                boxLabel: me.snippets.highlight.box,
                inputValue: true,
                uncheckedValue:false
            }, {
                xtype: 'checkboxfield',
                name: 'lastStock',
                fieldLabel: me.snippets.onSale.field,
                boxLabel: me.snippets.onSale.box,
                inputValue: true,
                uncheckedValue:false
            }, {
                xtype: 'textfield',
                name: 'mainDetail[ean]',
                fieldLabel: me.snippets.ean
            }, {
                xtype: 'numberfield',
                name: 'mainDetail[width]',
                decimalPrecision: 3,
                submitLocaleSeparator: false,
                fieldLabel: me.snippets.width
            }, {
                xtype: 'numberfield',
                name: 'mainDetail[height]',
                decimalPrecision: 3,
                submitLocaleSeparator: false,
                fieldLabel: me.snippets.height
            }, {
                xtype: 'numberfield',
                name: 'mainDetail[len]',
                decimalPrecision: 3,
                submitLocaleSeparator: false,
                fieldLabel: me.snippets.len
            }

        ];
    },

    onStoresLoaded: function(article, stores) {
        var me = this;

        me.customerGroupStore = stores['customerGroups'];
        me.avoidCustomerGroupsCombo.bindStore(me.customerGroupStore);
    }
});
//
<?php }} ?>