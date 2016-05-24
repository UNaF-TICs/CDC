<?php
session_start();

include "../lib/link_mysql.php";
include "../lib/template.inc";
include "privilegios.php";
$_SESSION['id_tabla02']=$_POST['id_tabla02'];
//tambien tiene que armar los privilegios
if ($_SESSION['id_tabla02']<>"")
{
	$acceso=recuperar_perfiles_con_modulo($_SESSION['id_tabla01'] ,$_SESSION['id_tabla02'] ,$link_mysql);
	echo $acceso;
}
else
{
	echo "NULL";
	$acceso["alta"]="0";
	$acceso["baja"]="0";
	$acceso["modificacion"]="0";
	$acceso["reporte"]="0";
}

$_SESSION['sesion_acceso'] = $acceso;
echo $_SESSION['sesion_acceso']["alta"];

?>