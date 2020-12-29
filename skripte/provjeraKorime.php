<?php

 require '../vanjske_biblioteke/baza.class.php';
    $veza = new Baza();
    $veza->spojiDB();
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $sql = "SELECT * from korisnik WHERE korisnicko_ime='{$korisnicko_ime}'";
    $rezultat = $veza->selectDB($sql);
    if(mysqli_num_rows($rezultat)>0){
        $veza->zatvoriDB();
        echo "Korisničko ime već postoji";
    }
    else{
        $veza->zatvoriDB();
        echo "Korisničko ime dostupno";
    }
    

?>

