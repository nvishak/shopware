<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:16
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\supplier.js" */ ?>
<?php /*%%SmartyHeaderCode:200935acda8e4d9cef0-71515156%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '974565d59ecaa9fc8c6164d4f7d9a137b0950134' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\supplier.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200935acda8e4d9cef0-71515156',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e4da7570_89667715',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e4da7570_89667715')) {function content_5acda8e4da7570_89667715($_smarty_tpl) {?>/**
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
 * @package    Base
 * @subpackage Store
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Store - Global Stores and Models
 *
 * todo@all: Documentation
 */
Ext.define('Shopware.apps.Base.store.Supplier', {

    /**
     * Defines an alternate name for this class.
     */
    alternateClassName: 'Shopware.store.Supplier',

    /**
     * Define that this component is an extension of the Ext.data.Store
     */
    extend: 'Ext.data.Store',

    /**
     * Define unique store id to create the store by the store manager
     */
    storeId: 'base.Supplier',

   /**
    * Auto load the store after the component
    * is initialized
    * @boolean
    */
    autoLoad: false,

    /**
     * Enable remote sorting
     */
    remoteSort: true,

    /**
     * Enable remote filtering
     */
    remoteFilter: true,

   /**
    * Define the used model for this store
    * @string
    */
    model : 'Shopware.apps.Base.model.Supplier',

   /**
    * Configure the data communication
    * @object
    */
    proxy: {
        type: 'ajax',

       /**
        * Configure the url mapping for the different
        * store operations based on
        * @object
        */
        url: '<?php echo '/shopware4/backend/base/getSuppliers';?>',

       /**
        * Configure the data reader
        * @object
        */
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        }
    }
}).create();

<?php }} ?>