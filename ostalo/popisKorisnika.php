<?php

$naslov = 'Popis korisnika';
$navigacija = 'ostalo/popisKorisnika.php';
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

function kreirajNavigacijuRegKorisnika() {
    return "<div class='navigacijaNatjecanja'>
                <a href='lokacije.php'>Lokacije</a>
                <a href='zahtjeviZaProglasenje.php'>Zahtjevi</a>
                <a href='statistikaPrijava.php'>Statistika</a>
                <a href='popisKorisnika.php'>Korisnici</a>
            </div>";
}

function IspisKorisnika() {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT id_korisnika, ime, prezime, korisnicko_ime, status.naziv FROM korisnik, status  WHERE korisnik.status=status.id_statusa";
    $str = "";
    $rezultat = $veza->selectDB($sql);
    while (list($id, $ime, $prezime, $korime, $status) = $rezultat->fetch_array()) {
        $str = $str . "<tr>"
                . "<td>$ime</td>"
                . "<td>$prezime</td>"
                . "<td>$korime</td>"
                . "<td>$status</td>"
                . "<td>". KreirajGumbStatusa($id, $status)."</td>"
                . "</tr>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

$IspisSvihKorisnika = IspisKorisnika();
$smarty->assign('IspisSvihKorisnika', $IspisSvihKorisnika);

$kreacijaNavigacije = "";
if (isset($_SESSION["korisnik"])) {
    $kreacijaNavigacije = kreirajNavigacijuRegKorisnika();
}
$smarty->assign('kreacijaNavigacije', $kreacijaNavigacije);

function KreirajGumbStatusa($id, $status) {
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
        if ($status == 'nije blokiran') {
            return "<form method='post' action=''>
            <input class='gumbDetalji' name='blokiraj' type='submit' value=' Blokiraj '>
            <input name='actionBlokiraj' type='hidden' value='$id'/>
        </form>";
        } else {
            return "<form method='post' action=''>
            <input class='gumbDetalji' name='odBlokiraj' type='submit' value=' Odblokiraj '>
            <input name='actionOdBlokiraj' type='hidden' value='$id'/>
        </form>";
        }
    } else {
        return "";
    }
}

if(isset($_POST['blokiraj'])){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "UPDATE korisnik SET status=2  WHERE id_korisnika={$_POST['actionBlokiraj']}";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
    header("Refresh:0");
}
if(isset($_POST['odBlokiraj'])){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "UPDATE korisnik SET status=1,broj_pokusaja=0  WHERE id_korisnika={$_POST['actionOdBlokiraj']}";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
    header("Refresh:0");
}


$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('popisKorisnik.tpl');
$smarty->display('podnozje.tpl');
?>



