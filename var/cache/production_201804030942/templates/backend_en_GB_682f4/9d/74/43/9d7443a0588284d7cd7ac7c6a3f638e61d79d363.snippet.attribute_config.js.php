<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:40
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\store\attribute_config.js" */ ?>
<?php /*%%SmartyHeaderCode:87325acd97e065c7e5-92173391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '87325acd97e065c7e5-92173391',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97e066ec97_77640844',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97e066ec97_77640844')) {function content_5acd97e066ec97_77640844($_smarty_tpl) {?>
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