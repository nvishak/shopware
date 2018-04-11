<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\address\list.js" */ ?>
<?php /*%%SmartyHeaderCode:208095acda8f3231b40-20624844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ccdf9e40ab344383fe6a91995c3c12b961688fcd' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\address\\list.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208095acda8f3231b40-20624844',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f33b76f8_76905622',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f33b76f8_76905622')) {function content_5acda8f33b76f8_76905622($_smarty_tpl) {?>/**
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
 * @package    Customer
 * @subpackage Address
 * @version    $Id$
 * @author shopware AG
 */

// 

/**
 * Shopware UI - Customer address list backend module
 */
// 
Ext.define('Shopware.apps.Customer.view.address.List', {

    extend: 'Shopware.grid.Panel',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias: 'widget.customer-address-grid',

    /**
     * The view needs to be scrollable
     * @string
     */
    autoScroll: true,

    /**
     * Set css class for this component
     * @string
     */
    cls: Ext.baseCSSPrefix + 'address-list',

    /**
     * Set region to expand width/height
     */
    region: 'center',

    /**
     * Snippets for grid headers
     */
    snippets: {
        header: {
            isDefaultAddress: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/isDefaultAddress','default'=>'Default','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/isDefaultAddress','default'=>'Default','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Default for<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/isDefaultAddress','default'=>'Default','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            company: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/company','default'=>'Company','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/company','default'=>'Company','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Company<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/company','default'=>'Company','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            salutation: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/salutation','default'=>'Salutation','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/salutation','default'=>'Salutation','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Salutation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/salutation','default'=>'Salutation','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/name','default'=>'Name','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/name','default'=>'Name','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/name','default'=>'Name','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            street: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/street','default'=>'Street','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/street','default'=>'Street','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Street<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/street','default'=>'Street','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            zipcode: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/zipcode','default'=>'Zipcode','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/zipcode','default'=>'Zipcode','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Zipcode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/zipcode','default'=>'Zipcode','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            city: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/city','default'=>'City','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/city','default'=>'City','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
City<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/city','default'=>'City','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            state: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/state','default'=>'State','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/state','default'=>'State','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
State<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/state','default'=>'State','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            country: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/country','default'=>'Country','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/country','default'=>'Country','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/country','default'=>'Country','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            phone: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/phone','default'=>'Phone','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/phone','default'=>'Phone','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Phone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/phone','default'=>'Phone','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            vatId: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/header/vatId','default'=>'VAT ID','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/vatId','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
VAT ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/header/vatId','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    /**
     * Listeners
     * - Enable double-click to open detail window
     * - Disable deletion by disabling the row selection for default addresses
     */
    listeners: {
        itemdblclick: function(view, record) {
            this.controller.onEditItem(this, record);
        },
        beforeselect: function(row, record) {
            var me = this;

            if (me.isDefaultAddress(record)) {
                return false;
            }
        }
    },

    /**
     * configure the grid
     * @returns { Object }
     */
    configure: function() {
        var me = this;

        var columns = {
            defaultAddress: {
                header: me.snippets.header.isDefaultAddress,
                renderer: me.defaultColumnRenderer,
                flex: 1,
                sortable: false
            },
            company: {
                header: me.snippets.header.company,
                renderer: me.companyRenderer,
                flex: 2
            },
            vatId: {
                header: me.snippets.header.vatId,
                flex: 1
            },
            firstname: {
                header: me.snippets.header.name,
                renderer: me.nameRenderer,
                flex: 2
            },
            street: {
                header: me.snippets.header.street,
                renderer: me.addressRenderer,
                flex: 2
            },
            zipcode: {
                header: me.snippets.header.zipcode,
                flex: 1
            },
            city: {
                header: me.snippets.header.city,
                flex: 1
            },
            state_id: {
                header: me.snippets.header.state,
                flex: 1,
                sortable: false
            },
            country_id: {
                header: me.snippets.header.country,
                flex: 1,
                sortable: false
            }
        };

        /* <?php ob_start();?><?php echo false;?><?php $_tmp1=ob_get_clean();?><?php if ($_tmp1){?> */
        columns['phone'] = {
            header: me.snippets.header.phone,
            flex: 1
        };
        /* <?php }?> */

        return {
            columns: columns,
            searchField: false,
            detailWindow: 'Shopware.apps.Customer.view.address.detail.Window'
        };
    },

    /**
     * Combine First- and Lastname
     *
     * @param value
     * @param col
     * @param record
     * @returns { String }
     */
    nameRenderer: function (value, col, record) {
        return record.get('firstname') + ' ' + record.get('lastname');
    },

    /**
     * Combine Company, Department and VatID
     *
     * @param value
     * @param col
     * @param record
     * @returns { String }
     */
    companyRenderer: function (value, col, record) {
        if (!record.get('company')) {
            return null;
        }

        var companyName = '<b>' + record.get('company') + '</b>';

        if (record.get('department')) {
            companyName += '<br/>' + record.get('department');
        }

        return companyName;
    },

    /**
     * Combine additional address lines and street
     *
     * @param value
     * @param col
     * @param record
     * @returns { String }
     */
    addressRenderer: function (value, col, record) {
        var addressLine = record.get('street');

        if (record.get('additionalAddressLine1')) {
            addressLine += '<br/>' + record.get('additionalAddressLine1');
        }

        if (record.get('additionalAddressLine2')) {
            addressLine += '<br/>' + record.get('additionalAddressLine2');
        }

        return addressLine;
    },

    /**
     * Indicate default billing and shipping addresses
     *
     * @param value
     * @param col
     * @param record
     * @returns { String }
     */
    defaultColumnRenderer: function (value, col, record) {
        var defaults = [],
            customer = record.getCustomerStore && record.getCustomerStore.first();

        if (customer && customer.get('default_billing_address_id') == record.get('id')) {
            defaults.push('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/data/billingaddress','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/data/billingaddress','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Billing<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/data/billingaddress','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
        }

        if (customer && customer.get('default_shipping_address_id') == record.get('id')) {
            defaults.push('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'list/data/shippingaddress','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/data/shippingaddress','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Shipping<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'list/data/shippingaddress','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
        }

        return defaults.join('<br/>');
    },

    /**
     * Inject customer id for model relation
     */
    createNewRecord: function() {
        var me = this;

        return Ext.create(this.store.model, {
            user_id: me.customerRecord.get('id')
        });
    },

    /**
     * Hide delete icon for default billing or shipping address
     */
    createDeleteColumn: function() {
        var me = this,
            button = me.callParent(arguments);

        button.getClass = function(value, meta, record) {
            if (me.isDefaultAddress(record)) {
                return 'x-hidden';
            }
        };

        return button;
    },

    /**
     * Checks if the given address is set as default billing or shipping address
     *
     * @param record
     * @returns { boolean }
     */
    isDefaultAddress: function(record) {
        var customer = record.getCustomerStore && record.getCustomerStore.first();

        return customer &&
            (customer.get('default_billing_address_id') == record.get('id') || customer.get('default_shipping_address_id') == record.get('id'));
    }
});
// 
<?php }} ?>