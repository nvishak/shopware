<?php /* Smarty version Smarty-3.1.12, created on 2018-04-11 08:19:14
         compiled from "E:\wamp\www\shopware4\themes\Backend\ExtJs\backend\base\application\Shopware.model.DataOperation.js" */ ?>
<?php /*%%SmartyHeaderCode:159955acda8e2d27073-81347717%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '159955acda8e2d27073-81347717',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5acda8e2d338e2_06142581',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5acda8e2d338e2_06142581')) {function content_5acda8e2d338e2_06142581($_smarty_tpl) {?>
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