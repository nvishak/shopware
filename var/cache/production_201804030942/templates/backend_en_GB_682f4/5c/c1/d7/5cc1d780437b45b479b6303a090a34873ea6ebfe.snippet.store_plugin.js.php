<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:41
         compiled from "E:\wamp\www\shopware4\engine\Shopware\Plugins\Default\Backend\PluginManager\Views\backend\plugin_manager\view\components\store_plugin.js" */ ?>
<?php /*%%SmartyHeaderCode:82885acda8fd232699-15604420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cc1d780437b45b479b6303a090a34873ea6ebfe' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\engine\\Shopware\\Plugins\\Default\\Backend\\PluginManager\\Views\\backend\\plugin_manager\\view\\components\\store_plugin.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82885acda8fd232699-15604420',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8fd2e00c0_08006390',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8fd2e00c0_08006390')) {function content_5acda8fd2e00c0_08006390($_smarty_tpl) {?>/**
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
 * @subpackage Components
 * @version    $Id$
 * @author shopware AG
 */
//

//
Ext.define('Shopware.apps.PluginManager.view.components.StorePlugin', {
    extend: 'Ext.container.Container',

    alternateClassName: 'PluginManager.components.StorePlugin',

    cls: 'store-plugin',

    alias: 'widget.plugin-manager-store-plugin',

    mixins: {
        events: 'Shopware.apps.PluginManager.view.PluginHelper'
    },

    initComponent: function() {
        var me = this, event;

        me.on('afterrender', function(comp) {
            comp.el.on('click', function(event, el) {
                if (!el.classList.contains('button')) {
                    me.onClickElement(me.record);
                }
            });
        });

        me.items = me.loadRecord(me.record);

        me.callParent(arguments);

        event = me.getPluginReloadedEventName(me.record);
        Shopware.app.Application.on(event, function(updated) {
            me.removeAll();
            me.add(me.loadRecord(updated));
            me.hideLoadingMask();
        });

    },

    onClickElement: function(record) {
        var me = this;
        me.displayPluginEvent(record);
    },

    loadRecord: function(plugin) {
        var me = this;

        me.record = plugin;

        try {
            if (plugin.allowDummyUpdate()) {
                me.addCls('dummy');
            } else if (me.hasCls('dummy')) {
                me.removeCls('dummy');
            }
        } catch (e) { }

        return [
            me.createBadges(),
            me.createRating(),
            me.createImage(),
            {
                xtype: 'container',
                cls: 'right-side',
                items: [
                    {
                        xtype: 'container',
                        cls: 'meta-information',
                        items: [
                            me.createName(),
                            me.createAuthor(),
                            me.createCertified()
                        ]
                    },
                    me.createButton()
                ]
            }
        ];
    },

    createCertified: function() {
        var me = this;

        if (!me.record.get('certified')) {
            return null;
        }

        return Ext.create('Ext.Component', {
            cls: 'certified',
            html: '<span class="icon">&nbsp;</span><span class="text"><?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'certified','default'=>'Certified','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'certified','default'=>'Certified','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Certified<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'certified','default'=>'Certified','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>'
        });
    },

    createName: function() {
        var me = this,
            name = me.record.get('label');

        return Ext.create('Ext.Component', {
            cls: 'name',
            html: Ext.util.Format.ellipsis(name, 40)
        });
    },

    createImage: function() {
        var me = this;

        return Ext.create('Ext.Component', {
            cls: 'image',
            html: '<img src="' + me.record.get('iconPath') + '" />'
        })
    },

    createAuthor: function() {
        var me = this;

        if (!me.record['getProducerStore']) {
            return null;
        }

        var producer = me.record['getProducerStore'].first();

        return Ext.create('Ext.Component', {
            cls: 'author',
            html: '<span class="prefix">' + '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'plugin_author_from','default'=>'By:','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_author_from','default'=>'By:','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
By:<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'plugin_author_from','default'=>'By:','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' + '</span> ' + Ext.util.Format.ellipsis(producer.get('name'), 25)
        });
    },

    createRating: function() {
        var me = this;

        if (me.record.get('rating') <= 0) {
            return;
        }

        return Ext.create('Ext.Component', {
            cls: 'store-plugin-rating star' + me.record.get('rating'),
            html: '&nbsp;'
        });
    },

    createBadges: function() {
        var me = this, items = [];

        var template = '' +
            '<div class="badge-circle">' +
                '<span class="badge-image">&nbsp;</span>' +
            '</div>' +
            '<div class="badge-text">';

        if (me.record.get('id')) {
            items.push({
                cls: 'installed badge',
                html: template + 'v ' + me.record.get('version') + '</div>'
            });
        }

        if (me.record.allowUpdate()) {
            items.push({
                cls: 'update badge',
                html: template + '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'update','default'=>'Update','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'update','default'=>'Update','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Update<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'update','default'=>'Update','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>'
            });
        }

        return Ext.create('Ext.container.Container', {
            cls: 'badge-container',
            defaults: {
                xtype: 'component'
            },
            items: items
        });
    },

    createButton: function() {
        var me = this, cls, text;

        switch (true) {
            case me.record.allowDummyUpdate():

                return Ext.create('PluginManager.container.Container', {
                    cls: 'button dummy',
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Install<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function() {
                        me.registerConfigRequiredEvent(me.record);
                        me.updateDummyPluginEvent(me.record);
                    }
                });

            case me.record.allowUpdate():
                return Ext.create('PluginManager.container.Container', {
                    cls: 'button update',
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'update_plugin','default'=>'Update','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'update_plugin','default'=>'Update','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Update<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'update_plugin','default'=>'Update','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function() {
                        me.updatePluginEvent(me.record);
                    }
                });

            case me.record.allowInstall():
                return Ext.create('PluginManager.container.Container', {
                    cls: 'button install',
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Install<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'install','default'=>'Install','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function() {
                        me.registerConfigRequiredEvent(me.record);
                        me.installPluginEvent(me.record);
                    }
                });

            case me.record.allowActivate():
                return Ext.create('PluginManager.container.Container', {
                    cls: 'button activate',
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'activate','default'=>'Activate','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'activate','default'=>'Activate','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Activate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'activate','default'=>'Activate','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function() {
                        me.activatePluginEvent(me.record);
                    }
                });

            case me.record.allowConfigure():
                return Ext.create('PluginManager.container.Container', {
                    cls: 'button configure',
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'configure','default'=>'Configure','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configure','default'=>'Configure','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Configure<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'configure','default'=>'Configure','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function() {
                        me.displayPluginEvent(me.record);
                    }
                });

            case me.record.isAdvancedFeature():
            case me.record.isLocalPlugin():
                return Ext.create('PluginManager.container.Container', {
                    cls: 'button locale',
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'open','default'=>'Open','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open','default'=>'Open','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Open<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'open','default'=>'Open','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function() {
                        me.displayPluginEvent(me.record);
                    }
                });

            case me.record.get('useContactForm'):
                return Ext.create('PluginManager.container.Container', {
                    cls: 'button contact-form',
                    html: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'request','default'=>'Contact','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'request','default'=>'Contact','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Contact<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'request','default'=>'Contact','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    handler: function() {
                        var link = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'contact_link','default'=>'http://store.shopware.com/en/contact-producer','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_link','default'=>'http://store.shopware.com/en/contact-producer','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
http://store.shopware.com/en/contact-producer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'contact_link','default'=>'http://store.shopware.com/en/contact-producer','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
?technicalName=' + me.record.get('technicalName');
                        window.open(link);
                    }
                });

            default:
                if (me.record['getPricesStore']) {
                    var prices = me.record['getPricesStore'],
                        buyPrice = me.getPriceByType(prices, 'buy'),
                        rentPrice = me.getPriceByType(prices, 'rent'),
                        redirectToStore = me.record.get('redirectToStore');

                    if (rentPrice || redirectToStore) {
                        text = me.getBoxText(redirectToStore, rentPrice);
                        cls = 'rent';
                    } else if (buyPrice) {
                        text = Ext.util.Format.currency(buyPrice.get('price'), ' €', 2, true);
                        cls = 'buy';
                    } else {
                        text = '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'free_price','default'=>'Free','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'free_price','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Free<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'free_price','default'=>'Free','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
';
                        cls = 'free';
                    }
                }
                break;
        }

        return Ext.create('PluginManager.container.Container', {
            cls: 'button ' + cls,
            html: text,
            handler: function() {
                me.displayPluginEvent(me.record);
            }
        });
    },

    /**
     * @param { boolean } redirectToStore
     * @param { Shopware.apps.PluginManager.model.Price } price
     * @returns { string }
     */
    getBoxText: function(redirectToStore, price) {
        var me = this;

        if (!redirectToStore) {
            return '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'from_price','default'=>'From','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'from_price','default'=>'From','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
From<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'from_price','default'=>'From','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 ' + Ext.util.Format.currency(price.get('price'), ' €', 2, true);
        }

        return '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'more/info/button/text','default'=>'More information','namespace'=>'backend/plugin_manager/translation')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'more/info/button/text','default'=>'More information','namespace'=>'backend/plugin_manager/translation'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
More information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'more/info/button/text','default'=>'More information','namespace'=>'backend/plugin_manager/translation'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    getPriceByType: function(prices, type) {
        var me = this, price = null;

        prices.each(function(item) {
            if (item.get('type') == type) {
                price = item;
            }
        });
        return price;
    }
});
//<?php }} ?>