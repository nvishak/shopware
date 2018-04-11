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
//{block name="backend/crefo_configuration/view/tabs/report_company/basket_area_row"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportcompany.BasketAreaRow',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefo-config-tabs-report-company-basket-area-row',
        name: 'basketAreaRow',
        border: 0,
        layout: 'column',
        ui: 'shopware-ui',
        width: '100%',
        minHeight: 50,
        positions: {
            actionsArea: 7,
            productsCombo: 2,
            addFirstButton: 0,
            addButton: 1,
            deleteButton: 2
        },
        snippets: {
            particle: {
                from: '{s name="crefo/part/lowercase/from"}ab{/s}'
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
                        addFirst: '{s name="crefo/config/view/tabs/reportcompany/tooltips/buttons/addFirst"}Ersten Warenkorb-Bereich einfügen{/s}',
                        add: '{s name="crefo/config/view/tabs/reportcompany/tooltips/buttons/add"}Warenkorb-Bereich einfügen{/s}',
                        delete: '{s name="crefo/config/view/tabs/reportcompany/tooltips/buttons/delete"}Warenkorb-Bereich löschen{/s}'
                    }
                }
            }
        },
        listeners: {
            'afterrender': function () {
                this.useDefaults = true;
            }
        },
        initComponent: function() {
            var me = this;
            me.registerEvents();
            me.items = me.getItems();
            Ext.apply(Ext.form.field.VTypes, {
                productCompanyType: function (val, field) {
                    if (Ext.isEmpty(Ext.getCmp('useraccountId').getValue()) || (field.allowBlank && (Ext.isEmpty(me.productRecord) || Ext.isEmpty(field.getValue())))) {
                        return true;
                    }
                    if (Ext.isDefined(field.inputCell) && field.inputCell.child('input').hasCls('crefo-red-product')) {
                        this.userAccountVTypeText = me.snippets.errors.hasRedProducts;
                        me.parentPanel.fireEvent('tabHasError', field.countryId);
                        return false;
                    } else {
                        return true;
                    }
                },
                productCompanyTypeText: me.snippets.errors.hasRedProducts,
                basketMinVType: function(val, field) {
                    if (Ext.isEmpty(field.getValue())) {
                        return true;
                    }
                    var basketAreaContainer = Ext.getCmp('reportCompanyBasketAreaContainer_' + field.countryId),
                        maxBasketValueRow = Ext.getCmp('bonimaBasketThresholdMaxValue_' + field.countryId),
                        basketAreaRow = field.findParentByType('container').findParentByType('container');
                    var result = true;
                    if (basketAreaRow.rowIndex > 0) {
                        var prevBasketAreaRow = basketAreaContainer.items.get(basketAreaRow.rowIndex - 1),
                            prevBasketValue = prevBasketAreaRow.down('numberfield[name=basketThresholdMin_' + field.countryId + ']');
                        result = Ext.isEmpty(prevBasketValue.getValue()) || prevBasketValue.getValue() < field.getValue();
                    }
                    if (basketAreaRow.rowIndex + 1 === basketAreaContainer.items.length) {
                        result = result && (Ext.isEmpty(maxBasketValueRow.getValue()) || field.getValue() < maxBasketValueRow.getValue());
                    } else {
                        var nextBasketAreaRow = basketAreaContainer.items.get(basketAreaRow.rowIndex + 1),
                            nextBasketValue = nextBasketAreaRow.down('numberfield[name=basketThresholdMin_' + field.countryId + ']');
                        result = result && (Ext.isEmpty(nextBasketValue.getValue()) || field.getValue() < nextBasketValue.getValue());
                    }
                    if (!result) {
                        me.parentPanel.fireEvent('tabHasError', field.countryId);
                    }
                    return result;
                },
                basketMinVTypeText: me.snippets.validation.invalidValue,
                solvencyIndexVType: function (val, field) {
                    if (Ext.isEmpty(field.getValue())) {
                        return true;
                    }
                    var result = true,
                        rowIndex = field.findParentByType('container').findParentByType('container').rowIndex,
                        solvencyIndexesUnsorted = Ext.ComponentQuery.query(' numberfield[name=solvencyIndex_' + field.countryId + ']'),
                        nextSolvencyIndex = {
                            index: null,
                            value: null
                        },
                        prevSolvencyIndex = {
                            index: null,
                            value: null
                        };

                    if (solvencyIndexesUnsorted.length > 1) {
                        Ext.Array.each(solvencyIndexesUnsorted, function (cmp, index, solvencyIndexes) {
                            var cmpIndex = cmp.findParentByType('container').findParentByType('container').rowIndex;
                            if (rowIndex > cmpIndex && (prevSolvencyIndex.index === null || prevSolvencyIndex.index < cmpIndex)) {
                                prevSolvencyIndex.index = cmpIndex;
                                prevSolvencyIndex.value = cmp.getValue();
                            }
                            if (rowIndex < cmpIndex && (nextSolvencyIndex.index === null || nextSolvencyIndex.index > cmpIndex)) {
                                nextSolvencyIndex.index = cmpIndex;
                                nextSolvencyIndex.value = cmp.getValue();
                            }
                        });
                        if (prevSolvencyIndex.index !== null) {
                            result = result && prevSolvencyIndex.value >= field.getValue();
                        }
                        if (nextSolvencyIndex.index !== null) {
                            result = result && field.getValue() >= nextSolvencyIndex.value;
                        }
                    }
                    return result;
                },
                solvencyIndexVTypeText: me.snippets.validation.invalidValue
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
            if (me.rowIndex !== 0 && Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton).fireEvent('hideFirstPlus');
            }
        },
        decreaseRowIndex: function () {
            var me = this;
            me.rowIndex--;
        },
        showFirstPlus: function () {
            var me = this;
            if (me.rowIndex === 0 && Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton).fireEvent('showFirstPlus');
            }
        },
        hideDelete: function () {
            var me = this;
            if (Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.deleteButton))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.deleteButton).fireEvent('hideDelete');
            }
        },
        showDelete: function () {
            var me = this;
            if (Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.deleteButton))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.deleteButton).fireEvent('showDelete');
            }
        },
        removePlusSigns: function () {
            var me = this;
            if (me.rowIndex === 0 && Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton).fireEvent('hideFirstPlus');
            }
            if (Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.addButton))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.addButton).fireEvent('hidePlus');
            }
        },
        showPlusSigns: function (position) {
            var me = this;
            if (Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton)) &&
              ((me.rowIndex === 0 && position !== me.rowIndex) || (position === me.rowIndex && me.rowIndex === 1))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.addFirstButton).fireEvent('showFirstPlus');
            }
            if (Ext.isDefined(me.items.get(me.positions.actionsArea).items.get(me.positions.addButton))) {
                me.items.get(me.positions.actionsArea).items.get(me.positions.addButton).fireEvent('showPlus');
            }
        },
        getItems: function () {
            var me = this,
                countryStore = Ext.create('Shopware.apps.CrefoConfiguration.store.reportcompany.Product'),
                records = me.parentPanel.productCwsStore.getRecordsForCountry(me.countryId);
            countryStore.loadRecords(records);
            return [
                {
                    xtype: 'container',
                    columnWidth: me.parentPanel.columnWidthLayout.headers.thresholdArea,
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
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdArea.from
                        },
                        {
                            xtype: 'container',
                            html: '&nbsp;',
                            columnWidth: me.parentPanel.columnWidthLayout.gap
                        },
                        {
                            xtype: 'numberfield',
                            name: 'basketThresholdMin_' + me.countryId,
                            countryId: me.countryId,
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdArea.value,
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
                                    this.allowBlank = false;
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
                                },
                                validitychange: function (field, isValid) {
                                    if (!isValid) {
                                        me.parentPanel.fireEvent('tabHasError', field.countryId);
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
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdArea.currency
                        },
                        {
                            xtype: 'container',
                            html: '&nbsp;',
                            columnWidth: me.parentPanel.columnWidthLayout.thresholdArea.endGap
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
                    columnWidth: me.parentPanel.columnWidthLayout.headers.productTypeArea,
                    queryMode: 'local',
                    displayField: 'nameWS',
                    valueField: 'keyWS',
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
                    name: 'productCrefo_' + me.countryId,
                    countryId: me.countryId,
                    cls: 'basketAreaProductType',
                    vtype: 'productCompanyType',
                    validateOnChange: false,
                    validateOnBlur: false,
                    store: countryStore,
                    listeners: {
                        'afterrender': function(combo) {
                            this.allowBlank = false;
                            if (me.useDefaults || Ext.isEmpty(me.productRecord)) {
                                return;
                            }
                            var keyWS = me.productRecord.get('productKeyWS');
                            if (!Ext.isEmpty(keyWS)) {
                                combo = combo.setValue(keyWS);
                                if (!me.productRecord.get('available') && !Ext.isEmpty(combo.getValue()) && Ext.isDefined(combo.inputCell)) {
                                    combo.inputCell.child('input').addCls('crefo-red-product');
                                } else if (!Ext.isEmpty(combo.getValue()) && Ext.isDefined(combo.inputCell) && combo.inputCell.child('input').hasCls('crefo-red-product')) {
                                    combo.inputCell.child('input').removeCls('crefo-red-product');
                                }
                            }
                        },
                        'change': function (combo, newValue, oldValue, eOpts) {
                            var solvencyIndexArea = me.getComponent('reportSolvencyIndexArea');
                            if (!Ext.isEmpty(newValue) && !Ext.isEmpty(solvencyIndexArea)) {
                                solvencyIndexArea.removeAll(true);
                                me.processSolvencyIndexField(newValue, me.useDefaults);
                                me.down('hiddenfield').fireEvent('updateHiddenProductName', combo.getRawValue());
                            }
                            combo.store.countryFilter(me.countryId).each(function (record) {
                                if (record.get('available') && record.get('keyWS') === combo.getValue() && Ext.isDefined(combo.inputCell) && combo.inputCell.child('input').hasCls('crefo-red-product')) {
                                    combo.inputCell.child('input').removeCls('crefo-red-product');
                                }
                            });
                        },
                        'blur': function (field) {
                            if (Ext.isEmpty(field.getValue())) {
                                var reportSolvencyIndexArea = me.getComponent('reportSolvencyIndexArea');
                                reportSolvencyIndexArea.removeAll(true);
                            }
                        },
                        'expand': function (combo) {
                            var recordsToBeRemoved = [];
                            combo.store.countryFilter(me.countryId).each(function (record) {
                                if (!record.get('available')) {
                                    recordsToBeRemoved.push(record);
                                }
                            });
                            if (recordsToBeRemoved.length > 0) {
                                combo.store.countryFilter(me.countryId).remove(recordsToBeRemoved);
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
                        },
                        validitychange: function (field, isValid) {
                            if (!isValid) {
                                me.parentPanel.fireEvent('tabHasError', field.countryId);
                            }
                        }
                    }
                },
                {
                    xtype: 'hiddenfield',
                    name: 'productCrefoName_' + me.countryId,
                    countryId: me.countryId,
                    value: '',
                    hidden: true,
                    listeners: {
                        'afterrender': function() {
                            if (!Ext.isEmpty(me.productRecord) && !Ext.isEmpty(me.productRecord.get('productTextWS'))) {
                                this.setValue(me.productRecord.get('productTextWS'));
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
                    columnWidth: me.parentPanel.columnWidthLayout.headers.solvencyIndexArea,
                    name: 'reportSolvencyIndexArea',
                    itemId: 'reportSolvencyIndexArea',
                    layout: 'column',
                    width: '100%',
                    html: '&nbsp;'
                },
                {
                    xtype: 'container',
                    html: '&nbsp;',
                    columnWidth: me.parentPanel.columnWidthLayout.gap
                },
                {
                    xtype: 'container',
                    columnWidth: me.parentPanel.columnWidthLayout.headers.actionsArea,
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
                            me.fireEvent('addFirstBasketAreaRow', me.basketContainerId);
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
                            me.fireEvent('addBasketAreaRow', me.basketContainerId, me.rowIndex);
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
                            me.fireEvent('deleteBasketAreaRow', me.basketContainerId, me.rowIndex);
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
        processSolvencyIndexField: function (productKey, useDefaults) {
            var me = this,
                solvencyIndexArea = me.getComponent('reportSolvencyIndexArea');
            if (Ext.isEmpty(useDefaults)) {
                useDefaults = me.useDefaults;
            }
            if (productKey === me.parentPanel.allowedCompaniesProducts.findRecord('id', me.parentPanel.productsIds.eCrefo).get('keyWS')) {
                solvencyIndexArea.html = '';
                solvencyIndexArea.add({
                    xtype: 'numberfield',
                    name: 'solvencyIndex_' + me.countryId,
                    countryId: me.countryId,
                    columnWidth: 0.70,
                    blankText: me.snippets.validation.invalidValue,
                    invalidText: me.snippets.validation.invalidValue,
                    nanText: me.snippets.validation.invalidValue,
                    minText: me.snippets.validation.invalidValue,
                    maxText: me.snippets.validation.invalidValue,
                    allowBlank: true,
                    allowDecimals: false,
                    disableKeyFilter: true,
                    allowOnlyWhitespace: false,
                    minValue: 100,
                    maxValue: 600,
                    //Remove spinner buttons, and arrow key and mouse wheel listeners
                    hideTrigger: true,
                    keyNavEnabled: false,
                    mouseWheelEnabled: false,
                    enforceMaxLength: true,
                    maxLength: 3,
                    maskRe: /\d/,
                    validateOnBlur: false,
                    validateOnChange: false,
                    vtype: 'solvencyIndexVType',
                    listeners: {
                        'afterrender': function () {
                            this.allowBlank = false;
                            if (!Ext.isEmpty(me.productRecord) && !Ext.isEmpty(me.productRecord.get('hasSolvencyIndex')) && !Ext.isEmpty(me.productRecord.get('thresholdIndex')) &&
                              me.productRecord.get('hasSolvencyIndex') && !useDefaults) {
                                this.setValue(me.productRecord.get('thresholdIndex'));
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
                        },
                        validitychange: function (field, isValid) {
                            if (!isValid) {
                                me.parentPanel.fireEvent('tabHasError', field.countryId);
                            }
                        }
                    }
                });
                solvencyIndexArea.add({
                    xtype: 'container',
                    html: '&nbsp;',
                    columnWidth: me.parentPanel.columnWidthLayout.gap
                });
            } else {
                solvencyIndexArea.html = '&nbsp;';
            }
        }
    });
//{/block}
