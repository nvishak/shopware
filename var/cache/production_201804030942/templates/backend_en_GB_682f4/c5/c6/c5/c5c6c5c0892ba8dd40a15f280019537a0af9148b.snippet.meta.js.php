<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:42
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\detail\meta.js" */ ?>
<?php /*%%SmartyHeaderCode:17245acda8feb07662-04237081%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c5c6c5c0892ba8dd40a15f280019537a0af9148b' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\detail\\meta.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17245acda8feb07662-04237081',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8feb36381_99622379',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8feb36381_99622379')) {function content_5acda8feb36381_99622379($_smarty_tpl) {?>/**
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
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.detail.Meta', {
    extend: 'Ext.container.Container',

    cls: 'store-plugin-detail-meta-data',
    defaults: {
        xtype: 'component',
        cls: 'item',
        height: 40
    },

    mixins: {
        events: 'Shopware.apps.PluginManager.view.PluginHelper'
    },

    initComponent: function() {
        var me = this, items = [], commentCount = 0;

        if (me.plugin['getCommentsStore']) {
            commentCount = me.plugin['getCommentsStore'].getCount();
        }

        items.push({
            html: '<div class="label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'version','default'=>'Version','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'version','default'=>'Version','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'version','default'=>'Version','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</div>' +
            '<div class="value">'+ me.plugin.get('version') +'</div>'
        });

        items.push({
            html: '<div class="label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'rating_short','default'=>'Rating','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rating_short','default'=>'Rating','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Rating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'rating_short','default'=>'Rating','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</div>' +
                '<div class="value">'+
                    '<div class="store-plugin-rating star' + me.plugin.get('rating') + '">('+commentCount+')</div>' +
                '</div>'
        });

        if (me.plugin['getLicenceStore']) {

            try {
                var licence = me.plugin['getLicenceStore'].first();

                var price = licence['getPriceStore'].first();

                var type = me.getTextForPriceType(price.get('type'));

                var expiration = licence.get('expirationDate');

                var result = type;

                if (expiration) {
                    var date = me.formatDate(expiration.date);
                    result += '<span class="date"> (<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'till','default'=>'until','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'till','default'=>'until','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
until<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'till','default'=>'until','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: '+ Ext.util.Format.date(date) + ')</span>';
                }

                items.push({
                    html: '<div class="label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'licence','default'=>'License','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence','default'=>'License','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
License<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'licence','default'=>'License','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</div><div class="value">'+result+'</div>'
                });
            } catch (e) {

            }
        }

        me.items = items;

        me.callParent(arguments);
    }
});
//<?php }} ?>