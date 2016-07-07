
<?php

require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";
session_start();

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_eventoclimatologico_busqueda.html",
	"un"				=> "un_eventoclimatologico.html",
	"una_opcion"		=> "una_opcion.html",
));
 
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$titulo="Listado de eventos climatologicos";
$t->set_var("titulo",$titulo);

//
//Otras Funciones
//$t->set_var("funcion_excel","modulos/libros/php/exportar_excel.php?tipo=xls");
//$t->set_var("funcion_doc","modulos/libros/php/exportar_excel.php?tipo=doc");
//$t->set_var("funcion_pdf","modulos/libros/php/exportar_excel.php");
//

$url="'modulos/evento_climatologico/php/ver_eventoclimatologico.php'";
$id="'listado_eventoclimatologico'";
$vars="'es_buscar=si&id_tablamodulo=$id_tablamodulo&";	
$vars.="tabla99_fecha_inicio='+ver_busqueda_eventoclimatologico.tabla99_fecha_inicio.value";	
$t->set_var("funcion_busqueda","cargar_post($url,$id,$vars)");

if (isset($_POST['offset'])) {
	$offset=$_POST["offset"];
} else {
	$offset = "";
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
		order by tabla99_fecha_inicio ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla99=$row["id_tabla99"];
		$rela_tabla01=$row["rela_tabla01"];
		$rela_tabla98=$row["rela_tabla98"];
		$rela_tabla74=$row["rela_tabla74"];
		$rela_tabla16=$row["rela_tabla16"];
		$rela_tabla71=$row["rela_tabla71"];

		$sql2="select * from tabla_98_tbl_tipo_evento where id_tabla98=$rela_tabla98   
		Limit $totalporpag OFFSET $ini ";
			$rs2 = $pdo->query($sql2);//
			$num_rows2 = $rs2->rowCount();
			if ($num_rows2>0)
			{
				while ($row2 = $rs2->fetch())
				{
					$tabla98_descripcion=$row2["tabla98_descripcion"];
				}
			}

			$sql3="select * from tabla_74_tbl_unidad_medicion where id_tabla74=$rela_tabla74   
		Limit $totalporpag OFFSET $ini ";
			$rs3 = $pdo->query($sql3);//
			$num_rows3 = $rs3->rowCount();
			if ($num_rows3>0)
			{
				while ($row3 = $rs3->fetch())
				{
					$tabla74_Tipo_Unidad=$row3["tabla74_Tipo_Unidad"];
				}
			}
		 

			$sql4="select * from tabla_99_cab_eventoclimatologico inner join tabla_16_cab_cultivo inner join tabla_15_tbl_variedad on tabla_99_cab_eventoclimatologico.rela_tabla16=id_tabla16 AND tabla_16_cab_cultivo.rela_tabla15=tabla_15_tbl_variedad.id_tabla15 ";
			$rs4 = $pdo->query($sql4);//
			$num_rows4 = $rs4->rowCount();
			if ($num_rows4>0)
			{
				while ($row4 = $rs4->fetch())
				{
					$tabla16_cultivo=$row4["tabla15_nombre"];
				}
			}

				$sql5="select * from tabla_01_usuarios where id_tabla01=$rela_tabla01   
		Limit $totalporpag OFFSET $ini ";
			$rs5 = $pdo->query($sql5);//
			$num_rows5 = $rs5->rowCount();
			if ($num_rows5>0)
			{
				while ($row5 = $rs5->fetch())
				{
					$tabla01_nombre=$row5["tabla01_nombre"];
				}
			}

			$sql6="select * from tabla_99_cab_eventoclimatologico inner join tabla_71_cab_personal inner join tabla_70_tbl_persona on tabla_99_cab_eventoclimatologico.rela_tabla71=id_tabla71 AND tabla_71_cab_personal.rela_tabla70=tabla_70_tbl_persona.id_tabla70";
			$rs6 = $pdo->query($sql6);//
			$num_rows6 = $rs6->rowCount();
			if ($num_rows6>0)
			{
				while ($row6 = $rs6->fetch())
				{
					$tabla71_personal=$row6["tabla70_nombre_apellido"];
				}
			}
		$t->set_var("tabla99_observacion",htmlentities($row["tabla99_observacion"],ENT_QUOTES));
		$t->set_var("tabla99_fecha_inicio",htmlentities($row["tabla99_fecha_inicio"],ENT_QUOTES));
		$t->set_var("tabla99_fecha_fin",htmlentities($row["tabla99_fecha_fin"],ENT_QUOTES));
		$t->set_var("rela_tabla16",$tabla16_cultivo);
		$t->set_var("rela_tabla01",$tabla01_nombre);
		$t->set_var("rela_tabla74",$tabla74_Tipo_Unidad);
		$t->set_var("rela_tabla71",$tabla71_personal);
		$t->set_var("tabla99_cantidad",$row["tabla99_cantidad"]);
		$t->set_var("rela_tabla98",$tabla98_descripcion);

		
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
	
}	
	$qrT="select * from tabla_99_cab_eventoclimatologico";
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