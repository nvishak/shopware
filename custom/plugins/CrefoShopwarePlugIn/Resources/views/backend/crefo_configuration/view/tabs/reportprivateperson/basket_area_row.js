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
//{block name="backend/crefo_configuration/view/tabs/report_private_person/basket_area_row"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.BasketAreaRow',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefo-config-tabs-report-private-person-basket-area-row',
        name: 'basketAreaRow',
        border: 0,
        layout: 'column',
        ui: 'shopware-ui',
        width: '100%',
        minHeight: 150,
        actionsPosition: 7,
        productsComboPosition: 2,
        snippets: {
            text: {
                identified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/identified"}Indetifiziert{/s}',
                notIdentified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/notIdentified"}Nicht Indetifiziert{/s}'
            },
            particle: {
                and: '{s name="crefo/part/uppercase/and"}UND{/s}',
                from: '{s name="crefo/part/lowercase/from"}ab{/s}',
                to: '{s name="crefo/part/lowercase/to"}bis{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            },
            errors: {
                hasRedProducts: '{s name="crefoconfig/reports/hasRedProducts"}ACHTUNG! Die Mitgliedskennung ist für die rot markierten Produktarten nicht berechtigt.<br/>' +
            'Voraussetzung für die Bonitätsprüfung im WebShop ist, dass die Mietgliedskennung für eine Produktart berechtigt ' +
            'ist, die die Software verarbeiten kann, und dass eine berechtigte Produktart ausgewählt ist.{/s}'
            },
            labels: {
                basket: {
                    currency: '{s name="crefoconfig/view/tabs/report_private_person/products/currency"}EUR{/s}'
                },
                tooltips: {
                    buttons: {
                        addFirst: '{s name="crefo/config/view/tabs/reportPrivatePerson/tooltips/buttons/addFirst"}ersten Warenkorb-Bereich einfügen{/s}',
                        add: '{s name="crefo/config/view/tabs/reportPrivatePerson/tooltips/buttons/add"}Warenkorb-Bereich einfügen{/s}',
                        delete: '{s name="crefo/config/view/tabs/reportPrivatePerson/tooltips/buttons/delete"}Warenkorb-Bereich löschen{/s}'
                    }
                }
            }
        },
        initComponent: function() {
            var me = this;
            me.registerEvents();
            me.items = me.getItems();
            Ext.apply(Ext.form.field.VTypes, {
                productBonimaType: function (val, field) {
                    if (Ext.isEmpty(Ext.getCmp('privatePersonUserAccountId').getValue()) || Ext.isEmpty(me.productRecord) || Ext.isEmpty(field.getValue())) {
                        return true;
                    }
                    if (Ext.isDefined(field.inputCell) && field.inputCell.child('input').hasCls('crefo-red-product')) {
                        this.userAccountVTypeText = me.snippets.errors.hasRedProducts;
                        return false;
                    } else {
                        return true;
                    }
                },
                productBonimaTypeText: this.snippets.errors.hasRedProducts,
                basketMinVType: function(val, field) {
                    if (Ext.isEmpty(field.getValue())) {
                        return true;
                    }
                    var basketAreaContainer = Ext.getCmp('reportPrivatePersonBasketAreaContainer'),
                        maxBasketValueRow = Ext.getCmp('bonimaBasketThresholdMaxValue'),
                        basketAreaRow = field.findParentByType('container').findParentByType('container');
                    var result = true;
                    if (basketAreaRow.rowIndex > 0) {
                        var prevBasketAreaRow = basketAreaContainer.items.get(basketAreaRow.rowIndex - 1),
                            prevBasketValue = prevBasketAreaRow.down('numberfield[name=basketThresholdMin]');
                        result = Ext.isEmpty(prevBasketValue.getValue()) || prevBasketValue.getValue() < field.getValue();
                    }
                    if (basketAreaRow.rowIndex + 1 === basketAreaContainer.items.length) {
                        return result && (Ext.isEmpty(maxBasketValueRow.getValue()) || field.getValue() < maxBasketValueRow.getValue());
                    } else {
                        var nextBasketAreaRow = basketAreaContainer.items.get(basketAreaRow.rowIndex + 1),
                            nextBasketValue = nextBasketAreaRow.down('numberfield[name=basketThresholdMin]');
                        return result && (Ext.isEmpty(nextBasketValue.getValue()) || field.getValue() < nextBasketValue.getValue());
                    }
                },
                basketMinVTypeText: me.snippets.validation.invalidValue
            });
            me.callParent(arguments);
        },
        registerEvents: function() {
            this.addEvents(
                'addBasketAreaRow',
                'addFirstBasketAreaRow',
                'deleteBasketAreaRow',
                'updateHiddenProductName'
            );
        },
        increaseRowIndex: function () {
            var me = this;
            me.rowIndex++;
            if (me.rowIndex !== 0 && Ext.isDefined(me.items.get(me.actionsPosition).items.get(0))) {
                me.items.get(me.actionsPosition).items.get(0).fireEvent('hideFirstPlus');
            }
        },
        decreaseRowIndex: function () {
            var me = this;
            me.rowIndex--;
        },
        showFirstPlus: function () {
            var me = this;
            if (me.rowIndex === 0 && Ext.isDefined(me.items.get(me.actionsPosition).items.get(0))) {
                me.items.get(me.actionsPosition).items.get(0).fireEvent('showFirstPlus');
            }
        },
        hideDelete: function () {
            var me = this;
            if (Ext.isDefined(me.items.get(me.actionsPosition).items.get(2))) {
                me.items.get(me.actionsPosition).items.get(2).fireEvent('hideDelete');
            }
        },
        showDelete: function () {
            var me = this;
            if (Ext.isDefined(me.items.get(me.actionsPosition).items.get(2))) {
                me.items.get(me.actionsPosition).items.get(2).fireEvent('showDelete');
            }
        },
        removePlusSigns: function () {
            var me = this;
            if (me.rowIndex === 0 && Ext.isDefined(me.items.get(me.actionsPosition).items.get(0))) {
                me.items.get(me.actionsPosition).items.get(0).fireEvent('hideFirstPlus');
            }
            if (Ext.isDefined(me.items.get(me.actionsPosition).items.get(1))) {
                me.items.get(me.actionsPosition).items.get(1).fireEvent('hidePlus');
            }
        },
        showPlusSigns: function (position) {
            var me = this;
            if (Ext.isDefined(me.items.get(me.actionsPosition).items.get(0)) && ((me.rowIndex === 0 && position !== me.rowIndex) || (position === me.rowIndex && me.rowIndex === 1))) {
                me.items.get(me.actionsPosition).items.get(0).fireEvent('showFirstPlus');
            }
            if (Ext.isDefined(me.items.get(me.actionsPosition).items.get(1))) {
                me.items.get(me.actionsPosition).items.get(1).fireEvent('showPlus');
            }
        },
        getItems: function () {
            var me = this;
            return [
                {
                    xtype: 'container',
                    columnWidth: me.parentPanel.columnWidthLayout.threshold,
                    layout: 'column',
                    defaults: {
                        columnWidth: me.parentPanel.columnWidthLayout.default,
                        style: {
                            height: '20px',
                            textAlign: 'left',
                            paddingTop: '7px',
                            paddingBottom: '2px'
                        }
                    },
                    items: [
                        {
                            xtype: 'container',
                            html: me.snippets.particle.from,
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdFromParticle
                        },
                        {
                            xtype: 'container',
                            html: '&nbsp;',
                            columnWidth: me.parentPanel.columnWidthLayout.gap
                        },
                        {
                            xtype: 'numberfield',
                            name: 'basketThresholdMin',
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdValue,
                            hideLabel: true,
                            allowBlank: true,
                            blankText: me.snippets.validation.invalidValue,
                            invalidText: me.snippets.validation.invalidValue,
                            nanText: me.snippets.validation.invalidValue,
                            maxText: me.snippets.validation.invalidValue,
                            minText: me.snippets.validation.invalidValue,
                            negativeText: me.snippets.validation.invalidValue,
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
                            vtype: 'basketMinVType',
                            listeners: {
                                'afterrender': function() {
                                    if (!me.useDefaults && !Ext.isEmpty(me.productRecord)) {
                                        this.setValue(me.productRecord.get('thresholdMin'));
                                    }
                                    if (me.focusThreshold) {
                                        this.focus(me.focusThreshold);
                                    }
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
                        },
                        {
                            xtype: 'container',
                            html: '&nbsp;',
                            columnWidth: me.parentPanel.columnWidthLayout.gap
                        },
                        {
                            xtype: 'container',
                            html: me.snippets.labels.basket.currency,
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdCurrency
                        },
                        {
                            xtype: 'container',
                            html: '&nbsp;',
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdEndGap
                        }
                    ]
                },
                {
                    xtype: 'container',
                    html: '&nbsp;',
                    columnWidth: me.parentPanel.columnWidthLayout.gap
                },
                {
                    xtype: 'combo',
                    columnWidth: me.parentPanel.columnWidthLayout.productType,
                    queryMode: 'local',
                    triggerAction: 'all',
                    style: {
                        height: '20px',
                        textAlign: 'left',
                        paddingTop: '7px',
                        paddingBottom: '2px'
                    },
                    forceSelection: true,
                    editable: false,
                    hideLabel: true,
                    allowBlank: true,
                    blankText: me.snippets.validation.invalidValue,
                    name: 'productCrefo',
                    cls: 'basketAreaProductType',
                    displayField: 'nameWS',
                    valueField: 'keyWS',
                    vtype: 'productBonimaType',
                    validateOnChange: false,
                    validateOnBlur: false,
                    store: me.parentPanel.productCwsStore,
                    listeners: {
                        'afterrender': function(combo) {
                            if (me.useDefaults || Ext.isEmpty(me.productRecord)) {
                                return;
                            }
                            var productKeyId = me.productRecord.get('productKeyWS');
                            if (!Ext.isEmpty(productKeyId)) {
                                var keyWS = me.parentPanel.allowedBonimaProducts.findRecord('id', productKeyId).get('keyWS');
                                combo.setValue(keyWS);
                                if (!me.productRecord.get('isProductAvailable') && !Ext.isEmpty(combo.getValue()) && Ext.isDefined(combo.inputCell)) {
                                    combo.inputCell.child('input').addCls('crefo-red-product');
                                } else if (!Ext.isEmpty(combo.getValue()) && Ext.isDefined(combo.inputCell) && combo.inputCell.child('input').hasCls('crefo-red-product')) {
                                    combo.inputCell.child('input').removeCls('crefo-red-product');
                                }
                            }
                        },
                        'change': function (combo, newValue) {
                            var scoreArea = me.getComponent('privatePersonScoreArea');
                            if (!Ext.isEmpty(newValue) && !Ext.isEmpty(scoreArea)) {
                                scoreArea.removeAll(true);
                                me.addScoreProduct(newValue);
                                me.down('hiddenfield').fireEvent('updateHiddenProductName', combo.getRawValue());
                            }
                            combo.store.each(function (record) {
                                if (record.get('available') && record.get('keyWS') === combo.getValue() && Ext.isDefined(combo.inputCell) && combo.inputCell.child('input').hasCls('crefo-red-product')) {
                                    combo.inputCell.child('input').removeCls('crefo-red-product');
                                }
                            });
                        },
                        'blur': function (field) {
                            if (Ext.isEmpty(field.getValue())) {
                                var scoreArea = me.getComponent('privatePersonScoreArea');
                                scoreArea.removeAll(true);
                            }
                        },
                        'expand': function (field) {
                            var recordsToBeRemoved = [];
                            field.store.each(function (record) {
                                if (!record.get('available')) {
                                    recordsToBeRemoved.push(record);
                                }
                            });
                            if (recordsToBeRemoved.length > 0) {
                                field.store.remove(recordsToBeRemoved);
                            }
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
                },
                {
                    xtype: 'hiddenfield',
                    name: 'productCrefoName',
                    value: '',
                    hidden: true,
                    listeners: {
                        'afterrender': function() {
                            if (!Ext.isEmpty(me.productRecord)) {
                                this.setValue(me.productRecord.get('productNameWS'));
                            }
                        },
                        'updateHiddenProductName': function (value) {
                            this.setValue(value);
                        }
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
                    name: 'privatePersonScoreArea',
                    itemId: 'privatePersonScoreArea',
                    useDBValues: !me.useDefaults,
                    layout: 'column',
                    width: '100%',
                    html: '&nbsp;',
                    listeners: {
                        'validateScoreArea': function () {
                            var scoreContainer = this.items.get(0);
                            if (!Ext.isEmpty(scoreContainer)) {
                                var hasValidScoreArea = false,
                                    i = 0;
                                for (i = 0; i < scoreContainer.items.length; i++) {
                                    var field = scoreContainer.items.get(i);
                                    if ((field.name === 'bonimaScoreFrom' || field.name === 'bonimaScoreTo') && !Ext.isEmpty(field.getValue())) {
                                        hasValidScoreArea = true;
                                        break;
                                    }
                                }
                                if (!hasValidScoreArea) {
                                    scoreContainer.queryBy(function (field) {
                                        if (field.name === 'bonimaScoreFrom' || field.name === 'bonimaScoreTo') {
                                            field.allowBlank = hasValidScoreArea;
                                        }
                                    });
                                } else {
                                    scoreContainer.queryBy(function (field) {
                                        if (field.name === 'bonimaScoreFrom') {
                                            var bonimaScoreTo = field.nextNode('numberfield[name=bonimaScoreTo]');
                                            if (Ext.isEmpty(field.getValue()) && Ext.isEmpty(bonimaScoreTo.getValue())) {
                                                field.allowBlank = hasValidScoreArea;
                                                bonimaScoreTo.allowBlank = hasValidScoreArea;
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    }
                },
                {
                    xtype: 'container',
                    html: '&nbsp;',
                    columnWidth: me.parentPanel.columnWidthLayout.gap
                },
                {
                    xtype: 'container',
                    columnWidth: me.parentPanel.columnWidthLayout.actions,
                    defaults: {
                        columnWidth: me.parentPanel.columnWidthLayout.default
                    },
                    style: {
                        height: '20px',
                        textAlign: 'left'
                    },
                    items: [
                        me.createAddFirstRow(),
                        me.createAddRow(),
                        me.createDeleteRow(),
                        {
                            xtype: 'container',
                            html: '&nbsp;',
                            columnWidth: 0.70
                        }
                    ]
                }
            ];
        },
        createAddFirstRow: function () {
            var me = this,
                button = Ext.create('Ext.Button', {
                    iconCls: 'icon--plus-first',
                    tooltip: me.snippets.labels.tooltips.buttons.addFirst,
                    action: 'addFirstBasketAreaRow',
                    listeners: {
                        'afterrender': function () {
                            if (me.rowIndex !== 0) {
                                this.addCls('x-hidden');
                            }
                        },
                        'click': function () {
                            me.fireEvent('addFirstBasketAreaRow');
                        },
                        'hideFirstPlus': function () {
                            this.addCls('x-hidden');
                        },
                        'showFirstPlus': function () {
                            this.removeCls('x-hidden');
                        }
                    }
                });
            button.addEvents('hideFirstPlus', 'showFirstPlus');
            return button;
        },
        createAddRow: function () {
            var me = this,
                button = Ext.create('Ext.Button', {
                    iconCls: 'sprite-plus-circle-frame',
                    tooltip: me.snippets.labels.tooltips.buttons.add,
                    action: 'addBasketAreaRow',
                    listeners: {
                        'click': function () {
                            me.fireEvent('addBasketAreaRow', me.rowIndex);
                        },
                        'hidePlus': function () {
                            this.addCls('x-hidden');
                        },
                        'showPlus': function () {
                            this.removeCls('x-hidden');
                        }
                    }
                });
            button.addEvents('hidePlus', 'showPlus');
            return button;
        },
        createDeleteRow: function () {
            var me = this,
                button = Ext.create('Ext.Button', {
                    iconCls: 'sprite-minus-circle-frame',
                    tooltip: me.snippets.labels.tooltips.buttons.delete,
                    action: 'deleteBasketAreaRow',
                    listeners: {
                        'click': function () {
                            me.fireEvent('deleteBasketAreaRow', me.rowIndex);
                        },
                        'hideDelete': function () {
                            this.addCls('x-hidden');
                        },
                        'showDelete': function () {
                            this.removeCls('x-hidden');
                        }
                    }
                });
            button.addEvents('hideDelete', 'showDelete');
            return button;
        },
        addScoreProduct: function (productKey) {
            var me = this,
                scoreArea = me.getComponent('privatePersonScoreArea'),
                scoreProducts;
            if (!Ext.isEmpty(me.productRecord)) {
                scoreProducts = me.productRecord.getScoreProducts();
            }
            if (productKey === me.parentPanel.allowedBonimaProducts.findRecord('id', me.parentPanel.productKeysIds.bonimaPoolIdent).get('keyWS')) {
                scoreArea.add(Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.products.BonimaPoolIdentContainer', {
                    parentPanel: me.parentPanel,
                    scoreProducts: scoreProducts
                }));
            } else {
                scoreArea.add(Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.products.BonimaPoolIdentPremiumContainer', {
                    parentPanel: me.parentPanel,
                    scoreProducts: scoreProducts
                }));
            }
        }
    });
//{/block}
