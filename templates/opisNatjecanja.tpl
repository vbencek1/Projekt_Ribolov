        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_720.css" rel="stylesheet" type="text/css"> 
        <link href="css/vbencek_1366.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <header>
            <h1>Natjecanja</h1>
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
        <section class="okvirOpisNatjecanja">
            <h2>{$nazivDatoteke}</h2>
            <br>
            <label>Početak: {$datumPocetka}</label>
            <label>Zavrsetak: {$datumZavrsetka}</label>
            <label>Organizator: {$nazivKluba}</label>
            <label>Lokacija: {$lokacija}</label>
            
            {$slikaPobjednika}<br>
            <div>{$opis}</div>
            <br>
            <form action="natjecanja.php">
            <input class="gumbOpisa" name="submit" type="submit" value=" Natrag ">
            </form>
            {$gumbPrijaveNatjecanja}
        </section>


