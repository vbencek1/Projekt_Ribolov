<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-21 18:57:09
         compiled from "C:\xampp\htdocs\Projekt_Ribolov\templates\zaglavlje.tpl" */ ?>
<?php /*%%SmartyHeaderCode:98429585ce42de579ef57-58669061%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '969ecc4dee1db21b1dc60cfa7dd6b601867103f1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekt_Ribolov\\templates\\zaglavlje.tpl',
      1 => 1558456913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '98429585ce42de579ef57-58669061',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'naslov' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5ce42de5959956_36404275',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ce42de5959956_36404275')) {function content_5ce42de5959956_36404275($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\Projekt_Ribolov\\vanjske_biblioteke\\Smarty\\libs\\plugins\\modifier.date_format.php';
?><?php  $_config = new Smarty_Internal_Config("konfiguracija.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<!DOCTYPE html>
<html lang="hr">
    <head>
<title><?php echo $_smarty_tpl->tpl_vars['naslov']->value;?>
</title>
        <meta charset="UTF-8">
        <meta name="Autor" content="<?php echo $_smarty_tpl->getConfigVariable('autor');?>
">
        <meta name="Kljucne rijeci" content="autor;nogomet;automobil;vrijeme;fortnite;">
        <meta name="Naslov" content="Početna stranica">
        <meta name="Datum" content="<?php echo smarty_modifier_date_format(time(),"%d.%m.%Y %H: %M: %S");?>
">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php }} ?>
