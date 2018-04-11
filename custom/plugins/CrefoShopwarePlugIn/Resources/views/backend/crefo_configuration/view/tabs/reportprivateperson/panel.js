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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/panel"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefoconfig-tabs-report-private-person-panel',
    bodyPadding: 20,
    autoScroll: true,
    trackResetOnLoad: true,
    id: 'ReportPrivatePersonPanel',
    tabSeen: false,
    layout: {
    //without these settings, the scroll jumps to top by validation
        type: 'vbox',
        align: 'stretch',
        height: '100%',
        width: '100%'
    },
    width: '100%',
    snippets: {
        buttons: {
            save: '{s name=crefo/buttons/save}Save{/s}'
        },
        error: {
            noProducts: '{s name="crefoconfig/reports/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,' +
          'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}'
        }
    },
    config: {
        legitimateKeyPrivatePerson: 'LEIN-100',
        hasBonimaProducts: true
    },
    productKeysIds: {
        bonimaPoolIdent: 0,
        bonimaPoolIdentPremium: 1
    },
    columnWidthLayout: {
        threshold: 0.16,
        productType: 0.30,
        bonimaScoreArea: 0.38,
        actions: 0.10,
        gap: 0.02,
        identificationResult: 0.60,
        bonimaScoreFrom: 0.18,
        bonimaScoreTo: 0.18,
        bonimaScoreFromTitle: 0.45,
        bonimaScoreToTitle: 0.45,
        default: 0.10,
        thresholdFromParticle: 0.19,
        thresholdValue: 0.60,
        thresholdCurrency: 0.15,
        thresholdEndGap: 0.02
    },
    initComponent: function() {
        var me = this;
        me.registerEvents();
        me.reportPrivatePersonStore = Ext.create('Shopware.apps.CrefoConfiguration.store.ReportPrivatePerson');
        me.allowedBonimaProducts = Ext.create('Shopware.apps.CrefoConfiguration.store.reportprivateperson.AllowedBonimaProducts');
        me.legitimateInterestStore = Ext.create('Shopware.apps.CrefoConfiguration.store.reportprivateperson.LegitimateInterests');
        me.productCwsStore = Ext.create('Shopware.apps.CrefoConfiguration.store.reportprivateperson.ProductCws');
        me.reportPrivatePersonStore.load();
        me.allowedBonimaProducts.load();

        me.headerContainer = Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.header.Container', {
            parentPanel: me
        });
        me.items = [ me.headerContainer ];
        me.dockedItems = [ {
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items: me.getButtons()
        } ];
        me.callParent(arguments);
    },
    getButtons: function() {
        var me = this;

        return [ '->', {
            text: me.snippets.buttons.save,
            enableToggle: true,
            id: 'crefoConfig-reportPrivatePerson-saveBtn',
            name: 'crefoConfig-reportPrivatePerson-saveBtn',
            cls: 'primary',
            handler: function() {
                me.fireEvent('saveReportPrivatePerson');
            }
        }
        ];
    },
    registerEvents: function() {
        this.addEvents(
            'saveReportPrivatePerson'
        );
    }
});
//{/block}
