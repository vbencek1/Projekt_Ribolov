<?php

require '../vanjske_biblioteke/baza.class.php';



$veza = new Baza();
$veza->spojiDB();
$sql = "SELECT ime, prezime, korisnicko_ime,email, lozinka, uloga.naziv FROM korisnik, uloga  WHERE korisnik.uloga_id_uloga=uloga.id_uloga order by 6";
$str = "<table>
                    <caption>Popis korisnika</caption>
                    <thead>
                        <tr>
                            <th>Korisničko ime</th>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Email</th>
                            <th>Lozinka</th>
                            <th>Vrsta</th>
                    </thead>
                    <tbody>";
$rezultat = $veza->selectDB($sql);
while (list( $ime, $prezime, $korime,$email, $lozinka, $uloga) = $rezultat->fetch_array()) {
    $str = $str . "<tr>"
            . "<td>$korime</td>"
            . "<td>$ime</td>"
            . "<td>$prezime</td>"
            . "<td>$email</td>"
            . "<td>$lozinka</td>"
            . "<td>$uloga</td>"
            . "</tr>\n";
}
$str .= " </tbody>
                </table>";
$veza->zatvoriDB();
echo $str;
?>
