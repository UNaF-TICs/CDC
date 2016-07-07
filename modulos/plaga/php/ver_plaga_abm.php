<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_plaga_abm.html",
	"una_opcionplaga"			=> "una_opcionplaga.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla33=isset($_POST['id_tabla33']) ? intval($_POST['id_tabla33']) : NULL;
$offset=$_POST["offset"]; 
$Rela_Tabla14='';


if ($id_tabla33!="")
{
	$sql="SELECT * FROM tabla_33_tbl_plaga
	where id_tabla33=$id_tabla33";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla33=$row["id_tabla33"];
		$t->set_var("tabla33_descripcion",htmlentities($row["tabla33_descripcion"],ENT_QUOTES));
		

	}
	
	
	$url="'modulos/plaga/php/abm_plaga_interfaz.php'";
	$vars="'nombre_funcion=modificar_plaga&";
	$vars.="id_tabla33=$id_tabla33&";
	$vars.="Rela_Tabla14='+abm_plaga.Rela_Tabla14.value+'&";
	$vars.="tabla33_descripcion='+abm_plaga.tabla33_descripcion.value";
	
	
	
	$url_exito="'modulos/plaga/php/ver_plaga_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	
	$t->set_var("tit","Modificar plaga");
}
else
{
	
	$t->set_var("tabla33_descripcion","");
	
	
	$url="'modulos/plaga/php/abm_plaga_interfaz.php'";
	$vars="'nombre_funcion=agregar_plaga&";
	$vars.="tabla33_descripcion='+abm_plaga.tabla33_descripcion.value";
	
				
	$url_exito="'modulos/plaga/php/ver_plaga_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar plaga");
}



$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito);");
		


$url="'modulos/plaga/php/ver_plaga_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
