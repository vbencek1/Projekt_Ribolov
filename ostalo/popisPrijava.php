<?php

$naslov = 'Popis prijava';
$navigacija = 'ostalo/popisPrijava.php';
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
if (!isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 3) {
    header('Location: ../index.php');
}


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

function administrator(){
if(DajIdKorisnika()==11){
    return "";
}else{
    $id= DajIdKorisnika();
    return " AND ribicki_klub.moderator={$id}";
}}


function IspisPrijava($admin) {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT id_zahtjev_za_prijavu_na_natjecanje, opis_prijave, datum_prijave, odobreno_odbijeno.naziv, natjecanje.naziv, korisnik.ime, korisnik.prezime,zahtjev_za_prijavu_na_natjecanje.korisnik, zahtjev_za_prijavu_na_natjecanje.natjecanje, odobreno_odbijeno.id_odobreno_odbijeno 
            FROM zahtjev_za_prijavu_na_natjecanje, natjecanje, odobreno_odbijeno, korisnik, ribicki_klub 
            WHERE zahtjev_za_prijavu_na_natjecanje.natjecanje=natjecanje.id_natjecanje 
            AND zahtjev_za_prijavu_na_natjecanje.odobreno=odobreno_odbijeno.id_odobreno_odbijeno 
            AND zahtjev_za_prijavu_na_natjecanje.korisnik=korisnik.id_korisnika
            AND natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub ".$admin;
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($id, $opis, $datumPrijave, $status, $natjecanje, $ime, $prezime, $korisnik, $natjecanjeID, $odobreno) = $rezultat->fetch_array()) {
        
        $str = $str . "<tr>"
                . "<td>$ime</td>"
                . "<td>$prezime</td>"
                . "<td>$datumPrijave</td>"
                . "<td>$natjecanje</td>"
                . "<td>$opis</td>"
                . "<td>$status</td>"
                . "<td>". KreirajGumbOdobri($id, $korisnik, $natjecanjeID, $odobreno)."<br>". KreirajGumbOdbij($id, $odobreno)."</td>"
                . "</tr>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

$IspisPrijava = IspisPrijava(administrator());
$smarty->assign('IspisPrijava', $IspisPrijava);


function KreirajGumbOdobri($id, $korisnik, $natjecanje, $odobreno){
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3 && $odobreno==3) {
    return "<form method='post' action=''>
            <input class='gumbDetalji' name='odobri' type='submit' value=' Odobri '>
            <input name='actionYes' type='hidden' value='$id'/>
            <input name='actionKorisnik' type='hidden' value='$korisnik'/>
            <input name='actionNatjecanje' type='hidden' value='$natjecanje'/>
            </form>";
    }else{
        return "";
    }
}
function KreirajGumbOdbij($id, $odobreno){
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3 && $odobreno==3) {
    return "<form method='post' action=''>
            <input class='gumbDetalji' name='odbij' type='submit' value=' Odbij '>
            <input name='actionNo' type='hidden' value='$id'/>
            </form>";
    
    }else{
        return "";
    }
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

function DodajSudionikaNatjecanja($veza){
    $sql = "INSERT INTO sudionici_natjecanja(korisnik_id, natjecanje_id, bodovi) VALUES({$_POST['actionKorisnik']},{$_POST['actionNatjecanje']}, 0)";
    $veza->selectDB($sql);
}

if(isset($_POST['odobri'])){
    $veza = new Baza();
    $veza->spojiDB();
    $moderator= DajIdKorisnika();
    $datum =date("y-m-d");
    $sql = "UPDATE zahtjev_za_prijavu_na_natjecanje SET odobreno=1, moderator={$moderator}, datum_pregleda_zahtjeva='{$datum}' WHERE id_zahtjev_za_prijavu_na_natjecanje={$_POST['actionYes']}";
    $rezultat = $veza->selectDB($sql);
    DodajSudionikaNatjecanja($veza);
    $veza->zatvoriDB();
    header("Refresh:0");
}

if(isset($_POST['odbij'])){
    $veza = new Baza();
    $veza->spojiDB();
    $moderator= DajIdKorisnika();
    $datum =date("y-m-d");
    $sql = "UPDATE zahtjev_za_prijavu_na_natjecanje SET odobreno=2, moderator={$moderator}, datum_pregleda_zahtjeva='{$datum}' WHERE id_zahtjev_za_prijavu_na_natjecanje={$_POST['actionNo']}";
    $rezultat = $veza->selectDB($sql);
    $veza->zatvoriDB();
    header("Refresh:0");
}

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('popisPrijava.tpl');
$smarty->display('podnozje.tpl');
?>