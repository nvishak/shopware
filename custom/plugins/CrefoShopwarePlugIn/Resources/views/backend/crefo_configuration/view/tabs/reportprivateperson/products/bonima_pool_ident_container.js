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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/products/bonima_pool_ident_container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.products.BonimaPoolIdentContainer',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefo-bonima-pool-ident-container',
        name: 'bonimaPoolIdentContainer',
        itemId: 'bonimaPoolIdentContainer',
        border: 0,
        layout: 'column',
        defaults: {
            columnWidth: 0.10,
            height: '20px',
            textAlign: 'left',
            paddingTop: '7px',
            paddingBottom: '2px',
            margin: '0 0 5 0'
        },
        width: '100%',
        ui: 'shopware-ui',
        snippets: {
            labels: {
                col: {
                    values: {
                        identified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/identified"}Indetifiziert{/s}',
                        notIdentified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/notIdentified"}Nicht Indetifiziert{/s}'
                    }
                }
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        listeners: {
            'afterrender': function () {
                var parent = this.ownerCt;
                if (!Ext.isEmpty(parent) && parent.useDBValues) {
                    parent.useDBValues = false;
                }
            }
        },
        initComponent: function() {
            var me = this;
            Ext.applyIf(me, {
                items: me.getItems()
            });
            Ext.apply(Ext.form.field.VTypes, {
                bonimaScoreFromVType: function(val, field) {
                    var bonimaScoreTo = field.nextNode('numberfield[name=bonimaScoreTo]');
                    return (Ext.isEmpty(val) && Ext.isEmpty(bonimaScoreTo.getValue())) ||
                          (!Ext.isEmpty(val) && !Ext.isEmpty(bonimaScoreTo.getValue()) && parseInt(field.getValue()) <= parseInt(bonimaScoreTo.getValue()));
                },
                bonimaScoreFromVTypeText: me.snippets.validation.invalidValue,
                bonimaScoreToVType: function(val, field) {
                    var bonimaScoreFrom = field.previousNode('numberfield[name=bonimaScoreFrom]');
                    return (Ext.isEmpty(val) && Ext.isEmpty(bonimaScoreFrom.getValue())) ||
                          (!Ext.isEmpty(val) && !Ext.isEmpty(bonimaScoreFrom.getValue()) && parseInt(bonimaScoreFrom.getValue()) <= parseInt(field.getValue()));
                },
                bonimaScoreToVTypeText: me.snippets.validation.invalidValue
            });
            me.callParent(arguments);
        },
        getItems: function() {
            var me = this,
                resultItems = [];
            for (var i = 0; i < 2; i++) {
                resultItems.push(me.createScoreIdentificationResultCol(i));
                resultItems.push(me.createGapInCol());
                resultItems.push(me.createScoreFromCol(i));
                resultItems.push(me.createGapInCol());
                resultItems.push(me.createScoreToCol(i));
            }
            return resultItems;
        },
        createGapInCol: function () {
            var me = this;
            return {
                xtype: 'text',
                html: '&nbsp;',
                columnWidth: me.parentPanel.columnWidthLayout.gap
            };
        },
        createScoreIdentificationResultCol: function (identifier) {
            var me = this,
                html = identifier === 0 ? me.snippets.labels.col.values.identified : me.snippets.labels.col.values.notIdentified;
            return {
                xtype: 'text',
                html: html,
                identificationResultType: identifier,
                columnWidth: me.parentPanel.columnWidthLayout.identificationResult,
                style: {
                    textAlign: 'left',
                    paddingTop: '7px',
                    paddingBottom: '2px'
                }
            };
        },
        createScoreFromCol: function (identifier) {
            var me = this;
            return {
                xtype: 'numberfield',
                name: 'bonimaScoreFrom',
                columnWidth: me.parentPanel.columnWidthLayout.bonimaScoreFrom,
                blankText: me.snippets.validation.invalidValue,
                invalidText: me.snippets.validation.invalidValue,
                nanText: me.snippets.validation.invalidValue,
                allowBlank: true,
                allowDecimals: false,
                disableKeyFilter: true,
                allowOnlyWhitespace: false,
                minValue: 0,
                maxValue: 99999,
                //Remove spinner buttons, and arrow key and mouse wheel listeners
                hideTrigger: true,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                enforceMaxLength: true,
                maxLength: 5,
                maskRe: /\d/,
                validateOnBlur: false,
                validateOnChange: false,
                identifier: identifier,
                vtype: 'bonimaScoreFromVType',
                listeners: {
                    'afterrender': function () {
                        var parent = me.ownerCt;
                        if (!Ext.isEmpty(parent) && parent.useDBValues && !Ext.isEmpty(me.scoreProducts)) {
                            var record = me.scoreProducts.findRecord('identificationResult', this.identifier);
                            if (!Ext.isEmpty(record)) {
                                this.setValue(record.get('productScoreFrom'));
                            }
                        }
                    },
                    'change': function (field, newValue) {
                        field.nextNode('numberfield[name=bonimaScoreTo]').allowBlank = Ext.isEmpty(newValue);
                    },
                    'paste': {
                        element: 'inputEl',
                        fn: function(event) {
                            if (event.type === 'paste') {
                                event.preventDefault();
                                return false;
                            }
                        }
                    }
                }
            };
        },
        createScoreToCol: function (identifier) {
            var me = this;
            return {
                xtype: 'numberfield',
                name: 'bonimaScoreTo',
                columnWidth: me.parentPanel.columnWidthLayout.bonimaScoreTo,
                blankText: me.snippets.validation.invalidValue,
                invalidText: me.snippets.validation.invalidValue,
                nanText: me.snippets.validation.invalidValue,
                allowBlank: true,
                allowDecimals: false,
                disableKeyFilter: true,
                allowOnlyWhitespace: false,
                minValue: 0,
                maxValue: 99999,
                //Remove spinner buttons, and arrow key and mouse wheel listeners
                hideTrigger: true,
                keyNavEnabled: false,
                mouseWheelEnabled: false,
                enforceMaxLength: true,
                maxLength: 5,
                maskRe: /\d/,
                validateOnBlur: false,
                validateOnChange: false,
                identifier: identifier,
                vtype: 'bonimaScoreToVType',
                listeners: {
                    'afterrender': function () {
                        var parent = me.ownerCt;
                        if (!Ext.isEmpty(parent) && parent.useDBValues && !Ext.isEmpty(me.scoreProducts)) {
                            var record = me.scoreProducts.findRecord('identificationResult', this.identifier);
                            if (!Ext.isEmpty(record)) {
                                this.setValue(record.get('productScoreTo'));
                            }
                        }
                    },
                    'change': function (field, newValue) {
                        field.previousNode('numberfield[name=bonimaScoreFrom]').allowBlank = Ext.isEmpty(newValue);
                    },
                    'paste': {
                        element: 'inputEl',
                        fn: function(event) {
                            if (event.type === 'paste') {
                                event.preventDefault();
                                return false;
                            }
                        }
                    }
                }
            };
        }
    });
//{/block}
