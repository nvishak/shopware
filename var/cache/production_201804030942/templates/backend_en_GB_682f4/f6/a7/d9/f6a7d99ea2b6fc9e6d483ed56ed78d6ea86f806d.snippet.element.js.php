<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:39
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\element.js" */ ?>
<?php /*%%SmartyHeaderCode:259975acd97df109ba5-52234483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6a7d99ea2b6fc9e6d483ed56ed78d6ea86f806d' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\element.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '259975acd97df109ba5-52234483',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97df138267_45869543',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97df138267_45869543')) {function content_5acd97df138267_45869543($_smarty_tpl) {?>/**
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
 * @package    Shopware_Base
 * @subpackage Config
 * @version    $Id$
 * @author shopware AG
 */
//
Ext.define('Shopware.apps.Base.model.Element', {

    extend: 'Ext.data.Model',

    alternateClassName: 'Shopware.model.Element',

    fields: [
        //
        { name: 'id', type: 'int', useNull: true },
        { name: 'name', type: 'string' },
        { name: 'value' },
        { name: 'label', type: 'string' },
        { name: 'description', type: 'string', useNull: true },
        { name: 'type', type: 'string', useNull: true },
        { name: 'required', type: 'boolean' },
        { name: 'scope', type: 'int' },
        'options'
    ],

    associations: [{
        type: 'hasMany',
        model: 'Shopware.apps.Base.model.Value',
        name: 'getValues',
        associationKey: 'values'
    }]
});
//
<?php }} ?>