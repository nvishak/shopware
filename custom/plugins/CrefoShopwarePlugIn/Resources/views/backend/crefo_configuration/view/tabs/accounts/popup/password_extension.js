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
//{block name="backend/crefo_configuration/view/tabs/accounts/popup/password_extension"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.accounts.popup.PasswordExtension', {
    extend: 'Ext.container.Container',
    alias: 'widget.crefoconfig-tabs-accounts-popup-password-extension',
    unstyled: true,
    layout: 'column',
    snippets: {
        extraPassText: '{s name="crefoconfig/view/tabs/accounts/popup/password_extension/labels/new_indpass_text"}Das Startkennwort wurde erkannt. Es muss ein neues persönliches Kennwort vergeben werden.{/s}',
        newIndPassText: '{s name="crefoconfig/view/tabs/accounts/popup/password_extension/labels/new_indpass"}Neues persönliches Kennwort{/s}',
        newIndPassConfirm: '{s name="crefoconfig/view/tabs/accounts/popup/password_extension/labels/new_indpass_confirm"}Neues persönliches Kennwort bestätigen{/s}',
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
        var me = this, components = [];
        if( me.addon ) {
            components.push( me.createDescriptionContainer( "", 1 ) );
            components.push( me.createDescriptionContainer( me.snippets.extraPassText, 1 ) );
        }
        components.push( me.createDescriptionContainer( "", 0.5 ) );
        components.push( {
            xtype: 'container',
            unstyled: true,
            columnWidth: 0.5,
            items: [
                {
                    xtype: 'textfield',
                    fieldLabel: me.snippets.newIndPassText,
                    labelWidth: '100%',
                    name: 'newindividualpassword',
                    anchor: '100%',
                    margin: '0 0 20 10',
                    labelAlign: 'left',
                    inputType: 'password',
                    allowBlank: false,
                    blankText: me.snippets.validation.invalidValue,
                    vtype: 'passwordChange'
                },
                {
                    xtype: 'textfield',
                    fieldLabel: me.snippets.newIndPassConfirm,
                    labelWidth: '100%',
                    name: 'password_confirmation',
                    anchor: '100%',
                    margin: '0 0 20 10',
                    labelAlign: 'left',
                    inputType: 'password',
                    allowBlank: false,
                    blankText: me.snippets.validation.invalidValue,
                    vtype: 'passwordRepeat'
                }
            ]
        } );

        me.items = components;

        // Add own vtypes to validate password fields
        Ext.apply( Ext.form.field.VTypes, {
            passwordChange: function( val, field ){
                if( field.up( 'crefoconfig-tabs-accounts-popup-password-extension' ).isVisible() === false ) {
                    return true;
                }
                var success = true;
                if( val === undefined || val === '' ) success = false;
                if( val.length < 6 ) success = false;
                return success;
            },
            passwordChangeText: this.snippets.validation.invalidValue,
            passwordRepeat: function( val, field ){
                if( field.up( 'crefoconfig-tabs-accounts-popup-password-extension' ).isVisible() === false ) {
                    return true;
                }
                var originalField = field.up( 'window' ).down( '[name=newindividualpassword]' );
                var success = true;
                if( val != originalField.getValue() ) success = false;
                return success;
            },
            passwordRepeatText: this.snippets.validation.invalidValue
        } );
        me.callParent( arguments );
    },
    createDescriptionContainer: function( html, size ){
        return Ext.create( 'Ext.container.Container', {
            unstyled: true,
            columnWidth: size,
            style: 'color: #999; font-style: italic; margin: 0 0 15px 0;',
            html: html
        } );
    }
} );
//{/block}
