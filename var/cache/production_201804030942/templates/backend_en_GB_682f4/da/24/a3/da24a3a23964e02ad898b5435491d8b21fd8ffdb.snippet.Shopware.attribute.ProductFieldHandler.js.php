<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:21
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field_handler\Shopware.attribute.ProductFieldHandler.js" */ ?>
<?php /*%%SmartyHeaderCode:30085acda8e9839df1-81366239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da24a3a23964e02ad898b5435491d8b21fd8ffdb' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field_handler\\Shopware.attribute.ProductFieldHandler.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30085acda8e9839df1-81366239',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e98441c9_74582907',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e98441c9_74582907')) {function content_5acda8e98441c9_74582907($_smarty_tpl) {?>/**
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

Ext.define('Shopware.attribute.ProductFieldHandler', {
    extend: 'Shopware.attribute.MultiSelectionFieldHandler',
    mixins: {
        factory: 'Shopware.attribute.SelectionFactory'
    },

    supports: function(attribute) {
        return (
            (attribute.get('columnType') == 'multi_selection' || attribute.get('columnType') == 'single_selection')
            &&
            (attribute.get('entity') == "Shopware\\Models\\Article\\Article" || attribute.get('entity') == "Shopware\\Models\\Article\\Detail")
        );
    },

    create: function(field, attribute) {
        var me = this;

        if (attribute.get('columnType') == 'single_selection') {
            return me.createSelection(
                field,
                attribute,
                'Shopware.form.field.ProductSingleSelection',
                me.createDynamicSearchStore(attribute)
            );
        }

        return me.createSelection(
            field,
            attribute,
            'Shopware.form.field.ProductGrid',
            me.createDynamicSearchStore(attribute),
            me.createDynamicSearchStore(attribute)
        );
    }
});<?php }} ?>