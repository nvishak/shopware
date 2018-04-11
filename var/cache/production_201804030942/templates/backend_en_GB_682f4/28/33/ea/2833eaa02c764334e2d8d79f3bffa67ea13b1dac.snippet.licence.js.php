<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:40
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\model\licence.js" */ ?>
<?php /*%%SmartyHeaderCode:50335acda8fca6aff9-19594927%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2833eaa02c764334e2d8d79f3bffa67ea13b1dac' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\model\\licence.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50335acda8fca6aff9-19594927',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fca818d6_70686117',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fca818d6_70686117')) {function content_5acda8fca818d6_70686117($_smarty_tpl) {?>/**
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
 * @package    PluginManager
 * @subpackage Model
 * @version    $Id$
 * @author shopware AG
 */

//
Ext.define('Shopware.apps.PluginManager.model.Licence', {
    extend: 'Ext.data.Model',

    fields: [
        { name: 'id', type: 'int' },
        { name: 'label', type: 'string' },
        { name: 'technicalName', type: 'string' },
        { name: 'iconPath', type: 'string' },
        { name: 'shop', type: 'string' },
        { name: 'subscription', type: 'string' },
        { name: 'creationDate', type: 'datetime' },
        { name: 'expirationDate', type: 'datetime' },
        { name: 'licenseKey', type: 'string' },
        { name: 'isLicenseCheckEnabled', type: 'boolean', defaultValue: false, persist: false},
        { name: 'binaryLink', type: 'string' },
        { name: 'binaryVersion', type: 'string' },

        { name: 'priceColumn', type: 'string' }
    ],

    associations: [{
        type: 'hasMany',
        model: 'Shopware.apps.PluginManager.model.Price',
        name: 'getPrice',
        associationKey: 'priceModel'
    }]
});
//<?php }} ?>