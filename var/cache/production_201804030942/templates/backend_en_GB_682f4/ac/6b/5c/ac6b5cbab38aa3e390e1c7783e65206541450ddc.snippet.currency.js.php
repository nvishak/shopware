<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:15
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\currency.js" */ ?>
<?php /*%%SmartyHeaderCode:157735acda8e3c8ba82-05914882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac6b5cbab38aa3e390e1c7783e65206541450ddc' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\currency.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157735acda8e3c8ba82-05914882',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e3c9bce5_93581797',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e3c9bce5_93581797')) {function content_5acda8e3c9bce5_93581797($_smarty_tpl) {?>/**
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
 * Shopware UI - Global Stores and Models
 */
//
Ext.define('Shopware.apps.Base.model.Currency', {

    /**
     * Defines an alternate name for this class.
     */
    alternateClassName: 'Shopware.model.Currency',

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend: 'Shopware.data.Model',

    /**
     * unique id
     * @int
     */
    idProperty : 'id',

    /**
     * The fields used for this model
     * @array
     */
    fields: [
        //
        { name : 'id', type : 'int' },
        { name : 'name', type : 'string' },
        { name : 'currency', type : 'string' }
    ]
});
//

<?php }} ?>