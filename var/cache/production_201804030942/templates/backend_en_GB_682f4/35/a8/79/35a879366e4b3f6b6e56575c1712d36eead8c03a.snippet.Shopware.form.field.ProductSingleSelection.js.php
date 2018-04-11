<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:20
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.ProductSingleSelection.js" */ ?>
<?php /*%%SmartyHeaderCode:30155acda8e84f1411-52021071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35a879366e4b3f6b6e56575c1712d36eead8c03a' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.ProductSingleSelection.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30155acda8e84f1411-52021071',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e851a2c6_74702028',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e851a2c6_74702028')) {function content_5acda8e851a2c6_74702028($_smarty_tpl) {?>/**
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

Ext.define('Shopware.form.field.ProductSingleSelection', {
    extend: 'Shopware.form.field.SingleSelection',
    alias: 'widget.shopware-form-field-product-single-selection',

    getComboConfig: function() {
        var me = this;
        var config = me.callParent(arguments);
        config.valueField = 'number';

        config.tpl = Ext.create('Ext.XTemplate',
            '<tpl for=".">',
                '<div class="x-boundlist-item">' +
                    //active renderer
                    '<tpl if="articleActive && variantActive">' +
                        '[<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'active_single_selection','namespace'=>'backend/attributes/fields')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'active_single_selection','namespace'=>'backend/attributes/fields'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'active_single_selection','namespace'=>'backend/attributes/fields'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
]' +
                    '<tpl else>' +
                        '[<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'inactive_single_selection','namespace'=>'backend/attributes/fields')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'inactive_single_selection','namespace'=>'backend/attributes/fields'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
inactive<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'inactive_single_selection','namespace'=>'backend/attributes/fields'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
]' +
                    '</tpl>' +

                    //number + data renderer
                    ' <b>{number}</b> - {name}' +

                    //additional text renderer
                    '<tpl if="additionalText">' +
                        '<i> ({additionalText})</i>' +
                    '</tpl>',
                '</div>',
            '</tpl>'
        );
        config.displayTpl = Ext.create('Ext.XTemplate',
            '<tpl for=".">',
                //active renderer
                '<tpl if="articleActive && variantActive">' +
                    '[<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'active_single_selection','namespace'=>'backend/attributes/fields')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'active_single_selection','namespace'=>'backend/attributes/fields'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'active_single_selection','namespace'=>'backend/attributes/fields'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
]' +
                '<tpl else>' +
                    '[<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'inactive_single_selection','namespace'=>'backend/attributes/fields')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'inactive_single_selection','namespace'=>'backend/attributes/fields'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
inactive<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'inactive_single_selection','namespace'=>'backend/attributes/fields'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
]' +
                '</tpl>' +

                //number + data renderer
                ' {number} - {name}' +

                //additional text renderer
                '<tpl if="additionalText">' +
                    ' ({additionalText})' +
                '</tpl>',
            '</tpl>'
        );
        return config;
    }
});<?php }} ?>