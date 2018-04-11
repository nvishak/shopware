<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:46
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\custom_facet.js" */ ?>
<?php /*%%SmartyHeaderCode:230925acd97e6147f75-94954211%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b61db31e1ae03a70e6adc05db61fe8aba531b66d' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\custom_facet.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230925acd97e6147f75-94954211',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e6173d04_45226429',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e6173d04_45226429')) {function content_5acd97e6173d04_45226429($_smarty_tpl) {?>/**
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
 */

//

Ext.define('Shopware.apps.Base.model.CustomFacet', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'CustomFacet'
        };
    },

    fields: [
        { name: 'id', type: 'int' },
        { name: 'name', type: 'string' },
        { name: 'active', type: 'boolean' },
        { name: 'displayInCategories', type: 'boolean' },
        { name: 'deletable', type: 'boolean', defaultValue: true },
        { name: 'position', type: 'int' },
        { name: 'facet', type: 'string' }
    ]
});

//
<?php }} ?>