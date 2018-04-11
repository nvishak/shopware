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
//{block name="backend/crefo_configuration/view/tabs/inkasso/container_error"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.ContainerError',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-inkasso-container-error',
        region: 'center',
        autoScroll: true,
        name: 'inkassoContainerError',
        id: 'inkassoContainerError',
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
            Ext.applyIf( me, {
                items: [
                    {
                        xtype: me.createTextContainer( me.errorText )
                    }
                ]
            } );
            me.callParent( arguments );
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