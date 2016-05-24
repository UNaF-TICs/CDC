<?php
session_start();
session_destroy();
$_SESSION=array();
$_SESSION['id_tabla01']="";
///header("Location: ../index.php")
?>
