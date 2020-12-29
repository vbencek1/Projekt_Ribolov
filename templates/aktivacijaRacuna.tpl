        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <h1>Aktivacija</h1>
        </header>
        <nav>
            <a href="../index.php">Početna</a>
        </nav>
        
         <form  id="form2" method="post" name="form2" action="{$aktivnaSkripta}">
            <p class="okvirPrijave">
                <label class ="labela" for="korime">Korisničko ime: </label>
                <input class="unos" type="text" id="korime" name="korime" maxlength="20" placeholder="korisničko ime" required="required"><br>
                <label class ="labela" for="lozinka">Kod: </label>
                <input class="unos" type="number" id="kod" name="kod" placeholder="aktivacijski kod" required="required"><br>
                
                <input class="gumb" name="submit" type="submit" value=" Aktiviraj ">
                <label class="labela" style="color:red;width:400px;"> {$porukaAktivacije}</label>
                <br><br>
                
            
            </p>
        </form>



