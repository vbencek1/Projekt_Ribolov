        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1>Kreiranje ribičkog kluba</h1>
        </header>
        <nav>
            <a href="../index.php">Početna</a>
            <a href="registracija.php">Registracija</a>
            <a href="../ostalo/natjecanja.php">Natjecanja</a>
            <a href="../ostalo/ribickiKlub.php">Ribički klub</a>
            {if isset($smarty.session.korisnik)}
                {if $smarty.session.tip==1} <a href="../ostalo/lokacije.php">Ostalo</a>{/if}
                    <a href="../skripte/odjava">Odjava</a>
                {else}
                <a href="prijava.php">Prijava</a>
                {/if}
            
        </nav>
        
         <section class="okvirPrijaveNaNatjecanje">
            <form id="form"  method="post" name="form" action="{$aktivnaSkripta}">
            <div>
                <h3 class="naslov-obrazac">Unesite informacije o ribičkom klubu</h3>
                <div class="cjeline-obrazac">
                    
                    <label class ="labela" for="naziv">Naziv ribičkog kluba:</label>
                    <input class="unos" type="text" id="naziv" name="naziv" placeholder="naziv ribičkog kluba" value="{$nazivReturn}"><br>
                    <label class ="labela" for="adresa">Adresa:</label>
                    <input class="unos" type="text" id="adresa" name="adresa" placeholder="adresa" value="{$adresaReturn}"><br>
                    <label class ="labela" for="predsjednik">Predsjednik:</label>
                    <input class="unos" type="text" id="predsjednik" name="predsjednik" placeholder="predsjednik"  value="{$predsjednikReturn}"><br>
                    <label class ="labela" for="email">Email:</label>
                    <input class="unos" type="email" id="email" name="email" placeholder="email"  value="{$emailReturn}"><br>
                    <label class ="labela" for="webAdresa">Web adresa:</label>
                    <input class="unos" type="text" id="webAdresa" name="webAdresa" placeholder="web adresa"  value="{$webAdresaReturn}"><br>
                    <label class ="labela" for="moderator">Moderator:</label>
                    <select class="liste" id="moderator" name="moderator">
                        <option value="0">Izaberite moderatora</option>
                        {$listaModeratora}
                    </select><br>
                    
                </div>
                 <label class="labela-obrazac" style="color:#ff002a;">{$porukaIspisa}</label><br>
                <input class="gumb" type="submit" name="submit" id="gumb" value="Unesi "></div>
        </form>
             <form action="../ostalo/ribickiKlub.php">
            <input class="gumbOpisa" style="margin-top: 10px;" name="nazad" type="submit" value=" Natrag ">
            </form>
        </section>
