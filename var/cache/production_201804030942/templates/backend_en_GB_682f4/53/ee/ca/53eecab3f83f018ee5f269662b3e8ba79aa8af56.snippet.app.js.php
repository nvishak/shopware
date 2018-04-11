<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:27
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\app.js" */ ?>
<?php /*%%SmartyHeaderCode:308485acda8ef3bb2d1-30368879%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53eecab3f83f018ee5f269662b3e8ba79aa8af56' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\app.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '308485acda8ef3bb2d1-30368879',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ef3e9610_46732698',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ef3e9610_46732698')) {function content_5acda8ef3e9610_46732698($_smarty_tpl) {?>/**
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
 * @subpackage App
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Application - Order module
 *
 * Contains the configuration for the order backend module.
 * This component defines which controllers belong to the application or whether the bulk loading is activated.
 */
//
Ext.define('Shopware.apps.Order', {

    /**
     * The name of the module. Used for internal purpose
     * @string
     */
    name: 'Shopware.apps.Order',

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
    loadPath: '<?php echo '/shopware4/backend/Order/load';?>',

    /**
     * Array of views to require from AppName.view namespace.
     * @array
     */
    views: [
        'main.Window',
        'detail.Window',
        'detail.Overview',
        'detail.Communication',
        'detail.Position',
        'detail.Document',
        'detail.Detail',
        'detail.Billing',
        'detail.Shipping',
        'detail.Debit',
        'detail.OrderHistory',
        'detail.Configuration',
        'detail.Dispatch',
        'list.Filter',
        'list.List',
        'list.Navigation',
        'list.Position',
        'list.Document',
        'mail.Window',
        'mail.Form',
        'mail.Attachment',
        'batch.Window',
        'batch.Form',
        'batch.List',
        'batch.Progress'
    ],

    /**
     * Array of stores to require from AppName.store namespace.
     * @array
     */
    stores: [
        'OrderHistory',
        'Order',
        'Voucher',
        'DocType',
        'Configuration',
        'Batch',
        'Tax',
        'DetailBatch',
        'ListBatch',
        'DocumentRegistry'
    ],

    /**
     * Array of models to require from AppName.model namespace.
     * @array
     */
    models: [
        'OrderHistory',
        'Order',
        'Billing',
        'Shipping',
        'Tax',
        'Debit',
        'Payment',
        'PaymentInstance',
        'Voucher',
        'Configuration',
        'Receipt',
        'Position',
        'Mail',
        'DetailBatch',
        'ListBatch',
        'Dispatch'
    ],

    /**
     * Requires controllers for sub-application
     * @array
     */
    controllers: [
        'Main',
        'List',
        'Filter',
        'Detail',
        'Batch',
        'Mail',
        'Document',
        'Attachment'
    ],

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

        me.getStore('Tax').load();
        return mainController.mainWindow;
    }
});
//

<?php }} ?>