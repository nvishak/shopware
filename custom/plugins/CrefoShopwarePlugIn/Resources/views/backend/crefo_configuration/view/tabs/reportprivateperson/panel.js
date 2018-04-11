/*
 * Copyright (c) 2016 Verband der Vereine Creditreform.
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
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefoconfig-tabs-report-private-person-panel',
    bodyPadding: 10,
    autoScroll: true,
    trackResetOnLoad: true,
    id: 'ReportPrivatePersonPanel',
    tabSeen: false,
    layout: {
        // without these settings, the scroll jumps to top by validation
        type: 'vbox',
        align: 'stretch',
        width: '100%'
    },
    snippets: {
        buttons: {
            save: '{s name=crefo/buttons/save}Save{/s}'
        }
    },
    productKeysIds: {
        bonimaPoolIdent: 0,
        bonimaPoolIdentPremium: 1
    },
    bonimaContainerTypes: {
        0: 'bonimaPoolIdentContainer',
        1: 'bonimaPoolIdentPremiumContainer'
    },
    bonimaRadioIds:{
        0: 'bonimaPoolIdentProductRadio',
        1: 'bonimaPoolIdentPremiumProductRadio'
    },
    initComponent: function(){
        var me = this;
        me.registerEvents();
        me.reportPrivatePersonStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.ReportPrivatePerson' );
        me.productsDbStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportprivateperson.ProductDb' );
        me.allowedBonimaProducts = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportprivateperson.AllowedBonimaProducts' );
        me.legitimateInterestStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportprivateperson.LegitimateInterests' );
        me.productCwsStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportprivateperson.ProductCws' );
        me.reportPrivatePersonStore.load();
        me.productsDbStore.load();
        me.allowedBonimaProducts.load();

        me.items = [
            Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.header.Container', {
                parentPanel: me
            } ),
            Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Container', {
                parentPanel: me
            } )
        ];

        me.dockedItems = [ {
            xtype: 'toolbar',
            dock: 'bottom',
            ui: 'shopware-ui',
            cls: 'shopware-toolbar',
            items: me.getButtons()
        } ];
        me.callParent( arguments );
    },
    getButtons: function(){
        var me = this;

        return [ '->', {
            text: me.snippets.buttons.save,
            enableToggle: true,
            id: 'crefoConfig-reportPrivatePerson-saveBtn',
            name: 'crefoConfig-reportPrivatePerson-saveBtn',
            cls: 'primary',
            handler: function( event ){
                me.fireEvent( 'saveReportPrivatePerson' );
            }
        }
        ];
    },
    registerEvents: function(){
        this.addEvents(
            /**
             * Event will be fired when the save button is pressed
             *
             * @event
             * @param [Ext.form.Panel] - This component
             * @param Event
             */
            'saveReportPrivatePerson'
        );
    },
    getBonimaContainerType: function( id ){
        var me = this;
        return me.bonimaContainerTypes[ id ];
    }

} );
//{/block}
