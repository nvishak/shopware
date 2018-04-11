<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:34
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\controller\stream.js" */ ?>
<?php /*%%SmartyHeaderCode:280575acda8f6939883-66250877%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '077051b3433072320ce6f6458b49b471bb773605' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\controller\\stream.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '280575acda8f6939883-66250877',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f6ae98a7_25910988',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f6ae98a7_25910988')) {function content_5acda8f6ae98a7_25910988($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Customer.controller.Stream', {

    extend: 'Ext.app.Controller',

    refs: [
        { ref: 'mainWindow', selector: 'customer-list-main-window' },
        { ref: 'mainToolbar', selector: 'customer-main-toolbar' },
        { ref: 'streamView', selector: 'stream-view' },
        { ref: 'streamListing', selector: 'customer-stream-listing' },
        { ref: 'streamDetailForm', selector: 'stream-view form[name=detail-form]' },
        { ref: 'conditionPanel', selector: 'customer-stream-condition-panel' }
    ],

    mixins: {
        batch: 'Shopware.helper.BatchRequests'
    },

    init: function () {
        var me = this;

        me.lastRecords = [];
        me.lastRecord = null;

        me.control({
            'stream-view': {
                'switch-layout': me.switchLayout,
                'stream-selection-changed': me.streamSelectionChanged,
                'change-auto-index': me.changeAutoIndex,
                'full-index': me.fullIndex,
                'save-stream': me.saveEditedStream,
                'refresh-stream-views': me.reloadView,
                'tab-activated': me.onTabActivated,
                'reset-progressbar': me.resetProgressbar,
                'add-customer-to-stream': me.addCustomerToStream,
                'validitychange': me.streamDetailValidityChanged
            },
            'customer-stream-detail': {
                'static-changed': me.staticCheckboxChanged
            },
            'customer-list': {
                'delete': me.deleteCustomerFromStream
            },
            'customer-stream-listing': {
                'index-stream': me.indexStream,
                'add-stream': me.addStream,
                'reset-progressbar': me.resetProgressbar,
                'save-as-new-stream': me.duplicateStream,
                'save-stream-selection': me.saveStreamSelection,
                'restore-stream-selection': me.restoreStreamSelection,
                'delete-stream': me.deleteStreamItem
            },
            'customer-stream-condition-panel': {
                'condition-panel-change': me.conditionPanelChange
            }
        });

        me.callParent(arguments);
    },

    addCustomerToStream: function(record) {
        var me = this,
            stream = me.getStreamDetailForm().getForm().getRecord();

        if (!stream.get('id')) {
            return false;
        }

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/CustomerStream/addCustomerToStream';?>',
            params: {
                streamId: stream.get('id'),
                customerId: record.get('id')
            },
            callback: function(operation, success, response) {
                success = Ext.JSON.decode(response.responseText);

                if (success.success) {
                    stream.set('customer_count', stream.get('customer_count') + 1);
                    Shopware.Notification.createGrowlMessage('', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'add_customer_success','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_customer_success','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer successfully added<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_customer_success','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                } else {
                    Shopware.Notification.createGrowlMessage('', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'add_customer_error','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_customer_error','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customer has already been assigned to the stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'add_customer_error','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                }
            }
        });

        return false;
    },

    deleteCustomerFromStream: function(record) {
        var me = this,
            stream = me.getStreamDetailForm().getForm().getRecord();

        if (!stream.get('id')) {
            return false;
        }

        me.getStreamView().gridPanel.getStore().remove(record);

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/CustomerStream/removeCustomerFromStream';?>',
            params: {
                streamId: stream.get('id'),
                customerId: record.get('id')
            },
            success: function () {
                stream.set('customer_count', stream.get('customer_count') - 1);
            }
        });
    },

    staticCheckboxChanged: function(value) {
        var me = this;

        me.refreshDateTimePicker(value);
        me.refreshSaveButton();
        me.refreshEmptyMessage();
    },

    addStream: function() {
        var me = this;

        me.getStreamListing().getSelectionModel().deselectAll();

        me.loadStream(
            Ext.create('Shopware.apps.Customer.model.CustomerStream')
        );

        me.getStreamListing().getStore().add(Ext.create('Shopware.apps.Customer.model.CustomerStream', {
            id: null,
            name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream/new_stream','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream/new_stream','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
New stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream/new_stream','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }));

        me.lastRecords = me.getStreamListing().getStore().getNewRecords();
        me.lastRecord = me.lastRecords[me.lastRecords.length - 1];
        me.getStreamListing().getSelectionModel().select([me.lastRecord]);

        me.disableDateTimeInput(true);
        me.refreshAddButton();
    },

    fullIndex: function() {
        var me = this,
            store = me.getStreamListing().getStore();
        me.saveStreamSelection();

        me.indexSearch(true, function() {
            var streamView = me.getStreamView();
            streamView.listStore.load();

            if (store.getCount() > 0) {
                var streams = me.filterUnsavedElements(store.data.items);
                me.refreshWhileFullIndex(streams, streams.length);
            } else {
                me.resetProgressbar();
            }
        });
    },

    onTabActivated: function() {
        var me = this;

        if (me.subApplication.userConfig && me.subApplication.userConfig.autoIndex) {
            me.fullIndex();
            return;
        }

        me.resetProgressbar();
    },

    indexStreams: function(stream, streams, total) {
        var me = this;

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if (!$_tmp1){?>*/
            return;
        /*<?php }?>*/

        me.indexStream(stream, function() {
            if (streams.length > 0) {
                me.refreshWhileFullIndex(streams, total);
            } else {
                var streamView = me.getStreamView();
                streamView.listStore.load();
                streamView.streamListing.getStore().load({
                    callback: Ext.bind(me.restoreStreamSelection, me)
                });
                me.resetProgressbar();
            }
        });
    },

    filterUnsavedElements: function(elements) {
        return Ext.Array.filter(elements, function (elem) {
            return elem.get('id') !== null;
        });
    },

    refreshWhileFullIndex: function(streams, total) {
        var me = this,
            next = streams.shift(),
            node = me.getStreamListing().getView().getNode(next),
            nodes = me.getStreamListing().getView().getNodes();

        Ext.each(nodes, function(node) {
            var el = Ext.get(node);
            el.removeCls('rotate');
        });

        var el = Ext.get(node);
        el.addCls('rotate');

        Ext.defer(function() {
            me.getStreamView().indexingBar.updateProgress(
                0,
                Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'batch_progress','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'batch_progress','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Refresh stream: "[0]" ([1] of [2])<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'batch_progress','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', next.get('name'), total - streams.length, total),
                true
            );

            Ext.defer(function() {
                me.indexStreams(next, streams, total);
            }, 650);
        }, 400);
    },

    checkIndexState: function() {
        var me = this,
            streamView = me.getStreamView();

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/CustomerStream/getNotIndexedCount';?>',
            success: function(operation) {
                var response = Ext.decode(operation.responseText);

                if (response.total <= 0) {
                    streamView.indexSearchButton.setIconCls('sprite-blue-document-search-result');
                    return;
                }

                /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'search_index'),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if (!$_tmp2){?>*/
                    return;
                /*<?php }?>*/

                streamView.indexSearchButton.setIconCls('sprite-exclamation');

                var position = streamView.indexSearchButton.getPosition();
                position[1] = position[1] + 30;
                position[0] = position[0] - 90;
                streamView.indexSearchNoticeTooltip.showAt(position);
            }
        });
    },

    changeAutoIndex: function(checkbox, newValue) {
        var me = this, config = me.subApplication.userConfig;

        checkbox.setDisabled(true);
        config.autoIndex = newValue;

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/UserConfig/save';?>',
            params: {
                config: Ext.JSON.encode(config),
                name: 'customer_module'
            },
            callback: function() {
                checkbox.setDisabled(false);
            }
        });
    },

    switchLayout: function (layout) {
        var me = this,
            streamView = me.getStreamView();

        me.layout = layout;

        switch (layout) {
            case 'table':
                streamView.cardContainer.getLayout().setActiveItem(0);
                streamView.gridPanel.getStore().load();
                streamView.formPanel.setDisabled(false);
                break;

            case 'amount_chart':

                /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'charts'),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if (!$_tmp3){?>*/
                    return;
                /*<?php }?>*/

                streamView.cardContainer.getLayout().setActiveItem(1);
                streamView.metaChartStore.load();
                streamView.formPanel.setDisabled(true);
                break;

            case 'stream_chart':
                /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'charts'),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if (!$_tmp4){?>*/
                    return;
                /*<?php }?>*/
                streamView.cardContainer.getLayout().setActiveItem(2);
                me.loadStreamChart();
                streamView.formPanel.setDisabled(true);
                break;
        }
    },

    loadStreamChart: function() {
        var me = this,
            streamView = me.getStreamView(),
            streamChartContainer = streamView.streamChartContainer;

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'charts'),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php if (!$_tmp5){?>*/
            return;
        /*<?php }?>*/

        streamChartContainer.removeAll();

        var store = streamView.streamListing.getStore();

        Ext.create('Shopware.apps.Customer.view.chart.AmountChartFactory').createChart(store, function (chart) {
            streamChartContainer.add(chart);
        });
    },

    reloadView: function() {
        var me = this,
            streamView = me.getStreamView();

        if (streamView.formPanel.getForm().isValid()) {
            streamView.listStore.getProxy().extraParams = streamView.filterPanel.getSubmitData();
            streamView.listStore.load();
        }

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'charts'),$_smarty_tpl);?>
<?php $_tmp6=ob_get_clean();?><?php if (!$_tmp6){?>*/
            return;
        /*<?php }?>*/
        streamView.metaChartStore.load();
        me.loadStreamChart();
    },

    duplicateStream: function(record) {
        var me = this,
            streamData = record.getData();

        delete streamData.id;
        var stream = Ext.create('Shopware.apps.Customer.model.CustomerStream', streamData);

        stream.set('name', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'copy_of','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'copy_of','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Copy of<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'copy_of','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + record.get('name'));

        me.sendSave(stream, function() {
            me.resetProgressbar();
            me.resetFilterPanel();
            me.saveStreamSelection();
            me.getStreamView().streamListing.getStore().load({
                callback: Ext.bind(me.restoreStreamSelection, me)
            });
        });
    },

    saveEditedStream: function() {
        var me = this,
            record = me.getStreamView().formPanel.getForm().getRecord(),
            isNewRecord = record.get('id') === null;

        me.saveStreamSelection();

        me.saveStream(record, function() {
            me.resetProgressbar();
            me.getStreamView().streamListing.getStore().load({
                callback: Ext.bind(me.restoreStreamSelection, me),
                forceReload: isNewRecord
            });

            if (isNewRecord) {
                me.lastRecord = null;
                me.lastRecords = [];
            }

            me.refreshAddButton();

            if (me.isChartViewActive()) {
                me.reloadView();
            }
        });
    },

    saveStream: function (record, callback) {
        var me = this,
            streamView = this.getStreamView(),
            streamDetailForm = me.getStreamDetailForm();

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp7=ob_get_clean();?><?php if (!$_tmp7){?>*/
            return;
        /*<?php }?>*/

        if (!streamView.formPanel.getForm().isValid()) {
            Shopware.Notification.createGrowlMessage('', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'not_valid_stream','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'not_valid_stream','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The form is not filled completely. Please check your input.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'not_valid_stream','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            return;
        }

        if (!streamDetailForm.getForm().isValid()) {
            Shopware.Notification.createGrowlMessage('', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'not_valid_stream','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'not_valid_stream','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The form is not filled completely. Please check your input.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'not_valid_stream','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            return;
        }

        var before = {
            'freezeUp': record.get('freezeUp'),
            'static': record.get('static')
        };

        streamDetailForm.getForm().updateRecord(record);
        streamView.formPanel.getForm().updateRecord(record);

        if (!record.get('static') && !record.hasConditions()) {
            Shopware.Notification.createGrowlMessage('', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'filter_missing','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_missing','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
You have to define a filter first<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'filter_missing','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            return;
        }

        if (record.get('static') && !before.static && record.hasConditions()) {
            before.static = record.get('static');
            record.set({ freezeUp: null, static: false });

            me.sendSave(record, function() {
                record.set(before);
                record.save({ callback: callback });
            });
        } else if (!record.get('static') && before.static) {
            Ext.MessageBox.confirm(
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'indexing','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'indexing','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Indexing<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'indexing','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'static_to_dynamic_message','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'static_to_dynamic_message','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
All customer from this stream will be removed if you convert it to a dynamic stream. The stream will be regenerated based on the defined filters. Do you want to continue?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'static_to_dynamic_message','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                function (response) {
                    if (response !== 'yes') {
                        callback();
                        return;
                    }

                    record.set({ freezeUp: null, static: false });
                    me.sendSave(record, callback);
                }
            );
        } else {
            me.sendSave(record, callback);
        }
    },

    sendSave: function(record, callback) {
        var me = this,
            streamView = me.getStreamView(),
            isNewRecord = record.get('id') === null;

        record.save({
            callback: function(newRecord) {
                if (isNewRecord) {
                    me.getStreamListing().getStore().remove(record);
                    streamView.formPanel.getForm().updateRecord(newRecord);
                }

                Shopware.Notification.createGrowlMessage('', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'stream_saved','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Stream saved<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'stream_saved','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                me.indexStream(newRecord, callback);
            }
        });
    },

    streamSelectionChanged: function(selection) {
        var me = this,
            streamView = me.getStreamView();

        if (me.preventStreamChanged) {
            return;
        }
        streamView.addCustomerToStreamSelection.setDisabled(true);

        if (selection.length <= 0) {
            me.resetFilterPanel();
            streamView.listStore.getProxy().extraParams = { };
            streamView.listStore.load();
            streamView.streamDetailForm.loadRecord({ });
            streamView.streamDetailForm.setDisabled(true);
        } else {
            me.loadStream(selection[0]);
        }
        me.loadChart();

        me.refreshEmptyMessage();
    },

    loadStream: function(record) {
        var me = this,
            streamView = this.getStreamView();

        streamView.streamListing.setLoading(true);
        streamView.addCustomerToStreamSelection.setDisabled(true);

        streamView.gridPanel.displayDeleteIcon = false;

        me.resetFilterPanel();
        streamView.formPanel.loadRecord(record);

        if (record.get('static')) {
            streamView.formPanel.setDisabled(true);
            streamView.addCustomerToStreamSelection.setDisabled(false);
            streamView.gridPanel.displayDeleteIcon = true;
        }

        streamView.streamListing.setLoading(false);
        streamView.listStore.getProxy().extraParams = {
            streamId: record.get('id')
        };

        streamView.listStore.load();
        streamView.streamDetailForm.loadRecord(record);
        streamView.streamDetailForm.setDisabled(false);

        if (me.isChartViewActive()) {
            streamView.formPanel.setDisabled(true);
        }
    },

    loadChart: function() {
        var streamView = this.getStreamView(),
            metaChartStore = streamView.metaChartStore,
            record = streamView.formPanel.getForm().getRecord();

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'charts'),$_smarty_tpl);?>
<?php $_tmp8=ob_get_clean();?><?php if (!$_tmp8){?>*/
            return;
        /*<?php }?>*/

        metaChartStore.getProxy().extraParams = { };

        if (record && record.get('id')) {
            metaChartStore.getProxy().extraParams = {
                streamId: record.get('id')
            };
        }

        metaChartStore.load();
    },

    indexStream: function(record, callback) {
        var me = this;

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'save'),$_smarty_tpl);?>
<?php $_tmp9=ob_get_clean();?><?php if (!$_tmp9){?>*/
            return;
        /*<?php }?>*/

        if (record.get('static') || record.get('id') === null) {
            Ext.callback(callback);
            return;
        }

        me.initProgressbar();

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/CustomerStream/loadStream';?>',
            params: {
                conditions: record.get('conditions')
            },
            success: function(operation) {
                var response = Ext.decode(operation.responseText);
                me.start(
                    [{
                        url: '<?php echo '/shopware4/backend/CustomerStream/indexStream';?>',
                        params: {
                            total: response.total,
                            streamId: record.get('id')
                        }
                    }],
                    callback
                );
            }
        });
    },

    indexSearch: function(force, callback) {
        var me = this;

        /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'customerstream','privilege'=>'search_index'),$_smarty_tpl);?>
