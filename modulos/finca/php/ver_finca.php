<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_finca.html",
	"un"		=> "un_finca.html",
	));

//Configuración Inicial
$where="";
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla63=isset($_POST['id_tabla63']) ? intval($_POST['id_tabla63']) : NULL;
$fincanombre=isset($_POST['fincanombre']) ? strval($_POST['fincanombre']) : '';
$titularnombre=isset($_POST['titularnombre']) ? strval($_POST['titularnombre']) : '';
$rela_tabla67=isset($_POST['rela_tabla67']) ? intval($_POST['rela_tabla67']) : NULL;
$tabla67_descrip=isset($_POST['tabla67_descrip']) ? strval($_POST['tabla67_descrip']) : '';
$tabla63_entidadcertificadora=isset($_POST['tabla63_entidadcertificadora']) ? strval($_POST['tabla63_entidadcertificadora']) : '';
$tabla63_tiporepresentante=isset($_POST['tabla63_tiporepresentante']) ? strval($_POST['tabla63_tiporepresentante']) : '';
$tabla63_areatotal=isset($_POST['tabla63_areatotal']) ? strval($_POST['tabla63_areatotal']) : '';

if ($es_buscar!="")
{
	$where="1=1";
	if ($fincanombre!="")
	{
		$where.=" and $fincanombre LIKE '%$fincanombre%'";
	}

	$_SESSION['where_titulos']=$where;
	if ($where!="")
	{
		$where= " where $where";
	}

}else{
	if(isset($_SESSION['where_titulos']))
	{
		$where= " where ".$_SESSION['where_titulos'];
	}
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
$sql="select * from FincaCompleta $where";
$sql .= "order by fincanombre ASC "
$sql .= "Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla63=$row["id_tabla63"];
		$t->set_var("rela_tabla67",$row["rela_tabla67"]);
		$t->set_var("tabla63_entidadcertificadora",htmlentities($row["tabla63_entidadcertificadora"],ENT_QUOTES));
		$t->set_var("fincanombre",htmlentities($row["fincanombre"],ENT_QUOTES));
		$t->set_var("titularnombre",htmlentities($row["titularnombre"],ENT_QUOTES));
		$t->set_var("tabla63_tiporepresentante",htmlentities($row["tabla63_tiporepresentante"],ENT_QUOTES));
		$t->set_var("tabla63_areatotal",$row["tabla63_areatotal"]);


		$url="'modulos/finca/php/ver_finca_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla63=$id_tabla63'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");

		$url="'modulos/finca/php/abm_finca_interfaz.php'";
		$vars="'nombre_funcion=borrar_finca&";
		$vars.="id_tabla63=$id_tabla63'";
		$url_exito="'modulos/finca/php/ver_finca_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el Registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");

		$t->parse("LISTADO","un",true);
	}
}
else
{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='10'>No se encuentran Registros Cargados. </td></tr>");

}		// New Paginador
	$qrT="select * from FincaCompleta
	$where " ;
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/finca/php/ver_finca.php','listado_finca','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/finca/php/ver_finca.php','listado_finca','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/finca/php/ver_finca.php','listado_finca','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador

	$url="'modulos/finca/php/ver_finca_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");
	$t->pparse("OUT", "ver");
?>
