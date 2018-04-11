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
//{block name="backend/crefo_configuration/app" }
Ext.define('Shopware.apps.CrefoConfiguration', {
    extend: 'Enlight.app.SubApplication',
    requires: [ 'CrefoUtil' ],
    name: 'Shopware.apps.CrefoConfiguration',
    loadPath: '{url action=load}',
    bulkLoad: true,
    controllers: [
        'Main',
        'CompanyConfig',
        'Settings',
        'Accounts',
        'InkassoConfig',
        'PrivatePersonConfig'
    ],
    views: [
        'tabs.accounts.List',
        'tabs.accounts.Panel',
        'tabs.accounts.popup.Edit',
        'tabs.accounts.popup.ChangePassword',
        'tabs.accounts.popup.PasswordExtension',

        'tabs.general.Panel',
        'tabs.general.Container',
        'tabs.general.popup.ErrorCounter',

        'tabs.inkasso.Panel',
        'tabs.inkasso.Container',
        'tabs.inkasso.ContainerHeader',

        'tabs.reportcompany.Panel',
        'tabs.reportcompany.Container',
        'tabs.reportcompany.TabContainer',
        'tabs.reportcompany.ContainerHeader',
        'tabs.reportcompany.BasketAreaRow',
        'tabs.reportcompany.BasketAreaContainer',

        'tabs.reportprivateperson.header.Container',
        'tabs.reportprivateperson.products.BonimaPoolIdentContainer',
        'tabs.reportprivateperson.products.BonimaPoolIdentPremiumContainer',
        'tabs.reportprivateperson.Panel',
        'tabs.reportprivateperson.BasketAreaRow',
        'tabs.reportprivateperson.BasketAreaContainer',
        'tabs.reportprivateperson.Container',

        'main.Window'
    ],
    models: [
        'Account',
        'AccountsInUse',
        'ReportCompany',
        'ReportPrivatePerson',
        'reportcompany.AllowedCompaniesProducts',
        'reportcompany.ReportLanguage',
        'reportcompany.LegitimateInterests',
        'reportcompany.Product',
        'reportcompany.CountryConfig',
        'reportcompany.ProductConfig',
        'reportprivateperson.AllowedBonimaProducts',
        'reportprivateperson.ProductDb',
        'reportprivateperson.ScoreProductDb',
        'reportprivateperson.ProductCws',
        'reportprivateperson.LegitimateInterests',
        'General',
        'Inkasso',
        'inkasso.InkassoValues',
        'inkasso.InkassoCreditors'
    ],
    stores: [
        'Account',
        'AccountsInUse',
        'ReportCompany',
        'ReportPrivatePerson',
        'reportcompany.AllowedCompaniesProducts',
        'reportcompany.ReportLanguage',
        'reportcompany.LegitimateInterests',
        'reportcompany.Product',
        'reportcompany.ProductConfig',
        'reportcompany.CountryConfig',
        'reportprivateperson.AllowedBonimaProducts',
        'reportprivateperson.ProductDb',
        'reportprivateperson.ScoreProductDb',
        'reportprivateperson.ProductCws',
        'reportprivateperson.LegitimateInterests',
        'General',
        'Inkasso',
        'inkasso.InkassoValues',
        'inkasso.InkassoCreditors'
    ],
    defaultController: 'Main',
    onBeforeLaunch: function() {
        var me = this;
        me._destroyOtherModuleInstances(function() { });
        Ext.require('CrefoUtil');
        me.callParent(arguments);
    },
    launch: function() {
        var me = this,
            controller = me.getController(me.defaultController);
        return controller.mainWindow;
    },
    _destroyOtherModuleInstances: function(cb, cbArgs) {
        var me = this, activeWindows = [], subAppId = me.$subAppId;
        me.windowClass = 'Shopware.apps.CrefoConfiguration.view.main.Window';
        cbArgs = cbArgs || [];

        Ext.each(Shopware.app.Application.subApplications.items, function(subApp) {
            if (!subApp || !subApp.windowManager || subApp.$subAppId === subAppId || !subApp.windowManager.hasOwnProperty('zIndexStack')) {
                return;
            }

            Ext.each(subApp.windowManager.zIndexStack, function(item) {
                if (typeof (item) !== 'undefined' && me.windowClass === item.$className) {
                    activeWindows.push(item);
                }
            });
        });

        if (activeWindows && activeWindows.length) {
            Ext.each(activeWindows, function(win) {
                win.destroy();
            });

            if (Ext.isFunction(cb)) {
                cb.apply(me, cbArgs);
            }
        } else {
            if (Ext.isFunction(cb)) {
                cb.apply(me, cbArgs);
            }
        }
    }
});
//{/block}
