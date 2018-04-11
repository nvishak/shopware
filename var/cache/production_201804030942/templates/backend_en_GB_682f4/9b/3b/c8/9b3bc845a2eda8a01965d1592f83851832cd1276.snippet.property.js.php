<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:36
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\store\property.js" */ ?>
<?php /*%%SmartyHeaderCode:128905acda8f8120ff7-17502510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b3bc845a2eda8a01965d1592f83851832cd1276' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\store\\property.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128905acda8f8120ff7-17502510',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f8135cf4_20691910',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f8135cf4_20691910')) {function content_5acda8f8135cf4_20691910($_smarty_tpl) {?>/**
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
 * @package    Article
 * @subpackage Batch
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Store - Article Module
 */
//
Ext.define('Shopware.apps.Article.store.Property', {
    extend: 'Ext.data.Store',
    alias: 'widget.article-store-property',
    model: 'Shopware.apps.Article.model.Property',
    batch: true,
    autoLoad: false,
    proxy: {
        type: 'ajax',
        api: {
            read: '<?php echo '/shopware4/backend/Article/getPropertyList';?>',
            update: '<?php echo '/shopware4/backend/Article/setPropertyList/targetField/properties';?>'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//
<?php }} ?>