<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:44
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.ProductFeedGrid.js" */ ?>
<?php /*%%SmartyHeaderCode:174935acd97e40c80a0-82368600%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '154de33fa69506e1c8539d7ca892534f0d2b6dde' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.ProductFeedGrid.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174935acd97e40c80a0-82368600',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e40f5b81_43330536',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e40f5b81_43330536')) {function content_5acd97e40f5b81_43330536($_smarty_tpl) {?>/**
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
 * @category    Shopware
 * @package     Base
 * @subpackage  Attribute
 * @version     $Id$
 * @author      shopware AG
 */

//

Ext.define('Shopware.form.field.ProductFeedGrid', {
    extend: 'Shopware.form.field.Grid',
    alias: 'widget.shopware-form-field-product-feed-grid',
    mixins: ['Shopware.model.Helper'],

    createColumns: function() {
        var me = this;
        var activeColumn = { dataIndex: 'active', width: 30 };
        me.applyBooleanColumnConfig(activeColumn);

        var lastExport = { dataIndex: 'lastExport' };
        me.applyDateColumnConfig(lastExport);

        return [
            me.createSortingColumn(),
            activeColumn,
            { dataIndex: 'fileName' },
            { dataIndex: 'name', flex: 1 },
            { dataIndex: 'countArticles', renderer: me.articleCountRenderer },
            lastExport,
            me.createActionColumn()
        ];
    },

    articleCountRenderer: function(value) {
        return value + ' <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'product_feed/grid/article_count','namespace'=>'backend/attributes/fields')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product_feed/grid/article_count','namespace'=>'backend/attributes/fields'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Articles<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product_feed/grid/article_count','namespace'=>'backend/attributes/fields'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    createSearchField: function() {
        return Ext.create('Shopware.form.field.ProductFeedSingleSelection', this.getComboConfig());
    }
});<?php }} ?>