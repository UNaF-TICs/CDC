
<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_eventoclimatologico.html",
	"un"		=> "un_eventoclimatologico.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla99=isset($_POST['id_tabla99']) ? intval($_POST['id_tabla99']) : NULL;
$tabla99_observacion=isset($_POST['tabla99_observacion']) ? strval($_POST['tabla99_observacion']) : '';
$tabla99_fecha_inicio=isset($_POST['tabla99_fecha_inicio']) ? strval($_POST['tabla99_fecha_inicio']) : '';
$tabla99_fecha_fin=isset($_POST['tabla99_fecha_fin']) ? strval($_POST['tabla99_fecha_fin']) : '';
$rela_tabla16=isset($_POST['rela_tabla16']) ? intval($_POST['rela_tabla16']) : NULL;
$rela_tabla01=isset($_POST['rela_tabla01']) ? intval($_POST['rela_tabla01']) : NULL;
$rela_tabla74=isset($_POST['rela_tabla74']) ? intval($_POST['rela_tabla74']) : NULL;
$tabla99_cantidad=isset($_POST['tabla99_cantidad']) ? strval($_POST['tabla99_cantidad']) : '';
$rela_tabla98=isset($_POST['rela_tabla98']) ? intval($_POST['rela_tabla98']) : NULL;
 

if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla99_observacion!="")
	{
		$where.=" and tabla99_observacion LIKE '%$tabla99_observacion%'";
	}

	$_SESSION['where_observacion']=$where;
	if ($where!="")
	{
		$where= " where $where";
	}

}else{
	if(isset($_SESSION['where_observacion'])) 
	{
		$where= " where ".$_SESSION['where_observacion'];
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
$sql="select * from tabla_99_cab_eventoclimatologico
		$where 
		order by tabla99_observacion ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla99=$row["id_tabla99"];
		$t->set_var("tabla99_observacion",htmlentities($row["tabla99_observacion"],ENT_QUOTES));
		$t->set_var("tabla99_fecha_inicio",htmlentities($row["tabla99_fecha_inicio"],ENT_QUOTES));
		$t->set_var("tabla99_fecha_fin",htmlentities($row["tabla99_fecha_fin"],ENT_QUOTES));
		$t->set_var("rela_tabla16",$row["rela_tabla16"]);
		$t->set_var("rela_tabla01",$row["rela_tabla01"]);
		$t->set_var("rela_tabla74",$row["rela_tabla74"]);
		$t->set_var("rela_tabla71",$row["rela_tabla71"]);
		$t->set_var("tabla99_cantidad",htmlentities($row["tabla99_cantidad"],ENT_QUOTES));
		$t->set_var("rela_tabla98",$row["rela_tabla98"]);


		$url="'modulos/evento_climatologico/php/ver_eventoclimatologico_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla99=$id_tabla99'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/evento_climatologico/php/abm_eventoclima_interfaz.php'";
		$vars="'nombre_funcion=borrar_eventoclimatico&";
		$vars.="id_tabla99=$id_tabla99'";
		$url_exito="'modulos/evento_climatologico/php/ver_eventoclimatologico_busqueda.php'";
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
	$qrT="select * from tabla_99_cab_eventoclimatologico
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/evento_climatologico/php/ver_eventoclimatologico.php','listado_eventoclimatologico','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/evento_climatologico/php/ver_eventoclimatologico.php','listado_eventoclimatologico','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/evento_climatologico/php/ver_eventoclimatologico.php','listado_eventoclimatologico','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/evento_climatologico/php/ver_eventoclimatologico_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>