<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:28
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\model\property_option.js" */ ?>
<?php /*%%SmartyHeaderCode:274175acda8f0693634-03320959%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73e03994732d4b239343bd190622167777e89bd3' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\model\\property_option.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '274175acda8f0693634-03320959',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f06aa469_76899136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f06aa469_76899136')) {function content_5acda8f06aa469_76899136($_smarty_tpl) {?>/**
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
 * @subpackage PropertyValue
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Model - Article backend module.
 *
 * todo@all: Documentation
 */
//
Ext.define('Shopware.apps.Article.model.PropertyOption', {

    /**
    * Extends the standard Ext Model
    * @string
    */
    extend: 'Ext.data.Model',

    /**
     * Fields array which contains the model fields
     * @array
     */
    fields: [
        //
        { name: 'id', type: 'int' },
        { name: 'name', type: 'string' },
        { name: 'propertyValues' }
    ],

    associations: [
        { type:'hasMany', model:'Shopware.apps.Article.model.PropertyValue', name:'getValues', associationKey:'values' }
    ]

});
//

<?php }} ?>