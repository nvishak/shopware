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
//{block name="backend/crefo_orders/view/batch/form"}
Ext.define('Shopware.apps.CrefoOrders.view.batch.Form', {
    extend:'Ext.form.Panel',
    alias:'widget.crefo-batch-settings-panel',
    cls: Ext.baseCSSPrefix + 'crefo-batch-settings-panel',
    autoScroll: true,
    layout: {
        align: 'stretch',
        type: 'vbox'
    },
    bodyPadding: 10,
    snippets:{
        settings:{
            title:'{s name="crefoorders/view/batch/form/settings/title"}Einstellungen zur Generierung{/s}',
            inkassoLabel:'{s name="crefoorders/view/batch/form/settings/label"}Inkasso{/s}',
            inkassoValues:{
                create: '{s name="crefoorders/view/batch/form/settings/values/create"}Inkasso-Vorschlag erzeugen{/s}',
                send: '{s name="crefoorders/view/batch/form/settings/values/send"}Inkasso-Auftrag senden{/s}',
                delete: '{s name="crefoorders/view/batch/form/settings/values/delete"}Inkasso-Vorschlag löschen{/s}'
            },
            generate: '{s name="crefoorders/view/batch/form/settings/btn/process"}Änderungen durchführen{/s}'
        },
        gridTitle: '{s name="crefoorders/view/batch/form/grid/title"}Ausgewählte Bestellungen{/s}'
    },

    initComponent:function () {
        var me = this;

        me.registerEvents();

        me.items = [
            me.createSettingsContainer(),
            me.createOrderGrid()
        ];
        me.addCls('layout-expert');
        me.callParent(arguments);
    },

    registerEvents: function() {
        this.addEvents(

            /**
             * Event will be fired when the user clicks the button which is
             * displayed within the form field set.
             *
             * @event
             * @param [Ext.form.Panel] - This component
             */
            'processChanges'
        );
    },

    createSettingsContainer: function() {
        var me = this;

        return Ext.create('Ext.form.FieldSet', {
            title: me.snippets.settings.title,
            layout: 'anchor',
            flex: 1,
            defaults: {
                labelWidth: 150,
                xtype: 'combobox',
                anchor: '100%'
            },
            items: [
                {
                    name: 'inkassoSettings',
                    id: 'inkassoSettings',
                    triggerAction: 'all',
                    fieldLabel: me.snippets.settings.inkassoLabel,
                    store: new Ext.data.SimpleStore({
                        fields:['value', 'description'],
                        data: [
                            [1, me.snippets.settings.inkassoValues.create],
                            [2, me.snippets.settings.inkassoValues.send],
                            [3, me.snippets.settings.inkassoValues.delete]
                        ]
                    }),
                    editable: false,
                    displayField: 'description',
                    valueField: 'value'
                },
                {
                    xtype: 'button',
                    margin: '15 0',
                    cls: 'primary',
                    text: me.snippets.settings.generate,
                    handler: function() {
                        me.fireEvent('processChanges', me)
                    }
                }
            ]
        });
    },
    createOrderGrid: function() {
        var me = this;

        var store = Ext.create('Ext.data.Store', {
            model: 'Shopware.apps.CrefoOrders.model.ListOrders',
            data: me.records
        });

        return Ext.create('Shopware.apps.CrefoOrders.view.batch.List', {
            flex: 1,
            title: me.snippets.gridTitle,
            store: store
        });
    }

});
//{/block}
