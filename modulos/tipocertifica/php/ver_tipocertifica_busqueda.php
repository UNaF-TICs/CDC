<?php
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";
session_start();

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_tipocertifica_busqueda.html",
	"un"				=> "un_tipocertifica.html",
	"una_opcion"		=> "una_opcion.html",
));

$offset=isset($_POST['offset']) ? intval($_POST['offset']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$titulo="Listado de tipos de certificación";
$t->set_var("titulo",$titulo);

//
//Otras Funciones
//$t->set_var("funcion_excel","modulos/tipocertifica/php/exportar_excel.php?tipo=xls");
//$t->set_var("funcion_doc","modulos/tipocertifica/php/exportar_excel.php?tipo=doc");
//$t->set_var("funcion_pdf","modulos/tipocertifica/php/exportar_excel.php");
//

$url="'modulos/tipocertifica/php/ver_tipocertifica.php'";
$id="'listado_tipocertifica'";
$vars="'es_buscar=si&id_tablamodulo=$id_tablamodulo&";
$vars.="tabla67_descrip='+ver_busqueda_tipocertifica.tabla67_descrip.value";
$t->set_var("funcion_busqueda","cargar_post($url,$id,$vars)");

if (isset($_POST['offset'])) {
	$offset=$_POST["offset"];
} else {
	$offset = "";
}

// New Paginador
$totalporpag=10;
if(!$offset){
	$off=0;$offset=1;
}
else{
    $off=($offset-1);
}
$ini=$off*$totalporpag;
// End New
$sql="select * from tabla_67_tipocertifica
		order by tabla67_descrip ASC
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla67=$row["id_tabla67"];
		$t->set_var("tabla67_descrip",htmlentities($row["tabla67_descrip"],ENT_QUOTES));

		$url="'modulos/tipocertifica/php/ver_tipocertifica_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla67=$id_tabla67'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");

		$url="'modulos/tipocertifica/php/abm_tipocertifica_interfaz.php'";
		$vars="'nombre_funcion=borrar_tipocertifica&";
		$vars.="id_tabla67=$id_tabla67'";
		$url_exito="'modulos/tipocertifica/php/ver_tipocertifica_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'¿Está seguro de que quiere eliminar este registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");

		$t->parse("LISTADO","un",true);
	}
}
else
{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='10'>No se encuentran Registros Cargados. </td></tr>");

}
	$qrT="select * from tabla_67_tipocertifica";
	$rs = $pdo->query($qrT);//
	$totalregistros = $rs->rowCount();
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=split("\.",$totalpaginas);
	$pag='';
	if(isset($test[1]))
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/tipocertifica/php/ver_tipocertifica.php','listado_tipocertifica','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
	}
	else
	{
		$pag.="<td></td>";
	}

	// Numeros
	if($totalpaginas>15)
	{
		$faltan=($totalpaginas-$off);
		if($faltan<15)
		{
			$ter=$totalpaginas;
			$com=$off -(15-($totalpaginas-$off));
		}
		elseif($off<8)
		{
			$ter=15;
			$com=1;
		}
		else
		{
			$ter=$off+7;
			$com=$off-7;
		}
	}
	else
	{
		$com=1;
		$ter=$totalpaginas;
	}

	$pag.="<td align='center'>";
	for($i=$com;$i<=$ter;$i++)
	{
		if($i==$offset)
		{
			$pag.="<font color=#000000><b>$i</b></font>&nbsp;";
		}
		else
		{
			$pag.="<a href=\"javascript:cargar_post('modulos/tipocertifica/php/ver_tipocertifica.php','listado_tipocertifica','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/tipocertifica/php/ver_tipocertifica.php','listado_tipocertifica','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador

	$url="'modulos/tipocertifica/php/ver_tipocertifica_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");

$t->pparse("OUT", "ver");
?>
