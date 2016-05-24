<?php
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";

/*Recibo los parametros para cargar el formulario ABM
Si son vacios es porque tengo que agregar uno nuevo.
*/
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"_VER_BUSQUEDA"		=> "ver_control_busqueda.html",
	"_una_opcion"		=> "una_opcion.html",	
));

//Configuración Inicial
$titulo="Control de Acciones";
$t->set_var("titulo",$titulo);
//

/*Alias de tablas*/
$qr="Select * from tabla_02_modulos
		where rela_padre >0 order by tabla02_nombre ASC";
$result = mysql_query($qr,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row_tipo = mysql_fetch_assoc($result))
	{
		$t->set_var("id",$row_tipo["id_tabla02"]);
		$t->set_var("descripcion",htmlentities($row_tipo["tabla02_nombre"]));	
		$t->parse("MODULOS","_una_opcion",true);
	}
	
}	


$qr="Select * from tabla_01_usuarios order by tabla01_nombre ASC";
$result = mysql_query($qr,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{

	while ($row_tipo = mysql_fetch_assoc($result))
	{
		$t->set_var("id",$row_tipo["id_tabla01"]);
		$t->set_var("descripcion",$row_tipo["tabla01_nombre"]);	
		$t->parse("USUARIOS","_una_opcion",true);
	}
	
}	



$url="'modulos/control/php/ver_control.php'";
$id="'listado'";
$vars="'es_buscar=si&";	
$vars.="id_tabla01_buscar='+ver_busqueda.id_tabla01_buscar.value+'&";	
$vars.="id_tabla02_buscar='+ver_busqueda.id_tabla02_buscar.value+'&";	
$vars.="texto='+ver_busqueda.texto.value+'&";	
$vars.="fecha_desde='+ver_busqueda.fecha_desde.value+'&";	
$vars.="fecha_hasta='+ver_busqueda.fecha_hasta.value";	

$t->set_var("funcion_busqueda","cargar_post($url,$id,$vars)");


$t->set_var("funcion_cerrar","cargar_get('modulos/login/php/cargar_modulos.php','content');");	

$t->pparse("OUT", "_VER_BUSQUEDA");




?>
