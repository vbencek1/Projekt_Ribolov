<?php

$naslov = 'Aktivacija';
$navigacija = 'skripte/aktivacijaRacuna.php';
include_once'../zaglavlje.php';
$smarty->assign('navigacija', $navigacija);

$putanja = "../";
$smarty->assign('putanja', $putanja);


require '../vanjske_biblioteke/baza.class.php';
require '../vanjske_biblioteke/sesija.class.php';

function AktivirajRacun() {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "UPDATE korisnik SET aktiviran_racun='da' WHERE korisnicko_ime='{$_POST['korime']}'";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

function DajKod() {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT aktivacijski_kod FROM korisnik WHERE korisnicko_ime='{$_POST['korime']}'";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($kod) = $rezultat->fetch_array()) {
        $str = $kod;
    }
    $veza->zatvoriDB();
    return $str;
}

$porukaAktivacije = "";
if (isset($_POST['submit'])) {
    if (DajKod() == $_POST['kod'] && !empty($_POST['korime'])) {
        AktivirajRacun();
        header("Location: ../obrasci/prijava.php");
    } else {
        $porukaAktivacije = "Neispravni podaci";
    }
}
$smarty->assign('porukaAktivacije', $porukaAktivacije);

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('aktivacijaRacuna.tpl');
$smarty->display('podnozje.tpl');
?>