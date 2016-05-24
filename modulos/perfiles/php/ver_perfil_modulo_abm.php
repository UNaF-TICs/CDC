<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "abm_perfiles_modulos.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"main"		=> "ver_perfil_modulo_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));

$id_tabla04=$_POST["id_tabla04"]; 
$rela_tabla03=$_POST["rela_tabla03"]; 

$offset=$_POST["offset"]; 
$estado = array('0' => '','1' => 'checked','0' => ''); 



if ($id_tabla04!="")
{
	$sql="select * from tabla_04_det_perfiles where id_tabla04=$id_tabla04";
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
		$row = mysql_fetch_assoc($result);
		$rela_tabla02=$row["rela_tabla02"];
		$rela_tabla03=$row["rela_tabla03"];
		
		$t->set_var("tabla04_alta",$estado[$row["tabla04_alta"]]);
		$t->set_var("tabla04_baja",$estado[$row["tabla04_baja"]]);
		$t->set_var("tabla04_modificacion",$estado[$row["tabla04_modificacion"]]);
		$t->set_var("tabla04_reporte",$estado[$row["tabla04_reporte"]]);
	}
	
	$url="'modulos/perfiles/php/abm_perfiles_modulos_interfaz.php'";
	$vars="'nombre_funcion=modificar_perfil_modulo&";
	$vars.="id_tabla04=$id_tabla04&";
	$vars.="rela_tabla03=$rela_tabla03&";
	$vars.="rela_tabla02='+abm.rela_tabla02.value+'&";
	$vars.="tabla04_alta='+abm.tabla04_alta.checked+'&";
	$vars.="tabla04_baja='+abm.tabla04_baja.checked+'&";
	$vars.="tabla04_modificacion='+abm.tabla04_modificacion.checked+'&";
	$vars.="tabla04_reporte='+abm.tabla04_reporte.checked";
			
	$url_exito="'modulos/perfiles/php/ver_perfil_modulo.php'";
	$id="'popup'";
	$vars_exito="'offset=$offset&id_tabla03=$rela_tabla03'";		
	$t->set_var("tit","Modificar perfil de usuario");

}
else
{
	$t->set_var("tabla04_alta","");
	$t->set_var("tabla04_baja","");
	$t->set_var("tabla04_modificacion","");
	$t->set_var("tabla04_reporte","");


	$url="'modulos/perfiles/php/abm_perfiles_modulos_interfaz.php'";
	$vars="'nombre_funcion=agregar_perfil_modulo&";
	$vars.="rela_tabla03=$rela_tabla03&";
	$vars.="rela_tabla02='+abm.rela_tabla02.value+'&";
	$vars.="tabla04_alta='+abm.tabla04_alta.checked+'&";
	$vars.="tabla04_baja='+abm.tabla04_baja.checked+'&";
	$vars.="tabla04_modificacion='+abm.tabla04_modificacion.checked+'&";
	$vars.="tabla04_reporte='+abm.tabla04_reporte.checked";
			
	$url_exito="'modulos/perfiles/php/ver_perfil_modulo.php'";
	$id="'popup'";
	$vars_exito="'offset=$offset&id_tabla03=$rela_tabla03'";		
	$t->set_var("tit","Agregar perfil de usuario");
}


if ($id_tabla04!="")
{
	$sql="select * from (tabla_02_modulos 
			left outer join tabla_04_det_perfiles on id_tabla02=rela_tabla02 AND rela_tabla03=$rela_tabla03)
			 where (rela_tabla03 IS NULL OR id_tabla04=$id_tabla04) AND rela_padre IS NOT NULL
             order by tabla02_nombre ASC";
			 //echo $sql;
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
	
		while ($row_tipo = mysql_fetch_assoc($result))
		{
			$id_tabla02 =$row_tipo["id_tabla02"];
			if ($id_tabla02==$rela_tabla02)
			{
				$t->set_var("id","\"$id_tabla02\" SELECTED");
				$t->set_var("descripcion",htmlentities($row_tipo["tabla02_nombre"],ENT_QUOTES));	
				$t->parse("MODULOS","una_opcion",true);
			}
			else
			{
				$t->set_var("id",$id_tabla02);
				$t->set_var("descripcion",htmlentities($row_tipo["tabla02_nombre"],ENT_QUOTES));	
				$t->parse("MODULOS","una_opcion",true);
			}				
		}
	}
}
else
{
	$sql="select * from (tabla_02_modulos 
			left outer join tabla_04_det_perfiles on id_tabla02=rela_tabla02 AND rela_tabla03=$rela_tabla03)
			 where rela_tabla03 IS NULL AND rela_padre IS NOT NULL
             order by tabla02_nombre ASC";
			 
	$result = mysql_query($sql,$link_mysql);
	$num_rows = mysql_num_rows($result);
	if ($num_rows>0)
	{
	
		while ($row_tipo = mysql_fetch_assoc($result))
		{
			$id_tabla02 =$row_tipo["id_tabla02"];
			if ($id_tabla02==$rela_tabla02)
			{
				$t->set_var("id","\"$id_tabla02\" SELECTED");
				$t->set_var("descripcion",htmlentities($row_tipo["tabla02_nombre"],ENT_QUOTES));	
				$t->parse("MODULOS","una_opcion",true);
			}
			else
			{
				$t->set_var("id",$id_tabla02);
				$t->set_var("descripcion",htmlentities($row_tipo["tabla02_nombre"],ENT_QUOTES));	
				$t->parse("MODULOS","una_opcion",true);
			}				
		}
	}

}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		
//$t->set_var("funcion_guardar","alert($estructura_hc);");		

$url="'modulos/perfiles/php/ver_perfil_modulo.php'";
$id="'popup'";
$vars="'offset=$offset&id_tabla03=$rela_tabla03'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars);");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars);");	

//echo $estructura_hc;
$t->pparse("OUT", "main");

?>




