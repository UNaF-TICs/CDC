<?php
include "logueo/lib/template.inc";

ini_set("session.cache_expire",30);
ini_set("session.gc_maxlifetime",9000);
session_start();
include "escrutinio_ajax/php/funcion_borrar_variables.php";

$t = new Template('logueo/templates/');
//Archivos comunes
$t->set_file(array(
	"index_login"	=> "index_login.html",
	
));
//$_SESSION["MOD_CARGA"]
/*
2 estados:
"" -> sin carga
"cargando" -> proceso de carga
*/
borrar_session();
//$_SESSION["MOD_CRITICO"]="";

if ($_SESSION['sesion_id_usuario'] =="")
{
	$t->set_var("inicio","logueo/templates/login.html");
}
else
{
	$t->set_var("inicio","logueo/php/cargar_modulos.php");
}
$t->pparse("OUT", "index_login");		

?>

