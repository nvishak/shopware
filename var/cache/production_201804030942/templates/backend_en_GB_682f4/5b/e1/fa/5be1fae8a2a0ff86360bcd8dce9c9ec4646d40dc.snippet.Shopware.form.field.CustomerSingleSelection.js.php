<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:20
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.CustomerSingleSelection.js" */ ?>
<?php /*%%SmartyHeaderCode:122145acda8e8b7e7f5-22819122%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5be1fae8a2a0ff86360bcd8dce9c9ec4646d40dc' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.CustomerSingleSelection.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122145acda8e8b7e7f5-22819122',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e8b8ad86_42046976',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e8b8ad86_42046976')) {function content_5acda8e8b8ad86_42046976($_smarty_tpl) {?>/**
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
 * @category    Shopware
 * @package     Base
 * @subpackage  Attribute
 * @version     $Id$
 * @author      shopware AG
 */

//

Ext.define('Shopware.form.field.CustomerSingleSelection', {
    extend: 'Shopware.form.field.SingleSelection',
    alias: 'widget.shopware-form-field-customer-single-selection',

    getComboConfig: function() {
        var me = this;
        var config = me.callParent(arguments);

        config.tpl = Ext.create('Ext.XTemplate',
            '<tpl for=".">',
                '<tpl if="company">',
                    '<div class="x-boundlist-item"><b>{number}</b> - {firstname} {lastname} ({company}) - <i>{customerGroup}</i></div>',
                '<tpl else>',
                    '<div class="x-boundlist-item"><b>{number}</b> - {firstname} {lastname} - <i>{customerGroup}</i></div>',
                '</tpl>',
            '</tpl>'
        );
        config.displayTpl = Ext.create('Ext.XTemplate',
            '<tpl for=".">',
                '<tpl if="company">',
                    '{number} - {firstname} {lastname} ({company}) - {customerGroup}',
                '<tpl else>',
                    '{number} - {firstname} {lastname} - {customerGroup}',
                '</tpl>',
            '</tpl>'
        );
        return config;
    }
});<?php }} ?>