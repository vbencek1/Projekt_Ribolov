<?php /* Smarty version Smarty-3.1.21-dev, created on 2019-05-21 19:17:12
         compiled from "C:\xampp\htdocs\Projekt_Ribolov\templates\obrazac.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6455119725ce43298875840-59529507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27fe7e959b283e5256106fd5ed03fae4417656b4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Projekt_Ribolov\\templates\\obrazac.tpl',
      1 => 1558456912,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6455119725ce43298875840-59529507',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aktivnaSkripta' => 0,
    'porukaUploada' => 0,
    'pj_voli_values' => 0,
    'pj_voli_output' => 0,
    'porukaPad' => 0,
    'klasaOcjena' => 0,
    'porukaOcjene' => 0,
    'zadnjaPoruka' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5ce432989a12e3_23278311',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ce432989a12e3_23278311')) {function content_5ce432989a12e3_23278311($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\xampp\\htdocs\\Projekt_Ribolov\\vanjske_biblioteke\\Smarty\\libs\\plugins\\function.html_options.php';
?>        <link href="../css/vbencek.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_480.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1024.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_720.css" rel="stylesheet" type="text/css">
        <link href="../css/vbencek_1366.css" rel="stylesheet" type="text/css">
    </head>
    <body onload="funkcije();">

      <!--  <?php echo '<script'; ?>
 type="text/javascript" src="../javascript/vbencek.js">
        <?php echo '</script'; ?>
>

        <noscript>
        Preglednik NE može izvršti JavaScript!
        </noscript>   --->

        <header>
            <div id="anim_obr"></div>
            <h1>Obrazac</h1>
        </header>
        <nav>
            <a href="../index.php">Početna</a>
            <a href="registracija.php">Registracija</a>
            <a href="prijava.php">Prijava</a>
            <a href="../ostalo/multimedija.php">Multimedija</a>
            <a href="../ostalo/popis.php">Popis</a>
        </nav>

        <form novalidate id="form3" enctype="multipart/form-data" method="post" name="form3" action="<?php echo $_smarty_tpl->tpl_vars['aktivnaSkripta']->value;?>
">
            <div class="okvirPrijave">
                <h3 class="naslov-obrazac">Pošaljite sliku</h3>
                <div class="cjeline-obrazac">
                    <label class ="labela-obrazac" for="userfile">Odaberite sliku koju biste htjeli da stavimo na web stranicu: </label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                    <input class="gumb-postava" type="file" id="userfile" name="userfile"><br>
                    <label class="labela-obrazac" style="color:red; font-size: 10px;"><?php echo $_smarty_tpl->tpl_vars['porukaUploada']->value;?>
</label><br><br>
                    <label class ="labela" for="tel">Vaš broj telefona:</label>
                    <input class="unos" type="tel" id="tel" name="telefon" placeholder="+385-xx-yyy-zzz"><br>
                </div> 
                <h3 class="naslov-obrazac">Mala anketa</h3>
                <div class="cjeline-obrazac">

                    <label class="labela-obrazac" for="visina">Koliko vremena provodite na internetu: </label>
                    <input type="range" id="visina" name="visina" min="0" max="100" value="50"><br>
                    <label class="labela-obrazac" for="preglednik">Koji preglednik trenutno koristite: </label>
                    <select class="liste" id="preglednik" name="preglednik" size="5">
                        <option value="0">Firefox</option>
                        <option value="1">Chrome</option>
                        <option value="2">Internet Explorer</option>
                        <option value="3">Opera</option>
                        <option value="4">Safari</option>
                    </select><br>


                    <label class ="labela" for="boja">Vaša omiljena boja: </label>
                    <input  type="color" id="boja" name="boja" value="#000000"><br><br>

                    <p class="paragraf-obrazac">Što najviše volite:</p><br><br><br>
                    <label class="labela" for="program">Programirati</label>
                    <input type="radio" name="okupacija" id="program" value="Programiranje"><br>
                    <label class="labela" for="sport">Baviti se sportom</label>
                    <input type="radio" name="okupacija" id="sport" value="Sport"><br>
                    <label class="labela" for="nista">Ništa ne raditi</label>
                    <input type="radio" name="okupacija" id="nista" value="Ništa ne raditi"><br><br>

                    <label class= "labela-obrazac" for="predmet">Najdraži predmeti na faksu(moguće više odabira): </label>
                    
                    <select class="liste" id="predmet" name="predmet[]" multiple="multiple" size="5">
                     <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['pj_voli_values']->value,'output'=>$_smarty_tpl->tpl_vars['pj_voli_output']->value),$_smarty_tpl);?>

                   </select>
                     <label class="labela-obrazac" style="color:red;"><?php echo $_smarty_tpl->tpl_vars['porukaPad']->value;?>
</label><br>
                 

                </div> 
                <h3 class="naslov-obrazac">Feedback</h3>
                <div class="cjeline-obrazac">
                    <label class= "labela-obrazac" for="misljenje">Mišljenje o stranici:</label> 
                    <textarea class="misljenje" id="misljenje" name="misljenje" rows="3" cols="60" placeholder="Vaše mišljenje"></textarea><br>
                    <label class ="labela-obrazac" for="ocjena">Ocijeni stranicu brojevima od 1 do 5: </label>
                    <input class="<?php echo $_smarty_tpl->tpl_vars['klasaOcjena']->value;?>
" type="number" id="ocjena" name="ocjena"  placeholder="Broj(0-100)">
                    <label class="labela-obrazac" style="color:red;"><?php echo $_smarty_tpl->tpl_vars['porukaOcjene']->value;?>
</label><br>
                </div>
                    <label class="labela-obrazac" style="color:red;"><?php echo $_smarty_tpl->tpl_vars['zadnjaPoruka']->value;?>
</label><br>
                <input class="gumb" type="submit" name="submit" id="gumb" value="Pošalji "></div>
        </form>

<?php }} ?>
