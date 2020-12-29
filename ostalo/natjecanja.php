<?php

$naslov = 'Natjecanja';
$navigacija = 'ostalo/natjecanja.php';
$putanja = "../";

include_once'../zaglavlje.php';


$smarty->assign('navigacija', $navigacija);
$smarty->assign('putanja', $putanja);

require '../vanjske_biblioteke/sesija.class.php';
require '../vanjske_biblioteke/baza.class.php';

sesija::kreirajSesiju();

unset($_SESSION['idNatjecanjaA']);

function ispisNatjecanja($filter, $sort) {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT natjecanje.id_natjecanje, natjecanje.naziv,ribicki_klub.naziv, ribicki_klub.id_ribicki_klub, ribicki_klub.moderator "
            . "FROM natjecanje, ribicki_klub "
            . "WHERE ribicki_klub.id_ribicki_klub=natjecanje.ribicki_klub " . $filter . " " . $sort;
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($idNatjecanja, $naziv_natjecanja, $naziv_kluba, $idKluba, $moderator) = $rezultat->fetch_array()) {

        $str = $str . "<tr>"
                . "<td>$naziv_natjecanja" . KreirajGumbAzuriranja($idNatjecanja, $moderator) . "" . KreirajGumbBrisanja($idNatjecanja, $moderator)
                . "<form method='post' action='opisNatjecanja.php'>
                        <button class='gumbDetalji' type='submit' name='submit'>Detalji</button>
                        <input name='action' type='hidden' value='$idNatjecanja'/>
                        </form></td>"
                . "<td>$naziv_kluba"
                . "<form method='post' action='opisKluba.php'>
                        <button class='gumbDetalji' type='submit' name='submit'>Info</button>
                        <input name='action' type='hidden' value='$idKluba'/></form></td>"
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
        $sort= " ORDER BY 3";
    } else {
        $sort= " ORDER BY 2";
    }
}

function kreirajNavigacijuRegKorisnika() {
    return "<div class='navigacijaNatjecanja'>
                <a href='mojePrijave.php'>Moje prijave</a>
                <a href='mojaNatjecanja.php'>Moja natjecanja</a>
                <a href='mojiRezultati.php'>Moji rezultati</a>
            </div>";
}

$kreacijaNavigacije = "";
if (isset($_SESSION["korisnik"])) {
    $kreacijaNavigacije = kreirajNavigacijuRegKorisnika();
}
$smarty->assign('kreacijaNavigacije', $kreacijaNavigacije);

function KreirajGumbKreiranja() {
    return "<form method='POST' action='../obrasci/kreiranjeNatjecanja.php'>
            <input class='gumbKreirajNatjecanje' name='actionKreiraj' type='submit' value=' Kreiraj natjecanje '>
            </form>";
}

$kreacijaGumba = "";
if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3) {
    $kreacijaGumba = KreirajGumbKreiranja();
}
$smarty->assign('kreacijaGumba', $kreacijaGumba);

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

function KreirajGumbAzuriranja($idNatjecanja, $moderator) {
    if ((isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3 && $moderator == DajIdKorisnika()) || ((isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1))) {
        return "<form method='post' action='../obrasci/kreiranjeNatjecanja.php'>
            <input class='gumbDetalji' name='azuriraj' type='submit' value=' Ažuriraj '>
            <input name='actionUpdate' type='hidden' value='$idNatjecanja'/>
            </form>";
    } else {
        return "";
    }
}

function KreirajGumbBrisanja($idNatjecanja, $moderator) {
    if ((isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3 && $moderator == DajIdKorisnika()) || ((isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1))) {
        return "<form method='post' action=''>
            <input class='gumbDetalji' name='obrisi' type='submit' value=' Obriši '>
            <input name='actionDelete' type='hidden' value='$idNatjecanja'/>
            </form>";
    } else {
        return "";
    }
}

if (isset($_POST['obrisi'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "DELETE FROM natjecanje WHERE id_natjecanje={$_POST['actionDelete']}";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
    header("Refresh:0");
}

function FilterKlubova() {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT id_ribicki_klub, naziv FROM ribicki_klub";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($id, $naziv) = $rezultat->fetch_array()) {
        $str = $str . "<option value='$id'>$naziv</option>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

$filter = "";
if (isset($_POST['filter']) && !empty($_POST['klub'])) {
    $filter = " AND ribicki_klub.id_ribicki_klub={$_POST['klub']}";
}

$smarty->assign('listaKlubova', FilterKlubova());
$IspisSvihNatjecanja = ispisNatjecanja($filter, $sort);
$smarty->assign('IspisSvihNatjecanja', $IspisSvihNatjecanja);

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('natjecanja.tpl');
$smarty->display('podnozje.tpl');
?>




