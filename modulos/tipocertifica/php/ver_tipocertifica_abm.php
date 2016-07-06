<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_tipocertifica_abm.html",
	"una_opcion"	=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla67=isset($_POST['id_tabla67']) ? intval($_POST['id_tabla67']) : NULL;
$offset=$_POST["offset"];
$rela_tabla09='';
$rela_tabla11='';

if ($id_tabla67!="")
{
	$sql="select * from tabla_67_tbl_tipocertifica
	where id_tabla67=$id_tabla67";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0)
	{
		$row = $rs->fetch();
		$id_tabla67=$row["id_tabla67"];
		$t->set_var("tabla67_descrip",htmlentities($row["tabla67_descrip"],ENT_QUOTES));
	}


	$url="'modulos/tipocertifica/php/abm_tipocertifica_interfaz.php'";
	$vars="'nombre_funcion=modificar_tipocertifica&";
	$vars.="id_tabla67=$id_tabla67&";
	$vars.="tabla67_descrip='+abm_tipocertifica.tabla67_descrip.value";

	$url_exito="'modulos/tipocertifica/php/ver_tipocertifica_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Modificar Libro");
}
else
{
	$t->set_var("tabla67_descrip","");

	$url="'modulos/tipocertifica/php/abm_tipocertifica_interfaz.php'";
	$vars="'nombre_funcion=agregar_tipocertifica&";
	$vars.="tabla67_descrip='+abm_tipocertifica.tabla67_descrip.value";

	$url_exito="'modulos/tipocertifica/php/ver_tipocertifica_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Agregar Libro");
}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$url="'modulos/tipocertifica/php/ver_tipocertifica_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
