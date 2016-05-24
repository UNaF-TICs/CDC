<?php
include "../../../lib/template.inc";
include "../../../lib/link_mysql.php";
include "../../../php/check.php";
include "../../../php/funciones_comunes.php";


$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_reporte.html",
	));
	
$id_tabla05=$_POST["id_tabla05"]; 

if ($id_tabla05!="")
{
	$qr="Select * from tabla_05_log
	inner join tabla_01_usuarios on rela_tabla01=id_tabla01
	left outer join tabla_02_modulos  on rela_tabla02=id_tabla02
	where id_tabla05=$id_tabla05";
	$result = mysql_query($qr,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		  $row = mysql_fetch_assoc($result);
		
		  $id_tabla05 = $row["id_tabla05"];
		  $t->set_var("tabla01_usuario",htmlentities($row["tabla01_usuario"],ENT_QUOTES));
		  $t->set_var("tabla01_nombre",htmlentities($row["tabla01_nombre"],ENT_QUOTES));
		  $t->set_var("tabla02_nombre",htmlentities($row["tabla02_nombre"],ENT_QUOTES));
		  $t->set_var("tabla05_operacion",htmlentities($row["tabla05_operacion"],ENT_QUOTES));
		  $t->set_var("tabla05_fecha",ver_fecha($row["tabla05_fecha"]));
		  $t->set_var("tabla05_hora",htmlentities($row["tabla05_hora"],ENT_QUOTES));
		  $t->set_var("tabla05_descripcion",htmlentities($row["tabla05_descripcion"]));
		  $t->set_var("tabla05_mensaje",htmlentities($row["tabla05_mensaje"],ENT_QUOTES));
		  
	}
}

$t->pparse("OUT", "ver");	
?>