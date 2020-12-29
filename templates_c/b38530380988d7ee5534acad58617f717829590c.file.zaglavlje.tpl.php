<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-13 10:23:59
         compiled from "/var/www/webdip.barka.foi.hr/2018/zadaca_04/vbencek/templates/zaglavlje.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4443791065cd916c10867d4-23726450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b38530380988d7ee5534acad58617f717829590c' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2018/zadaca_04/vbencek/templates/zaglavlje.tpl',
      1 => 1557735695,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4443791065cd916c10867d4-23726450',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cd916c10a3cc8_66961560',
  'variables' => 
  array (
    'naslov' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd916c10a3cc8_66961560')) {function content_5cd916c10a3cc8_66961560($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/webdip.barka.foi.hr/2018/zadaca_04/vbencek/vanjske_biblioteke/Smarty/libs/plugins/modifier.date_format.php';
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
