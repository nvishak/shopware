<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:33
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\controller\detail.js" */ ?>
<?php /*%%SmartyHeaderCode:13255acda8f56cea51-44043857%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dddab66e304df4342b8387c861feacbff09d9aa3' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\controller\\detail.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13255acda8f56cea51-44043857',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f58722d7_73438842',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f58722d7_73438842')) {function content_5acda8f58722d7_73438842($_smarty_tpl) {?>/**
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
 *
 * The order module detail controller handles all action around the detail page.
 * It handles also the click on the pencil action column which opens the detail page.
 */
//
Ext.define('Shopware.apps.Order.controller.Detail', {

    /**
     * Extend from the standard ExtJS 4 controller
     * @string
     */
    extend:'Ext.app.Controller',

    refs: [
        { ref: 'orderList', selector: 'order-list' },
        { ref: 'positionGrid', selector: 'order-detail-window order-position-panel' },
        { ref: 'detailWindow', selector: 'order-detail-window' }
    ],

    snippets: {
        successTitle:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'save'/'success_title','default'=>'Successful','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'save'/'success_title','default'=>'Successful','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Successful<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'save'/'success_title','default'=>'Successful','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        failureTitle:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'save'/'error_title','default'=>'Error','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'save'/'error_title','default'=>'Error','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'save'/'error_title','default'=>'Error','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        internalComment: {
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'internal_comment'/'success','default'=>'Internal comment has been saved successfully for order [0]','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'internal_comment'/'success','default'=>'Internal comment has been saved successfully for order [0]','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Internal comment has been saved successfully for order [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'internal_comment'/'success','default'=>'Internal comment has been saved successfully for order [0]','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            failureMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'internal_comment'/'failure','default'=>'An error has occurred while saving the internal comment for order [0].','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'internal_comment'/'failure','default'=>'An error has occurred while saving the internal comment for order [0].','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to save the internal comment for order [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'internal_comment'/'failure','default'=>'An error has occurred while saving the internal comment for order [0].','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        externalComment: {
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'external_comment'/'success','default'=>'External comment has been saved successfully for order [0]','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'external_comment'/'success','default'=>'External comment has been saved successfully for order [0]','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
External comment has been saved successfully for order [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'external_comment'/'success','default'=>'External comment has been saved successfully for order [0]','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            failureMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'external_comment'/'failure','default'=>'An error has occurred while saving the external comment for order [0].','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'external_comment'/'failure','default'=>'An error has occurred while saving the external comment for order [0].','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to save the external comment for order [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'external_comment'/'failure','default'=>'An error has occurred while saving the external comment for order [0].','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        overview: {
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'overview'/'success','default'=>'Order [0] has been saved successfully','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'overview'/'success','default'=>'Order [0] has been saved successfully','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order [0] has been saved successfully.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'overview'/'success','default'=>'Order [0] has been saved successfully','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            failureMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'overview'/'failure','default'=>'An error has occurred while saving order [0].','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'overview'/'failure','default'=>'An error has occurred while saving order [0].','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error has occurred while attempting to save order [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'overview'/'failure','default'=>'An error has occurred while saving order [0].','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        details: {
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'details'/'success','default'=>'The order addresses and payment method have been saved successfully for order [0]','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'details'/'success','default'=>'The order addresses and payment method have been saved successfully for order [0]','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The order addresses and payment method have been saved successfully for order [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'details'/'success','default'=>'The order addresses and payment method have been saved successfully for order [0]','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            failureMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'details'/'failure','default'=>'An error has occurred while saving the order details for order [0].','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'details'/'failure','default'=>'An error has occurred while saving the order details for order [0].','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to save the order details for order [0].<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'details'/'failure','default'=>'An error has occurred while saving the order details for order [0].','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        positions: {
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'positions'/'success','default'=>'The order position has been saved successfully','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'positions'/'success','default'=>'The order position has been saved successfully','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The order position has been saved successfully.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'positions'/'success','default'=>'The order position has been saved successfully','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            failureMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'positions'/'failure','default'=>'An error has occurred while saving the order positions.','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'positions'/'failure','default'=>'An error has occurred while saving the order positions.','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to save the order positions.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'positions'/'failure','default'=>'An error has occurred while saving the order positions.','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            nonEditable: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'positions'/'nonEditable','default'=>'This article is not editable','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'positions'/'nonEditable','default'=>'This article is not editable','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
This item cannot be edited.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'positions'/'nonEditable','default'=>'This article is not editable','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        documents: {
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'documents'/'success','default'=>'Document has been created successfully','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'documents'/'success','default'=>'Document has been created successfully','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Document has been created successfully.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'documents'/'success','default'=>'Document has been created successfully','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            failureMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'documents'/'failure','default'=>'An error has occurred while creating the order document.','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'documents'/'failure','default'=>'An error has occurred while creating the order document.','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to create the order document.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'documents'/'failure','default'=>'An error has occurred while creating the order document.','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        delete: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'delete'/'title','default'=>'Delete selected positions','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'title','default'=>'Delete selected positions','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete selected positions<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'title','default'=>'Delete selected positions','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'delete'/'message','default'=>'There have been marked [0] positions. Are you sure you want to delete all selected positions?','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'message','default'=>'There have been marked [0] positions. Are you sure you want to delete all selected positions?','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
There have been marked [0] positions. Are you sure you want to delete all selected positions?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'message','default'=>'There have been marked [0] positions. Are you sure you want to delete all selected positions?','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            successMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'delete'/'success','default'=>'The order position(s) has been removed successfully','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'success','default'=>'The order position(s) has been removed successfully','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The order position(s) has/have been deleted successfully.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'success','default'=>'The order position(s) has been removed successfully','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            failureMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'message'/'delete'/'failure','default'=>'An error has occurred while saving the order position(s).','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'failure','default'=>'An error has occurred while saving the order position(s).','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error occurred while attempting to save the order position(s).<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'message'/'delete'/'failure','default'=>'An error has occurred while saving the order position(s).','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        convertOrder: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'convertOrder'/'title','default'=>'Convert order?','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertOrder'/'title','default'=>'Convert order?','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Convert order?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertOrder'/'title','default'=>'Convert order?','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'convertOrder'/'message','default'=>'Do you want to convert this order to a regular order?','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertOrder'/'message','default'=>'Do you want to convert this order to a regular order?','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Do you want to convert this order to a regular order?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertOrder'/'message','default'=>'Do you want to convert this order to a regular order?','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            successTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'convertOrderSuccess'/'tile','default'=>'Order converted','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertOrderSuccess'/'tile','default'=>'Order converted','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order has been converted<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertOrderSuccess'/'tile','default'=>'Order converted','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        growlMessage: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'growlMessage','default'=>'Order','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growlMessage','default'=>'Order','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'growlMessage','default'=>'Order','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @return void
     */
    init:function () {
        var me = this;

        me.control({
            'order-list-main-window order-list': {
                showDetail: me.onShowDetail
            },
            'order-detail-window order-communication-panel': {
                saveInternalComment: me.onSaveInternalComment,
                saveExternalComment: me.onSaveExternalComment
            },
            'order-detail-window order-overview-panel': {
                saveOverview: me.onSaveOverview,
                updateForms: me.onUpdateDetailPage,
                convertOrder: me.onConvertOrder
            },
            'order-billing-field-set': {
                countryChanged: me.onCountryChanged
            },

            'order-shipping-field-set': {
                countryChanged: me.onCountryChanged
            },
            'order-detail-window order-detail-panel': {
                saveDetails: me.onSaveDetails,
                updateForms: me.onUpdateDetailPage
            },
            'order-detail-window order-detail-panel order-debit-field-set': {
                changePayment:me.onChangePayment
            },
            'order-detail-window order-detail-panel order-dispatch-field-set': {
                changeDispatch: me.onChangeDispatch
            },
            'order-detail-window order-configuration-panel': {
                resetConfiguration: me.onResetConfiguration,
                createDocument: me.onCreateDocument,
                documentPreview: me.onDocumentPreview
            },
            'order-detail-window order-position-panel': {
                beforeEdit: me.onBeforeEdit,
                savePosition: me.onSavePosition,
                cancelEdit: me.onCancelEdit,
                articleNumberSelect: me.onArticleSelect,
                articleNameSelect: me.onArticleSelect,
                addPosition: me.onAddPosition,
                deleteMultiplePositions: me.onDeleteMultiplePositions,
                updateForms: me.onUpdateDetailPage
            },
            'order-detail-window tabpanel[name=main-tab]': {
                beforetabchange: me.onTabChange
            }
        });
        me.callParent(arguments);
    },

    /**
     * Event listener function,  needed for convertOrder event.
     * Will convert the current order after user's confirmation
     * @param record
     */
    onConvertOrder: function(record) {
        var me = this,
            window = me.getDetailWindow();

        Ext.MessageBox.confirm(me.snippets.convertOrder.title, me.snippets.convertOrder.message, function (response) {
            if ( response !== 'yes' ) {
                return;
            }

            // do the actual request to convert he order
            Ext.Ajax.request({
                url: '<?php echo '/shopware4/backend/CanceledOrder/convertOrder';?>',
                method: 'POST',
                params: {
                    orderId: record.get('id')
                },
                success: function(response) {
                    var status = Ext.decode(response.responseText);
                    if (status.success) {
                        Shopware.Notification.createGrowlMessage(me.snippets.convertOrder.successTitle);
                        Shopware.app.Application.addSubApplication({
                            name: 'Shopware.apps.Order',
                            params: {
                                orderId:record.get('id')
                            }
                        });
                        window.destroy();
                    } else {
                        Shopware.Notification.createGrowlMessage('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'convertError','default'=>'Order was not converted','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertError','default'=>'Order was not converted','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order could not be converted<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'convertError','default'=>'Order was not converted','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', status.message);
                    }
                }
            });

        });
    },

    /**
     * Event listener function, fired when the user want to change the tab in the order detail window
     */
    onTabChange: function(panel, newTab, oldTab) {
        this.cancelPositionEdit();
    },

    /**
     * Internal helper function to cancel the open editing of the position grid.
     */
    cancelPositionEdit: function() {
        var me = this,
            positionGrid = me.getPositionGrid();

        if (positionGrid && positionGrid.rowEditor) {
            positionGrid.rowEditor.cancelEdit();
        }
    },

    /**
     * Updates the detail page after the record has been saved.
     * @param order
     * @param window
     */
    onUpdateDetailPage: function(order, window) {
        var me = this,
            overview = window.down('order-overview-panel'),
            communication = window.down('order-communication-panel'),
            history = window.down('order-history-list'),
            detail = window.down('order-detail-panel');

        overview.record = order;
        communication.record = order;
        detail.record = order;
        history.getStore().load();

        overview.detailsForm.loadRecord(order);
        overview.editForm.loadRecord(order);
        detail.loadRecord(order);
        communication.loadRecord(order);
    },

    /**
     * Event will be fired when the user start the editing of the order position grid
     *
     * @param [Ext.grid.plugin.Editing] - The row editor
     * @param [object]  - An edit event with the following properties:
     *   grid - The grid this editor is on
     *   view - The grid view
     *   store - The grid store
     *   record - The record being edited
     *   row - The grid table row
     *   column - The grid Column defining the column that initiated the edit
     *   rowIdx - The row index that is being edited
     *   colIdx - The column index that initiated the edit
     *   cancel - Set this to true to cancel the edit or return false from your handler.
     */
    onBeforeEdit: function(editor, e) {
        var me = this,
            columns = editor.editor.items.items,
            articleId = e.record.get('articleId');

            columns[1].setValue(e.record.get('articleNumber'));
            columns[2].setValue(e.record.get('articleName'));

    },

    /**
     * Event will be fired when the user clicks the update button of the row editor.
     *
     * @param [Ext.grid.plugin.Editing] - The row editor
     * @param [object]  - An edit event with the following properties:
     *   grid - The grid this editor is on
     *   view - The grid view
     *   store - The grid store
     *   record - The record being edited
     *   row - The grid table row
     *   column - The grid Column defining the column that initiated the edit
     *   rowIdx - The row index that is being edited
     *   colIdx - The column index that initiated the edit
     *   cancel - Set this to true to cancel the edit or return false from your handler.
     */
    onSavePosition: function(editor, e, order, options) {
        var me = this;

        //to convert the float value. Without this the insert value "10,55" would be converted to "1055,00"
        e.record.set('price', e.newValues.price);

        //the article suggest search is not a form field so we have to set the value manually
        e.record.set('articleName', e.newValues.articleName);
        e.record.set('articleNumber', e.newValues.articleNumber);

        //calculate the new total amount.
        if (Ext.isNumeric(e.newValues.price) && Ext.isNumeric(e.newValues.quantity)) {
            e.record.set('total', e.newValues.price * e.newValues.quantity);
            e.newValues.total = e.newValues.price * e.newValues.quantity;
        }

        e.record.save({
            callback:function (data, operation) {
                var records = operation.getRecords(),
                    record = records[0],
                    rawData = record.getProxy().getReader().rawData;

                if ( operation.success === true ) {
                    Shopware.Notification.createGrowlMessage(me.snippets.successTitle, me.snippets.positions.successMessage, me.snippets.growlMessage);
                    order.set('invoiceAmount', rawData.invoiceAmount);
                    if (options !== Ext.undefined && Ext.isFunction(options.callback)) {
                        options.callback(order);
                    }
                } else {
                    Shopware.Notification.createGrowlMessage(me.snippets.failureTitle, me.snippets.positions.failureMessage + '<br> ' + rawData.message, me.snippets.growlMessage);
                    e.store.remove(records);
                }
            }
        });
    },

    /**
     * Event listener method which is fired when the user cancel the row editing in the position grid
     * on the detail page. If the edited record is a new position, the position will be removed.
     *
     * @param grid
     * @param eOpts
     */
    onCancelEdit: function(grid, eOpts) {
        var record = eOpts.record,
            store = eOpts.store;

        if (!(record instanceof Ext.data.Model) || !(store instanceof Ext.data.Store)) {
            return;
        }
        if (record.get('id') === 0) {
            store.remove(record);
        }
    },

    /**
     * Event will be fired when the user search for an article number in the row editor
     * and selects an article in the drop down menu.
     *
     * @param [object] editor - Ext.grid.plugin.RowEditing
     * @param [string] value - Value of the Ext.form.field.Trigger
     * @param [object] record - Selected record
     */
    onArticleSelect: function(editor, value, record) {
        var columns = editor.editor.items.items,
            updateButton = editor.editor.floatingButtons.items.items[0];

        updateButton.setDisabled(false);
        columns[1].setValue(record.get('number'));
        columns[2].setValue(record.get('name'));

        // Update articleId for row
        editor.context.record.set('articleId', record.get('articleId'));
    },


    /**
     * Event will be fired when the user clicks the add button to add an order position.
     *
     * @param [Ext.data.Model] record - The record of the detail page
     * @param [Ext.grid.Panel] grid - The order position grid of the detail page
     * @param [Ext.grid.plugin.RowEditing] editor - The row editor of the grid panel
     */
    onAddPosition: function(record, grid, editor) {
        var me = this;

        editor.cancelEdit();
        var position = Ext.create('Shopware.apps.Order.model.Position', {
            orderId: record.get('id'),
            quantity: 1,
            taxId: me.subApplication.getStore('Tax').getAt(0).get('id'),
            statusId: 0
        });

        grid.getStore().add(position);
        editor.startEdit(position, 0);
    },

    /**
     * Event will be fired when the user clicks the remove button to remove all selected order positions.
     *
     * @param [Ext.data.Model] order - The order of the detail page
     * @param [Ext.grid.Panel] grid - The order position grid of the detail page
     */
    onDeleteMultiplePositions: function(order, grid, options) {
        var me = this, orderId,
            store = grid.getStore(),
            selectionModel = grid.getSelectionModel(),
            positions = selectionModel.getSelection(),
            message =  Ext.String.format(me.snippets.delete.message, positions.length);

        if (positions.length === 0) {
            return;
        } else {
            orderId = positions[0].get('orderId');
        }

        // we do not just delete - we are polite and ask the user if he is sure.
        Ext.MessageBox.confirm(me.snippets.delete.title, message, function (response) {
            if ( response !== 'yes' ) {
                return;
            }
            store.remove(positions);
            store.getProxy().extraParams = {
                orderID: orderId
            };
            store.sync({
                callback:function (batch, operation) {
                    var rawData = batch.proxy.getReader().rawData;

                    if ( rawData.success === true ) {
                        Shopware.Notification.createGrowlMessage(me.snippets.successTitle, me.snippets.delete.successMessage, me.snippets.growlMessage);

                        order.set('invoiceAmount', rawData.data.invoiceAmount);
                        if (options !== Ext.undefined && Ext.isFunction(options.callback)) {
                            options.callback(order);
                        }

                    } else {
                        Shopware.Notification.createGrowlMessage(me.snippets.failureTitle, me.snippets.delete.failureMessage + '<br> ' + rawData.message, me.snippets.growlMessage)
                    }
                }
            });
        });
    },


    /**
     * Event will be fired when the user change the payment combo box which
     * is displayed on bottom of the detail page.
     *
     * @param [object] value     - the new value of the combo box
     * @param [object] container - The field container which contains the debit account fields
     * @return void
     */
    onChangePayment:function (value, container) {
        if ( value !== 2 ) {
            if (container.getEl()) {
                container.getEl().fadeOut({
                    opacity:0,
                    easing:'easeOut',
                    duration:500,
                    callback:function () {
                        container.hide();
                    }
                });
            } else {
                container.hide();
            }
        } else {
            container.show();
            if (container.getEl()) {
                container.getEl().fadeIn({
                    opacity:1,
                    easing:'easeOut',
                    duration:500
                });
            }
        }
    },

    /**
     * Updates the dispatch method of the edited order to correspond to the selection
     * made in the 'dispatch' combobox.
     *
     * @param Shopware.apps.Order.view.detail.Dispatch panel
     * @param int newValue
     */
    onChangeDispatch: function(panel, newValue) {
        var orderDispatch = panel.record.getDispatch(),
            newDispatch = panel.dispatchesStore.getById(newValue);

        orderDispatch.removeAll();
        orderDispatch.add(newDispatch);
    },

    /**
     * Called when the user changes the country combobox in the shipping or billing form
     *
     * @param countryCombo
     * @param newValue
     * @param countryStateCombo
     * @param record
     */
    onCountryChanged: function(countryCombo, newValue, countryStateCombo, record) {
        var store = countryStateCombo.store,
            oldStateId = record.get('stateId');
        if (newValue === null) {
            countryStateCombo.setValue(null);
            countryStateCombo.hide();
            return;
        }
        store.getProxy().extraParams = {
            countryId: newValue
        };
        countryStateCombo.show();
        store.load({
            callback: function() {
                var record = store.getById(oldStateId);
                if (store.getCount() === 0) {
                    countryStateCombo.setValue(null);
                    countryStateCombo.hide();
                    return true;
                }
                if (record instanceof Ext.data.Model) {
                    countryStateCombo.setValue(record.get('id'));
                } else {
                    countryStateCombo.setValue(null);
                }
                countryStateCombo.show();
            }
        });
    },

    /**
     * Event listener method which is fired when the user clicks the preview button
     * on the detail page in the document tab panel.
     *
     * @param [Ext.data.Model] order - The order record of the detail page
     * @param [Ext.data.Model] config - The configuration record
     * @param [Ext.container.Container] panel - The form panel
     */
    onDocumentPreview: function(order, config, panel) {
        window.open('<?php echo '/shopware4/backend/Order/createDocument';?>' + '' +
                '?orderId=' + order.get('id') +
                '&preview=1'+ '' +
                '&taxFree=' + config.get('taxFree') +
                '&temp=1' +
                '&documentType=' + config.get('documentType') )
    },

    /**
     * Event listener method which is fired when the user clicks
     * the "create document" button on the detail page in the document tab.
     *
     * @param [Ext.data.Model]          The record of the detail page (Shopware.apps.Order.model.Order)
     * @param [Ext.data.Model]          The configuration record of the document form (Shopware.apps.Order.model.Configuration)
     * @param [Ext.container.Container] me
     */
    onCreateDocument: function(order, config, panel) {
        var me = this,
            store = Ext.create('Shopware.apps.Order.store.Configuration');

        panel.setLoading(true);

        config.set('orderId', order.get('id'));
        store.add(config);
        store.sync({
            callback: function(batch, operation) {
                var rawData = batch.proxy.getReader().rawData;

                panel.setLoading(false);

                if ( rawData.success === true ) {
                    var data = rawData.data[0];
                    order.set(data);

                    Shopware.Notification.createGrowlMessage(me.snippets.successTitle, me.snippets.documents.successMessage, me.snippets.growlMessage);

                    var documentStore = order['getReceiptStore'],
                        documents = order.get('documents');

                    if (!documentStore) {
                        return;
                    }

                    documentStore.removeAll();
                    Ext.each(documents, function(modelData){
                        var model = Ext.create('Shopware.apps.Order.model.Receipt', modelData),
                            typeModel = Ext.create('Shopware.apps.Base.model.DocType', modelData.type);

                        var typeStore = model.getDocType();
                        typeStore.add(typeModel);
                        model['getDocTypeStore'] = typeStore;
                        documentStore.add(model);
                    });
                } else {
                    Shopware.Notification.createGrowlMessage(me.snippets.failureTitle, me.snippets.documents.failureMessage + '<br> ' + rawData.message, me.snippets.growlMessage);
                }
            }
        });
    },

    /**
     * Event listener method which is fired when the user clicks the reset button
     * in the document tab panel on the detail page to reset the document configuration.
     * @return void
     */
    onResetConfiguration: function(form, record) {
        /**
         * Usually called by the Ext.data.Store to which this model instance has been joined.
         * Rejects all changes made to the model instance since either creation, or the last commit operation.
         * Modified fields are reverted to their original values.
         */
        record.reject();
        form.loadRecord(record);
    },

    /**
     * Event will be fired when the user clicks on one of the three buttons in the customer
     * information panels.
     *
     * @param [Ext.data.Model] record - The record of the detail page
     */
    onOpenCustomer: function(record) {
        Shopware.app.Application.addSubApplication({
            name: 'Shopware.apps.Customer',
            action: 'detail',
            params: {
                customerId: record.get('customerId')
            }
        });
    },

    /**
     * Event listener method which is fired when the user wants to save the internal comment
     * which can be edit in the communication tab panel on the detail page.
     * @return void
     */
    onSaveInternalComment: function(record) {
        var me = this;

        me.saveRecord(record, me.snippets.internalComment.successMessage, me.snippets.internalComment.failureMessage);
    },

    /**
     * Event listener method which is fired when the user edits an order over the detail
     * page and clicks the save button on the overview panel.
     *
     * @param record
     */
    onSaveOverview: function(record, options) {
        var me = this;

        me.saveRecord(record, me.snippets.overview.successMessage, me.snippets.overview.failureMessage, options);
    },

    /**
     * Event listener method which is fired when the user edits an order over the detail
     * page and clicks the save button on the details panel.
     *
     * @param record
     */
    onSaveDetails: function(record, options) {
        var me = this;

        me.saveRecord(record, me.snippets.details.successMessage, me.snippets.details.failureMessage, options);
    },

    /**
     * Event listener method which is fired when the user wants to save the external comment
     * which can be edit in the communication tab panel on the detail page.
     * @return void
     */
    onSaveExternalComment: function(record) {
        var me = this;

        me.saveRecord(record, me.snippets.externalComment.successMessage, me.snippets.externalComment.failureMessage);

    },

    /**
     * Internal helper function to save the record and display a succes message or error message
     * @param record
     * @param title
     * @param message
     */
    saveRecord: function(order, successMessage, errorMessage, options) {
        var me = this;

        successMessage = Ext.String.format(successMessage, order.get('number'));
        errorMessage = Ext.String.format(errorMessage, order.get('number'));

        order.save({
            callback:function (data, operation) {
                var records = operation.getRecords(),
                    record = records[0],
                    rawData = record.getProxy().getReader().rawData;

                if ( operation.success === true ) {
                    Shopware.Notification.createGrowlMessage(me.snippets.successTitle, successMessage, me.snippets.growlMessage);
                    order.set('invoiceAmount', rawData.data.invoiceAmount);

                    //Check if a status mail content created and create a model with the returned data and open the mail window.
                    if (rawData && rawData.data && rawData.data.mail && rawData.data.mail.content) {
                        var mail = Ext.create('Shopware.apps.Order.model.Mail', rawData.data.mail);
                        me.showOrderMail(mail, record)
                    }

                    if (options !== Ext.undefined && Ext.isFunction(options.callback)) {
                        options.callback(order);
                    }
                } else {
                    Shopware.Notification.createGrowlMessage(me.snippets.failureTitle, errorMessage + '<br> ' + rawData.message, me.snippets.growlMessage)
                }
                // reload the order list
                me.getOrderList().store.load();
            }
        });
    },

    /**
     * Opens the status mail window
     *
     * @param mail
     */
    showOrderMail: function(mail, record) {
        var me = this,
            documentTypeStore = Ext.create('Shopware.apps.Order.store.DocType');

        // open the status mail window
        documentTypeStore.load({
            callback: function () {
                me.mainWindow = me.getView('mail.Window').create({
                    attached: [
                        record.get('id')
                    ],
                    record: record,
                    listStore: me.getOrderList().getStore(),
                    documentTypeStore: documentTypeStore,
                    mail: mail
                }).show();
            }
        });
    },


    /**
     * Event listener method which fired when the user clicks the pencil button
     * in the order list to show the order detail page.
     * @param record
     */
    onShowDetail: function(record) {
        var me = this;
        var mainController = me.subApplication.getController('Main');
        mainController.showOrder(record);
    }
});
//
Ext.define('Shopware.apps.Order.PaymentMethods.controller.Detail', {
    override: 'Shopware.apps.Order.controller.Detail',

    onChangePayment: function (value, oldDebitContainer) {
        var me = this;
        var window = me.getDetailWindow();
        var store = window.paymentsStore;
        var record = store.getById(value);
        var paymentFieldSet = window.down('order-debit-field-set');

        switch (record.get('name').toLowerCase()) {
            case 'sepa':
                paymentFieldSet.fieldContainer.show();
                if (paymentFieldSet.fieldContainer.getEl()) {
                    paymentFieldSet.fieldContainer.getEl().fadeIn({
                        opacity: 1,
                        easing: 'easeOut',
                        duration: 500
                    });
                }
                paymentFieldSet.accountNumberField.hide();
                paymentFieldSet.accountHolderField.hide();
                paymentFieldSet.bankCodeField.hide();
                paymentFieldSet.ibanField.show();
                paymentFieldSet.bicField.show();
                break;
            case 'debit':
                paymentFieldSet.fieldContainer.show();
                if (paymentFieldSet.fieldContainer.getEl()) {
                    paymentFieldSet.fieldContainer.getEl().fadeIn({
                        opacity: 1,
                        easing: 'easeOut',
                        duration: 500
                    });
                }
                paymentFieldSet.fieldContainer.getEl().show();
                paymentFieldSet.accountNumberField.show();
                paymentFieldSet.accountHolderField.show();
                paymentFieldSet.bankCodeField.show();
                paymentFieldSet.ibanField.hide();
                paymentFieldSet.bicField.hide();
                break;
            default:
                me.callParent(arguments);
        }
    }
});

//
<?php }} ?>