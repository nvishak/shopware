<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\order\model\voucher.js" */ ?>
<?php /*%%SmartyHeaderCode:44345acda8f107f730-47464182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '691471ce18a054b4930082075b07927ddeb252f4' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\order\\model\\voucher.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44345acda8f107f730-47464182',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f109e931_02131020',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f109e931_02131020')) {function content_5acda8f109e931_02131020($_smarty_tpl) {?>/**
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
 * The document model contains the configuration for the document creation. It
 * will be used in the order detail page document tab and in the detail controller.
 */
//
Ext.define('Shopware.apps.Order.model.Voucher', {

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend:'Ext.data.Model',
    /**
     * The fields used for this model
     * @array
     */
    fields:[
        //
        { name: 'id', type:'int' },
        { name: 'description', type:'string' },
        { name: 'voucherCode', type:'string' },
        { name: 'value', type:'float' },
        { name: 'minimumCharge', type:'float' },
        {
            name: 'display',
            type:'string',
            convert: function(value, record) {
                if (!Ext.isNumeric(record.get('value'))) {
                    return record.get('description');
                }
                return record.get('description') + ' (' + Ext.util.Format.currency(record.get('value')) + ')';

            }
        }

    ],

    /**
     * Configure the data communication
     * @object
     */
    proxy:{
        /**
         * Set proxy type to ajax
         * @string
         */
        type:'ajax',

        /**
         * Specific urls to call on CRUD action methods "create", "read", "update" and "destroy".
         * @object
         */
        api:{
            read:'<?php echo '/shopware4/backend/Order/getVouchers';?>'
        },

        /**
         * The Ext.data.reader.Reader to use to decode the server's
         * response or data read from client. This can either be a Reader instance,
         * a config object or just a valid Reader type name (e.g. 'json', 'xml').
         * @object
         */
        reader:{
            type:'json',
            root:'data'
        }
    }
});
//
<?php }} ?>