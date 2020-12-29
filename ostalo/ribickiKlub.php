<?php
$naslov = 'Ribički klubovi';
$navigacija = 'ostalo/ribickiKlub.php';
$putanja = "../";

include_once'../zaglavlje.php';


$smarty->assign('navigacija', $navigacija);
$smarty->assign('putanja', $putanja);

require '../vanjske_biblioteke/sesija.class.php';
require '../vanjske_biblioteke/baza.class.php';

sesija::kreirajSesiju();

unset($_SESSION['idKlubaA']);

function IspisKlubova($sort) {
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "SELECT id_ribicki_klub, naziv, adresa  FROM ribicki_klub ".$sort;
    $rezultat = $veza->selectDB($sql);
    $str = "";
    while (list($idKluba, $naziv, $adresa) = $rezultat->fetch_array()) {
        
        $str = $str . "<tr>"
                . "<td>$naziv</td>"
                . "<td>$adresa</td>"
                . "<td><form method='post' action='opisKluba.php'>
                        <button class='gumbDetalji' type='submit' name='submit'>Detalji</button>
                        <input name='action' type='hidden' value='$idKluba'/>
                        </form>".KreirajGumbAzuriranja($idKluba)."".KreirajGumbBrisanja($idKluba)
                . "</td>"
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
        $sort= " ORDER BY 2";
    } else {
        $sort= " ORDER BY 3";
    }
}

$IspisSvihKlubova = IspisKlubova($sort);
$smarty->assign('IspisSvihKlubova', $IspisSvihKlubova);



function KreirajGumbKreiranja(){
    return "<form action='../obrasci/kreiranjeKluba.php'>
            <input class='gumbKreirajNatjecanje' name='submit' type='submit' value=' Kreiraj ribički klub '>
            </form>";
}

$kreacijaGumba="";
if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
    $kreacijaGumba=KreirajGumbKreiranja();
}
$smarty->assign('kreacijaGumba', $kreacijaGumba);


function KreirajGumbAzuriranja($idKluba){
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] == 1) {
    return "<form method='post' action='../obrasci/kreiranjeKluba.php'>
            <input class='gumbDetalji' name='azuriraj' type='submit' value=' Ažuriraj '>
            <input name='actionUpdate' type='hidden' value='$idKluba'/>
            </form>";
    }else{
        return "";
    }
}
function KreirajGumbBrisanja($idKluba){
    if (isset($_SESSION["korisnik"]) && $_SESSION["tip"] ==1) {
    return "<form method='post' action=''>
            <input class='gumbDetalji' name='obrisi' type='submit' value=' Obriši '>
            <input name='actionDelete' type='hidden' value='$idKluba'/>
            </form>";
    
    }else{
        return "";
    }
}
if(isset($_POST['obrisi'])){
    $veza = new Baza();
    $veza->spojiDB();
    $sql = "DELETE FROM ribicki_klub WHERE ribicki_klub.id_ribicki_klub={$_POST['actionDelete']}";
    $rezultat = $veza->selectDB($sql);
    $veza->zatvoriDB();
    header("Refresh:0");
}

$smarty->assign('aktivnaSkripta', $_SERVER["PHP_SELF"]);
$smarty->display('ribickiKlub.tpl');
$smarty->display('podnozje.tpl');

?>