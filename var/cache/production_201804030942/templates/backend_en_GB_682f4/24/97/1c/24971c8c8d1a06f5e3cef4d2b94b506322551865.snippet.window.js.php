<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\address\detail\window.js" */ ?>
<?php /*%%SmartyHeaderCode:26385acda8f3580085-33512124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24971c8c8d1a06f5e3cef4d2b94b506322551865' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\address\\detail\\window.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26385acda8f3580085-33512124',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f35b6240_08356703',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f35b6240_08356703')) {function content_5acda8f35b6240_08356703($_smarty_tpl) {?>/**
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
 * @package    Customer
 * @subpackage Address
 * @version    $Id$
 * @author shopware AG
 */

// 

/**
 * Shopware UI - Customer address window backend module
 */
// 
Ext.define('Shopware.apps.Customer.view.address.detail.Window', {
    extend: 'Shopware.window.Detail',
    alias: 'widget.customer-address-detail-window',
    height: 600,
    width: '80%',
    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail/window/title','default'=>'Address details','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/window/title','default'=>'Address details','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Address data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/window/title','default'=>'Address details','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    initComponent: function() {
        var me = this;

        me.callParent(arguments);

        if (me.record && me.record.get('id')) {
            me.attributeForm.loadAttribute(me.record.get('id'));
        }

        Shopware.app.Application.on('address-save-successfully', me.onSaveSuccessful);
    },

    /**
     * Set title of first tab and add attribute tab
     *
     * @returns array
     */
    createTabItems: function() {
        var me = this,
            items = me.callParent(arguments);

        items[0].title = me.title;
        items.push(me.createAttributesTab());

        return items;
    },

    /**
     * Create the attribute tab
     *
     * @returns Ext.container.Container
     */
    createAttributesTab: function() {
        var me = this;

        me.attributeForm = Ext.create('Shopware.attribute.Form', {
            allowTranslation: false,
            table: 's_user_addresses_attributes'
        });

        return Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/customer/view/address','name'=>'attribute_form_title')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/address','name'=>'attribute_form_title'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free text fields<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/customer/view/address','name'=>'attribute_form_title'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            padding: 20,
            items: [
                me.attributeForm
            ]
        });
    },

    /**
     * Save attributes after saving the record
     *
     * @param controller
     * @param record
     * @param window
     */
    onSaveSuccessful: function(controller, record, window) {
        window.attributeForm.saveAttribute(record.get('id'), function(success) {
            if (!success) {
                window.close();
                return;
            }

            Ext.Ajax.request({
                url: '<?php echo '/shopware4/backend/Address/syncAttribute';?>',
                params: {
                    id: record.get('id')
                },
                callback: function(options, success) {
                    if (success) {
                        window.close();
                    }
                }
            });
        });
    }
});
// 
<?php }} ?>