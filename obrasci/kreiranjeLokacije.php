<?php

$naslov = 'Kreiranje lokacije';
$navigacija = 'obrasci/kreiranjeLokacije.php';
$putanja = "../";

include_once'../zaglavlje.php';

$smarty->assign('navigacija', $navigacija);
$smarty->assign('putanja', $putanja);

require '../vanjske_biblioteke/sesija.class.php';
require '../vanjske_biblioteke/baza.class.php';

sesija::kreirajSesiju();
if (!isset($_SESSION["korisnik"])) {
    header('Location: prijava.php');
}
if (!isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 3) {
    header('Location: ../index.php');
}
if (!isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 2) {
    header('Location: ../index.php');
}

if (isset($_POST['actionUpdate'])) {
    $_SESSION['idLokacije'] = $_POST['actionUpdate'];
}



function PopuniGradove($veza, $gradReturn) {
    $sql = "SELECT id_grad, naziv FROM grad";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($id, $naziv) = $rezultat->fetch_array()) {
        $str = $str . "<option value='$id'" . IzabranaOpcija($id, $gradReturn) . ">$naziv</option>\n";
    }
    return $str;
}

function IzabranaOpcija($id, $izabrani) {
    if ($id == $izabrani) {
        return "selected";
    } else {
        return "";
    }
}

function DajIdKorisnika() {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT id_korisnika FROM korisnik WHERE korisnicko_ime='{$_SESSION['korisnik']}'";
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($id) = $rezultat->fetch_array()) {
        $ispis = $id;
    }
    $veza->zatvoriDB();
    return $ispis;
}

function UnosLokacijeUBazu() {
    $veza = new Baza();
    $veza->spojiDB();
    $naziv = $_POST['naziv'];
    $duljina = $_POST['duljina'];
    $grad = $_POST['grad'];
    $administrator = DajIdKorisnika();

    $sql = "INSERT INTO lokacija(naziv_rijeke, "
            . "duljina, "
            . "grad, "
            . "administrator) VALUES ('{$naziv}', {$duljina}, {$grad}, {$administrator})";

    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

function AzuriranjeLokacije() {
    $veza = new Baza();
    $veza->spojiDB();
    $naziv = $_POST['naziv'];
    $duljina = $_POST['duljina'];
    $grad = $_POST['grad'];
    $administrator = DajIdKorisnika();

    $sql = "UPDATE lokacija SET naziv_rijeke='{$naziv}', "
            . "duljina={$duljina}, "
            . "grad={$grad}, "
            . "administrator={$administrator} WHERE id_lokacija={$_SESSION['idLokacije']}";

    $veza->selectDB($sql);
    $veza->zatvoriDB();
}


$veza = new Baza();
$veza->spojiDB();
$nazivReturn = "";
$duljinaReturn = "";
$gradReturn = "";
if (isset($_SESSION['idLokacije'])) {
    $sql = "SELECT naziv_rijeke, duljina, grad  FROM lokacija WHERE id_lokacija={$_SESSION['idLokacije']} ";
    $rezultat = $veza->selectDB($sql);
    while (list($nazivA, $duljinaA, $gradA) = $rezultat->fetch_array()) {
        $nazivReturn = $nazivA;
        $duljinaReturn = $duljinaA;
        $gradReturn = $gradA;
        
    }
}

$listaGradova = PopuniGradove($veza, $gradReturn);
$veza->zatvoriDB();
$smarty->assign('nazivReturn', $nazivReturn);
$smarty->assign('duljinaReturn', $duljinaReturn);
$smarty->assign('listaGradova', $listaGradova);

$porukaIspisa = "";
if (!isset($_SESSION['idLokacije'])) {
    if (isset($_POST['submit']) && !empty($_POST['naziv']) && !empty($_POST['duljina']) && !empty($_POST['grad'])) {
        UnosLokacijeUBazu();
        $porukaIspisa = "Lokacija je uspješno kreirana";
    } else {
        $porukaIspisa = "Sva polja moraju biti popunjena";
    }
}else{
    if (isset($_POST['submit']) && !empty($_POST['naziv']) && !empty($_POST['duljina']) && !empty($_POST['grad'])) {
        AzuriranjeLokacije();
        unset($_SESSION['idLokacije']);
        $porukaIspisa = "Lokacija je uspješno ažurirana";
    } else {
        $porukaIspisa = "*sva polja moraju biti popunjena";
    }
}
$smarty->assign('porukaIspisa', $porukaIspisa);

if(isset($_POST['nazad'])){
    unset($_SESSION['idLokacije']);
}


$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('kreiranjeLokacije.tpl');
$smarty->display('podnozje.tpl');
?>