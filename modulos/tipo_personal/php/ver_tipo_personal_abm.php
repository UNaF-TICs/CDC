<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_tipo_personal_abm.html",
	"una_opcion"	=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla72=isset($_POST['id_tabla72']) ? intval($_POST['id_tabla72']) : NULL;
$offset=$_POST["offset"];
$rela_tabla09='';
$rela_tabla11='';

if ($id_tabla72!="")
{
	$sql="select * from tabla_72_tbl_tipo_personal
	where id_tabla72=$id_tabla72";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla72=$row["id_tabla72"];
		$t->set_var("tabla72_descripcion",htmlentities($row["tabla72_descripcion"],ENT_QUOTES));
	}


	$url="'modulos/tipo_personal/php/abm_tipo_personal_interfaz.php'";
	$vars="'nombre_funcion=modificar_tipo_personal&";
	$vars.="id_tabla72=$id_tabla72&";
	$vars.="tabla72_descripcion='+abm_tipo_personal.tabla72_descripcion.value";

	$url_exito="'modulos/tipo_personal/php/ver_tipo_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Modificar Libro");
}
else
{
	$t->set_var("tabla72_descripcion","");

	$url="'modulos/tipo_personal/php/abm_tipo_personal_interfaz.php'";
	$vars="'nombre_funcion=agregar_tipo_personal&";
	$vars.="tabla72_descripcion='+abm_tipo_personal.tabla72_descripcion.value";

	$url_exito="'modulos/tipo_personal/php/ver_tipo_personal_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Agregar Libro");
}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$url="'modulos/tipo_personal/php/ver_tipo_personal_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
