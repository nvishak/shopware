<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:27
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\app.js" */ ?>
<?php /*%%SmartyHeaderCode:218025acda8ef782f32-53597435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f160936620c729ac184e237576febdfcad3ec4b' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\app.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '218025acda8ef782f32-53597435',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ef7c91a9_23334461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ef7c91a9_23334461')) {function content_5acda8ef7c91a9_23334461($_smarty_tpl) {?>/**
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
 * @subpackage App
 * @version    $Id$
 * @author shopware AG
 */

// 

/**
 * Shopware Application - Customer list backend module
 *
 * Contains the configuration for the customer list backend module.
 * This component defines which controllers belong to the application or whether the bulk loading is activated.
 */
// 
Ext.define('Shopware.apps.Customer', {

    /**
     * The name of the module. Used for internal purpose
     * @string
     */
    name: 'Shopware.apps.Customer',

    /**
     * Extends from our special controller, which handles the sub-application behavior and the event bus
     * @string
     */
    extend: 'Enlight.app.SubApplication',

    /**
     * Enable bulk loading
     * @boolean
     */
    bulkLoad: true,

    /**
     * Sets the loading path for the sub-application.
     *
     * @string
     */
    loadPath: '<?php echo '/shopware4/backend/customer/load';?>',

    /**
     * Requires controllers for sub-application
     * @array
     */
    controllers: [ 'Detail', 'Order', 'Main', 'Stream' ],

    /**
     * The detail controller knows all form field sets and the detail window component
     * @array
     */
    views: [

        'main.QuickView',
        'main.StreamView',
        'main.CustomerList',
        'main.CustomerListFilter',
        'main.Window',
        'main.Wizard',

        'detail.Window',
        'detail.Base',
        'detail.Debit',
        'detail.Comment',
        'detail.Additional',
        'order.List',
        'order.Chart',
        'address.List',
        'address.detail.Window',
        'address.detail.Address',

        'chart.AmountChartFactory',
        'chart.Chart',
        'chart.MetaChart',

        'customer_stream.Detail',
        'customer_stream.Listing',
        'customer_stream.Preview',
        'customer_stream.ConditionPanel',
        'customer_stream.Assignment',
        'customer_stream.ConditionField',
        'customer_stream.conditions.AgeCondition',
        'customer_stream.conditions.HasAddressWithCountryCondition',
        'customer_stream.conditions.HasCanceledOrdersCondition',
        'customer_stream.conditions.HasNewsletterRegistrationCondition',
        'customer_stream.conditions.IsCustomerSinceCondition',
        'customer_stream.conditions.IsInCustomerGroupCondition',
        'customer_stream.conditions.HasOrderCountCondition',
        'customer_stream.conditions.OrderedAtWeekdayCondition',
        'customer_stream.conditions.OrderedInLastDaysCondition',
        'customer_stream.conditions.OrderedInShopCondition',
        'customer_stream.conditions.RegisteredInShopCondition',
        'customer_stream.conditions.OrderedOnDeviceCondition',
        'customer_stream.conditions.OrderedProductCondition',
        'customer_stream.conditions.OrderedProductOfCategoryCondition',
        'customer_stream.conditions.OrderedProductOfManufacturerCondition',
        'customer_stream.conditions.OrderedWithDeliveryCondition',
        'customer_stream.conditions.OrderedWithPaymentCondition',
        'customer_stream.conditions.HasTotalOrderAmountCondition',
        'customer_stream.conditions.CustomerAttributeCondition',
        'customer_stream.conditions.SalutationCondition',
        'customer_stream.conditions.SearchTermCondition',
        'customer_stream.conditions.field.AttributeValue',
        'customer_stream.conditions.field.AttributeWindow',
        'customer_stream.conditions.field.OperatorField'
    ],

    /**
     * All required stores are defined here. The detail store contains all data around the customer.
     * The other shops are global stores which used for combo boxes.
     * @array
     */
    stores: [ 'Detail', 'Orders', 'Chart', 'Batch', 'Address', 'QuickView', 'Preview', 'CustomerStream' ],

    /**
     * All store's required models. The detail store handles the base, billing, shipping and debit model.
     * @array
     */
    models: [ 'Customer', 'Billing', 'Shipping', 'Debit', 'PaymentData', 'Order', 'Chart', 'Batch', 'Address', 'QuickView', 'CustomerStream' ],

    /**
     * Returns the main application window for this is expected
     * by the Enlight.app.SubApplication class.
     * The class sets a new event listener on the "destroy" event of
     * the main application window to perform the destroying of the
     * whole sub application when the user closes the main application window.
     *
     * This method will be called when all dependencies are solved and
     * all member controllers, models, views and stores are initialized.
     *
     * @private
     * @return [object] mainWindow - the main application window based on Enlight.app.Window
     */
    launch: function() {
        var me = this,
            mainController = me.getController('Main');

        me.currencySign = '<?php echo $_smarty_tpl->tpl_vars['currency']->value['sign'];?>
';
        me.currencyAtEnd = '<?php echo $_smarty_tpl->tpl_vars['currency']->value['currencyAtEnd'];?>
';

        return mainController.mainWindow;
    }
});
// 
<?php }} ?>