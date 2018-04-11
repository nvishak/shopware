<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:35
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\Shopware.data.reader.Application.js" */ ?>
<?php /*%%SmartyHeaderCode:66395acd97dbc0b7d1-54947597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e8b2a968be1feca6d28120a07879176d5a22289' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\Shopware.data.reader.Application.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66395acd97dbc0b7d1-54947597',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97dbc2d6e0_06696681',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97dbc2d6e0_06696681')) {function content_5acd97dbc2d6e0_06696681($_smarty_tpl) {?>/**
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
 * @subpackage Component
 * @copyright  Copyright (c) shopware AG (http://www.shopware.de)
 * @version    $Id$
 * @author     shopware AG
 */

Ext.define('Shopware.data.reader.Application', {
    extend: 'Ext.data.reader.Json',
    alternateClassName: 'Ext.data.ApplicationReader',
    alias : 'reader.application',

    extractData : function(root) {
        var me = this,
            records = [],
            Model   = me.model,
            length  = root.length,
            modelIteration = null,
            convertedValues, node, record, i;

        if (!root.length && Ext.isObject(root)) {
            root = [root];
            length = 1;
        }

        modelIteration = me.model;

        for (i = 0; i < length; i++) {
            node = root[i];

            if (!node.isModel) {
                //SW FIX
                    //internal reference of convertRecordData function lost
                    //reproducible if you load a one to many association and additionally a many to one association
                    me.setModel(modelIteration, true);
                //fix end

                record = new Model(undefined, me.getId(node), node, convertedValues = {});

                record.phantom = false;

                me.convertRecordData(convertedValues, node, record);

                records.push(record);

                if (me.implicitIncludes) {
                    me.readAssociated(record, node);
                }
            } else {
                records.push(node);
            }
        }
        return records;
    }
});


<?php }} ?>