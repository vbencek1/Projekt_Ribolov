        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1>Proglašenje pobjednika</h1>
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
                <h3 class="naslov-obrazac">Napišite razlog zašto se izabrali natjecatelja</h3>
                <div class="cjeline-obrazac">
                    <br><br>
                    <textarea class="misljenje" id="opis" name="opis" rows="10" cols="70" placeholder="objašnjnje.."></textarea><br>
                </div>
                <input class="gumb" type="submit" name="submit" id="gumb" value="Proglasi "></div>
        </form>
             <form action="../ostalo/zahtjeviZaProglasenje.php">
            <input class="gumbOpisa" style="margin-top: 10px;" name="natrag" type="submit" value=" Natrag ">
            </form>
        </section>



