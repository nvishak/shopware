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
//{block name="backend/crefo_configuration/view/tabs/general/container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.general.Container',
    {
        extend: 'Ext.container.Container',
        autoShow: true,
        alias: 'widget.crefoconfig-tabs-general-container',
        region: 'center',
        autoScroll: false,
        name: 'generalCrefoContainer',
        border: 0,
        ui: 'shopware-ui',
        layout: 'anchor',
        defaults: {
            labelWidth: 210,
            labelStyle: 'font-weight: 700;',
            anchor: '100%'
        },
        hidden: false,
        minWidth: 155,
        snippets: {
            lang: {
                english: '{s name="crefoconfig/view/tabs/general/panel/language_en"}English{/s}',
                german: '{s name="crefoconfig/view/tabs/general/panel/language_de"}German{/s}'
            },
            maxNumReq: {
                value_0: '1000',
                value_1: '5000',
                value_2: '10000'
            },
            maxTimeLogs: {
                months_6: '{s name="crefoconfig/view/tabs/general/panel/months6"}6 Months{/s}',
                months_12: '{s name="crefoconfig/view/tabs/general/panel/months12"}12 Months{/s}',
                months_18: '{s name="crefoconfig/view/tabs/general/panel/months18"}18 Months{/s}'
            },
            reqCheckAmount: {
                value_0: '10',
                value_1: '50',
                value_2: '100',
                value_3: '500',
                value_4: '1000'
            },
            errTolerance: {
                value_0: '25%',
                value_1: '50%',
                value_2: '75%'
            },
            labels: {
                commlang: '{s name="crefoconfig/view/tabs/general/panel/labels/commLang"}Communication Language{/s}',
                maxNumReq: '{s name="crefoconfig/view/tabs/general/panel/labels/maxNumReq"}Crefo Logs: Max Number of Request{/s}',
                maxTimeLogs: '{s name="crefoconfig/view/tabs/general/panel/labels/maxTimeLogs"}Crefo Logs: Max Storage Time{/s}',
                activateNotif: '{s name="crefoconfig/view/tabs/general/panel/labels/activateNotif"}Activate Error Notification{/s}',
                email: '{s name="crefoconfig/view/tabs/general/panel/labels/email"}Email Address{/s}',
                reqCheckAmount: '{s name="crefoconfig/view/tabs/general/panel/labels/reqCheckAmount"}Request Check Amount{/s}',
                errTolerance: '{s name="crefoconfig/view/tabs/general/panel/labels/errTolerance"}Error Tolerance{/s}',
                consentDeclaration: '{s name="crefoconfig/view/tabs/general/panel/labels/consentDeclaration"}Einwilligungserklärung im WebShop aktivieren{/s}',
                consentDeclarationText: '{s name="crefoconfig/view/tabs/general/panel/labels/consentDeclarationText"}Die Einwilligungserklärung darf nur deaktiviert werden, wenn die allgemeinen Geschäftsbedingungen eine Einwilligungserklärung zur Bonitätsprüfung enthalten und wenn der Kunde die allgemeinen Geschäftsbedingungen vor Kaufabschluss zur Kenntnis genommen hat.{/s}'
            },
            tooltips: {
                announcementPerEmail: '{s name="crefoconfig/view/tabs/general/panel/tooltips/announcementPerEmail1"}Wenn Sie die Fehler-Benachrichtung aktivieren, dann zählt die Software die bei Creditreform angefragten Bonitätsprüfungen und die daraus resultierenden Fehlermeldungen und berechnet daraus eine Fehlerquote. Diese Informationen können Sie mit Klick auf den Button &quot;Aktueller Fehlerstand&quot; einsehen. Sie werden per Email benachrichtigt, wenn die eingestellte Anfragen-Prüfmenge erreicht ist und die Fehlertoleranz gleichzeitig überschritten ist.{/s}' +
                '<br />' +
                '{s name="crefoconfig/view/tabs/general/panel/tooltips/announcementPerEmail2"}Nach Erreichen der Anfragen-Prüfmenge wird der Fehlerstand automatisch zurückgesetzt. Gleiches gilt nach dem Versand einer Email und nach Änderung der Einstellungen.{/s}'
            },
            btn: {
                statusErrNotification: '{s name="crefoconfig/view/tabs/general/panel/buttons/currentErrorStatus"}Current Error Status{/s}'
            },
            validation: {
                email: '{s name="crefo/validation/invalidValue"}Invalid Value{/s}'
            }
        },
        useDBValues: true,
        config: {
            communicationLanguage: 'de',
            consentDeclaration: true,
            logsMaxNumberOfRequest: 0,
            logsMaxStorageTime: 2,
            errorNotificationStatus: false,
            emailAddress: Ext.undefined,
            requestCheckAtValue: 2,
            errorTolerance: 1
        },
        /**
         * This function is called, when the component is initiated
         * It creates the columns of the grid
         */
        initComponent: function() {
            var me = this;
            me.items = me.getItems();

            me.addEvents('showErrorNotificationStatus');
            me.callParent(arguments);
        },
        createDescriptionContainer: function(html, style) {
            if (style === null || !Ext.isDefined(style)) {
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
        getItems: function() {
            var me = this;
            return [
                {
                    fieldLabel: me.snippets.labels.commlang,
                    name: 'communicationLanguage',
                    itemId: 'communicationLanguage',
                    xtype: 'combobox',
                    anchor: '100%',
                    labelWidth: '30%',
                    forceSelection: true,
                    allowBlank: false,
                    editable: false,
                    store: me.getCommunicationLanguageStore(),
                    queryMode: 'local',
                    displayField: 'label',
                    valueField: 'id',
                    listeners: {
                        beforerender: function () {
                            if (me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) && !Ext.isEmpty(me.parentPanel.generalStore.first().get('communicationLanguage'))) {
                                this.setValue(me.parentPanel.generalStore.first().get('communicationLanguage'));
                            } else {
                                this.setValue(me.getCommunicationLanguage());
                            }
                        }
                    }
                },
                {
                    fieldLabel: me.snippets.labels.consentDeclaration,
                    xtype: 'fieldcontainer',
                    anchor: '100%',
                    labelWidth: '30%',
                    layout: 'hbox',
                    defaultType: 'checkboxfield',
                    items: [
                        {
                            xtype: 'checkboxfield',
                            name: 'consentDeclaration',
                            itemId: 'consentDeclaration',
                            id: 'consentDeclaration',
                            inputValue: '1',
                            listeners: {
                                beforerender: function () {
                                    if (me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) && !Ext.isEmpty(me.parentPanel.generalStore.first().get('consentDeclaration'))) {
                                        this.setValue(me.parentPanel.generalStore.first().get('consentDeclaration'));
                                    } else {
                                        this.setValue(me.getConsentDeclaration());
                                    }
                                }
                            }
                        }
                    ]
                },
                {
                    xtype: me.createDescriptionContainer(me.snippets.labels.consentDeclarationText)
                },
                {
                    xtype: me.createDescriptionContainer('')
                },
                {
                    xtype: me.createDescriptionContainer('')
                },
                {
                    fieldLabel: me.snippets.labels.maxNumReq,
                    name: 'logsMaxNumberOfRequest',
                    itemId: 'logsMaxNumberOfRequest',
                    xtype: 'combobox',
                    anchor: '100%',
                    forceSelection: true,
                    allowBlank: false,
                    editable: false,
                    labelWidth: '30%',
                    store: me.getMaxNumberOfRequestsStore(),
                    queryMode: 'local',
                    mode: 'local',
                    displayField: 'label',
                    valueField: 'id',
                    listeners: {
                        beforerender: function () {
                            if (me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) && !Ext.isEmpty(me.parentPanel.generalStore.first().get('logsMaxNumberOfRequest'))) {
                                this.setValue(me.parentPanel.generalStore.first().get('logsMaxNumberOfRequest'));
                            } else {
                                this.setValue(parseInt(me.getLogsMaxNumberOfRequest()));
                            }
                        }
                    }
                },
                {
                    fieldLabel: me.snippets.labels.maxTimeLogs,
                    name: 'logsMaxStorageTime',
                    itemId: 'logsMaxStorageTime',
                    xtype: 'combobox',
                    anchor: '100%',
                    labelWidth: '30%',
                    forceSelection: true,
                    allowBlank: false,
                    editable: false,
                    store: me.getMaxTimeLogsStore(),
                    queryMode: 'local',
                    mode: 'local',
                    displayField: 'label',
                    valueField: 'id',
                    listeners: {
                        beforerender: function () {
                            if (me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) && !Ext.isEmpty(me.parentPanel.generalStore.first().get('logsMaxStorageTime'))) {
                                this.setValue(me.parentPanel.generalStore.first().get('logsMaxStorageTime'));
                            } else {
                                this.setValue(parseInt(me.getLogsMaxStorageTime()));
                            }
                        }
                    }
                },
                {
                    xtype: me.createDescriptionContainer('')
                },
                {
                    fieldLabel: me.snippets.labels.activateNotif,
                    xtype: 'fieldcontainer',
                    itemId: 'notificationFieldContainer',
                    anchor: '100%',
                    labelWidth: '30%',
                    layout: 'hbox',
                    helpText: me.snippets.tooltips.announcementPerEmail,
                    defaultType: 'checkboxfield',
                    items: [
                        {
                            name: 'errorNotificationStatus',
                            itemId: 'errorNotificationStatus',
                            id: 'general_error_notification',
                            inputValue: '1',
                            listeners: {
                                'afterrender': function() {
                                    if (me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) && !Ext.isEmpty(me.parentPanel.generalStore.first().get('errorNotificationStatus'))) {
                                        this.setValue(me.parentPanel.generalStore.first().get('errorNotificationStatus'));
                                    } else {
                                        this.setValue(me.getErrorNotificationStatus());
                                    }
                                },
                                'change': function(checkbox, newValue, oldValue, eOpts) {
                                    me.toggleNotificationArea(newValue);
                                    me.toggleNotificationStatusButton(newValue);
                                }
                            }
                        }
                    ],
                    listeners: {
                        afterrender: function (cmp) {
                            if (cmp.helpText) {
                                CrefoUtil.createHelp(cmp);
                                cmp.helpIconEl.dom.style.marginLeft = '5px';
                            }
                        }
                    }
                }
            ];
        },
        getCommunicationLanguageStore: function() {
            var me = this;
            return new Ext.data.SimpleStore({
                fields: [ 'id', 'label' ],
                data: [
                    [ 'de', me.snippets.lang.german ],
                    [ 'en', me.snippets.lang.english ]
                ]
            });
        },
        getMaxNumberOfRequestsStore: function() {
            var me = this;
            return new Ext.data.SimpleStore({
                fields: [ 'id', 'label' ],
                data: [
                    [ 0, me.snippets.maxNumReq.value_0 ],
                    [ 1, me.snippets.maxNumReq.value_1 ],
                    [ 2, me.snippets.maxNumReq.value_2 ]
                ]
            });
        },
        getMaxTimeLogsStore: function() {
            var me = this;
            return new Ext.data.SimpleStore({
                fields: [ 'id', 'label' ],
                data: [
                    [ 0, me.snippets.maxTimeLogs.months_6 ],
                    [ 1, me.snippets.maxTimeLogs.months_12 ],
                    [ 2, me.snippets.maxTimeLogs.months_18 ]
                ]
            });
        },
        getRequestAmountStore: function() {
            var me = this;
            return new Ext.data.SimpleStore({
                fields: [ 'id', 'label' ],
                data: [
                    [ 0, me.snippets.reqCheckAmount.value_0 ],
                    [ 1, me.snippets.reqCheckAmount.value_1 ],
                    [ 2, me.snippets.reqCheckAmount.value_2 ],
                    [ 3, me.snippets.reqCheckAmount.value_3 ],
                    [ 4, me.snippets.reqCheckAmount.value_4 ]
                ]
            });
        },
        getErrToleranceStore: function() {
            var me = this;
            return new Ext.data.SimpleStore({
                fields: [ 'id', 'label' ],
                data: [
                    [ 0, me.snippets.errTolerance.value_0 ],
                    [ 1, me.snippets.errTolerance.value_1 ],
                    [ 2, me.snippets.errTolerance.value_2 ]
                ]
            });
        },
        toggleNotificationArea: function (show) {
            var me = this,
                emailAddress = Ext.getCmp('general_email_address'),
                checkAtAmount = Ext.getCmp('general_request_check_at_value'),
                errorTolerance = Ext.getCmp('general_error_tolerance');
            if (Ext.isDefined(emailAddress)) {
                me.remove(emailAddress, true);
            }
            if (Ext.isDefined(checkAtAmount)) {
                me.remove(checkAtAmount, true);
            }
            if (Ext.isDefined(errorTolerance)) {
                me.remove(errorTolerance, true);
            }
            if (show) {
                var valueEmail = me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) &&
                !Ext.isEmpty(me.parentPanel.generalStore.first().get('emailAddress')) ? me.parentPanel.generalStore.first().get('emailAddress') : me.getEmailAddress();
                var valueCheckAtAmount = me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) &&
                !Ext.isEmpty(me.parentPanel.generalStore.first().get('requestCheckAtValue')) ? parseInt(me.parentPanel.generalStore.first().get('requestCheckAtValue')) : me.getRequestCheckAtValue();
                var valueErrorTolerance = me.useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first()) &&
                !Ext.isEmpty(me.parentPanel.generalStore.first().get('errorTolerance')) ? parseInt(me.parentPanel.generalStore.first().get('errorTolerance')) : me.getErrorTolerance();
                me.add({
                    fieldLabel: me.snippets.labels.email,
                    emptyText: me.snippets.labels.email,
                    submitEmptyText: false,
                    xtype: 'textfield',
                    name: 'emailAddress',
                    itemId: 'emailAddress',
                    id: 'general_email_address',
                    anchor: '100%',
                    labelWidth: '30%',
                    allowBlank: false,
                    blankText: me.snippets.validation.email,
                    vtype: 'email',
                    vtypeText: me.snippets.validation.email,
                    value: valueEmail
                });
                me.add({
                    fieldLabel: me.snippets.labels.reqCheckAmount,
                    name: 'requestCheckAtValue',
                    itemId: 'requestCheckAtValue',
                    xtype: 'combobox',
                    id: 'general_request_check_at_value',
                    anchor: '100%',
                    labelWidth: '30%',
                    forceSelection: true,
                    allowBlank: false,
                    editable: false,
                    store: me.getRequestAmountStore(),
                    queryMode: 'local',
                    mode: 'local',
                    displayField: 'label',
                    valueField: 'id',
                    value: valueCheckAtAmount
                });
                me.add({
                    fieldLabel: me.snippets.labels.errTolerance,
                    name: 'errorTolerance',
                    itemId: 'errorTolerance',
                    id: 'general_error_tolerance',
                    xtype: 'combobox',
                    anchor: '100%',
                    labelWidth: '30%',
                    forceSelection: true,
                    allowBlank: false,
                    editable: false,
                    store: me.getErrToleranceStore(),
                    queryMode: 'local',
                    mode: 'local',
                    displayField: 'label',
                    valueField: 'id',
                    value: valueErrorTolerance
                });
            }
            me.useDBValues = false;
        },
        toggleNotificationStatusButton: function (show) {
            var me = this,
                notificationFieldContainer = me.getComponent('notificationFieldContainer');
            if (notificationFieldContainer.items.length > 1) {
                notificationFieldContainer.remove(notificationFieldContainer.getComponent('generalShowErrorNotificationStatus'), true);
            }
            if (show) {
                notificationFieldContainer.add({
                    text: me.snippets.btn.statusErrNotification,
                    xtype: 'button',
                    name: 'showErrorNotificationStatus',
                    id: 'general_showErrorNotificationStatus',
                    itemId: 'generalShowErrorNotificationStatus',
                    cls: 'secondary',
                    handler: function(event) {
                        me.fireEvent('showErrorNotificationStatus', event);
                    }
                });
            }
        },
        loadSettings: function (useDBValues) {
            var me = this;
            if (useDBValues && !Ext.isEmpty(me.parentPanel.generalStore.first())) {
                me.getComponent('communicationLanguage').setValue(me.parentPanel.generalStore.first().get('communicationLanguage'));
                Ext.getCmp('consentDeclaration').setValue(me.parentPanel.generalStore.first().get('consentDeclaration'));
                me.getComponent('logsMaxNumberOfRequest').setValue(me.parentPanel.generalStore.first().get('logsMaxNumberOfRequest'));
                me.getComponent('logsMaxStorageTime').setValue(me.parentPanel.generalStore.first().get('logsMaxStorageTime'));
                var errorNotificationStatus = me.parentPanel.generalStore.first().get('errorNotificationStatus');
                me.getComponent('notificationFieldContainer').getComponent('errorNotificationStatus').setValue(errorNotificationStatus);
                if (errorNotificationStatus) {
                    me.getComponent('emailAddress').setValue(me.parentPanel.generalStore.first().get('emailAddress'));
                    me.getComponent('requestCheckAtValue').setValue(me.parentPanel.generalStore.first().get('requestCheckAtValue'));
                    me.getComponent('errorTolerance').setValue(me.parentPanel.generalStore.first().get('errorTolerance'));
                }
            } else {
                me.getComponent('communicationLanguage').setValue(me.getCommunicationLanguage());
                Ext.getCmp('consentDeclaration').setValue(me.getConsentDeclaration());
                me.getComponent('logsMaxNumberOfRequest').setValue(me.getLogsMaxNumberOfRequest());
                me.getComponent('logsMaxStorageTime').setValue(me.getLogsMaxStorageTime());
                me.getComponent('notificationFieldContainer').getComponent('errorNotificationStatus').setValue(me.getErrorNotificationStatus());
            }
            me.useDBValues = false;
        }
    });
//{/block}
