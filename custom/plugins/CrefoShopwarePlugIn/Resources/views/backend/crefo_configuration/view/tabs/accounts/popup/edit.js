/*
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */
//{namespace name=backend/creditreform/translation}
//{block name="backend/crefo_configuration/view/tabs/accounts/popup/edit"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.accounts.popup.Edit', {
    extend: 'Enlight.app.Window',
    alias: 'widget.crefoconfig-tabs-accounts-popup-edit',
    layout: 'fit',
    autoShow: true,
    autoScroll: false,
    resizable: true,
    minimizable: false,
    height: 400,
    width: 650,
    minWidth: 625,
    minHeight: 400,
    bodyPadding: 5,
    modal: true,
    snippets: {
        titleNoEdit: '{s name="crefoconfig/view/tabs/accounts/popup/edit/title_create"}Add User Account{/s}',
        titleEdit: '{s name="crefoconfig/view/tabs/accounts/popup/edit/title_edit"}User account edit{/s}',
        btnCancel: '{s name="crefo/buttons/cancel"}Cancel{/s}',
        btnSave: '{s name="crefo/buttons/save"}Save{/s}',
        lblUserAcc: '{s name="crefoconfig/view/tabs/accounts/popup/edit/labels/user_account"}User Account{/s}',
        lblGenPass: '{s name="crefoconfig/view/tabs/accounts/popup/edit/labels/gen_pass"}General Password{/s}',
        lblIndPass: '{s name="crefoconfig/view/tabs/accounts/popup/edit/labels/ind_pass"}Individual Password{/s}',
        validation: {
            error: '{s name="crefo/validation/checkFields"}Es ist ein Fehler aufgetreten (Plausibilitätsprüfung).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
        }
    },

    /**
     * Initialize the view components
     *
     * @return void
     */
    initComponent: function() {
        var me = this;

        me.items = me.getAccountPanel();

        if (me.edit === true) {
            me.title = me.snippets.titleEdit;
            var acc = me.record.get('useraccount');
            me.formPanel.down('[name=useraccount]').setValue(acc);
        } else {
            me.title = me.snippets.titleNoEdit;
        }

        me.addEvents('saveAccount', 'processChangeDefaultPasswordRequest');

        me.dockedItems = [ {
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items: [ '->', {
                text: me.snippets.btnCancel,
                cls: 'secondary',
                scope: me,
                handler: me.close
            },
            {
                text: me.snippets.btnSave,
                action: 'save',
                cls: 'primary',
                handler: function(btn) {
                    if (me.edit) {
                        me.formPanel.down('textfield').setDisabled(me.edit);
                    }
                    if (me.down('textfield[name=individualpassword]').getValue().toUpperCase() === 'CISSTART' && me.down('crefoconfig-tabs-accounts-popup-password-extension').isVisible()) {
                        me.fireEvent('processChangeDefaultPasswordRequest', me.record, me.formPanel, me.view, me.edit);
                    } else {
                        me.fireEvent('saveAccount', me.record, me.formPanel, me.view, me.edit);
                    }
                }
            }
            ]
        } ];

        //Add own vtypes to validate password fields
        Ext.apply(Ext.form.field.VTypes, {
            crefoPassword: function(val, field) {
                var success = true;
                var patt = /(\w)+/gi;
                if (val.length < 6 || !patt.test(val)) {
                    success = false;
                }
                return success;
            },
            crefoPasswordText: this.snippets.validation.invalidValue
        });

        me.callParent(arguments);
    },
    getAccountPanel: function() {
        this.formPanel = Ext.create('Ext.form.Panel', {
            border: false,
            layout: 'anchor',
            autoScroll: false,
            bodyPadding: 10,
            defaults: {
                labelWidth: '155px',
                labelStyle: 'font-weight: 700; text-align: right;'
            },
            items: [
                this.getLoginFieldset()
            ]
        });
        return this.formPanel;
    },
    getLoginFieldset: function() {
        var me = this;
        return Ext.create('Ext.form.FieldSet',
            {
                defaults: {
                    labelWidth: '155px',
                    labelStyle: 'font-weight: 700; text-align: right;'
                },
                items: [ {
                    //Implementiert das Column Layout
                    xtype: 'container',
                    unstyled: true,
                    layout: 'column',
                    items: [
                        {
                            //Linke Spalte im Column Layout
                            xtype: 'container',
                            unstyled: true,
                            columnWidth: 0.5,
                            items: [
                                {
                                    xtype: 'textfield',
                                    labelWidth: '100%',
                                    //fieldWidth: '40%',
                                    fieldLabel: me.snippets.lblUserAcc,
                                    anchor: '100%',
                                    margin: '0 10 20 0',
                                    readOnly: me.edit,
                                    fieldBodyCls: me.edit ? 'x-item-disabled' : '',
                                    submitValue: true,
                                    name: 'useraccount',
                                    itemId: 'useraccount',
                                    allowBlank: false,
                                    blankText: me.snippets.validation.invalidValue,
                                    invalidText: me.snippets.validation.invalidValue,
                                    enforceMaxLength: true,
                                    maxLength: 12,
                                    maskRe: /\d/,
                                    regex: /^\d\d\d\d\d\d\d\d\d\d\d\d$/,
                                    regexText: me.snippets.validation.invalidValue
                                }
                            ]
                        },
                        {
                            //Rechte Spalte im Column Layout
                            xtype: 'container',
                            unstyled: true,
                            columnWidth: 0.5,
                            items: [
                                {
                                    xtype: 'textfield',
                                    fieldLabel: me.snippets.lblGenPass,
                                    labelWidth: '100%',
                                    //fieldWidth: '40%',
                                    name: 'generalpassword',
                                    anchor: '100%',
                                    margin: '0 0 20 10',
                                    labelAlign: 'left',
                                    inputType: 'password',
                                    allowBlank: false,
                                    blankText: me.snippets.validation.invalidValue,
                                    vtype: 'crefoPassword'
                                },
                                {
                                    xtype: 'textfield',
                                    fieldLabel: me.snippets.lblIndPass,
                                    labelWidth: '100%',
                                    //fieldWidth: '40%',
                                    name: 'individualpassword',
                                    anchor: '100%',
                                    margin: '0 0 20 10',
                                    labelAlign: 'left',
                                    inputType: 'password',
                                    allowBlank: false,
                                    blankText: me.snippets.validation.invalidValue,
                                    vtype: 'crefoPassword',
                                    enableKeyEvents: true,
                                    listeners: {
                                        keyup: function(textfield, event) {
                                            var extraFields = this.up('fieldset').down('crefoconfig-tabs-accounts-popup-password-extension');
                                            if (textfield.getValue().toUpperCase() === 'CISSTART') {
                                                extraFields.setDisabled(false);
                                                extraFields.show();
                                            } else {
                                                extraFields.hide();
                                                extraFields.setDisabled(true);
                                            }
                                        }
                                    }
                                }
                            ]
                        }
                    ]
                },
                {
                    xtype: 'crefoconfig-tabs-accounts-popup-password-extension',
                    addon: true,
                    hidden: true,
                    disabled: true
                }
                ]
            }
        );
    }
});
//{/block}
