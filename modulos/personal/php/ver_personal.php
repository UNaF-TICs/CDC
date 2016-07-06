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
$id_tabla70=isset($_POST['id_tabla70']) ? intval($_POST['id_tabla70']) : NULL;
$tabla70_nombre_apellido=isset($_POST['tabla70_nombre_apellido']) ? strval($_POST['tabla70_nombre_apellido']) : '';
$tabla70_razon_social=isset($_POST['tabla70_razon_social']) ? strval($_POST['tabla70_razon_social']) : NULL;
$tabla70_cuit=isset($_POST['tabla70_cuit']) ? strval($_POST['tabla70_cuit']) : '';
$tabla70_dni=isset($_POST['tabla70_dni']) ? strval($_POST['tabla70_dni']) : '';
$tabla70_foto=isset($_POST['tabla70_foto']) ? strval($_POST['tabla70_foto']) : '';
$tabla70_email=isset($_POST['tabla70_email']) ? strval($_POST['tabla70_email']) : '';
$tabla70_telefono=isset($_POST['tabla70_telefono']) ? strval($_POST['tabla70_telefono']) : '';
$tabla70_direccion=isset($_POST['tabla70_direccion']) ? strval($_POST['tabla70_direccion']) : '';

 

if ($es_buscar!="")
{
	$where="1=1";
	if ($tabla70_nombre_apellido!="")
	{
		$where.=" and tabla70_nombre_apellido LIKE '%$tabla70_nombre_apellido%'";
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
$sql="select * from tabla_70_tbl_persona 
		$where 
		order by tabla70_nombre_apellido ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla70=$row["id_tabla70"];
		$t->set_var("tabla70_nombre_apellido",htmlentities($row["tabla70_nombre_apellido"],ENT_QUOTES));
		$t->set_var("tabla70_razon_social",htmlentities($row["tabla70_razon_social"],ENT_QUOTES));
		$t->set_var("tabla70_cuit",$row["tabla70_cuit"]);
		$t->set_var("tabla70_dni",htmlentities($row["tabla70_dni"],ENT_QUOTES));
		$t->set_var("tabla70_foto",htmlentities($row["tabla70_foto"],ENT_QUOTES));
		$t->set_var("tabla70_email",$row["tabla70_email"]);
		$t->set_var("tabla70_telefono",$row["tabla70_telefono"]);
		$t->set_var("tabla70_direccion",$row["tabla70_direccion"]);

		$url="'modulos/personal/php/ver_personal_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla70=$id_tabla70'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/personal/php/abm_personal_interfaz.php'";
		$vars="'nombre_funcion=borrar_personal&";
		$vars.="id_tabla70=$id_tabla70'";
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
	$qrT="select * from tabla_70_tbl_persona
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