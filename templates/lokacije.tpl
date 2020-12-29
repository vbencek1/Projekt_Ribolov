        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_ispis.css" media="print" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
        
    </head>
    <body onload="Natjecanja();">
       <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../javascript/vbencek_jquery.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
       
        <header>
            <h1>Lokacije</h1>
        </header>
        <nav>
            <a href="../index.php">Početna</a>
            <a href="../obrasci/registracija.php">Registracija</a>
            <a href="natjecanja.php">Natjecanja</a> 
            <a href="ribickiKlub.php">Ribički klub</a> 
            {if isset($smarty.session.korisnik)}
                {if $smarty.session.tip==1} <a href="lokacije.php">Ostalo</a>{/if}
                    <a href="../skripte/odjava.php">Odjava</a>
                {else}
                <a href="../obrasci/prijava.php">Prijava</a>
                {/if}
        </nav>
        <br>
        <section>
            {$kreacijaNavigacije}
            <div class="okvirInfo">
                <div class="formaFiltera"> 
                    <form method="POST" action="">
                        <label class ="labela" for="klub">Sortiraj po:</label><br>
                    <select class="liste" id="klub" name="sortSelect">
                        <option value="0">Odabir</option>
                        <option value="1">Rijeka</option>
                        <option value="2">Grad</option>
                        <option value="3">Duljina rijeke</option>
                    </select><br><br>
                    <input class="gumbDetalji" style="float:left;" type="submit" name="sort" id="gumb" value="Sortiraj ">
                    </form>
                </div>
                {$kreacijaGumba}
                <table  class="tablica" id="TablicaNatjecanjaNOSORT">
                    <caption class="tablica-naslov">Prikaz lokacija</caption>
                    <thead>
                        <tr class="tablica-zaglavlje">
                            <th>Rijeka</th>
                            <th>Duljina</th>
                            <th>Grad</th>
                            <th>Akcija</th>
                    </thead>
                    <tbody class="tablica-tijelo">
                        {$IspisSvihLokacija}
                    </tbody>
                </table>
            </div>
        </section>


