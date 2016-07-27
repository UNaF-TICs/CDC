<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver" => "ver_parcela_abm.html",
	"una_opcion" => "una_opcion.html",
	));

$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla65=isset($_POST['id_tabla65']) ? intval($_POST['id_tabla65']) : NULL;
$offset=$_POST["offset"];
$rela_tabla09='';
$rela_tabla64='';
$rela_tabla66='';

if ($id_tabla65!="") {
	$sql="SELECT * FROM tabla_65_tbl_parcela WHERE id_tabla65=$id_tabla65";
	$rs = $pdo->query($sql);
	$num_rows = $rs->rowCount();
	if ($num_rows>0) {
		$row = $rs->fetch();
		$id_tabla65=$row["id_tabla65"];
		$rela_tabla09=$row["rela_tabla09"];
		$rela_tabla64=$row["rela_tabla64"];
		$rela_tabla66=$row["rela_tabla66"];
		$t->set_var("rela_tabla09",$row["rela_tabla09"]);
		$t->set_var("rela_tabla64",$row["rela_tabla64"]);
		$t->set_var("rela_tabla66",$row["rela_tabla66"]);
		$t->set_var("tabla65_numero",htmlentities($row["tabla65_numero"],ENT_QUOTES));
		$t->set_var("tabla65_limites",htmlentities($row["tabla65_limites"],ENT_QUOTES));
		$t->set_var("tabla65_tieneregadio",$row["tabla65_tieneregadio"]);
		// $t->set_var("tieneregadio_checked",($row["tabla65_tieneregadio"]==1) ? "checked" : "");
		$t->set_var("tieneregadio_si",($row["tabla65_tieneregadio"]==1) ? "checked" : "");
		$t->set_var("tieneregadio_no",($row["tabla65_tieneregadio"]!=1) ? "checked" : "");
		$t->set_var("tabla65_areatotal",$row["tabla65_areatotal"]);
	}

	$url="'modulos/parcela/php/abm_parcela_interfaz.php'";
	$vars="'nombre_funcion=modificar_parcela&";
	$vars.="id_tabla65=$id_tabla65&";
	$vars.="tabla65_numero='+abm_parcela.tabla65_numero.value+'&";
	$vars.="rela_tabla09='+abm_parcela.rela_tabla09.value+'&";
	$vars.="rela_tabla64='+abm_parcela.rela_tabla64.value+'&";
	$vars.="rela_tabla66='+abm_parcela.rela_tabla66.value+'&";
	$vars.="tabla65_areatotal='+abm_parcela.tabla65_areatotal.value+'&";
	$vars.="tabla65_tieneregadio='+abm_parcela.tabla65_tieneregadio.value+'&";
	$vars.="tabla65_limites='+abm_parcela.tabla65_limites.value";

	$url_exito="'modulos/parcela/php/ver_parcela_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Modificar Libro");
} else {
	$t->set_var("tabla65_numero","");
	$t->set_var("tabla65_limites","");
	$t->set_var("tabla65_tieneregadio","");
	// $t->set_var("tieneregadio_checked","");
	$t->set_var("tieneregadio_si","");
	$t->set_var("tieneregadio_no","");
	$t->set_var("rela_tabla09","");
	$t->set_var("rela_tabla64","");
	$t->set_var("rela_tabla66","");
	$t->set_var("tabla65_areatotal","");

	$url="'modulos/parcela/php/abm_parcela_interfaz.php'";
	$vars="'nombre_funcion=agregar_parcela&";
	$vars.="tabla65_numero='+abm_parcela.tabla65_numero.value+'&";
	$vars.="rela_tabla09='+abm_parcela.rela_tabla09.value+'&";
	$vars.="rela_tabla64='+abm_parcela.rela_tabla64.value+'&";
	$vars.="rela_tabla66='+abm_parcela.rela_tabla66.value+'&";
	$vars.="tabla65_areatotal='+abm_parcela.tabla65_areatotal.value+'&";
	$vars.="tabla65_tieneregadio='+abm_parcela.tabla65_tieneregadio.value+'&";
	$vars.="tabla65_limites='+abm_parcela.tabla65_limites.value";

	$url_exito="'modulos/parcela/php/ver_parcela_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Agregar Libro");
}

// Opciones para ubicación geográfica
$sql="SELECT * FROM  tabla_09_arb_ubicacion_geografica ORDER BY tabla09_descripcion ASC";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla09=$row["id_tabla09"];
		$t->set_var("ID", "\"$id_tabla09\"" . (($id_tabla09==$rela_tabla09) ? " SELECTED ": ""));
		$t->set_var("NOMBRE",utf8_encode($row["tabla09_descripcion"]));

		// phpConsoleLog($id_tabla09 . "|". $rela_tabla09. "|" . $row["tabla09_descripcion"]);

		// if ($id_tabla09==$rela_tabla09) {
		// 	$t->set_var("ID","\"$id_tabla09\" SELECTED ");
		// 	$t->set_var("NOMBRE",utf8_encode($row["tabla09_descripcion"]));
		// } else {
		// 	$t->set_var("ID",$row["id_tabla09"]);
		// 	$t->set_var("NOMBRE",utf8_encode($row["tabla09_descripcion"]));
		// }

		$t->parse("UBICGEOGS","una_opcion",true);
	}
}

// Opciones de Predios
$sql="SELECT * FROM tabla_64_tbl_predio ORDER BY tabla64_nombrepredio ASC";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();

if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla64=$row["id_tabla64"];
		$t->set_var("ID", "\"$id_tabla64\"" . (($id_tabla64==$rela_tabla64) ? " SELECTED ": ""));
		$t->set_var("NOMBRE",$row["tabla64_nombrepredio"]);
		$t->parse("PREDIOS","una_opcion",true);
	}
}

// Opciones de Sistemas de Riego
$sql="SELECT * FROM tabla_66_tbl_sisriego ORDER BY tabla66_descrip ASC";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();

if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla66=$row["id_tabla66"];
		$t->set_var("ID", "\"$id_tabla66\"" . (($id_tabla66==$rela_tabla66) ? " SELECTED ": ""));
		$t->set_var("NOMBRE",$row["tabla66_descrip"]);
		$t->parse("SISRIEGOS","una_opcion",true);
	}
}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$url="'modulos/parcela/php/ver_parcela_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
