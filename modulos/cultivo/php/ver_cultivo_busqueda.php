<?php
require_once "../../../php/check.php";
include "../../../lib/link_mysql.php";
require_once "../../../lib/template.inc";
include "../../../php/funciones_comunes.php";
session_start();

$t = new Template('../templates/');
//Archivos comunes
$t->set_file(array(
	"ver"				=> "ver_cultivo_busqueda.html",
	"un"				=> "un_cultivo.html",
	"una_opcion"		=> "una_opcion.html",
));
 
$offset=isset($_POST['offset']) ? intval($_POST['offset']) : '';
$id_tablamodulo=isset($_POST['id_tablamodulo']) ? intval($_POST['id_tablamodulo']) : NULL;
$titulo="Listado de Cultivos";
$t->set_var("Cultivos",$titulo);

//
//Otras Funciones
//$t->set_var("funcion_excel","modulos/libros/php/exportar_excel.php?tipo=xls");
//$t->set_var("funcion_doc","modulos/libros/php/exportar_excel.php?tipo=doc");
//$t->set_var("funcion_pdf","modulos/libros/php/exportar_excel.php");
//

$url="'modulos/cultivo/php/ver_cultivo.php'";
$id="'listado_cultivo'";
$vars="'es_buscar=si&id_tablamodulo=$id_tablamodulo&";	
$vars.="tabla16_fecha_siembra='+ver_busqueda_cultivo.tabla16_fecha_siembra.value";	
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
$sql="select * from tabla_16_cab_cultivo 
		order by tabla16_fecha_siembra ASC  
		Limit $totalporpag OFFSET $ini ";
$rs = $pdo->query($sql);//
$num_rows = $rs->rowCount();
if ($num_rows>0)
{
	while ($row = $rs->fetch())
	{
		$id_tabla16=$row["id_tabla16"];
		$rela_tabla15=$row["rela_tabla15"];
		$rela_tabla65=$row["rela_tabla65"];
		//encontrar el nombre de la variedad por medio del rela_tabla15
		$sql2="select * from tabla_15_tbl_variedad where id_tabla15=$rela_tabla15";
		$rs2=$pdo->query($sql2);
		$num_rows2 = $rs2->rowCount();
			if ($num_rows2>0){
				while ($row2 = $rs2->fetch())
			{
				$rela_tabla15=$row2["tabla15_nombre"];
			}
			}
		$t->set_var("rela_tabla15",$rela_tabla15);
		//encontrar el numero de la parcela por medio del rela_tabla65
		$sql2="select * from tabla_65_tbl_parcela where id_tabla65=$rela_tabla65";
		$rs2=$pdo->query($sql2);
		$num_rows2 = $rs2->rowCount();
			if ($num_rows2>0){
				while ($row2 = $rs2->fetch())
			{
				$rela_tabla65=$row2["id_tabla65"];
			}
			}
		$t->set_var("rela_tabla65",$rela_tabla65);
		$t->set_var("tabla16_fecha_cosecha",$row["tabla16_fecha_cosecha"]);
		$t->set_var("tabla16_fecha_siembra",$row["tabla16_fecha_siembra"]);

		
		$url="'modulos/cultivo/php/ver_cultivo_abm.php'";
		$id="'tabs-$id_tablamodulo'";
		$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo&id_tabla16=$id_tabla16'";
		$t->set_var("funcion_editar","cargar_post($url,$id,$vars)");	
		
		$url="'modulos/cultivo/php/abm_cultivo_interfaz.php'";
		$vars="'nombre_funcion=borrar_cultivo&";
		$vars.="id_tabla16=$id_tabla16'";
		$url_exito="'modulos/cultivo/php/ver_cultivo_busqueda.php'";
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
	$qrT="select * from tabla_16_cab_cultivo";
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
		$pag.="<td><a href=\"javascript:cargar_post('modulos/cultivo/php/ver_cultivo.php','listado_cultivo','offset=$off&id_tablamodulo=$id_tablamodulo');\"><< Anterior</a> | </td>";
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
			$pag.="<a href=\"javascript:cargar_post('modulos/cultivo/php/ver_cultivo.php','listado_cultivo','offset=$i&id_tablamodulo=$id_tablamodulo');\">$i</a>&nbsp;";
		}				 	 
	}
	$pag.="</td>";
					// Siguiente >>
	if($offset<$totalpaginas)
	{
		$ofs=$offset+1;
		$pag.="<td> | <a href=\"javascript:cargar_post('modulos/cultivo/php/ver_cultivo.php','listado_cultivo','offset=$ofs&id_tablamodulo=$id_tablamodulo');\">Siguiente >></a></td>";
	}else{
		$pag.="<td></td>";
	}
	$t->set_var("paginas","<table align=center><tr>".$pag."</tr></table>");
		//End Paginador
	
	$url="'modulos/cultivo/php/ver_cultivo_abm.php'";
	$id="'tabs-$id_tablamodulo'";
	$vars="'offset=$offset&id_tablamodulo=$id_tablamodulo'";
	$t->set_var("funcion_agregar","cargar_post($url,$id,$vars);");
	$t->set_var("icono_agregar","icon-plus.gif");	

$t->pparse("OUT", "ver");
?>