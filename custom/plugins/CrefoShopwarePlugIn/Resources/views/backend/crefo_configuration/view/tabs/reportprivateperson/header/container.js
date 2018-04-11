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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/header/container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.header.Container',
    {
        extend: 'Ext.container.Container',
        alias: 'widget.crefoconfig-tabs-report-private-person-header-container',
        name: 'reportPrivatePersonHeaderContainer',
        id: 'reportPrivatePersonHeaderContainer',
        region: 'center',
        border: 0,
        layout: 'anchor',
        ui: 'shopware-ui',
        defaults: {
            labelWidth: 210,
            labelStyle: 'font-weight: 700;',
            anchor: '100%'
        },
        autoShow: true,
        autoScroll: false,
        hidden: false,
        paddingRight: 0,
        minWidth: 155,
        snippets: {
            labels: {
                account: '{s name="crefoconfig/view/tabs/report_private_person/header/container/labels/userAccount"}Mitgliedskennung{/s}'
            },
            errors: {
                noProducts: '{s name="crefoconfig/reports/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,' +
                'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
                hasRedProducts: '{s name="crefoconfig/reports/hasRedProducts"}ACHTUNG! Die Mitgliedskennung ' +
                'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung ' +
                'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        initComponent: function() {
            var me = this;
            me.registerEvents();
            Ext.applyIf(me, {
                items: me.getItems()
            });

            Ext.apply(Ext.form.field.VTypes, {
                userAccountVType: function(val) {
                    var container = me.parentPanel.down('container[id=reportPrivatePersonContainer]'),
                        containerBasketArea = Ext.getCmp('reportPrivatePersonBasketAreaContainer');
                    if (Ext.isEmpty(val) || !Ext.isDefined(container) || !Ext.isDefined(containerBasketArea)) {
                        return true;
                    }
                    for (var i = 0; i < containerBasketArea.items.length; i++) {
                        var basketAreaRow = containerBasketArea.items.get(i);
                        var comboProducts = basketAreaRow.items.get(basketAreaRow.productsComboPosition);
                        if (Ext.isDefined(comboProducts.inputCell) && comboProducts.inputCell.child('input').hasCls('crefo-red-product')) {
                            this.userAccountVTypeText = me.snippets.errors.hasRedProducts;
                            return false;
                        }
                    }
                    if (!me.parentPanel.config.hasBonimaProducts) {
                        this.userAccountVTypeText = me.snippets.errors.noProducts;
                        return false;
                    }
                    return true;
                },
                userAccountVTypeText: me.snippets.errors.noProducts
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
                            id: 'privatePersonUserAccountId',
                            name: 'privatePersonUserAccountId',
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
                            vtype: 'userAccountVType',
                            listeners: {
                                'afterrender': function() {
                                    if (this.getValue() === '' || this.getRawValue() === '&nbsp;') {
                                        this.setValue(null);
                                    }
                                    var record = me.parentPanel.reportPrivatePersonStore.findRecord('id', 1);
                                    if (!Ext.isEmpty(record) && !Ext.isEmpty(record.get('userAccountId'))) {
                                        this.suspendEvents(false);
                                        var accountId = record.get('userAccountId');
                                        this.setValue(accountId);
                                        this.resumeEvents();
                                    }
                                },
                                'change': function(combo, newValue) {
                                    me.fireEvent('performLogonReportPrivatePerson', newValue, false);
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
                        }
                    ]
                }
            ];
        },
        registerEvents: function() {
            this.addEvents(
                /**
                 * Event will be fired when the the user account is changed
                 *
                 * @event performLogonReportPrivatePerson
                 * @param newValue
                 * @param [Ext.form.Panel] - This component
                 * @param boolean
                 */
                'performLogonReportPrivatePerson'
            );
        }
    });
//{/block}
