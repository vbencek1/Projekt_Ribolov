        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    </head>
    <body onload="Natjecanja();">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../javascript/vbencek_jquery.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <header>
            <h1>Moje prijave na natjecanja</h1>
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
            {$kreacijaNavigacije};
            <div class="okvirInfo">
                {$kreacijaGumba};
                <table  class="tablica" id="TablicaNatjecanja">
                    <caption class="tablica-naslov">Moje prijave</caption>
                    <thead>
                        <tr class="tablica-zaglavlje">
                            <th>Natjecanje</th>
                            <th>Status</th>
                    </thead>
                    <tbody class="tablica-tijelo">
                       {$IspisSvihPrijava};
                    </tbody>
                </table>
            </div>
        </section>




