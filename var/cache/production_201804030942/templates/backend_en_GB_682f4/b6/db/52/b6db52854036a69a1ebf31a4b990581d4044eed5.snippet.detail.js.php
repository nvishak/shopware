<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:34
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\esd\detail.js" */ ?>
<?php /*%%SmartyHeaderCode:90425acda8f6b25846-48225455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6db52854036a69a1ebf31a4b990581d4044eed5' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\esd\\detail.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90425acda8f6b25846-48225455',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f6bf0749_83204677',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f6bf0749_83204677')) {function content_5acda8f6bf0749_83204677($_smarty_tpl) {?>/**
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
 * Shopware UI - Article esd page
 */
//
//
Ext.define('Shopware.apps.Article.view.esd.Detail', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.panel.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-esd-detail',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-esd-detail',

    /**
     * The view needs to be scrollable
     * @string
     */
    autoScroll: true,

    layout: {
        align: 'stretch',
        type: 'hbox'
    },

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        esdInfo:{
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'esdinfo'/'title','default'=>'ESD-Version','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'title','default'=>'ESD-Version','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ESD version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'title','default'=>'ESD-Version','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            article: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'esdinfo'/'artcile','default'=>'Article:','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'artcile','default'=>'Article:','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'artcile','default'=>'Article:','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            serialAdministration: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'esdinfo'/'serial_administration','default'=>'Serial administration:','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'serial_administration','default'=>'Serial administration:','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Serial administration:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'serial_administration','default'=>'Serial administration:','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            enableSerialAdministration: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'esdinfo'/'enable_serial_administration','default'=>'Enables the administration of serials','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'enable_serial_administration','default'=>'Enables the administration of serials','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Enables the administration of serials<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'esdinfo'/'enable_serial_administration','default'=>'Enables the administration of serials','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        fileInfo:{
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileinfo'/'title','default'=>'File-Info','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileinfo'/'title','default'=>'File-Info','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
File info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileinfo'/'title','default'=>'File-Info','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            downloadFile: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileinfo'/'download_file','default'=>'Download file','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileinfo'/'download_file','default'=>'Download file','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Download file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileinfo'/'download_file','default'=>'Download file','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            noFile: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileinfo'/'no_file','default'=>'No file choosen','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileinfo'/'no_file','default'=>'No file choosen','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No file choosen<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileinfo'/'no_file','default'=>'No file choosen','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        fileUpload:{
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileupload'/'title','default'=>'File-Upload','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'title','default'=>'File-Upload','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
File upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'title','default'=>'File-Upload','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            selection: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileupload'/'selection','default'=>'Selection','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'selection','default'=>'Selection','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Selection<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'selection','default'=>'Selection','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            selectFile: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileupload'/'download_file','default'=>'Select file','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'download_file','default'=>'Select file','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'download_file','default'=>'Select file','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            dropZoneText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileupload'/'drop_zone_text','default'=>'Upload file via Drag and Drop','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'drop_zone_text','default'=>'Upload file via Drag and Drop','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Upload file via drag & drop<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'drop_zone_text','default'=>'Upload file via Drag and Drop','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },

        fileChoose:{
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'filechoose'/'title','default'=>'Choose File','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'filechoose'/'title','default'=>'Choose File','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'filechoose'/'title','default'=>'Choose File','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            pleaseChoose: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'detail'/'fileupload'/'please_choose','default'=>'Please choose...','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'please_choose','default'=>'Please choose...','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please select...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'detail'/'fileupload'/'please_choose','default'=>'Please choose...','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Initialize the Shopware.apps.Article.view.esd.List and defines the necessary default configuration
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.registerEvents();
        me.items = me.getItems();

        me.callParent(arguments);
    },

    /**
     * Defines additional events which will be fired from the component
     *
     * @return void
     */
    registerEvents: function () {
        this.addEvents(
            /**
             * @event downloadFile
             */
            'downloadFile',

            /**
             * @event backToList
             */
            'backToList',

            /**
             * @event hasSerialsChanged
             * @param [boolean]
             */
            'hasSerialsChanged',

            /**
             * @event fileChange
             * @param [string]
             */
            'fileChanged'
        );
    },

    /**
     * Creates the items
     *
     * @return [array] items
     */
    getItems: function() {
        var me = this;
        return [
            {
                xtype: 'container',
                padding: 10,
                flex: 4,
                layout: {
                    align: 'stretch',
                    type: 'vbox'
                },
                items: [
                    me.getEsdInfoPanel(),
                    {
                        xtype: 'article-esd-serials',
                        store: me.serialStore,
                        disabled: !me.esdRecord.get('hasSerials'),
                        flex: 1
                    }
                ]
            },
            {
                xtype: 'container',
                padding: 10,
                flex: 2,
                items: [
                    me.getFileInfoPanel(),
                    me.getFileUploadPanel(),
                    me.getFileChoosePanel()
                ]
            }
        ];
    },

    /**
     * @return [object]
     */
    getEsdInfoPanel: function() {
        var me = this;

        var name = me.esdRecord.get('name');

        if (me.esdRecord.get('additionalText')) {
            name = name + ' - ' + me.esdRecord.get('additionalText');
        }

        return  {
            xtype: 'form',
            margin: '0 0 10',
            flex: 0,
            defaults: {
                labelWidth: 155
            },
            bodyPadding: 10,
            title: me.snippets.esdInfo.title,
            items: [
                {
                    xtype: 'displayfield',
                    readonly: true,
                    value: name,
                    fieldLabel: me.snippets.esdInfo.article,
                    anchor: '100%'
                },
                {
                    xtype: 'checkboxfield',
                    fieldLabel: me.snippets.esdInfo.serialAdministration,
                    boxLabel: me.snippets.esdInfo.enableSerialAdministration,
                    checked: me.esdRecord.get('hasSerials'),
                    anchor: '100%',
                    handler: function(checkbox, checked) {
                        me.fireEvent('hasSerialsChanged', checked);
                    }
                }
            ]
        };
    },


    /**
     * Creates the XTemplate for the file information panel
     *
     * @return [object] generated Ext.XTemplate
     */
    createInfoPanelTemplate: function() {
        var me = this;
        return new Ext.XTemplate(
            '<tpl for=".">',
            '<tpl if="file">',
            '<p><span style="font-weight: bold;">Dateiname:</span> {file}</p>',
            '<tpl else>',
            '<p>' + me.snippets.fileInfo.noFile + '</p>',
            '</tpl>',
            '</tpl>'
        );
    },

    /**
     * Returns the fileinfo panel
     *
     * @return [object]
     */
    getFileInfoPanel: function() {
        var me = this;

        me.infoView = Ext.create('Ext.view.View', {
            tpl: me.createInfoPanelTemplate(),
            margin: '0 0 12',
            data: me.esdRecord.data
        });

        me.downloadButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-inbox-download',
            text: me.snippets.fileInfo.downloadFile,
            action: 'downloadFile',
            handler: function() {
                me.fireEvent('downloadFile');
            }
        });

        return {
            xtype: 'panel',
            margin: '0 0 10',
            bodyPadding: 8,
            title: me.snippets.fileInfo.title,
            items: [
                me.infoView,
                me.downloadButton
            ]
        };
    },


    /**
     * Creates the drop zone for article images
     * @return Shopware.app.FileUpload
     */
    getMediaDropZone: function() {
        var me = this;

        return Ext.create('Shopware.app.FileUpload', {
            name: 'drop-zone',
            requestURL: '<?php echo '/shopware4/backend/article/uploadEsdFile';?>',
            showInput: false,
            padding:0,
            checkSize: false,
            checkType: false,
            checkAmount: false,
            enablePreviewImage: false,
            dropZoneText: me.snippets.fileUpload.dropZoneText
        });
    },

    getFileUploadPanel: function() {
        var me = this;

        me.uploadField  = Ext.create('Ext.form.field.File', {
            buttonOnly: false,
            xtype: 'filefield',
            margin: '0 0 10',
            fieldLabel: me.snippets.fileUpload.selection,
            labelWidth: 60,
            anchor: '100%',
            buttonText : me.snippets.fileUpload.selectFile,
            listeners: {
                scope: this,
                afterrender: function(btn) {
                    btn.fileInputEl.dom.multiple = true;
                },
                change: function(field) {
                    me.fireEvent('mediaUpload', field);
                }
            },
            buttonConfig : {
                iconCls: 'sprite-inbox-upload',
                cls: 'small secondary'
            }
        });

        return {
            xtype: 'form',
            margin: '0 0 10',
            bodyPadding: 10,
            title: me.snippets.fileUpload.title,
            items: [
                me.uploadField,
                me.getMediaDropZone()
            ]
        };
    },

    getFileChoosePanel: function() {
        var me = this;

        return {
            xtype: 'panel',
            layout: {
                type: 'anchor'
            },
            bodyPadding: 10,
            title: me.snippets.fileChoose.title,
            items: [
                {
                    xtype: 'combobox',
                    store: me.fileStore,
                    valueField: 'filename',
                    forceSelection: true,
                    queryMode: 'local',
                    displayField: 'filename',
                    fieldLabel: 'Datei',
                    emptyText: me.snippets.fileChoose.pleaseChoose,
                    anchor: '100%',
                    listeners: {
                        select: function(field, records) {
                            var filename = records[0].get('filename');
                            me.fireEvent('fileChanged', filename);
                        }
                    }
                }
            ]
        };
    }
});
//

<?php }} ?>