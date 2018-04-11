<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:42
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\detail\container.js" */ ?>
<?php /*%%SmartyHeaderCode:249765acda8fe51fbf3-56898024%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1b21b60378ce7f147143d725d7ea9f56cdbc176' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\detail\\container.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '249765acda8fe51fbf3-56898024',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fe5cc163_72199974',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fe5cc163_72199974')) {function content_5acda8fe5cc163_72199974($_smarty_tpl) {?>/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   Shopware
 * @package    PluginManager
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.detail.Container', {
    extend: 'Ext.container.Container',
    cls: 'plugin-manager-detail-page',
    alias: 'widget.plugin-manager-detail-page',
    padding: 30,
    minWidth: 780,

    mixins: {
        events: 'Shopware.apps.PluginManager.view.PluginHelper'
    },

    tabIndex: {
        configuration: 0,
        description: 1,
        localDescription: 2,
        changelog: 3,
        comment: 4,
        installationManual: 5
    },

    initComponent: function() {
        var me = this;

        me.items = [
            me.createMessageContainer(),
            me.createHeadlineContainer(),
            me.createTopContainer(),
            me.createInformationTab()
        ];

        me.callParent(arguments);
    },

    loadRecord: function(plugin) {
        var me = this;

        me.plugin = plugin;

        me.updateDescription(plugin);

        me.updateHeadline(plugin);

        me.updatePictures(plugin);

        me.updateComments(plugin);

        me.updateChangeLog(plugin);

        me.updateMetaData(plugin);

        me.updateConfiguration(plugin);

        me.updateInstallationManual(plugin);

        me.updateLocalDescription(plugin);

        var event = me.getPluginReloadedEventName(me.plugin);
        Shopware.app.Application.on(event, me.pluginReloadedEventListener, this);

        event = me.getPluginBoughEventName(me.plugin);
        Shopware.app.Application.on(event, me.pluginBoughEventListener, this);
    },

    pluginReloadedEventListener: function(updated) {
        var me = this;

        me.updateMetaData(updated);
        me.updateConfiguration(updated);
        me.updateLocalDescription(updated);
        me.hideLoadingMask();
    },

    pluginBoughEventListener: function(bought) {
        var me = this;
        me.displayBoughtMessage();
    },

    destroy: function() {
        var me = this;

        Shopware.app.Application.removeListener(
            me.getPluginReloadedEventName(me.plugin),
            me.pluginReloadedEventListener,
            me
        );

        Shopware.app.Application.removeListener(
            me.getPluginBoughEventName(me.plugin),
            me.pluginBoughEventListener,
            me
        );

        me.callParent(arguments);
    },

    displayBoughtMessage: function() {
        var me = this;

        me.boughtMessage = Shopware.Notification.createBlockMessage(
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_bought_message','default'=>'The plugin was successfully purchased and is now ready for installation','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_bought_message','default'=>'The plugin was successfully purchased and is now ready for installation','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The plugin was successfully purchased and is now ready for installation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_bought_message','default'=>'The plugin was successfully purchased and is now ready for installation','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            'success'
        );

        me.messageContainer.add(me.boughtMessage);

        Ext.Function.defer(function() {
            try {
                me.boughtMessage.getEl().slideOut('t', { duration: 1000 });
            } catch (e) {
                me.boughtMessage.hide();
            }
        }, 6000);
    },

    updateInstallationManual: function(plugin) {
        var me = this;

        me.installationManualContainer.hide();
        me.installationManualContainer.removeAll();

        var text = plugin.get('installationManual') + '';

        if (!text || text.length <= 0) {
            me.informationTab.hideTab(me.tabIndex.installationManual);
            return
        }
        me.informationTab.showTab(me.tabIndex.installationManual);

        me.installationManualContainer.add({
            xtype: 'component',
            padding: 10,
            html: plugin.get('installationManual')
        });
        me.installationManualContainer.show();
    },

    updateConfiguration: function(plugin) {
        var me = this,
            tabIndex = me.tabIndex.description;

        me.configurationContainer.hide();
        me.configurationContainer.removeAll();

        if (plugin.get('formId') && plugin.get('installationDate') !== null) {
            me.informationTab.showTab(me.tabIndex.configuration);
            me.informationTab.navigationClick(me.tabIndex.configuration);
        } else {
            me.informationTab.hideTab(me.tabIndex.configuration);
            if (Ext.isEmpty(plugin.get('description'))) {
                tabIndex = me.tabIndex.localDescription;
            }
            me.informationTab.navigationClick(tabIndex);

            return;
        }
        me.configurationContainer.show();

        me.configurationForm = Ext.create('Shopware.form.PluginPanel', {
            padding: 10,
            formId: plugin.get('formId'),
            descriptionField: false,
            listeners: {
                'form-initialized': function(panel) {
                    if (panel && panel.items.length > 0) {
                        return;
                    }
                    me.informationTab.hideTab(me.tabIndex.configuration);
                    if (Ext.isEmpty(plugin.get('description'))) {
                        tabIndex = me.tabIndex.localDescription;
                    }
                    me.informationTab.navigationClick(tabIndex);
                }
            }
        });

        me.configurationContainer.add(me.configurationForm);

        me.toolbar = Ext.create('Ext.toolbar.Toolbar', {
            style: 'background: #fff !important',
            dock: 'bottom',
            items: ['->', {
                xtype: 'button',
                cls: 'primary save-button',
                text: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'save','default'=>'Save','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'save','default'=>'Save','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Save<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'save','default'=>'Save','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                handler: function() {
                    Shopware.app.Application.fireEvent(
                        'save-plugin-configuration',
                        plugin,
                        me.configurationForm
                    );
                }
            }]
        });

        me.configurationContainer.add(me.toolbar);
        me.configurationContainer.show();
    },

    updateLocalDescription: function(plugin) {
        var me = this;

        me.localDescriptionContainer.removeAll();

        var description = plugin.get('localDescription');

        if (!description || description.length <= 0) {
            me.informationTab.hideTab(me.tabIndex.localDescription);
            return;
        }
        me.informationTab.showTab(me.tabIndex.localDescription);

        me.localDescriptionContainer.add({
            xtype: 'component',
            html: description
        });
    },

    updateDescription: function(plugin) {
        var me = this;

        me.descriptionContainer.removeAll();

        var description = plugin.get('description');

        if (!description || description.length <= 0) {
            me.informationTab.hideTab(me.tabIndex.description);
            return;
        }

        me.informationTab.showTab(me.tabIndex.description);

        me.descriptionContainer.add({
            xtype: 'component',
            html: '<h1 class="store-plugin-detail-description-headline"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'product_information','default'=>'Product information','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product_information','default'=>'Product information','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Product information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'product_information','default'=>'Product information','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <span class="plugin-name">' + plugin.get('label') + '</span></h1>' + plugin.get('description')
        });
    },

    updateMetaData: function(plugin) {
        var me = this, content;

        me.metaDataContainer.removeAll();

        content = Ext.create('Shopware.apps.PluginManager.view.detail.Meta', {
            plugin: plugin
        });
        me.metaDataContainer.add(content);

        if (plugin.isLocalPlugin() || plugin.allowDummyUpdate()) {
            content = Ext.create('Shopware.apps.PluginManager.view.detail.Actions', {
                plugin: plugin
            });
            me.metaDataContainer.add(content);

        } else if (plugin.isAdvancedFeature()) {
            var image = '/shopware4/themes/Backend/ExtJs/backend/_resources/resources/themes/images/shopware-ui/plugin_manager/advanced_feature_icon.png';
            content = Ext.create('Ext.container.Container', {
                html: '<img src="' + image + '">' +
                      '<span class="advanced-feature-notice"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'advanced_feature_notice','default'=>'Advanced features are part of the professional and enterprise editions','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'advanced_feature_notice','default'=>'Advanced features are part of the professional and enterprise editions','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Advanced features are part of the professional and enterprise editions<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'advanced_feature_notice','default'=>'Advanced features are part of the professional and enterprise editions','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>',
                cls: 'advanced-feature-container'
            });
            me.metaDataContainer.add(content);
        } else {
            me.pricesContainer = Ext.create('Shopware.apps.PluginManager.view.detail.Prices', {
                prices: plugin['getPricesStore'],
                plugin: plugin
            });

            me.metaDataContainer.add(me.pricesContainer);

            me.metaDataContainer.add({
                xtype: 'component',
                cls: 'store-plugin-detail-star-description',
                html: '* <?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'vat_info','default'=>'All prices excl. VAT','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'vat_info','default'=>'All prices excl. VAT','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
All prices excl. VAT<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'vat_info','default'=>'All prices excl. VAT','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            });
        }
    },

    updateHeadline: function(plugin) {
        var me = this;

        var content = Ext.create('Shopware.apps.PluginManager.view.detail.Header', {
            plugin: plugin
        });

        me.headlineContainer.removeAll();
        me.headlineContainer.add(content);
    },

    updatePictures: function(plugin) {
        var me = this;

        var content = Ext.create('Shopware.apps.PluginManager.view.components.ImageSlider', {
            store: plugin['getPicturesStore'],
            flex: 1
        });

        me.pictureContainer.removeAll();

        me.pictureContainer.add(content);
    },

    updateComments: function(plugin) {
        var me = this;

        var comments = Ext.create('Shopware.apps.PluginManager.view.detail.Comments', {
            plugin: plugin
        });

        if (comments.commentCount <= 0) {
            me.informationTab.hideTab(me.tabIndex.comment);
            return;
        } else {
            me.informationTab.showTab(me.tabIndex.comment);
        }

        me.commentContainer.add(comments);
    },

    updateChangeLog: function(plugin) {
        var me = this, items = [];

        me.changelogContainer.removeAll();

        var changelog = plugin.get('changelog');

        if (!changelog || changelog.length <= 0) {
            me.informationTab.hideTab(me.tabIndex.changelog);
            return;
        }

        me.informationTab.showTab(me.tabIndex.changelog);

        Ext.each(changelog, function(value) {
            var version = value.version;

            if (value.creationDate) {
                var date = me.formatDate(value.creationDate.date);
                version = version + '<div class="date">' + Ext.util.Format.date(date) + '</div>';
            }

            items.push({
                xtype: 'container',
                cls: 'changelog',
                layout: { type: 'hbox', align: 'stretch' },
                items: [{
                    xtype: 'component',
                    cls: 'version',
                    html: 'v ' + version,
                    width: 120
                }, {
                    xtype: 'component',
                    cls: 'version-changelog',
                    html: value.text,
                    flex: 1
                }]
            });
        });

        me.changelogContainer.add(items);
        me.changelogContainer.enable();
    },

    createMessageContainer: function() {
        var me = this;

        me.messageContainer = Ext.create('Ext.container.Container', {
            cls: 'message-container',
            margin: '0 0 20',
            items: []
        });

        return me.messageContainer;
    },

    createHeadlineContainer: function() {
        var me = this;

        me.headlineContainer = Ext.create('Ext.container.Container', {
            height: 130,
            margin: '0 0 15',
            layout: { type: 'hbox', align: 'stretch' },
            items: [ ]
        });

        return me.headlineContainer;
    },

    createTopContainer: function() {
        var me = this;

        me.pictureContainer = Ext.create('Ext.container.Container', {
            width: 430,
            height: 400,
            layout: { type: 'vbox', align: 'stretch' },
            items: [ ]
        });

        me.metaDataContainer = Ext.create('Ext.container.Container', {
            flex: 1,
            cls: 'store-plugin-detail-meta-data-wrapper',
            layout: { type: 'vbox', align: 'stretch' },
            items: [ ]
        });

        return Ext.create('Ext.container.Container', {
            height: 400,
            margin: '0 0 50',
            layout: { type: 'hbox', align: 'stretch' },
            items: [
                me.headlineContainer,
                me.pictureContainer,
                me.metaDataContainer
            ]
        });
    },

    createInformationTab: function() {
        var me = this;

        me.configurationContainer = Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configuration','default'=>'Configuration','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration','default'=>'Configuration','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Configuration<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configuration','default'=>'Configuration','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'store-plugin-detail-configuration-container',
            flex: 1,
            layout: {
                type: 'vbox',
                align: 'stretch'
            }
        });

        me.changelogContainer = Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'changelog','default'=>'Change log','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'changelog','default'=>'Change log','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Change log<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'changelog','default'=>'Change log','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'store-plugin-detail-changelog-container',
            flex: 1,
            layout: {
                type: 'vbox',
                align: 'stretch'
            }
        });

        me.installationManualContainer = Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'installation_manual','default'=>'Installation manual','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'installation_manual','default'=>'Installation manual','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Installation manual<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'installation_manual','default'=>'Installation manual','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'store-plugin-detail-installation-manual-container',
            flex: 1,
            layout: {
                type: 'vbox',
                align: 'stretch'
            }
        });

        me.descriptionContainer = Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'description','default'=>'Description','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'description','default'=>'Description','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'description','default'=>'Description','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'plugin-description-container',
            flex: 1,
            layout: {
                type: 'vbox',
                align: 'stretch'
            }
        });

        me.localDescriptionContainer = Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'local_description','default'=>'Plugin description','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'local_description','default'=>'Plugin description','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Plugin description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'local_description','default'=>'Plugin description','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            cls: 'plugin-local-description-container',
            flex: 1,
            layout: { type: 'vbox', align: 'stretch' }
        });

        me.commentContainer = Ext.create('Ext.container.Container', {
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'comments','default'=>'Comments','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'comments','default'=>'Comments','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Comments<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'comments','default'=>'Comments','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            flex: 1,
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            cls: 'plugin-comment-container'
        });

        me.informationTab = Ext.create('PluginManager.tab.Panel', {
            margin: '0 0 25',
            items: [
                me.configurationContainer,
                me.descriptionContainer,
                me.localDescriptionContainer,
                me.changelogContainer,
                me.commentContainer,
                me.installationManualContainer
            ]
        });

        return me.informationTab;
    }

});
//<?php }} ?>