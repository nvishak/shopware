<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:33
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\variant\image_relation_process.js" */ ?>
<?php /*%%SmartyHeaderCode:279325acda8f57a1683-73652011%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70699fcbc12018ff8d1b5c16b678603fa0ae52e1' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\variant\\image_relation_process.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '279325acda8f57a1683-73652011',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f57e66d3_83442294',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f57e66d3_83442294')) {function content_5acda8f57e66d3_83442294($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Article.view.variant.ImageRelationProcess', {
    extend: 'Enlight.app.Window',
    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image_relation_process/window/title','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/title','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Update image mapping<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/title','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
    autoShow: false,
    width: 360,
    height: 140,

    /**
     * Creates a queue and starts the save mappings progress
     */
    initComponent: function() {
        var me = this;

        me.items = me.createItems();
        me.createQueue();

        me.callParent(arguments);
    },

    /**
     * @override
     *
     * if no pictures to map close the window
     */
    afterShow: function() {
        var me = this;
        me.callParent(arguments);

        if (me.getQueueLength() > 0) {
            me.updateProgressBar();
            me.saveNextMapping();
        } else {
            me.close();
        }
    },

    /**
     * Gets the next object from the queue and creates a store to save it
     */
    saveNextMapping: function() {
        var me = this,
            media = me.getNextFromQueue(),
            mappingStore = Ext.create('Shopware.apps.Article.store.MediaMapping');

        media.setDirty();
        mappingStore.add(media);

        mappingStore.sync({
            success: function() {
                me.updateProgressBar();

                if (me.getQueueLength() > 0) {
                    me.saveNextMapping();
                    return;
                }

                me.destroy();
            },
            failure: function() {
                me.showMessage('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image_relation_process/window/failure/text','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/failure/text','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An error has occurred while saving the image mapping.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/failure/text','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            }
        });
    },

    /**
     * Creates a container with the UI elements
     *
     * @return { Ext.container.Container }
     */
    createItems: function() {
        var me = this;

        return Ext.create('Ext.container.Container', {
            padding: 20,
            style: {
                background: '#F7F7F7'
            },
            items: [
                me.createInfoContainer(),
                me.createProgressBar()
            ]
        });
    },

    /**
     * Creates the info container
     *
     * @return { Ext.container.Container }
     */
    createInfoContainer: function() {
        return Ext.create('Ext.container.Container', {
            anchor: '100%',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image_relation_process/window/info/text','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/info/text','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The image mapping will be regenerated.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/info/text','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            style: 'color: #999; font-style: italic; margin: 0 0 15px 0; text-align: center;'
        });
    },

    /**
     * creates the progress bar
     *
     * @return { Ext.ProgressBar }
     */
    createProgressBar: function() {
        var me = this;

        me.progressBar = Ext.create('Ext.ProgressBar', {
            anchor: '100%',
            animate: true,
            margin: '0 0 15',
            style: 'border-width: 1px !important;',
            cls: 'left-align'
        });

        return me.progressBar;
    },

    /**
     * Updates the progressbar, creates the property totalCount and current step,
     * updates the current step and updates the progressbar progress
     */
    updateProgressBar: function() {
        var me = this,
            text = '';

        if (!me.hasOwnProperty('totalCount')) {
            me.totalCount = me.getQueueLength();
        }

        if (!me.hasOwnProperty('currentStep')) {
            me.currentStep = 0;
        } else {
            me.currentStep++;
        }

        text = me.currentStep + ' <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image_relation_process/window/of','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/of','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
of<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image_relation_process/window/of','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + me.totalCount;

        me.progressBar.updateProgress(1 / me.totalCount * me.currentStep, text, false);
    },

    /**
     * Creates the queue from the media mappings and set the property queue.
     */
    createQueue: function() {
        var me = this;

        me.queue = [];

        me.article.getMedia().each(function(media) {
            if (media.getMappings().getCount() > 0) {
                me.addToQueue(media);
            }
        });
    },

    /**
     * Adds a model to the queue.
     *
     * @param { Ext.data.Model } data
     */
    addToQueue: function(data) {
        this.queue.push(data);
    },

    /**
     * Returns the next model of the queue
     *
     * @return { Ext.data.Model }
     */
    getNextFromQueue: function() {
        return this.queue.shift();
    },

    /**
     * returns the length of the queue
     *
     * @return { Number }
     */
    getQueueLength: function() {
        return this.queue.length;
    },

    /**
     * Creates a growl message with the passed string
     *
     * @param { string } message
     */
    showMessage: function(message) {
        Shopware.Notification.createGrowlMessage('', message);
    }
});
// <?php }} ?>