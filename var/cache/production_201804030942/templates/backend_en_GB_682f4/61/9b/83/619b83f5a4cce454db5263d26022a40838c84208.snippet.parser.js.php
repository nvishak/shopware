<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\resource\parser.js" */ ?>
<?php /*%%SmartyHeaderCode:276155acda8f3db5b06-40713120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '619b83f5a4cce454db5263d26022a40838c84208' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\resource\\parser.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '276155acda8f3db5b06-40713120',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f3dd51c0_63573781',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f3dd51c0_63573781')) {function content_5acda8f3dd51c0_63573781($_smarty_tpl) {?>/**
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

/**
 * The parser knows tokenizer and lexer and handles an instance of each.
 */
Ext.define('Parser', {

    tokenizer: Ext.emptyFn,
    lexer: Ext.emptyFn,
    error: null,

    grammar: null,

    /**
     * Store the grammar object and generate tokens for the tokenizer
     * @param grammar
     */
    constructor: function(grammar) {
        var me = this;

        me.grammar = grammar;
        me.tokens = me.constructValidTokensFromGrammar(grammar);
    },


    /**
     * Returns a tokenizer instance
     *
     * @returns Tokenizer
     */
    createTokenizer: function() {
        return new Tokenizer(this.tokens,
            function (text, isSeparator, token) {
                text = text.trim();
                if ("" != text) {
                    return text;
                }
            }
        );
    },

    /**
     * Will extract all relevant tokens from the grammar array
     *
     * @param grammar
     * @returns Array
     */
    constructValidTokensFromGrammar: function(grammar) {
        var me = this;

        var attributes = Object.keys(grammar.attributes);
        attributes.sort(function(a, b){
            return b.length - a.length;
        });

        var unaryOperators = Object.keys(grammar.unaryOperators);
        unaryOperators.sort(function(a, b){
            return b.length - a.length;
        });


        var nullaryOperators = Object.keys(grammar.nullaryOperators);
        nullaryOperators.sort(function(a, b){
            return b.length - a.length;
        });

        var values = grammar.values;

        var binaryOperators = Object.keys(grammar.binaryOperators);
        binaryOperators.sort(function(a, b){
            return b.length - a.length;
        });

        var boolOperators = grammar.boolOperators;

        var subOperators = grammar.subOperators;

        var tokens = attributes.concat(unaryOperators, nullaryOperators, values, binaryOperators, boolOperators, subOperators);

        var noRegExpFor = ['(', ')', '<?php echo ', ';?>
'];

        // Be case-insensitive for all tokens
        tokens = tokens.map(function(token) {
            if (!token.test && noRegExpFor.indexOf(token) == -1 ) {
                token = new RegExp(token, "i");
            }
            return token
        });

        return tokens;

    },

    /**
     * Creates a new lexer instance
     *
     * @returns Lexer
     */
    createLexer: function() {
        return new Lexer(this.grammar);
    },

    /**
     * Returns the last error
     *
     * @returns null
     */
    getError: function() {
        var me = this;

        return me.error ? me.error : false;
    },

    /**
     * Runs the lexer
     *
     * @param string
     * @returns boolean
     */
    parse: function(string) {
        var me = this,
            result;

        me.spawnTokenizerAndLexer();

        result = me.lexer.analyze(me.tokenizer.parse(string));

        if (result == true) {
            me.error = false;
            return true;
        } else {
            me.error = result;
            return false;
        }
    },

    /**
     * Stops already running instances of lexer and tokenizer and spawns new instances (kind of)
     */
    spawnTokenizerAndLexer: function() {
        var me = this;

        // Cancel running instances
        if (me.tokenizer != Ext.emptyFn) {
            me.tokenizer.cancel();
        }
        if (me.lexer != Ext.emptyFn) {
            me.lexer.cancel();
        }

        me.tokenizer = me.createTokenizer();
        me.lexer = me.createLexer();
    },


    /**
     * Getter for the last seen attribute of the lexer
     * @returns string
     */
    getLastSeenAttribute: function() {
        var me = this;

        return me.lexer.lastSeenAttribute;
    },

    /**
     * Getter for the last suggestion of the lexer
     *
     * @returns array
     */
    getSuggestion: function() {
        var me = this;

        return me.lexer.suggest;
    },

    /**
     * Returns the simple result representation of the query string. Only available, if no suboperators and ony
     * "and" was used
     *
     * @returns Array|Boolean
     */
    getSimpleResult: function() {
        var me = this;

        if (me.lexer.isSimple) {
            return me.lexer.simpleResult;
        }

        return false;
    },

    getAst: function() {
        var me = this;

        return me.lexer.astFlat;
    }
});
<?php }} ?>