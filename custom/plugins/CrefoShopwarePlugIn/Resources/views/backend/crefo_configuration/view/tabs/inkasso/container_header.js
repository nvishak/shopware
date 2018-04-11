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
//{block name="backend/crefo_configuration/view/tabs/inkasso/container_header"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.inkasso.ContainerHeader',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-inkasso-container-header',
        region: 'center',
        autoScroll: true,
        name: 'inkassoContainerHeader',
        id: 'inkassoContainerHeader',
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
        snippets: {
            labels: {
                account: '{s name="crefoconfig/view/tabs/inkasso/panel/labels/useraccounts"}Mitgliedskennung{/s}',
            },
            errors: {
                noservice: '{s name="crefoconfig/view/tabs/inkasso/panel/noInkassoService"}ACHTUNG! Die Mitgliedskennung ist für die Abgabe von Inkasso-'
                + 'aufträgen nicht berechtigt.<br/>Dies ist eine Voraussetzung für die Nutzung der Funktionalität Inkassoauftrag in der Bestellübersicht.{/s}'
            }
        },
        initComponent: function(){
            var me = this;
            me.items = me.getItems();
            Ext.apply( Ext.form.field.VTypes, {
                userAccountInkassoVtype: function( val, field ){
                    if( val === null || !Ext.isDefined( val ) || val === '' ) {
                        return true;
                    }
                    var container = Ext.getCmp( 'inkassoContainer' );
                    if( !Ext.isDefined( container ) ) {
                        return true;
                    }
                    if( me.parentPanel.inkassoValuesStore.getCount() === 0 ) {
                        this.userAccountInkassoVtypeText = me.snippets.errors.noservice;
                        return false;
                    }
                    return true;
                },
                userAccountInkassoVtypeText: this.snippets.errors.noservice
            } );
            me.callParent( arguments );
        },
        getItems: function(){
            var me = this;
            return [
                {
                    xtype: 'container',
                    layout: 'vbox',
                    flex: 1,
                    align: 'center',
                    pack: 'start',
                    border: 0,
                    items: [
                        {
                            fieldLabel: me.snippets.labels.account,
                            xtype: 'combo',
                            id: 'inkasso_user_account',
                            name: 'inkasso_user_account',
                            flex: 1,
                            width: '100%',
                            labelWidth: '30%',
                            padding: '10 5 0 5',
                            editable: false,
                            emptyText: me.snippets.labels.account,
                            store: me.parentPanel.accountStore,
                            queryMode: 'local',
                            displayField: 'useraccount',
                            value: '',
                            valueField: 'id',
                            vtype: 'userAccountInkassoVtype',
                            listConfig: {
                                tpl: '<div class="my-boundlist-item-menu" style="font-size: 11px;color: #475c6a;padding: 4px 6px;cursor: pointer;position: relative;">&nbsp;</div>'
                                + '<tpl for=".">'
                                + '<div class="x-boundlist-item">{literal}{useraccount}{/literal}</div></tpl>',
                                listeners: {
                                    el: {
                                        delegate: '.my-boundlist-item-menu',
                                        'click': function(){
                                            var useraccount = Ext.getCmp( 'inkasso_user_account' );
                                            useraccount.clearValue();
                                            useraccount.collapse();
                                        }
                                    }
                                }
                            },
                            listeners: {
                                'afterrender': function( cmp ){
                                    var record = me.parentPanel.inkassoStore.findRecord( 'id', 1 );
                                    if( record !== null && record.get( 'inkasso_user_account' ) !== undefined ) {
                                        this.suspendEvents( false );
                                        this.setValue( record.get( 'inkasso_user_account' ) );
                                        this.resumeEvents();
                                    }
                                    if( cmp.getValue() === null || cmp.getValue() === undefined || cmp.getValue() === '' ) {
                                        Ext.getCmp( 'inkasso_valuta_date' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_due_date' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_order_type' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_receivable_reason' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_turnover_type' ).allowBlank = true;
                                    } else {
                                        Ext.getCmp( 'inkasso_valuta_date' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_due_date' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_order_type' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_receivable_reason' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_turnover_type' ).allowBlank = false;
                                    }
                                },
                                'change': function( combo, newValue, oldValue, eOpt ){
                                    me.fireEvent( 'performLogonInkasso', newValue, oldValue, me.parentPanel, false );
                                    if( Ext.isEmpty( newValue ) || newValue === '' ) {
                                        Ext.getCmp( 'inkasso_valuta_date' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_due_date' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_order_type' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_receivable_reason' ).allowBlank = true;
                                        Ext.getCmp( 'inkasso_turnover_type' ).allowBlank = true;
                                    } else {
                                        Ext.getCmp( 'inkasso_valuta_date' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_due_date' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_order_type' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_receivable_reason' ).allowBlank = false;
                                        Ext.getCmp( 'inkasso_turnover_type' ).allowBlank = false;
                                    }
                                }
                            }
                        },
                        {
                            xtype: 'container',
                            flex: 1,
                            width: '100%',
                            padding: '10 5 0 5',
                            style: 'color: #999; font-style: italic; margin: 0 0 15px 0;',
                            html: ''
                        }
                    ]
                }
            ];
        }
    } );
//{/block}