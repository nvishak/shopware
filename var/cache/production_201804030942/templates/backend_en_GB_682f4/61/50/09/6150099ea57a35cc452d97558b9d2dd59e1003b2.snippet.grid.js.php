<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\view\main\grid.js" */ ?>
<?php /*%%SmartyHeaderCode:109575acda8f09d59f4-09172442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6150099ea57a35cc452d97558b9d2dd59e1003b2' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\view\\main\\grid.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109575acda8f09d59f4-09172442',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f0f286b2_87712485',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f0f286b2_87712485')) {function content_5acda8f0f286b2_87712485($_smarty_tpl) {?>/**
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
 */

//
//
Ext.define('Shopware.apps.ArticleList.view.main.Grid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.multi-edit-main-grid',

    /**
     * Make the grid statefull
     */
    stateful: true,
    /**
     * StateId (used in the cookiename later)
     */
    stateId: 'multiedit-grid',

    /**
     * Variant active column
     */
    detailActiveColumn: null,

    snippets: {
        'Article_id': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_id','default'=>'Article_id','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_id','default'=>'Article_id','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_id','default'=>'Article_id','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_mainDetailId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_mainDetailId','default'=>'Article_mainDetailId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_mainDetailId','default'=>'Article_mainDetailId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Main variant ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_mainDetailId','default'=>'Article_mainDetailId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_supplierId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_supplierId','default'=>'Article_supplierId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_supplierId','default'=>'Article_supplierId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Supplier ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_supplierId','default'=>'Article_supplierId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_taxId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_taxId','default'=>'Article_taxId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_taxId','default'=>'Article_taxId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Tax ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_taxId','default'=>'Article_taxId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_priceGroupId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_priceGroupId','default'=>'Article_priceGroupId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_priceGroupId','default'=>'Article_priceGroupId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Price group ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_priceGroupId','default'=>'Article_priceGroupId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_filterGroupId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_filterGroupId','default'=>'Article_filterGroupId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_filterGroupId','default'=>'Article_filterGroupId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Filter group ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_filterGroupId','default'=>'Article_filterGroupId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_configuratorSetId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_configuratorSetId','default'=>'Article_configuratorSetId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_configuratorSetId','default'=>'Article_configuratorSetId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Configurator set ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_configuratorSetId','default'=>'Article_configuratorSetId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_name': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_name','default'=>'Article_name','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_name','default'=>'Article_name','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_name','default'=>'Article_name','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_description': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_description','default'=>'Article_description','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_description','default'=>'Article_description','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_description','default'=>'Article_description','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_descriptionLong': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_descriptionLong','default'=>'Article_descriptionLong','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_descriptionLong','default'=>'Article_descriptionLong','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Long description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_descriptionLong','default'=>'Article_descriptionLong','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_added': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_added','default'=>'Article_added','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_added','default'=>'Article_added','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Added<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_added','default'=>'Article_added','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_active': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_active','default'=>'Article_active','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_active','default'=>'Article_active','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_active','default'=>'Article_active','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_pseudoSales': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_pseudoSales','default'=>'Article_pseudoSales','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_pseudoSales','default'=>'Article_pseudoSales','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Pseudo sales<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_pseudoSales','default'=>'Article_pseudoSales','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_highlight': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_highlight','default'=>'Article_highlight','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_highlight','default'=>'Article_highlight','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Highlight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_highlight','default'=>'Article_highlight','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_keywords': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_keywords','default'=>'Article_keywords','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_keywords','default'=>'Article_keywords','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Keywords<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_keywords','default'=>'Article_keywords','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_changed': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_changed','default'=>'Article_changed','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_changed','default'=>'Article_changed','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last modified<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_changed','default'=>'Article_changed','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_priceGroupActive': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_priceGroupActive','default'=>'Article_priceGroupActive','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_priceGroupActive','default'=>'Article_priceGroupActive','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Price group active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_priceGroupActive','default'=>'Article_priceGroupActive','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_lastStock': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_lastStock','default'=>'Article_lastStock','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_lastStock','default'=>'Article_lastStock','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_lastStock','default'=>'Article_lastStock','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_crossBundleLook': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_crossBundleLook','default'=>'Article_crossBundleLook','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_crossBundleLook','default'=>'Article_crossBundleLook','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cross bundle look<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_crossBundleLook','default'=>'Article_crossBundleLook','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_notification': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_notification','default'=>'Article_notification','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_notification','default'=>'Article_notification','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Notification<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_notification','default'=>'Article_notification','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_template': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_template','default'=>'Article_template','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_template','default'=>'Article_template','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_template','default'=>'Article_template','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_mode': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_mode','default'=>'Article_mode','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_mode','default'=>'Article_mode','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Mode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_mode','default'=>'Article_mode','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_availableFrom': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_availableFrom','default'=>'Article_availableFrom','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_availableFrom','default'=>'Article_availableFrom','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Available from<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_availableFrom','default'=>'Article_availableFrom','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Article_availableTo': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Article_availableTo','default'=>'Article_availableTo','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_availableTo','default'=>'Article_availableTo','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Available until<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Article_availableTo','default'=>'Article_availableTo','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_id': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_id','default'=>'Detail_id','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_id','default'=>'Detail_id','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_id','default'=>'Detail_id','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_articleId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_articleId','default'=>'Detail_articleId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_articleId','default'=>'Detail_articleId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_articleId','default'=>'Detail_articleId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_unitId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_unitId','default'=>'Detail_unitId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_unitId','default'=>'Detail_unitId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Unit ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_unitId','default'=>'Detail_unitId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_number': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_number','default'=>'Detail_number','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_number','default'=>'Detail_number','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_number','default'=>'Detail_number','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_supplierNumber': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_supplierNumber','default'=>'Detail_supplierNumber','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_supplierNumber','default'=>'Detail_supplierNumber','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Supplier number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_supplierNumber','default'=>'Detail_supplierNumber','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_kind': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_kind','default'=>'Detail_kind','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_kind','default'=>'Detail_kind','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Kind<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_kind','default'=>'Detail_kind','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_additionalText': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_additionalText','default'=>'Detail_additionalText','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_additionalText','default'=>'Detail_additionalText','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Additional text<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_additionalText','default'=>'Detail_additionalText','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_active': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_active','default'=>'Detail_active','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_active','default'=>'Detail_active','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Variant active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_active','default'=>'Detail_active','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_inStock': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_inStock','default'=>'Detail_inStock','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_inStock','default'=>'Detail_inStock','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
In stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_inStock','default'=>'Detail_inStock','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_stockMin': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_stockMin','default'=>'Detail_stockMin','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_stockMin','default'=>'Detail_stockMin','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Minimum stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_stockMin','default'=>'Detail_stockMin','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_weight': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_weight','default'=>'Detail_weight','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_weight','default'=>'Detail_weight','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_weight','default'=>'Detail_weight','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_width': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_width','default'=>'Detail_width','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_width','default'=>'Detail_width','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Width<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_width','default'=>'Detail_width','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_len': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_len','default'=>'Detail_len','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_len','default'=>'Detail_len','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Length<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_len','default'=>'Detail_len','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_height': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_height','default'=>'Detail_height','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_height','default'=>'Detail_height','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Height<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_height','default'=>'Detail_height','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_ean': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_ean','default'=>'Detail_ean','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_ean','default'=>'Detail_ean','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EAN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_ean','default'=>'Detail_ean','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_position': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_position','default'=>'Detail_position','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_position','default'=>'Detail_position','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Position<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_position','default'=>'Detail_position','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_minPurchase': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_minPurchase','default'=>'Detail_minPurchase','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_minPurchase','default'=>'Detail_minPurchase','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Minimum purchase<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_minPurchase','default'=>'Detail_minPurchase','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_purchaseSteps': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_purchaseSteps','default'=>'Detail_purchaseSteps','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_purchaseSteps','default'=>'Detail_purchaseSteps','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Purchase steps<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_purchaseSteps','default'=>'Detail_purchaseSteps','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_maxPurchase': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_maxPurchase','default'=>'Detail_maxPurchase','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_maxPurchase','default'=>'Detail_maxPurchase','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Maximum purchase<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_maxPurchase','default'=>'Detail_maxPurchase','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_purchaseUnit': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_purchaseUnit','default'=>'Detail_purchaseUnit','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_purchaseUnit','default'=>'Detail_purchaseUnit','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Purchase unit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_purchaseUnit','default'=>'Detail_purchaseUnit','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_referenceUnit': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_referenceUnit','default'=>'Detail_referenceUnit','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_referenceUnit','default'=>'Detail_referenceUnit','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Reference unit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_referenceUnit','default'=>'Detail_referenceUnit','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_packUnit': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_packUnit','default'=>'Detail_packUnit','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_packUnit','default'=>'Detail_packUnit','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Pack unit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_packUnit','default'=>'Detail_packUnit','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_shippingFree': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_shippingFree','default'=>'Detail_shippingFree','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_shippingFree','default'=>'Detail_shippingFree','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free shipping<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_shippingFree','default'=>'Detail_shippingFree','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_releaseDate': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_releaseDate','default'=>'Detail_releaseDate','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_releaseDate','default'=>'Detail_releaseDate','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Release date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_releaseDate','default'=>'Detail_releaseDate','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Detail_shippingTime': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Detail_shippingTime','default'=>'Detail_shippingTime','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_shippingTime','default'=>'Detail_shippingTime','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shipping time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Detail_shippingTime','default'=>'Detail_shippingTime','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_id': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_id','default'=>'Attribute_id','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_id','default'=>'Attribute_id','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_id','default'=>'Attribute_id','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_articleId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_articleId','default'=>'Attribute_articleId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_articleId','default'=>'Attribute_articleId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_articleId','default'=>'Attribute_articleId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_articleDetailId': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_articleDetailId','default'=>'Attribute_articleDetailId','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_articleDetailId','default'=>'Attribute_articleDetailId','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product detail ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_articleDetailId','default'=>'Attribute_articleDetailId','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr1': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr1','default'=>'Attribute_attr1','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr1','default'=>'Attribute_attr1','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr1','default'=>'Attribute_attr1','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr2': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr2','default'=>'Attribute_attr2','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr2','default'=>'Attribute_attr2','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr2','default'=>'Attribute_attr2','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr3': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr3','default'=>'Attribute_attr3','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr3','default'=>'Attribute_attr3','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 3<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr3','default'=>'Attribute_attr3','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr4': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr4','default'=>'Attribute_attr4','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr4','default'=>'Attribute_attr4','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 4<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr4','default'=>'Attribute_attr4','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr5': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr5','default'=>'Attribute_attr5','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr5','default'=>'Attribute_attr5','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 5<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr5','default'=>'Attribute_attr5','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr6': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr6','default'=>'Attribute_attr6','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr6','default'=>'Attribute_attr6','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 6<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr6','default'=>'Attribute_attr6','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr7': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr7','default'=>'Attribute_attr7','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr7','default'=>'Attribute_attr7','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 7<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr7','default'=>'Attribute_attr7','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr8': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr8','default'=>'Attribute_attr8','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr8','default'=>'Attribute_attr8','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 8<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr8','default'=>'Attribute_attr8','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr9': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr9','default'=>'Attribute_attr9','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr9','default'=>'Attribute_attr9','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 9<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr9','default'=>'Attribute_attr9','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr10': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr10','default'=>'Attribute_attr10','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr10','default'=>'Attribute_attr10','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 10<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr10','default'=>'Attribute_attr10','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr11': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr11','default'=>'Attribute_attr11','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr11','default'=>'Attribute_attr11','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 11<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr11','default'=>'Attribute_attr11','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr12': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr12','default'=>'Attribute_attr12','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr12','default'=>'Attribute_attr12','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 12<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr12','default'=>'Attribute_attr12','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr13': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr13','default'=>'Attribute_attr13','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr13','default'=>'Attribute_attr13','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 13<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr13','default'=>'Attribute_attr13','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr14': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr14','default'=>'Attribute_attr14','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr14','default'=>'Attribute_attr14','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 14<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr14','default'=>'Attribute_attr14','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr15': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr15','default'=>'Attribute_attr15','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr15','default'=>'Attribute_attr15','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 15<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr15','default'=>'Attribute_attr15','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr16': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr16','default'=>'Attribute_attr16','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr16','default'=>'Attribute_attr16','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 16<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr16','default'=>'Attribute_attr16','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr17': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr17','default'=>'Attribute_attr17','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr17','default'=>'Attribute_attr17','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 17<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr17','default'=>'Attribute_attr17','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr18': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr18','default'=>'Attribute_attr18','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr18','default'=>'Attribute_attr18','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 18<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr18','default'=>'Attribute_attr18','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr19': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr19','default'=>'Attribute_attr19','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr19','default'=>'Attribute_attr19','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 19<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr19','default'=>'Attribute_attr19','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Attribute_attr20': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Attribute_attr20','default'=>'Attribute_attr20','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr20','default'=>'Attribute_attr20','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Attribute 20<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Attribute_attr20','default'=>'Attribute_attr20','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Price_price': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Price_price','default'=>'Price_price','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Price_price','default'=>'Price_price','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Gross price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Price_price','default'=>'Price_price','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Price_netPrice': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Price_netPrice','default'=>'Price_netPrice','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Price_netPrice','default'=>'Price_netPrice','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Net price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Price_netPrice','default'=>'Price_netPrice','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Supplier_name': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Supplier_name','default'=>'Supplier','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Supplier_name','default'=>'Supplier','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Supplier<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Supplier_name','default'=>'Supplier','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'Tax_name': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'columns'/'product'/'Tax_name','default'=>'Tax','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Tax_name','default'=>'Tax','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Tax<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'columns'/'product'/'Tax_name','default'=>'Tax','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Setup the component
     */
    initComponent: function () {
        var me = this;

        this.setupStateManager();

        me.columns = me.getColumns();

        me.tbar = me.getToolbar();
        me.bbar = me.getPagingbar();
        me.selModel = me.getGridSelModel();

        me.addEvents(
                /**
                 * Fired when the user edited a product in the grid
                 */
                'saveProduct',

                /**
                 * Delete a single article
                 */
                'deleteProduct',

                /**
                 * Delete multiple articles
                 */
                'deleteMultipleProducts',

                /**
                 * Trigger the split view
                 */
                'triggerSplitView',

                /**
                 * Triggered when the product selection changes
                 */
                'productchange',

                /**
                 * A search was triggered
                 */
                'search'
        );

        me.rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToEdit: 2,
            autoCancel: true,
            listeners: {
                scope: me,
                edit: function (editor, context) {
                    me.fireEvent('saveProduct', editor, context)
                }
            }
        });
        me.plugins = me.rowEditing;

        me.listeners = {
            'afterrender': me.onAfterRender
        };

        me.callParent(arguments);
    },

    onAfterRender: function() {
        var me = this;
        Ext.each(me.columns, function(col) {
            if (col.dataIndex == 'Detail_active') {
                me.detailActiveColumn = col;
                window.setTimeout(function() { col.setVisible(false); }, 0);
            }
        });
    },

    setupStateManager: function () {
        var me = this;
        me.stateManager = new Ext.state.LocalStorageProvider({ });

        Ext.state.Manager.setProvider(me.stateManager);
    },

    /**
     * Creates rowEditor Plugin
     *
     * @return [Ext.grid.plugin.RowEditing]
     */
    getRowEditorPlugin: function () {
        return Ext.create('Ext.grid.plugin.RowEditing', {
            clicksToEdit: 2,
            errorSummary: false,
            pluginId: 'rowEditing'
        });
    },

    /**
     * Creates the grid selection model for checkboxes
     *
     * @return [Ext.selection.CheckboxModel] grid selection model
     */
    getGridSelModel: function () {
        var me = this;

        return Ext.create('Ext.selection.CheckboxModel', {
            listeners: {
                // Unlocks the delete button if the user has checked at least one checkbox
                selectionchange: function (sm, selections) {
                    me.deleteButton.setDisabled(selections.length === 0);
                    me.splitViewModeBtn.setDisabled(selections.length === 0);
                    me.fireEvent('productchange', selections);
                }
            }
        });
    },

    getActionColumn: function () {
        var me = this;


        return {
            xtype: 'actioncolumn',
            width: 60,
            items: [
                /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'article','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>*/
                {
                    action: 'edit',
                    cls: 'editBtn',
                    iconCls: 'sprite-pencil',
                    handler: function (view, rowIndex, colIndex, item, opts, record) {
                        Shopware.app.Application.addSubApplication({
                            name: 'Shopware.apps.Article',
                            action: 'detail',
                            params: {
                                articleId: record.get('Article_id')
                            }
                        });
                    }
                },
                /*<?php }?>*/
                /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'article','privilege'=>'delete'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?>*/
                {
                    iconCls: 'sprite-minus-circle-frame',
                    action: 'delete',
                    handler: function (view, rowIndex, colIndex, item, opts, record) {
                        me.fireEvent('deleteProduct', record);
                    }
                }
                /*<?php }?>*/
            ]
        };
    },

    /**
     * Helper method which creates the columns for the
     * grid panel in this widget.
     *
     * @return [array] generated columns
     */
    getColumns: function () {
        var me = this,
                colLength,
                i,
                column,
                stateColumn,
                columnDefinition,
                width,
                xtype,
                renderer,
                columns = [ ];

        colLength = me.columnConfig.length;
        for (i = 0; i < colLength; i++) {
            column = me.columnConfig[i];

            if (!column.allowInGrid) {
                continue;
            }

            columnDefinition = {
                dataIndex: column.alias,
                header: me.getTranslationForColumnHead(column.alias),
                /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'article','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3){?>*/
                editor: me.getEditorForColumn(column),
                /*<?php }?>*/
                hidden: !column.show
            };

            if (xtype = me.getXtypeForColumn(column)) {
                columnDefinition.xtype = xtype;
            }

            if (renderer = me.getRendererForColumn(column)) {
                columnDefinition.renderer = renderer;
            }


            if (width = me.getWidthForColumn(column)) {
                columnDefinition.width = width;
            } else {
                columnDefinition.flex = 1;
            }

            if (column.alias == 'Detail_active') {
                columnDefinition.hidden = true;
            }

            columns.push(columnDefinition);
        }

        columns.push({
            header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list'/'column_info','default'=>'Info','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'column_info','default'=>'Info','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'column_info','default'=>'Info','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            width: 90,
            renderer: me.infoColumnRenderer
        });

        columns.push(me.getActionColumn());

        return columns;
    },

    /**
     * Returns a proper xtype fo a column
     *
     * @param column
     * @returns *
     */
    getXtypeForColumn: function (column) {
        var me = this;

        if (column.alias == 'Price_price') {
            return 'numbercolumn';
        }

        return undefined;
    },

    /**
     * Column renderer for columns shown in <b>tags</b>
     *
     * @param value
     * @returns string
     */
    boldColumnRenderer: function (value, metaData, record) {
        var result = value;
        var checkbox = this.up('window').down('checkbox[name=displayVariants]');

        var additional = record.get('Detail_additionalText');
        if (!additional) {
            additional = record.get('Detail_additionalText_dynamic');
        }

        if (checkbox.getValue() && additional) {
            result = value + ' - ' + additional;
        }
        return '<b>' + this.defaultColumnRenderer(result) + '</b>';
    },

    /**
     * Column renderer for most of the columns
     *
     * @param value
     * @returns string
     */
    defaultColumnRenderer: function (value) {
        return value;
    },

    /**
     * Column renderer for boolean columns in order to
     * @param value
     */
    booleanColumnRenderer: function (value) {
        var checked = 'sprite-ui-check-box-uncheck';
        if (value == true) {
            checked = 'sprite-ui-check-box';
        }
        return '<span style="display:block; margin: 0 auto; height:25px; width:25px;" class="' + checked + '"></span>';
    },

    /**
     *
     * Show info like: Is this a configurator article / does it have images /
     * does it have a category
     *
     * @param value
     * @param metaData
     * @param record
     * @returns string
     */
    infoColumnRenderer: function (value, metaData, record) {
        var me = this,
                result = '',
                title;

        var style = 'style="width: 25px; height: 25px; display: inline-block; margin-right: 3px;"';

        if (!record.get('imageSrc')) {
            title = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list'/'tooltip_noimage','default'=>'Article has no image','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'tooltip_noimage','default'=>'Article has no image','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Article has no image<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'tooltip_noimage','default'=>'Article has no image','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
            result = result + '<div  title="' + title + '" class="sprite-image--exclamation" ' + style + '>&nbsp;</div>';
        }

        if (record.get('hasConfigurator')) {
            title = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list'/'tooltip_hasconfigurator','default'=>'Article has configurator','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'tooltip_hasconfigurator','default'=>'Article has configurator','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Article has configurator<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'tooltip_hasconfigurator','default'=>'Article has configurator','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
            result = result + '<div  title="' + title + '" class="sprite-images-stack" ' + style + '>&nbsp;</div>';
        }

        if (!record.get('hasCategories')) {
            title = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list'/'tooltip_categories','default'=>'Article is not assigned to any category','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'tooltip_categories','default'=>'Article is not assigned to any category','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Article is not assigned to any category<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'tooltip_categories','default'=>'Article is not assigned to any category','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
            result = result + '<div title="' + title + '" class="sprite-blue-folder--exclamation" ' + style + '>&nbsp;</div>';
        }

        return result;
    },

    /**
     * Will return a renderer depending on the passed column.
     * todo: Article_name should not be hardcoded here
     *
     * @param column
     * @returns string|function
     */
    getRendererForColumn: function (column) {
        var me = this;

        if (column.alias == 'Article_name') {
            return me.boldColumnRenderer;
        }

        if (column.type == 'boolean') {
            return me.booleanColumnRenderer;
        }

        if (column.alias == 'Detail_inStock') {
            return me.colorColumnRenderer;
        }

        if (column.alias == 'Price_price') {
            return undefined;
        }

        return me.defaultColumnRenderer;
    },

    /**
     * Will return a green string for values > 0 and red otherwise
     *
     * @param value
     * @returns string
     */
    colorColumnRenderer: function (value) {
        value = value || 0;
        if (value > 0) {
            return '<span style="color:green;">' + value + '</span>';
        } else {
            return '<span style="color:red;">' + value + '</span>';
        }
    },

    /**
     * Helper method which returns a "human readable" translation for a columnAlias
     * Will return the columnAlias, if no translation was created
     *
     * @param columnHeader
     * @returns string
     */
    getTranslationForColumnHead: function (columnHeader) {
        var me = this;

        if (me.snippets.hasOwnProperty(columnHeader)) {
            return me.snippets[columnHeader];
        }
        return columnHeader;
    },

    /**
     * Return width for a given column
     *
     * For known fields like boolean, integer, date and datetime, we can try and
     * educated guess, for anything else undefined is returned.
     *
     * @param column
     */
    getWidthForColumn: function (column) {
        var me = this;

        if (column.alias.slice(-2).toLowerCase() == 'id') {
            return 60;
        }

        switch (column.alias) {
            case 'Price_price':
                return 90;
            case 'Detail_number':
                return 110;
            case 'Supplier_name':
                return 110;
            case 'Article_active':
            case 'Detail_active':
                return 40;
            case 'Tax_name':
                return 75;
            case 'Detail_inStock':
                return 80;
        }

        switch (column.type) {
            case 'integer':
            case 'decimal':
            case 'float':
                return 60;
            case 'string':
            case 'text':
                return undefined;
            case 'boolean':
                return 60;
            case 'date':
                return 100;
            case 'datetime':
                return 140;
            default:
                return undefined;
        }
    },

    /**
     * Helper method which returns a rowEditing.editor for a given column.
     *
     * @param column
     * @returns Object|boolean
     */
    getEditorForColumn: function (column) {
        var me = this;

        // Do create editor for columns, which have been configured to be non-editable
        if (!column.editable) {
            return false;
        }

        switch (column.alias) {
            case 'Price_price':
                return {
                    width: 85,
                    xtype: 'numberfield',
                    allowBlank: false,
                    hideTrigger: true,
                    keyNavEnabled: false,
                    mouseWheelEnabled: false
                };
            default:
                switch (column.type) {
                    case 'integer':
                    case 'decimal':
                    case 'float':
                        var precision = 0;
                        if (column.precision) {
                            precision = column.precision
                        } else if (column.type == 'float') {
                            precision = 3;
                        } else if (column.type == 'decimal') {
                            precision = 3;
                        }
                        return { xtype: 'numberfield', decimalPrecision: precision };
                        break;
                    case 'string':
                    case 'text':
                        return 'textfield';
                        break;
                    case 'boolean':
                        return {
                            xtype: 'checkbox',
                            inputValue: 1,
                            uncheckedValue: 0
                        };
                        break;
                    case 'date':
                        return new Ext.form.DateField({
                            disabled: false,
                            format: 'Y-m-d'
                        });
                        break;
                    case 'datetime':
                        return new Ext.form.DateField({
                            disabled: false,
                            format: 'Y-m-d H:i:s'
                        });
                        return new Shopware.apps.Base.view.element.DateTime({
                            timeCfg: { format: 'H:i:s' },
                            dateCfg: { format: 'Y-m-d' }
                        });
                        break;
                    default:
                        break;
                }
                break;
        }
    },


    /**
     * Creates the grid toolbar
     *
     * @return [Ext.toolbar.Toolbar] grid toolbar
     */
    getToolbar: function () {
        var me = this, buttons = [];

        me.splitViewModeBtn = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-ui-split-panel',
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'enableSplitView','default'=>'Activate split view','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'enableSplitView','default'=>'Activate split view','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Activate split view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'enableSplitView','default'=>'Activate split view','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            disabled: true,
            enableToggle: true,
            handler: function () {
                var selectionModel = me.getSelectionModel(),
                        record = selectionModel.getSelection()[0];

                me.fireEvent('triggerSplitView', this, record);
            }
        });

        buttons.push(me.splitViewModeBtn);

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'article','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4){?>*/
        buttons.push(
                Ext.create('Ext.button.Button', {
                    text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addProduct','default'=>'Add','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addProduct','default'=>'Add','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addProduct','default'=>'Add','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    iconCls: 'sprite-plus-circle-frame',
                    handler: function () {
                        Shopware.app.Application.addSubApplication({
                            name: 'Shopware.apps.Article',
                            action: 'detail'
                        });
                    }
                })
        );
        /*<?php }?>*/

        //creates the delete button to remove all selected esds in one request.
        me.deleteButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-minus-circle-frame',
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'deleteProduct','default'=>'Delete','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'deleteProduct','default'=>'Delete','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'deleteProduct','default'=>'Delete','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            disabled: true,
            handler: function () {
                var selectionModel = me.getSelectionModel(),
                        records = selectionModel.getSelection();

                if (records.length > 0) {
                    me.fireEvent('deleteMultipleProducts', records);
                }
            }
        });

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'article','privilege'=>'delete'),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php if ($_tmp5){?>*/
        buttons.push(me.deleteButton);
        /*<?php }?>*/

        buttons.push('->');


        buttons.push({
            xtype: 'textfield',
            name: 'searchfield',
            action: 'search',
            width: 170,
            cls: 'searchfield',
            enableKeyEvents: true,
            checkChangeBuffer: 500,
            emptyText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list'/'emptytext_search','default'=>'Search ...','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'emptytext_search','default'=>'Search ...','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Search ...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list'/'emptytext_search','default'=>'Search ...','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            listeners: {
                'change': function (field, value) {
                    var store = me.store,
                            searchString = Ext.String.trim(value);

                    me.fireEvent('search', searchString);
                }
            }
        });

        return Ext.create('Ext.toolbar.Toolbar', {
            ui: 'shopware-ui',
            items: buttons
        });
    },

    /**
     * Creates pagingbar
     *
     * @return Ext.toolbar.Paging
     */
    getPagingbar: function () {
        var me = this,
                productSnippet = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'pagingCombo'/'products','default'=>'products','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'pagingCombo'/'products','default'=>'products','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
products<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'pagingCombo'/'products','default'=>'products','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';

        var pageSize = Ext.create('Ext.form.field.ComboBox', {
            labelWidth: 120,
            cls: Ext.baseCSSPrefix + 'page-size',
            queryMode: 'local',
            width: 180,
            editable: false,
            listeners: {
                scope: me,
                select: me.onPageSizeChange
            },
            store: Ext.create('Ext.data.Store', {
                fields: [ 'value', 'name' ],
                data: [
                    { value: '25', name: '25 ' + productSnippet },
                    { value: '50', name: '50 ' + productSnippet },
                    { value: '75', name: '75 ' + productSnippet }
                ]
            }),
            displayField: 'name',
            valueField: 'value'
        });

        var pagingBar = Ext.create('Ext.toolbar.Paging', {
            dock: 'bottom',
            displayInfo: true
        });

        pagingBar.insert(pagingBar.items.length - 2, [
            { xtype: 'tbspacer', width: 6 },
            pageSize
        ]);
        return pagingBar;
    },

    /**
     * Event listener method which fires when the user selects
     * a entry in the "number of orders"-combo box.
     *
     * @event select
     * @param [object] combo - Ext.form.field.ComboBox
     * @param [array] records - Array of selected entries
     * @return void
     */
    onPageSizeChange: function (combo, records) {
        var record = records[0],
                me = this;

        me.store.pageSize = record.get('value');
        if (!me.store.getProxy().extraParams.ast) {
            return;
        }

        me.store.loadPage(1);
    }
});
//
<?php }} ?>