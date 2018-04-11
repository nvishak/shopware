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
//{block name="backend/crefo_configuration/controller/main"}
Ext.define('Shopware.apps.CrefoConfiguration.controller.Main', {
    extend: 'Enlight.app.Controller',
    mainWindow: null,
    snippets: {
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}',
        generalError: '{s name=crefo/validation/generalError}Allgemeiner Fehler{/s}',
        main: 'Main',
        validation: {
            error: '{s name="crefo/validation/checkFields"}Es ist ein Fehler aufgetreten (Plausibilitätsprüfung).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}',
            fault: {
                title: '{s name="crefo/validation/fault/title"}Es ist ein Fehler aufgetreten (validationfault).{/s}',
                contactText: '{s name="crefo/validation/fault/contactText"}Bitte kontaktieren Sie den Creditreform-Support.{/s}'
            }
        }
    },
    init: function() {
        var me = this;
        CrefoUtil.loadSnippets(me.snippets);
        me.subApplication.accountStore = me.getStore('Account');
        me.subApplication.accountStore.load({
            callback: function() {
                me.subApplication.generalStore = me.getStore('General');
                me.subApplication.generalStore.load({
                    callback: function() {
                        me.mainWindow = me.getView('main.Window').create({
                            generalStore: me.subApplication.generalStore,
                            accountStore: me.subApplication.accountStore
                        });
                    }
                });
            }
        });
        me.callParent(arguments);
    }
});
//{/block}
