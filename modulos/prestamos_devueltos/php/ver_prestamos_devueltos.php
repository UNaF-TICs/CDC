<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_prestamos_devueltos.html",
	"un"		=> "un_prestamos_devueltos.html",
	));
//Configuración Inicial
$id_tablamodulo=$_POST["id_tablamodulo"];
//
$tabla10_titulo=$_POST["tabla10_titulo"];

$es_buscar=$_POST["es_buscar"];
$offset=$_POST["offset"];

$id_tabla12=$_POST["id_tabla12"];
$rela_tabla10=$_POST["rela_tabla10"];
$rela_tabla07=$_POST["rela_tabla07"];
$fecha_hasta=$_POST["fecha_hasta"];
$fecha_desde=$_POST["fecha_desde"];
$fecha_desde_devolver=$_POST["fecha_desde_devolver"];
$fecha_hasta_devolver=$_POST["fecha_hasta_devolver"];


if ($es_buscar!="")
{
	$where="1=1";
	if ($rela_tabla10!="")
	{
		$where.=" AND rela_tabla10=$rela_tabla10";
	}
	if ($rela_tabla07!="")
	{
		$where.=" AND rela_tabla07=$rela_tabla07";
	}
	
	if ($fecha_desde!="")
	{
		if ($where=="")
		{
			$where.=" tabla12_fecha_prestamo >= '$fecha_desde' ";
		}
		else
		{
			$where.=" AND tabla12_fecha_prestamo >= '$fecha_desde'";
		}
	}

	if ($fecha_hasta!="")
	{
		if ($where=="")
		{
			$where.=" tabla12_fecha_prestamo <= '$fecha_hasta' ";
		}
		else
		{
			$where.=" AND tabla12_fecha_prestamo <= '$fecha_hasta' ";
		}
	}
	
	if ($fecha_desde_devolver!="")
	{
		if ($where=="")
		{
			$where.=" tabla12_fecha_prestamo >= '$fecha_desde_devolver' ";
		}
		else
		{
			$where.=" AND tabla12_fecha_a_devolver >= '$fecha_desde_devolver'";
		}
	}

	if ($fecha_hasta_devolver!="")
	{
		if ($where=="")
		{
			$where.=" tabla12_fecha_prestamo <= '$fecha_hasta_devolver' ";
		}
		else
		{
			$where.=" AND tabla12_fecha_a_devolver <= '$fecha_hasta_devolver' ";
		}
	}

	$_SESSION['where_titulos']=$where;
	if ($where!="")
	{
		$where= " where $where";
	}



}else{
	if($_SESSION['where_titulos']!="")
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
$sql="select * from tabla_12_prestamos 
inner join tabla_10_libros on id_tabla10 = rela_tabla10
inner join tabla_07_personas on id_tabla07 = rela_tabla07
		$where and tabla12_fecha_devolucion is not null
		order by id_tabla12 ASC  
		Limit $totalporpag OFFSET $ini ";
//echo $sql;
$result = mysql_query($sql,$link_mysql);
$num_rows = mysql_num_rows($result);
if ($num_rows>0)
{ 
    while ($row = mysql_fetch_assoc($result))
	{
		$id_tabla12=$row["id_tabla12"];
		$t->set_var("rela_tabla10",$row["rela_tabla10"]);
		$t->set_var("rela_tabla07",$row["rela_tabla07"]);
		$t->set_var("tabla12_fecha_prestamo",$row["tabla12_fecha_prestamo"]);
		$t->set_var("tabla12_fecha_a_devolver",$row["tabla12_fecha_a_devolver"]);
		$t->set_var("tabla12_fecha_devolucion",$row["tabla12_fecha_devolucion"]);
		
		$t->set_var("tabla10_titulo",$row["tabla10_titulo"]);
		$t->set_var("socio",$row["tabla07_apellido"]."  ,".$row["tabla07_nombre"]);

		$url="'modulos/prestamos/php/ver_prestamos_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla12=$id_tabla12'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/prestamos/php/abm_prestamos_interfaz.php'";
		$vars="'nombre_funcion=borrar_prestamos&";
		$vars.="id_tabla12=$id_tabla12'";
		$url_exito="'modulos/prestamos/php/ver_prestamos_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'Esta seguro que quiere eliminar el Registro?'";
		$t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");
		
		$t->parse("LISTADO","un",true);
	}
}	
else
{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='6'>No se encuentran Registros Cargados. </td></tr>");
	
}		// New Paginador
	$qrT="select * from tabla_12_prestamos
	inner join tabla_10_libros on id_tabla10 = rela_tabla10
    inner join tabla_07_personas on id_tabla07 = rela_tabla07
	$where and tabla12_fecha_devolucion is not null" ;
	$result = mysql_query($qrT,$link_mysql);
	$totalregistros = mysql_num_rows($result);
	$t->set_var("cantidad",$totalregistros);
	$totalpaginas=$totalregistros/$totalporpag;
	$test=explode("\.",$totalpaginas);
	if($test[1])
	{
		$totalpaginas=$test[0]+1;
	}
	// << Anterior
	if($offset>1)
	{
		$pag.="<td><a href=\"javascript:cargar_post('modulos/prestamos_devueltos/php/ver_prestamos_devueltos.php','listado_prestamos_devueltos','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/prestamos_devueltos/php/ver_prestamos_devueltos.php','listado_prestamos_devueltos','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/prestamos_devueltos/php/ver_prestamos_devueltos.php','listado_prestamos_devueltos','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/prestamos/php/ver_prestamos_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>