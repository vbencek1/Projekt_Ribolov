<?php
$naslov = 'Kreiranje natjecanja';
$navigacija = 'obrasci/kreiranjeNatjecanja.php';
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

if (isset($_POST['actionUpdate'])) {
    $_SESSION['idNatjecanjaA'] = $_POST['actionUpdate'];
}


function PopuniOrganizatore($veza, $ribickiKlubReturn){
    if(DajIdKorisnika()!=11){
    $sql = "SELECT id_ribicki_klub, naziv FROM ribicki_klub WHERE moderator=". DajIdKorisnika() ;}
    else{
        $sql = "SELECT id_ribicki_klub, naziv FROM ribicki_klub";
    }
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($id, $naziv) = $rezultat->fetch_array()) {
        $str = $str ."<option value='$id'". IzabranaOpcija($id, $ribickiKlubReturn).">$naziv</option>\n";
    }
    return $str;
}
function PopuniLokacije($veza, $lokacijaReturn){
    $sql = "SELECT lokacija.id_lokacija, lokacija.naziv_rijeke, grad.naziv "
            . "FROM lokacija, grad "
            . "WHERE lokacija.grad=grad.id_grad";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($id, $naziv_lokacija, $naziv_grada) = $rezultat->fetch_array()) {
        $str = $str ."<option value='$id'". IzabranaOpcija($id, $lokacijaReturn).">$naziv_lokacija $naziv_grada</option>\n";
    }
    return $str;
}

function IzabranaOpcija($id, $izabrani){
    if($id==$izabrani){
        return "selected";
    }else{
        return "";
    }
}

$veza = new Baza();
$veza->spojiDB();
$nazivReturn="";
$opisReturn=""; 
$datumPocetkaReturn="";
$datumZavrsetkaReturn=""; 
$lokacijaReturn=""; 
$ribickiKlubReturn="";
if(isset($_SESSION['idNatjecanjaA'])){
    $sql = "SELECT naziv, opis, datum_pocetka, datum_zavrsetka, lokacija, ribicki_klub "
            . "FROM natjecanje "
            . "WHERE natjecanje.id_natjecanje={$_SESSION['idNatjecanjaA']}";
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($naziv, $opis, $datumPocetka, $datumZavrsetka, $lokacija, $ribickiKlub) = $rezultat->fetch_array()) {
        $nazivReturn=$naziv;
        $opisReturn=$opis;
        $datumPocetkaReturn=$datumPocetka;
        $datumZavrsetkaReturn=$datumZavrsetka;
        $lokacijaReturn=$lokacija; 
        $ribickiKlubReturn=$ribickiKlub;
    }
}


$listaOrganizatora= PopuniOrganizatore($veza, $ribickiKlubReturn);
$listaLokacija= PopuniLokacije($veza, $lokacijaReturn);
$smarty->assign('nazivReturn', $nazivReturn);
$smarty->assign('opisReturn', $opisReturn);
$smarty->assign('datumPocetkaReturn', $datumPocetkaReturn);
$smarty->assign('datumZavrsetkaReturn', $datumZavrsetkaReturn);
$smarty->assign('listaOrganizatora', $listaOrganizatora);
$smarty->assign('listaLokacija', $listaLokacija);
$veza->zatvoriDB();



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

function unosBaza() {
        $veza = new Baza();
        $veza->spojiDB();
        $naziv=$_POST['naziv'];
        $opis=$_POST['opis'];
        $datumPocetka=$_POST['datumPocetka'];
        $datumZavrsetka=$_POST['datumZavrsetka'];
        $organizator=$_POST['organizator'];
        $lokacija=$_POST['lokacija'];
        $moderator= DajIdKorisnika();
        
        $sql = "INSERT INTO natjecanje(naziv, "
                . "opis, "
                . "datum_pocetka, "
                . "datum_zavrsetka, "
                . "lokacija, "
                . "ribicki_klub, "
                . "moderator) VALUES ('{$naziv}', '{$opis}', '{$datumPocetka}', "
                . "'{$datumZavrsetka}',{$lokacija} , {$organizator},{$moderator})";

        $veza->selectDB($sql);
        $veza->zatvoriDB();
    
}

function AzuriranjeNatjecanja(){
    $veza = new Baza();
        $veza->spojiDB();
        $naziv=$_POST['naziv'];
        $opis=$_POST['opis'];
        $datumPocetka=$_POST['datumPocetka'];
        $datumZavrsetka=$_POST['datumZavrsetka'];
        $organizator=$_POST['organizator'];
        $lokacija=$_POST['lokacija'];
        $moderator= DajIdKorisnika();
        $sql = "UPDATE natjecanje SET naziv='{$naziv}', "
                . "opis='{$opis}', "
                . "datum_pocetka= '{$datumPocetka}',"
                . "datum_zavrsetka='{$datumZavrsetka}', "
                . "lokacija={$lokacija}, "
                . "ribicki_klub={$organizator}, "
                . "moderator={$moderator} "
                . "WHERE id_natjecanje={$_SESSION['idNatjecanjaA']}";

        $veza->selectDB($sql);
        $veza->zatvoriDB();
}


$zadnjaPoruka="";
if (isset($_POST['submit'])) {
    if (!empty($_POST['naziv']) && !empty($_POST['opis']) && !empty($_POST['organizator']) && !empty($_POST['lokacija']) && !empty($_POST['datumPocetka'])&& !empty($_POST['datumZavrsetka'])) {
        if(isset($_SESSION['idNatjecanjaA'])){
            AzuriranjeNatjecanja();
            unset($_SESSION['idNatjecanjaA']);
            $zadnjaPoruka='Natjecanje je ažurirano!';
        }else{
        unosBaza();
       $zadnjaPoruka='Natjecanje je uspješno kreirano';
        }
    } else {
        $zadnjaPoruka= 'Svi podaci moraju biti ispunjeni';
    }
}
$smarty->assign('zadnjaPoruka', $zadnjaPoruka);

if(isset($_POST['natrag'])){
    unset($_SESSION['idNatjecanjaA']);
}

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('kreiranjeNatjecanja.tpl');
$smarty->display('podnozje.tpl');
?>
