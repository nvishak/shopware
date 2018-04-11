<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:34
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\store\preview.js" */ ?>
<?php /*%%SmartyHeaderCode:8395acda8f6424658-64894972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ddcce3e06bfc130a79270d337effbe88e069fad' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\store\\preview.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8395acda8f6424658-64894972',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f6436505_23614527',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f6436505_23614527')) {function content_5acda8f6436505_23614527($_smarty_tpl) {?>/**
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
 * @subpackage Store
 * @version    $Id$
 * @author shopware AG
 */

// 
// 
Ext.define('Shopware.apps.Customer.store.Preview', {
    extend: 'Ext.data.Store',
    model: 'Shopware.model.Dynamic',
    pageSize: 20,
    remoteSort: true,
    remoteFilter: true,

    proxy: {
        type: 'ajax',
        api: {
            read: '<?php echo '/shopware4/backend/CustomerStream/loadStream';?>'
        },
        reader: Ext.create('Shopware.model.DynamicReader')
    }
});
// 
<?php }} ?>