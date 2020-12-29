<?php
$naslov = 'Moje prijave';
$navigacija = 'ostalo/mojePrijave.php';
$putanja = "../";

include_once'../zaglavlje.php';

$smarty->assign('navigacija', $navigacija);
$smarty->assign('putanja', $putanja);

require '../vanjske_biblioteke/sesija.class.php';
require '../vanjske_biblioteke/baza.class.php';

sesija::kreirajSesiju();
if (!isset($_SESSION["korisnik"])) {
    header('Location: ../obrasci/prijava.php');
}

function DajIdKorisnika(){
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
function ispisPrijava() {
    $veza = new Baza();
    $veza->spojiDB();
    $idKorisnika= DajIdKorisnika();
    $sql = "SELECT natjecanje.naziv, odobreno_odbijeno.naziv "
            . "FROM zahtjev_za_prijavu_na_natjecanje, natjecanje, odobreno_odbijeno "
            . "WHERE zahtjev_za_prijavu_na_natjecanje.korisnik={$idKorisnika} AND "
            . "zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje AND "
            . "zahtjev_za_prijavu_na_natjecanje.odobreno=odobreno_odbijeno.id_odobreno_odbijeno";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($naziv_natjecanja, $odobreno) = $rezultat->fetch_array()) {
        $str = $str . "<tr>"
                . "<td>$naziv_natjecanja</td>"
                . "<td>$odobreno</td>"
                . "</tr>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

$IspisSvihPrijava = ispisPrijava();
$smarty->assign('IspisSvihPrijava', $IspisSvihPrijava);


function kreirajNavigacijuRegKorisnika(){
    return "<div class='navigacijaNatjecanja'>
                <a href='mojePrijave.php'>Moje prijave</a>
                <a href='mojaNatjecanja.php'>Moja natjecanja</a>
                <a href='mojiRezultati.php'>Moji rezultati</a>
            </div>";
}

$kreacijaNavigacije="";
if (isset($_SESSION["korisnik"])) {
    $kreacijaNavigacije=kreirajNavigacijuRegKorisnika();
}
$smarty->assign('kreacijaNavigacije', $kreacijaNavigacije);


function KreirajGumbPrikaza(){
    return "<form action='popisPrijava.php'>
            <input class='gumbKreirajNatjecanje' name='submit' type='submit' value=' Prikaži prijave korisnika '>
            </form>";
}

$kreacijaGumba="";
if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3) {
    $kreacijaGumba=KreirajGumbPrikaza();
}
$smarty->assign('kreacijaGumba', $kreacijaGumba);


$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('mojePrijave.tpl');
$smarty->display('podnozje.tpl');
?>