<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:35
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\crossselling\tab.js" */ ?>
<?php /*%%SmartyHeaderCode:88625acda8f7298c91-07120201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69d5aa805997351f5d7f991de3e62d39bc59618e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\crossselling\\tab.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88625acda8f7298c91-07120201',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f72ff100_89265461',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f72ff100_89265461')) {function content_5acda8f72ff100_89265461($_smarty_tpl) {?>/**
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
 * @subpackage Esd
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Article crosselling page
 */
//
//
Ext.define('Shopware.apps.Article.view.crossselling.Tab', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.form.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-crossselling-tab',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-crossselling-tab',

    /**
     * Padding for the body element.
     *
     * @number
     */
    bodyPadding: 10,

    /**
     * Defines that the component will automatically scrollbars if the content exceeded the max height of the container.
     *
     * @boolean
     */
    autoScroll: true,

    /**
     * Defines if the component should have a border.
     *
     * @boolean
     */
    border: 0,

    /**
     * System texts for the component.
     *
     * @object
     */
    snippets: {
        similar: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'title','default'=>'Similar articles','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'title','default'=>'Similar articles','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Similar items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'title','default'=>'Similar articles','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            notice: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'notice','default'=>'At this point you have the option of linking other articles with the current article. The linked articles are automatically displayed on the article detail page.','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'notice','default'=>'At this point you have the option of linking other articles with the current article. The linked articles are automatically displayed on the article detail page.','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
At this point you have the option of linking other items to the current item. The linked items will automatically be displayed on this item\'s detail page.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'notice','default'=>'At this point you have the option of linking other articles with the current article. The linked articles are automatically displayed on the article detail page.','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            gridTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'grid_title','default'=>'Assigned similar articles','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'grid_title','default'=>'Assigned similar articles','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigned similar items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'grid_title','default'=>'Assigned similar articles','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            add: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'similar'/'button','default'=>'Add article','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'button','default'=>'Add article','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'similar'/'button','default'=>'Add article','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        accessory: {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'accessory'/'title','default'=>'Accessory articles','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'title','default'=>'Accessory articles','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Accessory items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'title','default'=>'Accessory articles','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            notice: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'accessory'/'notice','default'=>'At this point you have the option of linking other articles with the current article. The linked articles are automatically displayed on the article detail page.','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'notice','default'=>'At this point you have the option of linking other articles with the current article. The linked articles are automatically displayed on the article detail page.','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
At this point you have the option of linking other items to the current item. The linked items will automatically be displayed on this item\'s detail page.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'notice','default'=>'At this point you have the option of linking other articles with the current article. The linked articles are automatically displayed on the article detail page.','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            gridTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'accessory'/'grid_title','default'=>'Assigned accessory articles','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'grid_title','default'=>'Assigned accessory articles','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigned accessory items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'grid_title','default'=>'Assigned accessory articles','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            add: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'sidebar'/'accessory'/'button','default'=>'Add item','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'button','default'=>'Add item','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'sidebar'/'accessory'/'button','default'=>'Add item','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * The initComponent template method is an important initialization step for a Component.
     * It is intended to be implemented by each subclass of Ext.Component to provide any needed constructor logic.
     * The initComponent method of the class being created is called first,
     * with each initComponent method up the hierarchy to Ext.Component being called thereafter.
     * This makes it easy to implement and, if needed, override the constructor logic of the Component at any step in the hierarchy.
     * The initComponent method must contain a call to callParent in order to ensure that the parent class' initComponent method is also called.
     *
     * @returns void
     */
    initComponent: function() {
        var me = this;

        me.items = [
            me.createSimilarFieldset(),
            me.createAccessoryFieldset(),
            me.createProductsStreamsFieldset()
        ];

        me.callParent(arguments);
    },

    /**
     * Creates the similar products fieldset.
     *
     * @returns { Shopware.apps.Article.view.crossselling.Base }
     */
    createSimilarFieldset: function() {
        var me = this;

        return Ext.create('Shopware.apps.Article.view.crossselling.Base', {
            snippets: me.snippets.similar,
            listingName: 'similar-listing',
            gridStore: me.article.getSimilar(),
            customEvents: {
                addEvent: 'addSimilarArticle',
                removeEvent: 'removeSimilarArticle'
            }
        });
    },

    /**
     * Creates the accessory products fieldset.
     *
     * @returns { Shopware.apps.Article.view.crossselling.Base }
     */
    createAccessoryFieldset: function() {
        var me = this;

        return Ext.create('Shopware.apps.Article.view.crossselling.Base', {
            snippets: me.snippets.accessory,
            listingName: 'accessory-listing',
            gridStore: me.article.getAccessory(),
            customEvents: {
                addEvent: 'addAccessoryArticle',
                removeEvent: 'removeAccessoryArticle'
            }
        });
    },

    /**
     * Creates the product streams fieldset.
     *
     * @returns { Shopware.apps.Article.view.crossselling.ProductStreams }
     */
    createProductsStreamsFieldset: function() {
        var me = this;

        return Ext.create('Shopware.apps.Article.view.crossselling.ProductStreams', {
            streamStore: me.article.getStreams()
        });
    }
});
//
<?php }} ?>