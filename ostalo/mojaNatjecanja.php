<?php
$naslov = 'Moja natjecanja';
$navigacija = 'ostalo/mojaNatjecanja.php';
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

function IspisSudionika($imeNatjecanja) {
    $veza = new Baza();
    $veza->spojiDB();
    $idKorisnika= DajIdKorisnika();
    $sql = "SELECT korisnik.ime, korisnik.prezime, sudionici_natjecanja.bodovi "
            . "FROM natjecanje, korisnik, sudionici_natjecanja, zahtjev_za_prijavu_na_natjecanje "
            . "WHERE zahtjev_za_prijavu_na_natjecanje.korisnik={$idKorisnika} "
                . "AND zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje "
                . "AND zahtjev_za_prijavu_na_natjecanje.odobreno=1 "
                . "AND sudionici_natjecanja.natjecanje_id=natjecanje.id_natjecanje "
                . "AND sudionici_natjecanja.korisnik_id=korisnik.id_korisnika "
                . "AND natjecanje.naziv='{$imeNatjecanja}'";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($ime_sudionika, $prezime_sudionika, $bodovi) = $rezultat->fetch_array()) {
        $str = $str ."<tr>"
                . "<td>$ime_sudionika</td>"
                . "<td>$prezime_sudionika</td>"
                . "<td>$bodovi</td>"
                . "</tr>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

function IspisMojihNatjecanja(){
    $veza = new Baza();
    $veza->spojiDB();
    $idKorisnika= DajIdKorisnika();
    $sql = "SELECT DISTINCT natjecanje.naziv "
            . "FROM natjecanje, korisnik, zahtjev_za_prijavu_na_natjecanje "
            . "WHERE zahtjev_za_prijavu_na_natjecanje.korisnik={$idKorisnika} "
                . "AND zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje "
                . "AND zahtjev_za_prijavu_na_natjecanje.odobreno=1 ";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($naziv_natjecanja) = $rezultat->fetch_array()) {
        $str = $str ."<table  class='tablicaMojaNatjecanja' border:0>
                    <caption>{$naziv_natjecanja}</caption>
                    <thead>
                        <tr>
                            <th>Ime </th>
                            <th>Prezime</th>
                            <th>Bodovi</th>
                    </thead>
                    <tbody>".
                       IspisSudionika($naziv_natjecanja)."
                    </tbody>
                </table>\n";
    }
    $veza->zatvoriDB();
    return $str;
}


$IspisSvihSudionika = IspisMojihNatjecanja();
$smarty->assign('IspisSvihSudionika', $IspisSvihSudionika);

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


function KreirajGumbUnosaBodova(){
    return "<form action='../obrasci/unosBodova.php'>
            <input class='gumbKreirajNatjecanje' name='submit' type='submit' value=' Prikaži sva natjecanja i sudionike '>
            </form>";
}

$kreacijaGumba="";
if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3) {
    $kreacijaGumba=KreirajGumbUnosaBodova();
}
$smarty->assign('kreacijaGumba', $kreacijaGumba);



$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('mojaNatjecanja.tpl');
$smarty->display('podnozje.tpl');
?>
