<?php
$naslov = 'Informacije o klubu';
$navigacija = 'ostalo/OpisNatjecanja.php';
$putanja = "../";

include_once'../zaglavlje.php';

$smarty->assign('navigacija', $navigacija);
$smarty->assign('putanja', $putanja);

require '../vanjske_biblioteke/sesija.class.php';
require '../vanjske_biblioteke/baza.class.php';

sesija::kreirajSesiju();

if(isset($_POST['action'])){
    $_SESSION['idKluba']=$_POST['action'];
}

function dohvatiNaziv($veza) {
    $idKluba = $_SESSION['idKluba'];
    $sql = "SELECT naziv FROM ribicki_klub WHERE id_ribicki_klub=" . $idKluba;
    $rezultat = $veza->selectDB($sql);
    $naziv = "";
    while (list($naziv_kluba) = $rezultat->fetch_array()) {
        $naziv = $naziv_kluba;
    }
    return $naziv;
}
function dohvatiAdresu($veza) {
    $idKluba = $_SESSION['idKluba'];
    $sql = "SELECT adresa FROM ribicki_klub WHERE id_ribicki_klub=" . $idKluba;
    $rezultat = $veza->selectDB($sql);
    $naziv = "";
    while (list($adresa_kluba) = $rezultat->fetch_array()) {
        $naziv = $adresa_kluba;
    }
    return $naziv;
}
function dohvatiEmail($veza) {
    $idKluba = $_SESSION['idKluba'];
    $sql = "SELECT email FROM ribicki_klub WHERE id_ribicki_klub=" . $idKluba;
    $rezultat = $veza->selectDB($sql);
    $naziv = "";
    while (list($email_kluba) = $rezultat->fetch_array()) {
        $naziv = $email_kluba;
    }
    return $naziv;
}
function dohvatiWebStranicu($veza) {
    $idKluba = $_SESSION['idKluba'];
    $sql = "SELECT web_adresa FROM ribicki_klub WHERE id_ribicki_klub=" . $idKluba;
    $rezultat = $veza->selectDB($sql);
    $naziv = "";
    while (list($web_kluba) = $rezultat->fetch_array()) {
        $naziv = $web_kluba;
    }
    return $naziv;
}
function dohvatiPredsjednika($veza) {
    $idKluba = $_SESSION['idKluba'];
    $sql = "SELECT predsjednik FROM ribicki_klub WHERE id_ribicki_klub=" . $idKluba;
    $rezultat = $veza->selectDB($sql);
    $naziv = "";
    while (list($predsjednik_kluba) = $rezultat->fetch_array()) {
        $naziv = $predsjednik_kluba;
    }
    return $naziv;
}
function dohvatiDatumKreiranja($veza) {
    $idKluba = $_SESSION['idKluba'];
    $sql = "SELECT datum_kreiranja FROM ribicki_klub WHERE id_ribicki_klub=" . $idKluba;
    $rezultat = $veza->selectDB($sql);
    $naziv = "";
    while (list($datum_kluba) = $rezultat->fetch_array()) {
        $naziv = $datum_kluba;
    }
    return $naziv;
}

$veza = new Baza();
$veza->spojiDB();
$nazivKluba = dohvatiNaziv($veza);
$adresaKluba= dohvatiAdresu($veza);
$emailKluba= dohvatiEmail($veza);
$webKluba= dohvatiWebStranicu($veza);
$predsjednikKluba= dohvatiPredsjednika($veza);
$datumKluba= dohvatiDatumKreiranja($veza);
$veza->zatvoriDB();

$smarty->assign('nazivKluba', $nazivKluba);
$smarty->assign('adresaKluba', $adresaKluba);
$smarty->assign('emailKluba', $emailKluba);
$smarty->assign('webKluba', $webKluba);
$smarty->assign('predsjednikKluba', $predsjednikKluba);
$smarty->assign('datumKluba', $datumKluba);


$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('opisKluba.tpl');
$smarty->display('podnozje.tpl');
?>

