<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\image\list.js" */ ?>
<?php /*%%SmartyHeaderCode:122485acda8f3bfebb1-97013448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26a337640c532cf33c4d83f06400e7fcd9d8d98c' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\image\\list.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122485acda8f3bfebb1-97013448',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f3ca56d1_86862873',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f3ca56d1_86862873')) {function content_5acda8f3ca56d1_86862873($_smarty_tpl) {?>/**
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
 * The image list component contains a custom listing of the assigned article images.
 * The component contains also a toolbar to define the preview image, remove selected images
 * and change the displayed image size over a slider. All events of the component handled in the media controller.
 */
//
//
Ext.define('Shopware.apps.Article.view.image.List', {

    /**
     * Defines that the article image listing is an extension of the Ext.panel.Panel
     */
    extend: 'Ext.panel.Panel',

    /**
     * Defines an alias for this component to get access over xtype
     */
    alias: 'widget.article-image-list',

    /**
     * Individually css class
     */
    cls: Ext.baseCSSPrefix + 'article-image-list',

    /**
     * Sets the background color for the listing
     */
    style: 'background: #fff',

    /**
     * Enables automatically scrolling
     */
    autoScroll: true,

    /**
     * Contains all snippets for this component
     * @object
     */
    snippets: {
        title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'title','default'=>'Assigned images','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'title','default'=>'Assigned images','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigned images<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'title','default'=>'Assigned images','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        comboBox: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'combo_box','default'=>'Images per page','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'combo_box','default'=>'Images per page','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Images per page<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'combo_box','default'=>'Images per page','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        previewButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'preview_button','default'=>'Mark as preview image','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'preview_button','default'=>'Mark as preview image','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Mark as preview image<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'preview_button','default'=>'Mark as preview image','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        removeButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'remove_button','default'=>'Remove image(s)image/list/remove_button','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'remove_button','default'=>'Remove image(s)image/list/remove_button','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Remove image(s)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'remove_button','default'=>'Remove image(s)image/list/remove_button','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        configButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'config_button','default'=>'Open configuration','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'config_button','default'=>'Open configuration','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Open configuration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'config_button','default'=>'Open configuration','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        attributeButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'attribute_button','default'=>'Edit attributes','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'attribute_button','default'=>'Edit attributes','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Edit attributes<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'attribute_button','default'=>'Edit attributes','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        downloadButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'download_button','default'=>'Download image','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'download_button','default'=>'Download image','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Download image<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'download_button','default'=>'Download image','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        mainImage:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image'/'list'/'main_image','default'=>'Preview','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'main_image','default'=>'Preview','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Preview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image'/'list'/'main_image','default'=>'Preview','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    dragOverCls: 'drag-over',

    /**
     * Indicates if there are attributes for article images
     * @boolean
     */
    hasActiveAttributes: false,

    layout: 'fit',

    /**
     * Initializes the component and sets the neccessary
     * toolbars and items.
     *
     * @return void
     */
    initComponent: function() {
        var me = this;

        me.mediaStore = me.article.getMedia();

        me.title = me.snippets.title;
        me.tbar = me.createActionToolbar();
        me.dropZone = Ext.create('Shopware.apps.Article.view.image.DropZone', {
            padding: 20,
            dropZoneConfig: { hideOnLegacy: true, focusable: false },
            height: 100,
            style: {
                borderBottom: '1px solid',
                borderColor: '#a4b5c0'
            }
        });

        me.items = [{
            xtype: 'container',
            style: 'background: #fff',
            autoScroll: true,
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            items: [
                me.dropZone,
                me.createMediaView()
            ]
        }];
        me.registerEvents();
        me.callParent(arguments);

        me.on('afterrender', function() {
            if (me.mediaStore.getCount() && me.dataView.getSelectionModel().getSelection().length === 0) {
                window.setTimeout(function() {
                    me.dataView.getSelectionModel().select(0);
                }, 1);
            }
        });
    },

    /**
     * Registers additional component events.
     */
    registerEvents: function() {
        this.addEvents(
            /**
             * Event will be fired when the user select an article image in the listing.
             *
             * @event
             * @param [Ext.selection.DataViewModel] The selection data view model of the Ext.view.View
             * @param [Shopware.apps.Article.model.Media] The selected media
             */
            'mediaSelect',

            /**
             * Event will be fired when the user de select an article image in the listing.
             *
             * @event
             * @param [Ext.selection.DataViewModel] The selection data view model of the Ext.view.View
             * @param [Shopware.apps.Article.model.Media] The selected media
             */
            'mediaDeselect',

            /**
             * Event will be fired when the user move an image.
             *
             * @event
             * @param [Ext.data.Store] The media store
             * @param [Shopware.apps.Article.model.Media] The dragged record
             * @param [Shopware.apps.Article.model.Media] The target record, on which the dragged record dropped
             */
            'mediaMoved',

            /**
             * Event will be fired when the user clicks the "mark selected image as preview image".
             *
             * @event
             */
            'markPreviewImage',

            /**
             * Event will be fired when the user clicks the "remove selected image".
             *
             * @event
             */
            'removeImage',

            /**
             * Event will be fired when the user clicks the "open configuration" button.
             *
             * @event
             */
            'openImageMapping',

            /**
             * Event will be fired when the user clicks the "download" button
             */
            'download'

        );
    },

    /**
     * Creates the template for the media view panel
     *
     * @return [object] generated Ext.XTemplate
     */
    createMediaViewTemplate: function() {
        var me = this;
        return new Ext.XTemplate(
            '<tpl for=".">',
                '<div class="article-thumb-wrap middle" >',
                    // If the type is image, then show the image
                    '<div class="thumb">',
                        '<div class="inner-thumb"><img src="{thumbnail}" /></div>',
                        '<tpl if="main===1">',
                            '<div class="preview"><span>' + me.snippets.mainImage  + '</span></div>',
                        '</tpl>',
                        '<tpl if="hasConfig">',
                            '<div class="mapping-config">&nbsp;</div>',
                        '</tpl>',
                    '</div>',
                '</div>',
            '</tpl>',
            '<div class="x-clear"></div>'
        );
    },

    /**
     * Creates the media listing based on an Ext.view.View (know as DataView)
     * and binds the "Media"-store to it
     *
     * @return [object] this.dataView - created Ext.view.View
     */
    createMediaView: function() {
        var me = this;

        me.dataView = Ext.create('Shopware.apps.Article.view.image.DataView', {
            store: me.mediaStore,
            tpl: me.createMediaViewTemplate()
        });

        me.dataView.getSelectionModel().on('select', function (dataViewModel, media) {
            me.fireEvent('mediaSelect', dataViewModel, media, me.previewButton, me.removeButton, me.configButton, me.downloadButton);
        });

        me.dataView.on('openSettingsForm', function(record) {
            me.fireEvent('openImageMapping', record);
        });

        me.dataView.getSelectionModel().on('deselect', function (dataViewModel, media) {
            me.fireEvent('mediaDeselect', dataViewModel, media, me.previewButton, me.removeButton, me.configButton, me.downloadButton);
        });
        me.initDragAndDrop();

        return me.dataView;
    },

    /**
     * Creates the drag and drop zone for the Ext.view.View to allow
     */
    initDragAndDrop: function() {
        var me = this;

        me.dataView.on('afterrender', function(v) {
            me.dataView.dragZone = new Ext.dd.DragZone(v.getEl(), {
                getDragData: function(e) {
                    //Use the DataView's own itemSelector to
                    //test if the mousedown is within one of the DataView's nodes.
                    var sourceEl = e.getTarget(v.itemSelector, 10);

                    //If the mousedown is within a DataView node, clone the node to produce
                    //a ddel element for use by the drag proxy. Also add application data
                    //to the returned data object.
                    if (sourceEl) {
                        var d = sourceEl.cloneNode(true);
                        d.id = Ext.id();

                        var result = {
                            ddel: d,
                            sourceEl: sourceEl,
                            repairXY: Ext.fly(sourceEl).getXY(),
                            sourceStore: v.store,
                            draggedRecord: v.getRecord(sourceEl)
                        };
                        return result;
                    }
                },
                getRepairXY: function() {
                    return this.dragData.repairXY;
                }
            });

            me.dataView.dropZone = new Ext.dd.DropZone(me.dataView.getEl(), {
                //If the mouse is over a grid row, return that node. This is
                //provided as the "target" parameter in all "onNodeXXXX" node event handling functions
                getTargetFromEvent: function(e) {
                    return e.getTarget(me.dataView.itemSelector);
                },

                //On entry into a target node, highlight that node.
                onNodeEnter : function(target, dd, e, data){
                    var record = me.dataView.getRecord(target);
                    if (record !== data.draggedRecord) {
                        Ext.fly(target).addCls(me.dragOverCls);
                    }
                },

                //On exit from a target node, unhighlight that node.
                onNodeOut : function(target, dd, e, data){
                    Ext.fly(target).removeCls(me.dragOverCls);
                },

                //While over a target node, return the default drop allowed class which
                //places a "tick" icon into the drag proxy.
                onNodeOver : function(target, dd, e, data){
                    return (data.draggedRecord instanceof Ext.data.Model);
                },

                //On node drop we can interrogate the target to find the underlying
                //application object that is the real target of the dragged data.
                //In this case, it is a Record in the GridPanel's Store.
                //We can use the data set up by the DragZone's getDragData method to read
                //any data we decided to attach in the DragZone's getDragData method.
                onNodeDrop : function(target, dd, e, data){
                    var record = me.dataView.getRecord(target);
                    me.fireEvent('mediaMoved', me.mediaStore, data.draggedRecord, record)
                }
            });

        });
    },

    /**
     * Creates the action toolbar for the image listing.
     *
     * @return [object] created Ext.toolbar.Toolbar
     */
    createActionToolbar: function() {
        var me = this;

        me.addButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image_list_add_button','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_list_add_button','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add image<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_list_add_button','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            iconCls: 'sprite-plus-circle-frame',
            handler: function() {
                me.openMediaManager();
            }
        });

        //the preview button, marks the selected image in the listing as preview.
        //the event will be handled in the media controller
        me.previewButton = Ext.create('Ext.button.Button', {
            text: me.snippets.previewButton,
            action: 'previewImage',
            disabled: true,
            iconCls: 'sprite-camera-lens',
            handler: function() {
                me.fireEvent('markPreviewImage');
            }
        });

        //the remove button, removes the selected item from the image listing.
        me.removeButton = Ext.create('Ext.button.Button', {
            text: me.snippets.removeButton,
            action: 'removeImage',
            disabled: true,
            iconCls:'sprite-minus-circle-frame',
            handler: function() {
                me.fireEvent('removeImage');
            }
        });

        //the config button, opens the config window for the image mapping
        me.configButton = Ext.create('Ext.button.Button', {
            text: me.snippets.configButton,
            disabled: true,
            iconCls:'sprite-gear',
            handler: function() {
                me.fireEvent('openImageMapping');
            }
        });

        //the download button, opens a popup with the original image
        me.downloadButton = Ext.create('Ext.button.Button', {
            text: me.snippets.downloadButton,
            disabled: true,
            iconCls:'sprite-drive-download',
            handler: function() {
                if (me.dataView.getSelectionModel().selected && me.dataView.getSelectionModel().selected.first()) {
                    me.fireEvent('download', me.dataView.getSelectionModel().selected.first());
                }
            }
        });

        return Ext.create('Ext.toolbar.Toolbar', {
            items: [
                me.addButton,
                me.previewButton,
                me.removeButton,
                me.configButton,
                me.downloadButton
            ]
        });
    },

    openMediaManager: function() {
        var me = this;

        Shopware.app.Application.addSubApplication({
            name: 'Shopware.apps.MediaManager',
            layout: 'small',
            eventScope: me,
            selectionMode: true,
            params: { albumId: -1 },
            mediaSelectionCallback: me.onSelectMedia
        });
    },

    onSelectMedia: function(button, window, selection) {
        var me = this;

        Ext.each(selection, function(item) {
            var media = Ext.create('Shopware.apps.Article.model.Media', item.data);
            media.set('path', item.get('name'));
            media.set('main', 2);
            media.set('mediaId', item.get('id'));

            if (me.mediaStore.getCount() === 0) {
                media.set('main', 1);
            }
            media.set('id', 0);
            me.mediaStore.add(media);
        });
        window.close();
    }
});
//
<?php }} ?>