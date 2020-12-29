<?php

$naslov = 'Statistika';
$navigacija = 'ostalo/statistikaLokacija.php';
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

if(isset($_POST['actionLokacija'])){
    $_SESSION['idKlubaP']=$_POST['actionLokacija'];
}

function BrojacOdobrenih($id){
    $veza = new Baza();
    $veza->spojiDB();
    $sql="select count(zahtjev_za_prijavu_na_natjecanje.odobreno) from natjecanje, ribicki_klub, zahtjev_za_prijavu_na_natjecanje,lokacija where zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje and natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub  and lokacija.id_lokacija=natjecanje.lokacija and odobreno=1 and id_ribicki_klub={$_SESSION['idKlubaP']} and id_lokacija={$id}";
    $rezultat = $veza->selectDB($sql);
    while(list($broj)=$rezultat->fetch_array()){ $str=$broj;}
    $veza->zatvoriDB();
    return $str;
}
function BrojacOdbijenih($id){
    $veza = new Baza();
    $veza->spojiDB();
    $sql="select count(zahtjev_za_prijavu_na_natjecanje.odobreno) from natjecanje, ribicki_klub, zahtjev_za_prijavu_na_natjecanje,lokacija where zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje and natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub  and lokacija.id_lokacija=natjecanje.lokacija and odobreno=2 and id_ribicki_klub={$_SESSION['idKlubaP']} and id_lokacija={$id}";
    $rezultat = $veza->selectDB($sql);
    while(list($broj)=$rezultat->fetch_array()){ $str=$broj;}
    $veza->zatvoriDB();
    return $str;
}

function IspisLokacija(){
    $veza = new Baza();
    $veza->spojiDB();
    $sql="SELECT DISTINCT id_lokacija, naziv_rijeke, grad.naziv FROM  ribicki_klub, lokacija, natjecanje, grad WHERE grad.id_grad=lokacija.grad AND ribicki_klub.id_ribicki_klub=natjecanje.ribicki_klub and natjecanje.lokacija=lokacija.id_lokacija and ribicki_klub.id_ribicki_klub={$_SESSION['idKlubaP']} ";
    $str="";
    $rezultat = $veza->selectDB($sql);
    while(list($id, $naziv, $grad)=$rezultat->fetch_array()){
        $str=$str."<tr>"
                . "<td>$naziv $grad</td>"
                . "<td>". BrojacOdobrenih($id)."</td>"
                . "<td>". BrojacOdbijenih($id)."</td>"
                . "</tr>\n";
        
    }
    $veza->zatvoriDB();
    return $str;
}

$IspisSvihLokacijaP = IspisLokacija();
$smarty->assign('IspisSvihLokacijaP', $IspisSvihLokacijaP);

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

function kreirajNavigacijuRegKorisnika() {
    return "<div class='navigacijaNatjecanja'>
                <a href='lokacije.php'>Lokacije</a>
                <a href='zahtjeviZaProglasenje.php'>Zahtjevi</a>
                <a href='statistikaPrijava.php'>Statistika</a>
                <a href='popisKorisnika.php'>Korisnici</a>
            </div>";
}

$kreacijaNavigacije = "";
if (isset($_SESSION["korisnik"])) {
    $kreacijaNavigacije = kreirajNavigacijuRegKorisnika();
}
$smarty->assign('kreacijaNavigacije', $kreacijaNavigacije);

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('statistikaLokacija.tpl');
$smarty->display('podnozje.tpl');
?>