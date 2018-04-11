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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/header/container"}
Ext.define( 'Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.header.Container',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-report-private-person-header-container',
        region: 'center',
        autoScroll: true,
        name: 'reportPrivatePersonHeaderContainer',
        id: 'reportPrivatePersonHeaderContainer',
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
                account: '{s name="crefoconfig/view/tabs/report_private_person/header/container/labels/userAccount"}Mitgliedskennung{/s}',
            },
            errors: {
                noProducts: '{s name="crefoconfig/reports/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,'
                + 'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
                hasRedProducts: '{s name="crefoconfig/reports/hasRedProducts"}ACHTUNG! Die Mitgliedskennung '
                + 'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung '
                + 'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        initComponent: function(){
            var me = this;
            me.registerEvents();
            Ext.applyIf( me, {
                items: me.getItems()
            } );

            Ext.apply( Ext.form.field.VTypes, {
                userAccountVType: function( val, field ){
                    if( val === null || !Ext.isDefined( val ) || val === '' ) {
                        return true;
                    }
                    var container = Ext.getCmp( 'reportPrivatePersonContainer' );
                    if( !Ext.isDefined( container ) ) {
                        return true;
                    }
                    if( !Ext.isDefined( Ext.getCmp( 'radio-group-bonima-products' ) ) ) {
                        this.userAccountVTypeText = me.snippets.errors.noProducts;
                        return false;
                    }
                    if( me.panelHasRedProducts() ) {
                        this.userAccountVTypeText = me.snippets.errors.hasRedProducts;
                        return false;
                    }
                    return true;
                },
                userAccountVTypeText: me.snippets.errors.noProducts
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
                            id: 'privatePersonUserAccountId',
                            name: 'privatePersonUserAccountId',
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
                            vtype: 'userAccountVType',
                            listConfig: {
                                tpl: '<div class="my-boundlist-item-menu" style="font-size: 11px;color: #475c6a;padding: 4px 6px;cursor: pointer;position: relative;">&nbsp;</div>'
                                + '<tpl for=".">'
                                + '<div class="x-boundlist-item">{literal}{useraccount}{/literal}</div></tpl>',
                                listeners: {
                                    el: {
                                        delegate: '.my-boundlist-item-menu',
                                        'click': function(){
                                            var userAccount = Ext.getCmp( 'privatePersonUserAccountId' );
                                            userAccount.clearValue();
                                            userAccount.collapse();
                                        }
                                    }
                                }
                            },
                            listeners: {
                                'afterrender': function(){
                                    var record = me.parentPanel.reportPrivatePersonStore.findRecord( 'id', 1 );
                                    if( record !== null && record.get( 'userAccountId' ) !== undefined ) {
                                        this.suspendEvents( false );
                                        var accountId = record.get( 'userAccountId' );
                                        this.setValue( accountId );
                                        me.setLegitimateFieldAllowBlank( accountId === null || accountId === '' );
                                        this.resumeEvents();
                                    }
                                },
                                'change': function( combo, newValue, oldValue, eOpt ){
                                    me.setLegitimateFieldAllowBlank( newValue === null );
                                    me.fireEvent( 'performLogonReportPrivatePerson', newValue );
                                }
                            }
                        }
                    ]
                }
            ];
        },
        registerEvents: function(){
            this.addEvents(
                /**
                 * Event will be fired when the the user account is changed
                 *
                 * @event
                 * @param newValue
                 * @param [Ext.form.Panel] - This component
                 * @param boolean
                 */
                'performLogonReportPrivatePerson'
            );
        },
        setLegitimateFieldAllowBlank: function( allowBlank ){
            var cmp = Ext.getCmp( 'legitimateKeyPrivatePerson' );
            Ext.isDefined( cmp ) ? cmp.allowBlank = allowBlank : null;
        },
        panelHasRedProducts: function(){
            var me = this,
                radioGroup = Ext.getCmp( 'radio-group-bonima-products' ),
                foundRedProducts = false;
            if( !Ext.isDefined( radioGroup ) || Ext.isEmpty( me.parentPanel.productsDbStore.first() ) ) {
                return false;
            }
            me.parentPanel.productsDbStore.queryBy( function( record, id ){
                var idProduct = record.get( 'productKeyWS' ),
                    idCmp = me.parentPanel.bonimaRadioIds[ idProduct ],
                    cmp = Ext.getCmp( idCmp );
                if( !record.get( 'isProductAvailable' ) && !Ext.isEmpty( cmp ) && cmp.getValue() ) {
                    foundRedProducts = true;
                    return;
                }
            } );
            return foundRedProducts;
        }
    } );
// {/block}