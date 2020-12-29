<?php
require '../vanjske_biblioteke/sesija.class.php';
sesija::kreirajSesiju();
sesija::obrisiSesiju();
header("Location: ../index.php");
?>