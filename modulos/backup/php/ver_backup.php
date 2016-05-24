<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_backup.html",

	));
//Configuración Inicial
$titulo="Generar Backup";
$t->set_var("titulo",$titulo);
$id_tablamodulo=$_POST["id_tablamodulo"];
//

	
	$t->pparse("OUT", "main");

?>


