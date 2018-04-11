<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:35
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\statistics\chart.js" */ ?>
<?php /*%%SmartyHeaderCode:227455acda8f714c051-02254820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '108ed63f20ed2189b44c1ce35e23b051f94704a5' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\statistics\\chart.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '227455acda8f714c051-02254820',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f716fd62_36836078',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f716fd62_36836078')) {function content_5acda8f716fd62_36836078($_smarty_tpl) {?>/**
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
Ext.define('Shopware.apps.Article.view.statistics.Chart', {

    /**
     * Extend from the standard ExtJS 4
     * @string
     */
    extend: 'Ext.chart.Chart',

    /**
     * Chart of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.article-statistics-chart',

    /**
     * Set css class
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-statistics-chart',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        revenue: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'revenue','default'=>'Revenue:','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'revenue','default'=>'Revenue:','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Turnover:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'revenue','default'=>'Revenue:','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        orders: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'statistic'/'list'/'orders','default'=>'Orders:','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'orders','default'=>'Orders:','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Orders:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'statistic'/'list'/'orders','default'=>'Orders:','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    insetPadding: 20,
    theme: 'Green',

    /**
     * Initialize the Shopware.apps.Article.view.statistics.Chart and defines the necessary default configuration
     * @return void
     */
    initComponent: function () {
        var me = this;

        me.axes = [{
            type: 'Numeric',
            position: 'left',
            fields: [ 'revenue'],
            grid: true,
            minimum: 0
        }, {
            type: 'Category',
            position: 'bottom',
            fields: ['groupdate'],
            setLabels: function() {
                var store = this.chart.getChartStore();
                var labels = this.labels = [];
                var monthArray = Ext.Array.map(Ext.Date.monthNames, function (e) { return [e]; });
                store.each(function(item) {
                    labels.push(monthArray[item.get('month')-1]);
                });
            }
        }];

        me.series = [{
            type: 'line',
            axis: 'left',
            highlight: true,
            tips: {
            trackMouse: true,
                width: 120,
                renderer: function(storeItem, item) {
                    this.setTitle(me.snippets.orders + ' ' + storeItem.get('orders') + '<br>' + me.snippets.revenue + ' ' +  storeItem.get('revenue'));
                }
            },
            markerConfig: {
                type: 'circle',
                fill: '#13be7b',
                size: 4,
                radius: 4,
                'stroke-width': 0
            },
            xField: 'groupdate',
            yField: 'revenue'
        }];

        me.callParent(arguments);
    }
});
//

<?php }} ?>