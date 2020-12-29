<?php

$naslov = 'Statistika';
$navigacija = 'ostalo/statistikaPrijava.php';
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

function BrojacOdobrenih($id){
    $veza = new Baza();
    $veza->spojiDB();
    $sql="select count(zahtjev_za_prijavu_na_natjecanje.odobreno) from natjecanje, ribicki_klub, zahtjev_za_prijavu_na_natjecanje where zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje and natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub and odobreno=1 and id_ribicki_klub={$id}";
    $rezultat = $veza->selectDB($sql);
    while(list($broj)=$rezultat->fetch_array()){ $str=$broj;}
    $veza->zatvoriDB();
    return $str;
}
function BrojacOdbijenih($id){
    $veza = new Baza();
    $veza->spojiDB();
    $sql="select count(zahtjev_za_prijavu_na_natjecanje.odobreno) from natjecanje, ribicki_klub, zahtjev_za_prijavu_na_natjecanje where zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje and natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub and odobreno=2 and id_ribicki_klub={$id}";
    $rezultat = $veza->selectDB($sql);
    while(list($broj)=$rezultat->fetch_array()){ $str=$broj;}
    $veza->zatvoriDB();
    return $str;
}

function IspisKlubova(){
    $veza = new Baza();
    $veza->spojiDB();
    $sql="SELECT id_ribicki_klub, naziv FROM  ribicki_klub";
    $str="";
    $rezultat = $veza->selectDB($sql);
    while(list($id, $naziv)=$rezultat->fetch_array()){
        $str=$str."<tr>"
                . "<td>$naziv". KreirajGumbLokacija($id)."</td>"
                . "<td>". BrojacOdobrenih($id)."</td>"
                . "<td>". BrojacOdbijenih($id)."</td>"
                . "</tr>\n";
        
    }
    $veza->zatvoriDB();
    return $str;
}

$IspisSvihKlubovaP = IspisKlubova();
$smarty->assign('IspisSvihKlubovaP', $IspisSvihKlubovaP);

$kreacijaNavigacije = "";
if (isset($_SESSION["korisnik"])) {
    $kreacijaNavigacije = kreirajNavigacijuRegKorisnika();
}
$smarty->assign('kreacijaNavigacije', $kreacijaNavigacije);


function KreirajGumbLokacija($id) {
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
            return "<form method='post' action='statistikaLokacija.php'>
            <input class='gumbDetalji' name='lokacija' type='submit' value=' Lokacije '>
            <input name='actionLokacija' type='hidden' value='$id'/>
        </form>";
    } else {
        return "";
    }
}

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('statistikaPrijava.tpl');
$smarty->display('podnozje.tpl');
?>



