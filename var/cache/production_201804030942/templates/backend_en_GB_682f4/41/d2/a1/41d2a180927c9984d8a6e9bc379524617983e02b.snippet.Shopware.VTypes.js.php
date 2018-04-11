<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:40
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\Shopware.VTypes.js" */ ?>
<?php /*%%SmartyHeaderCode:199105acd97e09ca853-58643185%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '41d2a180927c9984d8a6e9bc379524617983e02b' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\Shopware.VTypes.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199105acd97e09ca853-58643185',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e0a1ae05_50900667',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e0a1ae05_50900667')) {function content_5acd97e0a1ae05_50900667($_smarty_tpl) {?>/**
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
 * @package    Base
 * @subpackage Component
 * @version    $Id$
 * @author shopware AG
 */
//
/**
 * todo@all: Documentation
 */
Ext.apply(Ext.form.VTypes, {
    password: function (val, field) {
        if (field.initialPassField) {
            var pwd = Ext.getCmp(field.initialPassField);
            return (val == pwd.getValue());
        }
        return true;
    },
    passwordText: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'password_match','default'=>'The inserted passwords are not equal','namespace'=>'backend/base/vtype')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'password_match','default'=>'The inserted passwords are not equal','namespace'=>'backend/base/vtype'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The passwords entered do not match.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'password_match','default'=>'The inserted passwords are not equal','namespace'=>'backend/base/vtype'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
});

Ext.apply(Ext.form.field.VTypes, {

    missingValidationErrorText: 'The remote vType validation needs a validationErrorMsg property',

    emailMask: /[a-z\u00C0-\u00FF0-9_\.\-@\+]/i,

    /**
     * Remote validation method which sets an event listener on the blur event of
     * the field and validates the value with the server-side.
     *
     * @example Usage example:
     * <code>
     * me.numberField = Ext.create('Ext.form.field.Text', {
     *    fieldLabel: 'Numberfield',
     *    allowBlank: false,
     *    enableKeyEvents:true,
     *    checkChangeBuffer:700,
     *    vtype:'remote',
     *    validationUrl: '<?php echo '/shopware4/backend/base/validateNumber';?>',
     *    validationRequestParam: articleId,
     *    validationErrorMsg: me.snippets.numberValidation
     * });
     * </code>
     *
     * @param { String } val - Value of the field
     * @param { Object } field - Ext.form.field.* component.
     *
     * @returns { String|Boolean } Returns the string with a ajax validation war triggered,
     *          Otherwise a boolean value
     */
    remote: function (val, field) {
        if (!field.validationUrl) {
            return true;
        }

        if (!field.validationErrorMsg) {
            Ext.Error.raise(this.missingValidationErrorText);
            return false;
        }

        // Is the field rendered?
        if (!field.rendered) {
            return true;
        }

        if (!field.hasOwnProperty('hasBlurListener')) {
            field.on('change', this.onFireRemoteValidation, this, { delay: 750 });
            this.onFireRemoteValidation(field);
            field.hasBlurListener = true;
        }

        // If the valid state is set to the field return the value of it, otherwise
        // just return true to indicate that the
        return (field.hasOwnProperty('oldValid')) ? field.oldValid : true;
    },

    /**
     * Date Range Check - Checks if an start date is not after a given end date and vice versa
     *
     * <code>
     *     var dateStart =  new Ext.form.DateField( {
     *       name: 'dataStart',
     *       id: 'dataStart',
     *       fieldLabel: "Date Start",
     *       hideLabel: false,
     *       vtype: 'daterange',//type here
     *       endDateField: 'dateEnd'//and end date field
     *     });
     *
     *     var dateEnd =  new Ext.form.DateField( {
     *       id: 'dateEnd',
     *       name: 'dateEnd',
     *       fieldLabel: "Date End",
     *       hideLabel: false,
     *       vtype: 'daterange',//add type
     *       startDateField: 'dataStart'//start date field
     *     });
     * </code>
     *
     * @param val Date
     * @param field
     */
    daterange: function (val, field) {
        var date = field.parseDate(val);

        if (!date) {
            return false;
        }
        // build range
        if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
            var start = field.up('form').down('#' + field.startDateField);
            start.setMaxValue(date);
            start.validate();
            this.dateRangeMax = date;
        }
        else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
            var end = field.up('form').down('#' + field.endDateField);
            end.setMinValue(date);
            end.validate();
            this.dateRangeMin = date;
        }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
    },

    /**
     * Event listener method which fires field's `blur` event. The method triggers
     * an AJAX request to the server side to validate the passed field and it's value.
     *
     * @event blur
     * @param { Object } field - Ext.form.field.* component which triggers the event
     * @returns { Boolean } Truthy if the validation was sucessful, otherwise falsy.
     */
    onFireRemoteValidation: function (field) {
        var parameters, val = field.getValue();

        if (Ext.isDefined(field.oldValid)) {
            if (val == field.oldValue) {
                return field.oldValid;
            }
        }
        field.oldValue = val;

        if (!field.validationRequestParams) {
            parameters = {
                value: val,
                param: field.validationRequestParam
            };
        } else {
            parameters = field.validationRequestParams;
            parameters.value = val;
        }

        Ext.Ajax.request({
            async: false,
            url: field.validationUrl,
            params: parameters,
            success: function (response) {
                var oldValid = field.oldValid;

                if (!response.responseText) {
                    // Field is invalid setting the custom error message
                    field.markInvalid(field.validationErrorMsg);
                    field.vtypeText = field.validationErrorMsg;

                    field.oldValid = false;
                } else {
                    field.clearInvalid();
                    field.oldValid = true;
                }

                if (oldValid !== field.oldValid) {
                    field.fireEvent('validitychange', field, field.oldValid);
                }
            },
            failure: function (response) {
                Shopware.Msg.createGrowlMessage('', field.validationErrorMsg, '', 'growl', false);
                return false;
            }
        });
    }
});
<?php }} ?>