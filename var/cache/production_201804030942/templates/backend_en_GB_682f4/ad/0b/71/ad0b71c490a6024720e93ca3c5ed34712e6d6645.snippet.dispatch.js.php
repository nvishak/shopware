<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:39
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\dispatch.js" */ ?>
<?php /*%%SmartyHeaderCode:173195acd97df8a4277-05360096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad0b71c490a6024720e93ca3c5ed34712e6d6645' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\dispatch.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173195acd97df8a4277-05360096',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97df8bfce3_23027674',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97df8bfce3_23027674')) {function content_5acd97df8bfce3_23027674($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Base.store.Dispatch', {
    extend: 'Ext.data.Store',

    alternateClassName: 'Shopware.store.Dispatch',
    storeId: 'base.Dispatch',
    model : 'Shopware.apps.Base.model.Dispatch',
    pageSize: 1000,
    remoteFilter: true,
    filters: [{
        property: 'active',
        value: true
    }],

    proxy: {
        type: 'ajax',
        url: '<?php echo '/shopware4/backend/base/getDispatches';?>',
        reader: {
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        }
    }
}).create();
<?php }} ?>