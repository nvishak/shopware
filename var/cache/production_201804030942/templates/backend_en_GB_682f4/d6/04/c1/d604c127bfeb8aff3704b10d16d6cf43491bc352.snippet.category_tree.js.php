<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:16
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\category_tree.js" */ ?>
<?php /*%%SmartyHeaderCode:275895acda8e4abac45-29226456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd604c127bfeb8aff3704b10d16d6cf43491bc352' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\category_tree.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '275895acda8e4abac45-29226456',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e4ac68d3_57950452',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e4ac68d3_57950452')) {function content_5acda8e4ac68d3_57950452($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Base.store.CategoryTree', {

    /**
     * Defines an alternate name for this class.
     */
    alternateClassName: 'Shopware.store.CategoryTree',

    /**
     * Define that this component is an extension of the Ext.data.TreeStore
     */
    extend : 'Ext.data.TreeStore',

    /**
     * Define unique store id to create the store by the store manager
     */
    storeId: 'base.CategoryTree',

    /**
     * Auto load the store after the component
     * is initialized
     * @boolean
     */
    autoLoad: false,

    /**
     * Define the used model for this store
     * @string
     */
    model : 'Shopware.apps.Base.model.Category',

    /**
     * Configure the data communication
     * @object
     */
    proxy : {
        type : 'ajax',

        /**
         * Configure the url mapping for the different
         * store operations based on
         * @object
         */
        api : {
            read : '<?php echo '/shopware4/backend/category/getList';?>'
        },

        /**
         * Configure the data reader
         * @object
         */
        reader : {
            type : 'json',
            root: 'data'
        }
    }
}).create();

<?php }} ?>