<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:44
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.EmotionSingleSelection.js" */ ?>
<?php /*%%SmartyHeaderCode:136435acd97e4c37c72-51718049%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2cca162c1e6245a2efde6f9f78dfe097452ce98f' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.EmotionSingleSelection.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136435acd97e4c37c72-51718049',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e4ca3af5_14188852',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e4ca3af5_14188852')) {function content_5acd97e4ca3af5_14188852($_smarty_tpl) {?>/**
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

Ext.define('Shopware.form.field.EmotionSingleSelection', {
    extend: 'Shopware.form.field.SingleSelection',
    alias: 'widget.shopware-form-field-emotion-single-selection',
    iconStyling: 'width:16px; height:16px; display:inline-block; margin-right:5px',
    snippets: {
        desktop: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'desktop')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'desktop'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on desktop devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'desktop'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        tabletLandscape: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tabletLandscape')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tabletLandscape'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on tablet landscape devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tabletLandscape'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        tablet: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tablet')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tablet'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on tablet portrait devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tablet'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        mobileLandscape: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobileLandscape')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobileLandscape'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on mobile landscape devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobileLandscape'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        mobile: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobile')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobile'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on mobile portrait devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobile'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    getComboConfig: function() {
        var me = this;
        var config = me.callParent(arguments);

        config.tpl = Ext.create('Ext.XTemplate',
            '<tpl for=".">',
                '<div class="x-boundlist-item">' +
                '' +
                    '{name}   {[this.getDevices(values)]}' +
                '' +
                '</div>',
            '</tpl>',
            {
                getDevices: function(values) {
                    var devices = '';

                    // Device detection
                    if(values.device.indexOf('0') >= 0) {
                        devices += '<div class="sprite-imac" style="' + me.iconStyling + '" title="' + me.snippets.desktop + '">&nbsp;</div>';
                    }
                    if(values.device.indexOf('1') >= 0) {
                        devices += '<div class="sprite-ipad--landscape" style="' + me.iconStyling + '" title="' + me.snippets.tabletLandscape + '">&nbsp;</div>';
                    }
                    if(values.device.indexOf('2') >= 0) {
                        devices += '<div class="sprite-ipad--portrait" style="' + me.iconStyling + '" title="' + me.snippets.tablet + '">&nbsp;</div>';
                    }
                    if(values.device.indexOf('3') >= 0) {
                        devices += '<div class="sprite-iphone--landscape" style="' + me.iconStyling + '" title="' + me.snippets.mobileLandscape + '">&nbsp;</div>';
                    }
                    if(values.device.indexOf('4') >= 0) {
                        devices += '<div class="sprite-iphone--portrait" style="' + me.iconStyling + '" title="' + me.snippets.mobile + '">&nbsp;</div>';
                    }

                    return '<div style="float: right;">' + devices + '</div>';
                }
            }
        );

        config.displayTpl = Ext.create('Ext.XTemplate',
            '<tpl for=".">',
                '{name}',
            '</tpl>'
        );

        return config;
    }
});<?php }} ?>