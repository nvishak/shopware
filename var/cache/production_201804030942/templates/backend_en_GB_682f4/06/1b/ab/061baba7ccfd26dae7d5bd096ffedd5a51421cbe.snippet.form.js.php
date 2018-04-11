<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:17
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\form.js" */ ?>
<?php /*%%SmartyHeaderCode:150255acda8e52ec219-30477782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '061baba7ccfd26dae7d5bd096ffedd5a51421cbe' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\form.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150255acda8e52ec219-30477782',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e530f204_51342597',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e530f204_51342597')) {function content_5acda8e530f204_51342597($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Base.store.Form', {
    extend: 'Ext.data.Store',
    alternateClassName: 'Shopware.store.Form',
    storeId: 'base.Form',

    model:'Shopware.apps.Base.model.Form',
    proxy: {
        type: 'ajax',
        url: '<?php echo '/shopware4/backend/config/getForm';?>',
        api: {
            create: '<?php echo '/shopware4/backend/config/saveForm';?>',
            update: '<?php echo '/shopware4/backend/config/saveForm';?>',
            destroy: '<?php echo '/shopware4/backend/config/deleteForm';?>'
        },
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
//
<?php }} ?>