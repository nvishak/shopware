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
//{block name="backend/crefo_configuration/view/tabs/inkasso/container_header"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.inkasso.ContainerHeader',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-inkasso-container-header',
        region: 'center',
        autoScroll: true,
        name: 'inkassoContainerHeader',
        id: 'inkassoContainerHeader',
        border: 0,
        layout: 'anchor',
        ui: 'shopware-ui',
        defaults: {
            labelWidth: 210,
            labelStyle: 'font-weight: 700;',
            anchor: '100%'
        },
        hidden: false,
        minWidth: 155,
        snippets: {
            labels: {
                account: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/useraccounts"}Mitgliedskennung{/s}'
            },
            errors: {
                noservice: '{s name="crefoconfig/view/tabs/inkasso/panel/noInkassoService"}ACHTUNG! Die Mitgliedskennung ist für die Abgabe von Inkasso-' +
                'aufträgen nicht berechtigt.<br/>Dies ist eine Voraussetzung für die Nutzung der Funktionalität Inkassoauftrag in der Bestellübersicht.{/s}'
            }
        },
        initComponent: function() {
            var me = this;
            me.items = me.getItems();
            Ext.apply(Ext.form.field.VTypes, {
                userAccountInkassoVtype: function(val) {
                    if (Ext.isEmpty(val)) {
                        return true;
                    }
                    return !me.parentPanel.config.noService;
                },
                userAccountInkassoVtypeText: this.snippets.errors.noservice
            });
            me.callParent(arguments);
        },
        getItems: function() {
            var me = this;
            return [
                {
                    xtype: 'container',
                    layout: 'vbox',
                    flex: 1,
                    align: 'center',
                    pack: 'start',
                    border: 0,
                    items: [
                        {
                            fieldLabel: me.snippets.labels.account,
                            xtype: 'combo',
                            id: 'inkasso_user_account',
                            name: 'collectionUserAccountId',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            editable: false,
                            emptyText: me.snippets.labels.account,
                            store: me.parentPanel.accountStore,
                            queryMode: 'local',
                            displayField: 'useraccount',
                            valueField: 'id',
                            vtype: 'userAccountInkassoVtype',
                            listeners: {
                                'afterrender': function() {
                                    var record = me.parentPanel.inkassoStore.first();
                                    if (!Ext.isEmpty(record) && !Ext.isEmpty(record.UserAccount)) {
                                        this.suspendEvents(false);
                                        this.setValue(record.UserAccount.get('id'));
                                        this.resumeEvents();
                                    }
                                },
                                'change': function(combo, newValue) {
                                    me.fireEvent('performLogonInkasso', newValue, false);
                                },
                                /**
                               * Prevents "&nbsp;" text from being displayed on selection
                               */
                                'select': function(combo) {
                                    if (Ext.isEmpty(combo.getValue()) || combo.getRawValue() === '&nbsp;') {
                                        combo.setValue(null);
                                    }
                                }
                            }
                        },
                        {
                            xtype: 'container',
                            flex: 1,
                            width: '100%',
                            padding: '10 5 0 5',
                            style: 'color: #999; font-style: italic; margin: 0 0 15px 0;',
                            html: ''
                        }
                    ]
                }
            ];
        }
    });
//{/block}
