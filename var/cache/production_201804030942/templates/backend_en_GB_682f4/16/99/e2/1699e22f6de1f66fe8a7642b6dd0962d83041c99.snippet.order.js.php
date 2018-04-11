<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\model\order.js" */ ?>
<?php /*%%SmartyHeaderCode:293555acda8f09cce50-72011346%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1699e22f6de1f66fe8a7642b6dd0962d83041c99' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\model\\order.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '293555acda8f09cce50-72011346',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f0a45759_13986628',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f0a45759_13986628')) {function content_5acda8f0a45759_13986628($_smarty_tpl) {?>/**
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
 * @subpackage Model
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Model - Order list backend module.
 *
 * todo@all: Documentation
 */
//
Ext.define('Shopware.apps.Order.model.Order', {

    /**
    * Extends the standard Ext Model
    * @string
    */
    extend: 'Ext.data.Model',

    /**
    * The fields used for this model
    * @array
    */
    fields: [
        //
        { name : 'id', type: 'int' },
        { name : 'number', type: 'string' },
        { name : 'customerId', type: 'int' },
        { name : 'customerEmail', type: 'string'},
        { name : 'invoiceAmountNet', type: 'float' },
        { name : 'invoiceShippingNet', type: 'float' },
        { name : 'status', type: 'int' },
        { name : 'cleared', type: 'int' },
        { name : 'paymentId', type: 'int' },
        { name : 'transactionId', type: 'string' },
        { name : 'comment', type: 'string' },
        { name : 'customerComment', type: 'string' },
        { name : 'internalComment', type: 'string' },
        { name : 'net', type: 'int' },
        { name : 'taxFree', type: 'int' },
        { name : 'partnerId', type: 'string' },
        { name : 'temporaryId', type: 'string' },
        { name : 'referer', type: 'string' },
        { name : 'clearedDate', type: 'date', dateFormat: 'd.m.Y' },
        { name : 'trackingCode', type: 'string' },
        { name : 'languageIso', type: 'string' },
        { name : 'dispatchId', type: 'int' },
        { name : 'currency', type: 'string' },
        { name : 'currencyFactor', type: 'float' },
        { name : 'shopId', type: 'int' },
        { name : 'remoteAddress', type: 'string' },
        { name : 'deviceType', type: 'string' },
        {
            name : 'deviceTypeHuman',
            type: 'string',
            convert: function(value, record) {
                var deviceType = record.get('deviceType');

                if (deviceType.length) {
                    return deviceType.charAt(0).toUpperCase() + deviceType.slice(1);
                } else {
                    return deviceType;
                }
            }
        },
        { name : 'referer', type: 'string' },
        { name : 'partnerId', type: 'string' },
        { name : 'invoiceAmount', type: 'float' },
        { name : 'invoiceShipping', type: 'float' },
        { name : 'orderTime', type: 'date' },
        {
            name : 'invoiceShippingEuro',
            type: 'float',
            convert: function(value, record) {
                var factor = record.get('currencyFactor');
                if (!Ext.isNumeric(factor)) {
                    factor = 1;
                }
                return Ext.util.Format.round(record.get('invoiceShipping') / factor, 2);
            }
        },
        {
            name : 'invoiceAmountEuro',
            type: 'float',
            convert: function(value, record) {
                var factor = record.get('currencyFactor');
                if (!Ext.isNumeric(factor)) {
                    factor = 1;
                }
                return Ext.util.Format.round(record.get('invoiceAmount') / factor, 2);
            }
        },
        {
            name : 'remoteAddressConverted',
            type: 'string',
            /**
             * Used the convert function because the displayfield don't give an options
             * to format the data.
             * @param value
             */
            convert: function(value, record){
                if (Ext.isString(record.get('remoteAddress'))) {
                    return record.get('remoteAddress').substring(0, record.get('remoteAddress').lastIndexOf('.')) + '.xxx';
                } else {
                    return value;
                }
            }
        }
    ],

    /**
    * Configure the data communication
    * @object
    */
    proxy: {
        /**
         * Set proxy type to ajax
         * @string
         */
        type: 'ajax',

        /**
         * Specific urls to call on CRUD action methods "create", "read", "update" and "destroy".
         * @object
         */
        api: {
            read:'<?php echo '/shopware4/backend/Order/getList';?>',
            create: '<?php echo '/shopware4/backend/Order/save';?>',
            update: '<?php echo '/shopware4/backend/Order/save';?>',
            destroy:'<?php echo '/shopware4/backend/Order/delete';?>'
        },

        /**
         * The Ext.data.reader.Reader to use to decode the server's
         * response or data read from client. This can either be a Reader instance,
         * a config object or just a valid Reader type name (e.g. 'json', 'xml').
         * @object
         */
        reader: {
            type: 'json',
            root: 'data'
        }
    },

    /**
     * Define the associations of the order model.
     * One order has a customer, many details, billing- & shipping address and a payment information.
     * @array
     */
    associations:[
        { type:'hasMany', model:'Shopware.apps.Base.model.Customer', name:'getCustomer', associationKey:'customer' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Debit', name:'getDebit', associationKey:'debit' },
        { type:'hasMany', model:'Shopware.apps.Order.model.PaymentInstance', name:'getPaymentInstances', associationKey:'paymentInstances' },
        { type:'hasMany', model:'Shopware.apps.Base.model.Shop', name:'getShop', associationKey:'shop' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Dispatch', name:'getDispatch', associationKey:'dispatch' },
        { type:'hasMany', model:'Shopware.apps.Base.model.PaymentStatus', name:'getPaymentStatus', associationKey:'paymentStatus' },
        { type:'hasMany', model:'Shopware.apps.Base.model.OrderStatus', name:'getOrderStatus', associationKey:'orderStatus' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Billing', name:'getBilling', associationKey:'billing' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Shipping', name:'getShipping', associationKey:'shipping' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Payment', name:'getPayment', associationKey:'payment' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Receipt', name:'getReceipt', associationKey:'documents' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Mail', name:'getMail', associationKey:'mail' },
        { type:'hasMany', model:'Shopware.apps.Order.model.Position', name:'getPositions', associationKey:'details' },
        { type:'hasMany', model:'Shopware.apps.Base.model.Locale', name:'getLocale', associationKey:'locale' }
    ]

});
//

<?php }} ?>