<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:33
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\variant\number_progress.js" */ ?>
<?php /*%%SmartyHeaderCode:250705acda8f5477ec1-16308550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33cf455abca46bae5fce37c9331d6ac225005920' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\variant\\number_progress.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '250705acda8f5477ec1-16308550',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f54de185_94363966',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f54de185_94363966')) {function content_5acda8f54de185_94363966($_smarty_tpl) {?>/**
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
 */

//

//
Ext.define('Shopware.apps.Article.view.variant.NumberProgress', {

    /**
     * Define that the order main window is an extension of the enlight application window
     * @string
     */
    extend: 'Enlight.app.SubWindow',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-number-progress-window',

    /**
     * Define window width
     * @integer
     */
    width: 360,

    /**
     * Define window height
     * @integer
     */
    height: 170,

    /**
     * Display no footer button for the detail window
     * @boolean
     */
    footerButton: false,

    /**
     * Set vbox layout and stretch align to display the toolbar on top and the button container
     * under the toolbar.
     * @object
     */
    layout: {
        align: 'stretch',
        type: 'vbox'
    },

    /**
     * If the modal property is set to true, the user can't change the window focus to another window.
     * @boolean
     */
    modal: true,

    /**
     * The body padding is used in order to have a smooth side clearance.
     * @integer
     */
    bodyPadding: 10,

    /**
     * Disable the close icon in the window header
     * @boolean
     */
    closable: false,

    /**
     * Disable window resize
     * @boolean
     */
    resizable: false,

    /**
     * Disables the maximize button in the window header
     * @boolean
     */
    maximizable: false,
    /**
     * Disables the minimize button in the window header
     * @boolean
     */
    minimizable: false,

    /**
     * Contains all snippets for the component
     * @object
     */
    snippets: {
        cancel:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'progress'/'cancel','default'=>'Cancel process','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress'/'cancel','default'=>'Cancel process','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel process<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress'/'cancel','default'=>'Cancel process','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        start:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'progress'/'start','default'=>'Start process','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress'/'start','default'=>'Start process','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Start process<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress'/'start','default'=>'Start process','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        close:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'progress'/'close','default'=>'Close window','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress'/'close','default'=>'Close window','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Close window<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress'/'close','default'=>'Close window','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'progress_window'/'title','default'=>'Generate order numbers','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_window'/'title','default'=>'Generate order numbers','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Generate order numbers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'progress_window'/'title','default'=>'Generate order numbers','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    batchSize: 200,
    totalCount: 1,

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
    initComponent: function () {
        var me = this;

        me.registerEvents();
        me.items = [
            me.createProgressBar(),
            me.createBatchSizeCombo(),
            me.createButtons()
        ];
        me.callParent(arguments);
    },


    /**
     * Registers additional component events.
     */
    registerEvents: function() {
        this.addEvents(
            'cancelNumberProcess',
            'startNumberProcess'
        );
    },

    createBatchSizeCombo: function() {
        var me = this;

        me.combo = Ext.create('Ext.form.ComboBox', {
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'multi_request'/'batch'/'label','default'=>'Batch size','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'multi_request'/'batch'/'label','default'=>'Batch size','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Batch size<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'multi_request'/'batch'/'label','default'=>'Batch size','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            helpText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'multi_request'/'batch'/'help','default'=>'How many records should be processed per request? Default: 200','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'multi_request'/'batch'/'help','default'=>'How many records should be processed per request? Default: 200','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
How many records should be processed per request? Default: 200<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'multi_request'/'batch'/'help','default'=>'How many records should be processed per request? Default: 200','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            name: 'batchSize',
            forceSelection: true,
            margin: '0 0 10 0',
            allowBlank: false,
            value: 200,
            editable: true,
            displayField: 'batchSize',
            store: Ext.create('Ext.data.Store', {
                fields: [
                    { name: 'batchSize',  type: 'int' }
                ],
                data : [
                    { batchSize: '1' },
                    { batchSize: '5' },
                    { batchSize: '10' },
                    { batchSize: '20' },
                    { batchSize: '30' },
                    { batchSize: '50' },
                    { batchSize: '75' },
                    { batchSize: '100' },
                    { batchSize: '150' },
                    { batchSize: '200' },
                    { batchSize: '250' },
                    { batchSize: '500' },
                    { batchSize: '1000' },
                    { batchSize: '1500' }
                ]
            })
        });

        return me.combo;
    },

    /**
     * Creates the progress which displays the progress status for the document creation.
     */
    createProgressBar: function() {
        var me = this;

        me.progressBar = Ext.create('Ext.ProgressBar', {
            animate: true,
            margin: '0 0 15',
            style: 'border-width: 1px !important;',
            cls:'left-align'
        });

        return me.progressBar;
    },

    /**
     * Creates the cancel button which allows the user to cancel the document creation in the
     * batch window. Event will be handled in the batch controller.
     */
    createStartButton: function() {
        var me = this;

        return Ext.create('Ext.button.Button', {
            text: me.snippets.start,
            cls: 'primary',
            action: 'start',
            disabled: false,
            handler: function() {
                this.hide();
                me.cancelButton.show();
                me.closeButton.disable();
                me.fireEvent('startNumberProcess', me);
            }
        });
    },

    /**
     * Creates the cancel button which allows the user to cancel the document creation in the
     * batch window. Event will be handled in the batch controller.
     */
    createCancelButton: function() {
        var me = this;

        return Ext.create('Ext.button.Button', {
            text: me.snippets.cancel,
            cls: 'primary',
            action: 'cancel',
            disabled: false,
            hidden: true,
            handler: function() {
                this.disable();
                me.fireEvent('cancelNumberProcess', me);
            }
        });
    },

    /**
     * Creates the close button which allows the user to close the window. The window closing is handled over this
     * button to prevent that the user close the window while the batch process is already working.
     * So the user have to wait until the process are finish or the user can clicks the cancel button.
     * The button will enabled after the batch process are finish or the cancel event are fired and the batch process
     * successfully canceled.
     */
    createCloseButton: function() {
        var me = this;

        return Ext.create('Ext.button.Button', {
            text: me.snippets.close,
            flex: 1,
            action: 'closeWindow',
            cls: 'secondary',
            handler: function() {
                me.hide();
            }
        });
    },

    /**
     * Creates the button container for the close and cancel button
     *
     * @return Ext.container.Container
     */
    createButtons: function() {
        var me = this;

        me.startButton  = me.createStartButton();
        me.closeButton  = me.createCloseButton();
        me.cancelButton = me.createCancelButton();

        return Ext.create('Ext.container.Container', {
            layout: 'hbox',
            items: [
                me.startButton,
                me.cancelButton,
                me.closeButton
            ]
        });
    }
});
//
<?php }} ?>