<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:44
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\field\Shopware.form.field.EmotionGrid.js" */ ?>
<?php /*%%SmartyHeaderCode:15625acd97e4b1c869-34991003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce8f72d428ed5d94d61242366618d1df106e826a' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\field\\Shopware.form.field.EmotionGrid.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15625acd97e4b1c869-34991003',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e4b95771_39278843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e4b95771_39278843')) {function content_5acd97e4b95771_39278843($_smarty_tpl) {?>/**
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

Ext.define('Shopware.form.field.EmotionGrid', {
    extend: 'Shopware.form.field.Grid',
    alias: 'widget.shopware-form-field-emotion-grid',
    mixins: ['Shopware.model.Helper'],

    createColumns: function() {
        var me = this;
        var activeColumn = { dataIndex: 'active', width: 30 };
        me.applyBooleanColumnConfig(activeColumn);
        return [
            me.createSortingColumn(),
            activeColumn,
            { dataIndex: 'name', flex: 2 },
            { dataIndex: 'type', flex: 1 },
            { dataIndex: 'device', flex: 2, renderer: me.deviceRenderer },
            me.createActionColumn()
        ];
    },

    createSearchField: function() {
        return Ext.create('Shopware.form.field.EmotionSingleSelection', this.getComboConfig());
    },

    deviceRenderer: function(value, meta, record) {
        var devices = '',
            iconStyling = 'width:16px; height:16px; display:inline-block; margin-right:5px';

        var snippets = {
            desktop: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'desktop','default'=>'For desktop')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'desktop','default'=>'For desktop'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on desktop devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'desktop','default'=>'For desktop'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            tabletLandscape: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tabletLandscape','default'=>'For tablet landscape')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tabletLandscape','default'=>'For tablet landscape'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on tablet landscape devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tabletLandscape','default'=>'For tablet landscape'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            tablet: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tablet','default'=>'For tablet')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tablet','default'=>'For tablet'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on tablet portrait devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'tablet','default'=>'For tablet'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            mobileLandscape: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobileLandscape','default'=>'For mobile landscape')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobileLandscape','default'=>'For mobile landscape'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on mobile landscape devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobileLandscape','default'=>'For mobile landscape'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            mobile: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobile','default'=>'For mobile')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobile','default'=>'For mobile'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visible on mobile portrait devices<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('namespace'=>'backend/attributes/fields','name'=>'grid'/'renderer'/'mobile','default'=>'For mobile'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        };

        // Device detection
        if(value.indexOf('0') >= 0) {
            devices += '<div class="sprite-imac" style="' + iconStyling + '" title="' + snippets.desktop + '">&nbsp;</div>';
        }
        if(value.indexOf('1') >= 0) {
            devices += '<div class="sprite-ipad--landscape" style="' + iconStyling + '" title="' + snippets.tabletLandscape + '">&nbsp;</div>';
        }
        if(value.indexOf('2') >= 0) {
            devices += '<div class="sprite-ipad--portrait" style="' + iconStyling + '" title="' + snippets.tablet + '">&nbsp;</div>';
        }
        if(value.indexOf('3') >= 0) {
            devices += '<div class="sprite-iphone--landscape" style="' + iconStyling + '" title="' + snippets.mobileLandscape + '">&nbsp;</div>';
        }
        if(value.indexOf('4') >= 0) {
            devices += '<div class="sprite-iphone--portrait" style="' + iconStyling + '" title="' + snippets.mobile + '">&nbsp;</div>';
        }

        return devices;
    }
});<?php }} ?>