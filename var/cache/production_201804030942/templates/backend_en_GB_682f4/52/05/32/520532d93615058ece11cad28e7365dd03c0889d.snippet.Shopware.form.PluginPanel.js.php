<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:18
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\Shopware.form.PluginPanel.js" */ ?>
<?php /*%%SmartyHeaderCode:102825acda8e659aab6-37030291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '520532d93615058ece11cad28e7365dd03c0889d' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\Shopware.form.PluginPanel.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102825acda8e659aab6-37030291',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e6612d07_47186570',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e6612d07_47186570')) {function content_5acda8e6612d07_47186570($_smarty_tpl) {?>/**
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
 * @package    Base
 * @subpackage Component
 * @version    $Id$
 * @author shopware AG
 */
//
Ext.define('Shopware.form.PluginPanel',
/** @lends Ext.form.Panel# */
{
    /**
     * The parent class that this class extends.
     * @string
     */
    extend: 'Ext.form.Panel',

    /**
     * Alternate class name for the component.
     * @string
     */
    alternateClassName: 'Shopware.form.ConfigPanel',

    /**
     * List of short aliases for class names
     * @array
     */
    alias: 'widget.plugin-form-panel',

    /**
     * Store which contains the different shops.
     * @object Ext.data.Store
     */
    shopStore: Ext.create('Shopware.apps.Base.store.ShopLanguage'),

    /**
     * Store which contains the form elements.
     * @object Ext.data.Store
     */
    formStore: Ext.create('Shopware.apps.Base.store.Form'),

    /**
     * Truthy to include the buttons, falsy to prevent that behavior
     * @boolean
     */
    injectActionButtons: false,

    descriptionField: true,

    _descriptionAdded: false,

    /**
     * String with the error message for when no formId is configured
     */
    noFormIdConfiguredErrorText: 'No formId is passed to the component configuration',

    /**
     * String with the error message for when the form could not be loaded
     */
    formNotLoadedErrorText: "The form store couldn't be loaded successfully.",

    snippets: {
        resetButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'form'/'reset_text','default'=>'Reset','namespace'=>'backend/config/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'reset_text','default'=>'Reset','namespace'=>'backend/config/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Reset<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'reset_text','default'=>'Reset','namespace'=>'backend/config/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        saveButton: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'form'/'save_text','default'=>'Save','namespace'=>'backend/config/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'save_text','default'=>'Save','namespace'=>'backend/config/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'save_text','default'=>'Save','namespace'=>'backend/config/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        description: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'form'/'description_title','default'=>'Description','namespace'=>'backend/config/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'description_title','default'=>'Description','namespace'=>'backend/config/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'description_title','default'=>'Description','namespace'=>'backend/config/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        onSaveFormTitle: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'form'/'message'/'save_form_title','default'=>'Save form','namespace'=>'backend/config/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'message'/'save_form_title','default'=>'Save form','namespace'=>'backend/config/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save form<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'message'/'save_form_title','default'=>'Save form','namespace'=>'backend/config/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        saveFormSuccess: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'form'/'message'/'save_form_success','default'=>'Form „[name]“ has been saved.','namespace'=>'backend/config/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'message'/'save_form_success','default'=>'Form „[name]“ has been saved.','namespace'=>'backend/config/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Form "[name]" has been saved.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'message'/'save_form_success','default'=>'Form „[name]“ has been saved.','namespace'=>'backend/config/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        saveFormError: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'form'/'message'/'save_form_error','default'=>'Form „[name]“ could not be saved.','namespace'=>'backend/config/controller/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'message'/'save_form_error','default'=>'Form „[name]“ could not be saved.','namespace'=>'backend/config/controller/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Form "[name]" could not be saved.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'form'/'message'/'save_form_error','default'=>'Form „[name]“ could not be saved.','namespace'=>'backend/config/controller/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Initiliazes the component, loads the stores and creates the view.
     *
     * @public
     * @return void
     */
    initComponent: function() {
        var me = this;

        // Check if we're having a plugin form id
        if(!me.formId) {
            Ext.Error.raise(me.noFormIdConfiguredErrorText);
            return false;
        }

        // Cast the id to an integer
        me.formId = ~~(1 * me.formId);

        if(!me.shopStore.getCount()) {
            me.shopStore.load();
        }

        // Prepare form store and load the form record
        me.formStore.on('load', me.onLoadForm, me, { single: true });
        me.formStore.load({
            filters : [{
                property: 'id',
                value: me.formId
            }]
        });

        me.callParent(arguments);
    },

    /**
     * Event listener method which will be called when the form store was
     * loaded.
     *
     * Prepares the form and calls the "initForm"-method.
     *
     * @public
     * @event load
     * @param [object] store - Shopware.apps.Base.store.Form
     * @param [array] records - Array of returned records
     * @param [boolean] success - Truthy if the operation was successfully, if falsy the operation failed.
     * @return [boolean|void]
     */
    onLoadForm: function(store, records, success) {
        var me = this;

        // Check the response
        if (success !== true || !records.length) {
            Ext.Error.raise(me.formNotLoadedErrorText);
            return false;
        }

        // Initialize the form
        me.initForm(records[0]);
    },

    /**
     * Initializes the form panel and checks if the shop store
     * was loaded successfully.
     *
     * @public
     * @param [object] form - Shopware.apps.Base.model.Form
     * @return void
     */
    initForm: function(form) {
        var me = this;

        // If the shop store isn't fully loaded yet, defer the "initForm"-call
        if(me.shopStore.isLoading() || !me.rendered) {
            Ext.defer(me.initForm, 100, me, [ form ]);
            return false;
        }

        if(me.injectActionButtons) {
            me.addDocked(me.getButtons());
        }
        me.add(me.getItems(form));
        me.loadRecord(form);
        me.fireEvent('form-initialized', me);
    },

    /**
     * Creates the action toolbar which is docked (bottom)
     * to the form panel.
     *
     * @public
     * @return [array]
     */
    getButtons: function() {
        var me = this;

        return {
            dock: 'bottom',
            xtype: 'toolbar',
            items: ['->', {
                text: me.snippets.resetButton,
                cls: 'secondary',
                action: 'reset'
            }, {
                text: me.snippets.saveButton,
                cls: 'primary',
                action: 'save'
            }]
        };
    },

    /**
     * Creates the form elements based on the passed Shopware.apps.Base.model.Form
     * model.
     *
     * @public
     * @param [object] form - Shopware.apps.Base.model.Form
     * @return [array] - array of form element objects (initialConfig)
     */
    getItems: function(form) {
        var me = this,
            type, name, value,
            elementLabel = '',
            elementDescription = '', elementName,
            items = [],
            tabs = [], options;

        if(form.get('description') && me.descriptionField) {

            if(!me._descriptionAdded) {
                items.push({
                    xtype: 'fieldset',
                    margin: 10,
                    title: me.snippets.description,
                    html: form.get('description')
                });

                // Set private flag
                me._descriptionAdded = true;
            }
        }

        me.shopStore.each(function(shop) {
            var fields = [];
            form.getElements().each(function(element) {
                value = element.getValues().find('shopId', shop.getId(), 0, false, true, true);
                value = element.getValues().getAt(value);
                var initialValue = value;
                type = element.get('type').toLowerCase();
                type = 'base-element-' + type;
                name = 'values[' + shop.get('id') + ']['+ element.get('id') + ']';

                options = element.get('options');
                options = options || {};
                delete options.attributes;

                elementName = element.get('name');
                elementLabel = element.get('label');
                elementDescription = element.get('description');
                if(element.associations.containsKey('getTranslation')) {
                    if(element.getTranslation().getAt(0) && element.getTranslation().getAt(0).get('label')) {
                        elementLabel = element.getTranslation().getAt(0).get('label');
                    }

                    if(element.getTranslation().getAt(0) && element.getTranslation().getAt(0).get('description')) {
                        elementDescription = element.getTranslation().getAt(0).get('description');
                    }
                }

                var field = Ext.apply({
                    xtype: type,
                    name: name,
                    elementName: elementName,
                    fieldLabel: elementLabel,
                    helpText: elementDescription, //helpText
                    value: value ? value.get('value') : element.get('value'),
                    emptyText: shop.get('default') ? null : element.get('value'),
                    disabled: !element.get('scope') && !shop.get('default'),
                    allowBlank: !element.get('required') || !shop.get('default')
                }, options);

                if (field.xtype == "base-element-boolean" || field.xtype == "base-element-checkbox") {
                    field = me.convertCheckBoxToComboBox(field, shop, initialValue);
                }
                else if ((field.xtype == "base-element-datetime" ||
                        field.xtype == "base-element-date" ||
                        field.xtype == "base-element-time") && field.value) {

                    field.value += '+00:00';
                    field.value = new Date(field.value);
                    field.value = new Date((field.value.getTime() + (field.value.getTimezoneOffset() * 60 * 1000)));
                }

                fields.push(field);

            });
            if(fields.length > 0) {
                tabs.push({
                    xtype: 'base-element-fieldset',
                    title: shop.get('name'),
                    items: fields
                });
            }
        });

        if(tabs.length > 1) {
            items.push({
                xtype: 'tabpanel',
                bodyStyle: 'background-color: transparent !important',
                border: 0,
                activeTab: 0,
                enableTabScroll: true,
                deferredRender: false,
                items: tabs,
                plain: true
            });
        } else if(tabs.length == 1) {
            if(tabs[0].title) {
                delete tabs[0].title;
            }
            items.push({
                xtype: 'panel',
                bodyStyle: 'background-color: transparent !important',
                border: 0,
                layout: 'fit',
                items: tabs,
                bodyBorder: 0
            });
        }
        return items;
    },

    /**
     * helper method to convert the checkbox to a combobox
     * this is done to support the not selected values by the customer
     * cause checkboxes only have two states
     *
     * @param { Shopware.apps.Base.view.element.BooleanSelect } field
     * @param { Shopware.apps.Base.model.Shop } shop
     * @param { int } initialValue
     * @returns Shopware.apps.Base.view.element.BooleanSelect
     */
    convertCheckBoxToComboBox: function (field, shop, initialValue) {
        var booleanSelectValue = field.value;

        if (shop.get('id') != 1 && initialValue === undefined) {
            // set empty string only for foreign shops as a fallback to the default shop
            // the default shop always got a value
            booleanSelectValue = '';
        }
        else {
            //cast the value to boolean
            booleanSelectValue = Boolean(field.value);
        }

        Ext.apply(field, {
            xtype: "base-element-boolean-select",
            value: booleanSelectValue,
            emptyText: ""
        });

        return field;
    },

    /**
     * Event listener method which triggers when the user
     * wants to save the plugin configuraton form.
     *
     * @public
     * @param [object] button - Ext.button.Button
     */
    onSaveForm: function(formPanel, closeWindow, callback) {
        var me = this,
            basicForm = formPanel.getForm() || me.getForm(),
            form = basicForm.getRecord(),
            values = basicForm.getFieldValues(),
            fieldName, fieldValue, valueStore,
            win = formPanel.up('window');

        closeWindow = closeWindow || false;

        form.getElements().each(function(element) {
            valueStore = element.getValues();
            valueStore.removeAll();
            me.shopStore.each(function(shop) {
                fieldName = 'values[' + shop.get('id') + ']['+ element.get('id') + ']';
                fieldValue = values[fieldName];
                if(fieldValue !== '' && fieldValue !== null) {
                    valueStore.add({
                        shopId: shop.get('id'),
                        value: fieldValue
                    });
                }
            });
        });

        form.setDirty();

        var title = me.snippets.onSaveFormTitle;

        form.store.add(form);
        form.store.sync({
            success :function (records, operation) {
                var template = new Ext.Template(me.snippets.saveFormSuccess),
                    message = template.applyTemplate({
                        name: form.data.label || form.data.name
                    });
                Shopware.Notification.createGrowlMessage(title, message, win.title);
                if(closeWindow) {
                    win.destroy();
                }
                if(callback) {
                    callback.apply(me, records, operation);
                }
            },
            failure:function (records, operation) {
                var template = new Ext.Template(me.snippets.saveFormError),
                    message = template.applyTemplate({
                        name: form.data.label || form.data.name
                    });
                Shopware.Notification.createGrowlMessage(title, message, win.title);
            }
        });
    }
});
<?php }} ?>