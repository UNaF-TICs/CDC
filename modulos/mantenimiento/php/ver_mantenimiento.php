<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_mantenimiento.html",
	"un"		=> "un_mantenimiento.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla23=isset($_POST['id_tabla23']) ? intval($_POST['id_tabla23']) : NULL;
$tabla23_descripcion=isset($_POST['tabla23_descripcion']) ? strval($_POST['tabla23_descripcion']) : '';
$tabla23_fecha_mantenimiento=isset($_POST['tabla23_fecha_mantenimiento']) ? strval($_POST['tabla23_fecha_mantenimiento']) : '';
$tabla23_estado=isset($_POST['tabla23_estado']) ? strval($_POST['tabla23_estado']) : '';
$tabla23_fecha_trabajo=isset($_POST['tabla23_fecha_trabajo']) ? strval($_POST['tabla23_fecha_trabajo']) : '';
$tabla23_observacion=isset($_POST['tabla23_observacion']) ? strval($_POST['tabla23_observacion']) : '';
$rela_tabla22=isset($_POST['rela_tabla22']) ? intval($_POST['rela_tabla22']) : NULL;
 

if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla23_fecha_mantenimiento!="")
	{
		$where.=" and $tabla23_fecha_mantenimiento LIKE '%$$tabla23_fecha_mantenimiento%'";
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
$sql="select * from tabla_23_tbl_mantenimiento
		$where 
		order by tabla23_fecha_trabajo ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla23=$row["id_tabla23"];
		$t->set_var("tabla23_descripcion",htmlentities($row["tabla23_descripcion"],ENT_QUOTES));
		$t->set_var("tabla23_fecha_mantenimiento",htmlentities($row["tabla23_fecha_mantenimiento"]),ENT_QUOTES);
		$t->set_var("tabla23_estado",$row["tabla23_estado"]);
		$t->set_var("tabla23_fecha_trabajo",$row["tabla23_fecha_trabajo"]);
		$t->set_var("tabla23_observacion", $row["tabla23_observacion"]);
		$t->set_var("rela_tabla22",$row["rela_tabla22"]);


		$url="'modulos/mantenimiento/php/ver_mantenimiento_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla23=$id_tabla23'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/mantenimiento/php/abm_mantenimiento_interfaz.php'";
		$vars="'nombre_funcion=borrar_mantenimiento&";
		$vars.="id_tabla23=$id_tabla23'";
		$url_exito="'modulos/mantenimiento/php/ver_mantenimiento_busqueda.php'";
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
	$qrT="select * from tabla_23_tbl_mantenimiento
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/mantenimiento/php/ver_mantenimiento.php','listado_mantenimiento','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/mantenimiento/php/ver_mantenimiento.php','listado_mantenimiento','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/mantenimiento/php/ver_mantenimiento.php','listado_mantenimiento','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/mantenimiento/php/ver_mantenimiento_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>