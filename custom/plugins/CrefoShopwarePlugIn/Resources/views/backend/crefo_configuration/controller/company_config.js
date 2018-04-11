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
//{block name="backend/crefo_configuration/controller/company_config"}
Ext.define('Shopware.apps.CrefoConfiguration.controller.CompanyConfig', {
    extend: 'Ext.app.Controller',
    refs: [
        { ref: 'mainWindow', selector: 'crefoconfig-main-window' }
    ],
    snippets: {
        validation: {
            errorNoValidMessage: '{s name="crefo/validation/checkFields"}An error has occurred (plausibility check).{/s}',
            invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}',
            detailedError: '{s name="crefo/validation/detailedError"}Es gibt detaillierte Fehlermeldungen.{/s}'
        },
        success: '{s name="crefo/messages/success"}Aktion wurde erfolgreich durchgeführt{/s}'
    },
    init: function() {
        var me = this;
        me.mainController = me.getController('Main');
        me.control({
            'crefoconfig-main-window': {
                changeTab: me.onChangeTab
            },
            'crefoconfig-tabs-reportcompany-container-header': {
                performLogonReport: me.onPerformLogonReportCompany
            },
            'crefoconfig-tabs-reportcompany-panel': {
                saveReportCompanies: me.onSaveReportCompanies
            },
            'crefo-config-tabs-report-company-basket-area-row': {
                addBasketAreaRow: me.onAddBasketAreaRow,
                addFirstBasketAreaRow: me.onAddFirstBasketAreaRow,
                deleteBasketAreaRow: me.onDeleteBasketAreaRow
            }
        });
        me.callParent(arguments);
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
            newTabPanel = newTab.items.items[ 0 ];
        if (/reportCompanyPanel/ig.test(newTabPanel.id)) {
            try {
                newTabPanel.up('window').down('button[name=crefoConfig-reportCompany-saveBtn]').setDisabled(true);
                newTabPanel.up('window').setLoading(true);
                newTabPanel.reportCompanyStore.load({
                    callback: function() {
                        var recordRCS = this.first();
                        if (newTabPanel.tabSeen) {
                            var userAccountCbx = Ext.getCmp('useraccountId'),
                                userAccountValue = Ext.isEmpty(recordRCS) ? null : recordRCS.get('useraccountId');
                            userAccountCbx.suspendEvents(false);
                            userAccountCbx.setValue(userAccountValue);
                            userAccountCbx.resumeEvents();
                        } else {
                            newTabPanel.tabSeen = true;
                        }
                        var userAccountId = null;
                        if (!Ext.isEmpty(recordRCS) && !Ext.isEmpty(recordRCS.get('useraccountId'))) {
                            userAccountId = recordRCS.get('useraccountId');
                        }
                        me.onPerformLogonReportCompany(userAccountId, true);
                    }
                });
            } catch (e) {
                newTabPanel.up('window').setLoading(false);
            }
        } else {
            Ext.getCmp('reportCompanyPanel').initTabsMetadata();
        }
    },
    onAddBasketAreaRow: function (basketContainerId, rowIndex) {
        var basketAreaContainer = Ext.getCmp(basketContainerId);
        basketAreaContainer.addNewBasketAreaRow(rowIndex + 1, true);
    },
    onAddFirstBasketAreaRow: function (basketContainerId) {
        var basketAreaContainer = Ext.getCmp(basketContainerId);
        basketAreaContainer.addNewBasketAreaRow(0, true);
    },
    onDeleteBasketAreaRow: function (basketContainerId, rowIndex) {
        var basketAreaContainer = Ext.getCmp(basketContainerId);
        basketAreaContainer.removeBasketAreaRow(rowIndex);
    },
    onSaveReportCompanies: function(panel) {
        var me = this,
            window = Ext.getCmp('CrefoConfigurationWindow');

        var values = panel.getForm().getValues();
        me.changeAllowedBlankFields(panel);
        if (!Ext.isEmpty(values.useraccountId) && !me.validateOnSave(panel)) {
            CrefoUtil.showStickyMessage('', CrefoUtil.snippets.validation.error);
            Ext.getCmp('companyConfigCountriesTabPanel').setActiveTab(panel.getTabToBeActivated());
            return;
        }

        if (!Ext.isEmpty(values.useraccountId) &&
          !values.hasOwnProperty('tabSeen_' + panel.countriesIds.AT) &&
          !values.hasOwnProperty('tabSeen_' + panel.countriesIds.DE) &&
          !values.hasOwnProperty('tabSeen_' + panel.countriesIds.LU)
        ) {
            Ext.getCmp('companyCountriesCbxConfig').markInvalid(me.snippets.validation.invalidValue);
            CrefoUtil.showStickyMessage('', CrefoUtil.snippets.validation.error);
            return;
        }

        if (Ext.isEmpty(values.useraccountId)) {
            values = panel.getForm().getValues();
        }
        window.setLoading(true);
        Ext.Ajax.request({
            url: '{url controller=CrefoConfiguration action=saveReportCompanies}',
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
                    panel.reportCompanyStore.load({
                        callback: function() {
                            panel.updateCountriesStatus();
                            window.setLoading(false);
                            CrefoUtil.showStickyMessage('', me.snippets.success);
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
    /**
     *
     * @param newAccount
     * @param useDBValues boolean
     */
    onPerformLogonReportCompany: function(newAccount, useDBValues) {
        var me = this,
            panel = Ext.getCmp('reportCompanyPanel'),
            input = Object.create(Object.prototype),
            window = Ext.getCmp('CrefoConfigurationWindow');
        input.useraccountId = newAccount;
        window.setLoading(true);
        Ext.Ajax.request({
            url: '{url module=backend controller=CrefoConfiguration action=logonReportCompany}',
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
                        CrefoUtil.removeBodyContainer(panel, 'reportCompanyContainer');
                    } else {
                        me.processLogonReportCompanies(panel, result.data, useDBValues);
                    }
                    window.down('button[name=crefoConfig-reportCompany-saveBtn]').setDisabled(false);
                } catch (e) {
                    window.down('button[name=crefoConfig-reportCompany-saveBtn]').setDisabled(true);
                    CrefoUtil.removeBodyContainer(panel, 'reportCompanyContainer');
                    CrefoUtil.showStickyMessageFromError(e);
                } finally {
                    Ext.getCmp('useraccountId').validate();
                    window.setLoading(false);
                    window.doLayout();
                }
            },
            failure: function(response) {
                var result = null;
                var responseText = response.responseText.substr(0, response.responseText.lastIndexOf('}') + 1);
                window.down('button[name=crefoConfig-reportCompany-saveBtn]').setDisabled(true);
                CrefoUtil.removeBodyContainer(panel, 'reportCompanyContainer');
                Ext.getCmp('useraccountId').validate();
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
    processLogonReportCompanies: function(panel, data, useDBValues) {
        var me = this,
            reportCompanyStore = panel.reportCompanyStore.first(),
            productCWSTemp = Ext.create('Shopware.apps.CrefoConfiguration.store.reportcompany.Product');
        panel.config.hasCompanyProducts = data.products.length !== 0;
        productCWSTemp.loadData(data.products);
        if (useDBValues && !Ext.isEmpty(reportCompanyStore) && reportCompanyStore.getCountries().getCount() > 0) {
            var countriesStore = reportCompanyStore.getCountries();
            countriesStore.each(function (recordDBCountry) {
                var productsStore = recordDBCountry.getProducts();
                productsStore.each(function (recordDB) {
                    var keyWS = recordDB.get('productKeyWS');
                    if (!Ext.isEmpty(keyWS)) {
                        var recordCWSIndex = productCWSTemp.findBy(function (recordCws) {
                            if (recordCws.get('country') === recordDBCountry.get('country') && recordCws.get('keyWS') === keyWS) {
                                return true;
                            }
                        });
                        if (recordCWSIndex === -1) {
                            recordDB.set('available', false);
                            data.products.push({ 'keyWS': keyWS, 'nameWS': recordDB.get('productTextWS'), 'hasSolvencyIndex': recordDB.get('hasSolvencyIndex'), 'available': false, 'country': recordDBCountry.get('country') });
                        } else {
                            recordDB.set('available', true);
                        }
                    }
                });
            });
        }
        productCWSTemp = null;
        panel.reportLanguageStore.loadData(data.reportLanguages, false);
        panel.legitimateInterestStore.loadData(data.legitimateInterests, false);
        panel.productCwsStore.loadData(data.products, false);
        CrefoUtil.removeBodyContainer(panel, 'reportCompanyContainer');
        CrefoUtil.addBodyContainer(panel, 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Container', {
            parentPanel: panel,
            useDefaults: !useDBValues
        });
        reportCompanyStore = panel.reportCompanyStore.first();
        Ext.getCmp('legitimateKey').validate();
        Ext.getCmp('reportLanguageKey').validate();
        if (!Ext.isEmpty(reportCompanyStore) && !Ext.isEmpty(reportCompanyStore.get('useraccountId'))) {
            if (!me.validateProductsComboBoxes(panel)) {
                CrefoUtil.showStickyMessage('', CrefoUtil.snippets.validation.error);
            }
            Ext.getCmp('companyConfigCountriesTabPanel').setActiveTab(panel.getTabToBeActivated());
        }
    },
    changeAllowedBlankFields: function (panel) {
        panel.getForm().getFields().each(function(f) {
            if (/basketThresholdMin_[0-9]/ig.test(f.name) && (panel.seenTabs[f.countryId] || !panel.countriesConfigured[f.countryId])) {
                f.allowBlank = false;
            }
            if (/productCrefo_[0-9]/ig.test(f.name) && (panel.seenTabs[f.countryId] || !panel.countriesConfigured[f.countryId])) {
                f.allowBlank = false;
            }
        });
    },
    validateProductsComboBoxes: function (panel) {
        var sequence,
            countryId = -1,
            valid = true;
        panel.getForm().getFields().each(function(f) {
            if (/productCrefo_[0-9]/ig.test(f.name) && panel.countriesConfigured[f.countryId]) {
                if (countryId !== f.countryId) {
                    sequence = 0;
                    countryId = f.countryId;
                }
                var records = panel.productCwsStore.getRecordsForCountry(f.countryId);
                if (!panel.config.hasCompanyProducts && Ext.isEmpty(records)) {
                    f.markInvalid(panel.snippets.error.noProducts);
                    f.fireEvent('validitychange', f, false);
                    valid = false;
                } else {
                    Ext.Array.each(records, function (record) {
                        if (!record.get('available')) {
                            var product = panel.reportCompanyStore.first().getCountries().findRecord('country', countryId).getProducts().findRecord('productKeyWS', record.get('keyWS'));
                            if (!Ext.isEmpty(product) && !product.get('available') && product.get('sequence') === sequence) {
                                f.markInvalid(panel.snippets.error.hasRedProducts);
                                f.fireEvent('validitychange', f, false);
                                valid = false;
                            }
                        }
                    });
                    sequence++;
                }
            }
        });
        return valid;
    },
    validateOnSave: function (panel) {
        var valid = true,
            countryId = -1,
            sequence;
        panel.getForm().getFields().each(function (f) {
            var validCmp = true;
            if (/productCrefo_[0-9]/ig.test(f.name)) {
                if (countryId !== f.countryId) {
                    sequence = 0;
                    countryId = f.countryId;
                }
                if (panel.seenTabs[f.countryId]) {
                    validCmp = f.validate();
                } else {
                    var country = panel.reportCompanyStore.first().getCountries().findRecord('country', countryId);
                    if (Ext.isEmpty(country)) {
                        validCmp = f.validate();
                    } else {
                        var product = country.getProducts().findRecord('sequence', sequence);
                        if (!Ext.isEmpty(product) && !product.get('available')) {
                            f.markInvalid(panel.snippets.error.hasRedProducts);
                            f.fireEvent('validitychange', f, false);
                            validCmp = false;
                        }
                    }
                }
                if (!validCmp) {
                    panel.fireEvent('tabHasError', f.countryId);
                }
                sequence++;
            } else {
                validCmp = f.validate();
                if (!Ext.isEmpty(f.countryId) && !validCmp) {
                    panel.fireEvent('tabHasError', f.countryId);
                }
            }
            valid = validCmp && valid;
        });
        return valid;
    }
});
//{/block}
