<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:24
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\index\view\widgets\visitors.js" */ ?>
<?php /*%%SmartyHeaderCode:69925acda8ec3b32d7-61339421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49b965864d900ba7dc983da102cd1e85769fdb8a' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\index\\view\\widgets\\visitors.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69925acda8ec3b32d7-61339421',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ec460ad6_17793526',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ec460ad6_17793526')) {function content_5acda8ec460ad6_17793526($_smarty_tpl) {?>/**
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

/**
 * Shopware UI - Visitors Widget
 *
 * This file holds off the vistors widget.
 */
//
Ext.define('Shopware.apps.Index.view.widgets.Visitors', {
    extend: 'Shopware.apps.Index.view.widgets.Base',
    alias: 'widget.swag-visitors-customers-widget',
    title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'title','default'=>'Visitors online (Sample Data)','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'title','default'=>'Visitors online (Sample Data)','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visitors online (Sample Data)<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'title','default'=>'Visitors online (Sample Data)','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
    layout: 'column',

    /**
     * Snippets for the widget
     * @object
     */
    snippets: {
        date: {
            // Sunday needs to be first as getDay() is defined that way
            sunday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'date'/'sunday','default'=>'Sunday','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'sunday','default'=>'Sunday','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Sunday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'sunday','default'=>'Sunday','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            monday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'date'/'monday','default'=>'Monday','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'monday','default'=>'Monday','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Monday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'monday','default'=>'Monday','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            tuesday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'date'/'tuesday','default'=>'Tuesday','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'tuesday','default'=>'Tuesday','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Tuesday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'tuesday','default'=>'Tuesday','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            wednesday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'date'/'wednesday','default'=>'Wednesday','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'wednesday','default'=>'Wednesday','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Wednesday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'wednesday','default'=>'Wednesday','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            thursday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'date'/'thursday','default'=>'Thursday','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'thursday','default'=>'Thursday','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Thursday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'thursday','default'=>'Thursday','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            friday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'date'/'friday','default'=>'Friday','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'friday','default'=>'Friday','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Friday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'friday','default'=>'Friday','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            saturday: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'date'/'saturday','default'=>'Saturday','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'saturday','default'=>'Saturday','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Saturday<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'date'/'saturday','default'=>'Saturday','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        visitors_online: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'visitors_online','default'=>'Visitors online','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'visitors_online','default'=>'Visitors online','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Visitors online<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'visitors_online','default'=>'Visitors online','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        visitors_online_total: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'visitors_online_total','default'=>'Visitors online in total','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'visitors_online_total','default'=>'Visitors online in total','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Total visitors online<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'visitors_online_total','default'=>'Visitors online in total','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        headers: {
            customers_online: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'headers'/'customers_online','default'=>'Customers online','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'headers'/'customers_online','default'=>'Customers online','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Customers online<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'headers'/'customers_online','default'=>'Customers online','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            basket_amount: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'visitors'/'headers'/'basket_amount','default'=>'Basket amount','namespace'=>'backend/index/view/widgets')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'headers'/'basket_amount','default'=>'Basket amount','namespace'=>'backend/index/view/widgets'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cart value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'visitors'/'headers'/'basket_amount','default'=>'Basket amount','namespace'=>'backend/index/view/widgets'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    visitorsStore: null,

    height: 225,

    /**
     * Initializes the widget.
     *
     * @public
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.items = [];

        me.tools = [
            {
                type: 'refresh',
                scope: me,
                handler: me.refreshView
            }
        ];

        me.visitorsStore = Ext.create('Ext.data.Store', {
            model: 'Shopware.apps.Index.model.Batch',
            remoteFilter: true,
            autoLoad: true,
            clearOnLoad: false,

            proxy: {
                type: 'ajax',
                url: '<?php echo '/shopware4/backend/widgets/getVisitors';?>',
                reader: {
                    type: 'json',
                    root: 'data'
                }
            }
        });

        me.visitorsStore.load({
            callback: function () {
                me.createColumnContainers();

                me.createTaskRunner();
            }
        });

        me.callParent(arguments);
    },

    /**
     * Creates the necessary containers for the layout.
     *
     * @public
     * @return [array] array of Ext.container.Container's
     */
    createColumnContainers: function () {
        var me = this,
            stores = me.visitorsStore.first();

        me.dataView = Ext.create('Ext.view.View', {
            tpl: me.createVisitorsOnlineTemplate(),
            data: [
                {
                    visitors: stores.get('currentUsers')
                }
            ]
        });

        /** Left container */
        me.add(Ext.create('Ext.container.Container', {
            columnWidth: 0.45,
            height: '100%',
            items: [
                me.createLineChart(stores.getVisitorsStore),
                me.dataView
            ]
        }));

        me.gridPanel = Ext.create('Ext.grid.Panel', {
            border: 0,
            store: stores.getCustomersStore,
            columns: me.createColumns(),
            viewConfig: {
                hideLoadingMsg: true
            }
        });

        /** Right container */
        me.add(Ext.create('Ext.container.Container', {
            height: '100%',
            margin: '20 0 0 10',
            columnWidth: 0.55,
            items: [
                me.gridPanel
            ]
        }));
    },

    /**
     * Helper method which creates the template
     * for all current visitors in the shop.
     *
     * @public
     * @return { object } Ext.XTemplate
     */
    createVisitorsOnlineTemplate: function () {
        var me = this;

        return new Ext.XTemplate(
            '',
            '<tpl for=".">',
                '<div class="visitors-online">',
                    '<span class="visitors">{visitors}</span>',
                    '<strong class="title">' + me.snippets.visitors_online + '</strong>',
                '</div>',
            '</tpl>',
            ''
        );
    },

    /**
     * Registers a new task runner to refresh
     * the store after a given time interval.
     *
     * @public
     * @return void
     */
    createTaskRunner: function () {
        var me = this;

        me.storeRefreshTask = Ext.TaskManager.start({
            scope: me,
            run: me.refreshView,
            interval: 300000
        });
    },

    /**
     * Helper method which will be called by the
     * task runner and when the user clicks the
     * refresh icon in the panel header.
     *
     * @public
     * @return void
     */
    refreshView: function () {
        var me = this;

        me.gridPanel.setLoading(true);

        if (!me.visitorsStore) {
            return;
        }

        me.visitorsStore.load({
            callback: function () {
                var stores = me.visitorsStore.first();

                if (!stores || !stores.getCustomersStore || !stores.getVisitorsStore) {
                    return;
                }

                me.gridPanel.reconfigure(stores.getCustomersStore);
                me.chart.bindStore(stores.getVisitorsStore);
                me.dataView.update([
                    {
                        visitors: stores.get('currentUsers')
                    }
                ]);
                me.gridPanel.setLoading(false);
            }
        });
    },

    /**
     * Helper method which creates the columns
     * for the grid.
     *
     * @public
     * @return [array] generated columns
     */
    createColumns: function () {
        var me = this;

        return [
            {
                header: me.snippets.headers.customers_online,
                dataIndex: 'customer',
                flex: 1
            },
            {
                header: me.snippets.headers.basket_amount,
                dataIndex: 'amount',
                flex: 1,
                renderer: function (value) {
                    return Ext.util.Format.currency(value);
                }
            }
        ];
    },

    createLineChart: function (store) {
        var me = this;

        me.chart = Ext.create('Ext.chart.Chart', {
            xtype: 'chart',
            theme: 'Widget',
            height: 110,
            animate: false,
            store: store,
            shadow: false,
            listeners: {
                /**
                 * Event listener method which will be fired when the
                 * chart is rendered successfully.
                 *
                 * The method gets the width of the overlying container
                 * to propertly set the width of the chart.
                 *
                 * @public
                 * @event afterrender
                 * @param [object] chartCmp - Ext.chart.Chart
                 */
                afterrender: function (chartCmp) {

                    // The timeout is kinda dirty, i know, but there's no way around it...
                    var timeout = setTimeout(function () {
                        chartCmp.setWidth(chartCmp.ownerCt.getWidth());

                        clearTimeout(timeout);
                        timeout = null;
                    }, 5);
                }
            },
            axes: [
                {
                    type: 'Numeric',
                    position: 'left',
                    minorTickSteps: 1,
                    minimum: 0,
                    hidden: true,
                    fields: [ 'visitors']
                },
                {
                    type: 'Category',
                    position: 'bottom',
                    fields: [ 'timestamp' ],
                    label: {
                        fill: '#ffffff',
                        font: '11px/14px Arial, sans-serif'
                    },

                    setLabels: function () {
                        var store = this.chart.getChartStore(),
                            data = store.data.items,
                            d, dLen, record,
                            fields = this.fields,
                            ln = fields.length,
                            i;

                        this.labels = [];
                        for (d = 0, dLen = data.length; d < dLen; d++) {
                            record = data[d];
                            for (i = 0; i < ln; i++) {
                                var days = [], date = new Date(record.get(fields[i]) * 1000);
                                Ext.iterate(me.snippets.date, function (i, element) {
                                    days.push(element);
                                });
                                var day = days[date.getDay()];
                                day = day.substring(0, 2);
                                this.labels.push(day);
                            }
                        }
                    }
                }
            ],
            series: [
                {
                    type: 'line',
                    axis: 'left',
                    fill: true,
                    xField: 'date',
                    yField: 'visitors',

                    // Tips
                    tips: {
                        trackMouse: true,
                        width: 260,
                        height: 24,
                        renderer: function (storeItem) {
                            this.setTitle(storeItem.get('date') + ': ' + storeItem.get('visitors') + ' ' + me.snippets.visitors_online_total);
                        }
                    },
                    style: {
                        fill: '#2edc79',
                        stroke: '#2edc79'
                    },
                    highlight: {
                        size: 5,
                        radius: 5,
                        fill: '#2edc79',
                        stroke: '#2edc79'
                    },
                    markerConfig: {
                        type: 'circle',
                        fill: '#2edc79',
                        size: 4,
                        radius: 4,
                        'stroke-width': 0
                    }
                }
            ]
        });

        return me.chart;
    }
});
//
<?php }} ?>