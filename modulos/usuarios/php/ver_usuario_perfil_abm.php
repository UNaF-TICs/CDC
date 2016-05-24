<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "abm_usuarios.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver_abm"		=> "ver_usuario_perfil_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));

$id_tabla06=$_POST["id_tabla06"]; 
$rela_tabla01=$_POST["rela_tabla01"]; 

$offset=$_POST["offset"]; 
$habilitado = array('0' => 'NO','1' => 'SI'); 

if ($id_tabla06!="")
{
	$sql="select * from tabla_06_det_usuarios_perfiles
			 where id_tabla06=$id_tabla06" ;
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
	
		while ($row_tipo = mysql_fetch_assoc($result))
		{
			$id_tabla06=$row_tipo["id_tabla06"];
			$rela_tabla03 =$row_tipo["rela_tabla03"];
			
			$url="'modulos/usuarios/php/abm_usuarios_perfiles_interfaz.php'";
			$vars="'nombre_funcion=modificar_usuario_perfil&";
			$vars.="id_tabla06=$id_tabla06&";
			$vars.="rela_tabla01=$rela_tabla01&";
			$vars.="rela_tabla03='+abm.rela_tabla03.value";
			
			$url_exito="'modulos/usuarios/php/ver_usuario_perfil.php'";
			$id="'popup'";
			$vars_exito="'offset=$offset&id_tabla01=$rela_tabla01'";		
			$t->set_var("tit","Modificar Perfil de usuario");
			
			
		}
	}
}else{
	$url="'modulos/usuarios/php/abm_usuarios_perfiles_interfaz.php'";
	$vars="'nombre_funcion=agregar_usuario_perfil&";
	$vars.="rela_tabla01=$rela_tabla01&";
	$vars.="rela_tabla03='+abm.rela_tabla03.value";
			
	$url_exito="'modulos/usuarios/php/ver_usuario_perfil.php'";
	$id="'popup'";
	$vars_exito="'offset=$offset&id_tabla01=$rela_tabla01'";		
	$t->set_var("tit","Agregar perfil de usuario");

}

	$sql="select * from tabla_03_perfiles 
             order by tabla03_nombre ASC";
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
	
		while ($row_tipo = mysql_fetch_assoc($result))
		{
			$id_tabla03 =$row_tipo["id_tabla03"];
			if ($id_tabla03==$rela_tabla03)
			{
				$t->set_var("id","\"$id_tabla03\" SELECTED");
				$t->set_var("descripcion",htmlentities($row_tipo["tabla03_nombre"],ENT_QUOTES));	
				$t->parse("PERFILES","una_opcion",true);
			}
			else
			{
				$t->set_var("id",$id_tabla03);
				$t->set_var("descripcion",htmlentities($row_tipo["tabla03_nombre"],ENT_QUOTES));	
				$t->parse("PERFILES","una_opcion",true);
			}				
		}
	}



$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		
$t->set_var("funcion_cerrar","cargar_post('modulos/usuarios/php/ver_usuario_perfil.php','popup','id_tabla01=$rela_tabla01');");	
$t->set_var("funcion_cancelar","cargar_post('modulos/usuarios/php/ver_usuario_perfil.php','popup','id_tabla01=$rela_tabla01');");	

$t->pparse("OUT", "ver_abm");
?>