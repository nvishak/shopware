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
//{block name="backend/crefo_configuration/controller/inkasso_config"}
Ext.define('Shopware.apps.CrefoConfiguration.controller.InkassoConfig', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        errors: {
            noProducts: '{s name="crefoconfig/controller/crefo_configuration/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,' +
            'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
            hasRedProducts: '{s name="crefoconfig/controller/crefo_configuration/hasRedProducts"}ACHTUNG! Die Mitgliedskennung ' +
            'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung ' +
            'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
        },
        validation: {
            errorNoValidMessage: '{s name="crefo/validation/checkFields"}An error has occurred (plausibility check).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}',
            detailedError: '{s name="crefo/validation/detailedError"}Es gibt detaillierte Fehlermeldungen.{/s}'
        },
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}'
    },
    inkassoDefaultValues: {
        orderType: 'CCORTY-1',
        turnoverType: 'CCTOTY-1',
        receivableReason: 'CCRCRS-11'
    },
    init: function() {
        var me = this;
        me.mainController = me.getController('Main');
        me.control({
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            },
            'crefoconfig-tabs-inkasso-container-header': {
                performLogonInkasso: me.onPerformLogonInkasso
            },
            'crefoconfig-tabs-inkasso-panel': {
                saveInkasso: me.onSaveInkasso
            }
        });
        me.callParent(arguments);
    },
    onChangeTab: function(tabsPanel, newTab) {
        var me = this,
            newTabPanel = newTab.items.items[ 0 ];
        if (/collectionConfigPanel/ig.test(newTabPanel.id)) {
            try {
                newTabPanel.up('window').down('button[name=crefoConfig-inkasso-saveBtn]').setDisabled(true);
                newTabPanel.up('window').setLoading(true);
                newTabPanel.inkassoStore.load({
                    callback: function() {
                        var recordIS = this.first();
                        if (newTabPanel.tabSeen) {
                            var userAccountCbx = Ext.getCmp('inkasso_user_account'),
                                userAccountValue = Ext.isEmpty(recordIS) || Ext.isEmpty(recordIS.UserAccount) ? null : recordIS.UserAccount.get('useraccount');
                            userAccountCbx.suspendEvents(false);
                            userAccountCbx.setValue(userAccountValue);
                            userAccountCbx.resumeEvents();
                        } else {
                            newTabPanel.tabSeen = true;
                        }
                        var useraccountId = null;
                        if (!Ext.isEmpty(recordIS) && !Ext.isEmpty(recordIS.UserAccount) && !Ext.isEmpty(recordIS.UserAccount.get('useraccount'))) {
                            useraccountId = recordIS.UserAccount.get('id');
                        }
                        me.onPerformLogonInkasso(useraccountId, true);
                    }
                });
            } catch (e) {
                newTabPanel.up('window').setLoading(false);
            }
        }
    },
    onSaveInkasso: function() {
        var me = this,
            panel = Ext.getCmp('collectionConfigPanel'),
            window = Ext.getCmp('CrefoConfigurationWindow');
        var values = panel.getForm().getValues();
        if (values.useraccountId !== '' && !CrefoUtil.isFormValid(panel)) {
            return;
        }
        window.setLoading(true);
        Ext.Ajax.request({
            url: '{url controller=CrefoConfiguration action=saveInkassoConfig}',
            method: 'POST',
            jsonData: values,
            success: function(response) {
                try {
                    if (!CrefoUtil.isJson(response.responseText)) {
                        throw new Error('no response');
                    }
                    var result = Ext.JSON.decode(response.responseText);
                    if (!result.success) {
                        throw new Error('not successful');
                    }
                    var records = [];
                    panel.collectionOrderTypeStore.each(function (record) {
                        records.push(record.data);
                    });
                    panel.collectionTurnoverTypeStore.each(function (record) {
                        records.push(record.data);
                    });
                    panel.collectionReceivableReasonsStore.each(function (record) {
                        records.push(record.data);
                    });

                    Ext.Ajax.request({
                        url: '{url controller=CrefoConfiguration action=saveInkassoWSValues}',
                        method: 'POST',
                        jsonData: records,
                        success: function() {
                            var creditors = [];
                            panel.inkassoCreditorsStore.each(function (record) {
                                if (record.get('id') !== 0) {
                                    creditors.push(record.data);
                                }
                            });
                            Ext.Ajax.request({
                                url: '{url controller=CrefoConfiguration action=saveInkassoCreditors}',
                                method: 'POST',
                                jsonData: creditors,
                                success: function() {
                                    window.setLoading(false);
                                    CrefoUtil.showStickyMessage('', me.snippets.success);
                                },
                                failure: function() {
                                    CrefoUtil.handleFailure(window, true);
                                }
                            });
                        },
                        failure: function() {
                            CrefoUtil.handleFailure(window, true);
                        }
                    });
                } catch (e) {
                    window.setLoading(false);
                }
            },
            failure: function() {
                CrefoUtil.handleFailure(window, true);
            }
        });
    },
    onPerformLogonInkasso: function(newAccount, useDBValues) {
        var me = this,
            panel = Ext.getCmp('collectionConfigPanel'),
            input = Object.create(Object.prototype),
            window = Ext.getCmp('CrefoConfigurationWindow');
        input.useraccountId = newAccount;
        panel.config.noService = false;
        window.setLoading(true);
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoConfiguration action=logonInkasso}',
            method: 'POST',
            params: input,
            success: function(response) {
                try {
                    if (!CrefoUtil.isJson(response.responseText)) {
                        throw new Error('no response');
                    }
                    var result = Ext.JSON.decode(response.responseText);
                    if (!result.success && result.errors !== 'null-account') {
                        throw result.errors;
                    }
                    if (result.errors === 'null-account') {
                        CrefoUtil.removeBodyContainer(panel, 'inkassoContainer');
                        panel.collectionOrderTypeStore.loadData([], false);
                        panel.collectionTurnoverTypeStore.loadData([], false);
                        panel.collectionReceivableReasonsStore.loadData([], false);
                        panel.inkassoCreditorsStore.loadData([], false);
                    } else {
                        me.processLogonInkasso(panel, result.data, useDBValues);
                    }
                    window.down('button[name=crefoConfig-inkasso-saveBtn]').setDisabled(false);
                } catch (e) {
                    window.down('button[name=crefoConfig-inkasso-saveBtn]').setDisabled(true);
                    CrefoUtil.removeBodyContainer(panel, 'inkassoContainer');
                    if (Ext.isDefined(e.errorCode) && e.title === 'no-service' && parseInt(e.errorCode) === 999) {
                        panel.config.noService = true;
                    } else {
                        CrefoUtil.showStickyMessageFromError(e);
                    }
                } finally {
                    Ext.getCmp('inkasso_user_account').validate();
                    window.setLoading(false);
                    window.doLayout();
                }
            },
            failure: function(response) {
                window.down('button[name=crefoConfig-inkasso-saveBtn]').setDisabled(true);
                CrefoUtil.removeBodyContainer(panel, 'inkassoContainer');
                Ext.getCmp('inkasso_user_account').validate();
                var result = null,
                    responseText = response.responseText.substr(0, response.responseText.lastIndexOf('}') + 1);
                try {
                    if (!CrefoUtil.isJson(responseText)) {
                        result = Object.create(Object.prototype);
                        result.errors = Object.create(Object.prototype);
                        result.errors.errorCode = true;
                        throw new Error('no response');
                    }
                    result = Ext.JSON.decode(responseText);
                    if (!result.success) {
                        throw result.errors;
                    }
                } catch (e) {
                    if (Ext.isEmpty(e.errorCode) && Ext.isObject(e)) {
                        var errors = [];
                        for (var i in e) {
                            if (e.hasOwnProperty(i)) {
                                errors.push(e[ i ]);
                            }
                        }
                        CrefoUtil.showStickyMessageFromError(errors[ 0 ]);
                    } else {
                        CrefoUtil.showStickyMessageFromError(result.errors);
                    }
                } finally {
                    window.setLoading(false);
                    window.doLayout();
                }
            }
        });
    },
    processLogonInkasso: function(panel, inkassoData, useDBValues) {
        if (!Ext.isEmpty(inkassoData) && !Ext.isEmpty(inkassoData.collectionOrderType) && Ext.isDefined(inkassoData.collectionOrderType[0].no_service)) {
            panel.collectionOrderTypeStore.loadData([], false);
        } else {
            panel.collectionOrderTypeStore.loadData(inkassoData.collectionOrderType, false);
        }

        if (!Ext.isEmpty(inkassoData) && !Ext.isEmpty(inkassoData.collectionTurnoverType) && Ext.isDefined(inkassoData.collectionTurnoverType[0].no_service)) {
            panel.collectionTurnoverTypeStore.loadData([], false);
        } else {
            panel.collectionTurnoverTypeStore.loadData(inkassoData.collectionTurnoverType, false);
        }
        if (!Ext.isEmpty(inkassoData) && !Ext.isEmpty(inkassoData.receivableReason) && Ext.isDefined(inkassoData.receivableReason[0].no_service)) {
            panel.collectionReceivableReasonsStore.loadData([], false);
        } else {
            panel.collectionReceivableReasonsStore.loadData(inkassoData.receivableReason, false);
        }
        panel.inkassoCreditorsStore.loadData(inkassoData.creditors, false);

        CrefoUtil.removeBodyContainer(panel, 'inkassoContainer');
        CrefoUtil.addBodyContainer(panel, 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Container', {
            parentPanel: panel,
            useDefaults: !useDBValues
        });
    }
});
//{/block}
