<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\image\drop_zone.js" */ ?>
<?php /*%%SmartyHeaderCode:97505acda8f3ea1a40-87994432%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba434388605de0dd03c2b66d790fd96feb3f76f2' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\image\\drop_zone.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97505acda8f3ea1a40-87994432',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f3ec6209_48663231',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f3ec6209_48663231')) {function content_5acda8f3ec6209_48663231($_smarty_tpl) {?>/**
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
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Article detail page - Image
 * The drop zone component is used in the option sidebar component and in the image tab.
 * It handles the drop event when the user drops one or more images on the drop zone and uploads
 * the images over the media manager into the article album. After the images uploaded the media controller
 * adds the images to the listing.
 * All events of the component handled in the media controller.
 */
//
//
Ext.define('Shopware.apps.Article.view.image.DropZone', {
    /**
     * Define that the category drop zone is an extension of the Ext.panel.Panel
     * @string
     */
    extend:'Ext.container.Container',
    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias:'widget.article-image-drop-zone',
    /**
     * Set css class for this component
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-image-drop-zone',

    /**
     * Layout for the component
     */
    layout: 'anchor',

    /**
     * Defaults for the panel items
     * @object
     */
    defaults: {
        anchor: '100%'
    },

    snippets: {
        dropZone: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'upload'/'drop_zone','default'=>'Upload images via drag&drop','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'upload'/'drop_zone','default'=>'Upload images via drag&drop','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Upload images via drag & drop<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'upload'/'drop_zone','default'=>'Upload images via drag&drop','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Configuration object for the drop zone which will be set during initializing
     * @object
     */
    dropZoneConfig: {},

    /**
     * The initComponent template method is an important initialization step for a Component.
     * It is intended to be implemented by each subclass of Ext.Component to provide any needed constructor logic.
     * The initComponent method of the class being created is called first,
     * with each initComponent method up the hierarchy to Ext.Component being called thereafter.
     * This makes it easy to implement and, if needed, override the constructor logic of the Component at any step in the hierarchy.
     * The initComponent method must contain a call to callParent in order to ensure that the parent class' initComponent method is also called.
     *
     * @return void
     */
    initComponent:function () {
        var me = this;
        me.mediaDropZone = me.createMediaDropZone();
        me.items = [ me.mediaDropZone ];
        me.registerEvents();
        me.callParent(arguments);
    },

    /**
     * Registers additional component events.
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user select or uploads article images.
             *
             * @event
             * @param [Ext.data.Model] media - The uploaded media
             */
            'addMedia'
        );
    },

    /**
     * Creates the drop zone for article images
     * @return Shopware.app.FileUpload
     */
    createMediaDropZone: function() {
        var me = this,
            defaultConfig = {
            requestURL: '<?php echo '/shopware4/backend/mediaManager/upload';?>?albumID=-1',
            showInput: false,
            padding:0,
            checkSize: false,
            checkType: false,
            checkAmount: false,
            enablePreviewImage: false,
            dropZoneText: me.snippets.dropZone
        };

        defaultConfig = Ext.apply(defaultConfig, me.dropZoneConfig);
        return Ext.create('Shopware.app.FileUpload', defaultConfig);
    }
});
//
<?php }} ?>