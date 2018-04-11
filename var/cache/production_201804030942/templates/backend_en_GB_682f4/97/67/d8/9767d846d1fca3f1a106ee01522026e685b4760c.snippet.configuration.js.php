<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\view\detail\configuration.js" */ ?>
<?php /*%%SmartyHeaderCode:156945acda8f32639d7-51411335%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9767d846d1fca3f1a106ee01522026e685b4760c' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\view\\detail\\configuration.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156945acda8f32639d7-51411335',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f33453b9_87490155',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f33453b9_87490155')) {function content_5acda8f33453b9_87490155($_smarty_tpl) {?>/**
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
 * @package    Order
 * @subpackage View
 * @version    $Id$
 * @author shopware AG
 */

//

/**
 * Shopware UI - Order detail page
 *
 * todo@all: Documentation
 */
//
Ext.define('Shopware.apps.Order.view.detail.Configuration', {

    /**
     * The configuration is an extension of the form panel
     */
    extend: 'Ext.form.Panel',

    /**
     * The configuration panel uses the column layout
     */
    layout: 'column',

    cls: 'shopware-form',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias:'widget.order-configuration-panel',

    /**
     * Default configuration for the left and right container
     * @object
     */
    formDefaults: {
        labelWidth: 155,
        style: 'margin-bottom: 10px !important;',
        labelStyle: 'font-weight: 700;',
        anchor: '100%'
    },

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        vatId: {
            label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'vat_id_label','default'=>'Customer VAT ID','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'vat_id_label','default'=>'Customer VAT ID','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer VAT ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'vat_id_label','default'=>'Customer VAT ID','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            empty: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'vat_id_empty','default'=>'Not filed','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'vat_id_empty','default'=>'Not filed','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Not filed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'vat_id_empty','default'=>'Not filed','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        documentType:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'document_type','default'=>'Document type','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'document_type','default'=>'Document type','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Document type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'document_type','default'=>'Document type','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        comment: {
            label:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'comment_label','default'=>'Document comment','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'comment_label','default'=>'Document comment','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Document comment<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'comment_label','default'=>'Document comment','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            support:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'comment_support','default'=>'Changes are not saved permanently','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'comment_support','default'=>'Changes are not saved permanently','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Changes are not saved permanently<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'comment_support','default'=>'Changes are not saved permanently','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        voucher:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'voucher','default'=>'Voucher','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'voucher','default'=>'Voucher','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Voucher<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'voucher','default'=>'Voucher','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        taxFree:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'tax_free','default'=>'Tax free','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'tax_free','default'=>'Tax free','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Tax free<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'tax_free','default'=>'Tax free','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        invoiceNumber:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'invoice_number','default'=>'Invoice number','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'invoice_number','default'=>'Invoice number','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Invoice number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'invoice_number','default'=>'Invoice number','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        deliveryDate:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'delivery_date','default'=>'Delivery date','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'delivery_date','default'=>'Delivery date','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delivery date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'delivery_date','default'=>'Delivery date','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        displayDate:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'display_date','default'=>'Displayed date','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'display_date','default'=>'Displayed date','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Displayed date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'display_date','default'=>'Displayed date','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        buttons: {
            preview:  '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'preview','default'=>'Preview','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'preview','default'=>'Preview','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Preview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'preview','default'=>'Preview','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            reset: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'reset','default'=>'Reset settings','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'reset','default'=>'Reset settings','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Reset settings<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'reset','default'=>'Reset settings','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            create: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'create','default'=>'Create document','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'create','default'=>'Create document','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Generate document<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'create','default'=>'Create document','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        form: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration'/'form_title','default'=>'Configuration','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'form_title','default'=>'Configuration','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Configuration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration'/'form_title','default'=>'Configuration','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * The initComponent template method is an important initialization step for a Component.
     * It is intended to be implemented by each subclass of Ext.Component to provide any needed constructor logic.
     * The initComponent method of the class being created is called first,
     * with each initComponent method up the hierarchy to Ext.Component being called thereafter.
     * This makes it easy to implement and, if needed, override the constructor logic of the Component at any step in the hierarchy.
     * The initComponent method must contain a call to callParent in order to ensure that the parent class' initComponent method is also called.
     *
     * @return void
     */
    initComponent: function() {
        var me = this;

        me.title = me.snippets.form;
        me.items = [ me.createLeftItems(), me.createRightItems() ];
        me.buttons = me.createButtons();
        me.callParent(arguments);
        me.loadDefaultConfiguration();
    },

    /**
     * Registers the custom component events.
     * @return void
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the "create document" button
             * which is placed in the document tab on bottom.
             *
             * @event
             * @param [Ext.data.Model]          The record of the detail page (Shopware.apps.Order.model.Order)
             * @param [Ext.data.Model]          The configuration record of the document form (Shopware.apps.Order.model.Configuration)
             * @param [Ext.container.Container] me
             */
            'createDocument',

            /**
             * Event will be fired when the user clicks the "reset" button
             * which is placed in the document tab on bottom.
             *
             * @event
             * @param [Ext.container.Container] me
             */
            'resetConfiguration',

            /**
             * Event will be fired when the user clicks the "preview" button
             * which is placed in the document tab on bottom.
             *
             * @event
             * @param [Ext.data.Model]          The record of the detail page (Shopware.apps.Order.model.Order)
             * @param [Ext.data.Model]          The configuration record of the document form (Shopware.apps.Order.model.Configuration)
             * @param [Ext.container.Container] me
             */
            'documentPreview'
        );
    },

    /**
     * Creates the left form fields for the document creation.
     * @return Ext.container.Container
     */
    createLeftItems: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            columnWidth: 0.5,
            layout: 'anchor',
            padding: 10,
            defaults: me.formDefaults,
            items: [
                {
                    xtype: 'combobox',
                    queryMode: 'local',
                    triggerAction: 'all',
                    fieldLabel: me.snippets.documentType,
                    store: me.documentTypesStore,
                    displayField: 'name',
                    valueField: 'id',
                    name: 'documentType'
                },
                {
                    xtype: 'textfield',
                    fieldLabel: me.snippets.invoiceNumber,
                    name: 'invoiceNumber'
                },
                {
                    xtype: 'datefield',
                    fieldLabel: me.snippets.displayDate,
                    submitFormat: 'd.m.Y',
                    value: new Date(),
                    name: 'displayDate'
                },
                {
                    xtype: 'datefield',
                    fieldLabel: me.snippets.deliveryDate,
                    submitFormat: 'd.m.Y',
                    name: 'deliveryDate'
                },
                {
                    xtype: 'displayfield',
                    name: 'vatId',
                    fieldLabel: me.snippets.vatId.label,
                    emptyText: me.snippets.vatId.empty
                },
                {
                    xtype: 'checkbox',
                    fieldLabel: me.snippets.taxFree,
                    name: 'taxFree',
                    uncheckedValue:0,
                    inputValue:1
                }
            ]
        });

    },

    /**
     * Loads the default configuration.
     * @return void
     */
    loadDefaultConfiguration: function() {
        var me = this, vatId,
            billing = me.record.getBilling();

        if(billing == null || billing.first() == null) {
            vatId = me.snippets.vatId.empty;
        }else{
            billing = billing.first();
            if (Ext.isEmpty(billing.get('vatId'))) {
                vatId = me.snippets.vatId.empty;
            } else {
                vatId = billing.get('vatId');
            }
        }

        me.defaultConfig = Ext.create('Shopware.apps.Order.model.Configuration', {
            displayDate: new Date(),
            documentType: 1,
            voucher: null,
            vatId: vatId,
            orderId: me.record.get('id'),
            taxFree: me.record.get('taxFree')
        });

        me.loadRecord(me.defaultConfig);
    },

    /**
     * Creates the left form fields for the document creation.
     * @return Ext.container.Container
     */
    createRightItems: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            columnWidth: 0.5,
            layout: 'anchor',
            padding: 10,
            defaults: me.formDefaults,
            items: [{
                xtype: 'textarea',
                fieldLabel: me.snippets.comment.label,
                supportText: me.snippets.comment.support,
                name: 'docComment'
            }, {
                xtype: 'combobox',
                fieldLabel: me.snippets.voucher,
                name: 'voucher',
                store: Ext.create('Shopware.apps.Order.store.Voucher'),
                displayField: 'display',
                valueField: 'id'
            }]
        });
    },

    /**
     * Creates the form buttons create, reset and preview.
     * @return array
     */
    createButtons: function() {
        var me = this;

        me.createButton = Ext.create('Ext.button.Button', {
            text: me.snippets.buttons.create,
            action: 'create-document',
            cls:'primary',
            handler: function() {
                var config = Ext.create('Shopware.apps.Order.model.Configuration');

                me.getForm().updateRecord(config);
                me.fireEvent('createDocument', me.record, config, me);
            }
        });

        me.resetButton = Ext.create('Ext.button.Button', {
            text: me.snippets.buttons.reset,
            action: 'reset-config',
            cls: 'secondary',
            handler: function() {
                me.fireEvent('resetConfiguration', me, me.defaultConfig);
            }
        });

        me.previewButton = Ext.create('Ext.button.Button', {
            text: me.snippets.buttons.preview,
            action: 'document-preview',
            cls: 'secondary',
            handler: function() {
                var values = me.getValues(),
                    config = Ext.create('Shopware.apps.Order.model.Configuration', values);

                me.fireEvent('documentPreview', me.record, config, me);
            }
        });

        return [
            me.resetButton,
            /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('privilege'=>'update'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>*/
                me.previewButton,
                me.createButton
            /*<?php }?>*/
        ];
    }

});
//
<?php }} ?>