<?php
$greska = "";
$poruka = "";
$naslov='Prijava';
$navigacija='obrasci/prijava.php';
include_once'../zaglavlje.php';
$smarty->assign('navigacija',$navigacija);

$putanja="../";
$smarty->assign('putanja',$putanja);


require '../vanjske_biblioteke/baza.class.php';
require '../vanjske_biblioteke/sesija.class.php';


if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

$porukaPrijave="";
if (isset($_POST['submit'])) {
    $greska = "";
    foreach ($_POST as $k => $v) {
        if (empty($v)) {
            $porukaPrijave .= $k . " nije unesen! ";
        }
    }
    if(empty($greska)){
        $veza=new Baza();
        $veza->spojiDB();
        
        $korime=$_POST['korime'];
        $lozinka=$_POST['lozinka'];
        $salt=sha1($lozinka);
        $kriptirano=sha1($salt."--".$lozinka);
        
        $sql="SELECT * FROM korisnik WHERE "
                ."korisnicko_ime='{$korime}'"
                    ." AND lozinka='{$lozinka}' and status=1";
        $rezultat=$veza->selectDB($sql);
        
        $autenticiram=false;
        while($red=mysqli_fetch_array($rezultat)){
            if($red){
                $autenticiram=true;
                $tip=$red["uloga_id_uloga"];
            }
        }
        if($autenticiram){
            sesija::kreirajKorisnika($korime, $tip);
            header('Location: ../ostalo/natjecanja.php');
        }
        else{
            $porukaPrijave='Neuspješna prijava, pokušajte ponovo';
        }
        
        $veza->zatvoriDB();
    }
}
$smarty->assign('porukaPrijave',$porukaPrijave);

function GenerirajKod(){
    return rand ( 100000 , 999999);
}
function NovaLozinka($kod){
    $veza=new Baza();
    $veza->spojiDB();
    $salt = sha1($kod);
    $kriptirano = sha1($salt . "--" . $kod);
    $sql="UPDATE korisnik SET lozinka='{$kod}', lozinka_kript='{$kriptirano}' WHERE korisnicko_ime='{$_POST['korime']}'";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

function DajEmail(){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT email FROM korisnik WHERE korisnicko_ime='{$_POST['korime']}'";
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($email) = $rezultat->fetch_array()) {
        $ispis = $email;
    }
    $veza->zatvoriDB();
    return $ispis;
}

function SlanjeMaila($generiranKod) {
    $mail_to = DajEmail();
    $mail_from = "From: vbencek@foi.hr";
    $mail_subject = "Nova lozinka";
    $mail_body = "Pozdrav, Vaša nova lozinka je: ".$generiranKod;
    mail($mail_to, $mail_subject, $mail_body, $mail_from);
}


$porukaZaborava="";
if(isset($_POST['zaborav'])){
    if(!empty($_POST['korime'])){
        $kod= GenerirajKod();
        NovaLozinka($kod);
        SlanjeMaila($kod);
        $porukaZaborava="Nova lozinka poslana vam je na mail";
        
    }else{
        $porukaZaborava='Molimo unesite vaše korisničko ime';
    }
}
$smarty->assign('porukaZaborava',$porukaZaborava);

function DajLozinku(){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT lozinka FROM korisnik WHERE korisnicko_ime='{$_POST['korime']}'";
    $rezultat = $veza->selectDB($sql);
    $ispis = "";
    while (list($email) = $rezultat->fetch_array()) {
        $ispis = $email;
    }
    $veza->zatvoriDB();
    return $ispis;
}


function pokusajiPrijave(){
    $veza=new Baza();
    $veza->spojiDB();
    $sql="UPDATE korisnik SET broj_pokusaja=broj_pokusaja+1 WHERE korisnicko_ime='{$_POST['korime']}'";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

function promijeniStatus(){
    $veza=new Baza();
    $veza->spojiDB();
    $sql="UPDATE korisnik SET status=2 WHERE korisnicko_ime='{$_POST['korime']}' and broj_pokusaja=3";
    $veza->selectDB($sql);
    $veza->zatvoriDB();
}

if(isset($_POST['submit'])){
    if($_POST['lozinka']!= DajLozinku()){
        pokusajiPrijave();
        promijeniStatus();
    }
}


$smarty->assign('greska', $greska);
$smarty->assign('poruka', $poruka);
$smarty->assign('aktivnaSkripta',$_SERVER["PHP_SELF"]);
$smarty->display('prijava.tpl');
$smarty->display('podnozje.tpl');
?>


