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
//{block name="backend/crefo_orders/view/batch/list"}
Ext.define('Shopware.apps.CrefoOrders.view.batch.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.crefo-batch-list',
    cls: Ext.baseCSSPrefix + 'crefo-orders-batch-grid',
    minHeight: 150,
    flex: 1,
    autoScroll: false,
    snippets: {
        columns: {
            number: '{s name="crefoorders/view/batch/list/columns/order/number"}Bestellnummer{/s}',
            orderStatus: '{s name="crefoorders/view/batch/list/columns/order/status"}Aktueller Bestellstatus{/s}',
            paymentStatus: '{s name="crefoorders/view/batch/list/columns/payment"}Aktueller Zahlungsstatus{/s}',
            orderTime: '{s name="crefoorders/view/batch/list/columns/order/time"}Bestell-Zeit{/s}',
            report: '{s name="crefoorders/view/batch/list/columns/report"}Bonität{/s}',
            collection: '{s name="crefoorders/view/batch/list/columns/collection"}Inkasso{/s}'
        },
        solvencyAnswers: {
            error: '{s name="crefoorders/view/list/col/solvency/answers/fault"}Error{/s}',
            noValue: '{s name="crefoorders/view/list/col/solvency/answers/novalue"}Kein Wert{/s}',
            white: '{s name="crefoorders/view/list/col/solvency/answers/RIJM-10"}Weiß{/s}',
            black: '{s name="crefoorders/view/list/col/solvency/answers/RIJM-30"}Schwarz{/s}',
            for: '{s name="crefoorders/view/list/col/solvency/answers/for"}für{/s}'
        },
        solvencyResults: {
            passed: '{s name="crefoorders/view/list/col/solvency/results/passed"}Bestanden{/s}',
            rejected: '{s name="crefoorders/view/list/col/solvency/results/rejected"}Abgelehnt{/s}'
        },
        collectionAnswers: {
            documentType: {
                proposal: '{s name="crefoorders/view/list/col/collection/answers/doc/proposal"}Vorschlag{/s}',
                errorText: '{s name="crefoorders/view/list/col/collection/answers/doc/error"}Error{/s}',
                toEdit: '{s name="crefoorders/view/list/col/collection/answers/doc/edit"}Bearbeitung erforderlich{/s}',
                toEditError: '{s name="crefoorders/view/list/col/collection/answers/doc/editError"}Error{/s}'
            }
        },
        fault: 'fault'
    },

    initComponent: function() {
        var me = this;

        me.columns = me.getColumns();
        me.callParent(arguments);
    },

    getColumns: function() {
        var me = this;

        return [
            {
                header: me.snippets.columns.number,
                dataIndex: 'number',
                flex: 1
            },
            {
                header: me.snippets.columns.orderTime,
                xtype: 'datecolumn',
                dataIndex: 'orderTime',
                flex: 1
            },
            {
                header: me.snippets.columns.orderStatus,
                dataIndex: 'orderStatus',
                flex: 1,
                renderer: me.orderStatusColumn
            },
            {
                header: me.snippets.columns.paymentStatus,
                dataIndex: 'paymentStatus',
                flex: 1,
                renderer: me.paymentStatusColumn
            },
            {
                header: me.snippets.columns.report,
                dataIndex: 'report',
                flex: 1,
                renderer: me.reportColumn
            },
            {
                header: me.snippets.columns.collection,
                dataIndex: 'collection',
                flex: 1,
                renderer: me.collectionColumn
            }
        ];
    },
    reportColumn: function(value, metaData, record) {
        var me = this,
            report = record.getAssociatedData().crefoReportResults,
            solvencyId = record.get('solvencyId');
        if (Ext.isEmpty(report) || Ext.isEmpty(solvencyId)) {
            return value;
        }
        if (Ext.isEmpty(report.privatePersonResult)) {
            return me.renderIdentificationSolvency(value, report);
        } else {
            return me.renderBonimaSolvency(value, report);
        }
    },
    renderIdentificationSolvency: function(value, report) {
        var me = this,
            returnValue = value;
        if (report !== null && report !== Ext.undefined) {
            if (report.textReportName === me.snippets.fault) {
                returnValue = me.snippets.solvencyAnswers.error;
            } else if (report.textReportName === 'novalue') {
                returnValue = me.snippets.solvencyAnswers.noValue + '<br/>' + (report.successfulSolvency ? me.snippets.solvencyResults.passed : me.snippets.solvencyResults.rejected);
            } else if (report.textReportName === 'RIJM-10') {
                returnValue = me.snippets.solvencyAnswers.white;
                if (report.indexThreshold > 0) {
                    returnValue += ' ' + me.snippets.solvencyAnswers.for + ' ' + report.indexThreshold;
                }
                returnValue += '<br/>' + (report.successfulSolvency ? me.snippets.solvencyResults.passed : me.snippets.solvencyResults.rejected);
            } else if (report.textReportName === 'RIJM-30') {
                returnValue = me.snippets.solvencyAnswers.black;
                if (report.indexThreshold > 0) {
                    returnValue += ' ' + me.snippets.solvencyAnswers.for + ' ' + report.indexThreshold;
                }
                returnValue += '<br/>' + (report.successfulSolvency ? me.snippets.solvencyResults.passed : me.snippets.solvencyResults.rejected);
            }
        }
        return returnValue;
    },
    renderBonimaSolvency: function(value, report) {
        var me = this,
            returnValue = value;
        if (report.textReportName.toLowerCase() === me.snippets.fault) {
            returnValue = me.snippets.solvencyAnswers.error;
        } else {
            returnValue = report.privatePersonResult + '<br/>' + (report.successfulSolvency ? me.snippets.solvencyResults.passed : me.snippets.solvencyResults.rejected);
        }
        return returnValue;
    },
    collectionColumn: function(value, metaData, record) {
        var me = this,
            returnValue = value,
            showText = value,
            hasExtension = false,
            hasError = false;
        if (record.getAssociatedData().crefoOrderListing !== null && record.getAssociatedData().crefoOrderListing !== Ext.undefined) {
            var orderListing = record.getAssociatedData().crefoOrderListing;
            var proposalRecord = orderListing.crefoOrderProposal;
            if (Ext.isDefined(proposalRecord)) {
                var status = proposalRecord.proposalStatus;
                var docType = proposalRecord.crefoOrderType;
                showText = (parseInt(docType) === 2) ? proposalRecord.documentNumber : me.snippets.collectionAnswers.documentType.proposal;
                hasExtension = (parseInt(docType) === 1 && parseInt(status) === 2);
                hasError = (parseInt(docType) === 1 && parseInt(status) === 0);
                if (hasError) {
                    showText = me.snippets.collectionAnswers.documentType.errorText;
                }
            }
            if (hasExtension) {
                var extensionText = Ext.String.format("&nbsp;<span data-qtip='[0]' class='sprite-exclamation' style='padding-left: 25px;'></span>", me.snippets.collectionAnswers.documentType.toEdit);
                returnValue = Ext.String.format('<span>[0]</span>[1]', showText, extensionText);
            } else {
                returnValue = showText === Ext.undefined ? showText : Ext.String.format('<span>[0]</span>', showText);
            }
        }
        return returnValue;
    },
    orderStatusColumn: function(value, metaData, record) {
        var orderStatus = record.getOrderStatus().first();

        if (orderStatus instanceof Ext.data.Model) {
            return orderStatus.get('description');
        } else {
            return value;
        }
    },
    paymentStatusColumn: function(value, metaData, record) {
        var paymentStatus = null;

        if (record && record.getPaymentStatus() instanceof Ext.data.Store && record.getPaymentStatus().first() instanceof Ext.data.Model) {
            paymentStatus = record.getPaymentStatus().first();
        }

        if (paymentStatus instanceof Ext.data.Model) {
            return paymentStatus.get('description');
        } else {
            return value;
        }
    }

});
//{/block}
