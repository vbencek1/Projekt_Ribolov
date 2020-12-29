<?php
$naslov = 'Proglašenje pobjednika';
$navigacija = 'obrasci/proglasenjePobjednika.php';
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

if(isset($_POST['actionProglasi'])){
    $_SESSION['idZahtjeva']=$_POST['actionProglasi'];
}
if(isset($_POST['actionPobjednik'])){
    $_SESSION['idPobjednika']=$_POST['actionPobjednik'];
}
if(isset($_POST['actionNatjecanje'])){
    $_SESSION['idNatjecanja']=$_POST['actionNatjecanje'];
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
if(isset($_POST['submit'])){
    $veza = new Baza();
    $veza->spojiDB();
    $admin = DajIdKorisnika();
    $opis=$_POST['opis'];
    $sql = "UPDATE zahtjev_za_proglasenje_pobjednika SET administrator={$admin},opis='{$opis}' WHERE id_zahtjeva={$_SESSION['idZahtjeva']}";
    $veza->selectDB($sql);
    $sql2 = "UPDATE natjecanje SET pobjednik={$_SESSION['idPobjednika']} where id_natjecanje={$_SESSION['idNatjecanja']}";
    $veza->selectDB($sql2);
    $veza->zatvoriDB();
    header('Location: ../ostalo/zahtjeviZaProglasenje.php');
}


$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('proglasenjePobjednika.tpl');
$smarty->display('podnozje.tpl');
?>

