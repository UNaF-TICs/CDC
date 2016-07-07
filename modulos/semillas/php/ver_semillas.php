<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_semillas.html",
	"un"		=> "un_semillas.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla25=isset($_POST['id_tabla25']) ? intval($_POST['id_tabla25']) : NULL;
$tabla25_nombre=isset($_POST['tabla25_nombre']) ? strval($_POST['tabla25_nombre']) : '';
$rela_tabla26=isset($_POST['rela_tabla26']) ? intval($_POST['rela_tabla26']) : NULL;
$rela_tabla27=isset($_POST['rela_tabla27']) ? intval($_POST['rela_tabla27']) : NULL;
$rela_tabla15=isset($_POST['rela_tabla15']) ? strval($_POST['rela_tabla15']) : '';
$tabla25_dosis=isset($_POST['tabla25_dosis']) ? strval($_POST['tabla25_dosis']) : '';
$rela_tabla28=isset($_POST['rela_tabla28']) ? strval($_POST['rela_tabla28']) : '';
$rela_tabla74=isset($_POST['rela_tabla74']) ? strval($_POST['rela_tabla74']) : '';
$rela_tabla76=isset($_POST['rela_tabla76']) ? strval($_POST['rela_tabla76']) : '';
 

if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla25_nombre!="")
	{
		$where.=" and tabla25_nombre LIKE '%$tabla25_nombre%'";
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
$sql="select * from tabla_25_cab_semilla 
		$where 
		order by tabla25_nombre ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla25=$row["id_tabla25"];
		$t->set_var("rela_tabla26",$row["rela_tabla26"]);
		$t->set_var("rela_tabla27",$row["rela_tabla27"]);
		$t->set_var("tabla25_nombre",htmlentities($row["tabla25_nombre"],ENT_QUOTES));
		$t->set_var("rela_tabla15",htmlentities($row["rela_tabla15"],ENT_QUOTES));
		$t->set_var("tabla25_dosis",htmlentities($row["tabla25_dosis"],ENT_QUOTES));
		$t->set_var("rela_tabla28",$row["rela_tabla28"]);
		$t->set_var("rela_tabla74",$row["rela_tabla74"]);
		$t->set_var("rela_tabla76",$row["rela_tabla76"]);


		$url="'modulos/semillas/php/ver_semillas_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla25=$id_tabla25'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/semillas/php/abm_semillas_interfaz.php'";
		$vars="'nombre_funcion=borrar_semillas&";
		$vars.="id_tabla25=$id_tabla25'";
		$url_exito="'modulos/semillas/php/ver_semillas_busqueda.php'";
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
	$qrT="select * from tabla_25_cab_semilla
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/semillas/php/ver_semillas.php','listado_semillas','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/semillas/php/ver_semillas.php','listado_semillas','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/semillas/php/ver_semillas.php','listado_semillas','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/semillas/php/ver_semillas_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>