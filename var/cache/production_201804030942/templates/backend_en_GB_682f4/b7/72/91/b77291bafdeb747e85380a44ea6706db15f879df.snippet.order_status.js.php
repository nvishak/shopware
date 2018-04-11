<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:15
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\model\order_status.js" */ ?>
<?php /*%%SmartyHeaderCode:199395acda8e3f30fb0-81865101%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b77291bafdeb747e85380a44ea6706db15f879df' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\model\\order_status.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199395acda8e3f30fb0-81865101',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e4058880_85939136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e4058880_85939136')) {function content_5acda8e4058880_85939136($_smarty_tpl) {?>/**
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
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware Model - Global Stores and Models
 *
 * The payment model represents a data row of the s_core_states or the
 * Shopware\Models\State\State doctrine model.
 */
//
//
Ext.define('Shopware.apps.Base.model.OrderStatus', {

    snippets: {
        //
        cancelled: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cancelled','default'=>'Cancelled','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancelled','default'=>'Cancelled','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancelled<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancelled','default'=>'Cancelled','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        open: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'open','default'=>'Open','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open','default'=>'Open','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Open<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open','default'=>'Open','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        in_process: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'in_process','default'=>'In process','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'in_process','default'=>'In process','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
In process<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'in_process','default'=>'In process','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        completed: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'completed','default'=>'Completed','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'completed','default'=>'Completed','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Completed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'completed','default'=>'Completed','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        partially_completed: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'partially_completed','default'=>'Partially completed','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'partially_completed','default'=>'Partially completed','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Partially completed<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'partially_completed','default'=>'Partially completed','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        cancelled_rejected: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cancelled_rejected','default'=>'Cancelled/rejected','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancelled_rejected','default'=>'Cancelled/rejected','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancelled/rejected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancelled_rejected','default'=>'Cancelled/rejected','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        ready_for_delivery: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'ready_for_delivery','default'=>'Ready for delivery','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ready_for_delivery','default'=>'Ready for delivery','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Ready for delivery<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'ready_for_delivery','default'=>'Ready for delivery','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        partially_delivered: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'partially_delivered','default'=>'Partially delivered','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'partially_delivered','default'=>'Partially delivered','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Partially delivered<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'partially_delivered','default'=>'Partially delivered','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        completely_delivered: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'completely_delivered','default'=>'Completely delivered','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'completely_delivered','default'=>'Completely delivered','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Completely delivered<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'completely_delivered','default'=>'Completely delivered','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        clarification_required: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'clarification_required','default'=>'Clarification required','namespace'=>'backend/static/order_status')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'clarification_required','default'=>'Clarification required','namespace'=>'backend/static/order_status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Clarification required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'clarification_required','default'=>'Clarification required','namespace'=>'backend/static/order_status'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Defines an alternate name for this class.
     */
    alternateClassName: 'Shopware.model.OrderStatus',

    /**
     * Extends the standard Ext Model
     * @string
     */
    extend:'Shopware.data.Model',

    /**
     * unique id
     * @int
     */
    idProperty:'id',

    /**
     * The fields used for this model
     * @array
     */
    fields:[
        //
        { name:'id', type: 'int' },
        { name:'name', type: 'string' },
        {
            name:'description',
            type: 'string',
            convert: function(value, record) {
                var snippet = value;
                if (record && record.snippets) {
                    snippet = record.snippets[record.get('name')];
                }
                if (Ext.isString(snippet) && snippet.length > 0) {
                    return snippet;
                } else {
                    return value;
                }
            }
        }
    ]
});
//

<?php }} ?>