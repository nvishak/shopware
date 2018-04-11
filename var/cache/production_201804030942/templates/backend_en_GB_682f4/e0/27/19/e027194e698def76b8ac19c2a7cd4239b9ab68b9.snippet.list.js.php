<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\view\batch\list.js" */ ?>
<?php /*%%SmartyHeaderCode:83705acda8f4ac3076-46182959%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e027194e698def76b8ac19c2a7cd4239b9ab68b9' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\view\\batch\\list.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83705acda8f4ac3076-46182959',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f4b33198_31243859',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f4b33198_31243859')) {function content_5acda8f4b33198_31243859($_smarty_tpl) {?>/**
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
 * Shopware UI - Order list backend module
 *
 * The order list view displays the data of the list store.
 * One row displays the head data of a order.
 */
//
Ext.define('Shopware.apps.Order.view.batch.List', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend:'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
    */
    alias:'widget.batch-list',

    /**
     * Set css class
     * @string
     */
    cls:Ext.baseCSSPrefix + 'order-batch-grid',

    minHeight: 150,
    /**
     * This configuration option is to be applied to child items of the container managed by this layout.
     * Each child item with a flex property will be flexed horizontally according to each item's relative
     * flex value compared to the sum of all items with a flex value specified. Any child items that have either
     * a flex = 0 or flex = undefined will not be 'flexed' (the initial size will not be changed).
     */
    flex: 1,

    /**
     * True to use overflow:'auto' on the components layout element and show scroll
     * bars automatically when necessary, false to clip any overflowing content.
     * @string
     */
    autoScroll:true,

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'number','default'=>'Order number','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'number','default'=>'Order number','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'number','default'=>'Order number','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        columns: {
            number:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'number','default'=>'Order number','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'number','default'=>'Order number','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'number','default'=>'Order number','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            customer:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'customer','default'=>'Customer','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'customer','default'=>'Customer','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'customer','default'=>'Customer','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            orderStatus:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'order_status','default'=>'Order Status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'order_status','default'=>'Order Status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Current order status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'order_status','default'=>'Order Status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            paymentStatus:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'payment_status','default'=>'Payment Status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'payment_status','default'=>'Payment Status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Current payment status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'payment_status','default'=>'Payment Status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            sent:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'email_sent','default'=>'Email has been sent','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'email_sent','default'=>'Email has been sent','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Email has been sent<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'email_sent','default'=>'Email has been sent','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            orderTime:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'order_time','default'=>'Order time','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'order_time','default'=>'Order time','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order time/date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'order_time','default'=>'Order time','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            mailGenerated: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'mail_generated','default'=>'Mail has been generated','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'mail_generated','default'=>'Mail has been generated','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Mail has been generated<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'mail_generated','default'=>'Mail has been generated','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
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
    initComponent:function () {
        var me = this;

        me.columns = me.getColumns();
        me.callParent(arguments);
    },

    /**
     * Returns an array for the grid columns.
     * @return array
     */
    getColumns: function() {
        var me = this;

        return [
            {
                header: me.snippets.columns.number,
                dataIndex: 'number',
                flex:1
            },
            {
                header: me.snippets.columns.orderTime,
                xtype: 'datecolumn',
                dataIndex: 'orderTime',
                flex:1
            },
            {
                header: me.snippets.columns.orderStatus,
                dataIndex: 'orderStatus',
                flex:1,
                renderer: me.orderStatusColumn
            },
            {
                header: me.snippets.columns.paymentStatus,
                dataIndex: 'paymentStatus',
                flex:1,
                renderer: me.paymentStatusColumn
            },
            {
                xtype: 'booleancolumn',
                header: me.snippets.columns.mailGenerated,
                dataIndex: 'mailGenerated',
                flex:1,
                renderer: me.mailColumn
            },
            {
                xtype: 'booleancolumn',
                header: me.snippets.columns.sent,
                dataIndex: 'sent',
                flex:1,
                renderer: me.sentColumn
            }
        ]
    },

    /**
     * Column renderer function for the mail column.
     *
     * @param { boolean } value
     * @param { Object } metaData
     * @param { Ext.data.Model } record
     * @return string
     */
    mailColumn: function(value, metaData, record) {
        var me = this,
            checked = 'sprite-ui-check-box-uncheck',
            mail = record.getMail().first();

        if (mail instanceof Ext.data.Model) {
            checked = 'sprite-ui-check-box';
        }
        return '<span style="display:block; margin: 0 auto; height:16px; width:16px;" class="' + checked + '"></span>';
    },

    /**
     * Column renderer function for the sent column
     *
     * @param { boolean } value
     * @param { Object } metaData
     * @param { Ext.data.Model } record
     * @return string
     */
    sentColumn: function(value, metaData, record) {
        var me = this,
            checked = 'sprite-ui-check-box-uncheck',
            mail = record.getMail().first();

        if (mail) {
            checked = 'sprite-ui-check-box';
        }
        return '<span style="display:block; margin: 0 auto; height:16px; width:16px;" class="' + checked + '"></span>';
    },

    /**
     * Column renderer function for the payment column of the list grid.
     * @param [string] value    - The field value
     * @param [string] metaData - The model meta data
     * @param [string] record   - The whole data model
     * return string
     */
    orderStatusColumn: function(value, metaData, record) {
        var orderStatus = record.getOrderStatus().first();

        if (orderStatus instanceof Ext.data.Model) {
            return orderStatus.get('description');
        } else {
            return value;
        }
    },

    /**
     * Column renderer function for the payment column of the list grid.
     * @param [string] value    - The field value
     * @param [string] metaData - The model meta data
     * @param [string] record   - The whole data model
     * @return string
     */
    paymentStatusColumn: function(value, metaData, record) {
        var paymentStatus = null;

        if (record && record.getPaymentStatus() instanceof Ext.data.Store && record.getPaymentStatus().first() instanceof Ext.data.Model) {
            paymentStatus = record.getPaymentStatus().first();
        }

        if (paymentStatus instanceof Ext.data.Model) {
            return paymentStatus.get('description');
        } else {
            return value;
        }
    }

});
//

<?php }} ?>