<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 07:06:37
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\application\Shopware.model.DataOperation.js" */ ?>
<?php /*%%SmartyHeaderCode:22635acd97dd5d77f9-91004001%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cb6171dbc900a39682226c876fe65171f50a167' => 
    array (
      0 => 'E:\\wamp\\www\\shopware4\\themes\\Backend\\ExtJs\\backend\\base\\application\\Shopware.model.DataOperation.js',
      1 => 1522728756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22635acd97dd5d77f9-91004001',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acd97dd5f9540_40698809',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acd97dd5f9540_40698809')) {function content_5acd97dd5f9540_40698809($_smarty_tpl) {?>
//
//

Ext.define('Shopware.model.DataOperation', {

    extend:'Ext.data.Model',

    phantom: true,

    fields:[
        { name: 'success', type: 'boolean' },
        { name: 'request' },
        { name: 'error', type: 'string' },
        { name: 'operation' },
    ]
});
//
<?php }} ?>