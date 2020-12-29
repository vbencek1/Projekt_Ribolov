<?php
$naslov = 'Moji rezultati';
$navigacija = 'ostalo/mojiRezultati.php';
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
function IspisRezultata() {
    $veza = new Baza();
    $veza->spojiDB();
    $idKorisnika= DajIdKorisnika();
    $sql = "SELECT natjecanje.naziv, sudionici_natjecanja.bodovi, natjecanje.pobjednik "
            . "FROM zahtjev_za_prijavu_na_natjecanje, natjecanje, sudionici_natjecanja, odobreno_odbijeno "
            . "WHERE zahtjev_za_prijavu_na_natjecanje.korisnik={$idKorisnika} AND "
            . "zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje AND "
            . "zahtjev_za_prijavu_na_natjecanje.odobreno=odobreno_odbijeno.id_odobreno_odbijeno AND "
            . "sudionici_natjecanja.korisnik_id={$idKorisnika} AND "
            . "sudionici_natjecanja.natjecanje_id=natjecanje.id_natjecanje";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($naziv_natjecanja, $bodovi, $pobjednik) = $rezultat->fetch_array()) {
        $str = $str . "<tr>"
                . "<td>$naziv_natjecanja</td>"
                . "<td>$bodovi</td>";
        if($pobjednik==$idKorisnika){
            $str=$str."<td>Da</td></tr>\n";
        }
        else{
            $str=$str."<td>Ne</td></tr>\n";
        }
    }
    $veza->zatvoriDB();
    return $str;
}

$IspisRezultata = IspisRezultata();
$smarty->assign('IspisRezultata', $IspisRezultata);


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



$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('mojiRezultati.tpl');
$smarty->display('podnozje.tpl');
?>
