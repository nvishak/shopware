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
//{block name="backend/app/crefo_util"}
Ext.define('CrefoUtil', {
    extend: 'Enlight.app.SubApplication',
    singleton: true,
    name: 'CrefoUtil',
    alias: 'CrefoUtil',
    loadPath: '{url action=load}',
    bulkLoad: true,
    loadSnippets: function (snippets) {
        this.snippets = snippets;
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
    },
    showStickyMessageFromError: function(e) {
        var me = this,
            errorText = '';
        if (!Ext.isEmpty(e) && Ext.isObject(e) && Ext.isDefined(e.faults)) {
            Ext.Array.each(e.faults, function (fault) {
                errorText += fault.errortext + '<br/>';
            });
            CrefoUtil.showStickyMessage(e.title, errorText);
            return;
        } else if (!Ext.isEmpty(e) && Ext.isObject(e) && Ext.isDefined(e.validationfault)) {
            errorText = me.snippets.validation.fault.title;
        } else {
            if (!Ext.isEmpty(e) && Ext.isEmpty(e.errorText)) {
                errorText = Ext.isEmpty(e.title) || e.title === '' ? me.snippets.generalError : e.title;
            } else {
                errorText = !Ext.isEmpty(e) ? e.errorText : me.snippets.generalError;
            }
        }
        me.showStickyMessage('', errorText);
    },
    showStickyMessage: function(title, text) {
        var opts = {
            title: title,
            text: text
        };
        Shopware.Notification.createStickyGrowlMessage(opts, this.snippets.main);
    },
    handleFailure: function(window, endLoadingScreen) {
        if (endLoadingScreen) {
            window.setLoading(!endLoadingScreen);
        }
    },
    handleSoapErrors: function(errors, formPnl) {
        var me = this;
        if (Ext.isArray(errors) === false && Ext.isObject(errors) === false) {
            return;
        }
        if (!Ext.isEmpty(errors.errorCode)) {
            var errorText = me.snippets.generalError;
            if (Ext.isEmpty(errors.errorText)) {
                errorText = Ext.isEmpty(errors.title) || errors.title === '' ? me.snippets.generalError : errors.title;
            } else {
                errorText = errors.errorText;
            }
            me.showStickyMessage('', errorText);
            return;
        }
        if (!Ext.isEmpty(errors.validationfault)) {
            var validationFault = me.snippets.validation.fault.contactText;
            me.showStickyMessage(me.snippets.validation.fault.title, validationFault);
            return;
        }

        if (!Ext.isEmpty(errors.faults)) {
            var errorsText, index;
            for (index = 0; index < errors.faults.length; index++) {
                var fault = errors.faults[ index ];
                if (Ext.isDefined(fault.errorfield) && Ext.isDefined(formPnl) && Ext.isDefined(formPnl.down('textfield[name=' + fault.errorfield + ']'))) {
                    var component = formPnl.down('textfield[name=' + fault.errorfield + ']');
                    component.markInvalid(fault.errortext);
                } else {
                    if (errorsText === undefined) errorsText = '';
                    errorsText += Ext.isDefined(fault.errorFieldLabel) ? fault.errorFieldLabel + ': ' : '';
                    errorsText += fault.errortext + '<br/>';
                }
            }
            me.showStickyMessage(errors.title, errorsText);
        }
    },
    isJson: function(str) {
        try {
            Ext.JSON.decode(str, false);
            return true;
        } catch (e) {
            return false;
        }
    },
    getArrayFromObject: function(objectToArray) {
        return Object.keys(objectToArray).map(
            function(key) {
                return objectToArray[ key ];
            }
        );
    },
    isFormValid: function(formPnl) {
        var me = this;
        if (!formPnl.getForm().isValid()) {
            formPnl.getForm().getFields().each(function(f) {
                f.validate();
            });
            me.showStickyMessage('', me.snippets.validation.error);
            return false;
        }
        return true;
    },
    addBodyContainer: function (parent, className, args) {
        parent.add(Ext.create(className, args));
    },
    removeBodyContainer: function (parent, id) {
        var child = Ext.getCmp(id);
        if (Ext.isDefined(child)) {
            parent.remove(child, true);
        }
    },
    createHelp: function (cmp) {
        var helpIcon = new Ext.Element(document.createElement('span')),
            row = new Ext.Element(document.createElement('td'));

        row.set({ width: 24, valign: 'top' });
        helpIcon.set({ cls: Ext.baseCSSPrefix + 'form-help-icon' });
        helpIcon.appendTo(row);

        Ext.tip.QuickTipManager.register({
            target: helpIcon,
            cls: Ext.baseCSSPrefix + 'form-tooltip',
            title: (cmp.helpTitle) ? cmp.helpTitle : '',
            text: cmp.helpText,
            width: (cmp.helpWidth) ? cmp.helpWidth : 225,
            anchorToTarget: true,
            anchor: 'right',
            anchorSize: {
                width: 24,
                height: 24
            },
            defaultAlign: 'tr',
            showDelay: cmp.helpTooltipDelay,
            dismissDelay: cmp.helpTooltipDismissDelay
        });
        row.appendTo(cmp.inputRow);
        cmp.helpIconEl = helpIcon;
        return helpIcon;
    }
});
//{/block}
