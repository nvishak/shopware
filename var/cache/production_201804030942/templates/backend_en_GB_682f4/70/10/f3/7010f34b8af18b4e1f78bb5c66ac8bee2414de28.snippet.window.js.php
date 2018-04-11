<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\view\detail\window.js" */ ?>
<?php /*%%SmartyHeaderCode:237075acda8f1766665-19768869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7010f34b8af18b4e1f78bb5c66ac8bee2414de28' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\view\\detail\\window.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '237075acda8f1766665-19768869',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f17bf1c5_49011921',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f17bf1c5_49011921')) {function content_5acda8f17bf1c5_49011921($_smarty_tpl) {?>/**
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
 * Shopware UI - Order list main window.
 *
 * todo@all: Documentation
 */
//
Ext.define('Shopware.apps.Order.view.detail.Window', {
    /**
     * Define that the order main window is an extension of the enlight application window
     * @string
     */
    extend:'Enlight.app.Window',
    /**
     * Set base css class prefix and module individual css class for css styling
     * @string
     */
    cls:Ext.baseCSSPrefix + 'order-detail-window',
    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias:'widget.order-detail-window',
    /**
     * Set no border for the window
     * @boolean
     */
    border:false,
    /**
     * True to automatically show the component upon creation.
     * @boolean
     */
    autoShow:true,
    /**
     * Set fit layout for the window
     * @string
     */
    layout:'fit',
    /**
     * Define window width
     * @integer
     */
    width:900,
    /**
     * Define window height
     * @integer
     */
    height:'90%',
    /**
     * A flag which causes the object to attempt to restore the state of internal properties from a saved state on startup.
     */
    stateful:true,
    /**
     * The unique id for this object to use for state management purposes.
     */
    stateId:'shopware-order-detail-window',
    /**
     * Contains all snippets for this component
     */
    snippets: {
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tab'/'title','default'=>'Order details:','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'title','default'=>'Order details:','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Order details:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'title','default'=>'Order details:','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        overview: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tab'/'overview','default'=>'Overview','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'overview','default'=>'Overview','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Overview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'overview','default'=>'Overview','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        details: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tab'/'details','default'=>'Details','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'details','default'=>'Details','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Details<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'details','default'=>'Details','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        communication: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tab'/'communication','default'=>'Communication','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'communication','default'=>'Communication','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Communication<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'communication','default'=>'Communication','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        document: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tab'/'document','default'=>'Documents','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'document','default'=>'Documents','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Documents<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'document','default'=>'Documents','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        position: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tab'/'position','default'=>'Positions','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'position','default'=>'Positions','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Positions<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'position','default'=>'Positions','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        history: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'tab'/'history','default'=>'Status history','namespace'=>'backend/order/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'history','default'=>'Status history','namespace'=>'backend/order/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Status history<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'tab'/'history','default'=>'Status history','namespace'=>'backend/order/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
    initComponent:function () {
        var me = this;

        //add the order list grid panel and set the store
        me.items = [ me.createTabPanel() ];
        me.title = me.snippets.title + ' ' + me.record.get('number');
        me.callParent(arguments);
    },

    /**
     * Creates the tab panel for the detail page.
     * @return Ext.tab.Panel
     */
    createTabPanel: function() {
        var me = this;

        return Ext.create('Ext.tab.Panel', {
            name: 'main-tab',
            items: [
                Ext.create('Shopware.apps.Order.view.detail.Overview', {
                    title: me.snippets.overview,
                    record: me.record,
                    orderStatusStore: me.orderStatusStore,
                    paymentStatusStore:  me.paymentStatusStore
                }), Ext.create('Shopware.apps.Order.view.detail.Detail',{
                    title: me.snippets.details,
                    record: me.record,
                    paymentsStore: me.paymentsStore,
                    dispatchesStore: me.dispatchesStore,
                    shopsStore: me.shopsStore,
                    countriesStore: me.countriesStore
                }), Ext.create('Shopware.apps.Order.view.detail.Communication',{
                    title: me.snippets.communication,
                    record: me.record
                }), Ext.create('Shopware.apps.Order.view.detail.Position', {
                    title: me.snippets.position,
                    record: me.record,
                    taxStore: me.taxStore,
                    statusStore: me.statusStore
                }), Ext.create('Shopware.apps.Order.view.detail.Document',{
                    record: me.record,
                    documentTypesStore: me.documentTypesStore
                }), Ext.create('Shopware.apps.Order.view.detail.OrderHistory', {
                    title: me.snippets.history,
                    historyStore: me.historyStore,
                    record: me.record,
                    orderStatusStore: me.orderStatusStore,
                    paymentStatusStore:  me.paymentStatusStore
                })
            ]
        });
    }
});
//
<?php }} ?>