<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:21
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\attribute\Shopware.attribute.Form.js" */ ?>
<?php /*%%SmartyHeaderCode:237905acda8e9df8d26-54456859%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb78d4262127b61e639ddf39019cb3381ead07d0' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\attribute\\Shopware.attribute.Form.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '237905acda8e9df8d26-54456859',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e9f03ed8_80086151',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e9f03ed8_80086151')) {function content_5acda8e9f03ed8_80086151($_smarty_tpl) {?>/**
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
 * @category    Shopware
 * @package     Base
 * @subpackage  Attribute
 * @version     $Id$
 * @author      shopware AG
 */

//
//
Ext.define('Shopware.attribute.Form', {
    extend: 'Ext.form.Panel',
    layout: 'anchor',
    alias: 'widget.shopware-attribute-form',
    cls: 'shopware-attribute-form',
    bodyStyle: {
        background: 'transparent'
    },
    autoScroll: false,
    mixins: { helper: 'Shopware.model.Helper' },
    defaults: { anchor: '100%' },
    border: false,
    fieldSetPadding: 10,
    fields: [],

    /**
     * @required
     * @var string|null
     * @example s_articles_attributes
     */
    table: null,

    /**
     * Disable to deactivate translation plugin
     * @boolean
     */
    allowTranslation: true,

    /**
     * Ext.tab.Panel
     */
    tabPanel: null,

    /**
     * Ext.form.Panel
     */
    translationForm: null,

    /**
     * @var boolean
     */
    configLoaded: false,

    /**
     * @var Shopware.form.Translation|null
     */
    translationPlugin: null,

    initComponent: function() {
        var me = this;

        me.typeHandlers = me.registerTypeHandlers();

        me.initTabChange();
        me.initTranslation();
        me.loadConfig();

        // refresh translation plugin after panel expanded to display translation icons
        me.on('expand', function() {
            me.refreshTranslationPlugin();
        });

        // refresh translation after form showed. special case for tab panels
        me.on('show', function() {
            me.refreshTranslationPlugin();
        });

        me.callParent(arguments);
    },

    initTabChange: function() {
        var me = this;

        if (!me.tabPanel) {
            return;
        }

        me.on('config-loaded', function() {
            me.tabPanel.setActiveTab(0);
        }, me, { single: true });
    },

    initTranslation: function() {
        var me = this;

        if (!me.allowTranslation) {
            return;
        }

        me.translationPlugin = Ext.create('Shopware.form.Translation', {
            translationType: me.table
        });
        me.plugins = [me.translationPlugin];
    },

    loadAttribute: function(foreignKey, callback) {
        var me = this;
        callback = callback ? callback: Ext.emptyFn;

        if (!foreignKey) {
            me.disableForm(true);
            callback();
            return;
        }

        if (!me.configLoaded) {
            me.on('config-loaded', function() {
                me.loadAttribute(foreignKey, callback);
            }, me, { single: true });
            return;
        }

        if (me.fields.length <= 0) {
            callback();
            return;
        }

        try {
            me.disableForm(false);
        } catch (e) { }

        me.resetFields();

        me.setLoading(true);

        me.load({
            url: '<?php echo '/shopware4/backend/AttributeData/loadData';?>',
            params: {
                _foreignKey: foreignKey,
                _table: me.table
            },
            success: function() {
                me.setLoading(false);
                try {
                    me.refreshTranslationPlugin(foreignKey);
                } catch (e) { }

                callback();
            },
            failure: function() {
                me.setLoading(false);
                me.resetFields();
                callback();
            }
        });
    },

    disableForm: function(disabled) {
        var me = this;

        if (me.fields.length <= 0) {
            return;
        }
        me.setDisabled(disabled);
    },

    resetFields: function() {
        var me = this;
        var fields = me.getForm().getFields();

        Ext.each(fields.items, function(field) {
            try {
                field.setValue(null);
            } catch (e) {
            }
        });
    },

    saveAttribute: function(foreignKey, callback) {
        var me = this, callbackFn = Ext.emptyFn;

        if (Ext.isFunction(callback)) {
            callbackFn = callback;
        }

        if (!foreignKey) {
            callbackFn(false);
            return;
        }

        if (!me.getForm().isValid()) {
            callbackFn(false);
            return;
        }
        if (me.fields.length <= 0) {
            callbackFn(false);
            return;
        }

        me.submit({
            url: '<?php echo '/shopware4/backend/AttributeData/saveData';?>',
            params: {
                _table: me.table,
                _foreignKey: foreignKey
            },
            success: function() {
                callbackFn(true);
            },
            failure: function() {
                callbackFn(false);
            }
        });
    },

    refreshTranslationPlugin: function(foreignKey) {
        var me = this;

        if (foreignKey) {
            me._translationConfig.translationKey = foreignKey;
        }

        if (me.translationForm) {
            me.translationForm.translationPlugin.initTranslationFields(me.translationForm);
            return;
        }

        if (!me.translationPlugin || !me.allowTranslation) {
            return;
        }

        me.translationPlugin.initTranslationFields(me);
    },

    loadConfig: function() {
        var me = this;

        me.configLoaded = false;
        me.store = Ext.create('Shopware.store.AttributeConfig');
        me.store.getProxy().extraParams = { table: me.table };
        me.store.load(function(attributes) {
            me.fields = me.createFields(attributes);
            me.removeAll();
            me.add(me.createFieldSet(me.fields));
            me.configLoaded = true;
            me.refreshTranslationPlugin();
            me.fireEvent('config-loaded', me.fields);
        });
    },

    createFieldSet: function(fields) {
        var me = this, items, hidden = false;

        items = fields;
        if (fields.length <= 0) {

            /*<?php ob_start();?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['acl_is_allowed'][0][0]->isAllowed(array('resource'=>'attributes','privilege'=>'read'),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if (!$_tmp1){?>*/
                hidden = true;

                me.fireEvent('hide-attribute-field-set');

            /*<?php }?>*/

            items = [me.createNotification()];
        }

        me.fieldSet = Ext.create('Ext.form.FieldSet', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'attribute_form_title','namespace'=>'backend/attributes/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_form_title','namespace'=>'backend/attributes/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free text fields<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'attribute_form_title','namespace'=>'backend/attributes/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            defaults: { anchor: '100%' },
            layout: 'anchor',
            background: 'transparent',
            hidden: hidden,
            items: [{
                xtype: 'container',
                padding: me.fieldSetPadding,
                defaults: me.defaults,
                layout: 'anchor',
                items: items
            }]
        });
        return me.fieldSet;
    },

    createNotification: function() {
        var me = this;

        me.moduleButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configure_now','namespace'=>'backend/attributes/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configure_now','namespace'=>'backend/attributes/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Configure now<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configure_now','namespace'=>'backend/attributes/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'primary attribute-notification-button configure-button',
            margin: 4,
            handler: function() {
                Shopware.app.Application.addSubApplication({
                    name: 'Shopware.apps.Attributes',
                    params: {
                        table: me.table
                    }
                });
            }
        });

        me.reloadButton = Ext.create('Ext.button.Button', {
            text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'reload','namespace'=>'backend/attributes/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'reload','namespace'=>'backend/attributes/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Refresh<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'reload','namespace'=>'backend/attributes/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'secondary attribute-notification-button',
            handler: function() {
                me.loadConfig();
            }
        });

        var notification = Ext.create('Ext.Component', {
            cls: 'attribute-notification',
            padding: 10,
            html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'notification','namespace'=>'backend/attributes/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'notification','namespace'=>'backend/attributes/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No free text fields configured for this module.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'notification','namespace'=>'backend/attributes/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        });

        return Ext.create('Ext.container.Container', {
            items: [notification, me.moduleButton, me.reloadButton]
        });
    },

    createFields: function(attributes) {
        var me = this, fields = [];

        Ext.each(attributes, function(attribute) {
            var field = {
                name: '__attribute_' + attribute.get('columnName'),
                translatable: attribute.get('translatable'),
                fieldLabel: attribute.get('label'),
                supportText: attribute.get('supportText'),
                helpText: attribute.get('helpText'),
                labelWidth: 155,
                value: attribute.get('defaultValue')
            };
            var handler = me.getTypeHandler(attribute);

            if (handler && attribute.get('displayInBackend')) {
                fields.push(handler.create(field, attribute));
            }
        });

        return fields;
    },

    getTypeHandler: function(attribute) {
        var me = this;
        var found = null;

        Ext.each(me.typeHandlers, function(handler) {
            if (handler.supports(attribute)) {
                found = handler;
                return false;
            }
        });
        return found;
    },

    registerTypeHandlers: function() {
        return [
            Ext.create('Shopware.attribute.ShopFieldHandler'),
            Ext.create('Shopware.attribute.ProductStreamFieldHandler'),
            Ext.create('Shopware.attribute.PremiumFieldHandler'),
            Ext.create('Shopware.attribute.EmotionFieldHandler'),
            Ext.create('Shopware.attribute.MailFieldHandler'),
            Ext.create('Shopware.attribute.PaymentFieldHandler'),
            Ext.create('Shopware.attribute.DispatchFieldHandler'),
            Ext.create('Shopware.attribute.CustomerFieldHandler'),
            Ext.create('Shopware.attribute.CustomerStreamFieldHandler'),
            Ext.create('Shopware.attribute.FormFieldHandler'),
            Ext.create('Shopware.attribute.PartnerFieldHandler'),
            Ext.create('Shopware.attribute.NewsletterFieldHandler'),
            Ext.create('Shopware.attribute.ProductFeedFieldHandler'),
            Ext.create('Shopware.attribute.VoucherFieldHandler'),
            Ext.create('Shopware.attribute.PropertyOptionFieldHandler'),
            Ext.create('Shopware.attribute.CategoryFieldHandler'),
            Ext.create('Shopware.attribute.MediaFieldHandler'),
            Ext.create('Shopware.attribute.ProductFieldHandler'),
            Ext.create('Shopware.attribute.BlogFieldHandler'),
            Ext.create('Shopware.attribute.BooleanFieldHandler'),
            Ext.create('Shopware.attribute.DateFieldHandler'),
            Ext.create('Shopware.attribute.DateTimeFieldHandler'),
            Ext.create('Shopware.attribute.FloatFieldHandler'),
            Ext.create('Shopware.attribute.HtmlFieldHandler'),
            Ext.create('Shopware.attribute.IntegerFieldHandler'),
            Ext.create('Shopware.attribute.StringFieldHandler'),
            Ext.create('Shopware.attribute.TextAreaFieldHandler'),
            Ext.create('Shopware.attribute.ComboBoxFieldHandler'),
            Ext.create('Shopware.attribute.SingleSelectionFieldHandler'),
            Ext.create('Shopware.attribute.MultiSelectionFieldHandler')
        ];
    }
});
//<?php }} ?>