<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:36
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\store\configurator_set.js" */ ?>
<?php /*%%SmartyHeaderCode:106205acda8f801def8-02262688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c16849eca3955699ba5a8f8087f6f096fcd4246' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\store\\configurator_set.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106205acda8f801def8-02262688',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f8036bf8_47282288',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f8036bf8_47282288')) {function content_5acda8f8036bf8_47282288($_smarty_tpl) {?>/**
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
 * @package    Article
 * @subpackage Batch
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Store - Article Module
 */
//
Ext.define('Shopware.apps.Article.store.ConfiguratorSet', {
    /**
     * Extend for the standard ExtJS 4
     * @string
     */
    extend:'Ext.data.Store',
    autoLoad: false,
    /**
     * Define the used model for this store
     * @string
     */
    model:'Shopware.apps.Article.model.ConfiguratorSet',
    /**
     * Configure the data communication
     * @object
     */
    proxy:{
        /**
         * Set proxy type to ajax
         * @string
         */
        type:'ajax',

        /**
         * Configure the url mapping for the different
         * store operations based on
         * @object
         */
        api: {
             read: '<?php echo '/shopware4/backend/Article/getConfiguratorSets';?>',
             create: '<?php echo '/shopware4/backend/Article/saveConfiguratorSet';?>',
             update: '<?php echo '/shopware4/backend/Article/saveConfiguratorSet';?>'
         },
        reader:{
            type:'json',
            root:'data',
            totalProperty:'total'
        }
    }

});
//

<?php }} ?>