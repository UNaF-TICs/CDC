<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_editoriales_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=$_POST["id_tablamodulo"];

$id_tabla11=$_POST["id_tabla11"];
$tabla11_nombre=$_POST["tabla11_nombre"];
$tabla11_descripcion=$_POST["tabla11_descripcion"];
$tabla09_subtema=$_POST["tabla09_subtema"];
$offset=$_POST["offset"]; 

if ($id_tabla11!="")
{
	$sql="select * from tabla_11_editoriales  
			where id_tabla11=$id_tabla11";

	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$id_tabla11=$row["id_tabla11"];
		$t->set_var("tabla11_nombre",htmlentities($row["tabla11_nombre"],ENT_QUOTES));
		$t->set_var("tabla11_descripcion",htmlentities($row["tabla11_descripcion"],ENT_QUOTES));
		$t->set_var("tabla09_subtema",htmlentities($row["tabla09_subtema"],ENT_QUOTES));
	}
	
	
	$url="'modulos/editoriales/php/abm_editoriales_interfaz.php'";
	$vars="'nombre_funcion=modificar_temas&";
	$vars.="id_tabla11=$id_tabla11&";
	$vars.="tabla11_nombre='+abm_editoriales.tabla11_nombre.value+'&";
	$vars.="tabla11_descripcion='+abm_editoriales.tabla11_descripcion.value";
	
	$url_exito="'modulos/editoriales/php/ver_editoriales_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Editorial");
}
else
{
	$t->set_var("tabla11_nombre","");
	$t->set_var("tabla11_descripcion","");
	$t->set_var("tabla09_subtema","");
	
	$url="'modulos/editoriales/php/abm_editoriales_interfaz.php'";
	$vars="'nombre_funcion=agregar_editoriales&";
	$vars.="tabla11_nombre='+abm_editoriales.tabla11_nombre.value+'&";
	$vars.="tabla11_descripcion='+abm_editoriales.tabla11_descripcion.value";
			
	$url_exito="'modulos/editoriales/php/ver_editoriales_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Editorial");
}


$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/editoriales/php/ver_editoriales_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
