<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-22 18:17:50
         compiled from "C:\xampp\htdocs\Projekt_Ribolov\templates\prijava.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8127681155ce432964dd1a6-30792355%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2806938dbab7b238d8acc97c0980a04d9f89bb5f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekt_Ribolov\\templates\\prijava.tpl',
      1 => 1558541867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8127681155ce432964dd1a6-30792355',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5ce4329666f3f0_85743431',
  'variables' => 
  array (
    'greska' => 0,
    'poruka' => 0,
    'aktivnaSkripta' => 0,
    'porukaPrijave' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ce4329666f3f0_85743431')) {function content_5ce4329666f3f0_85743431($_smarty_tpl) {?>        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
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
                    <a href="../index.php?mod=odjava">Odjava</a>
                <?php } else { ?>
                <a href="prijava.php">Prijava</a>
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
                
                <input class="gumb" name="submit" type="submit" value=" Prijavi se ">
                <label class="labela" style="color:red;width:400px;"> <?php echo $_smarty_tpl->tpl_vars['porukaPrijave']->value;?>
</label>
                <br><br>
                
            
            </p>
        </form>
<?php }} ?>
