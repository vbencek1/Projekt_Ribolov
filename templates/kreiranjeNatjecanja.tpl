        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1>Kreiranje natjecanja</h1>
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
        
         <section class="okvirPrijaveNaNatjecanje">
            <form id="form"  method="post" name="form" action="{$aktivnaSkripta}">
            <div>
                <h3 class="naslov-obrazac">Unesite informacije o natjecanju</h3>
                <div class="cjeline-obrazac">
                    
                    <label class ="labela" for="naziv">Naziv natjecanja:</label>
                    <input class="unos" type="text" id="naziv" name="naziv" placeholder="naziv natjecanja" value="{$nazivReturn}"><br>
                    <label class ="labela" for="datumPocetka">Datum početka:</label>
                    <input class="unos" type="date" id="datumPocetka" name="datumPocetka" value="{$datumPocetkaReturn}"><br>
                    <label class ="labela" for="datumZavrsetka">Datum završetka:</label>
                    <input class="unos" type="date" id="datumZavrsetka" name="datumZavrsetka" value="{$datumZavrsetkaReturn}"><br>
                    
                    <label class ="labela" for="organizator">Organizator:</label>
                    <select class="liste" id="organizator" name="organizator">
                        <option value="0">Izaberite organizatora</option>
                        {$listaOrganizatora};
                    </select><br>
                    <label class ="labela" for="lokacija">Lokacija:</label>
                    <select class="liste" id="lokacija" name="lokacija">
                        <option value="0">Izaberite lokaciju</option>
                        {$listaLokacija};
                    </select><br>
                    <label class ="labela" for="opis">Opis natjecanja:</label>
                    <textarea class="misljenje" id="opis" name="opis" rows="10" cols="70" placeholder="opis natjecanja">{$opisReturn}</textarea><br>
                    
                </div>
                 <label class="labela-obrazac" style="color:#ff002a;">{$zadnjaPoruka}</label><br>
                <input class="gumb" type="submit" name="submit" id="gumb" value="Unesi "></div>
        </form>
             <form action="../ostalo/natjecanja.php">
            <input class="gumbOpisa" style="margin-top: 10px;" name="natrag" type="submit" value=" Natrag ">
            </form>
        </section>


