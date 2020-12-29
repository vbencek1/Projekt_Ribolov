<?php

$naslov = 'Natjecanja';
$navigacija = 'ostalo/OpisNatjecanja.php';
$putanja = "../";

include_once'../zaglavlje.php';

$smarty->assign('navigacija', $navigacija);
$smarty->assign('putanja', $putanja);

require '../vanjske_biblioteke/sesija.class.php';
require '../vanjske_biblioteke/baza.class.php';

sesija::kreirajSesiju();

if(isset($_POST['action'])){
$_SESSION['IdNatjecanja']=$_POST['action'];

}

function dohvatiNaziv($veza) {
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql = "SELECT naziv FROM natjecanje WHERE id_natjecanje=" . $idNatjecanja;
    $rezultat = $veza->selectDB($sql);
    $naziv = "";
    while (list($naziv_natjecanja) = $rezultat->fetch_array()) {
        $naziv = $naziv_natjecanja;
    }
    return $naziv;
}

function dohvatiDatumPocetka($veza) {
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql = "SELECT datum_pocetka FROM natjecanje WHERE id_natjecanje=" . $idNatjecanja;
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($datum_pocetka) = $rezultat->fetch_array()) {
        $ispis = $datum_pocetka;
    }
    return $ispis;
}
function dohvatiDatumZavrsetka($veza) {
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql = "SELECT datum_zavrsetka FROM natjecanje WHERE id_natjecanje=" . $idNatjecanja;
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($datum_zavrsetka) = $rezultat->fetch_array()) {
        $ispis = $datum_zavrsetka;
    }
    return $ispis;
}
function dohvatiRibickiKlub($veza) {
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql = "SELECT ribicki_klub.naziv FROM natjecanje, ribicki_klub WHERE natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub AND id_natjecanje=" . $idNatjecanja;
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($naziv_kluba) = $rezultat->fetch_array()) {
        $ispis = $naziv_kluba;
    }
    return $ispis;
}
function dohvatiLokaciju($veza) {
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql = "SELECT lokacija.naziv_rijeke, grad.naziv"
            . " FROM natjecanje, lokacija, grad"
            . " WHERE natjecanje.lokacija=lokacija.id_lokacija AND lokacija.grad=grad.id_grad AND id_natjecanje=" . $idNatjecanja;
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($naziv_rijeke, $naziv_grada) = $rezultat->fetch_array()) {
        $ispis = $naziv_rijeke." ".$naziv_grada;
    }
    return $ispis;
}
function dohvatiOpis($veza) {
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql = "SELECT opis FROM natjecanje WHERE id_natjecanje=" . $idNatjecanja;
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($opis) = $rezultat->fetch_array()) {
        $ispis = $opis;
    }
    return $ispis;
}

function dohvatiSliku($veza) {
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql = "SELECT prilozena_slika, korisnik from zahtjev_za_prijavu_na_natjecanje, natjecanje where zahtjev_za_prijavu_na_natjecanje.korisnik=natjecanje.pobjednik and odobreno=1 and natjecanje.id_natjecanje=" . $idNatjecanja;
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($slika) = $rezultat->fetch_array()) {
        $ispis = $slika;
    }
    return $ispis;
}

function ProvjeraPobjednika($veza){
    $idNatjecanja = $_SESSION['IdNatjecanja'];
    $sql="select * from natjecanje where pobjednik is null and id_natjecanje={$idNatjecanja}";
    $rezultat = $veza->selectDB($sql);
    if(mysqli_num_rows($rezultat)==1){
        return false;
    }
    else{
        return true;
    }
}

function Pobjednik($veza){
    if(ProvjeraPobjednika($veza)){
        $slika= dohvatiSliku($veza);
        return "<label style='width:10%;clear:both;'>Pobjednik: </label>
            <figure>
                <img src='../multimedija/slika/{$slika}' style='width:100px; height:100px'>
            </figure>";
    }else{
        return "<label style='clear:both;'>Pobjednik: nema </label><br>";
    }
}


$veza = new Baza();
$veza->spojiDB();
$nazivDatoteke = dohvatiNaziv($veza);
$datumPocetka= dohvatiDatumPocetka($veza);
$datumZavrsetka= dohvatiDatumZavrsetka($veza);
$nazivKluba= dohvatiRibickiKlub($veza);
$lokacija= dohvatiLokaciju($veza);
$opis= dohvatiOpis($veza);
$slikaPobjednika= Pobjednik($veza);
$veza->zatvoriDB();
$smarty->assign('nazivDatoteke', $nazivDatoteke);
$smarty->assign('datumPocetka', $datumPocetka);
$smarty->assign('datumZavrsetka', $datumZavrsetka);
$smarty->assign('nazivKluba', $nazivKluba);
$smarty->assign('lokacija', $lokacija);
$smarty->assign('opis', $opis);
$smarty->assign('slikaPobjednika', $slikaPobjednika);


function KreiranjeGumbaPrijave(){
    if (isset($_SESSION["korisnik"])) {
    return "<form action='../obrasci/prijavaNaNatjecanje.php'>
            <input class='gumbOpisa' name='submit' type='submit' value=' Prijavi se na natjecanje '>
            </form>";
}
}
$gumbPrijaveNatjecanja= KreiranjeGumbaPrijave();
$smarty->assign('gumbPrijaveNatjecanja', $gumbPrijaveNatjecanja);







$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('opisNatjecanja.tpl');
$smarty->display('podnozje.tpl');
?>


