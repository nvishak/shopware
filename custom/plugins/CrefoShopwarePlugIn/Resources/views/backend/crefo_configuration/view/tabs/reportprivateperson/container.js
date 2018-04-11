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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.Container',
    {
        extend: 'Ext.container.Container',
        alias: 'widget.crefoconfig-tabs-report-private-person-container',
        name: 'reportPrivatePersonContainer',
        id: 'reportPrivatePersonContainer',
        itemId: 'reportPrivatePersonContainer',
        region: 'center',
        autoScroll: false,
        autoShow: true,
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
        minBasketAreas: 1,
        maxBasketAreas: 5,
        snippets: {
            labels: {
                legitimateInterest: '{s name="crefoconfig/view/tabs/reportprivateperson/panel/labels/legitimate_interest"}Berechtigtes Interesse{/s}',
                productTitle: '{s name="crefoconfig/view/tabs/reportprivateperson/container/labels/title_products_area"}Produktarten{/s}',
                basket: {
                    maxValue: '{s name="crefoconfig/view/tabs/report_private_person/products/maxValue"}Warenkorb-Obergrenze{/s}',
                    currency: '{s name="crefoconfig/view/tabs/report_private_person/products/currency"}EUR{/s}'
                },
                basketAreaTitle: {
                    thresholdBasket: '{s name="crefoconfig/view/tabs/report_private_person/basket_area/threshold"}Warenkorb-Schwellwert{/s}',
                    productType: '{s name="crefoconfig/view/tabs/report_private_person/basket_area/product_type"}Produktart{/s}',
                    identificationResult: '{s name="crefoconfig/view/tabs/report_private_person/products/col/titles/identResult"}Identifizierungsergebnis{/s}',
                    bonimaScoreTitle: '{s name="crefoconfig/view/tabs/report_private_person/basket_area/bonima_score"}Bonima Score{/s}',
                    bonimaScoreFrom: '{s name="crefo/part/lowercase/from"}ab{/s}',
                    bonimaScoreTo: '{s name="crefo/part/lowercase/to"}bis{/s}'
                },
                countries: {
                    germany: '{s name="crefo/config/view/tabs/reports/countries/germany"}Deutschland{/s}'
                }
            },
            tooltips: {
                infoProducts: '{s name="crefoconfig/view/tabs/reportprivateperson/container/infoProducts"}Diese Software-Version kann die folgenden Produktarten für Privatpersonen verarbeiten:' +
                '<br/><br/><p>Bonima Score Pool Ident</p><p>Bonima Score Pool Ident Premium</p><br/><br/>' +
                'Bei beiden Produktarten ist die Eingabe von Scorebereichen notwendig,innerhalb derer die Bonitätsprüfung bestanden ist (Wertebereich 0-99999).{/s}'
            },
            errors: {
                noProducts: '{s name="crefoconfig/reports/noRedProducts"}ACHTUNG! Die Mitgliedskennung ist für keine Produktart berechtigt,' +
                'die die Software verarbeiten kann.<br/>Dies ist eine Voraussetzung für die Bonitätsprüfung im WebShop.{/s}',
                hasRedProducts: '{s name="crefoconfig/reports/hasRedProducts"}ACHTUNG! Die Mitgliedskennung ' +
                'ist für die rot markierten Produktarten nicht berechtigt.<br/>Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung ' +
                'für eine Produktart berechtigt ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            },
            text: {
                basketAreaIntroText: '{s name="crefoconfig/view/tabs/report_private_person/products/productExplanation"}Die Bonitätsprüfung ist bestanden, wenn die Auskunftsinhalte den folgenden Einstellungen entsprechen:{/s}',
                basketAreaAddressText: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/addressOk"}Adresse in Ordnung{/s}' + ' ' + '{s name="crefo/part/uppercase/and"}UND{/s}'
            }
        },
        initComponent: function() {
            var me = this;
            Ext.applyIf(me, {
                items: me.getItems()
            });
            Ext.apply(Ext.form.field.VTypes, {
                legitimateVType: function(val) {
                    return Ext.isEmpty(Ext.getCmp('privatePersonUserAccountId').getValue()) || !Ext.isEmpty(val);
                },
                legitimateVTypeText: me.snippets.validation.invalidValue,
                basketMaxVType: function(val, field) {
                    var basketAreaContainer = Ext.getCmp('reportPrivatePersonBasketAreaContainer');
                    if (Ext.isEmpty(val) || Ext.isEmpty(basketAreaContainer) || basketAreaContainer.items.length === 0) {
                        return true;
                    }
                    var lastBasketRow = basketAreaContainer.items.get(basketAreaContainer.items.length - 1),
                        basketThresholdValue = lastBasketRow.query('numberfield[name=basketThresholdMin]')[0];
                    return field.getValue() > basketThresholdValue.getValue();
                },
                basketMaxVTypeText: me.snippets.validation.invalidValue
            });
            me.callParent(arguments);
        },
        getItems: function() {
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
                            xtype: me.createTextContainer('')
                        },
                        {
                            fieldLabel: me.snippets.labels.legitimateInterest,
                            emptyText: me.snippets.labels.legitimateInterest,
                            xtype: 'combo',
                            flex: 1,
                            id: 'legitimateKeyPrivatePerson',
                            name: 'legitimateKeyPrivatePerson',
                            width: '100%',
                            labelWidth: '30%',
                            padding: '20 5 0 5',
                            store: me.parentPanel.legitimateInterestStore,
                            queryMode: 'local',
                            forceSelection: true,
                            blankText: me.snippets.validation.invalidValue,
                            editable: false,
                            displayField: 'textWS',
                            valueField: 'keyWS',
                            allowBlank: false,
                            validateOnBlur: false,
                            validateOnChange: false,
                            vtype: 'legitimateVType',
                            listeners: {
                                'afterrender': function () {
                                    if (me.useDefaults) {
                                        this.setValue(me.parentPanel.config.legitimateKeyPrivatePerson);
                                    } else if (!Ext.isEmpty(me.parentPanel.legitimateInterestStore.first()) &&
                                      !Ext.isEmpty(me.parentPanel.reportPrivatePersonStore.first()) &&
                                        !Ext.isEmpty(me.parentPanel.reportPrivatePersonStore.first().get('legitimateKey')) &&
                                        !Ext.isEmpty(me.parentPanel.legitimateInterestStore.findRecord('keyWS', me.parentPanel.reportPrivatePersonStore.first().get('legitimateKey')))
                                    ) {
                                        this.setValue(me.parentPanel.reportPrivatePersonStore.first().get('legitimateKey'));
                                    }
                                }
                            }
                        }
                    ]
                },
                {
                    xtype: 'tabpanel',
                    autoShow: true,
                    activeTab: 0,
                    layout: 'fit',
                    plain: true,
                    region: 'center',
                    border: 0.1,
                    minTabWidth: 80,
                    frame: false,
                    frameHeader: false,
                    width: '100%',
                    bodyBorder: true,
                    bodyPadding: '1 1 5 5',
                    items: [
                        {
                            xtype: 'container',
                            id: 'reportPrivatePersonBasketArea',
                            name: 'reportPrivatePersonBasketArea',
                            autoShow: true,
                            autoRender: true,
                            title: me.snippets.labels.countries.germany,
                            items: me.createBasketAreaView(),
                            defaults: {
                                labelWidth: 90,
                                anchor: '100%',
                                layout: {
                                    type: 'vbox',
                                    defaultMargins: { top: 0, right: 5, bottom: 0, left: 0 }
                                }
                            }
                        }
                    ]
                }
            ];
        },
        createBasketAreaView: function () {
            var me = this,
                privatePersonConfigStore = me.parentPanel.reportPrivatePersonStore.first();
            if (Ext.isEmpty(privatePersonConfigStore)) {
                return [];
            }
            var introText = me.createTextContainer(me.snippets.text.basketAreaIntroText),
                addressText = me.createTextContainer(me.snippets.text.basketAreaAddressText, 'margin: 0 0 15px 0; text-align: center;'),
                basketMaxThresholdArea = me.createMaxThresholdArea(),
                basketHeaderColumn = me.createHeaders(),
                basketAreaContainer = me.createBasketAreaContainer();
            if (!me.useDefaults && !Ext.isEmpty(privatePersonConfigStore) && privatePersonConfigStore.getProducts().getCount() > 0) {
                var productsStore = privatePersonConfigStore.getProducts();
                productsStore.each(function (record) {
                    basketAreaContainer.addNewBasketAreaRow(record.get('visualSequence'), false, record, me.useDefaults);
                });
            } else {
                basketAreaContainer.addNewBasketAreaRow(0, false, undefined, me.useDefaults);
            }
            return [{
                xtype: me.createTextContainer('<div class="x-tool" style="float: right;border: none !important;" width="24" valign="top"><span id="report_private_person_products_icon" class="x-form-help-icon" style="margin: 0;" data-qtip="' + me.snippets.tooltips.infoProducts + '" role="presentation"></span></div>', 'margin: 0 0 0 0; padding: 0 0 0 0;')
            }, introText, addressText, basketHeaderColumn, basketAreaContainer, basketMaxThresholdArea ];
        },
        createHeaders: function () {
            var me = this;
            return Ext.create('Ext.container.Container', {
                layout: 'column',
                alias: 'widget.crefo-config-tabs-report-private-person-basket-area-headers',
                padding: '0 0 30 0',
                defaults: {
                    columnWidth: me.parentPanel.columnWidthLayout.default,
                    style: {
                        height: '20px',
                        textAlign: 'left',
                        paddingTop: '7px',
                        paddingBottom: '2px'
                    }
                },
                width: '100%',
                items: [
                    {
                        xtype: 'container',
                        columnWidth: me.parentPanel.columnWidthLayout.threshold,
                        html: me.snippets.labels.basketAreaTitle.thresholdBasket,
                        style: {
                            height: '20px',
                            textAlign: 'left',
                            paddingTop: '7px',
                            paddingBottom: '2px'
                        }
                    },
                    {
                        xtype: 'container',
                        html: '&nbsp;',
                        columnWidth: me.parentPanel.columnWidthLayout.gap
                    },
                    {
                        xtype: 'container',
                        columnWidth: me.parentPanel.columnWidthLayout.productType,
                        html: me.snippets.labels.basketAreaTitle.productType,
                        style: {
                            height: '20px',
                            textAlign: 'left',
                            paddingTop: '7px',
                            paddingBottom: '2px'
                        }
                    },
                    {
                        xtype: 'container',
                        html: '&nbsp;',
                        columnWidth: me.parentPanel.columnWidthLayout.gap
                    },
                    {
                        xtype: 'container',
                        columnWidth: me.parentPanel.columnWidthLayout.bonimaScoreArea,
                        layout: 'column',
                        html: '&nbsp;',
                        defaults: {
                            columnWidth: me.parentPanel.columnWidthLayout.default,
                            style: {
                                height: '20px',
                                textAlign: 'left'
                            }
                        },
                        items: [
                            {
                                xtype: 'container',
                                columnWidth: me.parentPanel.columnWidthLayout.identificationResult,
                                html: me.snippets.labels.basketAreaTitle.identificationResult,
                                style: {
                                    height: '20px',
                                    textAlign: 'left'
                                }
                            },
                            {
                                xtype: 'container',
                                html: '&nbsp;',
                                columnWidth: me.parentPanel.columnWidthLayout.gap
                            },
                            {
                                xtype: 'container',
                                html: '&nbsp;',
                                layout: 'column',
                                columnWidth: me.parentPanel.columnWidthLayout.gap + me.parentPanel.columnWidthLayout.bonimaScoreFrom + me.parentPanel.columnWidthLayout.bonimaScoreTo,
                                defaults: {
                                    columnWidth: me.parentPanel.columnWidthLayout.default,
                                    style: {
                                        height: '20px',
                                        textAlign: 'left'
                                    }
                                },
                                items: [
                                    {
                                        xtype: 'container',
                                        columnWidth: 1,
                                        html: me.snippets.labels.basketAreaTitle.bonimaScoreTitle,
                                        style: {
                                            height: '20px',
                                            textAlign: 'left'
                                        }
                                    },
                                    {
                                        xtype: 'container',
                                        columnWidth: me.parentPanel.columnWidthLayout.bonimaScoreFromTitle,
                                        html: me.snippets.labels.basketAreaTitle.bonimaScoreFrom,
                                        style: {
                                            height: '20px',
                                            textAlign: 'left'
                                        }
                                    },
                                    {
                                        xtype: 'container',
                                        html: '&nbsp;',
                                        columnWidth: me.parentPanel.columnWidthLayout.default
                                    },
                                    {
                                        xtype: 'container',
                                        columnWidth: me.parentPanel.columnWidthLayout.bonimaScoreToTitle,
                                        html: me.snippets.labels.basketAreaTitle.bonimaScoreTo,
                                        style: {
                                            height: '20px',
                                            textAlign: 'left'
                                        }
                                    }
                                ]
                            }
                        ]
                    },
                    {
                        xtype: 'container',
                        html: '&nbsp;',
                        columnWidth: me.parentPanel.columnWidthLayout.gap
                    },
                    {
                        xtype: 'container',
                        columnWidth: me.parentPanel.columnWidthLayout.actions,
                        html: '&nbsp;',
                        style: {
                            height: '20px',
                            textAlign: 'left'
                        }
                    }
                ]
            });
        },
        createBasketAreaContainer: function () {
            var me = this;
            return Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.BasketAreaContainer', {
                parentPanel: me.parentPanel
            });
        },
        createMaxThresholdArea: function() {
            var me = this;
            return Ext.create('Ext.container.Container', {
                layout: 'column',
                width: '100%',
                defaults: {
                    columnWidth: 0.10
                },
                items: [
                    {
                        xtype: 'text',
                        columnWidth: 0.22,
                        html: me.snippets.labels.basket.maxValue,
                        style: {
                            height: '24px',
                            textAlign: 'left',
                            paddingTop: '7px',
                            paddingBottom: '2px'
                        }
                    },
                    {
                        xtype: 'numberfield',
                        name: 'thresholdMax',
                        itemId: 'thresholdMax',
                        id: 'bonimaBasketThresholdMaxValue',
                        hideLabel: true,
                        allowBlank: true,
                        invalidText: me.snippets.validation.invalidValue,
                        nanText: me.snippets.validation.invalidValue,
                        maxText: me.snippets.validation.invalidValue,
                        width: 50,
                        decimalPrecision: 2,
                        disableKeyFilter: true,
                        submitLocaleSeparator: false,
                        minValue: 0,
                        maxValue: 99999.99,
                        //Remove spinner buttons, and arrow key and mouse wheel listeners
                        hideTrigger: true,
                        keyNavEnabled: false,
                        mouseWheelEnabled: false,
                        enforceMaxLength: true,
                        maxLength: 8,
                        maskRe: /[\d,.]/,
                        validateOnBlur: false,
                        validateOnChange: false,
                        vtype: 'basketMaxVType',
                        listeners: {
                            'afterrender': function() {
                                var privatePersonConfigStore = me.parentPanel.reportPrivatePersonStore.first();
                                if (!me.useDefaults && !Ext.isEmpty(privatePersonConfigStore) && privatePersonConfigStore.getProducts().getCount() > 0) {
                                    var lastProduct = privatePersonConfigStore.getProducts().last();
                                    if (lastProduct.get('isLastThresholdMax') && !Ext.isEmpty(lastProduct.get('thresholdMax'))) {
                                        this.setValue(lastProduct.get('thresholdMax'));
                                    }
                                }
                            },
                            'paste': {
                                element: 'inputEl',
                                fn: function(event, inputEl) {
                                    if (event.type === 'paste') {
                                        event.preventDefault();
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    {
                        xtype: 'label',
                        forId: 'thresholdMax',
                        html: me.snippets.labels.basket.currency,
                        style: {
                            height: '20px',
                            textAlign: 'left',
                            paddingTop: '7px',
                            paddingBottom: '2px',
                            paddingLeft: '2px'
                        }
                    },
                    {
                        xtype: 'text',
                        text: ' ',
                        style: {
                            height: '20px',
                            textAlign: 'left',
                            paddingTop: '7px',
                            paddingBottom: '2px'
                        },
                        columnWidth: 0.58
                    }
                ]
            });
        },
        createTextContainer: function(html, style) {
            if (!Ext.isDefined(style)) {
                style = 'color: #999; font-style: italic; margin: 0 0 15px 0;';
            }
            return Ext.create(
                'Ext.container.Container',
                {
                    flex: 1,
                    width: '100%',
                    padding: '10 5 0 5',
                    style: style,
                    html: html
                });
        }
    });
//{/block}
