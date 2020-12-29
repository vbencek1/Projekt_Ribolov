<?php
$naslov = 'Unos bodova';
$navigacija = 'obrasci/unosBodova.php';
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

function IspisSudionika($imeNatjecanja,$datum, $pobjednik) {
    $veza = new Baza();
    $veza->spojiDB();
    $datumZavrsetka=$datum;
    $sql = "SELECT sudionici_natjecanja.natjecanje_id, sudionici_natjecanja.korisnik_id, korisnik.ime, korisnik.prezime, sudionici_natjecanja.bodovi "
            . "FROM natjecanje, korisnik, sudionici_natjecanja "
            . "WHERE sudionici_natjecanja.natjecanje_id=natjecanje.id_natjecanje "
                . "AND sudionici_natjecanja.korisnik_id=korisnik.id_korisnika "
                . "AND natjecanje.naziv='{$imeNatjecanja}'";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($idNatjecanja, $idSudionika, $ime_sudionika, $prezime_sudionika, $bodovi) = $rezultat->fetch_array()) {
        $str = $str ."<tr>"
                . "<td>$ime_sudionika</td>"
                . "<td>$prezime_sudionika</td>"
                . "<td>$bodovi</td>"
                . "<td>". AzurirajBodove($datumZavrsetka, $idSudionika, $idNatjecanja, $pobjednik)."</td>"
                . "</tr>\n";
    }
    $veza->zatvoriDB();
    return $str;
}

function administrator(){
if(DajIdKorisnika()==11){
    return "";
}else{
    $id= DajIdKorisnika();
    return " AND ribicki_klub.moderator={$id}";
}}

function IspisMojihNatjecanja($admin){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT DISTINCT natjecanje.naziv,  datum_zavrsetka, pobjednik, ribicki_klub.moderator "
            . "FROM natjecanje, ribicki_klub "
            . "WHERE natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub {$admin}  "
            . "ORDER BY datum_zavrsetka";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($naziv_natjecanja,$datumZavrsetka, $pobjednik) = $rezultat->fetch_array()) {
        $str = $str ."<table  class='tablicaMojaNatjecanja' border:0>
                    <caption>{$naziv_natjecanja} <br>-Traje do: {$datumZavrsetka}</caption>
                    <thead>
                        <tr>
                            <th>Ime </th>
                            <th>Prezime</th>
                            <th>Bodovi</th>
                            <th>Novi bodovi</th>
                            
                    </thead>
                    <tbody>".
                       IspisSudionika($naziv_natjecanja,$datumZavrsetka, $pobjednik)."
                    </tbody>
                </table>\n";
    }
    $veza->zatvoriDB();
    return $str;
}


$IspisSvihSudionika = IspisMojihNatjecanja(administrator());
$smarty->assign('IspisSvihSudionika', $IspisSvihSudionika);



function AzurirajBodove($datumZavrsetka,$idSudionika, $idNatjecanja, $pobjednik){
    $trenutniDatum=date("Y-m-d");
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] != 3 && ($datumZavrsetka<$trenutniDatum) && $pobjednik==null) {
    return "<form method='post' action=''>
             <input type='number' class='unos' name='bodovi'/>
            <input class='gumbDetalji' name='unesi' type='submit' value=' Unesi '>
            <input name='actionSudionik' type='hidden' value='$idSudionika'/>
             <input name='actionNatjecanje' type='hidden' value='$idNatjecanja'/>
            </form>";
    }else{
        return "";
    }
}

if(isset($_POST['bodovi'])){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "UPDATE sudionici_natjecanja SET bodovi={$_POST['bodovi']} "
    . "WHERE sudionici_natjecanja.natjecanje_id={$_POST['actionNatjecanje']} "
    . "AND sudionici_natjecanja.korisnik_id={$_POST['actionSudionik']}";
    $rezultat = $veza->selectDB($sql);
    $veza->zatvoriDB();
    header("Refresh:0");
}


function kreirajNavigacijuRegKorisnika(){
    return "<div class='navigacijaNatjecanja'>
                <a href='../ostalo/mojePrijave.php'>Moje prijave</a>
                <a href='../ostalo/mojaNatjecanja.php'>Moja natjecanja</a>
                <a href='../ostalo/mojiRezultati.php'>Moji rezultati</a>
            </div>";
}
$kreacijaNavigacije="";
if (isset($_SESSION["korisnik"])) {
    $kreacijaNavigacije=kreirajNavigacijuRegKorisnika();
}
$smarty->assign('kreacijaNavigacije', $kreacijaNavigacije);

function PopuniNatjecanja($admin){
    $veza = new Baza();
    $veza->spojiDB();
    $datumTrenutni=date("y-m-d");
    $sql = "SELECT id_natjecanje, natjecanje.naziv "
            . "FROM natjecanje,ribicki_klub "
            . "WHERE datum_zavrsetka<'{$datumTrenutni}' "
            . "AND natjecanje.ribicki_klub=ribicki_klub.id_ribicki_klub "
            . "AND pobjednik is null {$admin} "
            . "ORDER by datum_zavrsetka";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($id, $naziv) = $rezultat->fetch_array()) {
        $str = $str ."<option value='$id'>$naziv</option>\n";
    }
    $veza->zatvoriDB();
    return $str;
    
}

$listaNatjecanja= PopuniNatjecanja(administrator());
$smarty->assign('listaNatjecanja', $listaNatjecanja);

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
$zadnjaPoruka="";
if(!empty($_POST['natjecanje']) && isset($_POST['posaljiZahtjev'])){
    $veza = new Baza();
    $veza->spojiDB();
    $datumTrenutni=date("y-m-d");
    $moderator= DajIdKorisnika();
    $sql = "INSERT INTO zahtjev_za_proglasenje_pobjednika(datum_zahtjeva, moderator, natjecanje) VALUES('{$datumTrenutni}',{$moderator},{$_POST['natjecanje']}) ";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
    $zadnjaPoruka="Poslano";
}else{
    $zadnjaPoruka="Izaberite natjecanje";
}
$smarty->assign('zadnjaPoruka', $zadnjaPoruka);



$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('unosBodova.tpl');
$smarty->display('podnozje.tpl');
?>