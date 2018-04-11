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
//{block name="backend/crefo_configuration/view/tabs/accounts/panel"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.accounts.Panel', {
	extend : 'Ext.panel.Panel',
	alias : 'widget.crefoconfig-tabs-accounts-panel',
	layout: 'border',
	initComponent : function() {
		var me = this;
        me.accountsInUseStore = Ext.create('Shopware.apps.CrefoConfiguration.store.AccountsInUse');
		me.items = [
			{
				xtype:'crefoconfig-tabs-accounts-list',
				accountStore: me.accountStore,
                accountsInUseStore: me.accountsInUseStore
			}
		];

		me.callParent(arguments);
	}
});
// {/block}
