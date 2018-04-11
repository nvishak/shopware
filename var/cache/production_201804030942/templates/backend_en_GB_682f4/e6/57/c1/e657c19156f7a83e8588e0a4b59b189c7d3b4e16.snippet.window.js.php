<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\view\add_filter\window.js" */ ?>
<?php /*%%SmartyHeaderCode:291345acda8f1f0aff0-58719793%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e657c19156f7a83e8588e0a4b59b189c7d3b4e16' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\view\\add_filter\\window.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '291345acda8f1f0aff0-58719793',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f2069d14_95661491',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f2069d14_95661491')) {function content_5acda8f2069d14_95661491($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.ArticleList.view.AddFilter.Window', {
    /**
     * Define that the plugin manager main window is an extension of the enlight application window
     * @string
     */
    extend: 'Enlight.app.Window',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.multi-edit-add-filter-window',

    /**
     * Set no border for the window
     * @boolean
     */
    border: false,

    /**
     * True to automatically show the component upon creation.
     * @boolean
     */
    autoShow: true,

    /**
     * Set border layout for the window
     * @string
     */

    /**
     * Define window width
     * @integer
     */
    width: 700,

    /**
     * Define window height
     * @integer
     */
    height: 500,

    /**
     * True to display the 'maximize' tool button and allow the user to maximize the window, false to hide the button and disallow maximizing the window.
     * @boolean
     */
    maximizable: true,

    /**
     * True to display the 'minimize' tool button and allow the user to minimize the window, false to hide the button and disallow minimizing the window.
     * @boolean
     */
    minimizable: true,

    /**
     * A flag which causes the object to attempt to restore the state of internal properties from a saved state on startup.
     */
    stateful: true,

    /**
     * The unique id for this object to use for state management purposes.
     */
    stateId: 'shopware-multi-edit-add-filter-window',

    /**
     * Title of the window.
     * @string
     */
    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'windowTitle','default'=>'Add/Edit Filter','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'windowTitle','default'=>'Add/Edit Filter','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add/Edit Filter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'windowTitle','default'=>'Add/Edit Filter','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    resizable: true,

    /**
     * Set the window's layout to "fit"
     */
    layout: 'fit',

    /**
     * Define (default) borders
     */
    bodyPadding: 10,
    defaults: {
        border: false,
        bodyBorder: 0
    },

    /**
     * Fix background color
     */
    bodyStyle: 'background-color: #f0f2f4;',

    /**
     * Initializes the component.
     *
     * @public
     * @return void
     */
    initComponent: function () {
        var me = this;


        me.dockedItems = [{
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items: me.getFormButtons()
        }];

        me.items = me.getItems();

        me.addEvents(
            /**
             * Fires after the user clicked a tab
             */
            'tabChanged'
        );

        me.callParent(arguments);
    },

    getItems: function() {
        var me = this;


        return [{
            xtype: 'form',
            layout: {
                type: 'vbox',
                pack: 'start',
                align: 'stretch'
            },

            items: [
                me.getSaveFieldSet(),
                me.getTabPanel(),
            ]
        }];
    },

    getSaveFieldSet: function() {
        var me = this;

        return {
            xtype: 'fieldset',
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'saveTitle','default'=>'Save','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveTitle','default'=>'Save','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveTitle','default'=>'Save','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            margin: 5,
            items: [
                {
                    xtype: 'label',
                    text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'labelDesc','default'=>'In order to save the filter above, enter a name and optionally a description','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'labelDesc','default'=>'In order to save the filter above, enter a name and optionally a description','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To save the filter, type a name and an optional description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'labelDesc','default'=>'In order to save the filter above, enter a name and optionally a description','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    style: {
                        display: 'block'
                    },
                    margin: '0 0 18px'
                },
                {
                    xtype: 'textfield',
                    name: 'name',
                    fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'saveName','default'=>'Filter name','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveName','default'=>'Filter name','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Filter name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveName','default'=>'Filter name','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    anchor: '100%',
                    allowBlank: false
                },
                {
                    xtype: 'textarea',
                    name: 'description',
                    fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'saveDescription','default'=>'Your description','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveDescription','default'=>'Your description','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveDescription','default'=>'Your description','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    anchor: '100%'
                }
            ]
        };
    },


    /**
     * Creates the save and cancel button for the form panel.
     *
     * @return [array] - Contains the cancel button and the save button
     */
    getFormButtons: function() {
        var me = this,
            buttons = [ '->' ];


        var cancelButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'cancel','default'=>'Cancel','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            scope: me,
            cls: 'secondary',
            handler:function () {
                me.down('form').getForm().reset();
                me.down('grid').getStore().removeAll();
                // Make sure, that the dropdown is hidden, when the window is closed
                me.down('filterString').collapse();
                me.hide();
            }
        });
        buttons.push(cancelButton);

        var saveButton = Ext.create('Ext.button.Button', {
            action: 'saveAdvanced',
            cls: 'primary',
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'saveButton','default'=>'Save','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveButton','default'=>'Save','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'saveButton','default'=>'Save','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        buttons.push(saveButton);

        return buttons;
    },

    getTabPanel: function()  {
        var me = this;

        return Ext.create('Ext.tab.Panel', {
            name: 'filter-tab-panel',
            flex: 1,
            plain: true,
            items: [{
                xtype: 'query-field',
                internalTitle: 'extended',
                title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'advancedTitle','default'=>'Advanced','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'advancedTitle','default'=>'Advanced','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Advanced<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'advancedTitle','default'=>'Advanced','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                tabConfig: {
                    tooltip: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'advancedTooltip','default'=>'In advanced mode, you can define and combine your conditions very free','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'advancedTooltip','default'=>'In advanced mode, you can define and combine your conditions very free','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
In advanced mode, you can freely define and combine your conditions<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'advancedTooltip','default'=>'In advanced mode, you can define and combine your conditions very free','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                }
            },{
                xtype: 'multi-edit-add-filter-grid',
                internalTitle: 'simple',
                filterableColumns: me.filterableColumns,
                columnStore: me.columnStore,
                operatorStore: me.operatorStore,
                title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'simpleTitle','default'=>'Simple','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'simpleTitle','default'=>'Simple','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Simple<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'simpleTitle','default'=>'Simple','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                border: false,
                tabConfig: {
                    tooltip: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'simpleTooltip','default'=>'In simple mode, all conditions are conjuncted with AND','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'simpleTooltip','default'=>'In simple mode, all conditions are conjuncted with AND','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
In simple mode, all conditions are agregated with AND<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'simpleTooltip','default'=>'In simple mode, all conditions are conjuncted with AND','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                }
            }],
            listeners: {
                tabchange: function(tabPanel, newCard, oldCard, eOpts) {
                    me.fireEvent('tabChanged', tabPanel, newCard, oldCard);
                }
            }
        });
    }
});
//
<?php }} ?>