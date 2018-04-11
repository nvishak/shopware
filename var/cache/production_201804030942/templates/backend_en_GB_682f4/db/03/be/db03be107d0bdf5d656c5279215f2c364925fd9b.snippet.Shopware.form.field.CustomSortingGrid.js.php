<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:21
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.CustomSortingGrid.js" */ ?>
<?php /*%%SmartyHeaderCode:273295acda8e94a1cf5-13402132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db03be107d0bdf5d656c5279215f2c364925fd9b' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.CustomSortingGrid.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '273295acda8e94a1cf5-13402132',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e956a5c0_02273402',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e956a5c0_02273402')) {function content_5acda8e956a5c0_02273402($_smarty_tpl) {?>/**
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

Ext.define('Shopware.form.field.CustomSortingGrid', {
    extend: 'Shopware.form.field.Grid',
    alias: 'widget.shopware-form-field-custom-sorting-grid',
    mixins: ['Shopware.model.Helper'],
    hideHeaders: false,

    initComponent: function() {
        var me = this;

        me.callParent(arguments);
        me.grid.view.on('drop', Ext.bind(me.onDrop, me));
    },

    createColumns: function() {
        var me = this;

        return [
            me.createSortingColumn(),
            me.applyBooleanColumnConfig({
                dataIndex: 'active',
                width: 90,
                header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'active','namespace'=>'backend/custom_search/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'active','namespace'=>'backend/custom_search/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'active','namespace'=>'backend/custom_search/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            }),
            {
                header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sorting_label','namespace'=>'backend/custom_search/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sorting_label','namespace'=>'backend/custom_search/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sorting_label','namespace'=>'backend/custom_search/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                dataIndex: 'label',
                flex: 1
            },
            {
                header: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'custom_sorting_default_sorting','namespace'=>'backend/custom_search/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'custom_sorting_default_sorting','namespace'=>'backend/custom_search/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Default<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'custom_sorting_default_sorting','namespace'=>'backend/custom_search/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                renderer: Ext.bind(me.defaultColumnRenderer, me),
                flex: 1
            },
            me.createActionColumn()
        ];
    },

    removeItem: function(record) {
        var me = this;

        me.callParent(arguments);
        this.grid.reconfigure(this.grid.getStore());
    },

    defaultColumnRenderer: function(value, meta, record) {
        return this.booleanColumnRenderer(
            (this.store.indexOf(record) === 0),
            meta,
            record
        );
    },

    onDrop: function() {
        //refresh whole listing for `default sorting` column renderer
        this.grid.reconfigure(this.grid.getStore());
    }
});<?php }} ?>