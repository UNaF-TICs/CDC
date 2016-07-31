<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_finca_abm.html",
	"una_opcion"	=> "una_opcion.html",

	));
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$id_tabla63=isset($_POST['id_tabla63']) ? intval($_POST['id_tabla63']) : NULL;
$offset=$_POST["offset"];
$rela_tabla67='';
$rela_tabla70_finca='';
$rela_tabla70_titular='';

if ($id_tabla63!="") {
	$sql="select * from tabla_63_tbl_finca
	where id_tabla63=$id_tabla63";
	$rs = $pdo->query($sql);//
	$num_rows = $rs->rowCount();
	if ($num_rows>0) {
		$row = $rs->fetch();
		$id_tabla63=$row["id_tabla63"];
		$rela_tabla67=$row["rela_tabla67"];
		$rela_tabla70_finca=$row["rela_tabla70_finca"];
		$rela_tabla70_titular=$row["rela_tabla70_titular"];
		$t->set_var("rela_tabla67",$row["rela_tabla67"]);
		$t->set_var("tabla63_entidadcertificadora",htmlentities($row["tabla63_entidadcertificadora"],ENT_QUOTES));
		$t->set_var("tabla63_tiporepresentante",htmlentities($row["tabla63_tiporepresentante"],ENT_QUOTES));
		$t->set_var("tabla63_areatotal",$row["tabla63_areatotal"]);
	}

	$url="'modulos/finca/php/abm_finca_interfaz.php'";
	$vars="'nombre_funcion=modificar_finca&";
	$vars.="id_tabla63=$id_tabla63&";
	$vars.="rela_tabla70_finca='+abm_finca.rela_tabla70_finca.value+'&";
	$vars.="rela_tabla70_titular='+abm_finca.rela_tabla70_titular.value+'&";
	$vars.="rela_tabla67='+abm_finca.rela_tabla67.value+'&";
	$vars.="tabla63_entidadcertificadora='+abm_finca.tabla63_entidadcertificadora.value+'&";
	$vars.="tabla63_areatotal='+abm_finca.tabla63_areatotal.value+'&";
	$vars.="tabla63_tiporepresentante='+abm_finca.tabla63_tiporepresentante.value";

	$url_exito="'modulos/finca/php/ver_finca_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Modificar Finca");
} else {
	$t->set_var("tabla63_entidadcertificadora","");
	$t->set_var("tabla63_tiporepresentante","");
	$t->set_var("rela_tabla67","");
	$t->set_var("rela_tabla70_finca","");
	$t->set_var("rela_tabla70_titular","");
	$t->set_var("tabla63_areatotal","");

	$url="'modulos/finca/php/abm_finca_interfaz.php'";
	$vars="'nombre_funcion=agregar_finca&";
	// Ver si no hay que quitar los siguientes 2 renglones
	$vars.="rela_tabla70_finca='+abm_finca.rela_tabla70_finca.value+'&";
	$vars.="rela_tabla70_titular='+abm_finca.rela_tabla70_titular.value+'&";
	$vars.="rela_tabla67='+abm_finca.rela_tabla67.value+'&";
	$vars.="tabla63_entidadcertificadora='+abm_finca.tabla63_entidadcertificadora.value+'&";
	$vars.="tabla63_areatotal='+abm_finca.tabla63_areatotal.value+'&";
	$vars.="tabla63_tiporepresentante='+abm_finca.tabla63_tiporepresentante.value";

	$url_exito="'modulos/finca/php/ver_finca_busqueda.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("tit","Agregar Finca");
}

//Finca
$sql="Select * from  PersonaOpcion";
$rs = $pdo->query($sql);
$num_rows = $rs->rowCount();
if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla70=$row["id_tabla70"];
		if ($id_tabla70==$rela_tabla70_finca) {
			$t->set_var("ID","\"$id_tabla70\" SELECTED ");
			$t->set_var("DESCRIP",$row["nombre"]);
		} else {
			$t->set_var("ID",$row["id_tabla70"]);
			$t->set_var("DESCRIP",$row["nombre"]);
		}
		$t->parse("FINCANOMBRES","una_opcion",true);
	}
}

// Titular
$sql="Select * from  PersonaOpcion";
$rs = $pdo->query($sql);
$num_rows = $rs->rowCount();
if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla70=$row["id_tabla70"];
		if ($id_tabla70==$rela_tabla70_titular) {
			$t->set_var("ID","\"$id_tabla70\" SELECTED ");
			$t->set_var("DESCRIP",$row["nombre"]);
		} else {
			$t->set_var("ID",$row["id_tabla70"]);
			$t->set_var("DESCRIP",$row["nombre"]);
		}
		$t->parse("TITULARNOMBRES","una_opcion",true);
	}
}

//Tipos de certificación
$sql="Select * from  tabla_67_tbl_tipocertifica  order by tabla67_descrip ASC";
$rs = $pdo->query($sql);
$num_rows = $rs->rowCount();
if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla67=$row["id_tabla67"];
		if ($id_tabla67==$rela_tabla67) {
			$t->set_var("ID","\"$id_tabla67\" SELECTED ");
			$t->set_var("DESCRIP",$row["tabla67_descrip"]);
		} else {
			$t->set_var("ID",$row["id_tabla67"]);
			$t->set_var("DESCRIP",$row["tabla67_descrip"]);
		}
		$t->parse("TIPOSCERTIFICA","una_opcion",true);
	}
}

$t->set_var("funcion_guardar","guardar_mostrar($url,$vars,$url_exito,$id,$vars_exito)");

$url="'modulos/finca/php/ver_finca_busqueda.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";

$t->set_var("funcion_cancelar","cargar_post($url,$id,$vars)");
$t->set_var("funcion_cerrar","cargar_post($url,$id,$vars)");

//echo $estructura_hc;
$t->pparse("OUT", "ver");

?>
