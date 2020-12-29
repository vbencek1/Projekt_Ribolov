        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_720.css" rel="stylesheet" type="text/css"> 
        <link href="css/vbencek_1366.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    </head>
    <body onload="Natjecanja();">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../javascript/vbencek_jquery.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <header>
            <h1>Sva Natjecanja i sudionici</h1>
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
        <section>
            {$kreacijaNavigacije}
            <div class="okvirInfo">
                <form method='POST' action='' class="formaIzbora">
                    <select class="liste" id="natjecanje" name="natjecanje">
                        <option value="0">Izaberite natjecanje</option>
                        {$listaNatjecanja};
                    </select><br><br>
                    <input class='gumbDetalji' name='posaljiZahtjev' type='submit' value=' Pošalji zahtjev proglašenja '><br>
                    <label style="color:#26C485;">{$zadnjaPoruka}</label><br>
            </form>
                    
                    <br>
                    
                       {$IspisSvihSudionika}
            </div>
        </section>


