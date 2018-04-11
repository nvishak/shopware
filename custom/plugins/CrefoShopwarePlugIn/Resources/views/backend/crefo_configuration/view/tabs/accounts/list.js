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
//{block name="backend/crefo_configuration/view/tabs/accounts/list"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.accounts.List', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.crefoconfig-tabs-accounts-list',
    height: '100%',
    region: 'center',
    autoScroll: false,
    //Event listeners
    listeners: {
        scope: this,

        afterrender: function(editor, eOpts) {

        }
    },
    snippets: {
        buttons: {
            row: {
                delAccount: '{s name="crefoconfig/view/tabs/accounts/list/row/tooltips/del_account"}Delete User Account{/s}',
                edtAccount: '{s name="crefoconfig/view/tabs/accounts/list/row/tooltips/edt_account"}Edit User Account{/s}',
                chgPassAccount: '{s name="crefoconfig/view/tabs/accounts/list/row/tooltips/chg_pass_account"}Change Password{/s}'
            },
            tb: {
                addAccount: '{s name="crefoconfig/view/tabs/accounts/list/top/buttons/add_account"}Add User Account{/s}',
                deleteAccounts: '{s name="crefoconfig/view/tabs/accounts/list/top/buttons/del_accounts"}Delete selected account(s){/s}'
            }
        },
        colheaders: {
            accounts: '{s name="crefoconfig/view/tabs/accounts/list/columns/header_account"}User Account{/s}',
            options: '{s name="crefoconfig/view/tabs/accounts/list/columns/header_options"}Options{/s}'
        },
        tooltips: {
            deleteAccounts: '{s name="crefoconfig/view/tabs/accounts/list/top/tooltips/del_accounts"}An account can be deleted only when it is not in use.{/s}'
        }
    },

    /**
     * Initialize the view components
     *
     * @return void
     */
    initComponent: function() {
        var me = this;
        //me.accountsInUseStore= me.accountsInUseStore;
        me.registerEvents();
        me.store = me.accountStore;

        this.selModel = Ext.create('Ext.selection.CheckboxModel', {
            listeners: {
                //Unlocks the delete button if the user has checked at least one checkbox
                selectionchange: function(sm, selections) {
                    var owner = this.view.ownerCt,
                        btn = owner.down('button[action=deleteAccounts]');
                    if (selections.length > 0) {
                        var hasDeletableAccounts = true;
                        for (var i = 0; i < selections.length; i++) {
                            if (me.accountsInUseStore.findRecord('id', selections[i].data.id) !== null) {
                                hasDeletableAccounts = false;
                            }
                        }
                        btn.setDisabled(!hasDeletableAccounts);
                    } else {
                        btn.setDisabled(true);
                    }
                }
            }
        });

        var buttons = [];

        buttons.push({
            iconCls: 'sprite-minus-circle',
            action: 'deleteAccount',
            cls: 'delete',
            tooltip: me.snippets.buttons.row.delAccount,
            handler: function (view, rowIndex, colIndex, item) {
                me.fireEvent('deleteAccount', view, rowIndex, colIndex, item);
            },
            getClass: function(value, metaData, record) {
                if (record.allowAccountDelete(me.accountsInUseStore)) {
                    return Ext.baseCSSPrefix + 'hidden';
                }
            }
        });

        buttons.push({
            iconCls: 'sprite-user--pencil',
            cls: 'editBtn',
            action: 'editAccount',
            tooltip: me.snippets.buttons.row.edtAccount,
            handler: function (view, rowIndex, colIndex, item) {
                me.fireEvent('editAccount', view, rowIndex, colIndex, item);
            }});

        buttons.push({
            iconCls: 'sprite-license-key',
            action: 'changePassAccount',
            tooltip: me.snippets.buttons.row.chgPassAccount,
            handler: function (view, rowIndex, colIndex, item) {
                me.fireEvent('changePassAccount', view, rowIndex, me.accountsInUseStore, colIndex, item);
            }});

        me.dockedItems = this.createDockedToolBar();

        //Define the columns and renderers
        this.columns = [
            {
                header: me.snippets.colheaders.accounts,
                dataIndex: 'useraccount',
                width: '85%'
            }, {
                xtype: 'actioncolumn',
                header: me.snippets.colheaders.options,
                flex: 1,
                items: buttons
            }];

        var tbButtons = [];

        tbButtons.push({
            iconCls: 'sprite-plus-circle',
            text: me.snippets.buttons.tb.addAccount,
            action: 'addAccount',
            handler: function() {
                me.fireEvent('addAccount', me);
            }
        });

        tbButtons.push({
            iconCls: 'sprite-minus-circle',
            text: me.snippets.buttons.tb.deleteAccounts,
            disabled: true,
            action: 'deleteAccounts',
            tooltip: me.snippets.tooltips.deleteAccounts,
            handler: function() {
                me.fireEvent('deleteAccounts', me);
            }
        });

        //Toolbar
        this.toolbar = Ext.create('Ext.toolbar.Toolbar', {
            dock: 'top',
            ui: 'shopware-ui',
            items: tbButtons
        });

        me.dockedItems = Ext.clone(this.dockedItems);
        me.dockedItems.push(this.toolbar);

        this.callParent();
    },
    registerEvents: function () {
        this.addEvents(

            /**
             * Event will be fired when the user clicks the delete icon in the
             * action column
             *
             * @event deleteColumn
             * @param [object] View - Associated Ext.view.Table
             * @param [integer] rowIndex - Row index
             * @param [integer] colIndex - Column index
             * @param [object] item - Associated HTML DOM node
             */
            'deleteAccount',

            /**
             * Event will be fired when the user clicks the edit icon in the
             * action column
             *
             * @event editColumn
             * @param [object] View - Associated Ext.view.Table
             * @param [integer] rowIndex - Row index
             * @param [integer] colIndex - Column index
             * @param [object] item - Associated HTML DOM node
             */
            'editAccount',
            /**
             * Event will be fired when the user clicks the licence key icon in the
             * action column
             *
             * @event changePasswordColumn
             * @param [object] View - Associated Ext.view.Table
             * @param [integer] rowIndex - Row index
             * @param [integer] colIndex - Column index
             * @param [object] item - Associated HTML DOM node
             */
            'changePassAccount'
        );

        return true;
    },
    /**
     * Create paging toolbar for grid view
     * @return [Array]
     */
    createDockedToolBar: function() {
        return [{
            dock: 'bottom',
            xtype: 'pagingtoolbar',
            displayInfo: true,
            store: this.accountStore
        }];
    }
});
//{/block}
