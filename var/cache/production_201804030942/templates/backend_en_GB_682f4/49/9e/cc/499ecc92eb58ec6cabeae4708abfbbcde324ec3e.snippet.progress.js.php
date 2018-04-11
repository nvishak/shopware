<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\image\progress.js" */ ?>
<?php /*%%SmartyHeaderCode:34905acda8f42f96a8-10788567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '499ecc92eb58ec6cabeae4708abfbbcde324ec3e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\image\\progress.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34905acda8f42f96a8-10788567',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f43325d7_85840379',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f43325d7_85840379')) {function content_5acda8f43325d7_85840379($_smarty_tpl) {?>/**
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
 * Shopware UI - Article Image assign variants progress window.
 */
//
//
Ext.define('Shopware.apps.Article.view.image.Progress', {
    extend: 'Shopware.window.Progress',

    /**
     * The name to identify our component
     *
     * @type { string }
     */
    name: 'image-variants-progress-window',

    /**
     * The window title
     *
     * @type { string }
     */
    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image/variant_info/progress/title','default'=>'Assigning variant configurations','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image/variant_info/progress/title','default'=>'Assigning variant configurations','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assigning variant configurations<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image/variant_info/progress/title','default'=>'Assigning variant configurations','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    /**
     * Internal flag which defines if the batch-processing may start.
     *
     * @type { boolean }
     */
    allowStart: false,

    /**
     * Will contain the mapping window which opened this progress component.
     * It needs to be destroyed once the progress is done.
     *
     * @type { Shopware.apps.Article.view.image.Mapping }
     */
    mappingWindow: undefined,

    /**
     * Instance of the start progress button which allows the user
     * to start the batch process.
     * The start button is created in the { @link #createStartButton } function.
     *
     * @type { Ext.button.Button }
     */
    startProgressButton: undefined,

    /**
     * @Override
     *
     * @param { Ext.data.Batch } batch
     * @param { Ext.data.Operation } operation
     * @returns { Shopware.model.DataOperation }
     */
    createResponseRecord: function (batch, operation) {
        var rawData = batch.proxy.getReader().rawData,
            errorMessage = '';

        if (!rawData.success && rawData.noId) {
            errorMessage = 'No image id was applied';
        }

        return Ext.create('Shopware.model.DataOperation', {
            success: rawData.success,
            error: errorMessage,
            request: { url: operation.batch.proxy.api.update },
            operation: operation
        });
    },

    /**
     * @Override
     *
     * @param { Object } currentTask
     * @param { Object[] } remainingTasks
     */
    sequentialProcess: function (currentTask, remainingTasks) {
        if (!this.allowStart) {
            return;
        }

        this.callParent(arguments);
    },

    /**
     * @Override
     *
     * @returns { Ext.button.Button[] }
     */
    createToolbarItems: function () {
        var items = this.callParent(arguments);

        this.closeButton.setVisible(false);

        this.registerCustomButtonHandler(this.closeButton);
        this.registerCustomButtonHandler(this.cancelButton);

        items.push(this.createStartButton());

        return items;
    },

    /**
     * @Override
     */
    onCancelProgress: function () {
        this.cancelProcess = true;
        this.startProgressButton.destroy();

        if (!this.allowStart) {
            this.allowStart = true;
            this.sequentialProcess(undefined, this.getConfig('tasks'));
        }
    },

    /**
     * @returns { Ext.button.Button }
     */
    createStartButton: function () {
        var me = this;

        me.startProgressButton = Ext.create('Ext.button.Button', {
            cls: 'primary',
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'image/variant_info/progress/save_button/text','default'=>'Save configurations','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image/variant_info/progress/save_button/text','default'=>'Save configurations','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save configurations<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'image/variant_info/progress/save_button/text','default'=>'Save configurations','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            handler: function () {
                me.allowStart = true;
                me.sequentialProcess(undefined, me.getConfig('tasks'));

                this.destroy();
            }
        });

        return me.startProgressButton;
    },

    /**
     * @param { Ext.button.Button } btn
     */
    registerCustomButtonHandler: function (btn) {
        btn.on('disable', function (btn) {
            btn.setVisible(false);
        });

        btn.on('enable', function (btn) {
            btn.setVisible(true);
        });
    }
});
//
<?php }} ?>