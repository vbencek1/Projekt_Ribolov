<?php

$greska = "";
$poruka = "";
$naslov = 'Registracija';

$navigacija = 'obrasci/registracija.php';
$putanja = '../';
include_once'../zaglavlje.php';

require '../vanjske_biblioteke/baza.class.php';
require '../vanjske_biblioteke/sesija.class.php';

$smarty->assign('navigacija', $navigacija);
$smarty->assign('putanja', $putanja);
sesija::kreirajSesiju();

function provjera() {
    if ($_POST['danRod'] != "" && $_POST['drzava'] != "" && $_POST['lozinka2'] != "") {
        return true;
    } else {
        return false;
    }
}

function provjeraImena() {
    $ime = $_POST['ime'];
    if (!preg_match("/^(([A-za-zÀ-Ÿ]+[\s]{1}[A-za-zÀ-Ÿ]+)|([A-Za-zÀ-Ÿ]+))$/", $ime)) {
        return false;
    } else {
        return true;
    }
}

function provjeraPrezimena() {
    $prez = $_POST['prez'];
    if (!preg_match("/^(([A-za-zÀ-Ÿ]+[\s]{1}[A-za-zÀ-Ÿ]+)|([A-Za-zÀ-Ÿ]+))$/", $prez)) {
        return false;
    } else {
        return true;
    }
}

function provjeraKorimena() {
    $korime = $_POST['korime'];
    if (!preg_match("/^([A-Za-z0-9]){6,18}$/", $korime)) {
        return false;
    } else {
        return true;
    }
}

function provjeraEmaila() {
    $email = $_POST['email'];
    if (!preg_match("/([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/", $email)) {
        return false;
    } else {
        return true;
    }
}

function provjeraLozinke() {
    $lozinka = $_POST['lozinka1'];
    if (strlen($lozinka) < 6) {
        return false;
    } else {
        return true;
    }
}

function provjeraPodudaranja() {
    $lozinka1 = $_POST['lozinka1'];
    $lozinka2 = $_POST['lozinka2'];
    if ($lozinka1 !== $lozinka2) {
        return false;
    } else {
        return true;
    }
}

function provjeraCaptcha() {
    $captcha = $_POST['captcha'];
    if ($captcha == 5632) {
        return true;
    } else {
        return false;
    }
}

function provjeraDuplikata() {
    $veza = new Baza();
    $veza->spojiDB();
    $korisnicko_ime = $_POST['korime'];
    $sql = "SELECT * from korisnik WHERE korisnicko_ime='{$korisnicko_ime}'";
    $rezultat = $veza->selectDB($sql);
    if (mysqli_num_rows($rezultat) > 0) {
        return false;
    } else {

        return true;
    }
    $veza->zatvoriDB();
}

function GenerirajKod(){
    return rand ( 1000 , 9999);
}

function unosBaza($generiranKod) {
    $veza = new Baza();
    $veza->spojiDB();

    $ime = $_POST['ime'];
    $prezime = $_POST['prez'];
    $korisnicko_ime = $_POST['korime'];
    $lozinka = $_POST['lozinka1'];
    $status = 1;
    $email = $_POST['email'];
    $drzava = $_POST['drzava'];
    $datum = date("Y-m-d H:i:s");
    $uloga = 3;
    $kod= $generiranKod;
    $salt = sha1($lozinka);
    $kriptirano = sha1($salt . "--" . $lozinka);


    $sql = "INSERT INTO korisnik(ime,
        prezime,
        korisnicko_ime,
        lozinka,
        lozinka_kript,
        status,
        email,
        drzava,
        datum_vrijeme_registracije,
        uloga_id_uloga,
        aktivacijski_kod) VALUES ('{$ime}', '{$prezime}', "
            . "'{$korisnicko_ime}', '{$lozinka}', '{$kriptirano}', {$status}, '{$email}',"
            . " '{$drzava}', '{$datum}', {$uloga},{$kod} )";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

function kreiranjeSesije() {
    $veza = new Baza();
    $veza->spojiDB();

    $korime = $_POST['korime'];
    $lozinka = $_POST['lozinka1'];

    $sql = "SELECT * FROM korisnik WHERE "
            . "korisnicko_ime='{$korime}'"
            . " AND lozinka='{$lozinka}'";
    $rezultat = $veza->selectDB($sql);

    $autenticiram = false;
    while ($red = mysqli_fetch_array($rezultat)) {
        if ($red) {
            $autenticiram = true;
            $tip = $red["uloga_id_uloga"];
        }
    }
    if ($autenticiram) {
        sesija::kreirajKorisnika($korime, $tip);
        header('Location: ../ostalo/natjecanja.php');
    }
    $veza->zatvoriDB();
}

function SlanjeMaila($generiranKod) {
    $mail_to = $_POST["email"];
    $mail_from = "From: vbencek@foi.hr";
    $mail_subject = "Aktivacija korisnickog racuna";
    $link="'http://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x009/skripte/aktivacijaRacuna.php'";
    $mail_body = "Molimo aktivirajte svoj korisnički račun u roku od 7 dana. Vas aktivacijski kod je: ".$generiranKod.""
            . " Racun aktivirajte preko sljedeceg linka: {$link}";

    mail($mail_to, $mail_subject, $mail_body, $mail_from);
}

$ispisProvjere = "<br>";
if (isset($_POST['submit'])) {
    if (provjera() && provjeraImena() && provjeraPrezimena() && provjeraKorimena() && provjeraEmaila() && provjeraLozinke() && provjeraPodudaranja() && provjeraCaptcha() && provjeraDuplikata()) {
        $generiranKod=GenerirajKod();
        unosBaza($generiranKod);
        SlanjeMaila($generiranKod);
        kreiranjeSesije();
    } else {
        if (!provjeraCaptcha()) {
            $ispisProvjere .= "Neispravna Captcha<br>";
        }
        if (!provjera()) {
            $ispisProvjere .= "Nisu ispunjena sva polja<br>";
        }
        if (!provjeraImena()) {
            $ispisProvjere .= "Neispravno Ime<br>";
        }
        if (!provjeraPrezimena()) {
            $ispisProvjere = "Neispravno prezime<br>";
        }
        if (!provjeraKorimena()) {
            $ispisProvjere .= "Neispravno korisnicko ime<br>";
        }
        if (!provjeraEmaila()) {
            $ispisProvjere .= "Neispravni email<br>";
        }
        if (!provjeraLozinke()) {
            $ispisProvjere .= "Neispravna lozinka<br>";
        }
        if (!provjeraPodudaranja()) {
            $ispisProvjere .= "Lozinke se ne podudaraju<br>";
        }
        if (!provjeraDuplikata()) {
            $ispisProvjere .= "Korisničko ime već postoji<br>";
        }
    }
}
$smarty->assign('ispisProvjere', $ispisProvjere);

$smarty->assign('greska', $greska);
$smarty->assign('poruka', $poruka);
$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('registracija.tpl');
$smarty->display('podnozje.tpl');
?>

