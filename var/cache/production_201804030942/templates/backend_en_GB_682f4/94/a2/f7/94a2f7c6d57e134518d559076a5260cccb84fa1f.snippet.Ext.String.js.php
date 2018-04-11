<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:35
         compiled from "E:\wamp\www\shopware4\engine\Library\ExtJs\overrides\Ext.String.js" */ ?>
<?php /*%%SmartyHeaderCode:326455acd97dbd00b79-38283553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94a2f7c6d57e134518d559076a5260cccb84fa1f' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Library\\ExtJs\\overrides\\Ext.String.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '326455acd97dbd00b79-38283553',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97dbd276e3_35560947',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97dbd276e3_35560947')) {function content_5acd97dbd276e3_35560947($_smarty_tpl) {?>/**
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

/** @lends Ext.String */
Ext.override(Ext.String, {
    /**
     * Return the text content of the element
     *
     * @returns string
     */
    getText: function(value) {
        var me = this,
            elementNode;

        elementNode = document.createElement('div');
        elementNode.innerHTML = value;

        return me._getText([elementNode]);
    },

    /**
     * Utility function for retrieving the text value of an array of DOM nodes
     *
     * @param { Array|Element } elem
     * @private
     */
    _getText: function(elem) {
        var node,
            ret = '',
            i = 0,
            nodeType = elem.nodeType;

        if (!nodeType) {
            while ((node = elem[i++])) {
                ret += this._getText(node);
            }
        } else if (nodeType === 1 || nodeType === 9 || nodeType === 11) {
            if (typeof elem.textContent === 'string') {
                return elem.textContent;
            } else {
                for (elem = elem.firstChild; elem; elem = elem.nextSibling) {
                    ret += this._getText(elem);
                }
            }
        } else if (nodeType === 3 || nodeType === 4) {
            return elem.nodeValue;
        }

        return ret;
    }
});
<?php }} ?>