<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:41
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\components\tree.js" */ ?>
<?php /*%%SmartyHeaderCode:30075acda8fd5e9785-94963250%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94f4f94ca05d3ec2af95a9499e7b6146e4a2c16e' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\components\\tree.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30075acda8fd5e9785-94963250',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fd609fa8_07665207',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fd609fa8_07665207')) {function content_5acda8fd609fa8_07665207($_smarty_tpl) {?>/**
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
 * @package    PluginManager
 * @subpackage Components
 * @version    $Id$
 * @author shopware AG
 */

//
Ext.define('Shopware.apps.PluginManager.view.components.Tree', {
    extend: 'Ext.container.Container',
    alternateClassName: 'PluginManager.category.Tree',
    name: 'category-tree',
    cls: 'category-tree navigation-level',
    alias: 'widget.plugin-manager-category-tree',

    initComponent: function() {
        var me = this;

        me.store.on('load', function(store, records) {
            me.addNavigationItems(records, me);
        }, { single: true });

        me.callParent(arguments);
    },

    selectActiveTreeNode: function(category) {
        var me = this;
        var actives   = me.getActiveTreeRoute(category, me.items.items);
        var activeIds = me.getActiveIds(actives);

        me.disableTreeNodes(activeIds, me.items.items);
    },

    removeSelection: function() {
        this.selectActiveTreeNode(null);
    },

    /**
     * @param records
     * @param container
     */
    addNavigationItems: function(records, container) {
        var me = this;

        Ext.each(records, function(record) {
            var itemSubContainer = null;
            var content = '<div class="content">' + record.get('name') + '</div>';

            if (record.get('parentId')) {
                content = '<div class="node-lines">&nbsp;</div>' + content;
            }

            var itemContainer =  Ext.create('PluginManager.container.Container', {
                html: content,
                record: record,
                parentContainer: container,
                cls: 'category navigation-item',
                disabled: !Shopware.app.Application.sbpAvailable,
                listeners: {
                    click: function() {
                        me.selectActiveTreeNode(record);
                        me.fireEvent('select-category', record);
                    }
                }
            });

            container.add(itemContainer);

            if (record.getChildren() && record.getChildren().getCount() > 0) {

                itemSubContainer = Ext.create('Ext.container.Container', {
                    items: [],
                    cls: 'navigation-level sub-level',
                    hidden: true,
                    parentContainer: itemContainer
                });

                me.addNavigationItems(record.getChildren().data.items, itemSubContainer);

                container.add(itemSubContainer);
            }

            itemContainer.subContainer = itemSubContainer;
        });
    },

    getActiveTreeRoute: function(category, items) {
        var me = this, actives = [];

        Ext.each(items, function(item) {
            item.removeCls('active');

            if (category && item.hasCls('category') && item.record.get('id') == category.get('id')) {

                actives.push(item.subContainer);

                item.addCls('active');
            } else if (item.hasCls('navigation-level')) {

                var activeChildren = me.getActiveTreeRoute(category, item.items.items);

                if (activeChildren.length > 0) {
                    actives.push(item);

                    Ext.each(activeChildren, function(activeChild) {
                        actives.push(activeChild);
                    });
                }
            }
        });

        return actives;
    },

    getActiveIds: function(items) {
        var me = this, ids = [];

        Ext.each(items, function(item) {
            if (!item) {
                return true;
            }
            ids.push(item.id);
        });
        return ids;
    },

    disableTreeNodes: function(actives, items) {
        var me = this;

        Ext.each(items, function(item) {
            if (!item.hasCls('navigation-level')) {
                return true;
            }

            if (actives.indexOf(item.id) >= 0) {
                item.show();
            } else {
                item.hide();
            }

            me.disableTreeNodes(actives, item.items.items);
        });
    }
});
//<?php }} ?>