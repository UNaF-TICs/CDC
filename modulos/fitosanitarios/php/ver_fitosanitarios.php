<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_fitosanitarios.html",
	"un"		=> "un_fitosanitarios.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla18=isset($_POST['id_tabla18']) ? intval($_POST['id_tabla18']) : NULL;
$Fitosanitario_Nombre=isset($_POST['Fitosanitario_Nombre']) ? strval($_POST['Fitosanitario_Nombre']) : '';
$Rela_tabla21=isset($_POST['Rela_tabla21']) ? intval($_POST['Rela_tabla21']) : NULL;
$Rela_tabla33=isset($_POST['Rela_tabla33']) ? intval($_POST['Rela_tabla33']) : NULL;
$Fitosanitario_Fabricante=isset($_POST['Fitosanitario_Fabricante']) ? strval($_POST['Fitosanitario_Fabricante']) : '';
$Cantidad_Agua=isset($_POST['Cantidad_Agua']) ? strval($_POST['Cantidad_Agua']) : '';
$Fitosanitario_Fecha_caducidad=isset($_POST['Fitosanitario_Fecha_caducidad']) ? strval($_POST['Fitosanitario_Fecha_caducidad']) : '';
$Rela_tabla19=isset($_POST['Rela_tabla19']) ? strval($_POST['Rela_tabla19']) : '';
$Rela_tabla20=isset($_POST['Rela_tabla20']) ? strval($_POST['Rela_tabla20']) : '';
 

if ($es_buscar!="")
{
	$where="1=1";
	if ($Fitosanitario_Nombre!="")
	{
		$where.=" and Fitosanitario_Nombre LIKE '%$Fitosanitario_Nombre%'";
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
$sql="select * from tabla_18_cab_fitosanitario 
		$where 
		order by Fitosanitario_Nombre ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla18=$row["id_tabla18"];
		$t->set_var("Rela_tabla21",$row["Rela_tabla21"]);
		$t->set_var("Rela_tabla33",$row["Rela_tabla33"]);
		$t->set_var("Fitosanitario_Nombre",htmlentities($row["Fitosanitario_Nombre"],ENT_QUOTES));
		$t->set_var("Fitosanitario_Fabricante",htmlentities($row["Fitosanitario_Fabricante"],ENT_QUOTES));
		$t->set_var("Cantidad_Agua",htmlentities($row["Cantidad_Agua"],ENT_QUOTES));
		$t->set_var("Fitosanitario_Fecha_caducidad",$row["Fitosanitario_Fecha_caducidad"]);
		$t->set_var("Rela_tabla19",$row["Rela_tabla19"]);
		$t->set_var("Rela_tabla20",$row["Rela_tabla20"]);


		$url="'modulos/fitosanitarios/php/ver_fitosanitarios_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla18=$id_tabla18'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/fitosanitarios/php/abm_fitosanitarios_interfaz.php'";
		$vars="'nombre_funcion=borrar_fitosanitarios&";
		$vars.="id_tabla18=$id_tabla18'";
		$url_exito="'modulos/fitosanitarios/php/ver_fitosanitarios_busqueda.php'";
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
	$qrT="select * from tabla_18_cab_fitosanitario
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/fitosanitarios/php/ver_fitosanitarios.php','listado_fitosanitarios','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/fitosanitarios/php/ver_fitosanitarios.php','listado_fitosanitarios','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/fitosanitarios/php/ver_fitosanitarios.php','listado_fitosanitarios','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/fitosanitarios/php/ver_fitosanitarios_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>