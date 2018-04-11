<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:23
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\index\view\footer.js" */ ?>
<?php /*%%SmartyHeaderCode:124075acda8ebe6e964-00725825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfd4df842788abe3c2e90bcb72f8f9bd302856bd' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\index\\view\\footer.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124075acda8ebe6e964-00725825',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8ebebc2d0_22400398',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8ebebc2d0_22400398')) {function content_5acda8ebebc2d0_22400398($_smarty_tpl) {?>/**
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
 */

//

/**
 * Shopware UI - Footer
 *
 * Special Ext.toolbar.Toolbar, which is docked
 * to the bottom and contains a special context
 * menu.
 *
 * Note that the component will be streched to
 * the full viewport width.
 */
//
Ext.define('Shopware.apps.Index.view.Footer', {
    extend: 'Ext.toolbar.Toolbar',
    alias: 'widget.footer',
    alternateClassName: 'Shopware.Footer',
    requires: [ 'Shopware.app.WindowManagement' ],

    height: 40,
    dock: 'bottom',
    cls: 'shopware-footer',

    /**
     * Used snippets for this component
     * @object
     */
    snippets: {
        logged_in_as: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'footer'/'logged_in_as','default'=>'Logging as','namespace'=>'backend/index/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'logged_in_as','default'=>'Logging as','namespace'=>'backend/index/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Logged in as<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'logged_in_as','default'=>'Logging as','namespace'=>'backend/index/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        logout_now: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'footer'/'logout_now','default'=>'Logout now','namespace'=>'backend/index/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'logout_now','default'=>'Logout now','namespace'=>'backend/index/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Logout now<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'logout_now','default'=>'Logout now','namespace'=>'backend/index/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        minimize_all: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'footer'/'minimize_all','default'=>'Minimize all','namespace'=>'backend/index/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'minimize_all','default'=>'Minimize all','namespace'=>'backend/index/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Minimize all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'minimize_all','default'=>'Minimize all','namespace'=>'backend/index/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        close_all: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'footer'/'close_all','default'=>'Close all','namespace'=>'backend/index/view/detail')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'close_all','default'=>'Close all','namespace'=>'backend/index/view/detail'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Close all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'footer'/'close_all','default'=>'Close all','namespace'=>'backend/index/view/detail'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },


    /**
     * Initialize the footer toolbar
     *
     * @return void
     */
    initComponent: function() {
        var me = this;

        me.createBasicItems();
        me.callParent(arguments);

        if(Ext.isObject(Shopware.app.WindowManagement)) {
            Shopware.app.WindowManagement.init(me);
        }
    },

    afterRender: function() {
        var me = this;

        Shopware.app.Application.baseComponentIsReady(me);

        me.callParent(arguments);
    },

    /**
     * Creates the default buttons for the footer taskbar
     *
     * @return void
     */
    createBasicItems: function() {
        var me = this;

        me.logoutBtn = me.createLogoutBtn();
        me.windowBtn = me.createWindowManagementMenu();
        me.widgetBtn = me.createWidgetBtn();

        this.items = [
            me.logoutBtn,
            { xtype: 'tbseparator', cls: 'separator-first' },
            me.windowBtn,
            { xtype: 'tbseparator', cls: 'separator-second' },
            me.widgetBtn
        ];

    },

    /**
     * Creates the logout button and the responsible tooltip
     * with all neccessary events
     *
     * @return [object] logoutBtn - Ext.button.Button
     */
    createLogoutBtn: function() {
        var me = this, logoutBtn, tip;

        // Create the button
        logoutBtn = Ext.create('Ext.button.Button', {
            cls: 'logout btn-over',
            iconCls: 'logout'
        });

        // Create tooltip
        tip = Ext.create('Ext.tip.ToolTip', {
            target:  logoutBtn,
            shadow: false,
            ui: 'shopware-ui',
            cls: 'logout-tooltip',
            html: me.getLogoutSnippet()
        });

        // Event listener which shows the tooltip
        logoutBtn.on('click', function() {
            var position = logoutBtn.getPosition();
            position[1] = position[1] - 50;
            tip.showAt(position);
        }, this);

        return logoutBtn;
    },

    createWidgetBtn: function() {
        return Ext.create('Ext.button.Button', {
            iconCls: 'widget-sidebar',
            id: 'widgetTaskBarBtn'
        });
    },

    /**
     * Returns the string which is used for the logout
     * tooltip
     *
     * @returns { String } - formatted localized string
     */
    getLogoutSnippet: function() {
        var url = '<?php echo '/shopware4/backend/login/logout';?>',
            s = this.snippets;

        return Ext.String.format('<span>[0] <strong>[1]</strong></span><a href="[2]">[3]</a><div class="x-clear"></div><div class="arrow"></div>', s.logged_in_as, userName, url, s.logout_now);
    },

    /**
     * Creates the button for the window management
     * and the responsible menu
     *
     * return [object] windowBtn - Ext.button.Button
     */
    createWindowManagementMenu: function() {
        var me = this, windowMenu, windowBtn;

        windowMenu = Ext.create('Ext.menu.Menu', {
            shadow: false,
            ui: 'window-managment',
            width: 126,
            plain: true,
            showSeparator: false,
            items: [{
                text: me.snippets.minimize_all,
                iconCls: 'min-all',
                handler: function() {
                    Shopware.app.WindowManagement.minimizeAll();
                }
            }, {
                text: me.snippets.close_all,
                iconCls: 'close-all',
                handler: function() {
                    Shopware.app.WindowManagement.closeAll();
                }
            }]
        });

        windowBtn = Ext.create('Ext.button.Button', {
            cls: 'window',
            iconCls: 'window-managment',
            arrowAlign: 'top',
            menu: windowMenu,
            menuAlign: 'c',
            menuOffset: [-20, -90]
        });

        return windowBtn;
    }
});
//
<?php }} ?>