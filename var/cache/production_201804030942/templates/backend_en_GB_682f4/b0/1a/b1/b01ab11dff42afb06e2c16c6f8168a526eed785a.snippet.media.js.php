<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:16
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\media.js" */ ?>
<?php /*%%SmartyHeaderCode:322685acda8e4304150-34690078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b01ab11dff42afb06e2c16c6f8168a526eed785a' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\media.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '322685acda8e4304150-34690078',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e43168c8_56780682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e43168c8_56780682')) {function content_5acda8e43168c8_56780682($_smarty_tpl) {?>/**
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
 * todo@all: Documentation
 */
//
Ext.define('Shopware.apps.Base.model.Media', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            field: 'Shopware.form.field.Media'
        };
    },

    fields: [
        //
        'created',
        'description',
        'extension',
        'id',
        'name',
        'type',
        'path',
        'userId',
        'width',
        'height',
        'albumId',
        'thumbnail'
    ]
});
//

<?php }} ?>