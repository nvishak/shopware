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
//{block name="backend/crefo_configuration/view/tabs/reportcompany/tab_container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.TabContainer',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-reportcompany-tab-container',
        region: 'center',
        autoScroll: true,
        border: 0,
        layout: 'anchor',
        ui: 'shopware-ui',
        hidden: false,
        minWidth: 155,
        useDefaults: false,
        defaults: {
            labelWidth: 90,
            anchor: '100%',
            layout: {
                type: 'vbox',
                defaultMargins: { top: 0, right: 5, bottom: 0, left: 0 }
            }
        },
        snippets: {
            labels: {
                basket: {
                    maxValue: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/basket_upper_limit"}Warenkorb-Obergrenze{/s}',
                    currency: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/currency"}EUR{/s}'
                },
                basketAreaTitle: {
                    thresholdBasket: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/basket_threshold"}Warenkorb-Schwellwert{/s}',
                    productType: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/product_type"}Produktart{/s}',
                    solvencyIndex: '{s name="crefoconfig/view/tabs/reportcompany/panel/labels/products/solvency_index"}Bonitätsindex-Schwellwert{/s}'
                }
            },
            tooltips: {
                infoProducts: '{s name="crefo/config/view/tabs/reportcompany/tooltips/questionMark"}In Abhängigkeit von Warenkorb-Schwellwerten können Produktarten definiert werden,' +
                ' die für die Bonitätsprüfung verwendet werden.<br/><br/>Diese Software-Version kann die folgenden' +
          'Produktarten verarbeiten:<br/><br/><p>RisikoCheck</p><p>eCrefo</p><p>Die tatsächlich auswählbaren Produktarten sind von den Berechtigungen' +
                ' der verwendeten Mitgliedskennung abhängig.</p><br/><br/>Bei Auswahl der Produktart eCrefo ist die ' +
          'Eingabe eines Bonitätsindex-Schwellwertes notwendig (Wertebereich 100-600).{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            }
        },
        initComponent: function() {
            var me = this;
            me.id = 'reportCompanyTabContainer_' + me.countryId;
            me.name = 'reportCompanyTabContainer_' + me.countryId;
            me.items = me.createBasketAreaView();
            Ext.apply(Ext.form.field.VTypes, {
                basketMaxVType: function(val, field) {
                    var basketAreaContainer = Ext.getCmp('reportCompanyBasketAreaContainer_' + field.countryId);
                    if (Ext.isEmpty(val) || Ext.isEmpty(basketAreaContainer) || basketAreaContainer.items.length === 0) {
                        return true;
                    }
                    var lastBasketRow = basketAreaContainer.items.get(basketAreaContainer.items.length - 1),
                        basketThresholdValue = lastBasketRow.query('numberfield[name=basketThresholdMin_' + field.countryId + ']')[0];
                    var result = field.getValue() > basketThresholdValue.getValue();
                    if (!result) {
                        me.parentPanel.fireEvent('tabHasError', field.countryId);
                    }
                    return result;
                },
                basketMaxVTypeText: me.snippets.validation.invalidValue
            });
            me.callParent(arguments);
        },
        createBasketAreaView: function() {
            var me = this,
                reportCompanyStore = me.parentPanel.reportCompanyStore.first();
            if (Ext.isEmpty(reportCompanyStore)) {
                return [];
            }
            var basketMaxThresholdArea = me.createMaxThresholdArea(),
                basketHeaderColumn = me.createHeaders(),
                basketAreaContainer = me.createBasketAreaContainer(),
                countryRecord = reportCompanyStore.getCountries().findRecord('country', me.countryId);
            if (!me.useDefaults && !Ext.isEmpty(countryRecord) && countryRecord.getProducts().getCount() > 0) {
                var productsStore = countryRecord.getProducts();
                productsStore.each(function (record) {
                    basketAreaContainer.addNewBasketAreaRow(record.get('sequence'), false, record, me.useDefaults);
                });
            } else {
                basketAreaContainer.addNewBasketAreaRow(0, false, undefined, me.useDefaults);
            }
            return [{
                xtype: CrefoUtil.createTextContainer('<div class="x-tool" style="float: right;border: none !important;" width="24" valign="top"><span id="reportcompany_prodtype_icon" class="x-form-help-icon" style="margin: 0;" data-qtip="' + me.snippets.tooltips.infoProducts + '" role="presentation"></span></div>', 'margin: 0 0 0 0; padding: 0 0 0 0;')
            }, basketHeaderColumn, basketAreaContainer, basketMaxThresholdArea ];
        },
        createHeaders: function () {
            var me = this;
            return Ext.create('Ext.container.Container', {
                layout: 'column',
                alias: 'widget.crefo-config-tabs-report-private-person-basket-area-headers',
                padding: '0 0 30 0',
                defaults: {
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
                        columnWidth: me.parentPanel.columnWidthLayout.headers.thresholdArea,
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
                        columnWidth: me.parentPanel.columnWidthLayout.headers.productTypeArea,
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
                        columnWidth: me.parentPanel.columnWidthLayout.headers.solvencyIndexArea,
                        html: me.snippets.labels.basketAreaTitle.solvencyIndex,
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
                        columnWidth: me.parentPanel.columnWidthLayout.headers.actionsArea,
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
            return Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.BasketAreaContainer', {
                parentPanel: me.parentPanel,
                countryId: me.countryId
            });
        },
        createMaxThresholdArea: function() {
            var me = this;
            return Ext.create('Ext.container.Container', {
                layout: 'column',
                width: '100%',
                defaults: {
                    columnWidth: me.parentPanel.columnWidthLayout.default
                },
                items: [
                    {
                        xtype: 'text',
                        columnWidth: me.parentPanel.columnWidthLayout.maxValueText,
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
                        name: 'thresholdMax_' + me.countryId,
                        itemId: 'thresholdMax_' + me.countryId,
                        columnWidth: me.parentPanel.columnWidthLayout.maxValueNumberField,
                        id: 'bonimaBasketThresholdMaxValue_' + me.countryId,
                        countryId: me.countryId,
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
                                var reportCompanyStore = me.parentPanel.reportCompanyStore.first();
                                if (Ext.isEmpty(reportCompanyStore)) {
                                    return;
                                }
                                var countryRecord = reportCompanyStore.getCountries().findRecord('country', me.countryId);
                                if (!me.useDefaults && countryRecord.getProducts().getCount() > 0) {
                                    var lastProduct = countryRecord.getProducts().last();
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
                        xtype: 'container',
                        html: '&nbsp;',
                        columnWidth: me.parentPanel.columnWidthLayout.maxValueGap
                    },
                    {
                        xtype: 'label',
                        forId: 'thresholdMax',
                        columnWidth: me.parentPanel.columnWidthLayout.maxValueCurrency,
                        html: me.snippets.labels.basket.currency,
                        style: {
                            height: '20px',
                            textAlign: 'left',
                            paddingTop: '7px',
                            paddingBottom: '2px'
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
                        columnWidth: me.parentPanel.columnWidthLayout.maxValueEndText
                    },
                    {
                        xtype: 'hiddenfield',
                        name: 'tabSeen_' + me.countryId,
                        value: false,
                        hidden: true,
                        listeners: {
                            'afterrender': function() {
                                this.setValue(true);
                                me.parentPanel.fireEvent('tabSeen', me.countryId);
                            }
                        }
                    }
                ]
            });
        }
    });
//{/block}
