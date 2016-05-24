<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "abm_perfiles.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_perfil_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=$_POST["id_tablamodulo"];
$id_tabla03=$_POST["id_tabla03"]; 
$offset=$_POST["offset"]; 
$habilitado = array('0' => 'NO','1' => 'SI'); 

if ($id_tabla03!="")
{
	$sql="select * from tabla_03_perfiles 
			where id_tabla03=$id_tabla03";
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$t->set_var("tabla03_nombre",$row["tabla03_nombre"]);
	}
	
	
	$url="'modulos/perfiles/php/abm_perfiles_interfaz.php'";
	$vars="'nombre_funcion=modificar_perfil&";
	$vars.="id_tabla03=$id_tabla03&";
	$vars.="tabla03_nombre='+abm_perfil.tabla03_nombre.value";
			
	$url_exito="'modulos/perfiles/php/ver_perfiles.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Modificar Perfil");

}
else
{
	$t->set_var("tabla03_nombre");

	$url="'modulos/perfiles/php/abm_perfiles_interfaz.php'";
	$vars="'nombre_funcion=agregar_perfil&";
	$vars.="tabla03_nombre='+abm_perfil.tabla03_nombre.value";
			
	$url_exito="'modulos/perfiles/php/ver_perfiles.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Perfil");
}



$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		
//$t->set_var("funcion_guardar","alert($estructura_hc);");		
$t->set_var("funcion_cancelar","cargar_post('modulos/perfiles/php/ver_perfiles.php','tabs-$id_tablamodulo','offset=$offset&id_tablamodulo=$id_tablamodulo');");	
$t->set_var("funcion_cerrar","cargar_post('modulos/perfiles/php/ver_perfiles.php','tabs-$id_tablamodulo','offset=$offset&id_tablamodulo=$id_tablamodulo');");	

//echo $estructura_hc;
$t->pparse("OUT", "main");

?>




