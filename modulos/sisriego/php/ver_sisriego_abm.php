<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_sisriego_abm.html",
	"una_opcion"	=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla66=isset($_POST['id_tabla66']) ? intval($_POST['id_tabla66']) : NULL;
$offset=$_POST["offset"];
$rela_tabla09='';
$rela_tabla11='';

if ($id_tabla66!="")
{
	$sql="select * from tabla_66_tbl_sisriego
	where id_tabla66=$id_tabla66";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla66=$row["id_tabla66"];
		$t->set_var("tabla66_descrip",htmlentities($row["tabla66_descrip"],ENT_QUOTES));
	}


	$url="'modulos/sisriego/php/abm_sisriego_interfaz.php'";
	$vars="'nombre_funcion=modificar_sisriego&";
	$vars.="id_tabla66=$id_tabla66&";
	$vars.="tabla66_descrip='+abm_sisriego.tabla66_descrip.value";

	$url_exito="'modulos/sisriego/php/ver_sisriego_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Modificar Libro");
}
else
{
	$t->set_var("tabla66_descrip","");

	$url="'modulos/sisriego/php/abm_sisriego_interfaz.php'";
	$vars="'nombre_funcion=agregar_sisriego&";
	$vars.="tabla66_descrip='+abm_sisriego.tabla66_descrip.value";

	$url_exito="'modulos/sisriego/php/ver_sisriego_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Agregar Libro");
}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$url="'modulos/sisriego/php/ver_sisriego_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
