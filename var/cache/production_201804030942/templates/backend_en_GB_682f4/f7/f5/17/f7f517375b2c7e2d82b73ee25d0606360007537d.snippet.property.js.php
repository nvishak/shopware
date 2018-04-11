<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:29
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\product_stream\view\condition_list\condition\property.js" */ ?>
<?php /*%%SmartyHeaderCode:236995acda8f1533ba5-26202051%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7f517375b2c7e2d82b73ee25d0606360007537d' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\product_stream\\view\\condition_list\\condition\\property.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236995acda8f1533ba5-26202051',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f1555a16_75356929',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f1555a16_75356929')) {function content_5acda8f1555a16_75356929($_smarty_tpl) {?>/**
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
 * @package    ProductStream
 * @subpackage Window
 * @version    $Id$
 * @author shopware AG
 */
//
//
Ext.define('Shopware.apps.ProductStream.view.condition_list.condition.Property', {
    extend: 'ProductStream.filter.AbstractCondition',

    getName: function() {
        return 'Shopware\\Bundle\\SearchBundle\\Condition\\PropertyCondition';
    },

    getLabel: function() {
        return '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'property_condition','default'=>'Property condition','namespace'=>'backend/product_stream/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'property_condition','default'=>'Property condition','namespace'=>'backend/product_stream/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Property condition<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'property_condition','default'=>'Property condition','namespace'=>'backend/product_stream/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
    },

    isSingleton: function() {
        return true;
    },

    create: function(callback, container, conditions) {
        var me = this;

        Ext.create('Shopware.apps.ProductStream.view.condition_list.field.PropertyWindow', {
            subApp: me.subApp,
            applyCallback: function(group) {
                var field = me.createField(group.get('id'), group.get('name'));
                callback(field);
                me.updateTitle(container, group.get('name'));
            }
        }).show();
    },

    load: function(key, value, container) {
        var me = this;

        if (key.indexOf(this.buildName(value.groupId)) < 0) {
            return;
        }

        var field = this.createField(value.groupId, value.groupName);
        me.updateTitle(container, value.groupName);
        container.fixToggleTool();
        field.setValue(value);
        return field;
    },

    createField: function(groupId, groupName) {
        return Ext.create('Shopware.apps.ProductStream.view.condition_list.field.Property', {
            name: 'condition.' + this.buildName(groupId),
            searchStore: this.createStore(groupId),
            store: this.createStore(groupId),
            groupId: groupId,
            groupName: groupName,
            flex: 1
        });
    },

    buildName: function(groupId) {
        return this.getName() + '|' + groupId;
    },

    createStore: function(groupId) {
        var store = Ext.create('Shopware.store.Search', {
            fields: [
                { name: 'id', type: 'int' },
                { name: 'name', type: 'string', mapping: 'value'}
            ],
            configure: function() {
                return { entity: "Shopware\\Models\\Property\\Value" }
            }
        });
        store.getProxy().extraParams.groupId = groupId;
        return store;
    },


    updateTitle: function(container, name) {
        container.setTitle(this.getLabel() + ': ' + name);
    }
});
//<?php }} ?>