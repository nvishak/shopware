<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\customer\view\address\detail\address.js" */ ?>
<?php /*%%SmartyHeaderCode:223835acda8f367d501-05928596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1517ea24f763119f4a7de2eee703bb2cec6da09b' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\customer\\view\\address\\detail\\address.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '223835acda8f367d501-05928596',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f37d8450_36204207',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f37d8450_36204207')) {function content_5acda8f37d8450_36204207($_smarty_tpl) {?>/**
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
 * Shopware UI - Customer address detail backend module
 */
// 
Ext.define('Shopware.apps.Customer.view.address.detail.Address', {
    extend: 'Shopware.model.Container',
    padding: 20,
    alias: 'widget.customer-address-detail-address',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets: {
        fieldset: {
            company: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail/fieldset/company','default'=>'Company data','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/fieldset/company','default'=>'Company data','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Company data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/fieldset/company','default'=>'Company data','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            address: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail/fieldset/address','default'=>'Address data','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/fieldset/address','default'=>'Address data','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Address data<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/fieldset/address','default'=>'Address data','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            actions: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail/fieldset/actions','default'=>'Actions','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/fieldset/actions','default'=>'Actions','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Actions<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail/fieldset/actions','default'=>'Actions','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        fields: {
            salutation: {
                label: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'salutation','default'=>'Salutation','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'salutation','default'=>'Salutation','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Salutation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'salutation','default'=>'Salutation','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
            },
            firstname: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'firstname','default'=>'First name','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'firstname','default'=>'First name','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Firstname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'firstname','default'=>'First name','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'title','default'=>'Title','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'title','default'=>'Title','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Title<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'title','default'=>'Title','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            lastname: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'lastname','default'=>'Last name','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'lastname','default'=>'Last name','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Lastname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'lastname','default'=>'Last name','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            street: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'street','default'=>'Street','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'street','default'=>'Street','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Street<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'street','default'=>'Street','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            zipcode: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'zipcode','default'=>'Zip code','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'zipcode','default'=>'Zip code','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Zipcode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'zipcode','default'=>'Zip code','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            city: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'city','default'=>'City','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'city','default'=>'City','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
City<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'city','default'=>'City','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            additionalAddressLine1: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'additionalAddressLine1','default'=>'Additional address line 1','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'additionalAddressLine1','default'=>'Additional address line 1','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Additional address line 1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'additionalAddressLine1','default'=>'Additional address line 1','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            additionalAddressLine2: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'additionalAddressLine2','default'=>'Additional address line 2','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'additionalAddressLine2','default'=>'Additional address line 2','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Additional address line 2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'additionalAddressLine2','default'=>'Additional address line 2','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            country: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'country','default'=>'Country','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'country','default'=>'Country','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'country','default'=>'Country','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            state: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'state','default'=>'State','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'state','default'=>'State','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
State<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'state','default'=>'State','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            phone: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'phone','default'=>'Phone','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'phone','default'=>'Phone','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Phone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'phone','default'=>'Phone','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            company: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'company','default'=>'Company','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'company','default'=>'Company','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Company<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'company','default'=>'Company','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            department: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'department','default'=>'Department','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'department','default'=>'Department','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Department<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'department','default'=>'Department','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            vatId: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'vat_id','default'=>'VAT ID','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'vat_id','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
VAT ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'vat_id','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            setDefaultBillingAddress: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'setDefaultBillingAddress','default'=>'VAT ID','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'setDefaultBillingAddress','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Set as default billing address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'setDefaultBillingAddress','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            setDefaultShippingAddress: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'label'/'setDefaultShippingAddress','default'=>'VAT ID','namespace'=>'backend/customer/view/address')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'setDefaultShippingAddress','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Set as default shipping address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'label'/'setDefaultShippingAddress','default'=>'VAT ID','namespace'=>'backend/customer/view/address'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        }
    },

    configure: function () {
        var me = this;

        return {
            controller: 'Address',
            fieldSets: [
                {
                    title: me.snippets.fieldset.company,
                    fields: {
                        company: {
                            fieldLabel: me.snippets.fields.company,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        department: {
                            fieldLabel: me.snippets.fields.department,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        vatId: {
                            fieldLabel: me.snippets.fields.vatId,
                            labelWidth: 155,
                            anchor: '95%'
                        }
                    }
                },
                {
                    title: me.snippets.fieldset.address,
                    fields: {
                        salutation: {
                            xtype: 'combobox',
                            triggerAction: 'all',
                            fieldLabel: me.snippets.fields.salutation.label,
                            editable: false,
                            allowBlank: false,
                            valueField: 'key',
                            displayField: 'label',
                            labelWidth: 155,
                            anchor: '95%',
                            store: Ext.create('Shopware.apps.Base.store.Salutation').load()
                        },
                        title: {
                            fieldLabel: me.snippets.fields.title,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        firstname: {
                            allowBlank: false,
                            fieldLabel: me.snippets.fields.firstname,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        lastname: {
                            allowBlank: false,
                            fieldLabel: me.snippets.fields.lastname,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        street: {
                            allowBlank: false,
                            fieldLabel: me.snippets.fields.street,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        additionalAddressLine1: {
                            /* <?php ob_start();?><?php echo false;?><?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo false;?><?php $_tmp2=ob_get_clean();?><?php if ($_tmp1&&$_tmp2){?> */
                            allowBlank: false,
                            /* <?php }?> */
                            fieldLabel: me.snippets.fields.additionalAddressLine1,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        additionalAddressLine2: {
                            /* <?php ob_start();?><?php echo false;?><?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo false;?><?php $_tmp4=ob_get_clean();?><?php if ($_tmp3&&$_tmp4){?> */
                            allowBlank: false,
                            /* <?php }?> */
                            fieldLabel: me.snippets.fields.additionalAddressLine2,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        zipcode: {
                            allowBlank: false,
                            fieldLabel: me.snippets.fields.zipcode,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        city: {
                            allowBlank: false,
                            fieldLabel: me.snippets.fields.city,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        country_id: {
                            allowBlank: false,
                            fieldLabel: me.snippets.fields.country,
                            labelWidth: 155,
                            anchor: '95%',
                            pageSize: 25,
                            listeners: {
                                select: me.onCountrySelect,
                                scope: me
                            }
                        },
                        state_id: {
                            fieldLabel: me.snippets.fields.state,
                            labelWidth: 155,
                            anchor: '95%',
                            pageSize: 25
                        },
                        phone: {
                            /* <?php ob_start();?><?php echo false;?><?php $_tmp5=ob_get_clean();?><?php ob_start();?><?php echo false;?><?php $_tmp6=ob_get_clean();?><?php if ($_tmp5&&$_tmp6){?> */
                            allowBlank: false,
                            /* <?php }?> */
                            fieldLabel: me.snippets.fields.phone,
                            labelWidth: 155,
                            anchor: '95%'
                        }
                    }
                },
                {
                    title: me.snippets.fieldset.actions,
                    fields: {
                        setDefaultBillingAddress: {
                            xtype: 'checkbox',
                            uncheckedValue: false,
                            inputValue: true,
                            boxLabel: me.snippets.fields.setDefaultBillingAddress,
                            fieldLabel: null,
                            labelWidth: 155,
                            anchor: '95%'
                        },
                        setDefaultShippingAddress: {
                            xtype: 'checkbox',
                            uncheckedValue: false,
                            inputValue: true,
                            boxLabel: me.snippets.fields.setDefaultShippingAddress,
                            fieldLabel: null,
                            labelWidth: 155,
                            anchor: '95%'
                        }
                    }
                }
            ]
        };
    },

    createAssociationSearchStore: function(model, associationKey) {
        var me = this;
        var store = me.callParent(arguments);
        if (associationKey == 'state') {
            me.addCountryIdFilter(store, me.record.get('country_id'));
        }
        return store;
    },

    addCountryIdFilter: function(store, countryId) {
        store.remoteFilter = true;
        store.filters.clear();
        store.pageSize = 25;
        store.filters.add({
            property: 'countryId',
            expression: '=',
            value: countryId
        });
    },

    /**
     * Called when the user changes the country combobox in the shipping or billing form
     * @param countryCombo
     * @param records Ext.data.Model[]
     */
    onCountrySelect: function(countryCombo, records) {
        var me = this,
            countryStateCombo = me.down('combobox[name=state_id]'),
            oldState = countryStateCombo.getValue(),
            store = countryStateCombo.store;

        var country = records.shift();
        if (country) {
            countryStateCombo.allowBlank = !country.get('forceStateInRegistration');
        }

        if (country === null) {
            countryStateCombo.setValue(null);
            countryStateCombo.hide();
            return;
        }

        me.addCountryIdFilter(store, country.get('id'));

        store.loadPage(1, {
            callback: function() {
                var record = store.getById(oldState);

                if (store.getCount() === 0) {
                    countryStateCombo.setValue(null);
                    countryStateCombo.hide();
                    return true;
                }

                if (record instanceof Ext.data.Model) {
                    countryStateCombo.setValue(record.get('id'));
                } else {
                    countryStateCombo.setValue(null);
                }
                countryStateCombo.show();
            }
        });
    }
});
// 
<?php }} ?>