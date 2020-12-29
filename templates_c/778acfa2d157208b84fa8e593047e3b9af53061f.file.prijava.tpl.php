<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-13 10:16:34
         compiled from "/var/www/webdip.barka.foi.hr/2018/zadaca_04/vbencek/templates/prijava.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12305703315cd923443af824-06972507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '778acfa2d157208b84fa8e593047e3b9af53061f' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2018/zadaca_04/vbencek/templates/prijava.tpl',
      1 => 1557735390,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12305703315cd923443af824-06972507',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5cd923443b7aa5_08381535',
  'variables' => 
  array (
    'greska' => 0,
    'poruka' => 0,
    'aktivnaSkripta' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd923443b7aa5_08381535')) {function content_5cd923443b7aa5_08381535($_smarty_tpl) {?>        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
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
            <a href="obrazac.php">Obrazac</a>
            <a href="../ostalo/multimedija.php">Multimedija</a>
            <a href="../ostalo/popis.php">Popis</a>
            
            <?php if (isset($_SESSION['korisnik'])) {?>
                    <li><a href="../index.php?mod=odjava">Odjava</a></li>
                <?php } else { ?>
                <li><a href="prijava.php">Prijava</a></li>
                <?php }?>
            
        </nav>
        
           <div id="greske">
            <?php if (isset($_smarty_tpl->tpl_vars['greska']->value)) {?>
                    <?php echo $_smarty_tpl->tpl_vars['greska']->value;?>

            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['poruka']->value)) {?>
                <?php echo $_smarty_tpl->tpl_vars['poruka']->value;?>

                <?php }?>
            </div>
        <form novalidate id="form2" method="post" name="form2" action="<?php echo $_smarty_tpl->tpl_vars['aktivnaSkripta']->value;?>
">
            <p class="okvirPrijave">
                <label class ="labela" for="korime">Korisničko ime: </label>
                <input class="unos" type="text" id="korime" name="korime" maxlength="20" placeholder="korisničko ime" required="required"><br>
                <label class ="labela" for="lozinka">Lozinka: </label>
                <input class="unos" type="password" id="lozinka" name="lozinka" placeholder="lozinka" required="required"><br>
                <input class="zapamti" type="checkbox" name="zapamti" value="1" checked>Zapamti me<br>
                <input class="gumb" name="submit" type="submit" value=" Prijavi se "></p>
        </form>
<?php }} ?>
