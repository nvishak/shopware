<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\main\stream_view.js" */ ?>
<?php /*%%SmartyHeaderCode:103165acda8f13803b7-15672099%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a12f6a23f786cc49cdb1deb2a03ec912fa727728' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\main\\stream_view.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103165acda8f13803b7-15672099',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f14b4e37_61600895',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f14b4e37_61600895')) {function content_5acda8f14b4e37_61600895($_smarty_tpl) {?>/**
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
 * @package    Customer
 * @subpackage Controller
 * @version    $Id$
 * @author shopware AG
 */

// 
// 

Ext.define('Shopware.apps.Customer.view.main.StreamView', {

    extend: 'Ext.panel.Panel',

    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_view_title','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_view_title','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer Streams<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_view_title','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',

    cls: 'customer-stream-view',

    layout: 'border',

    alias: 'widget.stream-view',

    activated: false,

    initComponent: function() {
        var me = this;

        me.items = me.createItems();
        me.dockedItems = me.createDockedItems();

        me.gridPanel.on('afterrender', function() {
            me.gridPanel.getEl().on('click', Ext.bind(me.onSelectInlineStream, me), me, {
                delegate: '.stream-inline'
            });
        });

        me.indexSearchNoticeTooltip = Ext.create('Ext.tip.ToolTip', {
            shadow: false,
            ui: 'shopware-ui',
            cls: 'stream-index-notice-tooltip',
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'index_notice','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'index_notice','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The customer data may be outdated. You should now update the data!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'index_notice','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        me.on('activate', function() {
            me.listStore.load();

            if (!me.activated) {
                me.activated = true;
                me.fireEvent('tab-activated');
            }
        });
        me.callParent(arguments);
    },

    createDockedItems: function() {
        this.toolbar = this.createToolbar();
        return [this.toolbar];
    },

    createToolbar: function() {
        var me = this;

        return Ext.create('Ext.toolbar.Toolbar', {
            ui: 'shopware-ui',
            items: [
                me.createLayoutButton(),
                '->',
                me.createAutoIndexCheckbox(),
                { xtype: 'tbspacer', width: 10 },
                me.createIndexButton(),
                { xtype: 'tbspacer', width: 10 },
                me.createProgressBar(),
                { xtype: 'tbspacer', width: 10 }
            ]
        });
    },

    createLayoutButton: function() {
        var me = this;

        me.layoutButton = Ext.create('Ext.button.Cycle', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'switch_layout','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'switch_layout','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Switch layout<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'switch_layout','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            action: 'layout',
            listeners: {
                change: Ext.bind(me.onChangeLayout, me)
            },
            menu: {
                items: [{
                    text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'view_table','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'view_table','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Overview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'view_table','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    layout: 'table',
                    iconCls: 'sprite-table',
                    checked: true
                }
                /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'charts'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?>*/
                , {
                    text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'view_chart','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'view_chart','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stream revenue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'view_chart','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    layout: 'amount_chart',
                    iconCls: 'sprite-chart-up'
                }, {
                    text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'view_chart_stream','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'view_chart_stream','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Revenue comparison<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'view_chart_stream','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    layout: 'stream_chart',
                    iconCls: 'sprite-chart-impressions'
                }
                /*<?php }?>*/
                ]
            }
        });
        return me.layoutButton;
    },

    createAutoIndexCheckbox: function() {
        var me = this, value = false;

        if (me.subApp.userConfig && me.subApp.userConfig.autoIndex) {
            value = true;
        }

        me.autoIndexCheckbox = Ext.create('Ext.form.field.Checkbox', {
            boxLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'auto_index','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'auto_index','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Analyze on startup<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'auto_index','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            name: 'autoIndex',
            inputValue: true,
            uncheckedValue: false,
            /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'search_index'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if (!$_tmp2){?>*/
                hidden: true,
            /*<?php }?>*/

            /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if (!$_tmp3){?>*/
                hidden: true,
            /*<?php }?>*/

            value: value,
            checked: value,
            listeners: {
                'change': Ext.bind(me.onOnChangeAutoIndex, me)
            }
        });
        return me.autoIndexCheckbox;
    },

    createIndexButton: function() {
        var me = this;

        me.indexSearchButton = Ext.create('Ext.button.Button', {
            iconCls: 'sprite-blue-document-search-result',
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'analyse_customer','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'analyse_customer','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Analyze customers<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'analyse_customer','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            action: 'index',
            /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'search_index'),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if (!$_tmp4){?>*/
                hidden: true,
            /*<?php }?>*/

            handler: Ext.bind(me.onIndexSearch, me)
        });
        return me.indexSearchButton;
    },

    createProgressBar: function() {
        var me = this;

        me.indexingBar = Ext.create('Ext.ProgressBar', {
            value: 0,
            height: 20,
            width: 360
        });

        me.indexingBar.addCls('empty');

        return me.indexingBar;
    },

    createItems: function() {
        var me = this;

        me.listStore = Ext.create('Shopware.apps.Customer.store.Preview');
        me.streamStore = Ext.create('Shopware.apps.Customer.store.CustomerStream', {
            sorters: [
                { property: 'stream.name', direction: 'ASC' }
            ],
            pageSize: 50000,
            listeners: {
                'beforeload': function (store, operation) {
                    if (!operation.forceReload) {
                        operation.addRecords = true;
                    }
                }
            }
        }).load();

        me.gridPanel = Ext.create('Shopware.apps.Customer.view.customer_stream.Preview', {
            store: me.listStore,
            border: true,
            margin: '0 0 0 5',
            flex: 1,
            displayDeleteIcon: false
        });

        var customerStore = Ext.create('Shopware.attribute.SelectionFactory').createEntitySearchStore('Shopware\\Models\\Customer\\Customer');
        me.addCustomerToStreamSelection = Ext.create('Shopware.form.field.CustomerSingleSelection', {
            store: customerStore,
            labelWidth: 150,
            margin: '0 0 0 5',
            disabled: true,
            width: '100%',
            padding: 0,
            listeners: {
                'beforeselect': function(combo, record) {
                    me.fireEvent('add-customer-to-stream', record);
                    return false;
                },
                'collapse': function() {
                    me.listStore.load();
                },
                'disable': function (elem) {
                    if (elem.items) {
                        elem.items.each(function(child) { child.disable(); });
                    }
                },
                'enable': function (elem) {
                    if (elem.items) {
                        elem.items.each(function(child) { child.enable(); });
                    }
                }
            }
        });
        me.addCustomerToStreamSelection.combo.emptyText = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'add_customer','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_customer','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add customer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_customer','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';

        me.gridContainer = Ext.create('Ext.container.Container', {
            layout: { type: 'vbox', align: 'stretch' },
            items: [ me.addCustomerToStreamSelection, me.gridPanel ]
        });

        me.streamListing = Ext.create('Shopware.apps.Customer.view.customer_stream.Listing', {
            store: me.streamStore,
            subApp: me.subApp,
            hideHeaders: true,
            border: false,
            flex: 1,
            listeners: {
                'selectionchange': Ext.bind(me.onSelectionChange, me),
                'beforedeselect': Ext.bind(me.onBeforeDeselect, me)
            }
        });

        me.filterPanel = Ext.create('Shopware.apps.Customer.view.customer_stream.ConditionPanel', {
            flex: 1,
            border: false
        });

        me.addConditionButton = Ext.create('Ext.button.Split', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'add_condition','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_condition','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Add filter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_condition','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            iconCls: 'sprite-plus-circle-frame',
            handler: function(btn) {
                btn.menu.showBy(btn);
            },
            menu: me.createConditionsMenu()
        });

        me.refreshViewButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'refresh_preview','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'refresh_preview','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Refresh preview<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'refresh_preview','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            iconCls: 'sprite-arrow-circle-225-left',
            handler: Ext.bind(me.onRefreshView, me)
        });

        me.formPanel = Ext.create('Ext.form.Panel', {
            width: 400,
            bodyCls: 'stream-filter-panel-body',
            layout: { type: 'vbox', align: 'stretch', pack: 'start' },
            dockedItems: [{
                xtype: 'toolbar',
                dock: 'top',
                ui: 'shopware-ui',
                cls: 'condition-toolbar',
                border: true,
                items: [ me.addConditionButton, '->', me.refreshViewButton ]
            }],
            items: [ me.filterPanel ]
        });

        me.metaChart = Ext.create('Shopware.apps.Customer.view.chart.MetaChart');

        me.metaChartStore = me.metaChart.store;

        me.streamChartContainer = Ext.create('Ext.container.Container', {
            items: [],
            flex: 1,
            cls: 'stream-chart-container',
            layout: 'border'
        });

        me.saveStreamButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'save','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'save','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'save','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'primary',
            anchor: '100%',
            /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php if (!$_tmp5){?>*/
                hidden: true,
            /*<?php }?>*/
            handler: Ext.bind(me.onSaveStream, me)
        });

        me.streamDetailForm = Ext.create('Ext.form.Panel', {
            bodyPadding: 20,
            overflowY: 'hidden',
            height: 270,
            disabled: true,
            border: false,
            name: 'detail-form',
            items: [
                Ext.create('Shopware.apps.Customer.view.customer_stream.Detail', {
                    record: Ext.create('Shopware.apps.Customer.model.CustomerStream')
                }),
                {
                    xtype: 'container',
                    items: [me.saveStreamButton],
                    layout: 'anchor',
                    flex: 1
                }
            ],
            listeners: {
                'validitychange': function () {
                    me.fireEvent('validitychange');
                }
            }
        });

        me.cardContainer = Ext.create('Ext.container.Container', {
            items: [ me.gridContainer, me.metaChart, me.streamChartContainer ],
            layout: 'card',
            flex: 1
        });

        me.regionContainer = Ext.create('Ext.panel.Panel', {
            region: 'center',
            border: true,
            bodyPadding: 5,
            layout: { type: 'hbox', align: 'stretch' },
            items: [
                me.formPanel,
                me.cardContainer
            ],
            margin: '10 10 10 10'
        });

        me.leftContainer = Ext.create('Ext.panel.Panel', {
            region: 'west',
            width: 390,
            collapsible: true,
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_listing','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_listing','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer Streams<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_listing','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            margin: '10 0 10 10',
            layout: { type: 'vbox', align: 'stretch' },
            items: [
                me.streamListing,
                me.streamDetailForm
            ]
        });
        return [ me.leftContainer, me.regionContainer ];
    },

    createConditionsMenu: function() {
        var me = this, items = [];

        Ext.each(me.filterPanel.handlers, function(handler) {
            items.push({
                text: handler.getLabel(),
                conditionHandler: handler,
                handler: function() {
                    me.addCondition(handler);
                }
            });
        });

        return new Ext.menu.Menu({ items: items });
    },

    onSelectInlineStream: function(event, element) {
        var me = this;

        element = Ext.get(element);
        event.preventDefault();

        me.streamListing.getSelectionModel().select([
            me.streamListing.getStore().getById(
                window.parseInt(element.getAttribute('data-id'))
            )
        ]);
    },

    onBeforeDeselect: function (selModel, record) {
        var me = this;

        if (record) {
            me.streamDetailForm.getForm().updateRecord(record);
            me.formPanel.getForm().updateRecord(record);
        }
    },

    onChangeLayout: function (button, item) {
        this.fireEvent('switch-layout', item.layout);
    },

    onSelectionChange: function(selModel, selection) {
        this.fireEvent('stream-selection-changed', selection);
    },

    onOnChangeAutoIndex: function(checkbox, newValue) {
        this.fireEvent('change-auto-index', checkbox, newValue);
    },

    onIndexSearch: function () {
        this.fireEvent('full-index');
    },

    onSaveStream: function() {
        this.fireEvent('save-stream');
    },

    onRefreshView: function() {
        this.fireEvent('refresh-stream-views');
    },

    addCondition: function(handler) {
        this.filterPanel.createCondition(handler);
    }
});
// 
<?php }} ?>