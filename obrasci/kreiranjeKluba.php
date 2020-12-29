<?php

$naslov = 'Kreiranje kluba';
$navigacija = 'obrasci/kreiranjeKluba.php';
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
    $_SESSION['idKlubaA'] = $_POST['actionUpdate'];
}

function PopuniModeratore($veza, $moderatorReturn) {
    $sql = "SELECT id_korisnika, ime, prezime FROM korisnik where status=1";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($id, $ime, $prezime) = $rezultat->fetch_array()) {
        $str = $str . "<option value='$id'" . IzabranaOpcija($id, $moderatorReturn) . ">" . $ime . " " . $prezime . "</option>\n";
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

function UnosKlubaUBazu() {
    $veza = new Baza();
    $veza->spojiDB();
    $naziv = $_POST['naziv'];
    $adresa = $_POST['adresa'];
    $predsjednik = $_POST['predsjednik'];
    $email = $_POST['email'];
    $webAdresa = $_POST['webAdresa'];
    $datumKreiranja = date("y-m-d");
    $moderator = $_POST['moderator'];
    $administrator = DajIdKorisnika();

    $sql = "INSERT INTO ribicki_klub(naziv, "
            . "adresa, "
            . "predsjednik, "
            . "email, "
            . "web_adresa, "
            . "datum_kreiranja, "
            . "moderator,"
            . "administrator) VALUES ('{$naziv}', '{$adresa}', "
            . "'{$predsjednik}', '{$email}','{$webAdresa}' ,'{$datumKreiranja}', {$moderator},{$administrator})";

    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

function AzuriranjeKluba() {
    $veza = new Baza();
    $veza->spojiDB();
    $naziv = $_POST['naziv'];
    $adresa = $_POST['adresa'];
    $predsjednik = $_POST['predsjednik'];
    $email = $_POST['email'];
    $webAdresa = $_POST['webAdresa'];
    $moderator = $_POST['moderator'];
    $administrator = DajIdKorisnika();

    $sql = "UPDATE ribicki_klub SET naziv='{$naziv}', "
            . "adresa='{$adresa}', "
            . "predsjednik='{$predsjednik}', "
            . "email='{$email}', "
            . "web_adresa='{$webAdresa}', "
            . "moderator={$moderator}, "
            . "administrator={$administrator} WHERE id_ribicki_klub={$_SESSION['idKlubaA']}";

    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

function AzuriranjeModeratora() {
    $veza = new Baza();
    $veza->spojiDB();
    $moderator = $_POST['moderator'];
    $sql = "UPDATE korisnik SET  uloga_id_uloga=2 WHERE id_korisnika=$moderator AND uloga_id_uloga=3";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

$veza = new Baza();
$veza->spojiDB();
$nazivReturn = "";
$adresaReturn = "";
$predsjednikReturn = "";
$emailReturn = "";
$webAdresaReturn = "";
$moderatorReturn = "";
if (isset($_SESSION['idKlubaA'])) {
    $sql = "SELECT naziv,adresa, predsjednik, email, web_adresa, moderator FROM ribicki_klub WHERE id_ribicki_klub={$_SESSION['idKlubaA']} ";
    $rezultat = $veza->selectDB($sql);
    while (list($nazivA, $adresaA, $predsjednikA, $emailA, $webAdresaA, $moderatorA) = $rezultat->fetch_array()) {
        $nazivReturn = $nazivA;
        $adresaReturn = $adresaA;
        $predsjednikReturn = $predsjednikA;
        $emailReturn = $emailA;
        $webAdresaReturn = $webAdresaA;
        $moderatorReturn = $moderatorA;
    }
}

$listaModeratora = PopuniModeratore($veza, $moderatorReturn);
$veza->zatvoriDB();
$smarty->assign('nazivReturn', $nazivReturn);
$smarty->assign('adresaReturn', $adresaReturn);
$smarty->assign('predsjednikReturn', $predsjednikReturn);
$smarty->assign('emailReturn', $emailReturn);
$smarty->assign('webAdresaReturn', $webAdresaReturn);
$smarty->assign('moderatorReturn', $moderatorReturn);
$smarty->assign('listaModeratora', $listaModeratora);

$porukaIspisa = "";
if (!isset($_SESSION['idKlubaA'])) {
    if (isset($_POST['submit']) && !empty($_POST['naziv']) && !empty($_POST['email']) && !empty($_POST['predsjednik']) && !empty($_POST['moderator']) && !empty($_POST['webAdresa']) && !empty($_POST['adresa'])) {
        UnosKlubaUBazu();
        AzuriranjeModeratora();
        $porukaIspisa = "Ribički klub je uspješno kreiran";
    } else {
        $porukaIspisa = "Sva polja moraju biti popunjena";
    }
}else{
    if (isset($_POST['submit']) && !empty($_POST['naziv']) && !empty($_POST['email']) && !empty($_POST['predsjednik']) && !empty($_POST['moderator']) && !empty($_POST['webAdresa']) && !empty($_POST['adresa'])) {
        AzuriranjeKluba();
        AzuriranjeModeratora();
        unset($_SESSION['idKlubaA']);
        $porukaIspisa = "Ribički klub je uspješno ažuriran";
    } else {
        $porukaIspisa = "*sva polja moraju biti popunjena";
    }
}
$smarty->assign('porukaIspisa', $porukaIspisa);

if(isset($_POST['nazad'])){
    unset($_SESSION['idKlubaA']);
}

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('kreiranjeKluba.tpl');
$smarty->display('podnozje.tpl');
?>
    
