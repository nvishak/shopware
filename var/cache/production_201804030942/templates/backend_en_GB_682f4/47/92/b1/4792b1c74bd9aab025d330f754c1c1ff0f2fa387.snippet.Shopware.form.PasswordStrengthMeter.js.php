<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:41
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\component\Shopware.form.PasswordStrengthMeter.js" */ ?>
<?php /*%%SmartyHeaderCode:31045acd97e1011ea0-25446026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4792b1c74bd9aab025d330f754c1c1ff0f2fa387' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\component\\Shopware.form.PasswordStrengthMeter.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31045acd97e1011ea0-25446026',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e104af16_54015535',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e104af16_54015535')) {function content_5acd97e104af16_54015535($_smarty_tpl) {?>/**
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

/**
 * todo@all: Documentation
 */
Ext.define('Shopware.form.PasswordStrengthMeter', {
    extend: 'Ext.form.field.Text',
    alias: 'widget.passwordmeter',
    inputType: 'password',

    reset: function() {
        this.callParent();
        this.updateMeter();
    },
//
    fieldSubTpl: [
        '<div><input id="{id}" type="{type}" ',
        '<tpl if="name">name="{name}" </tpl>',
        '<tpl if="size">size="{size}" </tpl>',
        '<tpl if="tabIdx">tabIndex="{tabIdx}" </tpl>',
        'class="{fieldCls} {typeCls}" autocomplete="off" /></div>',
        '<div class="' + Ext.baseCSSPrefix + 'form-strengthmeter">',
        '<div class="' + Ext.baseCSSPrefix + 'form-strengthmeter-scorebar">&nbsp;</div>',
        '</div>',
        {
            compiled: true,
            disableFormats: true
        }
    ],
//
    // private
    onChange: function(newValue, oldValue) {
        this.updateMeter(newValue);
    },

    /**
     * Sets the width of the meter, based on the score
     *
     * @param { Object } e Private function
     */
    updateMeter : function(val) {
        var me = this, maxWidth, score, scoreWidth,
            objMeter = me.el.down('.' + Ext.baseCSSPrefix + 'form-strengthmeter'),
            scoreBar = me.el.down('.' + Ext.baseCSSPrefix + 'form-strengthmeter-scorebar');

        if (val){
            maxWidth = objMeter.getWidth();
            score = me.calcStrength(val);
            scoreWidth = maxWidth - (maxWidth / 100) * score;
            scoreBar.setWidth(scoreWidth, true);
        } else {
            scoreBar.setWidth('100%');
        }
    },

    /**
     * Calculates the strength of a password
     *
     * @param { Object } p The password that needs to be calculated
     * @return { int } intScore The strength score of the password
     */
    calcStrength: function(p) {
        // PASSWORD LENGTH
        var len = p.length,
            score = len;

        if (len > 0 && len <= 4) { // length 4 or
            // less
            score += len
        } else if (len >= 5 && len <= 7) {
            // length between 5 and 7
            score += 6;
        } else if (len >= 8 && len <= 15) {
            // length between 8 and 15
            score += 12;
        } else if (len >= 16) { // length 16 or more
            score += 18;
        }

        // LETTERS (Not exactly implemented as dictacted above
        // because of my limited understanding of Regex)
        if (p.match(/[a-z]/)) {
            // [verified] at least one lower case letter
            score += 1;
        }
        if (p.match(/[A-Z]/)) { // [verified] at least one upper
            // case letter
            score += 5;
        }
        // NUMBERS
        if (p.match(/\d/)) { // [verified] at least one
            // number
            score += 5;
        }
        if (p.match(/(?:.*?\d)<?php echo 3;?>
/)) {
            // [verified] at least three numbers
            score += 5;
        }

        // SPECIAL CHAR
        if (p.match(/[\!,@,#,$,%,\^,&,\*,\?,_,~]/)) {
            // [verified] at least one special character
            score += 5;
        }
        // [verified] at least two special characters
        if (p.match(/(?:.*?[\!,@,#,$,%,\^,&,\*,\?,_,~])<?php echo 2;?>
/)) {
            score += 5;
        }

        // COMBOS
        if (p.match(/(?=.*[a-z])(?=.*[A-Z])/)) {
            // [verified] both upper and lower case
            score += 2;
        }
        if (p.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/)) {
            // [verified] both letters and numbers
            score += 2;
        }
        // [verified] letters, numbers, and special characters
        if (p.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\!,@,#,$,%,\^,&,\*,\?,_,~])/)) {
            score += 2;
        }

        return Math.min(Math.round(score * 2), 100);
    }
});
<?php }} ?>