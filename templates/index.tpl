        <link href="css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_720.css" rel="stylesheet" type="text/css"> 
        <link href="css/vbencek_1366.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1>Početna stranica</h1>
        </header>
        <nav>
            <a href="index.php">Početna</a>
            <a href="obrasci/registracija.php">Registracija</a>
            <a href="ostalo/natjecanja.php">Natjecanja</a>
            <a href="ostalo/ribickiKlub.php">Ribički klub</a>
            {if isset($smarty.session.korisnik)}
                {if $smarty.session.tip==1} <a href="ostalo/lokacije.php">Ostalo</a>{/if}
                    <a href="skripte/odjava.php">Odjava</a>
                {else}
                <a href="obrasci/prijava.php">Prijava</a>
                {/if}
        </nav>

        <section>
            
                <h2></h2>
                <div class="okvirInfo">
                   
                <article class="okvirPozdravnePoruke">
                    <h3> Dobro došli na stranicu ribolovnih natjecanja</h3>
                    <p> 
                        Stranica je namijenjena kreiranju i održavanju ribolovnih natjecanja.
                        Registracijom postajete njen član koji ima mogućnost prijave na neko
                        od navedenih natjecanja.
                    </p>
                </article>
                <article>
                    <h3> Dokumentacija</h3>
                    <a href="dokumentacija.html">
                        <img class="slikaPocetna" src="multimedija/document.png" alt="dokumentacija">
                    </a>
                </article>
                <article>
                    <h3> O autoru</h3>
                    <a href="o_autoru.html">
                        <img class="slikaPocetna" src="multimedija/autor.png" alt="oAutoru">
                    </a>
                </article>
                    <article>
                    <h3> Korisnici</h3>
                    <a href="http://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x009/privatno/korisnici.php" target="blank"> 
                        <img class="slikaPocetna" src="multimedija/korisnici_poz.jpg" alt="korisnici">
                    </a>
                </article>
                
            </div>
        </section>
        

