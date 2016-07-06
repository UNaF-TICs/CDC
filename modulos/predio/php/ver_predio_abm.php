<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver" => "ver_predio_abm.html",
	"una_opcion" => "una_opcion.html",
	));

$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla64=isset($_POST['id_tabla64']) ? intval($_POST['id_tabla64']) : NULL;
$offset=$_POST["offset"];
$rela_tabla09='';
$rela_tabla63='';

if ($id_tabla64!="") {
	$sql="select * from tabla_64_tbl_predio
	where id_tabla64=$id_tabla64";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0) {
		$row = $rs->fetch();
		$id_tabla64=$row["id_tabla64"];
		$rela_tabla09=$row["rela_tabla09"];
		$rela_tabla63=$row["rela_tabla63"];
		$t->set_var("rela_tabla09",$row["rela_tabla09"]);
		$t->set_var("rela_tabla63",$row["rela_tabla63"]);
		$t->set_var("tabla64_nombrepredio",htmlentities($row["tabla64_nombrepredio"],ENT_QUOTES));
		$t->set_var("tabla64_limites",htmlentities($row["tabla64_limites"],ENT_QUOTES));
		$t->set_var("tabla64_areatotal",$row["tabla64_areatotal"]);
	}

	$url="'modulos/predio/php/abm_predio_interfaz.php'";
	$vars="'nombre_funcion=modificar_predio&";
	$vars.="id_tabla64=$id_tabla64&";
	$vars.="tabla64_nombrepredio='+abm_predio.tabla64_nombrepredio.value+'&";
	$vars.="rela_tabla09='+abm_predio.rela_tabla09.value+'&";
	$vars.="rela_tabla63='+abm_predio.rela_tabla63.value+'&";
	$vars.="tabla64_areatotal='+abm_predio.tabla64_areatotal.value+'&";
	$vars.="tabla64_limites='+abm_predio.tabla64_limites.value";

	$url_exito="'modulos/predio/php/ver_predio_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Modificar Libro");
} else {
	$t->set_var("tabla64_nombrepredio","");
	$t->set_var("tabla64_limites","");
	$t->set_var("rela_tabla09","");
	$t->set_var("rela_tabla63","");
	$t->set_var("tabla64_areatotal","");

	$url="'modulos/predio/php/abm_predio_interfaz.php'";
	$vars="'nombre_funcion=agregar_predio&";
	$vars.="tabla64_nombrepredio='+abm_predio.tabla64_nombrepredio.value+'&";
	$vars.="rela_tabla09='+abm_predio.rela_tabla09.value+'&";
	$vars.="rela_tabla63='+abm_predio.rela_tabla63.value+'&";
	$vars.="tabla64_areatotal='+abm_predio.tabla64_areatotal.value+'&";
	$vars.="tabla64_limites='+abm_predio.tabla64_limites.value";

	$url_exito="'modulos/predio/php/ver_predio_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Agregar Libro");
}

// Opciones para ubicación geográfica
$sql="Select * from  tabla_09_arb_ubicacion_geografica order by tabla09_descripcion ASC";
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

// Opciones de Fincas
$sql="Select * from FincaCompleta order by FincaNombre ASC";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();

phpConsoleLog($num_rows);

if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla63=$row["id_tabla63"];
		$t->set_var("ID", "\"$id_tabla63\"" . (($id_tabla63==$rela_tabla63) ? " SELECTED ": ""));
		$t->set_var("NOMBRE",utf8_encode($row["FincaNombre"]));

		phpConsoleLog($id_tabla63 . "|". $rela_tabla63. "|" . $row["FincaNombre"]);

		// if ($id_tabla63==$rela_tabla63) {
		// 	$t->set_var("ID","\"$id_tabla63\" SELECTED ");
		// 	$t->set_var("NOMBRE",utf8_encode($row["FincaNombre"]));
		// } else {
		// 	$t->set_var("ID",$row["$id_tabla63"]);
		// 	$t->set_var("NOMBRE",utf8_encode($row["FincaNombre"]));
		// }

		$t->parse("FINCAS","una_opcion",true);
	}
}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$url="'modulos/predio/php/ver_predio_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
