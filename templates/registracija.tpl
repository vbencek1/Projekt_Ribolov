       <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    </head>
    <body onload="ocitaj();">
       <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
       
        <script type="text/javascript" src="../javascript/vbencek_jquery.js"></script>

        <header>
            <h1>Registracija</h1>
        </header>
        <nav>
            <a href="../index.php">Početna</a>
            <a href="registracija.php">Registracija</a>
            <a href="../ostalo/natjecanja.php">Natjecanja</a>
            <a href="../ostalo/ribickiKlub.php">Ribički klub</a> 
            {if isset($smarty.session.korisnik)}
                 {if $smarty.session.tip==1} <a href="../ostalo/lokacije.php">Ostalo</a>{/if}
                    <a href="../skripte/odjava.php">Odjava</a>
                {else}
                <a href="prijava.php">Prijava</a>
                {/if}
        </nav>
        <form novalidate id="form1" method="POST" name="form1" action="{$aktivnaSkripta}">
            <div class="okvirRegistacije">
                
                <label class="labela" for="ime">Ime: </label>
                <input type="text" id="ime" name="ime" class="unos" placeholder="ime"><br>
                <label class="labela" for="prez">Prezime: </label>
                <input type="text" id="prez" name="prez" class="unos" placeholder="prezime"><br>
                <label class="labela" for="korime">Korisničko ime: </label>
                <input class="unos" type="text" id="korime" name="korime"  placeholder="korisničko ime(6-18)"><br>
                <input type="text" id="ispisDuplikat"><br>
                <label class="labela" for="danRod">Datum rođenja: </label>
                <input class="unos" type="date" id="danRod" name="danRod"><br>
                <label class="labela" for="email">E-mail adresa: </label>
                <input class="unos" type="email" id="email" name="email" placeholder="email@mail.xxx"><br>
                <label class="labela" for="drzava">Država: </label>
                <input class="unos" type="text" id="drzava" name="drzava" placeholder="država"><br>
                <label class="labela" for="lozinka1">Lozinka: </label>
                <input class="unos" type="password" id="lozinka1" name="lozinka1" placeholder="lozinka(6-30)" ><br>
                <label class="labela" for="lozinka2">Ponovi lozinku: </label>
                <input class="unos" type="password" id="lozinka2" name="lozinka2"  placeholder="potvrda lozinke" ><br>
                <img src="../multimedija/CapthcaPlaceholder.png" alt="captcha"/><br><input type="text" name="captcha" />
            
                <br>
                <label class="labelaGreske" > {$ispisProvjere}</label><br><br>
                <input class="gumb" id="gumbic" name="submit" type="submit" value=" Registriraj se ">
            </div>
        </form>
