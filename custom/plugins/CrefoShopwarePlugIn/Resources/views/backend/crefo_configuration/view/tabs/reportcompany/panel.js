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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/panel"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Panel', {
    extend: 'Ext.form.Panel',
    alias: 'widget.crefoconfig-tabs-reportcompany-panel',
    id: 'reportCompanyPanel',
    bodyPadding: 10,
    autoScroll: true,
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
    initComponent: function(){
        var me = this;
        me.reportCompanyStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.ReportCompany' );
        me.productConfigStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportcompany.ProductConfig' );
        me.reportLanguageStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportcompany.ReportLanguage' );
        me.legitimateInterestStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportcompany.LegitimateInterests' );
        me.productStore = Ext.create( 'Shopware.apps.CrefoConfiguration.store.reportcompany.Product' );
        me.reportCompanyStore.load();
        me.productConfigStore.load();

        me.items = [
            Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.ContainerHeader', {
                parentPanel: me
            } ),
            Ext.create( 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.Container', {
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
            id: 'crefoConfig-reportCompany-saveBtn',
            name: 'crefoConfig-reportCompany-saveBtn',
            cls: 'primary',
            handler: function( event ){
                me.fireEvent( 'saveReportCompanies', me );
            }
        }
        ];
    }

} );
//{/block}
