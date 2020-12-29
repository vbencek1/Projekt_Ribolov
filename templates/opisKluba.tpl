        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="css/vbencek_720.css" rel="stylesheet" type="text/css"> 
        <link href="css/vbencek_1366.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <header>
            <h1>Ribički klub</h1>
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
            <h2>{$nazivKluba}</h2>
            <br>
            <label>Adresa: {$adresaKluba}</label>
            <label>Email: {$emailKluba}</label>
            <label>Web stranica: {$webKluba}</label>
            <label>Predsjednik: {$predsjednikKluba}</label>
            <label>Datum pridruživanja: {$datumKluba}</label>
            <br>
            <section class="formaGumbi">
            <form action='natjecanja.php'>
            <input class='gumbOpisa' name='natrag' type='submit' value=' Idi na natjecanja'>
            </form>
            <form action='ribickiKlub.php'>
            <input class='gumb' name='natragKlub' type='submit' value=' Idi na klubove'>
            </form>
            </section>
        </section>



