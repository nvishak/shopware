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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/container_header"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.ContainerHeader',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-reportcompany-container-header',
        region: 'center',
        autoScroll: true,
        name: 'reportCompanyContainerHeader',
        id: 'reportCompanyContainerHeader',
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
                account: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/useraccounts"}Mitgliedskennung{/s}',
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            },
            errors: {
                noProducts: '{s name="crefoconfig/controller/crefo_configuration/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,'
                + 'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
                hasRedProducts: '{s name="crefoconfig/controller/crefo_configuration/hasRedProducts"}ACHTUNG! Die Mitgliedskennung '
                + 'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung '
                + 'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            }
        },
        initComponent: function(){
            var me = this;
            me.items = me.getItems();
            Ext.apply( Ext.form.field.VTypes, {
                userAccountCompanyVtype: function( val, field ){
                    if( val === null || !Ext.isDefined( val ) || val === '' ) {
                        return true;
                    }
                    var container = Ext.getCmp( 'reportCompanyContainer' );
                    if( !Ext.isDefined( container ) ) {
                        return true;
                    }
                    if( me.panelHasRedProducts() ) {
                        this.userAccountCompanyVtypeText = me.snippets.errors.hasRedProducts;
                        return false;
                    }
                    if( me.parentPanel.productStore.getCount() === 0 ) {
                        this.userAccountCompanyVtypeText = me.snippets.errors.noProducts;
                        return false;
                    }
                    return true;
                },
                userAccountCompanyVtypeText: this.snippets.errors.noProducts
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
                            id: 'useraccountId',
                            name: 'useraccountId',
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
                            vtype: 'userAccountCompanyVtype',
                            validateOnBlur: false,
                            validateOnChange: false,
                            listConfig: {
                                tpl: '<div class="my-boundlist-item-menu" style="font-size: 11px;color: #475c6a;padding: 4px 6px;cursor: pointer;position: relative;">&nbsp;</div>'
                                + '<tpl for=".">'
                                + '<div class="x-boundlist-item">{literal}{useraccount}{/literal}</div></tpl>',
                                listeners: {
                                    el: {
                                        delegate: '.my-boundlist-item-menu',
                                        'click': function(){
                                            var useraccount = Ext.getCmp( 'useraccountId' );
                                            useraccount.clearValue();
                                            useraccount.collapse();
                                        }
                                    }
                                }
                            },
                            listeners: {
                                'afterrender': function(){
                                    var record = me.parentPanel.reportCompanyStore.findRecord( 'id', 1 );
                                    if( record !== null && record.get( 'useraccountId' ) !== undefined ) {
                                        this.suspendEvents( false );
                                        this.setValue( record.get( 'useraccountId' ) );
                                        this.resumeEvents();
                                    }
                                },
                                'change': function( combo, newValue, oldValue, eOpt ){
                                    me.fireEvent( 'performLogonReport', newValue, me.parentPanel, false );
                                }
                            }
                        },{
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
        },
        panelHasRedProducts: function(){
            var me = this,
                hasRedProduct = false,
                container = Ext.getCmp( 'reportCompanyContainer' );
            if( !Ext.isDefined( container ) ) {
                return hasRedProduct;
            }
            me.parentPanel.getForm().getFields().each( function( f ){
                if( !Ext.isDefined( f.inputCell ) ) {
                    return;
                }
                if( !Ext.isDefined( f.inputCell.child( 'input' ) ) ) {
                    return;
                }
                if( f.inputCell.child( 'input' ).hasCls( 'crefo-red-product' ) ) {
                    hasRedProduct = true;
                }
            } );
            return hasRedProduct;
        }
    } );
//{/block}