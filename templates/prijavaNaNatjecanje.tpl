        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_720.css" rel="stylesheet" type="text/css"> 
        <link href="css/vbencek_1366.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <header>
            <h1>Prijava na natjecanje</h1>
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
        <br>
        <section class="okvirPrijaveNaNatjecanje">
            <form novalidate id="form3" enctype="multipart/form-data" method="post" name="form3" action="{$aktivnaSkripta}">
            <div>
                <h3 class="naslov-obrazac">Priložite vlastitu fotografiju<br> (nije obavezno)</h3>
                <div class="cjeline-obrazac">
                    <label class ="labela-obrazac" for="userfile">Odaberite sliku: </label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                    <input class="gumb-postava" type="file" id="userfile" name="userfile"><br>
                    <label class="labela-obrazac" style="color:#ff002a; font-size: 10px;">{$porukaUploada}</label><br><br>
                    <label class ="labela" for="tel">Vaš broj telefona:</label>
                    <input class="unos" type="text" id="tel" name="telefon" placeholder="+385-xx-yyy-zzz"><br>
                </div>
                
                <h3 class="naslov-obrazac">Opis prijave</h3>
                <div class="cjeline-obrazac">
                    <textarea class="misljenje" id="opisPrijave" name="opisPrijave" rows="10" cols="70" placeholder="Opis prijave"></textarea><br>
                    
                </div>
                    <label class="labela-obrazac" style="color:#ff002a;">{$zadnjaPoruka}</label><br>
                <input class="gumb" type="submit" name="submit" id="gumb" value="Prijavi se "></div>
        </form>
             <form action="../ostalo/natjecanja.php">
            <input class="gumbOpisa" style="margin-top: 10px;" name="submit" type="submit" value=" Natrag ">
            </form>
        </section>



