<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:30
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article\view\detail\base.js" */ ?>
<?php /*%%SmartyHeaderCode:224315acda8f2f2ae30-80780941%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3edaccfb1e6a7d5556ddad00717f916d28df1a4' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article\\view\\detail\\base.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '224315acda8f2f2ae30-80780941',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f30d5111_79635383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f30d5111_79635383')) {function content_5acda8f30d5111_79635383($_smarty_tpl) {?>/**
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
 * @package    Article
 * @subpackage Detail
 * @version    $Id$
 * @author shopware AG
 */

/**
 * Shopware UI - Article detail page
 * The base component contains the configuration elements for the article head data, like the article name,
 * article order number, etc.
 */
//
//
Ext.define('Shopware.apps.Article.view.detail.Base', {
    /**
     * Define that the billing field set is an extension of the Ext.form.FieldSet
     * @string
     */
    extend:'Ext.form.FieldSet',

    /**
     * The Ext.container.Container.layout for the fieldset's immediate child items.
     * @object
     */
    layout: 'column',

    /**
     * List of short aliases for class names. Most useful for defining xtypes for widgets.
     * @string
     */
    alias:'widget.article-base-field-set',
    /**
     * Set css class for this component
     * @string
     */
    cls: Ext.baseCSSPrefix + 'article-base-field-set',

    /**
     * Contains all snippets for the view component
     * @object
     */
    snippets:{
        titleEdit:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'title_edit','default'=>'Head data - last edit [0]','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'title_edit','default'=>'Head data - last edit [0]','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Basic info - last edited [0]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'title_edit','default'=>'Head data - last edit [0]','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        titleNew:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'title_new','default'=>'Head data','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'title_new','default'=>'Head data','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Basic info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'title_new','default'=>'Head data','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        empty:'<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'empty','default'=>'Please select...','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'empty','default'=>'Please select...','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please select...<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'empty','default'=>'Please select...','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        name: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'description','default'=>'Article description','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'description','default'=>'Article description','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'description','default'=>'Article description','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        supplier: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'supplier','default'=>'Supplier','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'supplier','default'=>'Supplier','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Manufacturer<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'supplier','default'=>'Supplier','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        number: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'number','default'=>'Article number','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'number','default'=>'Article number','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Item number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'number','default'=>'Article number','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        active: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'active','default'=>'Active','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'active','default'=>'Active','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Active<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'active','default'=>'Active','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        configurator: {
            fieldLabel: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'configurator_field','default'=>'Configurator','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'configurator_field','default'=>'Configurator','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Variants<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'configurator_field','default'=>'Configurator','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
        },
        tax: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'tax','default'=>'Tax','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'tax','default'=>'Tax','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
VAT<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'tax','default'=>'Tax','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        template: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'template','default'=>'Template','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'template','default'=>'Template','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'template','default'=>'Template','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        priceGroupActive: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'price_group_active','default'=>'Active price group','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'price_group_active','default'=>'Active price group','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Active price group<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'price_group_active','default'=>'Active price group','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        priceGroup: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'price_group_select','default'=>'Select price group','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'price_group_select','default'=>'Select price group','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Select price group<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'price_group_select','default'=>'Select price group','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        purchasePrice: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'purchase_price','default'=>'Purchase price','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'purchase_price','default'=>'Purchase price','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Purchase price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'purchase_price','default'=>'Purchase price','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        numberValidation: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'number_validation','default'=>'The inserted article number already exists!','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'number_validation','default'=>'The inserted article number already exists!','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The item number entered already exists!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'number_validation','default'=>'The inserted article number already exists!','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        mainDetailAdditionalText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'main_detail_additional_text','default'=>'Varianten-Zusatztext','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'main_detail_additional_text','default'=>'Varianten-Zusatztext','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Additional variant text<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'main_detail_additional_text','default'=>'Varianten-Zusatztext','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        regexNumberValidation: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The item number entered contains invalid characters!<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'detail'/'base'/'regex_number_validation','default'=>'The inserted article number contains illegal characters!','namespace'=>'backend/article/view/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
    },

    /**
     * Contains the field set defaults.
     */
    defaults: {
        labelWidth: 155
    },

    /**
     * The initComponent template method is an important initialization step for a Component.
     * It is intended to be implemented by each subclass of Ext.Component to provide any needed constructor logic.
     * The initComponent method of the class being created is called first,
     * with each initComponent method up the hierarchy to Ext.Component being called thereafter.
     * This makes it easy to implement and, if needed, override the constructor logic of the Component at any step in the hierarchy.
     * The initComponent method must contain a call to callParent in order to ensure that the parent class' initComponent method is also called.
     *
     * @return void
     */
    initComponent:function () {
        var me = this,
            mainWindow = me.subApp.articleWindow;

        mainWindow.on('storesLoaded', me.onStoresLoaded, me);

        me.title = me.snippets.titleNew;
        me.items = me.createElements();
        me.callParent(arguments);
    },

    /**
     * The setTitle function checks if the detail window opened with an article record or not.
     * If an article passed, the last change date will be displayed in the field set header.
     */
    changeTitle: function() {
        var me = this;

        if (me.article instanceof Ext.data.Model) {
            var changed = Ext.util.Format.date(me.article.get('changed')) + ' ' + Ext.util.Format.date(me.article.get('changed'), 'H:i:s');
            me.title = Ext.String.format(me.snippets.titleEdit, changed);
        } else {
            me.title = me.snippets.titleNew;
        }
        me.setTitle(me.title);
    },

    /**
     * Creates the both containers for the field set
     * to display the form fields in two columns.
     *
     * @return [Array] Contains the left and right container
     */
    createElements:function () {
        var leftContainer, rightContainer, me = this;

        leftContainer = Ext.create('Ext.container.Container', {
            columnWidth:0.5,
            defaults: {
                labelWidth: 155,
                anchor: '100%'
            },
            padding: '0 20 0 0',
            layout: 'anchor',
            border:false,
            items:me.createLeftElements()
        });

        rightContainer = Ext.create('Ext.container.Container', {
            columnWidth:0.5,
            layout: 'anchor',
            defaults: {
                labelWidth: 155,
                anchor: '100%'
            },
            border:false,
            items:me.createRightElements()
        });

        return [ leftContainer, rightContainer ] ;
    },


    /**
     * Creates the field set items which displayed in the left column of the base field set
     * @return Array
     */
    createLeftElements: function() {
        var me =this, articleId = null, additionalText = null;


        if (me.article instanceof Ext.data.Model && me.article.getMainDetail().first() instanceof Ext.data.Model) {
            articleId = me.article.getMainDetail().first().get('id');
            additionalText = me.article.getMainDetail().first().get('additionalText');
        }

        me.numberField = Ext.create('Ext.form.field.Text', {
            name: 'mainDetail[number]',
            dataIndex: 'mainDetail[number]',
            fieldLabel: me.snippets.number,
            regex: /^[a-zA-Z0-9-_.]+$/,
            regexText: me.snippets.regexNumberValidation,
            allowBlank: false,
            enableKeyEvents:true,
            checkChangeBuffer:700,
            labelWidth: 155,
            anchor: '100%',
            vtype:'remote',
            validationUrl: '<?php echo '/shopware4/backend/Article/validateNumber';?>',
            validationRequestParam: articleId,
            validationErrorMsg: me.snippets.numberValidation
        });


        var hideVariantTab = true;
        if(me.article !== Ext.undefined) {
            hideVariantTab = (me.article.get('id') === null || me.article.get('isConfigurator') === false || me.article.get('configuratorSetId') === null);
        }

        var showAdditionalText = (hideVariantTab) ? !Ext.isEmpty(additionalText, false) : false;
        me.mainDetailAdditionalText = Ext.create('Ext.form.field.Text', {
            name: 'mainDetail[additionalText]',
            translatable: false,
            labelWidth: 155,
            anchor: '100%',
            hidden: !showAdditionalText,
            fieldLabel: me.snippets.mainDetailAdditionalText
        });

        me.supplierCombo = Ext.create('Ext.form.field.ComboBox', {
            xtype: 'combo',
            name: 'supplierId',
            queryMode: 'local',
            store: me.supplierStore,
            valueField: 'id',
            displayField: 'name',
            emptyText: me.snippets.empty,
            allowBlank: false,
            fieldLabel: me.snippets.supplier,
            labelWidth: 155,
            anchor: '100%'
        });

        return [
            me.supplierCombo,
            {
                xtype: 'textfield',
                name: 'name',
                translatable: true,
                allowBlank: false,
                fieldLabel: me.snippets.name
            },
            me.mainDetailAdditionalText,
            me.numberField,
            {
                xtype: 'checkbox',
                name: 'active',
                fieldLabel: me.snippets.active,
                inputValue: true,
                uncheckedValue:false
            },
            {
                xtype: 'checkbox',
                name: 'isConfigurator',
                fieldLabel: me.snippets.configurator.fieldLabel,
                inputValue: true,
                uncheckedValue:false
            }
        ];
    },

    onStoresLoaded: function(article, stores) {
        var me = this;

        // Change the title
        me.article = article;
        me.changeTitle();

        // Bind the stores on the left side
        me.supplierCombo.bindStore(stores['suppliers']);

        // Bind the stores to the comboboxes on the right side
        me.taxComboBox.bindStore(stores['taxes']);
        me.templateComboBox.bindStore(stores['templates']);
        me.priceGroupComboBox.bindStore(stores['priceGroups']);

        me.numberField.validationRequestParam = article.getMainDetail().first().get('id');
    },

    /**
     * Creates the field set items which displayed in the right column of the base field set
     * @return Array
     */
    createRightElements: function() {
        var me = this;

        me.taxComboBox = Ext.create('Ext.form.field.ComboBox', {
            name: 'taxId',
            queryMode: 'local',
            emptyText: me.snippets.empty,
            fieldLabel: me.snippets.tax,
            allowBlank: false,
            valueField: 'id',
            displayField: 'name',
            editable: false,
            labelWidth: 155,
            anchor: '100%'
        });

        me.templateComboBox = Ext.create('Ext.form.field.ComboBox', {
            name: 'template',
            queryMode: 'local',
            fieldLabel: me.snippets.template,
            emptyText: me.snippets.empty,
            valueField: 'id',
            displayField: 'name',
            editable: false,
            labelWidth: 155,
            anchor: '100%'
        });

        me.priceGroupComboBox = Ext.create('Ext.form.field.ComboBox', {
            queryMode: 'local',
            name: 'priceGroupId',
            fieldLabel: me.snippets.priceGroup,
            emptyText: me.snippets.empty,
            valueField: 'id',
            displayField: 'name',
            editable: false,
            labelWidth: 155,
            anchor: '100%'
        });

        return [
            me.taxComboBox, me.templateComboBox, {
            xtype: 'checkbox',
            name: 'priceGroupActive',
            fieldLabel: me.snippets.priceGroupActive,
            inputValue: true,
            uncheckedValue:false,
            listeners: {
                change: function(checkbox, newValue) {
                    me.priceGroupComboBox.allowBlank = !newValue;
                    me.priceGroupComboBox.validateValue(me.priceGroupComboBox.getValue());
                }
            }
        }, me.priceGroupComboBox, {
            xtype: 'numberfield',
            name: 'mainDetail[purchasePrice]',
            dataIndex: 'mainDetail[purchasePrice]',
            fieldLabel: me.snippets.purchasePrice,
            minValue: 0,
            step: 0.01
        }]
    }
});
//
<?php }} ?>