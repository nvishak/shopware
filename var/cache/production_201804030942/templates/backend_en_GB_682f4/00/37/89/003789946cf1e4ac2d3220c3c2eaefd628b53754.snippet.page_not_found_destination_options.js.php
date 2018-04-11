<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:17
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\page_not_found_destination_options.js" */ ?>
<?php /*%%SmartyHeaderCode:229635acda8e572cd63-63147668%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '003789946cf1e4ac2d3220c3c2eaefd628b53754' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\page_not_found_destination_options.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '229635acda8e572cd63-63147668',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e573d178_96618040',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e573d178_96618040')) {function content_5acda8e573d178_96618040($_smarty_tpl) {?>/**
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
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Store - Page Not Found Destination Options
 */
//
Ext.define('Shopware.apps.Base.store.PageNotFoundDestinationOptions', {
    extend:'Ext.data.Store',

    alternateClassName: 'Shopware.store.PageNotFoundDestinationOptions',
    model:'Shopware.apps.Base.model.PageNotFoundDestinationOptions',
    storeId: 'base.PageNotFoundDestinationOptions',

    /**
     * Enable remote filtering
     */
    remoteFilter: true,

    proxy:{
        type:'ajax',
        url:'<?php echo '/shopware4/backend/base/getPageNotFoundDestinationOptions';?>',
        reader:{
            type:'json',
            root:'data',
            totalProperty:'total'
        }
    }
}).create();
//

<?php }} ?>