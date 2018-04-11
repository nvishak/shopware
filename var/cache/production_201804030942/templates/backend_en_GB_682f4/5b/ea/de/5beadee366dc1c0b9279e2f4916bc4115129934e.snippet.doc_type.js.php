<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:39
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\doc_type.js" */ ?>
<?php /*%%SmartyHeaderCode:246605acd97df91f7c6-38269664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5beadee366dc1c0b9279e2f4916bc4115129934e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\doc_type.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '246605acd97df91f7c6-38269664',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97df937de2_75592194',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97df937de2_75592194')) {function content_5acd97df937de2_75592194($_smarty_tpl) {?>/**
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
 * The base store for document types.
 */
Ext.define('Shopware.apps.Base.store.DocType', {
    extend: 'Ext.data.Store',

    alternateClassName: 'Shopware.store.DocType',
    storeId: 'base.DocType',
    model : 'Shopware.apps.Base.model.DocType',
    pageSize: 1000,
    remoteFilter: true,

    proxy:{
        type:'ajax',
        url:'<?php echo '/shopware4/backend/base/getDocTypes';?>',
        reader:{
            type: 'json',
            root: 'data',
            totalProperty: 'total'
        }
    }
}).create();

<?php }} ?>