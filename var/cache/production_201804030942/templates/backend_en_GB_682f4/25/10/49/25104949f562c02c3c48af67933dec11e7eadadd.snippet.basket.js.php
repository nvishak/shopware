<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:40
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\model\basket.js" */ ?>
<?php /*%%SmartyHeaderCode:167415acda8fcc23587-94869724%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25104949f562c02c3c48af67933dec11e7eadadd' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\model\\basket.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167415acda8fcc23587-94869724',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fcc34081_75610318',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fcc34081_75610318')) {function content_5acda8fcc34081_75610318($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.PluginManager.model.Basket', {
    extend: 'Ext.data.Model',

    fields: [
        { name: 'grossPrice', type: 'float' },
        { name: 'netPrice', type: 'float' },
        { name: 'taxPrice', type: 'float' },
        { name: 'taxRate', type: 'string' },
        { name: 'bookingDomain', type: 'string' },
        { name: 'licenceDomain', type: 'string' }
    ],

    associations: [
    {
        type: 'hasMany',
        model: 'Shopware.apps.PluginManager.model.BasketPosition',
        name: 'getPositions',
        associationKey: 'positions'
    } ,
    {
        type: 'hasMany',
        model: 'Shopware.apps.PluginManager.model.Domain',
        name: 'getDomains',
        associationKey: 'domains'
    } ,
    {
        type: 'hasMany',
        model: 'Shopware.apps.PluginManager.model.Address',
        name: 'getAddress',
        associationKey: 'address'
    }
    ]

});
//<?php }} ?>