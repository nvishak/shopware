<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:20
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.CustomerStreamGrid.js" */ ?>
<?php /*%%SmartyHeaderCode:298795acda8e8bda199-69508901%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c875e319667fb925912809a570c20705f9c928dc' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.CustomerStreamGrid.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '298795acda8e8bda199-69508901',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e8c9e849_25235843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e8c9e849_25235843')) {function content_5acda8e8c9e849_25235843($_smarty_tpl) {?>/**
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

// 

Ext.define('Shopware.form.field.CustomerStreamGrid', {
    extend: 'Shopware.form.field.Grid',
    alias: 'widget.shopware-form-field-customer-stream-grid',
    mixins: ['Shopware.model.Helper'],
    displayNewsletterCount: false,

    createColumns: function() {
        var me = this;

        return [
            me.createSortingColumn(),
            { dataIndex: 'name', flex: 1, renderer: Ext.bind(me.nameRenderer, me) },
            me.createActionColumn()
        ];
    },

    nameRenderer: function (value, meta, record) {
        var qtip = '<b>' + record.get('name') + '</b>';
        qtip += ' - ' + record.get('customer_count') + ' <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer(s)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';

        if (record.get('freezeUp')) {
            qtip += '<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'frozen','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'frozen','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'frozen','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: ' + Ext.util.Format.date(record.get('freezeUp')) + '</p>';
        }

        qtip += '<br><p>' + record.get('description') +'</p>';

        meta.tdAttr = 'data-qtip="' + qtip + '"';

        if (this.displayNewsletterCount) {
            return '<span class="stream-name-column"><b>' + value + '</b> - ' + record.get('newsletter_count') + ' <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'newsletter_count_suffix','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newsletter_count_suffix','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Recipient(s)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'newsletter_count_suffix','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>';
        } else {
            return '<span class="stream-name-column"><b>' + value + '</b> - ' + record.get('customer_count') + ' <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer(s)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'customer_count_suffix','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>';
        }
    },

    createSearchField: function() {
        var config = this.getComboConfig();
        config.displayNewsletterCount = this.displayNewsletterCount;
        return Ext.create('Shopware.form.field.CustomerStreamSingleSelection', config);
    },

    createActionColumnItems: function() {
        var me = this,
            items = me.callParent(arguments);

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'read'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>*/
            items.push(me.createModuleIcon());
        /*<?php }?>*/

        return items;
    },

    createModuleIcon: function() {
        return {
            action: 'open-customer',
            iconCls: 'sprite-customer-streams',
            handler: function (view, rowIndex, colIndex, item, opts, record) {
                Shopware.app.Application.addSubApplication({
                    name: 'Shopware.apps.Customer',
                    action: 'customer_stream',
                    params: {
                        streamId: record.get('id')
                    }
                });
            }
        };
    }
});
// 
<?php }} ?>