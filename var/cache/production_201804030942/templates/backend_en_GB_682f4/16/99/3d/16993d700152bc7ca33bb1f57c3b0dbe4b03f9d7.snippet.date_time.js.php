<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:19
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\element\date_time.js" */ ?>
<?php /*%%SmartyHeaderCode:286345acda8e737bab4-49347078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16993d700152bc7ca33bb1f57c3b0dbe4b03f9d7' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\element\\date_time.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '286345acda8e737bab4-49347078',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e73a9137_92359063',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e73a9137_92359063')) {function content_5acda8e73a9137_92359063($_smarty_tpl) {?>/*
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
Ext.define('Shopware.apps.Base.view.element.DateTime', {
    extend:'Ext.form.FieldContainer',
    alias: [
        'widget.base-element-datetime'
    ],

    mixins: {
        field: 'Ext.form.field.Field'
    },
    layout: 'fit',
    timePosition: 'right', // valid values:'below', 'right'
    dateCfg:{},
    timeCfg:{},
    allowBlank: true,

    initComponent: function() {
        var me = this;

        me.value = me.formatValue(me.value);
        me.buildField();
        me.callParent();
        me.dateField = me.down('datefield');
        me.timeField = me.down('timefield');
        me.initField();
    },

    formatValue: function(value) {
        if(!value) {
            return null;
        } else if (typeof(value) == 'string') {
            value = value.replace(' ', 'T');
            value += '+00:00';
            value = new Date(value);
            return new Date((value.getTime() + (value.getTimezoneOffset() * 60 * 1000)));
        } else {
            return value;
        }
    },

    //@private
    buildField: function() {
        var me = this,
            l,
            d;
        if (me.timePosition == 'below') {
            l = { type: 'anchor' };
            d = { anchor: '100%' };
        } else {
            l = { type: 'hbox', align: 'middle' };
            d = { flex: 1 };
        }
        this.items = {
            xtype: 'container',
            layout: l,
            defaults: d,
            items: [Ext.apply({
                xtype: 'datefield',
                //format: 'Y-m-d',
                disabled: me.disabled,
                value: me.value,
                width: me.timePosition != 'below' ? 100 : undefined,
                allowBlank: me.allowBlank,
                listeners: {
                    specialkey: me.onSpecialKey,
                    scope: me
                },
                isFormField: false // prevent submission
            }, me.dateCfg), Ext.apply({
                xtype: 'timefield',
                submitFormat: 'H:i:s',
                disabled: me.disabled,
                value: me.value,
                margin: me.timePosition != 'below' ? '0 0 0 3' : 0,
                width: me.timePosition != 'below' ? 80 : undefined,
                allowBlank: me.allowBlank,
                listeners: {
                    specialkey: me.onSpecialKey,
                    scope: me
                },
                isFormField: false // prevent submission
            }, me.timeCfg)]
        };
    },

    focus: function() {
        this.callParent();
        this.dateField.focus(false, 100);
    },

    // Handle tab events
    onSpecialKey:function(cmp, e) {
        var key = e.getKey();
        if (key === e.TAB) {
            if (cmp == this.dateField) {
                // fire event in container if we are getting out of focus from datefield
                if (e.shiftKey) {
                    this.fireEvent('specialkey', this, e);
                }
            }
            if (cmp == this.timeField) {
                if (!e.shiftKey) {
                    this.fireEvent('specialkey', this, e);
                }
            }
        } else if (this.inEditor) {
            this.fireEvent('specialkey', this, e);
        }
    },

    getValue: function() {
        var value, date = this.dateField.getSubmitValue(), time = this.timeField.getSubmitValue();
        if (date) {
            if (time) {
                var format = this.getFormat();
                value = Ext.Date.parse(date + ' ' + time, format);
            } else {
                value = this.dateField.getValue();
            }
        }
        return value
    },

    setValue: function(value) {
        value = this.formatValue(value);
        if (value !== null && !isNaN(value)) {
            this.dateField.setValue(value);
            this.timeField.setValue(value);
        } else if (value === null) {
            this.reset();
        }
    },

    getSubmitData: function() {
        var value = this.getValue();
        var format = this.getFormat();
        var result = { };
        result[this.name]  = value ? Ext.Date.format(value, format) : null;
        return result;
    },

    getFormat: function() {
        return (this.dateField.submitFormat || this.dateField.format) + " " + (this.timeField.submitFormat || this.timeField.format)
    },

    getErrors: function() {
        return this.dateField.getErrors().concat(this.timeField.getErrors());
    },

    validate: function() {
        if (this.disabled)
            return true;
        else {
            var isDateValid = this.dateField.validate();
            var isTimeValid = this.timeField.validate();
            return isDateValid && isTimeValid;
        }
    },

    reset: function() {
        this.mixins.field.reset();
        this.dateField.reset();
        this.timeField.reset();
    }
});
<?php }} ?>