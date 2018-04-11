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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/container_error"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.ContainerError',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-reportcompany-container-error',
        region: 'center',
        autoScroll: true,
        name: 'reportCompanyContainerError',
        id: 'reportCompanyContainerError',
        border: 0,
        layout: 'anchor',
        ui: 'shopware-ui',
        defaults: {
            labelWidth: 210,
            labelStyle: 'font-weight: 700;',
            anchor: '100%'
        },
        hidden: false,
        minWidth: 155,
        initComponent: function(){
            var me = this;
            me.items = me.getItems();
            me.callParent( arguments );
        },
        getItems: function(){
            var me = this;
            return [
                {
                    xtype: me.createTextContainer( me.errorText )
                }
            ];
        },
        createTextContainer: function( html ){
            return Ext.create(
                'Ext.container.Container',
                {
                    flex: 1,
                    width: '100%',
                    padding: '10 5 0 5',
                    style: 'color: #999; font-style: italic; margin: 0 0 15px 0;',
                    html: html
                } );
        }
    } );
//{/block}