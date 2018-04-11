<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\view\condition_list\condition\manufacturer.js" */ ?>
<?php /*%%SmartyHeaderCode:83975acda8f13245c4-77043997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bfbdaa1628c562cba9326c71672cf1374a6717e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\view\\condition_list\\condition\\manufacturer.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83975acda8f13245c4-77043997',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f1352c97_42113802',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f1352c97_42113802')) {function content_5acda8f1352c97_42113802($_smarty_tpl) {?>/**
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
 * @package    ProductStream
 * @subpackage Window
 * @version    $Id$
 * @author shopware AG
 */
//
//
Ext.define('Shopware.apps.ProductStream.view.condition_list.condition.Manufacturer', {
    extend: 'ProductStream.filter.AbstractCondition',

    getName: function() {
        return 'Shopware\\Bundle\\SearchBundle\\Condition\\ManufacturerCondition';
    },

    getLabel: function() {
        return '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'manufacturer_condition','default'=>'Manufacturer condition','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'manufacturer_condition','default'=>'Manufacturer condition','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Manufacturer condition<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'manufacturer_condition','default'=>'Manufacturer condition','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
    },

    isSingleton: function() {
        return true;
    },

    create: function(callback) {
        var field = this.createSelection();
        callback(field);
    },

    load: function(key, value) {
        if (key !== this.getName()) {
            return null;
        }
        var field = this.createSelection();
        field.setValue(value);
        return field;
    },

    createStore: function() {
        return Ext.create('Shopware.store.Search', {
            model: 'Shopware.apps.Base.model.Supplier',
            pageSize: 10,
            configure: function() {
                return { entity: "Shopware\\Models\\Article\\Supplier" }
            }
        });
    },

    createSelection: function() {
        return Ext.create('Shopware.apps.ProductStream.view.condition_list.field.Grid', {
            name: 'condition.' + this.getName(),
            searchStore: this.createStore(),
            idsName: 'manufacturerIds',
            store: this.createStore(),
            getErrorMessage: function() {
                return 'No manufacturer selected';
            }
        });
    }
});
//<?php }} ?>