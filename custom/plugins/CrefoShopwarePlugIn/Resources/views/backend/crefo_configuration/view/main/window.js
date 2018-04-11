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
//{block name="backend/crefo_configuration/view/main/window" }
Ext.define( 'Shopware.apps.CrefoConfiguration.view.main.Window', {
    extend: 'Enlight.app.Window',
    alias: 'widget.crefoconfig-main-window',
    title: '{s name=crefoconfig/view/main/window}Crefo Configuration{/s}',
    id: 'CrefoConfigurationWindow',
    width: 800,
    height: Ext.getBody().getViewSize().height - 100,
    border: false,
    autoShow: true,
    stateful: true,
    layout: 'border',
    snippets: {
        tabs: {
            general: '{s name="crefoconfig/view/main/window/tab/general"}General{/s}',
            accounts: '{s name="crefoconfig/view/main/window/tab/accounts"}Accounts{/s}',
            reportcompany: '{s name="crefoconfig/view/main/window/tab/rep_companies"}Auskunft Firmen{/s}',
            reportPrivatePerson: '{s name="crefoconfig/view/main/window/tab/report_private_person"}Auskunft Privatpersonen{/s}',
            collections: '{s name="crefoconfig/view/main/window/tab/collection"}Collections Order{/s}',
            tooltip: '{s name="crefoconfig/view/main/window/tab/tooltip"}Der Reiter ist nur editierbar, wenn mindestens eine Mitgliedskennung hinterlegt ist.{/s}'
        }
    },
    /**
     * Initializes the component and builds up the main interface
     *
     * @return void
     */
    initComponent: function(){
        var me = this;
        me.registerEvents();
        me.tabPanel = me.createTabPanel();
        me.items = [ {
            xtype: 'container',
            region: 'center',
            layout: 'border',
            generalStore: me.generalStore,
            items: [ me.tabPanel ]
        } ];

        me.callParent( arguments );
    },
    registerEvents: function(){
        this.addEvents(
            /**
             * This event is fired, when the user changes the active tab
             * @param tabPanel Contains the tabPanel
             * @param newTab Contains the new active tab
             * @param oldTab Contains the old tab, which was active before
             * @param generalForm Contains the general form-panel
             */
            'changeTab'
        );
    },
    createTabPanel: function(){
        var me = this;

        me.general = Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.general.Panel', {
            generalStore: me.generalStore
        } );

        me.accounts = Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.accounts.Panel', {
            accountStore: me.accountStore
        } );

        me.reportCompany = Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Panel', {
            accountStore: me.accountStore
        } );

        me.reportPrivatePerson = Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Panel', {
            accountStore: me.accountStore
        } );

        me.inkasso = Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.Panel', {
            accountStore: me.accountStore
        } );


        return Ext.create( 'Ext.tab.Panel', {
            autoShow: true,
            layout: 'fit',
            region: 'center',
            border: 0,
            width: '100%',
            bodyBorder: false,
            defaults: {
                layout: 'fit'
            },
            items: [ {
                xtype: 'container',
                id: 'crefoconfig-main-tabpanel-general',
                title: me.snippets.tabs.general,
                items: [ me.general ]
            }, {
                xtype: 'container',
                id: 'crefoconfig-main-tabpanel-accounts',
                autoRender: true,
                title: me.snippets.tabs.accounts,
                items: [ me.accounts ]
            }, {
                xtype: 'container',
                id: 'crefoconfig-main-tabpanel-reportcompany',
                autoRender: true,
                title: me.snippets.tabs.reportcompany,
                tabConfig: {
                    tooltip: me.snippets.tabs.tooltip
                },
                disabled: true,
                items: [ me.reportCompany ]
            }, {
                xtype: 'container',
                id: 'crefoconfig-main-tabpanel-private-person',
                autoRender: true,
                title: me.snippets.tabs.reportPrivatePerson,
                tabConfig: {
                    tooltip: me.snippets.tabs.tooltip
                },
                disabled: true,
                items: [ me.reportPrivatePerson ]
            }, {
                xtype: 'container',
                id: 'crefoconfig-main-tabpanel-collections',
                autoRender: true,
                title: me.snippets.tabs.collections,
                tabConfig: {
                    tooltip: me.snippets.tabs.tooltip
                },
                disabled: true,
                items: [ me.inkasso ]
            } ],
            listeners: {
                tabchange: function( tabPanel, newTab, oldTab ){
                    var newTabPanel = newTab.items.items[ 0 ];
                    if( /crefoconfig-tabs-general-panel/ig.test( newTabPanel.id ) ) {
                        me.fireEvent( 'changeTab', tabPanel, newTab, oldTab, me.general );
                    }
                    if( /crefoconfig-tabs-accounts-panel/ig.test( newTabPanel.id ) ) {
                        me.fireEvent( 'changeTab', tabPanel, newTab, oldTab, me.accounts );
                    }
                    if( /reportCompanyPanel/ig.test( newTabPanel.id ) ) {
                        me.fireEvent( 'changeTab', tabPanel, newTab, oldTab, me.reportCompany );
                    }
                    if( /ReportPrivatePersonPanel/ig.test( newTabPanel.id ) ) {
                        me.fireEvent( 'changeTab', tabPanel, newTab, oldTab, me.reportPrivatePerson );
                    }
                    if( /crefoconfig-tabs-inkasso-panel/ig.test( newTabPanel.id ) ) {
                        me.fireEvent( 'changeTab', tabPanel, newTab, oldTab, me.inkasso );
                    }
                },
                'afterrender': function( editor, eOpts ){
                    if( me.accountStore.first() !== undefined ) {
                        me.disableTabs( false );
                    }
                }
            }
        } );
    },
    disableTabs: function( disabled ){
        var me = this;
        Ext.getCmp( 'crefoconfig-main-tabpanel-collections' ).setDisabled( disabled );
        Ext.getCmp( 'crefoconfig-main-tabpanel-reportcompany' ).setDisabled( disabled );
        Ext.getCmp( 'crefoconfig-main-tabpanel-private-person' ).setDisabled( disabled );
    }
} );
//{/block}