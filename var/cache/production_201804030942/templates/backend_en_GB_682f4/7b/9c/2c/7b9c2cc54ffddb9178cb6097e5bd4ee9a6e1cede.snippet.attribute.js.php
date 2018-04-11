<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\store\attribute.js" */ ?>
<?php /*%%SmartyHeaderCode:24775acda8f2efaeb1-91260155%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b9c2cc54ffddb9178cb6097e5bd4ee9a6e1cede' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\store\\attribute.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24775acda8f2efaeb1-91260155',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f2f0d464_86551920',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f2f0d464_86551920')) {function content_5acda8f2f0d464_86551920($_smarty_tpl) {?>/**
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
 * @package    ProductStream
 * @subpackage Store
 * @version    $Id$
 * @author shopware AG
 */
//
Ext.define('Shopware.apps.ProductStream.store.Attribute', {
    extend:'Ext.data.Store',
    fields: [ 'column', 'label' ],
    autoLoad: false,
    pageSize: 20,
    proxy:{
        type:'ajax',
        url: '<?php echo '/shopware4/backend/ProductStream/getAttributes';?>',
        reader:{
            type:'json',
            root:'data',
            totalProperty:'total'
        }
    }
});
//<?php }} ?>