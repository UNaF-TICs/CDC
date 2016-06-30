<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_variedad.html",
	"un"		=> "un_variedad.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla15=isset($_POST['id_tabla15']) ? intval($_POST['id_tabla15']) : NULL;
$tabla15_descripcion=isset($_POST['tabla15_descripcion']) ? strval($_POST['tabla15_descripcion']) : '';
$tabla15_nombre=isset($_POST['tabla15_nombre']) ? strval($_POST['tabla15_nombre']) : '';
$tabla15_temperatura_maxima=isset($_POST['tabla15_temperatura_maxima']) ? strval($_POST['tabla15_temperatura_maxima']) : '';
$tabla15_temperatura_minima=isset($_POST['tabla15_temperatura_minima']) ? strval($_POST['tabla15_temperatura_minima']) : '';
$tabla15_temperatura_optima=isset($_POST['tabla15_temperatura_optima']) ? strval($_POST['tabla15_temperatura_optima']) : '';


if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla15_nombre!="")
	{
		$where.=" and tabla15_nombre LIKE '%$tabla15_nombre%'";
	}

	$_SESSION['where_nombre']=$where;
	if ($where!="")
	{
		$where= " where $where";
	}

}else{
	if(isset($_SESSION['where_nombre'])) 
	{
		$where= " where ".$_SESSION['where_nombre'];
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
$sql="select * from tabla_15_tbl_variedad 
		$where 
		order by tabla15_nombre ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla15=$row["id_tabla15"];
		$t->set_var("tabla15_nombre",htmlentities($row["tabla15_nombre"],ENT_QUOTES));
		$t->set_var("tabla15_descripcion",htmlentities($row["tabla15_descripcion"],ENT_QUOTES));
		$t->set_var("tabla15_temperatura_maxima",htmlentities($row["tabla15_temperatura_maxima"],ENT_QUOTES));
		$t->set_var("tabla15_temperatura_minima",$row["tabla15_temperatura_minima"]);
		$t->set_var("tabla15_temperatura_optima",$row["tabla15_temperatura_optima"]);

		$url="'modulos/variedad/php/ver_variedad_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla15=$id_tabla15'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/variedad/php/abm_variedad_interfaz.php'";
		$vars="'nombre_funcion=borrar_variedad&";
		$vars.="id_tabla15=$id_tabla15'";
		$url_exito="'modulos/variedad/php/ver_variedad_busqueda.php'";
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
	$qrT="select * from tabla_15_tbl_variedad
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/variedad/php/ver_variedad.php','listado_variedad','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/variedad/php/ver_variedad.php','listado_variedad','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/variedad/php/ver_variedad.php','listado_variedad','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/libros/php/ver_variedad_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>