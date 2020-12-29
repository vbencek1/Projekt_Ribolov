       
<?php
$greska = "";
$poruka = "";
$naslov='Početna stranica';
$navigacija='index.php';


include_once'./zaglavlje.php';
require 'vanjske_biblioteke/sesija.class.php';
require 'vanjske_biblioteke/baza.class.php';

sesija::kreirajSesiju();

$putanja="";
$smarty->assign('putanja',$putanja);

$smarty->assign('navigacija',$navigacija);
$smarty->assign('greska', $greska);
$smarty->assign('poruka', $poruka);
$smarty->assign('aktivnaSkripta',$_SERVER["PHP_SELF"]);
$smarty->display('index.tpl');
$smarty->display('podnozje.tpl');


?>
        
    

