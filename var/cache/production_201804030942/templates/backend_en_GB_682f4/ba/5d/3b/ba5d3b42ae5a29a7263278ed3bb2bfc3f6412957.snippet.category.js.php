<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:38
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\category.js" */ ?>
<?php /*%%SmartyHeaderCode:178995acd97de21b0b2-34117085%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba5d3b42ae5a29a7263278ed3bb2bfc3f6412957' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\category.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178995acd97de21b0b2-34117085',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97de246d21_86797861',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97de246d21_86797861')) {function content_5acd97de246d21_86797861($_smarty_tpl) {?>/**
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
 * The category model represents a data row of the s_categories or the
 * Shopware\Models\Category\Category doctrine model.
 */
//
Ext.define('Shopware.apps.Base.model.Category', {

    /**
     * Defines an alternate name for this class.
     */
    alternateClassName: 'Shopware.model.Category',

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend:'Shopware.data.Model',

    /**
     * unique id
     * @int
     */
    idProperty:'id',

    /**
     * The fields used for this model
     * @array
     */
    fields:[
        //
        { name : 'id', type:'int' },
        { name : 'parent', type:'int' },
        { name : 'name', type:'string' },
        { name : 'position', type:'int' },
        { name : 'active', type:'boolean', defaultValue: true },
        { name : 'childrenCount', type: 'int' },

        // Some tree fields
        { name : 'text', type: 'string' },
        { name : 'cls', type: 'string' },
        { name : 'leaf', type: 'boolean' },
        { name : 'allowDrag', type: 'boolean' }
    ]
});
//


<?php }} ?>