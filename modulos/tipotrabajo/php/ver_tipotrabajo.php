<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_tipotrabajo.html",
	"un"		=> "un_tipotrabajo.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_Tabla14=isset($_POST['id_Tabla14']) ? intval($_POST['id_Tabla14']) : NULL;
$tabla14_Descripcion=isset($_POST['tabla14_Descripcion']) ? strval($_POST['tabla14_Descripcion']) : '';


 

if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla14_Descripcion!="")
	{
		$where.=" and tabla14_Descripcion LIKE '%$tabla14_Descripcion%'";
	}

	$_SESSION['where_Descripcion']=$where;
	if ($where!="")
	{
		$where= " where $where";
	}

}else{
	if(isset($_SESSION['where_Descripcion'])) 
	{
		$where= " where ".$_SESSION['where_Descripcion'];
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
$sql="SELECT * from tabla_14_tipo_trabajo 
		$where 
		order by tabla14_Descripcion ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_Tabla14=$row["id_Tabla14"];
		$t->set_var("tabla14_Descripcion",htmlentities($row["tabla14_Descripcion"],ENT_QUOTES));
		
		$url="'modulos/tipotrabajo/php/ver_tipotrabajo_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla14=$id_Tabla14'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/tipotrabajo/php/abm_tipotrabajo_interfaz.php'";
		$vars="'nombre_funcion=borrar_tipotrabajo&";
		$vars.="id_Tabla14=$id_Tabla14'";
		$url_exito="'modulos/tipotrabajo/php/ver_tipotrabajo_busqueda.php'";
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
	$qrT="SELECT * from tabla_14_tipo_trabajo
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/tipotrabajo/php/ver_tipotrabajo.php','Listado_tipoTrabajo','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/tipotrabajo/php/ver_tipotrabajo.php','Listado_tipoTrabajo','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/tipotrabajo/php/ver_tipotrabajo.php','Listado_tipoTrabajo','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/tipotrabajo/php/ver_tipotrabajo_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>