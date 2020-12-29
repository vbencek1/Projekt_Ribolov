<?php

$naslov = 'Lokacije';
$navigacija = 'ostalo/lokacije.php';
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

unset($_SESSION['idLokacije']);

function IspisLokacija($sort) {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT id_lokacija, naziv_rijeke, duljina, grad.naziv FROM lokacija, grad WHERE lokacija.grad=grad.id_grad ".$sort;
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($idLokacije, $nazivRijeke, $duljina, $nazivGrada) = $rezultat->fetch_array()) {
        
        $str = $str . "<tr>"
                . "<td>$nazivRijeke</td>"
                . "<td>$duljina km </td>"
                . "<td>$nazivGrada</td>"
                . "<td>".KreirajGumbAzuriranja($idLokacije)." ".KreirajGumbBrisanja($idLokacije)
                . "</td>"
                . "</tr>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

$sort = "";
if (isset($_POST['sort']) && !empty($_POST['sortSelect'])) {
    $opcija = $_POST['sortSelect'];
    if ($opcija == 0) {
        $sort= "";
    }
    if ($opcija == 1) {
        $sort= " ORDER BY 2";
    } if ($opcija == 2) {
        $sort= " ORDER BY 4";
    }
    if ($opcija == 3) {
        $sort= " ORDER BY 3";
    }
}

$IspisSvihLokacija = IspisLokacija($sort);
$smarty->assign('IspisSvihLokacija', $IspisSvihLokacija);

function KreirajGumbAzuriranja($idLokacije){
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
    return "<form method='post' action='../obrasci/kreiranjeLokacije.php'>
            <input class='gumbDetalji' name='azuriraj' type='submit' value=' Ažuriraj '>
            <input name='actionUpdate' type='hidden' value='$idLokacije'/>
            </form>";
    }else{
        return "";
    }
}
function KreirajGumbBrisanja($idLokacije){
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
    return "<form method='post' action=''>
            <input class='gumbDetalji' name='obrisi' type='submit' value=' Obriši '>
            <input name='actionDelete' type='hidden' value='$idLokacije'/>
            </form>";
    
    }else{
        return "";
    }
}

function KreirajGumbKreiranja(){
    return "<form action='../obrasci/kreiranjeLokacije.php'>
            <input class='gumbKreirajNatjecanje' name='submit' type='submit' value=' Kreiraj lokaciju '>
            </form>";
}

$kreacijaGumba="";
if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
    $kreacijaGumba=KreirajGumbKreiranja();
}
$smarty->assign('kreacijaGumba', $kreacijaGumba);


if(isset($_POST['obrisi'])){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "DELETE FROM lokacija WHERE id_lokacija={$_POST['actionDelete']}";
    $rezultat = $veza->selectDB($sql);
    $veza->zatvoriDB();
    header("Refresh:0");
}

function kreirajNavigacijuRegKorisnika(){
    return "<div class='navigacijaNatjecanja'>
                <a href='lokacije.php'>Lokacije</a>
                <a href='zahtjeviZaProglasenje.php'>Zahtjevi</a>
                <a href='statistikaPrijava.php'>Statistika</a>
                <a href='popisKorisnika.php'>Korisnici</a>
            </div>";
}

$kreacijaNavigacije="";
if (isset($_SESSION["korisnik"])) {
    $kreacijaNavigacije=kreirajNavigacijuRegKorisnika();
}
$smarty->assign('kreacijaNavigacije', $kreacijaNavigacije);


$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('lokacije.tpl');
$smarty->display('podnozje.tpl');
?>