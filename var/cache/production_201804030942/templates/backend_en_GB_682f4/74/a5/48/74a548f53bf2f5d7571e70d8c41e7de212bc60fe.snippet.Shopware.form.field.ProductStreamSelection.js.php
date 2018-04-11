<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:21
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\Shopware.form.field.ProductStreamSelection.js" */ ?>
<?php /*%%SmartyHeaderCode:241485acda8e96afc13-39287346%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74a548f53bf2f5d7571e70d8c41e7de212bc60fe' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\Shopware.form.field.ProductStreamSelection.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '241485acda8e96afc13-39287346',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e96d6209_55500627',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e96d6209_55500627')) {function content_5acda8e96d6209_55500627($_smarty_tpl) {?>/**
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
 * @package    Base
 * @subpackage Component
 * @version    $Id$
 * @author shopware AG
 */

//
Ext.define('Shopware.form.field.ProductStreamSelection', {

    extend: 'Shopware.form.field.SingleSelection',

    alias: ['widget.productstreamselection', 'widget.streamselect'],

    name: 'stream_selection',

    valueField: 'id',

    displayField: 'name',

    labelWidth: 155,

    /**
     * Snippets for the field.
     *
     * @object
     */
    snippets: {
        fields: {
            streamFieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'streamFieldLabel','default'=>'Product stream','namespace'=>'backend/base/component/Shopware.form.field.ProductStreamSelection')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'streamFieldLabel','default'=>'Product stream','namespace'=>'backend/base/component/Shopware.form.field.ProductStreamSelection'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'streamFieldLabel','default'=>'Product stream','namespace'=>'backend/base/component/Shopware.form.field.ProductStreamSelection'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            streamFieldEmptyText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'streamFieldEmptyText','default'=>'Please select ...','namespace'=>'backend/base/component/Shopware.form.field.ProductStreamSelection')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'streamFieldEmptyText','default'=>'Please select ...','namespace'=>'backend/base/component/Shopware.form.field.ProductStreamSelection'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please select ...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'streamFieldEmptyText','default'=>'Please select ...','namespace'=>'backend/base/component/Shopware.form.field.ProductStreamSelection'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Initialize the component.
     *
     * @public
     * @return void
     */
    initComponent: function() {
        var me = this;

        me.fieldLabel = me.fieldLabel || me.snippets.fields.streamFieldLabel;
        me.emptyText = me.emptyText || me.snippets.fields.streamFieldEmptyText;

        var factory = Ext.create('Shopware.attribute.SelectionFactory');
        me.store = factory.createEntitySearchStore("Shopware\\Models\\ProductStream\\ProductStream");
        me.searchStore = factory.createEntitySearchStore("Shopware\\Models\\ProductStream\\ProductStream");

        me.callParent(arguments);
    },

    /**
     * Adds the stream icon to the combo box field body.
     */
    afterRender: function() {
        var me = this,
            el = me.getEl(),
            inputCell = el.select('.x-form-trigger-input-cell', true).first(),
            iconCell = new Ext.Element(document.createElement('td')),
            icon = new Ext.Element(document.createElement('span'));

        icon.set({
            'cls': 'sprite-product-streams',
            'style': {
                display: 'inline-block',
                width: '16px',
                height: '16px',
                margin: '0 4px',
                position: 'relative',
                top: '2px'
            }
        });

        iconCell.set({
            'style': {
                width: '24px'
            }
        });

        icon.appendTo(iconCell);
        iconCell.insertBefore(inputCell);

        me.callParent(arguments);
    }
});

//
<?php }} ?>