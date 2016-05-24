<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_temas_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=$_POST["id_tablamodulo"];

$id_tabla09=$_POST["id_tabla09"];
$tabla09_nombre=$_POST["tabla09_nombre"];
$tabla09_descripcion=$_POST["tabla09_descripcion"];
$tabla09_subtema=$_POST["tabla09_subtema"];
$offset=$_POST["offset"]; 

if ($id_tabla09!="")
{
	$sql="select * from tabla_09_temas  
			where id_tabla09=$id_tabla09";

	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$id_tabla09=$row["id_tabla09"];
		$t->set_var("tabla09_nombre",htmlentities($row["tabla09_nombre"],ENT_QUOTES));
		$t->set_var("tabla09_descripcion",htmlentities($row["tabla09_descripcion"],ENT_QUOTES));
		$t->set_var("tabla09_subtema",htmlentities($row["tabla09_subtema"],ENT_QUOTES));
	}
	
	
	$url="'modulos/temas/php/abm_temas_interfaz.php'";
	$vars="'nombre_funcion=modificar_temas&";
	$vars.="id_tabla09=$id_tabla09&";
	$vars.="tabla09_nombre='+abm_temas.tabla09_nombre.value+'&";
	$vars.="tabla09_descripcion='+abm_temas.tabla09_descripcion.value+'&";
	$vars.="tabla09_subtema='+abm_temas.tabla09_subtema.value";
	
	$url_exito="'modulos/temas/php/ver_temas_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Tema");
}
else
{
	$t->set_var("tabla09_nombre","");
	$t->set_var("tabla09_descripcion","");
	$t->set_var("tabla09_subtema","");
	
	$url="'modulos/temas/php/abm_temas_interfaz.php'";
	$vars="'nombre_funcion=agregar_temas&";
	$vars.="tabla09_nombre='+abm_temas.tabla09_nombre.value+'&";
	$vars.="tabla09_descripcion='+abm_temas.tabla09_descripcion.value+'&";
	$vars.="tabla09_subtema='+abm_temas.tabla09_subtema.value";
			
	$url_exito="'modulos/temas/php/ver_temas_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Tema");
}


$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/temas/php/ver_temas_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
