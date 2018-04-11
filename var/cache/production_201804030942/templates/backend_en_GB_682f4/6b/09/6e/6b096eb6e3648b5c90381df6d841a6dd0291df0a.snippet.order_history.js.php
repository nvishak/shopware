<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\view\detail\order_history.js" */ ?>
<?php /*%%SmartyHeaderCode:287455acda8f310bbb1-53901300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b096eb6e3648b5c90381df6d841a6dd0291df0a' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\view\\detail\\order_history.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '287455acda8f310bbb1-53901300',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f31744a6_16363793',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f31744a6_16363793')) {function content_5acda8f31744a6_16363793($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Order.view.detail.OrderHistory', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend:'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
    */
    alias:'widget.order-history-list',

    /**
     * Set css class
     * @string
     */
    cls:Ext.baseCSSPrefix + 'order-history-grid',

    /**
     * The view needs to be scrollable
     * @string
     */
    autoScroll:true,

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        columns: {
            user: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'user','default'=>'User','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'user','default'=>'User','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
User<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'user','default'=>'User','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            changeDate: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'change_date','default'=>'Change date','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'change_date','default'=>'Change date','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Change date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'change_date','default'=>'Change date','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            previousOrderStatus: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'previous_order_status','default'=>'Previous order status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'previous_order_status','default'=>'Previous order status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Previous order status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'previous_order_status','default'=>'Previous order status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            orderStatus: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'order_status','default'=>'Current order status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'order_status','default'=>'Current order status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Current order status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'order_status','default'=>'Current order status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            previousPaymentStatus: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'previous_payment_status','default'=>'Previous payment status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'previous_payment_status','default'=>'Previous payment status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Previous payment status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'previous_payment_status','default'=>'Previous payment status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            paymentStatus: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'column'/'payment_status','default'=>'Current payment status','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'payment_status','default'=>'Current payment status','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Current payment status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'column'/'payment_status','default'=>'Current payment status','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
        me.columns =  {
            items: me.getColumns(),
            defaults: { flex: 1 }
        }
        me.pagingbar = me.getPagingBar();
        me.store = me.historyStore;
        me.dockedItems = [  me.pagingbar ];
        me.callParent(arguments);
    },

    /**
     * Creates the paging toolbar for the customer grid to allow
     * and store paging. The paging toolbar uses the same store as the Grid
     *
     * @return Ext.toolbar.Paging The paging toolbar for the customer grid
     */
    getPagingBar:function () {
        var me = this;

        return Ext.create('Ext.toolbar.Paging', {
            store: me.historyStore,
            dock:'bottom',
            displayInfo:true
        });

    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns:function () {
        var me = this;

        var columns = [{
            header: me.snippets.columns.user,
            dataIndex: 'user.name',
            renderer: me.userColumn
        }, {
            header: me.snippets.columns.changeDate,
            dataIndex: 'history.changeDate',
            renderer: me.changeDateColumn
        }, {
            header: me.snippets.columns.previousOrderStatus,
            dataIndex: 'prevOrderStatusId',
            renderer: me.prevOrderStatusColumn
        }, {
            header: me.snippets.columns.orderStatus,
            dataIndex: 'currentOrderStatusId',
            renderer: me.currentOrderStatusColumn
        }, {
            header: me.snippets.columns.previousPaymentStatus,
            dataIndex: 'prevPaymentStatusId',
            renderer: me.prevPaymentStatusColumn
        }, {
            header: me.snippets.columns.paymentStatus,
            dataIndex: 'currentPaymentStatusId',
            renderer: me.currentPaymentStatusColumn
        }];

        return columns;
    },

    /**
     * Renderer function of the user column
     * @param value
     * @param metaData
     * @param record
     */
    userColumn: function(value, metaData, record) {
        return record.get('userName');
    },

    /**
     * Renderer function of the changeDate column
     * @param value
     * @param metaData
     * @param record
     */
    changeDateColumn: function(value, metaData, record) {
        if (record.get('changeDate') === Ext.undefined) {
            return record.get('changeDate');
        }
        return Ext.util.Format.date(record.get('changeDate')) + ' ' + Ext.util.Format.date(record.get('changeDate'), 'H:i:s');
    },

    /**
     * Renderer function of the prevOrderStatus column
     * @param value
     * @param metaData
     * @param record
     */
    prevOrderStatusColumn: function(value, metaData, record) {
        var me = this;

        if (me.orderStatusStore) {
            var orderStatus = me.orderStatusStore.getById(value);
            return orderStatus.get('description');
        } else {
            return value;
        }
    },

    /**
     * Renderer function of the currentOrderStatus column
     * @param value
     * @param metaData
     * @param record
     */
    currentOrderStatusColumn: function(value, metaData, record) {
        var me = this;

        if (me.orderStatusStore) {
            var orderStatus = me.orderStatusStore.getById(value);
            return orderStatus.get('description');
        } else {
            return value;
        }
    },

    /**
     * Renderer function of the prevPaymentStatus column
     * @param value
     * @param metaData
     * @param record
     */
    prevPaymentStatusColumn: function(value, metaData, record) {
        var me = this;

        if (me.paymentStatusStore) {
            var paymentStatus = me.paymentStatusStore.getById(value);
            if (paymentStatus) {
                return paymentStatus.get('description');
            } else {
                return value;
            }
        } else {
            return value;
        }
    },

    /**
     * Renderer function of the currentPaymentStatus column
     * @param value
     * @param metaData
     * @param record
     */
    currentPaymentStatusColumn: function(value, metaData, record) {
        var me = this;

        if (me.paymentStatusStore) {
            var paymentStatus = me.paymentStatusStore.getById(value);
            if (paymentStatus) {
                return paymentStatus.get('description');
            } else {
                return value;
            }
        } else {
            return value;
        }
    }

});
//

<?php }} ?>