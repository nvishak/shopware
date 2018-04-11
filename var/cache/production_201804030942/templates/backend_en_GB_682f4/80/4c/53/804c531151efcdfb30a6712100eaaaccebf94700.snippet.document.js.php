<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:34
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\controller\document.js" */ ?>
<?php /*%%SmartyHeaderCode:182175acda8f6004e23-10848051%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '804c531151efcdfb30a6712100eaaaccebf94700' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\controller\\document.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182175acda8f6004e23-10848051',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f605a998_49654474',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f605a998_49654474')) {function content_5acda8f605a998_49654474($_smarty_tpl) {?>/**
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
 * @subpackage Controller
 * @version    $Id$
 * @author shopware AG
 */

//
//
Ext.define('Shopware.apps.Order.controller.Document', {
    extend: 'Ext.app.Controller',

    /**
     * all references to get the elements by the applicable selector
     *
     * @type { Array }
     */
    refs: [
        { ref: 'listing', selector: 'order-list' },
        { ref: 'documentWindow', selector: 'order-detail-window' }
    ],

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     */
    init: function() {
        var me = this;

        me.control({
            'order-detail-window order-document-list': {
                'delete-document': me.onDeleteDocument,
                'open-mail': me.openMail
            }
        });

        me.callParent(arguments)
    },

    /**
     * Loads a new mail and open a new mail window
     */
    openMail: function(record) {
        var me = this,
            order = me.getDocumentWindow().record;

        me.loadMail(order, record, Ext.bind(me.afterLoadMail, me));
    },

    /**
     * Calls a ajax request to delete a document.
     *
     * @param { Ext.grid.Panel } grid
     * @param { Ext.data.Model } record
     */
    onDeleteDocument: function(grid, record) {
        grid.getStore().remove(record);

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/order/deleteDocument';?>',
            method: 'POST',
            params: {
                documentId: record.get('id')
            },
            success: function(response) {
                response = Ext.JSON.decode(response.responseText);
                if (!response.success) {
                    Shopware.Notification.createGrowlMessage(
                        '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                        response.errorMessage
                    );
                }
            },
            failure: function(response) {
                Shopware.Notification.createGrowlMessage(
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    response.status + '<br />' + response.statusText
                );
            }
        });
    },

    /**
     * Calls a ajax request to load a new mail template.
     *
     * @param { Ext.data.Model } order
     * @param { Ext.data.Model } record
     * @param { function } callback
     */
    loadMail: function(order, record, callback) {
        var me = this;

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/order/createMail';?>',
            method: 'POST',
            params: {
                orderId: order.get('id')
            },
            success: function(response) {
                response = Ext.JSON.decode(response.responseText);
                Ext.callback(callback, me, [ response.mail, record ]);
            },
            failure: function(response) {
                Shopware.Notification.createGrowlMessage(
                    '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'document'/'attachemnt'/'error','default'=>'Error','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    response.status + '<br />' + response.statusText
                );
            }
        });
    },

    /**
     * Opens a new mail window.
     *
     * @param { object } mail
     * @param { Ext.data.Model } record
     */
    afterLoadMail: function(mail, record) {
        var me = this,
            mail = Ext.create('Shopware.apps.Order.model.Mail', mail),
            documentTypeStore = Ext.create('Shopware.apps.Order.store.DocType');
        
        documentTypeStore.load({
            callback: function() {
                me.mainWindow = me.getView('mail.Window').create({
                    attached: [
                        record.get('id')
                    ],
                    listStore: me.getListing().getStore(),
                    mail: mail,
                    record: me.getDocumentWindow().record,
                    documentTypeStore: documentTypeStore
                }).show();
            }
        });
    }
});
//
<?php }} ?>