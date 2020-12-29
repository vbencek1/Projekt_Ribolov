<?php

error_reporting(E_ALL);  //faza razvoja
//error_reporting(0);   //produkcija

$putanja = dirname(__FILE__);
require_once "$putanja/vanjske_biblioteke/Smarty/libs/Smarty.class.php";

$smarty=new Smarty();

$smarty->setTemplateDir($putanja . DS . 'templates' . DS)
        ->setCompileDir($putanja . DS . 'templates_c' . DS)
        ->setPluginsDir(SMARTY_PLUGINS_DIR)
        ->setCacheDir($putanja . DS . 'cache' . DS)
        ->setConfigDir($putanja . DS . 'configs' . DS);

$smarty->assign('naslov',$naslov);
$smarty->display('zaglavlje.tpl');