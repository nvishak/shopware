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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/container_header"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.ContainerHeader',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-reportcompany-container-header',
        region: 'center',
        autoScroll: true,
        name: 'reportCompanyContainerHeader',
        id: 'reportCompanyContainerHeader',
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
                account: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/useraccounts"}Mitgliedskennung{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            },
            errors: {
                noProducts: '{s name="crefoconfig/controller/crefo_configuration/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,' +
                'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
                hasRedProducts: '{s name="crefoconfig/controller/crefo_configuration/hasRedProducts"}ACHTUNG! Die Mitgliedskennung ' +
                'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung ' +
                'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            }
        },
        initComponent: function() {
            var me = this;
            me.items = me.getItems();
            Ext.apply(Ext.form.field.VTypes, {
                userAccountCompanyVtype: function(val) {
                    var container = Ext.getCmp('reportCompanyContainer');
                    if (Ext.isEmpty(val) || !Ext.isDefined(container)) {
                        return true;
                    }

                    if (me.panelHasRedProducts()) {
                        this.userAccountCompanyVtypeText = me.snippets.errors.hasRedProducts;
                        return false;
                    }

                    if (!me.parentPanel.config.hasCompanyProducts) {
                        this.userAccountCompanyVtypeText = me.snippets.errors.noProducts;
                        return false;
                    }
                    return true;
                },
                userAccountCompanyVtypeText: me.snippets.errors.hasRedProducts
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
                            id: 'useraccountId',
                            name: 'useraccountId',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            editable: false,
                            emptyText: me.snippets.labels.account,
                            store: me.parentPanel.accountStore,
                            queryMode: 'local',
                            displayField: 'useraccount',
                            value: '',
                            valueField: 'id',
                            vtype: 'userAccountCompanyVtype',
                            validateOnBlur: false,
                            validateOnChange: false,
                            listeners: {
                                'afterrender': function() {
                                    var record = me.parentPanel.reportCompanyStore.findRecord('id', 1);
                                    if (record !== null && record.get('useraccountId') !== undefined) {
                                        this.suspendEvents(false);
                                        this.setValue(record.get('useraccountId'));
                                        this.resumeEvents();
                                    }
                                },
                                'change': function(combo, newValue, oldValue, eOpt) {
                                    me.fireEvent('performLogonReport', newValue, false);
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
                        }, {
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
        },
        panelHasRedProducts: function() {
            var me = this,
                hasRedProducts = false,
                countryId = -1,
                sequence;
            if (Ext.isEmpty(me.parentPanel.reportCompanyStore.first().getCountries())) {
                return false;
            }
            me.parentPanel.getForm().getFields().each(function(f) {
                if (/productCrefo_[0-9]/ig.test(f.name)) {
                    if (countryId !== f.countryId) {
                        sequence = 0;
                        countryId = f.countryId;
                    }
                    var country = me.parentPanel.reportCompanyStore.first().getCountries().findRecord('country', countryId);
                    if (Ext.isDefined(f.inputCell)) {
                        hasRedProducts = hasRedProducts || f.inputCell.child('input').hasCls('crefo-red-product');
                    } else if (!Ext.isEmpty(country) && (me.parentPanel.config.hasCompanyProducts || me.parentPanel.countriesConfigured[countryId])) {
                        var product = country.getProducts().findRecord('sequence', sequence);
                        if (!Ext.isEmpty(product) && !product.get('available')) {
                            hasRedProducts = true;
                        }
                    }
                    sequence++;
                }
            });
            return hasRedProducts;
        }
    });
//{/block}
