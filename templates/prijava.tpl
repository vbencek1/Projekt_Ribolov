        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <div id="anim_prij"></div>
            <h1>Prijava</h1>
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
        
           <div id="greske">
            {if isset($greska)}
                    {$greska}
            {/if}
            {if isset($poruka)}
                {$poruka}
                {/if}
            </div>
            <section class="okvirPrijave">
        <form novalidate id="form2" method="post" name="form2" action="{$aktivnaSkripta}">
            
                <label class ="labela" for="korime">Korisničko ime: </label>
                <input class="unos" type="text" id="korime" name="korime" maxlength="20" placeholder="korisničko ime" required="required"><br>
                <label class ="labela" for="lozinka">Lozinka: </label>
                <input class="unos" type="password" id="lozinka" name="lozinka" placeholder="lozinka" required="required"><br>
                
                <input class="gumb" name="submit" type="submit" value=" Prijavi se ">
            
                <label class="labelaGreske"> {$porukaPrijave}</label>
                <br><br>
        
                    <label class ="labela"style="width:80%;" for="zaborav">Zaboravljena lozinka? </label>
                <input class="gumbDetalji" style="float:left;" id="zaborav" name="zaborav" type="submit" value=" Generiraj novu ">
                <label class="labelaGreske"> {$porukaZaborava}</label>
            </form>
                </section>