<?php $_tmp10=ob_get_clean();?><?php if (!$_tmp10){?>*/
            return;
        /*<?php }?>*/

        me.initProgressbar();

        me.getSearchIndexingParameters(force, function(params) {
            me.start(
                [{
                    url: '<?php echo '/shopware4/backend/CustomerStream/buildSearchIndex';?>',
                    params: params
                }],
                callback
            );
        });
    },

    getSearchIndexingParameters: function(force, callback) {
        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/CustomerStream/getNotIndexedCount';?>',
            params: { },
            success: function(operation) {
                var notIndexed = Ext.decode(operation.responseText);

                Ext.Ajax.request({
                    url: '<?php echo '/shopware4/backend/CustomerStream/getCustomerCount';?>',
                    params: {},
                    success: function (operation) {
                        var full = Ext.decode(operation.responseText);

                        if (force) {
                            callback({ total: full.total, full: true });
                        } else if (notIndexed.total > 0 && full.total !== notIndexed.total) {
                            callback({ total: notIndexed.total });
                        } else {
                            callback({ total: full.total, full: true });
                        }
                    }
                });
            }
        });
    },

    updateProgressBar: function(request, response) {
        this.getStreamView().indexingBar.updateProgress(response.progress, response.text, true);
    },

    initProgressbar: function() {
        this.getStreamView().indexingBar.updateProgress(0);
        this.getStreamView().indexingBar.show();
        this.getStreamView().indexingBar.removeCls('empty');

        this.getStreamView().indexSearchButton.setDisabled(true);
        this.getStreamView().leftContainer.setDisabled(true);
    },

    resetProgressbar: function () {
        var me = this;

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/CustomerStream/getLastFullIndexTime';?>',
            success: function(operation) {
                var response = Ext.decode(operation.responseText);
                Ext.defer(function () {
                    me.getStreamView().indexingBar.updateProgress(0, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'last_analyse','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'last_analyse','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last analysis at: <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'last_analyse','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' + Ext.util.Format.date(response.last_index_time), true);
                    me.getStreamView().indexingBar.addCls('empty');
                }, 500);
            }
        });

        me.getStreamView().indexSearchButton.setDisabled(false);
        me.getStreamView().leftContainer.setDisabled(false);
        me.checkIndexState();
    },

    finish: function(requests, callback) {
        var me = this;

        if (Ext.isFunction(callback)) {
            callback();
        } else {
            me.resetProgressbar();
        }
    },

    saveStreamSelection: function () {
        var me = this,
            selectionModel = me.getStreamListing().getSelectionModel();

        if (selectionModel.hasSelection()) {
            me.currentStreamSelection = selectionModel.getSelection()[0];
        } else {
            me.currentStreamSelection = null;
        }
    },

    restoreStreamSelection: function () {
        var me = this,
            streamListing = me.getStreamListing(),
            store = streamListing.getStore();

        if (!me.currentStreamSelection) {
            return;
        }

        var newest = -1;
        var recordIndex = store.findBy(function (record) {
            var id = record.get('id');
            if (id === me.currentStreamSelection.data.id) {
                return true;
            }

            if (id > newest) {
                newest = id;
            }
        });

        var record = null;
        if (newest !== -1 && recordIndex === -1) {
            record = store.getById(newest);
        } else {
            if (recordIndex === null || recordIndex < 0) {
                return;
            }
            record = store.getAt(recordIndex);
        }

        streamListing.getSelectionModel().select([record]);
    },

    disableDateTimeInput: function (disabled) {
        var me = this,
            streamDetailForm = me.getStreamDetailForm();
        streamDetailForm.getForm().findField('freezeUpTime').setDisabled(disabled);
        streamDetailForm.getForm().findField('freezeUpDate').setDisabled(disabled);
    },

    disableSaveButton: function(disabled) {
        var me = this,
            streamView = me.getStreamView();

        streamView.saveStreamButton.setDisabled(disabled);
    },

    refreshAddButton: function () {
        var me = this,
            streamListing = me.getStreamListing(),
            addButton = streamListing.addButton;

        if (me.lastRecords.length > 0) {
            addButton.setDisabled(true);
            addButton.setTooltip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'unsaved_stream','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unsaved_stream','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please save the stream before you add a new one.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unsaved_stream','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
        } else {
            addButton.setDisabled(false);
            addButton.setTooltip('');
        }
    },

    conditionPanelChange: function() {
        var me = this;
        me.refreshEmptyMessage();
        me.refreshSaveButton();
    },

    streamDetailValidityChanged: function () {
        var me = this;
        me.refreshSaveButton();
    },

    deleteStreamItem: function(record) {
        var me = this;
        Ext.MessageBox.confirm('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'delete_confirm_title','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_confirm_title','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Delete stream<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_confirm_title','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'delete_confirm_text','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_confirm_text','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Are you sure you want to delete the selected stream?<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'delete_confirm_text','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', function (response) {
            if (response !== 'yes') {
                return false;
            }

            if (record.phantom) {
                me.lastRecords = [];
            }

            me.getStreamListing().getStore().remove(record);

            record.destroy();

            me.reloadStreamList();
            me.refreshAddButton();
        });
    },

    refreshEmptyMessage: function() {
        var me = this,
            conditionPanel = me.getConditionPanel(),
            selection = me.getStreamListing().getSelectionModel().getSelection(),
            isStatic = me.getStreamDetailForm().getForm().findField('static').getValue(),
            conditions = me.hasConditions();

        if (selection.length === 1 && !isStatic && !conditions) {
            if (conditionPanel.items.length <= 0) {
                conditionPanel.add(conditionPanel.createEmptyMessage());
            }
        } else {
            if (!conditions) {
                conditionPanel.removeAll();
            }
        }
    },

    refreshDateTimePicker: function (isStatic) {
        var me = this,
            streamView = me.getStreamView();

        if (isStatic) {
            me.disableDateTimeInput(false);
            streamView.formPanel.setDisabled(true);
            streamView.formPanel.getForm().getFields().findBy(function(field) {
                var isValid = field.isValid(),
                    comp = field.getEl().up('.customer-stream-condition-field');

                if (comp && !isValid) {
                    streamView.filterPanel.remove(Ext.getCmp(comp.id).ownerCt);
                }
            });
        } else {
            me.disableDateTimeInput(true);
            streamView.formPanel.setDisabled(false);
        }
    },

    refreshSaveButton: function () {
        this.disableSaveButton(!this.isStreamValid());
    },

    isStreamValid: function () {
        var me = this,
            isValid = me.getStreamDetailForm().getForm().isValid(),
            selection = me.getStreamListing().getSelectionModel().getSelection(),
            isStatic = me.getStreamDetailForm().getForm().findField('static').getValue(),
            conditions = me.hasConditions();

        if (!isValid || (selection.length === 1 && !isStatic && !conditions)) {
            return false;
        }

        return true;
    },

    hasConditions: function () {
        var me = this;
        if (!me.getConditionPanel()) {
            return false;
        }
        return me.getConditionPanel().hasConditions;
    },

    reloadStreamList: function () {
        var me = this,
            streamView = me.getStreamView();

        me.saveStreamSelection();
        streamView.streamListing.getStore().load({
            callback: Ext.bind(me.restoreStreamSelection, me)
        });
    },

    isChartViewActive: function () {
        return this.layout === 'amount_chart' || this.layout === 'stream_chart';
    },

    resetFilterPanel: function() {
        var me = this,
            streamView = me.getStreamView();

        streamView.filterPanel.removeAll();
        streamView.filterPanel.loadRecord(null);

        streamView.formPanel.loadRecord(null);
        streamView.formPanel.setDisabled(me.isChartViewActive());
    }

});
// 
<?php }} ?>