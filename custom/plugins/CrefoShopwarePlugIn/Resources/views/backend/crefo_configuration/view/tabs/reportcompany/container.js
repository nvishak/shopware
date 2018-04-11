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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Container',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-reportcompany-container',
        region: 'center',
        autoScroll: true,
        name: 'reportCompanyContainer',
        id: 'reportCompanyContainer',
        border: 0,
        layout: 'anchor',
        ui: 'shopware-ui',
        defaults: {
            labelWidth: 210,
            labelStyle: 'font-weight: 700;',
            anchor: '100%'
        },
        hidden: false,
        useDefaults: false,
        minWidth: 155,
        snippets: {
            labels: {
                checkboxes: '{s name="crefo/config/view/tabs/reportcompany/panel/labels/checkboxes_countries"}Bonitätsprüfung für folgende Länder durchführen{/s}',
                countries: {
                    de: '{s name="crefo/config/view/tabs/reports/countries/germany"}Deutschland{/s}',
                    at: '{s name="crefo/config/view/tabs/reports/countries/austria"}Österreich{/s}',
                    lu: '{s name="crefo/config/view/tabs/reports/countries/luxembourg"}Luxemburg{/s}'
                },
                reportLanguage: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/report_language"}Auskunftssprache{/s}',
                legitimateInterest: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/legetimate_interest"}Berechtigtes Interesse{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        listeners: {
            afterrender: function () {
                this.useDefaults = true;
            }
        },
        initComponent: function() {
            var me = this;
            me.items = me.getItems();
            me.callParent(arguments);
        },
        getItems: function() {
            var me = this;
            return [
                {
                    fieldLabel: me.snippets.labels.legitimateInterest,
                    emptyText: me.snippets.labels.legitimateInterest,
                    xtype: 'combo',
                    flex: 1,
                    id: 'legitimateKey',
                    name: 'legitimateKey',
                    width: '100%',
                    labelWidth: '30%',
                    padding: '20 5 0 5',
                    store: me.parentPanel.legitimateInterestStore,
                    queryMode: 'local',
                    forceSelection: true,
                    blankText: me.snippets.validation.invalidValue,
                    allowBlank: false,
                    editable: false,
                    displayField: 'textWS',
                    valueField: 'keyWS',
                    validateOnBlur: false,
                    validateOnChange: false,
                    listeners: {
                        'afterrender': function () {
                            if (me.useDefaults) {
                                this.setValue(me.parentPanel.config.legitimateKeyPrivatePerson);
                            } else if (!Ext.isEmpty(me.parentPanel.legitimateInterestStore.first()) &&
                        !Ext.isEmpty(me.parentPanel.reportCompanyStore.first()) &&
                        !Ext.isEmpty(me.parentPanel.reportCompanyStore.first().get('legitimateKey')) &&
                        !Ext.isEmpty(me.parentPanel.legitimateInterestStore.findRecord('keyWS', me.parentPanel.reportCompanyStore.first().get('legitimateKey')))
                            ) {
                                this.setValue(me.parentPanel.reportCompanyStore.first().get('legitimateKey'));
                            }
                        }
                    }
                },
                {
                    fieldLabel: me.snippets.labels.reportLanguage,
                    emptyText: me.snippets.labels.reportLanguage,
                    xtype: 'combo',
                    flex: 1,
                    id: 'reportLanguageKey',
                    name: 'reportLanguageKey',
                    width: '100%',
                    labelWidth: '30%',
                    padding: '5 5 0 5',
                    store: me.parentPanel.reportLanguageStore,
                    queryMode: 'local',
                    forceSelection: true,
                    blankText: me.snippets.validation.invalidValue,
                    allowBlank: false,
                    editable: false,
                    displayField: 'textWS',
                    valueField: 'keyWS',
                    validateOnBlur: false,
                    validateOnChange: false,
                    listeners: {
                        'afterrender': function () {
                            if (me.useDefaults) {
                                this.setValue(me.parentPanel.config.reportLanguage);
                            } else if (!Ext.isEmpty(me.parentPanel.reportLanguageStore.first()) &&
                        !Ext.isEmpty(me.parentPanel.reportCompanyStore.first()) &&
                        !Ext.isEmpty(me.parentPanel.reportCompanyStore.first().get('reportLanguageKey')) &&
                        !Ext.isEmpty(me.parentPanel.reportLanguageStore.findRecord('keyWS', me.parentPanel.reportCompanyStore.first().get('reportLanguageKey')))
                            ) {
                                this.setValue(me.parentPanel.reportCompanyStore.first().get('reportLanguageKey'));
                            }
                        }
                    }
                },
                {
                    xtype: 'checkboxgroup',
                    id: 'companyCountriesCbxConfig',
                    name: 'companyCountriesCbxConfig',
                    fieldLabel: me.snippets.labels.checkboxes,
                    labelWidth: '30%',
                    padding: '5 5 0 5',
                    margin: '5 5 5 5',
                    vertical: true,
                    columns: 1,
                    flex: 1,
                    items: [
                        {
                            boxLabel: me.snippets.labels.countries.de,
                            name: 'companyConfigCheckbox_' + me.parentPanel.countriesIds.DE,
                            id: 'companyConfigCheckbox_' + me.parentPanel.countriesIds.DE,
                            inputValue: true,
                            listeners: {
                                afterrender: function () {
                                    if (!me.useDefaults) {
                                        this.setValue(me.parentPanel.countriesConfigured[me.parentPanel.countriesIds.DE]);
                                    }
                                },
                                change: function (cbx, newValue) {
                                    var tab = Ext.getCmp('crefo-company-config-tab-de');
                                    if (!Ext.isEmpty(tab)) {
                                        newValue === true ? tab.enable() : tab.disable();
                                    }
                                }
                            }
                        }, {
                            boxLabel: me.snippets.labels.countries.at,
                            name: 'companyConfigCheckbox_' + me.parentPanel.countriesIds.AT,
                            id: 'companyConfigCheckbox_' + me.parentPanel.countriesIds.AT,
                            inputValue: true,
                            listeners: {
                                afterrender: function () {
                                    if (!me.useDefaults) {
                                        this.setValue(me.parentPanel.countriesConfigured[me.parentPanel.countriesIds.AT]);
                                    }
                                },
                                change: function (cbx, newValue) {
                                    var tab = Ext.getCmp('crefo-company-config-tab-at');
                                    if (!Ext.isEmpty(tab)) {
                                        newValue === true ? tab.enable() : tab.disable();
                                    }
                                }
                            }
                        }, {
                            boxLabel: me.snippets.labels.countries.lu,
                            name: 'companyConfigCheckbox_' + me.parentPanel.countriesIds.LU,
                            id: 'companyConfigCheckbox_' + me.parentPanel.countriesIds.LU,
                            inputValue: true,
                            listeners: {
                                afterrender: function () {
                                    if (!me.useDefaults) {
                                        this.setValue(me.parentPanel.countriesConfigured[me.parentPanel.countriesIds.LU]);
                                    }
                                },
                                change: function (cbx, newValue) {
                                    var tab = Ext.getCmp('crefo-company-config-tab-lu');
                                    if (!Ext.isEmpty(tab)) {
                                        newValue === true ? tab.enable() : tab.disable();
                                    }
                                }
                            }
                        }
                    ]
                },
                me.createTabPanel()
            ];
        },
        createTabPanel: function() {
            var me = this;

            me.tabPanel = Ext.create('Ext.tab.Panel', {
                autoShow: true,
                id: 'companyConfigCountriesTabPanel',
                name: 'companyConfigCountriesTabPanel',
                activeTab: 0,
                border: 0,
                layout: 'fit',
                plain: true,
                region: 'center',
                minTabWidth: 80,
                frame: false,
                frameHeader: false,
                deferredRender: false,
                width: '100%',
                margin: '0 5 0 5',
                bodyPadding: '1 1 5 5',
                bodyBorder: true,
                items: [
                    {
                        xtype: 'container',
                        id: 'crefo-company-config-tab-de',
                        name: 'crefo-company-config-tab-de',
                        autoRender: true,
                        title: me.snippets.labels.countries.de,
                        listeners: {
                            beforerender: function () {
                                this.tab.setDisabled(true);
                            },
                            enable: function (tabPanel) {
                                tabPanel.add(Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.TabContainer', {
                                    countryId: me.parentPanel.countriesIds.DE,
                                    parentPanel: me.parentPanel,
                                    useDefaults: me.useDefaults
                                }));

                                var tab = Ext.getCmp('companyConfigCountriesTabPanel').getTabBar().items.items[0];
                                tab.setDisabled(false);
                            },
                            disable: function (tab) {
                                Ext.suspendLayouts();
                                tab.removeAll(true);
                                tab.doLayout();
                                Ext.resumeLayouts(true);
                            }
                        }
                    }, {
                        xtype: 'container',
                        id: 'crefo-company-config-tab-at',
                        name: 'crefo-company-config-tab-at',
                        autoRender: true,
                        title: me.snippets.labels.countries.at,
                        listeners: {
                            beforerender: function () {
                                this.tab.setDisabled(true);
                            },
                            enable: function (tabPanel) {
                                tabPanel.add(Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.TabContainer', {
                                    countryId: me.parentPanel.countriesIds.AT,
                                    parentPanel: me.parentPanel,
                                    useDefaults: me.useDefaults
                                }));
                            },
                            disable: function (tab) {
                                Ext.suspendLayouts();
                                tab.removeAll(true);
                                tab.doLayout();
                                Ext.resumeLayouts(true);
                            }
                        }
                    }, {
                        xtype: 'container',
                        id: 'crefo-company-config-tab-lu',
                        name: 'crefo-company-config-tab-lu',
                        autoRender: true,
                        title: me.snippets.labels.countries.lu,
                        listeners: {
                            beforerender: function () {
                                this.tab.setDisabled(true);
                            },
                            enable: function (tabPanel) {
                                tabPanel.add(Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.TabContainer', {
                                    countryId: me.parentPanel.countriesIds.LU,
                                    parentPanel: me.parentPanel,
                                    useDefaults: me.useDefaults
                                }));
                            },
                            disable: function (tab) {
                                Ext.suspendLayouts();
                                tab.removeAll(true);
                                tab.doLayout();
                                Ext.resumeLayouts(true);
                            }
                        }
                    }
                ]

            });
            return me.tabPanel;
        }
    });
//{/block}
