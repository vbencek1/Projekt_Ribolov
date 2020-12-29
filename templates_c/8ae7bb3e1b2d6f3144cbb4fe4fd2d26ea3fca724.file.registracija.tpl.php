<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-22 18:34:53
         compiled from "C:\xampp\htdocs\Projekt_Ribolov\templates\registracija.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12097787325ce42dfab09018-30380586%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ae7bb3e1b2d6f3144cbb4fe4fd2d26ea3fca724' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekt_Ribolov\\templates\\registracija.tpl',
      1 => 1558539123,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12097787325ce42dfab09018-30380586',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5ce42dfabc5964_65246442',
  'variables' => 
  array (
    'aktivnaSkripta' => 0,
    'ispisProvjere' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ce42dfabc5964_65246442')) {function content_5ce42dfabc5964_65246442($_smarty_tpl) {?>       <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    </head>
    <body onload="ocitaj();">
       <!-- <?php echo '<script'; ?>
 type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"><?php echo '</script'; ?>
> 
       -->
        <?php echo '<script'; ?>
 type="text/javascript" src="../javascript/vbencek_jsEmail.js"><?php echo '</script'; ?>
>

        <header>
            <h1>Registracija</h1>
        </header>
        <nav>
            <a href="../index.php">Početna</a>
            <a href="prijava.php">Prijava</a>
            <a href="obrazac.php">Obrazac</a>
            <a href="../ostalo/multimedija.php">Multimedija</a>
            <a href="../ostalo/popis.php">Popis</a>
        </nav>
        <form novalidate id="form1" method="POST" name="form1" action="<?php echo $_smarty_tpl->tpl_vars['aktivnaSkripta']->value;?>
">
            <p class="okvirRegistacije">
                
                <label class="labela" for="ime">Ime: </label>
                <input type="text" id="ime" name="ime" class="unos" placeholder="ime"><br>
                <label class="labela" for="prez">Prezime: </label>
                <input type="text" id="prez" name="prez" class="unos" placeholder="prezime"><br>
                <label class="labela" for="korime">Korisničko ime: </label>
                <input class="unos" type="text" id="korime" name="korime"  placeholder="korisničko ime"><br>
                <label class="labela" for="danRod">Datum rođenja: </label>
                <input class="unos" type="date" id="danRod" name="danRod"><br>
                <label class="labela" for="email">E-mail adresa: </label>
                <input class="unos" type="email" id="email" name="email" placeholder="email@mail.xxx"><br>
                <label class="labela" for="drzava">Država: </label>
                <input class="unos" type="text" id="drzava" name="drzava" placeholder="država"><br>
                <label class="labela" for="lozinka1">Lozinka: </label>
                <input class="unos" type="password" id="lozinka1" name="lozinka1" placeholder="lozinka" ><br>
                <label class="labela" for="lozinka2">Ponovi lozinku: </label>
                <input class="unos" type="password" id="lozinka2" name="lozinka2"  placeholder="potvrda lozinke" ><br>
                <br>
                <label class="labela" style="color:red;"> <?php echo $_smarty_tpl->tpl_vars['ispisProvjere']->value;?>
</label><br><br>
                <input class="gumb" id="gumbic" name="submit" type="submit" value=" Registriraj se ">
        </form>
<?php }} ?>
