<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_variedad_abm.html",
	"una_opcion"			=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla15=isset($_POST['id_tabla15']) ? intval($_POST['id_tabla15']) : NULL;
$offset=$_POST["offset"]; 

if ($id_tabla15!="")
{
	$sql="select * from tabla_15_tbl_variedad  
	where id_tabla15=$id_tabla15";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla15=$row["id_tabla15"];
		$t->set_var("tabla15_nombre",htmlentities($row["tabla15_nombre"],ENT_QUOTES));
		$t->set_var("tabla15_descripcion",htmlentities($row["tabla15_descripcion"],ENT_QUOTES));
		$t->set_var("tabla15_temperatura_maxima",htmlentities($row["tabla15_temperatura_maxima"],ENT_QUOTES));
		$t->set_var("tabla15_temperatura_minima",htmlentities($row["tabla15_temperatura_minima"],ENT_QUOTES));
		$t->set_var("tabla15_temperatura_optima",htmlentities($row["tabla15_temperatura_optima"],ENT_QUOTES));

	}
	
	
	$url="'modulos/variedad/php/abm_variedad_interfaz.php'";
	$vars="'nombre_funcion=modificar_variedad&";
	$vars.="id_tabla15=$id_tabla15&";
	$vars.="tabla15_nombre='+abm_variedad.tabla15_nombre.value+'&";
	$vars.="tabla15_temperatura_maxima='+abm_variedad.tabla15_temperatura_maxima.value+'&";
	$vars.="tabla15_temperatura_minima='+abm_variedad.tabla15_temperatura_minima.value+'&";
	$vars.="tabla15_temperatura_optima='+abm_variedad.tabla15_temperatura_optima.value+'&";
	$vars.="tabla15_descripcion='+abm_variedad.tabla15_descripcion.value";
	
	$url_exito="'modulos/variedad/php/ver_variedad_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";	
	$t->set_var("tit","Modificar Variedad");
}
else
{
	$t->set_var("tabla15_nombre","");
	$t->set_var("tabla15_descripcion","");
	$t->set_var("tabla15_temperatura_maxima","");
	$t->set_var("tabla15_temperatura_minima","");
	$t->set_var("tabla15_temperatura_optima","");
	
	$url="'modulos/variedad/php/abm_variedad_interfaz.php'";
	$vars="'nombre_funcion=agregar_variedad&";
	$vars.="tabla15_nombre='+abm_variedad.tabla15_nombre.value+'&";
	$vars.="tabla15_temperatura_maxima='+abm_variedad.tabla15_temperatura_maxima.value+'&";
	$vars.="tabla15_temperatura_minima='+abm_variedad.tabla15_temperatura_minima.value+'&";
	$vars.="tabla15_temperatura_optima='+abm_variedad.tabla15_temperatura_optima.value+'&";
	$vars.="tabla15_descripcion='+abm_variedad.tabla15_descripcion.value";
			
	$url_exito="'modulos/variedad/php/ver_variedad_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		
	$t->set_var("tit","Agregar Variedad");
}


$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");		


$url="'modulos/variedad/php/ver_variedad_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";		

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");	
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");	

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
