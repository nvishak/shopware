<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:38
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\variant.js" */ ?>
<?php /*%%SmartyHeaderCode:18915acd97de6776f9-44500800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b41a3f3f4ec07e111b95a718db6060158e7ec3c8' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\variant.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18915acd97de6776f9-44500800',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97de6a1459_85347715',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97de6a1459_85347715')) {function content_5acd97de6a1459_85347715($_smarty_tpl) {?>/**
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
 * @subpackage Model
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Model - Global Stores and Models
 *
 * The article_with_variants model is based on the article model. This model is able to hold article variants.
 */
//
Ext.define('Shopware.apps.Base.model.Variant', {
    /**
     * Extends the standard Ext Model
     * @string
     */
    extend:'Shopware.data.Model',

    /**
     * The fields used for this model
     * @array
     */
    fields: [
        { name: 'id', type: 'int' },
        { name: 'name', type: 'string' },
        { name: 'articleId', type: 'int' },
        { name: 'additionalText', type: 'string' },
        { name: 'supplierName', type: 'string'},
        { name: 'supplierId', type: 'int' },
        { name: 'ordernumber', type: 'string' },
        { name: 'inStock', type: 'string' },
        { name: 'active', type: 'int' },


        //mapping fields for ExtJS
        { name: 'number', type: 'string', mapping: 'ordernumber' },
    ]
});
//

<?php }} ?>