<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\view\mail\form.js" */ ?>
<?php /*%%SmartyHeaderCode:102785acda8f43f0c21-98804496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd34112b0448b7b04ddcdd5219bef8cab8f165501' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\view\\mail\\form.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102785acda8f43f0c21-98804496',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f442e7e0_94920050',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f442e7e0_94920050')) {function content_5acda8f442e7e0_94920050($_smarty_tpl) {?>/**
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
 * Shopware UI - Order batch window
 */
//
Ext.define('Shopware.apps.Order.view.mail.Form', {

    /**
     * Define that the additional information is an Ext.panel.Panel extension
     *
     * @type { String }
     */
    extend: 'Ext.form.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     *
     * @type { String }
     */
    alias: 'widget.order-mail-form',

    /**
     * An optional extra CSS class that will be added to this component's Element.
     */
    cls: Ext.baseCSSPrefix + 'batch-mail-panel',

    /**
     * Component layout definition
     *
     * @type { Object }
     */
    layout: {
        type: 'vbox',
        align: 'stretch'
    },

    /**
     * A shortcut for setting a padding style on the body element. The value can either be a number to be applied to all sides, or a normal css string describing padding.
     *
     * @type { Number }
     */
    bodyPadding: 10,

    /**
     * Whether or not the form panel should have a border.
     *
     * @type { Boolean }
     */
    border: false,

    /**
     * Contains all snippets for the view component
     *
     * @type { Object }
     */
    snippets: {
        subject: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'subject','default'=>'Subject','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'subject','default'=>'Subject','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Subject<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'subject','default'=>'Subject','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        to: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'to','default'=>'To','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'to','default'=>'To','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'to','default'=>'To','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        button: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'button','default'=>'Send mail','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'button','default'=>'Send mail','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Send mail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'button','default'=>'Send mail','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * The initComponent template method is an important initialization step for a Component.
     * It is intended to be implemented by each subclass of Ext.Component to provide any needed constructor logic.
     * The initComponent method of the class being created is called first,
     * with each initComponent method up the hierarchy to Ext.Component being called thereafter.
     * This makes it easy to implement and, if needed, override the constructor logic of the Component at any step in the hierarchy.
     * The initComponent method must contain a call to callParent in order to ensure that the parent class' initComponent method is also called.
     */
    initComponent: function() {
        var me = this;

        me.registerEvents();

        me.items = me.getFormItems();

        me.dockedItems = me.getToolbar();

        me.callParent(arguments);
    },

    /**
     * Registers the custom component events.
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the "generate documents" button which is
             * displayed within the form field set.
             *
             * @event sendMail
             * @param { Ext.form.Panel } - This component
             */
            'sendMail'
        );
    },

    /**
     * Creates and returns the toolbar which contains the send mail button.
     *
     * @returns { Ext.toolbar.Toolbar }
     */
    getToolbar: function() {
        var me = this;

        return Ext.create('Ext.toolbar.Toolbar', {
            dock: 'bottom',
            items: [
                '->',
                {
                    xtype: 'button',
                    cls: 'primary',
                    text: me.snippets.button,
                    handler: function() {
                        me.fireEvent('sendMail', me);
                        me.fireEvent('afterSendMail', me.attachmentGrid.getStore());
                    }
                }
            ]
        });
    },

    /**
     * Creates and returns an array of the form elements to send a mail.
     *
     * @returns { Array }
     */
    getFormItems: function() {
        var me = this;

        var fields = [
            {
                xtype: 'textfield',
                name: 'to',
                fieldLabel: me.snippets.to
            },
            {
                xtype: 'textfield',
                name: 'subject',
                fieldLabel: me.snippets.subject
            }
        ];

        if (me.mail.get('isHtml')) {
            fields.push({
                xtype: 'tinymcefield',
                name: 'contentHtml',
                minHeight: 90,
                flex: 1
            });
        } else {
            fields.push({
                xtype: 'textarea',
                name: 'content',
                minHeight: 90,
                flex: 1
            });
        }

        me.attachmentGrid = Ext.create('Shopware.apps.Order.view.mail.Attachment', {
            attached: me.attached,
            record: me.record,
            receiptStore: me.record.getReceipt(),
            listStore: me.listStore,
            documentTypeStore: me.documentTypeStore
        });

        // adds at last the attachment panel
        fields.push(me.attachmentGrid);

        return fields;
    }

});
//
<?php }} ?>