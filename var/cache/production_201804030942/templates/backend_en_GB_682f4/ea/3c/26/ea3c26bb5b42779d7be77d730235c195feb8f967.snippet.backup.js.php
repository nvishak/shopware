<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:32
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\controller\backup.js" */ ?>
<?php /*%%SmartyHeaderCode:124265acda8f42fb9c2-68847945%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea3c26bb5b42779d7be77d730235c195feb8f967' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\controller\\backup.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124265acda8f42fb9c2-68847945',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f43d2aa9_48990885',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f43d2aa9_48990885')) {function content_5acda8f43d2aa9_48990885($_smarty_tpl) {?>/**
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

/**
 * The backup controller handles the backup
 */
//
//
Ext.define('Shopware.apps.ArticleList.controller.Backup', {

    /**
     * The parent class that this class extends.
     * @string
     */
    extend: 'Ext.app.Controller',

    refs: [
        { ref:'mainGrid', selector:'multi-edit-main-grid' },
        { ref:'backupGrid', selector:'multi-edit-backup-grid' }
    ],

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @return void
     */
    init: function () {
        var me = this;

        me.control({
            'multiedit-main-window button[action=backup]': {
                click: me.onOpenBackupWindow
            },
            'multi-edit-backup-grid': {
                restoreBackup: me.onRestoreBackup,
                deleteBackup: me.onDeleteBackup
            }
        });

        me.subApplication.backupStore = me.getStore('Shopware.apps.ArticleList.store.Backup').load({
            params: {
                resource: 'product'
            }
        });
        me.subApplication.backupStore.getProxy().extraParams.resource = 'product';

        me.callParent(arguments);
    },

    /**
     * Called after the user clicked the 'delete backup' action button in the backup grid
     */
    onDeleteBackup: function(rowIdx) {
        var me = this,
            store = me.getBackupGrid().getStore(),
            record = store.getAt(rowIdx);

        Ext.MessageBox.confirm(
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'deleteConfirm','default'=>'Delete the selected backup?','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'deleteConfirm','default'=>'Delete the selected backup?','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete the selected backup?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'deleteConfirm','default'=>'Delete the selected backup?','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'deleteConfirmMessage','default'=>'You are about to delete the selected backup from [0]. Do you want to proceed?','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'deleteConfirmMessage','default'=>'You are about to delete the selected backup from [0]. Do you want to proceed?','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
You are about to delete the selected backup from [0]. Do you want to proceed?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'deleteConfirmMessage','default'=>'You are about to delete the selected backup from [0]. Do you want to proceed?','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', record.get('date')),
            function (response) {
                if ( response !== 'yes' ) {
                    return;
                }

                record.destroy({
                    params: {
                        resource: 'product'
                    },
                    success: function() {
                        store.reload();
                        Shopware.Notification.createGrowlMessage('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'successTitle','default'=>'Success','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'successTitle','default'=>'Success','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Success<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'successTitle','default'=>'Success','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'successDeleteMessage','default'=>'Successfully deleted [0]','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'successDeleteMessage','default'=>'Successfully deleted [0]','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Successfully deleted [0]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'successDeleteMessage','default'=>'Successfully deleted [0]','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', ''));
                    },
                    failure: function() {
                        store.reload();
                        Shopware.Notification.createGrowlMessage('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'errorTitle','default'=>'Error','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'errorTitle','default'=>'Error','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'errorTitle','default'=>'Error','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'errorDeleteMessage','default'=>'Could not delete the backup folder - make sure, it is empty','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'errorDeleteMessage','default'=>'Could not delete the backup folder - make sure, it is empty','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Could not delete the backup folder - make sure, it is empty<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'errorDeleteMessage','default'=>'Could not delete the backup folder - make sure, it is empty','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                    }
                });

            }
        );
    },

    /**
     * Callback function triggered, when the user clicked the 'restore' button in the main window
     */
    onOpenBackupWindow: function() {
        var me = this,
            window;

        window = me.getBackupWindow();

        window.show();
    },

    /**
     * Convenience method to show a sticky growl message
     *
     * @param message
     */
    showError: function(message) {
        var me = this;

        Shopware.Notification.createStickyGrowlMessage({
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'error','default'=>'Error','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error','default'=>'Error','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error','default'=>'Error','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            text: message,
            log: true
        },
        'ArticleList');
    },


    /**
     * Callback method triggered, after the user presses the 'reset' action button.
     */
    onRestoreBackup: function(rowIdx) {
        var me = this;

        Ext.MessageBox.confirm(
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'addConfirm','default'=>'Revert these changes?','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'addConfirm','default'=>'Revert these changes?','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Revert these changes?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'addConfirm','default'=>'Revert these changes?','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'addConfirm'/'Message','default'=>'You are about to revert the selected changes. Do you want to proceed?','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'addConfirm'/'Message','default'=>'You are about to revert the selected changes. Do you want to proceed?','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
You are about to revert the selected changes. Do you want to proceed?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'addConfirm'/'Message','default'=>'You are about to revert the selected changes. Do you want to proceed?','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            function (response) {
                if ( response !== 'yes' ) {
                    return;
                }
                var config = me.initBackup(rowIdx);
                me.runRestore(config, 0)
            }
        );
    },

    /**
     * Init backup
     *
     * @returns Object
     */
    initBackup: function(rowIdx) {
        var me = this,
            record = me.subApplication.backupStore.getAt(rowIdx);

        me.cancel = false;

        me.createRestoreBackupWindow();

        return { id: record.get('id'), filterString: record.get('filterString'), operationString: record.get('operationString').replace(/[\r\n]+/g, '<br>') };
    },

    /**
     * Creates a Ext.MessageBox with a progressbar in order to show a process while restoring the backup
     */
    createRestoreBackupWindow: function() {
        var me = this;

        me.progressWindow = Ext.MessageBox.show({
            title        : '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'restoringTitle','default'=>'Restoring the backup','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoringTitle','default'=>'Restoring the backup','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Restoring the backup<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoringTitle','default'=>'Restoring the backup','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            msg          : "<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'restoringMessage','default'=>'Currently restoring the selected backup.','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoringMessage','default'=>'Currently restoring the selected backup.','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Currently restoring the selected backup.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoringMessage','default'=>'Currently restoring the selected backup.','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
            width        : 500,
            progress     : true,
            closable     : false,
            buttons      : Ext.MessageBox.CANCEL,
            fn           : function(buttonId, text, opt) {

                if (buttonId != 'cancel') {
                    return;
                }

                // Set the cancel property to true in order to cancel the migration
                // after the next request
                me.cancel = true;
            }
        });

        // workaround to set the height of the MessageBox
        me.progressWindow.setSize(500, 150);
        me.progressWindow.doLayout();


        me.progressWindow.progressBar.reset();
        me.progressWindow.progressBar.animate = true;
        me.progressWindow.progressBar.updateProgress(0, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'startingRevert','default'=>'Begin restoring the selected file…','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'startingRevert','default'=>'Begin restoring the selected file…','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Begin restoring the selected file…<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'startingRevert','default'=>'Begin restoring the selected file…','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
    },

    /**
     * Called recursively until all items have been processed.
     *
     * @param config
     * @param offset
     */
    runRestore: function(config, offset) {
        var me = this;

        if (me.cancel) {
            me.cancel = false;
            return;
        }

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/ArticleList/restore';?>',
            timeout: 4000000,
            params : {
                resource: 'product',
                id: config.id,
                offset: offset
            },
            success: function (response, request) {
                if (!response.responseText) {
                    me.showError('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An unknown error occurred, please check your server logs<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                    return;
                }

                var result = Ext.JSON.decode(response.responseText);

                if(!result) {
                    me.progressWindow.close();
                    me.showError(response.responseText);
                }else if(!result.success) {
                    me.progressWindow.close();
                    me.showError(result.message);
                }else{
                    if (result.data.offset < result.data.totalCount) {
                        progressText =  Ext.String.format("<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'backup'/'alreadyRestored','default'=>'[0] out of [1] deltas restored','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'alreadyRestored','default'=>'[0] out of [1] deltas restored','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
[0] out of [1] deltas restored<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'backup'/'alreadyRestored','default'=>'[0] out of [1] deltas restored','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
", result.data.offset, result.data.totalCount);
                        me.progressWindow.progressBar.updateProgress(result.data.offset/result.data.totalCount, progressText);

                        me.runRestore(config, result.data.offset);
                    }else{
                        Shopware.Notification.createStickyGrowlMessage({
                                title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'restoredBackup','default'=>'Backup restored','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoredBackup','default'=>'Backup restored','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Backup restored<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'restoredBackup','default'=>'Backup restored','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                                text: Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'createdRestoreMessage','default'=>'The following changes have been undone:<br>[0]','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'createdRestoreMessage','default'=>'The following changes have been undone:<br>[0]','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The following changes have been undone:<br>[0]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'createdRestoreMessage','default'=>'The following changes have been undone:<br>[0]','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', config.operationString),
                                log: true
                            },
                            'ArticleList'
                        );

                        me.progressWindow.progressBar.updateProgress(1, "Done");
                        me.progressWindow.close();

                        // Reload the main grid - only possible if an AST was defined for that store
                        if (me.getMainGrid().getStore().getProxy().extraParams.ast) {
                            me.getMainGrid().getStore().reload();
                        }
                    }
                }

            },
            failure: function (response, request) {
                if(response.responseText) {
                    me.showError(response.responseText);
                } else {
                    me.showError('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An unknown error occurred, please check your server logs<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                }
            }
        });
    },

    /**
     * Return an existing instance of the backup window or create a new one
     *
     * @returns Ext.window
     */
    getBackupWindow: function() {
        var me = this;

        me.subApplication.backupStore.load();

        if (me.subApplication.backupWindow && !me.subApplication.backupWindow.isDestroyed) {
            return me.subApplication.backupWindow;
        } else {
            me.subApplication.backupWindow = me.getView('Backup.Window').create({
                backupStore: me.subApplication.backupStore
            });
        }

        return me.subApplication.backupWindow;

    }


});
//
<?php }} ?>