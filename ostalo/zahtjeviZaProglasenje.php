<?php

$naslov = 'Zahtjevi za proglašenje pobjednika';
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

function brojacZahtjeva($idZahtjeva) {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT count(*) FROM zahtjev_za_proglasenje_pobjednika, natjecanje, sudionici_natjecanja, korisnik WHERE zahtjev_za_proglasenje_pobjednika.natjecanje=natjecanje.id_natjecanje AND natjecanje.id_natjecanje=sudionici_natjecanja.natjecanje_id and sudionici_natjecanja.korisnik_id=korisnik.id_korisnika and zahtjev_za_proglasenje_pobjednika.administrator IS null and id_zahtjeva={$idZahtjeva} and sudionici_natjecanja.bodovi in (SELECT max(sudionici_natjecanja.bodovi) FROM zahtjev_za_proglasenje_pobjednika, natjecanje, sudionici_natjecanja, korisnik WHERE zahtjev_za_proglasenje_pobjednika.natjecanje=natjecanje.id_natjecanje AND natjecanje.id_natjecanje=sudionici_natjecanja.natjecanje_id and sudionici_natjecanja.korisnik_id=korisnik.id_korisnika and sudionici_natjecanja.bodovi GROUP by natjecanje.naziv)";
    $rezultat = $veza->selectDB($sql);
    while(list($broj)=$rezultat->fetch_array()){ $str=$broj;}
    $veza->zatvoriDB();
    return $str;
}

function IspisZahtjeva() {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT id_zahtjeva, korisnik.id_korisnika,id_natjecanje, datum_zahtjeva, natjecanje.naziv, sudionici_natjecanja.bodovi, korisnik.ime, korisnik.prezime FROM zahtjev_za_proglasenje_pobjednika, natjecanje, sudionici_natjecanja, korisnik WHERE zahtjev_za_proglasenje_pobjednika.natjecanje=natjecanje.id_natjecanje AND natjecanje.id_natjecanje=sudionici_natjecanja.natjecanje_id and sudionici_natjecanja.korisnik_id=korisnik.id_korisnika and zahtjev_za_proglasenje_pobjednika.administrator IS null and sudionici_natjecanja.bodovi in (SELECT max(sudionici_natjecanja.bodovi) FROM zahtjev_za_proglasenje_pobjednika, natjecanje, sudionici_natjecanja, korisnik WHERE zahtjev_za_proglasenje_pobjednika.natjecanje=natjecanje.id_natjecanje AND natjecanje.id_natjecanje=sudionici_natjecanja.natjecanje_id and sudionici_natjecanja.korisnik_id=korisnik.id_korisnika and sudionici_natjecanja.bodovi GROUP by natjecanje.naziv)";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($idZahtjeva, $idKorisnika, $idNatjecanja, $datum, $naziv, $bodovi, $ime, $prezime) = $rezultat->fetch_array()) {

        $str = $str . "<tr>"
                . "<td>$datum</td>"
                . "<td>$naziv</td>"
                . "<td>$ime $prezime</td>"
                . "<td>$bodovi</td>"
                . "<td>" . KreirajGumbProglasenja($idZahtjeva, $idKorisnika, $idNatjecanja) . "</td>"
                . "</tr>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

$IspisSvihZahtjeva = IspisZahtjeva();
$smarty->assign('IspisSvihZahtjeva', $IspisSvihZahtjeva);

function KreirajGumbProglasenja($idZahtjeva, $idKorisnika, $idNatjecanja) {
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
        if (brojacZahtjeva($idZahtjeva) < 2) {
            return "<form method='post' action=''>
            <input class='gumbDetalji' name='proglasi' type='submit' value=' Proglasi '>
            <input name='actionProglasi' type='hidden' value='$idZahtjeva'/>
            <input name='actionPobjednik' type='hidden' value='$idKorisnika'/>
            <input name='actionNatjecanje' type='hidden' value='$idNatjecanja'/>
        </form>";
        } else {
            return "<form method='post' action='../obrasci/proglasenjePobjednika.php'>
            <input class='gumbDetalji' name='proglasi' type='submit' value=' Proglasi '>
            <input name='actionProglasi' type='hidden' value='$idZahtjeva'/>
            <input name='actionPobjednik' type='hidden' value='$idKorisnika'/>
            <input name='actionNatjecanje' type='hidden' value='$idNatjecanja'/>
        </form>";
        }
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

function DohvatiEmail(){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT email FROM korisnik WHERE id_korisnika={$_POST['actionPobjednik']}";
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($email) = $rezultat->fetch_array()) {
        $ispis = $email;
    }
    $veza->zatvoriDB();
    return $ispis;
}

function DohvatiNatjecanje(){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT naziv FROM natjecanje WHERE id_natjecanje={$_POST['actionNatjecanje']}";
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($email) = $rezultat->fetch_array()) {
        $ispis = $email;
    }
    $veza->zatvoriDB();
    return $ispis;
}


function SlanjeMaila() {
    $mail_to = DohvatiEmail();
    $mail_from = "From: vbencek@foi.hr";
    $mail_subject = "Obavijest o osvajanju natjecanja";
    $mail_body = "Postovani, cestitamo vam na osvojenom natjecanju pod nazivom '". DohvatiNatjecanje()."'. "
            . "Svoju nagradu mozete preuzeti dolaskom u ribicki klub koji je ogranizirao natjecanje. LP, admin team.";

    mail($mail_to, $mail_subject, $mail_body, $mail_from);
}

if (isset($_POST['proglasi'])) {
    $veza = new Baza();
    $veza->spojiDB();
    $admin = DajIdKorisnika();
    $sql = "UPDATE zahtjev_za_proglasenje_pobjednika SET administrator={$admin} WHERE id_zahtjeva={$_POST['actionProglasi']}";
    $veza->selectDB($sql);
    $sql2 = "UPDATE natjecanje SET pobjednik={$_POST['actionPobjednik']} where id_natjecanje={$_POST['actionNatjecanje']}";
    $veza->selectDB($sql2);
    $veza->zatvoriDB();
    SlanjeMaila();
    header("Refresh:0");
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
$smarty->display('zahtjeviZaProglasenje.tpl');
$smarty->display('podnozje.tpl');
?>