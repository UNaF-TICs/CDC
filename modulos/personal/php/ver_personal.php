<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_personal.html",
	"un"		=> "un_personal.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla12=isset($_POST['id_tabla12']) ? intval($_POST['id_tabla12']) : NULL;
$tabla12_nombre_empresa=isset($_POST['tabla12_nombre_empresa']) ? strval($_POST['tabla12_nombre_empresa']) : '';
$rela_tabla09=isset($_POST['rela_tabla09']) ? intval($_POST['rela_tabla09']) : NULL;
$tabla12_dni_nif=isset($_POST['tabla12_dni_nif']) ? strval($_POST['tabla12_dni_nif']) : '';
$tabla12_num_carne=isset($_POST['tabla12_num_carne']) ? strval($_POST['tabla12_num_carne']) : '';
$tabla12_email=isset($_POST['tabla12_email']) ? strval($_POST['tabla12_email']) : '';
$tabla12_telefono=isset($_POST['tabla12_telefono']) ? strval($_POST['tabla12_telefono']) : '';
$tabla12_direccion=isset($_POST['tabla12_direccion']) ? strval($_POST['tabla12_direccion']) : '';
$tabla12_comentario=isset($_POST['tabla12_comentario']) ? strval($_POST['tabla12_comentario']) : '';

 

if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla12_nombre_empresa!="")
	{
		$where.=" and tabla12_nombre_empresa LIKE '%$tabla12_nombre_empresa%'";
	}

	$_SESSION['where_nombre_empresa']=$where;
	if ($where!="")
	{
		$where= " where $where";
	}

}else{
	if(isset($_SESSION['where_nombre_empresa'])) 
	{
		$where= " where ".$_SESSION['where_nombre_empresa'];
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
$sql="select * from tabla_12_personal 
		$where 
		order by tabla12_nombre_empresa ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla12=$row["id_tabla12"];
		$t->set_var("tabla12_nombre_empresa",htmlentities($row["tabla12_nombre_empresa"],ENT_QUOTES));
		$t->set_var("rela_tabla09",$row["rela_tabla09"]);
		$t->set_var("tabla12_dni_nif",htmlentities($row["tabla12_dni_nif"],ENT_QUOTES));
		$t->set_var("tabla12_num_carne",htmlentities($row["tabla12_num_carne"],ENT_QUOTES));
		$t->set_var("tabla12_email",$row["tabla12_email"]);
		$t->set_var("tabla12_telefono",$row["tabla12_telefono"]);
		$t->set_var("tabla12_direccion",$row["tabla12_direccion"]);
		$t->set_var("tabla12_comentario",$row["tabla12_comentario"]);

		$url="'modulos/personal/php/ver_personal_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla12=$id_tabla12'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/personal/php/abm_personal_interfaz.php'";
		$vars="'nombre_funcion=borrar_personal&";
		$vars.="id_tabla12=$id_tabla12'";
		$url_exito="'modulos/personal/php/ver_personal_busqueda.php'";
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
	$qrT="select * from tabla_12_personal
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/personal/php/ver_personal.php','listado_personal','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/personal/php/ver_personal.php','listado_personal','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/personal/php/ver_personal.php','listado_personal','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/personal/php/ver_personal_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>