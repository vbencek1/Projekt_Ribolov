<?php
$naslov = 'Prijava na natjecanje';
$navigacija = 'obrasci/prijavaNaNatjecanje.php';
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

$porukaUploada = "Odaberite datoteku";
function uploadDatoteke() {
    if (isset($_POST['submit'])) {
        $userfile = $_FILES['userfile']['tmp_name'];
        $userfile_name = $_FILES['userfile']['name'];
        $userfile_size = $_FILES['userfile']['size'];
        $userfile_type = $_FILES['userfile']['type'];
        $userfile_error = $_FILES['userfile']['error'];
        if ($userfile_error > 0) {
            return 'Datoteka nije prenesena';
        }
        $slika = array("image/jpeg", "image/gif", "image/png","image/jpeg");
        if (in_array($userfile_type, $slika)) {
            $upfile = '../multimedija/slika/' . $userfile_name;
        }
        if (is_uploaded_file($userfile)) {
            if (!move_uploaded_file($userfile, $upfile)) {
                return 'Problem: nije moguće prenijeti datoteku na odredište';
            }
        } else {
            return 'Problem: mogući napad prijenosom. Datoteka: ' . $userfile_name;
        }

        return 'Datoteka uspješno prenesena';
    }
}

if (isset($_POST["submit"])) {
    $porukaUploada = uploadDatoteke();
}
$smarty->assign('porukaUploada', $porukaUploada);

function unosBaza() {
    if (isset($_POST['submit'])) {

        $veza = new Baza();
        $veza->spojiDB();
        $naziv_datoteke = $_FILES['userfile']['name'];
        if(empty($_FILES['userfile']['name'])){ $naziv_datoteke="default.png";}
        $telefon = $_POST['telefon'];
        $opis_prijave = $_POST['opisPrijave'];
        $datum_prijave=date("Y-m-d");
        $natjecanje=$_SESSION['IdNatjecanja'];
        $korisnik= DajIdKorisnika();
        
        $sql = "INSERT INTO zahtjev_za_prijavu_na_natjecanje(opis_prijave, "
                . "prilozena_slika, "
                . "broj_mobitela, "
                . "datum_prijave, "
                . "natjecanje, "
                . "korisnik, "
                . "odobreno) VALUES ('$opis_prijave', '{$naziv_datoteke}', '{$telefon}', "
                . "'{$datum_prijave}', {$natjecanje}, {$korisnik},3)";

        $veza->selectDB($sql);
        $veza->zatvoriDB();
    }
}
$zadnjaPoruka="";
if (isset($_POST['submit'])) {
    if (!empty($_POST['telefon']) && !empty($_POST['opisPrijave'])) {
        unosBaza();
       $zadnjaPoruka='Uspješno ste se prijavili na natjecanje';
    } else {
        $zadnjaPoruka= 'Sva tekstualna polja moraju biti popunjena';
    }
}
$smarty->assign('zadnjaPoruka', $zadnjaPoruka);


$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('prijavaNaNatjecanje.tpl');
$smarty->display('podnozje.tpl');
?>