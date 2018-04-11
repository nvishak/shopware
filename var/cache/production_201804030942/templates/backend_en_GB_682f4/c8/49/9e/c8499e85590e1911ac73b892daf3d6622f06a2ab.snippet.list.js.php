<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:34
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\esd\list.js" */ ?>
<?php /*%%SmartyHeaderCode:235175acda8f692f0a4-80582452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8499e85590e1911ac73b892daf3d6622f06a2ab' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\esd\\list.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235175acda8f692f0a4-80582452',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f69f9586_99252553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f69f9586_99252553')) {function content_5acda8f69f9586_99252553($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Article.view.esd.List', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-esd-list',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-esd-list',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        columns:{
            name:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'column'/'name','default'=>'Articlename','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'name','default'=>'Articlename','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'name','default'=>'Articlename','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            downloads:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'column'/'downloads','default'=>'Downloads','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'downloads','default'=>'Downloads','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Downloads<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'downloads','default'=>'Downloads','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            addedDate:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'column'/'addedDate','default'=>'Added','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'addedDate','default'=>'Added','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Added<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'addedDate','default'=>'Added','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            serials:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'column'/'serials','default'=>'Serials','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'serials','default'=>'Serials','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Serial<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'serials','default'=>'Serials','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            file:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'column'/'file','default'=>'File exists','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'file','default'=>'File exists','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Assign file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'file','default'=>'File exists','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

            remove: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'column'/'remove','default'=>'Remove ESD','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'remove','default'=>'Remove ESD','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete ESD<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'remove','default'=>'Remove ESD','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            edit: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'column'/'edit','default'=>'Edit ESD','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'edit','default'=>'Edit ESD','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Edit ESD<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'column'/'edit','default'=>'Edit ESD','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        toolbar:{
            add:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'toolbar'/'button_add','default'=>'Add as new ESD-Article','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'button_add','default'=>'Add as new ESD-Article','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add as new ESD item<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'button_add','default'=>'Add as new ESD-Article','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            remove:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'toolbar'/'button_delete','default'=>'Delete selected ESD-Articles','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'button_delete','default'=>'Delete selected ESD-Articles','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete selected ESD items<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'button_delete','default'=>'Delete selected ESD-Articles','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            search:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Search...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'search_empty_text','default'=>'Search...','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            choose:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'esd'/'list'/'toolbar'/'choose','default'=>'Choose Variant','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'choose','default'=>'Choose Variant','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select variant<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'esd'/'list'/'toolbar'/'choose','default'=>'Choose Variant','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Add attributes plugin
     */
    plugins: [
        {
            ptype: 'grid-attributes',
            table: 's_articles_esd_attributes'
        }
    ],

    /**
     * Initialize the Shopware.apps.Article.view.esd.List and defines the necessary default configuration
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.registerEvents();

        me.store = me.esdStore;

        me.selModel = me.getGridSelModel();
        me.columns = me.getColumns();
        me.toolbar = me.getToolbar();
        me.pagingbar = me.getPagingBar();
        me.dockedItems = [ me.toolbar, me.pagingbar ];

        me.callParent(arguments);
    },

    /**
     * Defines additional events which will be fired from the component
     *
     * @return void
     */
    registerEvents:function () {
        this.addEvents(
            /**
             * Event will be fired when the user clicks the delete button in the toolbar or
             * use the action column of the grid to remove one or multiple esds
             * @event deleteEsd
             * @param [array] Record - The selected records
             */
            'deleteEsd',

            /**
             * Event will be fired when the user clicks the add button in the toolbar
             * or makes a double click within the grid to add a new plain esd.
             * @param [string] articleDetailId
             * @event addEsd
             */
            'addEsd',

            /**
             * Event will be fired when the user insert a value into the search field of the toolbar
             * to filter the listing.
             * @event searchEsds
             */
            'searchEsd',

            /**
             * Event will be fired when the user clicks on the edit action column of the
             * grid, to edit a single esd.
             * @event editEsd
             * @param [Ext.data.Model] Record - The selected record
             */
            'editEsd'
        );
    },

    /**
     * Creates the grid columns
     *
     * @return [array] grid columns
     */
    getColumns: function () {
        var me = this;

        return [
            {
                header: me.snippets.columns.name,
                dataIndex: 'name',
                sortable: true,
                flex: 3,
                renderer: me.articleNameColumnRenderer
            }, {
                header: me.snippets.columns.downloads,
                dataIndex: 'downloads',
                sortable: true,
                flex: 1,
                renderer: me.colorColumnRenderer
            }, {
                header: me.snippets.columns.addedDate,
                xtype: 'datecolumn',
                dataIndex: 'date',
                sortable: true,
                flex: 2
            } , {
                header: me.snippets.columns.serials,
                renderer: me.serialsColumnRenderer,
                flex: 2

            }, {
                header: me.snippets.columns.file,
                dataIndex: 'file',
                renderer: me.activeColumnRenderer,
                flex: 1
            },
            {
                /**
                 * Special column type which provides clickable icons in each row
                 */
                xtype:'actioncolumn',
                width:70,
                items:[
                    {
                        iconCls:'sprite-pencil',
                        action:'editEsd',
                        tooltip:me.snippets.columns.edit,
                        handler:function (view, rowIndex, colIndex, item, opts, record) {
                            me.fireEvent('editEsd', record);
                        }
                    },
                    {
                        iconCls:'sprite-minus-circle-frame',
                        action:'deleteEsd',
                        tooltip:me.snippets.columns.remove,
                        handler: function (view, rowIndex, colIndex, item, opts, record) {
                            var records = [ record ];
                            me.fireEvent('deleteEsd', records);
                        }
                    }
                ]
            }
        ];
    },


    /**
     * Creates the grid selection model for checkboxes
     *
     * @return [Ext.selection.CheckboxModel] grid selection model
     */
    getGridSelModel: function () {
        var me = this;

        return Ext.create('Ext.selection.CheckboxModel', {
            listeners:{
                // Unlocks the delete button if the user has checked at least one checkbox
                selectionchange:function (sm, selections) {
                    me.deleteButton.setDisabled(selections.length === 0);
                }
            }
        });
    },

    /**
     * Creates the grid toolbar with the different buttons.
     * @return [Ext.toolbar.Toolbar] grid toolbar
     */
    getToolbar: function () {
        var me = this;

        //creates the delete button to remove all selected esds in one request.
        me.deleteButton = Ext.create('Ext.button.Button', {
            iconCls:'sprite-minus-circle-frame',
            text: me.snippets.toolbar.remove,
            disabled: true,
            action:'deleteEsd',
            handler: function() {
                var selectionModel = me.getSelectionModel(),
                    records = selectionModel.getSelection();

                if (records.length > 0) {
                    me.fireEvent('deleteEsd', records);
                }
            }
        });

        //creates the add button for the toolbar to grant the user the option to add esds manual.
        me.addButton = Ext.create('Ext.button.Button', {
            iconCls:'sprite-plus-circle-frame',
            text: me.snippets.toolbar.add,
            action:'addEsd',
            disabled: true,
            handler: function() {
                me.fireEvent('addEsd', me.combo.getValue());
                this.disable();
            }
        });

        //creates the search field to filter the listing.
        me.searchField = Ext.create('Ext.form.field.Text', {
            name:'searchfield',
            cls:'searchfield',
            width:170,
            emptyText:me.snippets.toolbar.search,
            enableKeyEvents:true,
            checkChangeBuffer:500,
            listeners: {
                change: function(field, value) {
                    me.fireEvent('searchEsd', value);
                }
            }
        });

        me.combo = Ext.create('Ext.form.ComboBox', {
            store: me.filteredStore,
            forceSelection: true,
            queryMode: 'local',
            valueField: 'id',
            width: 450,
            displayField: 'name',
            fieldLabel: me.snippets.toolbar.choose,
            emptyText: me.snippets.toolbar.choose,
            anchor: '100%',
            displayTpl: Ext.create('Ext.XTemplate',
                '<tpl for=".">',
                '' +
                    '{name}' +
                    '<tpl if="additionalText"> - {additionalText}</tpl>' +
                '',
                '</tpl>'
            ),
            tpl: Ext.create('Ext.XTemplate',
                '<tpl for=".">',
                    '' +
                        '<div class="x-boundlist-item">{name}' +
                        '<tpl if="additionalText">' +
                            '<span style="font-size:10px; font-weight: 800;"> - {additionalText}</span>' +
                        '</tpl>' +
                        '</div>' +
                    '',
                '</tpl>'
            ),
            listeners: {
                select: function(field, records) {
                    me.addButton.enable();
                }
            }
        });


        return Ext.create('Ext.toolbar.Toolbar', {
            dock:'top',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items:[
                me.combo,
                me.addButton,
                me.deleteButton,
                '->',
                me.searchField,
                { xtype:'tbspacer', width:6 }
            ]
        });
    },

    /**
     * Creates the paging toolbar for the grid to allow store paging. The paging toolbar uses the same store as the Grid
     *
     * @return Ext.toolbar.Paging The paging toolbar for the customer grid
     */
    getPagingBar: function () {
        var me = this;

        return Ext.create('Ext.toolbar.Paging', {
            store: me.store,
            dock:'bottom',
            displayInfo:true
        });
    },

    /**
     * Formats the name column
     *
     * @param [string] value - Name of the disptach
     * @param [object] metaData - Meta data for this column
     * @param [object] record - current record
     */
    articleNameColumnRenderer: function (value, metaData, record) {
        if (!record.get('additionalText')) {
            return value;
        }

        return Ext.String.format('{0} - {1}', value, record.get('additionalText'));
    },

    /**
     * Formats the serial column
     *
     * @param [string] value - Name of the disptach
     * @param [object] metaData - Meta data for this column
     * @param [object] record - current record
     */
    serialsColumnRenderer: function (value, metaData, record) {
        if (!record.get('hasSerials')) {
            return '<div class="sprite-cross" style="width: 25px; height: 25px">&nbsp;</div>';
        }

        if (record.get('serialsUsed') >= record.get('serialsTotal')) {
            return Ext.String.format('<span style="color:red;">{0} / {1}</span>', record.get('serialsUsed'), record.get('serialsTotal'));
        }

        return Ext.String.format('{0} / {1}', record.get('serialsUsed'), record.get('serialsTotal'));
    },

    /**
     * @param [object] - value
     */
    activeColumnRenderer: function(value) {
        if (value) {
            return '<div class="sprite-tick"  style="width: 25px; height: 25px">&nbsp;</div>';
        } else {
            return '<div class="sprite-cross" style="width: 25px; height: 25px">&nbsp;</div>';
        }
    },

    /**
     * @param [object] - value
     */
    colorColumnRenderer: function(value) {
        if (value > 0){
            return '<span style="color:green;">' + value + '</span>';
        } else {
            return '<span style="color:red;">' + value + '</span>';
        }
    }
});
//

<?php }} ?>