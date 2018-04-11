<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:42
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\element\boolean_select.js" */ ?>
<?php /*%%SmartyHeaderCode:285065acd97e259d496-38379821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7a1352c70df3cece22b4f0619972062bf98c1c1' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\element\\boolean_select.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285065acd97e259d496-38379821',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e25bd209_25315532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e25bd209_25315532')) {function content_5acd97e25bd209_25315532($_smarty_tpl) {?>/**
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

/**
 * config element used to replace the checkbox to a combobox
 * This is necessary because checkboxes have only two states,
 * but we need a third state as a fallback to the default shop value
 */

//

//
Ext.define('Shopware.apps.Base.view.element.BooleanSelect', {
    extend:'Ext.form.field.ComboBox',
    alias:[
        'widget.base-element-boolean-select'
    ],

    queryMode: 'local',
    forceSelection: true,
    editable: false,

    store: [
        ["", 'Inherited'],
        [true, 'Yes'],
        [false, 'No']
    ]
});
//
<?php }} ?>