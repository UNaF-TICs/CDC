<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_libros.html",
	"un"		=> "un_libros.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla10=isset($_POST['id_tabla10']) ? intval($_POST['id_tabla10']) : NULL;
$tabla10_titulo=isset($_POST['tabla10_titulo']) ? strval($_POST['tabla10_titulo']) : '';
$rela_tabla09=isset($_POST['rela_tabla09']) ? intval($_POST['rela_tabla09']) : NULL;
$rela_tabla11=isset($_POST['rela_tabla11']) ? intval($_POST['rela_tabla11']) : NULL;
$tabla10_subtitulo=isset($_POST['tabla10_subtitulo']) ? strval($_POST['tabla10_subtitulo']) : '';
$tabla10_descripcion=isset($_POST['tabla10_descripcion']) ? strval($_POST['tabla10_descripcion']) : '';
$tabla10_fecha_entrada=isset($_POST['tabla10_fecha_entrada']) ? strval($_POST['tabla10_fecha_entrada']) : '';
$tabla10_tomo=isset($_POST['tabla10_tomo']) ? strval($_POST['tabla10_tomo']) : '';
$tabla10_cantidad=isset($_POST['tabla10_cantidad']) ? strval($_POST['tabla10_cantidad']) : '';
 

if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla10_titulo!="")
	{
		$where.=" and tabla10_titulo LIKE '%$tabla10_titulo%'";
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
$sql="select * from tabla_10_libros 
		$where 
		order by tabla10_titulo ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla10=$row["id_tabla10"];
		$t->set_var("rela_tabla09",$row["rela_tabla09"]);
		$t->set_var("rela_tabla11",$row["rela_tabla11"]);
		$t->set_var("tabla10_titulo",htmlentities($row["tabla10_titulo"],ENT_QUOTES));
		$t->set_var("tabla10_subtitulo",htmlentities($row["tabla10_subtitulo"],ENT_QUOTES));
		$t->set_var("tabla10_descripcion",htmlentities($row["tabla10_descripcion"],ENT_QUOTES));
		$t->set_var("tabla10_fecha_entrada",$row["tabla10_fecha_entrada"]);
		$t->set_var("tabla10_tomo",$row["tabla10_tomo"]);
		$t->set_var("tabla10_cantidad",$row["tabla10_cantidad"]);


		$url="'modulos/libros/php/ver_libros_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla10=$id_tabla10'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/libros/php/abm_libros_interfaz.php'";
		$vars="'nombre_funcion=borrar_libros&";
		$vars.="id_tabla10=$id_tabla10'";
		$url_exito="'modulos/libros/php/ver_libros_busqueda.php'";
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
	$qrT="select * from tabla_10_libros
	$where " ;
	$rs = $pdo->query($qrT);//
	$totalregistros = $rs->rowCount();
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=explode("\.",$totalpaginas);
	$pag=''; 
	if(isset($test[1]))
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/libros/php/ver_libros.php','listado_libros','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/libros/php/ver_libros.php','listado_libros','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/libros/php/ver_libros.php','listado_libros','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/libros/php/ver_libros_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>