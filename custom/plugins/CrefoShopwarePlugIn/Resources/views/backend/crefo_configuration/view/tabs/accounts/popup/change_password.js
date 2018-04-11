/*
 * Copyright (c) 2016 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */
//{namespace name=backend/creditreform/translation}
//{block name="backend/crefo_configuration/view/tabs/accounts/popup/change_password"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.accounts.popup.ChangePassword', {
    extend: 'Enlight.app.Window',
    alias: 'widget.crefoconfig-tabs-accounts-popup-change-password',
    layout: 'fit',
    autoShow: true,
    autoScroll: false,
    resizable: true,
    minimizable: false,
    height: 350,
    width: 650,
    minWidth: 625,
    minHeight: 350,
    bodyPadding: 5,
    modal: true,
    snippets: {
        titleNoEdit: '{s name="crefoconfig/view/tabs/accounts/popup/change_password/title"}Change password{/s}',
        btnCancel: '{s name="crefo/buttons/cancel"}Cancel{/s}',
        btnSave: '{s name="crefo/buttons/save"}Save{/s}',
        lblUserAcc: '{s name="crefoconfig/view/tabs/accounts/popup/edit/labels/user_account"}User Account{/s}',
        lblIndPass: '{s name="crefoconfig/view/tabs/accounts/popup/change_password/labels/ind_pass"}Individual Password{/s}',
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
    initComponent: function(){
        var me = this;

        me.title = me.snippets.titleNoEdit;

        me.items = me.getAccountPanel();

        var acc = me.record.get( "useraccount" );
        me.formPanel.down( "[name=useraccount]" ).setValue( acc );
        me.addEvents( 'changePassword' );

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
            }
                , {
                    text: me.snippets.btnSave,
                    action: 'save',
                    cls: 'primary',
                    handler: function( btn ){
                        me.fireEvent( 'changePassword', me.record, me.formPanel, me.view, me.inUseAccounts );
                    }
                }
            ]
        } ];

        // Add own vtypes to validate password fields
        Ext.apply( Ext.form.field.VTypes, {
            crefoPassword: function( val, field ){
                var success = true;
                var patt = /(\w)+/gi;
                if( val.length < 6 || !patt.test( val ) ) {
                    success = false;
                }
                return success;
            },
            crefoPasswordText: this.snippets.validation.invalidValue
        } );

        me.callParent( arguments );
    },
    getAccountPanel: function(){
        this.formPanel = Ext.create( 'Ext.form.Panel', {
            border: false,
            layout: 'anchor',
            autoScroll: true,
            bodyPadding: 10,
            defaults: {
                labelWidth: '155px',
                labelStyle: 'font-weight: 700; text-align: right;'
            },
            items: [
                this.getLoginFieldset()
            ]
        } );
        return this.formPanel;
    },
    getLoginFieldset: function(){
        var me = this;
        return Ext.create( 'Ext.form.FieldSet',
            {
                defaults: {
                    labelWidth: '155px',
                    labelStyle: 'font-weight: 700; text-align: right;',
                    height: '100%'
                },
                items: [ {
                    // Implementiert das Column Layout
                    xtype: 'container',
                    unstyled: true,
                    layout: 'column',
                    items: [
                        {
                            // Linke Spalte im Column Layout
                            xtype: 'container',
                            unstyled: true,
                            columnWidth: 0.5,
                            items: [
                                {
                                    xtype: 'textfield',
                                    labelWidth: '100%',
                                    // fieldWidth: '40%',
                                    fieldLabel: me.snippets.lblUserAcc,
                                    margin: '0 10 20 0',
                                    anchor: '100%',
                                    readOnly: true,
                                    fieldBodyCls: "x-item-disabled",
                                    name: 'useraccount',
                                    allowBlank: true,
                                    submitValue: true
                                }
                            ]
                        },
                        {
                            // Rechte Spalte im Column Layout
                            xtype: 'container',
                            unstyled: true,
                            columnWidth: 0.5,
                            items: [
                                {
                                    xtype: 'textfield',
                                    fieldLabel: me.snippets.lblIndPass,
                                    labelWidth: '100%',
                                    // fieldWidth: '40%',
                                    name: 'individualpassword',
                                    anchor: '100%',
                                    margin: '0 0 20 10',
                                    labelAlign: 'left',
                                    inputType: 'password',
                                    allowBlank: false,
                                    blankText: me.snippets.validation.invalidValue,
                                    vtype: 'crefoPassword'
                                }
                            ]
                        }
                    ]
                },
                    {
                        xtype: 'crefoconfig-tabs-accounts-popup-password-extension',
                        addon: false
                    }
                ]
            }
        );

    }
} );
//{/block}
