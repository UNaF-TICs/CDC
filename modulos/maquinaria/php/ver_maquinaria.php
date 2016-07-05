<?php
require "../../../php/check.php";
include "../../../lib/link_mysql.php";
include "../../../lib/template.inc";
//include "../../../php/funciones_comunes.php";
require_once "../../../php/funciones_comunes.php";
$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"		=> "ver_maquinaria.html",
	"un"		=> "un_maquinaria.html",
	));

//Configuración Inicial
$where=""; 
$es_buscar=isset($_POST['es_buscar']) ? strval($_POST['es_buscar']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : NULL;
$id_tabla22=isset($_POST['id_tabla22']) ? intval($_POST['id_tabla22']) : NULL;
//$tabla22_imagen=isset($_POST['tabla22_imagen']) ? strval($_POST['tabla22_imagen']) : '';
//$tabla22_nombre=$_POST['tabla22_nombre']) ? intval($_POST['tabla22_nombre']) : NULL;
$tabla22_nombre=isset($_POST['tabla22_nombre']) ? strval($_POST['tabla22_nombre']) : ''; 
$tabla22_descripcion=isset($_POST['tabla22_descripcion']) ? strval($_POST['tabla22_descripcion']) : NULL;
$tabla22_marca=isset($_POST['tabla22_marca']) ? strval($_POST['tabla22_marca']) : '';
$tabla22_modelo=isset($_POST['tabla22_modelo']) ? strval($_POST['tabla22_modelo']) : '';
$tabla22_fecha_compra=isset($_POST['tabla22_fecha_compra']) ? strval($_POST['tabla22_fecha_compra']) : '';
$tabla22_costo_compra=isset($_POST['tabla22_costo_compra']) ? intval($_POST['tabla22_costo_compra']) : '';
$tabla22_matricula=isset($_POST['tabla22_matricula']) ? strval($_POST['tabla22_matricula']) : '';
$tabla22_empresa_seguro=isset($_POST['tabla22_empresa_seguro']) ? strval($_POST['tabla22_empresa_seguro']) : '';
$tabla22_rto=isset($_POST['tabla22_rto']) ? strval($_POST['tabla22_rto']) : '';
$tabla22_funcion=isset($_POST['tabla22_funcion']) ? strval($_POST['tabla22_funcion']) : '';


if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla22_nombre!="")
	{
		$where.=" and tabla22_nombre LIKE '%$tabla22_nombre%'";
	}

	$_SESSION['where_nombres']=$where;
	if ($where!="")
	{
		$where= " where $where";
	}

}else{
	if(isset($_SESSION['where_nombres'])) 
	{
		$where= " where ".$_SESSION['where_nombres'];
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
$sql="select * from tabla_22_maquinaria 
		$where 
		order by tabla22_nombre ASC  
		Limit $totalporpag OFFSET $ini "; 
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla22=$row["id_tabla22"];
		//$t->set_var("tabla22_imagen",$row["tabla22_imagen"]);
		$t->set_var("tabla22_nombre",htmlentities($row["tabla22_nombre"],ENT_QUOTES));
		$t->set_var("tabla22_descripcion",$row["tabla22_descripcion"]);
		$t->set_var("tabla22_marca",htmlentities($row["tabla22_marca"],ENT_QUOTES));
		$t->set_var("tabla22_modelo",htmlentities($row["tabla22_modelo"],ENT_QUOTES));
		$t->set_var("tabla22_fecha_compra",$row["tabla22_fecha_compra"]);
		$t->set_var("tabla22_costo_compra",$row["tabla22_costo_compra"]);
		$t->set_var("tabla22_matricula",$row["tabla22_matricula"]);
        $t->set_var("tabla22_empresa_seguro",$row["tabla22_empresa_seguro"]);
        $t->set_var("tabla22_rto",$row["tabla22_rto"]);
        $t->set_var("tabla22_funcion",$row["tabla22_funcion"]);


		$url="'modulos/maquinaria/php/ver_maquinaria_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla22=$id_tabla22'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/maquinaria/php/abm_maquinaria_interfaz.php'";
		$vars="'nombre_funcion=borrar_maquinaria&";
		$vars.="id_tabla22=$id_tabla22'";
		$url_exito="'modulos/maquinaria/php/ver_maquinaria_busqueda.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars_exito="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
		$msg="'¿Esta seguro que quiere eliminar el Registro?'";
        $t->set_var("funcion_borrar","eliminar_mostrar($url,$vars,$url_exito,$id,$vars_exito,$msg);");
		
		$t->parse("LISTADO","un",true);
	}
}	
else
{
	$t->set_var("LISTADO","<tr align='center' class='alt'><td colspan='10'>No se encuentran Registros Cargados. </td></tr>");
	
}		// New Paginador
	$qrT="select * from tabla_22_maquinaria
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/maquinaria/php/ver_maquinaria.php','listado_maquinaria','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/maquinaria/php/ver_maquinaria.php','listado_maquinaria','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/maquinaria/php/ver_maquinaria.php','listado_maquinaria','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
		
	$url="'modulos/maquinaria/php/ver_maquinaria_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	
	$t->pparse("OUT", "ver");
?>