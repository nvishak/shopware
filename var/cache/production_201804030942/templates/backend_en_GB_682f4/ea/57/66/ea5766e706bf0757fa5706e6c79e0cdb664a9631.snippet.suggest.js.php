<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:31
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\article_list\controller\suggest.js" */ ?>
<?php /*%%SmartyHeaderCode:215615acda8f334a981-96808718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea5766e706bf0757fa5706e6c79e0cdb664a9631' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\article_list\\controller\\suggest.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '215615acda8f334a981-96808718',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8f34108b3_12401807',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8f34108b3_12401807')) {function content_5acda8f34108b3_12401807($_smarty_tpl) {?>/**
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
 * Currently there is in Shopware no way to include those resources other than with these smarty includes
 */
// <?php echo $_smarty_tpl->getSubTemplate ('backend/article_list/resource/lexer.js', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

// <?php echo $_smarty_tpl->getSubTemplate ('backend/article_list/resource/parser.js', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

// <?php echo $_smarty_tpl->getSubTemplate ('backend/article_list/resource/tokenizer.js', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


/**
 *
 */
//
Ext.define('Shopware.apps.ArticleList.controller.Suggest', {

    /**
     * The parent class that this class extends.
     * @string
     */
    extend: 'Ext.app.Controller',

    parser: null,

    refs: [
        { ref:'batchEditButton', selector:'multiedit-main-window button[name=batchEdit]' },
        { ref:'runButton', selector:'query-field button[name=run-button]' },
        { ref:'simpleRunButton', selector:'multi-edit-add-filter-grid button[name=run-button-simple]' },
        { ref:'statusLabel', selector:'query-field label[name=status-label]' },
        { ref:'statusLabelSimple', selector:'multi-edit-add-filter-grid label[name=status-label-simple]' },
        { ref:'filterCombo', selector:'query-field combo[name=filterString]' },
        { ref:'mainWindow', selector:'shopware-multiedit-main-window' }
    ],

    /**
     * A template method that is called when your application boots.
     * It is called before the Application's launch function is executed
     * so gives a hook point to run any code before your Viewport is created.
     *
     * @return void
     */
    init: function () {
        var me = this;

        me.createParser();

        me.control({
            'query-field': {
                suggest: me.onShowSuggestion
            },
            'query-field combo': {
                select: me.onSuggestionSelected
            }
        });

        me.callParent(arguments);
    },

    /**
     * Run through the grammar object and create RegExps when needed
     *
     * @param grammar
     * @returns Object
     */
    prepareGrammar: function(grammar)  {
        var me = this;


        Ext.each(Object.keys(grammar.binaryOperators), function(key) {
            var items = grammar.binaryOperators[key];

            Ext.each(items, function(item, idx) {
                if (item.charAt(item.length-1) == '/' && item.charAt(0) == '/') {

                    grammar.binaryOperators[key][idx] = new RegExp(item.slice(1).slice(0,-1));
                }
            });
        });

        Ext.each(grammar.values, function(item, idx) {
            if (item.charAt(item.length-1) == '/' && item.charAt(0) == '/') {

                grammar.values[idx] = new RegExp(item.slice(1).slice(0,-1));
            }
        });

        return grammar;

    },

    /**
     * Creates the parser. Will request the grammar object from remote.
     *
     */
    createParser: function() {
        var me = this;

        Ext.Ajax.request({
            url: '<?php echo '/shopware4/backend/ArticleList/getGrammar';?>',
            params : {
                resource: 'product'
            },
            method: 'GET',
            success: function (response, request) {
                var result = Ext.JSON.decode(response.responseText);

                if(!result) {
                    me.showError(response.responseText);
                }else if(result.success) {
                    var grammar = me.prepareGrammar(result.data);

                    me.parser = new Parser(grammar);

                    me.subApplication.fireEvent('grammarProcessed', grammar);
                    return;
                }
                me.showError(result.message);

            },
            failure: function (response, request) {
                if(response.responseText) {
                    me.showError(response.responseText);
                } else {
                    me.showError('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
An unknown error occurred, please check your server logs<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'unknownError','default'=>'An unknown error occurred, please check your server logs','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                }
            }
        });

    },

    /**
     * Convenience method to show a sticky growl message
     *
     * @param message
     */
    showError: function(message) {
        var me = this;

        Shopware.Notification.createStickyGrowlMessage({
            title: '<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'error','default'=>'Error','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error','default'=>'Error','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'error','default'=>'Error','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
            text: message,
            log: true
        },
        'ArticleList');
    },

    /**
     * Returns instance of the parser
     * @returns null
     */
    getParser: function() {
        var me = this;
        return me.parser;
    },


    /**
     * Actually do show suggestions in the combobox; depending on the type of suggestion, local or remote
     * suggestions are shown
     *
     * @param suggestion
     * @param lastSeenAttribute
     * @param lastToken
     * @param lastValidToken
     */
    showSuggestions: function(suggestion, lastSeenAttribute, lastToken, lastValidToken)  {
        var me = this,
            combo = me.getFilterCombo(),
            parser = me.getParser(),
            i;

        // If we got an array of suggestions, we just set that
        if (suggestion != 'value') {
            combo.showSuggestion(suggestion, lastToken, false);
            return;
        }

        // Check if the lastSeenAttribute is valid - if not, no remote request will be performed
        var attributes = Object.keys(me.getParser().grammar.attributes);
        var attributesLength = attributes.length;

        lastSeenAttribute = lastSeenAttribute.toUpperCase();

        for (i=0;i<attributesLength;i++) {
           if (lastSeenAttribute == attributes[i].toUpperCase()) {
               // Get the suggested values from remote
               var params = {
                   resource: 'product',
                   attribute: lastSeenAttribute
               };

               combo.showRemoteSuggestion(params, lastToken, lastValidToken);
               return;
           }
        }

        // If attribute was not valid, collapse suggestion box
        combo.collapse();
    },

    /**
     * A suggestion was selected and needs to be shown in the combo
     *
     * @param combo
     * @param suggestion
     */
    onSuggestionSelected: function(combo, suggestion) {
        var me = this,
            tokens = me.getParser().lexer.tokens,
            lastToken = tokens ? tokens.slice(-1).pop() : "";

        combo.insertSuggestion(suggestion, lastToken);
    },

    /**
     * Returns a token array from a given string
     *
     * @param string
     * @returns Array
     */
    getTokensFromString: function(string) {
        var me = this;

        me.getParser().parse(string);
        return me.getParser().getAst();
    },

    /**
     * Returns the simple result representation of the given query string
     * Will return false if the result is not simple or invalid
     *
     * @param string
     * @returns Boolean|Array
     */
    getSimpleResult: function(string) {
        var me = this;

        me.getParser().parse(string);
        return me.getParser().getSimpleResult();
    },

    /**
     * Callback function triggered when a suggestion needs to be shown
     *
     * @param string
     * @param cursorPosition
     */
    onShowSuggestion: function(string, cursorPosition) {
        var me = this,
            firstResult, secondResult,
            stringUntilCurrentPosition;

        if (!string) {
            string = "";
        }

        if (!isNaN(cursorPosition)) {
            stringUntilCurrentPosition = string.substring(0, cursorPosition);
        }

        var firstResult = me.getParser().parse(stringUntilCurrentPosition);

        me.showSuggestions(
            me.getParser().getSuggestion(),
            me.getParser().getLastSeenAttribute(),
            me.getParser().lexer.tokens.slice(-1).pop(),
            me.getParser().lexer.lastToken || undefined
        );

        if (string != stringUntilCurrentPosition) {
            var secondResult = me.getParser().parse(string);
            me.setStatus();
        } else {
            me.setStatus();

        }
    },

    /**
     * Check if a given filter is valid
     *
     * @param filterString
     * @returns boolean
     */
    isFilterValid: function(filterString) {
        var me = this;

        if (!filterString || filterString == '') {
            return false;
        }

        return me.getParser().parse(filterString);
    },

    /**
     * Loads a given filterString and show products, which do match that filter
     *
     * @param filterString
     * @param name
     * @returns boolean
     */
    loadFilter: function(filterString, name) {
        var me = this,
            batchEditButton = me.getBatchEditButton(),
            mainWindow = me.getController('Main').mainWindow,
            result = me.getParser().parse(filterString);

        if (result) {
            me.subApplication.currentFilterName = name;
            me.subApplication.currentFilterString = filterString;
            me.subApplication.articleStore.getProxy().extraParams = {
                resource: 'product',
                ast: Ext.JSON.encode(me.getParser().getAst())
            };
            me.subApplication.articleStore.loadPage(1, { callback: function () {
                me.getController('BatchProcess').updateBatchProcessWindow();
                mainWindow.setWindowTitle(name);
            }});
            batchEditButton.enable();
            return true;
        } else {
            me.showError(Ext.String.format('<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'parserError','default'=>'Could not parse the string [0]: [1]','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'parserError','default'=>'Could not parse the string [0]: [1]','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Could not parse the string \'[0]\': <br><br>[1]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'parserError','default'=>'Could not parse the string [0]: [1]','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', filterString, me.getErrorMessage()));
            batchEditButton.disable();
            return false;
        }
    },

    /**
     * Read the last error message from parser
     *
     * @returns string
     */
    getErrorMessage: function() {
        var me = this,
            error = me.getParser().getError(),
            context;

        // Rename the first token
        if (error.lastValidToken == 0) {
            context = error.context ? ' ' + error.context : "<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'expectedErrorMessage'/'begin','default'=>' at Begin','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expectedErrorMessage'/'begin','default'=>' at Begin','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
 at Begin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expectedErrorMessage'/'begin','default'=>' at Begin','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
";
        } else {
            context = error.context ? ' ' + error.context : Ext.String.format("<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'expectedErrorMessage'/'after','default'=>' after [0]','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expectedErrorMessage'/'after','default'=>' after [0]','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
 after [0]<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expectedErrorMessage'/'after','default'=>' after [0]','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
", error.lastValidToken);
        }
        return Ext.String.format("<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'expectedErrorMessage','default'=>'Expected [0] got [1] instead','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expectedErrorMessage','default'=>'Expected [0] got [1] instead','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expected [0] got [1] instead<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'expectedErrorMessage','default'=>'Expected [0] got [1] instead','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
", error.expectation.message + context, error.currentToken);
    },

    /**
     * Sets the status indicator in order to give the user feedback whether his query is valid or not
     */
    setStatus: function() {
        var me = this,
            error = me.getParser().getError(),
            combo = me.getFilterCombo(),
            runButton = me.getRunButton(),
            simpleRunButton = me.getSimpleRunButton(),
            simpleLabel = me.getStatusLabelSimple(),
            label = me.getStatusLabel();

        if (!error || error == false) {
            Ext.get(combo.inputEl).setStyle('background', '#C7F5AA');
            label.setText("<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'noErrorDetected','default'=>'No error detected','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'noErrorDetected','default'=>'No error detected','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No error detected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'noErrorDetected','default'=>'No error detected','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
            simpleLabel.setText("<?php $_smarty_tpl->smarty->_tag_stack[] = array('snippet', array('name'=>'addFilter'/'noErrorDetected','default'=>'No error detected','namespace'=>'backend/article_list/main')); $_block_repeat=true; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'noErrorDetected','default'=>'No error detected','namespace'=>'backend/article_list/main'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No error detected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo Enlight_Components_Snippet_Resource::compileSnippetBlock(array('name'=>'addFilter'/'noErrorDetected','default'=>'No error detected','namespace'=>'backend/article_list/main'), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
            runButton.enable();
            simpleRunButton.enable();
        } else {
            Ext.get(combo.inputEl).setStyle('background', '#FFB0AD');
            label.setText(me.getErrorMessage());
            simpleLabel.setText(me.getErrorMessage());
            runButton.disable();
            simpleRunButton.disable();
        }

        try {
            combo.alignPicker();
        } catch (e) {
            // The picker might not be available
        }


    }
});
//
<?php }} ?>