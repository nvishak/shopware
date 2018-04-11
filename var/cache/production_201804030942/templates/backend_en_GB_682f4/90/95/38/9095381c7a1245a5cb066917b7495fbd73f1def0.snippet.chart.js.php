<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\chart\chart.js" */ ?>
<?php /*%%SmartyHeaderCode:145975acda8f3e15e79-62030760%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9095381c7a1245a5cb066917b7495fbd73f1def0' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\chart\\chart.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145975acda8f3e15e79-62030760',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f3e4e025_74548733',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f3e4e025_74548733')) {function content_5acda8f3e4e025_74548733($_smarty_tpl) {?>/**
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
 * @subpackage Chart
 * @version    $Id$
 * @author shopware AG
 */

// 
// 
Ext.define('Shopware.apps.Customer.view.chart.Chart', {

    extend: 'Ext.chart.Chart',
    cls: 'customer-stream-chart',
    shadow: true,
    margin: 30,
    legend: true,
    animate: true,
    background: '#fff',

    initComponent: function () {
        var me = this;

        me.series = me.createSeries();

        me.axes = me.createAxes();

        me.callParent(arguments);
    },

    getAxesFields: function () {
        var me = this,
            fields = [];

        Ext.each(me.getFields(), function(item) {
            fields.push(item.name);
        });
        return fields;
    },

    getFields: function () {
        return [];
    },

    currencyRenderer: function(value) {
        value = value * 1;
        return Ext.util.Format.currency(value, this.getCurrency(), 2, (this.subApp.currencyAtEnd == 1));
    },

    getCurrency: function() {
        var currency = this.subApp.currencySign;

        switch (currency) {
            case '&euro;':
                return '&#8364;';
            case '&pound;':
                return '&#163;';
            default:
                return currency;
        }
    },

    createAxes: function () {
        var me = this;
        return [{
            type: 'Numeric',
            position: 'left',
            fields: me.getAxesFields(),
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'amount_axes','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'amount_axes','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Quantity / Revenue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'amount_axes','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            grid: true,
            minimum: 0,
            label: {
                renderer: function (value) {
                    return me.currencyRenderer(value);
                }
            }
        }, {
            type: 'Category',
            position: 'bottom',
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'month','default'=>'Month','namespace'=>'backend/customer/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'month','default'=>'Month','namespace'=>'backend/customer/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Month<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'month','default'=>'Month','namespace'=>'backend/customer/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            fields: ['yearMonth'],
            label: {
                renderer: function (value) {
                    var myDate = Ext.Date.add(new Date(value), Ext.Date.DAY, 4);
                    return Ext.util.Format.date(myDate, 'M, Y');
                },
                rotate: {
                    degrees: 315
                }
            }
        }];
    },

    createSeries: function () {
        var me = this,
            series = [];

        Ext.each(me.getFields(), function(item) {
            series.push(me.createLineSeries(item.name, item.title, item.currency));
        });

        return series;
    },

    createLineSeries: function(field, title, currency) {
        var me = this;

        return {
            type: 'line',
            axis: 'left',
            highlight: { size: 7, radius: 7 },
            fill: true,
            smooth: true,
            title: title,
            xField: 'yearMonth',
            yField: field,
            tips: {
                trackMouse: true,
                layout: 'fit',
                lineField: field,
                fieldTitle: title,
                height: 45,
                width: 300,
                highlight: { size: 7, radius: 7 },
                renderer: function (storeItem) {
                    var value = storeItem.get(this.lineField);

                    if (currency) {
                        value = me.currencyRenderer(value);
                    }

                    this.setTitle(
                        '<div class="customer-stream-chart-tip">' +
                            '<span class="customer-stream-chart-tip-label">' + this.fieldTitle + ':</span>&nbsp;'+
                            '<span class="customer-stream-chart-tip-amount">' + value + '</span>' +
                        '</div>'
                    );
                }
            },
            markerConfig: { type: 'circle', size: 4, radius: 4, 'stroke-width': 0 }
        };
    }
});
// 
<?php }} ?>