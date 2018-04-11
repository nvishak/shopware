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
//{block name="backend/crefo_configuration/controller/private_person_config"}
Ext.define('Shopware.apps.CrefoConfiguration.controller.PrivatePersonConfig', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}'
    },
    init: function() {
        var me = this;
        me.mainController = me.getController('Main');
        me.control({
            'crefoconfig-tabs-report-private-person-panel': {
                saveReportPrivatePerson: me.onSaveReportPrivatePerson
            },
            'crefoconfig-tabs-report-private-person-header-container': {
                performLogonReportPrivatePerson: me.onPerformLogonReportPrivatePerson
            },
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            },
            'crefo-config-tabs-report-private-person-basket-area-row': {
                addBasketAreaRow: me.onAddBasketAreaRow,
                addFirstBasketAreaRow: me.onAddFirstBasketAreaRow,
                deleteBasketAreaRow: me.onDeleteBasketAreaRow
            }
        });
        me.callParent(arguments);
    },
    onAddBasketAreaRow: function (rowIndex) {
        var basketAreaContainer = Ext.getCmp('reportPrivatePersonBasketAreaContainer');
        basketAreaContainer.addNewBasketAreaRow(rowIndex + 1, true);
    },
    onAddFirstBasketAreaRow: function () {
        var basketAreaContainer = Ext.getCmp('reportPrivatePersonBasketAreaContainer');
        basketAreaContainer.addNewBasketAreaRow(0, true);
    },
    onDeleteBasketAreaRow: function (rowIndex) {
        var basketAreaContainer = Ext.getCmp('reportPrivatePersonBasketAreaContainer');
        basketAreaContainer.removeBasketAreaRow(rowIndex);
    },
    /**
     * Is fired, when the tab is changed
     * Automatically selects the countries/shops and sets the surcharge
     * @param tabsPanel Contains the tabs-panel
     * @param newTab Contains the new tab, which was clicked now
     * @param oldTab Contains the old tab, which was opened before the new tab
     * @param formPanel Contains the form-panel of the tab
     */
    onChangeTab: function(tabsPanel, newTab, oldTab, formPanel) {
        var me = this,
            newTabPanel = newTab.down('panel[id=ReportPrivatePersonPanel]');
        if (!Ext.isEmpty(newTabPanel)) {
            try {
                Ext.getCmp('crefoConfig-reportPrivatePerson-saveBtn').setDisabled(true);
                newTabPanel.up('window').setLoading(true);
                newTabPanel.reportPrivatePersonStore.load({
                    callback: function() {
                        var recordReportStore = this.first();
                        if (newTabPanel.tabSeen) {
                            var userAccountCbx = Ext.getCmp('privatePersonUserAccountId'),
                                userAccountValue = Ext.isEmpty(recordReportStore) ? null : recordReportStore.get('userAccountId');
                            userAccountCbx.suspendEvents(false);
                            userAccountCbx.setValue(userAccountValue);
                            userAccountCbx.resumeEvents();
                        } else {
                            newTabPanel.tabSeen = true;
                        }
                        var userAccountId = null;
                        if (!Ext.isEmpty(recordReportStore) && Ext.isDefined(recordReportStore.get('userAccountId'))) {
                            userAccountId = recordReportStore.get('userAccountId');
                        }
                        me.onPerformLogonReportPrivatePerson(userAccountId, true);
                    }
                });
            } catch (e) {
                newTabPanel.up('window').setLoading(false);
            }
        }
    },
    onSaveReportPrivatePerson: function() {
        var me = this,
            panel = Ext.getCmp('ReportPrivatePersonPanel'),
            windowConfig = Ext.getCmp('CrefoConfigurationWindow');

        me.changeAllowedBlankFields(panel);
        var values = panel.getForm().getValues();
        if (values.privatePersonUserAccountId !== '' && !panel.getForm().isValid()) {
            CrefoUtil.showStickyMessage('', CrefoUtil.snippets.validation.error);
            return;
        }

        if (values.privatePersonUserAccountId === '') {
            panel.getForm().reset();
            values = panel.getForm().getValues();
        }

        windowConfig.setLoading(true);
        Ext.Ajax.request({
            url: '{url controller=CrefoConfiguration action=saveReportPrivatePerson}',
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
                    panel.reportPrivatePersonStore.load({
                        callback: function() {
                            windowConfig.setLoading(false);
                            CrefoUtil.showStickyMessage('', me.snippets.success);
                        }
                    });
                } catch (e) {
                    windowConfig.setLoading(false);
                }
            },
            failure: function() {
                CrefoUtil.handleFailure(windowConfig, true);
            }
        });
    },
    /**
     *
     * @param newAccount
     * @param useDBValues
     */
    onPerformLogonReportPrivatePerson: function(newAccount, useDBValues) {
        var me = this,
            panel = Ext.getCmp('ReportPrivatePersonPanel'),
            windowConfig = Ext.getCmp('CrefoConfigurationWindow'),
            input = Object.create(Object.prototype);
        input.useraccountId = newAccount;
        windowConfig.setLoading(true);
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoConfiguration action=logonReportPrivatePerson}',
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
                        CrefoUtil.removeBodyContainer(panel, 'reportPrivatePersonContainer');
                        Ext.getCmp('privatePersonUserAccountId').validate();
                    } else {
                        me.processLogonResult(panel, result.data, useDBValues);
                    }
                    Ext.getCmp('crefoConfig-reportPrivatePerson-saveBtn').setDisabled(false);
                } catch (e) {
                    Ext.getCmp('crefoConfig-reportPrivatePerson-saveBtn').setDisabled(true);
                    CrefoUtil.removeBodyContainer(panel, 'reportPrivatePersonContainer');
                    CrefoUtil.showStickyMessageFromError(e);
                } finally {
                    windowConfig.setLoading(false);
                    windowConfig.doLayout();
                }
            },
            failure: function(response) {
                Ext.getCmp('crefoConfig-reportPrivatePerson-saveBtn').setDisabled(true);
                CrefoUtil.removeBodyContainer(panel, 'reportPrivatePersonContainer');
                Ext.getCmp('privatePersonUserAccountId').validate();
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
                    windowConfig.setLoading(false);
                    windowConfig.doLayout();
                }
            }
        });
    },
    processLogonResult: function(panel, data, useDBValues) {
        var me = this,
            privatePersonConfigStore = panel.reportPrivatePersonStore.first(),
            productCWSTemp = Ext.create('Shopware.apps.CrefoConfiguration.store.reportprivateperson.ProductCws');
        panel.config.hasBonimaProducts = data.products.length !== 0;
        productCWSTemp.loadData(data.products);
        if (useDBValues && !Ext.isEmpty(privatePersonConfigStore) && privatePersonConfigStore.getProducts().getCount() > 0) {
            var productsStore = privatePersonConfigStore.getProducts();
            productsStore.each(function (record) {
                var productKeyId = record.get('productKeyWS');
                if (!Ext.isEmpty(productKeyId)) {
                    var keyWS = panel.allowedBonimaProducts.findRecord('id', productKeyId).get('keyWS');
                    if (Ext.isEmpty(productCWSTemp.findRecord('keyWS', keyWS))) {
                        record.set('isProductAvailable', false);
                        data.products.push({ 'keyWS': keyWS, 'nameWS': record.get('productNameWS'), 'available': false, 'country': 'DE' });
                    } else {
                        record.set('isProductAvailable', true);
                    }
                }
            });
        }
        productCWSTemp = null;
        panel.productCwsStore.loadData(data.products, false);
        panel.legitimateInterestStore.loadData(data.legitimateInterests, false);
        CrefoUtil.removeBodyContainer(panel, 'reportPrivatePersonContainer');
        CrefoUtil.addBodyContainer(panel, 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Container', {
            parentPanel: panel,
            useDefaults: !useDBValues
        });
        privatePersonConfigStore = panel.reportPrivatePersonStore.first();
        if (!Ext.isEmpty(privatePersonConfigStore) && !Ext.isEmpty(privatePersonConfigStore.get('userAccountId'))) {
            CrefoUtil.isFormValid(panel);
            me.validateProductsComboBoxes(panel);
        } else {
            Ext.getCmp('privatePersonUserAccountId').validate();
        }
    },
    changeAllowedBlankFields: function (panel) {
        panel.getForm().getFields().each(function(f) {
            if (f.name === 'basketThresholdMin') {
                f.allowBlank = false;
                f.nextNode('container[name=privatePersonScoreArea]').fireEvent('validateScoreArea');
            }
            if (f.name === 'productCrefo') {
                f.allowBlank = false;
            }
        });
    },
    validateProductsComboBoxes: function (panel) {
        panel.getForm().getFields().each(function(f) {
            if (!panel.config.hasBonimaProducts && f.name === 'productCrefo' && Ext.isEmpty(f.rawValue)) {
                f.markInvalid(panel.snippets.error.noProducts);
            }
        });
    }
})
;
//{/block}
