<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\view\condition_list\field\attribute.js" */ ?>
<?php /*%%SmartyHeaderCode:42445acda8f1f0ecc2-28139440%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee6cf351ea5e016b176ccf15be228ee3ef294f50' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\view\\condition_list\\field\\attribute.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '42445acda8f1f0ecc2-28139440',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f20971e2_88047092',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f20971e2_88047092')) {function content_5acda8f20971e2_88047092($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.ProductStream.view.condition_list.field.Attribute', {

    extend: 'Ext.form.FieldContainer',
    layout: { type: 'vbox', align: 'stretch' },
    mixins: [ 'Ext.form.field.Base' ],
    height: 70,
    value: undefined,
    attributeField: null,

    initComponent: function() {
        var me = this;
        me.items = me.createItems();
        me.callParent(arguments);
    },

    createItems: function() {
        var me = this;

        return [
            me.createOperatorSelection(),
            me.createValueField(),
            me.createBetweenContainer()
        ];
    },

    createBetweenContainer: function() {
        var me = this;

        me.betweenContainer = Ext.create('Ext.container.Container', {
            layout: { type: 'hbox', align: 'stretch' },
            hidden: true,
            items: [ me.createFromField(), me.createToField() ]
        });
        return me.betweenContainer;
    },

    createFromField: function() {
        var me = this;

        me.fromField = Ext.create('Ext.form.field.Number', {
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute'/'from_text','default'=>'From','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute'/'from_text','default'=>'From','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute'/'from_text','default'=>'From','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            flex: 1,
            listeners: {
                change: function() {
                    me.toField.setMinValue(me.fromField.getValue() -1);
                }
            }
        });
        return me.fromField;
    },

    createToField: function() {
        var me = this;

        me.toField = Ext.create('Ext.form.field.Number', {
            labelWidth: 50,
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute'/'to_text','default'=>'to','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute'/'to_text','default'=>'to','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
to<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute'/'to_text','default'=>'to','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            padding: '0 0 0 10',
            flex: 1,
            listeners: {
                change: function() {
                    me.fromField.setMaxValue(me.toField.getValue() + 1);
                }
            }
        });
        return me.toField;
    },

    createOperatorSelection: function () {
        var me = this;

        var store = Ext.create('Ext.data.Store', {
            fields: [ 'name', 'value' ],
            data: [
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'equals','default'=>'equals','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'equals','default'=>'equals','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
equals<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'equals','default'=>'equals','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: '=' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'not_equals','default'=>'not equals','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'not_equals','default'=>'not equals','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
does not equal<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'not_equals','default'=>'not equals','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: '!=' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'less_than','default'=>'less than','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'less_than','default'=>'less than','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
less than<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'less_than','default'=>'less than','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: '<' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'less_than_equals','default'=>'less than equals','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'less_than_equals','default'=>'less than equals','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
less than or equal to<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'less_than_equals','default'=>'less than equals','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: '<=' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'between','default'=>'between','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'between','default'=>'between','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
between<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'between','default'=>'between','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: 'BETWEEN' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'greater_than','default'=>'greater than','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'greater_than','default'=>'greater than','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
greater than<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'greater_than','default'=>'greater than','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: '>' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'greater_than_equals','default'=>'greater than equals','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'greater_than_equals','default'=>'greater than equals','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
greater than or equal to<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'greater_than_equals','default'=>'greater than equals','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: '>=' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'in','default'=>'in','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'in','default'=>'in','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
in<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'in','default'=>'in','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: 'IN' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'starts_with','default'=>'starts with','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'starts_with','default'=>'starts with','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
starts with<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'starts_with','default'=>'starts with','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: 'STARTS_WITH' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'ends_with','default'=>'ends with','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'ends_with','default'=>'ends with','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ends with<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'ends_with','default'=>'ends with','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: 'ENDS_WITH' },
                { name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_condition'/'like','default'=>'like','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'like','default'=>'like','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
like<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_condition'/'like','default'=>'like','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', value: 'CONTAINS' }
            ]
        });

        me.operatorSelection = Ext.create('Ext.form.field.ComboBox', {
            store: store,
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'operator','default'=>'Operator','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'operator','default'=>'Operator','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Operator<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'operator','default'=>'Operator','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            displayField: 'name',
            valueField: 'value',
            allowBlank: false,
            listeners: {
                change: function(field, value) {
                    if (value == 'BETWEEN') {
                        me.betweenContainer.show();
                        me.valueField.hide();
                    } else {
                        me.betweenContainer.hide();
                        me.valueField.show();
                    }
                }
            }
        });

        return me.operatorSelection;
    },

    createValueField: function () {
        var me = this;

        me.valueField = Ext.create('Ext.form.field.Text', {
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'value','default'=>'Value','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'value','default'=>'Value','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'value','default'=>'Value','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        });

        return me.valueField;
    },

    getValue: function() {
        return this.value;
    },

    setValue: function(value) {
        var me = this;

        me.value = value;
        if (Ext.isObject(value)) {
            me.attributeField = value.field;

            me.operatorSelection.setValue(value.operator);

            if (value.operator == 'BETWEEN') {
                me.fromField.setValue(value.value.min);
                me.toField.setValue(value.value.max);
            } else {
                me.valueField.setValue(value.value);
            }
        }
    },

    getSubmitData: function() {
        var value = {
            field: this.attributeField,
            operator: this.operatorSelection.getValue(),
            value: this.valueField.getValue()
        };

        if (value.operator == 'BETWEEN') {
            value.value = {
                min: this.fromField.getValue(),
                max: this.toField.getValue()
            }
        } else if (value.operator == 'IN') {
            value.value = value.value.split(",");
        }

        var result = {};
        result[this.name] = value;
        return result;
    }
});
//<?php }} ?>