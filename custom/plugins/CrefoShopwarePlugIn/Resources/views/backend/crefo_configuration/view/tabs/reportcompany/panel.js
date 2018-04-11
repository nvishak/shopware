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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/panel"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefoconfig-tabs-reportcompany-panel',
    id: 'reportCompanyPanel',
    bodyPadding: 10,
    autoScroll: true,
    layout: {
        //without these settings, the scroll jumps to top by validation
        type: 'vbox',
        align: 'stretch',
        width: '100%'
    },
    snippets: {
        buttons: {
            save: '{s name=crefo/buttons/save}Save{/s}'
        },
        error: {
            noProducts: '{s name="crefoconfig/controller/crefo_configuration/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,' +
        'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
            hasRedProducts: '{s name="crefoconfig/controller/crefo_configuration/hasRedProducts"}ACHTUNG! Die Mitgliedskennung ' +
        'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung ' +
        'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
        }
    },
    productsIds: {
        solvencyCheck: 0,
        eCrefo: 1
    },
    countriesIds: {
        AT: 0,
        DE: 1,
        LU: 2
    },
    seenTabs: [
        false,
        false,
        false
    ],
    errorOnTab: [
        false,
        false,
        false
    ],
    countriesConfigured: [
        false,
        false,
        false
    ],
    config: {
        legitimateKeyPrivatePerson: 'LEIN-100',
        reportLanguage: 'de',
        hasCompanyProducts: true
    },
    columnWidthLayout: {
        gap: 0.02,
        default: 0.10,
        headers: {
            thresholdArea: 0.26,
            productTypeArea: 0.25,
            solvencyIndexArea: 0.33,
            actionsArea: 0.10
        },
        thresholdArea: {
            from: 0.10,
            value: 0.35,
            currency: 0.10,
            endGap: 0.41
        },
        maxValueText: 0.20,
        maxValueNumberField: 0.09,
        maxValueCurrency: 0.03,
        maxValueGap: 0.01,
        maxValueEndText: 0.67
    },
    listeners: {
        tabHasError: function (countryId) {
            this.errorOnTab[countryId] = true;
        },
        tabSeen: function (countryId) {
            this.seenTabs[countryId] = true;
        },
        configCountry: function (countryId) {
            this.countriesConfigured[countryId] = true;
        }
    },
    initComponent: function() {
        var me = this;
        me.registerEvents();
        me.initTabsMetadata();
        me.reportCompanyStore = Ext.create('Shopware.apps.CrefoConfiguration.store.ReportCompany');
        me.reportLanguageStore = Ext.create('Shopware.apps.CrefoConfiguration.store.reportcompany.ReportLanguage');
        me.productCwsStore = Ext.create('Shopware.apps.CrefoConfiguration.store.reportcompany.Product');
        me.legitimateInterestStore = Ext.create('Shopware.apps.CrefoConfiguration.store.reportcompany.LegitimateInterests');
        me.allowedCompaniesProducts = Ext.create('Shopware.apps.CrefoConfiguration.store.reportcompany.AllowedCompaniesProducts');
        me.reportCompanyStore.load({
            callback: function () {
                me.updateCountriesStatus();
            }
        });
        me.allowedCompaniesProducts.load();

        me.items = [
            Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.ContainerHeader', {
                parentPanel: me
            })
        ];

        me.dockedItems = [ {
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items: me.getButtons()
        } ];
        me.callParent(arguments);
    },
    initTabsMetadata: function () {
        var me = this;
        me.errorOnTab = [ false, false, false ];
        me.seenTabs = [ false, false, false ];
    },
    getButtons: function() {
        var me = this;

        return [ '->', {
            text: me.snippets.buttons.save,
            enableToggle: true,
            id: 'crefoConfig-reportCompany-saveBtn',
            name: 'crefoConfig-reportCompany-saveBtn',
            cls: 'primary',
            handler: function() {
                me.clearErrorOnTab();
                me.fireEvent('saveReportCompanies', me);
            }
        }
        ];
    },
    registerEvents: function() {
        this.addEvents(
            'saveReportCompanies',
            'tabHasError'
        );
    },
    clearErrorOnTab: function () {
        var me = this;
        me.errorOnTab = [ false, false, false ];
    },
    getTabToBeActivated: function () {
        var me = this;
        if (me.errorOnTab[me.countriesIds.DE]) {
            return 0;
        }
        if (me.errorOnTab[me.countriesIds.AT]) {
            return 1;
        }
        if (me.errorOnTab[me.countriesIds.LU]) {
            return 2;
        }
        return 0;
    },
    updateCountriesStatus: function () {
        var me = this,
            countries = me.reportCompanyStore.first().getCountries();
        me.countriesConfigured = [ false, false, false ];
        if (!Ext.isEmpty(countries)) {
            countries.each(function (countryRecord) {
                me.fireEvent('configCountry', countryRecord.get('country'));
            });
        }
    }
});
//{/block}
