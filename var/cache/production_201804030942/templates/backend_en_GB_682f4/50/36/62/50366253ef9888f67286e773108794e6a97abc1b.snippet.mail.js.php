<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:33
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\controller\mail.js" */ ?>
<?php /*%%SmartyHeaderCode:237285acda8f5e3b415-72222472%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50366253ef9888f67286e773108794e6a97abc1b' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\controller\\mail.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '237285acda8f5e3b415-72222472',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f5e7c5a3_16541006',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f5e7c5a3_16541006')) {function content_5acda8f5e7c5a3_16541006($_smarty_tpl) {?>/**
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
 * @subpackage Controller
 * @version    $Id$
 * @author shopware AG
 */

//

/**
 * Shopware Controller - Order backend module
 */
//
Ext.define('Shopware.apps.Order.controller.Mail', {

    /**
     * Extend from the standard ExtJS 4 controller
     *
     * @type { String }
     */
    extend: 'Ext.app.Controller',

    /**
     * all references to get the elements by the applicable selector
     *
     * @type { Array }
     */
    refs: [
        { ref: 'mailWindow', selector: 'order-mail-window' },
        { ref: 'attachmentGrid', selector: 'order-mail-attachment' }
    ],

    /**
     * Contains all snippets for the this component
     *
     * @type { Object }
     */
    snippets: {
        growlMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'growlMessage','default'=>'Order','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growlMessage','default'=>'Order','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growlMessage','default'=>'Order','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

        successTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sent_success_title','default'=>'Email has been sent to customer [0]','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_success_title','default'=>'Email has been sent to customer [0]','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An email has been sent.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_success_title','default'=>'Email has been sent to customer [0]','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sent_success_message','default'=>'Email sent to customer [0]','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_success_message','default'=>'Email sent to customer [0]','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An email has been sent to the customer [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_success_message','default'=>'Email sent to customer [0]','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

        errorTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sent_error_title','default'=>'Email could not be sent.','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_error_title','default'=>'Email could not be sent.','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Email could not be sent.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_error_title','default'=>'Email could not be sent.','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        errorMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'sent_error_message','default'=>'An error has occurred while sending the status mail:','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_error_message','default'=>'An error has occurred while sending the status mail:','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to send the status mail:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'sent_error_message','default'=>'An error has occurred while sending the status mail:','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     */
    init: function() {
        var me = this;

        me.control({
            'order-mail-window order-mail-form': {
                sendMail: me.onSendMail
            }
        });

        me.callParent(arguments);
    },

    /**
     * Event listener method which is fired when the user clicks the "send email button" to send the displayed
     * email to the customer.
     *
     * @param { Ext.form.Panel } form
     */
    onSendMail: function(form) {
        var me = this,
            win = me.getMailWindow(),
            snippets = me.snippets,
            mail = form.getRecord(),
            rawData,
            message;

        mail.getReceipt().add(
            me.getAttachmentGrid().getStore().getActiveDocuments()
        );

        win.setLoading(true);

        form.getForm().updateRecord(mail);
        mail.setDirty();

        mail.save({
            callback: function(record, operation) {
                win.setLoading(false);

                rawData = record.getProxy().getReader().rawData;

                if (!operation.success) {
                    Shopware.Notification.createGrowlMessage(snippets.errorTitle, snippets.errorMessage + '<br>' + rawData.message, snippets.growlMessage);
                    return;
                }

                mail.set('set', true);
                message = Ext.String.format(snippets.successMessage, mail.get('to'));
                Shopware.Notification.createGrowlMessage(snippets.successTitle, message, snippets.growlMessage);

                win.destroy();
            }
        });
    }
});
//
<?php }} ?>