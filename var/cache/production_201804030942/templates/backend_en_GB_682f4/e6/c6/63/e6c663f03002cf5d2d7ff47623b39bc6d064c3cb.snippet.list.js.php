<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\variant\list.js" */ ?>
<?php /*%%SmartyHeaderCode:230915acda8f43d6ff4-23126403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6c663f03002cf5d2d7ff47623b39bc6d064c3cb' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\variant\\list.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230915acda8f43d6ff4-23126403',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f45549e2_19386189',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f45549e2_19386189')) {function content_5acda8f45549e2_19386189($_smarty_tpl) {?>/**
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
 * @subpackage Variants
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Article detail page
 * The variant list component is the listing component for the created article variants.
 */
//
//
Ext.define('Shopware.apps.Article.view.variant.List', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend:'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
    */
    alias:'widget.article-variant-list',

    /**
     * Set css class
     * @string
     */
    cls:Ext.baseCSSPrefix + 'article-variant-list',

    /**
     * The view needs to be scrollable
     * @string
     */
    autoScroll:true,

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        regexNumberValidation: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The item number entered contains invalid characters!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        columns:{
            number:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'number','default'=>'Order number','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'number','default'=>'Order number','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'number','default'=>'Order number','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            stock:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'stock','default'=>'Stock','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'stock','default'=>'Stock','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'stock','default'=>'Stock','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            price: {
                header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'price','default'=>'Price','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'price','default'=>'Price','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'price','default'=>'Price','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                undefined: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'price_undefined','default'=>'Undefined','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'price_undefined','default'=>'Undefined','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Undefined<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'price_undefined','default'=>'Undefined','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                from: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'price_from','default'=>'From','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'price_from','default'=>'From','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'price_from','default'=>'From','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            },
            pseudoPrice: {
                header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'pseudoprice','default'=>'Pseudoprice','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'pseudoprice','default'=>'Pseudoprice','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Pseudoprice<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'pseudoprice','default'=>'Pseudoprice','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                undefined: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'pseudoprice_undefined','default'=>'Undefined','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'pseudoprice_undefined','default'=>'Undefined','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Undefined<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'pseudoprice_undefined','default'=>'Undefined','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            },
            standard: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'standard','default'=>'Preselection','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'standard','default'=>'Preselection','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Preselection<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'standard','default'=>'Preselection','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            active: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'active','default'=>'Active','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'active','default'=>'Active','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'active','default'=>'Active','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            remove: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'remove','default'=>'Remove variant','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'remove','default'=>'Remove variant','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Remove variant<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'remove','default'=>'Remove variant','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            edit: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'column'/'edit','default'=>'Edit variant','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'edit','default'=>'Edit variant','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Edit variant<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'column'/'edit','default'=>'Edit variant','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        toolbar:{
            add:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'button_add','default'=>'Add','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'button_add','default'=>'Add','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'button_add','default'=>'Add','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            remove:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'button_delete','default'=>'Delete all selected','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'button_delete','default'=>'Delete all selected','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete selected variants<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'button_delete','default'=>'Delete all selected','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            search:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Search...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            data:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'data','default'=>'Apply standard data','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'data','default'=>'Apply standard data','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Apply standard data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'data','default'=>'Apply standard data','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            save:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'save','default'=>'Save changes','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'save','default'=>'Save changes','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save changes<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'save','default'=>'Save changes','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            orderNumber: {
                field: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'order_field','default'=>'Apply standard prices','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'order_field','default'=>'Apply standard prices','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Apply standard prices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'order_field','default'=>'Apply standard prices','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                button: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'order_button','default'=>'Regenerate order numbers','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'order_button','default'=>'Regenerate order numbers','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Regenerate order numbers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'order_button','default'=>'Regenerate order numbers','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                empty: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'variant'/'list'/'toolbar'/'order_empty','default'=>'mainDetail.number','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'order_empty','default'=>'mainDetail.number','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'variant'/'list'/'toolbar'/'order_empty','default'=>'mainDetail.number','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            }
        },
        saved: {
            errorMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'article_saved'/'error_message','default'=>'An error has occurred while saving the article:','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'error_message','default'=>'An error has occurred while saving the article:','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to save the item:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'error_message','default'=>'An error has occurred while saving the article:','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            errorTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'article_saved'/'error_title','default'=>'Error','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'error_title','default'=>'Error','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'article_saved'/'error_title','default'=>'Error','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            ordernumberNotMatch: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The item number entered contains invalid characters!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Initialize the Shopware.apps.Article.view.variant.List and defines the necessary default configuration
     *
     * @return void
     */
    initComponent:function () {
        var me = this,
            mainWindow = me.subApp.articleWindow;

        mainWindow.on('storesLoaded', me.onStoresLoaded, me);
        me.configuratorGroupStore = mainWindow.configuratorGroupStore;

        // Since we don't allow any column to be sorted, we disable the possibility to do so.
        me.sortableColumns = false;

        me.registerEvents();
        me.columns = me.getColumns(true);

        me.toolbar = me.getToolbar();
        me.pagingbar = me.getPagingBar();
        me.plugins = [ me.createCellEditor() ];
        me.dockedItems = [ me.toolbar, me.pagingbar ];
        me.callParent(arguments);
    },

    /**
     * Creates the cell editor the grid panel.
     *
     * @public
     * @return [object] Ext.grid.plugin.CellEditing
     */
    createCellEditor: function() {
        var me = this;

        me.cellEditor = Ext.create('Ext.grid.plugin.CellEditing', {
            clicksToMoveEditor: 1,
            autoCancel: true
        });

        // Register listener on the edit event to save the record and convert the price value. Without
        // this listener the insert price "10,55" would be become "1055"
        me.cellEditor.on('edit', function(editor, e) {
            if (e.value && e.field === 'price') {
                var newPrice = Ext.Number.from(e.value);
                newPrice = Ext.Number.toFixed(newPrice, 2);

                var oldPrice = Ext.Number.from(e.originalValue);
                oldPrice = Ext.Number.toFixed(oldPrice, 2);

                if (newPrice != oldPrice) {
                    me.fireEvent('editVariantPrice', e.record, newPrice);
                }

            } else if (e.field === 'pseudoPrice') {
                var newPseudoPrice = Ext.Number.toFixed(0, 2);
                var oldPseudoPrice = null;

                if(e.value !== null) {
                    newPseudoPrice = Ext.Number.from(e.value);
                    newPseudoPrice = Ext.Number.toFixed(newPseudoPrice, 2);

                    oldPseudoPrice = Ext.Number.from(e.originalValue);
                    if(! Ext.isDefined(e.originalValue) || e.originalValue === null) {
                        oldPseudoPrice = 0;
                    }

                    oldPseudoPrice = Ext.Number.toFixed(oldPseudoPrice, 2);
                }

                if (newPseudoPrice !== oldPseudoPrice || newPseudoPrice === 0.00) {
                    me.fireEvent('editVariantPseudoPrice', e.record, newPseudoPrice);
                }

            } else {
                var oldValue = e.originalValue,
                    newValue = e.value;

                // The number field is a mapping field of the variant. so we have to map this field
                if (e.field === 'details.number') {
                    oldValue = e.record.get('number');
                    newValue = e.record.get('details.number') || e.record.get('number')
                }

                if(e.field === 'details.number' &&  (!newValue || !newValue.match(/^[a-zA-Z0-9-_. ]+$/))) {
                    Shopware.Notification.createGrowlMessage(me.snippets.saved.errorTitle, me.snippets.saved.ordernumberNotMatch, me.snippets.growlMessage);
                    e.record.set('number', oldValue);
                    e.record.set('details.number', oldValue);
                    return;
                }

                if (oldValue === newValue) {
                    return;
                }

                if (e.field === 'details.number') {
                    e.record.set('number', newValue);
                }

                me.fireEvent('saveVariant', e.record);
            }
        });

        /**
         * Event listener which filters the html tags from the number value.
         */
        me.cellEditor.on('beforeedit', function(editor, e) {
            if(e.field === 'details.number') {

                // We need to defer the function call to make sure that the editor is rendered
                // and the value is loaded.
                Ext.defer(function() {

                    editor.editors.each(function(ed) {
                        ed.validationRequestParam = e.record.get('id');
                        ed.setValue(e.record.get('number'));
                    });
                }, 50);
            }
        }, me);

        return me.cellEditor;
    },

    /**
     * Called when the user creates the variants. This function recreates the grid columns.
     */
    refreshColumns: function() {
        var me = this;
        me.getSelectionModel().deselectAll();
        me.reconfigure(me.getStore(), me.getColumns(true));
    },

    /**
     * Defines additional events which will be fired from the component
     *
     * @return void
     */
    registerEvents:function () {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the delete button in the toolbar or
             * use the action column of the grid to remove one or multiple variants
             * @event deleteVariant
             * @param [array] Record - The selected records
             */
            'deleteVariant',

            /**
             * @event saveVariant
             */
            'saveVariant',

            /**
             * Event will be fired when the user insert a value into the search field of the toolbar
             * to filter the listing.
             * @event searchVariants
             */
            'searchVariants',

            /**
             * Event will be fired when the user clicks on the edit action column of the
             * grid, to edit a single variant.
             * @event editVariant
             * @param [Ext.data.Model] Record - The selected record
             */
            'editVariant',

            /**
             * Event will be fired when the user clicks the "generate order numbers" button in the
             * toolbar to create new article order numbers.
             * @event generateOrderNumbers
             */
            'generateOrderNumbers',

            /**
             * Event will be fired when the user clicks the "apply standard prices" button in the toolbar
             * to apply the standard prices for all article variants.
             * @event applyPrices
             */
            'applyData',

            /**
             * Event will be fired over the row editor update button.
             * @event saveVariants
             */
            'editVariantPrice',

            /**
             * Event will be fired over the row editor update button.
             * @event saveVariants
             */
            'editVariantPseudoPrice',

            /**
             * Event will be fired over the save button if the user is on the configurator tab.
             * Fired from the detail.window component
             * @event createVariants
             */
            'createVariants',

            /**
             * Event will be fired over the save button if the user is on the settings tab.
             * Fired from the detail.window component
             * @event saveSettings
             */
            'saveSettings'
        );
    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns: function (dynamic) {
        var me = this, standardColumns, columns = [];

        dynamic = dynamic || false;

        standardColumns = [
            {
                header: me.snippets.columns.stock,
                dataIndex: 'inStock',
                sortable: false,
                flex: 1,
                renderer: me.stockColumnRenderer,
                editor: {
                    xtype: 'numberfield',
                    allowBlank: true,
                    allowDecimals: false
                }
            } ,{
                header: me.snippets.columns.price.header,
                dataIndex: 'price',
                sortable: false,
                flex: 1,
                renderer: me.priceColumnRenderer,
                editor: {
                    xtype: 'numberfield',
                    allowBlank: false,
                    decimalPrecision: 2
                }
            } ,{
                header: me.snippets.columns.pseudoPrice.header,
                dataIndex: 'pseudoPrice',
                sortable: false,
                flex: 1,
                renderer: me.pseudoPriceColumnRenderer,
                editor: {
                    xtype: 'numberfield',
                    allowBlank: true,
                    decimalPrecision: 2
                }
            } , {
                header: me.snippets.columns.standard,
                dataIndex: 'standard',
                sortable: false,
                flex: 1,
                editor: {
                    xtype: 'checkbox',
                    inputValue: true,
                    uncheckedValue: false
                }
            } , {
                header: me.snippets.columns.active,
                dataIndex: 'active',
                sortable: false,
                flex: 1,
                editor: {
                    xtype: 'checkbox',
                    inputValue: true,
                    uncheckedValue: false
                }
            } ,
            {
                /**
                 * Special column type which provides clickable icons in each row
                 */
                xtype:'actioncolumn',
                width:70,
                items:[
                    {
                        iconCls:'sprite-minus-circle-frame',
                        action:'deleteVariant',
                        tooltip:me.snippets.columns.remove,
                        handler: function (view, rowIndex, colIndex, item, opts, record) {
                            var records = [ record ];
                            me.fireEvent('deleteVariant', records);
                        }
                    } , {
                        iconCls:'sprite-pencil',
                        action:'editVariant',
                        tooltip:me.snippets.columns.edit,
                        handler:function (view, rowIndex, colIndex, item, opts, record) {
                            me.fireEvent('editVariant', record);
                        }
                    }
                ]
            }
        ];

        columns.push({
            header: me.snippets.columns.number,
            dataIndex: 'details.number',
            sortable: true,
            flex:1,
            align: 'left',
            renderer: me.numberColumnRenderer,
            editor: {
                allowBlank: false
            }
        });

        if(dynamic) {
            columns = columns.concat(me.createDynamicColumns());
        }
        columns = columns.concat(standardColumns);
        return columns;
    },

    /**
     * Creates the grid columns for the dynamic configurator groups.
     *
     * @return [array] An array of column objects.
     */
    createDynamicColumns: function() {
        var me = this, columns = [], column;

        me.configuratorGroupStore.each(function(group) {
            if (group.get('active')) {
                columns.push(
                    {
                        header: group.get('name'),
                        dataIndex: 'configuratorOptions.name',
                        sortable: false,
                        flex: 1,
                        configuratorGroup: group,
                        renderer: me.configuratorGroupColumnRenderer
                    }
                );
            }
        });

        return columns;
    },

    /**
     * Renderer function of the price column. If a scale price defined, the function returns the first price value
     * with an additional flag "from*" to display the user that this variant has scale prices.
     *
     * @param value
     * @param metaData
     * @param record
     */
    priceColumnRenderer: function(value, metaData, record) {
        var me = this,
            prices = record.getPrice();

        if (prices.getCount() === 0) {
            return me.snippets.columns.price.undefined;
        } else {
            var firstPrice = prices.first();
            if (prices.getCount() === 1) {
                return Ext.util.Format.currency(firstPrice.get('price'));
            } else {
                return me.snippets.columns.price.from + ' ' + Ext.util.Format.currency(firstPrice.get('price'));
            }
        }
    },

    /**
     * Renderer function of the pseudoPrice column.
     *
     * @param value
     * @param metaData
     * @param record
     */
    pseudoPriceColumnRenderer: function(value, metaData, record) {
        var me = this,
            prices = record.getPrice();

        if (prices.getCount() === 0 || prices.first().get('pseudoPrice') === 0) {
            return me.snippets.columns.pseudoPrice.undefined;
        }

        var firstPrice = prices.first();
        return Ext.util.Format.currency(firstPrice.get('pseudoPrice'));
    },

    /**
     * Renderer function of the number column.
     *
     * @param value
     * @param metaData
     * @param record
     */
    numberColumnRenderer: function(value, metaData, record) {
        if (record) {
            return record.get('number');
        } else {
            return '';
        }
    },

    /**
     * Renderer function of the stock column.
     *
     * @param value
     * @param metaData
     * @param record
     */
    stockColumnRenderer: function(value, metaData, record) {
        if (record) {
            return record.get('inStock');
        } else {
            return '';
        }
    },

    /**
     * Renderer function for each configurator group column
     */
    configuratorGroupColumnRenderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
        var me = this;
        var column = me.columns[colIndex];
        var options = record.getConfiguratorOptions();

        if (column && options) {
            var configuratorGroup = column.configuratorGroup;
            var currentOption = null;
            options.each(function(option) {
                if (option.get('groupId') === configuratorGroup.get('id')) {
                    currentOption = option;
                    return;
                }
            });
            if (currentOption !== null) {
                return currentOption.get('name');
            }
        }
        return '';
    },

    /**
     * Creates the grid selection model for checkboxes
     *
     * @return [Ext.selection.CheckboxModel] grid selection model
     */
    getGridSelModel:function () {
        return Ext.create('Ext.selection.CellModel');
    },

    /**
     * Creates the grid toolbar with the different buttons.
     *
     * @return [Ext.toolbar.Toolbar] grid toolbar
     */
    getToolbar:function () {
        var me = this;

        // Creates the price button to apply the standard prices of the main article on all variants.
        me.applyDataButton = Ext.create('Ext.button.Button', {
            iconCls:'sprite-money--arrow',
            text: me.snippets.toolbar.data,
            action: 'applyData',
            handler: function() {
                me.fireEvent('applyData');
            }
        });

        // Creates the text field for the order number syntax.
        me.orderNumberField = Ext.create('Ext.form.field.Text', {
            emptyText: me.snippets.toolbar.orderNumber.empty,
            fieldLabel: me.snippets.toolbar.orderNumber.label,
            flex: 1,
            allowBlank: false,
            name: 'numberSyntax'
        });

        // Creates the button to regenerate all order numbers for the article variants.
        me.orderNumberButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-key--arrow',
            text: me.snippets.toolbar.orderNumber.button,
            action: 'generateOrderNumbers',
            handler: function() {
                me.fireEvent('generateOrderNumbers', me.orderNumberField);
            }
        });

        // Creates the search field to filter the listing.
        me.searchField = Ext.create('Ext.form.field.Text', {
            name:'searchfield',
            cls:'searchfield',
            width:170,
            emptyText:me.snippets.toolbar.search,
            enableKeyEvents:true,
            checkChangeBuffer:500,
            listeners: {
                change: function(field, value) {
                    me.fireEvent('searchVariants', value);
                }
            }
        });

        return Ext.create('Ext.toolbar.Toolbar', {
            dock:'top',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items:[
                me.applyDataButton,
                { xtype:'tbspacer', width: 6 },
                { xtype: 'tbseparator' },
                { xtype:'tbspacer', width: 6 },
                me.orderNumberField,
                { xtype:'tbspacer', width: 6 },
                me.orderNumberButton,
                '->',
                me.searchField,
                { xtype:'tbspacer', width:6 }
            ]
        });
    },

    /**
     * Creates the paging toolbar for the grid to allow store paging. The paging toolbar uses the same store as the Grid
     *
     * @return [Ext.toolbar.Paging] The paging toolbar for the customer grid
     */
    getPagingBar:function () {
        var me = this;

        return Ext.create('Ext.toolbar.Paging', {
            store: me.store,
            dock:'bottom',
            displayInfo:true
        });
    },

    /**
     * @param article
     * @param [array] stores
     */
    onStoresLoaded: function(article, stores) {
        var me = this;

        me.customerGroupStore = stores['customerGroups'];
        me.configuratorGroupStore = stores['configuratorGroups'];
        me.reconfigure(me.getStore(), me.getColumns(true));
    }
});
//

<?php }} ?>