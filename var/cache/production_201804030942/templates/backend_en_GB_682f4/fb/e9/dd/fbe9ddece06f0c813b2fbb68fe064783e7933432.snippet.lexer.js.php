<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\resource\lexer.js" */ ?>
<?php /*%%SmartyHeaderCode:272625acda8f357fb93-27794812%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fbe9ddece06f0c813b2fbb68fe064783e7933432' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\resource\\lexer.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '272625acda8f357fb93-27794812',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f3747409_59772438',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f3747409_59772438')) {function content_5acda8f3747409_59772438($_smarty_tpl) {?>/**
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
 * The lexer analyzes a given array of tokens and makes sure, that the order of thoken matches the grammar
 */
//
Ext.define('Lexer', {

    /**
     * Constructor method for the lexer object
     * @param grammar
     */
    constructor: function(grammar) {
        var me = this;

        me.grammar = grammar;
        me.init();
    },

    /**
     * Setup the lexer
     */
    init: function() {
        var me = this;

        // The last token the lexer looked at
        me.lastToken = 0;
        // The type of the last token the lexer looked at
        me.lastTokenType = 0;

        // Keep track of open braces
        me.braceCounter = 0;

        // Are we currently inside a list (e.g. IN (1,2,3))
        me.inList = false;

        // Was the process canceled?
        me.canceled = false;

        // The attribute the lexer looked at last
        me.lastSeenAttribute = null;

        // The item the lexer would suggest next
        me.suggest = null;

        // A flat description of the tokens (its not an ast, actually)
        me.astFlat = [ ];

        // Simple queries can be shown and edited in the "graphical" query designer
        me.isSimple = true;

        // Simple result which can be shown in the "simple editor" grid
        me.simpleResult = [ ];

        // Stores the tokens belonging to the current expression
        me.currentExpression = [ ];

    },

    /**
     * Cancel operation
     */
    cancel: function () {
        var me = this;

        me.canceled = true;
    },

    setSuggestion: function(suggestion) {
        this.suggest = suggestion;
    },

    /**
     * Analyze all the tokens and make sure, that they are valid
     */
    analyze: function (tokens) {
        var me = this,
            expectation,
            valid,
            finalCheck,
            i, token, tokenType, tokenLength = tokens.length;

        me.tokens = tokens;
        me.canceled = false;
        me.isSimple = true;
        me.simpleResult = [ ];
        me.currentExpression = [ ];

        if (tokens[0] ==  undefined) {
            expectation = me.getExpectationForToken(0, 0);
            me.lastSeenAttribute = '';
            me.lastToken = '';
            me.lastTokenType = 'boolOperators';
            me.setExpressionNotSimple();
            return {
                success: false,
                expectation: expectation,
                lastValidToken: '',
                currentToken: ''
            };
        }

        // Step through all the tokens
        for (i=0;i<tokenLength;i++) {
            token = tokens[i];

            if (me.canceled) {
                return;
            }
            token = token.toUpperCase();
            tokenType = me.getTokenType(token);

            if (tokenType == 'attribute' && Object.keys(me.grammar.attributes).indexOf(token) > -1) {
                me.lastSeenAttribute = token;
            }

            // subOperators, Lists and OR are not possible in simple queries
            if (token == 'IN' || tokenType == 'subOperators' || (tokenType == 'boolOperators' && token == 'OR')) {
                me.setExpressionNotSimple();
            } else if (tokenType == 'boolOperators' && token == 'AND') {
                me.addToSimpleResult();
            }

            // Check for braces
            if (token == '(') {
                me.braceCounter++;
            }

            // Check for list
            if (token == 'IN') {
                me.inList = true;
            }

            // Validate the token
            expectation = me.getExpectationForToken(me.lastToken, me.lastTokenType);
            valid = me.checkToken(token, tokenType, expectation.rules);
            if (!valid) {
                me.setExpressionNotSimple();
                return {
                    success: false,
                    expectation: expectation,
                    lastValidToken: me.lastToken,
                    currentToken: token
                };
            }

            if (me.isSimple) {
                me.buildSimpleResult(token, tokenType);
            }


            me.addToAst(token, tokenType);

            if (me.inList && token == ')') {
                me.inList = false;
            }
            if (token == ')') {
                me.braceCounter--;
            }
            me.lastToken = token;
            me.lastTokenType = tokenType;
        }
        if (me.canceled) {
            return;
        }

        finalCheck = me.checkFinalState();
        if (finalCheck == true) {
            me.addToSimpleResult();

            // Once we are done, we can start all over, so suggest a boolOperators
            me.setSuggestion(me.grammar.boolOperators);
            return true;
        } else {
            me.setExpressionNotSimple();

            // If we are not done, show a suggestion for the last item
            me.getExpectationForToken(me.tokens.slice(-1).pop().toUpperCase(), me.getTokenType(me.tokens.slice(-1).pop().toUpperCase()));
            return finalCheck;
        }
    },


    /**
     * Mark the query-string as not being simple
     */
    setExpressionNotSimple: function() {
        var me = this;

        me.isSimple = false;
        me.simpleResult = [ ];
        me.currentExpress = [ ];
    },

    /**
     * Push the current expression to the simpleResult array
     */
    addToSimpleResult: function() {
        var me = this;

        if (!me.isSimple) {
            return;
        }

        me.simpleResult.push(me.currentExpression);
        me.currentExpression = [ ];
    },

    /**
     * Push the current token to the currentExpression-Array. One a expression is satisfied (valid on its own)
     * it will be pushed to me.simpleResult by addToSimpleResult
     *
     * @param token
     * @param tokenType
     */
    buildSimpleResult: function(token, tokenType) {
        var me = this;

        if (!(tokenType == 'boolOperators' && token == 'AND')) {
            me.currentExpression.push({ token: token, tokenType: tokenType });
        }
    },

    /**
     * Add a given token to our token list
     *
     * @param token
     * @param tokenType
     */
    addToAst: function(token, tokenType) {
        var me = this;

        this.astFlat.push({
            type: tokenType,
            token: token
        });
    },

    /**
     * This check is performed at the end. It makes sure, that no braces are open and that all expressions
     * are satisfied
     *
     * @returns boolean|Object
     */
    checkFinalState: function () {
        var me = this,
            expectation,
            token = me.tokens[me.tokens.length - 1] ? me.tokens[me.tokens.length - 1].toUpperCase() : '',
            tokenType = me.getTokenType(token);

        // At the end of all the token we should no be "inList" any more
        if (me.inList) {
            if (token == ',' || token == '(') {
                return {
                    success: false,
                    expectation: { message: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'value','default'=>'value','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'value','default'=>'value','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'value','default'=>'value','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
", rule: me.grammar.values },
                    context: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'inList','default'=>'in list','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'inList','default'=>'in list','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
in list<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'inList','default'=>'in list','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    currentToken: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
END<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'
                };
            }
            if (tokenType == 'values') {
                return {
                    expectation: { message: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'commaOrBrace','default'=>', OR )','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'commaOrBrace','default'=>', OR )','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
, OR )<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'commaOrBrace','default'=>', OR )','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
", rule: ',|)' },
                    context: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'afterValueInList','default'=>'after value in list','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'afterValueInList','default'=>'after value in list','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
after value in list<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'afterValueInList','default'=>'after value in list','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    currentToken: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
END<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                    success: false
                };
            }
        }

        // Check for unsatisfied expressions (e.g. name =)
        if (tokenType != 'unaryOperators' && tokenType != 'nullaryOperators' && tokenType != 'values' && token != ')') {
            expectation = me.getExpectationForToken(token, tokenType);
            return {
                expectation: expectation,
                lastValidToken: tokenType,
                currentToken: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
END<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                success: false
            };
        // Check for open braces
        } else if (me.braceCounter != 0) {
            return {
                expectation: { message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'closingBrace','default'=>'closing brace','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'closingBrace','default'=>'closing brace','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
closing brace<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'closingBrace','default'=>'closing brace','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', rule: ')'},
                lastValidToken: tokenType,
                currentToken: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
END<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'end','default'=>'END','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
                success: false
            };
        }

        return true;
    },

    /**
     * Check the current token based on a given expected value
     *
     * @param token         The token we've got
     * @param tokenType     The token's type
     * @param expectation   What did the lexer expect?
     * @returns boolean
     */
    checkToken: function (token, tokenType, expectation) {
        var me = this,
            index;

        if (expectation == 'expression') {
            // todo: fix: don't hardcode (
            return tokenType == 'attribute' || tokenType == "nullaryOperators" || token == '(';
        }

        if (typeof expectation === 'string') {
            return tokenType == expectation || token == expectation;
        }

        // If array, check if operator matches
        if (expectation.indexOf) {
            index = Ext.each(expectation, function (rule) {
                // Simple operator comparision
                if (me.getOperators().indexOf(rule) > -1) {
                    if (rule == token) {
                        return false;
                    }
                    return;
                }

                var idx = token[rule.test ? 'search' : 'indexOf'](rule);
                if (idx > -1) {
                    return false;
                }
            });

            if (index === true) {
                return false;
            }
            return true;
        }

    },

    /**
     * Based on a given token and its type: Expect the next token
     *
     * @param token
     * @param tokenType
     * @returns Object
     */
    getExpectationForToken: function (token, tokenType) {
        var me = this;

        // First token
        if (token == 0) {
            me.setSuggestion(Object.keys(me.grammar.attributes).concat(Object.keys(me.grammar.nullaryOperators)));
            return { rules: 'expression', message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'expressionOrAttribute','default'=>'expression or attribute','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'expressionOrAttribute','default'=>'expression or attribute','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
expression or attribute<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'expressionOrAttribute','default'=>'expression or attribute','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
        }

        /**
         * Handle list - basically expect "(", ",", "value" or ")
         */
        if (me.inList) {
            if (token == ',' || token == '(') {
                me.setSuggestion('value');
                return { rules: me.grammar.values, message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'value','default'=>'Value','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'value','default'=>'Value','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'value','default'=>'Value','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
            }
            if (token == 'IN') {
                me.setSuggestion(['(']);
                return { rules: '(', message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'openingBrace','default'=>'(','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'openingBrace','default'=>'(','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
(<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'openingBrace','default'=>'(','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
            }
            if (tokenType == 'values') {
                me.setSuggestion([',', ')']);
                return { rules: [',', ')'], message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'commaOrBrace','default'=>', OR )','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'commaOrBrace','default'=>', OR )','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
, OR )<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'commaOrBrace','default'=>', OR )','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
            }
        }

        /**
         * Last token:  Bool operator like AND or OR
         * Expect:      New expression
         */
        if (tokenType == "boolOperators") {
            me.setSuggestion(Object.keys(me.grammar.attributes).concat(Object.keys(me.grammar.nullaryOperators)));
            return { rules: 'expression', message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'expression','default'=>'Expression','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'expression','default'=>'Expression','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expression<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'expression','default'=>'Expression','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
        }

        /**
         * Last token:  Opening brace
         * Expect:      New expression
         *
         * Last token:  Closing brace
         * Expect:      Bool operator
         *
         * Last token: Closing brace - braces not in balance
         * Expect:      Bool operators or closing brace
         */
        if (tokenType == "subOperators" && token != ')') {
            me.setSuggestion(Object.keys(me.grammar.attributes).concat(Object.keys(me.grammar.nullaryOperators)));
            return { rules: 'expression', message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'expression','default'=>'Expression','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'expression','default'=>'Expression','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expression<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'expression','default'=>'Expression','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
        } else if (tokenType == "subOperators" && token == ")" && me.braceCounter == 0) {
            me.setSuggestion(me.grammar.boolOperators);
            return { rules: 'boolOperators', message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'boolOperators','default'=>'boolOperators','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperators','default'=>'boolOperators','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
boolOperators<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperators','default'=>'boolOperators','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
        } else if (tokenType == "subOperators" && token == ")" && me.braceCounter != 0) {
            me.setSuggestion(me.grammar.boolOperators.concat([')']));
            return { rules: me.grammar.boolOperators.concat([')']), message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'boolOperatorsOrBrace','default'=>'boolOperators or )','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperatorsOrBrace','default'=>'boolOperators or )','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
boolOperators or )<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperatorsOrBrace','default'=>'boolOperators or )','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'};
        }

        /**
         * Last token:  Value, left side operator, atomic operator or value - Braces in balance
         * Expect:      bool operator
         *
         * Last token:  As above - but braces are not balanced
         * Expect:      bool operator or closing brace
         */
        if ((tokenType == 'unaryOperators' || tokenType == 'nullaryOperators' || tokenType == 'values') && me.braceCounter == 0) {
            me.setSuggestion(me.grammar.boolOperators);
            return { rules: 'boolOperators', message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'boolOperators','default'=>'boolOperators','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperators','default'=>'boolOperators','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
boolOperators<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperators','default'=>'boolOperators','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
        } else if (tokenType == 'nullaryOperators' || tokenType == 'unaryOperators' || tokenType == 'values') {
            me.setSuggestion(me.grammar.boolOperators.concat([')']));
            return { rules: me.grammar.boolOperators.concat([')']), message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'boolOperatorsOrBrace','default'=>'boolOperators or )','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperatorsOrBrace','default'=>'boolOperators or )','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
boolOperators or )<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'boolOperatorsOrBrace','default'=>'boolOperators or )','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'};
        }


        /**
         * Last token:  double sided operator
         * Expect:      value
         */
        if (tokenType == 'binaryOperators') {
            me.setSuggestion('value');
            return { rules: me.grammar[tokenType][token], message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'value','default'=>'Value','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'value','default'=>'Value','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'value','default'=>'Value','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'}
        }

        /**
         * Last token:  attribute
         * Expect:      an operator compatible to this attribute
         */
        if (tokenType == 'attribute') {
            me.setSuggestion(me.grammar.attributes[token]);
            return { rules: me.grammar.attributes[token], message: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'lexer'/'onOfThese','default'=>'one of these: ','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'onOfThese','default'=>'one of these: ','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
one of these: <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'lexer'/'onOfThese','default'=>'one of these: ','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
: ' + me.grammar.attributes[token].join(",")}
        }

        /**
         * Any other case is an unexpected / unknown token and will result in errors
         */
        console.log(token);
        console.log(tokenType);

    },

    /**
     * Determine the type of a given token by searching through the operators, attributes and values
     *
     * @param token
     * @returns string
     */
    getTokenType: function (token) {
        var me = this,
            operators,
            index;

        operators = me.getOperators('binaryOperators');
        index = operators.indexOf(token);
        if (index != -1) {
            return "binaryOperators";
        }

        operators = me.getOperators('unaryOperators');
        index = operators.indexOf(token);
        if (index != -1) {
            return "unaryOperators";
        }

        operators = me.getOperators('nullaryOperators');
        index = operators.indexOf(token);
        if (index != -1) {
            return "nullaryOperators";
        }

        index = me.grammar.boolOperators.indexOf(token);
        if (index != -1) {
            return "boolOperators";
        }

        index = me.grammar.subOperators.indexOf(token);
        if (index != -1) {
            return "subOperators";
        }

        index = Object.keys(me.grammar.attributes).indexOf(token);
        if (index != -1) {
            return "attribute";
        }

        index = Ext.each(me.grammar.values, function (rule) {
            var idx = token[rule.test ? 'search' : 'indexOf'](rule);
            if (idx > -1) {
                return false;
            }
        });
        if (index !== true) {
            return "values";
        }

        /**
         * Unknown tokens will result in an error
         */
        return "unknown";

    },

    /**
     * Get all available operators as string
     *
     * @param operator
     * @returns Array
     */
    getOperators: function (operator) {
        var me = this;

        if (operator) {
            return Object.keys(me.grammar[operator]);
        } else {
            return Object.keys(me.grammar.unaryOperators).concat(Object.keys(me.grammar.binaryOperators), Object.keys(me.grammar.nullaryOperators));
        }
    }
});

<?php }} ?>