<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver" => "ver_parcela.html",
	"un" => "un_parcela.html",
	));

//Configuración Inicial
$where="";
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla65=isset($_POST['id_tabla65']) ? intval($_POST['id_tabla65']) : NULL;
$tabla65_numero=isset($_POST['tabla65_numero']) ? strval($_POST['tabla65_numero']) : '';
$rela_tabla09=isset($_POST['rela_tabla09']) ? intval($_POST['rela_tabla09']) : NULL;
$rela_tabla64=isset($_POST['rela_tabla64']) ? intval($_POST['rela_tabla64']) : NULL;
$rela_tabla66=isset($_POST['rela_tabla66']) ? intval($_POST['rela_tabla66']) : NULL;
$tabla65_limites=isset($_POST['tabla65_limites']) ? strval($_POST['tabla65_limites']) : '';
$tabla65_tieneregadio=(isset($_POST['tabla65_tieneregadio']) && $_POST['tabla65_tieneregadio']=='1')? '1' : '0';
$tieneregadio_sn=($tabla65_tieneregadio==1) ? "Sí"  : "No";
$tabla65_areatotal=isset($_POST['tabla65_areatotal']) ? strval($_POST['tabla65_areatotal']) : '';

if ($es_buscar!="") {
	$where="1=1";
	if ($tabla65_numero!="") {
		$where.=" and tabla65_numero LIKE '%$tabla65_numero%'";
	}

	$_SESSION['where_titulos']=$where;
	if ($where!="") {
		$where= " where $where";
	}

} else {
	if (isset($_SESSION['where_titulos'])) {
		$where= " where ".$_SESSION['where_titulos'];
	}
}


// New Paginador
$totalporpag=10;
if (!$offset) {
	$off=0;$offset=1;
} else {
	$off=($offset-1);
}
$ini=$off*$totalporpag;
// End New
$sql="SELECT * FROM tabla_65_tbl_parcela
		JOIN tabla_64_tbl_predio ON tabla_64_tbl_predio.id_tabla64=tabla_65_tbl_parcela.rela_tabla64
		JOIN tabla_66_tbl_sisriego ON tabla_66_tbl_sisriego.id_tabla66=tabla_65_tbl_parcela.rela_tabla66
		$where
		ORDER BY tabla65_numero ASC
		LIMIT $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0) {
	while ($row = $rs->fetch()) {
		$id_tabla65=$row["id_tabla65"];
		$t->set_var("rela_tabla09",$row["rela_tabla09"]);
		$t->set_var("rela_tabla64",$row["rela_tabla64"]);
		$t->set_var("tabla64_nombrepredio",$row["tabla64_nombrepredio"]);
		$t->set_var("rela_tabla66",$row["rela_tabla66"]);
		$t->set_var("tabla66_descrip",$row["tabla66_descrip"]);
		$t->set_var("tabla65_numero",htmlentities($row["tabla65_numero"],ENT_QUOTES));
		$t->set_var("tabla65_limites",htmlentities($row["tabla65_limites"],ENT_QUOTES));
		$t->set_var("tabla65_tieneregadio",$row["tabla65_tieneregadio"]);
		$t->set_var("tieneregadio_sn",($row["tabla65_tieneregadio"]==1) ? "Sí": "No");
		$t->set_var("tabla65_areatotal",$row["tabla65_areatotal"]);

		$url="'modulos/parcela/php/ver_parcela_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla65=$id_tabla65'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");

		$url="'modulos/parcela/php/abm_parcela_interfaz.php'";
		$vars="'nombre_funcion=borrar_parcela&";
		$vars.="id_tabla65=$id_tabla65'";
		$url_exito="'modulos/parcela/php/ver_parcela_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'¿Está seguro de que quiere eliminar el Registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");

		$t->parse("LISTADO","un",true);
	}
} else {
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='10'>No se encuentran Registros Cargados. </td></tr>");
}

// New Paginador
$qrT="SELECT * FROM tabla_65_tbl_parcela $where " ;
$rs = $pdo->query($qrT);
$totalregistros = $rs->rowCount();
$t->set_var("cantidad",$totalregistros);
$totalpaginas=$totalregistros/$totalporpag;
$test=split("\.",$totalpaginas);
$pag='';
if (isset($test[1])) {
	$totalpaginas=$test[0]+1;
}

// << Anterior
if ($offset>1) {
	$pag.="<td><a href=\"javascript:cargar_post('modulos/parcela/php/ver_parcela.php','listado_parcela','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
} else {
	$pag.="<td></td>";
}

// Números
if ($totalpaginas>15) {
	$faltan=($totalpaginas-$off);
	if ($faltan<15) {
		$ter=$totalpaginas;
		$com=$off -(15-($totalpaginas-$off));
	} elseif ($off<8) {
		$ter=15;
		$com=1;
	} else {
		$ter=$off+7;
		$com=$off-7;
	}
} else {
	$com=1;
	$ter=$totalpaginas;
}

$pag.="<td align='center'>";
for ($i=$com;$i<=$ter;$i++) {
	if ($i==$offset) {
		$pag.="<font color=#000000><b>$i</b></font>&nbsp;";
	} else {
		$pag.="<a href=\"javascript:cargar_post('modulos/parcela/php/ver_parcela.php','listado_parcela','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
	}
}
$pag.="</td>";
				// Siguiente >>
if ($offset<$totalpaginas) {
	$ofs=$offset+1;
	$pag.="<td> | <a href=\"javascript:cargar_post('modulos/parcela/php/ver_parcela.php','listado_parcela','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
} else {
	$pag.="<td></td>";
}
$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
//End Paginador

$url="'modulos/parcela/php/ver_parcela_abm.php'";
$id="'tabs-$id_tablamodulo'";
$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
$t->set_var("icono_agregar","icon-plus.gif");
$t->pparse("OUT", "ver");

?>
