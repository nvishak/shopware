<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:17
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\attribute_config.js" */ ?>
<?php /*%%SmartyHeaderCode:275045acda8e5794a51-43353783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d7443a0588284d7cd7ac7c6a3f638e61d79d363' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\store\\attribute_config.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '275045acda8e5794a51-43353783',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e579a923_98082981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e579a923_98082981')) {function content_5acda8e579a923_98082981($_smarty_tpl) {?>
Ext.define('Shopware.store.AttributeConfig', {
    extend: 'Shopware.store.Listing',
    model: 'Shopware.model.AttributeConfig',
    remoteSort: false,

    configure: function() {
        return {
            controller: 'AttributeData'
        }
    }
});
<?php }} ?>