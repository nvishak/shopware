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
//{block name="backend/crefo_configuration/view/tabs/general/popup/error_counter"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.general.popup.ErrorCounter', {
    extend: 'Enlight.app.Window',
    alias: 'widget.crefoconfig-tabs-general-popup-error-counter',
    layout: 'fit',
    autoShow: true,
    autoScroll: false,
    maximizable: false,
    minimizable: false,
    width: '450px',
    height: '200px',
    resizable: false,
    modal: true,
    snippets: {
        title: '{s name="crefoconfig/view/tabs/general/popup/error_counter/title"}Error status{/s}',
        infoText: '{s name="crefoconfig/view/tabs/general/popup/error_counter/info_text"}Current error status{/s}',
        labels: {
            numReq: '{s name="crefoconfig/view/tabs/general/popup/error_counter/numReq"}Number of Requests{/s}',
            errTolerance: '{s name="crefoconfig/view/tabs/general/popup/error_counter/errTolerance"}Error tolerance{/s}',
            numErr: '{s name="crefoconfig/view/tabs/general/popup/error_counter/numErr"}Number of Errors{/s}'
        }
    },

    /**
     * Initialize the view components
     *
     * @return void
     */
    initComponent: function(){
        var me = this;

        me.title = me.snippets.title;

        me.items = me.getStatusPanel();

        me.callParent( arguments );
    },
    getStatusPanel: function(){
        this.formPanel = Ext.create( 'Ext.form.Panel', {
            border: false,
            layout: 'anchor',
            autoScroll: false,
            bodyPadding: 10,
            defaults: {
                labelWidth: '155',
                labelStyle: 'font-weight: 700; text-align: left;'
            },
            items: [
                this.getStatusFieldset()
            ]
        } );
        return this.formPanel;
    },
    getStatusFieldset: function(){
        var me = this;
        return Ext.create( 'Ext.form.FieldSet',
            {
                defaults: {
                    labelWidth: '155',
                    labelStyle: 'font-weight: 700; text-align: left;',
                    height: '100%'
                },
                items: [
                    me.createDescriptionContainer( me.snippets.infoText ),
                    {
                        xtype: 'displayfield',
                        fieldLabel: me.snippets.labels.numReq,
                        name: 'numReq',
                        value: me.record.numReq
                    },
                    {
                        xtype: 'displayfield',
                        fieldLabel: me.snippets.labels.numErr,
                        name: 'numErr',
                        value: me.record.numErr
                    },
                    {
                        xtype: 'displayfield',
                        fieldLabel: me.snippets.labels.errTolerance,
                        name: 'errTolerance',
                        value: me.record.errTolerance,
                        renderer: function( value, metaData, record ){
                            if( value === Ext.undefined ) {
                                value = 0;
                            }
                            return Ext.util.Format.currency( value, '%', 1, true );
                        }
                    }
                ]
            }
        );

    },
    createDescriptionContainer: function( html ){
        return Ext
            .create(
                'Ext.container.Container',
                {
                    flex: 1,
                    width: '100%',
                    padding: '10 5 0 0',
                    html: html
                } );
    }
} );
//{/block}
